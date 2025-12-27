<?php

namespace App\Controllers\Api;

use App\Controllers\BaseController;
use App\Models\ServiceEnquiryModel;
use CodeIgniter\API\ResponseTrait;
use Config\Services;

class ServiceEnquiry extends BaseController
{
    use ResponseTrait;

    public function submit()
    {
        $input = $this->request->getJSON(true);
        if (!is_array($input)) {
            $input = $this->request->getRawInput();
        }

        $payload = [
            'name' => trim($input['name'] ?? ''),
            'phone' => trim($input['phone'] ?? ''),
            'email' => trim($input['email'] ?? ''),
            'message' => trim($input['message'] ?? ''),
            'service_title' => trim($input['service_title'] ?? ''),
        ];

        $rules = [
            'name' => 'required|trim|min_length[3]|max_length[150]',
            'phone' => 'required|min_length[8]|max_length[20]|regex_match[/^[0-9\-\+\(\) ]+$/]',
            'email' => 'required|valid_email|max_length[150]',
            'message' => 'required|min_length[10]|max_length[1000]',
            'service_title' => 'required|min_length[3]|max_length[200]',
        ];

        $validation = Services::validation();
        if (! $validation->setRules($rules)->run($payload)) {
            return $this->failValidationErrors($validation->getErrors());
        }

        $model = new ServiceEnquiryModel();
        if ($model->insert($payload) === false) {
            log_message('error', 'API service enquiry save failed', $payload);
            return $this->failServerError('Unable to save the enquiry right now.');
        }

        return $this->respondCreated([
            'status' => 'success',
            'message' => 'Enquiry submitted successfully.',
        ]);
    }
}
