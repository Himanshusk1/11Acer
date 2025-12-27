<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class ConstrainUsersRoleEnum extends Migration
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
        ];

        $this->forge->modifyColumn('users', $fields);
    }

    public function down()
    {
        $fields = [
            'role' => [
                'name'       => 'role',
                'type'       => "ENUM('individual','agent','builder','buyer','owner','broker','admin')",
                'null'       => true,
                'default'    => null,
            ],
        ];

        $this->forge->modifyColumn('users', $fields);
    }
}
