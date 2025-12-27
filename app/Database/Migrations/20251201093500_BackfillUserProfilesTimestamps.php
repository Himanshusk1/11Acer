<?php
namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class BackfillUserProfilesTimestamps extends Migration
{
    public function up()
    {
        // Set created_at/updated_at to now() where null so older records have timestamps
        $db = \Config\Database::connect();
        $db->query("UPDATE `user_profiles` SET `created_at` = NOW() WHERE `created_at` IS NULL");
        $db->query("UPDATE `user_profiles` SET `updated_at` = NOW() WHERE `updated_at` IS NULL");
    }

    public function down()
    {
        // Intentionally do not revert timestamps to NULL
    }
}
