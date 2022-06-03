@extends('layouts.master')
@section('content')
    <div class="content">
        <div class="container-fluid">
            <form action="/administrator/tours/{{ $tour->id }}/articles/save-create" method="POST"
                enctype="multipart/form-data">
                @csrf
                <div class="form-group row">
                    <label for="inputEmail3" class="col-sm-2 col-form-label">Title :</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="title_article" name="title" placeholder="Title of article">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="inputEmail3" class="col-sm-2 col-form-label">Slug :</label>
                    <div class="col-sm-10">
                        <div class="input-group--sa-slug input-group"><span class="input-group-text input-half-bd"
                                id="form-category/slug-addon">https://360fairs.com/article/</span>
                            <input id="input-slug" type="text" class="form-control" name="slug">
                        </div>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="inputEmail3" class="col-sm-2 col-form-label">Poster :</label>
                    <div class="col-sm-10 banner_article">
                        <input type="file" name="files" class="dropify" data-max-file-size="10M" required>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="inputEmail3" class="col-sm-2 col-form-label">Short description:</label>
                    <div class="col-sm-10">
                        <textarea name="short_description" class="form-control" rows="5" placeholder="Short description of article"></textarea>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="inputEmail3" class="col-sm-2 col-form-label">Content :</label>
                    <div class="col-sm-10">
                        <textarea id="editor" name="content" class="form-control " cols="30" rows="3" placeholder="Content of article"></textarea>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="inputEmail3" class="col-sm-2 col-form-label">Author :</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="author" placeholder="Name of author" name="author">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="inputEmail3" class="col-sm-2 col-form-label"></label>
                    <div class="col-sm-10">
                        <div class="custom-control custom-checkbox">
                            <input type="checkbox" class="custom-control-input" id="input-hidden" name="public" checked>
                            <label class="custom-control-label" for="input-hidden">Visibility</label>
                        </div>
                    </div>
                </div>
                <div class="form-group row mt-3 float-right mr-1">
                    <button id="btn-clear" type="reset" class="btn btn-secondary waves-effect waves-light mr-2">
                        <span class="btn-label"><i class="fas fa-window-close"></i> </span>Đóng
                    </button>
                    <button type="submit" class="btn btn-success waves-effect waves-light mr-2">
                        <span class="btn-label"><i class="mdi mdi-content-save"></i> </span>Lưu bài viêt
                    </button>
                </div>
            </form>
        </div>
    </div>
@stop
@section('script')
    <script>
        // CKEDITOR.replace(document.getElementById('editor'));
        // var editor = CKEDITOR.replace( document.getElementById('editor'));
        // CKFinder.setupCKEditor( editor );

        CKEDITOR.replace( 'editor', {
            filebrowserBrowseUrl: '../../../../admin-master/asset/plugins/ckfinder/ckfinder.html',
            filebrowserUploadUrl: '../../../../admin-master/asset/plugins/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Files'
        } );
    </script>
    <script>
        $('#title_article').on('input', function() {
            let name = $(this).val();
            let slug = Utils.convertToSlug(name);
            $('#input-slug').val(slug);
        });

        $('#btn-clear').click(function() {
            let name = $(this).val();
            let slug = Utils.convertToSlug(name);
            $('#input-slug').val(slug);
        });

        $(".dropify").dropify({
            messages: {
                default: "Click here",
                replace: "Drag or click",
                remove: "Remove",
                error: "Ooops, something wrong appended."
            },
            error: {
                fileSize: "The file size is too big (10M max)."
            }
        });
    </script>
@stop
