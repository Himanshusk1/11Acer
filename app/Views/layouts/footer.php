
    <!-- FOOTER -->
    <footer class="site-footer text-white py-5">
        <div class="container">
            <div class="row gy-4" style="justify-content: space-between;">
                <!-- Logo / Brand -->
                <div class="col-12 col-md-4 col-lg-2 mb-3 footer-col">
                    <div class="text-center text-md-start">
                        <a href="/" class="footer-logo-link d-inline-block">
                            <img src="<?= base_url('images/PNG.png'); ?>"
                                 alt="36 Broking Hub"
                                 class="footer-brand img-fluid rounded-3 shadow-sm"
                                 loading="lazy">
                        </a>
                    </div>
                </div>

                <!-- Support -->
                <div class="col-6 col-md-4 col-lg-2 mb-3 footer-col">
                    <h5 class="footer-section-title">Support</h5>
                    <ul class="nav flex-column footer-list">
                        <li class="nav-item mb-2"><a href="<?= site_url('contact'); ?>" class="nav-link p-0">24x7 Chat Support</a></li>
                        <li class="nav-item mb-2"><a href="mailto:info@36brokinghub.com" class="nav-link p-0">Send us an email</a></li>
                    </ul>
                </div>

                <!-- Quick Links -->
                <div class="col-6 col-md-4 col-lg-2 mb-3 footer-col">
                    <h5 class="footer-section-title">Quick Links</h5>
                    <ul class="nav flex-column footer-list mb-0">
                        <li class="nav-item mb-2"><a href="<?= site_url('properties'); ?>" class="nav-link p-0">For Buyers</a></li>
                        <li class="nav-item mb-2"><a href="<?= site_url('commercial'); ?>" class="nav-link p-0">Commercial</a></li>
                        <li class="nav-item mb-2"><a href="<?= site_url('residential'); ?>" class="nav-link p-0">Residential</a></li>
                        <li class="nav-item mb-2"><a href="<?= site_url('services'); ?>" class="nav-link p-0">Services</a></li>
                        <li class="nav-item mb-2"><a href="<?= site_url('about'); ?>" class="nav-link p-0">About Us</a></li>
                        <li class="nav-item mb-2"><a href="<?= site_url('contact'); ?>" class="nav-link p-0">Contact</a></li>
                    </ul>
                </div>

                <!-- Important link -->
                <div class="col-6 col-md-4 col-lg-2 mb-3 footer-col">
                    <h5 class="footer-section-title">Important link</h5>
                    <ul class="nav flex-column footer-list mb-0">
                        <li class="nav-item mb-2"><a href="<?= site_url('privacy-policy'); ?>" class="nav-link p-0">Privacy Policy</a></li>
                        <li class="nav-item mb-2"><a href="<?= site_url('terms'); ?>" class="nav-link p-0">Terms of Use</a></li>
                        <li class="nav-item mb-2"><a href="<?= site_url('faq'); ?>" class="nav-link p-0">FAQ</a></li>
                        <li class="nav-item mb-2"><a href="<?= site_url('dashboard'); ?>" class="nav-link p-0">My Account</a></li>
                        <li class="nav-item mb-2"><a href="<?= site_url('login'); ?>" class="nav-link p-0">Login / Register</a></li>
                    </ul>
                </div>

                <!-- Download App + Social -->
                <div class="col-12 col-md-8 col-lg-2 mb-3 footer-col" style="width: max-content;">
                    <h5 class="footer-section-title">Download App</h5>
                    <div class="d-flex flex-column flex-sm-row flex-md-column flex-lg-column gap-2 mb-2" style="flex-direction: row !important;">
                        <a href="#"><img src="https://placehold.co/120x40/343a40/fff?text=Play+Store" alt="Play Store" class="img-fluid"></a>
                        <a href="#"><img src="https://placehold.co/120x40/343a40/fff?text=App+Store" alt="App Store" class="img-fluid"></a>
                    </div>
                    <div class="social-icons mt-1 d-flex">
                        <a href="https://www.instagram.com/36_broking_hub" target="_blank" rel="noopener noreferrer"><i class="bi bi-instagram"></i></a>
                        <a href="https://www.facebook.com/36Brokinghub" target="_blank" rel="noopener noreferrer"><i class="bi bi-facebook"></i></a>
                        <a href="https://www.youtube.com/@36brokinghub-v6r" target="_blank" rel="noopener noreferrer"><i class="bi bi-youtube"></i></a>
                        <a href="https://www.linkedin.com/company/36-brokinghub/" target="_blank" rel="noopener noreferrer"><i class="bi bi-linkedin"></i></a>
                    </div>
                </div>
            </div>

            <div class="footer-bottom d-flex flex-column flex-sm-row justify-content-between align-items-center gap-2 py-4 mt-4 border-top text-white small">
                <p class="mb-0 text-center text-sm-start">Website secured and maintained by
                    <a href="https://sachiva.in/" target="_blank" rel="noopener" class="text-decoration-none text-reset fw-semibold">
                        Sachiva Web &amp; Security
                    </a>
                </p>
                <p class="mb-0 text-center text-sm-end">&copy; All copyright resverd for sachiva web and security 2025</p>
            </div>
        </div>
    </footer>
    <!-- Ensure AOS is available on pages that may not include header (lightweight initializer) -->
    <link rel="stylesheet" href="https://unpkg.com/aos@2.3.4/dist/aos.css">
    <script defer src="https://unpkg.com/aos@2.3.4/dist/aos.js"></script>
    <!-- SweetAlert2 (fallback for pages that don't include the header) -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
    <script defer src="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.all.min.js"></script>
    <script>
    (function(){
        try {
            function enableAOS() {
                if (!window.AOS) return;
                // Attach simple fade-up to key elements if not present
                const sel = ['section','article','.card','.property-listings','.agent-card','.projects-container','h1','h2','h3','img'];
                const nodes = [];
                sel.forEach(s => document.querySelectorAll(s).forEach(n => nodes.push(n)));
                Array.from(new Set(nodes)).forEach((el, i) => {
                    if (el.closest && (el.closest('nav') || el.closest('footer'))) return;
                    if (!el.hasAttribute('data-aos')) el.setAttribute('data-aos','fade-up');
                    if (!el.hasAttribute('data-aos-delay')) el.setAttribute('data-aos-delay', String(Math.min(600, i*30)));
                });
                AOS.init && AOS.init({ once: true, duration: 600, easing: 'ease-out-cubic' });
                try{ AOS.refresh && AOS.refresh(); } catch(e){}
            }
            // Init when library available
            function waitForAOS(){ if (window.AOS) enableAOS(); else setTimeout(waitForAOS, 100); }
            document.addEventListener('DOMContentLoaded', waitForAOS);
            window.addEventListener('load', waitForAOS);
        } catch(e) { console.error('Footer AOS init error', e); }
    })();
    </script>
    <!-- SweetAlert2 helpers: attribute-driven confirm dialogs -->
    <script>
    (function(){
        function dispatchConfirmed(el){
            try {
                const ev = new CustomEvent('swal:confirmed', { detail: { element: el } });
                el.dispatchEvent(ev);
            } catch(e){ console.error(e); }
        }

        document.addEventListener('click', function(evt){
            const btn = evt.target.closest('[data-swal-confirm]');
            if(!btn) return;
            evt.preventDefault();

            // Message and options
            const message = btn.getAttribute('data-swal-confirm') || 'Are you sure?';
            const confirmText = btn.getAttribute('data-swal-confirm-text') || 'Yes';
            const cancelText = btn.getAttribute('data-swal-cancel-text') || 'Cancel';
            const href = btn.getAttribute('data-swal-href');

            if(typeof Swal === 'undefined'){
                // Fallback: simple confirm
                if(confirm(message)){
                    if(href && href !== '#') window.location = href;
                    else dispatchConfirmed(btn);
                }
                return;
            }

            Swal.fire({
                text: message,
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: confirmText,
                cancelButtonText: cancelText,
                reverseButtons: true
            }).then(function(result){
                if(result.isConfirmed){
                    if(href && href !== '#'){
                        window.location = href;
                        return;
                    }

                    // If the button is inside a form, submit that form (use requestSubmit when available)
                    try {
                        const form = btn.closest('form');
                        if (form) {
                            if (typeof form.requestSubmit === 'function') {
                                form.requestSubmit();
                            } else {
                                form.submit();
                            }
                            return;
                        }
                    } catch (e) {
                        console.error('form submit after swal confirm failed', e);
                    }

                    // Otherwise dispatch a confirmed event for JS handlers
                    dispatchConfirmed(btn);
                }
            });
        }, false);
    })();
    </script>