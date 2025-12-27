<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class SubscriptionSeeder extends Seeder
{
    public function run()
    {
        $data = [
            [
                'name' => 'Basic Monthly',
                'price' => 199,
                'duration_days' => 30,
                'description' => 'Post properties for 30 days.'
            ],
            [
                'name' => 'Annual',
                'price' => 2000,
                'duration_days' => 365,
                'description' => 'Full year subscription.'
            ],
            [
                'name' => 'Premium Monthly',
                'price' => 499,
                'duration_days' => 30,
                'description' => 'Featured listing for 30 days.'
            ]
        ];

        foreach ($data as $row) {
            $this->db->table('subscriptions')->insert($row);
        }
    }
}
