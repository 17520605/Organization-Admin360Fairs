<div class="modal fade" id="popup-create-booth-object" tabindex="-1" role="dialog" data-backdrop="static" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="fw-light">Create New Object File</h5>
               <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="d-flex flex-column" style="flex-grow: 1;">
                    <div class="modal-body" style="flex: 0 1 0%;">
                        <nav class="nav_profile">
                            <a href="javascript:void(0)" class="active" id="switch-local-booth-btn" style="width: 50%;">
                                <div class="d-block d-sm-inline">Upload Local</div>
                            </a>
                            <a href="javascript:void(0)" id="switch-link-booth-btn" style="width: 50%;">
                                <div class="d-block d-sm-inline">Upload Link</div>
                            </a>
                        </nav>
                    </div>
                    <div>
                        <form class="form-step1 object__upload-box" action="/administrator/tours/{{$tour->id}}/objects/save-create" method="POST">
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
                                    <input type="file" id="popup-create-booth-object__local-file-hidden-input" style="display: none">
                                    <button type="button" id="popup-create-booth-object__local-upload-btn" class="btn"><i class="fas fa-upload" style="font-size: 50px;"></i></button>
                                    <p>Drop your file here or Click to browse</p>
                                </div>
                                <div class="form_preview" style="display: none;">
                                    <img id="popup-create-booth-object__local-preview-img" src="" style="border-radius: 5px; display: none" >
                                    <video id="popup-create-booth-object__local-preview-video" controls src="" style="border-radius: 5px; display: none" ></video>
                                    <audio id="popup-create-booth-object__local-preview-audio" controls src="" style="border-radius: 5px; display: none"></audio>
                                    <model-viewer id="popup-create-booth-object__local-preview-model"  src="" ar ar-modes="webxr scene-viewer quick-look" environment-image="neutral" auto-rotate camera-controls style="border-radius: 5px; display: none"></model-viewer>
                                    <div id="popup-create-booth-object__local-preview-document" style="border-radius: 5px; display: none ;color: #2B5796; text-align: center; font-size: 150px;" ><i class="fas fa-file-alt"></i></div>
                                    <div class="remove_item_object">
                                        <div id="popup-create-booth-object__local-remove-btn" class="btn_remove ">Remove</div>
                                    </div>
                                </div>
                            </div>
                            <div class="mb-3">
                                <label class="small mb-1" for="">Name</label>
                                <input class="form-control" id="popup-create-booth-object__local-name-input" type="text" name="name" placeholder="Enter Name File">
                            </div>
                            <div class="mb-3">
                                <label class="small mb-1" for="">Description</label>
                                <textarea class="form-control" id="popup-create-booth-object__local-description-input" name="description" rows="4" placeholder="Write a short description"></textarea>
                            </div>
                            
                            <div class="modal-footer"  style="padding: 0.85rem 0px;">
                                <button type="submit" id="popup-create-booth-object__local-save-btn" class="btn btn-primary btn-block btn-icon-loader" disabled><span class="icon-loader-form"></span> Save Upload</button>
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
                                    <input id="popup-create-booth-object__link-url-input" class="form-control" type="text" placeholder="e.g. https://www.image.com/watch?v=9bZkp7q19f0">
                                </div>
                                <div class="form_preview" style="display: none;">
                                    <img id="popup-create-booth-object__link-preview-img" src="" style="border-radius: 5px; display: none" >
                                    <video id="popup-create-booth-object__link-preview-video" controls src="" style="border-radius: 5px; display: none" ></video> 
                                    <iframe id="popup-create-booth-object__link-preview-video-ytb" style="display: none" width="100%" height="400px" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                                    <audio id="popup-create-booth-object__link-preview-audio" controls src="" style="border-radius: 5px; display: none"></audio>
                                    <model-viewer id="popup-create-booth-object__link-preview-model" src="" ar ar-modes="webxr scene-viewer quick-look" environment-image="neutral" auto-rotate camera-controls style="border-radius: 5px; display: none"></model-viewer>
                                    <div id="popup-create-booth-object__link-preview-document" style="border-radius: 5px; display: none ;color: #2B5796; text-align: center; font-size: 150px;" ><i class="fas fa-file-alt"></i></div>
                                    <div class="remove_item_object">
                                    <div id="popup-create-booth-object__link-remove-btn" class="btn_remove ">Remove</div>
                                    </div>
                                </div>
                            </div>
                            <div class="mb-3">
                                <label class="small mb-1" for="">Name</label>
                                <input class="form-control" name="name" id="popup-create-booth-object__link-name-input" type="text" placeholder="Enter object's name ">
                            </div>
                            <div class="mb-3">
                                <label class="small mb-1" for="">Description</label>
                                <textarea class="form-control" name="description" id="popup-create-booth-object__link-description-input" rows="4" placeholder="Write a description"></textarea>
                            </div>
                            <div class="modal-footer" style="padding: 0.85rem 0px;">
                                <button type="submit" id="popup-create-booth-object__link-save-btn" class="btn btn-primary btn-block btn-icon-loader" disabled><span class="icon-loader-form"></span> Save Upload</button>
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
        $('#popup-create-booth-object__local-upload-btn').click(function (e) {  
            $('#popup-create-booth-object__local-file-hidden-input').trigger('click');
        });

        $('#popup-create-booth-object').on('hidden.bs.modal', function () {  
            closePopupCreateBoothObject();
        });

        $('#switch-local-booth-btn').click(function (e) { 
            closePopupCreateBoothObject();
            $('#popup-create-booth-object').find('.nav_profile > a').removeClass('active');
            $(this).addClass('active');
            $('#popup-create-booth-object').find('.form-step1').show();
            $('#popup-create-booth-object').find('.form-step2').hide();
        });

        $('#switch-link-booth-btn').click(function (e) { 
            closePopupCreateBoothObject();
            $('#popup-create-booth-object').find('.nav_profile > a').removeClass('active');
            $(this).addClass('active');
            $('#popup-create-booth-object').find('.form-step2').show();
            $('#popup-create-booth-object').find('.form-step1').hide();          
        });

        $('#popup-create-booth-object__local-file-hidden-input').change(function () {
            
            let file = this.files[0];
            if(file != null){
                $('#popup-create-booth-object').find(".form_upload").hide();
                $('#popup-create-booth-object').find(".form_preview").show();
                $('#popup-create-booth-object__local-save-btn').prop('disabled', true);
                $('#popup-create-booth-object__local-remove-btn').hide();
                
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
                            $('#popup-create-booth-object').find('input[name="url"]').val(res.url);
                            $('#popup-create-booth-object').find('input[name="format"]').val(res.format);
                            $('#popup-create-booth-object').find('input[name="width"]').val(res.width);
                            $('#popup-create-booth-object').find('input[name="height"]').val(res.height);
                            $('#popup-create-booth-object').find('input[name="size"]').val(res.bytes);

                            $('#popup-create-booth-object__local-save-btn').prop('disabled', false);
                            $('#popup-create-booth-object__local-remove-btn').show();

                            let formats = $('#popup-create-booth-object').find('input[name="format"]').val();
                            if(formats=='jpeg' || formats=='png' || formats=='jpg' || formats=='gif' || formats=='TIFF' || formats=='svg')
                            {
                                $('#popup-create-booth-object').find('input[name="type"]').val('image');
                                $('#popup-create-booth-object__link-preview-img').show();
                                $('#popup-create-booth-object__link-preview-video').hide();
                                $('#popup-create-booth-object__link-preview-audio').hide();
                                $('#popup-create-booth-object__local-preview-img').show();
                                $('#popup-create-booth-object__local-preview-video').hide();
                                $('#popup-create-booth-object__local-preview-audio').hide();
                                $('#popup-create-booth-object__local-preview-model').hide();
                                $('#popup-create-booth-object__link-preview-model').hide();
                                $('#popup-create-booth-object__local-preview-document').hide();
                                $('#popup-create-booth-object__link-preview-document').hide();
                            }
                            else if(formats=='WMV'|| formats=='MOV'|| formats=='MP4'|| formats=='AVI' )
                            {
                                $('#popup-create-booth-object').find('input[name="type"]').val('video');
                                $('#popup-create-booth-object__link-preview-img').hide();
                                $('#popup-create-booth-object__link-preview-video').show();
                                $('#popup-create-booth-object__link-preview-audio').hide();
                                $('#popup-create-booth-object__local-preview-img').hide();
                                $('#popup-create-booth-object__local-preview-video').show();
                                $('#popup-create-booth-object__local-preview-audio').hide();
                                $('#popup-create-booth-object__local-preview-model').hide();
                                $('#popup-create-booth-object__link-preview-model').hide();
                                $('#popup-create-booth-object__local-preview-document').hide();
                                $('#popup-create-booth-object__link-preview-document').hide();
                            }
                            else if(formats=='MP3' || formats=='WMA'|| formats=='WAV' || formats=='AAC')
                            {
                                $('#popup-create-booth-object').find('input[name="type"]').val('audio');
                                $('#popup-create-booth-object__link-preview-img').hide();
                                $('#popup-create-booth-object__link-preview-video').hide();
                                $('#popup-create-booth-object__link-preview-audio').show();
                                $('#popup-create-booth-object__local-preview-img').hide();
                                $('#popup-create-booth-object__local-preview-video').hide();
                                $('#popup-create-booth-object__local-preview-audio').show();
                                $('#popup-create-booth-object__local-preview-model').hide();
                                $('#popup-create-booth-object__link-preview-model').hide();
                                $('#popup-create-booth-object__local-preview-document').hide();
                                $('#popup-create-booth-object__link-preview-document').hide();
                            }
                            else if( formats=='GLB'|| formats=='OBJ' )
                            {
                                $('#popup-create-booth-object').find('input[name="type"]').val('model');
                                $('#popup-create-booth-object__link-preview-img').hide();
                                $('#popup-create-booth-object__link-preview-video').hide();
                                $('#popup-create-booth-object__link-preview-audio').hide();
                                $('#popup-create-booth-object__local-preview-img').hide();
                                $('#popup-create-booth-object__local-preview-video').hide();
                                $('#popup-create-booth-object__local-preview-audio').hide();
                                $('#popup-create-booth-object__local-preview-model').show();
                                $('#popup-create-booth-object__link-preview-model').show();
                                $('#popup-create-booth-object__local-preview-document').hide();
                                $('#popup-create-booth-object__link-preview-document').hide();
                            }
                            else if(formats=='PPT'|| formats=='PPTX'|| formats=='PDF'|| formats=='doc' || formats=='docx' )
                            {
                                $('#popup-create-booth-object').find('input[name="type"]').val('document');
                                $('#popup-create-booth-object__link-preview-img').hide();
                                $('#popup-create-booth-object__link-preview-video').hide();
                                $('#popup-create-booth-object__link-preview-audio').hide();
                                $('#popup-create-booth-object__local-preview-img').hide();
                                $('#popup-create-booth-object__local-preview-video').hide();
                                $('#popup-create-booth-object__local-preview-audio').hide();
                                $('#popup-create-booth-object__local-preview-model').hide();
                                $('#popup-create-booth-object__link-preview-model').hide();
                                $('#popup-create-booth-object__local-preview-document').show();
                                $('#popup-create-booth-object__link-preview-document').show();
                            }

                            let type =$('#popup-create-booth-object').find('input[name="type"]').val(); 
                            if(type=='image')
                            {
                                $('#popup-create-booth-object__local-preview-img').attr('src', res.url);
                            }
                            else if(type=='video')
                            {
                                $('#popup-create-booth-object__local-preview-video').attr('src', res.url);
                            }
                            else if(type=='audio')
                            {
                                $('#popup-create-booth-object__local-preview-audio').attr('src', res.url);
                            }
                            else if(type=='model')
                            {
                                $('#popup-create-booth-object__local-preview-model').attr('src', res.url);
                            }
                            else if(type=='document')
                            {
                                $('#popup-create-booth-object__local-preview-document').attr('src', res.url);
                            }
                        }
                       
                    }
                });
            }
        });

        
        $('#popup-create-booth-object__local-remove-btn').click(function (e) { 
            $('#popup-create-booth-object__local-preview-img').attr('src', null);
            $('#popup-create-booth-object__local-preview-video').attr('src', null);
            $('#popup-create-booth-object__local-preview-audio').attr('src', null);
            $('#popup-create-booth-object').find(".form_upload").show();
            $('#popup-create-booth-object').find(".form_preview").hide();
            $('#popup-create-booth-object__local-save-btn').prop('disabled', true);
            $('#popup-create-booth-object__local-remove-btn').hide();
            $('#popup-create-booth-object__local-file-hidden-input').val(null);
            $('#popup-create-booth-object').find('input[name="url"]').val(null);

        });

        $('#popup-create-booth-object__link-url-input').change( async function () { 

            let type =$('#popup-create-booth-object').find('input[name="type"]').val();

            let url = $(this).val();
            let slipt = url.split(".")[0];
            let correct = false;
            if( slipt == "https://youtu"){
                $('#popup-create-booth-object__link-preview-video-ytb').show();
                $('#popup-create-booth-object__link-preview-video').hide();
                if(type=='video')
                {
                    let link_ytb= url.replace("https://youtu.be/", "https://www.youtube.com/embed/");
                    $('#popup-create-booth-object__link-preview-video-ytb').attr('src', link_ytb);
                    $('#popup-create-booth-object').find('input[name="url"]').val(link_ytb);
                    $('#popup-create-booth-object').find('input[name="source"]').val('youtube');
                    $('#popup-create-booth-object').find('input[name="format"]').val('youtube');
                }
                $('#popup-create-booth-object').find(".form_upload").hide();
                $('#popup-create-booth-object').find(".form_preview").show();
                $('#popup-create-booth-object__link-save-btn').prop('disabled', false);
                $('#popup-create-booth-object__link-remove-btn').show();

                $('#popup-create-booth-object__link-save-btn').prop('disabled', false);
                $('#popup-create-booth-object__link-remove-btn').show();
                $('#popup-create-booth-object__link-name-input').change(function(){
                    let val =$('#popup-create-booth-object__link-name-input').val();
                    if(url != null && url != ""){
                        $('#popup-create-booth-object__link-save-btn').prop('disabled', false);
                    }
                });
            }
            else {
                $('#popup-create-booth-object__link-preview-video-ytb').hide();
                $('#popup-create-booth-object__link-preview-video').show();
                if(url != null && url != ""){
                    let blob = await fetch(url).then(function(response) {
                        if (response.ok)  correct = true;
                        return response.blob();
                    });
                    if(correct){
                        if(type=='image' && blob.type.split("/")[0] == 'image')
                        { 
                            $('#popup-create-booth-object__link-preview-img').attr('src', url );
                            let img = document.getElementById('popup-create-booth-object__link-preview-img');
                            $('#popup-create-booth-object').find('input[name="url"]').val(img.src);
                            $('#popup-create-booth-object').find('input[name="format"]').val(blob.type.split("/")[1]);
                            $('#popup-create-booth-object').find('input[name="width"]').val(img.naturalWidth);
                            $('#popup-create-booth-object').find('input[name="height"]').val(img.naturalHeight);
                            $('#popup-create-booth-object').find('input[name="size"]').val(blob.size);
                        }
                        else if(type=='video' && blob.type.split("/")[0] == 'video')
                        {
                            $('#popup-create-booth-object__link-preview-video').attr('src', url);
                            let video = document.getElementById('popup-create-booth-object__link-preview-video');
                            $('#popup-create-booth-object').find('input[name="url"]').val(video.src);
                            $('#popup-create-booth-object').find('input[name="format"]').val(blob.type.split("/")[1]);
                            $('#popup-create-booth-object').find('input[name="width"]').val(video.naturalWidth);
                            $('#popup-create-booth-object').find('input[name="height"]').val(video.naturalHeight);
                            $('#popup-create-booth-object').find('input[name="size"]').val(0);
                        }
                        else if(type=='audio' && blob.type.split("/")[0] == 'audio')
                        {
                            $('#popup-create-booth-object__link-preview-audio').attr('src', url);
                            let audio = document.getElementById('popup-create-booth-object__link-preview-audio');
                            $('#popup-create-booth-object').find('input[name="url"]').val(audio.src);
                            $('#popup-create-booth-object').find('input[name="format"]').val(blob.type.split("/")[1]);
                            $('#popup-create-booth-object').find('input[name="width"]').val(audio.naturalWidth);
                            $('#popup-create-booth-object').find('input[name="height"]').val(audio.naturalHeight);
                            $('#popup-create-booth-object').find('input[name="size"]').val(0);
                        }
                        else if(type=='model' && blob.type.split("/")[0] == 'model')
                        {
                            $('#popup-create-booth-object__link-preview-model').attr('src', url);
                            let model = document.getElementById('popup-create-booth-object__link-preview-model');
                            $('#popup-create-booth-object').find('input[name="url"]').val(model.src);
                            $('#popup-create-booth-object').find('input[name="format"]').val(blob.type.split("/")[1]);
                            $('#popup-create-booth-object').find('input[name="width"]').val(model.naturalWidth);
                            $('#popup-create-booth-object').find('input[name="height"]').val(model.naturalHeight);
                            $('#popup-create-booth-object').find('input[name="size"]').val(0);
                        }
                        else{
                            alert("SAI FORMAT FILE");
                            return;
                        }
                    }
                    else{
                        alert("LINK KHONG DUNG");
                        return;
                    }
                    $('#popup-create-booth-object').find(".form_upload").hide();
                    $('#popup-create-booth-object').find(".form_preview").show();
                    $('#popup-create-booth-object__link-save-btn').prop('disabled', false);
                    $('#popup-create-booth-object__link-remove-btn').show();

                    $('#popup-create-booth-object__link-save-btn').prop('disabled', false);
                    $('#popup-create-booth-object__link-remove-btn').show();
                    $('#popup-create-booth-object__link-name-input').change(function(){
                        let val =$('#popup-create-booth-object__link-name-input').val();
                        if(url != null && url != ""){
                            $('#popup-create-booth-object__link-save-btn').prop('disabled', false);
                        }
                    });
                }
            }
            

            $('#popup-create-booth-object__link-save-btn').prop('disabled', true);
        });

        $('#popup-create-booth-object__link-remove-btn').click(function (e) { 
            $('#popup-create-booth-object__link-preview-img').attr('src', null);
            $('#popup-create-booth-object__link-preview-video').attr('src', null);
            $('#popup-create-booth-object__link-preview-audio').attr('src', null);
            $('#popup-create-booth-object').find(".form_upload").show();
            $('#popup-create-booth-object').find(".form_preview").hide();
            $('#popup-create-booth-object__link-save-btn').prop('disabled', true);
            $('#popup-create-booth-object__link-remove-btn').hide();
            $('#popup-create-booth-object__link-file-hidden-input').val(null);
            $('#popup-create-booth-object').find('input[name="url"]').val(null);

        });
    });
</script>

<script>
    function openPopupCreateBoothObject() {   
        $('#popup-create-booth-object').modal('show');
    }

    function closePopupCreateBoothObject() { 
        $('#popup-create-booth-object').find('img').attr('src', null);
        $('#popup-create-booth-object').find('input').not('input[name="_token"]').not('input[name="type"]').not('input[name="source"]').val(null);
        $('#popup-create-booth-object').find('textarea').val(null);
        $('#popup-create-booth-object').find(".form_upload").show();
        $('#popup-create-booth-object').find(".form_preview").hide();
        $('#popup-create-booth-object__local-save-btn').prop('disabled', true);
        $('#popup-create-booth-object__link-save-btn').prop('disabled', true);

        $('#popup-create-booth-object').find('.nav_profile > a').removeClass('active');
        $(this).addClass('active');
        $('#popup-create-booth-object').find('.form-step1').show();
        $('#popup-create-booth-object').find('.form-step2').hide();
    }
</script>
