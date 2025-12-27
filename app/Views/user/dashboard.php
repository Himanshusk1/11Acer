<?php
$page_title = 'User Dashboard - 36 Broking Hub';
$defaultProfileImage = base_url('images/36_profile.png');
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
            --brand:#198754;
            --brand-dark:#0f5132;
            --brand-soft:#e6f2ec;
            --muted:#6c757d;
            --surface:#ffffff;
            --background:#f7faf8;
            --shadow:0 30px 60px rgba(15,28,22,0.12);
            --border:rgba(25,135,84,0.12);
        }
        *,*::before,*::after { box-sizing:border-box; }
        body {
            font-family:'Inter',system-ui,-apple-system,'Segoe UI',sans-serif;
            background:var(--background);
            color:#1f2a24;
            min-height:100vh;
            margin:0;
            line-height:1.55;
            overflow-x:hidden;
        }
        body.sidebar-open { overflow:hidden; }
        a { text-decoration:none; color:inherit; }
        img { max-width:100%; height:auto; display:block; }
        .layout-shell { min-height:100vh; background:var(--background); }

        /* Sidebar */
        .sidebar {
            position:fixed;
            top:0;
            left:0;
            bottom:0;
            width:270px;
            padding:2rem 1.5rem;
            display:flex;
            flex-direction:column;
            gap:1.25rem;
            background:rgba(15,24,19,0.95);
            color:#f0fff4;
            backdrop-filter:blur(18px);
            box-shadow:12px 0 35px rgba(11,18,14,0.5);
            z-index:1040;
            transition:transform 0.35s ease, box-shadow 0.35s ease;
            will-change:transform;
        }
        .sidebar-fixed { flex-shrink:0; }
        .sidebar-header {
            font-weight:700;
            font-size:1.35rem;
            text-transform:uppercase;
            letter-spacing:0.08em;
        }
        .sidebar-header span { color:var(--brand); }
        .sidebar-profile {
            border-radius:18px;
            padding:1.25rem;
            background:rgba(255,255,255,0.08);
            border:1px solid rgba(255,255,255,0.12);
        }
        .sidebar-profile-avatar {
            width:58px;
            height:58px;
            border-radius:14px;
            background:linear-gradient(135deg,rgba(25,135,84,0.2),rgba(25,135,84,0.45));
            display:flex;
            align-items:center;
            justify-content:center;
            font-weight:700;
            font-size:1.1rem;
        }
        .sidebar-scroll {
            flex:1;
            overflow-y:auto;
            margin-right:-0.35rem;
            padding-right:0.35rem;
            padding-bottom:1rem;
            overscroll-behavior:contain;
        }
        .sidebar-scroll::-webkit-scrollbar { width:6px; }
        .sidebar-scroll::-webkit-scrollbar-thumb { background:rgba(255,255,255,0.25); border-radius:8px; }
        .section-label {
            font-size:0.65rem;
            letter-spacing:0.08em;
            color:rgba(255,255,255,0.55);
            text-transform:uppercase;
            margin:0 0 0.5rem;
        }
        .dash-nav { padding:0; margin:0; list-style:none; }
        .dash-nav .nav-link {
            color:rgba(240,255,247,0.85);
            padding:0.6rem 0.85rem;
            border-radius:12px;
            display:flex;
            align-items:center;
            gap:0.65rem;
            margin-bottom:0.45rem;
            transition:background 0.2s ease,color 0.2s ease,transform 0.2s ease;
        }
        .dash-nav .nav-link i { font-size:1.1rem; flex-shrink:0; }
        .dash-nav .nav-link:hover { background:rgba(255,255,255,0.08); color:#fff; transform:translateX(6px); }
        .dash-nav .nav-link.active { background:var(--brand); color:#fff; box-shadow:0 12px 28px rgba(25,135,84,0.35); }
        .sidebar-cta {
            margin-top:1.25rem;
            padding:1rem;
            border-radius:18px;
            background:rgba(25,135,84,0.12);
            border:1px solid rgba(25,135,84,0.3);
        }
        .sidebar-cta .btn { width:100%; border-radius:12px; }

        /* Topbar */
        .topbar {
            position:fixed;
            top:0;
            left:270px;
            right:0;
            min-height:72px;
            background:var(--surface);
            border-bottom:1px solid var(--border);
            display:flex;
            align-items:stretch;
            z-index:1030;
            box-shadow:0 15px 30px rgba(12,25,19,0.08);
        }
        .topbar-inner {
            width:100%;
            max-width:1280px;
            margin:0 auto;
            padding:0.75rem 2rem;
            display:flex;
            align-items:center;
            justify-content:space-between;
            gap:1rem;
            flex-wrap:wrap;
        }
        .topbar-meta { flex:1 1 220px; min-width:200px; }
        .topbar-meta p { font-size:0.7rem; letter-spacing:0.08em; margin-bottom:0.2rem; color:var(--muted); text-transform:uppercase; }
        .topbar-meta h1 { margin:0; font-size:clamp(1.3rem,1.8vw,1.6rem); font-weight:600; color:#071b12; }
        .topbar-actions {
            flex:1 1 280px;
            display:flex;
            align-items:center;
            justify-content:flex-end;
            gap:0.6rem;
            flex-wrap:wrap;
        }
        .navbar-toggler {
            border:none;
            background:transparent;
            color:var(--brand);
            font-size:1.75rem;
            display:none;
        }
        .icon-btn {
            width:40px;
            height:40px;
            border-radius:12px;
            border:1px solid rgba(25,135,84,0.25);
            background:#fff;
            color:var(--brand);
            display:flex;
            align-items:center;
            justify-content:center;
            transition:all 0.2s ease;
        }
        .icon-btn:hover { background:var(--brand); color:#fff; box-shadow:0 12px 22px rgba(25,135,84,0.28); }
        .btn-brand { background:var(--brand); border-color:var(--brand); color:#fff; border-radius:12px; font-weight:600; }
        .btn-brand:hover { background:var(--brand-dark); border-color:var(--brand-dark); }
        .topbar-user .dropdown-toggle { gap:0.4rem; }

        /* Main */
        .main-content {
            margin-left:270px;
            margin-top:80px;
            padding:clamp(2rem,4vw,3.25rem) clamp(1.5rem,4vw,3.25rem) 3rem;
            min-height:calc(100vh - 72px);
            max-width:1400px;
        }
        .hero-panel {
            background:linear-gradient(135deg,rgba(25,135,84,0.16),rgba(25,135,84,0.05));
            border-radius:28px;
            padding:clamp(1.35rem,2vw,2.25rem);
            box-shadow:var(--shadow);
            margin-bottom:clamp(1.5rem,2vw,2rem);
        }
        .hero-panel h2 { font-size:clamp(1.45rem,2vw,2rem); margin-bottom:0.35rem; }
        .hero-panel p { color:var(--muted); margin-bottom:0; }
        .hero-panel .btn { min-width:160px; }

        .stat-card {
            border-radius:20px;
            background:var(--surface);
            border:1px solid var(--border);
            padding:1.1rem 1.25rem;
            box-shadow:var(--shadow);
            display:flex;
            align-items:flex-start;
            gap:0.9rem;
            min-height:100%;
            word-break:break-word;
            transition:transform 0.2s ease, box-shadow 0.2s ease;
        }
        .stat-card:hover { transform:translateY(-4px); box-shadow:0 32px 65px rgba(10,22,16,0.18); }
        .stat-card .icon {
            width:48px;
            height:48px;
            border-radius:14px;
            background:rgba(25,135,84,0.12);
            color:var(--brand);
            display:flex;
            align-items:center;
            justify-content:center;
            font-size:1.35rem;
        }
        .stat-card small { color:var(--muted); }

        .panel-section {
            background:var(--surface);
            border-radius:24px;
            border:1px solid var(--border);
            padding:clamp(1.35rem,2vw,1.9rem);
            box-shadow:var(--shadow);
            margin-bottom:clamp(1.25rem,2vw,1.85rem);
        }
        .panel-section-header {
            display:flex;
            flex-wrap:wrap;
            justify-content:space-between;
            gap:0.85rem;
            margin-bottom:1.25rem;
        }
        .panel-section h4 { margin:0; font-size:1.1rem; }
        .dash-section { display:none; }
        .dash-section.active { display:block; }

        .profile-avatar { width:88px; height:88px; border-radius:20px; object-fit:cover; border:3px solid rgba(255,255,255,0.8); }
        .profile-avatar-initials { width:88px; height:88px; border-radius:20px; display:grid; place-items:center; font-weight:700; font-size:1.5rem; color:var(--brand); background:linear-gradient(135deg,#f2fbf6,#fff); border:1px solid rgba(25,135,84,0.15); }
        .uplift-card { border-radius:20px; background:#f8fbf9; padding:1.5rem; border:1px dashed rgba(25,135,84,0.35); }

        .mobile-nav-card { display:none; border-radius:18px; }
        .mobile-nav-card .btn { flex:1 1 30%; border-radius:12px; }

        .backdrop {
            position:fixed;
            inset:0;
            background:rgba(0,0,0,0.45);
            z-index:1035;
            opacity:0;
            pointer-events:none;
            transition:opacity 0.3s ease;
        }
        .backdrop.active { opacity:1; pointer-events:auto; }

        .share-modal .modal-content {
            border-radius:16px;
            border:none;
            box-shadow:0 25px 70px rgba(12,12,20,0.18);
        }
        .share-modal .modal-header {
            border-bottom:none;
            padding-bottom:0;
        }
        .share-modal .modal-body { padding-top:0.5rem; }
        .share-link-group input {
            border-top-left-radius:999px;
            border-bottom-left-radius:999px;
        }
        .share-link-group .btn {
            border-top-right-radius:999px;
            border-bottom-right-radius:999px;
        }
        .share-actions {
            display:grid;
            grid-template-columns:repeat(auto-fit, minmax(120px, 1fr));
            gap:0.75rem;
            margin-top:1.25rem;
        }
        .share-chip {
            display:flex;
            align-items:center;
            justify-content:center;
            gap:0.4rem;
            border-radius:999px;
            padding:0.55rem 0.85rem;
            text-decoration:none;
            font-weight:600;
            border:1px solid rgba(25,135,84,0.2);
            color:#18422d;
            transition:background-color 0.2s ease, color 0.2s ease, border-color 0.2s ease;
        }
        .share-chip:hover {
            background-color:#198754;
            border-color:#198754;
            color:#fff;
        }
        .share-chip i { font-size:1rem; }

        /* Breakpoints */
        @media (max-width:1199.98px) {
            .main-content { padding:2.25rem clamp(1.25rem,4vw,2.5rem) 2.75rem; }
            .topbar-inner { padding:0.75rem 1.5rem; }
        }
        @media (max-width:991.98px) {
            .sidebar { transform:translateX(-105%); width:min(80vw,320px); box-shadow:0 20px 45px rgba(7,12,9,0.55); }
            .sidebar.active { transform:translateX(0); }
            .topbar { left:0; }
            .topbar-inner { padding:0.75rem 1.25rem; }
            .topbar-actions { width:100%; justify-content:flex-start; }
            .navbar-toggler { display:block; }
            .main-content { margin-left:0; margin-top:120px; padding:2rem 1.5rem 2.5rem; }
            .mobile-nav-card { display:block; }
        }
        @media (max-width:767.98px) {
            .topbar-meta { flex-basis:100%; }
            .topbar-meta h1 { font-size:1.35rem; }
            .topbar-actions { justify-content:flex-start; }
            .hero-panel { text-align:left; }
            .hero-panel .d-flex { flex-direction:column; align-items:flex-start; gap:1rem; }
            .hero-panel .btn { width:100%; }
            .panel-section { border-radius:20px; }
            .stat-card { flex-direction:row; align-items:flex-start; }
            .uplift-card { text-align:center; }
        }
        @media (max-width:575.98px) {
            .topbar-inner { padding:0.65rem 1rem; }
            .topbar-actions { gap:0.5rem; }
            .icon-btn { width:38px; height:38px; }
            .main-content { margin-top:140px; padding:1.5rem 1rem 2rem; }
            .hero-panel { padding:1.25rem; }
            .panel-section { padding:1.1rem; }
            .stat-card { flex-direction:column; align-items:flex-start; gap:0.65rem; }
            .stat-card .icon { width:44px; height:44px; }
            .mobile-nav-card .btn { flex:1 1 48%; min-width:140px; }
            .sidebar { width:min(82vw,320px); }
        }
        @media (max-width:400px) {
            .topbar-meta h1 { font-size:1.2rem; }
            .hero-panel h2 { font-size:1.3rem; }
            .hero-panel p { font-size:0.9rem; }
            .panel-section { padding:1rem; }
            .sidebar { width:85vw; }
            .btn, .btn-brand { width:100%; }
        }
        @media (min-width:1400px) {
            .main-content { padding:3rem 4.25rem 3.5rem; }
        }
    </style>
</head>
<body>
<?php
    $session = session();
    $userFullName = $session->get('full_name') ?: 'User';
    $userEmail = $session->get('email') ?: 'you@example.com';
    $userRole = ucfirst($session->get('role') ?: 'Member');
    $userPhone = $dashboardPhoneDisplay ?? '—';
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
        <?= view('user/partials/main_header', [
            'userFullName' => $userFullName,
        ]) ?>

        <div class="row g-4 mb-4">
            <div class="col-md-3" data-aos="fade-up">
                <div class="stat-card d-flex align-items-center gap-3">
                    <div class="icon"><i class="bi bi-person-badge"></i></div>
                    <div>
                        <p class="text-muted small mb-1">Account Email</p>
                        <p class="mb-0 fw-semibold"><?= esc($userEmail) ?></p>
                        <small class="text-muted"><?= esc($userRole) ?></small>
                    </div>
                </div>
            </div>
            <div class="col-md-3" data-aos="fade-up" data-aos-delay="60">
                <div class="stat-card d-flex align-items-center gap-3">
                    <div class="icon"><i class="bi bi-telephone-outbound"></i></div>
                    <div>
                        <p class="text-muted small mb-1">Phone</p>
                        <p class="mb-0 fw-semibold"><?= esc($userPhone) ?></p>
                        <small class="text-muted">Verified contact</small>
                    </div>
                </div>
            </div>
            <div class="col-md-3" data-aos="fade-up" data-aos-delay="120">
                <div class="stat-card d-flex align-items-center gap-3">
                    <div class="icon"><i class="bi bi-houses"></i></div>
                    <div>
                        <p class="text-muted small mb-1">Listings</p>
                        <p class="mb-0 fw-semibold">Live sync</p>
                        <small class="text-muted">Loaded below</small>
                    </div>
                </div>
            </div>
            <div class="col-md-3" data-aos="fade-up" data-aos-delay="180">
                <div class="stat-card d-flex align-items-center gap-3">
                    <div class="icon"><i class="bi bi-credit-card"></i></div>
                    <div>
                        <p class="text-muted small mb-1">Billing</p>
                        <p class="mb-0 fw-semibold">Manage plan</p>
                        <small class="text-muted">See payments</small>
                    </div>
                </div>
            </div>
        </div>

        <?php if (! empty($referralCode)): ?>
            <div class="panel-section mb-4" data-aos="fade-up">
                <div class="d-flex flex-column flex-md-row align-items-md-center justify-content-between gap-3">
                    <div>
                        <p class="text-uppercase text-muted small mb-1">Your referral code</p>
                        <h5 class="mb-0 fw-semibold"><?= esc($referralCode) ?></h5>
                        <p class="text-muted small mb-0">Share it anywhere—friends get started faster and you earn rewards.</p>
                    </div>
                    <div class="d-flex flex-wrap gap-2">
                        <button type="button" class="btn btn-success btn-sm" data-copy-referral-code="<?= esc($referralCode) ?>">
                            <i class="bi bi-clipboard me-1"></i>Copy Code
                        </button>
                        <?php if (! empty($referralShareUrl)): ?>
                            <button
                                type="button"
                                class="btn btn-outline-success btn-sm share-btn"
                                data-share-url="<?= esc($referralShareUrl) ?>"
                                data-share-title="Share Referral Link"
                                data-share-message="<?= esc('Use my referral code ' . $referralCode) ?>"
                            >
                                <i class="bi bi-share-fill me-1"></i>Share
                            </button>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        <?php endif; ?>

        <section id="section-account" class="panel-section dash-section active" data-aos="fade-up">
            <div class="panel-section-header">
                <div>
                    <p class="text-uppercase text-muted small mb-1">Profile</p>
                    <h4 class="mb-0">Account Settings</h4>
                </div>
                <div class="d-flex gap-2 flex-wrap">
                    <button class="btn btn-outline-success" id="btn-call-back" type="button"><i class="bi bi-telephone-outbound me-2"></i>Contact Support</button>
                </div>
            </div>
            <div class="row g-4 align-items-start">
                <div class="col-xl-4">
                    <div class="uplift-card text-center">
                        <div id="profile-photo-box">
                            <img id="profile-photo-preview" class="profile-avatar mb-3" src="<?= esc($defaultProfileImage) ?>" alt="Profile">
                            <div class="d-flex justify-content-center gap-2 mb-3">
                                <button id="remove-photo-btn" type="button" class="btn btn-sm btn-outline-danger">Remove Photo</button>
                            </div>
                        </div>
                        <p class="mb-0 fw-bold" id="display-fullname"><?= esc($userFullName) ?></p>
                        <p class="text-muted small mb-0" id="display-email"><?= esc($userEmail) ?></p>
                    </div>
                </div>
                <div class="col-xl-8">
                    <form id="account-settings-form" class="needs-validation" novalidate>
                        <div class="row g-3">
                            <div class="col-md-6">
                                <label class="form-label">Full name</label>
                                <input id="full_name" name="full_name" class="form-control" value="<?= esc($userFullName ?: '') ?>" required>
                                <div class="invalid-feedback">Please enter your full name.</div>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Email</label>
                                <input id="email" name="email" type="email" class="form-control" value="<?= esc($userEmail ?: '') ?>" required>
                                <div class="invalid-feedback">Please enter a valid email.</div>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Phone</label>
                                <input id="phone" name="phone" class="form-control" value="<?= esc($dashboardPhoneDisplay ?? '') ?>" readonly>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Profile photo</label>
                                <input id="profile-photo-input" name="photo" type="file" accept="image/*" class="form-control">
                            </div>
                        </div>
                        <div id="agent-extra-fields" class="mt-4 d-none">
                            <div class="row g-3">
                                <div class="col-12">
                                    <label class="form-label">About</label>
                                    <textarea id="about" name="about" class="form-control" rows="3"></textarea>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label">Experience</label>
                                    <input id="experience" name="experience" class="form-control">
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label">Team Members</label>
                                    <input id="team_members" name="team_members" class="form-control">
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label">Office Location</label>
                                    <input id="office_location" name="office_location" class="form-control">
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label">RERA Number</label>
                                    <input id="rera_number" name="rera_number" class="form-control">
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label">Languages (comma separated)</label>
                                    <input id="languages" name="languages" class="form-control">
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label">Specializations</label>
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" value="rental" id="spec_rental" name="specializations[]">
                                        <label class="form-check-label" for="spec_rental">Rental</label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" value="resale" id="spec_resale" name="specializations[]">
                                        <label class="form-check-label" for="spec_resale">Resale</label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" value="new_sale" id="spec_new" name="specializations[]">
                                        <label class="form-check-label" for="spec_new">New Sale</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="mt-4 d-flex gap-2 flex-wrap">
                            <button id="save-profile-btn" type="submit" class="btn btn-brand">Save Profile</button>
                            <button id="cancel-profile-btn" type="button" class="btn btn-outline-secondary">Cancel</button>
                        </div>
                    </form>
                </div>
            </div>
        </section>

        <section id="section-post" class="panel-section dash-section" data-aos="fade-up">
            <div class="panel-section-header">
                <div>
                    <p class="text-uppercase text-muted small mb-1">Listings</p>
                    <h4 class="mb-0">Post Property</h4>
                </div>
                <span class="badge bg-light text-success">Draft experience</span>
            </div>
            <p class="text-muted">Quick form to start posting a property. (Static placeholder — will be connected to backend later)</p>
            <div class="row g-3 mt-2">
                <div class="col-md-6">
                    <label class="form-label">Property Title</label>
                    <input class="form-control" placeholder="e.g. 3BHK apartment in Hyderabad">
                </div>
                <div class="col-md-6">
                    <label class="form-label">Price (INR)</label>
                    <input class="form-control" placeholder="e.g. 5,000,000">
                </div>
                <div class="col-12">
                    <label class="form-label">Short Description</label>
                    <textarea class="form-control" rows="4" placeholder="Short description for your listing"></textarea>
                </div>
            </div>
            <div class="mt-4 d-flex gap-2 flex-wrap">
                <button class="btn btn-brand">Save Draft</button>
                <button class="btn btn-outline-success">Publish (simulate)</button>
            </div>
        </section>

        <section id="section-listings" class="panel-section dash-section" data-aos="fade-up">
            <div class="panel-section-header">
                <div>
                    <p class="text-uppercase text-muted small mb-1">Inventory</p>
                    <h4 class="mb-0">My Listings</h4>
                </div>
                <div class="d-flex gap-2">
                    <button class="btn btn-outline-success" onclick="window.location.href='<?= site_url('post-your-property') ?>'">Add Listing</button>
                </div>
            </div>
            <div id="my-listings" class="row g-3 mt-1">
                <div class="col-12">
                    <div class="alert alert-secondary">Loading your listings...</div>
                </div>
            </div>
        </section>

        <section id="section-messages" class="panel-section dash-section" data-aos="fade-up">
            <div class="panel-section-header">
                <div>
                    <p class="text-uppercase text-muted small mb-1">Inbox</p>
                    <h4 class="mb-0">Messages</h4>
                </div>
            </div>
            <p class="text-muted">All enquiries and messages from potential buyers/agents will show here.</p>
            <div class="list-group">
                <div class="list-group-item text-muted">No messages yet (static)</div>
            </div>
        </section>

        <section id="section-payments" class="panel-section dash-section" data-aos="fade-up">
            <div class="panel-section-header">
                <div>
                    <p class="text-uppercase text-muted small mb-1">Billing</p>
                    <h4 class="mb-0">Payments &amp; Subscriptions</h4>
                </div>
            </div>
            <?php if (! empty($referralCode)): ?>
                <div class="mb-4 p-3 rounded-3" style="border:1px solid rgba(25,135,84,.2); background-color:#f3faf6;">
                    <div class="d-flex flex-wrap align-items-center justify-content-between gap-3">
                        <div>
                            <p class="text-uppercase text-muted small mb-1">Referral Code</p>
                            <h5 class="mb-1 fw-semibold"><?= esc($referralCode) ?></h5>
                            <p class="text-muted small mb-0">Each account keeps a single code you can share with friends. Every referral earns you rewards once they sign up and pay.</p>
                        </div>
                        <div class="d-flex flex-wrap gap-2">
                            <button type="button" class="btn btn-success btn-sm" data-copy-referral-code="<?= esc($referralCode) ?>">
                                <i class="bi bi-clipboard me-1"></i>Copy Code
                            </button>
                            <?php if (! empty($referralShareUrl)): ?>
                                <button
                                    type="button"
                                    class="btn btn-outline-success btn-sm share-btn"
                                    data-share-url="<?= esc($referralShareUrl) ?>"
                                    data-share-title="Share Referral Link"
                                    data-share-message="<?= esc('Use my referral code ' . $referralCode) ?>"
                                >
                                    <i class="bi bi-share-fill me-1"></i>Share
                                </button>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            <?php else: ?>
                <div class="alert alert-warning mb-4">
                    Your referral code is being generated. It will appear here as soon as your profile is fully set up and your payments are synced.
                </div>
            <?php endif; ?>
            <div id="my-subscription" class="mb-3"></div>
            <div class="mb-3">
                <label for="referral-code-input" class="form-label small text-uppercase mb-1">Referral code (optional)</label>
                <div class="input-group input-group-sm">
                    <input id="referral-code-input" type="text" class="form-control" maxlength="32" placeholder="Enter referral code">
                    <span class="input-group-text small" id="referral-code-status">Referral discounts apply on your first subscription only.</span>
                </div>
            </div>
            <h6>Available Subscriptions</h6>
            <div id="subscriptions-list" class="row g-3 mt-2"></div>
        </section>

        <div class="mobile-nav-card card p-2 d-lg-none" data-aos="fade-up">
            <div class="d-flex flex-wrap gap-2">
                <button class="btn btn-light flex-fill" data-target="section-account">Account</button>
                <a class="btn btn-light flex-fill" href="<?= site_url('post-your-property') ?>">Post</a>
                <button class="btn btn-light flex-fill" data-target="section-listings">Listings</button>
                <button class="btn btn-light flex-fill" data-target="section-messages">Messages</button>
                <button class="btn btn-light flex-fill" data-target="section-payments">Payments</button>
            </div>
        </div>
    </main>
</div>

    <div class="modal fade share-modal" id="shareModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <div>
                        <p class="text-uppercase text-muted small mb-1">Share Referral</p>
                        <h5 class="modal-title share-property-title mb-0">Share Referral Link</h5>
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

<?= $this->include('layouts/modal') ?>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/aos@2.3.4/dist/aos.js"></script>
<script>
(function(){
    const sidebar = document.getElementById('user-sidebar');
    const toggler = document.getElementById('sidebar-toggler');
    const backdrop = document.getElementById('sidebar-backdrop');
    const backBtn = document.getElementById('dashboard-back-btn');
    const body = document.body;

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
    backBtn?.addEventListener('click', function(){
        if (window.history.length > 1) {
            window.history.back();
        } else {
            window.location.href = '<?= site_url('/') ?>';
        }
    });
    window.addEventListener('resize', () => {
        if (window.innerWidth >= 992) setSidebarState(false);
    });
    window.AOS?.init({ duration:600, once:true });
})();
</script>

<script>
// Simple client-side tab switcher for static dashboard
        document.addEventListener('click', function(e){
            const t = e.target.closest('[data-target]');
            if(!t) return;
            const target = t.getAttribute('data-target');
            if(!target) return;
            // deactivate nav links
            document.querySelectorAll('.dash-nav .nav-link').forEach(n=>n.classList.remove('active'));
            // activate matching left nav link if exists
            const leftLink = document.querySelector('.dash-nav [data-target="'+target+'"]');
            if(leftLink) leftLink.classList.add('active');
            // mobile buttons highlight
            document.querySelectorAll('.card .btn[data-target]').forEach(b=>b.classList.remove('btn-primary'));
            // show section
            document.querySelectorAll('.dash-section').forEach(s=>s.classList.remove('active'));
            const section = document.getElementById(target);
            if(section) section.classList.add('active');
            window.scrollTo({ top: 180, behavior: 'smooth' });
            e.preventDefault();
        }, false);
    </script>

    <script>
    // fetchMyListings: load /api/property/my and render cards into #my-listings
    (function(){
        const LISTINGS_CONTAINER_ID = 'my-listings';
        const DETAIL_PAGE_URL = '<?= site_url('property') ?>';

        function safeJson(resp){ return resp.json().catch(()=>({})); }

        function formatPrice(v){
            if (v === null || v === undefined || v === '' || v === 'N/A') return 'N/A';
            const num = Number(String(v).replace(/[^0-9.-]+/g,''));
            if (Number.isNaN(num)) return v;
            return new Intl.NumberFormat('en-IN').format(num);
        }

        function createCardHTML(property){
            const media = (property.media && property.media.length && (property.media[0].file_url || property.media[0].file)) ? (property.media[0].file_url || property.media[0].file) : '<?= base_url("images/placeholder.png") ?>';
            const rawPrice = property.price ?? (property.pricing && property.pricing.price) ?? (property.details && property.details.price) ?? null;
            const price = rawPrice ? formatPrice(rawPrice) : 'N/A';
            // Prefer `property_name` stored on properties_new, then details.title, then fallbacks
            const title = property.property_name || (property.details && property.details.title) || property.property_type || property.property_category || 'Property';
            const status = property.status || 'N/A';

            // store encoded title and raw price as data attributes for edit dialog
            const encodedTitle = encodeURIComponent(title);
            const dataPrice = rawPrice !== null && rawPrice !== undefined ? rawPrice : '';

            return `
                <div class="col-12 listing-item" data-id="${property.id}" data-title="${encodedTitle}" data-price="${dataPrice}">
                    <div class="d-flex align-items-center justify-content-between border p-3 rounded">
                        <div>
                            <h6 class="mb-1">${escapeHtml(title)}</h6>
                            <small class="text-muted">₹ ${price} ${property.locality ? '• ' + escapeHtml(property.locality) : ''}</small>
                        </div>
                        <div class="d-flex gap-2">
                            <a class="btn btn-sm btn-outline-primary btn-edit" href="#" data-id="${property.id}">Edit</a>
                            <button class="btn btn-sm btn-outline-danger btn-delete">Delete</button>
                        </div>
                    </div>
                </div>`;
        }

        async function fetchMyListings(){
            const container = document.getElementById(LISTINGS_CONTAINER_ID);
            if (!container) return;
            container.innerHTML = '<div class="col-12"><div class="alert alert-secondary">Loading your listings...</div></div>';

            try{
                const resp = await fetch('<?= site_url("api/property/my") ?>', { headers: { 'Accept':'application/json' }, credentials: 'same-origin' });
                if (!resp.ok){
                    if (resp.status === 401 || resp.status === 403){
                        container.innerHTML = '<div class="col-12"><div class="alert alert-warning">Please log in to view your listings.</div></div>';
                        return;
                    }
                    container.innerHTML = `<div class="col-12"><div class="alert alert-danger">Failed to load listings (status ${resp.status}).</div></div>`;
                    return;
                }

                const json = await safeJson(resp);
                const listings = json.data || [];

                if (!Array.isArray(listings) || listings.length === 0){
                    container.innerHTML = '<div class="col-12"><div class="alert alert-info">You have no listings yet. Post a property to see it here.</div></div>';
                    return;
                }

                container.innerHTML = '';
                for (const p of listings){
                    container.insertAdjacentHTML('beforeend', createCardHTML(p));
                }

            }catch(err){
                console.error('fetchMyListings error', err);
                container.innerHTML = '<div class="col-12"><div class="alert alert-danger">An error occurred while loading listings.</div></div>';
            }
        }

        // Helper to escape HTML for inserting into SweetAlert inputs
        function escapeHtml(str){
            return String(str || '').replace(/[&<>"']/g, function(c){
                return ({'&':'&amp;','<':'&lt;','>':'&gt;','"':'&quot;','\'':'&#39;'})[c];
            });
        }

        // Event delegation for delete and edit buttons
        document.addEventListener('click', async function(e){
            // Delete flow
            const delBtn = e.target.closest('.btn-delete');
            if (delBtn) {
                const row = delBtn.closest('[data-id]');
                const id = row?.dataset?.id;
                if (!id) return;

                const ok = await Swal.fire({ title: 'Delete this property?', text: 'This action cannot be undone.', icon: 'warning', showCancelButton: true, confirmButtonText: 'Delete' });
                if (!ok.isConfirmed) return;

                try{
                    const del = await fetch('<?= site_url("api/property") ?>/'+id, { method: 'DELETE', credentials: 'same-origin', headers: { 'Accept':'application/json' } });
                    if (del.ok){
                        Swal.fire({ icon: 'success', title: 'Deleted', timer:900, showConfirmButton:false });
                        await fetchMyListings();
                    } else {
                        const body = await del.json().catch(()=>({}));
                        Swal.fire('Error', body.message || 'Failed to delete property', 'error');
                    }
                }catch(err){
                    console.error('delete error', err);
                    Swal.fire('Error', 'Network error while deleting', 'error');
                }

                return;
            }

            // Edit flow - open SweetAlert2 input dialog for simple edits
            const editBtn = e.target.closest('.btn-edit');
            if (editBtn) {
                e.preventDefault();
                const id = editBtn.dataset.id || editBtn.closest('[data-id]')?.dataset?.id;
                if (!id) return;

                // Find the full property object from the listings container if present
                const row = document.querySelector('[data-id="' + id + '"]');
                const rawTitle = row ? (row.querySelector('h6')?.textContent || '') : '';
                const rawPrice = row ? (row.dataset.price || '') : '';
                const rawLocality = row ? (row.querySelector('small')?.textContent.split('•')[1]?.trim() || '') : '';

                const { value: formValues } = await Swal.fire({
                    title: 'Edit listing',
                    html:
                        '<input id="swal-title" class="swal2-input" placeholder="Property Name" value="' + escapeHtml(rawTitle) + '">' +
                        '<input id="swal-price" type="number" class="swal2-input" placeholder="Price" value="' + escapeHtml(rawPrice) + '">' +
                        '<input id="swal-locality" class="swal2-input" placeholder="Locality" value="' + escapeHtml(rawLocality) + '">' +
                        '<select id="swal-status" class="swal2-select" style="margin-top:6px;padding:8px;border-radius:6px;border:1px solid #e6e6e6;width:100%">' +
                            '<option value="draft">Draft</option>' +
                            '<option value="published">Published</option>' +
                        '</select>',
                    focusConfirm: false,
                    preConfirm: () => {
                        return {
                            property_name: document.getElementById('swal-title').value.trim(),
                            price: document.getElementById('swal-price').value.trim(),
                            locality: document.getElementById('swal-locality').value.trim(),
                            status: document.getElementById('swal-status').value
                        };
                    },
                    didOpen: () => {
                        // set current status if available
                        (async function(){
                            try{
                                const resp = await fetch('<?= site_url("api/property") ?>/' + id, { credentials:'same-origin' });
                                if (!resp.ok) return;
                                const j = await resp.json().catch(()=>null);
                                const p = j && j.post ? j.post : (j && j.data ? j.data : null);
                                if (p && p.status) document.getElementById('swal-status').value = p.status;
                            }catch(e){}
                        })();
                    }
                });

                if (!formValues) return;

                try {
                    const payload = {};
                    if (formValues.property_name) payload.property_name = formValues.property_name;
                    if (formValues.locality) payload.locality = formValues.locality;
                    if (formValues.status) payload.status = formValues.status;
                    if (formValues.price !== undefined && formValues.price !== '') payload.price = formValues.price;

                    const upd = await fetch('<?= site_url("api/property") ?>/'+id, {
                        method: 'PUT',
                        credentials: 'same-origin',
                        headers: { 'Content-Type': 'application/json', 'Accept':'application/json' },
                        body: JSON.stringify(payload)
                    });

                    if (upd.ok) {
                        Swal.fire('Saved', 'Listing updated', 'success');
                        await fetchMyListings();
                    } else {
                        const body = await upd.json().catch(()=>({}));
                        Swal.fire('Error', body.message || 'Failed to update listing', 'error');
                    }
                } catch (err) {
                    console.error('update error', err);
                    Swal.fire('Error', 'Network error while updating', 'error');
                }
            }

            const listingRow = e.target.closest('.listing-item');
            if (listingRow && !e.target.closest('.btn-edit') && !e.target.closest('.btn-delete')) {
                const propertyId = listingRow.dataset.id;
                if (propertyId && DETAIL_PAGE_URL) {
                    window.location.href = DETAIL_PAGE_URL + '?id=' + encodeURIComponent(propertyId);
                }
            }
        });

        // Initialize robustly
        if (document.readyState === 'loading') {
            document.addEventListener('DOMContentLoaded', fetchMyListings);
        } else {
            fetchMyListings();
        }
    })();
    </script>

    <script src="https://checkout.razorpay.com/v1/checkout.js"></script>
    <script>
    (function(){
        const LIST = document.getElementById('subscriptions-list');
        const MY = document.getElementById('my-subscription');
        const REFERRAL_INPUT = document.getElementById('referral-code-input');
        const REFERRAL_STATUS = document.getElementById('referral-code-status');
        const MY_REFERRAL_CODE = '<?= esc($referralCode ?? '') ?>';
        const SUBSCRIBE_URL = '<?= site_url('api/subscriptions/subscribe') ?>';
        const ORDER_URL = '<?= site_url('api/subscriptions/order') ?>';

        const escapeHtml = (value) => String(value || '').replace(/[&<>"']/g, function(c){ return {'&':'&amp;','<':'&lt;','>':'&gt;','"':'&quot;','\'':'&#39;'}[c]; });
        const escapeAttr = (value) => String(value || '').replace(/"/g, '&quot;');

        const updateReferralAvailability = (canUse) => {
            if (REFERRAL_INPUT) {
                REFERRAL_INPUT.disabled = !canUse;
            }
            if (REFERRAL_STATUS) {
                REFERRAL_STATUS.textContent = canUse
                    ? 'Referral discounts apply on your first subscription only.'
                    : 'Referral codes are no longer available for this account.';
                REFERRAL_STATUS.classList.toggle('text-success', canUse);
                REFERRAL_STATUS.classList.toggle('text-muted', !canUse);
            }
        };

        updateReferralAvailability(true);

        async function fetchOrder(subscriptionId, referralCodeValue){
            const payload = new FormData();
            payload.append('subscription_id', subscriptionId);
            if (referralCodeValue) {
                payload.append('referral_code', referralCodeValue);
            }

            const resp = await fetch(ORDER_URL, { method: 'POST', credentials: 'same-origin', body: payload });
            const json = await resp.json().catch(()=>null);
            if (!resp.ok) {
                Swal.fire('Error', json?.message || 'Unable to initiate payment', 'error');
                throw new Error('order_failed');
            }
            return json;
        }

        async function finalizeSubscription(subscriptionId, referralCodeValue, paymentInfo){
            const payload = new FormData();
            payload.append('subscription_id', subscriptionId);
            if (referralCodeValue) payload.append('referral_code', referralCodeValue);
            if (paymentInfo?.method) payload.append('payment_method', paymentInfo.method);
            if (paymentInfo?.reference) payload.append('payment_reference', paymentInfo.reference);
            if (paymentInfo?.order_id) payload.append('payment_order_id', paymentInfo.order_id);
            if (paymentInfo?.signature) payload.append('payment_signature', paymentInfo.signature);

            try {
                const resp = await fetch(SUBSCRIBE_URL, { method:'POST', credentials:'same-origin', body: payload });
                const json = await resp.json().catch(()=>null);
                if (!resp.ok) {
                    Swal.fire('Error', json?.message || 'Unable to activate subscription', 'error');
                    return false;
                }
                const discountText = json?.discount_applied ? ` • Discount ₹${json.discount_amount}` : '';
                Swal.fire('Subscribed', 'Subscription active' + discountText, 'success');
                updateReferralAvailability(false);
                if (REFERRAL_INPUT) {
                    REFERRAL_INPUT.value = '';
                }
                await loadMySubscription();
                return true;
            } catch (err) {
                console.error('finalize subscription error', err);
                Swal.fire('Error', 'Network error while saving your subscription', 'error');
                return false;
            }
        }

        function openRazorpayCheckout(orderData, planName, subscriptionId, referralCodeValue){
            if (!window.Razorpay) {
                Swal.fire('Payment error', 'Razorpay checkout is unavailable right now.', 'error');
                throw new Error('razorpay_unavailable');
            }

            return new Promise((resolve, reject)=>{
                const prefillData = {
                    name: '<?= esc($userFullName) ?>',
                    email: '<?= esc($userEmail) ?>',
                    contact: '<?= esc($userPhone !== '—' ? $userPhone : '') ?>'
                };

                const options = {
                    key: orderData.razorpay_key,
                    amount: orderData.amount,
                    currency: orderData.currency,
                    name: '36 Broking Hub',
                    description: planName,
                    image: '<?= base_url('images/36_profile.png') ?>',
                    order_id: orderData.order_id,
                    handler: async function(response){
                        try {
                            const success = await finalizeSubscription(subscriptionId, referralCodeValue, {
                                method: 'razorpay',
                                reference: response.razorpay_payment_id,
                                order_id: response.razorpay_order_id,
                                signature: response.razorpay_signature,
                            });
                            success ? resolve() : reject(new Error('finalize_failed'));
                        } catch (err) {
                            reject(err);
                        }
                    },
                    prefill: prefillData,
                    notes: {
                        plan: planName,
                        user_id: '<?= esc(session()->get('user_id')) ?>'
                    },
                    theme: {
                        color: '#3399cc'
                    }
                };

                const checkout = new Razorpay(options);
                checkout.on('payment.failed', function (response){
                    Swal.fire('Payment failed', response.error.description || 'Your payment could not be completed', 'error');
                    reject(new Error('payment_failed'));
                });
                checkout.open();
            });
        }

        async function startSubscriptionFlow(button, subscriptionId, planName, referralCodeValue){
            if (button) {
                button.disabled = true;
                button.dataset.originalLabel = button.dataset.originalLabel || button.innerHTML;
                button.innerHTML = 'Processing...';
            }
            try {
                const orderData = await fetchOrder(subscriptionId, referralCodeValue);
                if (!orderData.requires_payment) {
                    await finalizeSubscription(subscriptionId, referralCodeValue, {
                        method: 'manual',
                        reference: `free-${Date.now()}`,
                    });
                    return;
                }
                await openRazorpayCheckout(orderData, planName, subscriptionId, referralCodeValue);
            } catch (err) {
                const ignored = ['order_failed', 'razorpay_unavailable', 'payment_cancelled', 'finalize_failed'];
                if (!ignored.includes(err?.message)) {
                    console.error('Subscription flow error', err);
                    Swal.fire('Error', 'Something went wrong while placing the order.', 'error');
                }
            } finally {
                if (button) {
                    button.disabled = false;
                    button.innerHTML = button.dataset.originalLabel || button.innerHTML;
                }
            }
        }

        async function loadSubscriptions(){
            if (!LIST) return;
            LIST.innerHTML = '<div class="col-12"><div class="alert alert-secondary">Loading subscriptions...</div></div>';
            try{
                const resp = await fetch('<?= site_url('api/subscriptions') ?>', { credentials: 'same-origin' });
                if (!resp.ok) return LIST.innerHTML = '<div class="col-12"><div class="alert alert-danger">Failed to load subscriptions.</div></div>';
                const json = await resp.json().catch(()=>({}));
                const subs = json.data || [];
                if (!subs.length) return LIST.innerHTML = '<div class="col-12"><div class="alert alert-info">No subscriptions available.</div></div>';
                LIST.innerHTML = '';
                subs.forEach(s=>{
                    const priceValue = Number(s.price) || 0;
                    const html = `
                        <div class="col-md-4">
                            <div class="card p-3">
                                <h6 class="mb-1">${escapeHtml(s.name)}</h6>
                                <p class="mb-2 small text-muted">${escapeHtml(s.description || '')}</p>
                                <div class="d-flex justify-content-between align-items-center">
                                    <div><strong>₹ ${priceValue}</strong><div class="small text-muted">for ${escapeHtml(s.duration_days)}</div></div>
                                    <div><button class="btn btn-sm btn-success btn-subscribe" data-id="${s.id}" data-plan-name="${escapeAttr(s.name)}">Subscribe</button></div>
                                </div>
                            </div>
                        </div>`;
                    LIST.insertAdjacentHTML('beforeend', html);
                });

                document.querySelectorAll('.btn-subscribe').forEach(b=> b.addEventListener('click', async function(){
                    const id = this.dataset.id;
                    const planName = this.dataset.planName || 'Subscription';
                    const prompt = await Swal.fire({
                        title: 'Referral code (optional)',
                        text: 'Enter a referral code to apply your first-time discount, or leave blank to continue.',
                        input: 'text',
                        inputPlaceholder: 'Referral code',
                        inputValue: REFERRAL_INPUT?.value || '',
                        showCancelButton: true,
                        confirmButtonText: 'Continue to subscribe',
                    });
                    if (!prompt.isConfirmed) return;
                    const referralCodeValue = prompt.value?.trim();
                    if (referralCodeValue && MY_REFERRAL_CODE && referralCodeValue.toLowerCase() === MY_REFERRAL_CODE.toLowerCase()) {
                        Swal.fire('Oops', 'You cannot use your own referral code.', 'warning');
                        return;
                    }
                    await startSubscriptionFlow(this, id, planName, referralCodeValue || '');
                }));

            }catch(err){ console.error('load subscriptions error', err); LIST.innerHTML = '<div class="col-12"><div class="alert alert-danger">Error loading subscriptions</div></div>'; }
        }

        async function loadMySubscription(){
            if (!MY) return;
            MY.innerHTML = '<div class="alert alert-secondary">Checking your subscription...</div>';
            try{
                const resp = await fetch('<?= site_url('api/subscriptions/status') ?>', { credentials: 'same-origin' });
                const j = await resp.json().catch(()=>({}));
                if (j && j.active_subscription) {
                    const sub = j.active_subscription;
                    const s = sub.subscription || {};
                    MY.innerHTML = `<div class="alert alert-success">Active: <strong>${s.name || 'Subscription'}</strong> — Expires in ${j.days_left || 0} day(s) (ends ${sub.expires_at})</div>`;
                } else {
                    let msg = '<div class="alert alert-info">No active subscription.</div>';
                    if (j && j.reason === 'agent_must_subscribe') msg = '<div class="alert alert-warning">Agents must subscribe to post properties.</div>';
                    if (j && j.reason === 'cooldown') msg = '<div class="alert alert-warning">You can post again after ' + (j.days_left||0) + ' day(s) without subscribing, or purchase a subscription to post now.</div>';
                    MY.innerHTML = msg;
                }
                updateReferralAvailability(Boolean(j.can_use_referral));
            }catch(err){ console.error('loadMySubscription error', err); MY.innerHTML = '<div class="alert alert-danger">Error checking subscription</div>'; updateReferralAvailability(false); }
        }

        // init
        if (document.readyState === 'loading') document.addEventListener('DOMContentLoaded', function(){ loadSubscriptions(); loadMySubscription(); });
        else { loadSubscriptions(); loadMySubscription(); }
    })();
    </script>

    <script>
    (function(){
        const shareModalEl = document.getElementById('shareModal');
        if (!shareModalEl) return;

        const shareModalInstance = new bootstrap.Modal(shareModalEl);
        const shareTitleEl = shareModalEl.querySelector('.share-property-title');
        const shareLinkInput = document.getElementById('shareLinkInput');
        const copyShareBtn = document.getElementById('copyShareLink');

        const shareTargets = {
            whatsapp: document.getElementById('shareWhatsApp'),
            facebook: document.getElementById('shareFacebook'),
            instagram: document.getElementById('shareInstagram'),
            x: document.getElementById('shareX'),
            linkedin: document.getElementById('shareLinkedIn'),
        };

        function openShareModal(url, title = 'Share Link', message = null) {
            if (!shareModalInstance || !shareLinkInput) return;
            const cleanUrl = url || window.location.href;
            shareLinkInput.value = cleanUrl;
            if (shareTitleEl) shareTitleEl.textContent = title;

            const shareMessage = message || title;
            const encodedUrl = encodeURIComponent(cleanUrl);
            const encodedMessage = encodeURIComponent(`${shareMessage} - ${cleanUrl}`);

            shareTargets.whatsapp && (shareTargets.whatsapp.href = `https://wa.me/?text=${encodedMessage}`);
            shareTargets.facebook && (shareTargets.facebook.href = `https://www.facebook.com/sharer/sharer.php?u=${encodedUrl}`);
            shareTargets.instagram && (shareTargets.instagram.href = `https://www.instagram.com/?url=${encodedUrl}`);
            shareTargets.x && (shareTargets.x.href = `https://twitter.com/intent/tweet?text=${encodedMessage}`);
            shareTargets.linkedin && (shareTargets.linkedin.href = `https://www.linkedin.com/sharing/share-offsite/?url=${encodedUrl}`);

            shareModalInstance.show();
        }

        document.addEventListener('click', function(event){
            const trigger = event.target.closest('.share-btn[data-share-url]');
            if (!trigger) return;
            event.preventDefault();
            event.stopPropagation();

            const shareUrl = trigger.getAttribute('data-share-url');
            const shareTitle = trigger.getAttribute('data-share-title') || 'Share Link';
            const shareMessage = trigger.getAttribute('data-share-message') || shareTitle;

            openShareModal(shareUrl, shareTitle, shareMessage);
        });

        if (copyShareBtn && shareLinkInput) {
            copyShareBtn.addEventListener('click', async () => {
                const link = shareLinkInput.value;
                if (!link) return;
                try {
                    if (navigator.clipboard?.writeText) {
                        await navigator.clipboard.writeText(link);
                    } else {
                        shareLinkInput.focus();
                        shareLinkInput.select();
                        document.execCommand('copy');
                        shareLinkInput.blur();
                    }
                    copyShareBtn.textContent = 'Copied!';
                    setTimeout(() => { copyShareBtn.textContent = 'Copy Link'; }, 1500);
                } catch (error) {
                    console.error('Copy failed', error);
                }
            });
        }
    })();
    </script>

    <script>
    // Account Settings: load current profile, preview image, and submit via AJAX
    (function(){
        const API = '<?= site_url("api/profile") ?>';
        const form = document.getElementById('account-settings-form');
        if (!form) return;

        const photoInput = document.getElementById('profile-photo-input');
        const preview = document.getElementById('profile-photo-preview');
        const agentFields = document.getElementById('agent-extra-fields');
        const displayFullname = document.getElementById('display-fullname');
        const displayEmail = document.getElementById('display-email');

        let currentProfile = null;

        function setAgentVisibility(show){
            if (show) agentFields.classList.remove('d-none');
            else agentFields.classList.add('d-none');
        }

        function makeInitialsSvg(name){
            const parts = (name || '').trim().split(/\s+/).filter(Boolean);
            let initials = '';
            if (parts.length === 0) initials = 'U';
            else if (parts.length === 1) initials = parts[0].substring(0,1).toUpperCase();
            else initials = (parts[0].substring(0,1) + parts[1].substring(0,1)).toUpperCase();

            const bg = '#f2fbf6';
            const fg = '#198754';
            const svg = `<svg xmlns='http://www.w3.org/2000/svg' width='200' height='200'>
                <rect width='100%' height='100%' fill='${bg}'/>
                <text x='50%' y='50%' dy='.08em' text-anchor='middle' font-family='Inter, system-ui, -apple-system, "Segoe UI", Roboto, Arial' font-size='84' fill='${fg}'>${initials}</text>
            </svg>`;
            return 'data:image/svg+xml;utf8,' + encodeURIComponent(svg);
        }

        function populateForm(data){
            if (!data) return;
            const user = data.user || {};
            const profile = data.profile || {};
            const extra = data.extra || {};

            document.getElementById('full_name').value = user.full_name || '';
            document.getElementById('email').value = user.email || '';
            document.getElementById('phone').value = user.phone_number || '';
            displayFullname.textContent = user.full_name || displayFullname.textContent;
            displayEmail.textContent = user.email || displayEmail.textContent;

            if (profile.photo_url) {
                preview.src = profile.photo_url;
            } else {
                // generate initials SVG as fallback
                const initialsSrc = makeInitialsSvg(user.full_name || displayFullname.textContent || 'User');
                preview.src = initialsSrc;
            }

            // Show agent fields if role indicates agent or if extra data exists
            const role = user.role || ('<?= session()->get('role') ?>' || 'user');
            if (role === 'agent' || Object.keys(extra).length > 0) {
                setAgentVisibility(true);
                document.getElementById('about').value = extra.about || '';
                document.getElementById('experience').value = extra.experience || '';
                document.getElementById('team_members').value = extra.team_members || '';
                document.getElementById('office_location').value = extra.office_location || '';
                document.getElementById('rera_number').value = extra.rera_number || '';
                document.getElementById('languages').value = Array.isArray(extra.languages) ? extra.languages.join(', ') : (extra.languages || '');
                // specializations checkboxes
                const specs = Array.isArray(extra.specializations) ? extra.specializations : (typeof extra.specializations === 'string' ? [extra.specializations] : (extra.specializations || []));
                ['rental','resale','new_sale'].forEach(k=>{
                    const el = document.getElementById('spec_' + (k==='new_sale' ? 'new' : k));
                    if (el) el.checked = specs.indexOf(k) !== -1;
                });
            } else {
                setAgentVisibility(false);
            }
        }

        async function loadProfile(){
            try{
                const resp = await fetch(API, { credentials: 'same-origin', headers: { 'Accept': 'application/json' } });
                if (!resp.ok) {
                    console.warn('Failed to load profile', resp.status);
                    return;
                }
                const json = await resp.json().catch(()=>null);
                if (!json) return;
                currentProfile = json;
                populateForm(json);
            }catch(err){ console.error('loadProfile', err); }
        }

        // Image preview
        photoInput.addEventListener('change', function(){
            const f = this.files && this.files[0];
            if (!f) return;
            const reader = new FileReader();
            reader.onload = function(e){ preview.src = e.target.result; };
            reader.readAsDataURL(f);
        });

        // Remove photo button
        const removeBtn = document.getElementById('remove-photo-btn');
        if (removeBtn) {
            removeBtn.addEventListener('click', async function(){
                const ok = await Swal.fire({ title: 'Remove profile photo?', text: 'This will delete your profile photo.', icon: 'warning', showCancelButton: true, confirmButtonText: 'Remove' });
                if (!ok.isConfirmed) return;
                try{
                    const resp = await fetch(API + '/delete-photo', { method: 'POST', credentials: 'same-origin', headers: { 'Accept':'application/json' } });
                    const json = await resp.json().catch(()=>null);
                    if (!resp.ok) {
                        Swal.fire('Error', (json && json.error) ? json.error : 'Failed to remove photo', 'error');
                        return;
                    }
                    // reset preview to initials
                    const name = document.getElementById('full_name').value || displayFullname.textContent || 'User';
                    preview.src = makeInitialsSvg(name);
                    // clear file input
                    photoInput.value = '';
                    Swal.fire({ icon: 'success', title: 'Removed', text: (json && json.message) ? json.message : 'Profile photo removed' });
                }catch(err){
                    console.error('remove photo', err);
                    Swal.fire('Error', 'Network error while removing photo', 'error');
                }
            });
        }

        // Form validation and submit
        form.addEventListener('submit', async function(e){
            e.preventDefault();
            form.classList.add('was-validated');
            if (!form.checkValidity()) return;

            const fd = new FormData();
            fd.append('full_name', document.getElementById('full_name').value.trim());
            fd.append('email', document.getElementById('email').value.trim());
            const photoFile = photoInput.files && photoInput.files[0];
            if (photoFile) fd.append('photo', photoFile);

            // If agent fields visible, append them
            if (!agentFields.classList.contains('d-none')){
                const about = document.getElementById('about').value.trim(); if (about) fd.append('about', about);
                const experience = document.getElementById('experience').value.trim(); if (experience) fd.append('experience', experience);
                const team = document.getElementById('team_members').value.trim(); if (team) fd.append('team_members', team);
                const office = document.getElementById('office_location').value.trim(); if (office) fd.append('office_location', office);
                const rera = document.getElementById('rera_number').value.trim(); if (rera) fd.append('rera_number', rera);
                const langs = document.getElementById('languages').value.trim(); if (langs) {
                    // store as array
                    const arr = langs.split(',').map(s=>s.trim()).filter(Boolean);
                    fd.append('languages', JSON.stringify(arr));
                }
                const specs = Array.from(document.querySelectorAll('input[name="specializations[]"]:checked')).map(i=>i.value);
                if (specs.length) fd.append('specializations', JSON.stringify(specs));
            }

            try{
                const resp = await fetch(API, { method: 'POST', credentials: 'same-origin', body: fd });
                const json = await resp.json().catch(()=>null);
                if (!resp.ok) {
                    Swal.fire('Error', (json && json.error) ? json.error : 'Failed to update profile', 'error');
                    return;
                }
                Swal.fire({ icon: 'success', title: 'Saved', text: (json && json.message) ? json.message : 'Profile updated' });
                // refresh profile
                await loadProfile();
            }catch(err){
                console.error('submit profile', err);
                Swal.fire('Error', 'Network error while saving profile', 'error');
            }
        });

        // Cancel action: reload last saved
        document.getElementById('cancel-profile-btn').addEventListener('click', function(){
            if (currentProfile) populateForm(currentProfile);
        });

        // Init
        if (document.readyState === 'loading') document.addEventListener('DOMContentLoaded', loadProfile);
        else loadProfile();
    })();
    </script>

    <script>
    (function(){
        const copyText = async (value, button, label) => {
            if (!value || !button) return;
            const original = button.dataset.originalLabel || button.innerHTML;
            button.dataset.originalLabel = original;

            const showCopied = () => {
                button.innerHTML = '<i class="bi bi-clipboard-check me-1"></i>' + label;
                setTimeout(() => { button.innerHTML = button.dataset.originalLabel; }, 1600);
            };

            const fallbackCopy = () => {
                const textarea = document.createElement('textarea');
                textarea.style.position = 'fixed';
                textarea.style.opacity = '0';
                textarea.value = value;
                document.body.appendChild(textarea);
                textarea.select();
                document.execCommand('copy');
                document.body.removeChild(textarea);
                showCopied();
            };

            if (navigator.clipboard && navigator.clipboard.writeText) {
                try {
                    await navigator.clipboard.writeText(value);
                    showCopied();
                } catch (err) {
                    fallbackCopy();
                }
            } else {
                fallbackCopy();
            }
        };

        document.addEventListener('click', function(e){
            const copyCodeBtn = e.target.closest('[data-copy-referral-code]');
            if (copyCodeBtn) {
                e.preventDefault();
                copyText(copyCodeBtn.dataset.copyReferralCode, copyCodeBtn, 'Code Copied');
            }
        });
    })();
    </script>

</body>
</html>
