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
    <!-- Favicon icon -->
    <link rel="icon" type="image/png" sizes="16x16" href="{{asset('dashboard/assets/images/favicon.png')}}">
    <title>Younique Booking..</title>
    <!-- This page plugin CSS -->
    <!-- <link href="{{asset('dashboard/assets/extra-libs/datatables.net-bs4/css/dataTables.bootstrap4.css')}}" rel="stylesheet"> -->
    <link rel="stylesheet" href="{{asset('dashboard/assets/extra-libs/datatables.net-bs4/css/dataTables.bootstrap4.css')}}">
    <link rel="stylesheet" href="{{asset('dashboard/assets/extra-libs/datatables.net-bs4/css/responsive.dataTables.min.css')}}">
    <!-- Custom CSS -->
    <link href="{{asset('dashboard/dist/css/style.min.css')}}" rel="stylesheet">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
    {{-- <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script> --}}
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.0/dist/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>







        <!-- FullCalendar CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/fullcalendar@3.10.2/dist/fullcalendar.min.css" />
    <!-- jQuery -->
    <!-- MomentJS -->
    <script src="https://cdn.jsdelivr.net/npm/moment@2.29.1/moment.min.js"></script>
    <!-- FullCalendar JS -->
    <script src="https://cdn.jsdelivr.net/npm/fullcalendar@3.10.2/dist/fullcalendar.min.js"></script>
    <!-- Bootstrap CSS (optional) -->
    {{-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"> --}}


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
            <div class="container-fluid">
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
        var newStatus = $(this).val();
        var dropdown = $(this);
        var badge = dropdown.siblings('.status-badge');
        
        $.ajax({
            url: '/photography/bookings/' + bookingId + '/update-status',
            method: 'POST',
            data: {
                status: newStatus,
                _token: '{{ csrf_token() }}'
            },
            success: function(response) {
                // Update the badge text and color
                badge.text(newStatus.charAt(0).toUpperCase() + newStatus.slice(1));
                
                // Update badge color based on status
                var badgeClass = 'bg-';
                if(newStatus == 'confirmed') {
                    badgeClass += 'success';
                } else if(newStatus == 'cancelled') {
                    badgeClass += 'danger';
                } else if(newStatus == 'completed') {
                    badgeClass += 'info';
                } else {
                    badgeClass += 'warning';
                }
                
                badge.removeClass().addClass('badge ' + badgeClass);
                
                // Optional: Show a success message
                toastr.success('Status updated successfully');
            },
            error: function(xhr) {
                // Revert the dropdown to its original value
                dropdown.val(dropdown.data('previous-value'));
                
                // Show error message
                toastr.error('Error updating status');
            }
        });
        
        // Store the previous value in case of error
        dropdown.data('previous-value', dropdown.val());
    });
});
</script>
    <script>
        $(document).ready(function() {
            $('#calendar').fullCalendar({
                header: {
                    left: 'prev,next today',
                    center: 'title',
                    right: 'month,agendaWeek,agendaDay'
                },
                defaultView: 'agendaDay',
                minTime: '09:00:00', // Backend still uses 24-hour format
                maxTime: '17:00:00', // Backend still uses 24-hour format
                slotLabelFormat: 'h(:mm)a', 
                eventTimeFormat: 'h:mm a',
                // slotDuration: '00:30:00',
                navLinks: true,
                editable: false,
                eventLimit: false,
                // eventLimit: false,
                events: {
                    url: '/photography/dashboard', // Your endpoint that returns JSON events
                    type: 'GET',
                    dataType: 'json',
                    error: function() {
                        alert('There was an error fetching events!');
                    }
                },
                eventRender: function(event, element) {
                    // Color events by status
                    if (event.status === 'confirmed') {
                        element.css('background-color', '#28a745');
                    } else if (event.status === 'pending') {
                        element.css('background-color', '#ffc107');
                    } else if (event.status === 'cancelled') {
                        element.css('background-color', '#dc3545');
                    }

                    // Show time range in title
                    // element.find('.fc-title').prepend(`${event.start_time} - ${event.end_time}: `);
                    element.find('.fc-title').html(`
                        <div class="fc-event-details">
                            <div class="fc-event-name">${event.name.toUpperCase()}</div>
                            ${event.email ? `<div class="fc-event-email">${event.email}</div>` : ''}
                        
                        </div>
                    `);
                    // Add tooltip with more info
                    element.attr('title',
                        `Customer: ${event.name}\n` +
                        `Services: ${event.contact_number}\n` +
                        `Status: ${event.status}`
                    );
                },
                eventClick: function(calEvent, jsEvent, view) {
                    // Populate modal with event details
                    $('#modal-name').text(calEvent.name);
                    $('#modal-phone').text(calEvent.contact_number);
                    $('#modal-email').text(calEvent.email);
                    $('#modal-services').text(calEvent.services);
                    $('#modal-date').text(calEvent.booking_date);
                    $('#modal-time').text(calEvent.start_time + ' - ' + calEvent.end_time);
                    $('#modal-guests').text(calEvent.no_of_guest);
                    $('#modal-amount').text(calEvent.sales_amount);
                    $('#modal-deposit').text(calEvent.deposit_amount);
                    $('#modal-status').text(calEvent.status);
                    $('#modal-booking-agent').text(calEvent.booking_agent);
                    $('#modal-sales-agent').text(calEvent.sales_agents);

                    // Show modal
                    var eventModal = new bootstrap.Modal(document.getElementById('eventModal'));
                    eventModal.show();
                }
            });
        });
    </script>

    </body>

</html>