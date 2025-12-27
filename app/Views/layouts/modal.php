<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<style>
    #loginModal .modal-content {
        border-radius: 30px;
        border: none;
        background: radial-gradient(circle at top, rgba(25, 135, 84, 0.12), transparent 45%), #fff;
        overflow: hidden;
        box-shadow: 0 30px 60px rgba(7, 20, 15, 0.25);
    }
    #loginModalLabel { font-size: 1.5rem; font-weight: 700; }
    .login-card-wrapper {
        padding: 1rem 0.5rem 0;
        display: flex;
        flex-direction: column;
        gap: 1rem;
    }
    .login-card-note {
        background: #191f16;
        color: #fff;
        border-radius: 16px;
        padding: 0.65rem 0.9rem;
        font-size: 0.8rem;
        line-height: 1.4;
    }
    .section-tagline {
        font-size: 0.9rem;
        letter-spacing: 0.04em;
        text-transform: uppercase;
        color: #198754;
        font-weight: 600;
    }
    .login-card-header {
        text-align: center;
    }
    .login-card-header h6 {
        margin-bottom: 0.4rem;
        font-weight: 700;
        font-size: 1.25rem;
        color: #0f2d1e;
    }
    .login-card-header p {
        font-size: 0.95rem;
        color: #4f574d;
        margin-bottom: 0.3rem;
    }
    .btn-success {
        border-radius: 12px;
        background: linear-gradient(135deg, #198754, #35c27d);
        border: none;
        padding: 0.9rem 1rem;
        font-weight: 600;
    }
    .btn-success:hover { box-shadow: 0 12px 25px rgba(24, 135, 84, 0.45); }
    .highlight-badges {
        display: flex;
        justify-content: center;
        flex-wrap: wrap;
        gap: 0.5rem;
        margin-top: 0.75rem;
    }
    .highlight-badges span {
        border-radius: 999px;
        padding: 0.25rem 0.9rem;
        background: rgba(25, 135, 84, 0.1);
        color: #155a34;
        font-size: 0.75rem;
        font-weight: 600;
    }
    .form-check-label a { color: #198754; }
    .login-otp-grid {
        justify-content: center;
        gap: 0.45rem;
    }
    .login-otp-grid input {
        width: 42px;
        height: 52px;
        font-size: 1.1rem;
        border-radius: 12px;
        text-align: center;
        border: 1px solid rgba(25, 135, 84, 0.3);
        background: #f9fdf8;
    }
    .modal-body { padding: 1.5rem 2rem 2rem; }
    .modal-body form .form-control {
        border-radius: 12px;
        border: 1px solid rgba(15, 45, 30, 0.15);
        padding: 0.85rem 1rem;
    }
    .modal-body .btn-link { color: #198754; text-decoration: none; font-weight: 600; }
</style>

<div class="modal fade" id="loginModal" tabindex="-1" aria-labelledby="loginModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">

            <div class="modal-header">
                <h5 class="modal-title" id="loginModalLabel">Login</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <div class="modal-body" id="loginBody">
                <div class="login-card-wrapper">
                    <div class="section-tagline">Fast access</div>
                    <div class="login-card-header">
                        <h6>OTP login</h6>
                        <p>Enter your mobile number and tap continue to receive a secure OTP.</p>
                        <div class="highlight-badges">
                            <span>OTP in 5s</span>
                            <span>Secure by design</span>
                            <span>Zero passwords</span>
                        </div>
                    </div>
                    <form id="loginForm">
                        <div id="loginError" class="alert alert-danger d-none"></div>
                        <div class="mb-3">
                            <input type="tel" id="loginPhone" name="phone_number" class="form-control"
                                placeholder="+91 Phone Number" required />
                        </div>
                        <div class="d-grid gap-2 mb-2">
                            <button type="submit" class="btn btn-success">Continue</button>
                        </div>
                        <p class="text-center" style="font-size:0.85rem; color:#4d5e52; margin-bottom:0.75rem;">We send a temporary one-time-password to keep your account safe.</p>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="agreeTerms" checked required />
                            <label class="form-check-label" for="agreeTerms" style="font-size: 0.8rem;">
                                I agree to the <a href="#">Terms & Condition</a> and <a href="#">Privacy Policy</a>
                            </label>
                        </div>
                    </form>
                    <div class="login-card-note">
                        Forgot your phone? <strong>Tap “Continue”</strong> and our support squad will help you login via email.
                    </div>
                </div>
            </div>

            <div class="modal-body d-none" id="registerBody">
                <form id="registerForm">
                    <p class="fw-bold">Please complete your registration</p>
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
                        <label class="form-label">You are</label>
                        <div class="btn-group w-100 gap-3" role="group" aria-label="User role selection">
                            <input type="radio" class="btn-check" name="role" id="roleOwner" value="owner"
                                autocomplete="off" checked>
                            <label class="btn rounded-pill role-btn" for="roleOwner">Owner</label>

                            <input type="radio" class="btn-check" name="role" id="roleAgent" value="agent"
                                autocomplete="off">
                            <label class="btn rounded-pill role-btn" for="roleAgent">Agent</label>

                            <input type="radio" class="btn-check" name="role" id="roleBuyer" value="buyer"
                                autocomplete="off">
                            <label class="btn rounded-pill role-btn" for="roleBuyer">Buyer</label>
                        </div>
                    </div>
                    <div class="d-grid">
                        <button type="submit" class="btn btn-success">Save Details & Login</button>
                    </div>
                </form>
            </div>

            <div class="modal-body d-none" id="otpBody">
                <div class="login-card-wrapper">
                    <div class="section-tagline">Secure OTP</div>
                    <div class="login-card-header">
                        <h6>Please enter the OTP sent to</h6>
                        <small class="fw-bold" id="maskedNumber"></small>
                    </div>
                    <div class="text-center">
                        <div id="otp" class="login-otp-grid d-flex mt-2">
                            <input type="text" maxlength="1" />
                            <input type="text" maxlength="1" />
                            <input type="text" maxlength="1" />
                            <input type="text" maxlength="1" />
                            <input type="text" maxlength="1" />
                            <input type="text" maxlength="1" />
                        </div>
                        <div class="mt-4">
                            <button id="validateBtn" class="btn btn-success px-4 validate">Validate</button>
                        </div>
                        <button type="button" class="btn btn-link" id="backToLoginFromOTP">
                            ← Change Number
                        </button>
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