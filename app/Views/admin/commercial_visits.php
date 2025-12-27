<?php
$page_title = $page_title ?? 'Commercial Visits - Admin - 36 Broking Hub';
$allowedStatus = $allowedStatus ?? ['pending', 'in_progress', 'closed'];
$allowedPriority = $allowedPriority ?? ['normal', 'high'];
$filters = $filters ?? ['status' => null, 'priority' => null];
$metrics = $metrics ?? ['total' => 0, 'pending' => 0, 'in_progress' => 0, 'closed' => 0, 'highPriority' => 0];
$activeVisits = (int) (($metrics['pending'] ?? 0) + ($metrics['in_progress'] ?? 0));
$closureRate = ($metrics['total'] ?? 0) > 0
    ? (int) round((($metrics['closed'] ?? 0) / max(1, $metrics['total'])) * 100)
    : 0;
$highPriorityLoad = ($metrics['total'] ?? 0) > 0
    ? (int) round((($metrics['highPriority'] ?? 0) / max(1, $metrics['total'])) * 100)
    : 0;
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <?php include 'assets/includes/seo-meta.php'; ?>
    <meta name="csrf-token-name" content="<?= csrf_token() ?>">
    <meta name="csrf-token-value" content="<?= csrf_hash() ?>">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="icon" type="image/x-icon" href="<?= base_url('images/favicon/favicon.ico') ?>">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/aos@2.3.4/dist/aos.css">
    <title><?= esc($page_title) ?></title>
    <?= view('admin/partials/layout-styles') ?>
    <?= view('admin/partials/dashboard-theme') ?>
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
    body.dark-mode .status-badge,
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

    .hero-panel {
        background: linear-gradient(135deg, rgba(25, 135, 84, 0.28), rgba(25, 135, 84, 0.08));
        border-radius: 32px;
        padding: 2rem 2.4rem;
        box-shadow: var(--shadow-soft);
        position: relative;
        overflow: hidden;
        border: 1px solid rgba(25, 135, 84, 0.18);
    }

    .hero-panel::after {
        content: '';
        position: absolute;
        top: -40%;
        right: -10%;
        width: 320px;
        height: 320px;
        background: radial-gradient(circle, rgba(255, 255, 255, 0.45), transparent 65%);
        opacity: 0.7;
        z-index: 0;
    }

    .hero-panel > * {
        position: relative;
        z-index: 1;
    }

    .hero-panel .badge-soft {
        display: inline-flex;
        align-items: center;
        gap: 0.35rem;
        padding: 0.35rem 0.85rem;
        border-radius: 999px;
        background: rgba(255, 255, 255, 0.2);
        color: #fff;
        text-transform: uppercase;
        letter-spacing: 0.08em;
        font-size: 0.72rem;
    }

    .quick-actions .btn {
        border-radius: 14px;
        padding: 0.65rem 1.6rem;
        font-weight: 600;
        border-width: 1.5px;
        transition: transform 0.2s ease, box-shadow 0.2s ease;
    }

    .quick-actions .btn:hover {
        transform: translateY(-2px);
        box-shadow: var(--shadow-soft);
    }

    .btn-brand {
        background: var(--admin-primary);
        border-color: var(--admin-primary);
        color: #fff;
    }

    .btn-brand:hover {
        background: #146c43;
        border-color: #146c43;
    }

    .hero-metrics {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(140px, 1fr));
        gap: 1rem;
    }

    .hero-metric {
        background: rgba(255, 255, 255, 0.2);
        border-radius: 18px;
        padding: 1rem;
        color: #000000ff;
        backdrop-filter: blur(16px);
    }

    .hero-metric span {
        font-size: 0.85rem;
        opacity: 0.85;
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

    .filter-actions {
        margin-top: 1rem;
        display: flex;
        justify-content: flex-end;
        flex-wrap: wrap;
        gap: 0.75rem;
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
        margin-top: 1.75rem;
        display: block;
        position: relative;
        z-index: 2;
        overflow: visible;
    }

    .table-card h5 {
        font-weight: 600;
    }

    .table-responsive {
        border-radius: 14px;
        overflow-x: auto;
        overflow-y: visible;
        -webkit-overflow-scrolling: touch;
    }

    .table-scroll {
        scrollbar-width: thin;
        scrollbar-color: rgba(25, 135, 84, 0.35) transparent;
        scroll-behavior: smooth;
    }

    .table-scroll::-webkit-scrollbar {
        height: 6px;
    }

    .table-scroll::-webkit-scrollbar-thumb {
        background: rgba(25, 135, 84, 0.35);
        border-radius: 999px;
    }

    .table-scroll::-webkit-scrollbar-track {
        background: transparent;
    }

    table thead th {
        font-size: 0.85rem;
        letter-spacing: 0.05em;
        text-transform: uppercase;
        color: var(--text-muted);
        border-bottom: 1px solid var(--border-subtle);
        background: var(--surface-muted);
    }

    table tbody td {
        vertical-align: middle;
        border-color: rgba(16, 24, 40, 0.035);
    }

    table tbody tr:hover {
        background: rgba(25, 135, 84, 0.04);
    }

    .status-badge,
    .badge-status,
    .badge-priority {
        border-radius: 999px;
        padding: 0.35rem 0.9rem;
        font-weight: 600;
        font-size: 0.85rem;
        text-transform: capitalize;
    }

    .badge-status.pending {
        background: rgba(255, 193, 7, 0.18);
        color: #b58102;
    }

    .badge-status.contacted {
        background: rgba(13, 110, 253, 0.16);
        color: #0d6efd;
    }

    .badge-status.in_progress {
        background: rgba(13, 110, 253, 0.16);
        color: #0d6efd;
    }

    .badge-status.converted {
        background: rgba(25, 135, 84, 0.12);
        color: var(--admin-primary);
    }

    .badge-status.closed {
        background: rgba(220, 53, 69, 0.15);
        color: #c21f32;
    }

    .badge-priority.high {
        background: rgba(220, 53, 69, 0.16);
        color: #dc3545;
    }

    .badge-priority.normal {
        background: rgba(108, 117, 125, 0.16);
        color: #6c757d;
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
        .main-content {
            margin-left: 0;
            padding: 1.75rem 1.25rem 2.5rem;
        }

        .table-wrapper .table {
            min-width: 960px;
        }

        .table-wrapper .table th,
        .table-wrapper .table td {
            white-space: nowrap;
        }

        .table-wrapper .table .text-break {
            white-space: normal;
        }

        .table-wrapper .table-responsive {
            overflow-x: auto;
            overflow-y: hidden;
        }
    }

    @media (max-width: 575.98px) {
        .hero-panel,
        .filter-card,
        .table-card {
            padding: 1.25rem;
        }

        .table-card {
            margin-top: 1.25rem;
        }

        .quick-actions .btn {
            flex: 1 1 100%;
        }

        .table-responsive {
            overflow-x: auto;
        }
    }
    </style>
</head>
<body>
    <?= view('admin/partials/sidebar', ['active' => 'commercial-visits']) ?>
    <?= view('admin/partials/topbar', ['showDarkToggle' => true, 'userRole' => 'Commercial Desk']) ?>

    <main class="main-content container-fluid" id="main-content">
        <section class="hero-panel mb-4" data-aos="fade-up">
            <span class="badge-soft"><i class="bi bi-buildings"></i> Commercial Desk</span>
            <div class="row align-items-center mt-3 g-4">
                <div class="col-lg-7">
                    <h1 class="h3 mb-3">Commercial Visit Requests</h1>
                    <p class="text-muted mb-4">Prioritise site walkthroughs, hit SLAs, and keep the conversion engine aligned with sales.</p>
                    <div class="quick-actions d-flex flex-wrap gap-2">
                        <a href="<?= current_url() ?>" class="btn btn-brand"><i class="bi bi-arrow-clockwise me-2"></i>Refresh queue</a>
                        <a href="<?= current_url() ?>?priority=high" class="btn btn-outline-secondary"><i class="bi bi-lightning-charge me-2"></i>High priority view</a>
                    </div>
                </div>
                <div class="col-lg-5">
                    <div class="hero-metrics">
                        <div class="hero-metric">
                            <span>Active visits</span>
                            <h3 class="mb-0"><?= esc(number_format($activeVisits)) ?></h3>
                            <small>Pending + In progress</small>
                        </div>
                        <div class="hero-metric">
                            <span>Closure rate</span>
                            <h3 class="mb-0"><?= esc($closureRate) ?>%</h3>
                            <small>Based on all time</small>
                        </div>
                        <div class="hero-metric">
                            <span>High priority load</span>
                            <h3 class="mb-0"><?= esc($highPriorityLoad) ?>%</h3>
                            <small>Of total requests</small>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section class="row g-4 mb-3">
            <div class="col-sm-6 col-xl-3" data-aos="fade-up">
                <div class="stat-card h-100">
                    <div class="d-flex justify-content-between align-items-start mb-3">
                        <h6>Total Requests</h6>
                        <div class="icon"><i class="bi bi-buildings"></i></div>
                    </div>
                    <div class="stat-value" data-metric="total"><?= esc(number_format($metrics['total'] ?? 0)) ?></div>
                    <div class="stat-meta text-success">All inbound enquiries</div>
                </div>
            </div>
            <div class="col-sm-6 col-xl-3" data-aos="fade-up" data-aos-delay="60">
                <div class="stat-card h-100">
                    <div class="d-flex justify-content-between align-items-start mb-3">
                        <h6>Pending</h6>
                        <div class="icon"><i class="bi bi-hourglass-split"></i></div>
                    </div>
                    <div class="stat-value" data-metric="pending"><?= esc(number_format($metrics['pending'] ?? 0)) ?></div>
                    <div class="stat-meta text-warning">Awaiting scheduling</div>
                </div>
            </div>
            <div class="col-sm-6 col-xl-3" data-aos="fade-up" data-aos-delay="120">
                <div class="stat-card h-100">
                    <div class="d-flex justify-content-between align-items-start mb-3">
                        <h6>In progress</h6>
                        <div class="icon"><i class="bi bi-arrow-repeat"></i></div>
                    </div>
                    <div class="stat-value" data-metric="in_progress"><?= esc(number_format($metrics['in_progress'] ?? 0)) ?></div>
                    <div class="stat-meta text-primary">Actively coordinated</div>
                </div>
            </div>
            <div class="col-sm-6 col-xl-3" data-aos="fade-up" data-aos-delay="180">
                <div class="stat-card h-100">
                    <div class="d-flex justify-content-between align-items-start mb-3">
                        <h6>Closed</h6>
                        <div class="icon"><i class="bi bi-patch-check"></i></div>
                    </div>
                    <div class="stat-value" data-metric="closed"><?= esc(number_format($metrics['closed'] ?? 0)) ?></div>
                    <div class="stat-meta text-success">Completed walk-throughs</div>
                </div>
            </div>
            <div class="col-sm-6 col-xl-3" data-aos="fade-up" data-aos-delay="240">
                <div class="stat-card h-100">
                    <div class="d-flex justify-content-between align-items-start mb-3">
                        <h6>High priority</h6>
                        <div class="icon"><i class="bi bi-lightning-charge"></i></div>
                    </div>
                    <div class="stat-value" data-metric="highPriority"><?= esc(number_format($metrics['highPriority'] ?? 0)) ?></div>
                    <div class="stat-meta text-danger">Escalated support</div>
                </div>
            </div>
        </section>

        <section class="filter-card" data-aos="fade-up" data-aos-delay="80">
            <form method="get" action="<?= current_url() ?>" class="w-100">
                <div class="d-flex flex-wrap justify-content-between align-items-center mb-3 gap-2">
                    <h5 class="mb-0">Visit Filters</h5>
                    <div class="d-flex gap-2 flex-wrap align-items-center">
                        <span class="badge-live px-3">Live sync</span>
                        <a href="<?= current_url() ?>" class="btn btn-link text-success p-0">Reset filters</a>
                    </div>
                </div>
                <div class="filter-bar">
                    <div class="input-icon">
                        <i class="bi bi-funnel"></i>
                        <select class="form-select" name="status" onchange="this.form.submit()">
                            <option value="">All</option>
                            <?php foreach ($allowedStatus as $statusOption): ?>
                                <option value="<?= esc($statusOption) ?>" <?= $filters['status'] === $statusOption ? 'selected' : '' ?>><?= ucwords(str_replace('_', ' ', $statusOption)) ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="input-icon">
                        <i class="bi bi-lightning-charge"></i>
                        <select class="form-select" name="priority" onchange="this.form.submit()">
                            <option value="">All</option>
                            <?php foreach ($allowedPriority as $priorityOption): ?>
                                <option value="<?= esc($priorityOption) ?>" <?= $filters['priority'] === $priorityOption ? 'selected' : '' ?>><?= ucfirst($priorityOption) ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                </div>
            </form>
        </section>

        <section class="table-wrapper" data-aos="fade-up" data-aos-delay="120">
            <div class="d-flex flex-wrap justify-content-between align-items-center gap-3 mb-3">
                <div>
                    <h5 class="mb-1">Visit pipeline</h5>
                    <p class="text-muted small mb-0">Insight across every schedule, contact, and follow-up.</p>
                </div>
                <span class="badge bg-success-light text-success px-3">Realtime</span>
            </div>
            <div class="table-responsive table-scroll">
                <table class="table align-middle table-hover mb-0">
                    <thead class="table-light">
                        <tr>
                            <th scope="col">Request</th>
                            <th scope="col">Contact</th>
                            <th scope="col">Requirement</th>
                            <th scope="col" class="text-center">Priority</th>
                            <th scope="col" class="text-center">Status</th>
                            <th scope="col" class="text-end">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (! empty($visits)): ?>
                            <?php foreach ($visits as $visit): ?>
                                <tr data-visit-row="<?= (int) $visit['id'] ?>">
                                    <td>
                                        <div class="fw-semibold"><?= esc($visit['full_name']) ?></div>
                                        <div class="text-muted small">Email: <a href="mailto:<?= esc($visit['email']) ?>"><?= esc($visit['email']) ?></a></div>
                                        <?php if (! empty($visit['created_at'])): ?>
                                            <div class="text-muted small">Logged <?= date('M d, Y H:i', strtotime($visit['created_at'])) ?></div>
                                        <?php endif; ?>
                                    </td>
                                    <td>
                                        <div class="text-muted small">Phone: <a href="tel:<?= esc($visit['phone']) ?>"><?= esc($visit['phone']) ?></a></div>
                                        <?php if (! empty($visit['follow_up_on'])): ?>
                                            <div class="text-muted small">Follow-up <?= date('M d, Y H:i', strtotime($visit['follow_up_on'])) ?></div>
                                        <?php endif; ?>
                                    </td>
                                    <td class="text-break">
                                        <p class="mb-1 small">Type: <?= esc($visit['requirement'] ?: '—') ?></p>
                                        <?php if (! empty($visit['message'])): ?>
                                            <p class="mb-0 small text-muted">“<?= esc($visit['message']) ?>”</p>
                                        <?php endif; ?>
                                        <?php if (! empty($visit['notes'])): ?>
                                            <p class="mb-0 small text-success">Notes: <?= esc($visit['notes']) ?></p>
                                        <?php endif; ?>
                                    </td>
                                    <td class="text-center">
                                        <span class="badge badge-priority <?= esc($visit['priority']) ?>"><?= ucfirst($visit['priority']) ?></span>
                                    </td>
                                    <td class="text-center">
                                        <span class="badge badge-status <?= esc($visit['status']) ?>"><?= ucwords(str_replace('_', ' ', $visit['status'])) ?></span>
                                    </td>
                                    <td class="text-end">
                                        <div class="d-flex flex-column gap-2 align-items-end">
                                            <div class="d-flex gap-2 justify-content-end">
                                                <select class="form-select form-select-sm" data-role="status-select" data-id="<?= (int) $visit['id'] ?>" style="min-width: 130px !important;">
                                                    <?php foreach ($allowedStatus as $statusOption): ?>
                                                        <option value="<?= esc($statusOption) ?>" <?= $visit['status'] === $statusOption ? 'selected' : '' ?>><?= ucwords(str_replace('_', ' ', $statusOption)) ?></option>
                                                    <?php endforeach; ?>
                                                </select>
                                                <select class="form-select form-select-sm" data-role="priority-select" data-id="<?= (int) $visit['id'] ?>" style="min-width: 110px !important;">
                                                    <?php foreach ($allowedPriority as $priorityOption): ?>
                                                        <option value="<?= esc($priorityOption) ?>" <?= $visit['priority'] === $priorityOption ? 'selected' : '' ?>><?= ucfirst($priorityOption) ?></option>
                                                    <?php endforeach; ?>
                                                </select>
                                                <button class="btn btn-brand btn-sm" data-role="save-visit" data-id="<?= (int) $visit['id'] ?>">
                                                    <i class="bi bi-check2"></i>
                                                </button>
                                                <button class="btn btn-outline-danger btn-sm" data-role="delete-visit" data-id="<?= (int) $visit['id'] ?>">
                                                <i class="bi bi-trash"></i>
                                            </button>
                                            </div>
                                            
                                        </div>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <tr>
                                <td colspan="6" class="text-center py-5">
                                    <p class="mb-1 fw-semibold">No commercial visit requests</p>
                                    <p class="text-muted mb-0">Submissions from the commercial page will appear here.</p>
                                </td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
            <?php $totalPages = $pager->getPageCount(); ?>
            <?php if ($totalPages > 1): ?>
                <?php $currentPage = $pager->getCurrentPage(); ?>
                <?php $previousUri = $pager->getPreviousPageURI(); ?>
                <?php $nextUri = $pager->getNextPageURI(); ?>
                <nav class="mt-3" aria-label="Commercial visits pagination">
                    <ul class="pagination justify-content-end mb-0">
                        <li class="page-item<?= $previousUri === null ? ' disabled' : '' ?>">
                            <?php if ($previousUri === null): ?>
                                <span class="page-link" aria-disabled="true" tabindex="-1">Previous</span>
                            <?php else: ?>
                                <a class="page-link" href="<?= esc($previousUri) ?>" rel="prev">Previous</a>
                            <?php endif; ?>
                        </li>
                        <?php for ($page = 1; $page <= $totalPages; $page++): ?>
                            <?php $isActive = ((int) $page === (int) $currentPage); ?>
                            <li class="page-item<?= $isActive ? ' active' : '' ?>">
                                <?php if ($isActive): ?>
                                    <span class="page-link"><?= $page ?></span>
                                <?php else: ?>
                                    <a class="page-link" href="<?= esc($pager->getPageURI($page)) ?>"><?= $page ?></a>
                                <?php endif; ?>
                            </li>
                        <?php endfor; ?>
                        <li class="page-item<?= $nextUri === null ? ' disabled' : '' ?>">
                            <?php if ($nextUri === null): ?>
                                <span class="page-link" aria-disabled="true">Next</span>
                            <?php else: ?>
                                <a class="page-link" href="<?= esc($nextUri) ?>" rel="next">Next</a>
                            <?php endif; ?>
                        </li>
                    </ul>
                </nav>
            <?php endif; ?>
        </section>
    </main>

    <div id="sidebar-backdrop" class="backdrop d-none"></div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/aos@2.3.4/dist/aos.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.10.0/dist/sweetalert2.all.min.js"></script>
    <script>
        (function () {
            'use strict';

            document.addEventListener('DOMContentLoaded', async function () {
                if (typeof Swal === 'undefined') {
                    console.error('SweetAlert2 is required but failed to load.');
                    return;
                }

                const tokenNameMeta = document.querySelector('meta[name="csrf-token-name"]');
                const tokenValueMeta = document.querySelector('meta[name="csrf-token-value"]');

                const body = document.body;
                const sidebar = document.getElementById('admin-sidebar');
                const toggler = document.getElementById('sidebar-toggler');
                const backdrop = document.getElementById('sidebar-backdrop');
                const darkToggle = document.getElementById('dark-mode-toggle');
                const THEME_KEY = 'adminTheme';

                const applyTheme = (mode) => {
                    body.classList.toggle('dark-mode', mode === 'dark');
                    localStorage.setItem(THEME_KEY, mode);
                };

                applyTheme(localStorage.getItem(THEME_KEY) || 'light');

                darkToggle?.addEventListener('click', () => {
                    applyTheme(body.classList.contains('dark-mode') ? 'light' : 'dark');
                });

                const showBackdrop = () => {
                    if (!backdrop) { return; }
                    backdrop.classList.remove('d-none');
                    backdrop.classList.add('visible');
                };

                const hideBackdrop = () => {
                    if (!backdrop) { return; }
                    backdrop.classList.remove('visible');
                    backdrop.classList.add('d-none');
                };

                const closeSidebar = () => {
                    sidebar?.classList.remove('active');
                    hideBackdrop();
                };

                toggler?.addEventListener('click', () => {
                    const isOpen = sidebar?.classList.toggle('active');
                    if (isOpen) {
                        showBackdrop();
                    } else {
                        hideBackdrop();
                    }
                });

                backdrop?.addEventListener('click', closeSidebar);
                window.addEventListener('resize', () => window.innerWidth >= 992 && closeSidebar());
                document.addEventListener('keydown', (event) => {
                    if (event.key === 'Escape') {
                        closeSidebar();
                    }
                });

                window.bootstrap?.Tooltip && Array.from(document.querySelectorAll('[data-bs-toggle="tooltip"]')).forEach((element) => {
                    new window.bootstrap.Tooltip(element);
                });

                window.AOS?.init({
                    once: true,
                    duration: 700,
                    offset: 80,
                    easing: 'ease-out-quart'
                });

                document.querySelectorAll('.stat-card').forEach((card) => {
                    card.addEventListener('mousemove', (event) => {
                        const bounds = card.getBoundingClientRect();
                        card.style.setProperty('--mouse-x', `${event.clientX - bounds.left}px`);
                        card.style.setProperty('--mouse-y', `${event.clientY - bounds.top}px`);
                    });
                    card.addEventListener('mouseleave', () => {
                        card.style.removeProperty('--mouse-x');
                        card.style.removeProperty('--mouse-y');
                    });
                });

                const updateCsrf = (payload) => {
                    if (!payload) { return; }
                    if (payload.csrfName) { tokenNameMeta.content = payload.csrfName; }
                    if (payload.csrfHash) { tokenValueMeta.content = payload.csrfHash; }
                };

                const showAlert = (options) => Swal.fire({
                    confirmButtonColor: '#198754',
                    cancelButtonColor: '#6c757d',
                    ...options,
                });

                const showSuccess = (message) => showAlert({
                    icon: 'success',
                    title: 'Success',
                    text: message,
                });

                const showError = (message) => showAlert({
                    icon: 'error',
                    title: 'Error',
                    text: message,
                });

                const confirmDelete = () => showAlert({
                    title: 'Delete this visit?',
                    text: 'This action cannot be undone.',
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonText: 'Yes, delete',
                    cancelButtonText: 'Cancel',
                });

                const numberFormatter = new Intl.NumberFormat();

                const refreshMetrics = (metrics) => {
                    if (!metrics) { return; }
                    Object.entries(metrics).forEach(([key, value]) => {
                        const target = document.querySelector(`[data-metric="${key}"]`);
                        if (target) {
                            const numeric = Number(value);
                            target.textContent = Number.isFinite(numeric) ? numberFormatter.format(numeric) : value;
                        }
                    });
                };

                const handleUpdate = async (id, payload) => {
                    try {
                        const response = await fetch(`<?= site_url('admin/commercial-visits') ?>/${id}/status`, {
                            method: 'POST',
                            headers: {
                                'X-Requested-With': 'XMLHttpRequest',
                                'Content-Type': 'application/x-www-form-urlencoded',
                            },
                            body: new URLSearchParams({
                                ...payload,
                                [tokenNameMeta.content]: tokenValueMeta.content,
                            }),
                        });

                        const data = await response.json();
                        updateCsrf(data);

                        if (!response.ok || data.success === false) {
                            await showError(data.message || 'Unable to update visit.');
                            return null;
                        }

                        await showSuccess(data.message || 'Visit updated successfully.');
                        refreshMetrics(data.metrics);
                        return data;
                    } catch (error) {
                        await showError(error.message || 'Unable to update visit.');
                        return null;
                    }
                };

                document.querySelectorAll('[data-role="save-visit"]').forEach((button) => {
                    button.addEventListener('click', async (event) => {
                        event.preventDefault();
                        const id = button.dataset.id;
                        const statusSelect = document.querySelector(`[data-role="status-select"][data-id="${id}"]`);
                        const prioritySelect = document.querySelector(`[data-role="priority-select"][data-id="${id}"]`);

                        const result = await handleUpdate(id, {
                            status: statusSelect?.value ?? '',
                            priority: prioritySelect?.value ?? '',
                        });

                        if (!result) { return; }

                        const statusValue = statusSelect?.value;
                        const statusBadge = document.querySelector(`[data-visit-row="${id}"] .badge-status`);
                        if (statusBadge && statusValue) {
                            const label = statusValue.replace('_', ' ').replace(/\b\w/g, (char) => char.toUpperCase());
                            statusBadge.textContent = label;
                            statusBadge.className = `badge badge-status ${statusValue}`;
                        }

                        const priorityValue = prioritySelect?.value;
                        const priorityBadge = document.querySelector(`[data-visit-row="${id}"] .badge-priority`);
                        if (priorityBadge && priorityValue) {
                            const label = priorityValue.charAt(0).toUpperCase() + priorityValue.slice(1);
                            priorityBadge.textContent = label;
                            priorityBadge.className = `badge badge-priority ${priorityValue}`;
                        }
                    });
                });

                document.querySelectorAll('[data-role="delete-visit"]').forEach((button) => {
                    button.addEventListener('click', async (event) => {
                        event.preventDefault();

                        const confirmation = await confirmDelete();
                        if (!confirmation.isConfirmed) { return; }

                        const id = button.dataset.id;

                        try {
                            const response = await fetch(`<?= site_url('admin/commercial-visits') ?>/${id}/delete`, {
                                method: 'POST',
                                headers: {
                                    'X-Requested-With': 'XMLHttpRequest',
                                    'Content-Type': 'application/x-www-form-urlencoded',
                                },
                                body: new URLSearchParams({
                                    [tokenNameMeta.content]: tokenValueMeta.content,
                                }),
                            });

                            const data = await response.json();
                            updateCsrf(data);

                            if (!response.ok || data.success === false) {
                                await showError(data.message || 'Unable to delete visit.');
                                return;
                            }

                            await showSuccess(data.message || 'Visit removed.');
                            refreshMetrics(data.metrics);
                            document.querySelector(`[data-visit-row="${id}"]`)?.remove();
                        } catch (error) {
                            await showError(error.message || 'Unable to delete visit.');
                        }
                    });
                });
            });
        })();
    </script>
</body>
</html>