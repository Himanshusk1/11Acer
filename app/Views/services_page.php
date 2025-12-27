<?php
$page_title = '11 Acer';
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <?php include 'assets/includes/seo-meta.php'; ?>
    <?= csrf_meta() ?>
    <style>
        .swal2-popup {
            border-radius: 1.75rem;
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
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="<?= base_url('CSS/style.css') ?>">
      <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="<?= base_url('CSS/home.css') ?>">
    <link rel="apple-touch-icon" sizes="180x180" href="<?= base_url('images/favicon/apple-touch-icon.png') ?>">
    <link rel="icon" type="image/png" sizes="32x32" href="<?= base_url('images/favicon/favicon-32x32.png') ?>">
    <link rel="icon" type="image/png" sizes="16x16" href="<?= base_url('images/favicon/favicon-16x16.png') ?>">
    <link rel="icon" type="image/x-icon" href="<?= base_url('images/favicon/favicon.ico') ?>">
    <link rel="manifest" href="<?= base_url('images/favicon/site.webmanifest') ?>">
</head>
<body>
    <?= $this->include('layouts/loader') ?>

    <?= $this->include('layouts/header') ?>

    <?php
    $services = [
        ['icon' => 'bi-house-heart', 'title' => 'For Buyers / Owners', 'description' => 'Personalised discovery journeys, curated recommendations and price insights.'],
        ['icon' => 'bi-door-open', 'title' => 'For Tenants', 'description' => 'Verified rental options with digital agreements and instant support.'],
        ['icon' => 'bi-person-badge', 'title' => 'For Agents', 'description' => 'Grow your network with co-broking tools and premium lead flows.'],
        ['icon' => 'bi-building', 'title' => 'For Builders & Banks', 'description' => 'Launch inventory faster with omni-channel campaigns and banking tie-ups.'],
        ['icon' => 'bi-bank', 'title' => 'Home Loan', 'description' => 'Compare offers from trusted lenders with guided approvals.'],
        ['icon' => 'bi-file-earmark-text', 'title' => 'Online Rent Agreement', 'description' => 'Digitally notarised agreements delivered to your inbox.'],
        ['icon' => 'bi-card-checklist', 'title' => 'List Property With Us', 'description' => 'High-impact listings powered by media-rich storytelling.'],
        ['icon' => 'bi-broadcast-pin', 'title' => 'Advertise With Us', 'description' => 'Performance marketing across web, social and partner channels.'],
        ['icon' => 'bi-brush', 'title' => 'Home Interior Design', 'description' => 'Design-to-delivery solutions with vetted interior experts.'],
        ['icon' => 'bi-receipt', 'title' => 'Rent Receipts', 'description' => 'Instant compliant receipts for tax saving and reimbursements.'],
        ['icon' => 'bi-diagram-3', 'title' => 'Co-Broking For New Projects', 'description' => 'Collaborative sales pods to move inventory faster.'],
        ['icon' => 'bi-vr', 'title' => '3D / AR / VR Services', 'description' => 'Immersive walkthroughs that help buyers experience spaces remotely.'],
        ['icon' => 'bi-graph-up', 'title' => 'Valuation', 'description' => 'AI-backed valuation plus on-ground validation for accuracy.'],
        ['icon' => 'bi-shield-lock', 'title' => 'Property Management', 'description' => 'Tenant onboarding, rent tracking and upkeep handled end-to-end.'],
        ['icon' => 'bi-cpu', 'title' => 'Data Intelligence', 'description' => 'Market dashboards, absorption trends and pricing benchmarks.'],
        ['icon' => 'bi-compass', 'title' => 'Vastu Calculator', 'description' => 'Scientifically backed vastu analysis for mindful living.'],
        ['icon' => 'bi-cash-coin', 'title' => 'Mortgage Partnerships', 'description' => 'Structure the right mortgage with exclusive partner benefits.'],
        ['icon' => 'bi-lightning', 'title' => 'Super Agent Pro', 'description' => 'Automation toolkit for power agents with CRM and analytics.'],
        ['icon' => 'bi-send-check', 'title' => 'Sell or Rent Property', 'description' => 'Dedicated closing teams to list, market and close deals swiftly.'],
    ];

    $whyChoose = [
        ['icon' => 'bi-patch-check', 'title' => 'Verified Listings', 'description' => 'Every listing passes multi-layer authenticity and quality checks.'],
        ['icon' => 'bi-people-fill', 'title' => 'Trusted Agents', 'description' => 'Credentialed experts with performance-based ratings and reviews.'],
        ['icon' => 'bi-headset', 'title' => 'End-to-End Support', 'description' => 'From discovery to documentation, our concierge team stays with you.'],
    ];
    ?>

    <main class="services-page overflow-hidden">
        <section class="py-5 bg-body-tertiary" data-aos="fade-up" data-aos-delay="100">
            <div class="container">
                <div class="row align-items-center g-4">
                    <div class="col-lg-7">
                        <p class="text-uppercase text-success fw-semibold mb-2">Our Services</p>
                        <h1 class="display-5 fw-bold text-dark">Everything you need to move home with confidence.</h1>
                        <p class="lead text-secondary mb-4">11 Acer blends expert advisory, verified inventory and intelligent tools so buyers, tenants, owners and partners can make faster, smarter real estate decisions.</p>
                        <div class="d-flex flex-wrap gap-3">
                            <div class="border rounded-4 px-4 py-3 bg-white shadow-sm" data-aos="fade-up" data-aos-delay="140">
                                <div class="h4 mb-0 text-success">5k+</div>
                                <small class="text-muted">Happy Families Served</small>
                            </div>
                            <div class="border rounded-4 px-4 py-3 bg-white shadow-sm" data-aos="fade-up" data-aos-delay="180">
                                <div class="h4 mb-0 text-success">350+</div>
                                <small class="text-muted">Verified Channel Partners</small>
                            </div>
                            <div class="border rounded-4 px-4 py-3 bg-white shadow-sm" data-aos="fade-up" data-aos-delay="220">
                                <div class="h4 mb-0 text-success">120+</div>
                                <small class="text-muted">Cities &amp; Towns Covered</small>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-5">
                        <div class="card border-0 shadow-lg rounded-4 h-100" data-aos="zoom-in" data-aos-delay="180">
                            <div class="card-body p-4">
                                <h5 class="fw-semibold text-success mb-3">Built for every stakeholder</h5>
                                <ul class="list-unstyled mb-0">
                                    <li class="d-flex align-items-start mb-3">
                                        <span class="badge bg-success-subtle text-success rounded-pill me-3">01</span>
                                        <div>
                                            <p class="fw-semibold mb-1">Owners &amp; Buyers</p>
                                            <p class="text-muted mb-0">Hyperlocal advisors, instant valuations, curated viewing experiences.</p>
                                        </div>
                                    </li>
                                    <li class="d-flex align-items-start mb-3">
                                        <span class="badge bg-success-subtle text-success rounded-pill me-3">02</span>
                                        <div>
                                            <p class="fw-semibold mb-1">Agents &amp; Brokers</p>
                                            <p class="text-muted mb-0">Lead automation, co-broking pods and always-on marketing pads.</p>
                                        </div>
                                    </li>
                                    <li class="d-flex align-items-start">
                                        <span class="badge bg-success-subtle text-success rounded-pill me-3">03</span>
                                        <div>
                                            <p class="fw-semibold mb-1">Developers &amp; Partners</p>
                                            <p class="text-muted mb-0">Demand-gen, mortgage alliances and intelligence dashboards.</p>
                                        </div>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section class="py-5" data-aos="fade-up" data-aos-delay="120">
            <div class="container">
                <div class="text-center mb-5">
                    <p class="text-uppercase text-success fw-semibold mb-2">Service Categories</p>
                    <h2 class="fw-bold text-dark">Solutions that cover every step</h2>
                    <p class="text-muted mb-0">From valuations to virtual tours, our integrated stack keeps each journey on track.</p>
                </div>
                <div class="row row-cols-1 row-cols-sm-2 row-cols-lg-3 row-cols-xl-4 g-4">
                    <?php foreach ($services as $index => $service): ?>
                        <div class="col" data-aos="fade-up" data-aos-delay="<?= 140 + ($index * 40) ?>">
                            <div class="card h-100 border-0 shadow-sm rounded-4 bg-white js-service-enquiry"
                                 data-service-title="<?= esc($service['title'], 'attr') ?>"
                                 role="button"
                                 tabindex="0"
                                 aria-label="Enquire about <?= esc($service['title'], 'attr') ?>"
                                 style="cursor:pointer;">
                                <div class="card-body text-center p-4">
                                    <div class="mb-3 text-success display-6">
                                        <i class="bi <?= esc($service['icon']) ?>"></i>
                                    </div>
                                    <h5 class="fw-semibold text-dark"><?= esc($service['title']) ?></h5>
                                    <p class="text-muted mb-0"><?= esc($service['description']) ?></p>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </section>

        <section class="py-5 bg-body-tertiary" data-aos="fade-up" data-aos-delay="140">
            <div class="container">
                <div class="text-center mb-4">
                    <p class="text-uppercase text-success fw-semibold mb-2">Why Choose Us</p>
                    <h2 class="fw-bold text-dark">Trust the 11 Acer advantage</h2>
                </div>
                <div class="row row-cols-1 row-cols-md-3 g-4">
                    <?php foreach ($whyChoose as $index => $item): ?>
                        <div class="col" data-aos="fade-up" data-aos-delay="<?= 160 + ($index * 80) ?>">
                            <div class="card h-100 border-0 rounded-4 shadow-sm bg-white">
                                <div class="card-body p-4 text-center">
                                    <div class="mb-3 text-success fs-1">
                                        <i class="bi <?= esc($item['icon']) ?>"></i>
                                    </div>
                                    <h5 class="fw-semibold text-dark"><?= esc($item['title']) ?></h5>
                                    <p class="text-muted mb-0"><?= esc($item['description']) ?></p>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </section>

        <section class="py-5" data-aos="fade-up" data-aos-delay="160">
            <div class="container">
                <div class="card border-0 rounded-4 shadow-lg bg-success text-white overflow-hidden">
                    <div class="card-body p-4 p-lg-5 d-flex flex-column flex-lg-row align-items-lg-center justify-content-between gap-4">
                        <div>
                            <p class="text-uppercase fw-semibold mb-1">Ready to move?</p>
                            <h3 class="fw-bold mb-2">List your property and reach the right audience in days, not months.</h3>
                            <p class="mb-0 opacity-75">Our concierge team sets up the listing, shoots media, and activates campaigns instantly.</p>
                        </div>
                        <a href="<?= base_url('post-your-property') ?>" class="btn btn-light text-success fw-semibold px-4 py-3 rounded-3">List Your Property</a>
                    </div>
                </div>
            </div>
        </section>
    </main>

    <?= $this->include('layouts/modal') ?>
    <?= $this->include('layouts/footer') ?>

    <script src="<?= base_url('js/script.js') ?>"></script>

    <script>
    document.addEventListener('DOMContentLoaded', function () {
        const csrfTokenMeta = document.querySelector('meta[name="csrf-token-name"]');
        const csrfHashMeta = document.querySelector('meta[name="csrf-token-value"]');
        let csrfTokenName = csrfTokenMeta ? csrfTokenMeta.getAttribute('content') : null;
        let csrfTokenValue = csrfHashMeta ? csrfHashMeta.getAttribute('content') : null;
        const csrfHeaderName = 'X-CSRF-TOKEN';
        const serviceEnquiryEndpoint = '<?= site_url('services/enquiry') ?>';
        const serviceCards = document.querySelectorAll('.js-service-enquiry');

        const refreshCsrfTokens = (payload) => {
            if (!payload) {
                return;
            }
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
            const headers = {
                'Content-Type': 'application/json'
            };
            if (csrfTokenValue) {
                headers[csrfHeaderName] = csrfTokenValue;
            }
            headers['X-Requested-With'] = 'XMLHttpRequest';
            return headers;
        };

        const formTemplate = (serviceTitle) => `
            <div class="swal2-service-chip">
                <i class="bi bi-lightning-charge-fill"></i>
                <span>${serviceTitle}</span>
            </div>
            <div class="swal2-form-grid">
                <div class="swal2-form-field">
                    <label>Name</label>
                    <input id="enquiry-name" class="swal2-input" placeholder="Full Name">
                </div>
                <div class="swal2-form-field">
                    <label>Phone Number</label>
                    <input id="enquiry-phone" class="swal2-input" placeholder="Phone Number">
                </div>
                <div class="swal2-form-field">
                    <label>Email</label>
                    <input id="enquiry-email" class="swal2-input" placeholder="Email">
                </div>
                <div class="swal2-form-field" style="grid-column: span 2;">
                    <label>Message / Context</label>
                    <textarea id="enquiry-message" class="swal2-textarea" rows="3" placeholder="How can we assist?"></textarea>
                </div>
            </div>
            <p class="swal2-note">We respond within 24 hours and keep your data fully private.</p>
        `;

        const openEnquiryModal = (serviceTitle) => {
            if (!serviceTitle) {
                return;
            }
            Swal.fire({
                title: 'Enquire about ' + serviceTitle,
                html: formTemplate(serviceTitle),
                showCancelButton: true,
                confirmButtonText: 'Send Enquiry',
                focusConfirm: false,
                preConfirm: async () => {
                    const nameEl = document.getElementById('enquiry-name');
                    const phoneEl = document.getElementById('enquiry-phone');
                    const emailEl = document.getElementById('enquiry-email');
                    const messageEl = document.getElementById('enquiry-message');
                    const name = nameEl ? nameEl.value.trim() : '';
                    const phone = phoneEl ? phoneEl.value.trim() : '';
                    const email = emailEl ? emailEl.value.trim() : '';
                    const message = messageEl ? messageEl.value.trim() : '';

                    if (!name || !phone || !email || !message) {
                        Swal.showValidationMessage('Please complete all fields.');
                        return false;
                    }

                    const emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
                    if (!emailPattern.test(email)) {
                        Swal.showValidationMessage('Please provide a valid email address.');
                        return false;
                    }

                    try {
                        const enquiryPayload = {
                            name,
                            phone,
                            email,
                            message,
                            service_title: serviceTitle
                        };
                        if (csrfTokenName && csrfTokenValue) {
                            enquiryPayload[csrfTokenName] = csrfTokenValue;
                        }
                        const response = await fetch(serviceEnquiryEndpoint, {
                            method: 'POST',
                            headers: buildHeaders(),
                            body: JSON.stringify(enquiryPayload),
                            credentials: 'same-origin'
                        });
                        const payload = await response.json();
                        refreshCsrfTokens(payload);

                        if (!response.ok) {
                            const validationMessage = payload && payload.message ? payload.message : 'Unable to submit enquiry.';
                            Swal.showValidationMessage(validationMessage);
                            return false;
                        }
                        return payload;
                    } catch (error) {
                        const message = error && error.message ? error.message : 'Something went wrong. Please try again.';
                        Swal.showValidationMessage(message);
                        return false;
                    }
                }
            }).then((result) => {
                if (result.isConfirmed && result.value) {
                    Swal.fire({
                        icon: 'success',
                        title: 'Enquiry sent',
                        text: result.value.message || 'We will reach out shortly.',
                        timer: 4000,
                        showConfirmButton: false
                    });
                }
            });
        };

        serviceCards.forEach((card) => {
            const serviceTitle = card.dataset.serviceTitle;
            card.addEventListener('click', () => openEnquiryModal(serviceTitle));
            card.addEventListener('keypress', (event) => {
                if (event.key === 'Enter' || event.key === ' ') {
                    event.preventDefault();
                    openEnquiryModal(serviceTitle);
                }
            });
        });
    });
    </script>
    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>