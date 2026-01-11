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
            --page-bg: #f5f7fb;
            --gradient-emerald: rgba(34, 197, 94, 0.15);
            --gradient-aqua: rgba(14, 165, 233, 0.12);
            --gradient-indigo: rgba(79, 70, 229, 0.16);
            --surface: rgba(255, 255, 255, 0.94);
            --surface-strong: rgba(10, 23, 33, 0.92);
            --ink: #0f172a;
            --muted: #5f6c88;
            --accent: #16a34a;
            --accent-bright: #22c55e;
            --accent-alt: #38bdf8;
            --accent-warm: #7c3aed;
            --border: rgba(15, 23, 42, 0.12);
            --border-strong: rgba(255, 255, 255, 0.16);
            --shadow-soft: 0 45px 120px -60px rgba(15, 35, 28, 0.55);
            --shadow-hover: 0 55px 140px -65px rgba(15, 35, 28, 0.65);
            --radius-lg: 28px;
            --radius-md: 20px;
        }

        *, *::before, *::after {
            box-sizing: border-box;
        }

        body {
            margin: 0;
            font-family: 'Inter', sans-serif;
            background:
                radial-gradient(circle at 12% 16%, var(--gradient-emerald), transparent 55%),
                radial-gradient(circle at 84% 12%, var(--gradient-aqua), transparent 58%),
                radial-gradient(circle at 70% 78%, var(--gradient-indigo), transparent 60%),
                var(--page-bg);
            color: var(--ink);
            min-height: 100vh;
            overflow-x: hidden;
            line-height: 1.6;
            -webkit-font-smoothing: antialiased;
        }

        body.dark-mode {
            background:
                radial-gradient(circle at 16% 8%, rgba(45, 212, 191, 0.18), transparent 60%),
                radial-gradient(circle at 78% 18%, rgba(14, 165, 233, 0.18), transparent 62%),
                radial-gradient(circle at 72% 80%, rgba(79, 70, 229, 0.24), transparent 68%),
                #030712;
            color: #eef7ff;
        }

        body.dark-mode .text-muted,
        body.dark-mode small.text-muted,
        body.dark-mode .text-muted small {
            color: rgba(208, 214, 232, 0.72) !important;
        }

        a {
            color: inherit;
            text-decoration: none;
            transition: color 0.2s ease;
        }

        a:hover {
            color: var(--accent);
        }

        img {
            max-width: 100%;
            height: auto;
            display: block;
        }

        .sidebar {
            position: fixed;
            top: 0;
            left: 0;
            bottom: 0;
            width: 276px;
            padding: 2.1rem 1.55rem;
            display: flex;
            flex-direction: column;
            gap: 1.4rem;
            background: linear-gradient(160deg, rgba(9, 26, 19, 0.96), rgba(13, 48, 30, 0.94) 55%, rgba(16, 63, 39, 0.92));
            color: #ecfdf5;
            border-right: 1px solid var(--border-strong);
            box-shadow: 22px 0 60px -32px rgba(6, 18, 12, 0.7);
            backdrop-filter: blur(18px);
            z-index: 1040;
            transition: transform 0.35s ease;
            isolation: isolate;
        }

        .sidebar::before {
            content: '';
            position: absolute;
            width: 220px;
            height: 220px;
            bottom: -110px;
            right: -120px;
            border-radius: 50%;
            background: radial-gradient(circle, rgba(34, 197, 94, 0.4), transparent 65%);
            pointer-events: none;
        }

        body.dark-mode .sidebar {
            background: linear-gradient(170deg, rgba(6, 12, 18, 0.95), rgba(10, 21, 30, 0.9));
            border-right-color: rgba(148, 163, 184, 0.16);
            color: #e6fffa;
            box-shadow: 24px 0 80px -38px rgba(2, 10, 18, 0.9);
        }

        body.dark-mode .sidebar::before {
            background: radial-gradient(circle, rgba(94, 234, 212, 0.28), transparent 70%);
        }

        .sidebar-header {
            font-size: 1.35rem;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 0.16em;
            margin-bottom: 2.1rem;
        }

        .sidebar-header span {
            color: var(--accent);
        }

        .nav h6 {
            color: rgba(236, 253, 245, 0.58);
            letter-spacing: 0.09em;
            font-size: 0.68rem;
            text-transform: uppercase;
            margin: 1.3rem 0 0.55rem;
        }

        .nav-link {
            display: flex;
            align-items: center;
            gap: 0.7rem;
            padding: 0.68rem 0.95rem;
            color: rgba(236, 253, 245, 0.78);
            border-radius: 14px;
            transition: background 0.2s ease, color 0.2s ease, transform 0.2s ease, box-shadow 0.2s ease;
            position: relative;
        }

        .nav-link .icon {
            font-size: 1.1rem;
        }

        .nav-link:hover {
            background: rgba(255, 255, 255, 0.12);
            color: #fff;
            transform: translateX(6px);
        }

        .nav-link.active {
            background: linear-gradient(135deg, rgba(34, 197, 94, 0.95), rgba(14, 165, 233, 0.65));
            color: #fff;
            font-weight: 600;
            box-shadow: 0 18px 45px -22px rgba(34, 197, 94, 0.55);
        }

        .sidebar-cta {
            margin-top: 1.35rem;
            padding: 1.1rem;
            border-radius: 20px;
            background: rgba(34, 197, 94, 0.12);
            border: 1px solid rgba(34, 197, 94, 0.3);
            position: relative;
            overflow: hidden;
        }

        body.dark-mode .sidebar-cta {
            background: rgba(34, 197, 94, 0.18);
            border-color: rgba(34, 197, 94, 0.4);
        }

        .topbar {
            position: fixed;
            top: 0;
            left: 276px;
            right: 0;
            min-height: 80px;
            background: rgba(255, 255, 255, 0.86);
            border-bottom: 1px solid var(--border);
            display: flex;
            align-items: center;
            justify-content: center;
            z-index: 1030;
            box-shadow: 0 25px 60px -40px rgba(15, 35, 28, 0.45);
            backdrop-filter: blur(16px);
        }

        body.dark-mode .topbar {
            background: rgba(6, 12, 18, 0.78);
            border-bottom-color: rgba(148, 163, 184, 0.18);
            box-shadow: 0 30px 80px -45px rgba(2, 10, 18, 0.92);
        }

        .topbar-inner {
            width: 100%;
            max-width: 1320px;
            margin: 0 auto;
            padding: 0.9rem 2.2rem;
            display: flex;
            align-items: center;
            justify-content: space-between;
            flex-wrap: wrap;
            gap: 1rem;
        }

        .topbar .navbar-toggler {
            border: none;
            background: transparent;
            color: var(--accent);
            font-size: 1.85rem;
            display: none;
        }

        .topbar-meta {
            flex: 1 1 240px;
            min-width: 210px;
        }

        .topbar-meta p {
            font-size: 0.68rem;
            letter-spacing: 0.12em;
            text-transform: uppercase;
            color: var(--muted);
            margin-bottom: 0.25rem;
        }

        .topbar-meta h1 {
            margin: 0;
            font-size: clamp(1.35rem, 1.8vw, 1.65rem);
            font-weight: 600;
            color: var(--ink);
        }

        body.dark-mode .topbar-meta p {
            color: rgba(203, 213, 225, 0.65);
        }

        body.dark-mode .topbar-meta h1 {
            color: #e2e8f0;
        }

        .topbar-actions {
            flex: 1 1 280px;
            display: flex;
            align-items: center;
            justify-content: flex-end;
            gap: 0.6rem;
            flex-wrap: wrap;
        }

        .icon-btn {
            width: 42px;
            height: 42px;
            border-radius: 14px;
            border: 1px solid rgba(34, 197, 94, 0.3);
            background: #fff;
            color: var(--accent);
            display: flex;
            align-items: center;
            justify-content: center;
            transition: all 0.2s ease;
        }

        .icon-btn:hover {
            background: var(--accent);
            color: #fff;
            box-shadow: 0 18px 45px -20px rgba(34, 197, 94, 0.55);
        }

        body.dark-mode .icon-btn {
            background: rgba(34, 197, 94, 0.12);
            border-color: rgba(34, 197, 94, 0.38);
            color: #34d399;
        }

        body.dark-mode .icon-btn:hover {
            background: linear-gradient(135deg, rgba(34, 197, 94, 0.95), rgba(79, 70, 229, 0.72));
            color: #fff;
        }

        .btn-brand,
        .btn-success {
            border-radius: 16px;
            background: linear-gradient(135deg, var(--accent), var(--accent-bright));
            border: none;
            color: #fff;
            font-weight: 600;
            box-shadow: 0 18px 45px -20px rgba(34, 197, 94, 0.55);
        }

        .btn-brand:hover,
        .btn-success:hover {
            background: linear-gradient(135deg, #15803d, var(--accent));
            box-shadow: 0 24px 60px -26px rgba(34, 197, 94, 0.7);
        }

        .btn-outline-success {
            border-radius: 16px;
            border: 1px solid rgba(34, 197, 94, 0.35);
            background: rgba(34, 197, 94, 0.08);
            color: var(--accent);
            font-weight: 600;
            transition: all 0.2s ease;
        }

        .btn-outline-success:hover {
            background: linear-gradient(135deg, var(--accent), var(--accent-bright));
            color: #fff;
            border-color: transparent;
            box-shadow: 0 18px 45px -22px rgba(34, 197, 94, 0.6);
        }

        .btn-outline-secondary {
            border-radius: 16px;
            border: 1px solid rgba(79, 70, 229, 0.26);
            background: rgba(79, 70, 229, 0.08);
            color: var(--accent-warm);
            font-weight: 600;
        }

        .btn-outline-secondary:hover {
            background: linear-gradient(135deg, rgba(79, 70, 229, 0.95), rgba(14, 165, 233, 0.65));
            color: #fff;
            border-color: transparent;
            box-shadow: 0 18px 45px -22px rgba(79, 70, 229, 0.6);
        }

        .btn-outline-danger {
            border-radius: 14px;
            border: 1px solid rgba(239, 68, 68, 0.35);
            color: #ef4444;
        }

        .btn-outline-danger:hover {
            background: linear-gradient(135deg, #ef4444, #f97316);
            color: #fff;
            border-color: transparent;
        }

        .btn-outline-warning {
            border-radius: 14px;
            border: 1px solid rgba(250, 204, 21, 0.36);
            color: #f59e0b;
        }

        .btn-outline-warning:hover {
            background: linear-gradient(135deg, #f59e0b, #fde047);
            color: #1f2937;
        }

        .btn-light {
            border-radius: 16px;
            border: 1px solid rgba(148, 163, 184, 0.28);
            background: rgba(248, 250, 252, 0.75);
            color: var(--ink);
            font-weight: 600;
        }

        .main-content {
            margin-left: 276px;
            margin-top: 120px;
            padding: clamp(2.1rem, 4vw, 3.5rem) clamp(1.8rem, 4vw, 3.4rem) 3.4rem;
            transition: all 0.3s ease;
            min-height: calc(100vh - 120px);
            max-width: 1440px;
        }

        .hero-panel {
            position: relative;
            border-radius: 32px;
            background: linear-gradient(130deg, rgba(15, 45, 30, 0.95), rgba(14, 85, 52, 0.9));
            padding: clamp(1.6rem, 2.6vw, 2.7rem);
            margin-bottom: clamp(1.9rem, 3vw, 2.6rem);
            color: #ecfdf5;
            box-shadow: var(--shadow-soft);
            overflow: hidden;
            isolation: isolate;
        }

        .hero-panel::before,
        .hero-panel::after {
            content: '';
            position: absolute;
            border-radius: 50%;
            pointer-events: none;
            filter: blur(2px);
        }

        .hero-panel::before {
            width: 320px;
            height: 320px;
            top: -150px;
            right: -140px;
            background: radial-gradient(circle, rgba(34, 197, 94, 0.45), transparent 62%);
        }

        .hero-panel::after {
            width: 360px;
            height: 360px;
            bottom: -180px;
            left: -150px;
            background: radial-gradient(circle, rgba(79, 70, 229, 0.28), transparent 65%);
        }

        body.dark-mode .hero-panel {
            background: linear-gradient(135deg, rgba(4, 27, 19, 0.88), rgba(20, 83, 45, 0.92));
            color: #d1fae5;
        }

        .hero-panel > * {
            position: relative;
            z-index: 1;
        }

        .quick-actions .btn {
            border-radius: 16px;
            padding: 0.65rem 1.45rem;
        }

        .quick-actions .btn[disabled] {
            opacity: 0.6;
            cursor: not-allowed;
        }

        .glass-card,
        .stat-card,
        .table-wrapper,
        .timeline-card,
        .recent-actions-card,
        .analytics-card {
            position: relative;
            border-radius: var(--radius-lg);
            border: 1px solid var(--border);
            background: var(--surface);
            padding: 1.6rem;
            box-shadow: var(--shadow-soft);
            overflow: hidden;
            isolation: isolate;
        }

        .glass-card::before,
        .stat-card::before,
        .table-wrapper::before,
        .timeline-card::before,
        .recent-actions-card::before,
        .analytics-card::before {
            content: '';
            position: absolute;
            width: 240px;
            height: 240px;
            top: -160px;
            right: -140px;
            border-radius: 50%;
            background: radial-gradient(circle, var(--gradient-emerald), transparent 60%);
            pointer-events: none;
        }

        .glass-card::after,
        .stat-card::after,
        .table-wrapper::after,
        .timeline-card::after,
        .recent-actions-card::after,
        .analytics-card::after {
            content: '';
            position: absolute;
            width: 260px;
            height: 260px;
            bottom: -170px;
            left: -150px;
            border-radius: 50%;
            background: radial-gradient(circle, var(--gradient-indigo), transparent 65%);
            pointer-events: none;
        }

        .glass-card > *,
        .stat-card > *,
        .table-wrapper > *,
        .timeline-card > *,
        .recent-actions-card > *,
        .analytics-card > * {
            position: relative;
            z-index: 1;
        }

        body.dark-mode .glass-card,
        body.dark-mode .stat-card,
        body.dark-mode .table-wrapper,
        body.dark-mode .timeline-card,
        body.dark-mode .recent-actions-card,
        body.dark-mode .analytics-card {
            background: rgba(7, 13, 20, 0.88);
            border-color: rgba(148, 163, 184, 0.16);
            box-shadow: 0 35px 120px -70px rgba(2, 10, 18, 0.9);
            color: #e2e8f0;
        }

        body.dark-mode .glass-card::before,
        body.dark-mode .stat-card::before,
        body.dark-mode .table-wrapper::before,
        body.dark-mode .timeline-card::before,
        body.dark-mode .recent-actions-card::before,
        body.dark-mode .analytics-card::before {
            background: radial-gradient(circle, rgba(34, 197, 94, 0.22), transparent 65%);
        }

        body.dark-mode .glass-card::after,
        body.dark-mode .stat-card::after,
        body.dark-mode .table-wrapper::after,
        body.dark-mode .timeline-card::after,
        body.dark-mode .recent-actions-card::after,
        body.dark-mode .analytics-card::after {
            background: radial-gradient(circle, rgba(79, 70, 229, 0.22), transparent 68%);
        }

        .stat-card {
            transition: transform 0.2s ease, box-shadow 0.2s ease;
        }

        .stat-card:hover {
            transform: translateY(-4px);
            box-shadow: var(--shadow-hover);
        }

        .stat-card .icon {
            font-size: 2rem;
            padding: 0.75rem;
            border-radius: 16px;
            background: linear-gradient(135deg, rgba(34, 197, 94, 0.16), rgba(14, 165, 233, 0.16));
            color: var(--accent);
            box-shadow: inset 0 1px 0 rgba(255, 255, 255, 0.35);
        }

        body.dark-mode .stat-card .icon {
            background: linear-gradient(135deg, rgba(34, 197, 94, 0.22), rgba(79, 70, 229, 0.24));
            color: #34d399;
        }

        .text-success { color: var(--accent) !important; }
        .bg-success-light { background: rgba(34, 197, 94, 0.12); }
        .text-primary { color: var(--accent-alt) !important; }
        .bg-primary-light { background: rgba(56, 189, 248, 0.12); }
        .text-warning { color: #f59e0b !important; }
        .bg-warning-light { background: rgba(250, 204, 21, 0.12); }
        .text-info { color: #38bdf8 !important; }
        .bg-info-light { background: rgba(56, 189, 248, 0.12); }
        .text-secondary { color: #64748b !important; }
        .bg-secondary-light { background: rgba(148, 163, 184, 0.18); }
        .text-danger { color: #ef4444 !important; }
        .bg-danger-light { background: rgba(239, 68, 68, 0.12); }

        .table-wrapper {
            padding: 1.6rem;
        }

        .table-responsive {
            border-radius: 18px;
            overflow: hidden;
            border: 1px solid rgba(15, 23, 42, 0.08);
        }

        .table thead {
            background: rgba(15, 23, 42, 0.04);
        }

        .table th {
            font-weight: 600;
            letter-spacing: 0.02em;
            border-bottom: none;
            color: var(--muted);
        }

        .table .badge {
            font-weight: 600;
            padding: 0.4em 0.85em;
            border-radius: 999px;
            border: none;
        }

        .table tbody tr:hover {
            background: rgba(34, 197, 94, 0.08);
        }

        body.dark-mode .table-responsive {
            border-color: rgba(148, 163, 184, 0.14);
        }

        body.dark-mode .table thead,
        body.dark-mode .table thead th {
            background: rgba(15, 23, 42, 0.55);
            color: #e2e8f0;
            border-color: rgba(148, 163, 184, 0.16);
        }

        body.dark-mode .table tbody td {
            border-color: rgba(148, 163, 184, 0.12);
        }

        body.dark-mode .table tbody tr:hover {
            background: rgba(34, 197, 94, 0.18);
        }

        .btn-sm {
            padding: 0.28rem 0.6rem;
            font-size: 0.8rem;
            border-radius: 10px;
        }

        .filter-bar {
            gap: 0.75rem;
            padding: 0.95rem 1.15rem;
            border-radius: 24px;
            background: linear-gradient(135deg, rgba(34, 197, 94, 0.12), rgba(14, 165, 233, 0.08));
            border: 1px solid rgba(34, 197, 94, 0.14);
            box-shadow: 0 22px 55px -32px rgba(15, 35, 28, 0.35);
        }

        .filter-chip {
            flex: 1 1 220px;
            display: flex;
            align-items: center;
            gap: 0.75rem;
            padding: 0.65rem 1rem;
            border-radius: 18px;
            background: rgba(255, 255, 255, 0.92);
            border: 1px solid rgba(15, 23, 42, 0.08);
            box-shadow: inset 0 1px 0 rgba(255, 255, 255, 0.5);
            position: relative;
        }

        .filter-chip i {
            font-size: 1rem;
            color: var(--accent);
        }

        .filter-chip input,
        .filter-chip select {
            border: 0;
            background: transparent;
            width: 100%;
            outline: none;
            font-size: 0.95rem;
            color: var(--ink);
        }

        .filter-chip select {
            appearance: none;
            padding-right: 1.5rem;
            cursor: pointer;
        }

        .filter-chip .chevron {
            position: absolute;
            right: 0.85rem;
            top: 50%;
            transform: translateY(-50%);
            pointer-events: none;
            color: rgba(100, 116, 139, 0.8);
            font-size: 0.85rem;
        }

        .filter-actions {
            display: flex;
            gap: 0.55rem;
            flex-wrap: wrap;
        }

        .filter-actions .btn {
            border-radius: 999px;
            padding: 0.55rem 1.4rem;
            font-weight: 600;
        }

        body.dark-mode .filter-bar {
            background: rgba(6, 12, 18, 0.75);
            border-color: rgba(148, 163, 184, 0.18);
            box-shadow: 0 25px 70px -45px rgba(2, 10, 18, 0.85);
        }

        body.dark-mode .filter-chip {
            background: rgba(11, 23, 32, 0.9);
            border-color: rgba(148, 163, 184, 0.24);
            color: #e2e8f0;
        }

        body.dark-mode .filter-chip input,
        body.dark-mode .filter-chip select {
            color: #e2e8f0;
        }

        body.dark-mode .filter-chip i,
        body.dark-mode .filter-chip .chevron {
            color: rgba(165, 180, 195, 0.85);
        }

        body.dark-mode .filter-actions .btn-outline-success {
            background: rgba(34, 197, 94, 0.22);
            border-color: rgba(34, 197, 94, 0.38);
            color: #bbf7d0;
        }

        .analytics-card {
            min-height: 220px;
        }

        .growth-line {
            position: absolute;
            inset: 1.5rem;
            border-radius: 20px;
            background: linear-gradient(135deg, rgba(34, 197, 94, 0.25), rgba(14, 165, 233, 0.1));
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
            background: var(--accent);
            box-shadow: 0 0 0 6px rgba(34, 197, 94, 0.16);
        }

        body.dark-mode .timeline-list li::before {
            box-shadow: 0 0 0 6px rgba(34, 197, 94, 0.26);
        }

        .badge.text-bg-light {
            background: rgba(34, 197, 94, 0.15) !important;
            color: var(--accent) !important;
            border-radius: 999px;
            padding: 0.45rem 0.85rem;
        }

        .badge.bg-success-light {
            background: rgba(34, 197, 94, 0.18) !important;
            color: var(--accent) !important;
        }

        .badge.bg-primary-light {
            background: rgba(14, 165, 233, 0.18) !important;
            color: var(--accent-alt) !important;
        }

        .badge.bg-warning-light {
            background: rgba(250, 204, 21, 0.22) !important;
            color: #b45309 !important;
        }

        .badge.bg-info-light {
            background: rgba(56, 189, 248, 0.2) !important;
            color: #0284c7 !important;
        }

        .badge.bg-secondary-light {
            background: rgba(148, 163, 184, 0.2) !important;
            color: #475569 !important;
        }

        .progress {
            background: rgba(15, 23, 42, 0.08);
            border-radius: 999px;
        }

        body.dark-mode .progress {
            background: rgba(148, 163, 184, 0.18);
        }

        .progress-bar.bg-success {
            background: linear-gradient(135deg, var(--accent), var(--accent-bright));
        }

        .progress-bar.bg-warning {
            background: linear-gradient(135deg, #f59e0b, #fde047);
        }

        .progress-bar.bg-secondary {
            background: linear-gradient(135deg, #64748b, #94a3b8);
        }

        .alert {
            border-radius: 16px;
            border: 1px solid var(--border);
            box-shadow: var(--shadow-soft);
        }

        .alert-info {
            background: rgba(14, 165, 233, 0.14);
            border-color: rgba(14, 165, 233, 0.28);
            color: var(--ink);
        }

        .alert-warning {
            background: rgba(250, 204, 21, 0.16);
            border-color: rgba(250, 204, 21, 0.28);
        }

        .alert-danger {
            background: rgba(239, 68, 68, 0.14);
            border-color: rgba(239, 68, 68, 0.26);
        }

        .backdrop {
            position: fixed;
            inset: 0;
            background: rgba(6, 20, 14, 0.55);
            z-index: 1035;
            opacity: 0;
            pointer-events: none;
            transition: opacity 0.3s ease;
        }

        .backdrop.active {
            opacity: 1;
            pointer-events: auto;
        }

        @media (max-width: 1199.98px) {
            .topbar-inner {
                padding: 0.75rem 1.8rem;
            }

            .main-content {
                padding: 2.35rem clamp(1.5rem, 4vw, 2.8rem) 3.1rem;
            }
        }

        @media (max-width: 991.98px) {
            .sidebar {
                transform: translateX(-108%);
                width: min(82vw, 320px);
                box-shadow: 18px 0 55px -26px rgba(6, 18, 12, 0.65);
            }

            .sidebar.active {
                transform: translateX(0);
            }

            .topbar {
                left: 0;
            }

            .topbar .navbar-toggler {
                display: inline-flex;
            }

            .topbar-inner {
                padding: 0.75rem 1.4rem;
            }

            .main-content {
                margin-left: 0;
                margin-top: 170px;
                padding: 2rem 1.6rem 2.6rem;
            }

            .filter-bar {
                width: 100%;
            }

            .filter-bar > * {
                flex: 1 1 100%;
            }

            .topbar-actions {
                gap: 0.45rem;
            }

            .icon-btn {
                width: 38px;
                height: 38px;
            }

            .table-responsive {
                border-radius: 14px;
            }

            .stat-card,
            .analytics-card,
            .timeline-card,
            .recent-actions-card {
                padding: 1.4rem;
            }
        }

        @media (max-width: 767.98px) {
            .topbar-meta {
                flex-basis: 100%;
            }

            .hero-panel {
                text-align: left;
            }

            .quick-actions {
                width: 100%;
                justify-content: flex-start;
            }

            .quick-actions .btn {
                width: 100%;
            }

            .form-actions,
            .table-wrapper .d-flex {
                flex-direction: column;
                align-items: stretch;
            }

            .form-actions .btn {
                width: 100%;
            }
        }

        @media (max-width: 575.98px) {
            .topbar-inner {
                padding: 0.65rem 1.1rem;
            }

            .main-content {
                margin-top: 190px;
                padding: 1.6rem 1.15rem 2.2rem;
            }

            .hero-panel {
                padding: 1.4rem 1.2rem;
            }

            .stat-card,
            .analytics-card,
            .timeline-card,
            .recent-actions-card,
            .table-wrapper {
                padding: 1.2rem;
            }

            .filter-chip {
                flex: 1 1 100%;
            }
        }

        @media (max-width: 400px) {
            .hero-panel h1,
            .topbar-meta h1 {
                font-size: 1.25rem;
            }

            .btn,
            .btn-brand,
            .btn-success {
                width: 100%;
            }
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