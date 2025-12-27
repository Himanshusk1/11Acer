<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class UsersSeeder extends Seeder
{
    public function run()
    {
        $data = [
            [
                'full_name'     => 'Rohit Sharma',
                'email'         => 'rohit@example.com',
                'phone_number'  => '9876543210',
                'public_id'     => 'BY-0001',
                'city'          => 'Mumbai',
                'role'          => 'buyer',
                'created_at'    => date('Y-m-d H:i:s'),
                'updated_at'    => date('Y-m-d H:i:s'),
            ],
            [
                'full_name'     => 'Sumit',
                'email'         => 'simran@example.com',
                'phone_number'  => '9876543211',
                'public_id'     => 'AG-0001',
                'city'          => 'Delhi',
                'role'          => 'agent',
                'created_at'    => date('Y-m-d H:i:s'),
                'updated_at'    => date('Y-m-d H:i:s'),
            ],
            [
                'full_name'     => 'Aman Verma',
                'email'         => 'aman@example.com',
                'phone_number'  => '9876543212',
                'public_id'     => 'BU-0001',
                'city'          => 'Bengaluru',
                'role'          => 'builder',
                'created_at'    => date('Y-m-d H:i:s'),
                'updated_at'    => date('Y-m-d H:i:s'),
            ],
            [
                'full_name'     => 'Priya Singh',
                'email'         => 'priya@example.com',
                'phone_number'  => '9876543213',
                'public_id'     => 'IN-0001',
                'city'          => 'Pune',
                'role'          => 'individual',
                'created_at'    => date('Y-m-d H:i:s'),
                'updated_at'    => date('Y-m-d H:i:s'),
            ],
        ];

        foreach ($data as $row) {
            $exists = $this->db->table('users')
                ->where('phone_number', $row['phone_number'])
                ->orWhere('public_id', $row['public_id'])
                ->countAllResults();

            if ($exists > 0) {
                continue;
            }

            $this->db->table('users')->insert($row);
        }
    }
}
