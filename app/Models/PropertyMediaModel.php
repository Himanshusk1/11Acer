<?php

namespace App\Models;
use CodeIgniter\Model;

class PropertyMediaModel extends Model
{
    protected $table = 'property_media';
    protected $allowedFields = ['property_id', 'file_url', 'file_type'];
}
