<?php
$page_title = $page_title ?? 'Residential Leads - Admin - 11 Acer';
$allowedStatus = $allowedStatus ?? ['pending', 'contacted', 'converted', 'closed'];
$metrics = $metrics ?? ['total' => 0, 'pending' => 0, 'contacted' => 0, 'converted' => 0, 'closed' => 0];
$filters = $filters ?? ['status' => null];
$activeLeads = (int) (($metrics['pending'] ?? 0) + ($metrics['contacted'] ?? 0));
$conversionRate = ($metrics['total'] ?? 0) > 0
        ? (int) round((($metrics['converted'] ?? 0) / max(1, $metrics['total'])) * 100)
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

    .breadcrumb-soft .breadcrumb {
        margin-bottom: 0.5rem;
        background: transparent;
        padding: 0;
    }

    .breadcrumb-soft .breadcrumb-item+.breadcrumb-item::before {
        color: var(--text-muted);
    }

    .breadcrumb-soft a {
        color: var(--text-muted);
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

    .hero-actions .btn[disabled],
    .table-card .btn[disabled] {
        opacity: 0.65;
        cursor: not-allowed;
        pointer-events: none;
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

    .page-header,
    .stat-card {
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
    .badge-status {
        border-radius: 999px;
        padding: 0.35rem 0.9rem;
        font-weight: 600;
        font-size: 0.85rem;
        text-transform: capitalize;
    }

    .badge-soft-success {
        background: rgba(25, 135, 84, 0.12);
        color: var(--admin-primary);
    }

    .badge-soft-warning {
        background: rgba(255, 193, 7, 0.18);
        color: #b58102;
    }

    .badge-soft-danger {
        background: rgba(220, 53, 69, 0.15);
        color: #c21f32;
    }

    .badge-status.pending {
        background: rgba(255, 193, 7, 0.18);
        color: #b58102;
    }

    .badge-status.contacted {
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
        }
    }

    @media (max-width: 575.98px) {

        .page-header,
        .filter-card,
        .table-card {
            padding: 1.25rem;
        }

        .table-card {
            margin-top: 1.25rem;
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
    <?= view('admin/partials/sidebar', ['active' => 'residential-leads']) ?>
    <?= view('admin/partials/topbar', ['showDarkToggle' => true, 'userRole' => 'Lead Desk']) ?>

    <main class="main-content container-fluid" id="main-content">
        <section class="page-header" data-aos="fade-up">
            <div class="d-flex flex-column flex-lg-row justify-content-between gap-3">
                <div>
                    <div class="breadcrumb-soft" aria-label="breadcrumb">
                        <ol class="breadcrumb mb-2">
                            <li class="breadcrumb-item"><a href="<?= site_url('/admin') ?>">Admin</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Residential Leads</li>
                        </ol>
                    </div>
                    <div class="d-flex flex-wrap align-items-center gap-2 mb-2">
                        <h1 class="page-title mb-0">Residential Leads</h1>
                        <span class="badge-live">Realtime pipeline</span>
                    </div>
                    <p class="text-muted mb-0">Track every inbound enquiry, keep responses timely, and surface
                        conversions that need attention.</p>
                </div>
                <div class="d-flex flex-column align-items-lg-end gap-3">
                    <div class="hero-actions">
                        <a href="<?= current_url() ?>" class="btn btn-ghost"><i
                                class="bi bi-arrow-repeat me-2"></i>Refresh view</a>
                        <a href="<?= current_url() ?>?status=converted" class="btn btn-soft-secondary"><i
                                class="bi bi-trophy me-2"></i>Converted focus</a>
                    </div>
                    <div class="d-flex flex-wrap gap-3 justify-content-lg-end">
                        <div class="text-lg-end">
                            <div class="text-muted small text-uppercase mb-1">Active follow-ups</div>
                            <div class="stat-value mb-0"><?= esc(number_format($activeLeads)) ?></div>
                            <div class="stat-meta">Pending + Contacted</div>
                        </div>
                        <div class="text-lg-end">
                            <div class="text-muted small text-uppercase mb-1">Conversion rate</div>
                            <div class="stat-value mb-0"><?= esc($conversionRate) ?>%</div>
                            <div class="stat-meta">Updated live</div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section class="row g-4 mb-3">
            <div class="col-sm-6 col-xl-3" data-aos="fade-up">
                <div class="stat-card h-100">
                    <div class="d-flex justify-content-between align-items-start mb-3">
                        <h6>Total Leads</h6>
                        <div class="stat-icon"><i class="bi bi-people-fill"></i></div>
                    </div>
                    <div class="stat-value" data-metric="total"><?= esc(number_format($metrics['total'] ?? 0)) ?></div>
                    <div class="stat-meta text-success">All inbound enquiries</div>
                </div>
            </div>
            <div class="col-sm-6 col-xl-3" data-aos="fade-up" data-aos-delay="60">
                <div class="stat-card h-100">
                    <div class="d-flex justify-content-between align-items-start mb-3">
                        <h6>Pending</h6>
                        <div class="stat-icon"><i class="bi bi-hourglass-split"></i></div>
                    </div>
                    <div class="stat-value" data-metric="pending"><?= esc(number_format($metrics['pending'] ?? 0)) ?>
                    </div>
                    <div class="stat-meta text-warning">Awaiting first touch</div>
                </div>
            </div>
            <div class="col-sm-6 col-xl-3" data-aos="fade-up" data-aos-delay="120">
                <div class="stat-card h-100">
                    <div class="d-flex justify-content-between align-items-start mb-3">
                        <h6>Contacted</h6>
                        <div class="stat-icon"><i class="bi bi-chat-dots"></i></div>
                    </div>
                    <div class="stat-value" data-metric="contacted">
                        <?= esc(number_format($metrics['contacted'] ?? 0)) ?></div>
                    <div class="stat-meta text-primary">Follow-ups in progress</div>
                </div>
            </div>
            <div class="col-sm-6 col-xl-3" data-aos="fade-up" data-aos-delay="180">
                <div class="stat-card h-100">
                    <div class="d-flex justify-content-between align-items-start mb-3">
                        <h6>Converted</h6>
                        <div class="stat-icon"><i class="bi bi-trophy"></i></div>
                    </div>
                    <div class="stat-value" data-metric="converted">
                        <?= esc(number_format($metrics['converted'] ?? 0)) ?></div>
                    <div class="stat-meta text-success">Won residential deals</div>
                </div>
            </div>
            <div class="col-sm-6 col-xl-3" data-aos="fade-up" data-aos-delay="240">
                <div class="stat-card h-100">
                    <div class="d-flex justify-content-between align-items-start mb-3">
                        <h6>Closed</h6>
                        <div class="stat-icon"><i class="bi bi-archive"></i></div>
                    </div>
                    <div class="stat-value" data-metric="closed"><?= esc(number_format($metrics['closed'] ?? 0)) ?>
                    </div>
                    <div class="stat-meta text-muted">Archived conversations</div>
                </div>
            </div>
        </section>

        <section class="filter-card" data-aos="fade-up">
            <form method="get" action="<?= current_url() ?>" class="w-100">
                <div class="d-flex flex-wrap justify-content-between align-items-center mb-3 gap-2">
                    <h5 class="mb-0">Lead Filters</h5>
                    <div class="d-flex gap-2 flex-wrap">
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
                            <option value="<?= esc($statusOption) ?>"
                                <?= $filters['status'] === $statusOption ? 'selected' : '' ?>>
                                <?= ucfirst($statusOption) ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                </div>
            </form>
        </section>

        <section class="table-card" data-aos="fade-up">
            <div class="d-flex flex-wrap justify-content-between align-items-center gap-3 mb-3">
                <div>
                    <h5 class="mb-1">Lead board</h5>
                    <p class="text-muted small mb-0">Every residential enquiry with status, notes, and quick actions.
                    </p>
                </div>
                <span class="badge-live px-3 py-2">Realtime</span>
            </div>
            <div class="table-responsive">
                <table class="table align-middle table-hover mb-0">
                    <thead class="table-light">
                        <tr>
                            <th scope="col">Lead</th>
                            <th scope="col">Preferred City</th>
                            <th scope="col">Message</th>
                            <th scope="col" class="text-center">Status</th>
                            <th scope="col" class="text-end">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (! empty($leads)): ?>
                        <?php foreach ($leads as $lead): ?>
                        <tr data-lead-row="<?= (int) $lead['id'] ?>">
                            <td>
                                <div class="fw-semibold"><?= esc($lead['full_name']) ?></div>
                                <div class="text-muted small">Email: <a
                                        href="mailto:<?= esc($lead['email']) ?>"><?= esc($lead['email']) ?></a></div>
                                <?php if (! empty($lead['created_at'])): ?>
                                <div class="text-muted small">Logged
                                    <?= date('M d, Y H:i', strtotime($lead['created_at'])) ?></div>
                                <?php endif; ?>
                            </td>
                            <td><?= esc($lead['preferred_city'] ?: '—') ?></td>
                            <td class="text-break">
                                <p class="mb-1 small"><?= esc($lead['message']) ?></p>
                                <?php if (! empty($lead['notes'])): ?>
                                <p class="mb-0 small text-success">Notes: <?= esc($lead['notes']) ?></p>
                                <?php endif; ?>
                            </td>
                            <td class="text-center">
                                <span
                                    class="badge badge-status <?= esc($lead['status']) ?>"><?= ucfirst($lead['status']) ?></span>
                            </td>
                            <td class="text-end">
                                <div class="d-flex flex-column gap-2 align-items-end">
                                    <div class="d-flex gap-2 justify-content-end">
                                        <select class="form-select form-select-sm" data-role="status-select"
                                            data-id="<?= (int) $lead['id'] ?>">
                                            <?php foreach ($allowedStatus as $statusOption): ?>
                                            <option value="<?= esc($statusOption) ?>"
                                                <?= $lead['status'] === $statusOption ? 'selected' : '' ?>>
                                                <?= ucfirst($statusOption) ?></option>
                                            <?php endforeach; ?>
                                        </select>
                                        <button class="btn btn-soft-primary btn-sm btn-table" data-role="save-status"
                                            data-id="<?= (int) $lead['id'] ?>">
                                            <i class="bi bi-check2"></i>
                                        </button>
                                        <button class="btn btn-outline-dark btn-sm btn-table" data-role="delete-lead"
                                            data-id="<?= (int) $lead['id'] ?>">
                                            <i class="bi bi-trash"></i>
                                        </button>
                                    </div>

                                </div>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                        <?php else: ?>
                        <tr>
                            <td colspan="5" class="text-center py-5">
                                <p class="mb-1 fw-semibold">No residential leads yet</p>
                                <p class="text-muted mb-0">Lead submissions from the residential page will appear here.
                                </p>
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
                <nav class="mt-3" aria-label="Residential leads pagination">
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
    (function() {
        'use strict';

        document.addEventListener('DOMContentLoaded', async function() {
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
                if (!backdrop) {
                    return;
                }
                backdrop.classList.remove('d-none');
                backdrop.classList.add('visible');
            };

            const hideBackdrop = () => {
                if (!backdrop) {
                    return;
                }
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

            window.bootstrap?.Tooltip && Array.from(document.querySelectorAll(
                '[data-bs-toggle="tooltip"]')).forEach((element) => {
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
                    card.style.setProperty('--mouse-x',
                        `${event.clientX - bounds.left}px`);
                    card.style.setProperty('--mouse-y',
                        `${event.clientY - bounds.top}px`);
                });
                card.addEventListener('mouseleave', () => {
                    card.style.removeProperty('--mouse-x');
                    card.style.removeProperty('--mouse-y');
                });
            });

            const updateCsrf = (payload) => {
                if (!payload) {
                    return;
                }
                if (payload.csrfName) {
                    tokenNameMeta.content = payload.csrfName;
                }
                if (payload.csrfHash) {
                    tokenValueMeta.content = payload.csrfHash;
                }
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
                title: 'Delete this lead?',
                text: 'This action cannot be undone.',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Yes, delete',
                cancelButtonText: 'Cancel',
            });

            const numberFormatter = new Intl.NumberFormat();

            const refreshMetrics = (metrics) => {
                if (!metrics) {
                    return;
                }
                Object.entries(metrics).forEach(([key, value]) => {
                    const target = document.querySelector(`[data-metric="${key}"]`);
                    if (target) {
                        const numeric = Number(value);
                        target.textContent = Number.isFinite(numeric) ? numberFormatter
                            .format(numeric) : value;
                    }
                });
            };

            const handleAction = async (id, body) => {
                try {
                    const response = await fetch(
                        `<?= site_url('admin/residential-leads') ?>/${id}/status`, {
                            method: 'POST',
                            headers: {
                                'X-Requested-With': 'XMLHttpRequest',
                                'Content-Type': 'application/x-www-form-urlencoded',
                            },
                            body: new URLSearchParams({
                                ...body,
                                [tokenNameMeta.content]: tokenValueMeta.content,
                            }),
                        });

                    const payload = await response.json();
                    updateCsrf(payload);

                    if (!response.ok || payload.success === false) {
                        await showError(payload.message || 'Unable to update lead.');
                        return null;
                    }

                    await showSuccess(payload.message || 'Lead updated successfully.');
                    refreshMetrics(payload.metrics);

                    return payload;
                } catch (error) {
                    await showError(error.message || 'Unable to update lead.');
                    return null;
                }
            };

            document.querySelectorAll('[data-role="save-status"]').forEach((button) => {
                button.addEventListener('click', async (event) => {
                    event.preventDefault();
                    const id = button.dataset.id;
                    const select = document.querySelector(
                        `[data-role="status-select"][data-id="${id}"]`);
                    if (!select) {
                        return;
                    }
                    const result = await handleAction(id, {
                        status: select.value
                    });
                    if (!result) {
                        return;
                    }

                    const updatedStatus = result.status || result.updatedStatus ||
                        select.value;
                    const badge = document.querySelector(
                        `[data-lead-row="${id}"] .badge-status`);
                    if (badge && updatedStatus) {
                        const label = updatedStatus.charAt(0).toUpperCase() +
                            updatedStatus.slice(1);
                        badge.textContent = label;
                        badge.className = `badge badge-status ${updatedStatus}`;
                    }
                });
            });

            document.querySelectorAll('[data-role="delete-lead"]').forEach((button) => {
                button.addEventListener('click', async (event) => {
                    event.preventDefault();

                    const confirmation = await confirmDelete();
                    if (!confirmation.isConfirmed) {
                        return;
                    }

                    const id = button.dataset.id;

                    try {
                        const response = await fetch(
                            `<?= site_url('admin/residential-leads') ?>/${id}/delete`, {
                                method: 'POST',
                                headers: {
                                    'X-Requested-With': 'XMLHttpRequest',
                                    'Content-Type': 'application/x-www-form-urlencoded',
                                },
                                body: new URLSearchParams({
                                    [tokenNameMeta
                                    .content]: tokenValueMeta.content,
                                }),
                            });

                        const payload = await response.json();
                        updateCsrf(payload);

                        if (!response.ok || payload.success === false) {
                            await showError(payload.message ||
                                'Unable to delete lead.');
                            return;
                        }

                        await showSuccess(payload.message || 'Lead removed.');
                        refreshMetrics(payload.metrics);

                        document.querySelector(`[data-lead-row="${id}"]`)?.remove();
                    } catch (error) {
                        await showError(error.message || 'Unable to delete lead.');
                    }
                });
            });
        });
    })();
    </script>
</body>

</html>