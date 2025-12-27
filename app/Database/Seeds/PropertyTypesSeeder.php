<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class PropertyTypesSeeder extends Seeder
{
    public function run()
    {
        $data = [
            ['name' => 'Apartment', 'category' => 'residential'],
            ['name' => 'Villa', 'category' => 'residential'],
            ['name' => 'Office Space', 'category' => 'commercial'],
            ['name' => 'Shop', 'category' => 'commercial'],
        ];

        $this->db->table('propertytypes')->insertBatch($data);
    }
}
