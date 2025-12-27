<?php

namespace App\Models;

use CodeIgniter\Model;

class AgentModel extends Model
{
    protected $table = 'agents';
    protected $primaryKey = 'agent_id';
    protected $returnType = 'array';
    protected $allowedFields = [
        'full_name', 'email', 'phone_number', 'city', 'agency_name', 'profile_photo'
    ];
}
