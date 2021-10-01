@extends('layouts.super')
@section('content')
    <div class="container">
        <div style="margin-top: 5%;">
            <h3 style="color: #35373b">Wellcome Khai !</h3>
            <div class="" style="border: 1px solid #dad9da; background-color: #fff;margin-bottom: 24px; border-radius: 8px;">
                <div class="" style="border-bottom: 1px solid #dad9da;">
                    <span style="color: #35373b;font-size: 16px; line-height:50px;font-weight: 700; padding: 10px 20px;">
                        <span>Hosting</span>
                    </span>
                </div>
                <div class="" style="padding: 10px 20px; position: relative;">
                    <div class="active-order-item border-dashed">
                        <div style="position: relative;">
                            <div class="row">
                                <div class="col-auto">
                                    <i class="fab fa-accusoft" style="font-size: 50px;color: #491bd5;"></i>
                                </div>
                                <div class="col-9">
                                    <div class="d-flex align-items-center">
                                        <span style="color: #35373b;font-size: 16px; line-height: 24px;font-weight: 700; margin: 0;"> 360fairs.com </span>
                                    </div>
                                    <p>Expires on 2022-09-12</p>
                                </div>
                                <div class="col-auto" style="padding-left: 40px;">
                                    <a href="{{env('APP_URL')}}/tour/1" class="btn" style="color: #fff; background-color: #491bd5; border-color: #461ac9; margin-top: .5rem!important;margin-bottom: .5rem!important;font-size: 14px!important;padding: 8px 34px!important; line-height: 30px!important;">
                                        <span>Manage</span>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

