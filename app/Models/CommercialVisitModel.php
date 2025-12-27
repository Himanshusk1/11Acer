<?php

namespace App\Models;

use CodeIgniter\Model;

class CommercialVisitModel extends Model
{
    protected $table = 'commercial_visits';
    protected $primaryKey = 'id';

    protected $allowedFields = [
        'full_name',
        'email',
        'phone',
        'requirement',
        'message',
        'status',
        'priority',
        'notes',
        'follow_up_on',
    ];

    protected $useTimestamps = true;
    protected $createdField = 'created_at';
    protected $updatedField = 'updated_at';
}
