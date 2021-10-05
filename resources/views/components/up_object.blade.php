<div class="modal fade" id="create_upload_object" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="fw-light">Create New Object File</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body">
                <div class="d-flex flex-column" style="flex-grow: 1;">
                    <div class="modal-body" style="flex: 0 1 0%;">
                        <nav class="nav_profile">
                            <a href="javascript:void(0)" class="active" id="btn_object_local" style="width: 50%;">
                                <div class="d-block d-sm-inline">Upload Local</div>
                            </a>
                            <a href="javascript:void(0)" id="btn_object_link" style="width: 50%;">
                                <div class="d-block d-sm-inline">Upload Link</div>
                            </a>
                        </nav>
                    </div>
                    <div class="">
                        <div class="form-step1 object__upload-box">
                            <div class="mb-3">
                                <div class="form_upload">
                                    <input type="file" style="display: none;">
                                    <button type="button" id="images-upload-btn" class="btn"><i class="fas fa-upload" style="font-size: 50px;"></i></button>
                                    <p>Drop your file here or Click to browse</p>
                                </div>
                                <div class="form_preview" style="display: none;">
                                    <img src="https://i.ytimg.com/vi/g3TYaM-p870/maxresdefault.jpg" style="border-radius: 5px;" alt="">
                                    <div class="remove_item_object">
                                        <button class="btn_remove ">Remove</button>
                                    </div>
                                </div>
                            </div>
                            <div class="mb-3">
                                <label class="small mb-1" for="">Name File</label>
                                <input class="form-control" id="" type="text" placeholder="Enter Name File">
                            </div>
                            <div class="mb-3">
                                <label class="small mb-1" for="">Description</label>
                                <textarea class="form-control" id="" rows="4" placeholder="Write a short description"></textarea>
                            </div>
                            <input type="hidden" name="type" value="">
                            <input type="hidden" name="type" value="local">
                            <div class="modal-footer" style="padding: 0.85rem 0px;">
                                <a class="btn btn-primary btn-block" href="">Save Upload</a>
                            </div>
                        </div>
                        <div class="form-step2 object__upload-box" style="display: none">
                            <div class="mb-3">
                                <div class="form_upload">
                                    <input class="form-control" type="text" placeholder="e.g. https://www.image.com/watch?v=9bZkp7q19f0">
                                </div>
                                <div class="form_preview" style="display: none;">
                                    <img src="https://i.ytimg.com/vi/g3TYaM-p870/maxresdefault.jpg" style="border-radius: 5px;" alt="">
                                    <div class="remove_item_object">
                                        <button class="btn_remove ">Remove</button>
                                    </div>
                                </div>
                            </div>
                            <div class="mb-3">
                                <label class="small mb-1" for="">Name File</label>
                                <input class="form-control" id="" type="text" placeholder="Enter Name File">
                            </div>
                            <div class="mb-3">
                                <label class="small mb-1" for="">Description</label>
                                <textarea class="form-control" id="" rows="4" placeholder="Write a short description"></textarea>
                            </div>
                            <input type="hidden" name="type" value="">
                            <input type="hidden" name="type" value="link">
                            <div class="modal-footer" style="padding: 0.85rem 0px;">
                                <a class="btn btn-primary btn-block" href="">Save Upload</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>