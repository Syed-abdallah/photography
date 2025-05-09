@extends('dashboard.layout.layout')

@section('content')
<div class="card">
    <div class="card-body">
        <h4 class="card-title">Booking Calendar</h4>
        <div id="calendar"></div>
    </div>
</div>
@endsection

@section('scripts')
    <!-- FullCalendar CSS -->
    <link href="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.8/main.min.css" rel="stylesheet">

    <!-- FullCalendar JS -->
    <script src="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.8/main.min.js"></script>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            var calendarEl = document.getElementById('calendar');

            var calendar = new FullCalendar.Calendar(calendarEl, {
                initialView: 'dayGridMonth',
                height: 650,
                events: @json($events),
                eventClick: function(info) {
                    if (info.event.url) {
                        window.open(info.event.url, "_blank");
                        info.jsEvent.preventDefault();
                    }
                }
            });

            calendar.render();
        });
    </script>
@endsection
