<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreatePropertyTypesTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'property_type_id' => ['type' => 'INT', 'constraint' => 11, 'unsigned' => true, 'auto_increment' => true],
            'name'             => ['type' => 'VARCHAR', 'constraint' => 100, 'unique' => true],
            'category'         => ['type' => 'ENUM("residential","commercial")'],
        ]);
        $this->forge->addKey('property_type_id', true);
        $this->forge->createTable('propertytypes');
    }

    public function down()
    {
        $this->forge->dropTable('propertytypes');
    }
}
