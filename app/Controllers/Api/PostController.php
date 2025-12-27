<?php

namespace App\Controllers\Api;

use CodeIgniter\RESTful\ResourceController;
use App\Models\PostModel;

class PostController extends ResourceController
{
    protected $format = 'json';
    protected $postModel;

    public function __construct()
    {
        $this->postModel = new PostModel();
    }

    /**
     * Get all posts
     */
    public function index()
    {
        $posts = $this->postModel->orderBy('created_at', 'DESC')->findAll();

        return $this->respond([
            'status' => 'success',
            'posts' => $posts
        ]);
    }

    /**
     * Get single post
     */
    public function show($id = null)
    {
        $post = $this->postModel->find($id);

        if (!$post) {
            return $this->failNotFound('Post not found');
        }

        return $this->respond([
            'status' => 'success',
            'post' => $post
        ]);
    }

    /**
     * Create a new post
     */
    public function create()
    {
        $userId = session()->get('user_id');
        if (!$userId) {
            return $this->failUnauthorized('Not logged in');
        }

        $rules = [
            'title' => 'required|min_length[3]|max_length[255]',
            'content' => 'required|min_length[10]'
        ];

        if (!$this->validate($rules)) {
            return $this->failValidationErrors($this->validator->getErrors());
        }

        $data = [
            'user_id' => $userId,
            'title' => $this->request->getVar('title'),
            'content' => $this->request->getVar('content'),
            'status' => $this->request->getVar('status') ?? 'draft'
        ];

        $this->postModel->insert($data);
        $postId = $this->postModel->insertID();

        return $this->respondCreated([
            'status' => 'success',
            'message' => 'Post created successfully',
            'post_id' => $postId
        ]);
    }

    /**
     * Update existing post
     */
    public function update($id = null)
    {
        $userId = session()->get('user_id');
        if (!$userId) {
            return $this->failUnauthorized('Not logged in');
        }

        $post = $this->postModel->find($id);
        if (!$post) {
            return $this->failNotFound('Post not found');
        }

        if ($post['user_id'] != $userId) {
            return $this->failForbidden('You cannot edit this post');
        }

        $rules = [
            'title' => 'required|min_length[3]|max_length[255]',
            'content' => 'required|min_length[10]'
        ];

        if (!$this->validate($rules)) {
            return $this->failValidationErrors($this->validator->getErrors());
        }

        $data = [
            'title' => $this->request->getVar('title'),
            'content' => $this->request->getVar('content'),
            'status' => $this->request->getVar('status') ?? $post['status']
        ];

        $this->postModel->update($id, $data);

        return $this->respond([
            'status' => 'success',
            'message' => 'Post updated successfully',
        ]);
    }

    /**
     * Delete post
     */
    public function delete($id = null)
    {
        $userId = session()->get('user_id');
        if (!$userId) {
            return $this->failUnauthorized('Not logged in');
        }

        $post = $this->postModel->find($id);
        if (!$post) {
            return $this->failNotFound('Post not found');
        }

        if ($post['user_id'] != $userId) {
            return $this->failForbidden('You cannot delete this post');
        }

        $this->postModel->delete($id);

        return $this->respond([
            'status' => 'success',
            'message' => 'Post deleted successfully'
        ]);
    }
}
