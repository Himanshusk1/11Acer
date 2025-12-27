<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddPropertyNameToProperties extends Migration
{
    public function up()
    {
        // Add a nullable property_name column to the existing properties_new table
        $fields = [
            'property_name' => [
                'type'       => 'VARCHAR',
                'constraint' => 255,
                'null'       => true,
                'default'    => null,
            ],
        ];

        $this->forge->addColumn('properties_new', $fields);
    }

    public function down()
    {
        // Remove the column on rollback
        $this->forge->dropColumn('properties_new', 'property_name');
    }
}
