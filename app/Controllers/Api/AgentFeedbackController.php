<?php

namespace App\Controllers\Api;

use App\Controllers\BaseController;
use App\Models\AgentFeedbackModel;
use CodeIgniter\API\ResponseTrait;

class AgentFeedbackController extends BaseController
{
    use ResponseTrait;

    protected $feedbackModel;

    public function __construct()
    {
        $this->feedbackModel = new AgentFeedbackModel();
    }

    public function submit()
    {
        if (!session()->get('isLoggedIn')) {
            return $this->failUnauthorized('Login required to submit feedback.');
        }

        $payload = $this->request->getJSON(true);
        if (empty($payload)) {
            $payload = $this->request->getPost();
        }

        $validation = \Config\Services::validation();
        $rules = [
            'agent_id' => 'required|is_natural_no_zero',
            'agent_name' => 'required|max_length[255]',
            'name' => 'required|max_length[150]',
            'phone_number' => 'required|min_length[10]|max_length[30]',
            'rating' => 'required|decimal|greater_than_equal_to[0]|less_than_equal_to[5]',
            'comment' => 'permit_empty|max_length[2000]',
        ];
        if (!$validation->setRules($rules)->run($payload)) {
            return $this->failValidationErrors($validation->getErrors());
        }

        $data = [
            'agent_id' => (int) $payload['agent_id'],
            'agent_name' => trim((string) ($payload['agent_name'] ?? '')),
            'name' => trim((string) ($payload['name'] ?? '')),
            'phone_number' => trim((string) ($payload['phone_number'] ?? '')),
            'rating' => (float) $payload['rating'],
            'comment' => trim((string) ($payload['comment'] ?? '')),
            'submitted_by' => session()->get('user_id'),
        ];

        if ($this->feedbackModel->save($data) === false) {
            return $this->failServerError($this->feedbackModel->errors() ?: 'Unable to store feedback.');
        }

        return $this->respondCreated([
            'status' => 'success',
            'message' => 'Feedback submitted. Thank you!',
        ]);
    }
}
