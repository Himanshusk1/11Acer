<?php
$page_title = 'Agent Profile - 36 Broking Hub';
$isLoggedIn = session()->get('isLoggedIn');
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
    <link rel="stylesheet" href="<?= base_url('CSS/style.css') ?>">
    <link rel="stylesheet" href="<?= base_url('CSS/home.css') ?>">
    <link rel="stylesheet" href="<?= base_url('CSS/responsive.css') ?>">
    <style>
        :root {
            --brand-green: #198754;
            --brand-dark: #123524;
            --muted: #6c757d;
            --card-bg: #ffffff;
            --page-bg: #f4f7f2;
            --shadow-soft: 0 20px 60px rgba(12, 41, 24, 0.08);
        }
        * { box-sizing: border-box; }
        body {
            font-family: 'Inter', sans-serif;
            background: var(--page-bg);
            color: #1e2b24;
            min-height: 100vh;
        }
        .agent-profile-page {
            padding: 3rem 0 4rem;
        }
        .shadow-card {
            background: var(--card-bg);
            border-radius: 22px;
            border: 1px solid rgba(16, 24, 40, 0.06);
            box-shadow: var(--shadow-soft);
        }
        .agent-hero {
            padding: 2.5rem;
            position: relative;
            overflow: hidden;
        }
        .agent-hero::after {
            content: '';
            position: absolute;
            inset: 0;
            background: radial-gradient(circle at top right, rgba(25, 135, 84, 0.12), transparent 55%);
            pointer-events: none;
        }
        .agent-hero > * { position: relative; z-index: 2; }
        .hero-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 2rem;
            align-items: center;
        }
        .avatar-stack {
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 1rem;
        }
        .avatar-ring {
            width: 150px;
            height: 150px;
            border-radius: 50%;
            padding: 6px;
            background: linear-gradient(135deg, var(--brand-green), rgba(25,135,84,0.25));
            display: inline-flex;
            align-items: center;
            justify-content: center;
            position: relative;
        }
        .premium-pill {
            position: absolute;
            top: -28px;
            left: 50%;
            transform: translateX(-50%);
            background: #111827;
            color: #facc15;
            padding: 0.2rem 0.9rem;
            border-radius: 999px;
            font-size: 0.75rem;
            font-weight: 600;
            letter-spacing: 0.08em;
        }
        .agent-avatar,
        .agent-avatar-img {
            width: 100%;
            height: 100%;
            border-radius: 50%;
            border: 6px solid #fff;
            background: #6c757d;
            color: #fff;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 3.5rem;
            font-weight: 600;
        }
        .agent-avatar-img { object-fit: cover; display: none; }
        .profile-meta h1 {
            font-size: 2rem;
            font-weight: 700;
            margin-bottom: 0.35rem;
        }
        .rating-row {
            display: flex;
            align-items: center;
            gap: 0.5rem;
            margin-bottom: 0.5rem;
            flex-wrap: wrap;
        }
        .rating-badge {
            display: inline-flex;
            align-items: center;
            gap: 0.25rem;
            background: rgba(25,135,84,0.12);
            color: var(--brand-green);
            padding: 0.35rem 0.8rem;
            border-radius: 999px;
            font-weight: 600;
        }
        .rating-stars i { color: #fbbf24; }
        .meta-list {
            list-style: none;
            padding: 0;
            margin: 0;
            display: flex;
            flex-wrap: wrap;
            gap: 1rem;
        }
        .meta-list li {
            display: flex;
            align-items: center;
            gap: 0.5rem;
            color: var(--muted);
            font-size: 0.95rem;
        }
        .cta-wrap {
            display: flex;
            flex-wrap: wrap;
            gap: 0.75rem;
        }
        .btn-brand {
            background: var(--brand-green);
            color: #fff;
            font-weight: 600;
            border-radius: 12px;
            border: none;
            padding: 0.75rem 1.5rem;
        }
        .btn-brand-outline {
            border: 1px solid rgba(25,135,84,0.4);
            color: var(--brand-green);
            font-weight: 600;
            border-radius: 12px;
            padding: 0.75rem 1.25rem;
            background: #fff;
        }
        .social-links {
            display: flex;
            gap: 0.75rem;
        }
        .social-links a {
            width: 44px;
            height: 44px;
            border-radius: 14px;
            border: 1px solid rgba(16,24,40,0.08);
            display: inline-flex;
            align-items: center;
            justify-content: center;
            color: var(--brand-green);
            background: #fff;
            transition: all 0.2s ease;
        }
        .social-links a:hover {
            background: var(--brand-green);
            color: #fff;
        }
        .profile-sidebar .shadow-card { padding: 1.75rem; }
        .sidebar-heading {
            font-size: 1.05rem;
            font-weight: 600;
            margin-bottom: 1rem;
        }
        .spec-tag {
            background: rgba(25,135,84,0.08);
            color: var(--brand-green);
            border-radius: 10px;
            padding: 0.35rem 0.9rem;
            font-weight: 600;
            font-size: 0.9rem;
        }
        .about-card {
            padding: 2rem;
        }
        .about-list {
            list-style: none;
            padding: 0;
            margin: 0;
            display: flex;
            flex-direction: column;
            gap: 1rem;
        }
        .about-list li {
            display: flex;
            align-items: center;
            gap: 0.75rem;
        }
        .about-list .icon {
            width: 42px;
            height: 42px;
            border-radius: 12px;
            background: rgba(25,135,84,0.08);
            color: var(--brand-green);
            display: inline-flex;
            align-items: center;
            justify-content: center;
            font-size: 1.1rem;
        }
        .property-board {
            padding: 2rem;
        }
        .filter-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(180px, 1fr));
            gap: 1rem;
        }
        .filter-group label {
            font-size: 0.85rem;
            font-weight: 600;
            color: var(--muted);
            margin-bottom: 0.35rem;
        }
        .filter-group select {
            border-radius: 14px;
            border: 1px solid rgba(16,24,40,0.12);
            padding: 0.6rem 0.75rem;
        }
        .view-toggle {
            border-radius: 999px;
            border: 1px solid rgba(16,24,40,0.12);
            overflow: hidden;
            display: inline-flex;
        }
        .view-toggle button {
            border: none;
            background: transparent;
            padding: 0.4rem 1.25rem;
            font-weight: 600;
            color: var(--muted);
        }
        .view-toggle button.active {
            background: var(--brand-green);
            color: #fff;
        }
        .property-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
            gap: 1.25rem;
        }
        .property-card {
            border: 1px solid rgba(16,24,40,0.06);
            border-radius: 20px;
            overflow: hidden;
            display: flex;
            flex-direction: column;
            background: #fff;
            min-height: 100%;
            cursor: pointer;
        }
        .property-card img {
            width: 100%;
            height: 190px;
            object-fit: cover;
        }
        .property-table tbody tr {
            cursor: pointer;
        }
        .property-card-body {
            padding: 1.3rem;
            display: flex;
            flex-direction: column;
            gap: 0.6rem;
        }
        .property-location { color: var(--muted); }
        .status-pill {
            position: absolute;
            top: 1rem;
            left: 1rem;
            background: #fff;
            color: var(--brand-green);
            padding: 0.25rem 0.75rem;
            border-radius: 999px;
            font-size: 0.8rem;
            font-weight: 600;
        }
        .property-card-header {
            display: flex;
            justify-content: space-between;
            gap: 0.5rem;
            align-items: flex-start;
        }
        .property-actions {
            display: inline-flex;
            gap: 0.35rem;
        }
        .btn-icon {
            width: 38px;
            height: 38px;
            border-radius: 12px;
            border: 1px solid rgba(16,24,40,0.12);
            background: #fff;
            color: var(--muted);
            display: inline-flex;
            align-items: center;
            justify-content: center;
        }
        .btn-icon:hover {
            background: rgba(25,135,84,0.08);
            color: var(--brand-green);
        }
        .property-table thead th {
            font-size: 0.85rem;
            letter-spacing: 0.04em;
            text-transform: uppercase;
            background: rgba(25,135,84,0.05);
        }
        .pagination-controls {
            display: flex;
            justify-content: space-between;
            align-items: center;
            flex-wrap: wrap;
            gap: 1rem;
            margin-top: 1.5rem;
        }
        .pagination-controls .btn {
            border-radius: 999px;
            padding: 0.55rem 1.35rem;
        }
        .empty-state {
            padding: 2rem;
            text-align: center;
            border: 1px dashed rgba(16,24,40,0.2);
            border-radius: 18px;
            background: rgba(25,135,84,0.03);
        }
        .share-modal .modal-content {
            border-radius: 16px;
            border: none;
            box-shadow: 0 25px 70px rgba(12,12,20,0.18);
        }
        .share-modal .modal-header {
            border-bottom: none;
            padding-bottom: 0;
        }
        .share-modal .modal-body {
            padding-top: 0.5rem;
        }
        .share-link-group input {
            border-top-left-radius: 999px;
            border-bottom-left-radius: 999px;
        }
        .share-link-group .btn {
            border-top-right-radius: 999px;
            border-bottom-right-radius: 999px;
        }
        .share-actions {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(120px, 1fr));
            gap: 0.75rem;
            margin-top: 1.25rem;
        }
        .share-chip {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 0.4rem;
            border-radius: 999px;
            padding: 0.55rem 0.85rem;
            text-decoration: none;
            font-weight: 600;
            border: 1px solid rgba(25,135,84,0.2);
            color: #18422d;
            transition: background-color 0.2s ease, color 0.2s ease, border-color 0.2s ease;
        }
        .share-chip:hover {
            background-color: #198754;
            border-color: #198754;
            color: #fff;
        }
        .share-chip i { font-size: 1rem; }
        .blurred-contact {
            filter: blur(6px);
            transition: filter 0.3s ease;
            user-select: none;
            pointer-events: none;
        }
        .swal2-modal {
            border-radius: 28px;
            font-family: 'Inter', sans-serif;
            background: #fff;
        }
        .swal2-title {
            font-size: 1.5rem;
            color: #0a1b16;
            font-weight: 700;
        }
        .swal2-service-chip {
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            padding: 0.35rem 0.9rem;
            border-radius: 999px;
            background: rgba(25,135,84,0.1);
            color: #0b3b2c;
            font-weight: 600;
            font-size: 0.9rem;
        }
        .swal2-note {
            font-size: 0.9rem;
            color: #3f4b4a;
            margin-bottom: 0.45rem;
        }
        .swal2-form-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 0.85rem;
            margin-top: 1rem;
        }
        .swal2-form-field {
            display: flex;
            flex-direction: column;
            gap: 0.35rem;
            font-size: 0.85rem;
            color: #1e2b24;
        }
        .swal2-form-field label {
            font-weight: 600;
            letter-spacing: 0.01em;
        }
        .swal2-input,
        .swal2-textarea {
            border-radius: 14px;
            border: 1px solid rgba(16,24,40,0.15);
            padding: 0.55rem 0.65rem;
            font-size: 0.95rem;
            background: rgba(255,255,255,0.9);
            transition: border-color 0.2s ease, box-shadow 0.2s ease;
        }
        .swal2-input:focus,
        .swal2-textarea:focus {
            border-color: #198754;
            box-shadow: 0 0 0 3px rgba(25,135,84,0.2);
            outline: none;
        }
        .swal2-styled.swal2-confirm {
            border-radius: 999px;
            padding: 0.7rem 1.75rem;
            background: linear-gradient(135deg, #198754, #0b6626);
            border: none;
            font-weight: 700;
            box-shadow: 0 10px 30px rgba(25,135,84,0.35);
        }
        .swal2-styled.swal2-cancel {
            border-radius: 999px;
            padding: 0.7rem 1.75rem;
            border: 1px solid rgba(16,24,40,0.2);
            color: #1e2b24;
        }
        @media (max-width: 576px) {
            .swal2-form-grid {
                grid-template-columns: 1fr;
            }
            .swal2-form-field label {
                font-size: 0.8rem;
            }
        }
        .feedback-modal .modal-content {
            border-radius: 30px;
            border: none;
            box-shadow: 0 25px 45px rgba(15, 40, 24, 0.18);
            overflow: hidden;
        }
        .feedback-modal .modal-header {
            background: linear-gradient(135deg, rgba(25,135,84,0.15), rgba(13,110,253,0.15));
            border-bottom: none;
            padding: 1.4rem 1.6rem 0.75rem;
        }
        .feedback-modal .modal-title {
            font-weight: 700;
            letter-spacing: 0.02em;
            color: #0f2f6e;
        }
        .feedback-modal .modal-body {
            padding: 1.6rem 1.6rem 2rem;
            background: #f8fbfb;
        }
        .feedback-modal .form-control,
        .feedback-modal .form-select,
        .feedback-modal textarea {
            border-radius: 14px;
            border: 1px solid rgba(16,24,40,0.12);
            padding: 0.65rem 0.75rem;
            font-size: 0.95rem;
            background: #fff;
            transition: border-color 0.2s ease, box-shadow 0.2s ease;
        }
        .feedback-modal .form-control:focus,
        .feedback-modal .form-select:focus,
        .feedback-modal textarea:focus {
            border-color: #198754;
            box-shadow: 0 0 0 3px rgba(25,135,84,0.2);
            outline: none;
        }
        .feedback-modal .btn-success {
            border-radius: 999px;
            padding: 0.65rem 1.5rem;
            font-weight: 700;
            box-shadow: 0 15px 35px rgba(25,135,84,0.35);
        }
        .contact-hint {
            font-size: 0.75rem;
            color: var(--muted);
            margin-top: 0.25rem;
        }
        [data-login-required] {
            cursor: pointer;
        }
        @media (max-width: 991.98px) {
            .agent-hero { padding: 1.75rem; }
            .property-grid { grid-template-columns: 1fr; }
        }
        @media (max-width: 575.98px) {
            .agent-profile-page { padding: 2rem 0; }
            .hero-grid { gap: 1.25rem; }
            .avatar-ring { width: 120px; height: 120px; }
            .property-card img { height: 180px; }
        }
    </style>
</head>
<body>
    <?= $this->include('layouts/header') ?>

    <main class="agent-profile-page">
        <div class="container">
            <section class="agent-hero shadow-card" data-aos="fade-up">
                <div class="hero-grid">
                    <div class="avatar-stack">
                        <div class="avatar-ring">
                            <span class="premium-pill">PREMIUM</span>
                            <img id="agent-avatar-img" class="agent-avatar-img" src="" alt="Agent photo">
                            <div id="agent-avatar" class="agent-avatar">A</div>
                        </div>
                        <div class="social-links">
                            <a id="agent-whatsapp" href="#" target="_blank" title="WhatsApp"<?= $isLoggedIn ? '' : ' data-login-required="contact"' ?>><i class="bi bi-whatsapp"></i></a>
                            <a id="agent-call" href="tel:" title="Call"<?= $isLoggedIn ? '' : ' data-login-required="contact"' ?>><i class="bi bi-telephone"></i></a>
                            <a id="agent-email" href="mailto:" title="Email"<?= $isLoggedIn ? '' : ' data-login-required="contact"' ?>><i class="bi bi-envelope"></i></a>
                        </div>
                    </div>
                    <div class="profile-meta">
                        <h1 id="agent-name">Agent Name <i id="agent-verified" class="bi bi-patch-check-fill text-success" style="display:none"></i></h1>
                        <div class="rating-row">
                            <span class="rating-badge"><i class="bi bi-star-fill"></i> <span id="agent-rating-value">4.8</span></span>
                            <div id="agent-rating-stars" class="rating-stars">
                                <i class="bi bi-star-fill"></i>
                                <i class="bi bi-star-fill"></i>
                                <i class="bi bi-star-fill"></i>
                                <i class="bi bi-star-fill"></i>
                                <i class="bi bi-star-half"></i>
                            </div>
                            <small class="text-muted" id="agent-company">Company</small>
                        </div>
                        <ul class="meta-list">
                            <li><i class="bi bi-geo-alt"></i><span id="agent-location">City</span></li>
                            <li><i class="bi bi-clock-history"></i><span id="agent-since">Active since: --</span></li>
                            <li><i class="bi bi-briefcase"></i><span id="agent-role">Real Estate Specialist</span></li>
                        </ul>
                        <div class="cta-wrap mt-3">
                            <button id="btn-call-back" class="btn btn-brand" type="button"><i class="bi bi-telephone-outbound me-2"></i>Contact Agent</button>
                            <?php if (session()->get('isLoggedIn')): ?>
                                <button class="btn btn-outline-success" type="button" data-bs-toggle="modal" data-bs-target="#feedbackModal">
                                    <i class="bi bi-chat-left-dots me-2"></i>Feedback
                                </button>
                            <?php endif; ?>
                            <button class="btn btn-brand-outline share-btn" id="agent-share" type="button" data-share-link="" data-share-title="Agent Profile" data-share-label="Share Profile"><i class="bi bi-share me-2"></i>Share Profile</button>
                        </div>
                    </div>
                </div>
            </section>

            <div class="row g-4 mt-4 align-items-start">
                <div class="col-lg-4 profile-sidebar">
                    <div class="shadow-card mb-4" data-aos="fade-up" data-aos-delay="50">
                        <h5 class="sidebar-heading">Specializations</h5>
                        <div id="specializations" class="d-flex flex-wrap gap-2"></div>
                    </div>
                    <div class="shadow-card" data-aos="fade-up" data-aos-delay="100">
                        <h5 class="sidebar-heading">Quick Contact</h5>
                        <p class="text-muted small mb-1">Phone</p>
                        <h6 id="agent-phone-display" class="contact-value <?= $isLoggedIn ? '' : 'blurred-contact' ?>">—</h6>
                        <p class="text-muted small mb-1 mt-3">Email</p>
                        <h6 id="agent-email-display" class="contact-value <?= $isLoggedIn ? '' : 'blurred-contact' ?>">—</h6>
                        <?php if (!$isLoggedIn): ?>
                            <small class="contact-hint">Login to view contact details and book an appointment.</small>
                        <?php endif; ?>
                        <div class="mt-4 d-flex gap-2 flex-wrap">
                            <a class="btn btn-light flex-grow-1" id="sidebar-call" href="tel:"<?= $isLoggedIn ? '' : ' data-login-required="contact"' ?>><i class="bi bi-telephone me-2"></i>Call</a>
                            <a class="btn btn-light flex-grow-1" id="sidebar-email" href="mailto:"<?= $isLoggedIn ? '' : ' data-login-required="contact"' ?>><i class="bi bi-envelope me-2"></i>Email</a>
                        </div>
                    </div>
                </div>

                <div class="col-lg-8" data-aos="fade-up" data-aos-delay="120">
                    <div class="shadow-card about-card mb-4">
                        <div class="d-flex justify-content-between align-items-center mb-3 flex-wrap gap-2">
                            <h3 class="mb-0">About</h3>
                            <span class="badge text-bg-light px-3 py-2"><i class="bi bi-activity me-1"></i>Profile Snapshot</span>
                        </div>
                        <ul id="about-list" class="about-list"></ul>
                    </div>

                </div>
                <div class="shadow-card property-board">
                    <div class="d-flex flex-column flex-xl-row justify-content-between gap-3 align-items-start align-items-xl-center mb-4">
                        <div>
                            <h3 class="mb-1">Active Listings</h3>
                            <p class="text-muted mb-0">Browse and filter the inventory managed by this agent.</p>
                        </div>
                        <div class="view-toggle">
                            <button type="button" class="active" data-view-toggle="card"><i class="bi bi-grid me-1"></i>Card View</button>
                            <button type="button" data-view-toggle="table"><i class="bi bi-list-ul me-1"></i>Table View</button>
                        </div>
                    </div>

                    <div class="filter-grid mb-4">
                        <div class="filter-group">
                            <label for="filter-city">City</label>
                            <select id="filter-city" class="form-select">
                                <option value="">All</option>
                            </select>
                        </div>
                        <div class="filter-group">
                            <label for="filter-price">Price Range</label>
                            <select id="filter-price" class="form-select">
                                <option value="">All</option>
                                <option value="low">Low (&lt; ₹50L)</option>
                                <option value="mid">Mid (₹50L - ₹1.5Cr)</option>
                                <option value="high">High (&gt; ₹1.5Cr)</option>
                            </select>
                        </div>
                        <div class="filter-group">
                            <label for="filter-type">Property Type</label>
                            <select id="filter-type" class="form-select">
                                <option value="">All</option>
                                <option value="flat">Flat</option>
                                <option value="plot">Plot</option>
                                <option value="builder floor">Builder Floor</option>
                                <option value="independent house">Independent House</option>
                            </select>
                        </div>
                        <div class="filter-group">
                            <label for="filter-status">Status</label>
                            <select id="filter-status" class="form-select">
                                <option value="">All</option>
                                <option value="ready to move">Ready to Move</option>
                                <option value="under construction">Under Construction</option>
                            </select>
                        </div>
                        <div class="filter-group">
                            <label for="sort-select">Sort By</label>
                            <select id="sort-select" class="form-select">
                                <option value="newest">Newest Listed</option>
                                <option value="price-asc">Price: Low to High</option>
                                <option value="price-desc">Price: High to Low</option>
                            </select>
                        </div>
                    </div>

                    <div id="properties-empty" class="empty-state d-none">
                        <i class="bi bi-stack text-success fs-3 mb-2"></i>
                        <p class="mb-0">No properties match the selected filters.</p>
                    </div>

                    <div id="properties-card-view" class="property-grid"></div>

                    <div id="properties-table-view" class="table-responsive d-none">
                        <table class="table align-middle property-table">
                            <thead>
                                <tr>
                                    <th>Property</th>
                                    <th>Location</th>
                                    <th>Area</th>
                                    <th>Status</th>
                                    <th>Price</th>
                                    <th class="text-end">Actions</th>
                                </tr>
                            </thead>
                            <tbody id="properties-table-body"></tbody>
                        </table>
                    </div>

                    <div class="pagination-controls">
                        <button class="btn btn-outline-success" id="prev-page"><i class="bi bi-arrow-left"></i> Previous</button>
                        <span id="pagination-info" class="text-muted small">Page 1 of 1</span>
                        <button class="btn btn-outline-success" id="next-page">Next <i class="bi bi-arrow-right"></i></button>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <?php if (session()->get('isLoggedIn')): ?>
    <div class="modal fade feedback-modal" id="feedbackModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <div>
                        <p class="text-uppercase text-muted small mb-1">Feedback</p>
                        <h5 class="modal-title mb-0">Share your experience</h5>
                    </div>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="agent-feedback-form" class="needs-validation" novalidate>
                        <input type="hidden" name="agent_id" id="feedback-agent-id">
                        <input type="hidden" name="agent_name" id="feedback-agent-name">
                        <div class="mb-3">
                            <label for="feedback-name" class="form-label">Your Name</label>
                            <input type="text" class="form-control" id="feedback-name" name="name" value="<?= esc(session()->get('full_name') ?? '') ?>" required>
                        </div>
                        <div class="mb-3">
                            <label for="feedback-phone" class="form-label">Phone Number</label>
                            <input type="tel" class="form-control" id="feedback-phone" name="phone_number" value="<?= esc(session()->get('phone_number') ?? '') ?>" required>
                        </div>
                        <div class="mb-3">
                            <label for="feedback-rating" class="form-label">Rating</label>
                            <select class="form-select" id="feedback-rating" name="rating" required>
                                <option value="">Select rating</option>
                                <option value="5">5 - Excellent</option>
                                <option value="4.5">4.5</option>
                                <option value="4">4 - Very Good</option>
                                <option value="3.5">3.5</option>
                                <option value="3">3 - Good</option>
                                <option value="2.5">2.5</option>
                                <option value="2">2 - Fair</option>
                                <option value="1.5">1.5</option>
                                <option value="1">1 - Needs Improvement</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="feedback-comment" class="form-label">Comment (optional)</label>
                            <textarea class="form-control" id="feedback-comment" name="comment" rows="3" placeholder="Share what you appreciated or what we can improve"></textarea>
                        </div>
                        <button type="submit" class="btn btn-success w-100" id="feedback-submit">Send Feedback</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <?php endif; ?>

    <div class="modal fade share-modal" id="shareModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <div>
                        <p class="text-uppercase text-muted small mb-1 share-entity-label">Share Profile</p>
                        <h5 class="modal-title share-entity-title mb-0">Agent Link</h5>
                    </div>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="input-group share-link-group">
                        <input type="text" class="form-control" id="shareLinkInput" readonly>
                        <button class="btn btn-success" type="button" id="copyShareLink">Copy Link</button>
                    </div>
                    <div class="share-actions">
                        <a href="#" id="shareWhatsApp" target="_blank" rel="nofollow noopener" class="share-chip">
                            <i class="bi bi-whatsapp"></i> WhatsApp
                        </a>
                        <a href="#" id="shareFacebook" target="_blank" rel="nofollow noopener" class="share-chip">
                            <i class="bi bi-facebook"></i> Facebook
                        </a>
                        <a href="#" id="shareInstagram" target="_blank" rel="nofollow noopener" class="share-chip">
                            <i class="bi bi-instagram"></i> Instagram
                        </a>
                        <a href="#" id="shareX" target="_blank" rel="nofollow noopener" class="share-chip">
                            <i class="bi bi-twitter-x"></i> X
                        </a>
                        <a href="#" id="shareLinkedIn" target="_blank" rel="nofollow noopener" class="share-chip">
                            <i class="bi bi-linkedin"></i> LinkedIn
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <?= $this->include('layouts/footer') ?>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script>
    (function(){
        function qs(key){
            const u = new URL(location.href);
            return u.searchParams.get(key);
        }

        const agentId = qs('id');
        const apiBase = '<?= site_url('api/agent') ?>';
        const apiProperties = '<?= site_url('api/property/all') ?>';
        const propertyDetailBase = '<?= site_url('property') ?>';
        const appointmentEndpoint = '<?= site_url('api/appointments/request') ?>';
        const loginUrl = '<?= site_url('login') ?>';
        const isLoggedIn = <?= $isLoggedIn ? 'true' : 'false' ?>;
        const feedbackUrl = '<?= site_url('api/agent/feedback') ?>';
        const el = (id)=> document.getElementById(id);
        const safe = (s)=> String(s ?? '');
        const escapeAttr = (value)=> safe(value).replace(/"/g, '&quot;');
        const agentProfile = {
            name: 'Agent Profile',
            label: 'Share Profile',
            url: window.location.href,
            agentId: null,
            agentFullName: '',
            city: '',
            service: ''
        };

        const state = {
            raw: [],
            filtered: [],
            filters: { city: '', price: '', type: '', status: '' },
            sort: 'newest',
            view: 'card',
            page: 1,
            perPage: 10
        };

        const ui = {
            grid: el('properties-card-view'),
            tableWrapper: el('properties-table-view'),
            tableBody: el('properties-table-body'),
            empty: el('properties-empty'),
            paginationInfo: el('pagination-info'),
            prevBtn: el('prev-page'),
            nextBtn: el('next-page'),
            filterCity: el('filter-city'),
            filterPrice: el('filter-price'),
            filterType: el('filter-type'),
            filterStatus: el('filter-status'),
            sortSelect: el('sort-select'),
            viewButtons: document.querySelectorAll('[data-view-toggle]'),
            contactBtn: document.getElementById('btn-call-back')
        };
        const shareModalEl = document.getElementById('shareModal');
        const shareModal = (shareModalEl && window.bootstrap) ? new window.bootstrap.Modal(shareModalEl) : null;
        const shareLabelEl = shareModalEl ? shareModalEl.querySelector('.share-entity-label') : null;
        const shareTitleEl = shareModalEl ? shareModalEl.querySelector('.share-entity-title') : null;
        const shareLinkInput = document.getElementById('shareLinkInput');
        const copyShareBtn = document.getElementById('copyShareLink');
        const shareTargets = {
            whatsapp: document.getElementById('shareWhatsApp'),
            facebook: document.getElementById('shareFacebook'),
            instagram: document.getElementById('shareInstagram'),
            x: document.getElementById('shareX'),
            linkedin: document.getElementById('shareLinkedIn')
        };
        const agentShareButton = document.getElementById('agent-share');
        if (agentShareButton) {
            agentShareButton.dataset.shareLink = agentProfile.url;
            agentShareButton.dataset.shareTitle = agentProfile.name;
            agentShareButton.dataset.shareLabel = agentProfile.label;
        }
        const feedbackModalEl = document.getElementById('feedbackModal');
        const feedbackModal = (feedbackModalEl && window.bootstrap) ? new window.bootstrap.Modal(feedbackModalEl) : null;
        const feedbackForm = document.getElementById('agent-feedback-form');
        const feedbackSubmitButton = document.getElementById('feedback-submit');
        const feedbackButtonDefaultText = feedbackSubmitButton ? feedbackSubmitButton.textContent.trim() : 'Send Feedback';
        const csrfTokenMeta = document.querySelector('meta[name="csrf-token-name"]');
        const csrfHashMeta = document.querySelector('meta[name="csrf-token-value"]');
        const csrfHeaderName = 'X-CSRF-TOKEN';
        let csrfTokenName = csrfTokenMeta ? csrfTokenMeta.getAttribute('content') : null;
        let csrfTokenValue = csrfHashMeta ? csrfHashMeta.getAttribute('content') : null;

        const refreshCsrfTokens = (payload) => {
            if (!payload) return;
            if (csrfTokenMeta && payload.csrfToken) {
                csrfTokenMeta.setAttribute('content', payload.csrfToken);
                csrfTokenName = payload.csrfToken;
            }
            if (csrfHashMeta && payload.csrfHash) {
                csrfHashMeta.setAttribute('content', payload.csrfHash);
                csrfTokenValue = payload.csrfHash;
            }
        };

        const buildHeaders = () => {
            const headers = { 'Content-Type': 'application/json', 'X-Requested-With': 'XMLHttpRequest' };
            if (csrfTokenValue) headers[csrfHeaderName] = csrfTokenValue;
            return headers;
        };

        const promptLoginToContact = () => {
            if (window.Swal) {
                Swal.fire({
                    icon: 'warning',
                    title: 'Login required',
                    text: 'Sign in to view contact details and book an appointment.',
                    confirmButtonText: 'Login',
                    showCancelButton: true
                }).then(result => {
                    if (result.isConfirmed) {
                        window.location.href = loginUrl;
                    }
                });
            } else {
                window.location.href = loginUrl;
            }
        };

        const appointmentFormTemplate = (agentName, agentCity, agentService) => {
            const today = new Date().toISOString().split('T')[0];
            return `
                <div class="swal2-service-chip">
                    <i class="bi bi-person-lines-fill"></i>
                    <span>Agent Appointment</span>
                </div>
                <div class="swal2-service-chip" style="background: rgba(13, 110, 253, 0.12); color: #0f2f6e;">
                    <i class="bi bi-person-badge"></i>
                    <span>${agentName}</span>
                </div>
                ${agentCity ? `<div class="swal2-note mb-2">Location: ${agentCity}</div>` : ''}
                ${agentService ? `<div class="swal2-note mb-2">Specialisation: ${agentService}</div>` : ''}
                <div class="swal2-form-grid">
                    <div class="swal2-form-field">
                        <label>Your Name</label>
                        <input id="appointment-name" class="swal2-input" placeholder="Full Name">
                    </div>
                    <div class="swal2-form-field">
                        <label>Phone Number</label>
                        <input id="appointment-phone" class="swal2-input" placeholder="Mobile number">
                    </div>
                    <div class="swal2-form-field">
                        <label>Email Address</label>
                        <input id="appointment-email" class="swal2-input" placeholder="Email">
                    </div>
                    <div class="swal2-form-field">
                        <label>Preferred Date</label>
                        <input id="appointment-date" class="swal2-input" type="date" min="${today}">
                    </div>
                    <div class="swal2-form-field">
                        <label>Preferred Time</label>
                        <input id="appointment-time" class="swal2-input" type="time">
                    </div>
                    <div class="swal2-form-field" style="grid-column: span 2;">
                        <label>Tell us more</label>
                        <textarea id="appointment-note" class="swal2-textarea" rows="3" placeholder="What outcome are you expecting?"></textarea>
                    </div>
                </div>
                <p class="swal2-note">Our concierge confirms availability and shares meeting options within 24 hours.</p>
            `;
        };

        const openAppointmentSurvey = ({ agentId, agentName, agentCity, agentService }) => {
            if (!window.Swal) {
                window.location.href = appointmentEndpoint;
                return;
            }
            const displayName = agentName || 'Agent';
            Swal.fire({
                title: `Book appointment with ${displayName}`,
                html: appointmentFormTemplate(displayName, agentCity || '', agentService || ''),
                showCancelButton: true,
                confirmButtonText: 'Submit Request',
                focusConfirm: false,
                preConfirm: async () => {
                    const name = document.getElementById('appointment-name')?.value.trim();
                    const phone = document.getElementById('appointment-phone')?.value.trim();
                    const email = document.getElementById('appointment-email')?.value.trim();
                    const date = document.getElementById('appointment-date')?.value;
                    const time = document.getElementById('appointment-time')?.value;
                    const note = document.getElementById('appointment-note')?.value.trim();

                    if (!name || !phone || !email || !date || !time) {
                        Swal.showValidationMessage('Please complete all required fields.');
                        return false;
                    }

                    const emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
                    if (!emailPattern.test(email)) {
                        Swal.showValidationMessage('Please enter a valid email address.');
                        return false;
                    }

                    const messageParts = [
                        `Agent: ${displayName}`,
                        agentCity ? `Location: ${agentCity}` : '',
                        agentService ? `Specialisation: ${agentService}` : '',
                        `Preferred Date: ${date}`,
                        `Preferred Time: ${time}`,
                        note ? `Notes: ${note}` : ''
                    ].filter(Boolean).join('\n');

                    const payload = {
                        agent_id: agentId || null,
                        agent_name: displayName,
                        agent_city: agentCity || '',
                        agent_service: agentService || '',
                        name,
                        phone,
                        email,
                        preferred_date: date,
                        preferred_time: time,
                        notes: note,
                        message: messageParts
                    };
                    if (csrfTokenName && csrfTokenValue) {
                        payload[csrfTokenName] = csrfTokenValue;
                    }

                    try {
                        const response = await fetch(appointmentEndpoint, {
                            method: 'POST',
                            headers: buildHeaders(),
                            body: JSON.stringify(payload),
                            credentials: 'same-origin'
                        });
                        const result = await response.json().catch(() => ({}));
                        refreshCsrfTokens(result);
                        if (!response.ok) {
                            Swal.showValidationMessage(result.message || 'Unable to submit appointment request right now.');
                            return false;
                        }
                        return result;
                    } catch (error) {
                        Swal.showValidationMessage('We are having trouble reaching the server. Please try again.');
                        return false;
                    }
                }
            }).then((result) => {
                if (result.isConfirmed && result.value) {
                    Swal.fire({
                        icon: 'success',
                        title: 'Request received',
                        text: 'Our concierge will reach out shortly with next steps.',
                        timer: 4000,
                        showConfirmButton: false
                    });
                }
            });
        };

        function openShareModal({ url, title, label }){
            const cleanUrl = url || window.location.href;
            const displayTitle = title || document.title || 'Share Link';
            if (!shareModal || !shareLinkInput) {
                if (navigator.share) {
                    navigator.share({ title: displayTitle, url: cleanUrl }).catch(()=>{});
                    return;
                }
                if (navigator.clipboard?.writeText) {
                    navigator.clipboard.writeText(cleanUrl).then(() => alert('Link copied to clipboard'));
                    return;
                }
                window.prompt('Copy this link', cleanUrl);
                return;
            }
            shareLinkInput.value = cleanUrl;
            if (shareLabelEl) shareLabelEl.textContent = label || 'Share';
            if (shareTitleEl) shareTitleEl.textContent = displayTitle;
            const encodedUrl = encodeURIComponent(cleanUrl);
            const encodedMessage = encodeURIComponent(`${displayTitle} - ${cleanUrl}`);
            shareTargets.whatsapp && (shareTargets.whatsapp.href = `https://wa.me/?text=${encodedMessage}`);
            shareTargets.facebook && (shareTargets.facebook.href = `https://www.facebook.com/sharer/sharer.php?u=${encodedUrl}`);
            shareTargets.instagram && (shareTargets.instagram.href = `https://www.instagram.com/?url=${encodedUrl}`);
            shareTargets.x && (shareTargets.x.href = `https://twitter.com/intent/tweet?text=${encodedMessage}`);
            shareTargets.linkedin && (shareTargets.linkedin.href = `https://www.linkedin.com/sharing/share-offsite/?url=${encodedUrl}`);
            shareModal?.show();
        }

        if (copyShareBtn) {
            copyShareBtn.addEventListener('click', async () => {
                const link = shareLinkInput ? shareLinkInput.value : '';
                if (!link) return;
                try {
                    if (navigator.clipboard?.writeText) {
                        await navigator.clipboard.writeText(link);
                    } else {
                        shareLinkInput.select();
                        document.execCommand('copy');
                        shareLinkInput.blur();
                    }
                    copyShareBtn.textContent = 'Copied!';
                    setTimeout(() => { copyShareBtn.textContent = 'Copy Link'; }, 1500);
                } catch(err) {
                    console.error('Copy failed', err);
                }
            });
        }

        function parsePrice(value){
            if (value === undefined || value === null || value === '') return null;
            if (typeof value === 'number') return value;
            const digits = String(value).replace(/[^0-9.]/g, '');
            return digits ? Number(digits) : null;
        }
        function extractCity(p){
            return safe(p.city || p.location || p.address || (p.details && p.details.city) || '').toLowerCase();
        }
        function extractStatus(p){
            return safe(p.status || p.possession || p.details?.status || '').toLowerCase();
        }
        function extractType(p){
            return safe(p.property_type || p.type || p.category || '').toLowerCase();
        }
        function extractDate(p){
            return p.created_at || p.updated_at || p.date || null;
        }
        function resolveMediaUrl(item){
            try{
                const first = (item.media && item.media.length) ? item.media[0] : null;
                const candidate = first?.url || first?.file_url || first?.fileUrl || first?.file || first?.image || null;
                if (candidate) return (/^https?:\/\//i.test(candidate)) ? candidate : ('<?= base_url('uploads/properties/') ?>' + candidate);
                const fallback = item.main_image || item.image || item.thumbnail || null;
                if (fallback) return (/^https?:\/\//i.test(fallback)) ? fallback : ('<?= base_url('uploads/properties/') ?>' + fallback);
            }catch(e){ console.debug('resolveMediaUrl error', e); }
            return '<?= base_url('images/property.png') ?>';
        }
        function resolveDetailUrl(item){
            if (!item) return '#';
            const explicit = item.permalink || item.url || item.detail_url || item.full_url;
            if (explicit) return explicit;
            const slug = item.slug || item.property_slug;
            if (slug) return `${propertyDetailBase}/${encodeURIComponent(slug)}`;
            const id = item.id || item.property_id || item.uuid;
            if (id) return `${propertyDetailBase}?id=${encodeURIComponent(id)}`;
            return '#';
        }
        function formatPrice(value){
            if (value === undefined || value === null || value === '') return '—';
            const num = parsePrice(value);
            return num ? '₹ ' + num.toLocaleString('en-IN') : safe(value);
        }
        function priceBucket(value){
            const price = parsePrice(value);
            if (!price) return '';
            if (price < 5000000) return 'low';
            if (price <= 15000000) return 'mid';
            return 'high';
        }
        function renderRating(value){
            const rating = Number(value) || 4.8;
            el('agent-rating-value').textContent = rating.toFixed(1);
            const stars = el('agent-rating-stars');
            let html = '';
            for (let i = 1; i <= 5; i++) {
                if (rating >= i) html += '<i class="bi bi-star-fill"></i>';
                else if (rating >= i - 0.5) html += '<i class="bi bi-star-half"></i>';
                else html += '<i class="bi bi-star"></i>';
            }
            stars.innerHTML = html;
        }
        function applyFilters(){
            const cityFilter = state.filters.city;
            const priceFilter = state.filters.price;
            const typeFilter = state.filters.type;
            const statusFilter = state.filters.status;

            let list = state.raw.filter(p => {
                if (cityFilter && extractCity(p) !== cityFilter) return false;
                if (priceFilter) {
                    const bucket = priceBucket(p.pricing?.price || p.price);
                    if (bucket !== priceFilter) return false;
                }
                if (typeFilter) {
                    const type = extractType(p);
                    if (!type.includes(typeFilter)) return false;
                }
                if (statusFilter) {
                    const status = extractStatus(p);
                    if (!status.includes(statusFilter)) return false;
                }
                return true;
            });

            if (state.sort === 'price-asc') {
                list = list.slice().sort((a,b) => (parsePrice(a.pricing?.price || a.price) || 0) - (parsePrice(b.pricing?.price || b.price) || 0));
            } else if (state.sort === 'price-desc') {
                list = list.slice().sort((a,b) => (parsePrice(b.pricing?.price || b.price) || 0) - (parsePrice(a.pricing?.price || a.price) || 0));
            } else {
                list = list.slice().sort((a,b) => {
                    const da = new Date(extractDate(a) || 0).getTime();
                    const db = new Date(extractDate(b) || 0).getTime();
                    return db - da;
                });
            }

            state.filtered = list;
            state.page = 1;
            renderProperties();
        }
        function paginate(list){
            const start = (state.page - 1) * state.perPage;
            return list.slice(start, start + state.perPage);
        }
        function updatePagination(){
            const totalPages = Math.max(1, Math.ceil(state.filtered.length / state.perPage));
            if (state.page > totalPages) state.page = totalPages;
            ui.paginationInfo.textContent = `Page ${state.page} of ${totalPages}`;
            ui.prevBtn.disabled = state.page === 1;
            ui.nextBtn.disabled = state.page === totalPages;
        }
        function buildCard(p){
            const img = resolveMediaUrl(p);
            const title = safe(p.property_name || p.title || p.name || p.property_title || 'Property');
            const location = safe(p.location || p.address || p.locality || p.city || '');
            const area = safe(p.area || p.area_sqft || p.details?.area || '—');
            const status = safe(p.status || p.possession || '');
            const price = formatPrice(p.pricing?.price || p.price);
            const detailUrl = resolveDetailUrl(p);
            const shareTitle = `${title} • ${location || 'Listing'}`;
            return `
                <article class="property-card" data-detail-url="${detailUrl}">
                    <div class="position-relative">
                        <img src="${img}" alt="${title}" loading="lazy">
                        ${status ? `<span class="status-pill">${status}</span>` : ''}
                    </div>
                    <div class="property-card-body">
                        <div class="property-card-header">
                            <div>
                                <p class="property-location mb-1">${location}</p>
                                <h5 class="mb-1">${title}</h5>
                            </div>
                            <div class="property-actions">
                                <button type="button" class="btn-icon" aria-label="Save"><i class="bi bi-heart"></i></button>
                                <button type="button" class="btn-icon share-btn" data-share-link="${escapeAttr(detailUrl)}" data-share-title="${escapeAttr(shareTitle)}" data-share-label="Share Property" aria-label="Share"><i class="bi bi-share"></i></button>
                            </div>
                        </div>
                        <h4 class="mb-1">${price}</h4>
                        <div class="d-flex gap-3 text-muted small">
                            <span><i class="bi bi-arrows-angle-expand me-1"></i>${area}</span>
                            <span><i class="bi bi-building me-1"></i>${safe(p.property_type || p.type || '—')}</span>
                        </div>
                    </div>
                </article>`;
        }
        function buildTableRow(p){
            const img = resolveMediaUrl(p);
            const title = safe(p.property_name || p.title || p.name || p.property_title || 'Property');
            const location = safe(p.location || p.address || p.locality || p.city || '');
            const area = safe(p.area || p.area_sqft || p.details?.area || '—');
            const status = safe(p.status || p.possession || '');
            const price = formatPrice(p.pricing?.price || p.price);
            const detailUrl = resolveDetailUrl(p);
            const shareTitle = `${title} • ${location || 'Listing'}`;
            return `
                <tr data-detail-url="${detailUrl}">
                    <td>
                        <div class="d-flex align-items-center gap-2">
                            <img src="${img}" alt="${title}" width="64" height="48" class="rounded-3 object-fit-cover">
                            <span>${title}</span>
                        </div>
                    </td>
                    <td>${location}</td>
                    <td>${area}</td>
                    <td>${status || '—'}</td>
                    <td>${price}</td>
                    <td class="text-end">
                        <button type="button" class="btn-icon" aria-label="Save"><i class="bi bi-heart"></i></button>
                        <button type="button" class="btn-icon share-btn" data-share-link="${escapeAttr(detailUrl)}" data-share-title="${escapeAttr(shareTitle)}" data-share-label="Share Property" aria-label="Share"><i class="bi bi-share"></i></button>
                    </td>
                </tr>`;
        }
        function renderProperties(){
            const slice = paginate(state.filtered);
            ui.grid.innerHTML = slice.map(buildCard).join('');
            ui.tableBody.innerHTML = slice.map(buildTableRow).join('');
            const hasData = state.filtered.length > 0;
            ui.empty.classList.toggle('d-none', hasData);
            ui.grid.classList.toggle('d-none', state.view !== 'card' || !hasData);
            ui.tableWrapper.classList.toggle('d-none', state.view !== 'table' || !hasData);
            updatePagination();
            attachListingNavigation();
        }

        function attachListingNavigation(){
            ui.grid.querySelectorAll('.property-card[data-detail-url]').forEach(card => {
                const targetUrl = card.dataset.detailUrl;
                card.onclick = () => targetUrl ? window.location.href = targetUrl : null;
            });
            ui.tableBody.querySelectorAll('tr[data-detail-url]').forEach(row => {
                const targetUrl = row.dataset.detailUrl;
                row.onclick = () => targetUrl ? window.location.href = targetUrl : null;
            });
        }
        function populateCities(data){
            const cities = Array.from(new Set(data.map(extractCity).filter(Boolean))).sort();
            const frag = document.createDocumentFragment();
            cities.forEach(city => {
                const option = document.createElement('option');
                option.value = city;
                option.textContent = city.replace(/\b\w/g, c => c.toUpperCase());
                frag.appendChild(option);
            });
            ui.filterCity.appendChild(frag);
        }
        function bindFilters(){
            ui.filterCity.addEventListener('change', e => { state.filters.city = e.target.value; applyFilters(); });
            ui.filterPrice.addEventListener('change', e => { state.filters.price = e.target.value; applyFilters(); });
            ui.filterType.addEventListener('change', e => { state.filters.type = e.target.value; applyFilters(); });
            ui.filterStatus.addEventListener('change', e => { state.filters.status = e.target.value; applyFilters(); });
            ui.sortSelect.addEventListener('change', e => { state.sort = e.target.value; applyFilters(); });
            ui.viewButtons.forEach(btn => {
                btn.addEventListener('click', () => {
                    ui.viewButtons.forEach(b => b.classList.toggle('active', b === btn));
                    state.view = btn.dataset.viewToggle;
                    renderProperties();
                });
            });
            ui.prevBtn.addEventListener('click', () => {
                if (state.page > 1) {
                    state.page -= 1;
                    renderProperties();
                }
            });
            ui.nextBtn.addEventListener('click', () => {
                const totalPages = Math.max(1, Math.ceil(state.filtered.length / state.perPage));
                if (state.page < totalPages) {
                    state.page += 1;
                    renderProperties();
                }
            });
        }

        async function loadAgent(){
            if (!agentId) return;
            try{
                const res = await fetch(`${apiBase}/${agentId}`);
                const payload = await res.json();
                if (!payload || payload.status !== 'success') return;
                const a = payload.data;

                if (a.avatar) {
                    const img = el('agent-avatar-img');
                    img.src = a.avatar;
                    img.style.display = 'block';
                    el('agent-avatar').style.display = 'none';
                } else {
                    el('agent-avatar-img').style.display = 'none';
                    const initials = (a.full_name || a.agency_name || 'A').split(' ').map(x => x[0]).slice(0,2).join('').toUpperCase();
                    const placeholder = el('agent-avatar');
                    placeholder.style.display = 'flex';
                    placeholder.textContent = initials || 'A';
                }

                const agentNameEl = el('agent-name');
                if (agentNameEl.firstChild) agentNameEl.firstChild.textContent = a.full_name || a.agency_name || 'Agent';
                agentProfile.name = `${safe(a.full_name || a.agency_name || 'Agent')} Profile`;
                agentProfile.url = window.location.href;
                agentProfile.agentId = a.user_id ?? a.agent_id ?? null;
                agentProfile.agentFullName = safe(a.full_name || a.agency_name || 'Agent');
                agentProfile.city = safe(a.city || a.office_location || '');
                agentProfile.service = Array.isArray(a.specializations) ? a.specializations.join(', ') : safe(a.specializations || '');
                if (agentShareButton) {
                    agentShareButton.dataset.shareTitle = agentProfile.name;
                    agentShareButton.dataset.shareLink = agentProfile.url;
                    agentShareButton.dataset.shareLabel = agentProfile.label;
                }
                const feedbackAgentIdEl = el('feedback-agent-id');
                if (feedbackAgentIdEl) feedbackAgentIdEl.value = agentProfile.agentId || '';
                const feedbackAgentNameEl = el('feedback-agent-name');
                if (feedbackAgentNameEl) feedbackAgentNameEl.value = agentProfile.agentFullName;
                el('agent-company').textContent = a.agency_name || a.city || 'Independent Agent';
                el('agent-location').textContent = a.city || 'Multiple Cities';
                el('agent-since').textContent = a.created_at ? ('Active since: ' + (new Date(a.created_at)).getFullYear()) : 'Active since: —';
                el('agent-role').textContent = a.specializations ? 'Specialist • ' + a.specializations.slice(0,2).join(', ') : 'Real Estate Specialist';
                if (a.is_verified) el('agent-verified').style.display = 'inline-flex';
                if (a.rating) renderRating(a.rating);

                const phone = a.phone_number || a.phone || '';
                const email = a.email || '';
                el('agent-phone-display').textContent = phone || '—';
                el('agent-email-display').textContent = email || '—';
                el('agent-whatsapp').href = phone ? `https://wa.me/${phone}` : '#';
                el('agent-call').href = phone ? `tel:${phone}` : '#';
                el('sidebar-call').href = phone ? `tel:${phone}` : '#';
                el('agent-email').href = email ? `mailto:${email}` : '#';
                el('sidebar-email').href = email ? `mailto:${email}` : '#';

                const specs = el('specializations'); specs.innerHTML='';
                const tags = Array.isArray(a.specializations) && a.specializations.length ? a.specializations : ['Rental', 'Resale', 'New Sale'];
                tags.forEach(tag => {
                    const span = document.createElement('span');
                    span.className = 'spec-tag';
                    span.textContent = tag;
                    specs.appendChild(span);
                });

                const about = el('about-list'); about.innerHTML='';
                const addAbout = (icon, label, val)=> {
                    const normalized = safe(val).trim();
                    const normalizedKey = normalized.replace(/[^a-z]/gi, '').toLowerCase();
                    if (!normalized || normalized === '—' || normalizedKey === 'na') {
                        return;
                    }
                    const li = document.createElement('li');
                    li.innerHTML = `<span class="icon"><i class="bi ${icon}"></i></span><div><strong>${label}</strong><div class="text-muted">${normalized}</div></div>`;
                    about.appendChild(li);
                };
                addAbout('bi-briefcase', 'Experience', a.experience || 'N/A');
                addAbout('bi-people', 'Team Members', a.team_size || 'N/A');
                addAbout('bi-geo-alt', 'Office Location', a.city || '');
                addAbout('bi-building-check', 'RERA Number', a.rera_number || 'NA');
                addAbout('bi-translate', 'Languages', Array.isArray(a.languages) ? a.languages.join(', ') : (a.languages || 'English'));
            }catch(err){ console.error('Failed to load agent', err); }
        }

        async function loadProperties(){
            try{
                const res = await fetch(apiProperties);
                if (!res.ok) throw new Error('HTTP ' + res.status);
                const payload = await res.json();
                const all = (payload && payload.data) ? payload.data : [];
                const myProps = agentId ? all.filter(p => String(p.user_id) === String(agentId)) : all;
                state.raw = myProps;
                populateCities(myProps);
                applyFilters();
            }catch(err){
                console.error('Failed to load properties', err);
                ui.empty.classList.remove('d-none');
                ui.empty.textContent = 'Failed to load properties.';
            }
        }

        bindFilters();
        loadAgent();
        loadProperties();

        if (ui.contactBtn) {
            ui.contactBtn.addEventListener('click', (event) => {
                event.preventDefault();
                openAppointmentSurvey({
                    agentId: agentProfile.agentId,
                    agentName: agentProfile.agentFullName,
                    agentCity: agentProfile.city,
                    agentService: agentProfile.service
                });
            });
        }

        document.addEventListener('click', (event) => {
            const guard = event.target.closest('[data-login-required]');
            if (guard) {
                event.preventDefault();
                promptLoginToContact();
                return;
            }
            const trigger = event.target.closest('.share-btn');
            if (!trigger) return;
            event.preventDefault();
            event.stopPropagation();
            const url = trigger.getAttribute('data-share-link') || window.location.href;
            const title = trigger.getAttribute('data-share-title') || document.title;
            const label = trigger.getAttribute('data-share-label') || 'Share';
            openShareModal({ url, title, label });
        });

        if (feedbackForm && feedbackSubmitButton) {
            feedbackForm.addEventListener('submit', async (event) => {
                event.preventDefault();
                if (!agentProfile.agentId) {
                    Swal.fire({ icon: 'warning', title: 'Please wait', text: 'Agent details are still loading.' });
                    return;
                }
                const nameInput = feedbackForm.querySelector('[name="name"]');
                const phoneInput = feedbackForm.querySelector('[name="phone_number"]');
                const ratingInput = feedbackForm.querySelector('[name="rating"]');
                const commentInput = feedbackForm.querySelector('[name="comment"]');
                const payload = {
                    agent_id: agentProfile.agentId,
                    agent_name: agentProfile.agentFullName || safe(el('agent-name')?.textContent || ''),
                    name: (nameInput?.value || '').trim(),
                    phone_number: (phoneInput?.value || '').trim(),
                    rating: (ratingInput?.value || '').trim(),
                    comment: (commentInput?.value || '').trim(),
                };
                if (!payload.name || !payload.phone_number || !payload.rating) {
                    Swal.fire({ icon: 'warning', title: 'Missing details', text: 'Please complete the required fields.' });
                    return;
                }
                feedbackSubmitButton.disabled = true;
                feedbackSubmitButton.textContent = 'Sending...';
                try {
                    const response = await fetch(feedbackUrl, {
                        method: 'POST',
                        headers: { 'Content-Type': 'application/json' },
                        body: JSON.stringify(payload),
                    });
                    const result = await response.json().catch(() => ({}));
                    if (!response.ok) throw new Error(result.message || 'Could not submit feedback.');
                    feedbackForm.reset();
                    if (feedbackModal) feedbackModal.hide();
                    Swal.fire({ icon: 'success', title: 'Feedback received', text: result.message || 'Thank you for sharing your rating.' });
                } catch (err) {
                    console.error('Feedback error', err);
                    Swal.fire({ icon: 'error', title: 'Submission failed', text: err.message || 'Unable to send feedback now.' });
                } finally {
                    feedbackSubmitButton.disabled = false;
                    feedbackSubmitButton.textContent = feedbackButtonDefaultText;
                }
            });
        }
    })();
    </script>
</body>
</html>

