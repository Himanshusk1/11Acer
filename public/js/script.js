// document.addEventListener("DOMContentLoaded", function () {
//     // --- FORM & MODAL ELEMENTS ---
//     const loginModalLabel = document.getElementById("loginModalLabel");
//     const loginBody = document.getElementById('loginBody');
//     const registerBody = document.getElementById('registerBody');
//     const otpBody = document.getElementById('otpBody');

//     const loginForm = document.getElementById("loginForm");
//     const registerForm = document.getElementById("registerForm");

//     // --- BUTTONS ---
//     const openRegisterBtn = document.getElementById("openRegister");
//     const backToLoginBtn = document.getElementById("backToLoginFromRegister");
//     const createAccountBtn = document.getElementById("createAccountBtn"); // Assuming this is the submit button for registration

//     // --- ERROR MESSAGE CONTAINERS ---
//     const loginErrorDiv = document.getElementById('loginError');
//     const registerErrorDiv = document.getElementById('registerError');

//     // --- API URLs (UPDATE IF YOURS ARE DIFFERENT) ---
//     const API_BASE_URL = 'http://localhost:8080/api/auth'; // Change if your URL is different
//     const REGISTER_URL = `${API_BASE_URL}/register`;
//     const LOGIN_URL = `${API_BASE_URL}/login`;

//     // --- UI SWITCHING LOGIC (YOUR EXISTING CODE) ---
//     function showLogin() {
//         loginModalLabel.textContent = 'Login';
//         loginBody.classList.remove('d-none');
//         registerBody.classList.add('d-none');
//         otpBody.classList.add('d-none');
//     }

//     function showRegister() {
//         loginModalLabel.textContent = 'Register For Buyer';
//         registerBody.classList.remove('d-none');
//         loginBody.classList.add('d-none');
//         otpBody.classList.add('d-none');
//     }

//     function showOtp() {
//         loginModalLabel.innerText = "OTP Verification";
//         registerBody.classList.add("d-none");
//         loginBody.classList.add("d-none");
//         otpBody.classList.remove("d-none");
//     }

//     // Event Listeners for switching
//     openRegisterBtn.addEventListener("click", showRegister);
//     backToLoginBtn.addEventListener("click", showLogin);

//     // Note: The original code had a button with id 'openOTP'. I've assumed the registration
//     // submit button is 'createAccountBtn'. If you want the OTP flow after registration,
//     // we can adjust the 'registerForm' submit handler.

//     // --- 🔀 API INTEGRATION & FORM SUBMISSION ---

//     // Handle Registration Form Submission
//     registerForm.addEventListener('submit', async function(event) {
//         event.preventDefault(); // Prevent default page reload

//         // Clear previous errors
//         registerErrorDiv.classList.add('d-none');
//         registerErrorDiv.innerHTML = '';

//         // Collect form data
//         const formData = new FormData(registerForm);
//         const userData = Object.fromEntries(formData.entries());

//         try {
//             const response = await fetch(REGISTER_URL, {
//                 method: 'POST',
//                 headers: {
//                     'Content-Type': 'application/json',
//                     'Accept': 'application/json'
//                 },
//                 body: JSON.stringify(userData)
//             });

//             const result = await response.json();

//             if (!response.ok) {
//                 // Handle validation or other server errors
//                 let errorMessages = 'Registration failed: <br>';
//                 if (result.messages && typeof result.messages === 'object') {
//                     errorMessages += Object.values(result.messages).join('<br>');
//                 } else {
//                     errorMessages += result.message || 'An unknown error occurred.';
//                 }
//                 registerErrorDiv.innerHTML = errorMessages;
//                 registerErrorDiv.classList.remove('d-none');
//             } else {
//                 // Success!
//                 alert('Registration successful! Please login.');
//                 registerForm.reset(); // Clear the form
//                 showLogin(); // Switch to the login form
//             }

//         } catch (error) {
//             console.error('Registration Fetch Error:', error);
//             registerErrorDiv.textContent = 'An network error occurred. Please try again.';
//             registerErrorDiv.classList.remove('d-none');
//         }
//     });

//     // Handle Login Form Submission
//     loginForm.addEventListener('submit', async function(event) {
//         event.preventDefault();
//         loginErrorDiv.classList.add('d-none');

//         const formData = new FormData(loginForm);

//         try {
//             // Your backend's login method likely expects form-urlencoded data, not JSON
//             const response = await fetch(LOGIN_URL, {
//                 method: 'POST',
//                 body: new URLSearchParams(formData)
//             });

//             const result = await response.json();

//             if (!response.ok) {
//                 loginErrorDiv.textContent = result.messages?.error || 'Invalid credentials provided.';
//                 loginErrorDiv.classList.remove('d-none');
//             } else {
//                 // Login successful
//                 alert(`Welcome back, ${result.user.full_name}!`);

//                 // Close the modal and refresh the page to reflect login state
//                 const modalInstance = bootstrap.Modal.getInstance(document.getElementById('loginModal'));
//                 modalInstance.hide();
//                 location.reload();
//             }
//         } catch (error) {
//             console.error('Login Fetch Error:', error);
//             loginErrorDiv.textContent = 'A network error occurred. Please try again.';
//             loginErrorDiv.classList.remove('d-none');
//         }
//     });

//     // --- OTP LOGIC (YOUR EXISTING CODE, UNCHANGED) ---
//     function OTPInput() {
//         const inputs = document.querySelectorAll("#otp > input");
//         for (let i = 0; i < inputs.length; i++) {
//             inputs[i].addEventListener("input", function () {
//                 if (this.value.length > 1) this.value = this.value[0];
//                 if (this.value !== "" && i < inputs.length - 1) inputs[i + 1].focus();
//             });
//             inputs[i].addEventListener("keydown", function (event) {
//                 if (event.key === "Backspace" && i > 0 && this.value === "") {
//                     inputs[i - 1].focus();
//                 }
//             });
//         }
//     }
//     // Note: You would call OTPInput() when the OTP form is shown.
//     // We can add this to the showOtp() function if needed.
// });

document.addEventListener("DOMContentLoaded", function () {
    // --- FORM & MODAL ELEMENTS ---
    const loginModalLabel = document.getElementById("loginModalLabel");
    const loginBody = document.getElementById('loginBody');
    const registerBody = document.getElementById('registerBody');
    const otpBody = document.getElementById('otpBody');

    const loginForm = document.getElementById("loginForm");
    const registerForm = document.getElementById("registerForm");

    const loginErrorDiv = document.getElementById('loginError');
    const registerErrorDiv = document.getElementById('registerError');

    // --- BUTTONS ---
    const backToLoginBtn = document.getElementById("backToLoginFromRegister");
    const backToLoginFromOTP = document.getElementById("backToLoginFromOTP");

    // --- API URLs ---
    const API_BASE_URL = 'http://localhost:8080/api/auth';
    const REGISTER_URL = `${API_BASE_URL}/register`;
    const LOGIN_URL = `${API_BASE_URL}/login`;
    const VERIFY_OTP_URL = `${API_BASE_URL}/verify-otp`;

    let currentUserId = null;
    let requiresProfileCompletion = false;

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
        otpBody.classList.add('d-none');
        registerBody.classList.remove('d-none');
    }

    function showOtp() {
        loginModalLabel.textContent = 'OTP Verification';
        loginBody.classList.add('d-none');
        registerBody.classList.add('d-none');
        otpBody.classList.remove('d-none');
        setupOtpInputs();
    }

    backToLoginBtn.addEventListener("click", showLogin);
    backToLoginFromOTP.addEventListener("click", showLogin);

    // --- OTP INPUT SETUP ---
    function setupOtpInputs() {
        const inputs = document.querySelectorAll("#otp > input");
        inputs.forEach((input, i) => {
            input.addEventListener("input", function () {
                if (this.value.length > 1) this.value = this.value[0];
                if (this.value !== "" && i < inputs.length - 1) inputs[i + 1].focus();
            });
            input.addEventListener("keydown", function (event) {
                if (event.key === "Backspace" && i > 0 && this.value === "") inputs[i - 1].focus();
            });
        });
    }

    // --- LOGIN SUBMIT ---
    loginForm.addEventListener('submit', async function (event) {
        event.preventDefault();
        loginErrorDiv.classList.add('d-none');

        const formData = new FormData(loginForm);
        try {
            const response = await fetch(LOGIN_URL, {
                method: 'POST',
                body: new URLSearchParams(formData)
            });
            const result = await response.json();

            if (!response.ok) {
                loginErrorDiv.textContent = result.message || 'Error logging in.';
                loginErrorDiv.classList.remove('d-none');
            } else {
                currentUserId = result.user_id;
                requiresProfileCompletion = !!result.requires_profile;
                showOtp();
                document.getElementById('maskedNumber').innerText = formData.get('phone_number').replace(/\d(?=\d{4})/g, "*");
            }
        } catch (error) {
            console.error(error);
            loginErrorDiv.textContent = 'Network error. Try again.';
            loginErrorDiv.classList.remove('d-none');
        }
    });

    // --- OTP VALIDATION ---
    document.getElementById('validateBtn').addEventListener('click', async function () {
        const otpInputs = document.querySelectorAll("#otp > input");
        const otp = Array.from(otpInputs).map(i => i.value).join('');

        // Phone number login form se lein
        const phone = document.getElementById('loginPhone').value;

        if (otp.length !== 6 || !phone) {
            alert('Please enter a valid 6-digit OTP.');
            return;
        }

        const formData = new URLSearchParams();
        formData.append('phone_number', phone);
        formData.append('otp', otp);
        if (currentUserId) {
            formData.append('user_id', currentUserId);
        }

        try {
            const response = await fetch(VERIFY_OTP_URL, {
                method: 'POST',
                body: formData // JSON ki jagah form data bhejein
            });

            const result = await response.json();

            if (!response.ok || !result.valid) {
                const errorMsg = result.message || 'Invalid or expired OTP.';
                alert(errorMsg);
                return;
            }

            requiresProfileCompletion = !!result.requires_profile;

            if (requiresProfileCompletion) {
                showRegister();
                registerForm.querySelector('[name="phone_number"]').value = phone;
                return;
            }

            if (result.redirect_url) {
                window.location.href = result.redirect_url;
                return;
            }

            location.reload();
        } catch (error) {
            console.error('OTP Verification Error:', error);
            alert('A network error occurred. Please try again.');
        }
    });

    // --- REGISTRATION SUBMIT ---
    registerForm.addEventListener('submit', async function (e) {
        e.preventDefault();
        registerErrorDiv.classList.add('d-none');
        registerErrorDiv.innerHTML = '';

        const formData = new FormData(registerForm);
        const userData = Object.fromEntries(formData.entries());
        userData.user_id = currentUserId; // send user_id to update existing minimal account

        try {
            const response = await fetch(REGISTER_URL, {
                method: 'POST',
                headers: { 'Content-Type': 'application/json' },
                body: JSON.stringify(userData)
            });
            const result = await response.json();

            if (!response.ok) {
                registerErrorDiv.innerHTML = result.message || 'Error saving details.';
                registerErrorDiv.classList.remove('d-none');
                return;
            }

            const modalInstance = bootstrap.Modal.getInstance(document.getElementById('loginModal'));
            modalInstance.hide();

            if (result.redirect_url) {
                window.location.href = result.redirect_url;
                return;
            }

            location.reload();
        } catch (error) {
            console.error(error);
            registerErrorDiv.textContent = 'Network error. Try again.';
            registerErrorDiv.classList.remove('d-none');
        }
    });
});