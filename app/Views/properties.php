<?php
$page_title = 'Property Listings - 36 Broking Hub';
$request = service('request');
$initialQuery = trim((string) $request->getGet('query'));
$initialPropertyType = trim((string) $request->getGet('property_type'));
$initialListingType = trim((string) $request->getGet('listing_type'));
$initialBudget = trim((string) $request->getGet('budget'));
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <?php include 'assets/includes/seo-meta.php'; ?>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <!-- Site styles -->
    <link rel="stylesheet" href="<?= base_url('CSS/style.css') ?>">
    <link rel="stylesheet" href="<?= base_url('CSS/home.css') ?>">
    <link rel="icon" type="image/x-icon" href="<?= base_url('images/favicon/favicon.ico') ?>">

    <style>
        body {
            font-family: 'Inter', sans-serif;
            background-color: #f7faf8;
        }
        h1, h2, h3, h4, h5, h6 { font-weight: 700; }

        .site-footer { background-color: #212529; font-size: 0.9rem; }
        .site-footer h5 { font-size: 1rem; font-weight: 600; color: #fff; }
        .site-footer a { color: #adb5bd; text-decoration: none; }
        .site-footer a:hover { color: #fff; }
        .footer-bottom { border-top: 1px solid #343a40; }

        :root {
            --brand-color: #198754;
            --muted-color: #6c757d;
            --soft-bg: #f2f8f4;
        }

        /* --- Page Layout & Filters (aligned with Agents page) --- */
        .properties-page {
            background-color: transparent;
        }

        .properties-hero {
            position: relative;
            background: linear-gradient(135deg, rgba(25,135,84,0.08), rgba(25,135,84,0.03));
            padding: clamp(3rem, 8vw, 5rem) 0 4rem;
            overflow: hidden;
        }

        .properties-hero::before,
        .properties-hero::after {
            content: '';
            position: absolute;
            border-radius: 50%;
            filter: blur(80px);
            background: rgba(25,135,84,0.19);
        }
        .properties-hero::before { width: 220px; height: 220px; top: -60px; left: -70px; }
        .properties-hero::after { width: 260px; height: 260px; bottom: -90px; right: 0; }

        .properties-hero-card {
            background: #fff;
            border-radius: 24px;
            padding: 1.75rem;
            box-shadow: 0 35px 80px rgba(19, 44, 31, 0.12);
            position: relative;
            z-index: 2;
        }

        .filter-panel {
            margin-top: -3rem;
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

        .filter-card .form-select:focus,
        .filter-card .form-control:focus {
            box-shadow: 0 0 0 0.25rem rgba(25, 135, 84, 0.18);
            border-color: #198754;
        }

        .filter-card label {
            font-size: 0.85rem;
            color: #5f6c62;
            margin-bottom: 0.15rem;
        }

        .filter-card .input-group-text {
            background-color: #fff;
            border-right: none;
        }

        .filter-card .form-control {
            border-left: none;
        }

        #clear-filters {
            background: #198754;
            color: #fff;
            border: none;
            border-radius: 14px;
            font-weight: 600;
            padding: 0.75rem 1.5rem;
            min-height: 48px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            transition: background-color 0.2s ease, transform 0.2s ease, box-shadow 0.2s ease;
            box-shadow: 0 10px 25px rgba(25, 135, 84, 0.18);
        }

        #clear-filters:hover {
            background: #157347;
            transform: translateY(-1px);
            box-shadow: 0 12px 30px rgba(21, 115, 71, 0.25);
        }

        .properties-wrapper {
            padding: 3rem 0 3.5rem;
        }

        .properties-sidebar-card {
            background: #fff;
            border-radius: 24px;
            padding: 1.75rem;
            box-shadow: 0 25px 55px rgba(16, 26, 20, 0.06);
        }

        .sticky-sidebar {
            position: sticky;
            top: 100px;
        }

        @media (max-width: 991px) {
            .filter-panel {
                margin-top: 0;
            }
            .sticky-sidebar {
                position: static;
                top: auto;
            }
        }

        /* --- Property Listing Card (aligned with Agents cards) --- */
        .property-listing-card {
            border-radius: 24px;
            background: #fff;
            border: 1px solid rgba(15,15,20,0.04);
            overflow: hidden;
            transition: transform 0.25s ease, box-shadow 0.25s ease;
            box-shadow: 0 25px 55px rgba(16, 26, 20, 0.06);
        }

        .property-listing-card:hover {
            transform: translateY(-4px);
            box-shadow: 0 18px 40px rgba(12,12,20,0.12);
        }

        .property-img {
            width: 100%;
            height: 220px;
            object-fit: cover;
            display: block;
        }

        .img-overlay {
            position: absolute;
            inset: 0;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            padding: 12px;
            background: linear-gradient(180deg, rgba(0,0,0,0) 35%, rgba(0,0,0,0.55) 100%);
            color: #fff;
        }

        .card-badges {
            display: flex;
            gap: 8px;
        }

        .badge-pill {
            border-radius: 999px;
            padding: 0.35rem 0.65rem;
            font-weight: 600;
            font-size: 0.8rem;
        }

        .property-price {
            font-weight: 700;
            font-size: 1.15rem;
            text-shadow: 0 6px 18px rgba(0,0,0,0.45);
        }

        .card-actions {
            position: absolute;
            top: 12px;
            right: 12px;
            display: flex;
            gap: 8px;
        }

        .card-actions .btn-icon {
            background: rgba(255,255,255,0.9);
            border-radius: 8px;
            padding: 0.35rem 0.5rem;
            border: none;
            color: #222;
            transition: background-color 0.2s ease, color 0.2s ease;
        }

        .card-actions .btn-icon:hover {
            background: var(--brand-color);
            color: #fff;
        }

        .property-listing-card .card-body {
            padding: 1.2rem 1.15rem 1.35rem;
        }

        .property-listing-card .card-title {
            font-weight: 700;
            font-size: 1.05rem;
            margin-bottom: 0.35rem;
        }

        .property-listing-card .card-location {
            color: var(--muted-color);
            font-size: 0.92rem;
        }

        .property-specs {
            display: flex;
            flex-wrap: wrap;
            gap: 10px;
            margin-top: 0.9rem;
        }

        .spec-pill {
            background: #d8d8d8;
            color: #2b3b33;
            padding: 0.35rem 0.65rem;
            border-radius: 10px;
            font-size: 0.85rem;
            font-weight: 600;
        }

        .agent-logo {
            width: 38px;
            height: 38px;
            border-radius: 8px;
            background: #d8d8d8;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 700;
            color: var(--brand-color);
        }

        .btn-outline-success {
            font-weight: 600;
        }

        @media (max-width: 767px) {
            .property-img {
                height: 180px;
            }
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

        .share-chip i {
            font-size: 1rem;
        }

    </style>
</head>
<body>
    <?= $this->include('layouts/loader') ?>

    <?= $this->include('layouts/header') ?>

    <main class="properties-page">
        <!-- HERO SECTION (aligned with agents page) -->
        <section class="properties-hero">
            <div class="container">
                <div class="row gy-4 align-items-center">
                    <div class="col-lg-7">
                        <span class="badge bg-white text-success rounded-pill px-3 py-2 mb-3 shadow-sm">Discover verified property listings</span>
                        <h1 class="display-5 fw-bold">Find the Right Property Faster</h1>
                        <p class="lead text-muted">Browse curated residential and commercial properties, then refine your search by type, price range, and city.</p>
                    </div>
                    <div class="col-lg-5">
                        <div class="properties-hero-card">
                            <h5 class="fw-bold mb-3">Smart filters. Clean results.</h5>
                            <ul class="list-unstyled text-muted small mb-0">
                                <li class="d-flex align-items-center mb-2"><i class="bi bi-funnel me-2 text-success"></i> Filter by property type, category, price, and city.</li>
                                <li class="d-flex align-items-center mb-2"><i class="bi bi-geo-alt me-2 text-success"></i> Quickly focus on the locations that matter to you.</li>
                                <li class="d-flex align-items-center"><i class="bi bi-house-check me-2 text-success"></i> View structured cards with all key details at a glance.</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- FILTER PANEL -->
        <section class="filter-panel" data-aos="fade-down">
            <div class="container">
                <div class="filter-card">
                    <div class="row g-3 align-items-end">
                        <div class="col-12 col-md-6 col-lg-3">
                            <label for="filter-query" class="form-label mb-1">Search</label>
                            <div class="input-group">
                                <span class="input-group-text"><i class="bi bi-search"></i></span>
                                <input id="filter-query" type="text" class="form-control" placeholder="City, locality or keyword" value="<?= esc($initialQuery) ?>">
                            </div>
                        </div>
                        <div class="col-12 col-md-6 col-lg-2">
                            <label for="filter-property-type" class="form-label mb-1">Property Type</label>
                            <div class="input-group">
                                <span class="input-group-text"><i class="bi bi-tag"></i></span>
                                <select id="filter-property-type" class="form-select">
                                    <option value="">All Property</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-12 col-md-6 col-lg-2">
                            <label for="filter-category" class="form-label mb-1">Category</label>
                            <div class="input-group">
                                <span class="input-group-text"><i class="bi bi-building"></i></span>
                                <select id="filter-category" class="form-select">
                                    <option value="">All Categories</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-12 col-md-6 col-lg-2">
                            <label for="filter-price" class="form-label mb-1">Budget</label>
                            <div class="input-group">
                                <span class="input-group-text"><i class="bi bi-cash-coin"></i></span>
                                <select id="filter-price" class="form-select" data-initial-value="<?= esc($initialBudget) ?>">
                                    <option value="">Any Budget</option>
                                    <option value="up_to_50k" <?= $initialBudget === 'up_to_50k' ? 'selected' : '' ?>>Up to ₹50k</option>
                                    <option value="50k_1l" <?= $initialBudget === '50k_1l' ? 'selected' : '' ?>>₹50k - ₹1 L</option>
                                    <option value="1l_2l" <?= $initialBudget === '1l_2l' ? 'selected' : '' ?>>₹1 L - ₹2 L</option>
                                    <option value="2l_3l" <?= $initialBudget === '2l_3l' ? 'selected' : '' ?>>₹2 L - ₹3 L</option>
                                    <option value="3l_5l" <?= $initialBudget === '3l_5l' ? 'selected' : '' ?>>₹3 L - ₹5 L</option>
                                    <option value="5l_8l" <?= $initialBudget === '5l_8l' ? 'selected' : '' ?>>₹5 L - ₹8 L</option>
                                    <option value="8l_12l" <?= $initialBudget === '8l_12l' ? 'selected' : '' ?>>₹8 L - ₹12 L</option>
                                    <option value="above_12l" <?= $initialBudget === 'above_12l' ? 'selected' : '' ?>>Above ₹12 L</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-12 col-md-6 col-lg-2">
                            <label for="filter-city" class="form-label mb-1">City</label>
                            <div class="input-group">
                                <span class="input-group-text"><i class="bi bi-geo-alt"></i></span>
                                <select id="filter-city" class="form-select">
                                    <option value="">All Cities</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-12 col-md-6 col-lg-1 d-flex align-items-end justify-content-md-end mt-2 mt-lg-0">
                            <button id="clear-filters" class="btn w-100">Clear</button>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- PROPERTY LISTINGS -->
        <section class="properties-wrapper" data-aos="fade-up">
            <div class="container">
                <div class="row g-4">
                    <div class="col-lg-12">
                        <div class="d-flex flex-wrap justify-content-between align-items-center mb-3">
                            <div>
                                <h2 class="h4 mb-1">Property Listings</h2>
                                <p id="results-count" class="text-muted small mb-0"></p>
                            </div>
                            <div class="text-muted small d-flex align-items-center mt-2 mt-lg-0">
                                <i class="bi bi-lightning-charge me-1 text-warning"></i>
                                <span>Updated as new properties go live</span>
                            </div>
                        </div>

                        <div class="row g-4" id="properties-row">
                            <div class="col-12 text-center my-5" id="properties-loading">
                                <div class="spinner-border text-success" role="status"></div>
                                <p class="mt-3">Loading properties...</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>

    <!-- Share Modal -->
    <div class="modal fade share-modal" id="shareModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <div>
                        <p class="text-uppercase text-muted small mb-1">Share Property</p>
                        <h5 class="modal-title share-property-title mb-0">Property Link</h5>
                    </div>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="input-group share-link-group">
                        <input type="text" class="form-control" id="shareLinkInput" readonly>
                        <button class="btn btn-success" type="button" id="copyShareLink">Copy Link</button>
                    </div>
                    <div class="share-actions">
                        <a href="<?= site_url('properties') ?>" id="shareWhatsApp" target="_blank" rel="nofollow noopener" class="share-chip">
                            <i class="bi bi-whatsapp"></i> WhatsApp
                        </a>
                        <a href="<?= site_url('properties') ?>" id="shareFacebook" target="_blank" rel="nofollow noopener" class="share-chip">
                            <i class="bi bi-facebook"></i> Facebook
                        </a>
                        <a href="<?= site_url('properties') ?>" id="shareInstagram" target="_blank" rel="nofollow noopener" class="share-chip">
                            <i class="bi bi-instagram"></i> Instagram
                        </a>
                        <a href="<?= site_url('properties') ?>" id="shareX" target="_blank" rel="nofollow noopener" class="share-chip">
                            <i class="bi bi-twitter-x"></i> X
                        </a>
                        <a href="<?= site_url('properties') ?>" id="shareLinkedIn" target="_blank" rel="nofollow noopener" class="share-chip">
                            <i class="bi bi-linkedin"></i> LinkedIn
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <?= $this->include('layouts/modal') ?>
    <?= $this->include('layouts/footer') ?>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
        <script>
            (function(){
                const apiUrl = '<?= site_url('api/property/all') ?>';
                const propertyUrl = '<?= site_url('property') ?>';
                const container = document.getElementById('properties-row');
                const loading = document.getElementById('properties-loading');
                const queryInput = document.getElementById('filter-query');
                const typeSelect = document.getElementById('filter-property-type');
                const categorySelect = document.getElementById('filter-category');
                const priceSelect = document.getElementById('filter-price');
                const citySelect = document.getElementById('filter-city');
                const clearBtn = document.getElementById('clear-filters');
                const resultsCount = document.getElementById('results-count');
                const shareModalEl = document.getElementById('shareModal');
                const shareModalInstance = shareModalEl ? new bootstrap.Modal(shareModalEl) : null;
                const shareTitleEl = shareModalEl ? shareModalEl.querySelector('.share-property-title') : null;
                const shareLinkInput = document.getElementById('shareLinkInput');
                const copyShareBtn = document.getElementById('copyShareLink');
                const shareTargets = {
                    whatsapp: document.getElementById('shareWhatsApp'),
                    facebook: document.getElementById('shareFacebook'),
                    instagram: document.getElementById('shareInstagram'),
                    x: document.getElementById('shareX'),
                    linkedin: document.getElementById('shareLinkedIn'),
                };

                const params = new URLSearchParams(window.location.search);
                const initialQueryParam = (params.get('query') || '').trim();
                const initialPropertyTypeParam = (params.get('property_type') || '').trim();
                let listingTypeFilter = (params.get('listing_type') || '').trim().toLowerCase();
                const initialBudgetParam = (params.get('budget') || '').trim();
                const selectBudgetDefault = priceSelect ? (priceSelect.dataset.initialValue || initialBudgetParam) : '';
                if (queryInput && !queryInput.value && initialQueryParam) {
                    queryInput.value = initialQueryParam;
                }
                if (typeSelect && initialPropertyTypeParam) {
                    typeSelect.dataset.initialValue = initialPropertyTypeParam;
                }
                if (priceSelect && selectBudgetDefault && !priceSelect.value) {
                    priceSelect.value = selectBudgetDefault;
                }

                let allProperties = [];

                function safe(v, fallback='-') { return (v !== undefined && v !== null && v !== '') ? v : fallback; }
                function escapeAttr(v) { return String(v ?? '').replace(/"/g, '&quot;'); }

                function renderCard(p, idx = 0) {
                    const rawPrice = (p.pricing && p.pricing.price) ? p.pricing.price : (p.price || p.avg_price || p.price_per_sqft);
                    const price = safe(rawPrice, 'Contact for price');
                    const title = safe(p.property_name || p.title || p.name, 'Untitled Property');
                    const titleAttr = escapeAttr(title);
                    const agent = safe(p.agent_name || p.user_name || 'Agent');
                    const locality = p.locality || (p.details && (p.details.sublocality || p.details.locality)) || '';
                    const city = p.city || (p.details && p.details.city) || '';
                    const location = safe(locality ? `${locality}${city ? ', ' + city : ''}` : city, 'Location');
                    const propType = (p.property_type || (p.details && p.details.sub_property_type) || '').toString();
                    const propCategory = (p.property_category || p.category || '').toString();
                    const firstMedia = (p.media && p.media.length) ? p.media[0] : null;
                    const img = safe(firstMedia ? (firstMedia.file_url || firstMedia.url || firstMedia.fileUrl) : '', '<?= base_url('images/property.png') ?>');
                    const avgPrice = safe(p.avg_price || p.price_per_sqft || p.price, 'N/A');
                    const area = safe(p.area_sqft || (p.details && p.details.area_sqft), 'N/A');
                    const possession = safe(p.possession_status || (p.details && p.details.availability) || 'N/A');

                    const delay = Math.min(600, idx * 60);
                    return `
                    <div class="col-lg-4 col-md-6 mb-4" data-aos="fade-up" data-aos-delay="${delay}">
                        <a href="${propertyUrl}?id=${p.id}" class="text-decoration-none text-reset" aria-label="Open property ${titleAttr}">
                            <article class="property-listing-card position-relative" data-id="${p.id}">
                                <div class="position-relative" style="min-height:220px;">
                                    <img src="${img}" class="property-img" alt="${titleAttr}" loading="lazy">
                                    <div class="img-overlay">
                                        <div class="card-badges">
                                            ${(p.is_featured ? '<span class="badge bg-warning badge-pill text-dark">Featured</span>' : '')}
                                            ${(p.is_new ? '<span class="badge bg-success badge-pill">New</span>' : '')}
                                        </div>
                                        <div class="d-flex justify-content-between align-items-end w-100">
                                            <div></div>
                                            <div class="text-end">
                                                <div class="property-price">${price}</div>
                                                <div class="small text-white-50">${propCategory || propType || ''}</div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card-actions">
                                        <button type="button" class="btn-icon share-btn" title="Share" data-share-url="${propertyUrl}?id=${p.id}" data-share-title="${titleAttr}"><i class="bi bi-share"></i></button>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <h3 class="card-title">${title}</h3>
                                    <div class="card-location">by <strong>${agent}</strong> · ${location}</div>
                                    <div class="property-specs">
                                        <span class="spec-pill">${propCategory || propType || '—'}</span>
                                        <span class="spec-pill">Area: ${area}</span>
                                        <span class="spec-pill">Possession: ${possession}</span>
                                        <span class="spec-pill">Avg: ${avgPrice}</span>
                                    </div>
                                    <div class="d-flex justify-content-between align-items-center mt-3 gap-3">
                                        <div class="d-flex align-items-center gap-2">
                                            <div class="agent-logo">${(agent || 'A').split(' ').map(s => s[0] || '').slice(0,2).join('')}</div>
                                            <div class="small">
                                                <div class="fw-bold">${agent}</div>
                                                <div class="text-muted">Listing Agent</div>
                                            </div>
                                        </div>
                                        <div style="min-width: 140px;">
                                            <button class="btn btn-outline-success btn-sm w-100">Contact Now</button>
                                        </div>
                                    </div>
                                </div>
                            </article>
                        </a>
                    </div>`;
                }

                function openShareModal(url, title = 'Property Link') {
                    if (!shareModalInstance || !shareLinkInput) return;
                    const cleanUrl = url || window.location.href;
                    shareLinkInput.value = cleanUrl;
                    if (shareTitleEl) shareTitleEl.textContent = title;

                    const encodedUrl = encodeURIComponent(cleanUrl);
                    const encodedMessage = encodeURIComponent(`${title} - ${cleanUrl}`);

                    shareTargets.whatsapp && (shareTargets.whatsapp.href = `https://wa.me/?text=${encodedMessage}`);
                    shareTargets.facebook && (shareTargets.facebook.href = `https://www.facebook.com/sharer/sharer.php?u=${encodedUrl}`);
                    shareTargets.instagram && (shareTargets.instagram.href = `https://www.instagram.com/?url=${encodedUrl}`);
                    shareTargets.x && (shareTargets.x.href = `https://twitter.com/intent/tweet?text=${encodedMessage}`);
                    shareTargets.linkedin && (shareTargets.linkedin.href = `https://www.linkedin.com/sharing/share-offsite/?url=${encodedUrl}`);

                    shareModalInstance.show();
                }

                function parsePrice(val) {
                    if (val === undefined || val === null) return NaN;
                    if (typeof val === 'number') return val;
                    try {
                        // remove commas, currency symbols
                        const cleaned = String(val).replace(/[^0-9.]/g, '');
                        return parseFloat(cleaned) || NaN;
                    } catch(e) { return NaN; }
                }

                function extractTypes(p) {
                    if (!p || typeof p !== 'object') {
                        return [];
                    }
                    const details = p.details || {};
                    const values = [
                        p.property_type,
                        p.type,
                        details.property_type,
                        details.sub_property_type
                    ];
                    return values.filter(Boolean).map((val) => val.toString());
                }
                function extractCategory(p) {
                    return (p.category || p.property_category || (p.details && p.details.category) || '').toString();
                }

                function collectQueryCandidates(p) {
                    if (!p || typeof p !== 'object') {
                        return [];
                    }
                    const details = p.details || {};
                    // Aggregate primary fields so free-text filters cover all relevant labels.
                    return [
                        p.city,
                        p.locality,
                        p.property_name,
                        p.title,
                        details.city,
                        details.locality,
                        details.sublocality,
                        details.sub_locality,
                        details.property_name,
                        details.title
                    ].filter(Boolean).map((val) => val.toString());
                }

                // Budget ranges expressed in INR.
                const budgetRanges = {
                    up_to_50k: { min: 0, max: 50000 },
                    '50k_1l': { min: 50000, max: 100000 },
                    '1l_2l': { min: 100000, max: 200000 },
                    '2l_3l': { min: 200000, max: 300000 },
                    '3l_5l': { min: 300000, max: 500000 },
                    '5l_8l': { min: 500000, max: 800000 },
                    '8l_12l': { min: 800000, max: 1200000 },
                    above_12l: { min: 1200000, max: null }
                };

                function passesBudgetFilter(values, rangeKey) {
                    if (!rangeKey || !budgetRanges[rangeKey]) {
                        return true;
                    }
                    const range = budgetRanges[rangeKey];
                    return values.some(function(val) {
                        if (Number.isNaN(val) || val <= 0) {
                            return false;
                        }
                        if (range.min !== null && val < range.min) {
                            return false;
                        }
                        if (range.max !== null && val > range.max) {
                            return false;
                        }
                        return true;
                    });
                }

                // Interpret hero listing modes inside listings grid.
                function matchesListingType(property, filterValue) {
                    if (!filterValue) {
                        return true;
                    }
                    const target = filterValue.toLowerCase();
                    const transaction = (property.transaction_type || property.transactionType || '').toLowerCase();
                    const category = (property.property_category || property.category || '').toLowerCase();
                    const status = (property.status || '').toLowerCase();
                    const details = property.details || {};
                    const availability = (details.availability || '').toLowerCase();

                    if (target === 'rent') {
                        return transaction.includes('rent');
                    }

                    if (target === 'commercial') {
                        return category.includes('commercial');
                    }

                    if (target === 'new_project') {
                        if (availability && availability !== 'ready_to_move' && availability !== 'ready to move') {
                            return true;
                        }
                        if (details.expected_completion) {
                            return true;
                        }
                        if (category.includes('project')) {
                            return true;
                        }
                        if (status && (status.includes('upcoming') || status.includes('launch'))) {
                            return true;
                        }
                        if (transaction && transaction !== 'rent') {
                            return true;
                        }
                        return false;
                    }

                    return true;
                }

                function populateFilters(items) {
                    const types = new Set();
                    const categories = new Set();
                    const cities = new Set();
                    const initialType = (typeSelect && typeSelect.dataset && typeSelect.dataset.initialValue)
                        ? typeSelect.dataset.initialValue.trim()
                        : '';

                    items.forEach(p => {
                        const typeValues = extractTypes(p);
                        typeValues.forEach((value) => {
                            if (value) {
                                types.add(value);
                            }
                        });
                        const c = extractCategory(p);
                        if (c) categories.add(c);
                        if (p.city) cities.add(p.city);
                        // details may contain city/locality too
                        if (p.details && p.details.city) cities.add(p.details.city);
                    });

                    if (initialType) {
                        types.add(initialType);
                    }

                    // helper to fill a select
                    function fill(selectEl, values, placeholder) {
                        if (!selectEl) return;
                        const cur = selectEl.value || '';
                        selectEl.innerHTML = '';
                        const opt = document.createElement('option'); opt.value = ''; opt.textContent = placeholder; selectEl.appendChild(opt);
                        Array.from(values).sort().forEach(v => {
                            const o = document.createElement('option'); o.value = v; o.textContent = v; selectEl.appendChild(o);
                        });
                        // restore if still available
                        if (cur) selectEl.value = cur;
                    }

                    fill(typeSelect, types, 'All Propertys');
                    fill(categorySelect, categories, 'All Categories');
                    fill(citySelect, cities, 'All Cities');

                    if (typeSelect && initialType) {
                        const normalized = initialType.toLowerCase();
                        const options = Array.prototype.slice.call(typeSelect.options || []);
                        const matched = options.find(function(option) {
                            return option.value.toLowerCase() === normalized;
                        });
                        if (matched) {
                            typeSelect.value = matched.value;
                        } else {
                            typeSelect.value = initialType;
                        }
                    }
                }

                function applyFilters() {
                    const queryVal = queryInput ? queryInput.value.trim().toLowerCase() : '';
                    const typeVal = typeSelect ? typeSelect.value.trim().toLowerCase() : '';
                    const catVal = categorySelect ? categorySelect.value.trim().toLowerCase() : '';
                    const priceVal = priceSelect ? (priceSelect.value || '').trim() : '';
                    const cityVal = citySelect ? citySelect.value.trim().toLowerCase() : '';

                    const filtered = allProperties.filter(p => {
                        const details = p && typeof p === 'object' ? (p.details || {}) : {};

                        if (listingTypeFilter && !matchesListingType(p, listingTypeFilter)) {
                            return false;
                        }

                        if (queryVal) {
                            const queryMatches = collectQueryCandidates(p)
                                .map(value => value.toLowerCase())
                                .some(value => value.includes(queryVal));
                            if (!queryMatches) {
                                return false;
                            }
                        }

                        if (typeVal) {
                            const typeMatches = extractTypes(p)
                                .map(value => value.toLowerCase())
                                .some(value => value.includes(typeVal));
                            if (!typeMatches) {
                                return false;
                            }
                        }

                        if (catVal) {
                            const categoryValue = extractCategory(p).toLowerCase();
                            if (!categoryValue.includes(catVal)) {
                                return false;
                            }
                        }

                        if (cityVal) {
                            const cityCandidates = [
                                p.city,
                                p.locality,
                                details.city,
                                details.locality,
                                details.sublocality,
                                details.sub_locality
                            ].filter(Boolean).map(value => value.toString().toLowerCase());
                            if (!cityCandidates.some(value => value.includes(cityVal))) {
                                return false;
                            }
                        }

                        const rawPrice = parsePrice((p.pricing && p.pricing.price) ? p.pricing.price : (p.price || p.avg_price || p.price_per_sqft));
                        const priceCandidates = [];
                        if (!isNaN(rawPrice) && rawPrice > 0) {
                            priceCandidates.push(rawPrice);
                            if (rawPrice < 100000) {
                                priceCandidates.push(rawPrice * 100000);
                            }
                        }

                        if (priceVal && !passesBudgetFilter(priceCandidates, priceVal)) {
                            return false;
                        }

                        return true;
                    });

                    resultsCount.textContent = `${filtered.length} result${filtered.length !== 1 ? 's' : ''}`;

                    if (!filtered || filtered.length === 0) {
                        container.innerHTML = '<div class="col-12 text-center py-5">No properties found.</div>';
                        return;
                    }

                    container.innerHTML = filtered.map((p, idx) => renderCard(p, idx)).join('');
                }

                async function loadProperties(){
                    try{
                        const res = await fetch(apiUrl);
                        if (!res.ok) throw new Error('Network response not ok: ' + res.status);
                        const payload = await res.json();
                        loading?.remove();

                        let items = [];
                        if (Array.isArray(payload)) items = payload;
                        else if (payload && Array.isArray(payload.data)) items = payload.data;
                        else if (payload && payload.status === 'success' && Array.isArray(payload.data)) items = payload.data;

                        allProperties = items || [];

                        if (!allProperties || allProperties.length === 0) {
                            container.innerHTML = '<div class="col-12 text-center py-5">No properties found.</div>';
                            resultsCount.textContent = '0 results';
                            console.info('Properties API returned empty. Payload:', payload);
                            return;
                        }

                        populateFilters(allProperties);
                        applyFilters();
                    }catch(err){
                        console.error('Error loading properties', err);
                        loading?.remove();
                        container.innerHTML = `<div class="col-12 text-center text-danger py-5">Failed to load properties. ${err.message}</div>`;
                        resultsCount.textContent = '';
                    }
                }

                // wire events
                let queryDebounce;
                if (queryInput) {
                    queryInput.addEventListener('input', () => {
                        clearTimeout(queryDebounce);
                        queryDebounce = setTimeout(applyFilters, 250);
                    });
                }

                [typeSelect, categorySelect, priceSelect, citySelect].forEach(el => {
                    if (!el) return;
                    el.addEventListener('change', applyFilters);
                });
                if (clearBtn) clearBtn.addEventListener('click', (e) => {
                    e.preventDefault();
                    if (queryInput) {
                        queryInput.value = '';
                    }
                    if (typeSelect) {
                        typeSelect.value = '';
                        if (typeSelect.dataset) {
                            typeSelect.dataset.initialValue = '';
                        }
                    }
                    [categorySelect, priceSelect, citySelect].forEach(el => { if (el) el.value = ''; });
                    applyFilters();
                });

                container?.addEventListener('click', (event) => {
                    const shareBtn = event.target.closest('.share-btn');
                    if (!shareBtn) return;
                    event.preventDefault();
                    event.stopPropagation();
                    openShareModal(shareBtn.getAttribute('data-share-url'), shareBtn.getAttribute('data-share-title') || 'Property Link');
                });

                if (copyShareBtn && shareLinkInput) {
                    copyShareBtn.addEventListener('click', async () => {
                        const link = shareLinkInput.value;
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
                            setTimeout(() => copyShareBtn.textContent = 'Copy Link', 1500);
                        } catch (error) {
                            console.error('Copy failed', error);
                        }
                    });
                }

                document.addEventListener('DOMContentLoaded', loadProperties);
            })();
        </script>
</body>
</html>
