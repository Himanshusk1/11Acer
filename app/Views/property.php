<?php
$page_title = 'Property Details - 36 Broking Hub';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <?php include 'assets/includes/seo-meta.php'; ?>
<!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <!-- Site styles -->
    <link rel="stylesheet" href="<?= base_url('CSS/style.css') ?>">
    <link rel="stylesheet" href="<?= base_url('CSS/home.css') ?>">
    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">

    <style>
        body {
            font-family: 'Inter', sans-serif;
            background-color: #f5f7fb;
            color: #1f2a37;
            line-height: 1.6;
        }

        h1, h2, h3, h4, h5, h6 { font-weight: 700; }

        .section-title {
            font-weight: 600;
            font-size: 1.1rem;
            text-transform: uppercase;
            letter-spacing: 0.08em;
            color: #0f172a;
            margin-bottom: 1.25rem;
        }

        .main-content { padding: 2.5rem 0; }
        .section-block { margin-bottom: 3rem; }

        .hero-card {
            background: #fff;
            border-radius: 24px;
            box-shadow: 0 20px 60px rgba(15, 23, 42, 0.12);
            padding: 1.75rem;
            height: 100%;
        }

        #propertyCarousel {
            border-radius: 20px;
            overflow: hidden;
            box-shadow: 0 30px 80px rgba(15, 23, 42, 0.18);
            border: 1px solid rgba(99, 102, 241, 0.08);
        }

        #propertyCarousel .carousel-item img {
            width: 100%;
            height: clamp(260px, 55vh, 520px);
            object-fit: cover;
        }

        #propertyCarousel .carousel-indicators [data-bs-target] {
            width: 4px;
            height: 4px;
            border-radius: 50%;
            background: rgba(255, 255, 255, 0.7);
            border: none;
            margin: 0 6px;
            transition: transform 0.2s ease;
        }

        #propertyCarousel .carousel-indicators .active {
            background: #cccccc6e;
            transform: scale(1.3);
        }

        .carousel-control-prev,
        .carousel-control-next {
            width: 3rem;
            height: 3rem;
            top: 50%;
            transform: translateY(-50%);
            border-radius: 50%;
            border: 1px solid rgba(15, 23, 42, 0.08);
            box-shadow: 0 8px 25px rgba(15, 23, 42, 0.18);
        }

        .unit-options .btn-check + .btn {
            border-radius: 999px;
            border: 1px solid #dfe3eb;
            color: #6c757d;
            font-size: 0.9rem;
            padding: 0.4rem 1.25rem;
            background: #fff;
        }

        .unit-options .btn-check:checked + .btn {
            background-color: #e1f7e6;
            color: #198754;
            border-color: #198754;
            box-shadow: inset 0 0 0 1px rgba(25, 135, 84, 0.2);
        }

        .price-highlight {
            background: linear-gradient(135deg, #ffffff 0%, #effaf2 100%);
            border-radius: 24px;
            padding: 1.5rem 1.75rem;
            box-shadow: 0 20px 55px rgba(15, 23, 42, 0.12);
            border: 1px solid rgba(25, 135, 84, 0.15);
            min-width: 260px;
        }

        .property-price-main { font-size: 2.1rem; color: #198754; }
        .price-per-sqft { font-size: 0.95rem; color: #6c757d; }

        .detail-card {
            background: #fff;
            border-radius: 20px;
            border: 1px solid rgba(15, 23, 42, 0.05);
            box-shadow: 0 15px 45px rgba(15, 23, 42, 0.08);
            padding: 1.5rem;
            height: 100%;

        .owner-card-fancy {
            background: linear-gradient(135deg, rgba(25, 135, 84, 0.08), rgba(255, 255, 255, 0.85));
            border: 1px solid rgba(25, 135, 84, 0.25);
            box-shadow: 0 25px 60px rgba(15, 23, 42, 0.15);
            padding: 1.5rem;
        }
        }
        .owner-card-fancy .owner-meta {
            display: flex;
            align-items: center;
            gap: 0.9rem;
        }

        .owner-card-fancy .owner-details {
            display: flex;
            flex-direction: column;
            gap: 0.25rem;
        }

        .owner-card-fancy .owner-contact {
            margin-top: 1rem;
        }

        .owner-card-fancy .badge-owner {
            border-radius: 999px;
            padding: 0.25rem 0.9rem;
            font-size: 0.75rem;
            letter-spacing: 0.1em;
            color: #0f5132;
            background: rgba(25, 135, 84, 0.15);
            text-transform: uppercase;
        }

        .owner-card-fancy .owner-avatar {
            background: linear-gradient(135deg, #fff 0%, rgba(25, 135, 84, 0.2) 100%);
            border: 2px solid rgba(25, 135, 84, 0.35);
        }

        .detail-item {
            display: flex;
            gap: 0.85rem;
            align-items: center;
        }

        .detail-item .icon {
            font-size: 1.35rem;
            color: #198754;
        }

        .amenities-wrap {
            background: linear-gradient(135deg, #ffffff 0%, #eff9ff 100%);
            border-radius: 22px;
            padding: 1.75rem;
            border: 1px solid rgba(15, 23, 42, 0.04);
            box-shadow: 0 18px 45px rgba(15, 23, 42, 0.06);
        }

        #amenities-list .badge {
            background: rgba(25, 135, 84, 0.12);
            color: #198754;
            border-radius: 999px;
            border: none;
            padding: 0.45rem 1.1rem;
            font-weight: 600;
            font-size: 0.85rem;
        }

        #config-list .config-badge {
            background: rgba(25, 135, 84, 0.12);
            color: #1f2a37;
            border-radius: 999px;
            border: none;
            padding: 0.45rem 1.15rem;
            font-weight: 600;
            font-size: 0.85rem;
            display: inline-flex;
            align-items: center;
            gap: 0.35rem;
            box-shadow: inset 0 0 0 1px rgba(25, 135, 84, 0.12);
            white-space: normal;
            line-height: 1.2;
        }

        #config-list .config-badge .config-key {
            color: #198754;
            text-transform: capitalize;
        }

        #config-list .config-badge .config-value {
            color: #0f172a;
            font-weight: 500;
        }

        #config-list .badge-wrapper {
            padding: 0.25rem;
        }

        .floor-plan-card {
            border-radius: 22px;
            border: 1px solid rgba(15, 23, 42, 0.05);
            box-shadow: 0 20px 55px rgba(15, 23, 42, 0.1);
            background: #fff;
        }

        .floor-plan-img {
            max-width: 320px;
            margin: 0 auto 1rem;
            display: block;
            border-radius: 14px;
            border: 1px dashed rgba(60, 72, 88, 0.25);
            padding: 0.85rem;
            background: #f9fafb;
        }

        .cta-pill {
            border-radius: 999px;
            padding: 0.55rem 1.75rem;
        }

        .config-card {
            border-radius: 18px;
            border: 1px solid rgba(15, 23, 42, 0.05);
            background: #fff;
            padding: 1.25rem;
            box-shadow: 0 10px 30px rgba(15, 23, 42, 0.08);
            height: 100%;
        }

        .config-card small {
            letter-spacing: 0.02em;
            text-transform: uppercase;
            font-weight: 600;
            color: #94a3b8;
        }

        .videos-wrap {
            gap: 1.25rem !important;
        }

        .videos-wrap .card {
            border-radius: 20px;
            border: 1px solid rgba(15, 23, 42, 0.05);
            box-shadow: 0 18px 40px rgba(15, 23, 42, 0.1);
        }

        .videos-wrap video { border-radius: 16px; }

        .walkthrough-card {
            border-radius: 20px;
            background: linear-gradient(145deg, rgba(25, 135, 84, 0.08), rgba(15, 23, 42, 0.05));
            border: 1px solid rgba(25, 135, 84, 0.25);
            color: #0f172a;
        }

        .property-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            flex-wrap: wrap;
            gap: 0.75rem;
        }

        .property-share-btn {
            display: inline-flex;
            align-items: center;
            gap: 0.45rem;
            border-radius: 999px;
            border: 1px solid #198754;
            background: #fff;
            color: #198754;
            font-weight: 600;
            padding: 0.55rem 1.15rem;
            transition: background-color 0.2s ease, color 0.2s ease, box-shadow 0.2s ease;
        }

        .property-share-btn:hover,
        .property-share-btn:focus {
            background: #198754;
            color: #fff;
            box-shadow: 0 10px 24px rgba(25, 135, 84, 0.25);
        }

        .property-share-btn:disabled {
            opacity: 0.6;
            cursor: not-allowed;
            box-shadow: none;
        }

        .property-share-btn i {
            font-size: 1rem;
        }

        .share-modal .modal-content {
            border-radius: 16px;
            border: none;
            box-shadow: 0 25px 70px rgba(12, 12, 20, 0.18);
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
            border: 1px solid rgba(25, 135, 84, 0.2);
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

        .walkthrough-link {
            background: #fff;
            border-radius: 999px;
            padding: 0.4rem 1rem;
            font-weight: 600;
            color: #0f172a;
            font-size: 0.85rem;
            border: 1px solid rgba(15, 23, 42, 0.1);
            display: inline-flex;
            align-items: center;
            gap: 0.35rem;
            text-decoration: none;
        }

        .walkthrough-link:hover {
            background: #f1fff4;
            border-color: #198754;
            color: #198754;
        }

        .contact-card {
            background: linear-gradient(135deg, #198754 0%, #38c172 85%);
            color: #fff;
            border-radius: 22px;
            padding: 1.5rem;
            box-shadow: 0 18px 45px rgba(25, 135, 84, 0.4);
        }

        .contact-card .btn {
            background: #fff;
            color: #198754;
            border-radius: 999px;
            font-weight: 600;
            padding: 0.65rem 1rem;
        }

        .owner-card {
            border-radius: 22px;
            border: 1px solid rgba(15, 23, 42, 0.08);
            box-shadow: 0 14px 40px rgba(15, 23, 42, 0.12);
            background: #fff;
            padding: 1.25rem;
        }

        .owner-card .owner-avatar {
            width: 48px;
            height: 48px;
            border-radius: 50%;
            display: inline-flex;
            justify-content: center;
            align-items: center;
            font-weight: 700;
            background: rgba(25, 135, 84, 0.12);
            color: #198754;
        }

        .owner-card .owner-contact a {
            font-weight: 600;
        }

        .property-listing-card {
            border-radius: 22px;
            border: 1px solid rgba(15, 23, 42, 0.04);
            background: #fff;
            overflow: hidden;
            box-shadow: 0 25px 65px rgba(15, 23, 42, 0.12);
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            height: 100%;
        }

        .property-listing-card:hover {
            transform: translateY(-6px);
            box-shadow: 0 35px 80px rgba(15, 23, 42, 0.18);
        }

        .property-listing-card .card-img-top {
            height: 200px;
            object-fit: cover;
        }

        .property-listing-card .card-body { padding: 1.4rem; }

        .property-listing-card .card-title { font-size: 1.05rem; margin-bottom: 0.35rem; }

        .lightbox-overlay {
            position: fixed;
            inset: 0;
            background: rgba(15, 23, 42, 0.93);
            backdrop-filter: blur(8px);
            display: flex;
            align-items: center;
            justify-content: center;
            z-index: 1080;
            opacity: 0;
            visibility: hidden;
            transition: opacity 0.25s ease, visibility 0.25s ease;
            padding: 1rem;
        }

        .lightbox-overlay.show {
            opacity: 1;
            visibility: visible;
        }

        .lightbox-stage {
            position: relative;
            max-width: min(1200px, 100%);
            width: 100%;
            height: min(80vh, 720px);
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .lightbox-image {
            max-width: 100%;
            max-height: 100%;
            width: auto;
            height: auto;
            border-radius: 18px;
            box-shadow: 0 25px 80px rgba(0, 0, 0, 0.4);
            transition: transform 0.3s ease;
        }

        .lightbox-counter {
            position: absolute;
            top: 1rem;
            left: 50%;
            transform: translateX(-50%);
            color: #fff;
            font-weight: 600;
            letter-spacing: 0.1em;
            text-shadow: 0 4px 20px rgba(0, 0, 0, 0.45);
        }

        .lightbox-nav {
            position: absolute;
            top: 50%;
            transform: translateY(-50%);
            width: 52px;
            height: 52px;
            border-radius: 50%;
            border: none;
            background: rgba(255, 255, 255, 0.15);
            color: #fff;
            font-size: 1.35rem;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: background 0.2s ease;
        }

        .lightbox-nav:hover { background: rgba(255, 255, 255, 0.3); }

        .lightbox-nav.prev { left: 1rem; }
        .lightbox-nav.next { right: 1rem; }

        .lightbox-close {
            position: absolute;
            top: 1rem;
            right: 1rem;
            z-index: 2;
        }

        .lightbox-trigger { cursor: zoom-in; }

        hr { color: #e2e8f0; margin: 2.75rem 0; }

        @media (max-width: 1199px) {
            .hero-card { padding: 1.5rem; }
        }

        @media (max-width: 991px) {
            .main-content { padding: 1.75rem 0; }
            .section-block { margin-bottom: 2.25rem; }
            .hero-card { padding: 1.25rem; }
            .price-highlight { width: 100%; }
        }

        @media (max-width: 767px) {
            body { font-size: 0.95rem; }
            .price-highlight { padding: 1.1rem 1.25rem; }
            .property-price-main { font-size: 1.7rem; }
            #propertyCarousel .carousel-item img { height: 260px; }
        }

        @media (max-width: 575px) {
            .hero-card { border-radius: 18px; }
            .unit-options .btn-check + .btn { width: 100%; text-align: center; }
            .price-highlight { flex-direction: column; align-items: flex-start; }
            .videos-wrap video { height: 200px; }
        }
    </style>
    <link rel="icon" type="image/x-icon" href="<?= base_url('images/favicon/favicon.ico') ?>">
</head>
<body>
    <?= $this->include('layouts/header') ?>

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

    <main class="main-content">
        <div class="container">
            <div class="row">
                <!-- Main Content Column -->
                <div>
                    <!-- Image Slider (Bootstrap 5.3) -->
                    <section class="section-block" data-aos="fade-up">
                        <div class="row g-4 align-items-stretch">
                            <div class="col-12 col-xl-8">
                                <div class="hero-card h-100">
                                    <div id="propertyCarousel" class="carousel slide" data-bs-ride="carousel" data-bs-interval="3500">
                                        <div class="carousel-indicators" id="carousel-indicators">
                                            <!-- indicators populated dynamically -->
                                        </div>
                                        <div id="carousel-inner" class="carousel-inner rounded-3 overflow-hidden">
                                            <!-- slides populated dynamically -->
                                        </div>
                                        <button class="carousel-control-prev" type="button" data-bs-target="#propertyCarousel" data-bs-slide="prev">
                                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                            <span class="visually-hidden">Previous</span>
                                        </button>
                                        <button class="carousel-control-next" type="button" data-bs-target="#propertyCarousel" data-bs-slide="next">
                                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                            <span class="visually-hidden">Next</span>
                                        </button>
                                    </div>
                                    <div class="property-header mt-4">
                                        <h1 id="property-title" class="h3 mb-0 flex-grow-1">Loading property...</h1>
                                        <button type="button" class="property-share-btn" id="property-share" disabled>
                                            <i class="bi bi-share"></i>
                                            Share
                                        </button>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 col-xl-4">
                                <div class="vstack gap-4 videos-wrap" id="video-stack">
                                    <!-- videos will be injected here (one per uploaded video) -->
                                    <div class="contact-card">
                                        <div class="d-flex align-items-center gap-3 mb-3">
                                            <div class="bg-white text-success rounded-circle d-flex align-items-center justify-content-center" style="width:48px;height:48px;">
                                                <i class="bi bi-chat-dots fs-4"></i>
                                            </div>
                                            <div>
                                                <p class="mb-0 text-uppercase small">Need Assistance?</p>
                                                <h6 class="mb-0">Contact an Agent</h6>
                                            </div>
                                        </div>
                                        <p class="small mb-3">Use the contact button on the property to reach out to the agent directly for site visits or more information.</p>
                                        <button class="btn w-100">Contact Now</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </section>
                    <style>
                        #propertyCarousel .carousel-item img { height: 480px; object-fit: cover; }
                        @media (max-width: 768px){ #propertyCarousel .carousel-item img { height: 320px; } }
                    </style>

                    <!-- Unit Options & Pricing -->
                    <section class="section-block" data-aos="fade-up" data-aos-delay="80">
                        <h4 class="section-title">Pricing</h4>
                        <div class="d-flex flex-column flex-lg-row justify-content-between gap-3 align-items-start align-items-lg-center">
                            <div class="price-highlight d-flex gap-3 align-items-center w-100 w-lg-auto">
                                <div class="rounded-circle bg-white shadow-sm d-flex align-items-center justify-content-center" style="width:52px;height:52px;">
                                    <i class="bi bi-currency-rupee text-success fs-4"></i>
                                </div>
                                <div>
                                    <div class="text-uppercase text-muted small fw-semibold">Current Price</div>
                                    <div id="property-price-main" class="property-price-main">Loading...</div>
                                    <div id="property-price-per-sqft" class="price-per-sqft">&nbsp;</div>
                                </div>
                            </div>
                        </div>
                    </section>

                    <!-- Property Details -->
                    <section id="property-details-section" class="section-block d-none" data-aos="fade-up" data-aos-delay="200">
                        <h4 class="section-title">Property Details</h4>
                        <div class="detail-card">
                            <p id="property-overview" class="text-muted mb-2"></p>
                            <a href="#" id="property-readmore" class="fw-bold text-decoration-none" style="display:none">Read More</a>
                        </div>
                    </section>

                    <section class="section-block d-none" data-aos="fade-up" data-aos-delay="220" id="floor-plan-section">
                        <h4 class="section-title">Floor Plan</h4>
                        <div id="floor-plan-content" class="floor-plan-card text-center p-4"></div>
                    </section>

                    <hr>

                    <!-- Overview -->
                    <section class="section-block" data-aos="fade-up" data-aos-delay="240">
                        <h4 class="section-title">Overview</h4>
                        <div class="row g-3">
                            <div class="col-md-6">
                                <div class="detail-card h-100">
                                    <div class="detail-item mb-3">
                                        <div class="icon-wrap bg-success-subtle text-success rounded-circle d-flex align-items-center justify-content-center" style="width:48px;height:48px;">
                                            <i class="bi bi-calendar-check icon"></i>
                                        </div>
                                        <div>
                                            <span class="text-muted small text-uppercase">Possession Starts</span>
                                            <div class="fw-bold" id="property-possession">-</div>
                                        </div>
                                    </div>
                                    <div class="detail-item">
                                        <div class="icon-wrap bg-primary-subtle text-primary rounded-circle d-flex align-items-center justify-content-center" style="width:48px;height:48px;">
                                            <i class="bi bi-rulers icon"></i>
                                        </div>
                                        <div>
                                            <span class="text-muted small text-uppercase">Area</span>
                                            <div class="fw-bold" id="property-area">-</div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                             <div class="col-md-6">
                                <div class="detail-card h-100">
                                    <div class="detail-item mb-3">
                                        <div class="icon-wrap bg-warning-subtle text-warning rounded-circle d-flex align-items-center justify-content-center" style="width:48px;height:48px;">
                                            <i class="bi bi-tag icon"></i>
                                        </div>
                                        <div>
                                            <span class="text-muted small text-uppercase">Avg Price</span>
                                            <div class="fw-bold" id="property-avgprice">-</div>
                                        </div>
                                    </div>
                                    <div class="detail-item">
                                        <div class="icon-wrap bg-info-subtle text-info rounded-circle d-flex align-items-center justify-content-center" style="width:48px;height:48px;">
                                            <i class="bi bi-building icon"></i>
                                        </div>
                                        <div>
                                            <span class="text-muted small text-uppercase">Configuration</span>
                                            <div class="fw-bold" id="property-configuration">-</div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </section>

                    <hr>

                    <!-- Configuration & Details -->
                    <section class="section-block" data-aos="fade-up" data-aos-delay="280">
                        <h4 class="section-title">Configuration & Details</h4>
                        <div class="amenities-wrap mb-3">
                            <div id="config-list" class="row g-3"></div>
                        </div>
                    </section>

                    <section class="section-block d-none" id="amenities-section" data-aos="fade-up" data-aos-delay="320">
                        <h4 class="section-title">Amenities</h4>
                        <div class="amenities-wrap" id="amenities-wrap">
                            <div id="amenities-list" class="row g-2"></div>
                        </div>
                    </section>
                    <!-- <div id="details-render" class="mb-3"></div> -->

                    <!-- Similar Properties -->
                    <section class="section-block">
                        <h4 class="section-title">Similar Properties</h4>
                        <div class="row g-4" id="similar-row">
                            <!-- similar properties injected here -->
                        </div>
                    </section>

                </div>
            </div>
        </div>
    </main>

    <div id="lightbox-overlay" class="lightbox-overlay" aria-hidden="true">
        <button type="button" class="btn-close btn-close-white lightbox-close" id="lightbox-close" aria-label="Close fullscreen viewer"></button>
        <div class="lightbox-stage">
            <div class="lightbox-counter" id="lightbox-counter">0 / 0</div>
            <button class="lightbox-nav prev" type="button" id="lightbox-prev" aria-label="Previous image">
                <i class="bi bi-chevron-left"></i>
            </button>
            <img src="" alt="Fullscreen property preview" class="lightbox-image" id="lightbox-image">
            <button class="lightbox-nav next" type="button" id="lightbox-next" aria-label="Next image">
                <i class="bi bi-chevron-right"></i>
            </button>
        </div>
    </div>

    <?= $this->include('layouts/modal') ?>
    <?= $this->include('layouts/footer') ?>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        (async function(){
            const apiUrl = '<?= site_url("api/property/all") ?>';
            const detailUrl = '<?= site_url("property") ?>';
            const carouselPlaceholder = '<?= base_url('images/property.png') ?>';
            const qs = new URLSearchParams(window.location.search);
            const id = qs.get('id');
            const titleEl = document.getElementById('property-title');
            const bodyEl = document.body;

            const lightboxOverlay = document.getElementById('lightbox-overlay');
            const lightboxImageEl = document.getElementById('lightbox-image');
            const lightboxCounterEl = document.getElementById('lightbox-counter');
            const lightboxPrevBtn = document.getElementById('lightbox-prev');
            const lightboxNextBtn = document.getElementById('lightbox-next');
            const lightboxCloseBtn = document.getElementById('lightbox-close');
            let lightboxImages = [];
            let lightboxIndex = 0;
            let lightboxActive = false;
            let touchStartX = null;
            const floorPlanSection = document.getElementById('floor-plan-section');
            const floorPlanContent = document.getElementById('floor-plan-content');
            const propertyDetailsSection = document.getElementById('property-details-section');
            const shareButton = document.getElementById('property-share');
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
                linkedin: document.getElementById('shareLinkedIn')
            };

            let sharePayload = {
                url: window.location.href,
                title: 'Property Link'
            };

            function openShareModal(url, title = 'Property Link') {
                if (!shareModalInstance || !shareLinkInput) return;
                const cleanUrl = url || window.location.href;
                shareLinkInput.value = cleanUrl;
                if (shareTitleEl) shareTitleEl.textContent = title;

                const encodedUrl = encodeURIComponent(cleanUrl);
                const encodedMessage = encodeURIComponent(`${title} - ${cleanUrl}`);

                if (shareTargets.whatsapp) shareTargets.whatsapp.href = `https://wa.me/?text=${encodedMessage}`;
                if (shareTargets.facebook) shareTargets.facebook.href = `https://www.facebook.com/sharer/sharer.php?u=${encodedUrl}`;
                if (shareTargets.instagram) shareTargets.instagram.href = `https://www.instagram.com/?url=${encodedUrl}`;
                if (shareTargets.x) shareTargets.x.href = `https://twitter.com/intent/tweet?text=${encodedMessage}`;
                if (shareTargets.linkedin) shareTargets.linkedin.href = `https://www.linkedin.com/sharing/share-offsite/?url=${encodedUrl}`;

                shareModalInstance.show();
            }

            if (shareButton) {
                shareButton.addEventListener('click', () => openShareModal(sharePayload.url, sharePayload.title));
            }

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

            function renderLightboxFrame() {
                if (!lightboxImages.length || !lightboxImageEl || !lightboxCounterEl) return;
                const frame = lightboxImages[lightboxIndex];
                lightboxImageEl.src = frame.src;
                lightboxImageEl.alt = frame.alt || 'Property preview image';
                lightboxCounterEl.textContent = (lightboxIndex + 1) + ' / ' + lightboxImages.length;
            }

            function openLightbox(index = 0) {
                if (!lightboxImages.length || !lightboxOverlay) return;
                lightboxIndex = index;
                lightboxActive = true;
                renderLightboxFrame();
                lightboxOverlay.classList.add('show');
                lightboxOverlay.setAttribute('aria-hidden', 'false');
                bodyEl?.classList.add('overflow-hidden');
            }

            function closeLightbox() {
                lightboxActive = false;
                lightboxOverlay?.classList.remove('show');
                lightboxOverlay?.setAttribute('aria-hidden', 'true');
                bodyEl?.classList.remove('overflow-hidden');
            }

            function showNextLightbox() {
                if (!lightboxImages.length) return;
                lightboxIndex = (lightboxIndex + 1) % lightboxImages.length;
                renderLightboxFrame();
            }

            function showPrevLightbox() {
                if (!lightboxImages.length) return;
                lightboxIndex = (lightboxIndex - 1 + lightboxImages.length) % lightboxImages.length;
                renderLightboxFrame();
            }

            function setupLightbox(images) {
                if (!Array.isArray(images) || !images.length) return;
                lightboxImages = images;
                const carouselImages = document.querySelectorAll('#carousel-inner .carousel-item img');
                carouselImages.forEach((img, idx) => {
                    img.classList.add('lightbox-trigger');
                    img.addEventListener('click', () => openLightbox(idx));
                });
            }

            document.addEventListener('keydown', evt => {
                if (!lightboxActive) return;
                if (evt.key === 'Escape') {
                    evt.preventDefault();
                    closeLightbox();
                } else if (evt.key === 'ArrowRight') {
                    evt.preventDefault();
                    showNextLightbox();
                } else if (evt.key === 'ArrowLeft') {
                    evt.preventDefault();
                    showPrevLightbox();
                }
            });

            if (lightboxOverlay) {
                lightboxOverlay.addEventListener('click', evt => {
                    if (evt.target === lightboxOverlay) closeLightbox();
                });
                lightboxOverlay.addEventListener('touchstart', evt => {
                    touchStartX = evt.changedTouches && evt.changedTouches[0] ? evt.changedTouches[0].clientX : null;
                }, { passive: true });
                lightboxOverlay.addEventListener('touchend', evt => {
                    if (touchStartX === null) return;
                    const endX = evt.changedTouches && evt.changedTouches[0] ? evt.changedTouches[0].clientX : null;
                    if (endX === null) return;
                    const delta = endX - touchStartX;
                    if (Math.abs(delta) > 40) {
                        if (delta > 0) showPrevLightbox(); else showNextLightbox();
                    }
                    touchStartX = null;
                });
            }

            lightboxPrevBtn?.addEventListener('click', showPrevLightbox);
            lightboxNextBtn?.addEventListener('click', showNextLightbox);
            lightboxCloseBtn?.addEventListener('click', closeLightbox);
            if (!id) {
                if (titleEl) titleEl.textContent = 'Property not specified';
                return;
            }

            function safeText(v, fallback='N/A') { return (v !== undefined && v !== null && v !== '') ? v : fallback; }
            function escapeHtml(value) {
                if (value === null || value === undefined) return '';
                return String(value)
                    .replace(/&/g, '&amp;')
                    .replace(/</g, '&lt;')
                    .replace(/>/g, '&gt;')
                    .replace(/"/g, '&quot;')
                    .replace(/'/g, '&#039;');
            }

            try {
                const res = await fetch(apiUrl);
                if (!res.ok) throw new Error('Failed to fetch properties: ' + res.status);
                const payload = await res.json();
                let items = [];
                if (Array.isArray(payload)) items = payload;
                else if (payload && Array.isArray(payload.data)) items = payload.data;

                const prop = items.find(p => String(p.id) === String(id));
                if (!prop) {
                    if (titleEl) titleEl.textContent = 'Property not found';
                    return;
                }

                // Basic fields
                const title = prop.property_name || prop.title || prop.name || 'Untitled Property';
                if (titleEl) titleEl.textContent = title;
                sharePayload = {
                    url: `${detailUrl}?id=${prop.id}`,
                    title
                };
                if (shareButton) {
                    shareButton.disabled = false;
                    shareButton.setAttribute('aria-label', `Share ${title}`);
                }

                const priceVal = (prop.pricing && prop.pricing.price) ? prop.pricing.price : (prop.price || prop.avg_price || '');
                const priceMainEl = document.getElementById('property-price-main');
                const pricePsfEl = document.getElementById('property-price-per-sqft');
                if (priceMainEl) priceMainEl.textContent = priceVal ? ('₹ ' + String(priceVal)) : 'Contact for price';
                const pps = prop.price_per_sqft || (prop.pricing && prop.pricing.price_per_sqft) || '';
                if (pricePsfEl) pricePsfEl.textContent = pps ? ('₹ ' + String(pps) + '/sq.ft') : '';

                const overviewEl = document.getElementById('property-overview');
                const descRaw = (prop.details && (prop.details.description || prop.details.unique_features)) || prop.description || '';
                const desc = descRaw.trim();
                if (overviewEl) overviewEl.textContent = desc;
                const readMore = document.getElementById('property-readmore');
                if (readMore) readMore.style.display = desc ? 'inline-block' : 'none';
                if (propertyDetailsSection) {
                    propertyDetailsSection.classList.toggle('d-none', !desc);
                }

                // Small detail fields
                const possessionEl = document.getElementById('property-possession');
                const areaEl = document.getElementById('property-area');
                const avgPriceEl = document.getElementById('property-avgprice');
                const configEl = document.getElementById('property-configuration');
                if (possessionEl) possessionEl.textContent = safeText((prop.details && prop.details.availability) || prop.possession_status || 'N/A');
                if (areaEl) areaEl.textContent = (prop.details && prop.details.area_sqft) ? (prop.details.area_sqft + ' sq.ft') : (prop.area_sqft ? prop.area_sqft + ' sq.ft' : 'N/A');
                if (avgPriceEl) avgPriceEl.textContent = priceVal ? ('₹ ' + String(priceVal)) : 'N/A';
                if (configEl) configEl.textContent = prop.configuration || (prop.details && prop.details.configuration) || 'N/A';

                // Build carousel from images only, and place videos into the sidebar stack
                const media = prop.media || [];
                const images = media.filter(m => {
                    const url = (m.file_url || m.url || m.fileUrl || '').toString();
                    const isVideo = (m.file_type && m.file_type === 'video') || /\.(mp4|webm|ogg)$/i.test(url);
                    return !isVideo;
                });
                const videos = media.filter(m => {
                    const url = (m.file_url || m.url || m.fileUrl || '').toString();
                    return (m.file_type && m.file_type === 'video') || /\.(mp4|webm|ogg)$/i.test(url);
                });
                const floorPlans = media.filter(m => {
                    const type = (m.file_type || '').toString().toLowerCase();
                    if (type === 'floor_plan') return true;
                    const url = (m.file_url || m.url || m.fileUrl || '').toString();
                    return /floor[-_ ]plan/i.test(url);
                });

                const ownerInfo = getOwnerInfo(prop);
                const ownerCardElement = ownerInfo ? buildOwnerCard(ownerInfo) : null;

                const indicators = document.getElementById('carousel-indicators');
                const inner = document.getElementById('carousel-inner');
                indicators.innerHTML = '';
                inner.innerHTML = '';

                let lightboxSources = [];
                if (!images.length) {
                    // fallback placeholder slide
                    const btn = document.createElement('button');
                    btn.type = 'button'; btn.setAttribute('data-bs-target', '#propertyCarousel'); btn.setAttribute('data-bs-slide-to', '0');
                    btn.className = 'active'; btn.setAttribute('aria-current', 'true'); btn.setAttribute('aria-label', 'Slide 1');
                    indicators.appendChild(btn);
                    const wrap = document.createElement('div'); wrap.className = 'carousel-item active';
                    wrap.innerHTML = '<img src="' + carouselPlaceholder + '" class="d-block w-100" alt="No Image">';
                    inner.appendChild(wrap);
                    lightboxSources = [{ src: carouselPlaceholder, alt: title + ' preview' }];
                } else {
                    lightboxSources = [];
                    images.forEach((m, i) => {
                        const isActive = i === 0 ? 'active' : '';
                        const indicator = document.createElement('button');
                        indicator.type = 'button';
                        indicator.setAttribute('data-bs-target', '#propertyCarousel');
                        indicator.setAttribute('data-bs-slide-to', String(i));
                        if (i === 0) { indicator.className = 'active'; indicator.setAttribute('aria-current', 'true'); }
                        indicator.setAttribute('aria-label', 'Slide ' + (i+1));
                        indicators.appendChild(indicator);

                        const wrap = document.createElement('div'); wrap.className = 'carousel-item ' + isActive;
                        const url = m.file_url || m.url || m.fileUrl || carouselPlaceholder;
                        wrap.innerHTML = '<img src="' + url + '" class="d-block w-100" alt="Property image">';
                        inner.appendChild(wrap);
                        lightboxSources.push({ src: url, alt: title + ' preview' });
                    });
                }
                setupLightbox(lightboxSources);
                    if (floorPlanContent) {
                        if (floorPlans.length) {
                            const plan = floorPlans[0];
                            const planUrl = (plan.file_url || plan.url || plan.fileUrl || '').toString();
                            if (planUrl) {
                                const encodedPlanUrl = encodeURI(planUrl);
                                floorPlanContent.innerHTML = `
                                    <a href="${encodedPlanUrl}" target="_blank" rel="noreferrer noopener" class="d-inline-block w-100 mb-2">
                                        <img src="${encodedPlanUrl}" alt="Floor plan" class="floor-plan-img img-fluid">
                                    </a>
                                    <p class="text-muted small mb-0">Tap the floor plan to view or download.</p>
                                `;
                                floorPlanSection?.classList.remove('d-none');
                            } else {
                                floorPlanContent.innerHTML = '';
                                floorPlanSection?.classList.add('d-none');
                            }
                        } else {
                            floorPlanContent.innerHTML = '';
                            floorPlanSection?.classList.add('d-none');
                        }
                    }

                // Populate video-stack in sidebar
                const videoStack = document.getElementById('video-stack');
                if (videoStack) {
                    // keep the contact card at the end; clear others
                    const contactHtml = `
                        <div class="contact-card">
                            <div class="d-flex align-items-center gap-3 mb-3">
                                <div class="bg-white text-success rounded-circle d-flex align-items-center justify-content-center" style="width:48px;height:48px;">
                                    <i class="bi bi-chat-dots fs-4"></i>
                                </div>
                                <div>
                                    <p class="mb-0 text-uppercase small">Need Assistance?</p>
                                    <h6 class="mb-0">Contact an Agent</h6>
                                </div>
                            </div>
                            <p class="small mb-3">Use the contact button on the property to reach out to the agent directly for site visits or more information.</p>
                            <button class="btn w-100">Contact Now</button>
                        </div>`;
                    videoStack.innerHTML = '';
                    if (videos.length) {
                        videos.forEach(v => {
                            const url = v.file_url || v.url || v.fileUrl || '';
                            const card = document.createElement('div'); card.className = 'card p-2';
                            card.innerHTML = '<video controls style="width:100%;height:180px;object-fit:cover;border-radius:8px"><source src="' + url + '"></video>';
                            videoStack.appendChild(card);
                        });
                    }
                    const videoLinks = (Array.isArray(prop.video_links) ? prop.video_links : []).map(link => (link || '').trim()).filter(Boolean);
                    if (videoLinks.length) {
                        const linksCard = document.createElement('div');
                        linksCard.className = 'walkthrough-card p-3';
                        let listHtml = '<div class="d-flex align-items-center gap-2 mb-2 text-success fw-semibold"><i class="bi bi-play-btn-fill fs-5"></i><span>Walkthrough Links</span></div><div class="d-flex flex-wrap gap-2">';
                        videoLinks.forEach(link => {
                            const safeText = escapeHtml(link);
                            const href = encodeURI(link);
                            listHtml += '<a href="' + href + '" target="_blank" rel="noreferrer noopener" class="walkthrough-link">' + safeText + '</a>';
                        });
                        listHtml += '</div>';
                        linksCard.innerHTML = listHtml;
                        videoStack.appendChild(linksCard);
                    }
                    if (ownerCardElement) {
                        videoStack.appendChild(ownerCardElement);
                    }
                    // append contact card last
                    const contactWrap = document.createElement('div'); contactWrap.innerHTML = contactHtml; videoStack.appendChild(contactWrap);
                }

                // Populate amenities and configuration from details JSON with a polished UI
                const details = prop.details || {};
                const amenitiesList = document.getElementById('amenities-list');
                const amenitiesSection = document.getElementById('amenities-section');
                const configList = document.getElementById('config-list');
                const detailsRender = document.getElementById('details-render');

                function formatValue(v) {
                    if (v === null || v === undefined || v === '') return '<span class="text-muted">N/A</span>';
                    if (Array.isArray(v)) return '<ul class="mb-0 ps-3">' + v.map(i => '<li>' + escapeHtml(i) + '</li>').join('') + '</ul>';
                    if (typeof v === 'object') return '<pre style="white-space:pre-wrap;margin:0">' + escapeHtml(JSON.stringify(v, null, 2)) + '</pre>';
                    // boolean prettify
                    if (typeof v === 'boolean') return v ? 'Yes' : 'No';
                    return escapeHtml(String(v));
                }

                function hasRenderableValue(v) {
                    if (v === null || v === undefined) return false;
                    if (typeof v === 'string') {
                        const trimmed = v.trim();
                        if (!trimmed) return false;
                        return trimmed.toLowerCase() !== 'n/a';
                    }
                    if (Array.isArray(v)) return v.length > 0;
                    if (typeof v === 'object') return Object.keys(v).length > 0;
                    return true;
                }

                function formatBadgeValue(v) {
                    if (v === null || v === undefined) return 'N/A';
                    if (typeof v === 'string') return escapeHtml(v);
                    if (typeof v === 'boolean') return v ? 'Yes' : 'No';
                    if (Array.isArray(v)) {
                        if (!v.length) return 'N/A';
                        return v.map(item => escapeHtml(String(item))).join(', ');
                    }
                    if (typeof v === 'object') {
                        const entries = Object.entries(v);
                        if (!entries.length) return 'N/A';
                        return escapeHtml(entries.map(([key, val]) => `${key}: ${typeof val === 'object' ? JSON.stringify(val) : val}`).join(', '));
                    }
                        return escapeHtml(String(v));
                }

                function formatPostedOn(value) {
                    if (!value || typeof value !== 'string') return value;
                    const normalized = value.replace(' ', 'T');
                    const date = new Date(normalized);
                    if (Number.isNaN(date.getTime())) return value;
                    const datePart = date.toLocaleDateString('en-IN', { day: '2-digit', month: 'short', year: 'numeric' });
                    let hours = date.getHours();
                    const minutes = date.getMinutes().toString().padStart(2, '0');
                    const ampm = hours >= 12 ? 'PM' : 'AM';
                    hours = hours % 12 || 12;
                    return `${datePart}, ${hours}:${minutes} ${ampm}`;
                }

                function getOwnerInfo(property) {
                    const user = property.user || {};
                    const name = (user.full_name || user.first_name || user.name || property.posted_by_name || property.user_name || property.user_full_name || property.agent_name || 'Property Owner').trim();
                    if (!name) return null;
                    const role = user.role || 'Listing Owner';
                    const phone = user.phone_number || user.mobile || user.contact_number || property.contact_phone || (property.details && property.details.contact_number) || '';
                    const email = user.email || property.user_email || property.contact_email || '';
                    const postedOnRaw = (property.details && property.details.posted_on) || property.posted_on || property.created_at || '';
                    const postedOn = formatPostedOn(postedOnRaw);
                    return {
                        name,
                        role,
                        phone,
                        email,
                        postedOn: postedOn || ''
                    };
                }

                function buildOwnerCard(info) {
                    const card = document.createElement('div');
                    card.className = 'owner-card owner-card-fancy mb-3';
                    const initials = (info.name || 'Owner').split(' ').map(s => s.charAt(0)).filter(Boolean).slice(0, 2).join('').toUpperCase() || 'PO';
                    const phoneLink = info.phone ? 'tel:' + info.phone.replace(/[^0-9+]/g, '') : '';
                    const emailLink = info.email ? 'mailto:' + info.email : '';
                    const metaSection = info.postedOn ? `<span class="text-muted small">${escapeHtml(info.postedOn)}</span>` : '';
                    card.innerHTML = `
                        <div class="owner-meta">
                            <div class="owner-avatar">${escapeHtml(initials)}</div>
                            <div class="owner-details">
                                <p class="text-uppercase small text-muted mb-1">Property posted by</p>
                                <div class="d-flex align-items-center gap-2">
                                    <h6 class="mb-0">${escapeHtml(info.name)}</h6>
                                    <span class="badge-owner">${escapeHtml(info.role)}</span>
                                </div>
                                ${metaSection}
                            </div>
                        </div>
                        <div class="owner-contact d-flex flex-wrap gap-2">
                            ${phoneLink ? `<a href="${phoneLink}" class="btn btn-sm btn-outline-success">Call</a>` : ''}
                            ${emailLink ? `<a href="${emailLink}" class="btn btn-sm btn-outline-success">Email</a>` : ''}
                            ${(!phoneLink && !emailLink) ? '<span class="text-muted small">Contact details unavailable</span>' : ''}
                        </div>
                    `;
                    return card;
                }

                function normalizeAmenityValue(val) {
                    if (val === null || val === undefined) return [];
                    if (Array.isArray(val)) return val.filter(Boolean).map(item => String(item).trim()).filter(Boolean);
                    if (typeof val === 'string') return val.split(/[,|]/).map(s => s.trim()).filter(Boolean);
                    if (typeof val === 'object') return Object.values(val).map(v => String(v).trim()).filter(Boolean);
                    return [String(val).trim()].filter(Boolean);
                }

                function collectAmenities(detailsObj) {
                    if (!detailsObj) return [];
                    const primary = detailsObj.amenities || detailsObj.amenities_list || detailsObj.amenitiesArray;
                    let amenities = normalizeAmenityValue(primary);
                    if (amenities.length) return amenities;
                    const keys = Object.keys(detailsObj || {});
                    keys.forEach(key => {
                        if (key.toLowerCase().includes('amen') || key.toLowerCase().includes('facility')) {
                            amenities = amenities.concat(normalizeAmenityValue(detailsObj[key]));
                        }
                    });
                    return amenities.filter(Boolean);
                }

                // Amenities as badges
                if (amenitiesList && amenitiesSection) {
                    amenitiesList.innerHTML = '';
                    const amenityItems = collectAmenities(details);
                    if (amenityItems.length) {
                        amenitiesSection.classList.remove('d-none');
                        const wrap = document.createElement('div'); wrap.className = 'col-12';
                        amenityItems.forEach(am => {
                            const span = document.createElement('span');
                            span.className = 'badge me-2 mb-2';
                            span.textContent = String(am);
                            wrap.appendChild(span);
                        });
                        amenitiesList.appendChild(wrap);
                    } else {
                        amenitiesSection.classList.add('d-none');
                    }
                }

                // Configuration: render each key as a card with formatted value
                if (configList) {
                    configList.innerHTML = '';
                    const keys = Object.keys(details)
                        .filter(k => hasRenderableValue(details[k]))
                        .filter(k => !/amen|facility/i.test(k));
                    if (keys.length) {
                        keys.forEach(k => {
                            let v = details[k];
                            if (typeof k === 'string' && k.toLowerCase().includes('posted')) {
                                const formatted = formatPostedOn(typeof v === 'string' ? v : '');
                                v = formatted || v;
                            }
                            const badgeWrap = document.createElement('div'); badgeWrap.className = 'col-auto badge-wrapper';
                            const label = escapeHtml(k.replace(/_/g, ' '));
                            badgeWrap.innerHTML = '<span class="badge config-badge"><span class="config-key">' + label + ':</span><span class="config-value">' + formatBadgeValue(v) + '</span></span>';
                            configList.appendChild(badgeWrap);
                        });
                    } else {
                        configList.innerHTML = '<div class="col-12 text-muted">No configuration details available.</div>';
                    }
                }

                // Optional: a short summary area that highlights key details (nice UI instead of raw JSON)
                if (detailsRender) {
                    detailsRender.innerHTML = '';
                    const summary = document.createElement('div');
                    summary.className = 'detail-card';
                    const keysToShow = ['facing', 'floor', 'total_floors', 'balconies', 'bathrooms', 'bedrooms', 'builder', 'rera_no'];
                    let html = '<div class="row">';
                    keysToShow.forEach(k => {
                        if (details[k] !== undefined) {
                            html += '<div class="col-sm-6"><strong>' + escapeHtml(k.replace(/_/g, ' ')) + ':</strong> ' + formatValue(details[k]) + '</div>';
                        }
                    });
                    html += '</div>';
                    summary.innerHTML = html;
                    detailsRender.appendChild(summary);
                }

                // Build similar properties list (simple heuristic: same category/type/city)
                const similarRow = document.getElementById('similar-row');
                if (similarRow) {
                    const similar = items.filter(p => String(p.id) !== String(prop.id) && (
                        (p.property_category && prop.property_category && p.property_category === prop.property_category) ||
                        (p.property_type && prop.property_type && p.property_type === prop.property_type) ||
                        (p.city && prop.city && p.city === prop.city)
                    )).slice(0,4);
                    similarRow.innerHTML = '';
                    if (similar.length === 0) {
                        similarRow.innerHTML = '<div class="col-12 text-muted">No similar properties found.</div>';
                    } else {
                        similar.forEach(s => {
                            const fm = (s.media && s.media[0]) ? (s.media[0].file_url || s.media[0].url || '') : '<?= base_url('images/property.png') ?>';
                            const price = (s.pricing && s.pricing.price) ? s.pricing.price : (s.price || s.avg_price || 'Contact');
                            const title = s.property_name || s.title || s.name || '';
                            const loc = s.locality || (s.details && s.details.sublocality) || s.city || '';
                            const col = document.createElement('div'); col.className = 'col-12 col-md-6';
                            col.innerHTML = `
                                <div class="property-listing-card h-100">
                                    <div class="position-relative">
                                        <img src="${fm}" class="card-img-top" alt="Property Image">
                                    </div>
                                    <div class="card-body">
                                        <h5 class="card-title">${title}</h5>
                                        <p class="card-price">₹ ${price}</p>
                                        <p class="text-muted small mb-0">${loc}</p>
                                    </div>
                                </div>`;
                            // wrap with link
                            const wrapper = document.createElement('div'); wrapper.className = 'col-12 col-md-6';
                            wrapper.innerHTML = `<a href="${detailUrl}?id=${s.id}" class="text-decoration-none text-reset d-block h-100">${col.innerHTML}</a>`;
                            similarRow.appendChild(wrapper);
                        });
                    }
                }

            } catch (e) {
                console.error(e);
                if (titleEl) titleEl.textContent = 'Failed to load property';
            }
        })();
    </script>
</body>
</html>
