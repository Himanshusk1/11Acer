<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateUserOtpsTable extends Migration
{
    public function up()
    {
        //
        $this->forge->addField([
            'otp_id' => [
                'type'           => 'INT',
                'constraint'     => 11,
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'user_id' => [
                'type'       => 'INT',
                'constraint' => 11,
                'unsigned'   => true,
            ],
            'otp_code' => [
                'type'       => 'VARCHAR',
                'constraint' => 6, // 6 digit OTP
            ],
            'expires_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
            'created_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
        ]);

        $this->forge->addKey('otp_id', true); // Primary Key
        $this->forge->addForeignKey('user_id', 'users', 'user_id', 'CASCADE', 'CASCADE');
        $this->forge->createTable('user_otps');
    }

    public function down()
    {
        //
        $this->forge->dropTable('user_otps');
    }
}
