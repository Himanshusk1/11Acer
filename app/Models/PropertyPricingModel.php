<?php

namespace App\Models;
use CodeIgniter\Model;

class PropertyPricingModel extends Model
{
    protected $table = 'property_pricing';
    protected $allowedFields = [
        'property_id', 'price', 'maintenance', 'available_from', 'negotiable'
    ];
}
