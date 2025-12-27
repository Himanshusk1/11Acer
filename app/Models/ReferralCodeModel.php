<?php

namespace App\Models;

use CodeIgniter\Model;

class ReferralCodeModel extends Model
{
    protected $table      = 'referral_codes';
    protected $primaryKey = 'referral_code_id';
    protected $allowedFields = [
        'user_id',
        'code',
    ];
    protected $useTimestamps = true;
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
}
