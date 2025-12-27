<?php

namespace App\Controllers\Api;

use CodeIgniter\RESTful\ResourceController;
use App\Models\UserModel;

class UserController extends ResourceController
{
    protected $format = 'json';
    protected $userModel;

    public function __construct()
    {
        $this->userModel = new UserModel();
    }

    /**
     * Get logged-in user profile
     */
    public function profile()
    {
        $userId = session()->get('user_id');

        if (!$userId) {
            return $this->failUnauthorized('User not logged in');
        }

        $user = $this->userModel->find($userId);

        if (!$user) {
            return $this->failNotFound('User not found');
        }

        return $this->respond([
            'status' => 'success',
            'user' => $user
        ]);
    }

    /**
     * Update logged-in user info
     */
    public function update()
    {
        $userId = session()->get('user_id');

        if (!$userId) {
            return $this->failUnauthorized('User not logged in');
        }

        $rules = [
            'full_name' => 'required|min_length[3]|max_length[255]',
            'email' => "required|valid_email|is_unique[users.email,user_id,{$userId}]",
            'phone_number' => "required|is_unique[users.phone_number,user_id,{$userId}]",
            'city' => 'required',
        ];

        if (!$this->validate($rules)) {
            return $this->failValidationErrors($this->validator->getErrors());
        }

        $data = [
            'full_name' => $this->request->getVar('full_name'),
            'email' => $this->request->getVar('email'),
            'phone_number' => $this->request->getVar('phone_number'),
            'city' => $this->request->getVar('city'),
        ];

        $this->userModel->update($userId, $data);

        $updatedUser = $this->userModel->find($userId);
        return $this->respond([
            'status' => 'success',
            'message' => 'Profile updated successfully',
            'user' => $updatedUser
        ]);
    }
}
