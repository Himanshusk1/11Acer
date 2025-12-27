<?php

namespace App\Models;

use CodeIgniter\Model;

class ContactRequestModel extends Model
{
    protected $table = 'contact_requests';
    protected $primaryKey = 'id';

    protected $allowedFields = [
        'full_name',
        'email',
        'phone',
        'subject',
        'message',
        'status',
        'assigned_to',
        'resolution_notes',
        'resolved_at',
    ];

    protected $useTimestamps = true;
    protected $createdField = 'created_at';
    protected $updatedField = 'updated_at';
}
