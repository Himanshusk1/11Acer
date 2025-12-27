<?php
$page_title = '11 Acer | Agents';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <?php include 'assets/includes/seo-meta.php'; ?>
    <?= csrf_meta() ?>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="<?= base_url('CSS/style.css') ?>">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="<?= base_url('CSS/home.css') ?>">
    <link rel="stylesheet" href="<?= base_url('CSS/agents.css') ?>">
    <link rel="stylesheet" href="<?= base_url('CSS/responsive.css') ?>">
    <link rel="icon" type="image/x-icon" href="<?= base_url('images/favicon/favicon.ico') ?>">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/aos@2.3.4/dist/aos.css">
    <style>
        :root {
            --bh-green: #198754;
            --bh-muted: #5c6c63;
            --bh-soft: #f2f8f4;
        }
        body { font-family: 'Inter', sans-serif; background-color: #f7faf8; }
        .agents-hero {
            position: relative;
            background: linear-gradient(135deg, rgba(25,135,84,0.08), rgba(25,135,84,0.03));
            padding: clamp(3rem, 8vw, 5rem) 0;
            overflow: hidden;
        }
        .agents-hero::before,
        .agents-hero::after {
            content: '';
            position: absolute;
            border-radius: 50%;
            filter: blur(80px);
            background: rgba(25,135,84,0.19);
        }
        .agents-hero::before { width: 260px; height: 260px; top: -60px; left: -70px; }
        .agents-hero::after { width: 320px; height: 320px; bottom: -90px; right: 0; }
        .hero-card {
            background: #fff;
            border-radius: 28px;
            padding: 2rem;
            box-shadow: 0 35px 80px rgba(19, 44, 31, 0.12);
            position: relative;
            z-index: 2;
        }
        .hero-search {
            background: #fff;
            border-radius: 999px;
            padding: 0.5rem 0.5rem 0.5rem 1.2rem;
            box-shadow: 0 20px 40px rgba(25, 135, 84, 0.12);
        }
        .hero-search input {
            border: none;
            outline: none;
            flex: 1;
        }
        .hero-search .btn-brand {
            border-radius: 999px;
            padding-inline: 1.5rem;
        }
        .btn-brand {
            background: var(--bh-green);
            color: #fff;
            font-weight: 600;
            border: none;
            border-radius: 14px;
            transition: transform 0.2s ease, box-shadow 0.2s ease;
        }
        .btn-brand:hover { transform: translateY(-2px); box-shadow: 0 12px 28px rgba(25,135,84,0.35); }
        .filter-panel {
            margin-top: -3.5rem;
            position: relative;
            z-index: 3;
        }
        .filter-card {
            background: #fff;
            border-radius: 20px;
            padding: 1.5rem;
            box-shadow: 0 25px 50px rgba(20, 41, 30, 0.08);
        }
        .filter-card .form-select,
        .filter-card .form-control {
            border-radius: 14px;
            border: 1px solid #dfe7e2;
            padding: 0.75rem 1rem;
        }
        .filter-card label { font-size: 0.85rem; color: #5f6c62; margin-bottom: 0.15rem; }
        .filter-card .sort-select { border-left: 1px dashed #dbe3de; }
        .agents-wrapper { padding-top: 3rem; }
        .agent-card {
            background: #fff;
            border-radius: 24px;
            padding: 1.75rem;
            box-shadow: 0 25px 55px rgba(16, 26, 20, 0.08);
            border: 1px solid transparent;
            transition: transform 0.2s ease, box-shadow 0.2s ease, border-color 0.3s;
        }
        .agent-card:hover { transform: translateY(-6px); box-shadow: 0 35px 70px rgba(19, 39, 28, 0.14); border-color: rgba(25,135,84,0.25); }
        .agent-avatar {
            width: 64px;
            height: 64px;
            border-radius: 50%;
            background: var(--bh-soft);
            color: var(--bh-green);
            font-weight: 700;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.1rem;
        }
        .agent-avatar-img { width:64px; height:64px; object-fit:cover; border-radius:50%; display:inline-block; }
        .verified-badge {
            color: var(--bh-green);
            font-size: 0.9rem;
        }
        .agent-rating { color: #f4b000; font-weight: 600; }
        .agent-meta .badge {
            background: rgba(25,135,84,0.12);
            color: var(--bh-green);
            border-radius: 999px;
            font-weight: 500;
            padding: 0.4rem 0.9rem;
        }
        .contact-pill {
            border: 1px dashed #dfe7e2;
            border-radius: 12px;
            padding: 0.45rem 0.9rem;
            color: #1c2b23;
            font-weight: 500;
        }
        .contact-pill:hover { background: var(--bh-green); color: #fff; }
        .contact-pill.blur-phone {
            filter: blur(3px);
            letter-spacing: 0.2em;
        }
        .contact-pill.disabled-link {
            pointer-events: auto;
            opacity: 0.8;
            cursor: pointer;
        }
        .view-profile-btn {
            padding: 0.75rem 1.75rem;
            border-radius: 999px;
            font-weight: 600;
            background: rgba(25,135,84,0.12);
            border: none;
            color: var(--bh-green);
            transition: background 0.2s, color 0.2s;
        }
        .view-profile-btn:hover { background: var(--bh-green); color: #fff; }
        .leaderboard-card {
            background: #fff;
            border-radius: 24px;
            box-shadow: 0 30px 65px rgba(11, 22, 16, 0.12);
            padding: 1.5rem;
        }
        .leaderboard-item {
            border-radius: 16px;
            padding: 0.85rem;
            background: #f8fbf9;
            display: flex;
            align-items: center;
            gap: 0.8rem;
        }
        .leaderboard-rank {
            width: 36px;
            height: 36px;
            border-radius: 12px;
            background: rgba(25,135,84,0.12);
            color: var(--bh-green);
            font-weight: 700;
            display: inline-flex;
            align-items: center;
            justify-content: center;
        }
        .leaderboard-avatar {
            width: 48px;
            height: 48px;
            border-radius: 50%;
            background: #fff;
            border: 1px solid #e2ebe4;
            display: flex; align-items: center; justify-content: center;
            font-weight: 600;
        }
        .sticky-sidebar { position: sticky; top: 100px; }
        .skeleton-card {
            border-radius: 24px;
            background: #fff;
            padding: 1.75rem;
            box-shadow: 0 25px 55px rgba(16, 26, 20, 0.05);
            overflow: hidden;
        }
        .skeleton-line {
            height: 14px;
            border-radius: 999px;
            background: linear-gradient(90deg, #f0f5f2, #e0ece4, #f0f5f2);
            background-size: 200%;
            animation: shimmer 1.5s infinite;
        }
        .skeleton-line.short { width: 40%; }
        .skeleton-line.medium { width: 70%; }
        .skeleton-line.full { width: 100%; }
        @keyframes shimmer {
            0% { background-position: -100% 0; }
            100% { background-position: 100% 0; }
        }
        @media (max-width: 991px) {
            .filter-card .sort-select { border-left: none; }
            .leaderboard-card { position: static; top: auto; }
        }
        .swal2-popup {
            border-radius: 1.5rem;
            border: 1px solid rgba(39, 174, 96, 0.3);
            background: linear-gradient(180deg, #ffffff 0%, #f8fff7 100%);
            box-shadow: 0 24px 60px rgba(15, 76, 108, 0.25);
            position: relative;
            overflow: hidden;
        }

        .swal2-popup::before {
            content: '';
            position: absolute;
            inset: -40% auto auto -30%;
            width: 220px;
            height: 220px;
            background: radial-gradient(circle, rgba(36, 178, 77, 0.3), transparent 65%);
            filter: blur(0);
            animation: pulse 6s ease-in-out infinite;
        }

        @keyframes pulse {
            0% {
                transform: scale(0.9);
                opacity: 0.4;
            }
            50% {
                transform: scale(1);
                opacity: 0.8;
            }
            100% {
                transform: scale(0.9);
                opacity: 0.4;
            }
        }

        .swal2-title {
            color: #0c5424;
            font-family: 'Inter', sans-serif;
            font-weight: 600;
            letter-spacing: 0.02em;
        }

        .swal2-html-container {
            width: 100%;
            padding: 0;
        }

        .swal2-input,
        .swal2-textarea {
            border-radius: 0.85rem;
            border: 1px solid rgba(102, 166, 118, 0.4);
            padding: 0.85rem 1rem;
            font-size: 0.95rem;
            box-shadow: inset 0 1px 2px rgba(0,0,0,0.05);
        }

        .swal2-input:focus,
        .swal2-textarea:focus {
            border-color: #24b24d;
            box-shadow: 0 0 0 2px rgba(36, 178, 77, 0.15);
        }

        .swal2-validation-message {
            font-size: 0.8rem;
            letter-spacing: 0.01em;
            text-transform: none;
        }

        .swal2-form-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(220px, 1fr));
            gap: 0.9rem 1rem;
            margin-bottom: 0.75rem;
        }

        .swal2-form-field {
            display: flex;
            flex-direction: column;
            gap: 0.35rem;
        }

        .swal2-form-field label {
            font-size: 0.8rem;
            text-transform: uppercase;
            letter-spacing: 0.08em;
            color: rgba(12, 84, 36, 0.7);
        }

        .swal2-note {
            font-size: 0.85rem;
            color: #2b6c42;
            text-align: center;
            margin-top: 0.5rem;
            opacity: 0.85;
        }

        .swal2-service-chip {
            display: inline-flex;
            align-items: center;
            gap: 0.45rem;
            justify-content: center;
            padding: 0.45rem 0.95rem;
            margin-bottom: 0.9rem;
            border-radius: 999px;
            background: rgba(36, 178, 77, 0.12);
            color: #0c5424;
            font-size: 0.8rem;
            text-transform: uppercase;
            letter-spacing: 0.12em;
        }

        .swal2-service-chip i {
            font-size: 1rem;
        }

        .swal2-confirm {
            border-radius: 1rem;
            padding: 0.75rem 1.5rem;
            font-weight: 600;
            background: linear-gradient(135deg, #0d6efd, #24b24d);
            border: none;
            box-shadow: 0 12px 28px rgba(13, 110, 253, 0.35);
        }

        .swal2-cancel {
            border-radius: 1rem;
        }
    </style>
</head>
<body>
    <?= $this->include('layouts/loader', ['loaderMinDuration' => 800]) ?>

    <?= $this->include('layouts/header') ?>

    <main class="agents-page">
        <section class="agents-hero">
            <div class="container">
                <div class="row gy-4 align-items-center">
                    <div class="col-lg-7">
                        <span class="badge bg-white text-success rounded-pill px-3 py-2 mb-3 shadow-sm">Trusted by 800+ verified agencies</span>
                        <h1 class="display-5 fw-bold">Find the Best Real Estate Agents</h1>
                        <p class="lead text-muted">Discover vetted professionals, compare performance, and contact them instantly to accelerate your next transaction.</p>
                        <div class="hero-search d-flex align-items-center gap-2 mt-4">
                            <i class="bi bi-search text-muted"></i>
                            <input id="hero-search" type="text" placeholder="Search by name, city, or expertise" aria-label="Search agents">
                            <button class="btn btn-brand">Search</button>
                        </div>
                    </div>
                    <div class="col-lg-5">
                        <div class="hero-card">
                            <h5 class="fw-bold mb-3">Why partner with us?</h5>
                            <ul class="list-unstyled text-muted mb-0">
                                <li class="d-flex align-items-center mb-2"><i class="bi bi-patch-check-fill text-success me-2"></i> Verified agent profiles & track record</li>
                                <li class="d-flex align-items-center mb-2"><i class="bi bi-lightning-charge-fill text-warning me-2"></i> Instant WhatsApp & call connect</li>
                                <li class="d-flex align-items-center"><i class="bi bi-award text-success me-2"></i> Leaderboards & client reviews</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section class="filter-panel">
            <div class="container">
                <div class="filter-card">
                    <div class="row g-3 align-items-end">
                        <div class="col-md-3">
                            <label for="filter-city">City</label>
                            <select id="filter-city" class="form-select">
                                <option value="">All Cities</option>
                                <option value="Delhi">Delhi</option>
                                <option value="Mumbai">Mumbai</option>
                                <option value="Bengaluru">Bengaluru</option>
                                <option value="Hyderabad">Hyderabad</option>
                            </select>
                        </div>
                        <div class="col-md-3">
                            <label for="filter-service">Specialisation</label>
                            <select id="filter-service" class="form-select">
                                <option value="">All Services</option>
                                <option value="Residential">Residential</option>
                                <option value="Commercial">Commercial</option>
                                <option value="Luxury">Luxury Homes</option>
                                <option value="Plots">Plots & Land</option>
                            </select>
                        </div>
                        <div class="col-md-4">
                            <label for="filter-search">Keyword</label>
                            <div class="position-relative">
                                <i class="bi bi-search position-absolute top-50 start-0 translate-middle-y ms-3 text-muted"></i>
                                <input id="filter-search" type="text" class="form-control ps-5" placeholder="Search Agents">
                            </div>
                        </div>
                        <div class="col-md-2 sort-select">
                            <label for="filter-sort">Sort by</label>
                            <select id="filter-sort" class="form-select">
                                <option value="">Default</option>
                                <option value="topRated">Top Rated</option>
                                <option value="mostListings">Most Listings</option>
                                <option value="city">Top Cities</option>
                            </select>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section class="agents-wrapper">
            <div class="container">
                <div class="row g-4">
                    <div class="col-lg-8 order-2 order-lg-1">
                        <div class="d-flex flex-wrap justify-content-between align-items-center mb-3">
                            <div>
                                <h2 class="h4 mb-1">Real Estate Agents</h2>
                                <p id="agents-count" class="text-muted small mb-0">Loading agents...</p>
                            </div>
                            <div class="text-muted small"><i class="bi bi-lightning-charge me-1 text-warning"></i> Updated in real-time</div>
                        </div>

                        <div id="agents-skeleton" class="vstack gap-4">
                            <?php for ($i = 0; $i < 3; $i++): ?>
                            <div class="skeleton-card">
                                <div class="d-flex gap-3 align-items-center mb-3">
                                    <div class="agent-avatar"></div>
                                    <div class="flex-grow-1">
                                        <div class="skeleton-line medium mb-2"></div>
                                        <div class="skeleton-line short"></div>
                                    </div>
                                </div>
                                <div class="skeleton-line full mb-2"></div>
                                <div class="skeleton-line medium"></div>
                            </div>
                            <?php endfor; ?>
                        </div>

                        <div id="agents-list" class="vstack gap-4 d-none"></div>

                        <div class="text-center mt-4">
                            <button id="load-more-btn" class="btn btn-outline-success px-4 py-2 rounded-pill d-none">Load more agents</button>
                        </div>
                    </div>

                    <div class="col-lg-4 order-1 order-lg-2">
                        <div class="sticky-sidebar">
                            <div class="leaderboard-card mb-4" data-aos="fade-left">
                                <div class="d-flex justify-content-between align-items-center mb-3">
                                    <div>
                                        <p class="text-uppercase text-muted small mb-1">Leaderboard</p>
                                        <h5 class="fw-semibold mb-0">Top Transacting Agents</h5>
                                    </div>
                                    <span class="badge bg-light text-success">Live</span>
                                </div>
                                <div id="leaderboard-list" class="vstack gap-3">
                                    <!-- leaderboard injected here -->
                                </div>
                            </div>
                            <div class="p-4 rounded-4 bg-white shadow-sm" data-aos="fade-left" data-aos-delay="150">
                                <h6 class="fw-semibold">Need help choosing?</h6>
                                <p class="text-muted small mb-3">Talk to our concierge team for curated agent recommendations in your city.</p>
                                <a href="tel:+911234567890" class="btn btn-brand w-100">Call Support</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>

    <?= $this->include('layouts/modal') ?>
    <?= $this->include('layouts/footer') ?>

    <script src="<?= base_url('js/script.js') ?>"></script>
    

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/aos@2.3.4/dist/aos.js"></script>
    <script>
    (function(){
        const api = '<?= site_url('api/agent/all') ?>';
        const agentsList = document.getElementById('agents-list');
        const agentsCount = document.getElementById('agents-count');
        const leaderboard = document.getElementById('leaderboard-list');
        const citySelect = document.getElementById('filter-city');
        const serviceSelect = document.getElementById('filter-service');
        const searchInput = document.getElementById('filter-search');
        const heroSearchInput = document.getElementById('hero-search');
        const sortSelect = document.getElementById('filter-sort');
        const skeleton = document.getElementById('agents-skeleton');
        const loadMoreBtn = document.getElementById('load-more-btn');
        const LOGGED_IN = <?= session()->get('user_id') ? 'true' : 'false' ?>;

        const PAGE_SIZE = 6;
        let allAgents = [];
        let renderedCount = 0;
        let searchDelay;

        function esc(s){ return String(s || ''); }

        function initials(name){
            return esc(name).split(' ').map(part => part.charAt(0)).slice(0,2).join('').toUpperCase() || 'AG';
        }

        function setSkeleton(state){
            if (!skeleton || !agentsList) return;
            if (state){
                skeleton.classList.remove('d-none');
                agentsList.classList.add('d-none');
                loadMoreBtn.classList.add('d-none');
            } else {
                skeleton.classList.add('d-none');
                agentsList.classList.remove('d-none');
            }
        }

        function renderAgent(agent, index){
            const card = document.createElement('div');
            card.className = 'agent-card';
            card.setAttribute('data-aos','fade-up');
            card.setAttribute('data-aos-delay', Math.min(index * 40, 200));
            const rating = agent.rating ? Number(agent.rating).toFixed(1) : '4.8';
            const reviews = agent.review_count || '120';
            const service = agent.service_type || agent.specialisation || 'Residential & Commercial';
            const phone = agent.phone_number || agent.phone || '';
            const phoneLabel = (LOGGED_IN && phone) ? esc(phone) : 'Login to view';
            const phoneHint = LOGGED_IN ? '' : '<span class="ms-1 small text-muted">Tap to login</span>';
            const phoneHref = (LOGGED_IN && phone) ? `tel:${esc(phone)}` : '#';
            const whatsappHref = (LOGGED_IN && phone) ? `https://wa.me/${esc(phone)}` : '#';
            const phoneBlurClass = LOGGED_IN ? '' : 'blur-phone';
            const phoneLoginAttrs = LOGGED_IN ? '' : ' data-login-required="true" aria-disabled="true"';
            const whatsappAttrs = LOGGED_IN ? ' target="_blank" rel="noreferrer"' : ' data-login-required="true" aria-disabled="true"';
            const whatsappClass = `contact-pill ${LOGGED_IN ? '' : 'disabled-link'}`;
            const email = agent.email || '';
            const emailLabel = (LOGGED_IN && email) ? esc(email) : 'Login to view';
            const emailHref = (LOGGED_IN && email) ? `mailto:${esc(email)}` : '#';
            const emailClass = `contact-pill ${LOGGED_IN ? '' : 'blur-phone disabled-link'}`;
            const emailAttrs = LOGGED_IN ? '' : ' data-login-required="true" aria-disabled="true"';
            const avatarHtml = agent.avatar ? `<img src="${esc(agent.avatar)}" alt="${esc(agent.full_name||agent.agency_name||'Agent')}" class="agent-avatar" onerror="this.style.display='none';this.nextElementSibling && (this.nextElementSibling.style.display='flex')">` : '';
            const avatarFallback = `<div class="agent-avatar" style="${agent.avatar ? 'display:none' : 'display:flex'}">${initials(agent.full_name || agent.agency_name)}</div>`;

            card.innerHTML = `
                <div class="d-flex flex-wrap gap-3 align-items-center mb-3">
                    ${avatarHtml}${avatarFallback}
                    <div class="flex-grow-1">
                        <div class="d-flex flex-wrap align-items-center gap-2">
                            <h3 class="h5 mb-0">${esc(agent.full_name || agent.agency_name || 'Agent')}</h3>
                            <span class="verified-badge"><i class="bi bi-patch-check-fill"></i> Verified</span>
                        </div>
                        <p class="text-muted mb-1 small">${esc(agent.agency_name || 'Independent Consultant')}</p>
                        <div class="agent-rating small"><i class="bi bi-star-fill me-1"></i>${rating} <span class="text-muted">(${reviews} reviews)</span></div>
                    </div>
                    <span class="badge bg-light text-success fw-semibold">${agent.property_count || 0} listings</span>
                </div>
                <div class="d-flex flex-wrap gap-2 agent-meta mb-3">
                    <span class="badge"><i class="bi bi-geo-alt me-1"></i>${esc(agent.city || 'Across India')}</span>
                    <span class="badge"><i class="bi bi-briefcase me-1"></i>${esc(service)}</span>
                </div>
                <div class="agent-contact d-flex flex-wrap gap-3 mb-3">
                    <a href="${phoneHref}" class="contact-pill ${phoneBlurClass}"${phoneLoginAttrs}><i class="bi bi-telephone me-1"></i>${phoneLabel}${phoneHint}</a>
                    <a href="${emailHref}" class="${emailClass}"${emailAttrs}><i class="bi bi-envelope me-1"></i>${emailLabel}</a>
                    <a href="${whatsappHref}" class="${whatsappClass}"${whatsappAttrs}><i class="bi bi-whatsapp text-success me-1"></i>WhatsApp</a>
                </div>
                <div class="d-flex flex-wrap justify-content-between align-items-center gap-3">
                    <button class="view-profile-btn" onclick="window.location.href='<?= site_url('agents/profile') ?>?id=${agent.agent_id}'">View Profile</button>
                    <div class="d-flex gap-2">
                        <button class="btn btn-outline-success rounded-pill px-3 book-appointment-btn" data-action="book-appointment" data-agent-id="${esc(agent.agent_id)}" data-agent-name="${esc(agent.full_name || agent.agency_name || 'Agent')}" data-agent-city="${esc(agent.city || 'Pan India')}" data-agent-service="${esc(service)}"><i class="bi bi-calendar-check me-2"></i>Book Appointment</button>
                    </div>
                </div>`;
            return card;
        }

        function renderLeaderboard(items){
            if (!leaderboard) return;
            leaderboard.innerHTML = '';
            items.slice(0,5).forEach((agent, idx) => {
                const item = document.createElement('div');
                item.className = 'leaderboard-item';
                const lbAvatar = agent.avatar ? `<img src="${esc(agent.avatar)}" alt="${esc(agent.full_name||agent.agency_name||'Agent')}" class="agent-avatar leaderboard-avatar" onerror="this.style.display='none';this.nextElementSibling && (this.nextElementSibling.style.display='flex')">` : '';
                const lbFallback = `<div class="leaderboard-avatar" style="${agent.avatar ? 'display:none' : 'display:flex'}">${initials(agent.full_name || agent.agency_name)}</div>`;
                item.innerHTML = `
                    <span class="leaderboard-rank">${idx + 1}</span>
                    ${lbAvatar}${lbFallback}
                    <div class="flex-grow-1">
                        <div class="fw-semibold">${esc(agent.full_name || agent.agency_name || 'Agent')}</div>
                        <small class="text-muted">${esc(agent.city || 'Pan India')}</small>
                    </div>
                    <div class="text-end">
                        <div class="fw-bold text-success">${agent.property_count || 0}</div>
                        <small class="text-muted">Listings</small>
                    </div>`;
                leaderboard.appendChild(item);
            });
        }

        function dedupeAndSort(values){
            const cleaned = values.filter(Boolean).map(item => item.trim()).filter(Boolean);
            return [...new Set(cleaned)].sort((a, b) => a.localeCompare(b));
        }

        function updateFilterOptions(items){
            if (!items || !items.length) return;
            const cities = dedupeAndSort(items.map(agent => agent.city || 'Across India'));
            const services = dedupeAndSort(items.map(agent => agent.service_type || agent.specialisation || 'Residential & Commercial'));
            if (citySelect) {
                const current = citySelect.value;
                citySelect.innerHTML = '<option value="">All Cities</option>';
                cities.forEach(city => {
                    const option = document.createElement('option');
                    option.value = city;
                    option.textContent = city;
                    citySelect.appendChild(option);
                });
                citySelect.value = cities.includes(current) ? current : '';
            }
            if (serviceSelect) {
                const current = serviceSelect.value;
                serviceSelect.innerHTML = '<option value="">All Services</option>';
                services.forEach(service => {
                    const option = document.createElement('option');
                    option.value = service;
                    option.textContent = service;
                    serviceSelect.appendChild(option);
                });
                serviceSelect.value = services.includes(current) ? current : '';
            }
        }

        function applySort(items){
            const selected = sortSelect ? sortSelect.value : '';
            if (!selected) return items;
            const sorted = [...items];
            switch (selected) {
                case 'topRated':
                    sorted.sort((a,b) => (b.rating || 4.9) - (a.rating || 4.9));
                    break;
                case 'mostListings':
                    sorted.sort((a,b) => (b.property_count || 0) - (a.property_count || 0));
                    break;
                case 'city':
                    sorted.sort((a,b) => esc(a.city).localeCompare(esc(b.city)));
                    break;
            }
            return sorted;
        }

        function renderAgentsChunk(){
            if (!agentsList) return;
            const next = allAgents.slice(renderedCount, renderedCount + PAGE_SIZE);
            next.forEach((agent, idx) => {
                agentsList.appendChild(renderAgent(agent, renderedCount + idx));
            });
            renderedCount += next.length;
            agentsList.classList.toggle('d-none', renderedCount === 0);
            loadMoreBtn.classList.toggle('d-none', renderedCount >= allAgents.length);
            if (window.AOS) {
                setTimeout(() => AOS.refresh(), 100);
            }
        }

        async function loadAgents(){
            setSkeleton(true);
            try {
                const q = new URL(api, window.location.origin);
                if (searchInput && searchInput.value.trim()) q.searchParams.set('q', searchInput.value.trim());
                if (citySelect && citySelect.value) q.searchParams.set('city', citySelect.value);
                if (serviceSelect && serviceSelect.value) q.searchParams.set('service', serviceSelect.value);
                const res = await fetch(q.toString());
                const payload = await res.json();
                const items = (payload && payload.data) ? payload.data : [];
                allAgents = applySort(items);
                updateFilterOptions(allAgents);
                agentsCount.textContent = `${items.length} agents found`;
                agentsList.innerHTML = '';
                renderedCount = 0;
                renderAgentsChunk();
                renderLeaderboard(allAgents);
            } catch (error) {
                console.error('Failed to load agents', error);
                agentsCount.textContent = 'Failed to load agents';
            } finally {
                setSkeleton(false);
            }
        }

        function handleSearchInput(){
            clearTimeout(searchDelay);
            searchDelay = setTimeout(loadAgents, 400);
        }

        if (searchInput) searchInput.addEventListener('input', handleSearchInput);
        if (heroSearchInput) {
            heroSearchInput.addEventListener('input', function(){
                searchInput.value = this.value;
                handleSearchInput();
            });
        }
        if (citySelect) citySelect.addEventListener('change', loadAgents);
        if (serviceSelect) serviceSelect.addEventListener('change', loadAgents);
        if (sortSelect) sortSelect.addEventListener('change', function(){
            allAgents = applySort(allAgents);
            agentsList.innerHTML = '';
            renderedCount = 0;
            renderAgentsChunk();
        });
        if (loadMoreBtn) loadMoreBtn.addEventListener('click', renderAgentsChunk);

        document.addEventListener('click', function(event){
            const loginGuard = event.target.closest('[data-login-required]');
            if (!loginGuard) return;
            event.preventDefault();
            if (window.Swal) {
                Swal.fire({
                    icon: 'warning',
                    title: 'Login required',
                    text: 'Sign in to view agent contact numbers or WhatsApp them directly.',
                    confirmButtonText: 'Login',
                    showCancelButton: true
                }).then(result => {
                    if (result.isConfirmed) {
                        window.location.href = '<?= site_url('login') ?>';
                    }
                });
            } else {
                alert('Please log in to view contact details.');
            }
        });

        loadAgents();
        if (window.AOS) {
            AOS.init({ duration: 700, once: true, offset: 80 });
        }
    })();
    </script>
    <script>
    document.addEventListener('DOMContentLoaded', function () {
        const csrfTokenMeta = document.querySelector('meta[name="csrf-token-name"]');
        const csrfHashMeta = document.querySelector('meta[name="csrf-token-value"]');
        let csrfTokenName = csrfTokenMeta ? csrfTokenMeta.getAttribute('content') : null;
        let csrfTokenValue = csrfHashMeta ? csrfHashMeta.getAttribute('content') : null;
        const csrfHeaderName = 'X-CSRF-TOKEN';
        const appointmentEndpoint = '<?= site_url('api/appointments/request') ?>';

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
            if (csrfTokenValue) {
                headers[csrfHeaderName] = csrfTokenValue;
            }
            return headers;
        };

        const formTemplate = (agentName, agentCity, agentService) => {
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

        const openAppointmentSurvey = (button) => {
            if (!window.Swal) return;
            const agentName = button.dataset.agentName || 'Agent';
            const agentCity = button.dataset.agentCity || '';
            const agentService = button.dataset.agentService || '';
            Swal.fire({
                title: `Book appointment with ${agentName}`,
                html: formTemplate(agentName, agentCity, agentService),
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
                        `Agent: ${agentName}`,
                        agentCity ? `Location: ${agentCity}` : '',
                        agentService ? `Specialisation: ${agentService}` : '',
                        `Preferred Date: ${date}`,
                        `Preferred Time: ${time}`,
                        note ? `Notes: ${note}` : ''
                    ].filter(Boolean).join('\n');

                    const payload = {
                        agent_id: button.dataset.agentId || null,
                        agent_name: agentName,
                        agent_city: agentCity,
                        agent_service: agentService,
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
                        const result = await response.json();
                        refreshCsrfTokens(result);
                        if (!response.ok) {
                            const validationText = result.message || 'Unable to submit appointment request right now.';
                            Swal.showValidationMessage(validationText);
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

        document.addEventListener('click', function (event) {
            const trigger = event.target.closest('.book-appointment-btn');
            if (!trigger) return;
            event.preventDefault();
            openAppointmentSurvey(trigger);
        });
    });
    </script>
</body>
</html>