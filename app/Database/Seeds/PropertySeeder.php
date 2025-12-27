<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class PropertySeeder extends Seeder
{
    public function run()
    {
        $now = date('Y-m-d H:i:s');

        // Safe insert: only include columns which the controller and models use.
        $sample = [
            [
                'user_id' => 1,
                'transaction_type' => 'sale',
                'property_category' => 'residential',
                'property_type' => 'apartment',
                'status' => 'published',
                'city' => 'Hyderabad',
                'locality' => 'Banjara Hills'
            ],
            [
                'user_id' => 2,
                'transaction_type' => 'sale',
                'property_category' => 'residential',
                'property_type' => 'villa',
                'status' => 'published',
                'city' => 'Mumbai',
                'locality' => 'Bandra'
            ],
            [
                'user_id' => 3,
                'transaction_type' => 'rent',
                'property_category' => 'commercial',
                'property_type' => 'office',
                'status' => 'published',
                'city' => 'Bengaluru',
                'locality' => 'Indiranagar'
            ],
            [
                'user_id' => 4,
                'transaction_type' => 'sale',
                'property_category' => 'residential',
                'property_type' => 'plot',
                'status' => 'published',
                'city' => 'Delhi',
                'locality' => 'Dwarka'
            ],
            [
                'user_id' => 5,
                'transaction_type' => 'rent',
                'property_category' => 'residential',
                'property_type' => 'apartment',
                'status' => 'published',
                'city' => 'Hyderabad',
                'locality' => 'Madhapur'
            ],
            [
                'user_id' => 6,
                'transaction_type' => 'sale',
                'property_category' => 'commercial',
                'property_type' => 'shop',
                'status' => 'published',
                'city' => 'Mumbai',
                'locality' => 'Andheri'
            ],
        ];

        // Insert properties and then add details + pricing for each one
        foreach ($sample as $row) {
            $this->db->table('properties_new')->insert($row);
            $pid = $this->db->insertID();

            if (!$pid) continue;

            // Example details - varied per sample by locality/pid
            $details = [];
            switch (strtolower($row['property_type'])) {
                case 'apartment':
                    $details = [
                        'area_sqft' => rand(800, 2500),
                        'availability' => 'ready_to_move',
                        'expected_completion' => null,
                        'ownership' => 'freehold',
                        'amenities' => ['parking', 'lift', 'power_backup'],
                        'sub_property_type' => '2BHK',
                        'sublocality' => $row['locality'],
                        'apartment' => 'Tower ' . chr(64 + ($pid % 26)),
                        'posted_on' => $now
                    ];
                    break;
                case 'villa':
                    $details = [
                        'area_sqft' => rand(2000, 5000),
                        'availability' => 'under_construction',
                        'expected_completion' => date('Y-m-d', strtotime('+6 months')),
                        'ownership' => 'freehold',
                        'amenities' => ['garden', 'private_parking', 'swimming_pool'],
                        'sub_property_type' => 'independent_villa',
                        'sublocality' => $row['locality'],
                        'apartment' => null,
                        'posted_on' => $now
                    ];
                    break;
                case 'office':
                case 'shop':
                case 'plot':
                default:
                    $details = [
                        'area_sqft' => rand(500, 10000),
                        'availability' => 'ready_to_move',
                        'expected_completion' => null,
                        'ownership' => 'leasehold',
                        'amenities' => ['security', 'toilet'],
                        'sub_property_type' => $row['property_type'],
                        'sublocality' => $row['locality'],
                        'apartment' => null,
                        'posted_on' => $now
                    ];
                    break;
            }

            $this->db->table('property_details')->insert([
                'property_id' => $pid,
                'details_json' => json_encode($details)
            ]);

            // Pricing - varied
            $price = 0;
            switch (strtolower($row['property_type'])) {
                case 'apartment':
                    $price = rand(30, 200) * 100000; // 30L - 200L
                    break;
                case 'villa':
                    $price = rand(100, 500) * 100000; // 1Cr - 5Cr
                    break;
                case 'office':
                    $price = rand(50, 400) * 100000;
                    break;
                case 'plot':
                    $price = rand(20, 300) * 100000;
                    break;
                case 'shop':
                    $price = rand(10, 150) * 100000;
                    break;
                default:
                    $price = rand(20, 150) * 100000;
                    break;
            }

            $this->db->table('property_pricing')->insert([
                'property_id' => $pid,
                'price' => $price,
                'maintenance' => (in_array(strtolower($row['property_type']), ['apartment', 'villa']) ? rand(1000, 10000) : null),
                'available_from' => date('Y-m-d', strtotime('+'.rand(0,60).' days')),
                'negotiable' => rand(0,1)
            ]);
        }

        echo "PropertySeeder: inserted sample properties.\n";
    }
}
