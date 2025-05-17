{{-- @extends('dashboard.layout.layout')

@section('content')

@endsection
 --}}








@extends('dashboard.layout.layout')

@section('content')

    <div class="card">
        <div class="card-body">
            <div class="d-flex justify-content-between align-items-center mb-3">
                <h4 class="card-title">Booking Calendar</h4>
                @can('create booking')
                    <a href="{{ route('bookings.create') }}" class="btn btn-primary">
                        <i class="mdi mdi-plus"></i> Add Booking
                    </a>
                @endcan
            </div>
            <div id="calendar"></div>
        </div>
    </div>




    <div class="card">
        <div class="card-body">
            <div class="d-flex justify-content-between align-items-center mb-3">
                <h4 class="card-title">Sales Overview</h4>
                <div class="d-flex">
                    <form method="GET" action="{{ route('dashboard') }}" class="form-inline">
                        <div class="form-group mr-4">
                            <label for="start_date" class="sr-only">From</label>
                            <input type="date" class="form-control" id="start_date" name="start_date"
                                value="{{ request('start_date', \Carbon\Carbon::parse($startDate)->format('Y-m-d')) }}">
                        </div>
                        <div class="form-group mr-4">
                            <label for="end_date" class="sr-only">To</label>
                            <input type="date" class="form-control" id="end_date" name="end_date"
                                value="{{ request('end_date', \Carbon\Carbon::parse($endDate)->format('Y-m-d')) }}">
                        </div>
                        <button type="submit" class="btn btn-primary mt-3">
                            <i class="mdi mdi-filter"></i> Filter
                        </button>
                        @if (request()->has('start_date'))
                            <a href="{{ route('dashboard') }}" class="btn btn-secondary mt-3">
                                <i class="mdi mdi-close"></i> Clear
                            </a>
                        @endif
                    </form>
                </div>
            </div>

            <!-- Summary Cards -->
            <div class="row mb-4">
                <div class="col-md-4">
                    <div class="card bg-light-info">
                        <div class="card-body">
                            <h6 class="card-title text-muted">Total Bookings</h6>
                            <h3 class="mb-0">{{ count($bookings) }}</h3>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card bg-light-primary">
                        <div class="card-body">
                            <h6 class="card-title text-muted">Total Deposit</h6>
                            <h3 class="mb-0">${{ number_format($totalDeposit, 2) }}</h3>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card bg-light-success">
                        <div class="card-body">
                            <h6 class="card-title text-muted">Total Sales</h6>
                            <h3 class="mb-0">${{ number_format($totalSales, 2) }}</h3>
                        </div>
                    </div>
                </div>
            </div>

            @if (count($bookings) > 0)
                <div class="row">
                    @foreach ($bookings as $booking)
                        <div class="col-md-4 mb-4">
                            <div
                                class="card border-{{ $booking->status == 'completed' ? 'success' : ($booking->status == 'confirmed' ? 'primary' : 'warning') }}">
                                <div
                                    class="card-header bg-{{ $booking->status == 'completed' ? 'success' : ($booking->status == 'confirmed' ? 'primary' : 'warning') }} text-white">
                                    <h5 class="mb-0">{{ $booking->name }}</h5>
                                </div>


                                <div class="card-body">
                                    <div class="d-flex justify-content-between mb-2">
                                        <span class="text-muted">Status:</span>
                                        @if ($booking->status == 'completed')
                                            <span class="badge bg-success">{{ $booking->status }}</span>
                                        @elseif($booking->status == 'confirmed')
                                            <span class="badge bg-primary">{{ $booking->status }}</span>
                                        @else
                                            <span class="badge bg-warning">{{ $booking->status }}</span>
                                        @endif
                                    </div>
                                    <div class="d-flex justify-content-between mb-2">
                                        <span class="text-muted">Dates:</span>
                                        <span>
                                            {{ \Carbon\Carbon::parse($booking->start)->format('M d') }} -
                                            {{ \Carbon\Carbon::parse($booking->end)->format('M d, Y') }}
                                        </span>
                                    </div>
                                    <div class="d-flex justify-content-between mb-2">
                                        <span class="text-muted">Guests:</span>
                                        <span>{{ $booking->no_of_guest }}</span>
                                    </div>
                                    <div class="d-flex justify-content-between mb-2">
                                        <span class="text-muted">Deposit:</span>
                                        <span>${{ number_format($booking->deposit_amount, 2) }}</span>
                                    </div>
                                    <div class="d-flex justify-content-between">
                                        <span class="text-muted">Total:</span>
                                        <span
                                            class="font-weight-bold">${{ number_format($booking->sales_amount, 2) }}</span>
                                    </div>
                                    <hr>
                                    <div class="d-flex justify-content-between  mt-2">
                                        <span class="text-muted">Remaining:</span>
                                        <span class="text-danger font-weight-bold">
                                            ${{ number_format($booking->sales_amount - $booking->deposit_amount, 2) }}
                                        </span>
                                    </div>
                                </div>
                                <div class="card-footer bg-light">
                                    <small class="text-muted">Agent: {{ $booking->booking_agent }}</small>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @else
                <div class="alert alert-warning">
                    No bookings found for the selected date range.
                </div>
            @endif
        </div>
    </div>

@endsection
