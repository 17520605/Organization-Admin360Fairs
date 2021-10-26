@extends('layouts.master')

@section('content')
                    <div class="container-fluid gallery">
                    <!-- Page Heading -->
                    <!-- DataTales Example -->
                    <section class="content">
                        <h1 class="h3 mb-2 text-gray-800" style="margin-left: 1.25rem;">Gallery</h1>
                        <div class="card-body">

                            <div>
                                <div class="btn-group w-100 mb-2">
                                    <a class="btn btn-info-tab active" href="javascript:void(0)" data-filter="all"><i class="fas fa-list"></i> All items </a>
                                    <a class="btn btn-info-tab" href="javascript:void(0)" data-filter="1"></i><i class="fas fa-images"></i> Images </a>
                                    <a class="btn btn-info-tab" href="javascript:void(0)" data-filter="2"><i class="fas fa-film"></i> Videos </a>
                                    <a class="btn btn-info-tab" href="javascript:void(0)" data-filter="3"><i class="fas fa-music"></i> Audios </a>
                                    <a class="btn btn-info-tab" href="javascript:void(0)" data-filter="4"><i class="fas fa-folder"></i> Other </a>
                                </div>
                                <div class="mb-2">
                                    <!-- <a class="btn btn-secondary" href="javascript:void(0)" data-shuffle=""> Shuffle items </a> -->
                                    <div class="float-right" style="margin-bottom: 1em;">
                                        <select class="custom-select" style="width: auto;" data-sortorder="">
                                                <option value="index"> Sort by Position </option>
                                                <option value="sortData"> Sort by Custom Data </option>
                                            </select>
                                        <div class="btn-group">
                                            <a class="btn btn-default" href="javascript:void(0)" data-sortasc=""> Ascending </a>
                                            <a class="btn btn-default" href="javascript:void(0)" data-sortdesc=""> Descending </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div>
                                <div class="filter-container p-0 row" style="padding: 3px; position: relative; width: 100%; display: flex; flex-wrap: wrap; height: 582px;">
                                    <div class="filtr-item col-sm-3" data-category="1" data-sort="white sample">
                                        <a href="https://via.placeholder.com/1200/FFFFFF.png?text=1" data-toggle="lightbox" data-title="sample 1 - white">
                                            <img src="https://via.placeholder.com/300/FFFFFF?text=1" class="img-fluid mb-2" alt="white sample" />
                                        </a>
                                    </div>
                                    <div class="filtr-item col-sm-3" data-category="2, 4" data-sort="black sample">
                                        <a href="https://via.placeholder.com/1200/000000.png?text=2" data-toggle="lightbox" data-title="sample 2 - black">
                                            <img src="https://via.placeholder.com/300/000000?text=2" class="img-fluid mb-2" alt="black sample" />
                                        </a>
                                    </div>
                                    <div class="filtr-item col-sm-3" data-category="3, 4" data-sort="red sample">
                                        <a href="https://via.placeholder.com/1200/FF0000/FFFFFF.png?text=3" data-toggle="lightbox" data-title="sample 3 - red">
                                            <img src="https://via.placeholder.com/300/FF0000/FFFFFF?text=3" class="img-fluid mb-2" alt="red sample" />
                                        </a>
                                    </div>
                                    <div class="filtr-item col-sm-3" data-category="3, 4" data-sort="red sample">
                                        <a href="https://via.placeholder.com/1200/FF0000/FFFFFF.png?text=4" data-toggle="lightbox" data-title="sample 4 - red">
                                            <img src="https://via.placeholder.com/300/FF0000/FFFFFF?text=4" class="img-fluid mb-2" alt="red sample" />
                                        </a>
                                    </div>
                                    <div class="filtr-item col-sm-3" data-category="2, 4" data-sort="black sample">
                                        <a href="https://via.placeholder.com/1200/000000.png?text=5" data-toggle="lightbox" data-title="sample 5 - black">
                                            <img src="https://via.placeholder.com/300/000000?text=5" class="img-fluid mb-2" alt="black sample" />
                                        </a>
                                    </div>
                                    <div class="filtr-item col-sm-3" data-category="1" data-sort="white sample">
                                        <a href="https://via.placeholder.com/1200/FFFFFF.png?text=6" data-toggle="lightbox" data-title="sample 6 - white">
                                            <img src="https://via.placeholder.com/300/FFFFFF?text=6" class="img-fluid mb-2" alt="white sample" />
                                        </a>
                                    </div>
                                    <div class="filtr-item col-sm-3" data-category="1" data-sort="white sample">
                                        <a href="https://via.placeholder.com/1200/FFFFFF.png?text=7" data-toggle="lightbox" data-title="sample 7 - white">
                                            <img src="https://via.placeholder.com/300/FFFFFF?text=7" class="img-fluid mb-2" alt="white sample" />
                                        </a>
                                    </div>
                                    <div class="filtr-item col-sm-3" data-category="2, 4" data-sort="black sample">
                                        <a href="https://via.placeholder.com/1200/000000.png?text=8" data-toggle="lightbox" data-title="sample 8 - black">
                                            <img src="https://via.placeholder.com/300/000000?text=8" class="img-fluid mb-2" alt="black sample" />
                                        </a>
                                    </div>
                                    <div class="filtr-item col-sm-3" data-category="3, 4" data-sort="red sample">
                                        <a href="https://via.placeholder.com/1200/FF0000/FFFFFF.png?text=9" data-toggle="lightbox" data-title="sample 9 - red">
                                            <img src="https://via.placeholder.com/300/FF0000/FFFFFF?text=9" class="img-fluid mb-2" alt="red sample" />
                                        </a>
                                    </div>
                                    <div class="filtr-item col-sm-3" data-category="1" data-sort="white sample">
                                        <a href="https://via.placeholder.com/1200/FFFFFF.png?text=10" data-toggle="lightbox" data-title="sample 10 - white">
                                            <img src="https://via.placeholder.com/300/FFFFFF?text=10" class="img-fluid mb-2" alt="white sample" />
                                        </a>
                                    </div>
                                    <div class="filtr-item col-sm-3" data-category="1" data-sort="white sample">
                                        <a href="https://via.placeholder.com/1200/FFFFFF.png?text=11" data-toggle="lightbox" data-title="sample 11 - white">
                                            <img src="https://via.placeholder.com/300/FFFFFF?text=11" class="img-fluid mb-2" alt="white sample" />
                                        </a>
                                    </div>
                                    <div class="filtr-item col-sm-3" data-category="2, 4" data-sort="black sample">
                                        <a href="https://via.placeholder.com/1200/000000.png?text=12" data-toggle="lightbox" data-title="sample 12 - black">
                                            <img src="https://via.placeholder.com/300/000000?text=12" class="img-fluid mb-2" alt="black sample" />
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- /.container-fluid -->
                    </section>
                </div>
@endsection
