<!DOCTYPE html>
<html>

<head>
    <title>Booking Calendar</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.9.0/fullcalendar.css" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.24.0/moment.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.9.0/fullcalendar.js"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" />

    <style>
        .fc-event {
            cursor: pointer;
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

        .fc-day-grid-event .fc-time {
            font-weight: bold;
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
                    <h5 class="modal-title" id="deleteConfirmationModalLabel">Confirm Delete</h5>
                    {{-- <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button> --}}
                </div>
                <div class="modal-body">
                    <p>Are you sure you want to delete this booking? This action cannot be undone.</p>
                    <p class="font-weight-bold" id="bookingToDeleteInfo"></p>
                </div>
                <div class="modal-footer">
                    {{-- <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button> --}}
                    <button type="button" class="btn btn-danger" id="confirmDeleteBtn">Delete Booking</button>
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
                    <button type="button" class="btn btn-danger " id="deleteBookingBtn">Delete</button>
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

    <script>
        $(document).ready(function() {
            var SITEURL = "{{ url('/') }}";
            var bookingModal = new bootstrap.Modal(document.getElementById('bookingModal'));
            var deleteConfirmationModal = new bootstrap.Modal(document.getElementById('deleteConfirmationModal'));
            var deleteForm = $('#deleteForm');
            var searchInput = $('#searchInput');
            var searchResults = $('#searchResults');
            var searchTimer;

            // View switcher buttons
            var monthViewBtn = $('#monthViewBtn');
            var weekViewBtn = $('#weekViewBtn');
            var dayViewBtn = $('#dayViewBtn');
            var agendaDayViewBtn = $('#agendaDayViewBtn');
            var agendaWeekViewBtn = $('#agendaWeekViewBtn');

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            var calendar = $('#calendar').fullCalendar({
                header: {
                    left: 'prev,next today',
                    center: 'title',
                    right: 'month,agendaWeek,agendaDay'
                },
                defaultView: 'month',
                events: SITEURL + "/calender",
                displayEventTime: true,
                timeFormat: 'h:mm a',
                eventRender: function(event, element, view) {
                    if (event.allDay === 'true') {
                        event.allDay = true;
                    } else {
                        event.allDay = false;
                    }

                    // Add more details to the event in month view
                    if (view.type === 'month') {
                        element.find('.fc-title').prepend('<span class="fc-time">' + moment(event.end)
                            .format('h:mm a') + ' - </span>');
                    }
                },
                selectable: true,
                selectHelper: true,
                eventClick: function(event) {
                    showBookingDetails(event.id);
                },
                viewRender: function(view, element) {
                    // Update active button based on current view
                    updateActiveViewButton(view.name);
                },
                eventAfterAllRender: function(view) {
                    // Color events differently based on status if needed
                    $('.fc-event').each(function() {
                        var event = $(this).data('event');
                        if (event && event.status) {
                            $(this).css('background-color', getStatusColor(event.status));
                        }
                    });
                }
            });

            // Function to update active view button
            function updateActiveViewButton(viewName) {
                // Remove active class from all buttons
                $('.view-switcher .btn').removeClass('active').addClass('btn-secondary');

                // Add active class to the correct button
                switch (viewName) {
                    case 'month':
                        monthViewBtn.removeClass('btn-secondary').addClass('btn-primary active');
                        break;
                    case 'basicWeek':
                        weekViewBtn.removeClass('btn-secondary').addClass('btn-primary active');
                        break;
                    case 'basicDay':
                        dayViewBtn.removeClass('btn-secondary').addClass('btn-primary active');
                        break;
                    case 'agendaDay':
                        agendaDayViewBtn.removeClass('btn-secondary').addClass('btn-primary active');
                        break;
                    case 'agendaWeek':
                        agendaWeekViewBtn.removeClass('btn-secondary').addClass('btn-primary active');
                        break;
                }
            }

            // View switcher button handlers
            monthViewBtn.click(function() {
                $('#calendar').fullCalendar('changeView', 'month');
                $(this).removeClass('btn-secondary').addClass('btn-primary active');
                weekViewBtn.removeClass('btn-primary active').addClass('btn-secondary');
                dayViewBtn.removeClass('btn-primary active').addClass('btn-secondary');
                agendaDayViewBtn.removeClass('btn-primary active').addClass('btn-secondary');
                agendaWeekViewBtn.removeClass('btn-primary active').addClass('btn-secondary');
            });

            weekViewBtn.click(function() {
                $('#calendar').fullCalendar('changeView', 'basicWeek');
                $(this).removeClass('btn-secondary').addClass('btn-primary active');
                monthViewBtn.removeClass('btn-primary active').addClass('btn-secondary');
                dayViewBtn.removeClass('btn-primary active').addClass('btn-secondary');
                agendaDayViewBtn.removeClass('btn-primary active').addClass('btn-secondary');
                agendaWeekViewBtn.removeClass('btn-primary active').addClass('btn-secondary');
            });

            dayViewBtn.click(function() {
                $('#calendar').fullCalendar('changeView', 'basicDay');
                $(this).removeClass('btn-secondary').addClass('btn-primary active');
                monthViewBtn.removeClass('btn-primary active').addClass('btn-secondary');
                weekViewBtn.removeClass('btn-primary active').addClass('btn-secondary');
                agendaDayViewBtn.removeClass('btn-primary active').addClass('btn-secondary');
                agendaWeekViewBtn.removeClass('btn-primary active').addClass('btn-secondary');
            });

            agendaDayViewBtn.click(function() {
                $('#calendar').fullCalendar('changeView', 'agendaDay');
                $(this).removeClass('btn-secondary').addClass('btn-primary active');
                monthViewBtn.removeClass('btn-primary active').addClass('btn-secondary');
                weekViewBtn.removeClass('btn-primary active').addClass('btn-secondary');
                dayViewBtn.removeClass('btn-primary active').addClass('btn-secondary');
                agendaWeekViewBtn.removeClass('btn-primary active').addClass('btn-secondary');
            });

            agendaWeekViewBtn.click(function() {
                $('#calendar').fullCalendar('changeView', 'agendaWeek');
                $(this).removeClass('btn-secondary').addClass('btn-primary active');
                monthViewBtn.removeClass('btn-primary active').addClass('btn-secondary');
                weekViewBtn.removeClass('btn-primary active').addClass('btn-secondary');
                dayViewBtn.removeClass('btn-primary active').addClass('btn-secondary');
                agendaDayViewBtn.removeClass('btn-primary active').addClass('btn-secondary');
            });

            // Search functionality
            searchInput.on('input', function() {
                clearTimeout(searchTimer);
                var query = $(this).val().trim();

                if (query.length < 2) {
                    searchResults.hide().empty();
                    return;
                }

                searchTimer = setTimeout(function() {
                    $.ajax({
                        url: SITEURL + '/search-bookings',
                        type: "GET",
                        data: {
                            query: query
                        },
                        success: function(response) {
                            if (response.length > 0) {
                                var html = '';
                                response.forEach(function(booking) {
                                    html += `
                                        <div class="search-result-item" data-id="${booking.id}">
                                            <strong>${booking.name}</strong><br>
                                            <small class="text-muted">
                                                ${booking.email} | ${booking.booking_number} | ${booking.contact_number} | ${booking.post_code || 'No post code'}
                                            </small><br>
                                            <small>${moment(booking.booking_date).format('MMM D, YYYY')} at ${booking.start_time}</small>
                                        </div>
                                    `;
                                });
                                searchResults.html(html).show();

                                // Add click handler for search results
                                $('.search-result-item').on('click', function() {
                                    var bookingId = $(this).data('id');
                                    showBookingDetails(bookingId);
                                    searchResults.hide();
                                });
                            } else {
                                searchResults.html(
                                    '<div class="p-3 text-muted">No bookings found</div>'
                                ).show();
                            }
                        }
                    });
                }, 100);
            });

            // Hide search results when clicking outside
            $(document).on('click', function(e) {
                if (!$(e.target).closest('#searchResults, #searchInput').length) {
                    searchResults.hide();
                }
            });

            // Function to show booking details
            function showBookingDetails(bookingId) {
                $.ajax({
                    url: SITEURL + '/booking/' + bookingId,
                    type: "GET",
                    success: function(response) {
                        var detailsHtml = `
                            <section class="booking-details container my-4">
                                <div class="card shadow-sm rounded">
                                    <div class="card-header bg-primary text-white py-2">
                                        <h5 class="mb-0">Booking Details</h5>
                                    </div>
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-md-6 mb-3">
                                                <div class="d-flex justify-content-between align-items-center border-bottom pb-2">
                                                    <small class="text-uppercase text-secondary">Booking Number:</small>
                                                    <span class="font-weight-bold text-dark">
                                                        ${response.booking_number || 'N/A'}
                                                    </span>
                                                </div>
                                            </div>
                                            <div class="col-md-6 mb-3">
                                                <div class="d-flex justify-content-between align-items-center border-bottom pb-2">
                                                    <small class="text-uppercase text-secondary">Name:</small>
                                                    <span class="font-weight-bold text-dark">
                                                        ${
                                                            response.title && response.name
                                                            ? `${response.title} ${response.name}`
                                                            : (response.name || 'N/A')
                                                        }
                                                    </span>
                                                </div>
                                            </div>
                                            <div class="col-md-6 mb-3">
                                                <div class="d-flex justify-content-between align-items-center border-bottom pb-2">
                                                    <small class="text-uppercase text-secondary">Address:</small>
                                                    <span class="font-weight-bold text-dark">
                                                        ${response.address || 'N/A'}
                                                    </span>
                                                </div>
                                            </div>
                                            <div class="col-md-6 mb-3">
                                                <div class="d-flex justify-content-between align-items-center border-bottom pb-2">
                                                    <small class="text-uppercase text-secondary">Post Code:</small>
                                                    <span class="font-weight-bold text-dark">
                                                        ${response.post_code || 'N/A'}
                                                    </span>
                                                </div>
                                            </div>
                                            <div class="col-md-6 mb-3">
                                                <div class="d-flex justify-content-between align-items-center border-bottom pb-2">
                                                    <small class="text-uppercase text-secondary">Contact Number:</small>
                                                    <span class="font-weight-bold text-dark">
                                                        ${response.contact_number || 'N/A'}
                                                    </span>
                                                </div>
                                            </div>
                                            <div class="col-md-6 mb-3">
                                                <div class="d-flex justify-content-between align-items-center border-bottom pb-2">
                                                    <small class="text-uppercase text-secondary">Email:</small>
                                                    <span class="font-weight-bold text-dark">
                                                        ${response.email || 'N/A'}
                                                    </span>
                                                </div>
                                            </div>
                                            <div class="col-md-6 mb-3">
                                                <div class="d-flex justify-content-between align-items-center border-bottom pb-2">
                                                    <small class="text-uppercase text-secondary">Deposit Amount:</small>
                                                    <span class="font-weight-bold text-dark">
                                                        ${
                                                            response.deposit_amount != null
                                                            ? '£' + parseFloat(response.deposit_amount).toFixed(2)
                                                            : 'N/A'
                                                        }
                                                    </span>
                                                </div>
                                            </div>
                                            <div class="col-md-6 mb-3">
                                                <div class="d-flex justify-content-between align-items-center border-bottom pb-2">
                                                    <small class="text-uppercase text-secondary">Pay on Day:</small>
                                                    <span class="font-weight-bold text-dark">
                                                        ${
                                                            response.pay_on_day != null
                                                            ? '£' + parseFloat(response.pay_on_day).toFixed(2)
                                                            : 'N/A'
                                                        }
                                                    </span>
                                                </div>
                                            </div>
                                            <div class="col-md-6 mb-3">
                                                <div class="d-flex justify-content-between align-items-center">
                                                    <small class="text-uppercase text-secondary">Total:</small>
                                                    <span class="font-weight-bold text-dark">
                                                        ${
                                                            (response.deposit_amount != null && response.pay_on_day != null)
                                                            ? '£' + (
                                                                parseFloat(response.deposit_amount) +
                                                                parseFloat(response.pay_on_day)
                                                            ).toFixed(2)
                                                            : 'N/A'
                                                        }
                                                    </span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </section>
                        `;

                        $('#bookingDetails').html(detailsHtml);
                        $('#deleteForm').data('booking-id', response.id);
                        $('#editBookingBtn').attr('href', SITEURL + '/photography/bookings/' + response
                            .id + '/edit');
                        deleteForm.attr('action', SITEURL + '/booking/' + response.id);
                        bookingModal.show();

                        // Center the calendar on this event's date
                        $('#calendar').fullCalendar('gotoDate', moment(response.booking_date));
                    }
                });
            }

            // Function to get color based on status
            function getStatusColor(status) {
                switch (status.toLowerCase()) {
                    case 'confirmed':
                        return '#28a745'; // Green
                    case 'pending':
                        return '#ffc107'; // Yellow
                    case 'cancelled':
                        return '#dc3545'; // Red
                    case 'completed':
                        return '#17a2b8'; // Teal
                    default:
                        return '#007bff'; // Blue
                }
            }

            // Global variable to store current booking ID
            var currentBookingId = null;
            var currentBookingInfo = null;

            // When delete button is clicked in booking modal
            $(document).on('click', '#deleteBookingBtn', function(e) {
                e.preventDefault();

                // Get booking info from the modal
                currentBookingId = $('#deleteForm').data('booking-id');
                currentBookingInfo = $('#bookingDetails').find('.booking-info').text();

                // Set info in confirmation modal
                $('#bookingToDeleteInfo').text(currentBookingInfo);

                // Show confirmation modal
                // deleteConfirmationModal.show();
                $('#deleteConfirmationModal')
                    .appendTo('body')
                    .modal('show');
            });

            // When confirm delete button is clicked
            $('#confirmDeleteBtn').click(function() {
                if (!currentBookingId) return;

                $.ajax({
                    url: SITEURL + '/booking/' + currentBookingId,
                    type: 'DELETE',
                    data: {
                        _token: $('meta[name="csrf-token"]').attr('content')
                    },
                    beforeSend: function() {
                        $('#confirmDeleteBtn').prop('disabled', true).html(
                            '<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Deleting...'
                            );
                    },
                    success: function(response) {
                        if (response.success) {
                            toastr.success(response.message, 'Success');
                            $('#calendar').fullCalendar('refetchEvents');
                            bookingModal.hide();
                        } else {
                            toastr.error(response.message, 'Error');
                        }
                    },
                    error: function(xhr) {
                        toastr.error(xhr.responseJSON?.message || 'Error deleting booking',
                            'Error');
                    },
                    complete: function() {
                        deleteConfirmationModal.hide();
                        $('#confirmDeleteBtn').prop('disabled', false).text('Delete Booking');
                    }
                });
            });
        });

        function displayMessage(message) {
            toastr.success(message, 'Booking');
        }
    </script>
</body>

</html>
