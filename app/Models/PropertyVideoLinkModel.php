<?php

namespace App\Models;

use CodeIgniter\Model;

class PropertyVideoLinkModel extends Model
{
    protected $table = 'property_video_links';
    protected $allowedFields = ['property_id', 'url'];
}
