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
                                        @foreach ($groupedPermissions as $category => $permissionGroup)
                                        <h4 class="mt-4"><strong>{{ ucfirst($category) }}</strong></h4>
                                        <div class="row">
                                            @foreach ($permissionGroup as $permission)
                                                <div class="col-xs-6 col-sm-4 col-md-3">
                                                    <div class="checkbox">
                                                        <label>
                                                            <input type="checkbox"
                                                                   name="permissions[]"
                                                                   value="{{ $permission->name }}"
                                                                   id="permission-{{ $permission->id }}">
                                                            {{ ucfirst($permission->name) }}
                                                        </label>
                                                    </div>
                                                </div>
                                            @endforeach
                                        </div>
                                    @endforeach
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