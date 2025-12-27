<?php

namespace App\Models;

use CodeIgniter\Model;

class PaymentModel extends Model
{
    protected $table = 'user_subscriptions';
    protected $primaryKey = 'id';
    protected $returnType = 'array';
    protected $allowedFields = ['user_id', 'subscription_id', 'starts_at', 'expires_at', 'active'];
    protected $useTimestamps = true;

    public function getRecentPayments(int $limit = 6): array
    {
        return $this->select([
                'user_subscriptions.id',
                'user_subscriptions.user_id',
                'user_subscriptions.active',
                'user_subscriptions.starts_at',
                'user_subscriptions.created_at',
                'subscriptions.name AS plan_name',
                'subscriptions.price',
                'users.full_name',
            ])
            ->join('subscriptions', 'subscriptions.id = user_subscriptions.subscription_id', 'left')
            ->join('users', 'users.user_id = user_subscriptions.user_id', 'left')
            ->orderBy('user_subscriptions.created_at', 'DESC')
            ->limit($limit)
            ->get()
            ->getResultArray();
    }

    public function getTotalVolume(): float
    {
        $builder = $this->builder();
        $builder->select('IFNULL(SUM(subscriptions.price), 0) AS total', false)
            ->join('subscriptions', 'subscriptions.id = user_subscriptions.subscription_id', 'left');

        $row = $builder->get()->getRowArray();
        return (float) ($row['total'] ?? 0);
    }

    public function getStatusCounts(): array
    {
        $builder = $this->builder();
        $builder->select('COUNT(*) AS total')
            ->select('SUM(CASE WHEN active = 1 THEN 1 ELSE 0 END) AS success', false)
            ->select('SUM(CASE WHEN active = 0 AND starts_at IS NOT NULL THEN 1 ELSE 0 END) AS pending', false)
            ->select('SUM(CASE WHEN (active = 0 AND (starts_at IS NULL OR starts_at = "0000-00-00 00:00:00")) THEN 1 ELSE 0 END) AS failed', false);

        $row = $builder->get()->getRowArray();

        return [
            'total' => (int) ($row['total'] ?? 0),
            'success' => (int) ($row['success'] ?? 0),
            'pending' => (int) ($row['pending'] ?? 0),
            'failed' => (int) ($row['failed'] ?? 0),
        ];
    }
}
