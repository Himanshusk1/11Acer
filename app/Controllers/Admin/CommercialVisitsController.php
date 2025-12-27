<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\CommercialVisitModel;
use CodeIgniter\HTTP\ResponseInterface;

class CommercialVisitsController extends BaseController
{
    private CommercialVisitModel $model;

    private array $allowedStatuses = ['pending', 'in_progress', 'closed'];
    private array $allowedPriorities = ['normal', 'high'];

    public function __construct()
    {
        $this->model = new CommercialVisitModel();
    }

    public function index()
    {
        $statusFilter = $this->request->getGet('status');
        $priorityFilter = $this->request->getGet('priority');

        $builder = $this->model->orderBy('created_at', 'DESC');

        if ($statusFilter && in_array($statusFilter, $this->allowedStatuses, true)) {
            $builder = $builder->where('status', $statusFilter);
        }

        if ($priorityFilter && in_array($priorityFilter, $this->allowedPriorities, true)) {
            $builder = $builder->where('priority', $priorityFilter);
        }

        $visits = $builder->paginate(20);

        return view('admin/commercial_visits', [
            'active'          => 'commercial-visits',
            'page_title'      => 'Commercial Visits - Admin - 36 Broking Hub',
            'visits'          => $visits,
            'pager'           => $this->model->pager,
            'filters'         => [
                'status'   => $statusFilter,
                'priority' => $priorityFilter,
            ],
            'allowedStatus'   => $this->allowedStatuses,
            'allowedPriority' => $this->allowedPriorities,
            'metrics'         => $this->collectMetrics(),
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
        $priority = strtolower((string) $this->request->getPost('priority'));
        $followUp = $this->request->getPost('follow_up_on');
        $notes = trim((string) $this->request->getPost('notes')) ?: null;

        if ($status && ! in_array($status, $this->allowedStatuses, true)) {
            return $this->respondJson([
                'success' => false,
                'message' => 'Invalid status supplied.',
            ], ResponseInterface::HTTP_UNPROCESSABLE_ENTITY);
        }

        if ($priority && ! in_array($priority, $this->allowedPriorities, true)) {
            return $this->respondJson([
                'success' => false,
                'message' => 'Invalid priority supplied.',
            ], ResponseInterface::HTTP_UNPROCESSABLE_ENTITY);
        }

        $payload = [];
        if ($status) {
            $payload['status'] = $status;
        }
        if ($priority) {
            $payload['priority'] = $priority;
        }
        if ($notes !== null) {
            $payload['notes'] = $notes;
        }
        if ($followUp) {
            $payload['follow_up_on'] = date('Y-m-d H:i:s', strtotime($followUp));
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
                'message' => 'Unable to update visit request.',
            ], ResponseInterface::HTTP_INTERNAL_SERVER_ERROR);
        }

        return $this->respondJson([
            'success' => true,
            'message' => 'Visit request updated.',
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
                'message' => 'Unable to remove visit request.',
            ], ResponseInterface::HTTP_INTERNAL_SERVER_ERROR);
        }

        return $this->respondJson([
            'success' => true,
            'message' => 'Visit request removed.',
            'metrics' => $this->collectMetrics(),
        ]);
    }

    private function collectMetrics(): array
    {
        return [
            'total'        => (new CommercialVisitModel())->countAllResults(),
            'pending'      => $this->countBy('status', 'pending'),
            'in_progress'  => $this->countBy('status', 'in_progress'),
            'closed'       => $this->countBy('status', 'closed'),
            'highPriority' => $this->countBy('priority', 'high'),
        ];
    }

    private function countBy(string $field, string $value): int
    {
        $model = new CommercialVisitModel();
        return $model->where($field, $value)->countAllResults();
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
