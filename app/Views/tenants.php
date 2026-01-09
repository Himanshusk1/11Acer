<?php
$page_title = 'Tenant Services | 11 Acer';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <?php include 'assets/includes/seo-meta.php'; ?>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="<?= base_url('CSS/style.css') ?>">
    <link rel="stylesheet" href="<?= base_url('CSS/home.css') ?>">
    <link rel="stylesheet" href="<?= base_url('CSS/responsive.css') ?>">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/aos@2.3.4/dist/aos.css">
    <link rel="icon" type="image/x-icon" href="<?= base_url('images/favicon/favicon.ico') ?>">

    <style>
        :root {
            --page-bg: #f4f6fb;
            --surface: #ffffff;
            --ink: #0f172a;
            --muted: #6b7a90;
            --accent: #16a34a;
            --accent-dark: #0f5132;
            --accent-soft: rgba(34, 197, 94, 0.12);
            --shadow-soft: 0 35px 75px -45px rgba(15, 45, 35, 0.45);
            --radius-lg: 28px;
        }

        * {
            box-sizing: border-box;
        }

        body {
            margin: 0;
            font-family: 'Inter', sans-serif;
            background: var(--page-bg);
            color: var(--ink);
            -webkit-font-smoothing: antialiased;
        }

        .hero-section {
            position: relative;
            padding: clamp(72px, 12vw, 120px) 0;
            background: radial-gradient(circle at 12% 18%, rgba(74, 222, 128, 0.14), transparent 55%),
                        radial-gradient(circle at 88% 8%, rgba(79, 70, 229, 0.18), transparent 60%),
                        linear-gradient(135deg, #0b2216, #103826);
            color: #ecfdf5;
            overflow: hidden;
        }

        .hero-highlight {
            border-radius: 999px;
            padding: 0.45rem 1.25rem;
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            background: rgba(255, 255, 255, 0.12);
            font-size: 0.82rem;
            text-transform: uppercase;
            letter-spacing: 0.08em;
        }

        .hero-card {
            background: rgba(12, 37, 24, 0.6);
            border: 1px solid rgba(255, 255, 255, 0.08);
            border-radius: var(--radius-lg);
            padding: clamp(24px, 3vw, 32px);
            box-shadow: 0 40px 80px -40px rgba(0, 0, 0, 0.55);
            backdrop-filter: blur(12px);
        }

        .stats-pill {
            background: rgba(255, 255, 255, 0.08);
            border-radius: 18px;
            padding: 1.2rem;
        }

        .section-title {
            font-weight: 600;
            font-size: clamp(2rem, 3vw, 2.55rem);
            margin-bottom: 1rem;
        }

        .section-subtitle {
            color: var(--muted);
            max-width: 720px;
            margin-bottom: 2.5rem;
        }

        .feature-card,
        .process-card,
        .testimonial-card,
        .assurance-card,
        .cta-banner {
            position: relative;
            border-radius: var(--radius-lg);
            background: var(--surface);
            border: 1px solid rgba(15, 45, 35, 0.08);
            box-shadow: var(--shadow-soft);
            padding: clamp(24px, 3vw, 32px);
            overflow: hidden;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .feature-card:hover,
        .process-card:hover,
        .testimonial-card:hover,
        .assurance-card:hover {
            transform: translateY(-6px);
            box-shadow: 0 45px 90px -45px rgba(15, 45, 35, 0.55);
        }

        .feature-icon {
            width: 56px;
            height: 56px;
            border-radius: 18px;
            background: var(--accent-soft);
            color: var(--accent);
            display: inline-flex;
            align-items: center;
            justify-content: center;
            font-size: 1.45rem;
        }

        .process-step {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            width: 42px;
            height: 42px;
            border-radius: 50%;
            background: var(--accent);
            color: #fff;
            font-weight: 600;
            margin-bottom: 1rem;
        }

        .testimonial-card blockquote {
            font-size: 1.05rem;
            line-height: 1.7;
        }

        .cta-banner {
            background: linear-gradient(130deg, #0b2216, #145d37);
            color: #e8fdf4;
            box-shadow: 0 60px 110px -55px rgba(10, 37, 22, 0.9);
        }

        .hero-ball {
            position: absolute;
            width: 200px;
            height: 200px;
            border-radius: 50%;
            background: rgba(74, 222, 128, 0.18);
            filter: blur(2px);
            opacity: 0.9;
            pointer-events: none;
        }

        .hero-ball.alt {
            background: rgba(79, 70, 229, 0.18);
        }

        .feature-card .hero-ball,
        .process-card .hero-ball,
        .testimonial-card .hero-ball,
        .assurance-card .hero-ball,
        .cta-banner .hero-ball {
            width: 180px;
            height: 180px;
            opacity: 0.7;
            z-index: 0;
        }

        .card-content {
            position: relative;
            z-index: 1;
        }

        @media (max-width: 991px) {
            main {
                padding-top: 72px;
            }
        }

        @media (max-width: 767px) {
            .hero-section {
                text-align: center;
            }

            .hero-highlight {
                justify-content: center;
            }

            .hero-card {
                margin-top: 2.5rem;
            }
        }
    </style>
</head>
<body>
    <?= $this->include('layouts/loader') ?>
    <?= $this->include('layouts/header') ?>

    <main>
        <section class="hero-section">
            <div class="container position-relative">
                <span class="hero-ball" style="top:-80px; left:-80px;"></span>
                <span class="hero-ball alt" style="bottom:-90px; right:-60px;"></span>
                <div class="row align-items-center g-5">
                    <div class="col-lg-7" data-aos="fade-up" data-aos-delay="80">
                        <span class="hero-highlight"><i class="bi bi-door-open"></i> Premium Rental Advisory</span>
                        <h1 class="display-4 fw-semibold mt-3 mb-4">Tailored Housing Journeys for Corporate & Luxury Tenants</h1>
                        <p class="lead mb-4">From curated inventory and compliance checks to concierge-grade move-ins, 11 Acer orchestrates end-to-end tenant experiences across India’s most sought-after micro-markets.</p>
                        <div class="d-flex flex-wrap gap-3">
                            <a href="<?= site_url('contact') ?>" class="btn btn-success px-4 py-3">Book a Consultation</a>
                            <a href="<?= site_url('properties') ?>" class="btn btn-outline-light px-4 py-3">Explore Premium Listings</a>
                        </div>
                    </div>
                    <div class="col-lg-5" data-aos="fade-left" data-aos-delay="160">
                        <div class="hero-card">
                            <h5 class="fw-semibold mb-3">Tenant Desk Highlights</h5>
                            <div class="row g-3">
                                <div class="col-6">
                                    <div class="stats-pill">
                                        <p class="text-uppercase small mb-1">Corporate Clients</p>
                                        <h3 class="fw-bold mb-0">180+</h3>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="stats-pill">
                                        <p class="text-uppercase small mb-1">Cities Mapped</p>
                                        <h3 class="fw-bold mb-0">12</h3>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="stats-pill">
                                        <p class="text-uppercase small mb-1">Avg. Turnaround</p>
                                        <h3 class="fw-bold mb-0">48 hrs</h3>
                                    </div>
                                </div>
                            </div>
                            <p class="mt-3 mb-0 text-white-50">Dedicated relationship managers bundle site visits, negotiations, documentation, and handovers into a single seamless workflow.</p>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section class="py-5">
            <div class="container">
                <div class="section-heading text-center mb-5" data-aos="fade-up">
                    <h2 class="section-title">What Tenants Gain with 11 Acer</h2>
                    <p class="section-subtitle mx-auto">Personalized curation, transparent negotiations, and relocation support engineered for CXOs, expatriates, and fast-moving professionals.</p>
                </div>
                <div class="row g-4">
                    <div class="col-md-6 col-xl-3" data-aos="fade-up" data-aos-delay="40">
                        <div class="feature-card">
                            <span class="hero-ball" style="top:-80px;right:-60px;"></span>
                            <div class="card-content">
                                <div class="feature-icon mb-3"><i class="bi bi-stars"></i></div>
                                <h5 class="fw-semibold mb-2">Curated Inventory</h5>
                                <p class="text-muted mb-0">Access to verified premium homes & managed residences matched to commute, lifestyle, and budget goals.</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 col-xl-3" data-aos="fade-up" data-aos-delay="80">
                        <div class="feature-card">
                            <span class="hero-ball alt" style="bottom:-70px;left:-70px;"></span>
                            <div class="card-content">
                                <div class="feature-icon mb-3"><i class="bi bi-file-earmark-check"></i></div>
                                <h5 class="fw-semibold mb-2">Compliance First</h5>
                                <p class="text-muted mb-0">Rigorous owner KYC, legal vetting, and digitally executed agreements protect tenant interests at every stage.</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 col-xl-3" data-aos="fade-up" data-aos-delay="120">
                        <div class="feature-card">
                            <span class="hero-ball" style="top:-70px;right:-50px;"></span>
                            <div class="card-content">
                                <div class="feature-icon mb-3"><i class="bi bi-people"></i></div>
                                <h5 class="fw-semibold mb-2">Concierge Move-ins</h5>
                                <p class="text-muted mb-0">White-glove support covering utility setups, furnishing, and on-ground settling-in for families and expats.</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 col-xl-3" data-aos="fade-up" data-aos-delay="160">
                        <div class="feature-card">
                            <span class="hero-ball alt" style="bottom:-65px;right:-65px;"></span>
                            <div class="card-content">
                                <div class="feature-icon mb-3"><i class="bi bi-headset"></i></div>
                                <h5 class="fw-semibold mb-2">24x7 Relationship Desk</h5>
                                <p class="text-muted mb-0">Single-window escalation desk for repairs, renewals, and portfolio-wide tenancy coordination.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section class="py-5 bg-white">
            <div class="container">
                <div class="row align-items-center g-5">
                    <div class="col-lg-5" data-aos="fade-right">
                        <span class="hero-highlight" style="background: var(--accent-soft); color: var(--accent-dark);"><i class="bi bi-diagram-3"></i> Guided Process</span>
                        <h2 class="section-title mt-3">A Five-Step Path to Move-In Day</h2>
                        <p class="text-muted mb-0">Our tenancy specialists orchestrate each milestone with transparent communication and measurable SLAs.</p>
                    </div>
                    <div class="col-lg-7" data-aos="fade-left">
                        <div class="row g-4">
                            <?php
                            $steps = [
                                ['title' => 'Discovery & Briefing', 'copy' => 'Understand lifestyle, compliance considerations, budgets, and move-in timelines.'],
                                ['title' => 'Curated Shortlist', 'copy' => 'Present verified options with virtual walkthroughs, commute maps, and cost sheets.'],
                                ['title' => 'Assisted Viewings', 'copy' => 'Coordinate site visits, negotiations, and owner alignment with transparent comparables.'],
                                ['title' => 'Documentation Desk', 'copy' => 'Draft, vet, and execute digital rental agreements with stamp duty management.'],
                                ['title' => 'Move-In Concierge', 'copy' => 'Plan handover, utility activation, and welcome kit for a frictionless start.'],
                            ];
                            foreach ($steps as $index => $step): ?>
                                <div class="col-sm-6">
                                    <div class="process-card">
                                        <span class="hero-ball" style="top:-70px;right:-70px;"></span>
                                        <div class="card-content">
                                            <span class="process-step">0<?= $index + 1 ?></span>
                                            <h6 class="fw-semibold mb-2"><?= esc($step['title']) ?></h6>
                                            <p class="text-muted mb-0"><?= esc($step['copy']) ?></p>
                                        </div>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section class="py-5">
            <div class="container">
                <div class="section-heading text-center mb-5" data-aos="fade-up">
                    <h2 class="section-title">Trusted by Top-Tier Renters</h2>
                    <p class="section-subtitle mx-auto">From relocating CXOs to long-stay expats, our tenancy desk unlocks premium addresses across NCR, Mumbai, Pune, Bengaluru, Hyderabad, and Goa.</p>
                </div>
                <div class="row g-4">
                    <div class="col-md-6" data-aos="fade-up" data-aos-delay="60">
                        <div class="testimonial-card">
                            <span class="hero-ball" style="top:-80px; right:-70px;"></span>
                            <div class="card-content">
                                <div class="d-flex align-items-center gap-3 mb-3">
                                    <div class="feature-icon"><i class="bi bi-building"></i></div>
                                    <div>
                                        <h6 class="fw-semibold mb-0">Ananya I., Country Head</h6>
                                        <span class="text-muted small">Relocated from Singapore to Gurgaon</span>
                                    </div>
                                </div>
                                <blockquote class="mb-3">“11 Acer coordinated every milestone—from previewing gated communities virtually to ensuring the home was fully furnished before arrival. Compliance, negotiations, and handover were all handled with zero stress.”</blockquote>
                                <div class="d-flex align-items-center gap-2 text-warning">
                                    <?php for ($i = 0; $i < 5; $i++): ?>
                                        <i class="bi bi-star-fill"></i>
                                    <?php endfor; ?>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6" data-aos="fade-up" data-aos-delay="120">
                        <div class="testimonial-card">
                            <span class="hero-ball alt" style="bottom:-80px; left:-70px;"></span>
                            <div class="card-content">
                                <div class="d-flex align-items-center gap-3 mb-3">
                                    <div class="feature-icon"><i class="bi bi-briefcase"></i></div>
                                    <div>
                                        <h6 class="fw-semibold mb-0">Rahul & Kavya S.</h6>
                                        <span class="text-muted small">Family relocating within Mumbai</span>
                                    </div>
                                </div>
                                <blockquote class="mb-3">“The concierge move-in meant utilities, deep cleaning, and minor fit-outs were finished before our kids started school. The relationship manager still helps us manage renewals.”</blockquote>
                                <div class="d-flex align-items-center gap-2 text-warning">
                                    <?php for ($i = 0; $i < 5; $i++): ?>
                                        <i class="bi bi-star-fill"></i>
                                    <?php endfor; ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section class="py-5 bg-white">
            <div class="container">
                <div class="row g-4 align-items-center">
                    <div class="col-lg-6" data-aos="fade-right">
                        <div class="assurance-card">
                            <span class="hero-ball" style="top:-85px;right:-75px;"></span>
                            <div class="card-content">
                                <h3 class="fw-semibold mb-3">Why Owners Prefer 11 Acer Tenants</h3>
                                <p class="text-muted">Our occupant footprint includes blue-chip companies, embassy staff, and vetted HNI families. This translates into minimal vacancy, disciplined upkeep, and trusted handovers for landlords.</p>
                                <ul class="list-unstyled d-grid gap-2 mt-3">
                                    <li><i class="bi bi-shield-check text-success me-2"></i>End-to-end KYC & contract management</li>
                                    <li><i class="bi bi-cash-coin text-success me-2"></i>Transparent rental payouts & escalation clauses</li>
                                    <li><i class="bi bi-tools text-success me-2"></i>Proactive upkeep with verified service partners</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6" data-aos="fade-left">
                        <div class="cta-banner position-relative">
                            <span class="hero-ball" style="top:-90px; left:-70px;"></span>
                            <span class="hero-ball alt" style="bottom:-85px; right:-70px;"></span>
                            <div class="card-content">
                                <h2 class="fw-semibold mb-3">Let’s Discuss Your Rental Mandate</h2>
                                <p class="mb-4">Share your requirements and a tenant specialist will craft a personalised shortlist within 24 hours.</p>
                                <div class="d-flex flex-wrap gap-3">
                                    <a href="<?= site_url('contact') ?>" class="btn btn-light text-success fw-semibold px-4 py-2">Schedule a Call</a>
                                    <a href="tel:+919818816311" class="btn btn-outline-light px-4 py-2"><i class="bi bi-telephone me-2"></i>+91 98188 16311</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>

    <?= $this->include('layouts/modal') ?>
    <?= $this->include('layouts/footer') ?>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/aos@2.3.4/dist/aos.js"></script>
    <script>AOS.init({ once: true, duration: 700, easing: 'ease-out' });</script>
</body>
</html>
