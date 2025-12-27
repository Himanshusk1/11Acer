<?php

namespace App\Controllers\Api;

use App\Controllers\BaseController;
use App\Models\AppointmentModel;
use CodeIgniter\API\ResponseTrait;
use Config\Services;

class AppointmentRequest extends BaseController
{
    use ResponseTrait;

    public function submit()
    {
        $input = $this->request->getJSON(true);
        if (!is_array($input)) {
            $input = $this->request->getRawInput();
        }

        $payload = [
            'agent_id' => isset($input['agent_id']) ? (int) $input['agent_id'] : null,
            'agent_name' => trim($input['agent_name'] ?? ''),
            'agent_city' => trim($input['agent_city'] ?? ''),
            'agent_service' => trim($input['agent_service'] ?? ''),
            'name' => trim($input['name'] ?? ''),
            'phone' => trim($input['phone'] ?? ''),
            'email' => trim($input['email'] ?? ''),
            'preferred_date' => trim($input['preferred_date'] ?? ''),
            'preferred_time' => trim($input['preferred_time'] ?? ''),
            'notes' => trim($input['notes'] ?? ''),
            'message' => trim($input['message'] ?? ''),
        ];

        $rules = [
            'name' => 'required|trim|min_length[3]|max_length[150]',
            'phone' => 'required|min_length[8]|max_length[20]|regex_match[/^[0-9\-\+\(\) ]+$/]',
            'email' => 'required|valid_email|max_length[150]',
            'preferred_date' => 'required|valid_date',
            'preferred_time' => 'required',
            'notes' => 'permit_empty|max_length[2000]',
        ];

        $validation = Services::validation();
        if (! $validation->setRules($rules)->run($payload)) {
            return $this->failValidationErrors($validation->getErrors());
        }

        $model = new AppointmentModel();
        if ($model->insert($payload) === false) {
            log_message('error', 'API appointment save failed', $payload);
            return $this->failServerError('Unable to save the appointment request right now.');
        }

        return $this->respondCreated([
            'status' => 'success',
            'message' => 'Appointment request submitted successfully.',
            'csrfToken' => csrf_token(),
            'csrfHash' => csrf_hash(),
        ]);
    }
}
