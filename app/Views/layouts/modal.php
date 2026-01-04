<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<style>
    #loginModal .modal-dialog {
        max-width: 540px;
    }
    #loginModal .modal-content {
        border: none;
        overflow: hidden;
        box-shadow: 0 40px 70px rgba(8, 24, 16, 0.28);
    }
    #loginModal .modal-header {
        padding: 1.4rem 2rem 0;
        border: none;
    }
    #loginModalLabel {
        font-size: 1.5rem;
        font-weight: 700;
        color: #0f2d1e;
    }
    #loginModal .modal-body {
        padding: 1.25rem 2rem 2.25rem;
        background: #f8faf9;
    }

    .auth-card {
        position: relative;
        background: #ffffff;
        padding: 2rem 1.9rem;
        box-shadow: 0 24px 48px rgba(12, 39, 26, 0.18);
        overflow: hidden;
        display: grid;
        gap: 1.4rem;
    }
    /* Accent halos for top-right and bottom-left corners */
    .auth-card::after,
    .auth-card::before {
        content: "";
        position: absolute;
        border-radius: 50%;
        filter: blur(0);
        z-index: 0;
    }
    .auth-card::after {
        width: 160px;
        height: 160px;
        top: -60px;
        right: -60px;
        background: var(--accent-primary, rgba(34, 197, 94, 0.18));
    }
    .auth-card::before {
        width: 210px;
        height: 210px;
        bottom: -105px;
        left: -90px;
        background: var(--accent-secondary, rgba(34, 197, 94, 0.12));
    }
    .auth-card > * {
        position: relative;
        z-index: 1;
    }

    .auth-card-login {
        --accent-primary: rgba(34, 197, 94, 0.22);
        --accent-secondary: rgba(16, 185, 129, 0.14);
    }
    .auth-card-otp {
        --accent-primary: rgba(99, 102, 241, 0.22);
        --accent-secondary: rgba(14, 165, 233, 0.14);
    }
    .auth-card-register {
        --accent-primary: rgba(249, 115, 22, 0.22);
        --accent-secondary: rgba(252, 211, 77, 0.16);
    }

    .auth-head {
        text-align: center;
        display: grid;
        gap: 0.75rem;
    }
    .auth-tagline {
        display: inline-block;
        padding: 0.35rem 0.85rem;
        border-radius: 999px;
        background: rgba(34, 197, 94, 0.12);
        color: #15803d;
        font-size: 0.78rem;
        font-weight: 600;
        letter-spacing: 0.08em;
        text-transform: uppercase;
    }
    .auth-card-otp .auth-tagline {
        background: rgba(59, 130, 246, 0.12);
        color: #2563eb;
    }
    .auth-card-register .auth-tagline {
        background: rgba(249, 115, 22, 0.12);
        color: #f97316;
    }
    .auth-head h6 {
        margin: 0;
        font-size: 1.3rem;
        font-weight: 700;
        color: #0f2d1e;
    }
    .auth-head p {
        margin: 0;
        font-size: 0.95rem;
        color: #4f574d;
        line-height: 1.6;
    }
    .auth-badges {
        display: flex;
        justify-content: center;
        flex-wrap: wrap;
        gap: 0.55rem;
    }
    .auth-badges span {
        padding: 0.22rem 0.9rem;
        border-radius: 999px;
        background: rgba(34, 197, 94, 0.1);
        color: #0f5132;
        font-size: 0.75rem;
        font-weight: 600;
        letter-spacing: 0.02em;
    }

    .auth-form .form-control {
        border-radius: 14px;
        border: 1px solid rgba(15, 45, 30, 0.14);
        padding: 0.9rem 1rem;
        background: rgba(248, 250, 248, 0.9);
        transition: border-color 0.2s ease, box-shadow 0.2s ease;
    }
    .auth-form .form-control:focus {
        border-color: rgba(34, 197, 94, 0.6);
        box-shadow: 0 0 0 4px rgba(34, 197, 94, 0.18);
    }

    .btn-success {
        background: linear-gradient(135deg, #16a34a, #22c55e);
        border: none;
        font-weight: 600;
    }
    .btn-success:hover {
        box-shadow: 0 14px 28px rgba(16, 185, 129, 0.36);
    }

    .btn-google {
        border: 1px solid rgba(15, 30, 25, 0.12);
        padding: 0.85rem 1rem;
        font-weight: 600;
        background: #ffffff;
        color: #0f2d1e;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 0.5rem;
        transition: border-color 0.2s ease, box-shadow 0.2s ease;
    }
    .btn-google:hover {
        border-color: rgba(15, 30, 25, 0.32);
        box-shadow: 0 14px 30px rgba(15, 30, 25, 0.08);
    }

    .auth-divider {
        position: relative;
        text-align: center;
        margin: 0.3rem 0 0.6rem;
    }
    .auth-divider::before {
        content: "";
        position: absolute;
        left: 0;
        right: 0;
        top: 50%;
        height: 1px;
        background: rgba(15, 45, 35, 0.1);
    }
    .auth-divider span {
        position: relative;
        background: #ffffff;
        padding: 0 0.65rem;
        font-size: 0.78rem;
        font-weight: 600;
        text-transform: uppercase;
        color: #6b7a6d;
        letter-spacing: 0.08em;
    }

    .form-check-label a {
        color: #16a34a;
        font-weight: 600;
        text-decoration: none;
    }

    .auth-note {
        border-radius: 16px;
        background: #10281c;
        color: #ffffff;
        padding: 0.85rem 1rem;
        font-size: 0.82rem;
        line-height: 1.5;
    }

    .otp-inputs {
        display: flex;
        justify-content: center;
        gap: 0.55rem;
    }
    .otp-inputs input {
        width: 46px;
        height: 56px;
        border-radius: 14px;
        text-align: center;
        font-size: 1.15rem;
        font-weight: 600;
        border: 1px solid rgba(99, 102, 241, 0.28);
        background: rgba(248, 250, 255, 0.9);
    }
    .auth-card-otp .otp-inputs input:focus {
        border-color: rgba(14, 165, 233, 0.6);
        box-shadow: 0 0 0 4px rgba(14, 165, 233, 0.18);
    }

    .auth-phone {
        font-weight: 700;
        letter-spacing: 0.04em;
        color: #0b3b2a;
    }
    .auth-card-otp .auth-phone {
        color: #1d4ed8;
    }

    .role-btn {
        border-radius: 999px;
        border: 1px solid rgba(15, 45, 30, 0.14);
        padding: 0.55rem 1.25rem;
        font-weight: 600;
        color: #0f2d1e;
        background: rgba(248, 250, 248, 0.9);
    }
    .btn-check:checked + .role-btn {
        background: linear-gradient(135deg, #16a34a, #22c55e);
        color: #ffffff;
        border-color: transparent;
        box-shadow: 0 12px 24px rgba(16, 185, 129, 0.32);
    }

    .auth-card-register .btn-success {
        background: linear-gradient(135deg, #f97316, #fb923c);
    }
    .auth-card-register .btn-success:hover {
        box-shadow: 0 14px 28px rgba(249, 115, 22, 0.32);
    }

    .auth-card-register .form-control:focus {
        border-color: rgba(249, 115, 22, 0.6);
        box-shadow: 0 0 0 4px rgba(249, 115, 22, 0.18);
    }

    .auth-card-otp .btn-link {
        color: #2563eb;
        font-weight: 600;
        text-decoration: none;
    }

    @media (max-width: 575.98px) {
        #loginModal .modal-header {
            padding: 1.2rem 1.3rem 0;
        }
        #loginModal .modal-body {
            padding: 1rem 1.3rem 1.8rem;
        }
        .auth-card {
            padding: 1.6rem 1.4rem;
            border-radius: 20px;
        }
        .otp-inputs input {
            width: 42px;
            height: 52px;
        }
    }
</style>

<div class="modal fade" id="loginModal" tabindex="-1" aria-labelledby="loginModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">

            <div class="modal-header">
                <h5 class="modal-title" id="loginModalLabel">Login</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <div class="modal-body" id="loginBody">
                <div class="auth-card auth-card-login rounded-3">
                    <div class="auth-head">
                        <span class="auth-tagline rounded-3">Trusted access</span>
                        <h6>Welcome back to 11 Acer</h6>
                        <p>Verify your mobile number to pick up where you left off with your shortlisted properties.</p>
                        <div class="auth-badges">
                            <span class="rounded-3">Login in seconds</span>
                            <span class="rounded-3">Multi-layer security</span>
                            <span class="rounded-3">Password-free</span>
                        </div>
                    </div>
                    <form id="loginForm" class="auth-form">
                        <div id="loginError" class="alert alert-danger d-none"></div>
                        <div class="mb-3">
                            <input type="tel" id="loginPhone" name="phone_number" class="form-control rounded-3"
                                placeholder="+91 Phone Number" required />
                        </div>
                        <div class="d-grid gap-2 mb-2">
                            <button type="submit" class="btn btn-success">Continue</button>
                        </div>
                        <div class="auth-divider"><span>or</span></div>
                        <button type="button" class="btn btn-google w-100">
                            <i class="bi bi-google"></i>
                            Continue with Google
                        </button>
                        <p class="text-center" style="font-size:0.85rem; color:#4d5e52; margin:0.85rem 0 0.7rem;">We send a one-time passcode to confirm it’s really you before granting access.</p>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="agreeTerms" checked required />
                            <label class="form-check-label" for="agreeTerms" style="font-size: 0.8rem;">
                                I agree to the <a href="#">Terms & Condition</a> and <a href="#">Privacy Policy</a>
                            </label>
                        </div>
                    </form>
                    <div class="auth-note rounded-3">
                        Phone out of reach? <strong>Tap “Continue”</strong> and our concierge team will guide you through email verification.
                    </div>
                </div>
            </div>

            <div class="modal-body d-none" id="registerBody">
                <div class="auth-card auth-card-register rounded-3">
                    <div class="auth-head">
                        <span class="auth-tagline rounded-3">Finish setup</span>
                        <h6>Tell us about you</h6>
                        <p>Unlock curated listings, alerts, and concierge assistance tailored to your buying journey.</p>
                    </div>
                    <form id="registerForm" class="auth-form">
                        <div id="registerError" class="alert alert-danger d-none"></div>
                        <div class="mb-3">
                            <input type="text" name="full_name" class="form-control" placeholder="Full Name" required />
                        </div>
                        <div class="mb-3">
                            <input type="email" name="email" class="form-control" placeholder="Email Address" required />
                        </div>
                        <div class="mb-3">
                            <input type="tel" name="phone_number" class="form-control" placeholder="Phone Number" required
                                readonly />
                        </div>
                        <div class="mb-3">
                            <input type="text" name="city" class="form-control" placeholder="Enter Your City" required />
                        </div>
                        <div class="mb-3">
                            <label class="form-label">You are signing in as</label>
                            <div class="btn-group w-100 gap-2 flex-wrap" role="group" aria-label="User role selection">
                                <input type="radio" class="btn-check" name="role" id="roleOwner" value="owner"
                                    autocomplete="off" checked>
                                <label class="btn role-btn" for="roleOwner">Owner</label>

                                <input type="radio" class="btn-check" name="role" id="roleAgent" value="agent"
                                    autocomplete="off">
                                <label class="btn role-btn" for="roleAgent">Agent</label>

                                <input type="radio" class="btn-check" name="role" id="roleBuyer" value="buyer"
                                    autocomplete="off">
                                <label class="btn role-btn" for="roleBuyer">Buyer</label>
                            </div>
                        </div>
                        <div class="d-grid">
                            <button type="submit" class="btn btn-success">Save Profile & Continue</button>
                        </div>
                    </form>
                </div>
            </div>

            <div class="modal-body d-none" id="otpBody">
                <div class="auth-card auth-card-otp rounded-3">
                    <div class="auth-head">
                        <span class="auth-tagline   rounded-3">Secure OTP</span>
                        <h6>Check your messages</h6>
                        <p>Enter the 6-digit passcode we just sent to <span class="auth-phone" id="maskedNumber"></span></p>
                    </div>
                    <div class="text-center">
                        <div id="otp" class="otp-inputs">
                            <input type="text" maxlength="1" class="rounded-3"/>
                            <input type="text" maxlength="1" class="rounded-3" />
                            <input type="text" maxlength="1" class="rounded-3" />
                            <input type="text" maxlength="1" class="rounded-3" />
                            <input type="text" maxlength="1" class="rounded-3" />
                            <input type="text" maxlength="1" class="rounded-3" />
                        </div>
                        <div class="d-grid gap-3 mt-4">
                            <button id="validateBtn" class="btn btn-success px-4 validate">Validate</button>
                            <button type="button" class="btn btn-link" id="backToLoginFromOTP">← Use a different number</button>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>


<script>
document.addEventListener("DOMContentLoaded", function() {
    // --- ELEMENTS ---
    const loginModalLabel = document.getElementById("loginModalLabel");
    const loginBody = document.getElementById('loginBody');
    const registerBody = document.getElementById('registerBody');
    const otpBody = document.getElementById('otpBody');

    const loginForm = document.getElementById("loginForm");
    const registerForm = document.getElementById("registerForm");
    const loginSubmitBtn = loginForm ? loginForm.querySelector('button[type="submit"]') : null;
    const registerSubmitBtn = registerForm ? registerForm.querySelector('button[type="submit"]') : null;
    const otpValidateBtn = document.getElementById('validateBtn');

    const registerErrorDiv = document.getElementById('registerError');
    const backToLoginFromOTP = document.getElementById("backToLoginFromOTP");

    // --- API URLs ---
    const API_BASE_URL = 'http://localhost:8080/api/auth';
    const LOGIN_URL = `${API_BASE_URL}/login`;
    const VERIFY_OTP_URL = `${API_BASE_URL}/verify-otp`;
    const REGISTER_URL = `${API_BASE_URL}/register`;

    // --- STATE VARIABLES ---
    let currentUserId = null;
    let isNewUser = false;
    let currentPhone = null;

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

    // --- UI FUNCTIONS ---
    function showLogin() {
        loginModalLabel.textContent = 'Login';
        loginBody.classList.remove('d-none');
        registerBody.classList.add('d-none');
        otpBody.classList.add('d-none');
    }

    function showRegister() {
        loginModalLabel.textContent = 'Complete Registration';
        loginBody.classList.add('d-none');
        registerBody.classList.remove('d-none');
        otpBody.classList.add('d-none');
    }

    function showOtp() {
        loginModalLabel.textContent = 'OTP Verification';
        loginBody.classList.add('d-none');
        registerBody.classList.add('d-none');
        otpBody.classList.remove('d-none');
        setupOtpInputs();
    }

    backToLoginFromOTP.addEventListener("click", showLogin);

    function setupOtpInputs() {
        const inputs = document.querySelectorAll("#otp > input");
        inputs.forEach((input, i) => {
            input.value = '';
            input.addEventListener("input", function() {
                if (this.value.length > 1) this.value = this.value[0];
                if (this.value !== "" && i < inputs.length - 1) inputs[i + 1].focus();
            });
            input.addEventListener("keydown", function(event) {
                if (event.key === "Backspace" && i > 0 && this.value === "") inputs[i - 1]
                    .focus();
            });
        });
        inputs[0].focus();
    }

    // --- 1. LOGIN FORM SUBMISSION (VALIDATE and GET OTP) ---
    loginForm.addEventListener('submit', async function(event) {
        event.preventDefault();
        const formData = new FormData(loginForm);
        const phone = formData.get('phone_number').trim();

        // --- YAHAN VALIDATION JODA GAYA HAI ---
        if (!/^\d{10}$/.test(phone)) {
            Swal.fire({
                icon: 'error',
                title: 'Invalid Number',
                text: 'Please enter a valid 10-digit mobile number.'
            });
            return; // API call ko rokein
        }

        currentPhone = phone; // Store phone for OTP verification

        try {
            toggleButtonLoading(loginSubmitBtn, true, 'Sending OTP...');
            const response = await fetch(LOGIN_URL, {
                method: 'POST',
                body: new URLSearchParams({
                    phone_number: phone
                })
            });
            const result = await response.json();

            if (!response.ok) {
                throw new Error(result.messages?.error || 'Failed to send OTP.');
            }

            // --- YAHAN SUCCESS ALERT JODA GAYA HAI ---
            Swal.fire({
                icon: 'success',
                title: 'OTP Sent!',
                text: `An OTP has been sent to ${phone}.`
            });

            currentUserId = result.user_id;
            isNewUser = result.is_new_user;

            showOtp();
            document.getElementById('maskedNumber').innerText = phone.replace(/\d(?=\d{4})/g, "X");

        } catch (error) {
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: error.message
            });
        } finally {
            toggleButtonLoading(loginSubmitBtn, false);
        }
    });

    // --- 2. OTP VALIDATION (No Change) ---
    document.getElementById('validateBtn').addEventListener('click', async function() {
        const otpInputs = document.querySelectorAll("#otp > input");
        const otp = Array.from(otpInputs).map(i => i.value).join('');

        if (otp.length !== 6) {
            return Swal.fire({
                icon: 'warning',
                title: 'Invalid OTP',
                text: 'Please enter a 6-digit code.'
            });
        }

        try {
            toggleButtonLoading(otpValidateBtn, true, 'Verifying...');
            const formData = new URLSearchParams();
            formData.append('phone_number', currentPhone);
            formData.append('otp', otp);

            const response = await fetch(VERIFY_OTP_URL, {
                method: 'POST',
                body: formData
            });

            const result = await response.json();

            if (!response.ok) {
                throw new Error(result.messages?.error || 'Invalid or expired OTP.');
            }

            if (isNewUser) {
                showRegister();
                registerForm.querySelector('[name="phone_number"]').value = currentPhone;
            } else {
                await Swal.fire({
                    icon: 'success',
                    title: 'Logged In!',
                    text: 'Welcome back!',
                    timer: 1500,
                    showConfirmButton: false
                });
                window.location.href = '/dashboard';
            }

        } catch (error) {
            Swal.fire({
                icon: 'error',
                title: 'Verification Failed',
                text: error.message
            });
        } finally {
            toggleButtonLoading(otpValidateBtn, false);
        }
    });

    // --- 3. FINAL REGISTRATION SUBMIT (No Change) ---
    registerForm.addEventListener('submit', async function(e) {
        e.preventDefault();
        const formData = new FormData(registerForm);
        const selectedRole = registerForm.querySelector('input[name="role"]:checked');
        if (!selectedRole) {
            registerErrorDiv.textContent = 'Please choose a role.';
            registerErrorDiv.classList.remove('d-none');
            return;
        }
        formData.set('role', selectedRole.value);
        const userData = Object.fromEntries(formData.entries());
        userData.user_id = currentUserId;

        try {
            toggleButtonLoading(registerSubmitBtn, true, 'Saving...');
            const response = await fetch(REGISTER_URL, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify(userData)
            });
            const result = await response.json();

            if (!response.ok) {
                const errorHtml = Object.values(result.messages).join('<br>');
                registerErrorDiv.innerHTML = errorHtml;
                registerErrorDiv.classList.remove('d-none');
                throw new Error('Please fix the errors above.');
            }

            await Swal.fire({
                icon: 'success',
                title: 'Registration Complete!',
                text: 'You are now logged in.',
                timer: 2000,
                showConfirmButton: false
            });
            window.location.href = '/dashboard';

        } catch (error) {
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: error.message
            });
        } finally {
            toggleButtonLoading(registerSubmitBtn, false);
        }
    });

});
</script>