<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\RedirectResponse;
use Config\Database;

class AdminSettingsController extends BaseController
{
    protected $helpers = ['url'];

    /**
     * Prevent non-admin access and redirect users to their respective dashboard.
     */
    protected function guardAdmin(): ?RedirectResponse
    {
        if (session()->get('role') === 'admin') {
            return null;
        }

        $redirect = role_dashboard_path(session()->get('role'));
        return redirect()->to($redirect)->with('error', 'You are not authorized to open the admin settings page.');
    }

    /**
     * Display the settings console.
     */
    public function index()
    {
        if ($response = $this->guardAdmin()) {
            return $response;
        }

        $session = session();

        $defaultAvatar = base_url('images/36_profile.png');

        $profileDefaults = [
            'name'  => $session->get('full_name') ?: 'Admin User',
            'email' => $session->get('email') ?: 'admin@example.com',
            'phone' => $session->get('phone_number') ?: '+91 00000 00000',
            'photo' => $session->get('admin_profile_photo') ?: $defaultAvatar,
        ];
        $existingProfile = $session->get('admin_profile_settings') ?? [];
        $profileSettings = array_merge($profileDefaults, $existingProfile);

        $appDefaults = [
            'dark_mode'           => false,
            'email_notifications' => true,
            'maintenance_mode'    => false,
        ];
        $existingAppSettings = $session->get('admin_app_settings') ?? [];
        $appSettings = array_merge($appDefaults, $existingAppSettings);

        $security = [
            'last_login' => $session->get('last_login_at') ?: date('d M Y, h:i A'),
            'ip_address' => $session->get('last_ip') ?: $this->request->getIPAddress(),
        ];

        $systemInfo = [
            'appVersion'   => defined('APP_VERSION') ? APP_VERSION : '1.0.0',
            'phpVersion'   => PHP_VERSION,
            'mysqlStatus'  => $this->getDatabaseStatus(),
            'storageUsage' => $this->getStorageUsage(),
        ];

        $data = [
            'page_title'      => 'Admin Settings',
            'active_page'     => 'settings',
            'profileSettings' => $profileSettings,
            'appSettings'     => $appSettings,
            'security'        => $security,
            'systemInfo'      => $systemInfo,
            'userRole'        => 'Platform Admin',
        ];

        return view('admin/settings', $data);
    }

    /**
     * Persist profile form submissions.
     */
    public function updateProfile()
    {
        if ($response = $this->guardAdmin()) {
            return $response;
        }

        if (! $this->request->is('post')) {
            return redirect()->to(site_url('/admin/settings'));
        }

        $rules = [
            'name'          => 'required|min_length[3]|max_length[100]',
            'email'         => 'required|valid_email|max_length[150]',
            'phone'         => 'required|min_length[8]|max_length[20]',
            'profile_photo' => 'permit_empty|is_image[profile_photo]|mime_in[profile_photo,image/jpg,image/jpeg,image/png]|max_size[profile_photo,2048]',
        ];

        if (! $this->validate($rules)) {
            return redirect()->back()->withInput()->with('settings_errors', $this->validator->getErrors());
        }

        $existingProfile = session('admin_profile_settings') ?? [];

        $defaultAvatar = base_url('images/36_profile.png');

        $profileData = [
            'name'  => $this->request->getPost('name'),
            'email' => $this->request->getPost('email'),
            'phone' => $this->request->getPost('phone'),
            'photo' => $existingProfile['photo'] ?? session('admin_profile_photo') ?? $defaultAvatar,
        ];

        $photo = $this->request->getFile('profile_photo');
        if ($photo && $photo->isValid() && ! $photo->hasMoved()) {
            $uploadDir = FCPATH . 'uploads/profile';
            if (! is_dir($uploadDir)) {
                mkdir($uploadDir, 0755, true);
            }

            $newName = uniqid('admin_', true) . '.' . $photo->getExtension();
            if ($photo->move($uploadDir, $newName, true)) {
                $publicPath = base_url('uploads/profile/' . $newName);
                $profileData['photo'] = $publicPath;
                session()->set('admin_profile_photo', $publicPath);
            } else {
                return redirect()->back()->withInput()->with('settings_errors', [
                    'profile_photo' => 'Unable to upload the profile photo. Please try again.',
                ]);
            }
        }

        session()->set('admin_profile_settings', $profileData);
        session()->setFlashdata('settings_success', 'Profile settings saved successfully.');

        return redirect()->to(site_url('/admin/settings'));
    }

    /**
     * Persist application toggles.
     */
    public function updateAppSettings()
    {
        if ($response = $this->guardAdmin()) {
            return $response;
        }

        if (! $this->request->is('post')) {
            return redirect()->to(site_url('/admin/settings'));
        }

        $appSettings = [
            'dark_mode'           => (bool) $this->request->getPost('dark_mode'),
            'email_notifications' => (bool) $this->request->getPost('email_notifications'),
            'maintenance_mode'    => (bool) $this->request->getPost('maintenance_mode'),
        ];

        session()->set('admin_app_settings', $appSettings);
        session()->set('adminThemePreference', $appSettings['dark_mode'] ? 'dark' : 'light');
        session()->setFlashdata('settings_success', 'Application settings updated.');

        return redirect()->to(site_url('/admin/settings'));
    }

    /**
     * Check database connectivity for status badge.
     */
    protected function getDatabaseStatus(): array
    {
        try {
            $db = Database::connect();
            $db->simpleQuery('SELECT 1');
            return ['ok' => true, 'message' => 'Connected'];
        } catch (\Throwable $e) {
            return ['ok' => false, 'message' => $e->getMessage()];
        }
    }

    /**
     * Calculate upload storage usage relative to a soft limit.
     */
    protected function getStorageUsage(): array
    {
        $storagePath = WRITEPATH . 'uploads';
        $limitBytes = 1024 * 1024 * 1024; // 1 GB soft limit
        $usedBytes = $this->folderSize($storagePath);
        $percent = $limitBytes > 0 ? min(100, round(($usedBytes / $limitBytes) * 100, 2)) : 0;

        return [
            'used'    => $usedBytes,
            'limit'   => $limitBytes,
            'percent' => $percent,
        ];
    }

    /**
     * Recursively evaluate folder size.
     */
    protected function folderSize(string $path): int
    {
        if (! is_dir($path)) {
            return 0;
        }

        $size = 0;
        $iterator = new \RecursiveIteratorIterator(
            new \RecursiveDirectoryIterator($path, \FilesystemIterator::SKIP_DOTS)
        );

        foreach ($iterator as $file) {
            $size += $file->getSize();
        }

        return $size;
    }
}
