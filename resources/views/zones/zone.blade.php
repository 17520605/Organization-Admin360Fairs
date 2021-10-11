<div class="col-sm-12" style="margin-bottom: 10px">
    @extends('layouts.master')

    @section('content')
        <div class="container-fluid" style="margin-bottom: 3rem;">
            <div class="row mb-3">
                <div class="col-md-12">
                    <div class="card p-3">
                        <h1 class="h4 text-gray-800">{{ $zone->name }}</h1>
                    </div>
                </div>
            </div>
            <div class="row" style="margin-bottom: 1.5rem;">
                <div class="col-md-5">
                    <div class="card" style="height: 300px;">
                        <div class="card-body" style="color: #555; font-size: 14px;">
                            <div class="d-flex mb-2">
                                <div class="flex-grow-1 overflow-hidden">
                                    <h5 class="text-truncate font-size-15">New admin Design</h5>
                                    <p class="text-muted">It will be as simple as Occidental</p>
                                </div>
                            </div>
                            <h5 class="font-size-15 mt-4">Project Details :</h5>
                            <p class="text-muted">
                                To an English person, it will seem like simplified English, as a skeptical Cambridge friend
                                of mine told me what Occidental is. The European languages are members of the same family.
                                Their separate existence is a myth. For science, music, sport, etc,
                            </p>
                        </div>
                    </div>
                </div>
                <div class="col-md-7">
                    <div class="card" style="width: 100%; height: 300px;padding: 20px;">
                        <div id="viewer-container" style="width: 100%; height: 100%;"></div>
                    </div>
                </div>
            </div>
            <div class="row" style="margin-bottom: 1.5rem;">
                <div class="col-md-4">
                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-12">
                                    <h6 class="text-gray-600">Types :</h6>
                                </div>
                            </div> 
                            <div class="row">
                                <div class="col-sm-12" style="margin-bottom: 10px">
                                    <div class="card">
                                        <div class="card-body" style="padding: 10px;">
                                            <div class="row">
                                                <div class="col-2">
                                                    <div class="avatar-title bg-transparent rounded"><i
                                                            class="fas fa-folder"
                                                            style="font-size:20px ;color: rgba(241,180,76,1)!important;"></i>
                                                    </div>
                                                </div>
                                                <div class="col-3">
                                                    <p class="font-size-14 text-truncate mb-0"><a class="text-body" href="/apps-filemanager">All</a></p>
                                                </div>
                                                <div class="col-4">
                                                    <p class="text-muted text-truncate mb-0">{{ $types->sum('count')}} Files</p>
                                                </div>
                                                <div class="col-3">
                                                    <p class="text-muted text-truncate mb-0">{{ number_format(floatval($types->sum('size'))/1048576, 1) }} MB</p>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row" style="padding: 0 5px 5px 5px;">
                                            <div class="col-12">
                                                <div style="border: 1px rgb(177, 177, 177) solid; border-radius:20px;">
                                                    <div style="width: 70%; height: 3px; background-color: rgb(84, 255, 84)"
                                                        ></div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-12" style="margin-bottom: 10px">
                                    <div class="card">
                                        <div class="card-body" style="padding: 10px;">
                                            <div class="row">
                                                <div class="col-2">
                                                    <div class="avatar-title bg-transparent rounded"><i
                                                            class="fas fa-folder"
                                                            style="font-size:20px ;color: rgba(241,180,76,1)!important;"></i>
                                                    </div>
                                                </div>
                                                <div class="col-3">
                                                    <p class="font-size-14 text-truncate mb-0"><a class="text-body" href="/apps-filemanager">Images</a></p>
                                                </div>
                                                <div class="col-4">
                                                    <p class="text-muted text-truncate mb-0">{{ $types->where('type', 'image')->first() != null ?$types->where('type', 'image')->first()->count : 0 }} Files</p>
                                                </div>
                                                <div class="col-3">
                                                    <p class="text-muted text-truncate mb-0">{{ $types->where('type', 'image')->first() != null ? number_format(floatval($types->where('type', 'image')->first()->size)/1048576, 1) : 0 }} MB</p>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row" style="padding: 0 5px 5px 5px;">
                                            <div class="col-12">
                                                <div style="border: 1px rgb(177, 177, 177) solid; border-radius:20px;">
                                                    <div style="width: 70%; height: 3px; background-color: rgb(84, 255, 84)"
                                                        ></div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-12" style="margin-bottom: 10px">
                                    <div class="card">
                                        <div class="card-body" style="padding: 10px;">
                                            <div class="row">
                                                <div class="col-2">
                                                    <div class="avatar-title bg-transparent rounded"><i
                                                            class="fas fa-folder"
                                                            style="font-size:20px ;color: rgba(241,180,76,1)!important;"></i>
                                                    </div>
                                                </div>
                                                <div class="col-3">
                                                    <p class="font-size-14 text-truncate mb-0"><a class="text-body" href="/apps-filemanager">Videos</a></p>
                                                </div>
                                                <div class="col-4">
                                                    <p class="text-muted text-truncate mb-0">{{ $types->where('type', 'video')->first() != null ?$types->where('type', 'video')->first()->count : 0 }} Files</p>
                                                </div>
                                                <div class="col-3">
                                                    <p class="text-muted text-truncate mb-0">{{ $types->where('type', 'video')->first() != null ? number_format(floatval($types->where('type', 'video')->first()->size)/1048576, 1) : 0 }} MB</p>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row" style="padding: 0 5px 5px 5px;">
                                            <div class="col-12">
                                                <div style="border: 1px rgb(177, 177, 177) solid; border-radius:20px;">
                                                    <div style="width: 70%; height: 3px; background-color: rgb(84, 255, 84)"
                                                        ></div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-12" style="margin-bottom: 10px">
                                    <div class="card">
                                        <div class="card-body" style="padding: 10px;">
                                            <div class="row">
                                                <div class="col-2">
                                                    <div class="avatar-title bg-transparent rounded"><i
                                                            class="fas fa-folder"
                                                            style="font-size:20px ;color: rgba(241,180,76,1)!important;"></i>
                                                    </div>
                                                </div>
                                                <div class="col-3">
                                                    <p class="font-size-14 text-truncate mb-0"><a class="text-body" href="/apps-filemanager">Audio</a></p>
                                                </div>
                                                <div class="col-4">
                                                    <p class="text-muted text-truncate mb-0">{{ $types->where('type', 'audio')->first() != null ?$types->where('type', 'audio')->first()->count : 0 }} Files</p>
                                                </div>
                                                <div class="col-3">
                                                    <p class="text-muted text-truncate mb-0">{{ $types->where('type', 'audio')->first() != null ? number_format(floatval($types->where('type', 'audio')->first()->size)/1048576, 1) : 0 }} MB</p>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row" style="padding: 0 5px 5px 5px;">
                                            <div class="col-12">
                                                <div style="border: 1px rgb(177, 177, 177) solid; border-radius:20px;">
                                                    <div style="width: 70%; height: 3px; background-color: rgb(84, 255, 84)"
                                                        ></div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-12" style="margin-bottom: 10px">
                                    <div class="card">
                                        <div class="card-body" style="padding: 10px;">
                                            <div class="row">
                                                <div class="col-2">
                                                    <div class="avatar-title bg-transparent rounded"><i
                                                            class="fas fa-folder"
                                                            style="font-size:20px ;color: rgba(241,180,76,1)!important;"></i>
                                                    </div>
                                                </div>
                                                <div class="col-3">
                                                    <p class="font-size-14 text-truncate mb-0"><a class="text-body" href="/apps-filemanager">Models</a></p>
                                                </div>
                                                <div class="col-4">
                                                    <p class="text-muted text-truncate mb-0">{{ $types->where('type', 'model')->first() != null ?$types->where('type', 'model')->first()->count : 0 }} Files</p>
                                                </div>
                                                <div class="col-3">
                                                    <p class="text-muted text-truncate mb-0">{{ $types->where('type', 'model')->first() != null ? number_format(floatval($types->where('type', 'model')->first()->size)/1048576, 1) : 0 }} MB</p>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row" style="padding: 0 5px 5px 5px;">
                                            <div class="col-12">
                                                <div style="border: 1px rgb(177, 177, 177) solid; border-radius:20px;">
                                                    <div style="width: 70%; height: 3px; background-color: rgb(84, 255, 84)"
                                                        ></div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-8">
                    <div class="card" style="width: 100%; padding: 0.25rem;">
                        <div class="card-body" style="color: #555; font-size: 14px;">
                            <div class="row">
                                <div class="col-12">
                                    <h6 class="text-gray-600 float-left">Objects </h6>
                                    <button class="btn float-right"
                                        style="margin-top: -12px; margin-right: -10px; font-size: 14px!important;  padding: 3px 20px!important;  line-height: 28px!important;  color: #224abe; font-weight: 600;"><i
                                            class="fas fa-plus" style="margin-right: 10px;"></i> Add </button>
                                </div>
                            </div>
                            <div class="row" style="height: 320px; overflow-y: scroll;">
                                <div class="col-lg-3 col-md-4 col-sm-12" style="padding: 5px;">
                                    <div class="card">
                                        <div class="file">
                                            <a href="javascript:void(0);">
                                                <div class="image">
                                                    <img src="https://wrraptheme.com/templates/lucid/hr/html/assets/images/image-gallery/8.jpg"
                                                        alt="img" class="img-fluid">
                                                </div>
                                                <div class="file-name">
                                                    <p class="m-b-5 text-muted">img21545ds.jpg</p>
                                                </div>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-3 col-md-4 col-sm-12" style="padding: 5px;">
                                    <div class="card">
                                        <div class="file">
                                            <a href="javascript:void(0);">
                                                <div class="image">
                                                    <img src="https://wrraptheme.com/templates/lucid/hr/html/assets/images/image-gallery/9.jpg"
                                                        alt="img" class="img-fluid">
                                                </div>
                                                <div class="file-name">
                                                    <p class="m-b-5 text-muted">img21545ds.jpg</p>
                                                </div>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-3 col-md-4 col-sm-12" style="padding: 5px;">
                                    <div class="card">
                                        <div class="file">
                                            <a href="javascript:void(0);">
                                                <div class="image">
                                                    <img src="https://wrraptheme.com/templates/lucid/hr/html/assets/images/image-gallery/8.jpg"
                                                        alt="img" class="img-fluid">
                                                </div>
                                                <div class="file-name">
                                                    <p class="m-b-5 text-muted">img21545ds.jpg</p>
                                                </div>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-3 col-md-4 col-sm-12" style="padding: 5px;">
                                    <div class="card">
                                        <div class="file">
                                            <a href="javascript:void(0);">
                                                <div class="image">
                                                    <img src="https://wrraptheme.com/templates/lucid/hr/html/assets/images/image-gallery/9.jpg"
                                                        alt="img" class="img-fluid">
                                                </div>
                                                <div class="file-name">
                                                    <p class="m-b-5 text-muted">img21545ds.jpg</p>
                                                </div>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-3 col-md-4 col-sm-12" style="padding: 5px;">
                                    <div class="card">
                                        <div class="file">
                                            <a href="javascript:void(0);">
                                                <div class="image">
                                                    <img src="https://wrraptheme.com/templates/lucid/hr/html/assets/images/image-gallery/8.jpg"
                                                        alt="img" class="img-fluid">
                                                </div>
                                                <div class="file-name">
                                                    <p class="m-b-5 text-muted">img21545ds.jpg</p>
                                                </div>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-3 col-md-4 col-sm-12" style="padding: 5px;">
                                    <div class="card">
                                        <div class="file">
                                            <a href="javascript:void(0);">
                                                <div class="image">
                                                    <img src="https://wrraptheme.com/templates/lucid/hr/html/assets/images/image-gallery/9.jpg"
                                                        alt="img" class="img-fluid">
                                                </div>
                                                <div class="file-name">
                                                    <p class="m-b-5 text-muted">img21545ds.jpg</p>
                                                </div>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-3 col-md-4 col-sm-12" style="padding: 5px;">
                                    <div class="card">
                                        <div class="file">
                                            <a href="javascript:void(0);">
                                                <div class="image">
                                                    <img src="https://wrraptheme.com/templates/lucid/hr/html/assets/images/image-gallery/8.jpg"
                                                        alt="img" class="img-fluid">
                                                </div>
                                                <div class="file-name">
                                                    <p class="m-b-5 text-muted">img21545ds.jpg</p>
                                                </div>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-3 col-md-4 col-sm-12" style="padding: 5px;">
                                    <div class="card">
                                        <div class="file">
                                            <a href="javascript:void(0);">
                                                <div class="image">
                                                    <img src="https://wrraptheme.com/templates/lucid/hr/html/assets/images/image-gallery/9.jpg"
                                                        alt="img" class="img-fluid">
                                                </div>
                                                <div class="file-name">
                                                    <p class="m-b-5 text-muted">img21545ds.jpg</p>
                                                </div>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="card mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">DataTables Example</h6>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Name</th>
                                            <th>Images</th>
                                            <th>Price</th>
                                            <th>Link Products</th>
                                            <th>Code</th>
                                            <th>Booths</th>
                                            <th style="width: 10%;">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>1</td>
                                            <td>Brielle Williamson</td>
                                            <td><img class="products-tables" src="./../asset/images/apps-1.jpg" alt="">
                                            </td>
                                            <td>150$</td>
                                            <td>
                                                <a href="https://github.com/">https://github.com/</a>
                                            </td>
                                            <td>SALE123</td>
                                            <td>Booth-01</td>
                                            <td>
                                                <a class="btn btn-xs btn-info" href="#"><i class="fa fa-pen"></i></a>
                                                <a class="btn btn-xs btn-danger" href="#"><i
                                                        class="fa fa-trash"></i></a>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>2</td>
                                            <td>Brielle Williamson</td>
                                            <td><img class="products-tables" src="./../asset/images/apps-1.jpg" alt="">
                                            </td>
                                            <td>150$</td>
                                            <td><a href="https://github.com/">https://github.com/</a></td>
                                            <td>SALE123</td>
                                            <td>Booth-01</td>
                                            <td>
                                                <a class="btn btn-xs btn-info" href="#"><i class="fa fa-pen"></i></a>
                                                <a class="btn btn-xs btn-danger" href="#"><i
                                                        class="fa fa-trash"></i></a>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="fw-light">Choose Object for Booths</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                                aria-hidden="true">&times;</span></button>
                    </div>
                    <div class="modal-body" style="border-radius:0 ;">
                        <div class="d-flex flex-column" style="flex-grow: 1;">
                            <div class="modal-body" style="flex: 0 1 0%;">
                                <nav class="nav_profile">
                                    <a href="javascript:void(0)" class="active" id="switch-local-btn"
                                        style="width: 50%;">
                                        <div class="d-block d-sm-inline"><i class="fas fa-file-image"></i> Images</div>
                                    </a>
                                    <a href="javascript:void(0)" id="switch-link-btn" style="width: 50%;">
                                        <div class="d-block d-sm-inline"><i class="fas fa-file-video"></i> Videos</div>
                                    </a>
                                    <a href="javascript:void(0)" id="switch-link-btn" style="width: 50%;">
                                        <div class="d-block d-sm-inline"><i class="fas fa-file-audio"></i> Audios</div>
                                    </a>
                                    <a href="javascript:void(0)" id="switch-link-btn" style="width: 50%;">
                                        <div class="d-block d-sm-inline"><i class="fas fa-file-prescription"></i> Modes
                                        </div>
                                    </a>
                                </nav>
                                <div class="step-1">
                                    <div class="row"
                                        style="height: 55vh; overflow-y: scroll;margin: 0; padding-top: 20px;">
                                        <div class="col-lg-4 col-md-4 col-sm-12" style="padding: 5px;">
                                            <div class="card">
                                                <div class="file" style="border-radius:0 ;">
                                                    <label class="image-checkbox">
                                                        <img class="img-responsive"
                                                            src="https://wrraptheme.com/templates/lucid/hr/html/assets/images/image-gallery/9.jpg"
                                                            alt="img" style="width: 100%;">
                                                        <input name="image[]" value="" type="checkbox">
                                                        <i class="fa fa-check hidden"></i>
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="step-2" style="display: none;">
                                    <div class="row"
                                        style="height: 55vh; overflow-y: scroll;margin: 0; padding-top: 20px;">
                                        <div class="col-lg-4 col-md-4 col-sm-12" style="padding: 5px;">
                                            <div class="card">
                                                <div class="file" style="border-radius:0 ;">
                                                    <label class="image-checkbox">
                                                        <img class="img-responsive"
                                                            src="https://wrraptheme.com/templates/lucid/hr/html/assets/images/image-gallery/9.jpg"
                                                            alt="img" style="width: 100%;">
                                                        <input name="image[]" value="" type="checkbox">
                                                        <i class="fa fa-check hidden"></i>
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="step-3" style="display: none;">
                                    <div class="row"
                                        style="height: 55vh; overflow-y: scroll;margin: 0; padding-top: 20px;">
                                        <div class="col-lg-4 col-md-4 col-sm-12" style="padding: 5px;">
                                            <div class="card">
                                                <div class="file" style="border-radius:0 ;">
                                                    <label class="image-checkbox">
                                                        <img class="img-responsive"
                                                            src="https://wrraptheme.com/templates/lucid/hr/html/assets/images/image-gallery/9.jpg"
                                                            alt="img" style="width: 100%;">
                                                        <input name="image[]" value="" type="checkbox">
                                                        <i class="fa fa-check hidden"></i>
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="step-4" style="display: none;">
                                    <div class="row"
                                        style="height: 55vh; overflow-y: scroll;margin: 0; padding-top: 20px;">
                                        <div class="col-lg-4 col-md-4 col-sm-12" style="padding: 5px;">
                                            <div class="card">
                                                <div class="file" style="border-radius:0 ;">
                                                    <label class="image-checkbox">
                                                        <img class="img-responsive"
                                                            src="https://wrraptheme.com/templates/lucid/hr/html/assets/images/image-gallery/9.jpg"
                                                            alt="img" style="width: 100%;">
                                                        <input name="image[]" value="" type="checkbox">
                                                        <i class="fa fa-check hidden"></i>
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button class="btn btn-df1" type="button" data-dismiss="modal">Save Change</button>
                    </div>
                </div>
            </div>
        </div>
        <script>
            function init() {
                var container = document.getElementById('viewer-container');
                var viewer = new PANOLENS.Viewer({
                    container: container,
                });
                viewer.OrbitControls.noZoom = true;

                @if ($overview != null)
                    let imagePanorama = new PANOLENS.ImagePanorama('{{ $overview->imageUrl }}');
                    viewer.add(imagePanorama);
                @endif

            }
        </script>
        <script>
            $(document).ready(function() {
                init();
            });
        </script>

    @endsection
