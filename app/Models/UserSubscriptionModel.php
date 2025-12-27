<?php

namespace App\Models;

use CodeIgniter\Model;

class UserSubscriptionModel extends Model
{
    protected $table = 'user_subscriptions';
    protected $primaryKey = 'id';
    protected $allowedFields = ['user_id', 'subscription_id', 'starts_at', 'expires_at', 'active'];
    protected $useTimestamps = true;
}
