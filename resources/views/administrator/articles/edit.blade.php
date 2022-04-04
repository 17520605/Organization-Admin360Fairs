@extends('layouts.master')
@section('content')
    <div class="content">
        <div class="container-fluid">
            <form action="/administrator/tours/{{ $tour->id }}/articles/{{ $article->id }}/save-edit"
                method="POST" enctype="multipart/form-data">
                @csrf
                <div class="form-group row">
                    <label for="inputEmail3" class="col-sm-2 col-form-label">Title :</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="title_article" placeholder="title of article"
                            value="{{ $article->title }}" name="title">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="inputEmail3" class="col-sm-2 col-form-label">Slug :</label>
                    <div class="col-sm-10">
                        <div class="input-group--sa-slug input-group"><span class="input-group-text input-half-bd"
                                id="form-category/slug-addon"> https://360fairs.com/article/</span>
                            <input id="input-slug" type="text" class="form-control" name="slug"
                                value="{{ $article->slug }}">
                        </div>
                    </div>
                </div>
                <div class="form-group row banner_article">
                    <label for="inputEmail3" class="col-sm-2 col-form-label">Poster :</label>
                    <div class="col-sm-10 dropify-file-wrapper">
                        <input type="hidden" class="changed" name="changedFiles" value="0">
                        <input type="file" name="file" class="dropify" data-default-file="{{ $article->banner }}">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="inputEmail3" class="col-sm-2 col-form-label">:</label>
                    <div class="col-sm-10">
                        <textarea name="short_description" class="form-control" rows="5"
                            placeholder="short description of article">{{ $article->shortDescription }}</textarea>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="inputEmail3" class="col-sm-2 col-form-label">Content :</label>
                    <div class="col-sm-10">
                        <textarea id="editor" name="content" class="form-control" cols="30" rows="3"
                            placeholder="content 0f article">{{ $article->content }}</textarea>
                    </div>
                </div>

                <div class="form-group row">
                    <label for="inputEmail3" class="col-sm-2 col-form-label">Author :</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="author" placeholder="author name"
                            value="{{ $article->author }}" name="author">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="inputEmail3" class="col-sm-2 col-form-label"></label>
                    <div class="col-sm-10">
                        <div class="custom-control custom-checkbox">
                            <input type="checkbox" class="custom-control-input" id="input-public" name="public"
                                {{ $article->isPublic != 0 ? 'checked' : '' }}>
                            <label class="custom-control-label" for="input-hidden">Visibility</label>
                        </div>
                    </div>
                </div>
                <div class="form-group row mt-3 float-right mr-1">
                    <button type="submit" class="btn btn-success waves-effect waves-light mr-2">
                        <span class="btn-label"><i class="mdi mdi-content-save"></i> </span>Save Changes
                    </button>
                </div>
            </form>
        </div>
    </div>
@stop
@section('script')
    <script>
        CKEDITOR.replace(document.getElementById('editor'));
    </script>
    <script>
        $('#title_article').on('input', function() {
            let name = $(this).val();
            let slug = Utils.convertToSlug(name);
            $('#input-slug').val(slug);
        });

        $('.dropify-clear').click(function() {
            let wrapper = $(this).parents('.dropify-file-wrapper');
            wrapper.find('.changed').val(1);

            let inputFile = wrapper.find('.dropify');
            if (inputFile.attr('name') == 'file') {
                inputFile.prop('required', true);
            }
        });

        $('.dropify').click(function() {
            let wrapper = $(this).parents('.dropify-file-wrapper');
            wrapper.find('.changed').val(1);
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
                fileSize: "The file size is too big (1M max)."
            }
        });
    </script>

@stop
