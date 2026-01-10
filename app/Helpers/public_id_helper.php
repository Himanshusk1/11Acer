<?php

if (! function_exists('generate_public_id')) {
    function generate_public_id(string $role): string
    {
        $prefixMap = [
            'agent'      => 'AG',
            'owner'      => 'OW',
            'individual' => 'IN',
            'service'    => 'SV',
        ];

        $normalized = strtolower(trim($role ?? ''));
        $prefix = $prefixMap[$normalized] ?? 'US';

        $db = \Config\Database::connect();
        $builder = $db->table('users');

        $row = $builder
            ->select('MAX(CAST(SUBSTRING_INDEX(public_id, "-", -1) AS UNSIGNED)) AS max_seq')
            ->like('public_id', $prefix . '-', 'after')
            ->get()
            ->getRowArray();

        $next = (int) ($row['max_seq'] ?? 0) + 1;
        $sequence = str_pad($next, 4, '0', STR_PAD_LEFT);

        return $prefix . '-' . $sequence;
    }
}
