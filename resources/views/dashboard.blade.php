@extends('dashboard.layout.layout')

@section('content')
    <style>
        .fc-event {
            cursor: pointer;
            font-size: 0.85em;
            padding: 2px 4px;
        }

        .fc-event .fc-time {
            font-weight: bold;
        }

        .fc-event .status-badge {
            font-size: 0.7em;
            padding: 1px 3px;
            margin-left: 3px;
            border-radius: 2px;
            background-color: rgba(255, 255, 255, 0.3);
        }

        .booking-detail {
            margin-bottom: 10px;
        }

        .booking-detail label {
            font-weight: bold;
            margin-bottom: 0;
            min-width: 150px;
            display: inline-block;
        }

        .booking-detail span {
            padding: 5px;
            background: #f8f9fa;
            border-radius: 3px;
            display: inline-block;
            min-width: 200px;
        }

        .modal-body {
            max-height: 70vh;
            overflow-y: auto;
        }

        .search-container {
            background: #f8f9fa;
            padding: 15px;
            border-radius: 5px;
            margin-bottom: 20px;
        }

        .search-result-item {
            cursor: pointer;
            padding: 8px;
            border-bottom: 1px solid #eee;
        }

        .search-result-item:hover {
            background-color: #f0f0f0;
        }

        #searchResults {
            max-height: 300px;
            overflow-y: auto;
            border: 1px solid #ddd;
            border-radius: 4px;
            margin-top: 10px;
            display: none;
        }

        .view-switcher {
            margin-bottom: 15px;
        }

        .view-switcher .btn {
            margin-right: 5px;
        }

        .fc-day-header {
            background-color: #f8f9fa;
        }

        /* Responsive adjustments */
        @media (max-width: 768px) {
            .fc-toolbar {
                flex-direction: column;
            }

            .fc-toolbar .fc-left,
            .fc-toolbar .fc-center,
            .fc-toolbar .fc-right {
                margin-bottom: 10px;
            }
        }
    </style>
</head>

<body>

    <div class="container">
        <h1>Booking Calendar</h1>

        <!-- Search Container -->
        <div class="search-container">
            <div class="row">
                <div class="col-md-12">
                    <div class="form-group">
                        <label for="searchInput">Search Bookings</label>
                        <input type="text" class="form-control" id="searchInput"
                            placeholder="Search by name, post code, email, booking number or phone number">
                        <div id="searchResults"></div>
                    </div>
                </div>
            </div>
        </div>

        <!-- View Switcher -->
        <div class="view-switcher btn-group">
            <button class="btn btn-primary active" id="monthViewBtn">Month</button>
            <button class="btn btn-secondary" id="weekViewBtn">Week</button>
            <button class="btn btn-secondary" id="dayViewBtn">Day</button>
            <button class="btn btn-secondary" id="agendaDayViewBtn">Day (Agenda)</button>
            <button class="btn btn-secondary" id="agendaWeekViewBtn">Week (Agenda)</button>
        </div>

        <div id='calendar'></div>
    </div>

    <!-- Delete Confirmation Modal -->
    <div class="modal fade" id="deleteConfirmationModal" tabindex="-1" role="dialog"
        aria-labelledby="deleteConfirmationModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header bg-danger text-white">
                    <h5 class="modal-title" id="deleteConfirmationModalLabel">Confirm Cancel</h5>
                </div>
                <div class="modal-body">
                    <p>Are you sure you want to cancel this booking?</p>
                    <p class="font-weight-bold" id="bookingToDeleteInfo"></p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" id="confirmDeleteBtn">Cancel Booking</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Booking Details Modal -->
    <div class="modal fade" id="bookingModal" tabindex="-1" role="dialog" aria-labelledby="bookingModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="bookingModalLabel">Booking Details</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body" id="bookingDetails">
                    <!-- Booking details will be loaded here -->
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" id="deleteBookingBtn">Cancel</button>
                    <form id="deleteForm" method="POST" style="display: none;">
                        @csrf
                        @method('DELETE')
                    </form>
                    <a href="#" class="btn btn-primary" id="editBookingBtn">Edit</a>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

 
@endsection