<?php

namespace App\Controllers;

use CodeIgniter\HTTP\RedirectResponse;
use App\Models\ContactRequestModel;

class ContactController extends BaseController
{
    protected $helpers = ['form'];

    public function index()
    {
        return view('contact', [
            'active_page' => 'contact',
        ]);
    }

    public function sendMessage(): RedirectResponse
    {
        $rules = [
            'full_name' => 'required|min_length[3]|max_length[120]',
            'email' => 'required|valid_email|max_length[150]',
            'phone' => 'required|min_length[8]|max_length[20]',
            'subject' => 'required|min_length[3]|max_length[150]',
            'message' => 'required|min_length[10]|max_length[1000]',
        ];

        if (! $this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $payload = [
            'full_name' => trim($this->request->getPost('full_name')),
            'email' => trim($this->request->getPost('email')),
            'phone' => trim($this->request->getPost('phone')),
            'subject' => trim($this->request->getPost('subject')),
            'message' => trim($this->request->getPost('message')),
        ];

        $contactModel = new ContactRequestModel();
        if ($contactModel->insert($payload) === false) {
            log_message('error', 'Contact form persistence failed', [
                'errors' => $contactModel->errors(),
            ]);
        }

        // Optional: send email notification to admin
        $emailService = service('email');
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
            log_message('error', 'Contact form email failed: {error}', ['error' => $emailService->printDebugger(['headers'])]);
        }

        // Persist lead data or trigger events as needed.
        log_message('info', 'Contact inquiry received', $payload);

        return redirect()->back()->with('success', 'Thank you for reaching out. Our advisory team will connect shortly.');
    }
}
