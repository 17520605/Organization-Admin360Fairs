@extends('layouts.master')

@section('content')
    <div class="container-fluid gallery">
    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800">Document  <button class="btn btn-df" data-toggle="modal" data-target="#create_upload_object" style="position: absolute; right: 1.5rem;"><i class="fas fa-upload" style="margin-right: 8px;"></i> Add new file</button></h1>
    <!-- DataTales Example -->
    <div class="row clearfix">
        <div class="col-lg-3 col-md-4 col-sm-12">
            <div class="card">
                <div class="file">
                    <a href="javascript:void(0);">
                        <div class="hover">
                              <button class="btn"><i class="fas fa-ellipsis-v"></i></button>
                        </div>
                        <div class="icon">
                            <i class="fa fa-file text-info"></i>
                        </div>
                        <div class="file-name">
                            <p class="m-b-5 text-muted">Document_2017.doc</p>
                            <small>Size: 42KB <span class="date text-muted">Nov 02, 2017</span></small>
                        </div>
                    </a>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-md-4 col-sm-12">
            <div class="card">
                <div class="file">
                    <a href="javascript:void(0);">
                        <div class="hover">
                              <button class="btn"><i class="fas fa-ellipsis-v"></i></button>
                        </div>
                        <div class="icon">
                            <i class="fa fa-file text-info"></i>
                        </div>
                        <div class="file-name">
                            <p class="m-b-5 text-muted">Document_2017.doc</p>
                            <small>Size: 89KB <span class="date text-muted">Dec 15, 2017</span></small>
                        </div>
                    </a>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-md-4 col-sm-12">
            <div class="card">
                <div class="file">
                    <a href="javascript:void(0);">
                        <div class="hover">
                              <button class="btn"><i class="fas fa-ellipsis-v"></i></button>
                        </div>
                        <div class="icon">
                            <i class="fa fa-file text-info"></i>
                        </div>
                        <div class="file-name">
                            <p class="m-b-5 text-muted">Document_2017.doc</p>
                            <small>Size: 89KB <span class="date text-muted">Dec 15, 2017</span></small>
                        </div>
                    </a>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-md-4 col-sm-12">
            <div class="card">
                <div class="file">
                    <a href="javascript:void(0);">
                        <div class="hover">
                              <button class="btn"><i class="fas fa-ellipsis-v"></i></button>
                        </div>
                        <div class="icon">
                            <i class="fas fa-chart-line text-warning"></i>
                        </div>
                        <div class="file-name">
                            <p class="m-b-5 text-muted">Report2016.xls</p>
                            <small>Size: 68KB <span class="date text-muted">Dec 12, 2016</span></small>
                        </div>
                    </a>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-md-4 col-sm-12">
            <div class="card">
                <div class="file">
                    <a href="javascript:void(0);">
                        <div class="hover">
                              <button class="btn"><i class="fas fa-ellipsis-v"></i></button>
                        </div>
                        <div class="icon">
                            <i class="fas fa-chart-line text-warning"></i>
                        </div>
                        <div class="file-name">
                            <p class="m-b-5 text-muted">Report2016.xls</p>
                            <small>Size: 68KB <span class="date text-muted">Dec 12, 2016</span></small>
                        </div>
                    </a>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-md-4 col-sm-12">
            <div class="card">
                <div class="file">
                    <a href="javascript:void(0);">
                        <div class="hover">
                              <button class="btn"><i class="fas fa-ellipsis-v"></i></button>
                        </div>
                        <div class="icon">
                            <i class="fa fa-file text-success"></i>
                        </div>
                        <div class="file-name">
                            <p class="m-b-5 text-muted">asdf hhkj.pdf</p>
                            <small>Size: 3MB <span class="date text-muted">Aug 18, 2017</span></small>
                        </div>
                    </a>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-md-4 col-sm-12">
            <div class="card">
                <div class="file">
                    <a href="javascript:void(0);">
                        <div class="hover">
                              <button class="btn"><i class="fas fa-ellipsis-v"></i></button>
                        </div>
                        <div class="icon">
                            <i class="fa fa-file text-success"></i>
                        </div>
                        <div class="file-name">
                            <p class="m-b-5 text-muted">asdf hhkj.pdf</p>
                            <small>Size: 3MB <span class="date text-muted">Aug 18, 2017</span></small>
                        </div>
                    </a>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-md-4 col-sm-12">
            <div class="card">
                <div class="file">
                    <a href="javascript:void(0);">
                        <div class="hover">
                              <button class="btn"><i class="fas fa-ellipsis-v"></i></button>
                        </div>
                        <div class="icon">
                            <i class="fa fa-file text-success"></i>
                        </div>
                        <div class="file-name">
                            <p class="m-b-5 text-muted">asdf hhkj.pdf</p>
                            <small>Size: 3MB <span class="date text-muted">Aug 18, 2017</span></small>
                        </div>
                    </a>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-md-4 col-sm-12">
            <div class="card">
                <div class="file">
                    <a href="javascript:void(0);">
                        <div class="hover">
                              <button class="btn"><i class="fas fa-ellipsis-v"></i></button>
                        </div>
                        <div class="icon">
                            <i class="fa fa-file text-success"></i>
                        </div>
                        <div class="file-name">
                            <p class="m-b-5 text-muted">asdf hhkj.pdf</p>
                            <small>Size: 3MB <span class="date text-muted">Aug 18, 2017</span></small>
                        </div>
                    </a>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-md-4 col-sm-12">
            <div class="card">
                <div class="file">
                    <a href="javascript:void(0);">
                        <div class="hover">
                              <button class="btn"><i class="fas fa-ellipsis-v"></i></button>
                        </div>
                        <div class="icon">
                            <i class="fas fa-chart-line text-warning"></i>
                        </div>
                        <div class="file-name">
                            <p class="m-b-5 text-muted">Report2016.xls</p>
                            <small>Size: 68KB <span class="date text-muted">Dec 12, 2016</span></small>
                        </div>
                    </a>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-md-4 col-sm-12">
            <div class="card">
                <div class="file">
                    <a href="javascript:void(0);">
                        <div class="hover">
                              <button class="btn"><i class="fas fa-ellipsis-v"></i></button>
                        </div>
                        <div class="icon">
                            <i class="fas fa-chart-line text-warning"></i>
                        </div>
                        <div class="file-name">
                            <p class="m-b-5 text-muted">Report2017.xls</p>
                            <small>Size: 103KB <span class="date text-muted">Jan 24, 2016</span></small>
                        </div>
                    </a>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-md-4 col-sm-12">
            <div class="card">
                <div class="file">
                    <a href="javascript:void(0);">
                        <div class="hover">
                              <button class="btn"><i class="fas fa-ellipsis-v"></i></button>
                        </div>
                        <div class="icon">
                            <i class="fas fa-chart-line text-warning"></i>
                        </div>
                        <div class="file-name">
                            <p class="m-b-5 text-muted">Report2016.xls</p>
                            <small>Size: 68KB <span class="date text-muted">Dec 12, 2016</span></small>
                        </div>
                    </a>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-md-4 col-sm-12">
            <div class="card">
                <div class="file">
                    <a href="javascript:void(0);">
                        <div class="hover">
                              <button class="btn"><i class="fas fa-ellipsis-v"></i></button>
                        </div>
                        <div class="icon">
                            <i class="fa fa-file text-info"></i>
                        </div>
                        <div class="file-name">
                            <p class="m-b-5 text-muted">Document_2017.doc</p>
                            <small>Size: 42KB <span class="date text-muted">Nov 02, 2017</span></small>
                        </div>
                    </a>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-md-4 col-sm-12">
            <div class="card">
                <div class="file">
                    <a href="javascript:void(0);">
                        <div class="hover">
                              <button class="btn"><i class="fas fa-ellipsis-v"></i></button>
                        </div>
                        <div class="icon">
                            <i class="fa fa-file text-info"></i>
                        </div>
                        <div class="file-name">
                            <p class="m-b-5 text-muted">Document_2017.doc</p>
                            <small>Size: 89KB <span class="date text-muted">Dec 15, 2017</span></small>
                        </div>
                    </a>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-md-4 col-sm-12">
            <div class="card">
                <div class="file">
                    <a href="javascript:void(0);">
                        <div class="hover">
                              <button class="btn"><i class="fas fa-ellipsis-v"></i></button>
                        </div>
                        <div class="icon">
                            <i class="fas fa-chart-line text-warning"></i>
                        </div>
                        <div class="file-name">
                            <p class="m-b-5 text-muted">Report2017.xls</p>
                            <small>Size: 103KB <span class="date text-muted">Jan 24, 2016</span></small>
                        </div>
                    </a>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-md-4 col-sm-12">
            <div class="card">
                <div class="file">
                    <a href="javascript:void(0);">
                        <div class="hover">
                              <button class="btn"><i class="fas fa-ellipsis-v"></i></button>
                        </div>
                        <div class="icon">
                            <i class="fa fa-file text-info"></i>
                        </div>
                        <div class="file-name">
                            <p class="m-b-5 text-muted">Document_2017.doc</p>
                            <small>Size: 89KB <span class="date text-muted">Dec 15, 2017</span></small>
                        </div>
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
