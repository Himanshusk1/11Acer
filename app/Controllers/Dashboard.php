<?php

namespace App\Controllers;

use App\Models\ReferralCodeModel;
use App\Models\UserModel;

class Dashboard extends BaseController
{
    public function index()
    {
        $session = session();
        $role = $session->get('role');

        if ($role === 'admin') {
            return redirect()->to(role_dashboard_path($role));
        }

        $referralCodeModel = new ReferralCodeModel();
        $userId = (int) $session->get('user_id');
        $referralCode = null;

        if ($userId > 0) {
            $entry = $referralCodeModel->where('user_id', $userId)->first();
            $referralCode = $entry['code'] ?? null;

            if (empty($referralCode)) {
                helper('referral_code');
                $publicId = session()->get('public_id') ?: '';
                if ($publicId !== '') {
                    $referralCode = ensure_referral_code_for_user($userId, $publicId);
                }
            }
        }

        $dashboardPhoneDisplay = $this->getDashboardPhoneDisplay($userId, $session);

        $data = [
            'page_title'   => 'Dashboard',
            'active_page'  => 'dashboard',
            'user_data'    => session()->get('userData'),
            'referralCode' => $referralCode,
            'referralShareUrl' => $referralCode ? site_url('?ref=' . urlencode($referralCode)) : null,
            'dashboardPhoneDisplay' => $dashboardPhoneDisplay,
        ];

        return view('user/dashboard', $data);
    }

    private function getDashboardPhoneDisplay(int $userId, $session): ?string
    {
        $rawPhone = $session->get('phone_number') ?: $session->get('phone');

        if (empty($rawPhone) && $userId > 0) {
            $user = (new UserModel())->select('phone_number')->find($userId);
            $rawPhone = $user['phone_number'] ?? null;
        }

        return $this->formatIndianPhone($rawPhone);
    }

    private function formatIndianPhone(?string $phone): ?string
    {
        $clean = trim((string) $phone);
        if ($clean === '') {
            return null;
        }

        $digits = preg_replace('/\D+/', '', $clean);
        if ($digits === '') {
            return null;
        }

        $digits = ltrim($digits, '0');
        if ($digits === '') {
            return null;
        }

        if (substr($digits, 0, 2) !== '91') {
            $digits = '91' . $digits;
        }

        return '+' . $digits;
    }
}