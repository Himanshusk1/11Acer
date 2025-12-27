<?php

namespace App\Controllers\Api;

use App\Controllers\BaseController;
use App\Models\ResidentialLeadModel;
use CodeIgniter\API\ResponseTrait;
use CodeIgniter\HTTP\ResponseInterface;
use Config\Services;

class ResidentialLead extends BaseController
{
    use ResponseTrait;

    public function submit()
    {
        $input = $this->request->getJSON(true);
        if (! is_array($input) || $input === []) {
            $input = $this->request->getRawInput();
        }
        if (! is_array($input) || $input === []) {
            $input = $this->request->getPost();
        }

        $payload = [
            'full_name'      => trim((string) ($input['full_name'] ?? '')),
            'email'          => strtolower(trim((string) ($input['email'] ?? ''))),
            'preferred_city' => trim((string) ($input['preferred_city'] ?? '')),
            'message'        => trim((string) ($input['message'] ?? '')),
        ];

        $rules = [
            'full_name'      => 'required|min_length[3]|max_length[150]',
            'email'          => 'required|valid_email|max_length[150]',
            'preferred_city' => 'permit_empty|max_length[120]',
            'message'        => 'required|min_length[10]|max_length[1200]',
        ];

        $validation = Services::validation();
        if (! $validation->setRules($rules)->run($payload)) {
            return $this->response
                ->setStatusCode(ResponseInterface::HTTP_UNPROCESSABLE_ENTITY)
                ->setJSON([
                    'status'    => 'error',
                    'message'   => 'Please review the highlighted fields.',
                    'errors'    => $validation->getErrors(),
                    'csrfToken' => csrf_token(),
                    'csrfHash'  => csrf_hash(),
                ]);
        }

        $model = new ResidentialLeadModel();
        if ($model->insert($payload) === false) {
            log_message('error', 'Residential lead save failed', ['errors' => $model->errors(), 'payload' => $payload]);
            return $this->response
                ->setStatusCode(ResponseInterface::HTTP_INTERNAL_SERVER_ERROR)
                ->setJSON([
                    'status'    => 'error',
                    'message'   => 'Unable to submit your request at the moment.',
                    'errors'    => $model->errors(),
                    'csrfToken' => csrf_token(),
                    'csrfHash'  => csrf_hash(),
                ]);
        }

        return $this->response
            ->setStatusCode(ResponseInterface::HTTP_CREATED)
            ->setJSON([
                'status'    => 'success',
                'message'   => 'Your residential request is logged. Our desk will connect shortly.',
                'csrfToken' => csrf_token(),
                'csrfHash'  => csrf_hash(),
            ]);
    }
}
