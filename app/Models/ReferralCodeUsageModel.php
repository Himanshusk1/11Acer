<?php

namespace App\Models;

use CodeIgniter\Model;

class ReferralCodeUsageModel extends Model
{
    protected $table = 'referral_code_usages';
    protected $primaryKey = 'id';
    protected $returnType = 'array';
    protected $allowedFields = [
        'referral_code_id',
        'referrer_user_id',
        'used_by_user_id',
        'used_for_subscription_id',
        'discount_type',
        'discount_value',
        'discount_amount',
        'paid_amount',
        'payment_method',
        'payment_status',
    ];
    protected $useTimestamps = true;
    protected $createdField = 'created_at';
    protected $updatedField = 'updated_at';
}
