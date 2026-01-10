<?php

namespace App\Models;

use CodeIgniter\Model;

class UserModel extends Model
{
    protected $table      = 'users';
    protected $primaryKey = 'user_id';  // ✅ Correct column name
    protected $allowedFields = [
        'full_name', 'email', 'phone_number', 'city', 'role', 'public_id',
        'service_type',
        'created_at', 'updated_at',
    ];
    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
}
