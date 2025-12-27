<?php

namespace App\Models;

use CodeIgniter\Model;

class AgentFeedbackModel extends Model
{
    protected $table = 'agent_feedbacks';
    protected $primaryKey = 'id';
    protected $returnType = 'array';
    protected $allowedFields = [
        'agent_id',
        'agent_name',
        'name',
        'phone_number',
        'rating',
        'comment',
        'submitted_by',
    ];
    protected $useTimestamps = true;
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
}
