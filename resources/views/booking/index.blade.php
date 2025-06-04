{{-- 
@extends('dashboard.layout.layout')

@section('content')
<div class="card">
    <div class="card-body">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h4 class="card-title">Bookings</h4>

            <button id="exportPdf" class="btn btn-danger mr-2">
            <i class="fas fa-file-pdf"></i> Export PDF
        </button>
            <a href="{{ route('bookings.create') }}" class="btn btn-primary">
                <i class="mdi mdi-plus"></i> Add Booking
            </a>
        </div>

        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <!-- Filter Form -->
        <div class="card mb-4">
            <div class="card-body">
                <form method="GET" action="{{ route('bookings.index') }}">
                    <div class="row">
                        <div class="col-md-3">
                            <label>Status</label>
                            <select name="status" class="form-control">
                                <option value="">All Statuses</option>
                                @foreach ($statuses as $status)
                                    <option value="{{ $status->id }}" {{ request('status') == $status->id ? 'selected' : '' }}>
                                        {{ $status->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-3">
                            <label>Start Date</label>
                            <input type="date" name="start_date" class="form-control" value="{{ request('start_date') }}">
                        </div>
                        <div class="col-md-3">
                            <label>End Date</label>
                            <input type="date" name="end_date" class="form-control" value="{{ request('end_date') }}">
                        </div>
                        <div class="col-md-3 d-flex align-items-end">
                            <button type="submit" class="btn btn-primary mr-2">Filter</button> &nbsp;
                            <a href="{{ route('bookings.index') }}" class="btn btn-secondary">Reset</a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <!-- End Filter Form -->

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
                    @foreach ($bookings as $booking)
                    <tr>
                        <td>{{ $booking->name }}</td>
                        <td>{{ $booking->contact_number }}</td>
                        <td>{{ $booking->service->name }}</td>
                        <td>{{ $booking->no_of_guest }}</td>
                        <td>
                            <select class="form-select status-dropdown" data-booking-id="{{ $booking->id }}" style="width: auto; display: inline-block;">
                                @foreach ($statuses as $status)
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

@endsection --}}














@extends('dashboard.layout.layout')

@section('content')
    <div class="card">
        <div class="card-body">
            <div class="d-flex justify-content-between align-items-center mb-3">
    <h4 class="card-title">Bookings</h4>

    <div class="d-flex">
        <a href="{{ route('bookings.create') }}" class="btn btn-primary mr-2">
            <i class="mdi mdi-plus"></i> Add Booking
        </a>
        &nbsp;
        <button id="exportExcel" class="btn btn-success">
            <i class="fas fa-file-excel"></i> Export Excel
        </button>
    </div>
</div>


            @if (session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif

            <!-- Filter Form -->
            <div class="card mb-4">
                <div class="card-body">
                    <form method="GET" action="{{ route('bookings.index') }}">
                        <div class="row">
                            <div class="col-md-3">
                                <label>Status</label>
                                <select name="status" class="form-control">
                                    <option value="">All Statuses</option>
                                    @foreach ($statuses as $status)
                                        <option value="{{ $status->id }}"
                                            {{ request('status') == $status->id ? 'selected' : '' }}>
                                            {{ $status->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-3">
                                <label>Start Date</label>
                                <input type="date" name="start_date" class="form-control"
                                    value="{{ request('start_date') }}">
                            </div>
                            <div class="col-md-3">
                                <label>End Date</label>
                                <input type="date" name="end_date" class="form-control"
                                    value="{{ request('end_date') }}">
                            </div>
                            <div class="col-md-3 d-flex align-items-end">
                                <button type="submit" class="btn btn-primary mr-2">Filter</button>
                                  &nbsp;
                                <a href="{{ route('bookings.index') }}" class="btn btn-secondary">Reset</a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <!-- End Filter Form -->

            <div class="table-responsive">
                <table id="zero_config" class="table border table-striped table-bordered text-nowrap">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Contact</th>
                            <th>Service</th>
                            <th>Guests</th>
                            <th>Status</th>
                            <th>Booking Date</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($bookings as $booking)
                            <tr>
                                <td>{{ $booking->name }}</td>
                                <td>{{ $booking->contact_number }}</td>
                                <td>{{ $booking->service->name }}</td>
                                <td>{{ $booking->no_of_guest }}</td>
                                <td>
                                    <select class="form-select status-dropdown" data-booking-id="{{ $booking->id }}"
                                        style="width: auto; display: inline-block;">
                                        @foreach ($statuses as $status)
                                            <option value="{{ $status->id }}"
                                                {{ $booking->status == $status->id ? 'selected' : '' }}>
                                                {{ $status->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                    <span class="badge status-badge"
                                        style="display: none; background-color: {{ $booking->statusRelation->color ?? '#6c757d' }};">
                                        {{ $booking->statusRelation->name ?? ucfirst($booking->status) }}
                                    </span>
                                </td>
                                <td>{{ $booking->booking_date->format('Y-m-d') }}</td>
                                <td>
                                    @can('edit booking')
                                        <a href="{{ route('bookings.edit', $booking->id) }}" class="btn btn-sm btn-info">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                    @endcan
                                    @can('delete booking')
                                        <form action="{{ route('bookings.destroy', $booking->id) }}" method="POST"
                                            style="display: inline-block;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-danger"
                                                onclick="return confirm('Are you sure?')">
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

    {{-- 1) Pass the filtered & eager‐loaded bookings to JavaScript --}}
    <script>
        window.bookingsData = @json($bookings);
        window.statusesMap  = @json($statuses->pluck('name', 'id'));
        console.log("Debug → first booking:", window.bookingsData[0]);
    </script>

    {{-- 2) Include SheetJS (xlsx) --}}
    <script src="https://cdn.jsdelivr.net/npm/xlsx@0.18.5/dist/xlsx.full.min.js"></script>

    {{-- 3) Excel‐export script --}}
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            document.getElementById('exportExcel').addEventListener('click', function() {
                // 3.1) Define column headers
                const headers = [
                    'ID',
                    'Booking Number',
                    'Name',
                    'Title',
                    'Address',
                    'Post Code',
                    'Contact Number',
                    'Email',
                    'Service',
                    'No. of Guests',
                    'Promotion',
                    'Sales Agent',
                    'Booking Agent',
                    'Deposit Amount',
                    'Pay On Day',
                    'Status',
                    'Notes',
                    'Payment Method',
                    'Booking Date',
                    'Start Time',
                    'End Time'
                ];

                // 3.2) Build each row, using snake_case relations
                const dataRows = window.bookingsData.map(booking => [
                    booking.id,
                    booking.booking_number,
                    booking.name,
                    booking.title,
                    booking.address,
                    booking.post_code,
                    booking.contact_number,
                    booking.email,

                    // service.name
                    booking.service ? booking.service.name : '',

                    booking.no_of_guest,

                    // promotion.name
                    booking.promotion ? booking.promotion.name : '',

                    // sales_agent.name (snake_case)
                    booking.sales_agent ? booking.sales_agent.name : '',

                    // booking_agent.name (snake_case)
                    booking.booking_agent ? booking.booking_agent.name : '',

                    booking.deposit_amount,
                    booking.pay_on_day,

                    window.statusesMap[booking.status] || '',
                    booking.text,

                    // payment_method.name (snake_case)
                    booking.payment_method ? booking.payment_method.name : '',

                    booking.booking_date,
                    booking.start_time,
                    booking.end_time
                ]);

                // 3.3) Prepend headers
                const worksheetData = [headers, ...dataRows];

                // 3.4) Create workbook & worksheet
                const wb = XLSX.utils.book_new();
                const ws = XLSX.utils.aoa_to_sheet(worksheetData);

                // Freeze top row
                ws['!freeze'] = { xSplit: 0, ySplit: 1 };

                // Auto‐size columns
                const maxColWidths = headers.map((h, colIndex) => {
                    const colData = worksheetData.map(row => (row[colIndex] || '').toString());
                    const maxLength = Math.max(...colData.map(str => str.length));
                    return { wch: Math.max(h.length, maxLength) + 3 };
                });
                ws['!cols'] = maxColWidths;

                // 3.5) Append sheet & trigger download
                XLSX.utils.book_append_sheet(wb, ws, 'Bookings_Report');
                const today = new Date().toISOString().slice(0, 10);
                XLSX.writeFile(wb, `Bookings_Report_${today}.xlsx`);
            });
        });
    </script>
@endsection
