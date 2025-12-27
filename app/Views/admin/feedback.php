<?php
$page_title = $page_title ?? 'Feedback - Admin - 36 Broking Hub';
$feedbackEntries = $feedbackEntries ?? [];
$totalFeedback = count($feedbackEntries);
$totalRating = 0;
$forwardedCount = 0;
foreach ($feedbackEntries as $entry) {
    $totalRating += (int) ($entry['rating'] ?? 0);
    if (!empty($entry['forwarded'])) {
        $forwardedCount++;
    }
}
$avgRating = $totalFeedback ? $totalRating / $totalFeedback : 0;
$pendingCount = max(0, $totalFeedback - $forwardedCount);
$renderStars = static function (int $rating): string {
    $rating = max(0, min(5, $rating));
    return str_repeat('&#9733;', $rating) . str_repeat('&#9734;', 5 - $rating);
};
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <?php include 'assets/includes/seo-meta.php'; ?>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="icon" type="image/x-icon" href="<?= base_url('images/favicon/favicon.ico') ?>">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/aos@2.3.4/dist/aos.css">
    <title><?= esc($page_title) ?></title>
    <style>
    :root {
        --admin-primary: #198754;
        --admin-primary-soft: rgba(25, 135, 84, 0.08);
        --surface-base: #f6f8f5;
        --surface-card: #ffffff;
        --surface-muted: #ecf3ec;
        --border-subtle: #dfe6df;
        --text-muted: #6c757d;
        --shadow-soft: 0 15px 45px rgba(28, 51, 36, 0.08);
    }

    * {
        box-sizing: border-box;
    }

    html,
    body {
        min-height: 100%;
        background: var(--surface-base);
        font-family: 'Inter', sans-serif;
        color: #101828;
        overflow-x: hidden;
    }

    body.dark-mode {
        background: #111618;
        color: #e8f1ec;
    }

    body.dark-mode .sidebar,
    body.dark-mode .topbar,
    body.dark-mode .page-header,
    body.dark-mode .stat-card,
    body.dark-mode .filter-card,
    body.dark-mode .table-card {
        background: rgba(20, 26, 24, 0.92);
        border-color: rgba(255, 255, 255, 0.08);
        color: inherit;
        box-shadow: 0 30px 60px rgba(0, 0, 0, 0.35);
    }

    body.dark-mode .table-card .table thead,
    body.dark-mode .table-card .table tbody tr {
        background-color: transparent;
    }

    body.dark-mode .table-card .table thead th {
        color: #f5fbf7;
        border-bottom-color: rgba(255, 255, 255, 0.1);
    }

    body.dark-mode .table-card .table tbody td {
        border-color: rgba(255, 255, 255, 0.08);
    }

    body.dark-mode .filter-card .form-control,
    body.dark-mode .filter-card .form-select {
        background: rgba(255, 255, 255, 0.06);
        border-color: rgba(255, 255, 255, 0.08);
        color: #f8f9fa;
    }

    body.dark-mode .topbar {
        background: rgba(15, 19, 18, 0.92);
        border-bottom-color: rgba(255, 255, 255, 0.08);
        color: #f2f7f4;
        box-shadow: 0 15px 35px rgba(0, 0, 0, 0.45);
    }

    body.dark-mode .topbar .dropdown-toggle,
    body.dark-mode .topbar .dropdown-toggle strong,
    body.dark-mode .topbar .dropdown-toggle small {
        color: #f2f7f4 !important;
    }

    body.dark-mode .icon-btn {
        background: rgba(255, 255, 255, 0.08);
        border-color: rgba(255, 255, 255, 0.1);
        color: #f5fbf7;
    }

    body.dark-mode .icon-btn:hover {
        background: var(--admin-primary);
        color: #fff;
    }

    body.dark-mode .btn-ghost,
    body.dark-mode .btn-soft-secondary {
        background: rgba(255, 255, 255, 0.08);
        color: #e8f1ec;
        border-color: rgba(255, 255, 255, 0.08);
    }

    body.dark-mode .badge-live,
    body.dark-mode .badge-status {
        background: rgba(25, 135, 84, 0.22);
        color: #dfffe9;
    }

    body.dark-mode .table .btn-outline-dark {
        color: #f8fbf9;
        border-color: rgba(255, 255, 255, 0.3);
    }

    body.dark-mode .table .btn-outline-dark:hover {
        background: rgba(255, 255, 255, 0.15);
        color: #0b0f0c;
    }

    body.dark-mode .text-muted {
        color: #c8d5cd !important;
    }

    body:not(.aos-ready) [data-aos] {
        opacity: 1;
        transform: none;
    }

    a {
        text-decoration: none;
    }

    .sidebar {
        position: fixed;
        top: 0;
        left: 0;
        bottom: 0;
        width: 260px;
        background: rgba(17, 26, 21, 0.92);
        color: #f0fff6;
        padding: 2rem 1.5rem;
        z-index: 1030;
        box-shadow: 10px 0 30px rgba(8, 12, 10, 0.4);
        backdrop-filter: blur(18px);
        transition: all 0.3s ease;
    }

    .sidebar-header {
        font-size: 1.5rem;
        font-weight: 700;
        text-align: center;
        margin-bottom: 2.5rem;
        color: #fff;
    }

    .sidebar-header span {
        color: var(--admin-primary);
    }

    .nav h6 {
        color: rgba(255, 255, 255, 0.55);
        letter-spacing: 0.08em;
        font-size: 0.7rem;
        text-transform: uppercase;
        margin: 1.25rem 0 0.6rem;
    }

    .sidebar .nav-link {
        display: flex;
        align-items: center;
        padding: 0.75rem 1rem;
        color: #adb5bd;
        border-radius: 8px;
        margin-bottom: 0.5rem;
        transition: background-color 0.2s ease, color 0.2s ease, transform 0.2s;
    }

    .sidebar .nav-link .icon {
        margin-right: 0.75rem;
        font-size: 1.1rem;
    }

    .sidebar .nav-link:hover {
        background-color: rgba(255, 255, 255, 0.08);
        color: #fff;
        transform: translateX(6px);
    }

    .sidebar .nav-link.active {
        background-color: var(--admin-primary);
        color: #fff;
        font-weight: 600;
        box-shadow: 0 12px 25px rgba(25, 135, 84, 0.35);
    }

    .topbar {
        position: fixed;
        top: 0;
        left: 260px;
        right: 0;
        height: 70px;
        background-color: #fff;
        border-bottom: 1px solid rgba(25, 135, 84, 0.08);
        padding: 0 2rem;
        display: flex;
        align-items: center;
        justify-content: space-between;
        z-index: 1020;
        transition: all 0.3s ease;
        box-shadow: 0 10px 30px rgba(15, 28, 22, 0.08);
    }

    .topbar .navbar-toggler {
        display: none;
        border: 0;
        background: transparent;
        color: var(--admin-primary);
    }

    .topbar-actions {
        display: flex;
        align-items: center;
        gap: 0.75rem;
    }

    .icon-btn {
        width: 40px;
        height: 40px;
        border-radius: 12px;
        border: 1px solid rgba(25, 135, 84, 0.25);
        background: #fff;
        color: var(--admin-primary);
        display: inline-flex;
        align-items: center;
        justify-content: center;
        transition: all 0.2s ease;
    }

    .icon-btn:hover {
        background: var(--admin-primary);
        color: #fff;
        box-shadow: 0 12px 20px rgba(25, 135, 84, 0.3);
    }

    .main-content {
        margin-top: 70px;
        padding: 2.5rem 3rem 3rem;
        min-height: 100vh;
        width: 100%;
        max-width: 100vw;
        position: relative;
        z-index: 1;
        overflow: visible;
    }

    @media (min-width: 992px) {
        .main-content {
            margin-left: 260px;
            width: calc(100% - 260px);
        }
    }

    .page-header {
        background: var(--surface-card);
        border-radius: 18px;
        padding: 2rem;
        margin-bottom: 1.75rem;
        border: 1px solid var(--border-subtle);
        box-shadow: var(--shadow-soft);
    }

    .page-title {
        font-weight: 700;
        font-size: 1.75rem;
    }

    .badge-live {
        background: var(--admin-primary-soft);
        color: var(--admin-primary);
        border-radius: 999px;
        padding: 0.25rem 0.85rem;
        font-weight: 600;
        font-size: 0.85rem;
    }

    .hero-actions {
        display: flex;
        flex-wrap: wrap;
        gap: 0.5rem;
    }

    .btn-soft-primary {
        background: linear-gradient(120deg, var(--admin-primary), #34c38f);
        color: #fff;
        border: none;
        box-shadow: 0 12px 30px rgba(25, 135, 84, 0.2);
    }

    .btn-soft-secondary {
        background: var(--surface-muted);
        color: #1c1f1c;
        border: 1px solid var(--border-subtle);
    }

    .btn-ghost {
        border: 1px solid rgba(16, 24, 40, 0.12);
        background: transparent;
        color: #101828;
    }

    .btn-soft-primary:hover,
    .btn-soft-secondary:hover,
    .btn-ghost:hover {
        transform: translateY(-1px);
        box-shadow: 0 18px 35px rgba(25, 135, 84, 0.15);
    }

    .stat-card {
        position: relative;
        background: var(--surface-card);
        border-radius: 20px;
        padding: 1.6rem;
        border: 1px solid rgba(16, 24, 40, 0.05);
        box-shadow: var(--shadow-soft);
        overflow: hidden;
        transition: transform 0.3s ease, box-shadow 0.3s ease;
    }

    .stat-card::after {
        content: '';
        position: absolute;
        inset: 0;
        background: radial-gradient(circle at top right, rgba(25, 135, 84, 0.18), transparent 55%);
        opacity: 0.9;
        pointer-events: none;
    }

    .stat-card:hover {
        transform: translateY(-6px);
        box-shadow: 0 22px 45px rgba(25, 135, 84, 0.18);
    }

    .stat-icon {
        width: 44px;
        height: 44px;
        border-radius: 14px;
        background: var(--admin-primary-soft);
        color: var(--admin-primary);
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.3rem;
    }

    .stat-card h6 {
        font-size: 0.95rem;
        color: var(--text-muted);
        font-weight: 600;
    }

    .stat-value {
        font-size: 2rem;
        font-weight: 700;
        margin-bottom: 0.25rem;
    }

    .stat-meta {
        font-size: 0.85rem;
        color: var(--text-muted);
    }

    .filter-card {
        background: var(--surface-card);
        border-radius: 18px;
        padding: 1.5rem;
        border: 1px solid var(--border-subtle);
        box-shadow: var(--shadow-soft);
        margin-bottom: 1.5rem;
        position: relative;
        z-index: 1;
    }

    .filter-bar {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
        gap: 0.75rem;
    }

    .input-icon {
        position: relative;
    }

    .input-icon .form-control,
    .input-icon .form-select {
        border-radius: 12px;
        border: 1px solid var(--border-subtle);
        padding-left: 2.4rem;
        height: 46px;
        box-shadow: none;
    }

    .input-icon i {
        position: absolute;
        top: 50%;
        left: 0.9rem;
        transform: translateY(-50%);
        color: var(--text-muted);
    }

    .table-card {
        background: linear-gradient(180deg, var(--surface-card) 0%, #f0f5f0 100%);
        border-radius: 22px;
        border: 1px solid rgba(16, 24, 40, 0.08);
        box-shadow: var(--shadow-soft);
        padding: 1.75rem;
        margin-bottom: 2rem;
        display: block;
        position: relative;
        z-index: 2;
        overflow: visible;
    }

    .table-card h5 {
        font-weight: 600;
    }

    .table-card .table-responsive {
        border-radius: 14px;
        overflow-x: auto;
        overflow-y: visible;
        -webkit-overflow-scrolling: touch;
    }

    .table-card .table-responsive::-webkit-scrollbar {
        height: 6px;
    }

    .table-card .table-responsive::-webkit-scrollbar-thumb {
        background: rgba(25, 135, 84, 0.35);
        border-radius: 999px;
    }

    table thead th {
        font-size: 0.85rem;
        letter-spacing: 0.05em;
        text-transform: uppercase;
        color: var(--text-muted);
        border-bottom: 1px solid var(--border-subtle);
        background: var(--surface-muted);
        white-space: nowrap;
    }

    table tbody td {
        vertical-align: middle;
        border-color: rgba(16, 24, 40, 0.035);
    }

    table tbody tr:hover {
        background: rgba(25, 135, 84, 0.04);
    }

    .badge-status {
        border-radius: 999px;
        padding: 0.35rem 0.9rem;
        font-weight: 600;
        font-size: 0.85rem;
        text-transform: capitalize;
    }

    .badge-status.bg-success-subtle {
        background: rgba(25, 135, 84, 0.18) !important;
        color: #198754 !important;
    }

    .badge-status.bg-warning-subtle {
        background: rgba(255, 193, 7, 0.18) !important;
        color: #b58102 !important;
    }

    .btn-table {
        border-radius: 10px;
        padding: 0.35rem 0.85rem;
        font-weight: 500;
    }

    .btn-outline-dark {
        border-color: rgba(16, 24, 40, 0.15);
        color: #101828;
    }

    .rating-stars {
        color: #f7b731;
        font-size: 1rem;
        letter-spacing: 0.15rem;
    }

    .comment-snippet {
        max-width: 320px;
    }

    .insight-list .list-group-item {
        background: transparent;
        border-color: rgba(25, 135, 84, 0.12);
        border-radius: 18px;
        margin-bottom: 0.75rem;
    }

    .insight-block {
        background: rgba(255, 255, 255, 0.75);
        border-radius: 18px;
        border: 1px solid rgba(16, 24, 40, 0.08);
        padding: 1.1rem 1.25rem;
        height: 100%;
    }

    .pagination .page-link {
        border: none;
        margin: 0 0.2rem;
        border-radius: 999px;
        padding: 0.45rem 1rem;
    }

    .pagination .page-item.active .page-link {
        background: var(--admin-primary);
        color: #fff;
        box-shadow: 0 8px 20px rgba(25, 135, 84, 0.2);
    }

    .backdrop {
        position: fixed;
        inset: 0;
        background: rgba(15, 23, 15, 0.45);
        z-index: 1025;
    }

    @media (max-width: 1199.98px) {
        .main-content {
            padding: 2rem;
        }
    }

    @media (max-width: 991.98px) {
        .sidebar {
            transform: translateX(-100%);
        }

        .sidebar.active {
            transform: translateX(0);
        }

        .topbar {
            left: 0;
            padding: 0 1.25rem;
        }

        .topbar .navbar-toggler {
            display: block;
        }

        .main-content {
            margin-left: 0;
            padding: 1.75rem 1.25rem 2.5rem;
            width: 100%;
        }

        .table-card .table {
            min-width: 1080px;
        }
    }

    @media (max-width: 575.98px) {
        .page-header,
        .filter-card,
        .table-card {
            padding: 1.25rem;
        }

        .table-card {
            margin-bottom: 1.25rem;
        }

        .hero-actions .btn {
            flex: 1 1 100%;
        }

        .table-responsive {
            overflow-x: auto;
        }
    }
    </style>
</head>
<body>
    <?= view('admin/partials/sidebar', ['active' => $active ?? 'feedback']) ?>
    <?= view('admin/partials/topbar', ['showDarkToggle' => true, 'userRole' => 'Experience Ops']) ?>

    <main class="main-content" id="main-content">
        <section class="hero-panel mb-4" data-aos="fade-up">
            <span class="badge-soft"><i class="bi bi-chat-left-heart"></i> Listening Hub</span>
            <div class="row align-items-center mt-3 g-4">
                <div class="col-lg-7">
                    <h1 class="h3 mb-3">Customer Feedback Pulse</h1>
                    <p class="text-muted mb-4">Track every voice, prioritize escalations, and celebrate promoters from a single high-trust workspace.</p>
                    <div class="d-flex flex-wrap gap-2">
                        <button type="button" class="btn btn-outline-success" data-feedback-filters-reset><i class="bi bi-funnel me-2"></i>Filter Insights</button>
                        <a href="<?= site_url('admin/feedback/export') ?>" class="btn btn-outline-secondary"><i class="bi bi-cloud-download me-2"></i>Export CSV</a>
            
                    </div>
                </div>
                <div class="col-lg-5">
                    <div class="hero-metrics">
                        <div class="hero-metric">
                            <span>Avg. Rating</span>
                            <h3 class="mb-0"><?= esc(number_format($avgRating, 1)) ?></h3>
                            <small>Out of 5</small>
                        </div>
                        <div class="hero-metric">
                            <span>Forwarded</span>
                            <h3 class="mb-0"><?= esc($forwardedCount) ?></h3>
                            <small>Escalated to teams</small>
                        </div>
                        <div class="hero-metric">
                            <span>Pending</span>
                            <h3 class="mb-0"><?= esc($pendingCount) ?></h3>
                            <small>Awaiting action</small>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <div class="row g-4 mb-4">
            <div class="col-sm-6 col-xl-4" data-aos="fade-up">
                <div class="stat-card">
                    <div class="d-flex align-items-center justify-content-between">
                        <div>
                            <p class="text-muted small mb-1">Total Responses</p>
                            <p class="fs-4 fw-bold mb-0"><?= esc(number_format($totalFeedback)) ?></p>
                            <span class="text-success small">Live sync enabled</span>
                        </div>
                        <div class="icon"><i class="bi bi-archive-fill"></i></div>
                    </div>
                </div>
            </div>
            <div class="col-sm-6 col-xl-4" data-aos="fade-up" data-aos-delay="60">
                <div class="stat-card">
                    <div class="d-flex align-items-center justify-content-between">
                        <div>
                            <p class="text-muted small mb-1">Promoter Score</p>
                            <p class="fs-4 fw-bold mb-0"><?= esc(number_format($avgRating * 20, 0)) ?>%</p>
                            <span class="text-primary small">Smiles delivered</span>
                        </div>
                        <div class="icon"><i class="bi bi-star-half"></i></div>
                    </div>
                </div>
            </div>
            <div class="col-sm-6 col-xl-4" data-aos="fade-up" data-aos-delay="120">
                <div class="stat-card">
                    <div class="d-flex align-items-center justify-content-between">
                        <div>
                            <p class="text-muted small mb-1">Forwarding Rate</p>
                            <?php $forwardRate = $totalFeedback ? ($forwardedCount / $totalFeedback) * 100 : 0; ?>
                            <p class="fs-4 fw-bold mb-0"><?= esc(number_format($forwardRate, 0)) ?>%</p>
                            <span class="text-warning small">Need triage</span>
                        </div>
                        <div class="icon"><i class="bi bi-send-check"></i></div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row g-4">
            <div class="col-12" data-aos="fade-up">
                <div class="table-wrapper">
                    <div class="d-flex flex-wrap justify-content-between align-items-center gap-3 mb-3">
                        <div>
                            <h3 class="h5 mb-1">Feedback Inbox</h3>
                            <p class="text-muted small mb-0">Sorted chronologically with escalation context.</p>
                        </div>
                        <div class="d-flex filter-bar gap-2">
                            <input type="text" class="form-control" placeholder="Search name or phone" data-feedback-search>
                            <select class="form-select" data-feedback-rating>
                                <option value="">Rating</option>
                                <option value="5">5 stars</option>
                                <option value="4">4 stars</option>
                                <option value="3">3 stars</option>
                                <option value="2">2 stars</option>
                                <option value="1">1 star</option>
                                <option value="0">0 stars</option>
                            </select>
                            <select class="form-select" data-feedback-forwarded>
                                <option value="">Forwarded</option>
                                <option value="yes">Forwarded</option>
                                <option value="no">Pending</option>
                            </select>
                        </div>
                    </div>
                    <div class="table-responsive">
                        <table class="table align-middle table-hover mb-0" data-feedback-table>
                            <thead class="table-light">
                                <tr>
                                    <th>S. No.</th>
                                    <th>Name</th>
                                    <th>Phone Number</th>
                                    <th>Rating</th>
                                    <th>Comment</th>
                                    <th>Forwarded</th>
                                    <th>Date</th>
                                    <th class="text-end">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if (empty($feedbackEntries)): ?>
                                    <tr>
                                        <td colspan="8" class="text-center text-muted fst-italic">No feedback entries available yet.</td>
                                    </tr>
                                <?php else: ?>
                                    <?php foreach ($feedbackEntries as $index => $entry): ?>
                                        <?php
                                            $isForwarded   = ! empty($entry['forwarded']);
                                            $badgeClass    = $isForwarded ? 'bg-success-subtle text-success' : 'bg-warning-subtle text-warning';
                                            $dateLabel     = ! empty($entry['created_at']) ? date('d M Y, h:i A', strtotime($entry['created_at'])) : 'N/A';
                                            $ratingValue   = (int) ($entry['rating'] ?? 0);
                                            $forwardedFlag = $isForwarded ? 'yes' : 'no';
                                            $searchHaystack = strtolower(trim(
                                                ($entry['name'] ?? '') . ' ' .
                                                ($entry['phone'] ?? '') . ' ' .
                                                ($entry['comment'] ?? '')
                                            ));
                                            $viewPayload = json_encode([
                                                'Name'       => $entry['name'] ?? 'Unknown',
                                                'Phone'      => $entry['phone'] ?? 'N/A',
                                                'Rating'     => $ratingValue . '/5',
                                                'Forwarded'  => $isForwarded ? 'Yes' : 'No',
                                                'Comment'    => $entry['comment'] ?? 'No comment shared yet.',
                                                'Submitted'  => $dateLabel,
                                            ], JSON_HEX_TAG | JSON_HEX_APOS | JSON_HEX_QUOT | JSON_HEX_AMP);
                                        ?>
                                        <tr
                                            data-feedback-row
                                            data-feedback-search="<?= esc($searchHaystack) ?>"
                                            data-feedback-rating="<?= esc((string) $ratingValue) ?>"
                                            data-feedback-forwarded="<?= esc($forwardedFlag) ?>"
                                        >
                                            <td><?= esc($index + 1) ?></td>
                                            <td><?= esc($entry['name'] ?? 'Unknown') ?></td>
                                            <td><?= esc($entry['phone'] ?? '—') ?></td>
                                            <td><span class="rating-stars"><?= $renderStars($ratingValue) ?></span></td>
                                            <td class="comment-snippet"><?= esc($entry['comment'] ?? 'No comment shared yet.') ?></td>
                                            <td><span class="badge <?= $badgeClass ?>"><?= $isForwarded ? 'Yes' : 'No' ?></span></td>
                                            <td><?= esc($dateLabel) ?></td>
                                            <td class="text-end">
                                                <div class="d-inline-flex justify-content-end gap-1">
                                                    <button type="button" class="btn btn-sm btn-outline-secondary js-feedback-view" data-feedback='<?= esc($viewPayload, 'attr') ?>'>
                                                        <i class="bi bi-eye"></i> View
                                                    </button>
                                                    <?php if ($isForwarded): ?>
                                                        <span class="d-inline-flex" data-bs-toggle="tooltip" data-bs-placement="bottom" title="This response has already been routed to the right team">
                                                            <button type="button" class="btn btn-sm btn-success" disabled aria-disabled="true">
                                                                <i class="bi bi-send-check"></i> Forwarded
                                                            </button>
                                                        </span>
                                                    <?php else: ?>
                                                        <span class="d-inline-flex" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Forwarding automation will activate once the CRM integration is live">
                                                            <button type="button" class="btn btn-sm btn-outline-success" disabled aria-disabled="true">
                                                                <i class="bi bi-send"></i> Mark Forwarded
                                                            </button>
                                                        </span>
                                                    <?php endif; ?>
                                                </div>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                    <tr class="text-center text-muted fst-italic d-none" data-empty-row>
                                        <td colspan="8">No feedback entries match the selected filters.</td>
                                    </tr>
                                <?php endif; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <div class="row g-4 mt-1">
            <div class="col-xl-5" data-aos="fade-up">
                <div class="feedback-highlights h-100">
                    <div class="d-flex justify-content-between mb-3">
                        <div>
                            <h5 class="mb-1">Escalation Queue</h5>
                            <p class="text-muted small mb-0">Pending attention</p>
                        </div>
                        <span class="badge bg-warning-subtle text-warning"><?= esc($pendingCount) ?> open</span>
                    </div>
                    <ul class="list-group list-unstyled mb-0">
                        <?php
                        $pendingEntries = array_filter($feedbackEntries, static fn ($entry) => empty($entry['forwarded']));
                        if (empty($pendingEntries)):
                        ?>
                            <li class="text-muted fst-italic">All caught up—no pending escalations 🎉</li>
                        <?php else: ?>
                            <?php foreach ($pendingEntries as $entry): ?>
                                <li class="list-group-item d-flex align-items-start justify-content-between">
                                    <div>
                                        <strong><?= esc($entry['name'] ?? 'Unknown') ?></strong>
                                        <p class="text-muted small mb-0">Rated <?= esc($entry['rating'] ?? '—') ?>/5 • <?= esc($entry['phone'] ?? 'N/A') ?></p>
                                    </div>
                                    <span class="badge bg-secondary-subtle text-secondary">Awaiting</span>
                                </li>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </ul>
                </div>
            </div>
            <div class="col-xl-7" data-aos="fade-up" data-aos-delay="80">
                <div class="glass-card h-100">
                        <div class="d-flex justify-content-between align-items-center mb-3">
                            <div>
                                <h5 class="mb-1">Recent Highlights</h5>
                                <p class="text-muted small mb-0">Signals worth amplifying</p>
                            </div>
                            <span class="small text-muted" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Analytics deep-dive will be linked once the reporting workspace ships">Insights dashboard in progress</span>
                        </div>
                    <div class="row g-3">
                        <div class="col-md-6">
                            <div class="p-3 border rounded-4 h-100">
                                <p class="text-muted small mb-1">Most loved experience</p>
                                <h6 class="mb-2">Agent empathy</h6>
                                <p class="mb-0 text-muted small">47% of comments applaud on-ground empathy shown by partner agents.</p>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="p-3 border rounded-4 h-100">
                                <p class="text-muted small mb-1">Top follow-up ask</p>
                                <h6 class="mb-2">Faster document updates</h6>
                                <p class="mb-0 text-muted small">28% of detractors mentioned delays in sharing next-step paperwork.</p>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="p-3 border rounded-4 h-100">
                                <p class="text-muted small mb-1">Regional spotlight</p>
                                <h6 class="mb-2">Gurugram</h6>
                                <p class="mb-0 text-muted small">Consistent 4.8 rating this week with zero escalations.</p>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="p-3 border rounded-4 h-100">
                                <p class="text-muted small mb-1">Focus this sprint</p>
                                <h6 class="mb-2">Drive proactive callbacks</h6>
                                <p class="mb-0 text-muted small">Trigger workflows for all detractors within 2 business hours.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <div id="sidebar-backdrop" class="backdrop d-none"></div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/aos@2.3.4/dist/aos.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.10.0/dist/sweetalert2.all.min.js"></script>
    <script>
    (() => {
        'use strict';
        document.addEventListener('DOMContentLoaded', () => {
            const body = document.body;
            const sidebar = document.getElementById('admin-sidebar');
            const toggler = document.getElementById('sidebar-toggler');
            const backdrop = document.getElementById('sidebar-backdrop');
            const darkToggle = document.getElementById('dark-mode-toggle');
            const THEME_KEY = 'adminTheme';

            const applyTheme = (mode = 'light') => {
                body.classList.toggle('dark-mode', mode === 'dark');
                localStorage.setItem(THEME_KEY, mode);
            };
            applyTheme(localStorage.getItem(THEME_KEY) || 'light');

            darkToggle?.addEventListener('click', () => {
                applyTheme(body.classList.contains('dark-mode') ? 'light' : 'dark');
            });

            const showBackdrop = () => {
                if (!backdrop) return;
                backdrop.classList.remove('d-none');
                backdrop.classList.add('visible');
            };
            const hideBackdrop = () => {
                if (!backdrop) return;
                backdrop.classList.remove('visible');
                backdrop.classList.add('d-none');
            };
            const closeSidebar = () => {
                sidebar?.classList.remove('active');
                hideBackdrop();
            };

            toggler?.addEventListener('click', () => {
                const opened = sidebar?.classList.toggle('active');
                if (opened) {
                    showBackdrop();
                } else {
                    hideBackdrop();
                }
            });
            backdrop?.addEventListener('click', closeSidebar);
            window.addEventListener('resize', () => window.innerWidth >= 992 && closeSidebar());
            document.addEventListener('keydown', event => {
                if (event.key === 'Escape') {
                    closeSidebar();
                }
            });

            document.querySelectorAll('.stat-card').forEach(card => {
                card.addEventListener('mousemove', event => {
                    const rect = card.getBoundingClientRect();
                    card.style.setProperty('--mouse-x', `${event.clientX - rect.left}px`);
                    card.style.setProperty('--mouse-y', `${event.clientY - rect.top}px`);
                });
                card.addEventListener('mouseleave', () => {
                    card.style.removeProperty('--mouse-x');
                    card.style.removeProperty('--mouse-y');
                });
            });

            window.AOS?.init({
                duration: 650,
                once: true,
                offset: 80,
                easing: 'ease-out-quart'
            });

            const initTooltips = () => {
                if (!window.bootstrap?.Tooltip) {
                    return;
                }
                const tooltipElements = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
                tooltipElements.forEach(el => {
                    try {
                        new bootstrap.Tooltip(el);
                    } catch (error) {
                        console.warn('Unable to initialize tooltip', error);
                    }
                });
            };

            const feedbackTable = document.querySelector('[data-feedback-table]');
            const searchInput = document.querySelector('[data-feedback-search]');
            const ratingSelect = document.querySelector('[data-feedback-rating]');
            const forwardedSelect = document.querySelector('[data-feedback-forwarded]');
            const resetButton = document.querySelector('[data-feedback-filters-reset]');

            if (feedbackTable) {
                const rows = Array.from(feedbackTable.querySelectorAll('tbody tr[data-feedback-row]'));
                const emptyRow = feedbackTable.querySelector('[data-empty-row]');

                const applyFilters = () => {
                    const searchTerm = (searchInput?.value || '').trim().toLowerCase();
                    const ratingFilter = (ratingSelect?.value || '').trim();
                    const forwardedFilter = (forwardedSelect?.value || '').trim();

                    let shown = 0;
                    rows.forEach(row => {
                        const matchesSearch = !searchTerm || (row.dataset.feedbackSearch || '').includes(searchTerm);
                        const matchesRating = !ratingFilter || (row.dataset.feedbackRating || '') === ratingFilter;
                        const matchesForwarded = !forwardedFilter || (row.dataset.feedbackForwarded || '') === forwardedFilter;
                        const visible = matchesSearch && matchesRating && matchesForwarded;
                        row.classList.toggle('d-none', !visible);
                        if (visible) {
                            shown += 1;
                        }
                    });

                    if (emptyRow) {
                        emptyRow.classList.toggle('d-none', shown !== 0);
                    }
                };

                searchInput?.addEventListener('input', applyFilters);
                ratingSelect?.addEventListener('change', applyFilters);
                forwardedSelect?.addEventListener('change', applyFilters);
                resetButton?.addEventListener('click', () => {
                    if (searchInput) {
                        searchInput.value = '';
                    }
                    if (ratingSelect) {
                        ratingSelect.value = '';
                    }
                    if (forwardedSelect) {
                        forwardedSelect.value = '';
                    }
                    applyFilters();
                    searchInput?.focus();
                });

                applyFilters();
            }

            const bindViewHandlers = () => {
                if (!window.Swal) {
                    console.error('SweetAlert2 is required for viewing feedback details.');
                    return;
                }

                const escapeHtml = value => String(value ?? '').replace(/[&<>"']/g, char => ({
                    '&': '&amp;',
                    '<': '&lt;',
                    '>': '&gt;',
                    '"': '&quot;',
                    "'": '&#39;',
                })[char] || char);

                document.querySelectorAll('.js-feedback-view').forEach(button => {
                    button.addEventListener('click', () => {
                        let payload = null;
                        if (button.dataset.feedback) {
                            try {
                                payload = JSON.parse(button.dataset.feedback);
                            } catch (parseError) {
                                console.error('Unable to parse feedback payload', parseError);
                                payload = null;
                            }
                        }
                        if (!payload) {
                            return;
                        }

                        const rows = Object.entries(payload)
                            .map(([label, value]) => `<tr><th class="text-start text-muted">${escapeHtml(label)}</th><td class="text-start">${escapeHtml(value)}</td></tr>`)
                            .join('');

                        Swal.fire({
                            title: 'Feedback details',
                            html: `<div class="table-responsive"><table class="table table-sm">${rows}</table></div>`,
                            confirmButtonText: 'Close',
                            width: 600,
                            focusConfirm: false,
                        });
                    });
                });
            };

            initTooltips();
            bindViewHandlers();
        });
    })();
    </script>
</body>
</html>
