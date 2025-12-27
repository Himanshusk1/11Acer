<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateReferralCodeUsagesTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => ['type' => 'INT', 'constraint' => 11, 'unsigned' => true, 'auto_increment' => true],
            'referral_code_id' => ['type' => 'INT', 'constraint' => 11, 'unsigned' => true, 'null' => false],
            'referrer_user_id' => ['type' => 'INT', 'constraint' => 11, 'unsigned' => true, 'null' => false],
            'used_by_user_id' => ['type' => 'INT', 'constraint' => 11, 'unsigned' => true, 'null' => false],
            'used_for_subscription_id' => ['type' => 'INT', 'constraint' => 11, 'unsigned' => true, 'null' => true],
            'discount_type' => ['type' => 'ENUM', 'constraint' => ['percentage', 'fixed'], 'default' => 'percentage'],
            'discount_value' => ['type' => 'DECIMAL', 'constraint' => '10,2', 'default' => 0],
            'discount_amount' => ['type' => 'DECIMAL', 'constraint' => '10,2', 'default' => 0],
            'paid_amount' => ['type' => 'DECIMAL', 'constraint' => '10,2', 'default' => 0],
            'payment_method' => ['type' => 'VARCHAR', 'constraint' => 100, 'null' => true],
            'payment_status' => ['type' => 'VARCHAR', 'constraint' => 50, 'default' => 'pending'],
            'created_at' => ['type' => 'DATETIME', 'null' => true],
            'updated_at' => ['type' => 'DATETIME', 'null' => true],
        ]);

        $this->forge->addKey('id', true);
        $this->forge->addKey('referral_code_id');
        $this->forge->addKey('used_by_user_id');
        $this->forge->addKey('used_for_subscription_id');

        $this->forge->addForeignKey('referral_code_id', 'referral_codes', 'id', 'CASCADE', 'CASCADE');
        $this->forge->addForeignKey('referrer_user_id', 'users', 'user_id', 'CASCADE', 'CASCADE');
        $this->forge->addForeignKey('used_by_user_id', 'users', 'user_id', 'CASCADE', 'CASCADE');
        $this->forge->addForeignKey('used_for_subscription_id', 'user_subscriptions', 'id', 'SET NULL', 'CASCADE');

        $this->forge->createTable('referral_code_usages');
    }

    public function down()
    {
        $this->forge->dropTable('referral_code_usages');
    }
}
