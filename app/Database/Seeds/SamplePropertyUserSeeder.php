<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class SamplePropertyUserSeeder extends Seeder
{
    public function run()
    {
        $now = date('Y-m-d H:i:s');
        $userPhone = '9000000000';

        $userData = [
            'full_name'    => 'Dev Test Agent',
            'email'        => 'dev.agent@example.com',
            'phone_number' => $userPhone,
            'city'         => 'Hyderabad',
            'role'         => 'agent',
            'public_id'    => 'AG-TEST-001',
            'created_at'   => $now,
            'updated_at'   => $now,
        ];

        $userTable = $this->db->table('users');
        $existing = $userTable->where('phone_number', $userPhone)->get()->getRowArray();
        if ($existing) {
            $userId = (int) ($existing['user_id'] ?? $existing['id'] ?? 0);
        } else {
            $userTable->insert($userData);
            $userId = (int) $this->db->insertID();
        }

        if ($userId <= 0) {
            return;
        }

        $samples = [
            [
                'transaction_type' => 'sell',
                'property_category' => 'residential',
                'property_type' => 'apartment',
                'city' => 'Hyderabad',
                'locality' => 'Gachibowli',
                'property_name' => 'Skyline Residences 2BHK',
                'details' => [
                    'area_sqft' => 1450,
                    'availability' => 'ready_to_move',
                    'ownership' => 'freehold',
                    'amenities' => ['parking', 'lift', 'power_backup'],
                    'sub_property_type' => '2BHK',
                    'posted_on' => $now,
                ],
                'pricing' => [
                    'price' => 4500000,
                    'maintenance' => 5200,
                    'available_from' => date('Y-m-d'),
                    'negotiable' => true,
                ],
            ],
            [
                'transaction_type' => 'sell',
                'property_category' => 'residential',
                'property_type' => 'villa',
                'city' => 'Bangalore',
                'locality' => 'Whitefield',
                'property_name' => 'Whitefield Vista Villa',
                'details' => [
                    'area_sqft' => 3100,
                    'availability' => 'under_construction',
                    'expected_completion' => date('Y-m-d', strtotime('+9 months')),
                    'ownership' => 'freehold',
                    'amenities' => ['garden', 'private_parking', 'club_house'],
                    'sub_property_type' => 'row_villa',
                    'posted_on' => $now,
                ],
                'pricing' => [
                    'price' => 15800000,
                    'maintenance' => 12000,
                    'available_from' => date('Y-m-d', strtotime('+180 days')),
                    'negotiable' => false,
                ],
            ],
            [
                'transaction_type' => 'rent',
                'property_category' => 'commercial',
                'property_type' => 'office',
                'city' => 'Mumbai',
                'locality' => 'Bandra-Kurla Complex',
                'property_name' => 'BKC Corporate Tower',
                'details' => [
                    'area_sqft' => 4200,
                    'availability' => 'ready_to_move',
                    'ownership' => 'leasehold',
                    'amenities' => ['cctv', 'reception', 'pantry'],
                    'sub_property_type' => 'corporate_office',
                    'posted_on' => $now,
                ],
                'pricing' => [
                    'price' => 6000000,
                    'maintenance' => null,
                    'available_from' => date('Y-m-d', strtotime('+30 days')),
                    'negotiable' => true,
                ],
            ],
            [
                'transaction_type' => 'rent',
                'property_category' => 'commercial',
                'property_type' => 'shop',
                'city' => 'Chennai',
                'locality' => 'T Nagar',
                'property_name' => 'T Nagar High Street Shop',
                'details' => [
                    'area_sqft' => 900,
                    'availability' => 'ready_to_move',
                    'ownership' => 'leasehold',
                    'amenities' => ['display_window', 'storage'],
                    'sub_property_type' => 'retail_shop',
                    'posted_on' => $now,
                ],
                'pricing' => [
                    'price' => 2200000,
                    'maintenance' => null,
                    'available_from' => date('Y-m-d'),
                    'negotiable' => true,
                ],
            ],
            [
                'transaction_type' => 'sell',
                'property_category' => 'residential',
                'property_type' => 'plot',
                'city' => 'Ahmedabad',
                'locality' => 'Satellite',
                'property_name' => 'Satellite Plot Estate',
                'details' => [
                    'area_sqft' => 3200,
                    'availability' => 'ready_to_move',
                    'ownership' => 'freehold',
                    'amenities' => ['boundary_wall'],
                    'sub_property_type' => 'corner_plot',
                    'posted_on' => $now,
                ],
                'pricing' => [
                    'price' => 8000000,
                    'maintenance' => null,
                    'available_from' => date('Y-m-d'),
                    'negotiable' => false,
                ],
            ],
            [
                'transaction_type' => 'rent',
                'property_category' => 'pg',
                'property_type' => 'pg',
                'city' => 'Delhi',
                'locality' => 'Lajpat Nagar',
                'property_name' => 'Lajpat Nagar PG Residence',
                'details' => [
                    'area_sqft' => 2000,
                    'availability' => 'ready_to_move',
                    'ownership' => 'leasehold',
                    'amenities' => ['wifi', 'meals'],
                    'sub_property_type' => 'pg',
                    'posted_on' => $now,
                ],
                'pricing' => [
                    'price' => 450000,
                    'maintenance' => null,
                    'available_from' => date('Y-m-d'),
                    'negotiable' => true,
                ],
            ],
        ];

        $propertyTable = $this->db->table('properties_new');
        $detailsTable = $this->db->table('property_details');
        $pricingTable = $this->db->table('property_pricing');

        foreach ($samples as $sample) {
            $insert = [
                'user_id' => $userId,
                'transaction_type' => $sample['transaction_type'],
                'property_category' => $sample['property_category'],
                'property_type' => $sample['property_type'],
                'city' => $sample['city'],
                'locality' => $sample['locality'],
                'property_name' => $sample['property_name'] ?? '',
                'status' => 'published',
                'created_at' => $now,
                'updated_at' => $now,
            ];

            $propertyTable->insert($insert);
            $propertyId = (int) $this->db->insertID();
            if ($propertyId <= 0) {
                continue;
            }

            $details = $sample['details'];
            if ($details !== null) {
                $detailsTable->insert([
                    'property_id' => $propertyId,
                    'details_json' => json_encode($details),
                    'created_at' => $now,
                    'updated_at' => $now,
                ]);
            }

            $pricing = $sample['pricing'];
            if ($pricing !== null) {
                $pricingTable->insert([
                    'property_id' => $propertyId,
                    'price' => $pricing['price'],
                    'maintenance' => $pricing['maintenance'],
                    'available_from' => $pricing['available_from'],
                    'negotiable' => $pricing['negotiable'] ? 1 : 0,
                    'created_at' => $now,
                    'updated_at' => $now,
                ]);
            }
        }

        echo "SamplePropertyUserSeeder: user {$userId} and properties seeded.\n";
    }
}
