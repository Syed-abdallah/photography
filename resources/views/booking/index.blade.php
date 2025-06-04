@extends('dashboard.layout.layout')

@section('content')
<div class="card">
    <div class="card-body">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h4 class="card-title">Bookings</h4>
            <a href="{{ route('bookings.create') }}" class="btn btn-primary">
                <i class="mdi mdi-plus"></i> Add Booking
            </a>
        </div>

        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <div class="table-responsive">
            <table id="zero_config" class="table border table-striped table-bordered text-nowrap">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Contact</th>
                        <th>Service</th>
                        <th>Guests</th>
                        <th>Status</th>
                        <th>Booking create date</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($bookings as $booking)
                    <tr>
                        <td>{{ $booking->name }}</td>
                        <td>{{ $booking->contact_number }}</td>
                        <td>{{ $booking->service->name }}</td>
                        <td>{{ $booking->no_of_guest }}</td>
                        <td>
                            <select class="form-select status-dropdown" data-booking-id="{{ $booking->id }}" style="width: auto; display: inline-block;">
                                @foreach($statuses as $status)
                                    <option value="{{ $status->id }}" {{ $booking->status == $status->id ? 'selected' : '' }}>
                                        {{ $status->name }}
                                    </option>
                                @endforeach
                            </select>
                            <span class="badge status-badge" style="display: none; background-color: {{ $booking->statusRelation->color ?? '#6c757d' }}">
                                {{ $booking->statusRelation->name ?? ucfirst($booking->status) }}
                            </span>
                        </td>
                        <td>
                            {{ $booking->created_at->format('Y-m-d') }}
                        </td>
                        <td>
                            @can('edit booking')
                            <a href="{{ route('bookings.edit', $booking->id) }}" class="btn btn-sm btn-info">
                                <i class="fas fa-edit"></i>
                            </a>
                            @endcan
                            @can('delete booking')
                            <form action="{{ route('bookings.destroy', $booking->id) }}" method="POST" style="display: inline-block;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure?')">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </form>
                            @endcan
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

@endsection