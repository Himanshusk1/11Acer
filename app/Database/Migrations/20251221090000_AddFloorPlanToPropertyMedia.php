<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddFloorPlanToPropertyMedia extends Migration
{
    public function up()
    {
        $this->forge->modifyColumn('property_media', [
            'file_type' => [
                'name'    => 'file_type',
                'type'    => "ENUM('image','video','floor_plan')",
                'null'    => false,
                'default' => 'image',
            ],
        ]);
    }

    public function down()
    {
        $this->forge->modifyColumn('property_media', [
            'file_type' => [
                'name'    => 'file_type',
                'type'    => "ENUM('image','video')",
                'null'    => false,
                'default' => 'image',
            ],
        ]);
    }
}
