{{-- @extends('dashboard.layout.layout')

@section('title', 'Edit User')
@section('content')

<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <h2 class="my-3">Edit User</h2>
                    <form action="{{ route('user.update', $user->id) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <!-- User Name (Read-Only) -->
                        <div class="form-group">
                            <label for="name" class="form-label">Name</label>
                            <input type="text" id="name" class="form-control" value="{{ $user->name }}" readonly>
                        </div>

                        <!-- User Email (Read-Only) -->
                        <div class="form-group">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" id="email" class="form-control" value="{{ $user->email }}" readonly>
                        </div>

                        <!-- Roles -->
                        <div class="form-group">
                            <label for="roles" class="form-label">Roles</label>
                            <div>
                                @foreach ($roles as $role)
                                @if ($role->name !== 'superadmin')
                                    <div class="form-check form-check-inline">
                                        <input 
                                            type="checkbox" 
                                            class="form-check-input" 
                                            name="roles[]" 
                                            value="{{ $role->name }}" 
                                            id="role-{{ $role->id }}"
                                            {{ $user->roles->contains('name', $role->name) ? 'checked' : '' }}>
                                        
                                        <label class="form-check-label" for="role-{{ $role->id }}">
                                            {{ $role->name }}
                                        </label>
                                    </div>
                                @endif
                            @endforeach
                            
                            </div>
                        </div>

                        <button type="submit" class="btn btn-primary">Update User</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection --}}



@extends('dashboard.layout.layout')

@section('title', 'Edit User')

@section('content')
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-xl-12">
            <div class="card shadow-lg animate__animated animate__fadeIn">
                <div class="card-header bg-gradient-primary text-white py-3">
                    <div class="d-flex justify-content-between align-items-center">
                        <h4 class="mb-0">
                            <i class="fas fa-user-edit me-2"></i>Edit User Profile
                        </h4>
                        <span class="badge bg-white text-primary fs-6">
                            User ID: #{{ $user->id }}
                        </span>
                    </div>
                </div>
                
                <div class="card-body p-4">
                    <form action="{{ route('user.update', $user->id) }}" method="POST" class="needs-validation" novalidate>
                        @csrf
                        @method('PUT')

                        <!-- User Profile Section -->
                        <div class="row mb-4">
                            <div class="col-md-4 text-center mb-3 mb-md-0">
                                <div class="position-relative mx-auto" style="width: 150px; height: 150px;">
                                    <img src="https://ui-avatars.com/api/?name={{ urlencode($user->name) }}&background=random&size=150&rounded=true" 
                                         class="img-thumbnail rounded-circle shadow-sm border-2 border-primary w-100 h-100"
                                         alt="User Avatar">
                                    <div class="position-absolute bottom-0 end-0 bg-white p-1 rounded-circle shadow">
                                        <i class="fas fa-user-cog text-primary"></i>
                                    </div>
                                </div>
                                <h5 class="mt-3 mb-0">{{ $user->name }}</h5>
                                <p class="text-muted small">{{ $user->email }}</p>
                            </div>

                            <div class="col-md-8">
                                <div class="row g-3">
                                    <div class="col-md-6">
                                        <div class="form-floating">
                                            <input type="text" class="form-control bg-light" id="name" 
                                                   value="{{ $user->name }}" readonly>
                                            <label for="name">Full Name</label>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-floating">
                                            <input type="email" class="form-control bg-light" id="email" 
                                                   value="{{ $user->email }}" readonly>
                                            <label for="email">Email Address</label>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="form-floating">
                                            <input type="text" class="form-control bg-light" 
                                                   value="{{ $user->created_at->format('M d, Y') }}" readonly>
                                            <label>Member Since</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Roles Management Section -->
                        <div class="card border-0 shadow-sm mb-4">
                            <div class="card-header bg-light py-3">
                                <h5 class="mb-0">
                                    <i class="fas fa-user-shield me-2"></i>Role Management
                                </h5>
                            </div>
                            <div class="card-body">
                                <div class="row g-3">
                                    @foreach($roles as $role)
                                        @if($role->name !== 'superadmin')
                                        <div class="col-md-6">
                                            <div class="role-card p-3 rounded border hover-shadow 
                                                {{ $user->roles->contains('name', $role->name) ? 'border-primary bg-primary-soft' : 'bg-light' }}">
                                                <div class="form-check form-switch mb-0">
                                                    <input class="form-check-input" type="checkbox" 
                                                           name="roles[]" value="{{ $role->name }}"
                                                           id="role-{{ $role->id }}" role="switch"
                                                           {{ $user->roles->contains('name', $role->name) ? 'checked' : '' }}>
                                                    <label class="form-check-label d-flex align-items-center" 
                                                           for="role-{{ $role->id }}">
                                                        <div class="me-3">
                                                            {{-- <span class="role-icon bg-{{ $role->name === 'admin' ? 'primary' : 'info' }} p-2 rounded-circle">
                                                                <i class="fas {{ $role->name === 'admin' ? 'fa-crown' : 'fa-user-tag' }} text-white"></i>
                                                            </span> --}}
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
                            </div>
                        </div>

                        <!-- Permissions Preview -->
                        <div class="card border-0 shadow-sm mb-4">
                            <div class="card-header bg-light py-3">
                                <h5 class="mb-0">
                                    <i class="fas fa-key me-2"></i>Effective Permissions
                                </h5>
                            </div>
                            <div class="card-body">
                                <div class="alert alert-info">
                                    <i class="fas fa-info-circle me-2"></i>
                                    Permissions are automatically granted based on assigned roles.
                                </div>
                                <div class="permissions-preview">
                                    @php
                                        $permissions = $user->getAllPermissions()->pluck('name')->unique();
                                    @endphp
                                    @if($permissions->count() > 0)
                                        <div class="d-flex flex-wrap gap-2">
                                            @foreach($permissions as $permission)
                                                <span class="badge bg-success bg-opacity-10 text-success border border-success border-opacity-25">
                                                    <i class="fas fa-check-circle me-1"></i>
                                                    {{ $permission }}
                                                </span>
                                            @endforeach
                                        </div>
                                    @else
                                        <div class="text-center py-3 text-muted">
                                            <i class="fas fa-lock-open fa-2x mb-2"></i>
                                            <p>No special permissions assigned</p>
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>

                        <!-- Form Actions -->
                        <div class="d-flex justify-content-between border-top pt-4">
                            <a href="{{ route('user.index') }}" class="btn btn-outline-secondary px-4">
                                <i class="fas fa-arrow-left me-2"></i> Cancel
                            </a>
                            <div>
                                {{-- <button type="reset" class="btn btn-light px-4 me-2">
                                    <i class="fas fa-undo me-2"></i> Reset
                                </button> --}}
                                <button type="submit" class="btn btn-primary px-4">
                                    <i class="fas fa-save me-2"></i> Save Changes
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('styles')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css">
<style>
    .card {
        border-radius: 0.75rem;
        border: none;
        transition: all 0.3s ease;
    }
    
    .card-header {
        border-radius: 0.7rem 0.7rem 0 0 !important;
    }
    
    .bg-gradient-primary {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    }
    
    .bg-primary-soft {
        background-color: rgba(13, 110, 253, 0.1) !important;
    }
    
    .role-card {
        transition: all 0.3s ease;
        cursor: pointer;
    }
    
    .role-card:hover {
        transform: translateY(-2px);
        box-shadow: 0 0.5rem 1rem rgba(0, 0, 0, 0.1) !important;
    }
    
    .role-icon {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        width: 40px;
        height: 40px;
    }
    
    .form-floating>label {
        color: #6c757d;
    }
    
    .form-switch .form-check-input {
        width: 2.5em;
        height: 1.5em;
    }
    
    .hover-shadow:hover {
        box-shadow: 0 0.125rem 0.25rem rgba(0, 0, 0, 0.075);
    }
    
    .border-2 {
        border-width: 2px !important;
    }
</style>
@endsection

@section('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Animate role cards when checked
        document.querySelectorAll('.form-check-input[type="checkbox"]').forEach(checkbox => {
            checkbox.addEventListener('change', function() {
                const card = this.closest('.role-card');
                if (this.checked) {
                    card.classList.add('border-primary', 'bg-primary-soft');
                    card.classList.remove('bg-light');
                } else {
                    card.classList.remove('border-primary', 'bg-primary-soft');
                    card.classList.add('bg-light');
                }
            });
        });
        
        // Click entire card to toggle checkbox
        document.querySelectorAll('.role-card').forEach(card => {
            card.addEventListener('click', function(e) {
                if (!e.target.closest('.form-check-input')) {
                    const checkbox = this.querySelector('.form-check-input');
                    checkbox.checked = !checkbox.checked;
                    checkbox.dispatchEvent(new Event('change'));
                }
            });
        });
    });
</script>
@endsection