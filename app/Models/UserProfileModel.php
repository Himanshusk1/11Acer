<?php
namespace App\Models;

use CodeIgniter\Model;

class UserProfileModel extends Model
{
    protected $table = 'user_profiles';
    protected $primaryKey = 'profile_id';
    protected $allowedFields = ['user_id','photo_url','extra_data','created_at','updated_at'];
    protected $useTimestamps = true;
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $dateFormat    = 'datetime';
    protected $returnType = 'array';

    public function getByUser(int $userId)
    {
        return $this->where('user_id', $userId)->first();
    }

    public function upsertByUser(int $userId, array $data)
    {
        $existing = $this->getByUser($userId);
        if ($existing) {
            $this->update($existing['profile_id'], $data);
            return $this->getByUser($userId);
        } else {
            $data['user_id'] = $userId;
            $this->insert($data);
            return $this->getByUser($userId);
        }
    }
}
