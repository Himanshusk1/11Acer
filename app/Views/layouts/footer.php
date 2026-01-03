<!-- NEWSLETTER -->
<section class="newsletter-strip">
    <div class="container">
        <div class="newsletter-inner">
            <div>
                <h4>Subscribe to Our Newsletter</h4>
                <p>Get the latest property updates and exclusive deals</p>
            </div>
            <form class="newsletter-form d-flex flex-wrap">
                <input type="email" placeholder="Enter your email" required>
                <button type="submit">Subscribe</button>
            </form>
        </div>
    </div>
</section>

<!-- FOOTER -->
<footer class="site-footer-v2">
    <div class="container">
        <div class="row gy-4">

            <!-- BRAND -->
            <div class="col-lg-3 col-md-6">
                <div class="footer-brand">
                    <h5 class="brand-name">11acer.ai</h5>
                    <p>
                        Your trusted partner in finding the perfect property.
                        We make real estate simple, transparent, and accessible.
                    </p>
                    <div class="social-icons">
                        <a href="#"><i class="bi bi-facebook"></i></a>
                        <a href="#"><i class="bi bi-twitter"></i></a>
                        <a href="#"><i class="bi bi-instagram"></i></a>
                        <a href="#"><i class="bi bi-linkedin"></i></a>
                    </div>
                </div>
            </div>

            <!-- QUICK LINKS -->
            <div class="col-lg-3 col-md-6">
                <h6 class="footer-title">Quick Links</h6>
                <ul class="footer-links">
                    <li><a href="<?= site_url('about') ?>">About Us</a></li>
                    <li><a href="<?= site_url('properties') ?>">Properties</a></li>
                    <li><a href="<?= site_url('agents') ?>">Agents</a></li>
                    <li><a href="<?= site_url('blog') ?>">Blog</a></li>
                    <li><a href="<?= site_url('contact') ?>">Contact</a></li>
                </ul>
            </div>

            <!-- SERVICES -->
            <div class="col-lg-3 col-md-6">
                <h6 class="footer-title">Services</h6>
                <ul class="footer-links">
                    <li><a href="#">Buy Property</a></li>
                    <li><a href="#">Sell Property</a></li>
                    <li><a href="#">Rent Property</a></li>
                    <li><a href="#">Property Management</a></li>
                    <li><a href="#">Home Loans</a></li>
                </ul>
            </div>

            <!-- CONTACT -->
            <div class="col-lg-3 col-md-6">
                <h6 class="footer-title">Contact Us</h6>
                <ul class="footer-contact">
                    <li><i class="bi bi-geo-alt"></i> 123 Real Estate Ave,<br>Mumbai, Maharashtra 400001</li>
                    <li><i class="bi bi-telephone"></i> +91 98765 43210</li>
                    <li><i class="bi bi-envelope"></i> info@homeproperty.com</li>
                </ul>
            </div>
        </div>

        <!-- BOTTOM -->
        <div class="footer-bottom">
            <p>© 2026 11acer.ai. All rights reserved.</p>
            <div class="footer-bottom-links">
                <a href="<?= site_url('privacy-policy') ?>">Privacy Policy</a>
                <a href="<?= site_url('terms') ?>">Terms of Service</a>
                <a href="<?= site_url('cookies') ?>">Cookie Policy</a>
            </div>
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