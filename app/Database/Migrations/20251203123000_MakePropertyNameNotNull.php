<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class MakePropertyNameNotNull extends Migration
{
    public function up()
    {
        // Backfill existing NULL values to empty string to allow altering to NOT NULL
        $this->db->query("UPDATE `properties_new` SET `property_name` = '' WHERE `property_name` IS NULL;");

        // Alter column to NOT NULL with default empty string
        $this->db->query("ALTER TABLE `properties_new` MODIFY `property_name` VARCHAR(255) NOT NULL DEFAULT '';");
    }

    public function down()
    {
        // Revert column to nullable
        $this->db->query("ALTER TABLE `properties_new` MODIFY `property_name` VARCHAR(255) NULL DEFAULT NULL;");
    }
}
