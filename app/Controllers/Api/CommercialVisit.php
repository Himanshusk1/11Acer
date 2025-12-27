<?php

namespace App\Controllers\Api;

use App\Controllers\BaseController;
use App\Models\CommercialVisitModel;
use CodeIgniter\API\ResponseTrait;
use CodeIgniter\HTTP\ResponseInterface;
use Config\Services;

class CommercialVisit extends BaseController
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
            'full_name'   => trim((string) ($input['full_name'] ?? '')),
            'email'       => strtolower(trim((string) ($input['email'] ?? ''))),
            'phone'       => trim((string) ($input['phone'] ?? '')),
            'requirement' => trim((string) ($input['requirement'] ?? '')),
            'message'     => trim((string) ($input['message'] ?? '')),
        ];

        $rules = [
            'full_name'   => 'required|min_length[3]|max_length[150]',
            'email'       => 'required|valid_email|max_length[150]',
            'phone'       => 'required|min_length[8]|max_length[20]|regex_match[/^[0-9\-\+\(\) ]+$/]',
            'requirement' => 'permit_empty|max_length[100]',
            'message'     => 'required|min_length[10]|max_length[1500]',
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

        $payload['priority'] = $this->resolvePriority($payload['requirement'] ?? '');

        $model = new CommercialVisitModel();
        if ($model->insert($payload) === false) {
            log_message('error', 'Commercial visit save failed', ['errors' => $model->errors(), 'payload' => $payload]);
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
                'message'   => 'Visit request captured. A specialist will call within the next business window.',
                'csrfToken' => csrf_token(),
                'csrfHash'  => csrf_hash(),
            ]);
    }

    private function resolvePriority(string $requirement): string
    {
        $requirement = strtolower($requirement);
        if ($requirement === '') {
            return 'normal';
        }

        $highIntentKeywords = ['investment', 'land', 'industrial'];
        foreach ($highIntentKeywords as $keyword) {
            if (str_contains($requirement, $keyword)) {
                return 'high';
            }
        }

        return 'normal';
    }
}
