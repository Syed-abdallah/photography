@extends('dashboard.layout.layout')

@section('content')
    <div class="card">
        <div class="card-body">
            <div class="d-flex justify-content-between align-items-center mb-3">
                <h4 class="card-title">Statuses</h4>
                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addStatusModal">
                    <i class="mdi mdi-plus"></i> Add Status
                </button>
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
                            <th>Status</th>
                            <th>Color</th>
                            <th>Created At</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($statuses as $status)
                            <tr>
                                <td>{{ $status->name }}</td>
                                <td>
                                    <span class="badge" style="background-color: {{ $status->color }}; color: white">
                                        {{ $status->color }}
                                    </span>
                                </td>
                                <td>{{ $status->created_at->format('d M Y') }}</td>
                                <td>
                                    @can('edit status')
                                        <button type="button" class="btn btn-sm btn-info" data-bs-toggle="modal"
                                            data-bs-target="#editStatusModal{{ $status->id }}">
                                            <i class="icon-pencil"></i>
                                        </button>
                                    @endcan
                                    @can('delete status')
                                        <button type="button" class="btn btn-sm btn-danger" data-bs-toggle="modal"
                                            data-bs-target="#deleteModal{{ $status->id }}">
                                            <i class="fas fa-trash-alt"></i>
                                        </button>
                                    @endcan
                                    <!-- Edit Modal -->
                                    <div class="modal fade" id="editStatusModal{{ $status->id }}" tabindex="-1"
                                        aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title">Edit Status</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                        aria-label="Close"></button>
                                                </div>
                                                <form action="{{ route('status.update', $status->id) }}" method="POST">
                                                    @csrf
                                                    @method('PUT')
                                                    <div class="modal-body">
                                                        <div class="form-group mb-3">
                                                            <label for="name">Status Name</label>
                                                            <input type="text"
                                                                class="form-control @error('name') is-invalid @enderror"
                                                                id="name" name="name"
                                                                value="{{ old('name', $status->name) }}" required>
                                                            @error('name')
                                                                <span class="invalid-feedback" role="alert">
                                                                    <strong>{{ $message }}</strong>
                                                                </span>
                                                            @enderror
                                                        </div>
                                                        <div class="form-group mb-3">
                                                            <label for="color">Color</label>
                                                            <input type="color"
                                                                class="form-control  @error('color') is-invalid @enderror"
                                                                id="color" name="color"
                                                                value="{{ old('color', $status->color) }}" required>
                                                            @error('color')
                                                                <span class="invalid-feedback" role="alert">
                                                                    <strong>{{ $message }}</strong>
                                                                </span>
                                                            @enderror
                                                        </div>
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
                                    <div class="modal fade" id="deleteModal{{ $status->id }}" tabindex="-1"
                                        aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title">Confirm Delete</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                        aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    Are you sure you want to delete this status:
                                                    <strong>{{ $status->name }}</strong>?
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary"
                                                        data-bs-dismiss="modal">Cancel</button>
                                                    <form action="{{ route('status.destroy', $status->id) }}"
                                                        method="POST">
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

    <!-- Add Status Modal -->
    <!-- Add Status Modal -->
    <div class="modal fade" id="addStatusModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Add New Status</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="{{ route('status.store') }}" method="POST">
                    @csrf
                    <div class="modal-body">
                        <div class="form-group mb-3">
                            <label for="name">Status Name</label>
                            <input type="text" class="form-control @error('name') is-invalid @enderror" id="name"
                                name="name" value="{{ old('name') }}" required>
                            @error('name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="form-group mb-3">
                            <label for="color">Color</label>
                            <div class="input-group">
                                {{-- <input type="color"
                                    class="form-control form-control-color @error('color') is-invalid @enderror"
                                    id="color_picker" value="{{ old('color', '#000000') }}" title="Choose color"
                                    oninput="document.getElementById('color').value = this.value">
                                <input type="text" class="form-control" id="color" name="color"
                                    value="{{ old('color', '#000000') }}" required "> --}}

                                {{-- <input type="color"
                                    class="form-control form-control-color @error('color') is-invalid @enderror"
                                    id="color" name="color" value="{{ old('color', $status->color) }}" required> --}}
                                    <input 
    type="color"
    class="form-control form-control-color @error('color') is-invalid @enderror"
    id="color" 
    name="color" 
    value="{{ old('color', '#000000') }}" 
    required
>
                            </div>
                            @error('color')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary">Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
