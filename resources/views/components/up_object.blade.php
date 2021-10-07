<div class="modal fade" id="popup-create-object" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
                            <a href="javascript:void(0)" class="active" id="switch-local-btn" style="width: 50%;">
                                <div class="d-block d-sm-inline">Upload Local</div>
                            </a>
                            <a href="javascript:void(0)" id="switch-link-btn" style="width: 50%;">
                                <div class="d-block d-sm-inline">Upload Link</div>
                            </a>
                        </nav>
                    </div>
                    <div>
                        <form class="form-step1 object__upload-box" action="/tours/{{$tour->id}}/objects/save-create" method="POST">
                            @csrf
                            <div class="mb-3">
                                <div class="form_upload">
                                    <input type="hidden" name="type">
                                    <input type="hidden" name="source" value="local">
                                    <input type="hidden" name="url">
                                    <input type="hidden" name="format">
                                    <input type="hidden" name="width">
                                    <input type="hidden" name="height">
                                    <input type="hidden" name="size">
                                    <input type="file" id="popup-create-object__local-file-hidden-input" style="display: none">
                                    <button type="button" id="popup-create-object__local-upload-btn" class="btn"><i class="fas fa-upload" style="font-size: 50px;"></i></button>
                                    <p>Drop your file here or Click to browse</p>
                                </div>
                                <div class="form_preview" style="display: none;">
                                    <img id="popup-create-object__local-preview-img" src="" style="border-radius: 5px; display: none" >
                                    <video id="popup-create-object__local-preview-video" controls src="" style="border-radius: 5px; display: none" ></video>
                                    <audio id="popup-create-object__local-preview-audio" controls src="" style="border-radius: 5px; display: none"></audio>
                                    <model-viewer id="popup-create-object__local-preview-model"  src="" ar ar-modes="webxr scene-viewer quick-look" environment-image="neutral" auto-rotate camera-controls style="border-radius: 5px; display: none"></model-viewer>
                                    <div class="remove_item_object">
                                        <div id="popup-create-object__local-remove-btn" class="btn_remove ">Remove</div>
                                    </div>
                                </div>
                            </div>
                            <div class="mb-3">
                                <label class="small mb-1" for="">Name</label>
                                <input class="form-control" id="popup-create-object__local-name-input" type="text" name="name" placeholder="Enter Name File">
                            </div>
                            <div class="mb-3">
                                <label class="small mb-1" for="">Description</label>
                                <textarea class="form-control" id="popup-create-object__local-description-input" name="description" rows="4" placeholder="Write a short description"></textarea>
                            </div>
                            
                            <div class="modal-footer"  style="padding: 0.85rem 0px;">
                                <button type="submit" id="popup-create-object__local-save-btn" class="btn btn-primary btn-block" disabled>Save Upload</button>
                            </div>
                        </form>
                        <form class="form-step2 object__upload-box" action="/tours/{{$tour->id}}/objects/save-create" method="POST"  style="display: none">
                            @csrf
                            <div class="mb-3">
                                <div class="form_upload">
                                    <input type="hidden" name="type">
                                    <input type="hidden" name="source" value="link">
                                    <input type="hidden" name="url">
                                    <input type="hidden" name="format">
                                    <input type="hidden" name="width">
                                    <input type="hidden" name="height">
                                    <input type="hidden" name="size">
                                    <input id="popup-create-object__link-url-input" class="form-control" type="text" placeholder="e.g. https://www.image.com/watch?v=9bZkp7q19f0">
                                </div>
                                <div class="form_preview" style="display: none;">
                                    <img id="popup-create-object__link-preview-img" src="" style="border-radius: 5px; display: none" >
                                    <video id="popup-create-object__link-preview-video" controls src="" style="border-radius: 5px; display: none" ></video>
                                    <audio id="popup-create-object__link-preview-audio" controls src="" style="border-radius: 5px; display: none"></audio>
                                    <model-viewer id="popup-create-object__link-preview-model" src="" ar ar-modes="webxr scene-viewer quick-look" environment-image="neutral" auto-rotate camera-controls style="border-radius: 5px; display: none"></model-viewer>
                                    <div class="remove_item_object">
                                        <div id="popup-create-object__link-remove-btn" class="btn_remove ">Remove</div>
                                    </div>
                                </div>
                            </div>
                            <div class="mb-3">
                                <label class="small mb-1" for="">Name</label>
                                <input class="form-control" name="name" id="popup-create-object__link-name-input" type="text" placeholder="Enter object's name ">
                            </div>
                            <div class="mb-3">
                                <label class="small mb-1" for="">Description</label>
                                <textarea class="form-control" name="description" id="popup-create-object__link-description-input" rows="4" placeholder="Write a description"></textarea>
                            </div>
                            <div class="modal-footer" style="padding: 0.85rem 0px;">
                                <button type="submit" id="popup-create-object__link-save-btn" class="btn btn-primary btn-block" disabled>Save Upload</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    $(document).ready(function () {

        // click button upload -> open explower files
        $('#popup-create-object__local-upload-btn').click(function (e) {  
            $('#popup-create-object__local-file-hidden-input').trigger('click');
        });

        $('#popup-create-object').on('hidden.bs.modal', function () {  
            closePopupCreateObject();
        });

        $('#switch-local-btn').click(function (e) { 
            closePopupCreateObject();
            $('#popup-create-object').find('.nav_profile > a').removeClass('active');
            $(this).addClass('active');
            $('#popup-create-object').find('.form-step1').show();
            $('#popup-create-object').find('.form-step2').hide();
        });

        $('#switch-link-btn').click(function (e) { 
            closePopupCreateObject();
            $('#popup-create-object').find('.nav_profile > a').removeClass('active');
            $(this).addClass('active');
            $('#popup-create-object').find('.form-step2').show();
            $('#popup-create-object').find('.form-step1').hide();          
        });

        $('#popup-create-object__local-file-hidden-input').change(function () { 
debugger;
            let type =$('#popup-create-object').find('input[name="type"]').val();
            let file = this.files[0];
            if(file != null){
                if(type=='image')
                {
                    $('#popup-create-object__local-preview-img').attr('src', URL.createObjectURL(this.files[0]));
                }
                else if(type=='video')
                {
                    $('#popup-create-object__local-preview-video').attr('src', URL.createObjectURL(this.files[0]));
                }
                else if(type=='audio')
                {
                    $('#popup-create-object__local-preview-audio').attr('src', URL.createObjectURL(this.files[0]));
                }
                else if(type=='model')
                {
                    $('#popup-create-object__local-preview-model').attr('src', URL.createObjectURL(this.files[0]));
                }
               
                $('#popup-create-object').find(".form_upload").hide();
                $('#popup-create-object').find(".form_preview").show();
                $('#popup-create-object__local-save-btn').prop('disabled', true);
                $('#popup-create-object__local-remove-btn').hide();
                
                let data = new FormData();
                data.append('file', file);
                let ajax = $.ajax({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    url: "{{env('APP_URL')}}/storage/upload",
                    method: 'post',
                    processData: false,
                    contentType: false,
                    data: data,
                    dataType: 'json',
                    success: function (res) { 
                        if (res != null) {
                            $('#popup-create-object').find('input[name="url"]').val(res.url);
                            $('#popup-create-object').find('input[name="format"]').val(res.format);
                            $('#popup-create-object').find('input[name="width"]').val(res.width);
                            $('#popup-create-object').find('input[name="height"]').val(res.height);
                            $('#popup-create-object').find('input[name="size"]').val(res.bytes);

                            $('#popup-create-object__local-save-btn').prop('disabled', false);
                            $('#popup-create-object__local-remove-btn').show();
                        }
                       
                    }
                });
            }
        });

        $('#popup-create-object__local-remove-btn').click(function (e) { 
            $('#popup-create-object__local-preview-img').attr('src', null);
            $('#popup-create-object__local-preview-video').attr('src', null);
            $('#popup-create-object__local-preview-audio').attr('src', null);
            $('#popup-create-object').find(".form_upload").show();
            $('#popup-create-object').find(".form_preview").hide();
            $('#popup-create-object__local-save-btn').prop('disabled', true);
            $('#popup-create-object__local-remove-btn').hide();
            $('#popup-create-object__local-file-hidden-input').val(null);
            $('#popup-create-object').find('input[name="url"]').val(null);

        });

        $('#popup-create-object__link-url-input').change( async function () { 
            let type =$('#popup-create-object').find('input[name="type"]').val();
            let url = $(this).val();
            let correct = false;
            if(url != null && url != ""){
                let file = await fetch(url).then(function(response) {
                    if (response.ok)  correct = true;
                    return response;
                });

                if(correct){
                    if(type=='image')
                    {
                        $('#popup-create-object__link-preview-img').attr('src', URL.createObjectURL(this.files[0]));
                    }
                    else if(type=='video')
                    {
                        $('#popup-create-object__link-preview-video').attr('src', URL.createObjectURL(this.files[0]));
                    }
                    else if(type=='audio')
                    {
                        $('#popup-create-object__link-preview-audio').attr('src', URL.createObjectURL(this.files[0]));
                    }
                    $('#popup-create-object').find(".form_upload").hide();
                    $('#popup-create-object').find(".form_preview").show();
                    $('#popup-create-object__link-save-btn').prop('disabled', false);
                    $('#popup-create-object__link-remove-btn').show();

                    let img = document.getElementById('popup-create-object__link-preview-img');
                    
                    $('#popup-create-object').find('input[name="url"]').val(img.src);
                    $('#popup-create-object').find('input[name="format"]').val(img.src.split('.').pop());
                    $('#popup-create-object').find('input[name="width"]').val(img.naturalWidth);
                    $('#popup-create-object').find('input[name="height"]').val(img.naturalHeight);
                    $('#popup-create-object').find('input[name="size"]').val(file.size);

                    $('#popup-create-object__link-save-btn').prop('disabled', false);
                    $('#popup-create-object__link-remove-btn').show();

                    return;
                }
            }

            $('#popup-create-object__link-save-btn').prop('disabled', true);
        });

        $('#popup-create-object__link-remove-btn').click(function (e) { 
            $('#popup-create-object__link-preview-img').attr('src', null);
            $('#popup-create-object__link-preview-video').attr('src', null);
            $('#popup-create-object__link-preview-audio').attr('src', null);
            $('#popup-create-object').find(".form_upload").show();
            $('#popup-create-object').find(".form_preview").hide();
            $('#popup-create-object__link-save-btn').prop('disabled', true);
            $('#popup-create-object__link-remove-btn').hide();
            $('#popup-create-object__link-file-hidden-input').val(null);
            $('#popup-create-object').find('input[name="url"]').val(null);

        });
    });
</script>

<script>
    function openPopupCreateObject(type) {   
        if(type == 'image'){
            $('#popup-create-object__link-preview-img').show();
            $('#popup-create-object__link-preview-video').hide();
            $('#popup-create-object__link-preview-audio').hide();
            $('#popup-create-object__local-preview-img').show();
            $('#popup-create-object__local-preview-video').hide();
            $('#popup-create-object__local-preview-audio').hide();
            $('#popup-create-object__local-preview-model').hide();
            $('#popup-create-object__link-preview-model').hide();
        }
        else if(type == 'video'){
            $('#popup-create-object__link-preview-img').hide();
            $('#popup-create-object__link-preview-video').show();
            $('#popup-create-object__link-preview-audio').hide();
            $('#popup-create-object__local-preview-img').hide();
            $('#popup-create-object__local-preview-video').show();
            $('#popup-create-object__local-preview-audio').hide();
            $('#popup-create-object__local-preview-model').hide();
            $('#popup-create-object__link-preview-model').hide();
        } 
        else if(type == 'audio'){
            $('#popup-create-object__link-preview-img').hide();
            $('#popup-create-object__link-preview-video').hide();
            $('#popup-create-object__link-preview-audio').show();
            $('#popup-create-object__local-preview-img').hide();
            $('#popup-create-object__local-preview-video').hide();
            $('#popup-create-object__local-preview-audio').show();
            $('#popup-create-object__local-preview-model').hide();
            $('#popup-create-object__link-preview-model').hide();
        }
        else if(type == 'model'){
            $('#popup-create-object__link-preview-img').hide();
            $('#popup-create-object__link-preview-video').hide();
            $('#popup-create-object__link-preview-audio').hide();
            $('#popup-create-object__local-preview-img').hide();
            $('#popup-create-object__local-preview-video').hide();
            $('#popup-create-object__local-preview-audio').hide();
            $('#popup-create-object__local-preview-model').show();
            $('#popup-create-object__link-preview-model').show();
        }
        $('#popup-create-object').find('input[name="type"]').val(type);
        $('#popup-create-object').modal('show');
    }

    function closePopupCreateObject() { 
        $('#popup-create-object').find('img').attr('src', null);
        $('#popup-create-object').find('input').not('input[name="_token"]').not('input[name="type"]').val(null);
        $('#popup-create-object').find('textarea').val(null);
        $('#popup-create-object').find(".form_upload").show();
        $('#popup-create-object').find(".form_preview").hide();
        $('#popup-create-object__local-save-btn').prop('disabled', true);
        $('#popup-create-object__link-save-btn').prop('disabled', true);

        $('#popup-create-object').find('.nav_profile > a').removeClass('active');
        $(this).addClass('active');
        $('#popup-create-object').find('.form-step1').show();
        $('#popup-create-object').find('.form-step2').hide();
    }
</script>
