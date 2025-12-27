<?php
$page_title = 'About Us | 11 Acer';
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <?php include 'assets/includes/seo-meta.php'; ?>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="<?= base_url('CSS/style.css') ?>">
    <link rel="stylesheet" href="<?= base_url('CSS/home.css') ?>">
    <link rel="stylesheet" href="<?= base_url('CSS/responsive.css') ?>">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/aos@2.3.4/dist/aos.css">
    <link rel="apple-touch-icon" sizes="180x180" href="<?= base_url('images/favicon/apple-touch-icon.png') ?>">
    <link rel="icon" type="image/png" sizes="32x32" href="<?= base_url('images/favicon/favicon-32x32.png') ?>">
    <link rel="icon" type="image/png" sizes="16x16" href="<?= base_url('images/favicon/favicon-16x16.png') ?>">
    <link rel="icon" type="image/x-icon" href="<?= base_url('images/favicon/favicon.ico') ?>">
    <link rel="manifest" href="<?= base_url('images/favicon/site.webmanifest') ?>">
    <style>
        :root {
            --brand: #198754;
            --brand-dark: #0f5d3a;
            --text-dark: #1f2a2e;
            --text-muted: #6b7b85;
            --surface: #ffffff;
            --surface-soft: #f5f7f8;
            --shadow: 0 20px 45px rgba(25, 135, 84, 0.12);
        }

        body {
            font-family: 'Inter', sans-serif;
            background-color: #f5f7f8;
            color: var(--text-dark);
        }

        .about-page section {
            padding: clamp(2.5rem, 5vw, 4rem) 0;
        }

        .section-heading {
            font-weight: 600;
            margin-bottom: 1rem;
        }

        .section-subtitle {
            color: var(--text-muted);
            max-width: 760px;
        }

        .hero-banner {
            position: relative;
            background-image: linear-gradient(120deg, rgba(8, 30, 27, 0.85), rgba(25, 135, 84, 0.85)), url('https://images.unsplash.com/photo-1505691938895-1758d7feb511?auto=format&fit=crop&w=1600&q=80');
            background-size: cover;
            background-position: center;
            border-bottom-left-radius: 2rem;
            border-bottom-right-radius: 2rem;
            min-height: clamp(360px, 65vh, 540px);
            display: flex;
            align-items: center;
            color: #ffffff;
            overflow: hidden;
        }

        .hero-banner h1 {
            font-size: clamp(2.1rem, 5vw, 3.6rem);
            line-height: 1.2;
        }

        .hero-card{
            color :black;
        }

        .hero-card,
        .value-card,
        .mission-card,
        .team-card,
        .reason-card,
        .stat-card,
        .cta-banner {
            background: var(--surface);
            border: 0;
            border-radius: 1.25rem;
            box-shadow: var(--shadow);
            transition: transform 0.4s ease, box-shadow 0.4s ease;
        }

        .hero-card:hover,
        .value-card:hover,
        .mission-card:hover,
        .team-card:hover,
        .reason-card:hover,
        .stat-card:hover,
        .cta-banner:hover {
            transform: translateY(-6px);
            box-shadow: 0 30px 60px rgba(8, 30, 27, 0.18);
        }

        .value-icon {
            width: 54px;
            height: 54px;
            border-radius: 12px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            background: rgba(25, 135, 84, 0.12);
            color: var(--brand);
            font-size: 1.4rem;
            margin-bottom: 1rem;
        }

        .mission-card {
            padding: 2rem;
            height: 100%;
        }

        .team-card img {
            border-top-left-radius: 1.25rem;
            border-top-right-radius: 1.25rem;
            height: 260px;
            object-fit: cover;
            width: 100%;
            display: block;
        }

        .stat-card {
            background: #0f201c;
            color: #ffffff;
            padding: 2rem;
        }

        .stat-card h3 {
            font-size: 2.5rem;
            font-weight: 700;
        }

        .cta-banner {
            background: linear-gradient(120deg, #081c1a, var(--brand-dark));
            color: #ffffff;
            padding: 3rem;
        }

        @media (max-width: 991.98px) {
            .section-heading {
                font-size: 1.9rem;
            }
        }

        @media (max-width: 767px) {
            .hero-banner {
                text-align: center;
                border-radius: 0 0 1.5rem 1.5rem;
                min-height: auto;
                padding: 2.5rem 0;
            }

            .cta-banner {
                padding: 2rem;
            }
        }
    </style>
</head>

<body>
    <?= $this->include('layouts/loader') ?>

    <?= $this->include('layouts/header') ?>

    <main class="about-page">
        <!-- Hero -->
        <section class="hero-banner">
            <div class="container" data-aos="fade-up" data-aos-delay="100">
                <div class="row align-items-center">
                    <div class="col-xl-7">
                        <h1 class="display-4 fw-semibold mb-3">Elevating Residential & Commercial Real Estate Experiences</h1>
                        <p class="lead mb-4">11 Acer orchestrates data-backed advisory, curated inventory, and concierge-grade service for buyers, investors, and developers across India.</p>
                        <div class="d-flex flex-wrap gap-3">
                            <a href="<?= site_url('contact') ?>" class="btn btn-brand px-4 py-3">Discuss Your Requirement</a>
                            <a href="<?= site_url('services') ?>" class="btn btn-brand-outline px-4 py-3">Discover Our Services</a>
                        </div>
                    </div>
                    <div class="col-xl-4 ms-auto mt-5 mt-xl-0" data-aos="fade-left" data-aos-delay="200">
                        <div class="hero-card p-4">
                            <p class="text-uppercase mb-2">Highlights</p>
                            <div class="d-flex justify-content-between">
                                <div>
                                    <h3 class="fw-bold">12+ yrs</h3>
                                    <p class="mb-0">Advisory Expertise</p>
                                </div>
                                <div>
                                    <h3 class="fw-bold">5000+</h3>
                                    <p class="mb-0">Homes Transacted</p>
                                </div>
                            </div>
                            <hr class="border-light opacity-25">
                            <p class="mb-0">Dedicated teams across NCR, Mumbai, Bengaluru, Hyderabad, and Pune deliver bespoke transaction journeys.</p>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Who we are -->
        <section class="container" id="who-we-are">
            <div class="row g-4 align-items-center">
                <div class="col-lg-6" data-aos="fade-right">
                    <img src="https://images.unsplash.com/photo-1451976426598-a7593bd6d0b2?auto=format&fit=crop&w=1500&q=80" class="img-fluid rounded-4 shadow" alt="Who we are">
                </div>
                <div class="col-lg-6" data-aos="fade-left" data-aos-delay="100">
                    <span class="badge bg-light text-success rounded-pill mb-3">Who We Are</span>
                    <h2 class="section-heading">A collective of real estate strategists, researchers & experience curators.</h2>
                    <p class="section-subtitle">We partner with leading developers, HNIs, institutional buyers, and retail customers to unlock residences and commercial assets with superior ROI, lifestyle upgrades, and transparent processes.</p>
                    <ul class="list-unstyled text-muted mb-4">
                        <li class="mb-2"><i class="bi bi-check-circle-fill text-success me-2"></i> Pan-India partnerships across 60+ micro-markets</li>
                        <li class="mb-2"><i class="bi bi-check-circle-fill text-success me-2"></i> Seamless onboarding through digital-first processes</li>
                        <li class="mb-2"><i class="bi bi-check-circle-fill text-success me-2"></i> Dedicated desks for NRIs and institutional portfolios</li>
                    </ul>
                    <a href="<?= site_url('properties') ?>" class="btn btn-brand">Explore Our Portfolio</a>
                </div>
            </div>
        </section>

        <!-- Mission & Vision -->
        <section class="container" id="mission-vision">
            <div class="row g-4">
                <div class="col-md-6" data-aos="fade-up" data-aos-delay="100">
                    <div class="mission-card">
                        <span class="value-icon"><i class="bi bi-bullseye"></i></span>
                        <h4>Our Mission</h4>
                        <p class="text-muted mb-0">Deliver trustworthy advisory and curated real estate assets that help families, investors, and developers realize the full potential of every square foot.</p>
                    </div>
                </div>
                <div class="col-md-6" data-aos="fade-up" data-aos-delay="180">
                    <div class="mission-card">
                        <span class="value-icon"><i class="bi bi-stars"></i></span>
                        <h4>Our Vision</h4>
                        <p class="text-muted mb-0">To become India’s most respected real estate intelligence platform empowering confident decisions through data, service excellence, and innovation.</p>
                    </div>
                </div>
            </div>
        </section>

        <!-- Core Values -->
        <section class="container" id="core-values">
            <div class="row mb-4">
                <div class="col-lg-8" data-aos="fade-right">
                    <h2 class="section-heading">Our Core Values</h2>
                    <p class="section-subtitle">Principles that define how we operate, collaborate, and serve every client interaction.</p>
                </div>
            </div>
            <div class="row g-4 values-grid auto-grid row-cols-1 row-cols-sm-2 row-cols-lg-3" data-aos="fade-up" data-aos-delay="120">
                <?php $values = [
                    ['icon' => 'bi-shield-check', 'title' => 'Integrity First', 'desc' => 'Every recommendation is transparent, data-backed, and client-first.'],
                    ['icon' => 'bi-graph-up', 'title' => 'Performance Obsessed', 'desc' => 'We optimize every mandate for ROI, absorption, and lifecycle value.'],
                    ['icon' => 'bi-lightbulb', 'title' => 'Innovation DNA', 'desc' => 'Emerging tech, AI insights, and digital journeys keep us ahead.'],
                    ['icon' => 'bi-people', 'title' => 'Collaborative Spirit', 'desc' => 'Cross-functional pods align marketing, research, and advisory.'],
                    ['icon' => 'bi-globe', 'title' => 'Global Outlook', 'desc' => 'Serving NRIs and institutional funds with compliance-ready solutions.'],
                    ['icon' => 'bi-heart', 'title' => 'People-Centric', 'desc' => 'We design experiences that make real estate joyful and stress-free.'],
                ]; ?>
                <?php foreach ($values as $value): ?>
                    <div class="col">
                        <div class="value-card p-4 h-100">
                            <div class="value-icon"><i class="bi <?= $value['icon'] ?>"></i></div>
                            <h6 class="fw-semibold mb-2"><?= $value['title'] ?></h6>
                            <p class="text-muted mb-0"><?= $value['desc'] ?></p>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </section>

        <!-- Why Choose Us -->
        <section class="container" id="why-choose">
            <div class="row mb-4">
                <div class="col-lg-8" data-aos="fade-right">
                    <h2 class="section-heading">Why Choose 11 Acer</h2>
                    <p class="section-subtitle">We bring the perfect blend of prop-tech intelligence and boutique consulting.</p>
                </div>
            </div>
            <div class="row g-4 reasons-grid" data-aos="fade-up" data-aos-delay="150">
                <?php $reasons = [
                    ['icon' => 'bi-houses', 'title' => 'Curated Inventory', 'desc' => 'Exclusive mandates, branded residences, and commercial assets.'],
                    ['icon' => 'bi-cpu', 'title' => 'Tech-enabled Journeys', 'desc' => 'Interactive dashboards, virtual walkthroughs, and predictive insights.'],
                    ['icon' => 'bi-emoji-smile', 'title' => 'Concierge Experience', 'desc' => 'Everything from site visits to paperwork handled end-to-end.'],
                    ['icon' => 'bi-credit-card', 'title' => 'Financing Allies', 'desc' => 'Preferred banking partners and home-loan desks.'],
                ]; ?>
                <?php foreach ($reasons as $reason): ?>
                    <div class="col-12 col-sm-6 col-lg-3">
                        <div class="reason-card p-4 h-100">
                            <div class="value-icon"><i class="bi <?= $reason['icon'] ?>"></i></div>
                            <h6 class="fw-semibold mb-2"><?= $reason['title'] ?></h6>
                            <p class="text-muted mb-0"><?= $reason['desc'] ?></p>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </section>

        <!-- Stats -->
        <section class="container" id="stats">
            <div class="row g-4 stats-grid" data-aos="fade-up" data-aos-delay="100">
                <?php $stats = [
                    ['number' => '650+', 'label' => 'Developers & Channel Partners'],
                    ['number' => '2.4 Mn sq.ft', 'label' => 'Transacted Residential Space'],
                    ['number' => '320+', 'label' => 'Institutional Mandates'],
                    ['number' => '98%', 'label' => 'Client Retention'],
                ]; ?>
                <?php foreach ($stats as $stat): ?>
                    <div class="col-6 col-md-3">
                        <div class="stat-card text-center h-100">
                            <h3><?= $stat['number'] ?></h3>
                            <p class="text-white-50 mb-0"><?= $stat['label'] ?></p>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </section>

        <!-- CTA -->
        <section class="container" id="about-cta">
            <div class="cta-banner" data-aos="zoom-in" data-aos-delay="120">
                <div class="row align-items-center g-4">
                    <div class="col-lg-8">
                        <h2 class="fw-semibold mb-3">Ready to unlock your next real estate milestone?</h2>
                        <p class="mb-0">Connect with our advisory desk to plan acquisitions, off-plan launches, or portfolio restructuring.</p>
                    </div>
                    <div class="col-lg-4 text-lg-end">
                        <a href="<?= site_url('contact') ?>" class="btn btn-light px-4 py-3 fw-semibold">Contact Us Today</a>
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
        AOS.init({
            once: true,
            duration: 900,
            easing: 'ease-out-cubic'
        });
    </script>
</body>

</html>
