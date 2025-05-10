@extends('dashboard.layout.layout')

@section('content')
<div class="card">
    <div class="card-body">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h4 class="card-title">Booking Calendar</h4>
            <a href="{{ route('bookings.create') }}" class="btn btn-primary">
                <i class="mdi mdi-plus"></i> Add Booking
            </a>
        </div>
        <div id="calendar"></div>
    </div>
</div>
@endsection

@push('styles')
<style>
    #calendar {
        width: 100%;
        margin: 0 auto;
    }
    .fc-event {
        cursor: pointer;
        font-size: 0.85em;
        padding: 2px 4px;
    }
</style>
@endpush

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    const calendarEl = document.getElementById('calendar');
    const calendar = new FullCalendar.Calendar(calendarEl, {
        plugins: [
            FullCalendar.dayGridPlugin,
            FullCalendar.timeGridPlugin,
            FullCalendar.interactionPlugin,
            FullCalendar.listPlugin
        ],
        initialView: 'dayGridMonth',
        headerToolbar: {
            left: 'prev,next today',
            center: 'title',
            right: 'dayGridMonth,timeGridWeek,timeGridDay,listWeek'
        },
        events: '{{ route("bookings.events") }}',
        editable: true,
        eventClick: function(info) {
            window.location.href = `/bookings/${info.event.id}/edit`;
        },
        dateClick: function(info) {
            window.location.href = `/bookings/create?date=${info.dateStr}`;
        },
        eventDrop: function(info) {
            axios.patch(`/bookings/${info.event.id}`, {
                start: info.event.start,
                end: info.event.end || info.event.start
            }).catch(() => {
                info.revert();
                alert('Failed to update booking time');
            });
        }
    });
    calendar.render();
});
</script>
@endpush