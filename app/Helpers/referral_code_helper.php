<?php

use App\Models\ReferralCodeModel;

if (! function_exists('generate_referral_code')) {
    function generate_referral_code(string $publicId = ''): string
    {
        $prefix = strtoupper(trim((string) $publicId));
        $prefix = preg_replace('/[^A-Z0-9]/', '', $prefix);
        if ($prefix !== '') {
            $prefix = substr($prefix, 0, 3) . '-';
        } else {
            $prefix = 'R-';
        }

        $pool = 'ABCDEFGHJKLMNPQRSTUVWXYZ23456789';
        $segments = [];
        for ($segment = 0; $segment < 3; $segment++) {
            $chunk = '';
            for ($i = 0; $i < 4; $i++) {
                $chunk .= $pool[random_int(0, strlen($pool) - 1)];
            }
            $segments[] = $chunk;
        }

        return $prefix . implode('-', $segments);
    }
}

if (! function_exists('ensure_referral_code_for_user')) {
    function ensure_referral_code_for_user(int $userId, string $publicId): string
    {
        $publicId = strtoupper(trim((string) $publicId));
        if ($publicId === '') {
            return '';
        }

        $model = new ReferralCodeModel();
        $existing = $model->where('user_id', $userId)->first();
        if (! empty($existing['code'])) {
            return $existing['code'];
        }

        $db = \Config\Database::connect();
        $builder = $db->table('referral_codes');
        $code = '';
        $maxAttempts = 6;

        // Retry if the randomly generated suffix already exists.
        for ($attempt = 0; $attempt < $maxAttempts; $attempt++) {
            $candidate = generate_referral_code($publicId);
            $exists = $builder->where('code', $candidate)->countAllResults();
            if ($exists === 0) {
                $code = $candidate;
                break;
            }
            $builder = $db->table('referral_codes');
        }

        if ($code === '') {
            throw new \RuntimeException('Unable to generate a unique referral code.');
        }

        $model->insert([
            'user_id' => $userId,
            'code'    => $code,
        ]);

        return $code;
    }
}
