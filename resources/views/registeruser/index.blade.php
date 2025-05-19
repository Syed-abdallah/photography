{{-- @extends('dashboard.layout.layout')

@section('content')
<div class="card">
    <div class="card-header">
        <h4>Register New User</h4>
    </div>
    <div class="card-body">
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <form id="registerForm" method="POST" action="{{ route('photography.register.user') }}">
            @csrf

            <div class="mb-3">
                <label for="name" class="form-label">Full Name</label>
                <input type="text" class="form-control @error('name') is-invalid @enderror" 
                       id="name" name="name" value="{{ old('name') }}" required>
                <div class="invalid-feedback" id="nameError">
                    @error('name') {{ $message }} @enderror
                </div>
            </div>

            <div class="mb-3">
                <label for="email" class="form-label">Email Address</label>
                <input type="email" class="form-control @error('email') is-invalid @enderror" 
                       id="email" name="email" value="{{ old('email') }}" required>
                <div class="invalid-feedback" id="emailError">
                    @error('email') {{ $message }} @enderror
                </div>
            </div>

            <div class="mb-3">
                <label for="password" class="form-label">Password</label>
                <input type="password" class="form-control @error('password') is-invalid @enderror" 
                       id="password" name="password" required>
                <div class="invalid-feedback" id="passwordError">
                    @error('password') {{ $message }} @enderror
                </div>
                
                <div class="password-requirements mt-2" id="passwordRequirements" style="display: none;">
                    <small class="text-muted">Password must contain:</small>
                    <ul class="list-unstyled">
                        <li id="lengthReq"><i class="fas fa-circle" id="lengthIcon"></i> At least 8 characters</li>
                        <li id="uppercaseReq"><i class="fas fa-circle" id="uppercaseIcon"></i> At least 1 uppercase letter</li>
                        <li id="numberReq"><i class="fas fa-circle" id="numberIcon"></i> At least 1 number</li>
                    </ul>
                </div>
            </div>

            <div class="mb-3">
                <label for="password_confirmation" class="form-label">Confirm Password</label>
                <input type="password" class="form-control @error('password_confirmation') is-invalid @enderror" 
                       id="password_confirmation" name="password_confirmation" required>
                <div class="invalid-feedback" id="confirmPasswordError">
                    @error('password_confirmation') {{ $message }} @enderror
                </div>
            </div>

            <button type="submit" class="btn btn-primary">Register</button>
        </form>
    </div>
</div>
@endsection

@section('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    const form = document.getElementById('registerForm');
    const password = document.getElementById('password');
    const passwordConfirmation = document.getElementById('password_confirmation');
    const passwordRequirements = document.getElementById('passwordRequirements');

    // Show password requirements when password field gets focus
    password.addEventListener('focus', function() {
        passwordRequirements.style.display = 'block';
    });

    // Hide password requirements if password field is empty and loses focus
    password.addEventListener('blur', function() {
        if (password.value === '') {
            passwordRequirements.style.display = 'none';
        }
    });

    // Real-time password validation
    password.addEventListener('input', function() {
        validatePassword();
        validatePasswordMatch();
    });

    passwordConfirmation.addEventListener('input', validatePasswordMatch);

    form.addEventListener('submit', function(event) {
        if (!validateForm()) {
            event.preventDefault();
            event.stopPropagation();
        }
    });

    function validateForm() {
        let isValid = true;

        // Name validation
        const name = document.getElementById('name');
        if (name.value.trim() === '') {
            showError(name, 'nameError', 'Name is required');
            isValid = false;
        } else if (name.value.trim().length > 255) {
            showError(name, 'nameError', 'Name must not exceed 255 characters');
            isValid = false;
        } else {
            clearError(name, 'nameError');
        }

        // Email validation
        const email = document.getElementById('email');
        const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        if (email.value.trim() === '') {
            showError(email, 'emailError', 'Email is required');
            isValid = false;
        } else if (!emailRegex.test(email.value)) {
            showError(email, 'emailError', 'Please enter a valid email address');
            isValid = false;
        } else if (email.value.trim().length > 255) {
            showError(email, 'emailError', 'Email must not exceed 255 characters');
            isValid = false;
        } else {
            clearError(email, 'emailError');
        }

        // Password validation
        if (!validatePassword()) {
            isValid = false;
        }

        // Password match validation
        if (!validatePasswordMatch()) {
            isValid = false;
        }

        return isValid;
    }

    function validatePassword() {
        const passwordValue = password.value;
        
        // Only show requirements if there's some input
        if (passwordValue.length > 0) {
            passwordRequirements.style.display = 'block';
        } else {
            passwordRequirements.style.display = 'none';
        }
        
        // Length check
        const lengthValid = passwordValue.length >= 8;
        updateRequirement('lengthReq', 'lengthIcon', lengthValid);
        
        // Uppercase check
        const uppercaseValid = /[A-Z]/.test(passwordValue);
        updateRequirement('uppercaseReq', 'uppercaseIcon', uppercaseValid);
        
        // Number check
        const numberValid = /[0-9]/.test(passwordValue);
        updateRequirement('numberReq', 'numberIcon', numberValid);

        // Check if all requirements are met
        const allValid = lengthValid && uppercaseValid && numberValid;
        
        if (passwordValue.length > 0 && !allValid) {
            showError(password, 'passwordError', 'Password must contain at least 8 characters, one uppercase letter, and one number');
            return false;
        } else if (passwordValue.length === 0) {
            showError(password, 'passwordError', 'Password is required');
            return false;
        } else {
            clearError(password, 'passwordError');
            return true;
        }
    }

    function updateRequirement(elementId, iconId, isValid) {
        const element = document.getElementById(elementId);
        const icon = document.getElementById(iconId);
        
        if (isValid) {
            element.style.color = '#28a745'; // Green
            icon.className = 'fas fa-check-circle';
            icon.style.color = '#28a745';
        } else {
            element.style.color = '#dc3545'; // Red
            icon.className = 'fas fa-times-circle';
            icon.style.color = '#dc3545';
        }
    }

    function validatePasswordMatch() {
        if (passwordConfirmation.value !== password.value) {
            showError(passwordConfirmation, 'confirmPasswordError', 'Passwords do not match');
            return false;
        } else if (passwordConfirmation.value === '') {
            showError(passwordConfirmation, 'confirmPasswordError', 'Please confirm your password');
            return false;
        } else {
            clearError(passwordConfirmation, 'confirmPasswordError');
            return true;
        }
    }

    function showError(input, errorElementId, message) {
        const errorElement = document.getElementById(errorElementId);
        input.classList.add('is-invalid');
        errorElement.textContent = message;
    }

    function clearError(input, errorElementId) {
        const errorElement = document.getElementById(errorElementId);
        input.classList.remove('is-invalid');
        errorElement.textContent = '';
    }
});
</script>

<style>
.password-requirements ul {
    margin-top: 5px;
    margin-bottom: 0;
}
.password-requirements li {
    font-size: 0.85rem;
    margin-bottom: 3px;
    transition: all 0.3s ease;
}
.fa-circle {
    font-size: 0.6rem;
    margin-right: 8px;
}
.fa-check-circle, .fa-times-circle {
    margin-right: 5px;
}
</style>
@endsection --}}








@extends('dashboard.layout.layout')

@section('content')
<div class="card">
    <div class="card-header">
        <h4>Register New User</h4>
    </div>
    <div class="card-body">
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <form id="registerForm" method="POST" action="{{ route('photography.register.user') }}">
            @csrf

            <div class="mb-3">
                <label for="name" class="form-label">Full Name</label>
                <input type="text" class="form-control @error('name') is-invalid @enderror" 
                       id="name" name="name" value="{{ old('name') }}" required>
                <div class="invalid-feedback" id="nameError">
                    @error('name') {{ $message }} @enderror
                </div>
            </div>

            <div class="mb-3">
                <label for="email" class="form-label">Email Address</label>
                <input type="email" class="form-control @error('email') is-invalid @enderror" 
                       id="email" name="email" value="{{ old('email') }}" required>
                <div class="invalid-feedback" id="emailError">
                    @error('email') {{ $message }} @enderror
                </div>
            </div>

            <div class="mb-3">
                <label for="password" class="form-label">Password</label>
                <input type="password" class="form-control @error('password') is-invalid @enderror" 
                       id="password" name="password" required>
                <div class="invalid-feedback" id="passwordError">
                    @error('password') {{ $message }} @enderror
                </div>
                
                <div class="password-requirements mt-2" id="passwordRequirements" style="display: none;">
                    <small class="text-muted">Password must contain:</small>
                    <ul class="list-unstyled">
                        <li id="lengthReq"><i class="fas fa-circle" id="lengthIcon"></i> At least 8 characters</li>
                        <li id="uppercaseReq"><i class="fas fa-circle" id="uppercaseIcon"></i> At least 1 uppercase letter</li>
                        <li id="numberReq"><i class="fas fa-circle" id="numberIcon"></i> At least 1 number</li>
                    </ul>
                </div>
            </div>

            <div class="mb-3">
                <label for="password_confirmation" class="form-label">Confirm Password</label>
                <input type="password" class="form-control @error('password_confirmation') is-invalid @enderror" 
                       id="password_confirmation" name="password_confirmation" required>
                <div class="invalid-feedback" id="confirmPasswordError">
                    @error('password_confirmation') {{ $message }} @enderror
                </div>
            </div>

            <!-- Role Selection Section -->
            <div class="card border-0 shadow-sm mb-4">
                <div class="card-header bg-light py-3">
                    <h5 class="mb-0">
                        <i class="fas fa-user-shield me-2"></i>Assign Roles
                    </h5>
                </div>
                <div class="card-body">
                    <div class="row g-3">
                        @foreach($roles as $role)
                            @if($role->name !== 'superadmin')
                            <div class="col-md-6">
                                <div class="role-card p-3 rounded border hover-shadow bg-light">
                                    <div class="form-check mb-0">
                                        <input class="form-check-input" type="checkbox" 
                                               name="roles[]" value="{{ $role->name }}"
                                               id="role-{{ $role->id }}"
                                               {{ in_array($role->name, old('roles', [])) ? 'checked' : '' }} >
                                        <label class="form-check-label d-flex align-items-center" 
                                               for="role-{{ $role->id }}">
                                            <div class="me-3">
                                         
                                            </div>
                                            <div>
                                                <h6 class="mb-1">{{ ucfirst($role->name) }}</h6>
                                                <small class="text-muted">
                                                    {{ $role->description ?? 'Standard system role' }}
                                                </small>
                                            </div>
                                        </label>
                                    </div>
                                </div>
                            </div>
                            @endif
                        @endforeach
                    </div>
                    @error('roles')
                        <div class="text-danger mt-2">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <button type="submit" class="btn btn-primary">Register</button>
        </form>
    </div>
</div>
@endsection

@section('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    const form = document.getElementById('registerForm');
    const password = document.getElementById('password');
    const passwordConfirmation = document.getElementById('password_confirmation');
    const passwordRequirements = document.getElementById('passwordRequirements');

    // Show password requirements when password field gets focus
    password.addEventListener('focus', function() {
        passwordRequirements.style.display = 'block';
    });

    // Hide password requirements if password field is empty and loses focus
    password.addEventListener('blur', function() {
        if (password.value === '') {
            passwordRequirements.style.display = 'none';
        }
    });

    // Real-time password validation
    password.addEventListener('input', function() {
        validatePassword();
        validatePasswordMatch();
    });

    passwordConfirmation.addEventListener('input', validatePasswordMatch);

    form.addEventListener('submit', function(event) {
        if (!validateForm()) {
            event.preventDefault();
            event.stopPropagation();
        }
    });

    function validateForm() {
        let isValid = true;

        // Name validation
        const name = document.getElementById('name');
        if (name.value.trim() === '') {
            showError(name, 'nameError', 'Name is required');
            isValid = false;
        } else if (name.value.trim().length > 255) {
            showError(name, 'nameError', 'Name must not exceed 255 characters');
            isValid = false;
        } else {
            clearError(name, 'nameError');
        }

        // Email validation
        const email = document.getElementById('email');
        const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        if (email.value.trim() === '') {
            showError(email, 'emailError', 'Email is required');
            isValid = false;
        } else if (!emailRegex.test(email.value)) {
            showError(email, 'emailError', 'Please enter a valid email address');
            isValid = false;
        } else if (email.value.trim().length > 255) {
            showError(email, 'emailError', 'Email must not exceed 255 characters');
            isValid = false;
        } else {
            clearError(email, 'emailError');
        }

        // Password validation
        if (!validatePassword()) {
            isValid = false;
        }

        // Password match validation
        if (!validatePasswordMatch()) {
            isValid = false;
        }

        // Role validation (at least one role selected)
        const roleCheckboxes = document.querySelectorAll('input[name="roles[]"]:checked');
        if (roleCheckboxes.length === 0) {
            // You can show an error message here if you want to enforce role selection
            // isValid = false;
        }

        return isValid;
    }

    function validatePassword() {
        const passwordValue = password.value;
        
        // Only show requirements if there's some input
        if (passwordValue.length > 0) {
            passwordRequirements.style.display = 'block';
        } else {
            passwordRequirements.style.display = 'none';
        }
        
        // Length check
        const lengthValid = passwordValue.length >= 8;
        updateRequirement('lengthReq', 'lengthIcon', lengthValid);
        
        // Uppercase check
        const uppercaseValid = /[A-Z]/.test(passwordValue);
        updateRequirement('uppercaseReq', 'uppercaseIcon', uppercaseValid);
        
        // Number check
        const numberValid = /[0-9]/.test(passwordValue);
        updateRequirement('numberReq', 'numberIcon', numberValid);

        // Check if all requirements are met
        const allValid = lengthValid && uppercaseValid && numberValid;
        
        if (passwordValue.length > 0 && !allValid) {
            showError(password, 'passwordError', 'Password must contain at least 8 characters, one uppercase letter, and one number');
            return false;
        } else if (passwordValue.length === 0) {
            showError(password, 'passwordError', 'Password is required');
            return false;
        } else {
            clearError(password, 'passwordError');
            return true;
        }
    }

    function updateRequirement(elementId, iconId, isValid) {
        const element = document.getElementById(elementId);
        const icon = document.getElementById(iconId);
        
        if (isValid) {
            element.style.color = '#28a745'; // Green
            icon.className = 'fas fa-check-circle';
            icon.style.color = '#28a745';
        } else {
            element.style.color = '#dc3545'; // Red
            icon.className = 'fas fa-times-circle';
            icon.style.color = '#dc3545';
        }
    }

    function validatePasswordMatch() {
        if (passwordConfirmation.value !== password.value) {
            showError(passwordConfirmation, 'confirmPasswordError', 'Passwords do not match');
            return false;
        } else if (passwordConfirmation.value === '') {
            showError(passwordConfirmation, 'confirmPasswordError', 'Please confirm your password');
            return false;
        } else {
            clearError(passwordConfirmation, 'confirmPasswordError');
            return true;
        }
    }

    function showError(input, errorElementId, message) {
        const errorElement = document.getElementById(errorElementId);
        input.classList.add('is-invalid');
        errorElement.textContent = message;
    }

    function clearError(input, errorElementId) {
        const errorElement = document.getElementById(errorElementId);
        input.classList.remove('is-invalid');
        errorElement.textContent = '';
    }
});
</script>

<style>
.password-requirements ul {
    margin-top: 5px;
    margin-bottom: 0;
}
.password-requirements li {
    font-size: 0.85rem;
    margin-bottom: 3px;
    transition: all 0.3s ease;
}
.fa-circle {
    font-size: 0.6rem;
    margin-right: 8px;
}
.fa-check-circle, .fa-times-circle {
    margin-right: 5px;
}
.role-card:hover {
    transform: translateY(-2px);
    transition: transform 0.2s ease;
}
.role-icon {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    width: 36px;
    height: 36px;
}
</style>
@endsection