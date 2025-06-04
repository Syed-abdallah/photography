{{-- @extends('dashboard.layout.layout')

@section('title', 'Manage Users')
@section('content')

<div class="card">
    <div class="card-body">
   

        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <div class="table-responsive">
            <table id="zero_config" class="table border table-striped table-bordered text-nowrap">
                <thead>
                    <tr>
                        <th>User Name</th>
                        <th>Email</th>
                        <th>Role</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($users as $user)
                         @if($role->name !== 'Super Admin')
                            <tr>
                                <td>{{ $user->name }}</td>
                                <td>{{ $user->email }}</td>
                                <td>
                                    @foreach ($user->roles as $role)
                                        <span class="badge bg-primary me-1 mb-1">{{ $role->name }}</span>
                                    @endforeach
                                </td>
                                <td>
                                    <div class="d-flex">
                                        @can('edit user')
                                            <a href="{{ route('user.edit', $user->id) }}" 
                                               class="btn btn-sm btn-primary me-2">
                                                <i class="fas fa-edit"></i> Edit
                                            </a>
                                        @endcan
                                        
                                        @can('delete user')
                                            <button type="button" class="btn btn-sm btn-danger" 
                                                    data-bs-toggle="modal" 
                                                    data-bs-target="#deleteModal{{ $user->id }}">
                                                <i class="fas fa-trash-alt"></i>
                                            </button>
                                            
                                            <!-- Delete Modal -->
                                            <div class="modal fade" id="deleteModal{{ $user->id }}" tabindex="-1" 
                                                 aria-hidden="true">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title">Confirm Delete</h5>
                                                            <button type="button" class="btn-close" 
                                                                    data-bs-dismiss="modal" aria-label="Close"></button>
                                                        </div>
                                                        <div class="modal-body">
                                                            Are you sure you want to delete user: 
                                                            <strong>{{ $user->name }}</strong>?
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary" 
                                                                    data-bs-dismiss="modal">Cancel</button>
                                                            <form action="{{ route('user.delete', $user->id) }}" 
                                                                  method="POST">
                                                                @csrf
                                                                @method('DELETE')
                                                                <button type="submit" class="btn btn-danger">
                                                                    Delete
                                                                </button>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        @endcan
                                    </div>
                                </td>
                            </tr>
                        @endif
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

@endsection --}}



@extends('dashboard.layout.layout')

@section('title', 'Manage Users')
@section('content')

<div class="card">
    <div class="card-body">

        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <div class="table-responsive">
            <table id="zero_config" class="table border table-striped table-bordered text-nowrap">
                <thead>
                    <tr>
                        <th>User Name</th>
                        <th>Email</th>
                        <th>Role</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($users as $user)
                        {{-- Skip this entire row if the user has any “Super Admin” role --}}
                        @if(! $user->roles->contains('name', 'Super Admin'))
                            <tr>
                                <td>{{ $user->name }}</td>
                                <td>{{ $user->email }}</td>
                                <td>
                                    @foreach ($user->roles as $role)
                                        <span class="badge bg-primary me-1 mb-1">{{ $role->name }}</span>
                                    @endforeach
                                </td>
                                <td>
                                    <div class="d-flex">
                                        @can('edit user')
                                            <a href="{{ route('user.edit', $user->id) }}" 
                                               class="btn btn-sm btn-primary me-2">
                                                <i class="fas fa-edit"></i> Edit
                                            </a>
                                        @endcan

                                        @can('delete user')
                                            <button type="button" class="btn btn-sm btn-danger" 
                                                    data-bs-toggle="modal" 
                                                    data-bs-target="#deleteModal{{ $user->id }}">
                                                <i class="fas fa-trash-alt"></i>
                                            </button>

                                            <!-- Delete Modal -->
                                            <div class="modal fade" id="deleteModal{{ $user->id }}" tabindex="-1" 
                                                 aria-hidden="true">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title">Confirm Delete</h5>
                                                            <button type="button" class="btn-close" 
                                                                    data-bs-dismiss="modal" aria-label="Close"></button>
                                                        </div>
                                                        <div class="modal-body">
                                                            Are you sure you want to delete user: 
                                                            <strong>{{ $user->name }}</strong>?
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary" 
                                                                    data-bs-dismiss="modal">Cancel</button>
                                                            <form action="{{ route('user.delete', $user->id) }}" 
                                                                  method="POST">
                                                                @csrf
                                                                @method('DELETE')
                                                                <button type="submit" class="btn btn-danger">
                                                                    Delete
                                                                </button>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        @endcan
                                    </div>
                                </td>
                            </tr>
                        @endif
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

@endsection
