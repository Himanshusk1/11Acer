<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class AgentProfilesSeeder extends Seeder
{
    public function run()
    {
        $data = [
            [
                'user_id' => 2,
                'company_name' => 'Dream Homes Realty',
                'experience_years' => 5,
                'team_member_count' => '10',
                'office_location' => 'Delhi NCR',
                'rera_number' => 'DLRERA12345',
                'languages_spoken' => json_encode(['English', 'Hindi', 'Punjabi']),
                'specializations' => json_encode(['Apartments', 'Commercial']),
                'profile_image_url' => 'https://example.com/images/agent_simran.jpg',
                'is_premium' => 1,
                'joined_on' => '2020-05-10',
            ],
        ];

        $this->db->table('agentprofiles')->insertBatch($data);
    }
}
