<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class RemoveExtraReferralUsageColumns extends Migration
{
    public function up()
    {
        if ($this->db->fieldExists('payment_reference', 'referral_code_usages')) {
            $this->forge->dropColumn('referral_code_usages', 'payment_reference');
        }
        if ($this->db->fieldExists('payment_details', 'referral_code_usages')) {
            $this->forge->dropColumn('referral_code_usages', 'payment_details');
        }
        if ($this->db->fieldExists('metadata', 'referral_code_usages')) {
            $this->forge->dropColumn('referral_code_usages', 'metadata');
        }
    }

    public function down()
    {
        $fields = [];
        if (! $this->db->fieldExists('payment_reference', 'referral_code_usages')) {
            $fields['payment_reference'] = ['type' => 'VARCHAR', 'constraint' => 191, 'null' => true];
        }
        if (! $this->db->fieldExists('payment_details', 'referral_code_usages')) {
            $fields['payment_details'] = ['type' => 'TEXT', 'null' => true];
        }
        if (! $this->db->fieldExists('metadata', 'referral_code_usages')) {
            $fields['metadata'] = ['type' => 'TEXT', 'null' => true];
        }
        if (! empty($fields)) {
            $this->forge->addColumn('referral_code_usages', $fields);
        }
    }
}
