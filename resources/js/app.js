import './bootstrap';
import Alpine from 'alpinejs';

// In resources/js/app.js
import '@fullcalendar/core/main.css';
import '@fullcalendar/daygrid/main.css';
import '@fullcalendar/timegrid/main.css';
import '@fullcalendar/list/main.css';


window.FullCalendar = {
    Calendar,
    dayGridPlugin,
    timeGridPlugin,
    interactionPlugin,
    listPlugin
};

window.Alpine = Alpine;

Alpine.start();
