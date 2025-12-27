<?php

namespace App\Controllers\Api;

use App\Controllers\BaseController;
use App\Models\ContactRequestModel;
use CodeIgniter\API\ResponseTrait;
use CodeIgniter\HTTP\ResponseInterface;
use Config\Services;

class ContactRequest extends BaseController
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
            'full_name' => trim((string) ($input['full_name'] ?? '')),
            'email'     => strtolower(trim((string) ($input['email'] ?? ''))),
            'phone'     => trim((string) ($input['phone'] ?? '')),
            'subject'   => trim((string) ($input['subject'] ?? '')),
            'message'   => trim((string) ($input['message'] ?? '')),
        ];

        $rules = [
            'full_name' => 'required|min_length[3]|max_length[150]',
            'email'     => 'required|valid_email|max_length[150]',
            'phone'     => 'required|min_length[8]|max_length[20]|regex_match[/^[0-9\-\+\(\) ]+$/]',
            'subject'   => 'required|min_length[3]|max_length[180]',
            'message'   => 'required|min_length[10]|max_length[1500]',
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

        $model = new ContactRequestModel();
        if ($model->insert($payload) === false) {
            log_message('error', 'Contact request save failed', ['errors' => $model->errors(), 'payload' => $payload]);
            return $this->response
                ->setStatusCode(ResponseInterface::HTTP_INTERNAL_SERVER_ERROR)
                ->setJSON([
                    'status'    => 'error',
                    'message'   => 'Unable to send your message right now.',
                    'errors'    => $model->errors(),
                    'csrfToken' => csrf_token(),
                    'csrfHash'  => csrf_hash(),
                ]);
        }

        $this->dispatchNotification($payload);

        return $this->response
            ->setStatusCode(ResponseInterface::HTTP_CREATED)
            ->setJSON([
                'status'    => 'success',
                'message'   => 'Thank you. The contact desk has your request on priority.',
                'csrfToken' => csrf_token(),
                'csrfHash'  => csrf_hash(),
            ]);
    }

    private function dispatchNotification(array $payload): void
    {
        $emailService = Services::email();
        $emailService->setTo('hello@36brokinghub.com');
        $emailService->setReplyTo($payload['email'], $payload['full_name']);
        $emailService->setSubject('[Contact Form] ' . $payload['subject']);

        $body = "A new contact request has been submitted:\n\n" .
            "Name: {$payload['full_name']}\n" .
            "Email: {$payload['email']}\n" .
            "Phone: {$payload['phone']}\n" .
            "Subject: {$payload['subject']}\n\n" .
            "Message:\n{$payload['message']}";

        $emailService->setMessage($body);

        if (! $emailService->send()) {
            log_message('error', 'Contact request email dispatch failed: {debug}', [
                'debug' => $emailService->printDebugger(['headers', 'subject'])
            ]);
        }
    }
}
