<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\ConnectionInterface;
use CodeIgniter\Database\Migration;

class DropPasswordFromUsers extends Migration
{
    public function up()
    {
        $db = \Config\Database::connect();
        $forge = $this->forge;

        if (! $db->fieldExists('public_id', 'users')) {
            $forge->addColumn('users', [
                'public_id' => [
                    'type'       => 'VARCHAR',
                    'constraint' => 32,
                    'null'       => true,
                ],
            ]);
        }

        $this->populateExistingPublicIds($db);

        try {
            $db->query('ALTER TABLE users ADD UNIQUE INDEX users_public_id_unique (public_id)');
        } catch (\Throwable $e) {
            // Index may already exist.
        }

        $forge->modifyColumn('users', [
            'public_id' => [
                'name'       => 'public_id',
                'type'       => 'VARCHAR',
                'constraint' => 32,
                'null'       => false,
            ],
        ]);

        if ($db->fieldExists('password_hash', 'users')) {
            $forge->dropColumn('users', 'password_hash');
        }
    }

    public function down()
    {
        $db = \Config\Database::connect();
        $forge = $this->forge;

        if (! $db->fieldExists('password_hash', 'users')) {
            $forge->addColumn('users', [
                'password_hash' => [
                    'type'       => 'VARCHAR',
                    'constraint' => 255,
                    'null'       => true,
                ],
            ]);
        }

        try {
            $db->query('ALTER TABLE users DROP INDEX users_public_id_unique');
        } catch (\Throwable $e) {
            // Safe to ignore if the index does not exist.
        }

        if ($db->fieldExists('public_id', 'users')) {
            $forge->dropColumn('users', 'public_id');
        }
    }

    private function populateExistingPublicIds(ConnectionInterface $db): void
    {
        $builder = $db->table('users')->select('user_id, role, public_id')->orderBy('user_id', 'ASC');
        $rows = $builder->get()->getResultArray();
        $counters = [];

        foreach ($rows as $row) {
            if (! empty($row['public_id'])) {
                [$prefix, $number] = $this->splitPublicId($row['public_id']);
                $counters[$prefix] = max($counters[$prefix] ?? 0, (int) $number);
                continue;
            }

            $prefix = $this->mapRoleToPrefix($row['role'] ?? '');
            $counters[$prefix] = ($counters[$prefix] ?? 0) + 1;
            $publicId = sprintf('%s-%04d', $prefix, $counters[$prefix]);

            $db->table('users')
                ->where('user_id', $row['user_id'])
                ->update(['public_id' => $publicId]);
        }
    }

    private function splitPublicId(string $publicId): array
    {
        $parts = explode('-', $publicId, 2);
        return [strtoupper($parts[0] ?? 'US'), $parts[1] ?? '0'];
    }

    private function mapRoleToPrefix(string $role): string
    {
        static $map = [
            'agent'      => 'AG',
            'owner'      => 'OW',
            'individual' => 'IN',
        ];

        $normalized = strtolower(trim($role));
        return $map[$normalized] ?? 'US';
    }
}