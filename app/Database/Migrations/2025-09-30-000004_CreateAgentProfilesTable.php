<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateAgentProfilesTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'agent_profile_id' => [
                'type'           => 'INT',
                'constraint'     => 11,
                'unsigned'       => true,
                'auto_increment' => true
            ],
            'user_id'          => [
                'type'       => 'INT',
                'constraint' => 11,
                'unsigned'   => true
            ],
            'company_name'     => ['type' => 'VARCHAR', 'constraint' => 255],
            'experience_years' => ['type' => 'INT', 'constraint' => 11, 'null' => true],
            'team_member_count'=> ['type' => 'INT', 'constraint' => 11, 'null' => true], // ✅ Changed to INT
            'office_location'  => ['type' => 'VARCHAR', 'constraint' => 255, 'null' => true],
            'rera_number'      => ['type' => 'VARCHAR', 'constraint' => 100, 'null' => true],
            'languages_spoken' => ['type' => 'TEXT', 'null' => true], // ✅ TEXT instead of LONGTEXT
            'specializations'  => ['type' => 'TEXT', 'null' => true], // ✅ TEXT instead of LONGTEXT
            'profile_image_url'=> ['type' => 'VARCHAR', 'constraint' => 255, 'null' => true],
            'is_premium'       => ['type' => 'TINYINT', 'constraint' => 1, 'default' => 0],
            'joined_on'        => ['type' => 'DATETIME', 'null' => true], // ✅ Changed to DATETIME
        ]);

        $this->forge->addKey('agent_profile_id', true);
        $this->forge->addUniqueKey('user_id'); 
        $this->forge->addForeignKey('user_id', 'users', 'user_id', 'CASCADE', 'CASCADE'); // ✅ safer update rule
        $this->forge->createTable('agentprofiles');
    }

    public function down()
    {
        $this->forge->dropTable('agentprofiles');
    }
}
