@extends('layouts.main', ['activePage' => 'dashboard', 'titlePage' => __('Dashboard')])
@section('content')
<br><br><hr>
<!-- HTML -->
<div id="calendar"></div>
@endsection
@notifyCss
<link href="https://cdn.jsdelivr.net/npm/fullcalendar@3.10.5/dist/fullcalendar.min.css" rel="stylesheet"/>
<link href="https://cdn.jsdelivr.net/npm/fullcalendar-scheduler@1.10.4/dist/scheduler.min.css" rel="stylesheet"/>
<link href="{{asset('css/modal.css')}}" rel="stylesheet" type="text/css"/>
<style>
  #calendar .fc-view-harness .fc-license-message {
    display: none;
  }
  #calendar {
    max-width: 95%;
    margin: 40px auto;
    padding: 20px;
    background-color:#ffff;
    white-space: nowrap;
    overflow: hidden;
    text-overflow: ellipsis;
  }
  .small-resource {
    width: 50%;
  }
</style>
@push('js')
@notifyJs
<script src="https://cdn.jsdelivr.net/npm/moment@2/min/moment.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/fullcalendar-scheduler@6.0.2/index.global.min.js"></script>
<!-- <script>      
    document.addEventListener('DOMContentLoaded', function() {
      // Convertir arreglos de eventos a objetos JSON
      var serves = JSON.parse('@json($serves)');
      var servehospedajes = JSON.parse('@json($servehospedajes)');

      // Inicializar FullCalendar
      var calendarEl = document.getElementById('calendar');
      var calendar = new FullCalendar.Calendar(calendarEl, {
        slotLabelFormat: {
          hour: 'numeric',
          minute: '2-digit',
          hour12: false
        },
        headerToolbar: {
          left: 'today prev,next',
          center: 'title',
          right: 'resourceTimelineDay,resourceTimelineWeek'
        },
        aspectRatio: 1.6,
        initialView: 'resourceTimelineDay',               
        events: serves.concat(servehospedajes), // combinar los dos arreglos de eventos
        eventDidMount: function(event) {
          // Obtiene el elemento HTML del evento
          var element = event.el;

          // Realiza alguna acción sobre el elemento HTML del evento
          element.style.width = '130%';
        },
        resources: @json($hbts),   
      });
      calendar.render();
    });
</script> -->
<script>      
  document.addEventListener('DOMContentLoaded', function() {
    // Convertir arreglos de eventos a objetos JSON
    var serves = JSON.parse('@json($serves)');
    var servehospedajes = JSON.parse('@json($servehospedajes)');

    // Inicializar FullCalendar
    var calendarEl = document.getElementById('calendar');
    var calendar = new FullCalendar.Calendar(calendarEl, {
      slotLabelFormat: {
        hour: 'numeric',
        minute: '2-digit',
        hour12: false
      },
      headerToolbar: {
        left: 'today prev,next',
        center: 'title',
        right: 'resourceTimelineDay,resourceTimelineWeek'
      },
      aspectRatio: 1.6,
      initialView: 'resourceTimelineDay',     
      events: serves.concat(servehospedajes), // combinar los dos arreglos de eventos
      eventDidMount: function(event) {
        // Obtiene el elemento HTML del evento
        var element = event.el;

        // Realiza alguna acción sobre el elemento HTML del evento
        element.style.width = '130%';
      },
      resources: @json($hbts),
      resourceOrder: function(a, b) {
        return a.id - b.id;
      },
      slotMinTime: '06:00:00',
      slotMaxTime: '19:00:00',
    });
    calendar.render();
  });
</script>
@endpush