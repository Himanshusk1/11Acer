<?php

namespace App\Models;

use CodeIgniter\Model;

class RazorpayTransactionModel extends Model
{
    protected $table = 'razorpay_transactions';
    protected $primaryKey = 'id';
    protected $returnType = 'array';
    protected $allowedFields = [
        'user_id',
        'subscription_id',
        'referral_code',
        'order_id',
        'amount',
        'currency',
        'status',
        'payment_capture',
        'receipt',
        'discount_applied',
        'discount_amount',
        'final_price',
        'notes',
        'order_payload',
    ];
    protected $useTimestamps = true;
}
