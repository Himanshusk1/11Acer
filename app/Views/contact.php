<?php
$page_title = 'Contact Us | 11 Acer';
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <?php include 'assets/includes/seo-meta.php'; ?>
    <meta name="csrf-token-name" content="<?= csrf_token() ?>">
    <meta name="csrf-token-value" content="<?= csrf_hash() ?>">
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
            --shadow: 0 20px 45px rgba(25, 135, 84, 0.12);
        }

        body {
            font-family: 'Inter', sans-serif;
            background-color: #f5f7f8;
            color: var(--text-dark);
        }

        .contact-page section {
            padding: clamp(2.5rem, 5vw, 4rem) 0;
        }

        .hero-contact {
            background-image: linear-gradient(120deg, rgba(5, 25, 22, 0.9), rgba(25, 135, 84, 0.85)), url('<?= base_url('images/contact/contact-hero.jpg') ?>');
            background-size: cover;
            background-position: center;
            border-bottom-left-radius: 2rem;
            border-bottom-right-radius: 2rem;
            min-height: clamp(320px, 60vh, 520px);
            display: flex;
            align-items: center;
            color: #ffffff;
            overflow: hidden;
        }

        .hero-contact .cta-actions {
            justify-content: flex-start;
        }

        .hero-contact h1 {
            font-size: clamp(2rem, 5vw, 3.2rem);
            line-height: 1.2;
        }

        .info-card,
        .contact-form-card,
        .faq-card,
        .cta-banner {
            background: var(--surface);
            border: 0;
            border-radius: 1.25rem;
            box-shadow: var(--shadow);
            padding: 2rem;
            transition: transform 0.35s ease, box-shadow 0.35s ease;
        }

        .info-card:hover,
        .contact-form-card:hover,
        .faq-card:hover,
        .cta-banner:hover {
            transform: translateY(-6px);
            box-shadow: 0 30px 60px rgba(5, 25, 22, 0.18);
        }

        .info-icon {
            width: 58px;
            height: 58px;
            border-radius: 50%;
            background: rgba(25, 135, 84, 0.12);
            display: inline-flex;
            align-items: center;
            justify-content: center;
            font-size: 1.4rem;
            color: var(--brand);
        }

        .info-icon i,
        .value-icon i,
        .amenity-icon i,
        .feature-icon i {
            display: inline-flex;
        }

        .contact-form-card input,
        .contact-form-card textarea {
            border-radius: 0.85rem;
            border-color: rgba(0, 0, 0, 0.06);
            padding: 0.85rem 1rem;
        }

        .map-wrapper iframe {
            width: 100%;
            min-height: clamp(260px, 45vw, 380px);
            border: 0;
            border-radius: 1.25rem;
            box-shadow: var(--shadow);
        }

        .cta-banner {
            background: linear-gradient(120deg, #072019, var(--brand-dark));
            color: #ffffff;
        }

        .alert-custom {
            border-radius: 1rem;
            border: 0;
            padding: 1rem 1.25rem;
        }

        @media (max-width: 991.98px) {
            .contact-form-card,
            .info-card,
            .faq-card,
            .cta-banner {
                padding: 1.5rem;
            }
        }

        @media (max-width: 767px) {
            .hero-contact {
                text-align: center;
                border-radius: 0 0 1.5rem 1.5rem;
                min-height: auto;
                padding: 2.5rem 0;
            }

            .hero-contact .cta-actions {
                justify-content: center;
            }

            .cta-banner {
                padding: 2rem;
            }

            .contact-page section {
                padding: 2.5rem 0;
            }
        }
    </style>
</head>

<body>
    <?= $this->include('layouts/loader') ?>

    <?= $this->include('layouts/header') ?>

    <main class="contact-page">
        <!-- Hero -->
        <section class="hero-contact">
            <div class="container" data-aos="fade-up" data-aos-delay="100">
                <div class="row align-items-center">
                    <div class="col-xl-7">
                        <h1 class="display-5 fw-semibold mb-3">Let’s design your next property move together</h1>
                        <p class="lead mb-4">Connect with our residential & commercial specialists for curated site visits, portfolio strategy, and exclusive launches.</p>
                        <div class="d-flex flex-wrap gap-3 cta-actions">
                            <a href="tel:+919876543210" class="btn btn-brand px-4 py-3"><i class="bi bi-telephone-outbound me-2"></i>Talk to Us</a>
                            <a href="mailto:hello@36brokinghub.com" class="btn btn-brand-outline px-4 py-3"><i class="bi bi-envelope-open me-2"></i>Email Advisory Desk</a>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Contact info cards -->
        <section class="container" id="contact-info">
            <div class="row g-4">
                <?php $infoCards = [
                    ['icon' => 'bi-telephone', 'title' => 'Talk to Sales', 'content' => '+91 98765 43210', 'sub' => 'Mon-Sun, 9 AM – 9 PM'],
                    ['icon' => 'bi-envelope-paper', 'title' => 'Write to Us', 'content' => 'hello@36brokinghub.com', 'sub' => 'Responses within 12 working hours'],
                    ['icon' => 'bi-geo-alt', 'title' => 'Head Office', 'content' => '8th Floor, Cyber Park, Gurugram', 'sub' => 'Satellite offices in Mumbai & Bengaluru'],
                    ['icon' => 'bi-calendar-week', 'title' => 'Customer Support', 'content' => 'Mon–Sat, 10 AM – 7 PM', 'sub' => 'Dedicated concierge for NRIs'],
                ]; ?>
                <?php foreach ($infoCards as $index => $card): ?>
                    <div class="col-12 col-md-6 col-xl-3" data-aos="fade-up" data-aos-delay="<?= 120 + ($index * 60) ?>">
                        <div class="info-card h-100">
                            <div class="info-icon mb-3"><i class="bi <?= $card['icon'] ?>"></i></div>
                            <h6 class="fw-semibold mb-1"><?= $card['title'] ?></h6>
                            <p class="mb-1"><?= $card['content'] ?></p>
                            <p class="text-muted small mb-0"><?= $card['sub'] ?></p>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </section>

        <!-- Contact form + map -->
        <section class="container" id="contact-form">
            <div class="row g-4 align-items-start">
                <div class="col-lg-7" data-aos="fade-right">
                    <div class="contact-form-card">
                        <span class="badge bg-light text-success rounded-pill mb-3">Send us a note</span>
                        <h3 class="fw-semibold mb-3">Share your requirement</h3>
                        <?php if (session()->getFlashdata('success')): ?>
                            <div class="alert alert-success alert-custom"><?= session()->getFlashdata('success') ?></div>
                        <?php endif; ?>
                        <?php if (session()->getFlashdata('errors')): ?>
                            <div class="alert alert-danger alert-custom">
                                <ul class="mb-0">
                                    <?php foreach (session()->getFlashdata('errors') as $error): ?>
                                        <li><?= esc($error) ?></li>
                                    <?php endforeach; ?>
                                </ul>
                            </div>
                        <?php endif; ?>
                        <form action="<?= site_url('contact/send') ?>" method="post" class="row g-3" id="contact-request-form" novalidate>
                            <?= csrf_field() ?>
                            <div class="col-md-6">
                                <input type="text" class="form-control" name="full_name" placeholder="Full Name" value="<?= old('full_name') ?>" required>
                            </div>
                            <div class="col-md-6">
                                <input type="email" class="form-control" name="email" placeholder="Email Address" value="<?= old('email') ?>" required>
                            </div>
                            <div class="col-md-6">
                                <input type="text" class="form-control" name="phone" placeholder="Phone Number" value="<?= old('phone') ?>" required>
                            </div>
                            <div class="col-md-6">
                                <input type="text" class="form-control" name="subject" placeholder="Subject" value="<?= old('subject') ?>" required>
                            </div>
                            <div class="col-12">
                                <textarea name="message" class="form-control" rows="5" placeholder="Tell us about your needs" required><?= old('message') ?></textarea>
                            </div>
                            <div class="col-12 d-flex flex-column flex-md-row gap-3">
                                <button type="submit" class="btn btn-brand px-4 py-3">Submit Inquiry</button>
                                <a href="<?= site_url('about') ?>" class="btn btn-brand-outline px-4 py-3">Know More About Us</a>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="col-lg-5" data-aos="fade-left" data-aos-delay="150">
                    <div class="map-wrapper">
                        <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3503.189508555564!2d77.0460475751682!3d28.59313928601498!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x390d193c3a647f07%3A0x2f8269ba9d5d0a2f!2sCyber%20City!5e0!3m2!1sen!2sin!4v1700000000000" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                    </div>
                    <p class="text-muted small mt-3">Schedule an in-person visit by invitation. Parking and concierge assistance available.</p>
                </div>
            </div>
        </section>

        <!-- FAQ -->
        <section class="container" id="contact-faqs">
            <div class="row mb-4">
                <div class="col-lg-8" data-aos="fade-right">
                    <h2 class="section-heading">Frequently Asked Questions</h2>
                    <p class="section-subtitle">Quick answers for prospective buyers, sellers, and partners.</p>
                </div>
            </div>
            <div class="faq-card" data-aos="fade-up" data-aos-delay="120">
                <div class="accordion accordion-flush" id="contactFAQ">
                    <?php $faqs = [
                        ['q' => 'How soon will I receive a response?', 'a' => 'Our advisors typically respond within 6 business hours with a tailored next step.'],
                        ['q' => 'Can I request virtual walkthroughs?', 'a' => 'Yes, we host HD walkthroughs, drone feeds, and live sessions for NRIs and remote clients.'],
                        ['q' => 'Do you assist with loan and paperwork?', 'a' => 'From loan facilitation to documentation, our concierge desk handles every touchpoint.'],
                        ['q' => 'Is there a dedicated investor desk?', 'a' => 'We have separate desks for institutional, retail investors, and second-home buyers.'],
                    ]; ?>
                    <?php foreach ($faqs as $index => $faq): ?>
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="contactHeading<?= $index ?>">
                                <button class="accordion-button <?= $index !== 0 ? 'collapsed' : '' ?>" type="button" data-bs-toggle="collapse" data-bs-target="#contactCollapse<?= $index ?>" aria-expanded="<?= $index === 0 ? 'true' : 'false' ?>" aria-controls="contactCollapse<?= $index ?>">
                                    <?= $faq['q'] ?>
                                </button>
                            </h2>
                            <div id="contactCollapse<?= $index ?>" class="accordion-collapse collapse <?= $index === 0 ? 'show' : '' ?>" data-bs-parent="#contactFAQ">
                                <div class="accordion-body">
                                    <?= $faq['a'] ?>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </section>

        <!-- CTA -->
        <section class="container" id="contact-cta">
            <div class="cta-banner" data-aos="zoom-in" data-aos-delay="120">
                <div class="row align-items-center g-3">
                    <div class="col-lg-8">
                        <h2 class="fw-semibold mb-3">Prefer a private consultation?</h2>
                        <p class="mb-0">Book an exclusive slot with our leadership team for capital allocation, project marketing, or partner onboarding.</p>
                    </div>
                    <div class="col-lg-4 text-lg-end">
                        <a href="<?= site_url('contact') ?>#contact-form" class="btn btn-light px-4 py-3 fw-semibold">Schedule a Session</a>
                    </div>
                </div>
            </div>
        </section>
    </main>

    <?= $this->include('layouts/modal') ?>
    <?= $this->include('layouts/footer') ?>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/aos@2.3.4/dist/aos.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="<?= base_url('js/script.js') ?>"></script>
    <script>
        AOS.init({
            once: true,
            duration: 900,
            easing: 'ease-out-cubic'
        });

        (function () {
            const form = document.getElementById('contact-request-form');
            if (!form) {
                return;
            }

            const submitButton = form.querySelector('button[type="submit"]');
            const tokenNameMeta = document.querySelector('meta[name="csrf-token-name"]');
            const tokenValueMeta = document.querySelector('meta[name="csrf-token-value"]');
            const csrfInput = form.querySelector('input[type="hidden"]');

            const resolveTokenName = () => (tokenNameMeta?.content || csrfInput?.name || '<?= csrf_token() ?>');
            const resolveTokenValue = () => (tokenValueMeta?.content || csrfInput?.value || '<?= csrf_hash() ?>');

            const refreshTokens = (payload) => {
                if (!payload) {
                    return;
                }
                if (payload.csrfToken) {
                    if (tokenNameMeta) {
                        tokenNameMeta.content = payload.csrfToken;
                    }
                    if (csrfInput) {
                        csrfInput.name = payload.csrfToken;
                    }
                }
                if (payload.csrfHash) {
                    if (tokenValueMeta) {
                        tokenValueMeta.content = payload.csrfHash;
                    }
                    if (csrfInput) {
                        csrfInput.value = payload.csrfHash;
                    }
                }
            };

            const extractErrors = (payload) => {
                if (payload?.errors && typeof payload.errors === 'object') {
                    return Object.values(payload.errors).join('\n');
                }
                if (payload?.messages && typeof payload.messages === 'object') {
                    return Object.values(payload.messages).join('\n');
                }
                return payload?.message || 'Please review the highlighted fields.';
            };

            const toggleButton = (isSubmitting) => {
                if (!submitButton) {
                    return;
                }
                submitButton.disabled = isSubmitting;
                submitButton.textContent = isSubmitting ? 'Sending...' : 'Submit Inquiry';
            };

            form.addEventListener('submit', async (event) => {
                event.preventDefault();

                const fullName = form.full_name.value.trim();
                const email = form.email.value.trim().toLowerCase();
                const phone = form.phone.value.trim();
                const subject = form.subject.value.trim();
                const message = form.message.value.trim();

                const emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
                const phonePattern = /^[0-9\-\+\(\) ]{8,20}$/;

                if (fullName.length < 3 || !emailPattern.test(email) || !phonePattern.test(phone) || subject.length < 3 || message.length < 10) {
                    Swal.fire({
                        icon: 'warning',
                        title: 'Missing details',
                        text: 'Kindly add a valid name, email, phone, subject, and at least 10 characters in the message.',
                    });
                    return;
                }

                toggleButton(true);

                const tokenName = resolveTokenName();
                const tokenValue = resolveTokenValue();

                const requestPayload = {
                    full_name: fullName,
                    email,
                    phone,
                    subject,
                    message,
                };

                if (tokenName && tokenValue) {
                    requestPayload[tokenName] = tokenValue;
                }

                try {
                    const response = await fetch('<?= site_url('api/contact/request') ?>', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-Requested-With': 'XMLHttpRequest',
                            'X-CSRF-TOKEN': tokenValue,
                        },
                        body: JSON.stringify(requestPayload),
                        credentials: 'same-origin',
                    });

                    const data = await response.json().catch(() => ({}));
                    refreshTokens(data);

                    if (!response.ok || data.status !== 'success') {
                        Swal.fire({ icon: 'error', title: 'Please review the form', text: extractErrors(data) });
                        return;
                    }

                    Swal.fire({
                        icon: 'success',
                        title: 'Message sent',
                        text: data.message || 'Our contact desk will respond shortly.',
                        timer: 3200,
                        showConfirmButton: false,
                    });
                    form.reset();
                } catch (error) {
                    Swal.fire({ icon: 'error', title: 'Network error', text: 'Unable to send your request. Please try again shortly.' });
                } finally {
                    toggleButton(false);
                }
            });
        })();
    </script>
</body>

</html>
