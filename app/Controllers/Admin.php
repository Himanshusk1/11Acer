<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\PropertyModel;
use App\Models\PropertyDetailModel;
use App\Models\PropertyMediaModel;
use App\Models\PropertyPricingModel;
use App\Models\PaymentModel;
use App\Models\SubscriptionModel;
use CodeIgniter\HTTP\RedirectResponse;
use Config\Database;
use App\Models\UserModel;

use App\Models\ReferralCodeModel;
use App\Models\ReferralCodeUsageModel;
use App\Models\ServiceEnquiryModel;
use Throwable;


class Admin extends BaseController
{
    /**
     * Make absolutely sure only admins hit these handlers.
     */
    protected function guardAdmin(): ?RedirectResponse
    {
        if (session()->get('role') === 'admin') {
            return null;
        }

        $redirect = role_dashboard_path(session()->get('role'));
        return redirect()->to($redirect)->with('error', 'You are not authorized to access the admin area.');
    }

    /**
     * Show admin dashboard (static view)
     */
    public function index()
    {
        if ($response = $this->guardAdmin()) {
            return $response;
        }

        $filters = [
            'search'   => trim((string) $this->request->getGet('search')),
            'role'     => $this->request->getGet('role'),
            'per_page' => (int) $this->request->getGet('per_page'),
            'sort'     => $this->request->getGet('sort') ?: 'user_id',
            'order'    => strtolower($this->request->getGet('order') ?? 'asc'),
        ];

        $perPage   = $filters['per_page'] ?: 20;
        $perPage   = max(5, min(200, $perPage));
        $page      = max(1, (int) $this->request->getGet('page'));
        $userModel  = new UserModel();

        $userModel
            ->select('users.user_id, users.public_id, users.full_name, users.email, users.role, users.created_at, users.phone_number, referral_codes.code AS referral_code')
            ->join('referral_codes', 'referral_codes.user_id = users.user_id', 'left');

        if ($filters['search'] !== '') {
            $term = $filters['search'];
            $userModel->groupStart()
                ->like('full_name', $term)
                ->orLike('email', $term)
                ->orLike('phone_number', $term)
                ->orLike('user_id', $term)
                ->orLike('public_id', $term)
                ->orLike('referral_codes.code', $term)
            ->groupEnd();
        }

        if (! empty($filters['role'])) {
            $userModel->where('role', $filters['role']);
        }

        $sortable = ['user_id', 'public_id', 'referral_code', 'created_at'];
        $sort     = in_array($filters['sort'], $sortable, true) ? $filters['sort'] : 'user_id';
        $order    = $filters['order'] === 'desc' ? 'DESC' : 'ASC';

        $users = $userModel
            ->orderBy($sort, $order)
            ->paginate($perPage, 'users', $page);

        $data = array_merge(
            [
                'page_title'  => 'Admin Dashboard',
                'active_page' => 'admin',
                'users'       => $users,
                'pager'       => $userModel->pager,
                'filters'     => $filters,
            ],
            $this->collectDashboardData()
        );

        return view('admin/dashboard', $data);
    }

    /**
     * Lightweight JSON endpoint to let the dashboard refresh stats/charts without a full reload.
     */
    public function stats()
    {
        if ($response = $this->guardAdmin()) {
            return $response;
        }

        return $this->response->setJSON($this->collectDashboardData());
    }

    public function createUser()
    {
        if ($response = $this->guardAdmin()) {
            return $response;
        }

        helper('form');

        $roles = ['buyer', 'agent', 'builder', 'individual', 'admin'];

        return view('admin/users/create', [
            'page_title'  => 'Add User',
            'active_page' => 'admin',
            'roles'       => $roles,
            'validation'  => $this->validator ?? \Config\Services::validation(),
        ]);
    }

    public function storeUser()
    {
        if ($response = $this->guardAdmin()) {
            return $response;
        }

        helper(['form', 'public_id', 'referral_code']);

        $rules = [
            'full_name'    => 'required|min_length[3]|max_length[120]',
            'email'        => 'permit_empty|valid_email|is_unique[users.email]',
            'phone_number' => 'permit_empty|min_length[6]|max_length[20]',
            'city'         => 'permit_empty|max_length[120]',
            'role'         => 'required|in_list[buyer,agent,builder,individual,admin]',
        ];

        if (! $this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $model = new UserModel();
        $role = $this->request->getPost('role');
        $publicId = generate_public_id($role);

        $payload = [
            'full_name'    => trim((string) $this->request->getPost('full_name')),
            'email'        => trim((string) $this->request->getPost('email')) ?: null,
            'phone_number' => trim((string) $this->request->getPost('phone_number')) ?: null,
            'city'         => trim((string) $this->request->getPost('city')) ?: null,
            'role'         => $role,
            'public_id'    => $publicId,
        ];

        try {
            $userId = $model->insert($payload, true);

            if ($userId) {
                try {
                    ensure_referral_code_for_user((int) $userId, $publicId);
                } catch (Throwable $referralError) {
                    log_message('warning', 'Unable to generate referral code: {message}', ['message' => $referralError->getMessage()]);
                }
            }
        } catch (Throwable $exception) {
            log_message('error', 'Failed to create user via Admin::storeUser: {message}', ['message' => $exception->getMessage()]);
            return redirect()->back()->withInput()->with('errors', ['general' => 'Unable to create user right now. Please try again.']);
        }

        session()->setFlashdata('success', 'User created successfully.');

        return redirect()->to(site_url('admin'));
    }

    public function exportUsers()
    {
        if ($response = $this->guardAdmin()) {
            return $response;
        }

        $filters = [
            'search' => trim((string) $this->request->getGet('search')),
            'role'   => $this->request->getGet('role'),
            'sort'   => $this->request->getGet('sort') ?: 'user_id',
            'order'  => strtolower($this->request->getGet('order') ?? 'asc'),
        ];

        $userModel = new UserModel();
        $userModel
            ->select('users.user_id, users.public_id, users.full_name, users.email, users.role, users.phone_number, users.created_at, referral_codes.code AS referral_code')
            ->join('referral_codes', 'referral_codes.user_id = users.user_id', 'left');

        if ($filters['search'] !== '') {
            $term = $filters['search'];
            $userModel->groupStart()
                ->like('users.full_name', $term)
                ->orLike('users.email', $term)
                ->orLike('users.phone_number', $term)
                ->orLike('users.user_id', $term)
                ->orLike('users.public_id', $term)
                ->orLike('referral_codes.code', $term)
            ->groupEnd();
        }

        if (! empty($filters['role'])) {
            $userModel->where('users.role', $filters['role']);
        }

        $sortable = ['user_id', 'public_id', 'referral_code', 'created_at'];
        $sort     = in_array($filters['sort'], $sortable, true) ? $filters['sort'] : 'user_id';
        $order    = $filters['order'] === 'desc' ? 'DESC' : 'ASC';

        $records = $userModel->orderBy($sort, $order)->findAll();

        $filename = 'users-' . date('Ymd-His') . '.csv';
        $this->response->setHeader('Content-Type', 'text/csv; charset=UTF-8');
        $this->response->setHeader('Content-Disposition', 'attachment; filename="' . $filename . '"');
        $this->response->setHeader('Cache-Control', 'no-store, no-cache, must-revalidate');
        $this->response->setHeader('Pragma', 'no-cache');

        $stream = fopen('php://temp', 'r+');
        fputcsv($stream, ['ID', 'Public ID', 'Name', 'Email', 'Phone', 'Role', 'Referral Code', 'Created At']);

        foreach ($records as $row) {
            $createdAt = $row['created_at'] ? date('Y-m-d H:i', strtotime((string) $row['created_at'])) : '';
            fputcsv($stream, [
                $row['user_id'] ?? '',
                $row['public_id'] ?? '',
                $row['full_name'] ?? '',
                $row['email'] ?? '',
                $row['phone_number'] ?? '',
                $row['role'] ?? '',
                $row['referral_code'] ?? '',
                $createdAt,
            ]);
        }

        rewind($stream);
        $csv = stream_get_contents($stream) ?: '';
        fclose($stream);

        return $this->response->setBody($csv);
    }

    public function exportProperties()
    {
        if ($response = $this->guardAdmin()) {
            return $response;
        }

        $request = $this->request;
        $filters = [
            'search' => trim((string) $request->getGet('search')),
            'city'   => $request->getGet('city'),
            'type'   => $request->getGet('type'),
            'status' => $request->getGet('status'),
            'quick'  => $request->getGet('quick'),
        ];

        $propertyModel = new PropertyModel();
        $builder = $propertyModel->builder();
        $builder
            ->select('properties_new.*, pp.price, u.full_name AS owner_name, u.user_id AS owner_identifier')
            ->join('property_pricing pp', 'pp.property_id = properties_new.id', 'left')
            ->join('users u', 'u.user_id = properties_new.user_id', 'left');

        $quickFilters = ['recent', 'published', 'drafts'];
        if (! empty($filters['quick']) && in_array($filters['quick'], $quickFilters, true)) {
            switch ($filters['quick']) {
                case 'recent':
                    $builder->where('properties_new.created_at >=', date('Y-m-d 00:00:00', strtotime('-7 days')));
                    break;
                case 'published':
                    $filters['status'] = 'published';
                    break;
                case 'drafts':
                    $filters['status'] = 'draft';
                    break;
            }
        }

        if ($filters['search'] !== '') {
            $builder->groupStart()
                ->like('properties_new.property_name', $filters['search'])
                ->orLike('properties_new.city', $filters['search'])
                ->orLike('properties_new.locality', $filters['search'])
                ->orLike('u.full_name', $filters['search'])
                ->orLike('properties_new.user_id', $filters['search'])
            ->groupEnd();
        }

        if (! empty($filters['city'])) {
            $builder->where('properties_new.city', $filters['city']);
        }

        if (! empty($filters['type'])) {
            $builder->where('properties_new.property_type', $filters['type']);
        }

        if (! empty($filters['status'])) {
            $builder->where('properties_new.status', $filters['status']);
        }

        $records = $builder
            ->orderBy('properties_new.created_at', 'DESC')
            ->get()
            ->getResultArray();

        $filename = 'properties-' . date('Ymd-His') . '.csv';
        $this->response->setHeader('Content-Type', 'text/csv; charset=UTF-8');
        $this->response->setHeader('Content-Disposition', 'attachment; filename="' . $filename . '"');
        $this->response->setHeader('Cache-Control', 'no-store, no-cache, must-revalidate');
        $this->response->setHeader('Pragma', 'no-cache');

        $stream = fopen('php://temp', 'r+');
        fputcsv($stream, ['ID', 'Title', 'Owner', 'Type', 'City', 'Price', 'Status', 'Created At']);

        foreach ($records as $row) {
            $ownerIdentifier = $row['owner_identifier'] ?? '';
            $ownerLabel = trim(($row['owner_name'] ?? '') . ($ownerIdentifier ? ' (#' . $ownerIdentifier . ')' : ''));
            if ($ownerLabel === '') {
                $ownerLabel = 'User #' . ($row['user_id'] ?? '');
            }

            $createdAt = $row['created_at'] ? date('Y-m-d H:i', strtotime((string) $row['created_at'])) : '';

            fputcsv($stream, [
                $row['id'] ?? '',
                $row['property_name'] ?? '',
                $ownerLabel,
                $row['property_type'] ?? '',
                $row['city'] ?? '',
                $row['price'] ?? '',
                $row['status'] ?? '',
                $createdAt,
            ]);
        }

        rewind($stream);
        $csv = stream_get_contents($stream) ?: '';
        fclose($stream);

        return $this->response->setBody($csv);
    }

    public function exportPayments()
    {
        if ($response = $this->guardAdmin()) {
            return $response;
        }

        $limit = (int) $this->request->getGet('limit') ?: 500;
        $limit = max(10, min(2000, $limit));

        $paymentModel = new PaymentModel();
        $rawPayments = $paymentModel->getRecentPayments($limit);

        $rows = [];
        foreach ($rawPayments as $entry) {
            $txnId = sprintf('SUB%05d', $entry['id']);
            $fullName = trim($entry['full_name'] ?? '') ?: 'Unknown user';
            $userLabel = sprintf('%s (%s)', $fullName, $entry['user_id'] ?? '—');
            $type = $entry['plan_name'] ?: 'Subscription';
            $amount = number_format((float) ($entry['price'] ?? 0), 2, '.', '');

            $status = 'Pending';
            if ((int) ($entry['active'] ?? 0) === 1) {
                $status = 'Success';
            } elseif (empty($entry['starts_at'])) {
                $status = 'Failed';
            }

            $createdAt = '';
            if (! empty($entry['created_at'])) {
                $timestamp = strtotime((string) $entry['created_at']);
                $createdAt = $timestamp ? date('Y-m-d H:i', $timestamp) : '';
            }

            $rows[] = [$txnId, $userLabel, $type, $amount, $status, $createdAt];
        }

        $filename = 'payments-' . date('Ymd-His') . '.csv';
        $this->response->setHeader('Content-Type', 'text/csv; charset=UTF-8');
        $this->response->setHeader('Content-Disposition', 'attachment; filename="' . $filename . '"');
        $this->response->setHeader('Cache-Control', 'no-store, no-cache, must-revalidate');
        $this->response->setHeader('Pragma', 'no-cache');

        $stream = fopen('php://temp', 'r+');
        fputcsv($stream, ['Txn ID', 'User', 'Type', 'Amount', 'Status', 'Date']);
        foreach ($rows as $row) {
            fputcsv($stream, $row);
        }

        rewind($stream);
        $csv = stream_get_contents($stream) ?: '';
        fclose($stream);

        return $this->response->setBody($csv);
    }
    /**
     * Gather all dashboard metrics and recent activity from the database.
     */
    private function collectDashboardData(): array
    {
        $db = Database::connect();

        // Role distribution (buyers, agents, builders, etc.)
        $roleCountsRaw = $db->table('users')
            ->select('role, COUNT(*) AS total')
            ->groupBy('role')
            ->get()
            ->getResultArray();

        $roleCounts = [];
        foreach ($roleCountsRaw as $row) {
            $roleCounts[$row['role']] = (int) $row['total'];
        }

        $totalUsers  = array_sum($roleCounts);
        $newThisWeek = $db->table('users')
            ->where('created_at >=', date('Y-m-d 00:00:00', strtotime('-7 days')))
            ->countAllResults();

        // Properties overview
        $propertyStats = [
            'total'     => $db->table('properties_new')->countAll(),
            'published' => $db->table('properties_new')->where('status', 'published')->countAllResults(),
            'drafts'    => $db->table('properties_new')->where('status', 'draft')->countAllResults(),
        ];

        // User growth for the last 6 months (including current)
        $growthRows = $db->table('users')
            ->select("DATE_FORMAT(created_at, '%Y-%m') AS ym, COUNT(*) AS total", false)
            ->where('created_at >=', date('Y-m-01', strtotime('-5 months')))
            ->groupBy('ym')
            ->orderBy('ym')
            ->get()
            ->getResultArray();

        $growthMap = [];
        foreach ($growthRows as $row) {
            $growthMap[$row['ym']] = (int) $row['total'];
        }

        $growthLabels = [];
        $growthValues = [];
        for ($i = 5; $i >= 0; $i--) {
            $ym = date('Y-m', strtotime("-$i months"));
            $growthLabels[] = date('M', strtotime($ym . '-01'));
            $growthValues[] = $growthMap[$ym] ?? 0;
        }

        // Recent users (latest 12)
        $recentUsers = $db->table('users')
            ->select('user_id, full_name, email, role, created_at')
            ->orderBy('created_at', 'DESC')
            ->limit(12)
            ->get()
            ->getResultArray();

        // Recent property activity (latest 5)
        $recentProperties = $db->table('properties_new p')
            ->select('p.id, p.property_name, p.city, p.status, p.created_at, u.full_name AS owner_name')
            ->join('users u', 'u.user_id = p.user_id', 'left')
            ->orderBy('p.created_at', 'DESC')
            ->limit(5)
            ->get()
            ->getResultArray();

        return [
            'counts' => [
                'users'          => $totalUsers,
                'agents'         => $roleCounts['agent'] ?? 0,
                'builders'       => $roleCounts['builder'] ?? 0,
                'buyers'         => $roleCounts['buyer'] ?? 0,
                'admins'         => $roleCounts['admin'] ?? 0,
                'individuals'    => $roleCounts['individual'] ?? 0,
                'newThisWeek'    => $newThisWeek,
                'activeSessions' => $this->countSessions(),
            ],
            'roleSplit' => [
                'buyer'      => $roleCounts['buyer'] ?? 0,
                'agent'      => $roleCounts['agent'] ?? 0,
                'builder'    => $roleCounts['builder'] ?? 0,
                'individual' => $roleCounts['individual'] ?? 0,
                'admin'      => $roleCounts['admin'] ?? 0,
            ],
            'growth' => [
                'labels' => $growthLabels,
                'values' => $growthValues,
            ],
            'propertyStats'   => $propertyStats,
            'recentUsers'     => $recentUsers,
            'recentProperties'=> $recentProperties,
        ];
    }

    /**
     * Approximate current active sessions by counting session files.
     */
    private function countSessions(): int
    {
        $sessionConfig = config('Session');
        $path = $sessionConfig->savePath ?? WRITEPATH . 'session';
        $path = rtrim($path, '\\/' );

        if (! is_dir($path)) {
            return 0;
        }

        $files = glob($path . '/*');
        return $files ? count($files) : 0;
    }

    /**
     * Placeholder: delete a user (POST expected)
     */
    public function deleteUser($id = null)
    {
        if ($response = $this->guardAdmin()) {
            return $response;
        }

        $wantsJson = $this->wantsJson();

        $userModel = new UserModel();
        $user = $userModel->find($id);

        if (! $user) {
            if ($wantsJson) {
                return $this->response->setJSON(['ok' => false, 'message' => 'User not found'])->setStatusCode(404);
            }
            session()->setFlashdata('error', 'User not found.');
            return redirect()->to(site_url('admin'));
        }

        $userModel->delete($id);
        if ($wantsJson) {
            return $this->response->setJSON(['ok' => true, 'message' => 'User deleted', 'id' => $id]);
        }

        session()->setFlashdata('success', 'User ' . ($user['full_name'] ?? ('#' . $id)) . ' deleted.');
        return redirect()->to(site_url('admin'));
    }

    /**
     * Promote a user to admin role.
     */
    public function promoteToAdmin($id = null)
    {
        if ($response = $this->guardAdmin()) {
            return $response;
        }

        $wantsJson = $this->wantsJson();

        $userModel = new UserModel();
        $user = $userModel->find($id);

        if (! $user) {
            if ($wantsJson) {
                return $this->response->setJSON(['ok' => false, 'message' => 'User not found'])->setStatusCode(404);
            }
            session()->setFlashdata('error', 'User not found.');
            return redirect()->to(site_url('admin'));
        }

        $userModel->update($id, ['role' => 'admin']);
        if ($wantsJson) {
            return $this->response->setJSON([
                'ok'      => true,
                'message' => 'User promoted to admin',
                'id'      => $id,
            ]);
        }

        session()->setFlashdata('success', 'User ' . ($user['full_name'] ?? ('#' . $id)) . ' promoted to admin.');
        return redirect()->to(site_url('admin'));
    }

    /**
     * Decide if the caller expects JSON.
     */
    private function wantsJson(): bool
    {
        $accept = strtolower($this->request->getHeaderLine('Accept'));
        return $this->request->isAJAX()
            || str_contains($accept, 'application/json')
            || str_contains($accept, 'json');
    }

    /**
     * Delete a property/post record along with its related data.
     */
    public function deletePost($id = null)
    {
        if ($response = $this->guardAdmin()) {
            return $response;
        }

        if (! $this->request->is('post')) {
            return redirect()->to(site_url('admin'));
        }

        $wantsJson = $this->wantsJson();
        if ($id === null) {
            return $this->handleDeleteFailure('Missing post identifier.', 400, $wantsJson);
        }

        $propertyModel = new PropertyModel();
        $property = $propertyModel->find($id);
        if (! $property) {
            return $this->handleDeleteFailure('Post not found.', 404, $wantsJson);
        }

        $detailModel  = new PropertyDetailModel();
        $mediaModel   = new PropertyMediaModel();
        $pricingModel = new PropertyPricingModel();
        $db = Database::connect();

        $db->transStart();
        $detailModel->where('property_id', $id)->delete();
        $mediaModel->where('property_id', $id)->delete();
        $pricingModel->where('property_id', $id)->delete();
        $propertyModel->delete($id);
        $db->transComplete();

        if (! $db->transStatus()) {
            log_message('error', 'Failed to delete property ' . $id . ' via Admin::deletePost');
            return $this->handleDeleteFailure('Unable to delete the post. Please try again.', 500, $wantsJson);
        }

        $label = $property['property_name'] ?? ('#' . $id);
        if ($wantsJson) {
            return $this->response->setJSON([
                'ok'      => true,
                'message' => 'Post deleted successfully.',
                'id'      => $id,
            ]);
        }

        session()->setFlashdata('success', 'Post ' . $label . ' deleted successfully.');
        return redirect()->to(site_url('admin/properties'));
    }

    private function handleDeleteFailure(string $message, int $status, bool $wantsJson)
    {
        if ($wantsJson) {
            return $this->response
                ->setStatusCode($status)
                ->setJSON(['ok' => false, 'message' => $message]);
        }

        $type = $status >= 500 ? 'error' : 'warning';
        session()->setFlashdata($type, $message);
        return redirect()->back()->withInput();
    }

    /**
     * Property listings with smart/quick filters
     */
    public function properties()
    {
        if ($response = $this->guardAdmin()) {
            return $response;
        }

        $request = $this->request;
        $filters = [
            'search' => trim((string) $request->getGet('search')),
            'city'   => $request->getGet('city'),
            'type'   => $request->getGet('type'),
            'status' => $request->getGet('status'),
            'quick'  => $request->getGet('quick'),
        ];

        $propertyModel = new PropertyModel();
        $builder = $propertyModel->builder();
        $builder
            ->select('properties_new.*, pp.price, u.full_name AS owner_name, u.user_id AS owner_identifier')
            ->join('property_pricing pp', 'pp.property_id = properties_new.id', 'left')
            ->join('users u', 'u.user_id = properties_new.user_id', 'left');

        $quickFilters = [
            'recent'    => 'Added last 7 days',
            'published' => 'Published only',
            'drafts'    => 'Drafts needing review',
        ];

        if (! empty($filters['quick']) && array_key_exists($filters['quick'], $quickFilters)) {
            switch ($filters['quick']) {
                case 'recent':
                    $builder->where('properties_new.created_at >=', date('Y-m-d 00:00:00', strtotime('-7 days')));
                    break;
                case 'published':
                    $filters['status'] = 'published';
                    break;
                case 'drafts':
                    $filters['status'] = 'draft';
                    break;
            }
        }

        if ($filters['search'] !== '') {
            $builder->groupStart()
                ->like('properties_new.property_name', $filters['search'])
                ->orLike('properties_new.city', $filters['search'])
                ->orLike('properties_new.locality', $filters['search'])
                ->orLike('u.full_name', $filters['search'])
                ->orLike('properties_new.user_id', $filters['search'])
                ->groupEnd();
        }

        if (! empty($filters['city'])) {
            $builder->where('properties_new.city', $filters['city']);
        }

        if (! empty($filters['type'])) {
            $builder->where('properties_new.property_type', $filters['type']);
        }

        if (! empty($filters['status'])) {
            $builder->where('properties_new.status', $filters['status']);
        }

        $properties = $builder
            ->orderBy('properties_new.created_at', 'DESC')
            ->limit(500)
            ->get()
            ->getResultArray();

        $db = Database::connect();
        $stats = [
            'total'     => $db->table('properties_new')->countAll(),
            'published' => $db->table('properties_new')->where('status', 'published')->countAllResults(),
            'drafts'    => $db->table('properties_new')->where('status', 'draft')->countAllResults(),
            'flagged'   => $db->table('properties_new')->where('status', 'flagged')->countAllResults(),
        ];

        $cities = array_column(
            $db->table('properties_new')->select('city')
                ->where('city !=', '')
                ->groupBy('city')
                ->orderBy('city', 'ASC')
                ->get()
                ->getResultArray(),
            'city'
        );

        $types = array_column(
            $db->table('properties_new')->select('property_type')
                ->where('property_type !=', '')
                ->groupBy('property_type')
                ->orderBy('property_type', 'ASC')
                ->get()
                ->getResultArray(),
            'property_type'
        );

        $statuses = array_column(
            $db->table('properties_new')->select('status')
                ->groupBy('status')
                ->orderBy('status', 'ASC')
                ->get()
                ->getResultArray(),
            'status'
        );

        if (! in_array('flagged', $statuses, true)) {
            $statuses[] = 'flagged';
        }

        $filterOptions = [
            'cities'   => array_values(array_filter($cities)),
            'types'    => array_values(array_filter($types)),
            'statuses' => array_values(array_filter($statuses)),
        ];

        $data = [
            'page_title'        => 'Admin Properties',
            'active_page'       => 'admin-properties',
            'properties'        => $properties,
            'filters'           => $filters,
            'filterOptions'     => $filterOptions,
            'quickFilters'      => $quickFilters,
            'stats'             => $stats,
        ];

        return view('admin/properties', $data);
    }

    /**
     * Payments history page (static)
     */
    public function payments()
    {
        if ($response = $this->guardAdmin()) {
            return $response;
        }

        $db = Database::connect();

        $rawPayments = [];
        $totalVolume = 0.0;
        $statusCounts = [
            'total' => 0,
            'success' => 0,
            'pending' => 0,
            'failed' => 0,
        ];

        if ($db->tableExists('user_subscriptions')) {
            $paymentModel = new PaymentModel();

            try {
                $rawPayments = $paymentModel->getRecentPayments(6);
                $totalVolume = $paymentModel->getTotalVolume();
                $statusCounts = array_merge($statusCounts, $paymentModel->getStatusCounts());
            } catch (Throwable $exception) {
                log_message('error', 'Admin payments dashboard failed to read user_subscriptions: {message}', [
                    'message' => $exception->getMessage(),
                ]);
            }
        } else {
            log_message('warning', 'Admin payments dashboard fallback: user_subscriptions table is missing.');
        }

        $subscriptionAlert = session()->getFlashdata('subscriptionAlert');

        $subscriptions = [];
        if ($db->tableExists('subscriptions')) {
            $subscriptionModel = new SubscriptionModel();

            try {
                $subscriptions = $subscriptionModel
                    ->orderBy('duration_days', 'DESC')
                    ->orderBy('price', 'DESC')
                    ->findAll();
            } catch (Throwable $exception) {
                log_message('error', 'Admin payments dashboard failed to read subscriptions: {message}', [
                    'message' => $exception->getMessage(),
                ]);
            }
        } else {
            log_message('warning', 'Admin payments dashboard fallback: subscriptions table is missing.');
        }

        $successfulPayouts = $statusCounts['success'] ?? 0;
        $pendingInvoices = $statusCounts['pending'] ?? 0;
        $failedAttempts = $statusCounts['failed'] ?? 0;
        $settlementTotal = max(1, $statusCounts['total'] ?? 0);

        $settlementStatuses = [
            'Cleared' => [
                'value' => round(($successfulPayouts / $settlementTotal) * 100, 1),
                'variant' => 'bg-success',
            ],
            'Processing' => [
                'value' => round(($pendingInvoices / $settlementTotal) * 100, 1),
                'variant' => 'bg-warning',
            ],
            'On Hold' => [
                'value' => round(($failedAttempts / $settlementTotal) * 100, 1),
                'variant' => 'bg-danger',
            ],
        ];

        $recentPayments = [];
        foreach ($rawPayments as $entry) {
            $fullName = trim($entry['full_name'] ?? '') ?: 'Unknown user';
            $statusText = 'Pending';
            $statusVariant = 'bg-warning text-dark';
            $actionLabel = 'Approve';

            if ((int) $entry['active'] === 1) {
                $statusText = 'Success';
                $statusVariant = 'bg-success-light text-success';
                $actionLabel = 'Refund';
            } elseif (empty($entry['starts_at'])) {
                $statusText = 'Failed';
                $statusVariant = 'bg-danger-light text-danger';
                $actionLabel = 'Retry';
            }

            $recentPayments[] = [
                'txn_id' => sprintf('SUB%05d', $entry['id']),
                'user_label' => sprintf('%s (%s)', $fullName, $entry['user_id'] ?? '—'),
                'type' => $entry['plan_name'] ?: 'Subscription',
                'amount' => (float) ($entry['price'] ?? 0),
                'status_text' => $statusText,
                'status_variant' => $statusVariant,
                'date' => $entry['created_at'],
                'action_label' => $actionLabel,
            ];
        }

        $timelineEntries = [];
        $activityLog = [];
        $teamMembers = ['Neha', 'Rahul', 'Aman', 'Maya', 'Kavya'];
        foreach (array_slice($recentPayments, 0, 3) as $index => $entry) {
            $timelineEntries[] = [
                'title' => sprintf('%s payment %s', $entry['type'], strtolower($entry['status_text'])),
                'meta' => date('M d - h:i A', strtotime($entry['date'] ?? 'now')),
                'amount' => $entry['amount'],
            ];

            if ($entry['status_text'] === 'Success') {
                $iconColor = 'text-success';
            } elseif ($entry['status_text'] === 'Failed') {
                $iconColor = 'text-danger';
            } else {
                $iconColor = 'text-warning';
            }

            $activityLog[] = [
                'team_member' => $teamMembers[$index % count($teamMembers)],
                'action' => $entry['status_text'] === 'Success'
                    ? 'Recorded settlement'
                    : ($entry['status_text'] === 'Failed' ? 'Flagged failed attempt' : 'Pending review'),
                'reference' => sprintf('%s %s', $entry['txn_id'], $entry['user_label']),
                'time' => date('h:i A', strtotime($entry['date'] ?? 'now')),
                'icon_class' => $iconColor,
            ];
        }

        $data = [
            'page_title' => 'Admin Payments',
            'active_page' => 'admin-payments',
            'totalVolume' => $totalVolume,
            'successfulPayouts' => $successfulPayouts,
            'pendingInvoices' => $pendingInvoices,
            'failedAttempts' => $failedAttempts,
            'settlementStatuses' => $settlementStatuses,
            'recentPayments' => $recentPayments,
            'timelineEntries' => $timelineEntries,
            'activityLog' => $activityLog,
            'subscriptions' => $subscriptions,
            'subscriptionAlert' => $subscriptionAlert,
        ];

        return view('admin/payments', $data);
    }

    /**
     * Referral intelligence dashboard.
     */
    public function referrals()
    {
        if ($response = $this->guardAdmin()) {
            return $response;
        }

        $db = Database::connect();
        $referralCodeModel = new ReferralCodeModel();
        $usageModel = new ReferralCodeUsageModel();

        $ownerCount = $referralCodeModel->countAllResults();
        $usageCount = $usageModel->countAllResults();

        $totalPaidRow = $db->table('referral_code_usages')
            ->select('COALESCE(SUM(paid_amount), 0) AS total_paid', false)
            ->get()
            ->getRowArray();

        $summary = [
            'owners' => $ownerCount,
            'usages' => $usageCount,
            'total_paid' => (float) ($totalPaidRow['total_paid'] ?? 0),
        ];

        $referrerStats = $db->table('referral_codes rc')
            ->select(
                "rc.referral_code_id, rc.code, u.user_id AS referrer_user_id, u.full_name AS referrer_name, u.email AS referrer_email, u.phone_number AS referrer_phone, COUNT(rcu.id) AS usage_count, COALESCE(SUM(rcu.paid_amount), 0) AS total_paid, MAX(rcu.created_at) AS last_used_at",
                false
            )
            ->join('users u', 'u.user_id = rc.user_id', 'left')
            ->join('referral_code_usages rcu', 'rcu.referral_code_id = rc.referral_code_id', 'left')
            ->groupBy('rc.referral_code_id, rc.code, u.user_id, u.full_name, u.email, u.phone_number')
            ->orderBy('usage_count', 'DESC')
            ->limit(25)
            ->get()
            ->getResultArray();

        $usageLog = (new ReferralCodeUsageModel())
            ->select(
                'referral_code_usages.*, rc.code AS referral_code, ref.full_name AS referrer_name, ref.email AS referrer_email, usr.full_name AS used_name, usr.email AS used_email',
                false
            )
            ->join('referral_codes rc', 'rc.referral_code_id = referral_code_usages.referral_code_id', 'left')
            ->join('users ref', 'ref.user_id = referral_code_usages.referrer_user_id', 'left')
            ->join('users usr', 'usr.user_id = referral_code_usages.used_by_user_id', 'left')
            ->orderBy('referral_code_usages.created_at', 'DESC')
            ->limit(50)
            ->findAll();

        $topConnectors = array_slice($referrerStats, 0, 3);

        $data = [
            'page_title' => 'Referral Insights',
            'active_page' => 'admin-referrals',
            'summary' => $summary,
            'referrerStats' => $referrerStats,
            'usageLog' => $usageLog,
            'topReferrer' => $referrerStats[0] ?? null,
            'topConnectors' => $topConnectors,
        ];

        return view('admin/referrals', $data);
    }

    public function serviceEnquiries()
    {
        if ($response = $this->guardAdmin()) {
            return $response;
        }

        $model = new ServiceEnquiryModel();
        $recentEnquiries = $model->orderBy('created_at', 'DESC')->findAll(50);
        $db = Database::connect();

        $summary = [
            'total' => $model->countAllResults(),
            'last24h' => $db->table('service_enquiries')->where('created_at >=', date('Y-m-d H:i:s', strtotime('-24 hours')))->countAllResults(),
            'last7d' => $db->table('service_enquiries')->where('created_at >=', date('Y-m-d H:i:s', strtotime('-7 days')))->countAllResults(),
        ];

        $popularServices = $db->table('service_enquiries')
            ->select('service_title, COUNT(*) AS enquiry_count', false)
            ->groupBy('service_title')
            ->orderBy('enquiry_count', 'DESC')
            ->limit(5)
            ->get()
            ->getResultArray();

        $data = [
            'page_title' => 'Service Enquiries',
            'active_page' => 'admin-service-enquiries',
            'recentEnquiries' => $recentEnquiries ?: [],
            'summary' => $summary,
            'popularServices' => $popularServices,
        ];

        return view('admin/service_enquiries', $data);
    }

    public function createSubscription()
    {
        if ($response = $this->guardAdmin()) {
            return $response;
        }

        if (! $this->request->is('post')) {
            return redirect()->to(site_url('admin/payments'));
        }

        $isAjax = $this->request->isAJAX();

        $input = [
            'name' => trim((string) $this->request->getPost('name')),
            'price' => $this->request->getPost('price'),
            'duration_days' => $this->request->getPost('duration_days'),
            'description' => trim((string) $this->request->getPost('description')),
        ];

        $rules = [
            'name' => 'required|max_length[191]',
            'price' => 'required|numeric|greater_than_equal_to[0]',
            'duration_days' => 'required|integer|greater_than_equal_to[1]',
        ];

        if (! $this->validate($rules)) {
            $validationPayload = [
                'status' => 'error',
                'message' => 'Please fix the highlighted fields.',
                'errors' => $this->validator->getErrors(),
                'csrfHash' => csrf_hash(),
            ];

            if ($isAjax) {
                return $this->response->setStatusCode(422)->setJSON($validationPayload);
            }

            session()->setFlashdata('subscriptionAlert', ['type' => 'danger', 'message' => 'Please fix the highlighted fields.']);
            return redirect()->to(site_url('admin/payments'))->withInput();
        }

        $subscriptionModel = new SubscriptionModel();
        $subscriptionModel->insert([
            'name' => $input['name'],
            'price' => (int) round((float) $input['price']),
            'duration_days' => (int) $input['duration_days'],
            'description' => $input['description'] ?: null,
        ]);

        $successPayload = [
            'status' => 'success',
            'message' => 'Subscription plan saved.',
            'csrfHash' => csrf_hash(),
        ];

        if ($isAjax) {
            return $this->response->setJSON($successPayload);
        }

        session()->setFlashdata('subscriptionAlert', ['type' => 'success', 'message' => 'Subscription plan saved.']);
        return redirect()->to(site_url('admin/payments'));
    }

    public function deleteSubscription($id = null)
    {
        if ($response = $this->guardAdmin()) {
            if ($this->request->isAJAX()) {
                return $this->response->setStatusCode(403)->setJSON([
                    'error' => 'Not authorized',
                    'csrfHash' => csrf_hash(),
                ]);
            }

            return $response;
        }

        if (! $this->request->isAJAX()) {
            return $this->response->setStatusCode(400)->setJSON([
                'error' => 'Invalid request',
                'csrfHash' => csrf_hash(),
            ]);
        }

        $subscriptionModel = new SubscriptionModel();
        $subscription = $subscriptionModel->find($id);

        if (! $subscription) {
            return $this->response->setStatusCode(404)->setJSON([
                'error' => 'Subscription not found',
                'csrfHash' => csrf_hash(),
            ]);
        }

        $subscriptionModel->delete($id);

        return $this->response->setJSON([
            'message' => 'Subscription removed',
            'csrfHash' => csrf_hash(),
        ]);
    }
}