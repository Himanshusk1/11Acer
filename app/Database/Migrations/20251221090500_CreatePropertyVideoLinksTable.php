<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreatePropertyVideoLinksTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type'           => 'INT',
                'constraint'     => 11,
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'property_id' => [
                'type'       => 'INT',
                'constraint' => 11,
                'unsigned'   => true,
            ],
            'url' => [
                'type'       => 'VARCHAR',
                'constraint' => 2048,
            ],
            'created_at DATETIME DEFAULT CURRENT_TIMESTAMP',
        ]);

        $this->forge->addKey('id', true);
        $this->forge->addForeignKey('property_id', 'properties', 'id', 'CASCADE', 'CASCADE');
        $this->forge->createTable('property_video_links');
    }

    public function down()
    {
        $this->forge->dropTable('property_video_links');
    }
}
