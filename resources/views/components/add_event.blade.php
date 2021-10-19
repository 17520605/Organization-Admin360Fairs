    <div class="modal fade" id="popup-create-webinar" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="fw-light">Create New Webinar</h5>
                   <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="/administrator/tours/{{$tour->id}}/events/webinars/save-create" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label class="small mb-1">Topic</label>
                            <input class="form-control" type="text" name="topic" placeholder="Enter topic">
                        </div>
                        <div class="row gx-3 mb-3">
                            <div class="col-md-6">
                                <label class="small mb-1" for="start">Start time</label>
                                <input class="form-control" id="start" name="start" type="datetime-local">
                            </div>
                            <div class="col-md-6">
                                <label class="small mb-1" for="end">End time</label>
                                <input class="form-control" id="end" name="end" type="datetime-local">
                            </div>
                        </div>
                        <label class="small mb-1" for="">Agenda</label>
                        <div class="row gx-3 mb-3">
                            <div class="col-md-6">
                                <input class="form-control" type="text" name="titles[]" placeholder="Title">
                            </div>
                            <div class="col-md-1" style="padding: 0;">
                                <input class="form-control" type="number" name="durations[]" min="0" max="500" style="padding-right: 0!important;" placeholder="Duration">
                            </div>
                            <div class="col-md-4" style="padding-right:0px ;">
                                <select class="form-control" name="speakers[]">
                                    <option disabled selected>--Choose speaker--</option>
                                    @foreach ($speakers as $speaker)
                                        <option value="{{$speaker->id}}">{{$speaker->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-1" style="text-align: center;">
                                <i class="fas fa-plus-circle add-agenda" onclick="addAgenda();" style="font-size: 25px;color: #4e73df;line-height: 38px;"></i>
                                <i class="fas fa-minus-circle remove-agenda" onclick="removeAgenda(event);" style="font-size: 25px;color: #f32d2d;line-height: 38px; display: none;"></i>
                            </div>
                        </div>
                        <div id="agenda-wrapper">

                        </div>
                        <div class="mb-3">
                            <label class="small mb-1" for="description">Tour Description</label>
                            <textarea placeholder="Enter your tour description" class="form-control" name="description" rows="6"></textarea>
                        </div>
                        <!-- Form Group (create account submit)-->
                        <button type="submit" class="btn btn-primary btn-block">Create</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        function addAgenda() {
            $('.add-agenda').hide();
            $('.remove-agenda').show();
            $("#agenda-wrapper").append( 
                `<div class="row gx-3 mb-3 agenda-item">
                    <div class="col-md-6">
                        <input class="form-control" type="text" name="titles[]" placeholder="Title">
                    </div>
                    <div class="col-md-1" style="padding: 0;">
                        <input class="form-control" type="number" name="durations[]" min="0" max="500" style="padding-right: 0!important;" placeholder="Duration">
                    </div>
                    <div class="col-md-4" style="padding-right:0px ;">
                        <select class="form-control" name="speakers[]">
                            <option>--Choose speaker--</option>
                            @foreach ($speakers as $speaker)
                                <option value="{{$speaker->id}}">{{$speaker->name}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-1" style="text-align: center;">
                        <i class="fas fa-plus-circle add-agenda" onclick="addAgenda();" style="font-size: 25px;color: #4e73df;line-height: 38px;"></i>
                        <i class="fas fa-minus-circle remove-agenda" onclick="removeAgenda(event);" style="font-size: 25px;color: #f32d2d;line-height: 38px; display: none;"></i>
                    </div>
                </div>`
            );

            let a = "{{$tour->id}}";
        }

        function removeAgenda(e) {
            $(e.currentTarget).parent().parent().remove();
        }
    </script>