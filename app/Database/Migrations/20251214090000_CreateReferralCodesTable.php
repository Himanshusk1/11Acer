<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;
use Config\Database;

class CreateReferralCodesTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'referral_code_id' => [
                'type'           => 'INT',
                'constraint'     => 11,
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'user_id' => [
                'type'       => 'INT',
                'constraint' => 11,
                'unsigned'   => true,
                'null'       => false,
            ],
            'code' => [
                'type'       => 'VARCHAR',
                'constraint' => 64,
                'unique'     => true,
            ],
            'created_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
            'updated_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
        ]);

        $this->forge->addKey('referral_code_id', true);
        $this->forge->addForeignKey('user_id', 'users', 'user_id', 'CASCADE', 'CASCADE');
        $this->forge->addUniqueKey('user_id');
        $this->forge->createTable('referral_codes');

        $this->seedReferralCodes();
    }

    public function down()
    {
        $this->forge->dropTable('referral_codes');
    }

    private function seedReferralCodes(): void
    {
        helper('referral_code');

        $db = Database::connect();
        $rows = $db->table('users')
            ->select('user_id, public_id')
            ->where('public_id !=', '')
            ->get()
            ->getResultArray();

        foreach ($rows as $row) {
            $publicId = trim((string) ($row['public_id'] ?? ''));
            if ($publicId === '') {
                continue;
            }

            try {
                ensure_referral_code_for_user((int) $row['user_id'], $publicId);
            } catch (\Throwable $e) {
                log_message('error', 'Referral code seeding failed for user ' . ($row['user_id'] ?? 'unknown') . ': ' . $e->getMessage());
            }
        }
    }
}
