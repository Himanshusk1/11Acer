<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateUsersTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'user_id'       => [
                'type'           => 'INT',
                'constraint'     => 11,
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'public_id'     => [
                'type'       => 'VARCHAR',
                'constraint' => 32,
                'unique'     => true,
            ],
            'full_name'     => [
                'type'       => 'VARCHAR',
                'constraint' => 255,
            ],
            'email'         => [
                'type'       => 'VARCHAR',
                'constraint' => 191,   // ✅ reduced for utf8mb4 + unique index
                'null'       => true,
                'unique'     => true,
            ],
            'phone_number'  => [
                'type'       => 'VARCHAR',
                'constraint' => 20,    // safe
                'unique'     => true,
            ],
            'city'          => [
                'type'       => 'VARCHAR',
                'constraint' => 100,
            ],
            'role'          => [
                'type'    => 'ENUM("individual","agent","builder","buyer","admin")',
                'default' => 'buyer',
            ],
            'created_at'    => [
                'type' => 'DATETIME',
                'null' => true,
            ],
            'updated_at'    => [
                'type' => 'DATETIME',
                'null' => true,
            ],
        ]);

        $this->forge->addKey('user_id', true); // primary key
        $this->forge->createTable('users');
    }

    public function down()
    {
        $this->forge->dropTable('users');
    }
}
