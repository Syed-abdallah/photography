@extends('dashboard.layout.layout')

@section('content')
    <div class="card">
        <div class="card-body">
            <div class="d-flex justify-content-between align-items-center mb-3">
                <h4 class="card-title">Roles</h4>
               <a href="/photography/roles/create" class="btn btn-success"> <i class="icon-plus"></i> Add Role</a>
                   
              
            </div>

            @if (session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif

            <div class="table-responsive">
                <table id="zero_config" class="table border table-striped table-bordered text-nowrap">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Permissions</th>
                            <th>Created At</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($roles as $role)
                            <tr>
                                <td>{{ $role->name }}</td>
                                <td>
                                    @if ($role->permissions->count() > 0)
                                    {{-- <div class="d-flex flex-wrap" style="max-width: 100%;">
                                        @foreach ($role->permissions as $permission)
                                            <span class="badge bg-primary me-1 mb-1" style="flex: 0 0 calc(100% / 15 - 138px); text-align: center;">
                                                {{ $permission->name }}
                                            </span>
                                        @endforeach
                                    </div> --}}
                                    <div class="d-flex flex-wrap gap-2 mb-3">
                                        @foreach ($role->permissions as $permission)
                                            <span class="badge bg-primary-soft text-primary rounded-pill d-flex align-items-center py-2 px-3">
                                                <i class="fas fa-shield-alt me-2 small"></i>
                                                <span class="text-truncate" style="max-width: 150px;" title="{{ $permission->name }}">
                                                    {{ Str::title(str_replace('-', ' ', $permission->name)) }}
                                                </span>
                                            </span>
                                        @endforeach
                                    </div>
                                    @else
                                        <span class="text-muted">No permissions assigned</span>
                                    @endif
                                </td>
                                <td>{{ $role->created_at->format('d M Y') }}</td>
                                <td>
                                    <a href="{{ route('roles.edit', $role->id) }}" class="btn btn-sm btn-primary me-2">
                                        <i class="fas fa-edit"></i> Edit
                                    </a>
                                    <button type="button" class="btn btn-sm btn-danger" data-bs-toggle="modal"
                                        data-bs-target="#deleteModal{{ $role->id }}">
                                        <i class="fas fa-trash-alt"> Delete</i>
                                    </button>

                                    <!-- Edit Modal -->
                                    <div class="modal fade" id="editRoleModal{{ $role->id }}" tabindex="-1"
                                        aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title">Edit Role</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                        aria-label="Close"></button>
                                                </div>
                                                <form action="{{ route('roles.update', $role->id) }}" method="POST">
                                                    @csrf
                                                    @method('PUT')
                                                    <div class="modal-body">
                                                        <div class="form-group mb-3">
                                                            <label for="name">Name</label>
                                                            <input type="text"
                                                                class="form-control @error('name') is-invalid @enderror"
                                                                id="name" name="name"
                                                                value="{{ old('name', $role->name) }}" required>
                                                            @error('name')
                                                                <span class="invalid-feedback" role="alert">
                                                                    <strong>{{ $message }}</strong>
                                                                </span>
                                                            @enderror
                                                        </div>
                                                        {{-- <div class="form-group mb-3">
                                                            <label>Permissions</label>
                                                            <div class="row">
                                                                @foreach ($permissions as $permission)
                                                                    <div class="col-md-6">
                                                                        <div class="form-check">
                                                                            <input class="form-check-input" type="checkbox"
                                                                                name="permissions[]"
                                                                                value="{{ $permission->id }}"
                                                                                id="permission_{{ $permission->id }}_{{ $role->id }}"
                                                                                {{ $role->permissions->contains($permission->id) ? 'checked' : '' }}>
                                                                            <label class="form-check-label"
                                                                                for="permission_{{ $permission->id }}_{{ $role->id }}">
                                                                                {{ $permission->name }}
                                                                            </label>
                                                                        </div>
                                                                    </div>
                                                                @endforeach
                                                            </div>
                                                        </div> --}}
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary"
                                                            data-bs-dismiss="modal">Cancel</button>
                                                        <button type="submit" class="btn btn-primary">Update</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Delete Modal -->
                                    <div class="modal fade" id="deleteModal{{ $role->id }}" tabindex="-1"
                                        aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title">Confirm Delete</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                        aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    Are you sure you want to delete this role:
                                                    <strong>{{ $role->name }}</strong>?
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary"
                                                        data-bs-dismiss="modal">Cancel</button>
                                                    <form action="{{ route('roles.destroy', $role->id) }}" method="POST">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-danger">Delete</button>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>


@endsection
