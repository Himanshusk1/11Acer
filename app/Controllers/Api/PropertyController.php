<?php
namespace App\Controllers\Api;

use App\Controllers\BaseController;
use App\Models\PropertyModel;
use App\Models\UserModel;
use App\Models\UserSubscriptionModel;
use App\Models\SubscriptionModel;
use App\Models\PropertyDetailModel;
use App\Models\PropertyMediaModel;
use App\Models\PropertyPricingModel;
use App\Models\PropertyVideoLinkModel;
use CodeIgniter\API\ResponseTrait;

class PropertyController extends BaseController
{
    use ResponseTrait;

    protected $propertyModel;
    protected $detailModel;
    protected $mediaModel;
    protected $pricingModel;
    protected $userModel;
    protected $videoLinkModel;

    public function __construct()
    {
        $this->propertyModel = new PropertyModel();
        $this->detailModel   = new PropertyDetailModel();
        $this->mediaModel    = new PropertyMediaModel();
        $this->pricingModel  = new PropertyPricingModel();
        $this->videoLinkModel = new PropertyVideoLinkModel();
        $this->userModel     = new UserModel();
        $this->userSubscriptionModel = new UserSubscriptionModel();
        $this->subscriptionModel = new SubscriptionModel();
    }

    // ✅ Create property with all details
    public function createFullProperty()
    {
        // Support both JSON payloads and multipart/form-data (files + POST fields).
        $data = null;

        // Only attempt to parse JSON when the request actually is JSON to avoid throwing exceptions
        try {
            if (method_exists($this->request, 'isJSON') && $this->request->isJSON()) {
                $data = $this->request->getJSON(true);
            }
        } catch (\Throwable $e) {
            // Log JSON parse error and continue to try POST fallback
            log_message('error', 'createFullProperty: Failed to parse JSON payload: ' . $e->getMessage());
            $data = null;
        }

        if (empty($data)) {
            // fallback to form POST (when files are uploaded)
            $data = $this->request->getPost();
        }

        if (empty($data) && empty($this->request->getFiles())) {
            return $this->fail('No data provided.', 400);
        }

        // ----- Enforce subscription/posting policy server-side -----
        $userId = session()->get('user_id');
        $role = session()->get('role') ?? 'user';

        if (empty($userId)) {
            return $this->failUnauthorized('Not authenticated');
        }

        // check active subscription
        $now = date('Y-m-d H:i:s');
        $active = $this->userSubscriptionModel
            ->where('user_id', $userId)
            ->where('active', 1)
            ->where('expires_at >', $now)
            ->orderBy('expires_at', 'DESC')
            ->first();

        if (!$active) {
            if ($role === 'agent') {
                return $this->failForbidden('Agents must purchase a subscription to post properties.');
            }

            // normal user: allow first post or after 90 days
            $count = $this->propertyModel->where('user_id', $userId)->countAllResults();
            if ($count > 0) {
                $last = $this->propertyModel->where('user_id', $userId)->orderBy('created_at', 'DESC')->first();
                if ($last && !empty($last['created_at'])) {
                    $lastdt = new \DateTime($last['created_at']);
                    $nowdt = new \DateTime();
                    $diff = $nowdt->diff($lastdt);
                    $days = (int)$diff->format('%a');
                    if ($days < 90) {
                        return $this->failForbidden('You can post again after ' . (90 - $days) . ' day(s) or purchase a subscription.');
                    }
                }
            }
        }

        // 1️⃣ Insert into properties table
        // Only insert fields that are known to exist on the `properties_new` table.
        // Server-side validation: property_name is required
        $propertyName = isset($data['property_name']) ? trim($data['property_name']) : '';
        if ($propertyName === '') {
            return $this->failValidationError('Property name is required');
        }

        $propertyData = [
            'user_id'           => session()->get('user_id') ?? 1,
            'transaction_type'  => $data['lookingTo'] ?? '',
            'property_category' => $data['propertyCategory'] ?? '',
            'property_type'     => $data['propertyType'] ?? '',
            'status'            => 'draft',
            'property_name'     => $propertyName,
            'city'              => $data['city'] ?? '',
            'locality'          => $data['locality'] ?? ''
        ];

        // Insert and get inserted ID
        $this->propertyModel->insert($propertyData);
        $propertyId = $this->propertyModel->getInsertID();

        if (!$propertyId) {
            return $this->failServerError('Failed to create property.');
        }

        // 2️⃣ Insert property details (as JSON)
        // Move fields that don't exist as columns into the details JSON
        $details = [
            'area_sqft'           => $data['area_sqft'] ?? '',
            'availability'        => $data['availability'] ?? '',
            'expected_completion' => $data['expected_completion'] ?? '',
            'ownership'           => $data['ownership'] ?? '',
            'amenities'           => $data['amenities'] ?? [],
            'unique_features'     => $data['unique_features'] ?? '',
            'voice_over'          => $data['voice_over'] ?? '',
            // extra metadata moved from property table to details
            'sub_property_type'   => $data['subPropertyType'] ?? '',
            'sublocality'         => $data['sublocality'] ?? '',
            'apartment'           => $data['apartment'] ?? '',
            'posted_on'           => date('Y-m-d H:i:s')
        ];

        $this->detailModel->insert([
            'property_id'  => $propertyId,
            'details_json' => json_encode($details)
        ]);

        $videoUrls = [];
        if (!empty($data['video_urls'])) {
            $videoUrls = is_array($data['video_urls']) ? $data['video_urls'] : [$data['video_urls']];
        }

        // 3️⃣ Insert media (images/videos)
        // First: ensure uploads directory exists
        $uploadPath = FCPATH . 'uploads' . DIRECTORY_SEPARATOR . 'properties' . DIRECTORY_SEPARATOR;
        if (!is_dir($uploadPath)) {
            @mkdir($uploadPath, 0755, true);
            // Optionally, create an index.html to prevent directory listing
            @file_put_contents($uploadPath . 'index.html', '<!-- silence -->');
        }

        // If client supplied filenames in JSON (existing approach), add them as media rows
        if (!empty($data['photos']) && is_array($data['photos'])) {
            foreach ($data['photos'] as $photo) {
                if (!empty($photo)) {
                    $this->mediaModel->insert([
                        'property_id' => $propertyId,
                        'file_url'    => base_url('uploads/properties/' . $photo),
                        'file_type'   => 'image'
                    ]);
                }
            }
        }

        if (!empty($data['video']) && !empty($data['video']['url'])) {
            $videoUrl = trim($data['video']['url']);
            if ($videoUrl !== '') {
                $this->mediaModel->insert([
                    'property_id' => $propertyId,
                    'file_url'    => $videoUrl,
                    'file_type'   => 'video'
                ]);
                $videoUrls[] = $videoUrl;
            }
        }

        $videoUrls = array_unique(array_filter(array_map('trim', $videoUrls)));
        foreach ($videoUrls as $url) {
            if (!filter_var($url, FILTER_VALIDATE_URL)) {
                continue;
            }
            $this->videoLinkModel->insert([
                'property_id' => $propertyId,
                'url'         => $url
            ]);
        }

    // Next: handle actual file uploads from multipart/form-data
        // Prefer explicit handling for common multi-file fields 'photos[]' and 'videos[]' using CI's getFileMultiple()
        $maxUploadSize = 10 * 1024 * 1024; // bytes
        $uploadErrors = [];
        $uploaded = [];

        // Helper to process a single UploadedFile instance
        $processFile = function($file, $inputName) use (&$uploadPath, &$propertyId, &$uploadErrors, &$uploaded, $maxUploadSize) {
            if (!is_object($file) || !method_exists($file, 'isValid')) {
                return;
            }

            if (!$file->isValid()) {
                $err = method_exists($file, 'getError') ? $file->getError() : 'unknown';
                $msg = "Property upload failed for input '{$inputName}': error={$err}";
                log_message('error', $msg);
                $uploadErrors[] = ['input' => $inputName, 'error' => $err, 'message' => $msg];
                return;
            }

            $mimeCheck = method_exists($file, 'getClientMimeType') ? $file->getClientMimeType() : ($file->getMimeType() ?? '');
            $isVideoFile = stripos($mimeCheck, 'video') !== false;
            if ($isVideoFile) {
                $size = method_exists($file, 'getSize') ? $file->getSize() : 0;
                if ($size > $maxUploadSize) {
                    $msg = "Rejected upload for input '{$inputName}': video exceeds max size of {$maxUploadSize} bytes (size={$size})";
                    log_message('error', $msg);
                    $uploadErrors[] = ['input' => $inputName, 'error' => 'too_large', 'message' => $msg, 'size' => $size];
                    return;
                }
            }

            if ($file->hasMoved()) {
                return;
            }

            $newName = $file->getRandomName();
            try {
                $moved = $file->move($uploadPath, $newName);
            } catch (\Throwable $e) {
                log_message('error', "Failed to move uploaded file for property {$propertyId}: " . $e->getMessage());
                $uploadErrors[] = ['input' => $inputName, 'error' => 'exception', 'message' => $e->getMessage()];
                return;
            }

            if ($moved || $file->hasMoved()) {
                $mime = method_exists($file, 'getClientMimeType') ? $file->getClientMimeType() : ($file->getMimeType() ?? 'application/octet-stream');
                $type = 'image';
                if (strpos($mime, 'video') !== false) {
                    $type = 'video';
                } elseif (stripos($inputName, 'floor_plan') !== false) {
                    $type = 'floor_plan';
                }

                $this->mediaModel->insert([
                    'property_id' => $propertyId,
                    'file_url'    => base_url('uploads/properties/' . $newName),
                    'file_type'   => $type
                ]);
                $uploaded[] = ['input' => $inputName, 'file' => $newName, 'type' => $type, 'mime' => $mime];
            } else {
                $msg = "Upload move returned false for property {$propertyId}, input {$inputName}";
                log_message('error', $msg);
                $uploadErrors[] = ['input' => $inputName, 'error' => 'move_failed', 'message' => $msg];
            }
        };

        // Log a short summary of received files for debugging (names, sizes, errors)
        try {
            $rawFiles = $_FILES ?? [];
            $summary = [];
            foreach ($rawFiles as $k => $f) {
                // f may be array for multiple files
                if (is_array($f['name'])) {
                    for ($i = 0; $i < count($f['name']); $i++) {
                        $summary[] = ['field' => $k, 'name' => $f['name'][$i], 'size' => $f['size'][$i], 'error' => $f['error'][$i]];
                    }
                } else {
                    $summary[] = ['field' => $k, 'name' => $f['name'], 'size' => $f['size'], 'error' => $f['error']];
                }
            }
            log_message('debug', 'createFullProperty received files summary: ' . json_encode($summary));
        } catch (\Throwable $e) {
            log_message('debug', 'createFullProperty could not summarize $_FILES: ' . $e->getMessage());
        }

        // Handle photos[] explicitly
        try {
            $photoFiles = $this->request->getFileMultiple('photos');
            if (!empty($photoFiles)) {
                foreach ($photoFiles as $file) {
                    $processFile($file, 'photos');
                }
            }
        } catch (\Throwable $e) {
            // ignore if getFileMultiple not applicable
        }

        // Handle videos[] explicitly
        try {
            $videoFiles = $this->request->getFileMultiple('videos');
            if (!empty($videoFiles)) {
                foreach ($videoFiles as $file) {
                    $processFile($file, 'videos');
                }
            }
        } catch (\Throwable $e) {
            // ignore
        }

        // Fallback: process any other files that may have been uploaded under different names
        $files = $this->request->getFiles();
        if (!empty($files)) {
            foreach ($files as $inputName => $fileOrArray) {
                // Skip photos/videos already handled
                if (strpos($inputName, 'photos') !== false || strpos($inputName, 'videos') !== false) continue;

                $items = is_array($fileOrArray) ? $fileOrArray : [$fileOrArray];
                foreach ($items as $file) {
                    $processFile($file, $inputName);
                }
            }
        }

        // 5️⃣ Insert pricing info (if provided)
        if (!empty($data['price']) || !empty($data['maintenance']) || isset($data['negotiable']) || !empty($data['available_from'])) {
            $this->pricingModel->replace([
                'property_id'    => $propertyId,
                'price'          => $data['price'] ?? null,
                'maintenance'    => $data['maintenance'] ?? null,
                'available_from' => $data['available_from'] ?? null,
                'negotiable'     => !empty($data['negotiable']) ? 1 : 0,
            ]);
        }

        $responsePayload = [
            'message'     => 'Property created successfully',
            'property_id' => $propertyId,
            'uploaded'    => $uploaded
        ];

        if (!empty($uploadErrors)) {
            // Include upload warnings in response but still return 201 so property exists.
            $responsePayload['upload_errors'] = $uploadErrors;

            // If any error is UPLOAD_ERR_INI_SIZE (1) or many files are missing (error=4), add guidance.
            $hasIniSize = false;
            $hasNoFile = false;
            foreach ($uploadErrors as $ue) {
                if (isset($ue['error']) && ($ue['error'] === 1 || $ue['error'] === '1')) $hasIniSize = true;
                if (isset($ue['error']) && ($ue['error'] === 4 || $ue['error'] === '4')) $hasNoFile = true;
            }

            if ($hasIniSize) {
                $responsePayload['upload_warning'] = 'One or more files exceed server upload_max_filesize or post_max_size.';
                $responsePayload['php_upload_max_filesize'] = ini_get('upload_max_filesize');
                $responsePayload['php_post_max_size'] = ini_get('post_max_size');
                // log $_FILES for debugging (avoid exposing in production responses)
                log_message('error', 'File upload failed due to PHP INI limit. upload_max_filesize=' . ini_get('upload_max_filesize') . ', post_max_size=' . ini_get('post_max_size'));
                log_message('debug', 'Raw $_FILES: ' . json_encode($_FILES));
            }

            if ($hasNoFile && !$hasIniSize) {
                // no-file often happens when total POST payload exceeds post_max_size or when inputs were empty
                $responsePayload['upload_warning'] = $responsePayload['upload_warning'] ?? 'Some files were not received by the server.';
                $responsePayload['php_upload_max_filesize'] = ini_get('upload_max_filesize');
                $responsePayload['php_post_max_size'] = ini_get('post_max_size');
                log_message('debug', 'File upload returned NO_FILE for some inputs. Raw $_FILES: ' . json_encode($_FILES));
            }
        }

        return $this->respondCreated($responsePayload);
    }

    // ✅ Fetch all properties with details & media
    public function getAllProperties()
    {
        try {
            $properties = $this->propertyModel->findAll();

            if (empty($properties)) {
                return $this->respond([
                    'status'  => 'success',
                    'data'    => [],
                    'message' => 'No properties found.'
                ]);
            }

            // Batch-fetch related data to avoid N+1 queries
            $propertyIds = array_column($properties, 'id');

            // Details
            $detailsRows = $this->detailModel->whereIn('property_id', $propertyIds)->findAll();
            $detailsMap = [];
            foreach ($detailsRows as $d) {
                $detailsMap[$d['property_id']] = json_decode($d['details_json'], true) ?: [];
            }

            // Media
            $mediaRows = $this->mediaModel->whereIn('property_id', $propertyIds)->orderBy('id', 'ASC')->findAll();
            $mediaMap = [];
            foreach ($mediaRows as $m) {
                $mediaMap[$m['property_id']][] = $m;
            }

            $videoLinkRows = $this->videoLinkModel->whereIn('property_id', $propertyIds)->orderBy('id', 'ASC')->findAll();
            $videoLinkMap = [];
            foreach ($videoLinkRows as $link) {
                $videoLinkMap[$link['property_id']][] = $link['url'];
            }

            // Pricing (if model exists)
            $pricingMap = [];
            if (isset($this->pricingModel)) {
                $pricingRows = $this->pricingModel->whereIn('property_id', $propertyIds)->findAll();
                foreach ($pricingRows as $p) {
                    $pricingMap[$p['property_id']] = $p;
                }
            }

            // Owner metadata fetched via UserModel by user_id/created_by
            $userMap = [];
            $ownerIds = [];
            foreach ($properties as $propertyRow) {
                if (!empty($propertyRow['user_id'])) {
                    $ownerIds[] = $propertyRow['user_id'];
                }
                if (!empty($propertyRow['created_by'])) {
                    $ownerIds[] = $propertyRow['created_by'];
                }
            }
            $ownerIds = array_values(array_unique($ownerIds));
            if (!empty($ownerIds)) {
                $userRows = $this->userModel
                    ->select(['user_id', 'full_name', 'email', 'phone_number', 'role'])
                    ->whereIn('user_id', $ownerIds)
                    ->findAll();
                foreach ($userRows as $userRow) {
                    $userMap[(string)$userRow['user_id']] = $userRow;
                }
            }

            // Attach maps to each property
            foreach ($properties as &$property) {
                $pid = $property['id'];
                $property['details'] = $detailsMap[$pid] ?? [];
                $property['media']   = $mediaMap[$pid] ?? [];
                $property['pricing'] = $pricingMap[$pid] ?? null;
                $ownerKey = null;
                if (!empty($property['user_id'])) {
                    $ownerKey = (string)$property['user_id'];
                } elseif (!empty($property['created_by'])) {
                    $ownerKey = (string)$property['created_by'];
                }
                $property['user'] = $ownerKey ? ($userMap[$ownerKey] ?? null) : null;
                $property['video_links'] = $videoLinkMap[$pid] ?? [];
            }

            return $this->respond([
                'status' => 'success',
                'count'  => count($properties),
                'data'   => $properties
            ]);

        } catch (\Throwable $e) {
            return $this->failServerError($e->getMessage());
        }
    }

    /**
     * Fetch properties belonging to the currently logged-in user.
     */
    public function getMyProperties()
    {
        $userId = session()->get('user_id');
        if (empty($userId)) {
            return $this->failUnauthorized('Not authenticated');
        }

        try {
            $properties = $this->propertyModel->where('user_id', $userId)->findAll();

            if (empty($properties)) {
                return $this->respond([
                    'status' => 'success',
                    'count'  => 0,
                    'data'   => []
                ]);
            }

            $propertyIds = array_column($properties, 'id');

            // Details
            $detailsRows = $this->detailModel->whereIn('property_id', $propertyIds)->findAll();
            $detailsMap = [];
            foreach ($detailsRows as $d) {
                $detailsMap[$d['property_id']] = json_decode($d['details_json'], true) ?: [];
            }

            // Media
            $mediaRows = $this->mediaModel->whereIn('property_id', $propertyIds)->orderBy('id', 'ASC')->findAll();
            $mediaMap = [];
            foreach ($mediaRows as $m) {
                $mediaMap[$m['property_id']][] = $m;
            }

            $videoLinkRows = $this->videoLinkModel->whereIn('property_id', $propertyIds)->orderBy('id', 'ASC')->findAll();
            $videoLinkMap = [];
            foreach ($videoLinkRows as $link) {
                $videoLinkMap[$link['property_id']][] = $link['url'];
            }

            // Pricing
            $pricingMap = [];
            if (isset($this->pricingModel)) {
                $pricingRows = $this->pricingModel->whereIn('property_id', $propertyIds)->findAll();
                foreach ($pricingRows as $p) {
                    $pricingMap[$p['property_id']] = $p;
                }
            }

            foreach ($properties as &$property) {
                $pid = $property['id'];
                $property['details'] = $detailsMap[$pid] ?? [];
                $property['media']   = $mediaMap[$pid] ?? [];
                $property['pricing'] = $pricingMap[$pid] ?? null;
                $property['video_links'] = $videoLinkMap[$pid] ?? [];
            }

            return $this->respond([
                'status' => 'success',
                'count'  => count($properties),
                'data'   => $properties
            ]);

        } catch (\Throwable $e) {
            return $this->failServerError($e->getMessage());
        }
    }

    /**
     * Delete a property owned by the current user.
     */
    public function delete($id = null)
    {
        if (empty($id)) {
            return $this->failValidationError('Property ID is required');
        }

        $property = $this->propertyModel->find($id);
        if (empty($property)) {
            return $this->failNotFound('Property not found');
        }

        $userId = session()->get('user_id');
        if (empty($userId)) {
            return $this->failUnauthorized('Not authenticated');
        }

        // Only allow owner or admin (simple check: role==admin) to delete
        $role = session()->get('role');
        if ((int)$property['user_id'] !== (int)$userId && $role !== 'admin') {
            return $this->failForbidden('You are not allowed to delete this property');
        }

        try {
            // Remove related rows first
            $this->mediaModel->where('property_id', $id)->delete();
            $this->videoLinkModel->where('property_id', $id)->delete();
            $this->detailModel->where('property_id', $id)->delete();
            if (isset($this->pricingModel)) {
                $this->pricingModel->where('property_id', $id)->delete();
            }

            $this->propertyModel->delete($id);

            return $this->respondDeleted(['message' => 'Property deleted']);
        } catch (\Throwable $e) {
            return $this->failServerError($e->getMessage());
        }
    }

    /**
     * Update a property's basic fields and pricing.
     */
    public function update($id = null)
    {
        if (empty($id)) {
            return $this->failValidationError('Property ID is required');
        }

        $property = $this->propertyModel->find($id);
        if (empty($property)) {
            return $this->failNotFound('Property not found');
        }

        $userId = session()->get('user_id');
        if (empty($userId)) {
            return $this->failUnauthorized('Not authenticated');
        }

        $role = session()->get('role');
        if ((int)$property['user_id'] !== (int)$userId && $role !== 'admin') {
            return $this->failForbidden('You are not allowed to update this property');
        }

        // Parse JSON/PUT body robustly: try getJSON(), then raw input, then POST
        $payload = null;
        try {
            // Prefer getJSON when content-type is application/json
            if (method_exists($this->request, 'getJSON')) {
                $payload = $this->request->getJSON(true);
            }
        } catch (\Throwable $e) {
            log_message('debug', 'PropertyController::update getJSON failed: ' . $e->getMessage());
            $payload = null;
        }

        if (empty($payload)) {
            // Try raw input (php://input)
            try {
                $raw = $this->request->getRawInput();
                if (!empty($raw) && is_string($raw)) {
                    $decoded = json_decode($raw, true);
                    if (json_last_error() === JSON_ERROR_NONE) {
                        $payload = $decoded;
                    }
                } elseif (!empty($raw) && is_array($raw)) {
                    $payload = $raw;
                }
            } catch (\Throwable $e) {
                // ignore
            }
        }

        if (empty($payload)) {
            // Fallback to POST/PUT form vars
            $payload = $this->request->getPost();
        }

        if (empty($payload)) {
            return $this->fail('No data provided', 400);
        }

        $updateData = [];
        // Only allow updating known safe fields
        $allowed = ['city','locality','status','property_type','property_category','property_name','title'];
        foreach ($allowed as $k) {
            if (isset($payload[$k]) && $payload[$k] !== '') {
                // Prevent updating property_name to empty string
                if ($k === 'property_name') {
                    $pn = trim($payload[$k]);
                    if ($pn === '') {
                        return $this->failValidationError('Property name cannot be empty');
                    }
                    $updateData[$k] = $pn;
                } else {
                    $updateData[$k] = $payload[$k];
                }
            }
        }

        try {
            // Log payload for debugging
            log_message('debug', 'PropertyController::update payload: ' . json_encode($payload));
            log_message('debug', 'PropertyController::update prepared updateData: ' . json_encode($updateData));

            if (!empty($updateData)) {
                // Handle fields that don't exist on the properties table (e.g., title)
                if (isset($updateData['title'])) {
                    $titleVal = $updateData['title'];
                    unset($updateData['title']);
                    // Update details JSON with title
                    $detailRow = $this->detailModel->where('property_id', $id)->first();
                    if ($detailRow) {
                        $detailsJson = json_decode($detailRow['details_json'], true) ?: [];
                        $detailsJson['title'] = $titleVal;
                        $this->detailModel->update($detailRow['id'], ['details_json' => json_encode($detailsJson)]);
                        log_message('debug', "PropertyDetail updated title for property_id={$id}");
                    } else {
                        $detailsJson = ['title' => $titleVal, 'posted_on' => date('Y-m-d H:i:s')];
                        $this->detailModel->insert(['property_id' => $id, 'details_json' => json_encode($detailsJson)]);
                        log_message('debug', "PropertyDetail inserted title for property_id={$id}");
                    }
                }

                if (!empty($updateData)) {
                    $this->propertyModel->update($id, $updateData);
                    log_message('debug', "PropertyModel->update succeeded for id={$id}");
                }
            }

            if (isset($payload['price']) && $payload['price'] !== '') {
                // upsert pricing
                $this->pricingModel->replace([
                    'property_id' => $id,
                    'price'       => $payload['price'],
                    'maintenance' => $payload['maintenance'] ?? null,
                    'available_from' => $payload['available_from'] ?? null,
                    'negotiable'  => !empty($payload['negotiable']) ? 1 : 0
                ]);
                log_message('debug', "PropertyPricingModel->replace succeeded for property_id={$id}");
            }

            return $this->respond(['status' => 'success', 'message' => 'Property updated']);
        } catch (\Throwable $e) {
            log_message('error', 'PropertyController::update exception: ' . $e->getMessage() . '\n' . $e->getTraceAsString());
            return $this->failServerError('Internal error while updating property');
        }
    }

}
