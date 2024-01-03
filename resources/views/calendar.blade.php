@extends('layouts.app', ['activePage' => 'icons', 'titlePage' => __('Icons')])

@section('content')
<br><br><br>
<div class="card" style="width:90%; margin:auto;">
    <div class="card-body">
        <div class="container">
            <div class="row m-3">
                <div class="col-12">
                    <div id='calendar'></div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
<link href="{{ asset('css/material-dashboardForms.css?v=2.1.1') }}" rel="stylesheet" />
<link rel="stylesheet" href="https://cdn.datatables.net/1.12.1/css/dataTables.bootstrap4.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.3.0/css/responsive.bootstrap4.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.2/css/all.min.css" integrity="sha512-1sCRPdkRXhBV2PBLUdRb4tMg1w2YPf37qatUFeS7zlBy7jJI8Lf4VHwWfZZfpXtYSLy85pkm9GaYVYMfw5BC1A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/material-design-iconic-font/2.2.0/css/material-design-iconic-font.min.css" integrity="sha512-rRQtF4V2wtAvXsou4iUAs2kXHi3Lj9NE7xJR77DE7GHsxgY9RTWy93dzMXgDIG8ToiRTD45VsDNdTiUagOFeZA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
<meta name="csrf-token" content="{{ csrf_token() }}">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.10.2/fullcalendar.min.css" />
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.2/dist/css/bootstrap.min.css" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/izitoast/1.4.0/css/iziToast.min.css" />
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.2/css/all.min.css" integrity="sha512-1sCRPdkRXhBV2PBLUdRb4tMg1w2YPf37qatUFeS7zlBy7jJI8Lf4VHwWfZZfpXtYSLy85pkm9GaYVYMfw5BC1A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
@notifyCss

@push('js')
<script src="https://cdn.jsdelivr.net/npm/fullcalendar@5.11.3/main.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/fullcalendar@5.11.3/locales-all.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.10.2/fullcalendar.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.2/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/izitoast/1.4.0/js/iziToast.min.js"></script>
<script type="text/javascript">
    $(document).ready(function() {

        // pass _token in all ajax
            $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        // initialize calendar in all events
        var calendar = $('#calendar').fullCalendar({        
            editable: true,
            events: "{{ route('calendar.index') }}",
            displayEventTime: true,
            eventRender: function (event, element, view) {
                if (event.allDay === 'true') {
                        event.allDay = true;
                } else {
                        event.allDay = false;
                }
            },
            selectable: true,
            selectHelper: true,
            select: function (start, end, allDay) {
                var event_name = prompt('Event Name:');
                if (event_name) {
                    var start = $.fullCalendar.formatDate(start, "YYYY-MM-DD HH:mm:ss");
                    var end = $.fullCalendar.formatDate(end, "YYYY-MM-DD HH:mm:ss");
                    $.ajax({
                        url: "{{ route('calendar.create') }}",
                        data: {
                            title: event_name,
                            start: start,
                            end: end
                        },
                        type: 'post',
                        success: function (data) {
                            iziToast.success({
                                position: 'topRight',
                                message: 'Event created successfully.',
                            });

                            calendar.fullCalendar('renderEvent', {
                                id: data.id,
                                title: event_name,
                                start: start,
                                end: end,
                                allDay: allDay,
                            }, true);
                            calendar.fullCalendar('unselect');
                        }
                    });
                }
            },
            eventDrop: function (event, delta) {
                var start = $.fullCalendar.formatDate(event.start, "YYYY-MM-DD HH:mm:ss");
                var end = $.fullCalendar.formatDate(event.end, "YYYY-MM-DD HH:mm:ss");

                $.ajax({
                    url: "{{ route('calendar.edit') }}",
                    data: {
                        title: event.event_name,
                        start: start,
                        end: end,
                        id: event.id,
                    },
                    type: "POST",
                    success: function (response) {
                        iziToast.success({
                            position: 'topRight',
                            message: 'Event updated successfully.',
                        });
                    }
                });
            },
            eventClick: function (event) {
                var eventDelete = confirm('Are you sure to remove event?');
                if (eventDelete) {
                    $.ajax({
                        type: "post",
                        url: "{{ route('calendar.destroy') }}",
                        data: {
                            id: event.id,
                            _method: 'delete',
                        },
                        success: function (response) {
                            calendar.fullCalendar('removeEvents', event.id);
                            iziToast.success({
                                position: 'topRight',
                                message: 'Event removed successfully.',
                            });
                        }
                    });
                }
            }   
        });
    });
</script>
@notifyJs
@endpush