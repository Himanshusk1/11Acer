<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreatePropertyPricingTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'property_id' => [
                'type'       => 'INT',
                'constraint' => 11,
                'unsigned'   => true,
            ],
            'price' => [
                'type'       => 'DECIMAL',
                'constraint' => '12,2',
            ],
            'maintenance' => [
                'type'       => 'DECIMAL',
                'constraint' => '12,2',
                'null'       => true,
            ],
            'available_from' => [
                'type' => 'DATE',
                'null' => true,
            ],
            'negotiable' => [
                'type'       => 'BOOLEAN',
                'default'    => false,
            ],
            'created_at DATETIME DEFAULT CURRENT_TIMESTAMP',
            'updated_at DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP',
        ]);

        $this->forge->addKey('property_id', true);
        $this->forge->addForeignKey('property_id', 'properties', 'id', 'CASCADE', 'CASCADE');
        $this->forge->createTable('property_pricing');
    }

    public function down()
    {
        $this->forge->dropTable('property_pricing');
    }
}
