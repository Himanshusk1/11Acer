<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateInvoicesTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => ['type' => 'INT', 'constraint' => 11, 'unsigned' => true, 'auto_increment' => true],
            'invoice_number' => ['type' => 'VARCHAR', 'constraint' => 64, 'unique' => true],
            'user_id' => ['type' => 'INT', 'constraint' => 11, 'unsigned' => true],
            'subscription_id' => ['type' => 'INT', 'constraint' => 11, 'unsigned' => true],
            'subscription_name' => ['type' => 'VARCHAR', 'constraint' => 255],
            'order_id' => ['type' => 'VARCHAR', 'constraint' => 128, 'null' => true],
            'customer_name' => ['type' => 'VARCHAR', 'constraint' => 255],
            'customer_gstin' => ['type' => 'VARCHAR', 'constraint' => 32, 'null' => true],
            'customer_email' => ['type' => 'VARCHAR', 'constraint' => 191, 'null' => true],
            'customer_phone' => ['type' => 'VARCHAR', 'constraint' => 20, 'null' => true],
            'customer_address' => ['type' => 'TEXT', 'null' => true],
            'amount_before_tax' => ['type' => 'DECIMAL', 'constraint' => '12,2', 'default' => 0],
            'tax_rate_percent' => ['type' => 'DECIMAL', 'constraint' => '5,2', 'default' => 18.00],
            'cgst_amount' => ['type' => 'DECIMAL', 'constraint' => '12,2', 'default' => 0],
            'sgst_amount' => ['type' => 'DECIMAL', 'constraint' => '12,2', 'default' => 0],
            'total_tax' => ['type' => 'DECIMAL', 'constraint' => '12,2', 'default' => 0],
            'grand_total' => ['type' => 'DECIMAL', 'constraint' => '12,2', 'default' => 0],
            'pdf_path' => ['type' => 'VARCHAR', 'constraint' => 255],
            'data' => ['type' => 'LONGTEXT', 'null' => true],
            'created_at DATETIME DEFAULT CURRENT_TIMESTAMP',
            'updated_at DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP',
        ]);

        $this->forge->addKey('id', true);
        $this->forge->addForeignKey('user_id', 'users', 'user_id', 'CASCADE', 'CASCADE');
        $this->forge->addForeignKey('subscription_id', 'subscriptions', 'id', 'CASCADE', 'CASCADE');
        $this->forge->createTable('invoices');
    }

    public function down()
    {
        $this->forge->dropTable('invoices');
    }
}
