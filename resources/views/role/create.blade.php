@extends('dashboard.layout.layout')

@section('content')
<div class="card">
    <div class="card-body">
 

            <!-- Page-Title -->
            {{-- <div class="row">
                <div class="col-sm-12">
                    <h4 class="pull-left page-title">Create Permission</h4>
                    <ol class="breadcrumb pull-right">
                        <li><a href="{{ route('permissions.index') }}">Permissions</a></li>
                        <li class="active">Create</li>
                    </ol>
                </div>
            </div> --}}

         
                <div class="col-12 mt-4">
                    
                
                        <div class="card-body collapse show">
                         

                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <h3 class="panel-title">New Permission Details</h3>
                                </div>
                                <div class="panel-body">
                                    <form action="{{ route('roles.store') }}" method="POST">
                                        @csrf
                                        <div class="form-group">
                                            <label for="name" class="form-label">Role</label>
                                            <input type="text" name="role" id="name" class="form-control"
                                                   value="{{ old('role') }}" placeholder="e.g. create-role">
                                            @error('name')
                                                <small class="text-danger">{{ $message }}</small>
                                            @enderror
                                        </div>

                                        <h3 class="mt-5 mb-3"><strong>Permissions</strong></h3>

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
                                                                       data-category="{{ $category }}">
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
                                    <button type="submit" class="btn btn-primary mt-3 px-4 me-3">Submit</button>
                                    <a href="{{ route('permissions.index') }}" class="btn btn-danger mt-3" >Cancel</a>
                                    </form>
                                </div>
                            </div>





                        </div>
                    </div>
               
            </div>




        
   



</div>
@endsection