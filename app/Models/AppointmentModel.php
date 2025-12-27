<?php

namespace App\Models;

use CodeIgniter\Model;

class AppointmentModel extends Model
{
    protected $table = 'appointments';
    protected $primaryKey = 'id';

    protected $allowedFields = [
        'agent_id',
        'agent_name',
        'agent_city',
        'agent_service',
        'name',
        'phone',
        'email',
        'preferred_date',
        'preferred_time',
        'notes',
        'message',
    ];

    protected $useTimestamps = true;
    protected $createdField = 'created_at';
    protected $updatedField = 'updated_at';
}
