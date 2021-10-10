    <div class="modal fade" id="popup-create-events" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="fw-light">Create New Event</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                </div>
                <div class="modal-body">
                    <form>
                        <div class="mb-3">
                            <label class="small mb-1" for="">Webinar Name (Topic)</label>
                            <input class="form-control" id="" type="text" placeholder="Enter email address">
                        </div>
                        <div class="row gx-3 mb-3">
                            <div class="col-md-6">
                                <label class="small mb-1" for="inputFirstName">Start time</label>
                                <input class="form-control" id="inputFirstName" type="datetime-local">
                            </div>
                            <div class="col-md-6">
                                <label class="small mb-1" for="inputLastName">End time</label>
                                <input class="form-control" id="inputLastName" type="datetime-local">
                            </div>
                        </div>
                        <label class="small mb-1" for="">Spearker (mutiple)</label>
                        <div class="row gx-3 mb-3">
                            <div class="col-md-6">
                                <input class="form-control" id="" type="text" placeholder="Enter Type tour">
                            </div>
                            <div class="col-md-1" style="padding: 0;">
                                <input class="form-control" id="" type="number" min="0" max="500" style="padding-right: 0!important;" placeholder="Time">
                            </div>
                            <div class="col-md-4" style="padding-right:0px ;">
                                <select class="form-control" name="" id="">
                                    <option value="">-Choose speaker-</option>
                                    <option value="volvo">Nguyễn Khai</option>
                                    <option value="saab">Ngọc Khải</option>
                                </select>
                            </div>
                            <div class="col-md-1" style="text-align: center;">
                                <i class="fas fa-plus-circle add-agenda" onclick="addAgenda();" style="font-size: 25px;color: #4e73df;line-height: 38px;"></i>
                                <i class="fas fa-minus-circle remove-agenda" onclick="removeAgenda(event);" style="font-size: 25px;color: #f32d2d;line-height: 38px; display: none;"></i>
                            </div>
                        </div>
                        <div id="add-new-input">

                        </div>
                        <div class="mb-3">
                            <label class="small mb-1" for="inputUsername">Tour Description</label>
                            <textarea placeholder="Enter your tour description" class="form-control" name="" id="" rows="6"></textarea>
                        </div>
                        <!-- Form Group (create account submit)-->
                        <a class="btn btn-primary btn-block" href="">Create New Tour</a>
                    </form>
                </div>
            </div>
        </div>
    </div>