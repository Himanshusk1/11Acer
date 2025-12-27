<?php
$page_title = 'Admin Dashboard - 11 Acer';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <?php include 'assets/includes/seo-meta.php'; ?>
<meta name="csrf-token-name" content="<?= csrf_token() ?>">
    <meta name="csrf-token-value" content="<?= csrf_hash() ?>">
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="icon" type="image/x-icon" href="<?= base_url('images/favicon/favicon.ico') ?>">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/aos@2.3.4/dist/aos.css">
    
    <style>
        :root {
            --admin-primary: #198754;
            --admin-primary-dark: #0f5132;
            --admin-primary-light: #e6fae6;
            --admin-bg: #f5f8f6;
            --card-shadow: 0 25px 60px rgba(13, 27, 19, 0.09);
        }
        body {
            font-family: 'Inter', sans-serif;
            background-color: var(--admin-bg);
            color: #1c2a21;
            min-height: 100vh;
            overflow-x: hidden;
        }
        body.dark-mode {
            background-color: #111618;
            color: #e8f1ec;
        }
        body.dark-mode .sidebar,
        body.dark-mode .topbar,
        body.dark-mode .glass-card,
        body.dark-mode .table-wrapper,
        body.dark-mode .stat-card,
        body.dark-mode .timeline-card,
        body.dark-mode .recent-actions-card,
        body.dark-mode .analytics-card {
            background: rgba(20, 26, 24, 0.92);
            color: #e8f1ec;
            border-color: rgba(255,255,255,0.08);
        }

        .sidebar {
            body.dark-mode .text-muted,
            body.dark-mode .text-muted small,
            body.dark-mode .stat-card p,
            body.dark-mode .stat-card small {
                color: #cdd8d2 !important;
            }
        
            body.dark-mode .table thead,
            body.dark-mode .table thead th {
                color: #f6fbf7;
                background-color: rgba(255,255,255,0.04);
                border-color: rgba(255,255,255,0.08);
            }
        
            body.dark-mode .table tbody td {
                border-color: rgba(255,255,255,0.06);
            }
        
            body.dark-mode .badge {
                background: rgba(25,135,84,0.25);
                color: #eafff2;
            }
        
            body.dark-mode .icon-btn {
                background: rgba(255,255,255,0.08);
                border-color: rgba(255,255,255,0.1);
                color: #f6fbf7;
            }
        
            body.dark-mode .icon-btn:hover {
                background: var(--admin-primary);
                color: #fff;
            }
            position: fixed;
            top: 0;
            left: 0;
            bottom: 0;
            width: 260px;
            background: rgba(17, 26, 21, 0.92);
            backdrop-filter: blur(18px);
            color: #f0fff6;
            padding: 2rem 1.5rem;
            transition: all 0.3s ease;
            z-index: 1030;
            box-shadow: 10px 0 30px rgba(8, 12, 10, 0.4);
        }
        .sidebar-header {
            font-size: 1.5rem;
            font-weight: 700;
            color: #fff;
            text-align: center;
            margin-bottom: 2.5rem;
        }
        .sidebar-header span {
            color: var(--admin-primary);
        }
        .nav h6 {
            color: rgba(255,255,255,0.55);
            letter-spacing: 0.08em;
            font-size: 0.7rem;
            text-transform: uppercase;
            margin: 1.25rem 0 0.6rem;
        }
        .nav-link {
            display: flex;
            align-items: center;
            padding: 0.75rem 1rem;
            color: #adb5bd;
            border-radius: 8px;
            margin-bottom: 0.5rem;
            transition: background-color 0.2s ease, color 0.2s ease, transform 0.2s;
        }
        .nav-link .icon {
            margin-right: 0.75rem;
            font-size: 1.1rem;
        }
        .nav-link:hover {
            background-color: rgba(255,255,255,0.08);
            color: #fff;
            transform: translateX(6px);
        }
        .nav-link.active {
            background-color: var(--admin-primary);
            color: #fff;
            font-weight: 600;
            box-shadow: 0 12px 25px rgba(25,135,84,0.35);
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
            box-shadow: 0 10px 30px rgba(15,28,22,0.08);
        }
        .topbar .navbar-toggler {
            display: none;
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
            border: 1px solid rgba(25,135,84,0.25);
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
            box-shadow: 0 12px 20px rgba(25,135,84,0.3);
        }

        .main-content {
            margin-left: 260px;
            margin-top: 70px;
            padding: 2.5rem 2.5rem 3rem;
            transition: all 0.3s ease;
            min-height: calc(100vh - 70px);
        }
        .hero-panel {
            background: linear-gradient(135deg, rgba(25,135,84,0.14), rgba(25,135,84,0.04));
            border-radius: 28px;
            padding: 1.5rem 2rem;
            box-shadow: var(--card-shadow);
        }
        .quick-actions .btn {
            border-radius: 14px;
            padding: 0.65rem 1.5rem;
            font-weight: 600;
        }
        .quick-actions .btn[disabled] {
            opacity: 0.65;
            cursor: not-allowed;
            pointer-events: none;
        }
        .btn-brand {
            background: var(--admin-primary);
            border-color: var(--admin-primary);
        }
        .btn-brand:hover {
            background: var(--admin-primary-dark);
            border-color: var(--admin-primary-dark);
        }
        .glass-card,
        .stat-card,
        .table-wrapper,
        .timeline-card,
        .recent-actions-card,
        .analytics-card {
            background: #fff;
            border-radius: 20px;
            border: 1px solid rgba(25,135,84,0.08);
            box-shadow: var(--card-shadow);
            padding: 1.5rem;
        }
        .stat-card {
            transition: transform 0.2s ease, box-shadow 0.2s ease;
        }
        .stat-card:hover {
            transform: translateY(-4px);
            box-shadow: 0 35px 70px rgba(13,27,19,0.15);
        }
        .stat-card .icon {
            font-size: 2rem;
            padding: 0.75rem;
            border-radius: 14px;
            background: rgba(25,135,84,0.1);
        }
        .text-success { color: var(--admin-primary) !important; }
        .bg-success-light { background-color: var(--admin-primary-light); }
        .text-primary { color: #0d6efd !important; }
        .bg-primary-light { background-color: #e7f0ff; }
        .text-warning { color: #ffc107 !important; }
        .bg-warning-light { background-color: #fff8e6; }
        .text-info { color: #0dcaf0 !important; }
        .bg-info-light { background-color: #e7f9ff; }
        .text-secondary { color: #6c757d !important; }
        .bg-secondary-light { background-color: #f0f2f5; }
        .text-danger { color: #dc3545 !important; }
        .bg-danger-light { background-color: #ffe8ec; }

        .table-wrapper {
            padding: 1.5rem;
        }
        .table-responsive {
            border-radius: 16px;
            overflow: hidden;
        }
        .table th {
            font-weight: 600;
            border-bottom: none;
        }
        .table .badge {
            font-weight: 500;
            padding: 0.4em 0.75em;
            border-radius: 999px;
        }
        .btn-sm {
            padding: 0.25rem 0.6rem;
            font-size: 0.8rem;
        }
        .btn-outline-warning { color: #ffc107; border-color: #ffc107; }
        .btn-outline-warning:hover { background-color: #ffc107; color: #000; }
        .btn-outline-danger { color: #dc3545; border-color: #dc3545; }
        .btn-outline-danger:hover { background-color: #dc3545; color: #fff; }
        .table tbody tr:hover {
            background-color: rgba(25,135,84,0.04);
        }
        .filter-bar {
            gap: 0.75rem;
            padding: 0.85rem 1rem;
            border-radius: 20px;
            background: linear-gradient(135deg, rgba(25,135,84,0.08), rgba(25,135,84,0.02));
            border: 1px solid rgba(25,135,84,0.12);
            box-shadow: 0 18px 35px rgba(15, 28, 22, 0.08);
        }
        .filter-chip {
            flex: 1 1 200px;
            display: flex;
            align-items: center;
            gap: 0.75rem;
            padding: 0.65rem 0.9rem;
            background: #fff;
            border-radius: 14px;
            border: 1px solid rgba(16,24,40,0.08);
            box-shadow: inset 0 1px 0 rgba(255,255,255,0.6);
            position: relative;
        }
        .filter-chip i {
            font-size: 1rem;
            color: var(--admin-primary);
        }
        .filter-chip input,
        .filter-chip select {
            border: 0;
            background: transparent;
            width: 100%;
            outline: none;
            font-size: 0.95rem;
            color: #1c2a21;
        }
        .filter-chip select {
            appearance: none;
            padding-right: 1.5rem;
            cursor: pointer;
        }
        .filter-chip .chevron {
            position: absolute;
            right: 0.75rem;
            top: 50%;
            transform: translateY(-50%);
            pointer-events: none;
            color: #98a29a;
            font-size: 0.85rem;
        }
        .filter-actions {
            display: flex;
            gap: 0.5rem;
            flex-wrap: wrap;
        }
        .filter-actions .btn {
            border-radius: 999px;
            padding: 0.5rem 1.35rem;
            font-weight: 600;
        }
        .filter-actions .btn-outline-success {
            border-color: rgba(25,135,84,0.35);
            color: var(--admin-primary);
            background: rgba(25,135,84,0.08);
        }
        .filter-actions .btn-outline-success:hover {
            background: var(--admin-primary);
            color: #fff;
        }
        .analytics-card {
            min-height: 220px;
            position: relative;
        }
        .growth-line {
            position: absolute;
            inset: 1.5rem;
            background: linear-gradient(135deg, rgba(25,135,84,0.3), rgba(25,135,84,0.05));
            border-radius: 16px;
        }
        .timeline-list {
            list-style: none;
            padding: 0;
            margin: 0;
        }
        .timeline-list li {
            position: relative;
            padding-left: 1.75rem;
            margin-bottom: 1rem;
        }
        .timeline-list li::before {
            content: '';
            position: absolute;
            left: 0;
            top: 6px;
            width: 10px;
            height: 10px;
            border-radius: 50%;
            background: var(--admin-primary);
            box-shadow: 0 0 0 6px rgba(25,135,84,0.12);
        }

        body.dark-mode .filter-bar {
            background: rgba(255,255,255,0.05);
            border-color: rgba(255,255,255,0.14);
            box-shadow: 0 10px 30px rgba(0,0,0,0.35);
        }
        body.dark-mode .filter-chip {
            background: rgba(255,255,255,0.08);
            border-color: rgba(255,255,255,0.15);
            color: #f0fff4;
        }
        body.dark-mode .filter-chip input,
        body.dark-mode .filter-chip select {
            color: #f0fff4;
        }
        body.dark-mode .filter-chip i,
        body.dark-mode .filter-chip .chevron {
            color: rgba(255,255,255,0.8);
        }
        body.dark-mode .filter-actions .btn-outline-success {
            background: rgba(25,135,84,0.2);
            border-color: rgba(25,135,84,0.4);
            color: #eafff2;
        }

        @media (max-width: 991.98px) {
            .sidebar {
                left: -260px;
            }
            .sidebar.active {
                left: 0;
            }
            .main-content {
                margin-left: 0;
                padding: 1.75rem 1.5rem 2.5rem;
            }
            .topbar {
                left: 0;
            }
            .topbar .navbar-toggler {
                display: block;
            }
            .backdrop {
                position: fixed;
                top: 0; left: 0; right: 0; bottom: 0;
                background-color: rgba(0,0,0,0.5);
                z-index: 1025;
            }
            .filter-bar { width: 100%; }
            .filter-bar > * { flex: 1 1 100%; }
            .topbar-actions { gap: 0.4rem; }
            .icon-btn { width: 36px; height: 36px; }
        }
        @media (max-width: 575.98px) {
            .hero-panel { padding: 1.25rem; }
            .quick-actions .btn { width: 100%; }
        }
    </style>
</head>
<body>
    <?php
        $counts           = $counts ?? [];
        $roleSplit        = $roleSplit ?? [];
        $growth           = $growth ?? ['labels' => [], 'values' => []];
        $propertyStats    = $propertyStats ?? ['total' => 0, 'published' => 0, 'drafts' => 0];
        $recentUsers      = $recentUsers ?? [];
        $recentProperties = $recentProperties ?? [];
        $users            = $users ?? [];
        $agentsDealers    = ($counts['agents'] ?? 0) + ($counts['builders'] ?? 0);
        $currentMonthUsers = ! empty($growth['values']) ? end($growth['values']) : 0;
        $totalUsersCount  = isset($pager) ? $pager->getTotal('users') : count($users);
        $exportParams = [
            'search'   => $filters['search'] ?? null,
            'role'     => $filters['role'] ?? null,
            'per_page' => $filters['per_page'] ?? null,
            'sort'     => $filters['sort'] ?? null,
            'order'    => $filters['order'] ?? null,
        ];
        $exportParams = array_filter($exportParams, static function ($value) {
            return $value !== null && $value !== '';
        });
        $exportUrl = site_url('admin/users/export') . ($exportParams ? '?' . http_build_query($exportParams) : '');
    ?>
    <?= view('admin/partials/sidebar', ['active' => 'users']) ?>
    <?= view('admin/partials/topbar', ['showDarkToggle' => true, 'userRole' => 'Control Center']) ?>

    <main class="main-content" id="main-content">
        <section class="hero-panel mb-4" data-aos="fade-up">
            <div class="d-flex flex-wrap justify-content-between align-items-center gap-3">
                <div>
                    <p class="text-uppercase text-muted mb-1 small">Control center</p>
                    <h1 class="h3 mb-2">User Management</h1>
                    <p class="text-muted mb-0">Monitor activity, onboard partners, and keep every account in sync with your revenue goals.</p>
                </div>
                <div class="quick-actions d-flex flex-wrap gap-2">
                    <a href="<?= site_url('admin/users/create') ?>" class="btn btn-outline-success"><i class="bi bi-person-plus me-2"></i>Add User</a>
                    <a href="<?= esc($exportUrl) ?>" class="btn btn-outline-secondary"><i class="bi bi-download me-2"></i>Export CSV</a>
                    <span class="d-inline-block" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Reports dashboard coming soon">
                    </span>
                </div>
            </div>
        </section>

        <div class="row g-4 mb-4">
            <div class="col-md-3" data-aos="fade-up">
                <div class="stat-card">
                    <div class="d-flex align-items-center">
                        <div class="icon bg-success-light text-success me-3"><i class="bi bi-people-fill"></i></div>
                        <div>
                            <p class="text-muted small mb-1">Total Users</p>
                            <p class="fs-4 fw-bold mb-0" id="total-users-count"><?= number_format($counts['users'] ?? 0) ?></p>
                            <small class="text-success" id="new-week-count"><?= number_format($counts['newThisWeek'] ?? 0) ?> joined this week</small>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-3" data-aos="fade-up" data-aos-delay="60">
                <div class="stat-card">
                    <div class="d-flex align-items-center">
                        <div class="icon bg-primary-light text-primary me-3"><i class="bi bi-person-fill-gear"></i></div>
                        <div>
                            <p class="text-muted small mb-1">Agents / Dealers</p>
                            <p class="fs-4 fw-bold mb-0" id="agents-count"><?= number_format($agentsDealers) ?></p>
                            <small class="text-primary">Agents: <?= number_format($counts['agents'] ?? 0) ?> • Builders: <?= number_format($counts['builders'] ?? 0) ?></small>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-3" data-aos="fade-up" data-aos-delay="120">
                <div class="stat-card">
                    <div class="d-flex align-items-center">
                        <div class="icon bg-info-light text-info me-3"><i class="bi bi-graph-up"></i></div>
                        <div>
                            <p class="text-muted small mb-1">Active Sessions</p>
                            <p class="fs-4 fw-bold mb-0" id="active-sessions-count"><?= number_format($counts['activeSessions'] ?? 0) ?></p>
                            <small class="text-info">Live from session store</small>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-3" data-aos="fade-up" data-aos-delay="180">
                <div class="stat-card">
                    <div class="d-flex align-items-center">
                        <div class="icon bg-warning-light text-warning me-3"><i class="bi bi-houses-fill"></i></div>
                        <div>
                            <p class="text-muted small mb-1">Published Properties</p>
                            <p class="fs-4 fw-bold mb-0" id="published-properties-count"><?= number_format($propertyStats['published'] ?? 0) ?></p>
                            <small class="text-warning" id="property-breakdown">Drafts: <?= number_format($propertyStats['drafts'] ?? 0) ?> • Total: <?= number_format($propertyStats['total'] ?? 0) ?></small>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row g-4 mb-4">
            <div class="col-xl-6" data-aos="fade-up">
                <div class="analytics-card h-100">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <div>
                            <h5 class="mb-1">New Users (last 6 months)</h5>
                            <p class="text-muted small mb-0">Live from users.created_at</p>
                        </div>
                        <span class="badge bg-light text-success">Live</span>
                    </div>
                    <canvas id="userGrowthChart" height="160"></canvas>
                    <div class="d-flex justify-content-between text-muted small mt-3">
                        <span>Total shown: <?= number_format(array_sum($growth['values'] ?? [])) ?></span>
                        <span>This month: <?= number_format($currentMonthUsers) ?></span>
                    </div>
                </div>
            </div>
            <div class="col-xl-3" data-aos="fade-up" data-aos-delay="80">
                <div class="analytics-card h-100 text-center">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <h5 class="mb-0">User Split</h5>
                        <span class="badge bg-success-light text-success">Roles</span>
                    </div>
                    <canvas id="userSplitChart" height="180"></canvas>
                    <div class="mt-3 text-start small">
                        <p class="mb-1"><span class="badge bg-success-light text-success me-2">Buyers</span> <?= number_format($roleSplit['buyer'] ?? 0) ?></p>
                        <p class="mb-1"><span class="badge bg-primary-light text-primary me-2">Agents</span> <?= number_format($roleSplit['agent'] ?? 0) ?></p>
                        <p class="mb-1"><span class="badge bg-warning-light text-warning me-2">Builders</span> <?= number_format($roleSplit['builder'] ?? 0) ?></p>
                        <p class="mb-1"><span class="badge bg-info-light text-info me-2">Individuals</span> <?= number_format($roleSplit['individual'] ?? 0) ?></p>
                        <p class="mb-0"><span class="badge bg-secondary-light text-secondary me-2">Admins</span> <?= number_format($roleSplit['admin'] ?? 0) ?></p>
                    </div>
                </div>
            </div>
            <div class="col-xl-3" data-aos="fade-up" data-aos-delay="160">
                <div class="analytics-card h-100">
                    <h5 class="mb-3">Property Activity</h5>
                    <?php
                        $totalProps   = max(1, (int) ($propertyStats['total'] ?? 0));
                        $published    = (int) ($propertyStats['published'] ?? 0);
                        $drafts       = (int) ($propertyStats['drafts'] ?? 0);
                        $otherProps   = max(0, $totalProps - ($published + $drafts));
                        $propSegments = [
                            ['label' => 'Published', 'value' => $published, 'class' => 'bg-success'],
                            ['label' => 'Drafts', 'value' => $drafts, 'class' => 'bg-warning'],
                            ['label' => 'Other', 'value' => $otherProps, 'class' => 'bg-secondary'],
                        ];
                    ?>
                    <div class="d-flex flex-column gap-2">
                        <?php foreach ($propSegments as $segment): 
                            $percent = $totalProps ? round(($segment['value'] / $totalProps) * 100) : 0;
                        ?>
                        <div>
                            <div class="d-flex justify-content-between small mb-1"><span><?= esc($segment['label']) ?></span><span><?= $segment['value'] ?> (<?= $percent ?>%)</span></div>
                            <div class="progress" style="height:8px;">
                                <div class="progress-bar <?= esc($segment['class']) ?>" role="progressbar" style="width: <?= $percent ?>%"></div>
                            </div>
                        </div>
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>
        </div>

        <div class="table-wrapper" data-aos="fade-up">

    <!-- Header + Filters -->
    <div class="d-flex flex-wrap justify-content-between align-items-center gap-3 mb-3">
        <div>
            <h3 class="h5 mb-1">All Users List</h3>
            <p class="text-muted small mb-0">Filter, review, and update user accounts in one place.</p>
        </div>

        <!-- Filter Bar -->
        <form class="filter-bar d-flex flex-wrap align-items-center w-100" method="get" action="<?= site_url('admin'); ?>">

            <!-- Search -->
            <div class="filter-chip">
                <i class="bi bi-search"></i>
                  <input type="text"
                      id="live-search"
                      name="search"
                      value="<?= esc($filters['search'] ?? '') ?>"
                      class="flex-grow-1 bg-transparent"
                      placeholder="Search name, email, phone, IDs"
                      data-user-filter="search">
            </div>

            <!-- Role Dropdown -->
            <div class="filter-chip">
                <i class="bi bi-people"></i>
                <select name="role" id="live-role" class="flex-grow-1 bg-transparent" data-user-filter="role">
                    <option value="">Role</option>
                    <?php 
                        $roles = ['buyer','agent','builder','individual','admin'];
                        foreach ($roles as $role): 
                    ?>
                    <option value="<?= $role ?>" <?= (($filters['role'] ?? '') === $role) ? 'selected' : '' ?>><?= ucfirst($role) ?></option>
                    <?php endforeach; ?>
                </select>
                <span class="chevron bi bi-chevron-down"></span>
            </div>

            <!-- Rows Per Page -->
            <div class="filter-chip">
                <i class="bi bi-list-check"></i>
                <select name="per_page" class="flex-grow-1 bg-transparent">
                    <?php foreach ([10,25,50,100] as $limit): ?>
                        <option value="<?= $limit ?>" <?= (($filters['per_page'] ?? 10) == $limit) ? 'selected' : '' ?>>
                            <?= $limit ?> rows
                        </option>
                    <?php endforeach; ?>
                </select>
                <span class="chevron bi bi-chevron-down"></span>
            </div>

            <!-- Apply + Reset -->
            <div class="filter-actions ms-auto d-flex gap-2 flex-wrap">
                <button type="submit" class="btn btn-outline-success btn-sm">
                    <i class="bi bi-sliders me-1"></i>Apply
                </button>
                <a href="<?= site_url('admin'); ?>" class="btn btn-light btn-sm" data-reset-filters data-redirect="<?= site_url('admin'); ?>">
                    <i class="bi bi-arrow-counterclockwise me-1"></i>Reset
                </a>
            </div>
        </form>
    </div>

    <!-- Users Table -->
    <div class="table-responsive">
        <table class="table align-middle table-hover" data-users-table>
            <thead class="table-light">
                <tr>
                    <th>S. No.</th>

                    <!-- Sorting Button for User ID -->
                    <th>
                        <a href="?<?= http_build_query(array_merge($_GET, ['sort' => 'user_id', 'order' => ($filters['order'] ?? 'asc') === 'asc' ? 'desc' : 'asc'])) ?>"
                           class="text-decoration-none text-dark">
                            User ID 
                            <?php if (($filters['sort'] ?? '') === 'user_id'): ?>
                                <i class="bi bi-caret-<?= ($filters['order'] ?? 'asc') === 'asc' ? 'up' : 'down' ?>-fill small"></i>
                            <?php endif; ?>
                        </a>
                    </th>

                    <th>
                        <a href="?<?= http_build_query(array_merge($_GET, ['sort' => 'public_id', 'order' => ($filters['order'] ?? 'asc') === 'asc' ? 'desc' : 'asc'])) ?>"
                           class="text-decoration-none text-dark">
                            Public ID
                            <?php if (($filters['sort'] ?? '') === 'public_id'): ?>
                                <i class="bi bi-caret-<?= ($filters['order'] ?? 'asc') === 'asc' ? 'up' : 'down' ?>-fill small"></i>
                            <?php endif; ?>
                        </a>
                    </th>
                    <th>
                        <a href="?<?= http_build_query(array_merge($_GET, ['sort' => 'referral_code', 'order' => ($filters['order'] ?? 'asc') === 'asc' ? 'desc' : 'asc'])) ?>"
                           class="text-decoration-none text-dark">
                            Referral Code
                            <?php if (($filters['sort'] ?? '') === 'referral_code'): ?>
                                <i class="bi bi-caret-<?= ($filters['order'] ?? 'asc') === 'asc' ? 'up' : 'down' ?>-fill small"></i>
                            <?php endif; ?>
                        </a>
                    </th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Mobile</th>
                    <th>Role</th>
                    <th>Status</th>
                    <th>Actions</th>

                </tr>
            </thead>

            <tbody>

                <?php if (!empty($users)): ?>
                    <?php foreach ($users as $index => $user):
                        $role = $user['role'] ?? 'user';
                        $roleBadgeMap = [
                            'buyer'      => 'badge bg-success-light text-success',
                            'agent'      => 'badge bg-info-light text-info',
                            'builder'    => 'badge bg-warning-light text-warning',
                            'individual' => 'badge bg-primary-light text-primary',
                            'admin'      => 'badge bg-secondary-light text-secondary',
                        ];
                        $roleClass = $roleBadgeMap[$role] ?? 'badge bg-secondary-light text-secondary';
                        $searchHaystack = strtolower(trim(implode(' ', [
                            $user['user_id'] ?? '',
                            $user['public_id'] ?? '',
                            $user['referral_code'] ?? '',
                            $user['full_name'] ?? '',
                            $user['email'] ?? '',
                            $user['phone_number'] ?? ''
                        ])));
                    ?>
                        <tr data-user-row
                            data-role="<?= esc($role) ?>"
                            data-search="<?= esc($searchHaystack) ?>">
                            <td><?= $index + 1 ?></td>
                            <td><strong>#<?= esc($user['user_id']) ?></strong></td>
                            <td><?= esc($user['public_id'] ?? '—') ?></td>
                            <td><?= esc($user['referral_code'] ?? '—') ?></td>
                            <td><?= esc($user['full_name'] ?: 'N/A') ?></td>
                            <td><?= esc($user['email'] ?: '—') ?></td>
                            <td><?= esc($user['phone_number'] ?? '—') ?></td>

                            <!-- Role Badge -->
                            <td>
                                <span class="<?= esc($roleClass) ?>">
                                    <?= esc(ucfirst($role)) ?>
                                </span>
                            </td>

                            <td><span class="badge bg-success-light text-success">Active</span></td>

                            <td class="d-flex gap-1 flex-wrap">

                                <!-- Promote -->
                                <form method="post" action="<?= site_url('admin/user/'.$user['user_id'].'/make-admin') ?>" class="user-action-form" data-action="promote" data-user-id="<?= esc($user['user_id']) ?>">
                                    <?= csrf_field() ?>
                                    <button class="btn btn-sm btn-outline-primary" title="Promote to Admin">
                                        <i class="bi bi-shield-check"></i>
                                    </button>
                                </form>

                                <!-- Delete -->
                                <form method="post" action="<?= site_url('admin/user/'.$user['user_id'].'/delete') ?>" class="user-action-form" data-action="delete" data-user-id="<?= esc($user['user_id']) ?>">
                                    <?= csrf_field() ?>
                                    <button class="btn btn-sm btn-outline-danger" title="Delete User">
                                        <i class="bi bi-trash-fill"></i>
                                    </button>
                                </form>

                            </td>
                        </tr>
                    <?php endforeach; ?>
                    <tr class="text-center text-muted py-4 fst-italic d-none" data-empty-row>
                        <td colspan="10">No users match the selected filters.</td>
                    </tr>

                <?php else: ?>
                    <tr data-empty-row>
                        <td colspan="10" class="text-center text-muted py-4">
                            No users found with these filters.
                        </td>
                    </tr>
                <?php endif; ?>

            </tbody>
        </table>
    </div>

    <!-- Pagination -->
    <div class="d-flex justify-content-between align-items-center mt-3 flex-wrap gap-2">
        <div class="text-muted small"
             data-users-count
             data-total="<?= esc($totalUsersCount) ?>">
            Showing <?= count($users) ?> of <?= $totalUsersCount ?> results
        </div>
        <div class="pagination-container" data-users-server-pager>
            <?= isset($pager) ? $pager->links('users', 'default_full') : '' ?>
        </div>
    </div>
    <nav class="mt-3 d-none" aria-label="Users pagination" data-users-pagination>
        <ul class="pagination justify-content-end mb-0">
            <li class="page-item disabled" data-page-control="prev">
                <a class="page-link" href="#" tabindex="-1" aria-disabled="true">Previous</a>
            </li>
            <li class="page-item disabled" data-page-control="next">
                <a class="page-link" href="#">Next</a>
            </li>
        </ul>
    </nav>

</div>


        <div class="row g-4 mt-1">
            <div class="col-xl-4" data-aos="fade-up">
                <div class="timeline-card">
                    <div class="d-flex justify-content-between mb-3">
                        <h5 class="mb-0">Latest Properties</h5>
                        <small class="text-muted">Live</small>
                    </div>
                    <ul class="timeline-list">
                        <?php if (! empty($recentProperties)): ?>
                            <?php foreach ($recentProperties as $property): ?>
                            <li>
                                <strong><?= esc($property['property_name'] ?: 'Property #' . ($property['id'] ?? '')) ?></strong> in <?= esc($property['city'] ?: 'NA') ?>
                                <div class="text-muted small">
                                    <?= esc($property['owner_name'] ?: 'Owner unknown') ?> • <?= $property['created_at'] ? date('M d, H:i', strtotime($property['created_at'])) : '—' ?>
                                </div>
                            </li>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <li class="text-muted">No properties created yet.</li>
                        <?php endif; ?>
                    </ul>
                </div>
            </div>
            <div class="col-xl-8" data-aos="fade-up" data-aos-delay="80">
                <div class="recent-actions-card">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <h5 class="mb-0">Recent Signups</h5>
                        <span class="small text-success">users.created_at</span>
                    </div>
                    <div class="table-responsive">
                        <table class="table table-borderless align-middle">
                            <thead class="table-light">
                                <tr>
                                    <th>User</th>
                                    <th>Role</th>
                                    <th>Email</th>
                                    <th>Joined</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if (! empty($recentUsers)): ?>
                                    <?php foreach ($recentUsers as $user): ?>
                                    <tr>
                                        <td><i class="bi bi-person-circle me-2 text-success"></i><?= esc($user['full_name'] ?: 'N/A') ?></td>
                                        <td><?= esc(ucfirst($user['role'] ?? 'user')) ?></td>
                                        <td><?= esc($user['email'] ?: '—') ?></td>
                                        <td><?= $user['created_at'] ? date('M d, H:i', strtotime($user['created_at'])) : '—' ?></td>
                                    </tr>
                                    <?php endforeach; ?>
                                <?php else: ?>
                                    <tr>
                                        <td colspan="4" class="text-muted text-center py-3">No signups yet.</td>
                                    </tr>
                                <?php endif; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <!-- Backdrop for mobile sidebar -->
    <div id="sidebar-backdrop" class="backdrop d-none"></div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/aos@2.3.4/dist/aos.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.1/dist/chart.umd.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.10.0/dist/sweetalert2.all.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            if (window.bootstrap && window.bootstrap.Tooltip) {
                var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
                tooltipTriggerList.forEach(function (tooltipTriggerEl) {
                    new window.bootstrap.Tooltip(tooltipTriggerEl);
                });
            }
            const sidebar = document.getElementById('admin-sidebar');
            const toggler = document.getElementById('sidebar-toggler');
            const backdrop = document.getElementById('sidebar-backdrop');
            const darkToggle = document.getElementById('dark-mode-toggle');
            const THEME_KEY = 'adminTheme';
            const savedTheme = localStorage.getItem(THEME_KEY);

            const setTheme = (mode) => {
                const next = mode === 'dark' ? 'dark' : 'light';
                document.body.classList.toggle('dark-mode', next === 'dark');
                localStorage.setItem(THEME_KEY, next);
            };

            setTheme(savedTheme || 'light');
            
            if (toggler) {
                toggler.addEventListener('click', function() {
                    sidebar.classList.toggle('active');
                    backdrop.classList.toggle('d-none');
                });
            }
            
            if (backdrop) {
                backdrop.addEventListener('click', function() {
                    sidebar.classList.remove('active');
                    backdrop.classList.add('d-none');
                });
            }

            if (darkToggle) {
                darkToggle.addEventListener('click', function() {
                    const next = document.body.classList.contains('dark-mode') ? 'light' : 'dark';
                    setTheme(next);
                });
            }

            if (window.AOS) {
                AOS.init({ duration: 700, once: true, offset: 80 });
            }

            // --- Live dashboard data & charts ---
            const statsEndpoint = '<?= site_url('admin/stats'); ?>';
            const csrfName = document.querySelector('meta[name="csrf-token-name"]').content;
            let csrfValue = document.querySelector('meta[name="csrf-token-value"]').content;
            const initialStats = <?= json_encode([
                'counts'        => $counts,
                'roleSplit'     => $roleSplit,
                'growth'        => $growth,
                'propertyStats' => $propertyStats,
            ], JSON_HEX_TAG | JSON_HEX_APOS | JSON_HEX_QUOT | JSON_HEX_AMP); ?>;

            const el = (id) => document.getElementById(id);
            const formatNum = (value) => Number(value || 0).toLocaleString();

            const updateCounts = (counts = {}, propertyStats = {}) => {
                if (el('total-users-count')) {
                    el('total-users-count').textContent = formatNum(counts.users);
                }
                if (el('agents-count')) {
                    const agentsTotal = Number(counts.agents || 0) + Number(counts.builders || 0);
                    el('agents-count').textContent = formatNum(agentsTotal);
                }
                if (el('active-sessions-count')) {
                    el('active-sessions-count').textContent = formatNum(counts.activeSessions);
                }
                if (el('new-week-count')) {
                    el('new-week-count').textContent = `${formatNum(counts.newThisWeek)} joined this week`;
                }

                if (el('published-properties-count')) {
                    el('published-properties-count').textContent = formatNum(propertyStats.published);
                }
                if (el('property-breakdown')) {
                    const draft = formatNum(propertyStats.drafts);
                    const total = formatNum(propertyStats.total);
                    el('property-breakdown').textContent = `Drafts: ${draft} • Total: ${total}`;
                }
            };

            const growthCtx = document.getElementById('userGrowthChart')?.getContext('2d');
            const splitCtx  = document.getElementById('userSplitChart')?.getContext('2d');

            const growthChart = growthCtx ? new Chart(growthCtx, {
                type: 'line',
                data: {
                    labels: initialStats.growth.labels,
                    datasets: [{
                        label: 'New users',
                        data: initialStats.growth.values,
                        tension: 0.35,
                        borderColor: '#198754',
                        backgroundColor: 'rgba(25, 135, 84, 0.12)',
                        fill: true,
                        borderWidth: 3,
                        pointRadius: 4,
                        pointBackgroundColor: '#198754',
                    }]
                },
                options: {
                    plugins: { legend: { display: false } },
                    scales: {
                        y: { beginAtZero: true, ticks: { precision: 0 } },
                        x: { grid: { display: false } }
                    }
                }
            }) : null;

            const splitChart = splitCtx ? new Chart(splitCtx, {
                type: 'doughnut',
                data: {
                    labels: ['Buyers', 'Agents', 'Builders', 'Individuals', 'Admins'],
                    datasets: [{
                        data: [
                            initialStats.roleSplit.buyer || 0,
                            initialStats.roleSplit.agent || 0,
                            initialStats.roleSplit.builder || 0,
                            initialStats.roleSplit.individual || 0,
                            initialStats.roleSplit.admin || 0,
                        ],
                        backgroundColor: ['#198754', '#0dcaf0', '#ffc107', '#0d6efd', '#6c757d'],
                        borderWidth: 1,
                    }]
                },
                options: {
                    plugins: { legend: { display: false } },
                    cutout: '60%'
                }
            }) : null;

            const refreshCharts = (stats) => {
                if (growthChart) {
                    growthChart.data.labels = stats.growth.labels;
                    growthChart.data.datasets[0].data = stats.growth.values;
                    growthChart.update();
                }
                if (splitChart) {
                    splitChart.data.datasets[0].data = [
                        stats.roleSplit.buyer || 0,
                        stats.roleSplit.agent || 0,
                        stats.roleSplit.builder || 0,
                        stats.roleSplit.individual || 0,
                        stats.roleSplit.admin || 0,
                    ];
                    splitChart.update();
                }
            };

            const refreshStats = async () => {
                try {
                    const res = await fetch(statsEndpoint, { headers: { 'Accept': 'application/json' } });
                    if (!res.ok) {
                        return;
                    }
                    const data = await res.json();
                    updateCounts(data.counts, data.propertyStats);
                    refreshCharts(data);
                } catch (err) {
                    console.warn('Unable to refresh stats', err);
                }
            };

            updateCounts(initialStats.counts, initialStats.propertyStats);
            refreshCharts(initialStats);
            setInterval(refreshStats, 30000);

            // --- Inline promote/delete via fetch ---
            const actionForms = document.querySelectorAll('.user-action-form');
            actionForms.forEach((form) => {
                form.addEventListener('submit', async (e) => {
                    e.preventDefault();
                    const action = form.dataset.action;
                    const userId = form.dataset.userId;

                    const confirmResult = await Swal.fire({
                        title: action === 'delete' ? 'Delete this user?' : 'Make this user an admin?',
                        text: action === 'delete' ? 'This cannot be undone.' : 'User will gain admin privileges.',
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonText: action === 'delete' ? 'Yes, delete' : 'Yes, promote',
                        cancelButtonText: 'Cancel',
                        confirmButtonColor: action === 'delete' ? '#dc3545' : '#198754'
                    });
                    if (!confirmResult.isConfirmed) return;

                    const fd = new FormData(form);
                    if (csrfName && csrfValue) {
                        fd.set(csrfName, csrfValue);
                    }

                    try {
                        const res = await fetch(form.action, {
                            method: 'POST',
                            headers: {
                                'Accept': 'application/json',
                                'X-Requested-With': 'XMLHttpRequest'
                            },
                            body: fd
                        });

                        const newToken = res.headers.get('X-CSRF-Token');
                        if (newToken) {
                            csrfValue = newToken;
                            document.querySelector('meta[name="csrf-token-value"]').content = newToken;
                        }

                        if (!res.ok) {
                            const text = await res.text();
                            Swal.fire('Action failed', text || 'Error', 'error');
                            return;
                        }

                        let data;
                        const contentType = res.headers.get('content-type') || '';
                        if (contentType.includes('application/json')) {
                            data = await res.json();
                        } else {
                            Swal.fire('Unexpected response', '', 'error');
                            return;
                        }
                        if (!data.ok) {
                            Swal.fire('Action failed', data.message || 'Error', 'error');
                            return;
                        }

                        const row = form.closest('tr');
                        if (action === 'delete' && row) {
                            row.remove();
                        }
                        if (action === 'promote' && row) {
                            const roleCell = row.querySelector('td:nth-child(4) span');
                            if (roleCell) {
                                roleCell.className = 'badge bg-secondary-light text-secondary';
                                roleCell.textContent = 'Admin';
                            }
                        }

                        Swal.fire({
                            title: action === 'delete' ? 'Deleted' : 'Promoted',
                            icon: 'success',
                            toast: true,
                            position: 'top-end',
                            showConfirmButton: false,
                            timer: 1800
                        });

                        refreshStats();
                    } catch (err) {
                        console.warn('Action failed', err);
                        Swal.fire('Action failed', 'Network or server error.', 'error');
                    }
                });
            });
        });

        // Client-side filtering + pagination for the users table
        const usersTable = document.querySelector('[data-users-table]');
        const usersPagination = document.querySelector('[data-users-pagination]');
        const usersServerPager = document.querySelector('[data-users-server-pager]');
        const usersCountIndicator = document.querySelector('[data-users-count]');
        const perPageSelect = document.querySelector('select[name="per_page"]');

        if (usersTable && usersPagination) {
            const userRows = Array.from(usersTable.querySelectorAll('tbody tr[data-user-row]'));
            if (userRows.length) {
                const filters = {
                    search: document.querySelector('[data-user-filter="search"]'),
                    role: document.querySelector('[data-user-filter="role"]')
                };
                const resetTrigger = document.querySelector('[data-reset-filters]');

                let rowsPerPage = Number(perPageSelect?.value) || 10;
                let currentPage = 1;
                let totalPages = 1;

                const emptyRow = usersTable.querySelector('tr[data-empty-row]');
                const paginationList = usersPagination.querySelector('.pagination');
                const prevControl = usersPagination.querySelector('li[data-page-control="prev"]');
                const nextControl = usersPagination.querySelector('li[data-page-control="next"]');

                const normalize = (value) => (value || '').toLowerCase();
                usersServerPager?.classList.add('d-none');

                const getFilteredRows = () => {
                    const searchTerm = normalize(filters.search?.value);
                    const selectedRole = filters.role?.value || '';
                    return userRows.filter((row) => {
                        if (searchTerm && !(row.dataset.search || '').includes(searchTerm)) {
                            return false;
                        }
                        if (selectedRole && (row.dataset.role || '') !== selectedRole) {
                            return false;
                        }
                        return true;
                    });
                };

                const setEmptyState = (visibleRows) => {
                    if (!emptyRow) return;
                    emptyRow.classList.toggle('d-none', visibleRows !== 0);
                };

                const updateCountIndicator = (pageCount) => {
                    if (!usersCountIndicator) return;
                    const total = Number(usersCountIndicator.dataset.total || userRows.length);
                    usersCountIndicator.textContent = `Showing ${pageCount} of ${total} results`;
                };

                const updatePaginationControls = (total) => {
                    if (!paginationList) return;
                    const numberItems = paginationList.querySelectorAll('li[data-page-number]');
                    numberItems.forEach((item) => item.remove());
                    const insertionPoint = nextControl || null;
                    for (let page = 1; page <= total; page += 1) {
                        const li = document.createElement('li');
                        li.className = `page-item${page === currentPage ? ' active' : ''}`;
                        li.dataset.pageNumber = String(page);
                        const link = document.createElement('a');
                        link.className = 'page-link';
                        link.href = '#';
                        link.textContent = page;
                        li.appendChild(link);
                        if (insertionPoint) {
                            paginationList.insertBefore(li, insertionPoint);
                        } else {
                            paginationList.appendChild(li);
                        }
                    }

                    prevControl?.classList.toggle('disabled', currentPage === 1 || total === 0);
                    nextControl?.classList.toggle('disabled', currentPage === total || total === 0);
                };

                const renderTable = () => {
                    const filteredRows = getFilteredRows();
                    totalPages = filteredRows.length ? Math.max(1, Math.ceil(filteredRows.length / rowsPerPage)) : 0;
                    if (currentPage > totalPages && totalPages !== 0) {
                        currentPage = totalPages;
                    }

                    userRows.forEach((row) => row.classList.add('d-none'));

                    if (!filteredRows.length) {
                        setEmptyState(0);
                        updatePaginationControls(0);
                        usersPagination.classList.add('d-none');
                        updateCountIndicator(0);
                        return;
                    }

                    const start = (currentPage - 1) * rowsPerPage;
                    const pageRows = filteredRows.slice(start, start + rowsPerPage);
                    pageRows.forEach((row) => row.classList.remove('d-none'));
                    setEmptyState(pageRows.length);
                    updatePaginationControls(totalPages);
                    usersPagination.classList.toggle('d-none', totalPages <= 1);
                    updateCountIndicator(pageRows.length);
                };

                const resetAndRender = () => {
                    currentPage = 1;
                    renderTable();
                };

                if (resetTrigger) {
                    resetTrigger.addEventListener('click', function(event) {
                        event.preventDefault();
                        if (filters.search) {
                            filters.search.value = '';
                        }
                        if (filters.role) {
                            filters.role.value = '';
                        }
                        if (perPageSelect) {
                            const firstOption = perPageSelect.querySelector('option');
                            if (firstOption) {
                                perPageSelect.value = firstOption.value;
                            }
                        }
                        resetAndRender();
                        var redirectUrl = resetTrigger.getAttribute('data-redirect') || resetTrigger.getAttribute('href');
                        if (redirectUrl) {
                            window.location.href = redirectUrl;
                        }
                    });
                }

                Object.values(filters).forEach((input) => {
                    if (!input) return;
                    const eventName = input.tagName === 'INPUT' ? 'input' : 'change';
                    input.addEventListener(eventName, resetAndRender);
                });

                perPageSelect?.addEventListener('change', () => {
                    rowsPerPage = Number(perPageSelect.value) || 10;
                    resetAndRender();
                });

                usersPagination.addEventListener('click', (event) => {
                    const control = event.target.closest('li');
                    if (!control) return;
                    if (!control.dataset.pageControl && !control.dataset.pageNumber) return;
                    event.preventDefault();

                    if (control.dataset.pageControl === 'prev' && currentPage > 1) {
                        currentPage -= 1;
                        renderTable();
                        return;
                    }

                    if (control.dataset.pageControl === 'next' && currentPage < totalPages) {
                        currentPage += 1;
                        renderTable();
                        return;
                    }

                    if (control.dataset.pageNumber) {
                        const requested = Number(control.dataset.pageNumber);
                        if (!Number.isNaN(requested) && requested !== currentPage) {
                            currentPage = requested;
                            renderTable();
                        }
                    }
                });

                resetAndRender();
            } else {
                usersPagination.classList.add('d-none');
            }
        }
    </script>
</body>
</html>