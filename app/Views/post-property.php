<?php
$page_title = 'Sell or Rent Property - 11 Acer';
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <?php include 'assets/includes/seo-meta.php'; ?>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="<?= base_url('CSS/style.css') ?>">
    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="<?= base_url('CSS/home.css') ?>">

    <style>
    body {
        font-family: 'Inter', sans-serif;
        background-color: #FFFFFF;
    }

    h1,
    h2,
    h3,
    h4,
    h5,
    h6 {
        font-weight: 700;
    }

    .section-title-main {
        font-weight: 700;
        color: #212529;
    }

    .section-subtitle {
        color: #6c757d;
    }

    .btn-brand {
        background-color: #198754;
        color: white;
        border-radius: 8px;
        padding: 0.6rem 1.8rem;
        font-weight: 600;
        transition: background-color 0.2s ease-in-out, box-shadow 0.2s ease-in-out;
        border: none;
    }

    .btn-brand:hover {
        background-color: #146c43;
        color: white;
        box-shadow: 0 4px 15px rgba(25, 135, 84, 0.3);
    }

    .btn-get-started {
        background-color: #198754;
        color: white;
        border-radius: 8px;
        padding: 0.5rem 1.5rem;
        font-weight: 600;
    }

    .post-property-hero {
        position: relative;
        padding: 6rem 0;
        background-color: #e6fae6;
        overflow: hidden;
    }

    .bg-circle-1,
    .bg-circle-2 {
        position: absolute;
        background-color: rgba(144, 238, 144, 0.4);
        border-radius: 50%;
        z-index: 0;
        filter: blur(60px);
    }

    .bg-circle-1 {
        width: 300px;
        height: 300px;
        top: -50px;
        left: -80px;
    }

    .bg-circle-2 {
        width: 300px;
        height: 300px;
        bottom: -60px;
        right: -90px;
    }

    .post-property-hero .hero-title {
        font-size: 2.8rem;
        font-weight: 700;
        color: #198754;
    }

    .post-property-hero .hero-subtitle {
        font-size: 2.8rem;
        font-weight: 700;
        color: #212529;
        line-height: 1.2;
    }

    .benefits-list {
        list-style: none;
        padding-left: 0;
        margin-top: 2rem;
    }

    .benefits-list li {
        font-size: 1.1rem;
        margin-bottom: 1rem;
        display: flex;
        align-items: center;
    }

    .benefits-list .check-icon {
        color: #198754;
        font-size: 1.5rem;
        margin-right: 0.75rem;
    }

    /* FORM STYLES */
    .form-card {
        border: 1px solid #dee2e6;
        border-radius: 12px;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.08);
        padding: 2.5rem;
        background-color: #fff;
    }

    .form-card h5 {
        font-weight: 600;
        margin-bottom: 0.5rem;
    }

    .form-card .form-subtitle {
        font-size: 0.9rem;
        color: #6c757d;
        font-weight: 500;
        margin-bottom: 1.5rem;
    }

    .section-title {
        font-size: 1rem;
        font-weight: 500;
        color: #343a40;
        margin-bottom: 0.75rem;
    }

    .looking-to-tabs .nav-link {
        border: none;
        border-bottom: 3px solid transparent;
        color: #6c757d;
        font-weight: 600;
        padding: 0.5rem 0;
        margin-right: 1.5rem;
        border-radius: 0;
        transition: all 0.2s ease-in-out;
    }

    .looking-to-tabs .nav-link.active {
        border-bottom-color: #198754;
        color: #198754;
        background-color: transparent;
    }

    .form-check-input:checked {
        background-color: #198754;
        border-color: #198754;
    }

    .form-check-label {
        font-weight: 500;
    }

    #property-type-container,
    #sub-type-container {
        display: flex;
        flex-wrap: wrap;
        gap: 0.75rem;
    }

    .prop-type-btn {
        border: 1px solid #dee2e6;
        border-radius: 20px;
        padding: 0.3rem 1rem;
        font-size: 0.9rem;
        font-weight: 500;
        background-color: #fff;
        color: #343a40;
        cursor: pointer;
        transition: all 0.2s ease-in-out;
    }

    .prop-type-btn.active {
        background-color: #198754;
        color: #fff;
        border-color: #198754;
    }

    .form-control {
        border-radius: 8px;
        padding: 0.75rem 1rem;
    }

    .form-control:focus {
        box-shadow: 0 0 0 0.25rem rgba(25, 135, 84, 0.25);
        border-color: #198754;
    }

    .login-link-text {
        font-size: 0.9rem;
        color: #6c757d;
        text-align: center;
    }

    .login-link-text a {
        color: #198754;
        text-decoration: none;
        font-weight: 600;
    }

    .btn-submit {
        background-color: #198754;
        border: none;
        font-weight: 600;
        padding: 0.85rem;
        border-radius: 8px;
        transition: background-color 0.2s;
    }

    .btn-submit:hover {
        background-color: #146c43;
    }

    /* HOW TO POST & FOOTER STYLES */
    .how-to-post-section {
        background-color: #fff;
    }

    .step-card {
        background-color: #f8f9fa;
        border-radius: 15px;
        padding: 1.5rem;
        text-align: center;
        height: 100%;
        border: 1px solid #e9ecef;
        transition: box-shadow 0.3s ease;
    }

    .step-card:hover {
        box-shadow: 0 8px 25px rgba(0, 0, 0, 0.07);
    }

    .step-card img {
        max-width: 100%;
        height: 180px;
        object-fit: cover;
        border-radius: 10px;
        margin-bottom: 1.5rem;
    }

    .step-card h5 {
        font-weight: 600;
    }

    .step-card p {
        color: #6c757d;
    }
    </style>
</head>

<body>
    <?= $this->include('layouts/loader') ?>

    <?= $this->include('layouts/header') ?>

    <main>
        <section class="post-property-hero" data-aos="fade-down" data-aos-delay="120">
            <div class="bg-circle-1"></div>
            <div class="bg-circle-2"></div>
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-lg-6 mb-5 mb-lg-0">
                        <h1 class="hero-title" data-aos="fade-down" data-aos-delay="140">Sell or Rent Property</h1>
                        <h2 class="hero-subtitle" data-aos="fade-down" data-aos-delay="160">Online Faster with 36Brokinghub.com</h2>
                        <ul class="benefits-list">
                            <li data-aos="fade-up" data-aos-delay="200"><i class="bi bi-check-circle-fill check-icon"></i> Advertise for Free</li>
                            <li data-aos="fade-up" data-aos-delay="240"><i class="bi bi-check-circle-fill check-icon"></i> Get Unlimited enquiries</li>
                            <li data-aos="fade-up" data-aos-delay="280"><i class="bi bi-check-circle-fill check-icon"></i> Get shortlisted buyers.</li>
                        </ul>
                    </div>
                    <div class="col-lg-6">
                        <div class="form-card" data-aos="fade-up" data-aos-delay="300">
                            <h5 data-aos="fade-up" data-aos-delay="320">Start Posting your Property. its free</h5>
                            <p class="form-subtitle" data-aos="fade-up" data-aos-delay="340">Add Basic Details</p>

                            <form id="property-form" data-aos="fade-up" data-aos-delay="360">
                                <div class="d-none">
                                    <input type="radio" name="lookingFor" id="sell" value="sell" checked>
                                    <input type="radio" name="lookingFor" id="rent" value="rent">
                                    <input type="radio" name="lookingFor" id="pg" value="pg">
                                </div>

                                <div class="mb-4" data-aos="fade-up" data-aos-delay="380">
                                    <label class="section-title">You're looking to ...</label>
                                    <div class="nav looking-to-tabs" id="lookingToTab">
                                        <a class="nav-link active" data-value="sell" href="#">Sell</a>
                                        <a class="nav-link" data-value="rent" href="#">Rent / Lease</a>
                                        <a class="nav-link" id="pg-tab" data-value="pg" href="#">PG</a>
                                    </div>
                                </div>

                                <div class="mb-4" data-aos="fade-up" data-aos-delay="400">
                                    <label class="section-title">And it's a ...</label>
                                    <div class="d-flex mb-3">
                                        <div class="form-check me-4">
                                            <input class="form-check-input" type="radio" name="propertyCategory"
                                                id="residential" value="residential" checked>
                                            <label class="form-check-label" for="residential">Residential</label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="propertyCategory"
                                                id="commercial" value="commercial">
                                            <label class="form-check-label" for="commercial">Commercial</label>
                                        </div>
                                    </div>
                                    <div id="property-type-container" class="mb-3"></div>
                                    <div id="sub-type-container"></div>
                                </div>

                                <div class="mb-4" data-aos="fade-up" data-aos-delay="420">
                                    <label for="phone" class="section-title">Your contact details</label>
                                    <input type="tel" class="form-control" id="phone" placeholder="Phone Number">
                                </div>

                                <p class="login-link-text mb-4">Are you a registered user? <a href="#">Login</a></p>

                                <button type="submit" class="btn w-100 btn-submit" data-aos="fade-up" data-aos-delay="440" data-swal-confirm="Start posting this property now?">Start Now</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section class="how-to-post-section py-5" data-aos="fade-up" data-aos-delay="480">
            <div class="container">
                <div class="text-center">
                    <p class="text-muted mb-1">How To Post</p>
                    <h2 class="section-title-main" data-aos="fade-up" data-aos-delay="500">Post Your Property in 3 Simple Steps</h2>
                </div>
                <div class="row mt-5">
                    <div class="col-lg-4 col-md-6 mb-4" data-aos="fade-up" data-aos-delay="520">
                        <div class="step-card" data-aos="fade-up" data-aos-delay="540">
                            <img src="https://images.pexels.com/photos/8293778/pexels-photo-8293778.jpeg?auto=compress&cs=tinysrgb&w=800" alt="Fill in property details" data-aos="zoom-in" data-aos-delay="560">
                            <h5>Add details of your property</h5>
                            <p>Begin by telling us the few basic details about your property like your property type,
                                location, No. of rooms etc</p>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6 mb-4" data-aos="fade-up" data-aos-delay="580">
                        <div class="step-card" data-aos="fade-up" data-aos-delay="600">
                            <img src="https://images.pexels.com/photos/439391/pexels-photo-439391.jpeg?auto=compress&cs=tinysrgb&w=800" alt="Upload property photos" data-aos="zoom-in" data-aos-delay="620">
                            <h5>Upload Photos & Videos</h5>
                            <p>Upload photos and videos of your property either via your desktop device or from your
                                mobile phone</p>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6 mb-4">
                        <div class="step-card" data-aos="fade-up" data-aos-delay="640">
                            <img src="https://images.pexels.com/photos/4386379/pexels-photo-4386379.jpeg?auto=compress&cs=tinysrgb&w=800" alt="Pricing and ownership documents" data-aos="zoom-in" data-aos-delay="660">
                            <h5>Add Pricing & Ownership</h5>
                            <p>Just update your property's ownership details and your expected price and your property
                                is ready for posting</p>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>

    <?= $this->include('layouts/footer') ?>
    <?= $this->include('layouts/modal') ?>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script>
    document.addEventListener('DOMContentLoaded', function() {
        const form = document.getElementById('property-form');
        const propertyTypeContainer = document.getElementById('property-type-container');
        const subTypeContainer = document.getElementById('sub-type-container');
        const pgTab = document.getElementById('pg-tab');
        const isLoggedIn = <?= session()->get('isLoggedIn') ? 'true' : 'false' ?>;

        const options = {
            residential: {
                sell: ['FLAT/Apartment', 'House/Villa', 'Builder Floor', 'Plot/Land', 'Studio Apt',
                    'Farmhouse', 'Other'
                ],
                rent: ['FLAT/Apartment', 'House/Villa', 'Builder Floor', 'Studio Apt', 'Serviced Apt',
                    'Farmhouse', 'Other'
                ],
                pg: ['FLAT/Apartment', 'House/Villa', 'Builder Floor', 'Studio Apt', 'Serviced Apt']
            },
            commercial: {
                sell: ['Office', 'Retail', 'Plot/Land', 'Storage', 'Industry', 'Hospitality', 'Other'],
                rent: ['Office', 'Retail', 'Plot/Land', 'Storage', 'Industry', 'Hospitality', 'Other'],
                subTypes: {
                    'Office': ['Ready to move', 'Bare shell', 'Co-working'],
                    'Retail': ['Commercial Shops', 'Showrooms'],
                    'Plot/Land': ['Commercial Land', 'Agricultural Land', 'Industrial Plots'],
                    'Storage': ['Warehouse', 'Cold Storage'],
                    'Industry': ['Factory', 'Manufacturing'],
                    'Hospitality': ['Hotel/Resorts', 'Guest-House']
                }
            }
        };

        function generatePropertyButtons(name, items, container) {
            container.innerHTML = !items || items.length === 0 ? '' : items.map(item =>
                `<button type="button" class="prop-type-btn" data-name="${name}" data-value="${item}">${item}</button>`
            ).join('');
        }

        function updateForm() {
            const category = form.querySelector('input[name="propertyCategory"]:checked').value;
            const lookingFor = form.querySelector('input[name="lookingFor"]:checked').value;

            pgTab.style.display = category === 'commercial' ? 'none' : 'inline-block';
            if (category === 'commercial' && lookingFor === 'pg') {
                document.querySelector('#lookingToTab .nav-link.active').classList.remove('active');
                const sellTab = document.querySelector('#lookingToTab .nav-link[data-value="sell"]');
                sellTab.classList.add('active');
                form.querySelector('input[name="lookingFor"][value="sell"]').checked = true;
            }

            const finalLookingFor = form.querySelector('input[name="lookingFor"]:checked').value;

            subTypeContainer.innerHTML = '';
            const propertyTypes = options[category]?. [finalLookingFor];
            generatePropertyButtons('propertyType', propertyTypes, propertyTypeContainer);
        }

        const lookingToTabs = document.querySelectorAll('#lookingToTab .nav-link');
        lookingToTabs.forEach(tab => {
            tab.addEventListener('click', function(e) {
                e.preventDefault();
                lookingToTabs.forEach(t => t.classList.remove('active'));
                this.classList.add('active');
                const value = this.getAttribute('data-value');
                form.querySelector(`input[name="lookingFor"][value="${value}"]`).checked = true;
                updateForm();
            });
        });

        form.querySelectorAll('input[name="propertyCategory"]').forEach(radio => {
            radio.addEventListener('change', updateForm);
        });

        // CORRECTED LOGIC: Event listener for main property types
        propertyTypeContainer.addEventListener('click', function(event) {
            if (event.target.classList.contains('prop-type-btn')) {
                const mainTypeButtons = propertyTypeContainer.querySelectorAll('.prop-type-btn');
                mainTypeButtons.forEach(btn => btn.classList.remove('active'));
                event.target.classList.add('active');

                const category = form.querySelector('input[name="propertyCategory"]:checked').value;
                const propertyType = event.target.dataset.value;

                if (category === 'commercial' && options.commercial.subTypes[propertyType]) {
                    const subTypes = options.commercial.subTypes[propertyType];
                    generatePropertyButtons('subPropertyType', subTypes, subTypeContainer);
                } else {
                    subTypeContainer.innerHTML = '';
                }
            }
        });

        // CORRECTED LOGIC: Separate listener for sub-types
        subTypeContainer.addEventListener('click', function(event) {
            if (event.target.classList.contains('prop-type-btn')) {
                const subTypeButtons = subTypeContainer.querySelectorAll('.prop-type-btn');
                subTypeButtons.forEach(btn => btn.classList.remove('active'));
                event.target.classList.add('active');
            }
        });

        updateForm();

        if (!isLoggedIn && form) {
            const propertyPhoneInput = document.getElementById('phone');
            const loginModalEl = document.getElementById('loginModal');
            const loginPhoneInput = document.getElementById('loginPhone');
            const loginModalLabel = document.getElementById('loginModalLabel');
            const loginBody = document.getElementById('loginBody');
            const registerBody = document.getElementById('registerBody');
            const otpBody = document.getElementById('otpBody');

            form.addEventListener('submit', function(event) {
                event.preventDefault();
                const phoneValue = propertyPhoneInput?.value.trim() || '';
                if (!/^[0-9]{10}$/.test(phoneValue)) {
                    Swal.fire({
                        icon: 'warning',
                        title: 'Invalid Number',
                        text: 'Please provide a valid 10-digit mobile number to continue.'
                    });
                    propertyPhoneInput?.focus();
                    return;
                }

                if (loginPhoneInput) {
                    loginPhoneInput.value = phoneValue;
                    loginPhoneInput.dispatchEvent(new Event('input', { bubbles: true }));
                }

                if (loginModalLabel) loginModalLabel.textContent = 'Login';
                loginBody?.classList.remove('d-none');
                registerBody?.classList.add('d-none');
                otpBody?.classList.add('d-none');

                const modalInstance = loginModalEl ? bootstrap?.Modal?.getOrCreateInstance(loginModalEl) : null;
                modalInstance?.show();

                const loginForm = document.getElementById('loginForm');
                loginForm?.requestSubmit();
            });
        }
    });
    </script>
</body>

</html>