<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\ResidentialLeadModel;
use CodeIgniter\HTTP\ResponseInterface;

class ResidentialLeadsController extends BaseController
{
    private ResidentialLeadModel $model;

    private array $allowedStatuses = ['pending', 'contacted', 'converted', 'closed'];

    public function __construct()
    {
        $this->model = new ResidentialLeadModel();
    }

    public function index()
    {
        $statusFilter = $this->request->getGet('status');
        $builder = $this->model->orderBy('created_at', 'DESC');

        if ($statusFilter && in_array($statusFilter, $this->allowedStatuses, true)) {
            $builder = $builder->where('status', $statusFilter);
        }

        $leads = $builder->paginate(20);

        $metrics = $this->collectMetrics();

        return view('admin/residential_leads', [
            'active'        => 'residential-leads',
            'page_title'    => 'Residential Leads - Admin - 11 Acer',
            'leads'         => $leads,
            'pager'         => $this->model->pager,
            'filters'       => ['status' => $statusFilter],
            'allowedStatus' => $this->allowedStatuses,
            'metrics'       => $metrics,
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
        if (! in_array($status, $this->allowedStatuses, true)) {
            return $this->respondJson([
                'success' => false,
                'message' => 'Invalid status supplied.',
            ], ResponseInterface::HTTP_UNPROCESSABLE_ENTITY);
        }

        $notes = trim((string) $this->request->getPost('notes')) ?: null;
        $followUpAt = $this->request->getPost('followed_up_at');

        $updatePayload = [
            'status' => $status,
            'notes' => $notes,
        ];

        if ($followUpAt) {
            $updatePayload['followed_up_at'] = date('Y-m-d H:i:s', strtotime($followUpAt));
        }

        if (! $this->model->update($id, $updatePayload)) {
            return $this->respondJson([
                'success' => false,
                'message' => 'Unable to update lead.',
            ], ResponseInterface::HTTP_INTERNAL_SERVER_ERROR);
        }

        return $this->respondJson([
            'success' => true,
            'message' => 'Lead updated successfully.',
            'metrics' => $this->refreshMetrics(),
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
                'message' => 'Unable to delete lead.',
            ], ResponseInterface::HTTP_INTERNAL_SERVER_ERROR);
        }

        return $this->respondJson([
            'success' => true,
            'message' => 'Lead removed.',
            'metrics' => $this->refreshMetrics(),
        ]);
    }

    private function collectMetrics(): array
    {
        $model = new ResidentialLeadModel();
        return [
            'total'     => $model->countAllResults(),
            'pending'   => $this->countByStatus('pending'),
            'contacted' => $this->countByStatus('contacted'),
            'converted' => $this->countByStatus('converted'),
            'closed'    => $this->countByStatus('closed'),
        ];
    }

    private function countByStatus(string $status): int
    {
        $model = new ResidentialLeadModel();
        return $model->where('status', $status)->countAllResults();
    }

    private function refreshMetrics(): array
    {
        return $this->collectMetrics();
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
