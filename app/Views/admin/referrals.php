<?php
$page_title = 'Referrals - Admin - 11 Acer';
$formatCurrency = static function ($amount): string {
    return 'Rs ' . number_format((float) $amount, 0, '.', ',');
};
$formatDate = static function (?string $value): string {
    if (! $value) {
        return '—';
    }
    return date('M d, Y', strtotime($value));
};
$statusBadgeClass = static function (?string $status): string {
    $normalized = strtolower(trim((string) $status));
    if ($normalized === 'success') {
        return 'bg-success-light text-success';
    }
    if ($normalized === 'pending') {
        return 'bg-warning-light text-warning';
    }
    return 'bg-danger-light text-danger';
};
$summary = $summary ?? ['owners' => 0, 'usages' => 0, 'total_paid' => 0];
$referrerStats = $referrerStats ?? [];
$usageLog = $usageLog ?? [];
$topReferrer = $topReferrer ?? null;
$topConnectors = $topConnectors ?? [];
?>
<!DOCTYPE html>
<html lang='en'>
<head>
    <?php include 'assets/includes/seo-meta.php'; ?>
    <meta name='csrf-token-name' content='<?= csrf_token() ?>'>
    <meta name='csrf-token-value' content='<?= csrf_hash() ?>'>
    <link href='https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css' rel='stylesheet'>
    <link rel='stylesheet' href='https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css'>
    <link rel='preconnect' href='https://fonts.googleapis.com'>
    <link rel='preconnect' href='https://fonts.gstatic.com' crossorigin>
    <link href='https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap' rel='stylesheet'>
    <link rel='icon' type='image/x-icon' href='<?= base_url('images/favicon/favicon.ico') ?>'>
    <link rel='stylesheet' href='https://cdn.jsdelivr.net/npm/aos@2.3.4/dist/aos.css'>
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
        body.dark-mode .analytics-card,
        body.dark-mode .table-wrapper,
        body.dark-mode .timeline-card,
        body.dark-mode .recent-actions-card {
            background: var(--dark-surface);
            border-color: var(--dark-border);
            color: inherit;
            box-shadow: 0 25px 50px rgba(0, 0, 0, 0.35);
        }
        body.dark-mode .stat-card .icon { background: rgba(25, 135, 84, 0.16); }
        body.dark-mode .table-wrapper .table thead { background: rgba(255, 255, 255, 0.05); }
        body.dark-mode .filter-bar .form-control,
        body.dark-mode .filter-bar .form-select {
            background: rgba(255, 255, 255, 0.08);
            border-color: transparent;
            color: #f4fcf8;
        }
        body.dark-mode .icon-btn { background: rgba(255, 255, 255, 0.08); color: #eaf6ef; }
        body.dark-mode .icon-btn:hover { background: rgba(25, 135, 84, 0.6); }
        body.dark-mode .text-muted,
        body.dark-mode .stat-meta,
        body.dark-mode .table p,
        body.dark-mode .table small {
            color: #d6e2d9 !important;
        }
        body.dark-mode .table thead th,
        body.dark-mode .recent-actions-card .table thead th {
            color: #f7fcf8;
            border-color: rgba(255, 255, 255, 0.08);
        }
        body.dark-mode .table tbody td {
            border-color: rgba(255, 255, 255, 0.08);
        }
        body.dark-mode .badge {
            background: rgba(25,135,84,0.25);
            color: #eafff1;
        }
        body.dark-mode .hero-panel { border-color: rgba(255,255,255,0.12); }
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
            color: #fff;
            text-align: center;
            margin-bottom: 2.5rem;
        }
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
        .topbar .navbar-toggler { display: none; border: none; background: transparent; color: var(--admin-primary); }
        .topbar-actions { display: flex; align-items: center; gap: 0.75rem; }
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
            color: #000000ff;
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
        .quick-actions .btn:hover { transform: translateY(-2px); box-shadow: var(--shadow-soft); }
        .btn-brand { background: var(--admin-primary); border-color: var(--admin-primary); color: #fff; }
        .btn-brand:hover { background: var(--admin-primary-dark); }
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
        .glass-card,
        .stat-card,
        .analytics-card,
        .table-wrapper,
        .timeline-card,
        .recent-actions-card {
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
        .stat-meta { font-size: 0.85rem; color: var(--text-muted); }
        body.dark-mode .stat-meta { color: rgba(255, 255, 255, 0.75); }
        .table-wrapper { margin-top: 1rem; }
        .table-wrapper .table-responsive { border-radius: 22px; overflow: hidden; }
        .table { margin: 0; }
        .table thead { background: linear-gradient(120deg, rgba(25, 135, 84, 0.1), rgba(25, 135, 84, 0.02)); }
        .table thead th { border: none; font-size: 0.85rem; letter-spacing: 0.03em; text-transform: uppercase; }
        .table tbody tr { transition: background 0.2s ease; }
        .table tbody tr:hover { background: rgba(25, 135, 84, 0.05); }
        .table tbody td { border-bottom: 1px solid rgba(25, 135, 84, 0.08); }
        .table tbody td .btn { border-radius: 999px; }
        .badge { border-radius: 999px; font-weight: 500; padding: 0.35rem 0.75rem; }
        .badge.bg-success-light { background: rgba(25, 135, 84, 0.14); color: var(--admin-primary); }
        .badge.bg-warning-light { background: rgba(255, 193, 7, 0.2); color: #a37000; }
        .badge.bg-danger-light { background: rgba(220, 53, 69, 0.18); color: #c82333; }
        .badge.bg-info-light { background: rgba(13, 202, 240, 0.15); color: #0aa2c0; }
        .badge.bg-secondary-light { background: rgba(16, 24, 40, 0.06); color: #364146; }
        .filter-bar { gap: 0.75rem; }
        .filter-bar .form-control,
        .filter-bar .form-select {
            border-radius: 14px;
            border: 1px solid var(--border-color);
            padding: 0.6rem 1rem;
            min-width: 180px;
            transition: box-shadow 0.2s ease, border-color 0.2s ease;
        }
        .filter-bar .form-control:focus,
        .filter-bar .form-select:focus {
            border-color: var(--admin-primary);
            box-shadow: 0 0 0 0.15rem rgba(25, 135, 84, 0.2);
        }
        .timeline-list { list-style: none; padding: 0; margin: 0; }
        .timeline-list li { position: relative; padding-left: 1.9rem; margin-bottom: 1.2rem; }
        .timeline-list li::before {
            content: '';
            position: absolute;
            left: 0; top: 6px;
            width: 10px; height: 10px;
            border-radius: 50%;
            background: var(--admin-primary);
            box-shadow: 0 0 0 6px rgba(25, 135, 84, 0.15);
        }
        .timeline-list li:last-child { margin-bottom: 0; }
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
        @media (max-width: 1199.98px) {
            .hero-panel { padding: 1.8rem; }
        }
        @media (max-width: 991.98px) {
            .sidebar { transform: translateX(-100%); }
            .sidebar.active { transform: translateX(0); }
            .main-content { margin-left: 0; padding: 2rem 1.5rem 2.5rem; }
            .topbar { left: 0; padding: 0 1.25rem; }
            .topbar .navbar-toggler { display: block; }
            .hero-panel { border-radius: 26px; }
            .filter-bar { width: 100%; }
            .filter-bar > * { flex: 1 1 calc(50% - 0.75rem); min-width: 0; }
            .quick-actions .btn { width: 100%; }
        }
        @media (max-width: 575.98px) {
            .hero-panel { padding: 1.4rem; }
            .filter-bar > * { flex: 1 1 100%; }
            .topbar-actions strong { display: none; }
            .hero-metrics { grid-template-columns: repeat(2, minmax(0, 1fr)); }
        }
    </style>
</head>
<body>

    <?= view('admin/partials/sidebar', ['active' => 'referrals']) ?>
    <?= view('admin/partials/topbar', ['showDarkToggle' => true, 'userRole' => 'Growth Ops']) ?>

    <main class='main-content' id='main-content'>
        <section class='hero-panel mb-4' data-aos='fade-up'>
            <span class='badge-soft'><i class='bi bi-link-45deg'></i> Referral Intelligence</span>
            <div class='row align-items-center mt-3 g-4'>
                <div class='col-lg-7'>
                    <h1 class='h3 mb-3'>Who is connecting the network?</h1>
                    <p class='text-muted mb-4'>Track every code shared and every new user that joined through it so you can reward the most impactful partners.</p>
                    <div class='row g-3'>
                        <div class='col-sm-4'>
                            <div class='stat-card text-center'>
                                <p class='text-muted small mb-1'>Referral owners</p>
                                <h3 class='mb-1'><?= esc(number_format($summary['owners'] ?? 0)) ?></h3>
                                <span class='stat-meta'>Codes issued</span>
                            </div>
                        </div>
                        <div class='col-sm-4'>
                            <div class='stat-card text-center'>
                                <p class='text-muted small mb-1'>Total referrals</p>
                                <h3 class='mb-1'><?= esc(number_format($summary['usages'] ?? 0)) ?></h3>
                                <span class='stat-meta'>Users acquired</span>
                            </div>
                        </div>
                        <div class='col-sm-4'>
                            <div class='stat-card text-center'>
                                <p class='text-muted small mb-1'>Revenue influenced</p>
                                <h3 class='mb-1'><?= esc($formatCurrency($summary['total_paid'] ?? 0)) ?></h3>
                                <span class='stat-meta'>Paid via referrals</span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class='col-lg-5' data-aos='fade-left'>
                    <div class='glass-card h-100 d-flex flex-column justify-content-between'>
                        <?php if ($topReferrer): ?>
                            <div>
                                <p class='text-muted small mb-1'>Top connector</p>
                                <h4 class='mb-1'><?= esc($topReferrer['referrer_name'] ?? '—') ?></h4>
                                <p class='text-muted small mb-1'><?= esc($topReferrer['referrer_email'] ?? '—') ?></p>
                                <p class='text-muted small mb-2'>Code <?= esc($topReferrer['code'] ?? '—') ?></p>
                            </div>
                            <div class='d-flex flex-wrap gap-3'>
                                <div class='text-center'>
                                    <h3 class='mb-0'><?= esc(number_format((int) ($topReferrer['usage_count'] ?? 0))) ?></h3>
                                    <small class='text-muted'>Connects</small>
                                </div>
                                <div class='text-center'>
                                    <h3 class='mb-0'><?= esc($formatCurrency($topReferrer['total_paid'] ?? 0)) ?></h3>
                                    <small class='text-muted'>Revenue</small>
                                </div>
                            </div>
                            <p class='text-muted small mt-2'>Last used <?= esc($formatDate($topReferrer['last_used_at'] ?? null)) ?></p>
                        <?php else: ?>
                            <div>
                                <p class='text-muted small mb-2'>No referral activity yet.</p>
                                <p class='text-muted small mb-0'>Once someone shares a code, the newest hero will appear here.</p>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </section>

        <div class='table-wrapper mb-4' data-aos='fade-up'>
            <div class='d-flex flex-wrap justify-content-between align-items-center gap-3 mb-3'>
                <div>
                    <h3 class='h5 mb-1'>Referral leaders</h3>
                    <p class='text-muted small mb-0'>Sorted by connections in the latest period.</p>
                </div>
                <span class='badge bg-success-light text-success'>Live</span>
            </div>
            <div class='table-responsive'>
                <table class='table align-middle table-hover mb-0'>
                    <thead class='table-light'>
                        <tr>
                            <th>#</th>
                            <th>Referrer</th>
                            <th>Code</th>
                            <th>Connects</th>
                            <th>Revenue</th>
                            <th>Last used</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (empty($referrerStats)): ?>
                            <tr>
                                <td colspan='6' class='text-center text-muted fst-italic'>No referral owners yet.</td>
                            </tr>
                        <?php else: ?>
                            <?php foreach ($referrerStats as $index => $stat): ?>
                                <tr>
                                    <td><?= $index + 1 ?></td>
                                    <td>
                                        <strong><?= esc($stat['referrer_name'] ?? '—') ?></strong><br>
                                        <small class='text-muted'>ID <?= esc($stat['referrer_user_id'] ?? '—') ?></small><br>
                                        <small class='text-muted'><?= esc($stat['referrer_email'] ?? '—') ?></small>
                                    </td>
                                    <td><span class='badge bg-success-light text-success'><?= esc($stat['code'] ?? '—') ?></span></td>
                                    <td><?= esc(number_format((int) ($stat['usage_count'] ?? 0))) ?></td>
                                    <td><?= esc($formatCurrency($stat['total_paid'] ?? 0)) ?></td>
                                    <td><?= esc($formatDate($stat['last_used_at'] ?? null)) ?></td>
                                </tr>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>

        <div class='glass-card' data-aos='fade-up'>
            <div class='d-flex flex-wrap justify-content-between align-items-center mb-3 gap-2'>
                <div>
                    <h5 class='mb-1'>Recent referral conversions</h5>
                    <p class='text-muted small mb-0'>The latest referrals that resulted in a subscription.</p>
                </div>
                <span class='badge bg-info-light text-info'>Live</span>
            </div>
            <div class='table-responsive'>
                <table class='table table-borderless align-middle mb-0'>
                    <thead class='table-light'>
                        <tr>
                            <th>#</th>
                            <th>Referrer</th>
                            <th>Used by</th>
                            <th>Code</th>
                            <th>Status</th>
                            <th>Paid</th>
                            <th>Date</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (empty($usageLog)): ?>
                            <tr>
                                <td colspan='7' class='text-center text-muted fst-italic'>No referral conversions recorded yet.</td>
                            </tr>
                        <?php else: ?>
                            <?php foreach ($usageLog as $index => $usage): ?>
                                <tr>
                                    <td><?= $index + 1 ?></td>
                                    <td>
                                        <strong><?= esc($usage['referrer_name'] ?? '—') ?></strong><br>
                                        <small class='text-muted'>ID <?= esc($usage['referrer_user_id'] ?? '—') ?></small><br>
                                        <small class='text-muted'><?= esc($usage['referrer_email'] ?? '—') ?></small>
                                    </td>
                                    <td>
                                        <strong><?= esc($usage['used_name'] ?? '—') ?></strong><br>
                                        <small class='text-muted'>ID <?= esc($usage['used_by_user_id'] ?? '—') ?></small>
                                    </td>
                                    <td><span class='badge bg-secondary-light'><?= esc($usage['referral_code'] ?? '—') ?></span></td>
                                    <td><span class='badge <?= esc($statusBadgeClass($usage['payment_status'] ?? 'pending')) ?>'><?= esc(ucfirst(trim((string) ($usage['payment_status'] ?? 'pending')))) ?></span></td>
                                    <td><?= esc($formatCurrency($usage['paid_amount'] ?? 0)) ?></td>
                                    <td><?= esc($formatDate($usage['created_at'] ?? null)) ?></td>
                                </tr>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>

        <section class='glass-card mt-4' data-aos='fade-up'>
            <div class='d-flex justify-content-between align-items-center mb-3'>
                <div>
                    <h5 class='mb-1'>Most people connected by</h5>
                    <p class='text-muted small mb-0'>Highlighting the connectors who brought in the most users.</p>
                </div>
                <span class='badge bg-success-light text-success'>Top 3</span>
            </div>
            <div class='row g-3'>
                <?php if (empty($topConnectors)): ?>
                    <div class='col-12 text-center text-muted fst-italic'>Referrals will surface here once the network grows.</div>
                <?php else: ?>
                    <?php foreach ($topConnectors as $connector): ?>
                        <div class='col-sm-6 col-lg-4'>
                            <div class='stat-card h-100 border border-success border-2 shadow-sm'>
                                <p class='text-muted small mb-1'><?= esc($connector['referrer_email'] ?? '—') ?></p>
                                <h4 class='mb-1'><?= esc($connector['referrer_name'] ?? '—') ?></h4>
                                <p class='text-muted small mb-2'>Code <?= esc($connector['code'] ?? '—') ?></p>
                                <div class='d-flex justify-content-between align-items-center mb-2'>
                                    <div>
                                        <p class='mb-0 fs-6 fw-semibold'><?= esc(number_format((int) ($connector['usage_count'] ?? 0))) ?></p>
                                        <small class='text-muted'>Connects</small>
                                    </div>
                                    <div class='text-end'>
                                        <p class='mb-0 fs-6 fw-semibold'><?= esc($formatCurrency($connector['total_paid'] ?? 0)) ?></p>
                                        <small class='text-muted'>Revenue</small>
                                    </div>
                                </div>
                                <small class='text-muted'>Last used <?= esc($formatDate($connector['last_used_at'] ?? null)) ?></small>
                            </div>
                        </div>
                    <?php endforeach; ?>
                <?php endif; ?>
            </div>
        </section>
    </main>

    <div id='sidebar-backdrop' class='backdrop d-none'></div>

<script src='https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js'></script>
<script src='https://cdn.jsdelivr.net/npm/aos@2.3.4/dist/aos.js'></script>
<script src='https://cdn.jsdelivr.net/npm/sweetalert2@11.10.0/dist/sweetalert2.all.min.js'></script>
<script>
(function () {
    'use strict';

    document.addEventListener('DOMContentLoaded', function () {
        var body = document.body;
        var sidebar = document.getElementById('admin-sidebar');
        var toggler = document.getElementById('sidebar-toggler');
        var backdrop = document.getElementById('sidebar-backdrop');
        var darkToggle = document.getElementById('dark-mode-toggle');
        var THEME_KEY = 'adminTheme';

        var applyTheme = function (mode) {
            body.classList.toggle('dark-mode', mode === 'dark');
            localStorage.setItem(THEME_KEY, mode);
        };

        applyTheme(localStorage.getItem(THEME_KEY) || 'light');

        if (darkToggle) {
            darkToggle.addEventListener('click', function () {
                applyTheme(body.classList.contains('dark-mode') ? 'light' : 'dark');
            });
        }

        var showBackdrop = function () {
            if (!backdrop) {
                return;
            }
            backdrop.classList.remove('d-none');
            backdrop.classList.add('visible');
        };

        var hideBackdrop = function () {
            if (!backdrop) {
                return;
            }
            backdrop.classList.remove('visible');
            backdrop.classList.add('d-none');
        };

        var showSidebar = function () {
            if (sidebar) {
                sidebar.classList.add('active');
            }
            showBackdrop();
        };

        var hideSidebar = function () {
            if (sidebar) {
                sidebar.classList.remove('active');
            }
            hideBackdrop();
        };

        if (toggler) {
            toggler.addEventListener('click', function () {
                if (!sidebar) {
                    return;
                }
                if (sidebar.classList.contains('active')) {
                    hideSidebar();
                    return;
                }
                showSidebar();
            });
        }

        if (backdrop) {
            backdrop.addEventListener('click', hideSidebar);
        }

        window.addEventListener('resize', function () {
            if (window.innerWidth >= 992) {
                hideSidebar();
            }
        });

        if (typeof AOS !== 'undefined') {
            AOS.init({ duration: 700, once: true, offset: 80, easing: 'ease-out-quart' });
        }
    });
})();
</script>
</body>
</html>