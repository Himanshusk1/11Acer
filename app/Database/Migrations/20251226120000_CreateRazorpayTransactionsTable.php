<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateRazorpayTransactionsTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => ['type' => 'INT', 'constraint' => 11, 'unsigned' => true, 'auto_increment' => true],
            'user_id' => ['type' => 'INT', 'constraint' => 11, 'unsigned' => true],
            'subscription_id' => ['type' => 'INT', 'constraint' => 11, 'unsigned' => true],
            'referral_code' => ['type' => 'VARCHAR', 'constraint' => 64, 'null' => true],
            'order_id' => ['type' => 'VARCHAR', 'constraint' => 128, 'null' => true],
            'amount' => ['type' => 'BIGINT', 'constraint' => 20, 'unsigned' => true, 'default' => 0],
            'currency' => ['type' => 'VARCHAR', 'constraint' => 8, 'default' => 'INR'],
            'status' => ['type' => 'VARCHAR', 'constraint' => 64, 'default' => 'created'],
            'payment_capture' => ['type' => 'TINYINT', 'constraint' => 1, 'default' => 0],
            'receipt' => ['type' => 'VARCHAR', 'constraint' => 128, 'null' => true],
            'discount_applied' => ['type' => 'TINYINT', 'constraint' => 1, 'default' => 0],
            'discount_amount' => ['type' => 'DECIMAL', 'constraint' => '10,2', 'default' => 0],
            'final_price' => ['type' => 'DECIMAL', 'constraint' => '10,2', 'default' => 0],
            'notes' => ['type' => 'TEXT', 'null' => true],
            'order_payload' => ['type' => 'LONGTEXT', 'null' => true],
            'created_at DATETIME DEFAULT CURRENT_TIMESTAMP',
            'updated_at DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP',
        ]);

        $this->forge->addKey('id', true);
        $this->forge->addForeignKey('user_id', 'users', 'user_id', 'CASCADE', 'CASCADE');
        $this->forge->addForeignKey('subscription_id', 'subscriptions', 'id', 'CASCADE', 'CASCADE');
        $this->forge->createTable('razorpay_transactions');
    }

    public function down()
    {
        $this->forge->dropTable('razorpay_transactions');
    }
}
