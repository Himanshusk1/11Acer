<?php
$page_title = 'Post Your Property - 11 Acer';
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
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/aos@2.3.4/dist/aos.css">
    <link rel="icon" type="image/x-icon" href="<?= base_url('images/favicon/favicon.ico') ?>">

    <style>
        :root {
            --page-bg: #f4f7fb;
            --gradient-a: rgba(34, 197, 94, 0.18);
            --gradient-b: rgba(14, 165, 233, 0.12);
            --gradient-c: rgba(79, 70, 229, 0.16);
            --surface: rgba(255, 255, 255, 0.94);
            --surface-strong: #0f2d1f;
            --ink: #0f172a;
            --muted: #5f6c88;
            --accent: #16a34a;
            --accent-bright: #22c55e;
            --accent-soft: rgba(22, 163, 74, 0.14);
            --accent-alt-soft: rgba(79, 70, 229, 0.16);
            --border: rgba(15, 45, 35, 0.12);
            --border-strong: rgba(255, 255, 255, 0.12);
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
                radial-gradient(circle at 12% 18%, var(--gradient-a), transparent 58%),
                radial-gradient(circle at 82% 10%, var(--gradient-b), transparent 60%),
                radial-gradient(circle at 70% 78%, var(--gradient-c), transparent 62%),
                var(--page-bg);
            color: var(--ink);
            min-height: 100vh;
            line-height: 1.6;
            overflow-x: hidden;
            -webkit-font-smoothing: antialiased;
        }

        body.sidebar-open {
            overflow: hidden;
        }

        body.post-property-dashboard .navbar-custom,
        body.post-property-dashboard .site-footer {
            display: none !important;
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

        .layout-shell {
            min-height: 100vh;
        }

        /* Sidebar */
        .sidebar {
            position: fixed;
            inset: 0 auto 0 0;
            width: 276px;
            padding: 2.1rem 1.6rem;
            display: flex;
            flex-direction: column;
            gap: 1.4rem;
            background: linear-gradient(160deg, rgba(10, 32, 22, 0.96), rgba(13, 48, 30, 0.94) 55%, rgba(16, 63, 39, 0.92));
            color: #ecfdf5;
            border-right: 1px solid var(--border-strong);
            box-shadow: 22px 0 60px -32px rgba(6, 18, 12, 0.7);
            backdrop-filter: blur(18px);
            z-index: 1040;
            transition: transform 0.35s ease;
            isolation: isolate;
        }

        .sidebar-header {
            font-weight: 700;
            font-size: 1.3rem;
            text-transform: uppercase;
            letter-spacing: 0.16em;
        }

        .sidebar-profile {
            border-radius: 20px;
            padding: 1.2rem;
            background: rgba(255, 255, 255, 0.08);
            border: 1px solid rgba(255, 255, 255, 0.16);
            display: flex;
            align-items: center;
            gap: 0.8rem;
        }

        .sidebar-profile-avatar {
            width: 60px;
            height: 60px;
            border-radius: 16px;
            display: grid;
            place-items: center;
            font-weight: 700;
            font-size: 1.1rem;
            color: #ecfdf5;
            background: linear-gradient(135deg, rgba(34, 197, 94, 0.78), rgba(14, 165, 233, 0.52));
            box-shadow: 0 12px 24px rgba(15, 45, 35, 0.45);
        }

        .sidebar-scroll {
            flex: 1;
            overflow-y: auto;
            margin-right: -0.35rem;
            padding-right: 0.35rem;
            padding-bottom: 1.2rem;
        }

        .sidebar-scroll::-webkit-scrollbar {
            width: 6px;
        }

        .sidebar-scroll::-webkit-scrollbar-thumb {
            background: rgba(255, 255, 255, 0.25);
            border-radius: 6px;
        }

        .section-label {
            font-size: 0.65rem;
            letter-spacing: 0.12em;
            color: rgba(236, 253, 245, 0.6);
            text-transform: uppercase;
            margin-bottom: 0.6rem;
        }

        .dash-nav {
            list-style: none;
            margin: 0;
            padding: 0;
            display: grid;
            gap: 0.35rem;
        }

        .dash-nav .nav-link {
            display: flex;
            align-items: center;
            gap: 0.7rem;
            padding: 0.65rem 0.95rem;
            border-radius: 14px;
            color: rgba(236, 253, 245, 0.85);
            transition: background 0.2s ease, color 0.2s ease, transform 0.2s ease, box-shadow 0.2s ease;
        }

        .dash-nav .nav-link i {
            font-size: 1.1rem;
            flex-shrink: 0;
        }

        .dash-nav .nav-link:hover {
            background: rgba(255, 255, 255, 0.12);
            color: #fff;
            transform: translateX(6px);
        }

        .dash-nav .nav-link.active {
            background: linear-gradient(135deg, rgba(34, 197, 94, 0.95), rgba(14, 165, 233, 0.65));
            color: #fff;
            box-shadow: 0 18px 45px -22px rgba(34, 197, 94, 0.55);
        }

        .sidebar-cta {
            margin-top: 1.4rem;
            padding: 1.1rem;
            border-radius: 20px;
            background: rgba(34, 197, 94, 0.12);
            border: 1px solid rgba(34, 197, 94, 0.32);
            position: relative;
            overflow: hidden;
            isolation: isolate;
        }

        .sidebar-cta::before {
            content: '';
            position: absolute;
            width: 150px;
            height: 150px;
            top: -80px;
            right: -60px;
            border-radius: 50%;
            background: radial-gradient(circle, rgba(34, 197, 94, 0.35), transparent 60%);
            pointer-events: none;
        }

        /* Topbar */
        .topbar {
            position: fixed;
            top: 0;
            left: 276px;
            right: 0;
            min-height: 80px;
            background: rgba(255, 255, 255, 0.86);
            border-bottom: 1px solid var(--border);
            box-shadow: 0 25px 60px -40px rgba(15, 35, 28, 0.45);
            backdrop-filter: blur(16px);
            z-index: 1030;
        }

        .topbar-inner {
            width: 100%;
            max-width: 1340px;
            margin: 0 auto;
            padding: 0.8rem 2.2rem;
            display: flex;
            align-items: center;
            justify-content: space-between;
            flex-wrap: wrap;
            gap: 1rem;
        }

        .topbar-meta {
            flex: 1 1 240px;
            min-width: 210px;
        }

        .topbar-meta p {
            font-size: 0.68rem;
            letter-spacing: 0.12em;
            color: var(--muted);
            text-transform: uppercase;
            margin-bottom: 0.25rem;
        }

        .topbar-meta h1 {
            margin: 0;
            font-size: clamp(1.3rem, 1.8vw, 1.6rem);
            font-weight: 600;
            color: var(--ink);
        }

        .topbar-actions {
            flex: 1 1 280px;
            display: flex;
            align-items: center;
            justify-content: flex-end;
            gap: 0.6rem;
            flex-wrap: wrap;
        }

        .navbar-toggler {
            border: none;
            background: transparent;
            color: var(--accent);
            font-size: 1.8rem;
            display: none;
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

        .btn-brand,
        .btn-success {
            border-radius: 14px;
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
            border-radius: 14px;
            border-color: rgba(22, 163, 74, 0.35);
            color: var(--accent);
            transition: all 0.2s ease;
        }

        .btn-outline-success:hover {
            background: var(--accent);
            border-color: var(--accent);
            color: #fff;
            box-shadow: 0 20px 50px -24px rgba(34, 197, 94, 0.6);
        }

        .btn-soft {
            border-radius: 14px;
            border: 1px solid rgba(34, 197, 94, 0.25);
            background: rgba(34, 197, 94, 0.1);
            color: var(--accent);
            font-weight: 500;
        }

        .btn-soft:hover {
            background: var(--accent);
            color: #fff;
        }

        /* Main */
        .main-content {
            margin-left: 276px;
            padding: clamp(2rem, 4vw, 3.4rem) clamp(1.6rem, 4vw, 3.4rem) 3.2rem;
            max-width: 1440px;
        }

        .hero-panel {
            position: relative;
            border-radius: 32px;
            background: linear-gradient(130deg, rgba(15, 45, 30, 0.96), rgba(16, 79, 43, 0.9));
            padding: clamp(1.6rem, 2.6vw, 2.7rem);
            margin-bottom: clamp(1.8rem, 3vw, 2.5rem);
            box-shadow: var(--shadow-soft);
            color: #ecfdf5;
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
            width: 280px;
            height: 280px;
            top: -130px;
            right: -110px;
            background: radial-gradient(circle, rgba(34, 197, 94, 0.45), transparent 62%);
        }

        .hero-panel::after {
            width: 340px;
            height: 340px;
            bottom: -170px;
            left: -130px;
            background: radial-gradient(circle, rgba(79, 70, 229, 0.28), transparent 65%);
        }

        .hero-panel > * {
            position: relative;
            z-index: 1;
        }

        .hero-panel .text-muted {
            color: rgba(236, 253, 245, 0.75) !important;
        }

        .floating-hints {
            display: flex;
            flex-wrap: wrap;
            gap: 0.5rem;
        }

        .floating-hints span {
            border-radius: 999px;
            padding: 0.4rem 0.9rem;
            background: rgba(236, 253, 245, 0.18);
            border: 1px solid rgba(236, 253, 245, 0.32);
            color: #ecfdf5;
            font-weight: 500;
        }

        .panel-section {
            position: relative;
            border-radius: var(--radius-lg);
            border: 1px solid var(--border);
            background: var(--surface);
            padding: clamp(1.45rem, 2.3vw, 2rem);
            margin-bottom: clamp(1.6rem, 2.8vw, 2.2rem);
            box-shadow: var(--shadow-soft);
            isolation: isolate;
            overflow: hidden;
        }

        .panel-section::before,
        .panel-section::after {
            content: '';
            position: absolute;
            border-radius: 50%;
            pointer-events: none;
        }

        .panel-section::before {
            width: 240px;
            height: 240px;
            top: -140px;
            right: -140px;
            background: radial-gradient(circle, rgba(34, 197, 94, 0.18), transparent 60%);
        }

        .panel-section::after {
            width: 260px;
            height: 260px;
            bottom: -150px;
            left: -120px;
            background: radial-gradient(circle, rgba(79, 70, 229, 0.16), transparent 65%);
        }

        .panel-section > * {
            position: relative;
            z-index: 1;
        }

        .stepper-card {
            position: sticky;
            top: 120px;
            padding: 1.9rem;
        }

        .stepper-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 1.1rem;
        }

        .stepper-header h5 {
            margin: 0;
            font-size: 1rem;
            letter-spacing: 0.1em;
            text-transform: uppercase;
            color: var(--muted);
        }

        .stepper {
            list-style: none;
            margin: 0;
            padding: 0;
            display: flex;
            flex-direction: column;
            gap: 1.2rem;
        }

        .step {
            display: flex;
            gap: 0.85rem;
            align-items: center;
            padding: 0.85rem 0.7rem;
            border-radius: 18px;
            background: rgba(255, 255, 255, 0.18);
            border: 1px solid rgba(34, 197, 94, 0.18);
            transition: transform 0.2s ease, box-shadow 0.2s ease, background 0.2s ease;
        }

        .step.active {
            background: rgba(34, 197, 94, 0.14);
            box-shadow: 0 20px 55px -32px rgba(15, 35, 28, 0.55);
        }

        .step.completed {
            opacity: 0.9;
        }

        .step-icon {
            width: 44px;
            height: 44px;
            border-radius: 16px;
            background: rgba(255, 255, 255, 0.9);
            border: 1px solid rgba(34, 197, 94, 0.28);
            display: grid;
            place-items: center;
            font-weight: 600;
            color: var(--accent);
            box-shadow: 0 12px 28px -18px rgba(34, 197, 94, 0.55);
        }

        .step.active .step-icon,
        .step.completed .step-icon {
            background: linear-gradient(135deg, var(--accent), var(--accent-bright));
            border-color: transparent;
            color: #fff;
        }

        .step-content h6 {
            margin: 0;
            font-size: 1.02rem;
            color: var(--ink);
        }

        .step-content small {
            color: var(--muted);
            text-transform: uppercase;
            letter-spacing: 0.08em;
        }

        .step-progress {
            font-weight: 600;
            color: var(--accent);
            margin-left: 0.35rem;
        }

        .step-description {
            margin: 0.25rem 0 0;
            color: var(--muted);
            font-size: 0.9rem;
        }

        .form-section {
            display: none;
            flex-direction: column;
            gap: 1.25rem;
        }

        .form-section.active {
            display: flex;
        }

        .form-section h3 {
            font-size: 1.45rem;
            margin-bottom: 0.4rem;
            color: var(--ink);
        }

        .form-section p.lead {
            color: var(--muted);
            margin-bottom: 0.5rem;
        }

        .form-divider {
            border-color: var(--border);
            margin: 1rem 0 1.6rem;
        }

        .form-label-group {
            font-weight: 600;
            color: var(--ink);
            margin-bottom: 0.75rem;
        }

        .btn-check-group {
            display: flex;
            flex-wrap: wrap;
            gap: 0.55rem;
        }

        .btn-check + .btn-check-label {
            border-radius: 14px;
            border: 1px solid var(--border);
            background: rgba(255, 255, 255, 0.9);
            padding: 0.55rem 1.2rem;
            font-weight: 500;
            transition: all 0.2s ease;
        }

        .btn-check:checked + .btn-check-label,
        .btn-check:focus + .btn-check-label,
        .btn-check + .btn-check-label:hover {
            background: linear-gradient(135deg, var(--accent), var(--accent-bright));
            color: #fff;
            border-color: transparent;
            box-shadow: 0 18px 40px -24px rgba(34, 197, 94, 0.45);
        }

        .form-control,
        .form-select {
            border-radius: 14px;
            border: 1px solid var(--border);
            background: rgba(255, 255, 255, 0.96);
            transition: border-color 0.2s ease, box-shadow 0.2s ease;
        }

        .form-control:focus,
        .form-select:focus {
            border-color: var(--accent);
            box-shadow: 0 0 0 0.25rem rgba(34, 197, 94, 0.2);
        }

        .upload-box {
            border-radius: var(--radius-md);
            border: 2px dashed rgba(34, 197, 94, 0.35);
            background: rgba(240, 250, 244, 0.92);
            padding: 2.1rem;
            text-align: center;
            box-shadow: var(--shadow-soft);
            position: relative;
            overflow: hidden;
        }

        .upload-box::before {
            content: '';
            position: absolute;
            width: 220px;
            height: 220px;
            top: -140px;
            right: -120px;
            border-radius: 50%;
            background: radial-gradient(circle, rgba(79, 70, 229, 0.18), transparent 65%);
            pointer-events: none;
        }

        .upload-box input[type="file"] {
            border-radius: 14px;
        }

        .preview-grid img {
            width: 100px;
            height: 70px;
            object-fit: cover;
            border-radius: 14px;
            box-shadow: 0 18px 40px -26px rgba(15, 35, 28, 0.65);
        }

        .form-actions {
            display: flex;
            flex-wrap: wrap;
            justify-content: space-between;
            align-items: center;
            gap: 0.85rem;
        }

        .form-actions .btn {
            min-width: 160px;
        }

        .badge.text-bg-light {
            background: rgba(34, 197, 94, 0.15) !important;
            color: var(--accent) !important;
            border-radius: 999px;
            padding: 0.45rem 0.8rem;
            border: none;
        }

        .alert {
            border-radius: 16px;
            border: 1px solid var(--border);
            box-shadow: var(--shadow-soft);
        }

        .alert-info {
            background: rgba(79, 70, 229, 0.1);
            border-color: rgba(79, 70, 229, 0.24);
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

        .stepper-card ::-webkit-scrollbar,
        .btn-check-group::-webkit-scrollbar {
            height: 6px;
        }

        .stepper-card ::-webkit-scrollbar-thumb,
        .btn-check-group::-webkit-scrollbar-thumb {
            background: var(--accent);
            border-radius: 999px;
        }

        /* Backdrop */
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

        /* Breakpoints */
        @media (max-width: 1199.98px) {
            .topbar-inner {
                padding: 0.75rem 1.8rem;
            }

            .main-content {
                padding: 2.3rem clamp(1.4rem, 4vw, 2.6rem) 3rem;
            }
        }

        @media (max-width: 991.98px) {
            .sidebar {
                transform: translateX(-108%);
                width: min(82vw, 320px);
                box-shadow: 18px 0 45px -26px rgba(6, 18, 12, 0.65);
            }

            .sidebar.active {
                transform: translateX(0);
            }

            .topbar {
                left: 0;
            }

            .topbar-inner {
                padding: 0.75rem 1.4rem;
            }

            .navbar-toggler {
                display: inline-flex;
            }

            .main-content {
                margin-left: 0;
                margin-top: 170px;
                padding: 2rem 1.6rem 2.6rem;
            }

            .stepper-card {
                position: static;
                padding: 1.5rem;
            }

            .stepper {
                flex-direction: row;
                overflow-x: auto;
                padding-bottom: 0.6rem;
            }

            .step {
                min-width: 220px;
            }
        }

        @media (max-width: 767.98px) {
            .topbar-meta {
                flex-basis: 100%;
            }

            .hero-panel .row {
                text-align: left;
            }

            .form-actions {
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

            .panel-section {
                padding: 1.2rem;
            }

            .step {
                min-width: 190px;
            }
        }

        @media (max-width: 400px) {
            .hero-panel h2 {
                font-size: 1.35rem;
            }

            .btn,
            .btn-brand,
            .btn-success {
                width: 100%;
            }
        }
    </style>
</head>
<body class="post-property-dashboard">
<?= $this->include('layouts/header') ?>
<?php
    $session = session();
    $userFullName = $session->get('full_name') ?: 'User';
    $userEmail = $session->get('email') ?: 'you@example.com';
    $userRole = ucfirst($session->get('role') ?: 'Member');
    $parts = preg_split('/\s+/', trim($userFullName));
    $initials = '';
    foreach ($parts as $index => $part) {
        if ($index >= 2) { break; }
        $initials .= strtoupper(substr($part, 0, 1));
    }
    if ($initials === '') { $initials = 'U'; }
?>
<div class="layout-shell">
    <?= view('user/partials/sidebar', [
        'initials'     => $initials,
        'userFullName' => $userFullName,
        'userRole'     => $userRole,
    ]) ?>

    <?= view('user/partials/topbar', [
        'initials'     => $initials,
        'userFullName' => $userFullName,
        'userRole'     => $userRole,
    ]) ?>

    <main class="main-content" id="main-content">
        <section id="section-post" class="hero-panel" data-aos="fade-up">
            <div class="row align-items-center g-4">
                <div class="col-lg-8">
                    <p class="text-uppercase text-muted small mb-2">Post property</p>
                    <h2 class="mb-2">Hi <?= esc($userFullName) ?>, let's publish your next listing</h2>
                    <p class="mb-0 text-muted">Keep your details handy. This guided flow mirrors your dashboard experience and saves progress per step.</p>
                </div>
                <div class="col-lg-4 text-lg-end">
                    <div class="floating-hints">
                        <span><i class="bi bi-clock"></i> ~6 min</span>
                        <span><i class="bi bi-images"></i> 50 photos</span>
                        <span><i class="bi bi-check2-circle"></i> Smart validation</span>
                    </div>
                </div>
            </div>
        </section>

        <div class="row g-4 align-items-start">
            <div class="col-12 col-xl-4">
                <aside class="panel-section stepper-card" data-aos="fade-right">
                    <div class="stepper-header">
                        <h5>Step Progress</h5>
                        <span class="badge text-bg-light text-success border-0">Live</span>
                    </div>
                    <ul class="stepper" id="stepper-track">
                        <li class="step active" data-step="1">
                            <div class="step-icon">1</div>
                            <div class="step-content">
                                <div class="d-flex align-items-center">
                                    <h6 class="mb-0">Basic Details</h6>
                                    <span class="step-progress ms-2 small">8%</span>
                                </div>
                                <p class="step-description">Goal, property category, type.</p>
                            </div>
                        </li>
                        <li class="step" data-step="2">
                            <div class="step-icon">2</div>
                            <div class="step-content">
                                <div class="d-flex align-items-center">
                                    <h6 class="mb-0">Location</h6>
                                    <span class="step-progress ms-2 small">8%</span>
                                </div>
                                <p class="step-description">City, locality & society.</p>
                            </div>
                        </li>
                        <li class="step" data-step="3">
                            <div class="step-icon">3</div>
                            <div class="step-content">
                                <div class="d-flex align-items-center">
                                    <h6 class="mb-0">Property Profile</h6>
                                    <span class="step-progress ms-2 small">8%</span>
                                </div>
                                <p class="step-description">Area, pricing, attributes.</p>
                            </div>
                        </li>
                        <li class="step" data-step="4">
                            <div class="step-icon">4</div>
                            <div class="step-content">
                                <div class="d-flex align-items-center">
                                    <h6 class="mb-0">Media</h6>
                                    <span class="step-progress ms-2 small">8%</span>
                                </div>
                                <p class="step-description">Photos, walkthroughs.</p>
                            </div>
                        </li>
                        <li class="step" data-step="5">
                            <div class="step-icon">5</div>
                            <div class="step-content">
                                <div class="d-flex align-items-center">
                                    <h6 class="mb-0">Amenities & Terms</h6>
                                    <span class="step-progress ms-2 small">8%</span>
                                </div>
                                <p class="step-description">Lease details & highlights.</p>
                            </div>
                        </li>
                    </ul>
                    <div class="mt-4 small text-muted">
                        Tip: You can tap any completed step to revisit without losing progress.
                    </div>
                </aside>
            </div>

            <div class="col-12 col-xl-8">
                <form id="multi-step-form" class="needs-validation" novalidate enctype="multipart/form-data" method="post" data-aos="fade-up">
                    <?= csrf_field() ?>

                    <div class="panel-section form-section active" data-step="1">
                        <div>
                            <p class="text-uppercase text-muted small mb-1">Step 1</p>
                            <h3>Tell us what you are posting</h3>
                            <p class="lead">Choose your goal and category so we can tailor the rest of the form.</p>
                        </div>
                        <hr class="form-divider d-none">

                        <div>
                            <p class="form-label-group">I am looking to</p>
                            <div class="btn-check-group">
                                <div>
                                    <input type="radio" class="btn-check" name="lookingTo" id="looking-sell" value="sell" checked>
                                    <label class="btn-check-label" for="looking-sell">Sell</label>
                                </div>
                                <div>
                                    <input type="radio" class="btn-check" name="lookingTo" id="looking-rent" value="rent">
                                    <label class="btn-check-label" for="looking-rent">Rent / Lease</label>
                                </div>
                                <div id="pg-option-wrapper">
                                    <input type="radio" class="btn-check" name="lookingTo" id="looking-pg" value="pg">
                                    <label class="btn-check-label" for="looking-pg">PG</label>
                                </div>
                            </div>
                        </div>

                        <div>
                            <p class="form-label-group">Property category</p>
                            <div class="btn-check-group">
                                <div>
                                    <input type="radio" class="btn-check" name="propertyCategory" id="cat-residential" value="residential" checked>
                                    <label class="btn-check-label" for="cat-residential">Residential</label>
                                </div>
                                <div>
                                    <input type="radio" class="btn-check" name="propertyCategory" id="cat-commercial" value="commercial">
                                    <label class="btn-check-label" for="cat-commercial">Commercial</label>
                                </div>
                            </div>
                        </div>

                        <div id="property-type-container"></div>
                        <div id="sub-type-container"></div>

                        <div class="form-actions">
                            <button type="button" class="btn btn-brand next-step">Continue</button>
                        </div>
                    </div>

                    <div class="panel-section form-section" data-step="2">
                        <div>
                            <p class="text-uppercase text-muted small mb-1">Step 2</p>
                            <h3>Where is your property located?</h3>
                            <p class="lead">Accurate location helps buyers and tenants discover you faster.</p>
                        </div>
                        <hr class="form-divider">

                        <div class="row g-3">
                            <div class="col-12">
                                <label for="city" class="form-label">City</label>
                                <input type="text" id="city" name="city" class="form-control" placeholder="Enter city" required>
                                <div class="invalid-feedback">City is required.</div>
                            </div>
                            <div class="col-12">
                                <label for="locality" class="form-label">Locality</label>
                                <input type="text" id="locality" name="locality" class="form-control" placeholder="Enter locality" required>
                                <div class="invalid-feedback">Locality is required.</div>
                            </div>
                            <div class="col-12">
                                <label for="sublocality" class="form-label">Sub Locality (Optional)</label>
                                <input type="text" id="sublocality" name="sublocality" class="form-control" placeholder="Enter sub locality">
                            </div>
                            <div class="col-12">
                                <label for="apartment" class="form-label">Apartment / Society (Optional)</label>
                                <input type="text" id="apartment" name="apartment" class="form-control" placeholder="Enter apartment or society name">
                            </div>
                        </div>

                        <div class="form-actions">
                            <button type="button" class="btn btn-soft prev-step">Back</button>
                            <button type="button" class="btn btn-brand next-step">Continue</button>
                        </div>
                    </div>

                    <div class="panel-section form-section" data-step="3">
                        <div>
                            <p class="text-uppercase text-muted small mb-1">Step 3</p>
                            <h3>Tell us about your property</h3>
                            <p class="lead">Fields update automatically based on the goal & category you choose.</p>
                        </div>
                        <hr class="form-divider">

                        <div id="property-profile-fields"></div>

                        <div class="form-actions">
                            <button type="button" class="btn btn-soft prev-step">Back</button>
                            <button type="button" class="btn btn-brand next-step">Continue</button>
                        </div>
                    </div>

                    <div class="panel-section form-section" data-step="4">
                        <div>
                            <p class="text-uppercase text-muted small mb-1">Step 4</p>
                            <h3>Add photos & walkthroughs</h3>
                            <p class="lead">High-quality media dramatically improves conversions.</p>
                        </div>
                        <hr class="form-divider">

                        <div class="row g-3">
                            <div class="col-12">
                                <label class="form-label">Photos (you can select multiple, up to 50)</label>
                                <div class="upload-box">
                                    <i class="bi bi-cloud-arrow-up fs-1 text-success"></i>
                                    <p class="mb-2">Drag and drop or click to upload photos</p>
                                    <input type="file" accept="image/*" id="photos" name="photos[]" multiple class="form-control" />
                                    <small class="text-muted d-block mt-2">Max size per image: 10MB. Max count: 50.</small>
                                    <div id="photos-preview" class="preview-grid d-flex flex-wrap gap-2 mt-3"></div>
                                </div>
                            </div>
                            <div class="col-12">
                                <label class="form-label">Floor plan (optional)</label>
                                <input type="file" accept="image/*,application/pdf" id="floor-plan" name="floor_plan" class="form-control" />
                                <small class="text-muted d-block mt-2">Upload a PDF or image version of the floor plan (helps buyers visualise the unit).</small>
                            </div>
                            <div class="col-12">
                                <label class="form-label">Walkthrough links (optional)</label>
                                <div id="video-links-list"></div>
                                <button type="button" id="add-video-link-btn" class="btn btn-soft btn-sm">
                                    <i class="bi bi-plus-lg"></i> Add another link
                                </button>
                                <small class="text-muted d-block mt-2">Paste URLs from YouTube, Instagram, Reels, or any hosting platform you prefer.</small>
                            </div>
                            <div class="col-12">
                                <label class="form-label">Voice-over / Description (optional)</label>
                                <textarea class="form-control" name="voice_over" rows="2" placeholder="Add a short voice-over text or description"></textarea>
                            </div>
                        </div>

                        <div class="form-actions">
                            <button type="button" class="btn btn-soft prev-step">Back</button>
                            <button type="button" class="btn btn-brand next-step">Continue</button>
                        </div>
                    </div>

                    <div class="panel-section form-section" data-step="5">
                        <div>
                            <p class="text-uppercase text-muted small mb-1">Step 5</p>
                            <h3>Amenities & lease terms</h3>
                            <p class="lead">Optional, but listings with amenities see 3x more enquiries.</p>
                        </div>
                        <hr class="form-divider">

                        <div id="amenities-container" class="vstack gap-4"></div>

                        <div class="form-actions">
                            <button type="button" class="btn btn-soft prev-step">Back</button>
                            <button type="submit" class="btn btn-brand" data-swal-confirm="Submit your property listing?">Save and Submit</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </main>
</div>

<?= $this->include('layouts/footer') ?>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/aos@2.3.4/dist/aos.js"></script>
<script>
(function(){
    const sidebar = document.getElementById('user-sidebar');
    const toggler = document.getElementById('sidebar-toggler');
    const backdrop = document.getElementById('sidebar-backdrop');
    const backBtn = document.getElementById('dashboard-back-btn');
    const body = document.body;
    const dashboardUrl = '<?= site_url('dashboard') ?>';

    const setSidebarState = (open) => {
        if (!sidebar) return;
        if (open) {
            sidebar.classList.add('active');
            backdrop?.classList.add('active');
            body.classList.add('sidebar-open');
        } else {
            sidebar.classList.remove('active');
            backdrop?.classList.remove('active');
            body.classList.remove('sidebar-open');
        }
    };

    const toggleSidebar = () => {
        const shouldOpen = !(sidebar?.classList?.contains('active'));
        setSidebarState(shouldOpen);
    };

    toggler?.addEventListener('click', toggleSidebar);
    backdrop?.addEventListener('click', () => setSidebarState(false));
    backBtn?.addEventListener('click', () => {
        if (window.history.length > 1) {
            window.history.back();
        } else {
            window.location.href = dashboardUrl;
        }
    });
    window.addEventListener('resize', () => { if (window.innerWidth >= 992) setSidebarState(false); });
    window.AOS?.init({ duration:600, once:true });

    document.addEventListener('DOMContentLoaded', () => {
        document.querySelectorAll('.dash-nav .nav-link').forEach(link => link.classList.remove('active'));
        const postLink = document.querySelector('.dash-nav .nav-link[href$="post-your-property"]');
        postLink?.classList.add('active');

        const redirectToDashboardSection = (section) => {
            const sectionHash = section ? '#' + section : '';
            window.location.href = dashboardUrl + sectionHash;
        };

        document.querySelectorAll('.dash-nav .nav-link').forEach(link => {
            link.addEventListener('click', (e) => {
                const targetSection = link.getAttribute('data-target');
                if (!targetSection) return;
                if (!document.getElementById(targetSection)) {
                    e.preventDefault();
                    redirectToDashboardSection(targetSection);
                }
            });
        });

        document.querySelectorAll('[data-target]').forEach(el => {
            if (el.closest('.dash-nav')) return;
            el.addEventListener('click', (e) => {
                const targetSection = el.getAttribute('data-target');
                if (!targetSection) return;
                if (!document.getElementById(targetSection)) {
                    e.preventDefault();
                    redirectToDashboardSection(targetSection);
                }
            });
        });
    });
})();
</script>

<script>
// Multi-step form logic retained from original page with UI adjustments
document.addEventListener('DOMContentLoaded', function () {
    async function checkPostingAllowed() {
        try {
            const resp = await fetch('<?= site_url('api/subscriptions/status') ?>', { credentials: 'same-origin' });
            const data = await resp.json().catch(() => ({}));
            if (!resp.ok) return;

            const formEl = document.getElementById('multi-step-form');
            const existing = document.getElementById('posting-banner');
            if (existing) existing.remove();

            if (data && data.can_post) {
                return;
            }

            if (formEl) {
                Array.from(formEl.querySelectorAll('input, select, textarea, button')).forEach(i => i.disabled = true);
            }

            let message = 'You need an active subscription to post properties.';
            if (data && data.reason === 'cooldown' && data.days_left !== undefined) {
                message = 'You have already posted once. You can post again after ' + data.days_left + ' day(s), or purchase a subscription.';
            } else if (data && data.reason === 'agent_must_subscribe') {
                message = 'Agents must purchase a subscription before posting properties.';
            }

            Swal.fire({
                icon: 'warning',
                title: 'Subscription required',
                html: message + '<br><small>You will be redirected to your dashboard to manage subscriptions.</small>',
                confirmButtonText: 'Go to dashboard',
                allowOutsideClick: false
            }).then(function(){
                window.location.href = '<?= site_url('dashboard') ?>#section-payments';
            });
        } catch (err) {
            console.error('Error checking subscription status', err);
        }
    }

    const form = document.getElementById('multi-step-form');
    const submitButton = form ? form.querySelector('button[type="submit"]') : null;
    const steps = document.querySelectorAll('.stepper .step');
    const formSections = document.querySelectorAll('.form-section');
    const nextButtons = document.querySelectorAll('.next-step');
    const prevButtons = document.querySelectorAll('.prev-step');
    const propertyTypeContainer = document.getElementById('property-type-container');
    const subTypeContainer = document.getElementById('sub-type-container');
    const propertyProfileFields = document.getElementById('property-profile-fields');
    const amenitiesContainer = document.getElementById('amenities-container');
    const pgOptionWrapper = document.getElementById('pg-option-wrapper');
    const stepProgressEls = document.querySelectorAll('.step-progress');
    const photosInput = document.getElementById('photos');
    const photosPreview = document.getElementById('photos-preview');
    const videosInput = document.getElementById('videos');
    const videoLinksList = document.getElementById('video-links-list');
    const addVideoLinkBtn = document.getElementById('add-video-link-btn');

    let currentStep = 1;
    let submissionCompleted = false;
    let propertyScore = 8;

    const options = {
        residential: {
            sell: ['FLAT/Apartment', 'Independent House/Villa', 'Independent/Builder Floor', 'Plot/Land', '1RK/Studio Apartment', 'Serviced Apartment', 'Farmhouse', 'Other'],
            rent: ['FLAT/Apartment', 'Independent House/Villa', 'Independent/Builder Floor', '1RK/Studio Apartment', 'Serviced Apartment', 'Other'],
            pg: ['FLAT/Apartment', 'Independent House/Villa', '1RK/Studio Apartment']
        },
        commercial: {
            sell: ['Office', 'Retail', 'Plot/Land', 'Storage', 'Industry', 'Hospitality', 'Other'],
            rent: ['Office', 'Retail', 'Storage', 'Industry', 'Hospitality', 'Other'],
            subTypes: {
                'Office': ['Ready to move office space', 'Bare shell office space', 'Co-working office space'],
                'Retail': ['Commercial Shops', 'Commercial Showrooms'],
                'Plot/Land': ['Commercial Land/Institutional Land', 'Industrial Land/Plots'],
                'Storage': ['Warehouse', 'Cold Storage'],
                'Industry': ['Factory', 'Manufacturing Unit'],
                'Hospitality': ['Hotel/Resorts', 'Guest House/Banquet Hall']
            }
        }
    };

    function buildRadioGroup(name, items, title = 'Select') {
        if (!items || items.length === 0) return '';
        let html = `<p class="form-label-group">${title}</p><div class="btn-check-group">`;
        items.forEach((item, idx) => {
            const id = `${name}-${idx}-${item.toLowerCase().replace(/[^a-z0-9]/g,'')}`;
            html += `<div>
                        <input type="radio" class="btn-check" name="${name}" id="${id}" value="${item}" ${idx===0?'checked':''}>
                        <label class="btn-check-label" for="${id}">${item}</label>
                    </div>`;
        });
        html += `</div>`;
        return html;
    }

    function generateFurnishingSection() {
        return `
            <div class="mb-4">
                <p class="form-label-group">Furnishing</p>
                <div class="btn-check-group">
                    <div><input type="radio" class="btn-check" name="furnishing" id="furnish-full" value="furnished"><label class="btn-check-label" for="furnish-full">Furnished</label></div>
                    <div><input type="radio" class="btn-check" name="furnishing" id="furnish-semi" value="semi-furnished"><label class="btn-check-label" for="furnish-semi">Semi-Furnished</label></div>
                    <div><input type="radio" class="btn-check" name="furnishing" id="furnish-none" value="unfurnished" checked><label class="btn-check-label" for="furnish-none">Unfurnished</label></div>
                </div>
            </div>
            <div id="furnishing-details" style="display:none;" class="mb-4">
                <p class="form-label-group">Furnishing Items</p>
                <div class="row g-3">
                    <div class="col-md-4"><div class="form-check"><input class="form-check-input" type="checkbox" name="furnishing_items[]" id="item-lights" value="lights"><label class="form-check-label" for="item-lights">Lights</label></div></div>
                    <div class="col-md-4"><div class="form-check"><input class="form-check-input" type="checkbox" name="furnishing_items[]" id="item-ac" value="ac"><label class="form-check-label" for="item-ac">AC</label></div></div>
                    <div class="col-md-4"><div class="form-check"><input class="form-check-input" type="checkbox" name="furnishing_items[]" id="item-tv" value="tv"><label class="form-check-label" for="item-tv">TV</label></div></div>
                    <div class="col-md-4"><div class="form-check"><input class="form-check-input" type="checkbox" name="furnishing_items[]" id="item-beds" value="beds"><label class="form-check-label" for="item-beds">Beds</label></div></div>
                    <div class="col-md-4"><div class="form-check"><input class="form-check-input" type="checkbox" name="furnishing_items[]" id="item-wardrobe" value="wardrobe"><label class="form-check-label" for="item-wardrobe">Wardrobe</label></div></div>
                    <div class="col-md-4"><div class="form-check"><input class="form-check-input" type="checkbox" name="furnishing_items[]" id="item-fans" value="fans"><label class="form-check-label" for="item-fans">Fans</label></div></div>
                    <div class="col-md-4"><div class="form-check"><input class="form-check-input" type="checkbox" name="furnishing_items[]" id="item-geyser" value="geyser"><label class="form-check-label" for="item-geyser">Geyser</label></div></div>
                    <div class="col-md-4"><div class="form-check"><input class="form-check-input" type="checkbox" name="furnishing_items[]" id="item-fridge" value="fridge"><label class="form-check-label" for="item-fridge">Refrigerator</label></div></div>
                    <div class="col-md-4"><div class="form-check"><input class="form-check-input" type="checkbox" name="furnishing_items[]" id="item-curtains" value="curtains"><label class="form-check-label" for="item-curtains">Curtains</label></div></div>
                    <div class="col-md-4"><div class="form-check"><input class="form-check-input" type="checkbox" name="furnishing_items[]" id="item-study" value="study_table"><label class="form-check-label" for="item-study">Study Table</label></div></div>
                </div>
            </div>`;
    }

    function renderPropertyTypes() {
        const looking = form.querySelector('input[name="lookingTo"]:checked')?.value || 'sell';
        const cat = form.querySelector('input[name="propertyCategory"]:checked')?.value || 'residential';

        if (cat === 'commercial') {
            pgOptionWrapper.style.display = 'none';
            if (looking === 'pg') {
                const sellOption = form.querySelector('input[name="lookingTo"][value="sell"]');
                if (sellOption) sellOption.checked = true;
            }
        } else {
            pgOptionWrapper.style.display = 'block';
        }

        const types = options[cat]?.[looking] || [];
        propertyTypeContainer.innerHTML = buildRadioGroup('propertyType', types, 'Property Type');

        propertyTypeContainer.querySelectorAll('input[name="propertyType"]').forEach(r => {
            r.addEventListener('change', function() {
                renderSubTypes();
                renderPropertyProfileFields();
                updatePropertyScore();
            });
        });

        renderSubTypes();
        renderPropertyProfileFields();
    }

    function renderSubTypes() {
        const cat = form.querySelector('input[name="propertyCategory"]:checked')?.value || 'residential';
        const selectedType = form.querySelector('input[name="propertyType"]:checked')?.value;
        if (cat === 'commercial' && options.commercial.subTypes[selectedType]) {
            subTypeContainer.innerHTML = buildRadioGroup('subPropertyType', options.commercial.subTypes[selectedType], 'Sub Type');
            subTypeContainer.querySelectorAll('input[name="subPropertyType"]').forEach(r => {
                r.addEventListener('change', updatePropertyScore);
            });
        } else {
            subTypeContainer.innerHTML = '';
        }
    }

    function renderPropertyProfileFields() {
        const looking = form.querySelector('input[name="lookingTo"]:checked')?.value || 'sell';
        const cat = form.querySelector('input[name="propertyCategory"]:checked')?.value || 'residential';
        const type = form.querySelector('input[name="propertyType"]:checked')?.value || '';

        let html = `
            <div class="mb-4">
                <label for="property_name" class="form-label">Property Name</label>
                <input type="text" id="property_name" name="property_name" required class="form-control" placeholder="Short name for your property (e.g., 'Greenwood Villa')">
                <div class="invalid-feedback">Property name is required.</div>
                <div class="form-text">This name helps buyers quickly identify your listing.</div>
            </div>`;

        if (cat === 'residential' && looking === 'pg') {
            html += `
                <div class="mb-4">
                    <p class="form-label-group">Monthly Rent & Deposit</p>
                    <div class="row g-3">
                        <div class="col-md-6">
                            <label class="form-label">Monthly Rent</label>
                            <div class="input-group">
                                <span class="input-group-text">₹</span>
                                <input type="number" name="price" id="price" class="form-control" placeholder="e.g., 8000" required>
                                <div class="invalid-feedback">Rent is required.</div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Security Deposit</label>
                            <div class="input-group">
                                <span class="input-group-text">₹</span>
                                <input type="number" name="security_deposit" class="form-control" placeholder="e.g., 16000" required>
                                <div class="invalid-feedback">Security deposit is required for PG.</div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="mb-4">
                    <p class="form-label-group">Room Type & Sharing</p>
                    <div class="row g-3">
                        <div class="col-md-6">
                            <label class="form-label">Room Type</label>
                            <div class="btn-check-group">
                                <div><input type="radio" class="btn-check" name="room_type" id="room-sharing" value="sharing" checked><label class="btn-check-label" for="room-sharing">Sharing</label></div>
                                <div><input type="radio" class="btn-check" name="room_type" id="room-private" value="private"><label class="btn-check-label" for="room-private">Private</label></div>
                            </div>
                        </div>
                        <div class="col-md-6" id="sharing-details">
                            <label class="form-label">Maximum Sharing</label>
                            <select class="form-select" name="max_sharing">
                                <option value="">Select...</option>
                                <option value="2">2 Person</option>
                                <option value="3">3 Person</option>
                                <option value="4">4 Person</option>
                                <option value="5">5+ Person</option>
                            </select>
                            <div class="invalid-feedback">Please select maximum sharing capacity.</div>
                        </div>
                    </div>
                </div>

                <div class="mb-4">
                    <p class="form-label-group">PG Counts</p>
                    <div class="row g-3">
                        <div class="col-md-6"><label class="form-label">Total Rooms in PG</label><input type="number" min="1" class="form-control" name="total_rooms" required><div class="invalid-feedback">Required.</div></div>
                        <div class="col-md-6"><label class="form-label">Available Rooms</label><input type="number" min="0" class="form-control" name="available_rooms" required><div class="invalid-feedback">Required.</div></div>
                    </div>
                </div>

                <div class="mb-4">
                    <p class="form-label-group">Room Features</p>
                    <div class="btn-check-group">
                        <div><input type="checkbox" class="btn-check" name="room_features[]" id="feature-bathroom" value="attached_bathroom"><label class="btn-check-label" for="feature-bathroom">Attached Bathroom</label></div>
                        <div><input type="checkbox" class="btn-check" name="room_features[]" id="feature-balcony" value="attached_balcony"><label class="btn-check-label" for="feature-balcony">Attached Balcony</label></div>
                    </div>
                </div>

                <div class="mb-4">
                    <p class="form-label-group">Available For</p>
                    <div class="btn-check-group">
                        <div><input type="radio" class="btn-check" name="gender_allowed" id="gender-boys" value="boys" required><label class="btn-check-label" for="gender-boys">Boys Only</label></div>
                        <div><input type="radio" class="btn-check" name="gender_allowed" id="gender-girls" value="girls"><label class="btn-check-label" for="gender-girls">Girls Only</label></div>
                        <div><input type="radio" class="btn-check" name="gender_allowed" id="gender-any" value="any"><label class="btn-check-label" for="gender-any">Any</label></div>
                    </div>
                </div>

                <div class="mb-4">
                    <p class="form-label-group">Suitable For</p>
                    <div class="btn-check-group">
                        <div><input type="checkbox" class="btn-check" name="suitable_for[]" id="suitable-students" value="students"><label class="btn-check-label" for="suitable-students">Students</label></div>
                        <div><input type="checkbox" class="btn-check" name="suitable_for[]" id="suitable-working" value="working"><label class="btn-check-label" for="suitable-working">Working Professional</label></div>
                    </div>
                </div>

                ${generateFurnishingSection()}
            `;
        } else if (cat === 'residential' && looking === 'rent') {
            html += `
                <div class="mb-4">
                    <p class="form-label-group">Monthly Rent & Deposit</p>
                    <div class="row g-3">
                        <div class="col-md-6">
                            <label class="form-label">Monthly Rent</label>
                            <div class="input-group">
                                <span class="input-group-text">₹</span>
                                <input type="number" name="price" id="price" class="form-control" placeholder="e.g., 25000" required>
                                <div class="invalid-feedback">Rent is required.</div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Security Deposit (Optional)</label>
                            <div class="input-group">
                                <span class="input-group-text">₹</span>
                                <input type="number" name="security_deposit" class="form-control" placeholder="e.g., 50000">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="mb-4">
                    <p class="form-label-group">Your apartment is</p>
                    <div class="btn-check-group">
                        ${['1 BHK', '2 BHK', '3 BHK', '4 BHK', '4+ BHK'].map((bhk, idx) => `
                            <div>
                                <input type="radio" class="btn-check" name="bhk_config" id="bhk-${idx}" value="${bhk}" ${idx === 1 ? 'checked' : ''} required>
                                <label class="btn-check-label" for="bhk-${idx}">${bhk}</label>
                            </div>
                        `).join('')}
                    </div>
                </div>
                <div class="mb-4">
                    <p class="form-label-group">Area Details</p>
                    <div class="row g-3">
                        <div class="col-md-4">
                            <label class="form-label">Carpet Area (sq.ft)</label>
                            <input type="number" class="form-control" name="carpet_area" required>
                            <div class="invalid-feedback">Carpet Area is required.</div>
                        </div>
                        <div class="col-md-4">
                            <label class="form-label">Built-up Area (Optional)</label>
                            <input type="number" class="form-control" name="builtup_area">
                        </div>
                        <div class="col-md-4">
                            <label class="form-label">Super Built-up (Optional)</label>
                            <input type="number" class="form-control" name="super_builtup_area">
                        </div>
                    </div>
                </div>
                <div class="mb-4">
                    <div class="row g-3">
                        <div class="col-md-6">
                            <label class="form-label">Age of Property</label>
                            <select class="form-select" name="property_age" required>
                                <option value="">Select...</option>
                                <option>0-1 Years</option>
                                <option>1-5 Years</option>
                                <option>5-10 Years</option>
                                <option>10+ Years</option>
                            </select>
                            <div class="invalid-feedback">Please select property age.</div>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Available From</label>
                            <input type="date" class="form-control" name="available_from" required>
                            <div class="invalid-feedback">Please select an availability date.</div>
                        </div>
                    </div>
                </div>
                <div class="mb-4">
                    <p class="form-label-group">Willing to rent out to</p>
                    <div class="btn-check-group">
                        <div><input type="checkbox" class="btn-check" name="tenants[]" id="tenant-family" value="family"><label class="btn-check-label" for="tenant-family">Family</label></div>
                        <div><input type="checkbox" class="btn-check" name="tenants[]" id="tenant-man" value="single_man"><label class="btn-check-label" for="tenant-man">Single Man</label></div>
                        <div><input type="checkbox" class="btn-check" name="tenants[]" id="tenant-woman" value="single_woman"><label class="btn-check-label" for="tenant-woman">Single Woman</label></div>
                    </div>
                </div>
                <div class="mb-4">
                    <p class="form-label-group">Are you okay with brokers contacting you?</p>
                    <div class="btn-check-group">
                        <div><input type="radio" class="btn-check" name="broker_contact" id="broker-yes" value="yes" checked><label class="btn-check-label" for="broker-yes">Yes</label></div>
                        <div><input type="radio" class="btn-check" name="broker_contact" id="broker-no" value="no"><label class="btn-check-label" for="broker-no">No</label></div>
                    </div>
                </div>
            `;
        } else {
            html += `<div class="mb-4">
                        <p class="form-label-group">Price Details</p>
                        <div class="input-group">
                            <span class="input-group-text">₹</span>
                            <input type="text" name="price" id="price" class="form-control" placeholder="Expected Price" required>
                            <div class="invalid-feedback">Price is required.</div>
                        </div>
                    </div>`;

            if (cat === 'residential') {
                if (type.includes('FLAT') || type.toLowerCase().includes('apartment') || type.includes('1RK') || type.includes('Studio')) {
                    html += `
                    <div class="mb-4">
                        <p class="form-label-group">Room Details</p>
                        <div class="row gx-2">
                            <div class="col-md-4 mb-2"><label class="form-label">Bedrooms</label><input type="number" min="0" name="bedrooms" class="form-control" required /><div class="invalid-feedback">Required.</div></div>
                            <div class="col-md-4 mb-2"><label class="form-label">Bathrooms</label><input type="number" min="0" name="bathrooms" class="form-control" required /><div class="invalid-feedback">Required.</div></div>
                            <div class="col-md-4 mb-2"><label class="form-label">Balconies</label><input type="number" min="0" name="balconies" class="form-control" /></div>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Carpet Area (sq.ft.)</label>
                        <input type="number" min="0" name="area_sqft" class="form-control" placeholder="e.g., 950" required />
                        <div class="invalid-feedback">Carpet area is required.</div>
                    </div>
                    <div class="mb-3 row g-2">
                        <div class="col-md-6">
                            <label class="form-label">Floor Number</label>
                            <input type="number" min="0" name="floor_no" class="form-control" placeholder="Floor no. (if applicable)" />
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Total Floors</label>
                            <input type="number" min="0" name="total_floors" class="form-control" placeholder="Total floors in building" />
                        </div>
                    </div>`;
                } else if (type.includes('Plot') || type.includes('Land')) {
                    html += `
                    <div class="mb-4">
                        <p class="form-label-group">Plot Details</p>
                        <div class="row g-3">
                            <div class="col-md-6">
                                <label class="form-label">Plot Area</label>
                                <div class="input-group">
                                    <input type="number" name="plot_area" class="form-control" placeholder="e.g., 1200" required>
                                    <select class="input-group-text" name="plot_area_unit">
                                        <option>sq.ft.</option>
                                        <option>sq.yd.</option>
                                        <option>acres</option>
                                    </select>
                                    <div class="invalid-feedback">Please enter a valid plot area.</div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Floors Allowed for Construction</label>
                                <input type="number" min="0" name="floors_allowed" class="form-control" required>
                                <div class="invalid-feedback">Please enter the number of allowed floors.</div>
                            </div>
                        </div>
                    </div>
                    <div class="mb-4">
                        <p class="form-label-group">Property Dimensions (Optional)</p>
                        <div class="row g-3">
                            <div class="col-md-6">
                                <label class="form-label">Length (ft)</label>
                                <input type="number" min="0" name="dimension_length" class="form-control" placeholder="e.g., 30">
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Width (ft)</label>
                                <input type="number" min="0" name="dimension_width" class="form-control" placeholder="e.g., 40">
                            </div>
                        </div>
                    </div>
                    <div class="mb-4">
                        <p class="form-label-group">Open Sides & Boundary</p>
                        <div class="row g-3">
                            <div class="col-md-6">
                                <label class="form-label">Number of Open Sides</label>
                                <select name="open_sides" class="form-select" required>
                                    <option value="">Select...</option>
                                    <option value="1">1</option>
                                    <option value="2">2</option>
                                    <option value="3">3 (Corner)</option>
                                    <option value="4">4 (Island)</option>
                                </select>
                                <div class="invalid-feedback">Please select the number of open sides.</div>
                            </div>
                            <div class="col-md-6">
                                <p class="form-label mb-2">Is Boundary Wall Made?</p>
                                <div class="btn-check-group">
                                    <div><input type="radio" class="btn-check" name="boundary_wall" id="wall-yes" value="yes" required><label class="btn-check-label" for="wall-yes">Yes</label></div>
                                    <div><input type="radio" class="btn-check" name="boundary_wall" id="wall-no" value="no" required><label class="btn-check-label" for="wall-no">No</label></div>
                                </div>
                            </div>
                        </div>
                    </div>`;
                } else {
                    html += `<div class="mb-3"><label class="form-label">Area (sq.ft.)</label><input type="number" min="0" name="area_sqft" class="form-control" required /><div class="invalid-feedback">Required.</div></div>`;
                }

                if (!type.includes('Plot') && !type.includes('Land')) {
                    html += `
                    <div class="mb-4">
                        <p class="form-label-group">Other Rooms (Optional)</p>
                        <div class="btn-check-group">
                            <div><input type="checkbox" class="btn-check" name="other_rooms[]" id="room-pooja" value="pooja"><label class="btn-check-label" for="room-pooja">Pooja Room</label></div>
                            <div><input type="checkbox" class="btn-check" name="other_rooms[]" id="room-study" value="study"><label class="btn-check-label" for="room-study">Study Room</label></div>
                            <div><input type="checkbox" class="btn-check" name="other_rooms[]" id="room-servant" value="servant"><label class="btn-check-label" for="room-servant">Servant Room</label></div>
                            <div><input type="checkbox" class="btn-check" name="other_rooms[]" id="room-store" value="store"><label class="btn-check-label" for="room-store">Store Room</label></div>
                        </div>
                    </div>
                    <div class="mb-4">
                        <p class="form-label-group">Furnishing</p>
                        <div class="btn-check-group">
                            <div><input type="radio" class="btn-check" name="furnishing" id="furnish-full" value="furnished"><label class="btn-check-label" for="furnish-full">Furnished</label></div>
                            <div><input type="radio" class="btn-check" name="furnishing" id="furnish-semi" value="semi-furnished" checked><label class="btn-check-label" for="furnish-semi">Semi-Furnished</label></div>
                            <div><input type="radio" class="btn-check" name="furnishing" id="furnish-none" value="unfurnished"><label class="btn-check-label" for="furnish-none">Un-Furnished</label></div>
                        </div>
                    </div>
                    <div class="mb-4">
                        <p class="form-label-group">Parking (Optional)</p>
                        <div class="btn-check-group">
                            <div><input type="checkbox" class="btn-check" name="parking[]" id="park-covered" value="covered"><label class="btn-check-label" for="park-covered">Covered Parking</label></div>
                            <div><input type="checkbox" class="btn-check" name="parking[]" id="park-open" value="open"><label class="btn-check-label" for="park-open">Open Parking</label></div>
                        </div>
                    </div>`;
                }
            } else {
                html += `<div class="mb-3"><label class="form-label">Area (sq.ft.)</label><input type="number" min="0" name="area_sqft" class="form-control" required /><div class="invalid-feedback">Area is required.</div></div>`;
            }

            html += `
                <div class="mb-3">
                    <p class="form-label-group">Availability Status</p>
                    <div class="btn-check-group">
                        <div><input type="radio" class="btn-check" name="availability" id="avail-ready" value="ready" checked><label class="btn-check-label" for="avail-ready">Ready to move</label></div>
                        <div><input type="radio" class="btn-check" name="availability" id="avail-uc" value="under_construction"><label class="btn-check-label" for="avail-uc">Under Construction</label></div>
                    </div>
                </div>
                <div id="availability-extra"></div>
                <div class="mb-3">
                    <label class="form-label">Ownership</label>
                    <select name="ownership" class="form-select" required>
                        <option value="">Select</option>
                        <option value="freehold">Freehold</option>
                        <option value="leasehold">Leasehold</option>
                        <option value="cooperative">Co-operative</option>
                        <option value="others">Others</option>
                    </select>
                    <div class="invalid-feedback">Please select ownership status.</div>
                </div>`;
        }

        propertyProfileFields.innerHTML = html;

        propertyProfileFields.querySelectorAll('input, select, textarea').forEach(el => {
            el.addEventListener('change', function() {
                handleAvailabilityExtra();
                updatePropertyScore();
            });
            el.addEventListener('input', updatePropertyScore);
        });

        propertyProfileFields.querySelectorAll('input[name="furnishing"]').forEach(r => r.addEventListener('change', handleFurnishingDetails));
        handleFurnishingDetails();

        const roomTypeRadios = propertyProfileFields.querySelectorAll('input[name="room_type"]');
        if (roomTypeRadios.length) {
            const sharingDiv = propertyProfileFields.querySelector('#sharing-details');
            roomTypeRadios.forEach(r => r.addEventListener('change', function() {
                if (r.value === 'private') {
                    if (sharingDiv) sharingDiv.style.display = 'none';
                } else {
                    if (sharingDiv) sharingDiv.style.display = 'block';
                }
            }));
        }

        handleAvailabilityExtra();
    }

    function handleAvailabilityExtra() {
        const availability = propertyProfileFields.querySelector('input[name="availability"]:checked')?.value;
        const container = document.getElementById('availability-extra');
        if (!container) return;

        if (availability === 'ready') {
            container.innerHTML = `
                <div class="row g-2">
                    <div class="col-md-6">
                        <label class="form-label">Age of property (years)</label>
                        <input type="number" min="0" name="age_property" class="form-control" placeholder="e.g., 5" />
                    </div>
                </div>`;
        } else if (availability === 'under_construction') {
            container.innerHTML = `
                <div class="row g-2">
                    <div class="col-md-6">
                        <label class="form-label">Expected Completion (date)</label>
                        <input type="date" name="expected_completion" class="form-control" />
                    </div>
                </div>`;
        } else {
            container.innerHTML = '';
        }

        container.querySelectorAll('input, select, textarea').forEach(el => {
            el.addEventListener('change', updatePropertyScore);
            el.addEventListener('input', updatePropertyScore);
        });
    }

    function renderAmenities() {
        const looking = form.querySelector('input[name="lookingTo"]:checked')?.value || 'sell';
        const cat = form.querySelector('input[name="propertyCategory"]:checked')?.value || 'residential';
        const type = form.querySelector('input[name="propertyType"]:checked')?.value || '';

        let html = '';

        if (cat === 'residential' && looking === 'rent') {
            html += `
            <div>
                <p class="form-label-group">Lease Details & Terms</p>
                <div class="mb-3">
                    <label class="form-label">Preferred Agreement Type</label>
                    <div class="btn-check-group">
                        <div><input type="radio" class="btn-check" name="agreement_type" id="agree-any" value="any" checked><label class="btn-check-label" for="agree-any">Any</label></div>
                        <div><input type="radio" class="btn-check" name="agreement_type" id="agree-company" value="company_lease"><label class="btn-check-label" for="agree-company">Company Lease Agreement</label></div>
                    </div>
                </div>
                <div class="row g-3">
                    <div class="col-md-6">
                        <label class="form-label">Duration of Agreement</label>
                        <select class="form-select" name="agreement_duration">
                            <option>11 Months</option>
                            <option>12 Months</option>
                            <option>24 Months</option>
                            <option>36 Months</option>
                        </select>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Month of Notice</label>
                        <select class="form-select" name="notice_period">
                            <option>1 Month</option>
                            <option>2 Months</option>
                            <option>3 Months</option>
                        </select>
                    </div>
                </div>
            </div>`;
        }

        const residentialAmenities = ['Lift', 'Gym', 'Swimming Pool', 'Power Backup', 'Parking', 'Children Play Area', 'Club House', 'Security'];
        const villaAmenities = ['Private Garden', 'Servant Quarters'];
        const commercialAmenities = ['Power Backup', 'Parking', 'Fire Safety', 'CCTV', 'Lift', 'Loading Bay'];
        const plotFeatures = ['Gated Community', 'Park Facing', 'Water Connection Available', 'Electricity Connection Available'];

        let items = [];
        let amenitiesTitle = 'Amenities';

        if (cat === 'commercial') {
            items = commercialAmenities;
        } else if (type.includes('Plot') || type.includes('Land')) {
            items = plotFeatures;
            amenitiesTitle = 'Plot Features';
        } else if (type.includes('Villa') || type.includes('Independent House')) {
            items = [...new Set([...residentialAmenities, ...villaAmenities])];
        } else {
            items = residentialAmenities;
        }

        if (items.length > 0) {
            html += `<div><p class="form-label-group">${amenitiesTitle}</p><div class="btn-check-group">`;
            items.forEach((a, idx) => {
                const id = `amenity-${idx}-${a.toLowerCase().replace(/[^a-z0-9]/g,'')}`;
                html += `<div>
                                <input type="checkbox" class="btn-check" name="amenities[]" id="${id}" value="${a}">
                                <label class="btn-check-label" for="${id}">${a}</label>
                            </div>`;
            });
            html += `</div></div>`;
        }

        html += `<div>
                    <label class="form-label-group">What makes your property unique? (Optional)</label>
                    <textarea name="unique_features" class="form-control" rows="3" placeholder="e.g., North-facing with a great view, newly renovated kitchen, close to metro station..."></textarea>
                </div>`;

        amenitiesContainer.innerHTML = html;

        amenitiesContainer.querySelectorAll('input, select, textarea').forEach(el => {
            el.addEventListener('change', updatePropertyScore);
            el.addEventListener('input', updatePropertyScore);
        });
    }

    function calculatePropertyScore() {
        const importantSelectors = [
            'input[name="lookingTo"]:checked', 'input[name="propertyCategory"]:checked', 'input[name="propertyType"]:checked',
            'input[name="city"]', 'input[name="locality"]', 'input[name="price"]',
            'input[name="photos[]"]', 'input[name="amenities[]"]:checked'
        ];
        let filled = 0;
        let total = importantSelectors.length;

        if (form.querySelector('input[name="lookingTo"]:checked')) filled++;
        if (form.querySelector('input[name="propertyCategory"]:checked')) filled++;
        if (form.querySelector('input[name="propertyType"]:checked')) filled++;
        if (form.querySelector('input[name="city"]')?.value?.trim()) filled++;
        if (form.querySelector('input[name="locality"]')?.value?.trim()) filled++;
        if (form.querySelector('input[name="price"]')?.value?.trim()) filled++;
        if (currentStep >= 4) filled++;
        if (form.querySelectorAll('input[name="amenities[]"]:checked').length > 0) filled++;

        if (form.querySelector('input[name*="area"]')?.value) filled++;
        if (form.querySelector('input[name*="bedrooms"]')?.value) filled++;
        if (form.querySelector('input[name*="bathrooms"]')?.value) filled++;
        if (form.querySelector('input[name="furnishing"]:checked')) filled++;
        total += 4;

        const percent = Math.round((filled / total) * 100);
        return Math.min(100, Math.max(8, percent));
    }

    function updatePropertyScore() {
        propertyScore = calculatePropertyScore();
        stepProgressEls.forEach(el => { el.textContent = ''; });
        const activeStepEl = document.querySelector('.stepper .step.active .step-progress');
        if (activeStepEl) activeStepEl.textContent = propertyScore + '%';
    }

    function handleFurnishingDetails() {
        const val = form.querySelector('input[name="furnishing"]:checked')?.value;
        const details = document.getElementById('furnishing-details');
        if (!details) return;
        if (val === 'furnished' || val === 'semi-furnished') {
            details.style.display = 'block';
        } else {
            details.style.display = 'none';
            details.querySelectorAll('input[type="checkbox"]').forEach(cb => cb.checked = false);
        }
    }

    function updateStepDisplay() {
        steps.forEach((s, idx) => {
            const stepNum = idx + 1;
            s.classList.remove('active', 'completed');
            if (stepNum < currentStep) s.classList.add('completed');
            if (stepNum === currentStep) s.classList.add('active');
        });
        formSections.forEach(section => {
            section.classList.toggle('active', parseInt(section.dataset.step, 10) === currentStep);
        });
        updatePropertyScore();
    }

    function validateCurrentStep() {
        const currentSection = form.querySelector(`.form-section[data-step="${currentStep}"]`);
        if (!currentSection) return true;
        let isValid = true;
        const inputs = currentSection.querySelectorAll('input[required], select[required], textarea[required]');
        inputs.forEach(input => {
            if (!input.checkValidity()) {
                isValid = false;
            }
        });
        return isValid;
    }

    nextButtons.forEach(btn => btn.addEventListener('click', () => {
        form.classList.add('was-validated');
        if (validateCurrentStep()) {
            if (currentStep < formSections.length) {
                currentStep++;
                updateStepDisplay();
                form.classList.remove('was-validated');
            }
        }
    }));

    prevButtons.forEach(btn => btn.addEventListener('click', () => {
        if (currentStep > 1) {
            currentStep--;
            updateStepDisplay();
        }
    }));

    steps.forEach(s => s.addEventListener('click', () => {
        if (s.classList.contains('completed') || s.classList.contains('active')) {
            currentStep = parseInt(s.dataset.step, 10);
            updateStepDisplay();
        }
    }));

    form.addEventListener('change', function(e) {
        const name = e.target.name;
        if (name === 'lookingTo' || name === 'propertyCategory') {
            renderPropertyTypes();
            renderAmenities();
        }
        if (name === 'propertyType' || name === 'subPropertyType') {
            renderPropertyProfileFields();
            renderAmenities();
        }
        updatePropertyScore();
    });

    const setSubmittingState = (isSubmitting) => {
        if (!submitButton) return;
        if (isSubmitting) {
            if (!submitButton.dataset.originalHtml) submitButton.dataset.originalHtml = submitButton.innerHTML;
            submitButton.innerHTML = '<span class="spinner-border spinner-border-sm me-2" role="status" aria-hidden="true"></span>Saving...';
            submitButton.disabled = true;
        } else {
            if (submitButton.dataset.originalHtml) submitButton.innerHTML = submitButton.dataset.originalHtml;
            submitButton.disabled = false;
        }
    };

    form.addEventListener('submit', async function(e) {
        e.preventDefault();
        e.stopPropagation();
        submissionCompleted = false;

        form.classList.add('was-validated');

        if (!form.checkValidity()) {
            Swal.fire({ icon: 'warning', title: 'Incomplete', text: 'Please fill all the required fields in all steps before submitting.' });
            return;
        }

        updatePropertyScore();

        try {
            const maxVideoBytes = 10 * 1024 * 1024;
            const maxImageBytes = 10 * 1024 * 1024;
            const maxImages = 50;
            const TOTAL_BYTES_LIMIT = 50 * 1024 * 1024;

            const selectedImages = photosInput && photosInput.files ? photosInput.files : [];
            const selectedVideos = videosInput && videosInput.files ? videosInput.files : [];

            if (selectedImages.length > maxImages) {
                Swal.fire({ icon: 'warning', title: 'Too many images', text: 'Please select at most ' + maxImages + ' images.' });
                return;
            }

            let totalBytes = 0;
            for (let i = 0; i < selectedImages.length; i++) totalBytes += selectedImages[i].size;
            for (let i = 0; i < selectedVideos.length; i++) totalBytes += selectedVideos[i].size;
            if (totalBytes > TOTAL_BYTES_LIMIT) {
                Swal.fire({ icon: 'warning', title: 'Files too large', text: 'Total selected files size is ' + Math.round(totalBytes/1024/1024*10)/10 + ' MB which exceeds the client limit of ' + (TOTAL_BYTES_LIMIT/1024/1024) + ' MB. Please select smaller files.' });
                return;
            }

            for (let i = 0; i < selectedImages.length; i++) {
                if (selectedImages[i].size > maxImageBytes) {
                    Swal.fire({ icon: 'warning', title: 'Image too large', text: 'Image "' + selectedImages[i].name + '" exceeds maximum allowed size of 10 MB.' });
                    return;
                }
            }

            for (let i = 0; i < selectedVideos.length; i++) {
                if (selectedVideos[i].size > maxVideoBytes) {
                    Swal.fire({ icon: 'warning', title: 'Video too large', text: 'Video "' + selectedVideos[i].name + '" exceeds maximum allowed size of 10 MB.' });
                    return;
                }
            }

            setSubmittingState(true);

            const formData = new FormData(form);
            formData.set('lookingTo', form.querySelector('input[name="lookingTo"]:checked')?.value || 'sell');
            formData.set('propertyCategory', form.querySelector('input[name="propertyCategory"]:checked')?.value || 'residential');
            const propertyType = form.querySelector('input[name="propertyType"]:checked')?.value;
            if (propertyType) formData.set('propertyType', propertyType);

            const resp = await fetch('<?= site_url('api/property/create-full') ?>', {
                method: 'POST',
                body: formData
            });

            const data = await resp.json().catch(() => ({}));

            if (resp.ok) {
                const pid = data.property_id || data.propertyId || null;
                submissionCompleted = true;
                if (submitButton) {
                    submitButton.innerHTML = '<i class="bi bi-check-circle me-2"></i>Submitted';
                    submitButton.disabled = true;
                }
                Swal.fire({ icon: 'success', title: 'Property posted', html: (data.message || 'Property posted successfully!') + (pid ? ('<br><strong>Property ID:</strong> ' + pid) : '') }).then(function(){
                    window.location.href = '<?= site_url('dashboard') ?>';
                });
            } else {
                const msg = data.message || data.error || JSON.stringify(data) || 'Failed to create property.';
                Swal.fire({ icon: 'error', title: 'Error', text: msg });
                console.error('Create property failed', resp.status, data);
            }
        } catch (err) {
            console.error('Network or parsing error', err);
            Swal.fire({ icon: 'error', title: 'Submission failed', text: 'An unexpected error occurred while submitting. Check console for details.' });
        } finally {
            if (!submissionCompleted) {
                setSubmittingState(false);
            }
        }
    });

    renderPropertyTypes();
    renderSubTypes();
    renderPropertyProfileFields();
    renderAmenities();
    updateStepDisplay();
    updatePropertyScore();
    checkPostingAllowed();

    const MAX_IMAGE_COUNT = 50;
    const MAX_IMAGE_BYTES = 10 * 1024 * 1024;

    function renderImagePreviews(files) {
        photosPreview.innerHTML = '';
        if (!files || files.length === 0) return;
        Array.from(files).slice(0, MAX_IMAGE_COUNT).forEach(f => {
            const url = URL.createObjectURL(f);
            const img = document.createElement('img');
            img.src = url;
            img.width = 96;
            img.height = 64;
            img.className = 'rounded shadow-sm';
            img.style.objectFit = 'cover';
            photosPreview.appendChild(img);
        });
    }

    function syncVideoLinkButtons() {
        if (!videoLinksList) return;
        const rows = videoLinksList.querySelectorAll('.video-link-row');
        rows.forEach(row => {
            const removeBtn = row.querySelector('.remove-video-link');
            if (!removeBtn) return;
            removeBtn.style.display = rows.length > 1 ? 'inline-flex' : 'none';
        });
    }

    function createVideoLinkRow(value = '') {
        if (!videoLinksList) return null;
        const row = document.createElement('div');
        row.className = 'input-group mb-2 video-link-row';
        const input = document.createElement('input');
        input.type = 'url';
        input.name = 'video_urls[]';
        input.className = 'form-control';
        input.placeholder = 'https://youtu.be/...';
        input.autocomplete = 'off';
        input.value = value;
        input.addEventListener('input', updatePropertyScore);
        const removeBtn = document.createElement('button');
        removeBtn.type = 'button';
        removeBtn.className = 'btn btn-outline-danger remove-video-link';
        removeBtn.innerHTML = '<i class="bi bi-x-lg"></i>';
        removeBtn.addEventListener('click', () => {
            row.remove();
            syncVideoLinkButtons();
            updatePropertyScore();
        });
        row.appendChild(input);
        row.appendChild(removeBtn);
        videoLinksList.appendChild(row);
        syncVideoLinkButtons();
        return row;
    }

    function handleImageChange(e) {
        const files = e.target.files;
        if (!files) return;
        if (files.length > MAX_IMAGE_COUNT) {
            Swal.fire({ icon: 'warning', title: 'Too many images', text: 'You selected more than ' + MAX_IMAGE_COUNT + ' images. Only the first ' + MAX_IMAGE_COUNT + ' will be used.' });
        }
        for (let i = 0; i < files.length; i++) {
            if (files[i].size > MAX_IMAGE_BYTES) {
                Swal.fire({ icon: 'warning', title: 'Image too large', text: 'Image "' + files[i].name + '" exceeds max size of 10 MB. Please choose smaller images.' });
                return;
            }
        }
        renderImagePreviews(files);
        updatePropertyScore();
    }

    photosInput?.addEventListener('change', handleImageChange);
    addVideoLinkBtn?.addEventListener('click', () => {
        createVideoLinkRow();
        updatePropertyScore();
    });
    if (videoLinksList && videoLinksList.children.length === 0) {
        createVideoLinkRow();
    }

    document.addEventListener('input', updatePropertyScore);
    document.addEventListener('change', updatePropertyScore);
});
</script>
</body>
</html>
