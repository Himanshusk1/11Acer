<?php
$page_title = $page_title ?? 'Appointments - Admin - 36 Broking Hub';
$appointments = $appointments ?? [];
$metrics = array_merge([
    'total'     => 0,
    'forwarded' => 0,
    'pending'   => 0,
    'declined'  => 0,
], $metrics ?? []);
$autoForwardEnabled = ! empty($autoForwardEnabled);
$cities = $cities ?? [];

$normalizeStatus = static function ($status): string {
    $status = strtolower(trim((string) $status));
    return in_array($status, ['forwarded', 'declined', 'pending'], true) ? $status : 'pending';
};

$statusClasses = [
    'pending'   => 'bg-warning-subtle text-warning',
    'forwarded' => 'bg-success-subtle text-success',
    'declined'  => 'bg-danger-subtle text-danger',
];

$forwardRate = ($metrics['total'] ?? 0) > 0
    ? round((($metrics['forwarded'] ?? 0) / max(1, $metrics['total'])) * 100)
    : 0;
$pendingRate = ($metrics['total'] ?? 0) > 0
    ? round((($metrics['pending'] ?? 0) / max(1, $metrics['total'])) * 100)
    : 0;
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
            --admin-primary-dark: #0f5132;
            --admin-primary-light: #e6fae6;
            --surface: #ffffff;
            --surface-muted: #f5f8f6;
            --border-color: rgba(25, 135, 84, 0.12);
            --text-muted: #6c7c72;
            --shadow-soft: 0 25px 60px rgba(13, 27, 19, 0.09);
            --shadow-hover: 0 35px 80px rgba(13, 27, 19, 0.14);
            --blur: 22px;
            --dark-bg: #0a100e;
            --dark-surface: rgba(18, 26, 23, 0.92);
            --dark-border: rgba(255, 255, 255, 0.08);
        }
        * { box-sizing: border-box; }
        body {
            font-family: 'Inter', sans-serif;
            background: radial-gradient(circle at top, #f3fbf6 0%, #ecf3ed 45%, #e7ede7 100%);
            color: #1c2b20;
            min-height: 100vh;
            overflow-x: hidden;
            position: relative;
        }
        body::before {
            content: '';
            position: fixed;
            inset: 0;
            background: radial-gradient(circle at 10% 20%, rgba(25, 135, 84, 0.15), transparent 45%),
                        radial-gradient(circle at 80% 0%, rgba(15, 81, 50, 0.15), transparent 40%);
            opacity: 0.7;
            pointer-events: none;
        }
        body.dark-mode {
            background: var(--dark-bg);
            color: #ebf5ed;
        }
        body.dark-mode::before { opacity: 0.3; }
        body.dark-mode .sidebar,
        body.dark-mode .topbar,
        body.dark-mode .hero-panel,
        body.dark-mode .stat-card,
        body.dark-mode .glass-card,
        body.dark-mode .table-wrapper,
        body.dark-mode .feedback-highlights {
            background: var(--dark-surface);
            border-color: var(--dark-border);
            color: inherit;
            box-shadow: 0 25px 50px rgba(0, 0, 0, 0.35);
        }
        body.dark-mode .stat-card .icon { background: rgba(25, 135, 84, 0.16); }
        body.dark-mode .table-wrapper .table thead { background: rgba(255, 255, 255, 0.05); }
        body.dark-mode .badge { color: #f3fff6; }
        body.dark-mode .filter-bar .form-control,
        body.dark-mode .filter-bar .form-select {
            background: rgba(255, 255, 255, 0.08);
            border-color: transparent;
            color: inherit;
        }
        body.dark-mode .icon-btn { background: rgba(255, 255, 255, 0.08); color: #eaf6ef; }
        body.dark-mode .icon-btn:hover { background: rgba(25, 135, 84, 0.6); }

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
        .sidebar-header { font-size: 1.5rem; font-weight: 700; color: #fff; text-align: center; margin-bottom: 2.5rem; }
        .sidebar-header span { color: var(--admin-primary); }
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
        .sidebar .nav-link .icon { margin-right: 0.75rem; font-size: 1.1rem; }
        .sidebar .nav-link:hover { background-color: rgba(255,255,255,0.08); color: #fff; transform: translateX(6px); }
        .sidebar .nav-link.active {
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
        .main-content {
            margin-left: 260px;
            margin-top: 70px;
            padding: 2.5rem 2.7rem 3rem;
            min-height: calc(100vh - 70px);
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
            top: -40%; right: -10%;
            width: 320px; height: 320px;
            background: radial-gradient(circle, rgba(255, 255, 255, 0.45), transparent 65%);
            opacity: 0.7;
            z-index: 0;
        }
        .hero-panel > * { position: relative; z-index: 1; }
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
        .hero-metric span { font-size: 0.85rem; opacity: 0.85; }
        .btn-brand { background: var(--admin-primary); border-color: var(--admin-primary); color: #fff; }
        .btn-brand:hover { background: var(--admin-primary-dark); border-color: var(--admin-primary-dark); }

        .stat-card,
        .glass-card,
        .table-wrapper,
        .feedback-highlights {
            background: var(--surface);
            border-radius: 24px;
            border: 1px solid var(--border-color);
            box-shadow: var(--shadow-soft);
            padding: 1.6rem;
            transition: transform 0.25s ease, box-shadow 0.25s ease;
        }
        .stat-card { position: relative; overflow: hidden; }
        .stat-card::after {
            content: '';
            position: absolute;
            top: var(--mouse-y, 50%);
            left: var(--mouse-x, 50%);
            transform: translate(-50%, -50%);
            width: 0;
            height: 0;
            border-radius: 50%;
            background: radial-gradient(circle, rgba(25, 135, 84, 0.15), transparent 60%);
            transition: width 0.4s ease, height 0.4s ease;
            pointer-events: none;
        }
        .stat-card:hover::after { width: 220px; height: 220px; }
        .stat-card:hover { transform: translateY(-4px); box-shadow: var(--shadow-hover); }
        .stat-card .icon {
            width: 54px;
            height: 54px;
            border-radius: 16px;
            background: rgba(25, 135, 84, 0.12);
            color: var(--admin-primary);
            display: inline-flex;
            align-items: center;
            justify-content: center;
            font-size: 1.35rem;
        }

        .table-wrapper { margin-top: 1rem; }
        .table-wrapper .table-responsive { border-radius: 22px; overflow: hidden; }
        .table { margin: 0; }
        .table thead { background: linear-gradient(120deg, rgba(25, 135, 84, 0.1), rgba(25, 135, 84, 0.02)); }
        .table thead th { border: none; font-size: 0.85rem; letter-spacing: 0.03em; text-transform: uppercase; }
        .table tbody tr { transition: background 0.2s ease; }
        .table tbody tr:hover { background: rgba(25, 135, 84, 0.05); }
        .table tbody td { border-bottom: 1px solid rgba(25, 135, 84, 0.08); }
        .badge { border-radius: 999px; font-weight: 500; padding: 0.35rem 0.75rem; }
        /* Horizontal scroll when filters overflow */
        .filter-bar {
            display: flex;
            gap: 0.75rem;
            flex-wrap: nowrap;
            overflow-x: auto;
            padding-bottom: 0.35rem;
            -webkit-overflow-scrolling: touch;
            scrollbar-width: thin;
            scrollbar-color: rgba(25, 135, 84, 0.35) transparent;
        }
        .filter-bar::-webkit-scrollbar { height: 6px; }
        .filter-bar::-webkit-scrollbar-thumb {
            background: rgba(25, 135, 84, 0.35);
            border-radius: 999px;
        }
        .filter-bar > * {
            flex: 0 0 auto;
        }
        .filter-bar .form-control,
        .filter-bar .form-select {
            border-radius: 14px;
            border: 1px solid var(--border-color);
            padding: 0.6rem 1rem;
            min-width: 180px;
        }

        #sidebar-backdrop.backdrop {
            position: fixed;
            top: 0; left: 0; right: 0; bottom: 0;
            background: rgba(0, 0, 0, 0.55);
            z-index: 1000;
            opacity: 0;
            pointer-events: none;
            transition: opacity 0.3s ease;
        }
        #sidebar-backdrop.backdrop.visible:not(.d-none) {
            opacity: 1;
            pointer-events: auto;
            z-index: 1025;
        }

        .toggle-card {
            background: rgba(255, 255, 255, 0.25);
            border-radius: 18px;
            padding: 1rem 1.2rem;
            color: #000000ff;
            backdrop-filter: blur(14px);
        }
        .toggle-card .form-check-input:checked { background-color: var(--admin-primary); border-color: var(--admin-primary); }
        .toggle-card .form-check-input:not(:checked) { background-color: rgba(255, 255, 255, 0.45); border-color: transparent; }
        .toggle-card small { color: rgba(0, 0, 0, 0.85); }

        @media (max-width: 991.98px) {
            .sidebar { transform: translateX(-100%); }
            .sidebar.active { transform: translateX(0); }
            .main-content { margin-left: 0; padding: 2rem 1.5rem 2.5rem; }
            .topbar { left: 0; padding: 0 1.25rem; }
            .hero-panel { border-radius: 26px; }
        }
        @media (max-width: 575.98px) {
            .hero-panel { padding: 1.4rem; }
            .filter-bar {
                margin: 0 -0.35rem;
                padding: 0 0.35rem 0.5rem;
            }
            .filter-bar > * {
                min-width: 200px;
            }
            .hero-metrics { grid-template-columns: repeat(2, minmax(0, 1fr)); }
        }
    </style>
</head>
<body>
    <?= view('admin/partials/sidebar', ['active' => $active ?? 'appointments']) ?>
    <?= view('admin/partials/topbar', ['showDarkToggle' => true, 'userRole' => 'Operations Lead']) ?>

    <main class="main-content" id="main-content">
        <section class="hero-panel mb-4" data-aos="fade-up">
            <span class="badge-soft"><i class="bi bi-calendar-check"></i> Appointment Ops</span>
            <div class="row align-items-center mt-3 g-4">
                <div class="col-xl-7">
                    <h1 class="h3 mb-3">Appointment Requests</h1>
                    <p class="text-muted mb-4">Track incoming client appointments, coordinate with partner agents, and keep routing insights current in a single console.</p>
                    <div class="d-flex flex-wrap gap-2">
                        <button type="button" class="btn btn-outline-success" data-appointments-reset><i class="bi bi-funnel me-2"></i>Reset Filters</button>
                        <a href="<?= site_url('admin/appointments') ?>" class="btn btn-outline-secondary"><i class="bi bi-arrow-clockwise me-2"></i>Refresh View</a>
                    </div>
                </div>
                <div class="col-xl-5">
                    <div class="hero-metrics">
                        <div class="hero-metric">
                            <span>Total Appointments</span>
                            <h3 class="mb-0" data-metric-total><?= esc(number_format($metrics['total'])) ?></h3>
                            <small>Captured in pipeline</small>
                        </div>
                        <div class="hero-metric">
                            <span>Forwarded</span>
                            <h3 class="mb-0" data-metric-forwarded><?= esc(number_format($metrics['forwarded'])) ?></h3>
                            <small>Sent to agents</small>
                        </div>
                        <div class="hero-metric">
                            <span>Pending</span>
                            <h3 class="mb-0" data-metric-pending><?= esc(number_format($metrics['pending'])) ?></h3>
                            <small>Awaiting routing</small>
                        </div>
                        <div class="hero-metric">
                            <span>Declined</span>
                            <h3 class="mb-0" data-metric-declined><?= esc(number_format($metrics['declined'])) ?></h3>
                            <small>Closed out</small>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row g-3 mt-3">
                <div class="col-md-6 col-lg-5 col-xl-4">
                    <div class="toggle-card d-flex align-items-center justify-content-between gap-3">
                        <div>
                            <div class="form-check form-switch m-0">
                                <input class="form-check-input" type="checkbox" role="switch" id="auto-forward-toggle" data-auto-forward-toggle <?= $autoForwardEnabled ? 'checked' : '' ?>>
                                <label class="form-check-label fw-semibold" for="auto-forward-toggle">Auto Forward Appointments</label>
                            </div>
                            <small class="d-block mt-1" data-auto-forward-status><?= $autoForwardEnabled ? 'Auto-forward is active; new appointments reach agents instantly.' : 'Manual triage is active; review each request before sending.' ?></small>
                        </div>
                        <i class="bi bi-lightning-charge-fill fs-3"></i>
                    </div>
                </div>
            </div>
        </section>

        <div class="row g-4 mb-4">
            <div class="col-sm-6 col-xl-3" data-aos="fade-up">
                <div class="stat-card">
                    <div class="d-flex align-items-center justify-content-between">
                        <div>
                            <p class="text-muted small mb-1">Appointments Logged</p>
                            <p class="fs-4 fw-bold mb-0" data-stat-total><?= esc(number_format($metrics['total'])) ?></p>
                            <span class="text-success small">Live sync enabled</span>
                        </div>
                        <div class="icon"><i class="bi bi-calendar3"></i></div>
                    </div>
                </div>
            </div>
            <div class="col-sm-6 col-xl-3" data-aos="fade-up" data-aos-delay="60">
                <div class="stat-card">
                    <div class="d-flex align-items-center justify-content-between">
                        <div>
                            <p class="text-muted small mb-1">Forward Rate</p>
                            <p class="fs-4 fw-bold mb-0" data-stat-forward-rate><?= esc(number_format($forwardRate)) ?>%</p>
                            <span class="text-primary small">Agent routing</span>
                        </div>
                        <div class="icon"><i class="bi bi-send-check"></i></div>
                    </div>
                </div>
            </div>
            <div class="col-sm-6 col-xl-3" data-aos="fade-up" data-aos-delay="120">
                <div class="stat-card">
                    <div class="d-flex align-items-center justify-content-between">
                        <div>
                            <p class="text-muted small mb-1">Pending Queue</p>
                            <p class="fs-4 fw-bold mb-0" data-stat-pending><?= esc(number_format($metrics['pending'])) ?></p>
                            <span class="text-warning small"><?= esc($pendingRate) ?>% awaiting action</span>
                        </div>
                        <div class="icon"><i class="bi bi-hourglass-split"></i></div>
                    </div>
                </div>
            </div>
            <div class="col-sm-6 col-xl-3" data-aos="fade-up" data-aos-delay="180">
                <div class="stat-card">
                    <div class="d-flex align-items-center justify-content-between">
                        <div>
                            <p class="text-muted small mb-1">Declined</p>
                            <p class="fs-4 fw-bold mb-0" data-stat-declined><?= esc(number_format($metrics['declined'])) ?></p>
                            <span class="text-danger small">Archived requests</span>
                        </div>
                        <div class="icon"><i class="bi bi-x-octagon"></i></div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row g-4">
            <div class="col-12" data-aos="fade-up">
                <div class="table-wrapper">
                    <div class="d-flex flex-wrap justify-content-between align-items-center gap-3 mb-3">
                        <div>
                            <h3 class="h5 mb-1">Appointment Inbox</h3>
                            <p class="text-muted small mb-0">Chronological feed with routing controls and SLA context.</p>
                        </div>
                        <div class="d-flex filter-bar gap-2">
                            <input type="text" class="form-control" placeholder="Search name, phone, or email" data-appointments-search>
                            <select class="form-select" data-appointments-status>
                                <option value="">Status</option>
                                <option value="pending">Pending</option>
                                <option value="forwarded">Forwarded</option>
                                <option value="declined">Declined</option>
                            </select>
                            <select class="form-select" data-appointments-city>
                                <option value="">City</option>
                                <?php foreach ($cities as $city): ?>
                                    <option value="<?= esc(strtolower($city)) ?>"><?= esc($city) ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                    </div>
                    <div class="table-responsive">
                        <table class="table align-middle table-hover mb-0" data-appointments-table>
                            <thead class="table-light">
                                <tr>
                                    <th>S. No.</th>
                                    <th>Client Name</th>
                                    <th>Phone</th>
                                    <th>Email</th>
                                    <th>Agent Name</th>
                                    <th>City</th>
                                    <th>Service</th>
                                    <th>Preferred Date</th>
                                    <th>Preferred Time</th>
                                    <th>Status</th>
                                    <th>Created At</th>
                                    <th class="text-end">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if (empty($appointments)): ?>
                                    <tr>
                                        <td colspan="12" class="text-center text-muted fst-italic">No appointments available yet.</td>
                                    </tr>
                                <?php else: ?>
                                    <?php foreach ($appointments as $index => $appointment): ?>
                                        <?php
                                            $appointmentId = (int) ($appointment['id'] ?? 0);
                                            $status = $normalizeStatus($appointment['status'] ?? 'pending');
                                            $badgeClass = $statusClasses[$status] ?? $statusClasses['pending'];
                                            $preferredDate = ! empty($appointment['preferred_date']) ? date('d M Y', strtotime($appointment['preferred_date'])) : 'N/A';
                                            $createdAt = ! empty($appointment['created_at']) ? date('d M Y, h:i A', strtotime($appointment['created_at'])) : 'N/A';
                                            $searchHaystack = strtolower(trim(
                                                ($appointment['name'] ?? '') . ' ' .
                                                ($appointment['phone'] ?? '') . ' ' .
                                                ($appointment['email'] ?? '') . ' ' .
                                                ($appointment['agent_name'] ?? '') . ' ' .
                                                ($appointment['agent_service'] ?? '')
                                            ));
                                            $citySlug = strtolower(trim((string) ($appointment['agent_city'] ?? '')));
                                            $forwardDisabled = $status !== 'pending';
                                            $declineDisabled = $status !== 'pending';
                                        ?>
                                        <tr
                                            data-appointment-row
                                            data-appointment-id="<?= esc((string) $appointmentId) ?>"
                                            data-appointment-search="<?= esc($searchHaystack) ?>"
                                            data-appointment-status="<?= esc($status) ?>"
                                            data-appointment-city="<?= esc($citySlug) ?>"
                                        >
                                            <td><?= esc($index + 1) ?></td>
                                            <td><?= esc($appointment['name'] ?? 'Unknown') ?></td>
                                            <td><?= esc($appointment['phone'] ?? '—') ?></td>
                                            <td><?= esc($appointment['email'] ?? '—') ?></td>
                                            <td><?= esc($appointment['agent_name'] ?? '—') ?></td>
                                            <td><?= esc($appointment['agent_city'] ?? '—') ?></td>
                                            <td><?= esc($appointment['agent_service'] ?? '—') ?></td>
                                            <td><?= esc($preferredDate) ?></td>
                                            <td><?= esc($appointment['preferred_time'] ?? 'N/A') ?></td>
                                            <td>
                                                <span class="badge <?= $badgeClass ?>" data-status-badge><?= esc(ucfirst($status)) ?></span>
                                            </td>
                                            <td><?= esc($createdAt) ?></td>
                                            <td class="text-end">
                                                <div class="d-inline-flex flex-wrap justify-content-end gap-1">
                                                    <button type="button" class="btn btn-sm btn-outline-secondary js-appointment-view" data-appointment-view="<?= esc((string) $appointmentId) ?>">
                                                        <i class="bi bi-eye"></i> View
                                                    </button>
                                                    <span class="d-inline-flex" data-action-wrapper="forward" <?= $forwardDisabled ? 'data-bs-toggle="tooltip" data-bs-placement="bottom" title="' . esc($status === 'forwarded' ? 'Already forwarded to the agent success pod.' : 'Declined appointments cannot be forwarded.') . '"' : '' ?>>
                                                        <button type="button" class="btn btn-sm <?= $status === 'forwarded' ? 'btn-success' : 'btn-outline-success' ?> js-appointment-forward" data-appointment-forward="<?= esc((string) $appointmentId) ?>" <?= $forwardDisabled ? 'disabled aria-disabled="true"' : '' ?>>
                                                            <i class="bi bi-send<?= $status === 'forwarded' ? '-check' : '' ?>"></i> <?= $status === 'forwarded' ? 'Forwarded' : 'Forward' ?>
                                                        </button>
                                                    </span>
                                                    <span class="d-inline-flex" data-action-wrapper="decline" <?= $declineDisabled ? 'data-bs-toggle="tooltip" data-bs-placement="bottom" title="' . esc($status === 'declined' ? 'Already declined and archived.' : 'Forwarded appointments cannot be declined.') . '"' : '' ?>>
                                                        <button type="button" class="btn btn-sm <?= $status === 'declined' ? 'btn-danger' : 'btn-outline-danger' ?> js-appointment-decline" data-appointment-decline="<?= esc((string) $appointmentId) ?>" <?= $declineDisabled ? 'disabled aria-disabled="true"' : '' ?>>
                                                            <i class="bi bi-x-circle<?= $status === 'declined' ? '-fill' : '' ?>"></i> <?= $status === 'declined' ? 'Declined' : 'Decline' ?>
                                                        </button>
                                                    </span>
                                                </div>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                    <tr class="text-center text-muted fst-italic d-none" data-empty-row>
                                        <td colspan="12">No appointments match the selected filters.</td>
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
                            <h5 class="mb-1">Routing Queue</h5>
                            <p class="text-muted small mb-0">Pending follow-ups</p>
                        </div>
                        <span class="badge bg-warning-subtle text-warning" data-metric-pending-badge><?= esc($metrics['pending']) ?> open</span>
                    </div>
                    <ul class="list-group list-unstyled mb-0" data-pending-list>
                        <?php
                        $pendingEntries = array_filter($appointments, static function ($item) use ($normalizeStatus) {
                            return $normalizeStatus($item['status'] ?? 'pending') === 'pending';
                        });
                        if (empty($pendingEntries)):
                        ?>
                            <li class="text-muted fst-italic">All appointments are routed. Great job! 🎉</li>
                        <?php else: ?>
                            <?php foreach ($pendingEntries as $pending): ?>
                                <li class="list-group-item d-flex align-items-start justify-content-between" data-pending-item="<?= esc((string) ($pending['id'] ?? 0)) ?>">
                                    <div>
                                        <strong><?= esc($pending['name'] ?? 'Unknown') ?></strong>
                                        <p class="text-muted small mb-0">Agent: <?= esc($pending['agent_name'] ?? 'Unassigned') ?> • <?= esc($pending['phone'] ?? 'N/A') ?></p>
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
                            <h5 class="mb-1">Operations Signals</h5>
                            <p class="text-muted small mb-0">Indicators worth watching</p>
                        </div>
                        <span class="small text-muted" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Analytics deep-dive will be linked once routing reports go live">Insights dashboard in progress</span>
                    </div>
                    <div class="row g-3">
                        <div class="col-md-6">
                            <div class="p-3 border rounded-4 h-100">
                                <p class="text-muted small mb-1">Fastest response city</p>
                                <h6 class="mb-2">Bengaluru</h6>
                                <p class="mb-0 text-muted small">Average routing time down to 25 minutes for the last 7 days.</p>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="p-3 border rounded-4 h-100">
                                <p class="text-muted small mb-1">High intent service</p>
                                <h6 class="mb-2">Luxury residential</h6>
                                <p class="mb-0 text-muted small">63% of recent requests convert after a forwarded touchpoint.</p>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="p-3 border rounded-4 h-100">
                                <p class="text-muted small mb-1">Queue at risk</p>
                                <h6 class="mb-2">Weekend backlog</h6>
                                <p class="mb-0 text-muted small">Pending appointments spike 32% on Saturday evenings—plan agent roster.</p>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="p-3 border rounded-4 h-100">
                                <p class="text-muted small mb-1">Next sprint focus</p>
                                <h6 class="mb-2">Automated reminders</h6>
                                <p class="mb-0 text-muted small">Pilot SMS nudges for clients awaiting confirmations beyond 12 hours.</p>
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
            if (typeof Swal === 'undefined') {
                console.error('SweetAlert2 is required for the appointments console.');
                return;
            }

            const body = document.body;
            const sidebar = document.getElementById('admin-sidebar');
            const toggler = document.getElementById('sidebar-toggler');
            const backdrop = document.getElementById('sidebar-backdrop');
            const darkToggle = document.getElementById('dark-mode-toggle');

            const THEME_KEY = 'adminTheme';
            const CSRF_NAME = <?= json_encode(csrf_token()) ?>;
            let CSRF_HASH = <?= json_encode(csrf_hash()) ?>;

            const ENDPOINTS = {
                view: <?= json_encode(site_url('admin/appointments/view')) ?>,
                forward: <?= json_encode(site_url('admin/appointments/forward')) ?>,
                decline: <?= json_encode(site_url('admin/appointments/decline')) ?>,
                autoForward: <?= json_encode(site_url('admin/appointments/auto-forward')) ?>,
            };

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
                const tooltipElements = Array.prototype.slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
                tooltipElements.forEach(el => {
                    try {
                        if (el.__tooltipInstance) {
                            el.__tooltipInstance.dispose();
                        }
                        const instance = new window.bootstrap.Tooltip(el);
                        el.__tooltipInstance = instance;
                    } catch (error) {
                        console.warn('Unable to initialize tooltip', error);
                    }
                });
            };
            initTooltips();

            const syncCsrf = hash => {
                if (!hash) {
                    return;
                }
                CSRF_HASH = hash;
                document.querySelectorAll(`input[name="${CSRF_NAME}"]`).forEach(input => {
                    input.value = hash;
                });
            };

            const escapeHtml = value => String(value ?? '').replace(/[&<>"']/g, char => ({
                '&': '&amp;',
                '<': '&lt;',
                '>': '&gt;',
                '"': '&quot;',
                "'": '&#39;',
            })[char] || char);

            const table = document.querySelector('[data-appointments-table]');
            const searchInput = document.querySelector('[data-appointments-search]');
            const statusSelect = document.querySelector('[data-appointments-status]');
            const citySelect = document.querySelector('[data-appointments-city]');
            const resetButton = document.querySelector('[data-appointments-reset]');

            const metricElements = {
                total: document.querySelector('[data-metric-total]'),
                forwarded: document.querySelector('[data-metric-forwarded]'),
                pending: document.querySelector('[data-metric-pending]'),
                declined: document.querySelector('[data-metric-declined]'),
            };
            const statElements = {
                total: document.querySelector('[data-stat-total]'),
                pending: document.querySelector('[data-stat-pending]'),
                declined: document.querySelector('[data-stat-declined]'),
                forwardRate: document.querySelector('[data-stat-forward-rate]'),
                pendingBadge: document.querySelector('[data-metric-pending-badge]'),
            };
            const pendingList = document.querySelector('[data-pending-list]');

            const updateMetricsUI = metrics => {
                if (metrics && typeof metrics === 'object') {
                    const total = Number(metrics.total ?? 0);
                    const forwarded = Number(metrics.forwarded ?? 0);
                    const pending = Number(metrics.pending ?? 0);
                    const declined = Number(metrics.declined ?? 0);
                    const forwardRate = total > 0 ? Math.round((forwarded / total) * 100) : 0;
                    const pendingRate = total > 0 ? Math.round((pending / total) * 100) : 0;

                    metricElements.total && (metricElements.total.textContent = total.toLocaleString());
                    metricElements.forwarded && (metricElements.forwarded.textContent = forwarded.toLocaleString());
                    metricElements.pending && (metricElements.pending.textContent = pending.toLocaleString());
                    metricElements.declined && (metricElements.declined.textContent = declined.toLocaleString());

                    statElements.total && (statElements.total.textContent = total.toLocaleString());
                    statElements.pending && (statElements.pending.textContent = pending.toLocaleString());
                    statElements.declined && (statElements.declined.textContent = declined.toLocaleString());
                    statElements.forwardRate && (statElements.forwardRate.textContent = `${forwardRate}%`);
                    statElements.pending && statElements.pending.setAttribute('data-pending-count', pending);
                    statElements.pending && statElements.pending.nextElementSibling && (statElements.pending.nextElementSibling.textContent = `${pendingRate}% awaiting action`);
                    statElements.pendingBadge && (statElements.pendingBadge.textContent = `${pending.toLocaleString()} open`);
                }
            };

            const refreshPendingList = () => {
                if (!pendingList) {
                    return;
                }
                const rows = table ? Array.from(table.querySelectorAll('tbody tr[data-appointment-row]')) : [];
                const pendingRows = rows.filter(row => (row.dataset.appointmentStatus || '') === 'pending');
                const emptyState = pendingList.querySelector('[data-empty-placeholder]');
                if (!pendingRows.length) {
                    if (!emptyState) {
                        pendingList.innerHTML = '<li class="text-muted fst-italic" data-empty-placeholder>All appointments are routed. Great job! 🎉</li>';
                    }
                    return;
                }

                pendingList.innerHTML = pendingRows.map(row => {
                    const name = escapeHtml(row.children[1]?.textContent || 'Unknown');
                    const agent = escapeHtml(row.children[4]?.textContent || 'Unassigned');
                    const phone = escapeHtml(row.children[2]?.textContent || 'N/A');
                    const id = escapeHtml(row.dataset.appointmentId || '');
                    return `<li class="list-group-item d-flex align-items-start justify-content-between" data-pending-item="${id}"><div><strong>${name}</strong><p class="text-muted small mb-0">Agent: ${agent} • ${phone}</p></div><span class="badge bg-secondary-subtle text-secondary">Awaiting</span></li>`;
                }).join('');
            };

            if (table) {
                const rows = Array.from(table.querySelectorAll('tbody tr[data-appointment-row]'));
                const emptyRow = table.querySelector('[data-empty-row]');

                const applyFilters = () => {
                    const searchTerm = (searchInput?.value || '').trim().toLowerCase();
                    const statusFilter = (statusSelect?.value || '').trim();
                    const cityFilter = (citySelect?.value || '').trim();

                    let shown = 0;
                    rows.forEach(row => {
                        const matchesSearch = !searchTerm || (row.dataset.appointmentSearch || '').includes(searchTerm);
                        const matchesStatus = !statusFilter || (row.dataset.appointmentStatus || '') === statusFilter;
                        const matchesCity = !cityFilter || (row.dataset.appointmentCity || '') === cityFilter;
                        const visible = matchesSearch && matchesStatus && matchesCity;
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
                statusSelect?.addEventListener('change', applyFilters);
                citySelect?.addEventListener('change', applyFilters);
                resetButton?.addEventListener('click', () => {
                    if (searchInput) {
                        searchInput.value = '';
                    }
                    if (statusSelect) {
                        statusSelect.value = '';
                    }
                    if (citySelect) {
                        citySelect.value = '';
                    }
                    applyFilters();
                    searchInput?.focus();
                });

                applyFilters();
            }

            const statusStyles = {
                forwarded: {
                    label: 'Forwarded',
                    badge: 'badge bg-success-subtle text-success',
                },
                pending: {
                    label: 'Pending',
                    badge: 'badge bg-warning-subtle text-warning',
                },
                declined: {
                    label: 'Declined',
                    badge: 'badge bg-danger-subtle text-danger',
                },
            };

            const updateRowState = (row, status) => {
                if (!row) {
                    return;
                }
                const safeStatus = statusStyles[status] ? status : 'pending';
                const config = statusStyles[safeStatus];
                const badge = row.querySelector('[data-status-badge]');
                if (badge) {
                    badge.className = config.badge;
                    badge.textContent = config.label;
                }
                row.dataset.appointmentStatus = safeStatus;

                const forwardWrapper = row.querySelector('[data-action-wrapper="forward"]');
                const forwardBtn = row.querySelector('.js-appointment-forward');
                const declineWrapper = row.querySelector('[data-action-wrapper="decline"]');
                const declineBtn = row.querySelector('.js-appointment-decline');

                const resetTooltip = (wrapper, title) => {
                    if (!wrapper) return;
                    wrapper.setAttribute('title', title || '');
                    wrapper.setAttribute('data-bs-original-title', title || '');
                    if (title) {
                        wrapper.setAttribute('data-bs-toggle', 'tooltip');
                        wrapper.setAttribute('data-bs-placement', 'bottom');
                    } else {
                        wrapper.removeAttribute('data-bs-toggle');
                        wrapper.removeAttribute('data-bs-original-title');
                        wrapper.removeAttribute('title');
                    }
                };

                if (forwardBtn) {
                    if (safeStatus === 'pending') {
                        forwardBtn.disabled = false;
                        forwardBtn.classList.remove('btn-success');
                        forwardBtn.classList.add('btn-outline-success');
                        forwardBtn.innerHTML = '<i class="bi bi-send"></i> Forward';
                        resetTooltip(forwardWrapper, 'Route this appointment to the assigned team.');
                    } else {
                        forwardBtn.disabled = true;
                        forwardBtn.classList.remove('btn-outline-success');
                        forwardBtn.classList.add('btn-success');
                        forwardBtn.innerHTML = '<i class="bi bi-send-check"></i> Forwarded';
                        const title = safeStatus === 'forwarded'
                            ? 'Already forwarded to the agent success pod.'
                            : 'Declined appointments cannot be forwarded.';
                        resetTooltip(forwardWrapper, title);
                    }
                }

                if (declineBtn) {
                    if (safeStatus === 'pending') {
                        declineBtn.disabled = false;
                        declineBtn.classList.remove('btn-danger');
                        declineBtn.classList.add('btn-outline-danger');
                        declineBtn.innerHTML = '<i class="bi bi-x-circle"></i> Decline';
                        resetTooltip(declineWrapper, 'Decline this appointment and archive it.');
                    } else {
                        declineBtn.disabled = true;
                        declineBtn.classList.remove('btn-outline-danger');
                        declineBtn.classList.add('btn-danger');
                        declineBtn.innerHTML = safeStatus === 'declined'
                            ? '<i class="bi bi-x-circle-fill"></i> Declined'
                            : '<i class="bi bi-x-circle"></i> Decline';
                        const title = safeStatus === 'forwarded'
                            ? 'Forwarded appointments cannot be declined.'
                            : 'Already declined and archived.';
                        resetTooltip(declineWrapper, title);
                    }
                }

                initTooltips();
            };

            const handleAction = async (type, id) => {
                const endpoint = ENDPOINTS[type];
                if (!endpoint) {
                    throw new Error('Unknown endpoint for action.');
                }

                const url = `${endpoint}/${encodeURIComponent(id)}`;
                const formData = new FormData();
                formData.append(CSRF_NAME, CSRF_HASH);

                const response = await fetch(url, {
                    method: 'POST',
                    body: formData,
                    headers: {
                        'X-Requested-With': 'XMLHttpRequest',
                    },
                    credentials: 'same-origin',
                });

                const data = await response.json().catch(() => ({ success: false, message: 'Invalid server response.' }));
                if (data?.csrfHash) {
                    syncCsrf(data.csrfHash);
                }

                if (!response.ok || !data?.success) {
                    throw new Error(data?.message || 'Unable to update appointment.');
                }

                return data;
            };

            document.addEventListener('click', async event => {
                const viewBtn = event.target.closest('.js-appointment-view');
                if (viewBtn) {
                    const id = viewBtn.dataset.appointmentView;
                    if (!id) {
                        return;
                    }

                    try {
                        const response = await fetch(`${ENDPOINTS.view}/${encodeURIComponent(id)}`, {
                            headers: { 'Accept': 'application/json' },
                            credentials: 'same-origin',
                        });
                        const data = await response.json().catch(() => null);
                        if (data?.csrfHash) {
                            syncCsrf(data.csrfHash);
                        }
                        if (!response.ok || !data?.success || !data.details) {
                            throw new Error(data?.message || 'Unable to load appointment details.');
                        }
                        const rows = Object.entries(data.details)
                            .map(([label, value]) => `<tr><th class="text-start text-muted">${escapeHtml(label)}</th><td class="text-start">${escapeHtml(value)}</td></tr>`)
                            .join('');
                        await Swal.fire({
                            title: 'Appointment details',
                            html: `<div class="table-responsive"><table class="table table-sm">${rows}</table></div>`,
                            confirmButtonText: 'Close',
                        });
                    } catch (error) {
                        await Swal.fire({
                            title: 'Unable to load',
                            text: error.message || 'Something went wrong.',
                            icon: 'error',
                            confirmButtonColor: '#198754',
                        });
                    }
                }

                const forwardBtn = event.target.closest('.js-appointment-forward');
                if (forwardBtn) {
                    const id = forwardBtn.dataset.appointmentForward;
                    if (!id || forwardBtn.disabled) {
                        return;
                    }

                    const confirmForward = await Swal.fire({
                        title: 'Forward this appointment?',
                        text: 'The assigned agent will be notified immediately.',
                        icon: 'question',
                        showCancelButton: true,
                        confirmButtonText: 'Yes, forward',
                        cancelButtonText: 'Cancel',
                        reverseButtons: true,
                        confirmButtonColor: '#198754',
                        cancelButtonColor: '#6c757d',
                    });

                    if (!confirmForward.isConfirmed) {
                        return;
                    }

                    forwardBtn.disabled = true;

                    try {
                        const data = await handleAction('forward', id);
                        const row = forwardBtn.closest('tr[data-appointment-row]');
                        updateRowState(row, data.status || 'forwarded');
                        if (data.metrics) {
                            updateMetricsUI(data.metrics);
                            refreshPendingList();
                        }
                        await Swal.fire({
                            title: 'Forwarded',
                            text: data.message || 'Appointment forwarded successfully.',
                            icon: 'success',
                            confirmButtonColor: '#198754',
                        });
                    } catch (error) {
                        forwardBtn.disabled = false;
                        await Swal.fire({
                            title: 'Unable to forward',
                            text: error.message || 'Please try again later.',
                            icon: 'error',
                            confirmButtonColor: '#198754',
                        });
                    }
                }

                const declineBtn = event.target.closest('.js-appointment-decline');
                if (declineBtn) {
                    const id = declineBtn.dataset.appointmentDecline;
                    if (!id || declineBtn.disabled) {
                        return;
                    }

                    const confirmDecline = await Swal.fire({
                        title: 'Decline this appointment?',
                        text: 'The request will be archived and removed from the routing queue.',
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonText: 'Yes, decline',
                        cancelButtonText: 'Cancel',
                        reverseButtons: true,
                        confirmButtonColor: '#dc3545',
                        cancelButtonColor: '#6c757d',
                    });

                    if (!confirmDecline.isConfirmed) {
                        return;
                    }

                    declineBtn.disabled = true;

                    try {
                        const data = await handleAction('decline', id);
                        const row = declineBtn.closest('tr[data-appointment-row]');
                        updateRowState(row, data.status || 'declined');
                        if (data.metrics) {
                            updateMetricsUI(data.metrics);
                            refreshPendingList();
                        }
                        await Swal.fire({
                            title: 'Declined',
                            text: data.message || 'Appointment declined successfully.',
                            icon: 'success',
                            confirmButtonColor: '#198754',
                        });
                    } catch (error) {
                        declineBtn.disabled = false;
                        await Swal.fire({
                            title: 'Unable to decline',
                            text: error.message || 'Please try again later.',
                            icon: 'error',
                            confirmButtonColor: '#198754',
                        });
                    }
                }
            });

            refreshPendingList();

            const autoForwardToggle = document.querySelector('[data-auto-forward-toggle]');
            const autoForwardStatus = document.querySelector('[data-auto-forward-status]');
            if (autoForwardToggle) {
                autoForwardToggle.addEventListener('change', async () => {
                    const enabled = autoForwardToggle.checked;
                    autoForwardToggle.disabled = true;
                    const formData = new FormData();
                    formData.append('enabled', enabled ? '1' : '0');
                    formData.append(CSRF_NAME, CSRF_HASH);

                    try {
                        const response = await fetch(ENDPOINTS.autoForward, {
                            method: 'POST',
                            body: formData,
                            headers: { 'X-Requested-With': 'XMLHttpRequest' },
                            credentials: 'same-origin',
                        });
                        const data = await response.json().catch(() => null);
                        if (data?.csrfHash) {
                            syncCsrf(data.csrfHash);
                        }
                        if (!response.ok || !data?.success) {
                            throw new Error(data?.message || 'Unable to update auto-forward preference.');
                        }
                        autoForwardStatus && (autoForwardStatus.textContent = data.autoForwardEnabled
                            ? 'Auto-forward is active; new appointments reach agents instantly.'
                            : 'Manual triage is active; review each request before sending.');
                        await Swal.fire({
                            title: 'Preference saved',
                            text: data.message || 'Auto-forward preference updated.',
                            icon: 'success',
                            confirmButtonColor: '#198754',
                        });
                    } catch (error) {
                        autoForwardToggle.checked = !enabled;
                        await Swal.fire({
                            title: 'Unable to update',
                            text: error.message || 'Please try again later.',
                            icon: 'error',
                            confirmButtonColor: '#198754',
                        });
                    } finally {
                        autoForwardToggle.disabled = false;
                    }
                });
            }
        });
    })();
    </script>
</body>
</html>
