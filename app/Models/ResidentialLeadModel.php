<?php

namespace App\Models;

use CodeIgniter\Model;

class ResidentialLeadModel extends Model
{
    protected $table = 'residential_leads';
    protected $primaryKey = 'id';

    protected $allowedFields = [
        'full_name',
        'email',
        'preferred_city',
        'message',
        'status',
        'notes',
        'followed_up_at',
    ];

    protected $useTimestamps = true;
    protected $createdField = 'created_at';
    protected $updatedField = 'updated_at';
}
