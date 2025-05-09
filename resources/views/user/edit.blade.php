@extends('dashboard.layout.layout')

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

@endsection
