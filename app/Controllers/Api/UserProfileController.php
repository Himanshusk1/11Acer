<?php
namespace App\Controllers\Api;

use App\Controllers\BaseController;
use App\Models\UserProfileModel;
use App\Models\UserModel;

class UserProfileController extends BaseController
{
    protected $userModel;
    protected $profileModel;

    public function __construct()
    {
        $this->userModel = new UserModel();
        $this->profileModel = new UserProfileModel();
    }

    public function getProfile()
    {
        $session = session();
        $userId = $session->get('user_id');
        if (!$userId) {
            return $this->response->setStatusCode(401)->setJSON(['error' => 'Not authenticated']);
        }

        $user = $this->userModel->find($userId);
        $profile = $this->profileModel->getByUser($userId);

        $extra = [];
        if (!empty($profile['extra_data'])) {
            $extra = json_decode($profile['extra_data'], true) ?: [];
        }

        return $this->response->setJSON([
            'user' => $user,
            'profile' => $profile,
            'extra' => $extra,
        ]);
    }

    public function updateProfile()
    {
        $session = session();
        $userId = $session->get('user_id');
        if (!$userId) {
            return $this->response->setStatusCode(401)->setJSON(['error' => 'Not authenticated']);
        }

        $role = $session->get('role') ?: 'user';

        $post = $this->request->getPost();

        // Validate core fields
        $full_name = isset($post['full_name']) ? trim($post['full_name']) : null;
        $email = isset($post['email']) ? trim($post['email']) : null;

        $updateUser = [];
        if ($full_name !== null) $updateUser['full_name'] = $full_name;
        if ($email !== null) $updateUser['email'] = $email;

        // Prevent changing phone via this endpoint

        // Handle file upload (photo)
        $photoUrl = null;
        $file = $this->request->getFile('photo');
        if ($file && $file->isValid() && !$file->hasMoved()) {
            $ext = $file->getClientExtension();
            $name = $userId . '_' . time() . '.' . $ext;
            $targetDir = FCPATH . 'uploads/profile/';
            if (!is_dir($targetDir)) {
                mkdir($targetDir, 0755, true);
            }
            try {
                $file->move($targetDir, $name);
                $photoUrl = base_url('uploads/profile/' . $name);
            } catch (\Exception $e) {
                return $this->response->setStatusCode(500)->setJSON(['error' => 'Failed to save uploaded file']);
            }
        }

        // Agent extra fields
        $extra = [];
        if ($role === 'agent') {
            $agentFields = [
                'about','experience','team_members','office_location','rera_number','languages','specializations'
            ];
            foreach ($agentFields as $f) {
                if ($this->request->getPost($f) !== null) {
                    $val = $this->request->getPost($f);
                    // Normalize arrays (specializations, languages) if JSON sent as string
                    if (is_string($val)) {
                        $decoded = json_decode($val, true);
                        if ($decoded !== null) $val = $decoded;
                    }
                    $extra[$f] = $val;
                }
            }
        }

        // Start DB updates
        try {
            if (!empty($updateUser)) {
                $this->userModel->update($userId, $updateUser);
            }

            // Merge extra_data with existing
            $existing = $this->profileModel->getByUser($userId);
            $existingExtra = [];
            if (!empty($existing['extra_data'])) {
                $existingExtra = json_decode($existing['extra_data'], true) ?: [];
            }
            // Merge, but only overwrite keys present in $extra
            $merged = $existingExtra;
            foreach ($extra as $k => $v) {
                $merged[$k] = $v;
            }

            $profileData = [];
            if ($photoUrl) $profileData['photo_url'] = $photoUrl;
            $profileData['extra_data'] = !empty($merged) ? json_encode($merged) : null;

            $this->profileModel->upsertByUser($userId, $profileData);

            return $this->response->setJSON(['success' => true, 'message' => 'Profile updated', 'profile' => $this->profileModel->getByUser($userId)]);
        } catch (\Exception $e) {
            log_message('error', 'UserProfileController::updateProfile exception: ' . $e->getMessage());
            return $this->response->setStatusCode(500)->setJSON(['error' => 'Failed to update profile']);
        }
    }

    public function deletePhoto()
    {
        $session = session();
        $userId = $session->get('user_id');
        if (!$userId) {
            return $this->response->setStatusCode(401)->setJSON(['error' => 'Not authenticated']);
        }

        $profile = $this->profileModel->getByUser($userId);
        if (empty($profile) || empty($profile['photo_url'])) {
            return $this->response->setStatusCode(404)->setJSON(['error' => 'No photo to delete']);
        }

        // Attempt to remove the file if it's in our uploads/profile folder
        try {
            $photoUrl = $profile['photo_url'];
            $filename = basename(parse_url($photoUrl, PHP_URL_PATH));
            $filePath = FCPATH . 'uploads/profile/' . $filename;
            if (is_file($filePath)) {
                @unlink($filePath);
            }

            // Update DB to clear photo_url
            $this->profileModel->upsertByUser($userId, ['photo_url' => null]);

            return $this->response->setJSON(['success' => true, 'message' => 'Photo removed']);
        } catch (\Exception $e) {
            log_message('error', 'UserProfileController::deletePhoto exception: ' . $e->getMessage());
            return $this->response->setStatusCode(500)->setJSON(['error' => 'Failed to remove photo']);
        }
    }
}
