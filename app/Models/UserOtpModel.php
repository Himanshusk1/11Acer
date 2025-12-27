<?php

namespace App\Models;

use CodeIgniter\Model;

class UserOtpModel extends Model
{
    protected $table      = 'user_otps';
    protected $primaryKey = 'otp_id';
    protected $allowedFields = ['user_id', 'otp_code', 'expires_at', 'created_at']; 
}
