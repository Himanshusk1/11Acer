<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;

class FeedbackController extends BaseController
{
    public function index()
    {
        $feedbackEntries = $this->loadFeedbackEntries();

        return view('admin/feedback', [
            'active' => 'feedback',
            'feedbackEntries' => $feedbackEntries,
        ]);
    }

    public function export()
    {
        $feedbackEntries = $this->loadFeedbackEntries();

        $filename = 'feedback-' . date('Ymd-His') . '.csv';
        $this->response->setHeader('Content-Type', 'text/csv; charset=UTF-8');
        $this->response->setHeader('Content-Disposition', 'attachment; filename="' . $filename . '"');
        $this->response->setHeader('Cache-Control', 'no-store, no-cache, must-revalidate');
        $this->response->setHeader('Pragma', 'no-cache');

        $stream = fopen('php://temp', 'r+');
        fputcsv($stream, ['Name', 'Phone', 'Rating', 'Comment', 'Forwarded', 'Date']);

        foreach ($feedbackEntries as $entry) {
            $forwarded = ! empty($entry['forwarded']) ? 'Yes' : 'No';
            $dateLabel = ! empty($entry['created_at']) ? date('Y-m-d H:i', strtotime($entry['created_at'])) : '';

            fputcsv($stream, [
                $entry['name'] ?? 'Unknown',
                $entry['phone'] ?? 'N/A',
                (int) ($entry['rating'] ?? 0),
                $entry['comment'] ?? 'No comment shared yet.',
                $forwarded,
                $dateLabel,
            ]);
        }

        rewind($stream);
        $csv = stream_get_contents($stream) ?: '';
        fclose($stream);

        return $this->response->setBody($csv);
    }

    private function loadFeedbackEntries(): array
    {
        return [
            [
                'name' => 'Ananya Sharma',
                'phone' => '+91 98989 12345',
                'rating' => 5,
                'comment' => 'Fantastic experience with the agents. They truly understood my needs and guided me throughout.',
                'forwarded' => true,
                'created_at' => '2025-12-18 14:32:00',
            ],
            [
                'name' => 'Rahul Verma',
                'phone' => '+91 98765 43210',
                'rating' => 4,
                'comment' => 'Smooth property visit, but I would have liked quicker documentation.',
                'forwarded' => false,
                'created_at' => '2025-12-17 10:10:00',
            ],
            [
                'name' => 'Priya Nair',
                'phone' => '+91 99555 11001',
                'rating' => 3,
                'comment' => 'Decent response time. Would appreciate more updates on upcoming listings.',
                'forwarded' => false,
                'created_at' => '2025-12-14 18:45:00',
            ],
        ];
    }
}
