@extends('layouts.resume')
@section('content')
    <div class="container card-tour">
        <div class="tour-mg-top" style="margin-top: 3%">
            <div class="card" style="background: radial-gradient(circle, rgba(47,87,203,1) 50%, rgba(78,115,223,1) 100%);">
                <div class="card-body profile-user-box">
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="row align-items-center">
                                <div class="col-auto">
                                    <div class="avatar-lg">
                                        @if ($profile->avatar != null || $profile->avatar !='')
                                            <img style="width: 150px; height: 150px; border: 2px" src="{{$profile->avatar}}" alt="" class="rounded-circle img-thumbnail">
                                        @else
                                            <img style="width: 150px; height: 150px; border: 2px" src="https://res.cloudinary.com/virtual-tour/image/upload/v1634823839/icons/default_avatar_jeqa4w.png" alt="" class="rounded-circle img-thumbnail">
                                        @endif
                                    </div>
                                </div>
                                <div class="col">
                                    <div>
                                        <h4 class="mt-1 text-white font-weight-bold" style="margin-bottom: 15px">{{$profile->name != null ? $profile->name : 'N/A'}}</h4>
                                        <h6 class="font-13 text-white-50"><i class="fas fa-envelope" style="margin-right: 5px"></i><span> {{$profile->email != null ? $profile->email : 'N/A'}}</span></h6>
                                        <h6 class="font-13 text-white-50"><i class="fas fa-phone-alt" style="margin-right: 5px"></i><span> {{$profile->contact != null ? $profile->contact : 'N/A'}}</span></h6>
                                        <h6 class="font-13 text-white-50" style="overflow: hidden;text-overflow: ellipsis;white-space: nowrap;"><i class="fas fa-map-marker-alt" style="margin-right: 9px"></i><span> {{$profile->address != null ? $profile->address : 'N/A'}}</span></h6>
                                        <h6 class="font-13 text-white-50"><i class="fab fa-black-tie" style="margin-right: 7px"></i></i><span> {{$profile->type != null ? $profile->type : 'N/A'}}</span></h6>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row mt-4 icon-social-network"  style="text-align: center ; width: 60%; margin-left: 20%" >
                <div class="col-sm">
                   <a href="{{$profile->facebook}}" target="_blank" class="fab fa-facebook-f" style="background: #3f51b5!important"></a>
                </div>
                <div class="col-sm">
                    <a href="#" target="_blank" class="fab fa-twitter" style="background: #2196F3!important"></a>
                </div>
                <div class="col-sm">
                    <a href="{{$profile->email}}" target="_blank" class="fab fa-google-plus-g" style="background: #F44336!important"></a>
                </div>
                <div class="col-sm">
                    <a href="#" class="fab fa-invision" target="_blank" style="background: #1565C0!important"></a>
                </div>
                <div class="col-sm">
                    <a href="{{$profile->website}}" target="_blank" class="fab fa-internet-explorer" style="background: #2196F3!important"></a>
                </div>
                <div class="col-sm">
                    <a href="{{$profile->youtube}}" target="_blank" class="fab fa-youtube" style="background: #b61c11!important"></a>
                </div>
            </div>
            <div class="row mt-4 mb-5" id="box-cv-up">
                <div class="col-12" id="preview-box-cv"> 
                    <button class="btn btn-download-cv" data-href='{{$profile->profile}}' download="resume.jpg" onclick='forceDownload(this)'><i class="fas fa-download"></i></button>
                    <img id="preview-box-cv-img" style="width: 100%; border-radius: 5px;" src="{{$profile->profile == '' ? '':$profile->profile}}" alt="">
                </div>
            </div>
        </div>
    </div>
    <script src="add-download-btn.js"></script>
<script>
function forceDownload(link) {
   var url = link.getAttribute("data-href");
   var fileName = link.getAttribute("download");
   link.innerText = "Working...";
   var xhr = new XMLHttpRequest();
   xhr.open("GET", url, true);
   xhr.responseType = "blob";
   xhr.onload = function() {
      var urlCreator = window.URL || window.webkitURL;
      var imageUrl = urlCreator.createObjectURL(this.response);
      var tag = document.createElement('a');
      tag.href = imageUrl;
      tag.download = fileName;
      document.body.appendChild(tag);
      tag.click();
      document.body.removeChild(tag);
      link.innerText = "Download Resume";
   }
   xhr.send();
}
</script>

@endsection

