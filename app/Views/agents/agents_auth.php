<?php
$page_title = 'Sell or Rent Property - 36 Broking Hub';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <?php include 'assets/includes/seo-meta.php'; ?>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="<?= base_url('CSS/home.css') ?>">
    <link rel="stylesheet" href="<?= base_url('CSS/responsive.css') ?>">
    <link rel="icon" type="image/x-icon" href="<?= base_url('images/favicon/favicon.ico') ?>">
    <style>
        :root { --bh-green: #198754; --bh-dark: #0f2d1e; --card-cream: #fdfefc; }
        body {
            font-family: 'Inter', sans-serif;
            min-height: 100vh;
            background: radial-gradient(circle at top right, rgba(25, 135, 84, 0.18), transparent 45%),
                        linear-gradient(180deg, #f8faf8 0%, #edf6f1 100%);
        }
        h1, h2, h3, h4, h5, h6 { font-weight: 700; }
        .hero-section {
            position: relative;
            padding: clamp(4rem, 8vw, 6rem) 0;
            background: linear-gradient(135deg, #e6fae6 0%, #f6fffb 70%);
            overflow: hidden;
        }
        .hero-section::before,
        .hero-section::after {
            content: '';
            position: absolute;
            border-radius: 50%;
            background: rgba(25, 135, 84, 0.14);
            filter: blur(70px);
            z-index: 0;
        }
        .hero-section::before { width: 280px; height: 280px; top: -70px; left: -80px; }
        .hero-section::after { width: 320px; height: 320px; bottom: -120px; right: -140px; }
        .hero-text { position: relative; z-index: 1; }
        .hero-text h1 { font-size: clamp(2.1rem, 4vw, 3.1rem); color: var(--bh-green); }
        .hero-text p { color: #516055; }
        .auth-card {
            border-radius: 32px;
            padding: clamp(1.75rem, 4vw, 2.85rem);
            box-shadow: 0 40px 80px rgba(17, 28, 20, 0.22);
            background: linear-gradient(180deg, #ffffff 0%, #fdfefe 65%, #e9fff2 100%);
            border: 1px solid rgba(255, 255, 255, 0.4);
            position: relative;
            overflow: hidden;
        }
        .auth-card::before,
        .auth-card::after {
            content: '';
            position: absolute;
            width: 220px;
            height: 220px;
            border-radius: 50%;
            opacity: 0.35;
            background: radial-gradient(circle, rgba(25, 135, 84, 0.3), transparent 70%);
            filter: blur(10px);
        }
        .auth-card::before { top: -60px; right: -40px; }
        .auth-card::after { bottom: -80px; left: -40px; }
        .auth-card-accent {
            position: relative;
            z-index: 2;
            display: flex;
            flex-wrap: wrap;
            gap: 0.65rem;
            margin-bottom: 1.2rem;
            font-size: 0.9rem;
            color: var(--bh-green);
            justify-content: center;
        }
        .auth-card-accent span {
            border-radius: 999px;
            padding: 0.3rem 0.9rem;
            background: rgba(25, 135, 84, 0.08);
            border: 1px solid rgba(25, 135, 84, 0.2);
            font-weight: 600;
        }
        .auth-card-body { position: relative; z-index: 2; }
        .auth-card-title { text-align: center; margin-bottom: 0.5rem; font-size: clamp(1.6rem, 3vw, 2rem); color: #1f392b; }
        .auth-card-subtitle { text-align: center; margin-bottom: 1.4rem; color: #4d5a50; font-size: 0.95rem; }
        .auth-card-highlights { display: flex; justify-content: center; flex-wrap: wrap; gap: 0.65rem; margin-top: 1.1rem; }
        .auth-card-pill {
            border-radius: 12px;
            padding: 0.45rem 0.9rem;
            font-size: 0.78rem;
            border: 1px dashed rgba(25, 135, 84, 0.55);
            background: rgba(25, 135, 84, 0.05);
            color: #176635;
            font-weight: 600;
        }
        .auth-card-pill.secondary { border-style: solid; background: rgba(255, 255, 255, 0.65); }
        .auth-card-note {
            background: rgba(25, 135, 84, 0.1);
            border-radius: 16px;
            padding: 0.65rem 0.85rem;
            font-size: 0.9rem;
            text-align: center;
            color: #0f2b1e;
            margin-bottom: 1rem;
            border: 1px solid rgba(25, 135, 84, 0.18);
        }
        .auth-card-foot { margin-top: 1.35rem; }
        .btn-brand {
            background: linear-gradient(135deg, #198754, #35c27d);
            color: #fff;
            border-radius: 16px;
            padding: 0.85rem 1.4rem;
            font-weight: 600;
            border: none;
            transition: transform 0.2s ease, box-shadow 0.2s ease;
            letter-spacing: 0.02em;
        }
        .btn-brand:hover { transform: translateY(-1px); box-shadow: 0 18px 35px rgba(24, 135, 84, 0.4); }
        .btn-outline-dark {
            border-radius: 14px;
            border-color: rgba(25, 25, 25, 0.2);
            color: #1a2b23;
            background: rgba(255, 255, 255, 0.7);
        }
        .form-control,
        .form-select { border-radius: 14px; padding: 0.85rem 1rem; }
        .form-control:focus,
        .form-select:focus {
            border-color: var(--bh-green);
            box-shadow: 0 0 0 0.16rem rgba(25, 135, 84, 0.25);
        }
        .helper-text { color: #6c7c72; font-size: 0.9rem; }
        #otp { gap: 0.45rem; }
        #otp .otp-input {
            width: 48px;
            height: 56px;
            text-align: center;
            font-size: 1.2rem;
            border-radius: 12px;
        }
        .stats-section {
            background: #fff;
            margin-top: -2.5rem;
            border-radius: 20px;
            box-shadow: 0 20px 50px rgba(31, 53, 42, 0.1);
            position: relative;
            z-index: 2;
        }
        .stat-card h3 { color: var(--bh-green); font-size: 2rem; }
        .stat-card p { margin: 0; color: #5e6c64; font-weight: 600; }
        .feature-section { background: #f0f7f3; }
        .feature-card {
            background: #fff;
            border-radius: 18px;
            padding: 1.5rem;
            height: 100%;
            box-shadow: 0 15px 35px rgba(32, 57, 44, 0.08);
        }
        .feature-card .icon-wrapper {
            width: 48px;
            height: 48px;
            border-radius: 16px;
            background: rgba(25, 135, 84, 0.15);
            color: var(--bh-green);
        }
        .testimonial-card {
            border-radius: 18px;
            background: #fff;
            padding: 1.5rem;
            height: 100%;
            border: 1px solid #e5eee8;
        }
        .faq-section .accordion-button:focus {
            box-shadow: 0 0 0 0.2rem rgba(25, 135, 84, 0.12);
        }
        .cta-banner {
            background: #10271c;
            border-radius: 28px;
            color: #fff;
            padding: clamp(2rem, 6vw, 3.5rem);
        }
        @media (max-width: 991px) { .hero-text { text-align: center; margin-bottom: 2.5rem; } }
    </style>
</head>
<body>
<?= $this->include('layouts/loader', ['loaderMinDuration' => 0]) ?>
<?= $this->include('layouts/header') ?>

<main>
    <section class="hero-section">
        <div class="container">
            <div class="row align-items-center justify-content-center g-5">
                <div class="col-lg-6 hero-text" data-aos="fade-right">
                    <p class="text-uppercase text-muted fw-semibold mb-2">Agents & Owners</p>
                    <h1>Grow faster with 36 Broking Hub</h1>
                    <p class="mt-3">Generate qualified leads, showcase premium inventory, and manage your clients from a single dashboard. Join thousands of verified partners already scaling with us.</p>
                    <ul class="list-unstyled mt-4 text-start">
                        <li class="d-flex align-items-center mb-2"><i class="bi bi-patch-check-fill text-success me-2"></i>Verified buyer network nationwide</li>
                        <li class="d-flex align-items-center mb-2"><i class="bi bi-speedometer2 text-success me-2"></i>Fast OTP-based onboarding</li>
                        <li class="d-flex align-items-center"><i class="bi bi-shield-lock-fill text-success me-2"></i>Secure dashboard & insights</li>
                    </ul>
                </div>
                <div class="col-lg-5 col-md-8" data-aos="fade-left">
                    <div class="auth-card">
                        <div class="auth-card-accent">
                            <span>Trusted by 12K+ partners</span>
                            <span>Secure OTP, zero passwords</span>
                        </div>
                        <div class="auth-card-body">
                            <div id="phone-form-container">
                                <h4 class="auth-card-title">Login / Signup</h4>
                                <p class="auth-card-subtitle">Enter your mobile number to receive an OTP and access the dashboard in seconds.</p>
                                <form id="phone-form">
                                    <div class="alert alert-danger d-none p-2 small" id="phone-error"></div>
                                    <div class="mb-2">
                                        <label for="phone-number" class="form-label small mb-1">Phone Number</label>
                                        <input type="tel" id="phone-number" name="phone_number" class="form-control" placeholder="Enter your phone number" required>
                                    </div>
                                    <div class="d-grid mt-3">
                                        <button type="submit" class="btn btn-brand">Get OTP</button>
                                    </div>
                                </form>
                                <div class="auth-card-highlights">
                                    <span class="auth-card-pill">OTP in 5s</span>
                                    <span class="auth-card-pill secondary">Live onboarding support</span>
                                    <span class="auth-card-pill">Multi-device ready</span>
                                </div>
                                <p class="text-center helper-text auth-card-foot">By continuing, you agree to our <a href="#" class="text-decoration-none">Terms & Conditions</a></p>
                            </div>
                            <div id="otp-form-container" class="d-none">
                                <button class="btn btn-link btn-sm text-decoration-none p-0 mb-2" id="backToPhone">← Back</button>
                                <h4 class="auth-card-title">OTP Verification</h4>
                                <p class="auth-card-subtitle">Enter the 6-digit code sent to <span id="masked-phone" class="fw-semibold"></span></p>
                                <div class="auth-card-note">OTP expires in 5 minutes. We'll notify you before it lapses.</div>
                                <form id="otp-form">
                                    <div class="alert alert-danger d-none p-2 small" id="otp-error"></div>
                                    <div id="otp" class="d-flex justify-content-center flex-wrap my-3">
                                        <input type="text" maxlength="1" class="form-control otp-input" />
                                        <input type="text" maxlength="1" class="form-control otp-input" />
                                        <input type="text" maxlength="1" class="form-control otp-input" />
                                        <input type="text" maxlength="1" class="form-control otp-input" />
                                        <input type="text" maxlength="1" class="form-control otp-input" />
                                        <input type="text" maxlength="1" class="form-control otp-input" />
                                    </div>
                                    <div class="d-grid">
                                        <button type="submit" class="btn btn-brand">Verify OTP</button>
                                    </div>
                                </form>
                                <p class="text-center helper-text mt-3">Didn't receive the code? <a href="#" class="text-decoration-none">Resend OTP</a></p>
                            </div>
                            <div id="register-form-container" class="d-none">
                                <h4 class="auth-card-title">Complete Your Profile</h4>
                                <div class="auth-card-note">Share a few quick details to unlock the premium brokerage tools.</div>
                                <form id="register-form">
                                    <div class="alert alert-danger d-none p-2 small" id="register-error"></div>
                                    <input type="hidden" id="reg-phone" name="phone_number">
                                    <div class="mb-2"><input type="text" name="full_name" class="form-control" placeholder="Full Name" required></div>
                                    <div class="mb-2"><input type="email" name="email" class="form-control" placeholder="Email Address" required></div>
                                    <div class="mb-2"><input type="text" name="city" class="form-control" placeholder="Your City" required></div>
                                    <input type="hidden" name="role" value="agent">
                                    <div class="d-grid">
                                        <button type="submit" class="btn btn-brand">Save & Continue</button>
                                    </div>
                                </form>
                                <p class="text-center helper-text mt-3 mb-0">Have questions? <a href="tel:+919999999999" class="text-decoration-none">Talk to our onboarding team</a></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="stats-section py-4 px-3 px-md-5">
        <div class="container">
        <div class="row g-4 text-center">
            <div class="col-6 col-lg-3">
                <div class="stat-card">
                    <h3>12K+</h3>
                    <p>Active Listings</p>
                </div>
            </div>
            <div class="col-6 col-lg-3">
                <div class="stat-card">
                    <h3>850+</h3>
                    <p>Verified Agencies</p>
                </div>
            </div>
            <div class="col-6 col-lg-3">
                <div class="stat-card">
                    <h3>92%</h3>
                    <p>Lead Conversion</p>
                </div>
            </div>
            <div class="col-6 col-lg-3">
                <div class="stat-card">
                    <h3>48hrs</h3>
                    <p>Avg. Closing Time</p>
                </div>
            </div>
        </div>
        </div>
    </section>

    <section class="feature-section py-5">
        <div class="container">
            <div class="row justify-content-between align-items-center mb-4">
                <div class="col-lg-7">
                    <h2 class="fw-bold mb-2">Everything you need to scale your brokerage</h2>
                    <p class="text-muted mb-0">Marketing automation, client management, and inventory visibility bundled into one simplified workspace.</p>
                </div>
            </div>
            <div class="row g-4">
                <div class="col-md-6 col-xl-3">
                    <div class="feature-card">
                        <div class="icon-wrapper d-flex align-items-center justify-content-center mb-3"><i class="bi bi-broadcast"></i></div>
                        <h5 class="fw-semibold">Pan-India Exposure</h5>
                        <p class="text-muted mb-0">Instantly showcase every property to buyers searching across 40+ cities.</p>
                    </div>
                </div>
                <div class="col-md-6 col-xl-3">
                    <div class="feature-card">
                        <div class="icon-wrapper d-flex align-items-center justify-content-center mb-3"><i class="bi bi-graph-up-arrow"></i></div>
                        <h5 class="fw-semibold">Performance Analytics</h5>
                        <p class="text-muted mb-0">Track inquiries, site visits, and closures with real-time dashboards.</p>
                    </div>
                </div>
                <div class="col-md-6 col-xl-3">
                    <div class="feature-card">
                        <div class="icon-wrapper d-flex align-items-center justify-content-center mb-3"><i class="bi bi-people"></i></div>
                        <h5 class="fw-semibold">Dedicated CRM</h5>
                        <p class="text-muted mb-0">Organize buyers, schedule follow-ups, and manage documents securely.</p>
                    </div>
                </div>
                <div class="col-md-6 col-xl-3">
                    <div class="feature-card">
                        <div class="icon-wrapper d-flex align-items-center justify-content-center mb-3"><i class="bi bi-lightning-charge"></i></div>
                        <h5 class="fw-semibold">Automation Suite</h5>
                        <p class="text-muted mb-0">Auto-send reminders, marketing drip campaigns, and payment nudges.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="py-5">
        <div class="container">
            <div class="row g-4">
                <div class="col-lg-6">
                    <div class="testimonial-card h-100">
                        <span class="text-warning fs-4">“</span>
                        <p class="fs-5">Our closure rate jumped by 30% within the first quarter of onboarding with 36 Broking Hub. The OTP onboarding makes our field team lightning fast.</p>
                        <div class="d-flex align-items-center mt-3">
                            <img src="<?= base_url('images/36_profile.png') ?>" class="rounded-circle me-3" alt="client" style="width: 50px;">
                            <div>
                                <div class="fw-semibold">Kiran Rao</div>
                                <small class="text-muted">Director, UrbanNest Realty</small>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="testimonial-card h-100">
                        <span class="text-warning fs-4">“</span>
                        <p class="fs-5">The integrated CRM + marketing toolkit replaced three separate subscriptions for us. Everything from order forms to payout tracking now lives in one clean dashboard.</p>
                        <div class="d-flex align-items-center mt-3">
                            <img src="<?= base_url('images/36_profile.png') ?>" class="rounded-circle me-3" alt="client" style="width: 50px;">
                            <div>
                                <div class="fw-semibold">Sanjana Jain</div>
                                <small class="text-muted">Partner, Prime Spaces</small>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="faq-section py-5 bg-white">
        <div class="container">
            <div class="row g-4">
                <div class="col-lg-5">
                    <p class="text-uppercase text-muted fw-semibold mb-2">FAQ</p>
                    <h2 class="fw-bold">Answers before you onboard</h2>
                    <p class="text-muted">Need more details about pricing, onboarding, or integrations? We captured the most common questions below.</p>
                </div>
                <div class="col-lg-7">
                    <div class="accordion" id="agentsFaq">
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="faqOne">
                                <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#faqCollapseOne" aria-expanded="true" aria-controls="faqCollapseOne">
                                    How long does verification take?
                                </button>
                            </h2>
                            <div id="faqCollapseOne" class="accordion-collapse collapse show" aria-labelledby="faqOne" data-bs-parent="#agentsFaq">
                                <div class="accordion-body">
                                    Most agents go live within 24 hours once KYC documents are uploaded through the dashboard or shared with our onboarding specialist.
                                </div>
                            </div>
                        </div>
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="faqTwo">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#faqCollapseTwo" aria-expanded="false" aria-controls="faqCollapseTwo">
                                    Can teams collaborate on the same account?
                                </button>
                            </h2>
                            <div id="faqCollapseTwo" class="accordion-collapse collapse" aria-labelledby="faqTwo" data-bs-parent="#agentsFaq">
                                <div class="accordion-body">
                                    Yes. Create unlimited staff logins with granular permissions for lead assignment, payout tracking, and inventory access.
                                </div>
                            </div>
                        </div>
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="faqThree">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#faqCollapseThree" aria-expanded="false" aria-controls="faqCollapseThree">
                                    Do you integrate with other CRMs?
                                </button>
                            </h2>
                            <div id="faqCollapseThree" class="accordion-collapse collapse" aria-labelledby="faqThree" data-bs-parent="#agentsFaq">
                                <div class="accordion-body">
                                    We provide webhooks and Zapier connectors for sending inquiries into Salesforce, Zoho, HubSpot, or any custom pipeline with minimal setup.
                                </div>
                            </div>
                        </div>
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="faqFour">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#faqCollapseFour" aria-expanded="false" aria-controls="faqCollapseFour">
                                    What support do I get post-onboarding?
                                </button>
                            </h2>
                            <div id="faqCollapseFour" class="accordion-collapse collapse" aria-labelledby="faqFour" data-bs-parent="#agentsFaq">
                                <div class="accordion-body">
                                    Dedicated account managers, WhatsApp support, and quarterly playbook reviews to ensure your funnel keeps compounding month over month.
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="py-5">
        <div class="container">
            <div class="cta-banner text-center text-md-start">
                <div class="row align-items-center g-4">
                    <div class="col-md-8">
                        <p class="text-uppercase text-light fw-semibold mb-1">Ready to grow?</p>
                        <h2 class="mb-2 text-white">Launch your digital brokerage playbook in under 10 minutes.</h2>
                        <p class="mb-0 text-white-50">No credit card needed. Start with OTP onboarding and unlock the premium suite whenever you are ready.</p>
                    </div>
                    <div class="col-md-4 text-md-end">
                        <button class="btn btn-light text-success fw-semibold px-4 py-3">Talk to Growth Team</button>
                    </div>
                </div>
            </div>
        </div>
    </section>
</main>

<?= $this->include('layouts/footer') ?>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script>
document.addEventListener("DOMContentLoaded", function () {
    const phoneFormContainer = document.getElementById('phone-form-container');
    const otpFormContainer = document.getElementById('otp-form-container');
    const registerFormContainer = document.getElementById('register-form-container');

    const phoneForm = document.getElementById("phone-form");
    const otpForm = document.getElementById("otp-form");
    const registerForm = document.getElementById("register-form");

    const phoneSubmitBtn = phoneForm ? phoneForm.querySelector('button[type="submit"]') : null;
    const otpSubmitBtn = otpForm ? otpForm.querySelector('button[type="submit"]') : null;
    const registerSubmitBtn = registerForm ? registerForm.querySelector('button[type="submit"]') : null;

    const phoneErrorDiv = document.getElementById('phone-error');
    const otpErrorDiv = document.getElementById('otp-error');
    const registerErrorDiv = document.getElementById('register-error');

    const maskedPhone = document.getElementById('masked-phone');
    const backToPhoneBtn = document.getElementById('backToPhone');

    const API_BASE_URL = 'http://localhost:8080/api/auth';
    const LOGIN_URL = `${API_BASE_URL}/login`;
    const VERIFY_OTP_URL = `${API_BASE_URL}/verify-otp`;
    const REGISTER_URL = `${API_BASE_URL}/register`;

    let currentPhone = '';
    let currentUserId = null;
    let requiresProfileCompletion = false;

    function toggleButtonLoading(button, isLoading, loadingText) {
        if (!button) return;
        if (isLoading) {
            if (!button.dataset.originalContent) {
                button.dataset.originalContent = button.innerHTML;
            }
            button.disabled = true;
            button.innerHTML = `<span class="spinner-border spinner-border-sm me-2" role="status" aria-hidden="true"></span>${loadingText}`;
        } else {
            button.disabled = false;
            if (button.dataset.originalContent) {
                button.innerHTML = button.dataset.originalContent;
            }
        }
    }

    function showPhoneForm() {
        phoneFormContainer.classList.remove('d-none');
        otpFormContainer.classList.add('d-none');
        registerFormContainer.classList.add('d-none');
        phoneErrorDiv.classList.add('d-none');
        phoneForm.reset();
    }

    function showOtpForm() {
        phoneFormContainer.classList.add('d-none');
        otpFormContainer.classList.remove('d-none');
        registerFormContainer.classList.add('d-none');
        otpErrorDiv.classList.add('d-none');
        setupOtpInputs();
        maskedPhone.textContent = currentPhone.replace(/\d(?=\d{4})/g, "*");
    }

    function showRegisterForm() {
        phoneFormContainer.classList.add('d-none');
        otpFormContainer.classList.add('d-none');
        registerFormContainer.classList.remove('d-none');
        registerErrorDiv.classList.add('d-none');
        registerForm.reset();
        document.getElementById('reg-phone').value = currentPhone;
    }

    backToPhoneBtn.addEventListener('click', showPhoneForm);

    function setupOtpInputs() {
        const inputs = document.querySelectorAll("#otp > input");
        inputs.forEach((input, i) => {
            input.value = "";
            input.setAttribute('type', 'tel');
            input.setAttribute('inputmode', 'numeric');
            input.addEventListener("input", function () {
                if (this.value.length > 1) this.value = this.value[0];
                if (this.value && i < inputs.length - 1) inputs[i + 1].focus();
            });
            input.addEventListener("keydown", function (e) {
                if (e.key === "Backspace" && i > 0 && this.value === "") inputs[i - 1].focus();
            });
        });
        if (inputs.length) inputs[0].focus();
    }

    phoneForm.addEventListener('submit', async (e) => {
        e.preventDefault();
        phoneErrorDiv.classList.add('d-none');

        currentPhone = phoneForm['phone_number'].value.trim();
        if (!/^\d{10}$/.test(currentPhone)) {
            phoneErrorDiv.textContent = "Please enter a valid 10-digit phone number.";
            phoneErrorDiv.classList.remove('d-none');
            return;
        }

        try {
            toggleButtonLoading(phoneSubmitBtn, true, 'Sending OTP...');
            const res = await fetch(LOGIN_URL, {
                method: 'POST',
                body: new URLSearchParams({ phone_number: currentPhone })
            });
            const data = await res.json();

            if (!res.ok) {
                phoneErrorDiv.textContent = data.message || 'Login failed.';
                phoneErrorDiv.classList.remove('d-none');
                return;
            }

            currentUserId = data.user_id || null;
            requiresProfileCompletion = !!data.requires_profile;
            showOtpForm();

        } catch (err) {
            console.error(err);
            phoneErrorDiv.textContent = 'Network error. Try again.';
            phoneErrorDiv.classList.remove('d-none');
        } finally {
            toggleButtonLoading(phoneSubmitBtn, false);
        }
    });

    otpForm.addEventListener('submit', async (e) => {
        e.preventDefault();
        otpErrorDiv.classList.add('d-none');

        const otpInputs = otpForm.querySelectorAll("input");
        const otp = Array.from(otpInputs).map(i => i.value.trim()).join('');

        if (!/^\d{6}$/.test(otp)) {
            otpErrorDiv.textContent = 'Please enter a valid 6-digit OTP.';
            otpErrorDiv.classList.remove('d-none');
            return;
        }

        try {
            toggleButtonLoading(otpSubmitBtn, true, 'Verifying...');
            const res = await fetch(VERIFY_OTP_URL, {
                method: 'POST',
                headers: { 'Content-Type': 'application/json' },
                body: JSON.stringify({ phone_number: currentPhone, otp, user_id: currentUserId })
            });
            const data = await res.json();

            if (!res.ok) {
                otpErrorDiv.textContent = data.message || 'Invalid or expired OTP';
                otpErrorDiv.classList.remove('d-none');
                return;
            }

            if (data.user && data.user.user_id) {
                currentUserId = data.user.user_id;
            }

            requiresProfileCompletion = !!data.requires_profile;

            if (requiresProfileCompletion) {
                showRegisterForm();
                return;
            }

            const redirectUrl = data.redirect_url || '/dashboard';

            Swal.fire({
                icon: 'success',
                title: 'Welcome back!',
                timer: 2000,
                showConfirmButton: false
            }).then(() => window.location.href = redirectUrl);

        } catch (err) {
            console.error(err);
            otpErrorDiv.textContent = 'Network error. Try again.';
            otpErrorDiv.classList.remove('d-none');
        } finally {
            toggleButtonLoading(otpSubmitBtn, false);
        }
    });

    registerForm.addEventListener('submit', async (e) => {
        e.preventDefault();
        registerErrorDiv.classList.add('d-none');
        registerErrorDiv.textContent = '';

        if (!currentUserId || !currentPhone) {
            registerErrorDiv.textContent = 'User info missing. Please start from phone login.';
            registerErrorDiv.classList.remove('d-none');
            return;
        }

        const formData = new FormData(registerForm);
        const userData = {
            user_id: currentUserId,
            full_name: formData.get('full_name').trim(),
            email: formData.get('email').trim(),
            phone_number: currentPhone,
            city: formData.get('city').trim(),
            role: 'agent'
        };

        try {
            toggleButtonLoading(registerSubmitBtn, true, 'Saving...');
            const res = await fetch(REGISTER_URL, {
                method: 'POST',
                headers: { 'Content-Type': 'application/json' },
                body: JSON.stringify(userData)
            });

            const data = await res.json();

            if (!res.ok) {
                if (data.errors) {
                    registerErrorDiv.innerHTML = Object.values(data.errors).join('<br>');
                } else {
                    registerErrorDiv.textContent = data.message || 'Registration failed.';
                }
                registerErrorDiv.classList.remove('d-none');
                return;
            }

            const redirectUrl = data.redirect_url || '/dashboard';

            Swal.fire({
                icon: 'success',
                title: 'Registration complete!',
                timer: 2000,
                showConfirmButton: false
            }).then(() => window.location.href = redirectUrl);

        } catch (err) {
            console.error('Network error:', err);
            registerErrorDiv.textContent = 'Network error. Try again.';
            registerErrorDiv.classList.remove('d-none');
        } finally {
            toggleButtonLoading(registerSubmitBtn, false);
        }
    });

    showPhoneForm();
});
</script>
</body>
</html>
