<?php

namespace App\Controllers\Api;

use CodeIgniter\RESTful\ResourceController;
use App\Models\InvoiceModel;
use App\Models\SubscriptionModel;
use App\Models\UserModel;
use App\Services\InvoiceService;

class Invoices extends ResourceController
{
    protected $format = 'json';
    protected InvoiceModel $invoiceModel;
    protected SubscriptionModel $subscriptionModel;
    protected UserModel $userModel;
    protected InvoiceService $invoiceService;

    public function __construct()
    {
        helper('url');
        $this->invoiceModel = new InvoiceModel();
        $this->subscriptionModel = new SubscriptionModel();
        $this->userModel = new UserModel();
        $this->invoiceService = new InvoiceService($this->invoiceModel);
    }

    public function index()
    {
        $userId = session()->get('user_id');
        if (! $userId) {
            return $this->failUnauthorized('Not logged in');
        }

        $invoices = $this->invoiceModel->where('user_id', $userId)
            ->orderBy('created_at', 'DESC')
            ->findAll();

        return $this->respond([
            'status' => 'success',
            'invoices' => $invoices,
            'messages' => $this->buildMessages($invoices),
        ]);
    }

    public function show($id)
    {
        $userId = session()->get('user_id');
        if (! $userId) {
            return $this->failUnauthorized('Not logged in');
        }

        $invoice = $this->invoiceModel->find($id);
        if (! $invoice || (int) $invoice['user_id'] !== (int) $userId) {
            return $this->failNotFound('Invoice not found');
        }

        return $this->respond([
            'status' => 'success',
            'invoice' => $invoice,
            'messages' => $this->buildMessages([$invoice]),
        ]);
    }

    public function generate()
    {
        $userId = session()->get('user_id');
        if (! $userId) {
            return $this->failUnauthorized('Not logged in');
        }

        $subscriptionId = $this->request->getPost('subscription_id');
        if (! $subscriptionId) {
            return $this->failValidationErrors('subscription_id is required');
        }

        $subscription = $this->subscriptionModel->find($subscriptionId);
        if (! $subscription) {
            return $this->failNotFound('Subscription not found');
        }

        $finalPrice = (float) $this->request->getPost('final_price');
        if ($finalPrice <= 0) {
            return $this->failValidationErrors('final_price must be greater than zero');
        }

        $customer = [
            'name' => $this->request->getPost('customer_name') ?: $this->getCustomerName($userId),
            'gstin' => $this->request->getPost('customer_gstin'),
            'email' => $this->request->getPost('customer_email') ?: $this->getCustomerEmail($userId),
            'phone' => $this->request->getPost('customer_phone') ?: $this->getCustomerPhone($userId),
            'address' => $this->request->getPost('customer_address'),
        ];

        $items = [
            [
                'description' => ($subscription['name'] ?? 'Subscription') . ' (' . ((int) ($subscription['duration_days'] ?? 0)) . ' days)',
                'hsn' => $subscription['hsn_code'] ?? '9983',
                'qty' => 1,
                'rate' => $finalPrice,
                'amount' => $finalPrice,
            ],
        ];

        $result = $this->invoiceService->generate([
            'user_id' => $userId,
            'subscription_id' => $subscriptionId,
            'subscription_name' => $subscription['name'] ?? 'Subscription',
            'order_id' => $this->request->getPost('order_id'),
            'amount_before_tax' => $finalPrice,
            'tax_rate_percent' => (float) ($this->request->getPost('tax_rate_percent') ?? 18),
            'items' => $items,
            'customer' => $customer,
            'customer_address' => $this->request->getPost('customer_address'),
        ]);

        $invoice = $result['invoice'];

        return $this->respondCreated([
            'status' => 'success',
            'invoice' => $invoice,
            'pdf_path' => $result['pdf_path'],
            'messages' => $this->buildMessages([$invoice]),
        ]);
    }

    public function download($id)
    {
        $userId = session()->get('user_id');
        if (! $userId) {
            return $this->failUnauthorized('Not logged in');
        }

        $invoice = $this->invoiceModel->find($id);
        if (! $invoice || (int) $invoice['user_id'] !== (int) $userId) {
            return $this->failNotFound('Invoice not found');
        }

        $fileName = basename($invoice['pdf_path']);
        $fullPath = WRITEPATH . 'invoices' . DIRECTORY_SEPARATOR . $fileName;
        if (! is_file($fullPath)) {
            return $this->failNotFound('Invoice file missing');
        }

        $download = $this->request->getGet('download') !== '0';
        $disposition = $download ? 'attachment' : 'inline';

        return $this->response
            ->setHeader('Content-Type', 'application/pdf')
            ->setHeader('Content-Disposition', "{$disposition}; filename=\"{$fileName}\"")
            ->setBody(file_get_contents($fullPath));
    }

    private function buildMessages(array $invoices): array
    {
        return array_map(function (array $invoice) {
            $baseUrl = base_url("api/invoices/{$invoice['id']}/pdf");
            return [
                'id' => 'invoice-' . $invoice['id'],
                'text' => sprintf('GST Invoice %s for %s', $invoice['invoice_number'], $invoice['subscription_name'] ?: 'subscription'),
                'buttons' => [
                    [
                        'label' => 'View Invoice',
                        'action' => 'view',
                        'url' => "$baseUrl?download=0",
                    ],
                    [
                        'label' => 'Download Invoice',
                        'action' => 'download',
                        'url' => "$baseUrl?download=1",
                    ],
                ],
            ];
        }, $invoices);
    }

    private function getCustomerName(int $userId): string
    {
        $user = $this->userModel->find($userId);
        return $user['full_name'] ?? 'Retail Customer';
    }

    private function getCustomerEmail(int $userId): ?string
    {
        $user = $this->userModel->find($userId);
        return $user['email'] ?? null;
    }

    private function getCustomerPhone(int $userId): ?string
    {
        $user = $this->userModel->find($userId);
        return $user['phone_number'] ?? null;
    }
}
