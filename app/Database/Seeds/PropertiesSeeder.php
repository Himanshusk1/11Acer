<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class PropertiesSeeder extends Seeder
{
    public function run()
    {
        $data = [
            [
                'user_id' => 2,
                'property_name' => 'Luxury 2BHK in South Delhi',
                'description' => 'Spacious 2BHK apartment with modern amenities',
                'listing_type' => 'rent',
                'property_type_id' => 1,
                'city' => 'Delhi',
                'locality' => 'South Extension',
                'full_address' => '123, South Extension, Delhi',
                'price' => 25000.00,
                'price_per_sqft' => null,        // explicitly null
                'built_up_area' => 1200.00,
                'area_unit' => 'sqft',
                'bedrooms' => 2,
                'bathrooms' => 2,
                'floors' => 5,
                'possession_status' => 'ready_to_move',
                'possession_date' => null,       // explicitly null
                'status' => 'active',
                'is_verified_by_team' => 1,
                'property_score' => 0,
                'posted_on' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'user_id' => 3,
                'property_name' => 'Premium Villa in Whitefield',
                'description' => 'Independent villa with garden and parking',
                'listing_type' => 'sell',
                'property_type_id' => 2,
                'city' => 'Bengaluru',
                'locality' => 'Whitefield',
                'full_address' => '456, Whitefield, Bengaluru',
                'price' => 12000000.00,
                'price_per_sqft' => null,
                'built_up_area' => 3200.00,
                'area_unit' => 'sqft',
                'bedrooms' => 4,
                'bathrooms' => 3,
                'floors' => 2,
                'possession_status' => 'under_construction',
                'possession_date' => null,
                'status' => 'active',
                'is_verified_by_team' => 0,
                'property_score' => 0,
                'posted_on' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'user_id' => 4,
                'property_name' => 'Office Space in Hinjewadi',
                'description' => 'Fully furnished office with 50 seats',
                'listing_type' => 'lease',
                'property_type_id' => 3,
                'city' => 'Pune',
                'locality' => 'Hinjewadi Phase 1',
                'full_address' => '789, Hinjewadi Phase 1, Pune',
                'price' => 80000.00,
                'price_per_sqft' => null,
                'built_up_area' => 2000.00,
                'area_unit' => 'sqft',
                'bedrooms' => null,              // explicitly null
                'bathrooms' => 2,
                'floors' => null,                // explicitly null
                'possession_status' => 'ready_to_move',
                'possession_date' => null,       // explicitly null
                'status' => 'active',
                'is_verified_by_team' => 1,
                'property_score' => 0,
                'posted_on' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
        ];

        $this->db->table('properties')->insertBatch($data);
    }
}
