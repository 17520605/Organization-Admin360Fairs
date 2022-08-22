@extends('layouts.master')
<style>
    input[type="color"] {
    border-radius: 0px !important;
    border: 1px solid rgb(116, 116, 116) !important;
}
</style>
@section('content')
<div class="container-fluid">
    <div class="card shadow mb-4">
        <div class="card-header">
            <h1 class="h4 font-weight-bold text-primary" style="margin: 0px">Settings</h1>
        </div>
        <div class="card-body container" style="border: none !important;">
            <div class="row mt-4 mb-4 d-flex justify-content-center" id="setting-color">
                <form action="/administrator/tours/{{$tour->id}}/settings/save-configs-color" method="post">
                    @csrf
                    <input type="hidden" name="id" id="profile_personal_edit_id" value="{{$tour->id}}">
                    <div>
                        <div class="row">
                            <div class="col-sm">
                                <div class="swatch">
                                    <input type="color" class="color" onchange="ChangeColorInput(this)" name="color1" value="{{$tour->color1?$tour->color1:''}}">
                                    <input class="form-control mt-2 color1" onchange="ChangeColorInput1(this)" type="text" value="{{$tour->color1?$tour->color1:''}}">
                                    <div class="info">
                                    <h2>Default1</h2>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm">
                                <div class="swatch">
                                    <input type="color" class="color" onchange="ChangeColorInput(this)" name="color2" value="{{$tour->color2?$tour->color2:''}}">
                                    <input class="form-control mt-2 color1" onchange="ChangeColorInput1(this)" type="text" value="{{$tour->color2?$tour->color2:''}}">
                                    <div class="info">
                                        <h2>Default1</h2>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm">
                                <div class="swatch">
                                    <input type="color" class="color" onchange="ChangeColorInput(this)" name="color3" value="{{$tour->color3?$tour->color3:''}}">
                                    <input class="form-control mt-2 color1" onchange="ChangeColorInput1(this)" type="text" value="{{$tour->color3?$tour->color3:''}}">
                                    <div class="info">
                                    <h2>Default1</h2>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm">
                                <div class="swatch">
                                    <input type="color" class="color" onchange="ChangeColorInput(this)" name="color4" value="{{$tour->color4?$tour->color4:''}}">
                                    <input class="form-control mt-2 color1" onchange="ChangeColorInput1(this)" type="text" value="{{$tour->color4?$tour->color4:''}}">
                                    <div class="info">
                                    <h2>Default1</h2>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <button class="btn btn-primary btn-block mt-4 btn-icon-loader" type="submit" id="save-edit-conifg-color"> <span class="icon-loader-form"></span> Save Edit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<script>
    function ChangeColorInput(target)
    {
        let value = $(target).val();
        $(target).parents(".swatch").find(".color1").val(value);
    }
    function ChangeColorInput1(target)
    {
        let value = $(target).val();
        $(target).parents(".swatch").find(".color").val(value);
    }
</script>
@endsection
