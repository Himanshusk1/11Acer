<?php
$page_title = 'Agents & Broker Partnerships | 11 Acer';
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
            --page-bg: #f6f5ff;
            --ink: #111827;
            --muted: #6b7280;
            --surface: #ffffff;
            --accent: #f97316;
            --accent-alt: #fb7185;
            --accent-soft: rgba(249, 115, 22, 0.12);
            --accent-alt-soft: rgba(251, 113, 133, 0.12);
            --shadow-soft: 0 42px 90px -52px rgba(17, 24, 39, 0.45);
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
            padding: clamp(78px, 11vw, 128px) 0;
            background: radial-gradient(circle at 12% 18%, rgba(249, 115, 22, 0.22), transparent 58%),
                        radial-gradient(circle at 88% 12%, rgba(251, 113, 133, 0.22), transparent 58%),
                        linear-gradient(135deg, #1c0f2c, #311a3c);
            color: #fdf7ff;
            overflow: hidden;
        }

        .hero-chip {
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            padding: 0.55rem 1.4rem;
            border-radius: 999px;
            background: rgba(255, 255, 255, 0.12);
            text-transform: uppercase;
            font-size: 0.78rem;
            letter-spacing: 0.1em;
        }

        .hero-card {
            background: rgba(26, 13, 40, 0.65);
            border: 1px solid rgba(255, 255, 255, 0.08);
            border-radius: var(--radius-lg);
            padding: clamp(24px, 3vw, 32px);
            box-shadow: 0 50px 100px -60px rgba(0, 0, 0, 0.65);
            backdrop-filter: blur(12px);
        }

        .metric-pill {
            background: rgba(255, 255, 255, 0.12);
            border-radius: 18px;
            padding: 1.15rem;
        }

        .section-title {
            font-weight: 600;
            font-size: clamp(2.1rem, 3vw, 2.6rem);
            margin-bottom: 1rem;
        }

        .section-subtitle {
            color: var(--muted);
            max-width: 720px;
            margin: 0 auto 2.75rem;
        }

        .feature-card,
        .playbook-card,
        .testimonial-card,
        .cta-banner {
            position: relative;
            border-radius: var(--radius-lg);
            background: var(--surface);
            border: 1px solid rgba(17, 24, 39, 0.08);
            box-shadow: var(--shadow-soft);
            padding: clamp(24px, 3vw, 32px);
            overflow: hidden;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .feature-card:hover,
        .playbook-card:hover,
        .testimonial-card:hover {
            transform: translateY(-6px);
            box-shadow: 0 55px 100px -55px rgba(17, 24, 39, 0.5);
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

        .badge-soft {
            display: inline-flex;
            align-items: center;
            gap: 0.45rem;
            padding: 0.45rem 1.1rem;
            border-radius: 999px;
            background: rgba(249, 115, 22, 0.1);
            color: var(--accent);
            font-weight: 600;
            font-size: 0.85rem;
        }

        .testimonial-card blockquote {
            font-size: 1.05rem;
            line-height: 1.75;
            margin-bottom: 1.5rem;
        }

        .cta-banner {
            background: linear-gradient(130deg, #311a3c, #7c2d12);
            color: #ffeae1;
            box-shadow: 0 70px 130px -60px rgba(49, 26, 60, 0.85);
        }

        .glow-ball {
            position: absolute;
            width: 190px;
            height: 190px;
            border-radius: 50%;
            background: rgba(249, 115, 22, 0.2);
            filter: blur(2px);
            opacity: 0.85;
            pointer-events: none;
        }

        .glow-ball.alt {
            background: rgba(251, 113, 133, 0.22);
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
                <span class="glow-ball" style="top:-90px; left:-100px;"></span>
                <span class="glow-ball alt" style="bottom:-110px; right:-80px;"></span>
                <div class="row align-items-center g-5">
                    <div class="col-lg-7" data-aos="fade-up" data-aos-delay="80">
                        <span class="hero-chip"><i class="bi bi-people"></i> Channel Partner Hub</span>
                        <h1 class="display-4 fw-semibold mt-3 mb-3">Scale Your Brokerage with Priority Access & Enterprise Support</h1>
                        <p class="lead mb-4">Join 11 Acer's preferred agent network to co-market exclusive launches, close faster with verified leads, and unlock concierge support for your client portfolio.</p>
                        <div class="d-flex flex-wrap gap-3">
                            <a href="<?= site_url('contact') ?>" class="btn btn-warning text-dark px-4 py-3">Apply for Partnership</a>
                            <a href="tel:+919818816311" class="btn btn-outline-light px-4 py-3"><i class="bi bi-telephone me-2"></i>+91 98188 16311</a>
                        </div>
                    </div>
                    <div class="col-lg-5" data-aos="fade-left" data-aos-delay="160">
                        <div class="hero-card">
                            <h5 class="fw-semibold mb-3">Network Snapshot</h5>
                            <div class="row g-3">
                                <div class="col-6">
                                    <div class="metric-pill">
                                        <p class="text-uppercase small mb-1">Active Partners</p>
                                        <h3 class="fw-bold mb-0">420+</h3>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="metric-pill">
                                        <p class="text-uppercase small mb-1">Avg. Payout Cycle</p>
                                        <h3 class="fw-bold mb-0">7 Days</h3>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="metric-pill">
                                        <p class="text-uppercase small mb-1">Inventory Value</p>
                                        <h3 class="fw-bold mb-0">₹950 Cr</h3>
                                    </div>
                                </div>
                            </div>
                            <p class="mt-3 mb-0 text-white-50">Dedicated partner success teams assist with site access, documentation, and on-ground coordination.</p>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section class="py-5">
            <div class="container">
                <div class="section-heading text-center" data-aos="fade-up">
                    <h2 class="section-title">Why Agents Choose 11 Acer</h2>
                    <p class="section-subtitle">Unlock high-velocity inventory, curated marketing assets, and instant support designed for ambitious advisors and channel partners.</p>
                </div>
                <div class="row g-4">
                    <div class="col-md-6 col-xl-3" data-aos="fade-up" data-aos-delay="40">
                        <div class="feature-card">
                            <span class="glow-ball" style="top:-70px; right:-70px;"></span>
                            <div class="card-layer">
                                <div class="feature-icon mb-3"><i class="bi bi-stars"></i></div>
                                <h5 class="fw-semibold mb-2">Exclusive Mandates</h5>
                                <p class="text-muted mb-0">Priority allocations on luxury residential and Grade-A commercial launches across metros.</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 col-xl-3" data-aos="fade-up" data-aos-delay="80">
                        <div class="feature-card">
                            <span class="glow-ball alt" style="bottom:-70px; left:-70px;"></span>
                            <div class="card-layer">
                                <div class="feature-icon mb-3"><i class="bi bi-bullseye"></i></div>
                                <h5 class="fw-semibold mb-2">Qualified Lead Desk</h5>
                                <p class="text-muted mb-0">Pre-vetted buyers and tenants routed with contextual briefs to speed up walk-ins.</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 col-xl-3" data-aos="fade-up" data-aos-delay="120">
                        <div class="feature-card">
                            <span class="glow-ball" style="top:-70px; right:-60px;"></span>
                            <div class="card-layer">
                                <div class="feature-icon mb-3"><i class="bi bi-cash-coin"></i></div>
                                <h5 class="fw-semibold mb-2">Transparent Payouts</h5>
                                <p class="text-muted mb-0">Digitally tracked commissions with milestone-based releases and dashboard visibility.</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 col-xl-3" data-aos="fade-up" data-aos-delay="160">
                        <div class="feature-card">
                            <span class="glow-ball alt" style="bottom:-70px; right:-70px;"></span>
                            <div class="card-layer">
                                <div class="feature-icon mb-3"><i class="bi bi-life-preserver"></i></div>
                                <h5 class="fw-semibold mb-2">Partner Success</h5>
                                <p class="text-muted mb-0">Access to marketing kits, site support, and deal-structuring specialists on demand.</p>
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
                        <span class="badge-soft"><i class="bi bi-diagram-3"></i> Partnership Playbook</span>
                        <h2 class="section-title mt-3">How We Enable Every Deal</h2>
                        <p class="text-muted mb-0">A structured engagement that keeps your client conversations sharp, compliant, and conversion-ready.</p>
                    </div>
                    <div class="col-lg-7" data-aos="fade-left">
                        <div class="row g-4">
                            <?php
                            $playbook = [
                                ['title' => 'Inventory Briefing', 'copy' => 'Weekly digital sessions covering product USPs, pricing ladders, and objection handling cues.'],
                                ['title' => 'Marketing Suite', 'copy' => 'Customizable creatives, 3D walkthroughs, and WhatsApp-ready explainers for rapid outreach.'],
                                ['title' => 'Client Concierge', 'copy' => 'Dedicated desk to schedule site visits, virtual tours, and owner interactions with zero friction.'],
                                ['title' => 'Deal Desk', 'copy' => 'Structure offers, close paperwork, and manage disbursals from a single command center.'],
                            ];
                            foreach ($playbook as $item): ?>
                                <div class="col-sm-6">
                                    <div class="playbook-card">
                                        <span class="glow-ball" style="top:-70px; right:-70px;"></span>
                                        <div class="card-layer">
                                            <h6 class="fw-semibold mb-2"><?= esc($item['title']) ?></h6>
                                            <p class="text-muted mb-0"><?= esc($item['copy']) ?></p>
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
                    <h2 class="section-title">Partner Voices</h2>
                    <p class="section-subtitle">Hear from channel leaders who closed marquee transactions with the 11 Acer platform.</p>
                </div>
                <div class="row g-4">
                    <div class="col-md-6" data-aos="fade-up" data-aos-delay="80">
                        <div class="testimonial-card">
                            <span class="glow-ball" style="top:-80px; right:-70px;"></span>
                            <div class="card-layer">
                                <div class="d-flex align-items-center gap-3 mb-3">
                                    <div class="feature-icon" style="background: var(--accent-alt-soft); color: var(--accent-alt);"><i class="bi bi-building"></i></div>
                                    <div>
                                        <h6 class="fw-semibold mb-0">Rohan Malhotra</h6>
                                        <span class="text-muted small">Principal Partner, NCR</span>
                                    </div>
                                </div>
                                <blockquote>“Weekly funnel reviews and the 11 Acer lead desk kept our team focused on closures. We moved an entire tower in five months with zero payout disputes.”</blockquote>
                                <div class="d-flex align-items-center gap-2 text-warning">
                                    <?php for ($i = 0; $i < 5; $i++): ?>
                                        <i class="bi bi-star-fill"></i>
                                    <?php endfor; ?>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6" data-aos="fade-up" data-aos-delay="140">
                        <div class="testimonial-card">
                            <span class="glow-ball alt" style="bottom:-80px; left:-70px;"></span>
                            <div class="card-layer">
                                <div class="d-flex align-items-center gap-3 mb-3">
                                    <div class="feature-icon"><i class="bi bi-briefcase"></i></div>
                                    <div>
                                        <h6 class="fw-semibold mb-0">Sana Qureshi</h6>
                                        <span class="text-muted small">Luxury Leasing Specialist, Mumbai</span>
                                    </div>
                                </div>
                                <blockquote>“Having 11 Acer manage paperwork and handovers meant I could focus purely on clients. The partner success desk feels like an extension of my team.”</blockquote>
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
                        <div class="playbook-card">
                            <span class="glow-ball" style="top:-85px; right:-75px;"></span>
                            <div class="card-layer">
                                <h3 class="fw-semibold mb-3">Resources Partners Can Access</h3>
                                <p class="text-muted">Plug into a ready-made toolkit so every briefing, follow-up, and negotiation feels effortless.</p>
                                <ul class="list-unstyled d-grid gap-2 mt-3">
                                    <li><i class="bi bi-clipboard-data text-warning me-2"></i>Real-time dashboards for allocation, payouts, and client status</li>
                                    <li><i class="bi bi-film text-warning me-2"></i>Marketing asset vault with creatives, scripts, and walkthroughs</li>
                                    <li><i class="bi bi-shield-check text-warning me-2"></i>Compliance guardrails to handle documentation and KYC</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6" data-aos="fade-left">
                        <div class="cta-banner position-relative">
                            <span class="glow-ball" style="top:-90px; left:-80px;"></span>
                            <span class="glow-ball alt" style="bottom:-90px; right:-70px;"></span>
                            <div class="card-layer">
                                <h2 class="fw-semibold mb-3">Let's Grow Together</h2>
                                <p class="mb-4">Share your focus markets and team size. Our partner success manager will set up an onboarding workshop within 48 hours.</p>
                                <div class="d-flex flex-wrap gap-3">
                                    <a href="<?= site_url('contact') ?>" class="btn btn-light text-dark fw-semibold px-4 py-2">Start Application</a>
                                    <a href="mailto:partners@11acer.com" class="btn btn-outline-light px-4 py-2"><i class="bi bi-envelope me-2"></i>partners@11acer.com</a>
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
