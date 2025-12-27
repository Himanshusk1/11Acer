<?php

namespace App\Models;
use CodeIgniter\Model;

class PropertyDetailModel extends Model
{
    protected $table = 'property_details';
    protected $allowedFields = ['property_id', 'details_json'];
}
