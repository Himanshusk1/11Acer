<?php
$page_title = 'Payments - Admin - 11 Acer';
$formatCurrency = function ($amount): string {
    return 'Rs ' . number_format((float) $amount, 0, '.', ',');
};
$slugify = static function (?string $value): string {
    $value = strtolower(trim((string) $value));
    $value = preg_replace('/[^a-z0-9]+/i', '-', $value) ?: '';
    return trim($value, '-');
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

        body.dark-mode .hero-panel {
            border-color: rgba(255,255,255,0.12);
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
        .topbar .navbar-toggler {
            display: none;
            border: none;
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
        .quick-actions .btn[disabled],
        .table .btn[disabled] {
            opacity: 0.65;
            cursor: not-allowed;
            pointer-events: none;
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

        .analytics-card h5 { font-weight: 600; }
        .chart-legend {
            display: flex;
            flex-wrap: wrap;
            gap: 0.85rem;
            margin-top: 1rem;
        }
        .legend-item { display: flex; align-items: center; gap: 0.4rem; font-size: 0.85rem; color: var(--text-muted); }
        .legend-dot { width: 10px; height: 10px; border-radius: 50%; display: inline-flex; }
        .flow-chart { width: 100%; height: auto; }
        .donut-wrapper { position: relative; width: 170px; height: 170px; margin: 0 auto; }
        .donut-center {
            position: absolute;
            top: 50%; left: 50%;
            transform: translate(-50%, -50%);
            text-align: center;
        }
        .donut-center h4 { margin: 0; font-size: 1.5rem; }
        .donut-legend { margin-top: 1.25rem; display: grid; gap: 0.6rem; }
        .donut-legend span { font-size: 0.9rem; }

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

        .recent-actions-card .table { color: inherit; }
        .recent-actions-card .table thead { background: transparent; }

        .status-progress { height: 8px; border-radius: 999px; background: rgba(25, 135, 84, 0.12); overflow: hidden; }
        .status-progress .progress-bar { border-radius: 999px; }

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
            .filter-bar {
                width: 100%;
                padding-bottom: 0.5rem;
            }
            .quick-actions .btn { width: 100%; }
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
            .topbar-actions strong { display: none; }
            .hero-metrics { grid-template-columns: repeat(2, minmax(0, 1fr)); }
        }
    </style>
</head>
<body>

<?php $exportUrl = site_url('admin/payments/export'); ?>

    <?= view('admin/partials/sidebar', ['active' => 'payments']) ?>
    <?= view('admin/partials/topbar', ['showDarkToggle' => true, 'userRole' => 'Finance Ops']) ?>

    <main class="main-content" id="main-content">
        <section class="hero-panel mb-4" data-aos="fade-up">
            <span class="badge-soft"><i class="bi bi-lightning-charge"></i> Finance Center</span>
            <div class="row align-items-center mt-3 g-4">
                <div class="col-lg-7">
                    <h1 class="h3 mb-3">Payment Operations</h1>
                    <p class="text-muted mb-4">Stay ahead of every settlement, analyze cash flow, and bring premium control to every listing upgrade payment.</p>
                    <div class="quick-actions d-flex flex-wrap gap-2">
                        <span class="d-inline-flex" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Manual payment recording is coming soon">
                        </span>
                        <a href="<?= esc($exportUrl) ?>" class="btn btn-outline-secondary"><i class="bi bi-download me-2"></i>Export CSV</a>
                        <span class="d-inline-flex" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Automated payout processing is under development">
                        </span>
                    </div>
                </div>
                <div class="col-lg-5">
                    <div class="hero-metrics">
                        <div class="hero-metric">
                            <span>Avg. settlement time</span>
                            <h3 class="mb-0">2.3 days</h3>
                            <small>Down 0.5d this week</small>
                        </div>
                        <div class="hero-metric">
                            <span>Automation coverage</span>
                            <h3 class="mb-0">78%</h3>
                            <small>+12% vs last month</small>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <div class="row g-4 mb-4">
            <div class="col-sm-6 col-xl-3" data-aos="fade-up">
                <div class="stat-card">
                    <div class="d-flex align-items-center justify-content-between">
                        <div>
                            <p class="text-muted small mb-1">Total Volume</p>
                            <p class="fs-4 fw-bold mb-0"><?= esc($formatCurrency($totalVolume ?? 0)) ?></p>
                            <span class="stat-meta text-success">
                                <?= esc(sprintf('Based on %s settled payments', number_format($successfulPayouts ?? 0))) ?>
                            </span>
                        </div>
                        <div class="icon"><i class="bi bi-cash-stack"></i></div>
                    </div>
                </div>
            </div>
            <div class="col-sm-6 col-xl-3" data-aos="fade-up" data-aos-delay="60">
                <div class="stat-card">
                    <div class="d-flex align-items-center justify-content-between">
                        <div>
                            <p class="text-muted small mb-1">Successful Payouts</p>
                            <p class="fs-4 fw-bold mb-0"><?= esc(number_format($successfulPayouts ?? 0)) ?></p>
                            <span class="stat-meta text-primary">Settlements recorded</span>
                        </div>
                        <div class="icon"><i class="bi bi-check2-circle"></i></div>
                    </div>
                </div>
            </div>
            <div class="col-sm-6 col-xl-3" data-aos="fade-up" data-aos-delay="120">
                <div class="stat-card">
                    <div class="d-flex align-items-center justify-content-between">
                        <div>
                            <p class="text-muted small mb-1">Pending Invoices</p>
                            <p class="fs-4 fw-bold mb-0"><?= esc(number_format($pendingInvoices ?? 0)) ?></p>
                            <span class="stat-meta text-warning">Awaiting compliance review</span>
                        </div>
                        <div class="icon"><i class="bi bi-hourglass-split"></i></div>
                    </div>
                </div>
            </div>
            <div class="col-sm-6 col-xl-3" data-aos="fade-up" data-aos-delay="180">
                <div class="stat-card">
                    <div class="d-flex align-items-center justify-content-between">
                        <div>
                            <p class="text-muted small mb-1">Failed Attempts</p>
                            <p class="fs-4 fw-bold mb-0"><?= esc(number_format($failedAttempts ?? 0)) ?></p>
                            <span class="stat-meta text-danger">Follow-up required</span>
                        </div>
                        <div class="icon"><i class="bi bi-exclamation-octagon"></i></div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row g-4 mb-4">
            <div class="col-xl-6" data-aos="fade-up">
                <div class="analytics-card h-100">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <div>
                            <h5 class="mb-1">Monthly Cash Flow</h5>
                            <p class="text-muted small mb-0">Collections vs payouts</p>
                        </div>
                        <span class="badge bg-light text-success">Live</span>
                    </div>
                    <div class="mt-3">
                        <svg viewBox="0 0 420 190" preserveAspectRatio="none" class="w-100 flow-chart">
                            <defs>
                                <linearGradient id="incomeGradient" x1="0" y1="0" x2="0" y2="1">
                                    <stop offset="0%" stop-color="rgba(25,135,84,0.4)"></stop>
                                    <stop offset="100%" stop-color="rgba(25,135,84,0)"></stop>
                                </linearGradient>
                                <linearGradient id="expenseGradient" x1="0" y1="0" x2="0" y2="1">
                                    <stop offset="0%" stop-color="rgba(255,193,7,0.35)"></stop>
                                    <stop offset="100%" stop-color="rgba(255,193,7,0)"></stop>
                                </linearGradient>
                            </defs>
                            <path d="M10,150 C70,120 130,130 190,85 250,70 310,68 370,55 L370,190 L10,190Z" fill="url(#incomeGradient)" opacity="0.6"></path>
                            <polyline fill="none" stroke="#198754" stroke-width="4" stroke-linecap="round" points="10,150 70,120 130,130 190,85 250,70 310,68 370,55" opacity="0.9"></polyline>
                            <path d="M10,165 C70,145 130,120 190,135 250,120 310,100 370,110 L370,190 L10,190Z" fill="url(#expenseGradient)" opacity="0.5"></path>
                            <polyline fill="none" stroke="#ffc107" stroke-width="4" stroke-linecap="round" points="10,165 70,145 130,120 190,135 250,120 310,100 370,110" opacity="0.7"></polyline>
                        </svg>
                        <div class="d-flex justify-content-between text-muted small mt-2">
                            <span>Aug</span><span>Sep</span><span>Oct</span><span>Nov</span><span>Dec</span><span>Jan</span>
                        </div>
                        <div class="chart-legend">
                            <div class="legend-item"><span class="legend-dot" style="background:#198754"></span>Collections</div>
                            <div class="legend-item"><span class="legend-dot" style="background:#ffc107"></span>Payouts</div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-3" data-aos="fade-up" data-aos-delay="90">
                <div class="analytics-card h-100 text-center">
                    <h5 class="mb-3">Payment Split</h5>
                    <div class="donut-wrapper">
                        <svg viewBox="0 0 36 36" class="w-100 h-100">
                            <circle cx="18" cy="18" r="15.9155" fill="transparent" stroke="#f0f3f0" stroke-width="2"></circle>
                            <circle cx="18" cy="18" r="15.9155" fill="transparent" stroke="#198754" stroke-width="2" stroke-dasharray="55 45" stroke-dashoffset="25"></circle>
                            <circle cx="18" cy="18" r="15.9155" fill="transparent" stroke="#0dcaf0" stroke-width="2" stroke-dasharray="30 70" stroke-dashoffset="80"></circle>
                            <circle cx="18" cy="18" r="15.9155" fill="transparent" stroke="#ffc107" stroke-width="2" stroke-dasharray="15 85" stroke-dashoffset="120"></circle>
                        </svg>
                        <div class="donut-center">
                            <small class="text-muted">Coverage</small>
                            <h4>100%</h4>
                        </div>
                    </div>
                    <div class="donut-legend text-start">
                        <span><span class="legend-dot" style="background:#198754"></span> Listing Boost - 55%</span>
                        <span><span class="legend-dot" style="background:#0dcaf0"></span> Subscription - 30%</span>
                        <span><span class="legend-dot" style="background:#ffc107"></span> Other Fees - 15%</span>
                    </div>
                </div>
            </div>
            <div class="col-xl-3" data-aos="fade-up" data-aos-delay="150">
                <div class="analytics-card h-100">
                    <h5 class="mb-3">Settlement Status</h5>
                    <div class="d-flex flex-column gap-3">
                        <?php
                        $settlementStatuses = $settlementStatuses ?? [];
                        if (empty($settlementStatuses)) {
                            $settlementStatuses = [
                                'Cleared' => ['value' => 82, 'variant' => 'bg-success'],
                                'Processing' => ['value' => 45, 'variant' => 'bg-warning'],
                                'On Hold' => ['value' => 18, 'variant' => 'bg-danger']
                            ];
                        }
                        foreach ($settlementStatuses as $label => $meta): ?>
                        <div>
                            <div class="d-flex justify-content-between small mb-1"><span><?= esc($label) ?></span><span><?= esc($meta['value']) ?>%</span></div>
                            <div class="status-progress">
                                <div class="progress-bar <?= esc($meta['variant']) ?>" style="width: <?= esc($meta['value']) ?>%"></div>
                            </div>
                        </div>
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>
        </div>

        <div class="table-wrapper" data-aos="fade-up">
            <div class="d-flex flex-wrap justify-content-between align-items-center gap-3 mb-3">
                <div>
                    <h3 class="h5 mb-1">Recent Payments</h3>
                    <p class="text-muted small mb-0">Search, filter, and reconcile every transaction.</p>
                </div>
                <div class="d-flex filter-bar">
                    <input type="text" class="form-control" placeholder="Search txn or user" data-filter="payments-search">
                    <select class="form-select" data-filter="payments-type">
                        <option value="">Type</option>
                        <option value="listing-boost">Listing Boost</option>
                        <option value="subscription">Subscription</option>
                        <option value="promotional">Promotional</option>
                    </select>
                    <select class="form-select" data-filter="payments-status">
                        <option value="">Status</option>
                        <option value="success">Success</option>
                        <option value="pending">Pending</option>
                        <option value="failed">Failed</option>
                    </select>
                    <input type="date" class="form-control" data-filter="payments-date">
                </div>
            </div>
            <div class="table-responsive">
                <table class="table align-middle table-hover mb-0" data-payments-table>
                    <thead class="table-light">
                        <tr>
                            <th>S. No.</th>
                            <th>Txn ID</th>
                            <th>User</th>
                            <th>Type</th>
                            <th>Amount</th>
                            <th>Status</th>
                            <th>Date</th>
                            <th class="text-end">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $recentPayments = $recentPayments ?? []; ?>
                        <?php if (empty($recentPayments)): ?>
                            <tr data-empty-row>
                                <td colspan="8" class="text-center text-muted fst-italic">No payments have been recorded yet.</td>
                            </tr>
                        <?php else: ?>
                            <?php foreach ($recentPayments as $index => $payment): ?>
                                <?php
                                    $txnId = $payment['txn_id'] ?? '';
                                    $userLabel = $payment['user_label'] ?? '';
                                    $typeLabel = $payment['type'] ?? '';
                                    $typeSlug = $slugify($typeLabel);
                                    $statusLabel = $payment['status_text'] ?? '';
                                    $statusSlug = $slugify($statusLabel);
                                    $normalizedDate = ! empty($payment['date']) ? date('Y-m-d', strtotime($payment['date'])) : '';
                                    $searchHaystack = strtolower(trim($txnId . ' ' . $userLabel));
                                    $displayCreatedAt = ! empty($payment['date']) ? date('M d, Y H:i', strtotime($payment['date'])) : 'N/A';
                                    $viewPayload = json_encode([
                                        'Transaction' => $txnId,
                                        'User'        => $userLabel,
                                        'Type'        => $typeLabel ?: '—',
                                        'Amount'      => $formatCurrency($payment['amount']),
                                        'Status'      => $statusLabel ?: 'N/A',
                                        'Recorded'    => $displayCreatedAt,
                                        'Action'      => $payment['action_label'] ?? 'N/A',
                                    ], JSON_HEX_TAG | JSON_HEX_APOS | JSON_HEX_QUOT | JSON_HEX_AMP);
                                ?>
                                <tr
                                    data-payment-row
                                    data-search="<?= esc($searchHaystack) ?>"
                                    data-type="<?= esc($typeSlug) ?>"
                                    data-status="<?= esc($statusSlug) ?>"
                                    data-date="<?= esc($normalizedDate) ?>"
                                >
                                    <td><?= $index + 1 ?></td>
                                    <td><strong><?= esc($txnId) ?></strong></td>
                                    <td><?= esc($userLabel) ?></td>
                                    <td><?= esc($typeLabel) ?></td>
                                    <td><?= esc($formatCurrency($payment['amount'])) ?></td>
                                    <td><span class="badge <?= esc($payment['status_variant']) ?>"><?= esc($statusLabel) ?></span></td>
                                    <td><?= esc($normalizedDate ?: 'N/A') ?></td>
                                    <td class="text-end">
                                            <button type="button" class="btn btn-sm btn-outline-secondary me-1 js-payment-view" data-payment='<?= esc($viewPayload, 'attr') ?>'>View</button>
                                            <span class="d-inline-flex" data-bs-toggle="tooltip" data-bs-placement="bottom" title="This workflow will be enabled once secure finance APIs are live">
                                                <button type="button" class="btn btn-sm <?= esc($payment['status_text'] === 'Success' ? 'btn-outline-danger' : ($payment['status_text'] === 'Failed' ? 'btn-outline-warning' : 'btn-outline-success')) ?>" disabled aria-disabled="true">
                                                    <?= esc($payment['action_label']) ?>
                                                </button>
                                            </span>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                            <tr class="text-center text-muted fst-italic d-none" data-empty-row>
                                <td colspan="8">No payments match the selected filters.</td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
            <nav class="mt-3" aria-label="Payments pagination">
                <ul class="pagination justify-content-end mb-0" data-payments-pagination>
                    <li class="page-item disabled" data-page-control="prev">
                        <button type="button" class="page-link" disabled aria-disabled="true" tabindex="-1">Previous</button>
                    </li>
                    <li class="page-item active" data-page-number="1">
                        <button type="button" class="page-link">1</button>
                    </li>
                    <li class="page-item" data-page-number="2">
                        <button type="button" class="page-link">2</button>
                    </li>
                    <li class="page-item" data-page-control="next">
                        <button type="button" class="page-link">Next</button>
                    </li>
                </ul>
            </nav>
        </div>


        <div class="row g-4 mt-1">
            <div class="col-xl-4" data-aos="fade-up">
                <div class="timeline-card">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <h5 class="mb-0">Payout Timeline</h5>
                        <small class="text-muted">Today</small>
                    </div>
                    <ul class="timeline-list">
                        <?php $timelineEntries = $timelineEntries ?? []; ?>
                        <?php if (empty($timelineEntries)): ?>
                            <li class="text-muted small">No payout activity yet.</li>
                        <?php else: ?>
                            <?php foreach ($timelineEntries as $entry): ?>
                                <li>
                                    <strong><?= esc($entry['title']) ?></strong>
                                    <div class="text-muted small"><?= esc($entry['meta']) ?> - <?= esc($formatCurrency($entry['amount'])) ?></div>
                                </li>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </ul>
                </div>
            </div>
            <div class="col-xl-8" data-aos="fade-up" data-aos-delay="80">
                <div class="recent-actions-card">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <h5 class="mb-0">Finance Activity Log</h5>
                        <span class="small text-muted" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Extended finance history is coming soon">View all</span>
                    </div>
                    <div class="table-responsive">
                        <table class="table table-borderless align-middle mb-0">
                            <thead class="table-light">
                                <tr>
                                    <th>S. No.</th>
                                    <th>Team Member</th>
                                    <th>Action</th>
                                    <th>Reference</th>
                                    <th>Time</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $activityLog = $activityLog ?? []; ?>
                                <?php if (empty($activityLog)): ?>
                                    <tr>
                                        <td colspan="5" class="text-center text-muted fst-italic">No finance actions logged yet.</td>
                                    </tr>
                                <?php else: ?>
                                    <?php foreach ($activityLog as $index => $log): ?>
                                        <tr>
                                            <td><?= $index + 1 ?></td>
                                            <td><i class="bi bi-person-circle me-2 <?= esc($log['icon_class'] ?? 'text-secondary') ?>"></i><?= esc($log['team_member']) ?></td>
                                            <td><?= esc($log['action']) ?></td>
                                            <td><?= esc($log['reference']) ?></td>
                                            <td><?= esc($log['time']) ?></td>
                                        </tr>
                                    <?php endforeach; ?>
                                <?php endif; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <br>
        <?php
/**
 * Required variables from controller:
 * $subscriptions (array)
 * $subscriptionAlert (['type' => 'success|danger', 'message' => string] | null)
 */

$subscriptions = $subscriptions ?? [];
$subscriptionAlert = $subscriptionAlert ?? null;

$formatCurrency = $formatCurrency ?? fn ($amount) => '₹' . number_format((float)$amount, 0);
?>

<div class="row g-4 mb-4">

    <?php if ($subscriptionAlert): ?>
        <div id="subscription-alert" data-alert-type="<?= esc($subscriptionAlert['type']) ?>" data-alert-message="<?= esc($subscriptionAlert['message']) ?>"></div>
    <?php endif; ?>

    <!-- ================= SUBSCRIPTION TABLE ================= -->
    <div class="col-xl-7" data-aos="fade-up">
        <div class="glass-card">
            <div class="d-flex justify-content-between mb-3">
                <div>
                    <h5 class="mb-1">Subscription Catalog</h5>
                    <p class="text-muted small mb-0">Plans available for purchase</p>
                </div>
            </div>

            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead class="table-light">
                        <tr>
                            <th>S. No.</th>
                            <th>ID</th>
                            <th>Plan</th>
                            <th>Price</th>
                            <th>Duration</th>
                            <th>Description</th>
                            <th class="text-end">Actions</th>
                        </tr>
                    </thead>
                    <tbody>

                        <?php if (empty($subscriptions)): ?>
                            <tr>
                                <td colspan="7" class="text-center text-muted fst-italic">
                                    No subscription plans created yet.
                                </td>
                            </tr>
                        <?php else: ?>
                            <?php foreach ($subscriptions as $index => $sub): ?>
                                <tr data-row-id="<?= esc($sub['id']) ?>">
                                    <td><?= $index + 1 ?></td>
                                    <td><?= esc($sub['id']) ?></td>
                                    <td class="fw-semibold"><?= esc($sub['name']) ?></td>
                                    <td><?= esc($formatCurrency($sub['price'])) ?></td>
                                    <td><?= esc($sub['duration_days']) ?> days</td>
                                    <td><?= esc($sub['description'] ?: '—') ?></td>
                                    <td class="text-end">
                                        <button
                                            type="button"
                                            class="btn btn-sm btn-outline-danger js-delete-subscription"
                                            data-subscription-id="<?= esc($sub['id']) ?>">
                                            Delete
                                        </button>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        <?php endif; ?>

                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- ================= ADD SUBSCRIPTION ================= -->
    <div class="col-xl-5" data-aos="fade-up" data-aos-delay="80">
        <div class="glass-card h-100">
            <h5 class="mb-2">Add Subscription</h5>
            <p class="text-muted small">Create a new subscription plan</p>

            <form method="post" action="<?= site_url('api/admin/subscriptions') ?>" class="row g-3 js-subscription-form">
                <?= csrf_field() ?>
                <div class="col-12">
                    <label class="form-label">Plan Name</label>
                    <input type="text" name="name" class="form-control" required>
                </div>

                <div class="col-12">
                    <label class="form-label">Price (₹)</label>
                    <input type="number" name="price" min="0" step="1" class="form-control" required>
                </div>

                <div class="col-12">
                    <label class="form-label">Duration (days)</label>
                    <input type="number" name="duration_days" min="1" value="30" class="form-control" required>
                </div>

                <div class="col-12">
                    <label class="form-label">Description</label>
                    <textarea name="description" rows="3" class="form-control"></textarea>
                </div>

                <div class="col-12 text-end">
                    <button type="submit" class="btn btn-brand">Save Plan</button>
                </div>
            </form>
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

    document.addEventListener('DOMContentLoaded', async () => {
        if (typeof Swal === 'undefined') {
            console.error('SweetAlert2 is required but failed to load.');
            return;
        }

        /* =============================
         * Constants & Elements
         * ============================= */
        const body        = document.body;
        const sidebar     = document.getElementById('admin-sidebar');
        const toggler     = document.getElementById('sidebar-toggler');
        const backdrop    = document.getElementById('sidebar-backdrop');
        const darkToggle  = document.getElementById('dark-mode-toggle');

        const THEME_KEY   = 'adminTheme';
        const DELETE_URL  = <?= json_encode(site_url('api/admin/subscriptions')) ?>;
        const CSRF_NAME   = <?= json_encode(csrf_token()) ?>;
        let   CSRF_HASH   = <?= json_encode(csrf_hash()) ?>;

        if (window.bootstrap && window.bootstrap.Tooltip) {
            const tooltipTriggerList = Array.prototype.slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
            tooltipTriggerList.forEach(triggerEl => new window.bootstrap.Tooltip(triggerEl));
        }

        /* =============================
         * Theme Handling
         * ============================= */
        const applyTheme = (mode = 'light') => {
            body.classList.toggle('dark-mode', mode === 'dark');
            localStorage.setItem(THEME_KEY, mode);
        };

        applyTheme(localStorage.getItem(THEME_KEY) || 'light');

        darkToggle?.addEventListener('click', () => {
            applyTheme(body.classList.contains('dark-mode') ? 'light' : 'dark');
        });

        const escapeHtml = (value) => String(value ?? '')
            .replace(/&/g, '&amp;')
            .replace(/</g, '&lt;')
            .replace(/>/g, '&gt;')
            .replace(/"/g, '&quot;')
            .replace(/'/g, '&#39;');

        /* =============================
         * Sidebar Handling
         * ============================= */
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
            const isOpen = sidebar?.classList.toggle('active');
            if (isOpen) {
                showBackdrop();
            } else {
                hideBackdrop();
            }
        });

        backdrop?.addEventListener('click', closeSidebar);
        window.addEventListener('resize', () => window.innerWidth >= 992 && closeSidebar());
        document.addEventListener('keydown', e => e.key === 'Escape' && closeSidebar());

        /* =============================
         * Stat Card Hover Effect
         * ============================= */
        document.querySelectorAll('.stat-card').forEach(card => {
            card.addEventListener('mousemove', e => {
                const r = card.getBoundingClientRect();
                card.style.setProperty('--mouse-x', `${e.clientX - r.left}px`);
                card.style.setProperty('--mouse-y', `${e.clientY - r.top}px`);
            });
            card.addEventListener('mouseleave', () => {
                card.style.removeProperty('--mouse-x');
                card.style.removeProperty('--mouse-y');
            });
        });

        /* =============================
         * AOS Init
         * ============================= */
        window.AOS?.init({
            duration: 650,
            once: true,
            offset: 80,
            easing: 'ease-out-quart'
        });

        /* =============================
         * CSRF Sync Helper
         * ============================= */
        const syncCsrf = (hash) => {
            CSRF_HASH = hash;
            document
                .querySelectorAll(`input[name="${CSRF_NAME}"]`)
                .forEach(i => i.value = hash);
        };

        const queuedAlertElement = document.getElementById('subscription-alert');
        if (queuedAlertElement) {
            const type = queuedAlertElement.dataset.alertType;
            const message = queuedAlertElement.dataset.alertMessage;
            const icon = type === 'danger' ? 'error' : 'success';
            const title = type === 'danger' ? 'Something went wrong' : 'Success';
            await Swal.fire({
                title,
                text: message,
                icon,
                confirmButtonColor: '#198754'
            });
        }

        /* =============================
         * Delete Subscription (AJAX)
         * ============================= */
        document.addEventListener('click', async event => {
            const btn = event.target.closest('.js-delete-subscription');
            if (!btn) return;

            event.preventDefault();

            const id = btn.dataset.subscriptionId;
            if (!id) return;

            const confirmation = await Swal.fire({
                title: 'Delete this subscription?',
                text: 'This action cannot be undone.',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Yes, delete it',
                cancelButtonText: 'Cancel',
                reverseButtons: true,
                confirmButtonColor: '#dc3545',
                cancelButtonColor: '#6c757d'
            });

            if (!confirmation.isConfirmed) return;

            btn.disabled = true;

            try {
                const res = await fetch(`${DELETE_URL}/${id}`, {
                    method: 'DELETE',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-Requested-With': 'XMLHttpRequest'
                    },
                    body: JSON.stringify({ [CSRF_NAME]: CSRF_HASH })
                });

                const data = await res.json();
                if (data?.csrfHash) syncCsrf(data.csrfHash);
                if (!res.ok) throw new Error(data?.error || 'Delete failed');

                await Swal.fire({
                    title: 'Deleted!',
                    text: data.message || 'Subscription removed.',
                    icon: 'success',
                    confirmButtonColor: '#198754'
                });
                btn.closest('tr')?.remove();

            } catch (err) {
                await Swal.fire({
                    title: 'Error',
                    text: err.message,
                    icon: 'error',
                    confirmButtonColor: '#198754'
                });
            } finally {
                btn.disabled = false;
            }
        });

        const subscriptionForm = document.querySelector('.js-subscription-form');
        if (subscriptionForm) {
            subscriptionForm.addEventListener('submit', async event => {
                event.preventDefault();
                const submitButton = subscriptionForm.querySelector('button[type="submit"]');
                submitButton?.setAttribute('disabled', 'disabled');

                try {
                    const response = await fetch(subscriptionForm.action, {
                        method: 'POST',
                        headers: {
                            'X-Requested-With': 'XMLHttpRequest'
                        },
                        body: new FormData(subscriptionForm)
                    });

                    const payload = await response.json().catch(() => ({}));
                    if (payload?.csrfHash) {
                        syncCsrf(payload.csrfHash);
                    }

                    if (!response.ok) {
                        throw new Error(payload.message || payload.error || 'Unable to save subscription.');
                    }

                    await Swal.fire({
                        title: 'Subscription saved',
                        text: payload.message || 'Subscription plan saved.',
                        icon: 'success',
                        confirmButtonColor: '#198754'
                    });
                    subscriptionForm.reset();
                    setTimeout(() => window.location.reload(), 850);
                } catch (error) {
                    await Swal.fire({
                        title: 'Unable to save',
                        text: error.message || 'Something went wrong.',
                        icon: 'error',
                        confirmButtonColor: '#198754'
                    });
                } finally {
                    submitButton?.removeAttribute('disabled');
                }
            });
        }

        document.addEventListener('click', async event => {
            const viewBtn = event.target.closest('.js-payment-view');
            if (!viewBtn) {
                return;
            }

            const payloadRaw = viewBtn.dataset.payment;
            if (!payloadRaw) {
                return;
            }

            let payload;
            try {
                payload = JSON.parse(payloadRaw);
            } catch (err) {
                console.warn('Unable to parse payment payload', err);
                return;
            }

            const rows = Object.entries(payload)
                .map(([label, value]) => (
                    `<div class="d-flex justify-content-between mb-1"><span class="text-muted">${escapeHtml(label)}</span><span class="fw-semibold ms-3 text-end">${escapeHtml(value)}</span></div>`
                ))
                .join('');

            await Swal.fire({
                title: 'Payment Details',
                html: `<div class="text-start small">${rows}</div>`,
                confirmButtonColor: '#198754'
            });
        });

        /* =============================
         * Recent Payments Filters & Pagination
         * ============================= */
        const paymentsTable = document.querySelector('[data-payments-table]');
        const paymentsPagination = document.querySelector('[data-payments-pagination]');

        if (paymentsTable && paymentsPagination) {
            const ROWS_PER_PAGE = 10;
            let currentPage = 1;
            let totalPages = 1;

            const filters = {
                search: document.querySelector('[data-filter="payments-search"]'),
                type: document.querySelector('[data-filter="payments-type"]'),
                status: document.querySelector('[data-filter="payments-status"]'),
                date: document.querySelector('[data-filter="payments-date"]')
            };

            const dataRows = Array.from(paymentsTable.querySelectorAll('tbody tr[data-payment-row]'));
            if (dataRows.length) {
                const emptyRow = paymentsTable.querySelector('tbody tr[data-empty-row]');

                const getFilteredRows = () => {
                    const searchTerm = (filters.search?.value || '').trim().toLowerCase();
                    const typeFilter = (filters.type?.value || '').trim();
                    const statusFilter = (filters.status?.value || '').trim();
                    const dateFilter = (filters.date?.value || '').trim();

                    return dataRows.filter(row => {
                        if (searchTerm && !(row.dataset.search || '').includes(searchTerm)) {
                            return false;
                        }
                        if (typeFilter && (row.dataset.type || '') !== typeFilter) {
                            return false;
                        }
                        if (statusFilter && (row.dataset.status || '') !== statusFilter) {
                            return false;
                        }
                        if (dateFilter && (row.dataset.date || '') !== dateFilter) {
                            return false;
                        }
                        return true;
                    });
                };

                const setEmptyState = visibleCount => {
                    if (!emptyRow) return;
                    emptyRow.classList.toggle('d-none', visibleCount !== 0);
                };

                const updatePaginationControls = total => {
                    const prevControl = paymentsPagination.querySelector('li[data-page-control="prev"]');
                    const nextControl = paymentsPagination.querySelector('li[data-page-control="next"]');
                    const existingNumbers = paymentsPagination.querySelectorAll('li[data-page-number]');
                    existingNumbers.forEach(item => item.remove());

                    const insertionPoint = nextControl || null;
                    for (let page = 1; page <= total; page++) {
                        const li = document.createElement('li');
                        li.className = `page-item${page === currentPage ? ' active' : ''}`;
                        li.dataset.pageNumber = String(page);
                        const button = document.createElement('button');
                        button.type = 'button';
                        button.className = 'page-link';
                        button.textContent = page;
                        li.appendChild(button);
                        if (insertionPoint) {
                            paymentsPagination.insertBefore(li, insertionPoint);
                        } else {
                            paymentsPagination.appendChild(li);
                        }
                    }

                    const prevDisabled = currentPage === 1;
                    const nextDisabled = currentPage === total;

                    if (prevControl) {
                        prevControl.classList.toggle('disabled', prevDisabled);
                        const prevButton = prevControl.querySelector('.page-link');
                        if (prevButton) {
                            prevButton.disabled = prevDisabled;
                            prevButton.setAttribute('aria-disabled', prevDisabled ? 'true' : 'false');
                        }
                    }

                    if (nextControl) {
                        nextControl.classList.toggle('disabled', nextDisabled);
                        const nextButton = nextControl.querySelector('.page-link');
                        if (nextButton) {
                            nextButton.disabled = nextDisabled;
                            nextButton.setAttribute('aria-disabled', nextDisabled ? 'true' : 'false');
                        }
                    }
                };

                const renderTable = () => {
                    const filteredRows = getFilteredRows();
                    totalPages = Math.max(1, Math.ceil(filteredRows.length / ROWS_PER_PAGE));
                    if (currentPage > totalPages) {
                        currentPage = totalPages;
                    }

                    dataRows.forEach(row => row.classList.add('d-none'));

                    if (!filteredRows.length) {
                        setEmptyState(0);
                        updatePaginationControls(totalPages);
                        return;
                    }

                    const start = (currentPage - 1) * ROWS_PER_PAGE;
                    const pageRows = filteredRows.slice(start, start + ROWS_PER_PAGE);
                    pageRows.forEach(row => row.classList.remove('d-none'));
                    setEmptyState(pageRows.length);
                    updatePaginationControls(totalPages);
                };

                const resetAndRender = () => {
                    currentPage = 1;
                    renderTable();
                };

                Object.values(filters).forEach(input => {
                    if (!input) return;
                    const eventName = input.tagName === 'INPUT' && input.type === 'text' ? 'input' : 'change';
                    input.addEventListener(eventName, resetAndRender);
                });

                paymentsPagination.addEventListener('click', event => {
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

                renderTable();
            }
        }

    });
})();
</script>
</body>
</html>
