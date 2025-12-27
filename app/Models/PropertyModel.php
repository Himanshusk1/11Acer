<?php

namespace App\Models;
use CodeIgniter\Model;

class PropertyModel extends Model
{
    protected $table = 'properties_new';
    protected $primaryKey = 'id';
    // Keep allowed fields aligned with the actual DB columns for `properties_new`.
    // Reverted to the minimal set that exists in the database to avoid "Unknown column" errors.
    protected $allowedFields = [
        'user_id', 'transaction_type', 'property_category',
        'property_type', 'city', 'locality', 'status',
        'property_name'
    ];
}
