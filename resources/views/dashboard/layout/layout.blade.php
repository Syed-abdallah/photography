<!DOCTYPE html>
<html dir="ltr" lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <meta name="csrf-token" content="{{ csrf_token() }}">
 



<!-- these are pfd javascript -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf-autotable/3.5.28/jspdf.plugin.autotable.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/1.4.1/html2canvas.min.js"></script>
<!-- these are pfd javascript  -->


  @php
        
        $logo = \App\Models\Logo::first();
  
        $logoUrl = $logo && $logo->logo_path
            ? asset('dashboard/assets/images/logo/' . $logo->logo_path)
            : null;
    @endphp

    
    <title>{{ $logo ? $logo->name : '' }}</title>

    @if($logoUrl)
        <link rel="icon" type="image/png" href="{{ $logoUrl }}">
    @endif















    <!-- This page plugin CSS -->
    <!-- <link href="{{asset('dashboard/assets/extra-libs/datatables.net-bs4/css/dataTables.bootstrap4.css')}}" rel="stylesheet"> -->
    <link rel="stylesheet" href="{{asset('dashboard/assets/extra-libs/datatables.net-bs4/css/dataTables.bootstrap4.css')}}">
    <link rel="stylesheet" href="{{asset('dashboard/assets/extra-libs/datatables.net-bs4/css/responsive.dataTables.min.css')}}">
    <!-- Custom CSS -->
    <link href="{{asset('dashboard/dist/css/style.min.css')}}" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.0/dist/jquery.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
    {{-- <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script> --}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>





   

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.9.0/fullcalendar.css" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.24.0/moment.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.9.0/fullcalendar.js"></script>


    <style>
     

        #calendar {
            max-width: 1200px;
            margin: 0 auto;
        }

        .fc-event {
            cursor: pointer;
        }
        /* Custom Slide-In from Right */
        .toast {
            opacity: 0;
            margin-top: 22px;
            transform: translateX(100px);
            transition: all 0.3s ease;
        }
    
        .toast.showing {
            opacity: 1;
            transform: translateX(0);
        }
    
        /* Fade-Out and Move Up */
        .toast.hiding {
            opacity: 0;
            transform: translateY(-100px); /* Move upward while hiding */
        }
    </style>
</head>

<body>

       <!-- Modal for event details -->
    <div class="modal fade" id="eventModal" tabindex="-1" aria-labelledby="eventModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="eventModalLabel">Booking Details</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p><strong>Customer:</strong> <span id="modal-name"></span></p>
                    <p><strong>Phone:</strong> <span id="modal-phone"></span></p>
                    <p><strong>Email:</strong> <span id="modal-email"></span></p>
                    <p><strong>Services:</strong> <span id="modal-services"></span></p>
                    <p><strong>Date:</strong> <span id="modal-date"></span></p>
                    <p><strong>Time:</strong> <span id="modal-time"></span></p>
                    <p><strong>Guests:</strong> <span id="modal-guests"></span></p>
                    <p><strong>Amount:</strong> $<span id="modal-amount"></span></p>
                    <p><strong>Deposit:</strong> $<span id="modal-deposit"></span></p>
                    <p><strong>Status:</strong> <span id="modal-status"></span></p>
                    <p><strong>Booking Agent:</strong> <span id="modal-booking-agent"></span></p>
                    <p><strong>Sales Agent:</strong> <span id="modal-sales-agent"></span></p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
    <!-- ============================================================== -->
    <!-- Preloader - style you can find in spinners.css -->
    <!-- ============================================================== -->


  @include('dashboard.layout.toast')


    <!-- ============================================================== -->
    <!-- Preloader - style you can find in spinners.css -->
    <!-- ============================================================== -->
    <div class="preloader">
        <div class="lds-ripple">
            <div class="lds-pos"></div>
            <div class="lds-pos"></div>
        </div>
    </div>
    <!-- ============================================================== -->
    <!-- Main wrapper - style you can find in pages.scss -->
    <!-- ============================================================== -->
    <div id="main-wrapper" data-theme="light" data-layout="vertical" data-navbarbg="skin6" data-sidebartype="full" data-sidebar-position="fixed" data-header-position="fixed" data-boxed-layout="full">
        <!-- ============================================================== -->
        <!-- Topbar header - style you can find in pages.scss -->
        <!-- ============================================================== -->
  @include('dashboard.layout.header')
        <!-- ============================================================== -->
        <!-- End Topbar header -->
        <!-- ============================================================== -->
        <!-- ============================================================== -->
        <!-- Left Sidebar - style you can find in sidebar.scss  -->
        <!-- ============================================================== -->
      @include('dashboard.layout.sidebar')
        <!-- ============================================================== -->
        <!-- End Left Sidebar - style you can find in sidebar.scss  -->
        <!-- ============================================================== -->
        <!-- ============================================================== -->
        <!-- Page wrapper  -->
        <!-- ============================================================== -->
        <div class="page-wrapper">
            <!-- ============================================================== -->
            <!-- Bread crumb and right sidebar toggle -->
            <!-- ============================================================== -->
        @include('dashboard.layout.breadcrumb')
            <!-- ============================================================== -->
            <!-- End Bread crumb and right sidebar toggle -->
            <!-- ============================================================== -->
            <!-- ============================================================== -->
            <!-- Container fluid  -->
            <!-- ============================================================== -->
            <div class="container-fluid" style="background-color: rgb(253, 209, 216);">
                <!-- ============================================================== -->
                <!-- Start Page Content -->
                <!-- ============================================================== -->
                <!-- basic table -->
            

                    @yield('content')
           
                <!-- multi-column ordering -->
         
                <!-- ============================================================== -->
                <!-- End PAge Content -->
                <!-- ============================================================== -->
            </div>
            <!-- ============================================================== -->
            <!-- End Container fluid  -->
            <!-- ============================================================== -->
            <!-- ============================================================== -->
            <!-- footer -->
            <!-- ============================================================== -->
          @include('dashboard.layout.footer')
            <!-- ============================================================== -->
            <!-- End footer -->
            <!-- ============================================================== -->
        </div>
        <!-- ============================================================== -->
        <!-- End Page wrapper  -->
        <!-- ============================================================== -->
    </div>
    <!-- ============================================================== -->
    <!-- End Wrapper -->
    <!-- ============================================================== -->
    <!-- End Wrapper -->
    <!-- ============================================================== -->
    <!-- All Jquery -->
    <!-- ============================================================== -->
    {{-- <script src="{{asset('dashboard/assets/libs/jquery/dist/jquery.min.js')}}"></script> --}}
    <!-- Bootstrap tether Core JavaScript -->
    <script src="{{asset('dashboard/assets/libs/popper.js/dist/umd/popper.min.js')}}"></script>
    <script src="{{asset('dashboard/assets/libs/bootstrap/dist/js/bootstrap.bundle.min.js')}}"></script>
    <!-- apps -->
    <!-- apps -->
    <script src="{{asset('dashboard/dist/js/app-style-switcher.js')}}"></script>
    <script src="{{asset('dashboard/dist/js/feather.min.js')}}"></script>
    <!-- slimscrollbar scrollbar JavaScript -->
    <script src="{{asset('dashboard/assets/libs/perfect-scrollbar/dist/perfect-scrollbar.jquery.min.js')}}"></script>
    <script src="{{asset('dashboard/assets/extra-libs/sparkline/sparkline.js')}}"></script>
    <!--Wave Effects -->
    <!-- themejs -->
    <!--Menu sidebar -->
    <script src="{{asset('dashboard/dist/js/sidebarmenu.js')}}"></script>
    <!--Custom JavaScript -->
    <script src="{{asset('dashboard/dist/js/custom.min.js')}}"></script>
    <!--This page plugins -->
    <script src="{{asset('dashboard/assets/extra-libs/datatables.net/js/jquery.dataTables.min.js')}}"></script>
    <script src="{{asset('dashboard/assets/extra-libs/datatables.net-bs4/js/dataTables.responsive.min.js')}}"></script>
    <script src="{{asset('dashboard/dist/js/pages/datatable/datatable-basic.init.js')}}"></script>
{{-- <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script> --}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.16/jquery.mask.min.js"></script>
    
    <script>
        // UK phone format: +44 (0)20 7946 0958
        $('#contact_number').mask('+00 (0)00 0000 0000');
    </script>




<script>

    $(document).ready(function() {
      $('.status-dropdown').change(function() {
        var bookingId = $(this).data('booking-id');
        var newStatusId = $(this).val();
        var dropdown = $(this);
        var badge = dropdown.siblings('.status-badge');
        var selectedOption = dropdown.find('option:selected');
        
        $.ajax({
            url: "{{ route('bookings.update-status', ['booking' => 'BOOKING_ID']) }}".replace('BOOKING_ID', bookingId),
            method: 'POST',
            data: {
                status: newStatusId,
                _token: '{{ csrf_token() }}'
            },
            success: function(response) {
                // Update the badge text and color
                badge.text(selectedOption.text());
                badge.css('background-color', response.color || '#6c757d');
                
                // Optional: Show a success message
                toastr.success('Status updated successfully');
            },
            error: function(xhr) {
                // Revert the dropdown to its original value
                dropdown.val(dropdown.data('previous-value'));
                
                // Show error message
                toastr.error('Error updating status: ' + (xhr.responseJSON.message || 'Unknown error'));
            }
        });
        
        // Store the previous value in case of error
        dropdown.data('previous-value', dropdown.val());
    });
});

// ---------------------Calender---------------------------------------

 
    
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
                events: SITEURL + "/photography/dashboard",
                displayEventTime: true,
                timeFormat: 'h:mm a',
                eventRender: function(event, element, view) {
    console.log("FullCalendar received event:", event.backgroundColor);

                    if (event.allDay === 'true') {
                        event.allDay = true;
                    } else {
                        event.allDay = false;
                    }

                    // Apply status color
                      if (event.color) {
        element.css('background-color', event.color);
        element.css('border-color', event.color);
    }

                    // Add more details to the event in month view
                    if (view.type === 'month') {
                        element.find('.fc-title').prepend('<span class="fc-time"> to ' + moment(event.end)
                            .format('h:mm a') + ' - </span>');
                        
                        // Add status badge if status exists
                        if (event.status) {
                            element.find('.fc-title').append('<span class="status-badge">' + 
                                event.status + '</span>');
                        }
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
                    // Additional rendering if needed
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
                                    <div class="card-header" style="background-color: ${response.status_color || '#007bff'}; color: white; py-2">
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
                                                    <small class="text-uppercase text-secondary">Status:</small>
                                                    <span class="font-weight-bold text-dark" style="color: ${response.status_color || '#007bff'}">
                                                        ${response.status || 'N/A'}
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















{{-- <script>
document.addEventListener('DOMContentLoaded', function() {
    const { jsPDF } = window.jspdf;
    
    // PDF Export Button
    document.getElementById('exportPdf').addEventListener('click', function() {
        // Create new PDF document in landscape mode
        const doc = new jsPDF('l', 'pt', 'a4');
        
        // Add title and report information
        const title = "COMPLETE BOOKINGS REPORT";
        const date = new Date().toLocaleDateString();
        const time = new Date().toLocaleTimeString();
        
        doc.setFontSize(20);
        doc.setTextColor(40, 40, 40);
        doc.setFont('helvetica', 'bold');
        doc.text(title, 40, 40);
        
        doc.setFontSize(12);
        doc.setFont('helvetica', 'normal');
        doc.text(`Generated on: ${date} at ${time}`, 40, 70);
        
        // Add filter information if any filters are applied
        const statusFilter = document.querySelector('select[name="status"]').value;
        const startDate = document.querySelector('input[name="start_date"]').value;
        const endDate = document.querySelector('input[name="end_date"]').value;
        
        let filterInfo = "Applied Filters: ";
        let hasFilters = false;
        
        if (statusFilter) {
            const statusText = document.querySelector('select[name="status"] option:checked').text;
            filterInfo += `Status: ${statusText}, `;
            hasFilters = true;
        }
        
        if (startDate) {
            filterInfo += `From: ${startDate}, `;
            hasFilters = true;
        }
        
        if (endDate) {
            filterInfo += `To: ${endDate}`;
            hasFilters = true;
        }
        
        if (hasFilters) {
            filterInfo = filterInfo.replace(/, $/, ''); // Remove trailing comma
            doc.text(filterInfo, 40, 90);
        }
        
        // Get all table headers
        const headers = [];
        document.querySelectorAll('#zero_config thead th').forEach(th => {
            // Skip the Actions column if you don't want it
            if (!th.textContent.includes('Actions')) {
                headers.push(th.textContent.trim());
            }
        });
        
        // Get all table rows data
        const rows = [];
        document.querySelectorAll('#zero_config tbody tr').forEach(row => {
            const rowData = [];
            const cells = row.querySelectorAll('td');
            
            cells.forEach((cell, index) => {
                // Skip the Actions column (last column)
                if (index < cells.length - 1) {
                    // For status column, get the selected option text
                    if (cell.querySelector('select')) {
                        const select = cell.querySelector('select');
                        const selectedOption = select.options[select.selectedIndex];
                        rowData.push(selectedOption.text.trim());
                    } else {
                        rowData.push(cell.textContent.trim());
                    }
                }
            });
            
            rows.push(rowData);
        });
        
        // Add table to PDF with proper styling
        doc.autoTable({
            head: [headers],
            body: rows,
            startY: hasFilters ? 110 : 90,
            styles: {
                fontSize: 8,
                cellPadding: 4,
                overflow: 'linebreak',
                valign: 'middle'
            },
            headStyles: {
                fillColor: [13, 110, 253], // Bootstrap primary blue
                textColor: 255,
                fontStyle: 'bold',
                halign: 'center'
            },
            bodyStyles: {
                textColor: [33, 37, 41], // Dark gray
                fontStyle: 'normal'
            },
            alternateRowStyles: {
                fillColor: [248, 249, 250] // Light gray
            },
            margin: { 
                top: hasFilters ? 110 : 90,
                left: 20,
                right: 20
            },
            tableWidth: 'auto',
            showHead: 'everyPage',
            tableLineColor: [221, 221, 221],
            tableLineWidth: 0.1
        });
        
        // Add footer
        const pageCount = doc.internal.getNumberOfPages();
        for(let i = 1; i <= pageCount; i++) {
            doc.setPage(i);
            doc.setFontSize(10);
            doc.setTextColor(150);
            doc.text(
                `Page ${i} of ${pageCount}`,
                doc.internal.pageSize.getWidth() - 50,
                doc.internal.pageSize.getHeight() - 20
            );
        }
        
        // Save the PDF with dynamic filename
        const filename = `Bookings_Report_${date.replace(/\//g, '-')}.pdf`;
        doc.save(filename);
    });
});
</script> --}}





    </body>

</html>