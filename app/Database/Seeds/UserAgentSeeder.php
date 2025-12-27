<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class UserAgentSeeder extends Seeder
{
    public function run()
    {
        $now = date('Y-m-d H:i:s');

        $data = [
            [
                'full_name'     => 'Rajnish Gupta',
                'email'         => 'rajnish.gupta@example.com',
                'phone_number'  => '9001002000',
                'public_id'     => 'AG-0002',
                'city'          => 'Mumbai',
                'role'          => 'agent',
                'created_at'    => $now,
                'updated_at'    => $now,
            ],
            [
                'full_name'     => 'Neha Kaur',
                'email'         => 'neha.kaur@example.com',
                'phone_number'  => '9001002001',
                'public_id'     => 'AG-0003',
                'city'          => 'Delhi',
                'role'          => 'agent',
                'created_at'    => $now,
                'updated_at'    => $now,
            ],
            [
                'full_name'     => 'Vikram Singh',
                'email'         => 'vikram.singh@example.com',
                'phone_number'  => '9001002002',
                'public_id'     => 'AG-0004',
                'city'          => 'Bengaluru',
                'role'          => 'agent',
                'created_at'    => $now,
                'updated_at'    => $now,
            ],
            [
                'full_name'     => 'Sonia Mehta',
                'email'         => 'sonia.mehta@example.com',
                'phone_number'  => '9001002003',
                'public_id'     => 'AG-0005',
                'city'          => 'Pune',
                'role'          => 'agent',
                'created_at'    => $now,
                'updated_at'    => $now,
            ],
            [
                'full_name'     => 'Arjun Patel',
                'email'         => 'arjun.patel@example.com',
                'phone_number'  => '9001002004',
                'public_id'     => 'AG-0006',
                'city'          => 'Ahmedabad',
                'role'          => 'agent',
                'created_at'    => $now,
                'updated_at'    => $now,
            ],
        ];

        // Insert into the existing users table (only the users table is used for agents)
        $this->db->table('users')->insertBatch($data);

        // Optional: print a message when running via CLI
        if (is_cli()) {
            echo "Inserted " . count($data) . " agent users into `users` table.\n";
        }
    }
}
