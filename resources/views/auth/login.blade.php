
<!DOCTYPE html>
<html lang="en" data-bs-theme="dark">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Neon Login | Bootstrap 5.3</title>
    <!-- Bootstrap 5.3 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <!-- Animate.css -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css">
    <style>
        :root {
            --primary-glow: rgba(110, 142, 251, 0.15);
            --success-glow: rgba(40, 167, 69, 0.15);
            --glass-blur: blur(9px);
        }

        html,
        body {
            height: 100%;
            overflow: hidden;
        }

        body {
    background: 
        linear-gradient(rgba(22, 22, 22, 0.7), rgba(0, 0, 0, 0.9)),
        url('https://images.unsplash.com/photo-1639762681057-408e52192e55?q=80&w=2232&auto=format&fit=crop') no-repeat center center fixed;
    background-size: cover;
    min-height: 100vh;
    display: flex;
    align-items: center;
    overflow-x: hidden;
}

        .login-container {
            backdrop-filter: var(--glass-blur);
            -webkit-backdrop-filter: var(--glass-blur);
            background: rgba(255, 255, 255, 0.08);
            border-radius: 24px;
            border: 1px solid rgba(255, 255, 255, 0.1);
            box-shadow: 0 8px 32px 0 rgba(31, 38, 135, 0.37);
            overflow: hidden;
            transition: all 0.5s ease;
        }

        .login-container:hover {
            box-shadow: 0 8px 32px 0 rgba(110, 142, 251, 0.3);
            border-color: rgba(110, 142, 251, 0.3);
        }

        .form-control {
            background: rgba(255, 255, 255, 0.05);
            border: 1px solid rgba(255, 255, 255, 0.1);
            color: white !important;
            transition: all 0.3s ease;
        }

        .form-control:focus {
            background: rgba(255, 255, 255, 0.1);
            border-color: rgba(110, 142, 251, 0.6);
            box-shadow: 0 0 0 0.25rem var(--primary-glow);
        }

        .btn-neon {
            position: relative;
            overflow: hidden;
            z-index: 1;
            border: none;
            transition: all 0.4s cubic-bezier(0.25, 0.8, 0.25, 1);
        }

        .btn-neon:before {
            content: "";
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: linear-gradient(45deg, #667eea, #764ba2, #6B8DD6, #8E37D7);
            background-size: 400% 400%;
            z-index: -1;
            transition: 0.5s;
            animation: gradient 8s ease infinite;
        }

        .btn-neon:hover:before {
            background-position: 100% 100%;
        }

        @keyframes gradient {
            0% {
                background-position: 0% 50%;
            }

            50% {
                background-position: 100% 50%;
            }

            100% {
                background-position: 0% 50%;
            }
        }

        .password-strength {
            height: 4px;
            background: rgba(255, 255, 255, 0.1);
            margin-top: 8px;
            border-radius: 2px;
            overflow: hidden;
        }

        .strength-meter {
            height: 100%;
            width: 0;
            transition: width 0.4s ease;
        }

        .biometric-btn {
            cursor: pointer;
            transition: transform 0.3s ease;
        }

        .biometric-btn:hover {
            transform: scale(1.1);
        }

        .floating-label {
            position: relative;
            margin-bottom: 1.5rem;
        }

        .floating-label label {
            position: absolute;
            top: 12px;
            left: 15px;
            color: rgba(255, 255, 255, 0.7);
            transition: all 0.3s ease;
            pointer-events: none;
        }

        .floating-label input:focus+label,
        .floating-label input:not(:placeholder-shown)+label {
            top: -18px;
            left: 10px;
            font-size: 12px;
            color: #6e8efb;
            background: linear-gradient(to bottom, rgba(30, 30, 40, 0.9), rgba(30, 30, 40, 0.7));
            padding: 0 5px;
            border-radius: 4px;
        }

        .particles {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            pointer-events: none;
            z-index: -1;
        }

        .particle {
            position: absolute;
            background: rgba(255, 255, 255, 0.5);
            border-radius: 50%;
            animation: float linear infinite;
        }

        @keyframes float {
            0% {
                transform: translateY(0) rotate(0deg);
                opacity: 1;
            }

            100% {
                transform: translateY(-100vh) rotate(360deg);
                opacity: 0;
            }
        }
    </style>
</head>

<body class="bg-dark text-white">
    <!-- Animated Background Particles -->
    <div class="particles" id="particles"></div>

    <div class="container p-5">
        <div class="row justify-content-center">
            <div class="col-md-8 col-lg-6 col-xl-5">
                <div class="login-container p-5 p-md-5 animate__animated animate__fadeIn">
                    <!-- Logo Header -->
                    <div class="text-center ">
                        <!-- <div class="d-inline-block p-1 rounded-circle bg-primary bg-opacity-10 ">
                            <i class="bi bi-fingerprint fs-1 text-primary"></i>
                        </div> -->
                        <h2 class="fw-bold mb-1">Secure Access</h2>
                        <p class="text-muted">Enter your credentials to continue</p>
                    </div>

                    <!-- Login Form -->
                    {{-- <form id="loginForm" class="needs-validation" novalidate>
                        <!-- Email Field -->
                        <div class="floating-label mb-4">
                            <input type="email" class="form-control form-control-lg" id="email" placeholder=" "
                                required>
                            <label for="email">Email Address</label>
                            <div class="invalid-feedback">
                                Please provide a valid email address
                            </div>
                        </div>

                        <!-- Password Field -->
                        <div class="floating-label mb-3">
                            <input type="password" class="form-control form-control-lg" id="password" placeholder=" "
                                required minlength="8">
                            <label for="password">Password</label>
                            <div class="invalid-feedback">
                                Password must be at least 8 characters
                            </div>
                            <div class="password-strength mt-2">
                                <div class="strength-meter" id="strengthMeter"></div>
                            </div>
                        </div>

                        <!-- Security Row -->
                        <div class="d-flex justify-content-between align-items-center mb-4">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" id="remember">
                                <label class="form-check-label" for="remember">Remember device</label>
                            </div>
                            <a href="#forgot-password" class="text-decoration-none text-warning">Forgot password?</a>
                        </div>

                        <!-- Submit Button -->
                        <button type="submit" class="btn btn-neon btn-primary btn-lg w-100 py-3 mb-4 text-white">
                            <span class="position-relative">Sign In</span>
                        </button>

                        <!-- Biometric Auth -->
                        <div class="text-center ">
                            <p class="text-muted mb-2">Or sign in with</p>
                            <div class="d-flex justify-content-center gap-3">
                                <div class="biometric-btn" data-bs-toggle="tooltip" title="Face ID">
                                    <i class="bi bi-camera-fill fs-4 text-primary"></i>
                                </div>
                                <div class="biometric-btn" data-bs-toggle="tooltip" title="Fingerprint">
                                    <i class="bi bi-fingerprint fs-4 text-primary"></i>
                                </div>
                                <div class="biometric-btn" data-bs-toggle="tooltip" title="Security Key">
                                    <i class="bi bi-usb-drive-fill fs-4 text-primary"></i>
                                </div>
                            </div>
                        </div>




                    </form> --}}
                  <!-- Login Form -->
<form id="loginForm" method="POST" action="{{ route('login') }}" class="needs-validation" novalidate>
    @csrf
    
    <!-- Authentication Errors -->
    @if ($errors->any())
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            @foreach ($errors->all() as $error)
                {{ $error }}<br>
            @endforeach
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <!-- Email Field -->
    <div class="floating-label mb-4">
        <input type="email" class="form-control form-control-lg @error('email') is-invalid @enderror" 
               id="email" name="email" placeholder=" " value="{{ old('email') }}" required autofocus>
        <label for="email">Email Address</label>
        @error('email')
            <div class="invalid-feedback d-block">
                {{ $message }}
            </div>
        @enderror
    </div>

    <!-- Password Field -->
    <div class="floating-label mb-3">
        <input type="password" class="form-control form-control-lg @error('password') is-invalid @enderror" 
               id="password" name="password" placeholder=" " required autocomplete="current-password">
        <label for="password">Password</label>
        @error('password')
            <div class="invalid-feedback d-block">
                {{ $message }}
            </div>
        @enderror
        <div class="password-strength mt-2">
            <div class="strength-meter" id="strengthMeter"></div>
        </div>
    </div>

    <!-- Remember Me -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div class="form-check">
            <input class="form-check-input" type="checkbox" id="remember" name="remember">
            <label class="form-check-label" for="remember">Remember me</label>
        </div>
        @if (Route::has('password.request'))
            <a href="{{ route('password.request') }}" class="text-decoration-none text-warning">Forgot password?</a>
        @endif
    </div>

    <!-- Submit Button -->
    <button type="submit" class="btn btn-neon btn-primary btn-lg w-100 py-3 mb-4 text-white">
        <span class="position-relative">Sign In</span>
    </button>

    <!-- Biometric Auth (optional) -->
    <div class="text-center">
        <p class="text-muted mb-2">Or sign in with</p>
        <div class="d-flex justify-content-center gap-3">
            <div class="biometric-btn" data-bs-toggle="tooltip" title="Face ID">
                <i class="bi bi-camera-fill fs-4 text-primary"></i>
            </div>
            <div class="biometric-btn" data-bs-toggle="tooltip" title="Fingerprint">
                <i class="bi bi-fingerprint fs-4 text-primary"></i>
            </div>
            <div class="biometric-btn" data-bs-toggle="tooltip" title="Security Key">
                <i class="bi bi-usb-drive-fill fs-4 text-primary"></i>
            </div>
        </div>
    </div>
</form>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

    <script>
        // Create animated particles
        function createParticles() {
            const container = document.getElementById('particles');
            const particleCount = window.innerWidth < 808 ? 25 : 60;

            for (let i = 0; i < particleCount; i++) {
                const particle = document.createElement('div');
                particle.classList.add('particle');

                // Random properties
                const size = Math.random() * 5 + 2;
                const posX = Math.random() * window.innerWidth;
                const duration = Math.random() * 15 + 10;
                const delay = Math.random() * 5;

                particle.style.width = `${size}px`;
                particle.style.height = `${size}px`;
                particle.style.left = `${posX}px`;
                particle.style.bottom = `-10px`;
                particle.style.animationDuration = `${duration}s`;
                particle.style.animationDelay = `${delay}s`;
                particle.style.opacity = Math.random() * 0.5 + 0.1;

                container.appendChild(particle);
            }
        }

        // Password strength indicator
        document.getElementById('password').addEventListener('input', function (e) {
            const password = e.target.value;
            const meter = document.getElementById('strengthMeter');
            let strength = 0;

            // Check password strength
            if (password.length > 0) strength += 20;
            if (password.length >= 8) strength += 20;
            if (/[A-Z]/.test(password)) strength += 20;
            if (/[0-9]/.test(password)) strength += 20;
            if (/[^A-Za-z0-9]/.test(password)) strength += 20;

            // Update meter
            meter.style.width = `${strength}%`;
            meter.style.backgroundColor = strength < 40 ? '#dc3545' :
                strength < 70 ? '#fd7e14' :
                    strength < 90 ? '#ffc107' : '#28a745';
        });

        // Form validation
   // Form validation
(function () {
    'use strict'

    const form = document.getElementById('loginForm');

    form.addEventListener('submit', function (event) {
        if (!form.checkValidity()) {
            event.preventDefault()
            event.stopPropagation()
        }
        
        form.classList.add('was-validated')
    }, false)
})();

// Password strength indicator (keep this as is)
document.getElementById('password').addEventListener('input', function (e) {
    const password = e.target.value;
    const meter = document.getElementById('strengthMeter');
    let strength = 0;

    // Check password strength
    if (password.length > 0) strength += 20;
    if (password.length >= 8) strength += 20;
    if (/[A-Z]/.test(password)) strength += 20;
    if (/[0-9]/.test(password)) strength += 20;
    if (/[^A-Za-z0-9]/.test(password)) strength += 20;

    // Update meter
    meter.style.width = `${strength}%`;
    meter.style.backgroundColor = strength < 40 ? '#dc3545' :
        strength < 70 ? '#fd7e14' :
            strength < 90 ? '#ffc107' : '#28a745';
});

        // Initialize tooltips
        document.addEventListener('DOMContentLoaded', function () {
            createParticles();

            // Initialize Bootstrap tooltips
            const tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
            tooltipTriggerList.map(function (tooltipTriggerEl) {
                return new bootstrap.Tooltip(tooltipTriggerEl, {
                    trigger: 'hover'
                });
            });

            // Biometric auth simulation
            document.querySelectorAll('.biometric-btn').forEach(btn => {
                btn.addEventListener('click', function () {
                    const icon = this.querySelector('i');
                    const originalClass = icon.className;

                    // Show loading state
                    icon.className = 'bi bi-arrow-repeat fs-4 text-primary spin';

                    // Simulate biometric scan
                    setTimeout(() => {
                        icon.className = 'bi bi-check-circle-fill fs-4 text-success';

                        // Reset after delay
                        setTimeout(() => {
                            icon.className = originalClass;
                        }, 1500);
                    }, 1000);
                });
            });
        });

        // Add spin class to icon
        const style = document.createElement('style');
        style.innerHTML = `
            .spin {
                animation: spin 1s linear infinite;
            }
            @keyframes spin {
                from { transform: rotate(0deg); }
                to { transform: rotate(360deg); }
            }
        `;
        document.head.appendChild(style);
    </script>
</body>

</html>