<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use CodeIgniter\Database\Exceptions\DatabaseException;
use CodeIgniter\HTTP\ResponseInterface;
use Config\Database;

class AppointmentsController extends BaseController
{
    protected string $appointmentsTable = 'appointments';
    protected string $settingsTable = 'appointment_settings';

    public function index()
    {
        $appointments = $this->fetchAppointments();
        $metrics = $this->collectMetrics($appointments);
        $autoForwardEnabled = $this->getAutoForwardSetting();
        $cities = $this->extractCities($appointments);

        return view('admin/appointments', [
            'active'             => 'appointments',
            'page_title'         => 'Appointments - Admin - 36 Broking Hub',
            'appointments'       => $appointments,
            'metrics'            => $metrics,
            'autoForwardEnabled' => $autoForwardEnabled,
            'cities'             => $cities,
        ]);
    }

    public function forward(int $id)
    {
        if (! $this->request->is('post')) {
            return $this->respondJson([
                'success' => false,
                'message' => 'Unsupported method.',
            ], ResponseInterface::HTTP_METHOD_NOT_ALLOWED);
        }

        $appointment = $this->findAppointment($id);
        if ($appointment === null) {
            return $this->respondJson([
                'success' => false,
                'message' => 'Appointment not found.',
            ], ResponseInterface::HTTP_NOT_FOUND);
        }

        $currentStatus = $this->normalizeStatus($appointment['status'] ?? 'pending');
        if ($currentStatus === 'forwarded') {
            return $this->respondJson([
                'success' => true,
                'message' => 'This appointment has already been forwarded.',
                'status'  => 'forwarded',
                'metrics' => $this->collectMetrics(),
            ]);
        }

        if ($currentStatus === 'declined') {
            return $this->respondJson([
                'success' => false,
                'message' => 'Declined appointments cannot be forwarded.',
            ], ResponseInterface::HTTP_BAD_REQUEST);
        }

        $now = date('Y-m-d H:i:s');

        try {
            $updated = Database::connect()
                ->table($this->appointmentsTable)
                ->where('id', $id)
                ->update([
                    'status'       => 'forwarded',
                    'auto_forward' => 1,
                    'updated_at'   => $now,
                ]);
        } catch (DatabaseException $exception) {
            log_message('error', 'Unable to forward appointment: {message}', ['message' => $exception->getMessage()]);
            $updated = false;
        }

        if (! $updated) {
            return $this->respondJson([
                'success' => false,
                'message' => 'Unable to update the appointment status.',
            ], ResponseInterface::HTTP_INTERNAL_SERVER_ERROR);
        }

        return $this->respondJson([
            'success' => true,
            'message' => 'Appointment forwarded successfully.',
            'status'  => 'forwarded',
            'metrics' => $this->collectMetrics(),
        ]);
    }

    public function decline(int $id)
    {
        if (! $this->request->is('post')) {
            return $this->respondJson([
                'success' => false,
                'message' => 'Unsupported method.',
            ], ResponseInterface::HTTP_METHOD_NOT_ALLOWED);
        }

        $appointment = $this->findAppointment($id);
        if ($appointment === null) {
            return $this->respondJson([
                'success' => false,
                'message' => 'Appointment not found.',
            ], ResponseInterface::HTTP_NOT_FOUND);
        }

        $currentStatus = $this->normalizeStatus($appointment['status'] ?? 'pending');
        if ($currentStatus === 'declined') {
            return $this->respondJson([
                'success' => true,
                'message' => 'This appointment has already been declined.',
                'status'  => 'declined',
                'metrics' => $this->collectMetrics(),
            ]);
        }

        if ($currentStatus === 'forwarded') {
            return $this->respondJson([
                'success' => false,
                'message' => 'Forwarded appointments cannot be declined.',
            ], ResponseInterface::HTTP_BAD_REQUEST);
        }

        $now = date('Y-m-d H:i:s');

        try {
            $updated = Database::connect()
                ->table($this->appointmentsTable)
                ->where('id', $id)
                ->update([
                    'status'     => 'declined',
                    'updated_at' => $now,
                ]);
        } catch (DatabaseException $exception) {
            log_message('error', 'Unable to decline appointment: {message}', ['message' => $exception->getMessage()]);
            $updated = false;
        }

        if (! $updated) {
            return $this->respondJson([
                'success' => false,
                'message' => 'Unable to update the appointment status.',
            ], ResponseInterface::HTTP_INTERNAL_SERVER_ERROR);
        }

        return $this->respondJson([
            'success' => true,
            'message' => 'Appointment declined successfully.',
            'status'  => 'declined',
            'metrics' => $this->collectMetrics(),
        ]);
    }

    public function toggleAutoForward()
    {
        if (! $this->request->is('post')) {
            return $this->respondJson([
                'success' => false,
                'message' => 'Unsupported method.',
            ], ResponseInterface::HTTP_METHOD_NOT_ALLOWED);
        }

        $enabledRaw = $this->request->getPost('enabled');
        $enabled = filter_var($enabledRaw, FILTER_VALIDATE_BOOLEAN, FILTER_NULL_ON_FAILURE);

        if ($enabled === null) {
            return $this->respondJson([
                'success' => false,
                'message' => 'Invalid toggle value.',
            ], ResponseInterface::HTTP_BAD_REQUEST);
        }

        if (! $this->persistAutoForwardSetting($enabled)) {
            return $this->respondJson([
                'success' => false,
                'message' => 'Unable to persist auto-forward preference.',
            ], ResponseInterface::HTTP_INTERNAL_SERVER_ERROR);
        }

        return $this->respondJson([
            'success'            => true,
            'message'            => $enabled ? 'Auto-forward enabled. New appointments will be routed automatically.' : 'Auto-forward disabled. Manual triage is now active.',
            'autoForwardEnabled' => $enabled,
        ]);
    }

    public function view(int $id)
    {
        $appointment = $this->findAppointment($id);
        if ($appointment === null) {
            return $this->respondJson([
                'success' => false,
                'message' => 'Appointment not found.',
            ], ResponseInterface::HTTP_NOT_FOUND);
        }

        $details = [
            'Client Name'     => $appointment['name'] ?? 'Unknown',
            'Phone'           => $appointment['phone'] ?? 'N/A',
            'Email'           => $appointment['email'] ?? 'N/A',
            'Agent Name'      => $appointment['agent_name'] ?? 'N/A',
            'Agent City'      => $appointment['agent_city'] ?? 'N/A',
            'Service'         => $appointment['agent_service'] ?? 'N/A',
            'Preferred Date'  => $this->formatDate($appointment['preferred_date'] ?? null),
            'Preferred Time'  => $appointment['preferred_time'] ?? 'N/A',
            'Status'          => ucfirst($this->normalizeStatus($appointment['status'] ?? 'pending')),
            'Auto Forward'    => ! empty($appointment['auto_forward']) ? 'Yes' : 'No',
            'Submitted On'    => $this->formatDateTime($appointment['created_at'] ?? null),
            'Last Updated'    => $this->formatDateTime($appointment['updated_at'] ?? null),
            'Notes'           => $appointment['notes'] ?? '—',
            'Message'         => $appointment['message'] ?? '—',
        ];

        return $this->respondJson([
            'success'    => true,
            'details'    => $details,
            'status'     => $this->normalizeStatus($appointment['status'] ?? 'pending'),
        ]);
    }

    private function fetchAppointments(): array
    {
        try {
            $results = Database::connect()
                ->table($this->appointmentsTable)
                ->orderBy('created_at', 'DESC')
                ->get()
                ->getResultArray();

            return $results ?: $this->sampleAppointments();
        } catch (DatabaseException $exception) {
            log_message('error', 'Unable to load appointments: {message}', ['message' => $exception->getMessage()]);
            return $this->sampleAppointments();
        }
    }

    private function findAppointment(int $id): ?array
    {
        try {
            $row = Database::connect()
                ->table($this->appointmentsTable)
                ->where('id', $id)
                ->get()
                ->getRowArray();
            return $row ?: null;
        } catch (DatabaseException $exception) {
            log_message('error', 'Unable to find appointment: {message}', ['message' => $exception->getMessage()]);
            return null;
        }
    }

    private function sampleAppointments(): array
    {
        $now = date('Y-m-d H:i:s');
        return [
            [
                'id'             => 1001,
                'agent_id'       => 12,
                'agent_name'     => 'Isha Malhotra',
                'agent_city'     => 'Bengaluru',
                'agent_service'  => 'Luxury Residential',
                'name'           => 'Rohit Sharma',
                'phone'          => '+91 98765 12045',
                'email'          => 'rohit.sharma@example.com',
                'preferred_date' => date('Y-m-d', strtotime('+1 day')),
                'preferred_time' => '11:30 AM',
                'notes'          => 'Looking for a site visit around Indiranagar.',
                'message'        => 'Please align a walkthrough with the owner if possible.',
                'created_at'     => date('Y-m-d H:i:s', strtotime('-2 hours')),
                'updated_at'     => $now,
                'status'         => 'pending',
                'auto_forward'   => 0,
            ],
            [
                'id'             => 1000,
                'agent_id'       => 8,
                'agent_name'     => 'Neeraj Khatri',
                'agent_city'     => 'Gurugram',
                'agent_service'  => 'Commercial Leasing',
                'name'           => 'Akshita Rao',
                'phone'          => '+91 99900 56789',
                'email'          => 'akshita.rao@example.com',
                'preferred_date' => date('Y-m-d', strtotime('+2 days')),
                'preferred_time' => '04:00 PM',
                'notes'          => 'Needs 4000 sq.ft. plug-and-play office near Cyberhub.',
                'message'        => 'Forward to the enterprise desk for quick turnaround.',
                'created_at'     => date('Y-m-d H:i:s', strtotime('-1 day')),
                'updated_at'     => date('Y-m-d H:i:s', strtotime('-1 day +30 minutes')),
                'status'         => 'forwarded',
                'auto_forward'   => 1,
            ],
            [
                'id'             => 999,
                'agent_id'       => 5,
                'agent_name'     => 'Saanvi Patel',
                'agent_city'     => 'Mumbai',
                'agent_service'  => 'Rental Advisory',
                'name'           => 'Karan Singh',
                'phone'          => '+91 98111 22334',
                'email'          => 'karan.singh@example.com',
                'preferred_date' => date('Y-m-d', strtotime('+3 days')),
                'preferred_time' => '02:15 PM',
                'notes'          => 'Client evaluating Bandra/Khar options under ₹1.5L.',
                'message'        => 'Declined due to overlapping lead from partner brokerage.',
                'created_at'     => date('Y-m-d H:i:s', strtotime('-3 days')),
                'updated_at'     => date('Y-m-d H:i:s', strtotime('-3 days +2 hours')),
                'status'         => 'declined',
                'auto_forward'   => 0,
            ],
        ];
    }

    private function collectMetrics(?array $appointments = null): array
    {
        $appointments ??= $this->fetchAppointments();

        $metrics = [
            'total'     => count($appointments),
            'forwarded' => 0,
            'pending'   => 0,
            'declined'  => 0,
        ];

        foreach ($appointments as $appointment) {
            $status = $this->normalizeStatus($appointment['status'] ?? 'pending');
            if (isset($metrics[$status])) {
                $metrics[$status]++;
            }
        }

        return $metrics;
    }

    private function extractCities(array $appointments): array
    {
        $cities = [];
        foreach ($appointments as $appointment) {
            $city = trim((string) ($appointment['agent_city'] ?? ''));
            if ($city !== '') {
                $cities[$city] = true;
            }
        }

        $cityList = array_keys($cities);
        sort($cityList, SORT_NATURAL | SORT_FLAG_CASE);

        return $cityList;
    }

    private function normalizeStatus(?string $status): string
    {
        $status = strtolower(trim((string) $status));
        return in_array($status, ['forwarded', 'declined', 'pending'], true) ? $status : 'pending';
    }

    private function getAutoForwardSetting(): bool
    {
        try {
            $row = Database::connect()
                ->table($this->settingsTable)
                ->select('auto_forward')
                ->orderBy('id', 'DESC')
                ->get(1)
                ->getRowArray();
            return ! empty($row) && ! empty($row['auto_forward']);
        } catch (DatabaseException $exception) {
            log_message('error', 'Unable to read auto-forward preference: {message}', ['message' => $exception->getMessage()]);
            return false;
        }
    }

    private function persistAutoForwardSetting(bool $enabled): bool
    {
        $now = date('Y-m-d H:i:s');

        try {
            $db = Database::connect();
            $builder = $db->table($this->settingsTable);
            $existing = $builder->select('id')->orderBy('id', 'DESC')->get(1)->getRowArray();

            if ($existing) {
                return (bool) $builder
                    ->where('id', $existing['id'])
                    ->set('auto_forward', $enabled ? 1 : 0)
                    ->set('updated_at', $now)
                    ->update();
            }

            return (bool) $builder->insert([
                'auto_forward' => $enabled ? 1 : 0,
                'created_at'   => $now,
                'updated_at'   => $now,
            ]);
        } catch (DatabaseException $exception) {
            log_message('error', 'Unable to persist auto-forward preference: {message}', ['message' => $exception->getMessage()]);
            return false;
        }
    }

    private function respondJson(array $payload, int $status = ResponseInterface::HTTP_OK)
    {
        if (function_exists('csrf_token')) {
            $payload['csrfToken'] = csrf_token();
        }
        if (function_exists('csrf_hash')) {
            $payload['csrfHash'] = csrf_hash();
        }

        return $this->response->setStatusCode($status)->setJSON($payload);
    }

    private function formatDate(?string $date): string
    {
        if (empty($date)) {
            return 'N/A';
        }

        try {
            $timestamp = strtotime($date);
            if ($timestamp === false) {
                return (string) $date;
            }
            return date('d M Y', $timestamp);
        } catch (\Throwable $exception) {
            return (string) $date;
        }
    }

    private function formatDateTime(?string $dateTime): string
    {
        if (empty($dateTime)) {
            return 'N/A';
        }

        try {
            $timestamp = strtotime($dateTime);
            if ($timestamp === false) {
                return (string) $dateTime;
            }
            return date('d M Y, h:i A', $timestamp);
        } catch (\Throwable $exception) {
            return (string) $dateTime;
        }
    }
}
