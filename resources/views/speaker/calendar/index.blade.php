@extends('layouts.speaker')

@section('content')
    <link href="{{ asset('admin-master/asset/style/app.min.css') }}" rel="stylesheet" />
    <div class="container-fluid calendar">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="mt-4 mt-lg-0">
                                    <div id="calendar" class="fc fc-media-screen fc-direction-ltr fc-theme-bootstrap"
                                        style="height: 531px;">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal fade" id="event-modal" tabindex="-1" style="display: none;" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <form class="needs-validation" name="event-form" id="form-event" novalidate="">
                                <div class="modal-header py-3 px-4 border-bottom-0">
                                    <h5 class="modal-title" id="modal-title">Add New Event</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                                </div>
                                <div class="modal-body px-4 pb-4 pt-0">
                                    <div class="row">
                                        <div class="col-12">
                                            <div class="mb-3">
                                                <label class="control-label form-label">Event Name</label>
                                                <input class="form-control" placeholder="Insert Event Name" type="text"
                                                    name="title" id="event-title" required="">
                                                <div class="invalid-feedback">Please provide a valid event name</div>
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="mb-3">
                                                <label class="control-label form-label">Category</label>
                                                <select class="form-select" name="category" id="event-category"
                                                    required="">
                                                    <option value="bg-danger" selected="">Danger</option>
                                                    <option value="bg-success">Success</option>
                                                    <option value="bg-primary">Primary</option>
                                                    <option value="bg-info">Info</option>
                                                    <option value="bg-dark">Dark</option>
                                                    <option value="bg-warning">Warning</option>
                                                </select>
                                                <div class="invalid-feedback">Please select a valid event category</div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-6">
                                            <button type="button" class="btn btn-danger" id="btn-delete-event"
                                                style="display: none;">Delete</button>
                                        </div>
                                        <div class="col-6 text-end">
                                            <button type="button" class="btn btn-light me-1"
                                                data-bs-dismiss="modal">Close</button>
                                            <button type="submit" class="btn btn-success" id="btn-save-event">Save</button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <!-- end modal-content-->
                    </div>
                    <!-- end modal dialog-->
                </div>
            </div>
        </div>
    </div>
    <script>
        function htmlToElements(html) {
            var template = document.createElement('template');
            template.innerHTML = html;
            return template.content.childNodes;
        }
    </script>
    <script>
        ! function(l) {
            "use strict";

            function e() {
                this.$body = l("body"), 
                this.$modal = new bootstrap.Modal(document.getElementById("event-modal"), {  backdrop: "static"}),
                this.$calendar = l("#calendar"), 
                this.$formEvent = l("#form-event"), 
                this.$btnNewEvent = l("#btn-new-event"), 
                this.$btnDeleteEvent = l("#btn-delete-event"),
                this.$btnSaveEvent = l( "#btn-save-event"),
                this.$modalTitle = l("#modal-title"), 
                this.$calendarObj = null,
                this.$selectedEvent = null, 
                this.$newEventData = null
            }

            e.prototype.init = function() {
                    var e = new Date(l.now());
                    // new FullCalendar.Draggable(document.getElementById("external-events"), { itemSelector: ".external-event", eventData: function(e) { return { title: e.innerText, className: l(e).data("class") } } });
                    var t = [
                            @for ($i = 0; $i < count($webinars); $i++)
                                {
                                    title: "{{$webinars[$i]->topic}}",
                                    start: '{{$webinars[$i]->startAt}}',
                                    end: '{{$webinars[$i]->endAt}}',
                                    className: "webinar webinar-{{$webinars[$i]->id}} {{ Carbon\Carbon::now()->gt(Carbon\Carbon::parse($webinars[$i]->endAt)) ? 'bg-secondary' : (Carbon\Carbon::now()->lt(Carbon\Carbon::parse($webinars[$i]->startAt)) ? 'bg-warning' : 'bg-danger') }}",
                                    url: '/speaker/tours/{{$tour->id}}/events/webinars/{{$webinars[$i]->id}}',
                                    extendedProps: {
                                        'content' : `
                                            <div class="row">
                                                <div class="col-12">
                                                    <div class="row">
                                                        <div class="col-5">
                                                            <h6 style="font-size:15px"><i class="fas fa-calendar-alt mr-1" style="color: #4348dfb0;"></i><span>{{ $webinars[$i]->startAt != null ? Carbon\Carbon::parse($webinars[$i]->startAt)->format('M-d  h:m') : 'N/A'}}</span></h6>
                                                        </div>
                                                        <div class="col-2 mt-1"> to </div>
                                                        <div class="col-5">
                                                            <h6 style="font-size:15px"><i class="fas fa-calendar-alt mr-1" style="color: #4348dfb0;"></i><span>{{ $webinars[$i]->endAt != null ? Carbon\Carbon::parse($webinars[$i]->endAt)->format('M-d  h:m') : 'N/A'}}</span></h6>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-12 mt-1">
                                                    @foreach($webinars[$i]->details as $detail)
                                                        <a class='text-detail-webinar'>
                                                            <i class='fas fa-check'></i>
                                                            {{$detail->title}}
                                                            @if($detail->speaker != null && $detail->speaker->id == $profile->id)
                                                            <i class='ml-2 fas fa-user'></i>
                                                            @endif
                                                        </a><br>
                                                    @endforeach
                                                </div>
                                            </div>
                                        `
                                    }
                                }
                                @if ($i < count($webinars) - 1) , @endif
                            @endfor
                        ],
                        a = this;
                    a.$calendarObj = new FullCalendar.Calendar(a.$calendar[0], {
                            // slotDuration: "00:15:00",
                            // slotMinTime: "06:00:00",
                            // slotMaxTime: "23:00:00",
                            themeSystem: "bootstrap",
                            bootstrapFontAwesome: !1,
                            buttonText: {
                                today: "Today",
                                month: "Month",
                                week: "Week",
                                day: "Day",
                                list: "List",
                                prev: "Prev",
                                next: "Next"
                            },
                            initialView: "dayGridMonth",
                            handleWindowResize: !0,
                            height: l(window).height() - 200,
                            headerToolbar: {
                                left: "prev,next today",
                                center: "title",
                                right: "dayGridMonth,timeGridWeek,timeGridDay,listMonth"
                            },
                            initialEvents: t,
                            editable: 0,
                            droppable: 0,
                            selectable: !0,
                            // dateClick: function(e) {
                            //     a.onSelect(e)
                            // },
                            eventClick: function(e) {
                                
                            },
                            eventMouseEnter: function(info) {
                                let start = info.event.start;
                                let end = info.event.end;
                                let title = info.event.title;
                                let content = info.event.extendedProps.content;
                                $(info.el).popover({
                                    title: title,
                                    placement:'top',
                                    trigger : 'hover',
                                    content: content,
                                    container:'body',
                                    html: true,
                                    animation: true
                                })
                                .popover('show');
                            },
                        }),
                        a.$calendarObj.render()
                },
                l.CalendarApp = new e, l.CalendarApp.Constructor = e
        }(window.jQuery),

        function() {
            "use strict";
            window.jQuery.CalendarApp.init()
        }();

        $(document).ready(function () {
            $('.webinar').click(function () {  
                
            })
        });
    </script>
@endsection
