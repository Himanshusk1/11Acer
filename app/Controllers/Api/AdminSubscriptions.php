<?php

namespace App\Controllers\Api;

use App\Controllers\BaseController;
use App\Models\SubscriptionModel;
use CodeIgniter\API\ResponseTrait;

class AdminSubscriptions extends BaseController
{
    use ResponseTrait;

    private SubscriptionModel $subscriptionModel;

    public function __construct()
    {
        $this->subscriptionModel = new SubscriptionModel();
    }

    public function index()
    {
        $subscriptions = $this->subscriptionModel
            ->orderBy('duration_days', 'DESC')
            ->orderBy('price', 'DESC')
            ->findAll();

        return $this->respond([
            'status' => 'success',
            'data' => $subscriptions,
            'csrfHash' => csrf_hash(),
        ]);
    }

    public function store()
    {
        $input = $this->request->getPost();
        $rules = [
            'name' => 'required|max_length[191]',
            'price' => 'required|numeric|greater_than_equal_to[0]',
            'duration_days' => 'required|integer|greater_than_equal_to[1]',
        ];

        if (! $this->validate($rules)) {
            return $this->respond([
                'status' => 'error',
                'message' => 'Please fix the highlighted fields.',
                'errors' => $this->validator->getErrors(),
                'csrfHash' => csrf_hash(),
            ], 422);
        }

        $id = $this->subscriptionModel->insert([
            'name' => trim((string) $input['name']),
            'price' => (int) round((float) $input['price']),
            'duration_days' => (int) $input['duration_days'],
            'description' => trim((string) ($input['description'] ?? '')) ?: null,
        ]);

        return $this->respondCreated([
            'status' => 'success',
            'message' => 'Subscription plan saved.',
            'id' => $id,
            'csrfHash' => csrf_hash(),
        ]);
    }

    public function destroy($id = null)
    {
        if (empty($id)) {
            return $this->respond([
                'status' => 'error',
                'message' => 'Subscription id is required.',
                'csrfHash' => csrf_hash(),
            ], 422);
        }

        $subscription = $this->subscriptionModel->find($id);
        if (! $subscription) {
            return $this->respond([
                'status' => 'error',
                'message' => 'Subscription not found.',
                'csrfHash' => csrf_hash(),
            ], 404);
        }

        $this->subscriptionModel->delete($id);

        return $this->respondDeleted([
            'status' => 'success',
            'message' => 'Subscription removed.',
            'csrfHash' => csrf_hash(),
        ]);
    }
}
