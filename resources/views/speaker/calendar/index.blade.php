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

            e.prototype.onEventClick = function(e) {
                    // this.$formEvent[0].reset(),
                    // this.$formEvent.removeClass("was-validated"),
                    // this.$newEventData = null,
                    // this.$btnDeleteEvent.show(),
                    // this.$modalTitle.text("Edit Event"),
                    // this.$modal.show(),
                    // this.$selectedEvent = e.event,
                    // l("#event-title").val(this.$selectedEvent.title),
                    // l("#event-category").val(this.$selectedEvent.classNames[0])
                },
                // e.prototype.onSelect = function(e) {
                //     this.$formEvent[0].reset(),
                //         this.$formEvent.removeClass("was-validated"),
                //         this.$selectedEvent = null,
                //         this.$newEventData = e,
                //         this.$btnDeleteEvent.hide(),
                //         this.$modalTitle.text("Add New Event"),
                //         this.$modal.show(),
                //         this.$calendarObj.unselect()
                // },
                e.prototype.init = function() {
                    var e = new Date(l.now());
                    // new FullCalendar.Draggable(document.getElementById("external-events"), { itemSelector: ".external-event", eventData: function(e) { return { title: e.innerText, className: l(e).data("class") } } });
                    var t = [
                            @for ($i = 0; $i < count($webinars); $i++)
                                {
                                    title: "{{$webinars[$i]->topic}}",
                                    start: '{{$webinars[$i]->startAt}}',
                                    end: '{{$webinars[$i]->endAt}}',
                                    className: "webinar webinar-{{$webinars[$i]->id}} {{ Carbon\Carbon::now()->gt(Carbon\Carbon::parse($webinars[$i]->endAt)) ? 'bg-secondary' : (Carbon\Carbon::now()->lt(Carbon\Carbon::parse($webinars[$i]->startAt)) ? 'bg-warning' : 'bg-danger') }}"
                                }
                                @if ($i < count($webinars) - 1) , @endif
                            @endfor
                        ],
                        a = this;
                    a.$calendarObj = new FullCalendar.Calendar(a.$calendar[0], {
                            slotDuration: "00:15:00",
                            slotMinTime: "06:00:00",
                            slotMaxTime: "23:00:00",
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
                            editable: !0,
                            droppable: !0,
                            selectable: !0,
                            dateClick: function(e) {
                                a.onSelect(e)
                            },
                            eventClick: function(e) {
                                a.onEventClick(e)
                            }
                        }),
                        a.$calendarObj.render() //,
                        // a.$btnNewEvent.on("click", function(e) {
                        //     a.onSelect({
                        //         date: new Date,
                        //         allDay: !0
                        //     })
                        // }),
                        // a.$formEvent.on("submit", function(e) {
                        //     e.preventDefault();
                        //     var t, n = a.$formEvent[0];
                        //     n.checkValidity() ? (a.$selectedEvent ? (a.$selectedEvent.setProp("title", l("#event-title")
                        //         .val()), a.$selectedEvent.setProp("classNames", [l("#event-category")
                        //     .val()])) : (t = {
                        //         title: l("#event-title").val(),
                        //         start: a.$newEventData.date,
                        //         allDay: a.$newEventData.allDay,
                        //         className: l("#event-category").val()
                        //     }, a.$calendarObj.addEvent(t)), a.$modal.hide()) : (e.stopPropagation(), n.classList
                        //         .add("was-validated"))
                        // }),
                        // l(a.$btnDeleteEvent.on("click", function(e) {
                        //     a.$selectedEvent && (a.$selectedEvent.remove(), a.$selectedEvent = null, a.$modal
                        //     .hide())
                        // }))
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
