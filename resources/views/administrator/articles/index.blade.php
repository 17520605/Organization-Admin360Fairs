@extends('layouts.master')
@section('content')
    <div class="content">
        <div class="container-fluid">
            {{-- <a type="button" href="/administrator/tours/{{$tour->id}}/articles/create"
                class="btn btn-twitter waves-effect waves-light mb-3"><span class="btn-label"> <i
                        class="fas fa-plus"></i></span> Thêm mới bài viết</a>
            <div class="row">
                <div class="col-12">
                    <div class="card-box">
                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Title</th>
                                    <th>Poster</th>
                                    <th>Visibility</th>
                                    <th>Author</th>
                                    <th>Created at</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if(@isset($articles) > 0)
                                    @php
                                        $number = 1;
                                    @endphp
                                    @foreach ($articles as $article)
                                    <tr data-article-id='{{$article->id}}'>
                                        <td>{{$number++}}</td>
                                        <td>
                                            <h6 href="app-product.html" class="font-weight-bold">{{$article->title}}</h6>
                                        </td>
                                        <td>
                                            <img src="{{$article->banner}}" class="rounded" height="70" width="140" style="object-fit: cover;">
                                        </td>
                                        <td>
                                            <button onclick="toggleVisiable(this)" class="btn waves-effect waves-light {{$article->is_hidden != 0 ? 'btn-success' : 'btn-secondary'}}">{{$article->isPublic != 0 ? 'UnPublic' : 'Public'  }}</button>
                                        </td>
                                        <td>
                                            {{$article->author}}
                                        </td>
                                        <td>
                                            {{$article->created_at}}
                                        </td>
                                        <td> 
                                            <a class="btn waves-effect waves-light btn-success" href="/administrator/{{$tour->id}}/articles/{{$article->id}}/edit" ><i class="mdi mdi-pencil-outline"></i></a>
                                            <button class="btn waves-effect waves-light btn-danger" onclick="openPopupDelete('{{$article->id}}')"><i class="mdi mdi-trash-can"> </i></button>
                                        </td>
                                    </tr>
                                    @endforeach
                                @else
                                    <tr>
                                        <td colspan="12">Không có dữ liệu</td>
                                    </tr>
                                @endif
                            </tbody>
                        </table>
                    </div>
                </div>
            </div> --}}

            <div class="card shadow mb-4">
                <div class="card-header">
                    <h1 class="h4 font-weight-bold text-primary" style="margin: 0px">Articles <span style="font-size: 16px;margin-left: 20px">(<i class="far fa-eye-slash"></i> : Published - <i class="far fa-eye"></i> : Unpublished)</span></h1>
                    <div class="div_cardheader_btn" >
                        <a href="/administrator/tours/{{$tour->id}}/articles/create"><button class="mb-0 btn float-right active" data-toggle="modal"><i class="fas fa-plus"></i> Add </button></a>
                    </div>
                </div>
                <div class="card-body" style="border: none !important;">
                    <div class="table-responsive">
                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Title</th>
                                    <th>Poster</th>
                                    <th>Visibility</th>
                                    <th>Author</th>
                                    <th>Created at</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if(@isset($articles) > 0)
                                    @php
                                        $number = 1;
                                    @endphp
                                    @foreach ($articles as $article)
                                    <tr data-article-id='{{$article->id}}'>
                                        <td>{{$number++}}</td>
                                        <td>
                                            <h6 href="app-product.html" class="font-weight-bold">{{$article->title}}</h6>
                                        </td>
                                        <td>
                                            <img src="{{$article->banner}}" class="rounded" height="70" width="140" style="object-fit: cover;">
                                        </td>
                                        <td>
                                            <button onclick="toggleVisiable(this)" class="btn {{$article->isPublic != 0 ? 'btn-secondary' : 'btn-primary'}}">
                                                @if ($article->isPublic)
                                                    <i class="far fa-eye-slash"></i>
                                                @else
                                                    <i class="far fa-eye"></i>
                                                @endif
                                            </button>
                                        </td>
                                        <td>
                                            {{$article->author}}
                                        </td>
                                        <td>
                                            {{$article->created_at}}
                                        </td>
                                        <td class="btn-action-icon"> 
                                            
                                            <a href="/administrator/tours/{{$tour->id}}/articles/{{$article->id}}/edit"> <i class="fas fa-pen edit"></i></a>
                                            <a href="#"><i class="fas fa-trash-alt delete" onclick="openPopupDelete('{{$article->id}}')"></i></a> 
                                        </td>
                                    </tr>
                                    @endforeach
                                @else
                                    <tr>
                                        <td colspan="12">Không có dữ liệu</td>
                                    </tr>
                                @endif
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

        </div>
        <div class="modal fade" id="deleteArticle" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
            aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="titleDeleteProduct">Xóa bài viết</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    </div>
                    <div class="modal-body">
                        <p> Bạn có chắc chắn muốn xóa bài viết này không ?</p>
                    </div>
                    <div class="modal-footer">
                        <input id="id-article-hidden-input" type="hidden">
                        <button id="confirmDeleteBtn" type="button" class="btn btn-danger" onclick='confirmDelete(this)'>Xóa</button>
                        <button type="button" class="btn btn-secondary waves-effect" data-dismiss="modal">Đóng</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop
@section('script')
<script>
    function openPopupDelete(id) {  
        $('#confirmDeleteBtn').attr('data-id', id);
        $('#deleteArticle').modal('show');
    }

    function confirmDelete(target){
        let id = $(target).attr('data-id');
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            type: "delete",
            url: "/administrator/tours/{{$tour->id}}/articles/" + id,
            data: "data",
            dataType: "json",
            success: function (res) {
                if(res.success === true){
                    $('#deleteArticle').modal('hide');
                    var table = $('#datatable').DataTable();
                    var row = $('#datatable').find('tr[data-article-id="'+ id +'"]');
                    table.row(row).remove().draw();
                    location.reload();
                    tata.success('Thành công', 'Đã xóa bài viết', {
                        animate: 'slide',
                        closeBtn: true,
                    })
                }
                else{
                    tata.error('Lỗi', res.errors, {
                        animate: 'slide',
                        closeBtn: true,
                    })
                }
            },
            error: function(){
                tata.error('Lỗi', "Xóa thất bại", {
                    animate: 'slide',
                    closeBtn: true,
                });
            }
        });
    }

    function toggleVisiable(target){
        let id = $(target).parents('tr').attr('data-article-id');
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            type: "post",
            url: "/administrator/tours/{{$tour->id}}/articles/" + id + "/toggle-visiable",
            dataType: "json",
            success: function (res) {
                if(res.success === true){
                    if(res.isPublic){
                        $(target).removeClass('btn-primary');
                        $(target).addClass('btn-secondary');
                        $(target).html('<i class="far fa-eye-slash"></i>')
                    }
                    else{
                        $(target).removeClass('btn-secondary');
                        $(target).addClass('btn-primary');
                        $(target).html('<i class="far fa-eye"></i>')
                        
                    }

                    tata.success('Thành công', 'Đã thay đổi thành công', {
                        animate: 'slide',
                        closeBtn: true,
                    })
                }
                else{
                    tata.error('Lỗi', res.errors, {
                        animate: 'slide',
                        closeBtn: true,
                    })
                }
            },
            error: function(){
                tata.error('Lỗi', "Cập nhật thất bại", {
                    animate: 'slide',
                    closeBtn: true,
                });
            }
        });
    }
</script>
@stop

