<?php
$page_title = 'Owner & Builder Solutions | 11 Acer';
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
            --page-bg: #f3f6fb;
            --ink: #0f172a;
            --muted: #5f6c88;
            --surface: #ffffff;
            --accent: #0ea5e9;
            --accent-alt: #6366f1;
            --accent-soft: rgba(14, 165, 233, 0.12);
            --accent-alt-soft: rgba(99, 102, 241, 0.12);
            --shadow-soft: 0 40px 80px -48px rgba(15, 23, 42, 0.4);
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
        }

        .hero-section {
            position: relative;
            padding: clamp(80px, 12vw, 132px) 0;
            background: radial-gradient(circle at 15% 25%, rgba(14, 165, 233, 0.18), transparent 55%),
                        radial-gradient(circle at 85% 10%, rgba(99, 102, 241, 0.2), transparent 60%),
                        linear-gradient(135deg, #072541, #0c1d36);
            color: #f8fbff;
            overflow: hidden;
        }

        .hero-chip {
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            padding: 0.5rem 1.35rem;
            border-radius: 999px;
            background: rgba(255, 255, 255, 0.12);
            text-transform: uppercase;
            font-size: 0.8rem;
            letter-spacing: 0.08em;
        }

        .hero-card {
            background: rgba(3, 10, 26, 0.65);
            border: 1px solid rgba(255, 255, 255, 0.08);
            border-radius: var(--radius-lg);
            backdrop-filter: blur(12px);
            padding: clamp(24px, 3vw, 32px);
            box-shadow: 0 45px 90px -52px rgba(0, 0, 0, 0.6);
        }

        .metric-pill {
            background: rgba(255, 255, 255, 0.12);
            border-radius: 18px;
            padding: 1.15rem;
        }

        .section-title {
            font-weight: 600;
            font-size: clamp(2rem, 3vw, 2.5rem);
            margin-bottom: 0.75rem;
        }

        .section-subtitle {
            color: var(--muted);
            max-width: 720px;
            margin: 0 auto 2.75rem;
        }

        .feature-card,
        .solution-card,
        .case-card,
        .cta-banner {
            position: relative;
            border-radius: var(--radius-lg);
            background: var(--surface);
            border: 1px solid rgba(15, 23, 42, 0.08);
            box-shadow: var(--shadow-soft);
            padding: clamp(24px, 3vw, 32px);
            overflow: hidden;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .feature-card:hover,
        .solution-card:hover,
        .case-card:hover {
            transform: translateY(-6px);
            box-shadow: 0 50px 90px -50px rgba(15, 23, 42, 0.5);
        }

        .feature-icon {
            width: 58px;
            height: 58px;
            border-radius: 18px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            background: var(--accent-soft);
            color: var(--accent);
            font-size: 1.55rem;
        }

        .solution-badge {
            display: inline-flex;
            align-items: center;
            gap: 0.4rem;
            padding: 0.4rem 1rem;
            background: rgba(14, 165, 233, 0.08);
            color: var(--accent);
            border-radius: 999px;
            font-weight: 600;
            font-size: 0.85rem;
        }

        .case-card blockquote {
            font-size: 1.05rem;
            line-height: 1.75;
            margin-bottom: 0;
        }

        .cta-banner {
            background: linear-gradient(130deg, #0d3b66, #2563eb);
            color: #e2f3ff;
            box-shadow: 0 70px 120px -60px rgba(15, 23, 42, 0.75);
        }

        .glow-ball {
            position: absolute;
            width: 190px;
            height: 190px;
            border-radius: 50%;
            background: rgba(14, 165, 233, 0.18);
            filter: blur(2px);
            opacity: 0.8;
            pointer-events: none;
        }

        .glow-ball.alt {
            background: rgba(99, 102, 241, 0.2);
        }

        .card-layer {
            position: relative;
            z-index: 1;
        }

        @media (max-width: 767px) {
            .hero-section {
                text-align: center;
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
                <span class="glow-ball" style="top:-90px; left:-90px;"></span>
                <span class="glow-ball alt" style="bottom:-100px; right:-80px;"></span>
                <div class="row align-items-center g-5">
                    <div class="col-lg-7" data-aos="fade-up" data-aos-delay="60">
                        <span class="hero-chip"><i class="bi bi-building-gear"></i> Developer Partnerships</span>
                        <h1 class="display-4 fw-semibold mt-3 mb-3">Unlock Faster Sales & Leasing Cycles for Prime Assets</h1>
                        <p class="lead mb-4">11 Acer powers inventory absorption for luxury residences and commercial towers with integrated marketing, sales pods, and compliance desks tailored for owners and builders.</p>
                        <div class="d-flex flex-wrap gap-3">
                            <a href="<?= site_url('contact') ?>" class="btn btn-info text-white px-4 py-3">Schedule a Strategy Call</a>
                            <a href="<?= site_url('properties') ?>" class="btn btn-outline-light px-4 py-3">View Managed Inventory</a>
                        </div>
                    </div>
                    <div class="col-lg-5" data-aos="fade-left" data-aos-delay="140">
                        <div class="hero-card">
                            <h5 class="fw-semibold mb-3">Performance Snapshot</h5>
                            <div class="row g-3">
                                <div class="col-6">
                                    <div class="metric-pill">
                                        <p class="text-uppercase small mb-1">Inventory Closed</p>
                                        <h3 class="fw-bold mb-0">₹780 Cr+</h3>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="metric-pill">
                                        <p class="text-uppercase small mb-1">Active Mandates</p>
                                        <h3 class="fw-bold mb-0">38</h3>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="metric-pill">
                                        <p class="text-uppercase small mb-1">Cities Served</p>
                                        <h3 class="fw-bold mb-0">11</h3>
                                    </div>
                                </div>
                            </div>
                            <p class="mt-3 mb-0 text-white-50">Dedicated launch pods integrate channel partner orchestration, buyer discovery, virtual tours, and transaction governance.</p>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section class="py-5">
            <div class="container">
                <div class="section-heading text-center" data-aos="fade-up">
                    <h2 class="section-title">Solutions Crafted for Owners & Developers</h2>
                    <p class="section-subtitle">End-to-end asset marketing, absorption, and lifecycle management that elevate buyer experience and accelerate revenue recognition.</p>
                </div>
                <div class="row g-4">
                    <div class="col-md-6 col-xl-3" data-aos="fade-up" data-aos-delay="40">
                        <div class="feature-card">
                            <span class="glow-ball" style="top:-80px; right:-70px;"></span>
                            <div class="card-layer">
                                <div class="feature-icon mb-3"><i class="bi bi-broadcast"></i></div>
                                <h5 class="fw-semibold mb-2">Launch Marketing</h5>
                                <p class="text-muted mb-0">Integrated campaigns, microsites, and performance media tuned for HNI, NRI, and institutional buyers.</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 col-xl-3" data-aos="fade-up" data-aos-delay="80">
                        <div class="feature-card">
                            <span class="glow-ball alt" style="bottom:-70px; left:-70px;"></span>
                            <div class="card-layer">
                                <div class="feature-icon mb-3"><i class="bi bi-people"></i></div>
                                <h5 class="fw-semibold mb-2">Sales Command Center</h5>
                                <p class="text-muted mb-0">Trained sales pods, virtual walkthroughs, and CRM automation convert prospects across time zones.</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 col-xl-3" data-aos="fade-up" data-aos-delay="120">
                        <div class="feature-card">
                            <span class="glow-ball" style="top:-70px; right:-60px;"></span>
                            <div class="card-layer">
                                <div class="feature-icon mb-3"><i class="bi bi-journal-check"></i></div>
                                <h5 class="fw-semibold mb-2">Compliance Desk</h5>
                                <p class="text-muted mb-0">Title diligence, buyer vetting, and RERA-aligned documentation ensure frictionless closures.</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 col-xl-3" data-aos="fade-up" data-aos-delay="160">
                        <div class="feature-card">
                            <span class="glow-ball alt" style="bottom:-65px; right:-70px;"></span>
                            <div class="card-layer">
                                <div class="feature-icon mb-3"><i class="bi bi-houses"></i></div>
                                <h5 class="fw-semibold mb-2">Asset Management</h5>
                                <p class="text-muted mb-0">Lease administration, facility partner governance, and quarterly asset health dashboards.</p>
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
                        <span class="solution-badge"><i class="bi bi-diagram-3"></i> Structured Playbook</span>
                        <h2 class="section-title mt-3">Four Pillars of Every 11 Acer Mandate</h2>
                        <p class="text-muted mb-0">Each assignment is executed by a war-room team blending market intelligence, branding, and sales enablement.</p>
                    </div>
                    <div class="col-lg-7" data-aos="fade-left">
                        <div class="row g-4">
                            <?php
                            $pillars = [
                                ['title' => 'Market Positioning', 'copy' => 'Micro-market analytics define pricing ladders, buyer cohorts, and absorption forecasts.'],
                                ['title' => 'Demand Generation', 'copy' => 'Performance-led omnichannel outreach combined with curated roadshows and channel partner engagement.'],
                                ['title' => 'Experience Layer', 'copy' => 'Immersive walkthroughs, digital twins, and concierge site visits convert intent into bookings.'],
                                ['title' => 'Transaction Governance', 'copy' => 'Booking, payments, and registrations handled through audited and transparent workflows.'],
                            ];
                            foreach ($pillars as $pillar): ?>
                                <div class="col-sm-6">
                                    <div class="solution-card">
                                        <span class="glow-ball" style="top:-70px; right:-70px;"></span>
                                        <div class="card-layer">
                                            <h6 class="fw-semibold mb-2"><?= esc($pillar['title']) ?></h6>
                                            <p class="text-muted mb-0"><?= esc($pillar['copy']) ?></p>
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
                    <h2 class="section-title">Recent Mandates & Success Stories</h2>
                    <p class="section-subtitle">Selected engagements that highlight our ability to drive velocity, manage compliance, and elevate customer experience.</p>
                </div>
                <div class="row g-4">
                    <div class="col-lg-4" data-aos="fade-up" data-aos-delay="60">
                        <div class="case-card">
                            <span class="glow-ball" style="top:-70px; right:-70px;"></span>
                            <div class="card-layer">
                                <div class="d-flex align-items-center gap-3 mb-3">
                                    <div class="feature-icon" style="background: var(--accent-alt-soft); color: var(--accent-alt);"><i class="bi bi-building"></i></div>
                                    <div>
                                        <h6 class="fw-semibold mb-0">Skyline One, Gurugram</h6>
                                        <span class="text-muted small">Luxury residential</span>
                                    </div>
                                </div>
                                <blockquote>“Achieved 70 percent absorption within 90 days through virtual launch rooms and curated NRI roadshows.”</blockquote>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4" data-aos="fade-up" data-aos-delay="120">
                        <div class="case-card">
                            <span class="glow-ball alt" style="bottom:-80px; left:-70px;"></span>
                            <div class="card-layer">
                                <div class="d-flex align-items-center gap-3 mb-3">
                                    <div class="feature-icon" style="background: var(--accent-soft);"><i class="bi bi-building-check"></i></div>
                                    <div>
                                        <h6 class="fw-semibold mb-0">Vertex Towers, Hyderabad</h6>
                                        <span class="text-muted small">Grade-A commercial</span>
                                    </div>
                                </div>
                                <blockquote>“Signed global occupiers for 2.4 lakh sq.ft via blended leasing strategy and enterprise outreach.”</blockquote>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4" data-aos="fade-up" data-aos-delay="180">
                        <div class="case-card">
                            <span class="glow-ball" style="top:-70px; right:-70px;"></span>
                            <div class="card-layer">
                                <div class="d-flex align-items-center gap-3 mb-3">
                                    <div class="feature-icon" style="background: var(--accent-alt-soft); color: var(--accent-alt);"><i class="bi bi-hospital"></i></div>
                                    <div>
                                        <h6 class="fw-semibold mb-0">The Wellness District, Goa</h6>
                                        <span class="text-muted small">Branded resort villas</span>
                                    </div>
                                </div>
                                <blockquote>“Concluded 32 villa bookings with white-glove site experiences and a dedicated compliance helpdesk.”</blockquote>
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
                        <div class="solution-card">
                            <span class="glow-ball" style="top:-85px; right:-75px;"></span>
                            <div class="card-layer">
                                <h3 class="fw-semibold mb-3">Why Developers Choose 11 Acer</h3>
                                <p class="text-muted">A single mandate connects you with a multi-disciplinary team that integrates brand strategy, analytics, and high-touch customer journeys.</p>
                                <ul class="list-unstyled d-grid gap-2 mt-3">
                                    <li><i class="bi bi-graph-up-arrow text-info me-2"></i>Revenue acceleration via data-backed pricing and demand shaping</li>
                                    <li><i class="bi bi-puzzle text-info me-2"></i>Plug-and-play pods across sales, marketing, and operations</li>
                                    <li><i class="bi bi-shield-lock text-info me-2"></i>Audit-ready compliance and buyer documentation management</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6" data-aos="fade-left">
                        <div class="cta-banner position-relative">
                            <span class="glow-ball" style="top:-90px; left:-80px;"></span>
                            <span class="glow-ball alt" style="bottom:-90px; right:-70px;"></span>
                            <div class="card-layer">
                                <h2 class="fw-semibold mb-3">Let’s Co-create Your Go-to-market Plan</h2>
                                <p class="mb-4">Share your project details and our mandate specialists will present a tailored absorption strategy within 48 hours.</p>
                                <div class="d-flex flex-wrap gap-3">
                                    <a href="<?= site_url('contact') ?>" class="btn btn-light text-info fw-semibold px-4 py-2">Submit Project Brief</a>
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
