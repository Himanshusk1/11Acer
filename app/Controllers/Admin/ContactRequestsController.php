<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\ContactRequestModel;
use CodeIgniter\HTTP\ResponseInterface;

class ContactRequestsController extends BaseController
{
    private ContactRequestModel $model;

    private array $allowedStatuses = ['pending', 'in_progress', 'resolved', 'archived'];

    public function __construct()
    {
        $this->model = new ContactRequestModel();
    }

    public function index()
    {
        $statusFilter = $this->request->getGet('status');
        $builder = $this->model->orderBy('created_at', 'DESC');

        if ($statusFilter && in_array($statusFilter, $this->allowedStatuses, true)) {
            $builder = $builder->where('status', $statusFilter);
        }

        $requests = $builder->paginate(20);

        return view('admin/contact_requests', [
            'active'        => 'contact-requests',
            'page_title'    => 'Contact Requests - Admin - 11 Acer',
            'requests'      => $requests,
            'pager'         => $this->model->pager,
            'filters'       => ['status' => $statusFilter],
            'allowedStatus' => $this->allowedStatuses,
            'metrics'       => $this->collectMetrics(),
        ]);
    }

    public function updateStatus(int $id)
    {
        if (! $this->request->is('post')) {
            return $this->respondJson([
                'success' => false,
                'message' => 'Unsupported request method.',
            ], ResponseInterface::HTTP_METHOD_NOT_ALLOWED);
        }

        $status = strtolower((string) $this->request->getPost('status'));
        $assignedTo = trim((string) $this->request->getPost('assigned_to')) ?: null;
        $notes = trim((string) $this->request->getPost('resolution_notes')) ?: null;
        $resolvedAt = $this->request->getPost('resolved_at');

        if ($status && ! in_array($status, $this->allowedStatuses, true)) {
            return $this->respondJson([
                'success' => false,
                'message' => 'Invalid status supplied.',
            ], ResponseInterface::HTTP_UNPROCESSABLE_ENTITY);
        }

        $payload = [];
        if ($status) {
            $payload['status'] = $status;
        }
        if ($assignedTo !== null) {
            $payload['assigned_to'] = $assignedTo;
        }
        if ($notes !== null) {
            $payload['resolution_notes'] = $notes;
        }
        if ($resolvedAt) {
            $payload['resolved_at'] = date('Y-m-d H:i:s', strtotime($resolvedAt));
        } elseif ($status === 'resolved') {
            $payload['resolved_at'] = date('Y-m-d H:i:s');
        }

        if ($payload === []) {
            return $this->respondJson([
                'success' => false,
                'message' => 'Nothing to update.',
            ], ResponseInterface::HTTP_BAD_REQUEST);
        }

        if (! $this->model->update($id, $payload)) {
            return $this->respondJson([
                'success' => false,
                'message' => 'Unable to update contact request.',
            ], ResponseInterface::HTTP_INTERNAL_SERVER_ERROR);
        }

        return $this->respondJson([
            'success' => true,
            'message' => 'Contact request updated.',
            'metrics' => $this->collectMetrics(),
        ]);
    }

    public function delete(int $id)
    {
        if (! $this->request->is('post')) {
            return $this->respondJson([
                'success' => false,
                'message' => 'Unsupported request method.',
            ], ResponseInterface::HTTP_METHOD_NOT_ALLOWED);
        }

        if (! $this->model->delete($id)) {
            return $this->respondJson([
                'success' => false,
                'message' => 'Unable to delete contact request.',
            ], ResponseInterface::HTTP_INTERNAL_SERVER_ERROR);
        }

        return $this->respondJson([
            'success' => true,
            'message' => 'Contact request removed.',
            'metrics' => $this->collectMetrics(),
        ]);
    }

    private function collectMetrics(): array
    {
        $model = new ContactRequestModel();
        return [
            'total'       => $model->countAllResults(),
            'pending'     => $this->countByStatus('pending'),
            'in_progress' => $this->countByStatus('in_progress'),
            'resolved'    => $this->countByStatus('resolved'),
            'archived'    => $this->countByStatus('archived'),
        ];
    }

    private function countByStatus(string $status): int
    {
        $model = new ContactRequestModel();
        return $model->where('status', $status)->countAllResults();
    }

    private function respondJson(array $payload, int $status = ResponseInterface::HTTP_OK)
    {
        return $this->response
            ->setStatusCode($status)
            ->setJSON(array_merge($payload, [
                'csrfHash' => csrf_hash(),
                'csrfName' => csrf_token(),
            ]));
    }
}
