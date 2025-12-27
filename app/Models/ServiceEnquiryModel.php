<?php

namespace App\Models;

use CodeIgniter\Model;

class ServiceEnquiryModel extends Model
{
    protected $table = 'service_enquiries';
    protected $primaryKey = 'id';
    protected $allowedFields = [
        'name',
        'phone',
        'email',
        'service_title',
        'message',
    ];
    protected $useTimestamps = true;
    protected $createdField = 'created_at';
    protected $updatedField = 'updated_at';
}
