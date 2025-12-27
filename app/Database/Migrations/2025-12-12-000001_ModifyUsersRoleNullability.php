<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class ModifyUsersRoleNullability extends Migration
{
    public function up()
    {
        $fields = [
            'role' => [
                'name'       => 'role',
                'type'       => "ENUM('individual','agent','builder','buyer','admin')",
                'null'       => true,
                'default'    => null,
            ],
            'public_id' => [
                'name'       => 'public_id',
                'type'       => 'VARCHAR',
                'constraint' => 32,
                'null'       => true,
            ],
        ];

        $this->forge->modifyColumn('users', $fields);
    }

    public function down()
    {
        $fields = [
            'role' => [
                'name'       => 'role',
                'type'       => "ENUM('individual','agent','builder','buyer','admin')",
                'null'       => false,
                'default'    => 'buyer',
            ],
            'public_id' => [
                'name'       => 'public_id',
                'type'       => 'VARCHAR',
                'constraint' => 32,
                'null'       => false,
            ],
        ];

        $this->forge->modifyColumn('users', $fields);
    }
}
