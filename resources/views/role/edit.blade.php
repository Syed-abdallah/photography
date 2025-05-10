@extends('dashboard.layout.layout')

@section('content')
<div class="card">
    <div class="card-body">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title">Edit Role: {{ $role->name }}</h3>
            </div>
            <div class="panel-body">
                <form action="{{ route('roles.update', $role->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    
                    <div class="form-group mb-3">
                        <label for="name" class="form-label">Role Name</label>
                        <input type="text" name="role" id="name" class="form-control"
                               value="{{ old('name', $role->name) }}" required>
                        @error('name')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                    
                    <h3 class="mt-4 mb-3"><strong>Permissions</strong></h3>
            
                    @foreach ($groupedPermissions as $category => $permissionGroup)
                    <div class="card mb-3">
                        <div class="card-header bg-light d-flex justify-content-between align-items-center">
                            <h5 class="mb-0">
                                {{ ucfirst($category) }} Permissions
                            </h5>
                            <div>
                                <button type="button" class="btn btn-sm btn-outline-primary select-all" data-category="{{ $category }}">
                                    Select All
                                </button>
                                <button type="button" class="btn btn-sm btn-outline-danger deselect-all" data-category="{{ $category }}">
                                    Deselect All
                                </button>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                @foreach ($permissionGroup as $permission)
                                    <div class="col-xs-6 col-sm-4 col-md-3 mb-2">
                                        <div class="form-check">
                                            <input class="form-check-input permission-checkbox" type="checkbox"
                                                   name="permissions[]"
                                                   value="{{ $permission->id }}"
                                                   id="permission-{{ $permission->id }}"
                                                   data-category="{{ $category }}"
                                                   {{ $role->permissions->contains($permission->id) ? 'checked' : '' }}>
                                            <label class="form-check-label" for="permission-{{ $permission->id }}">
                                                {{ ucfirst($permission->name) }}
                                            </label>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                @endforeach
                <script>
                    $(document).ready(function() {
                        // Select all permissions in a category
                        $('.select-all').click(function() {
                            const category = $(this).data('category');
                            $(`.permission-checkbox[data-category="${category}"]`).prop('checked', true);
                        });
                
                        // Deselect all permissions in a category
                        $('.deselect-all').click(function() {
                            const category = $(this).data('category');
                            $(`.permission-checkbox[data-category="${category}"]`).prop('checked', false);
                        });
                    });
                </script>

                    <div class="d-flex mt-4">
                        <button type="submit" class="btn btn-primary px-4 me-2">Update Role</button>
                        <a href="{{ route('roles.index') }}" class="btn btn-danger">Cancel</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection