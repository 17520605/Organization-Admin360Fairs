<?php
use Illuminate\Support\Facades\Route;

Route::get('/', 'AdminEventController@index');

// ROUTER AUTH
Route::get('/login', 'AuthController@login');
Route::get('/register', 'AuthController@register');
Route::get('/forgot', 'AuthController@forgot');

// ROUTER TOUR
Route::get('/tour', 'TourController@index');


// ROUTER AUTH
Route::group(['prefix' => 'company'], function(){
    Route::get('/', 'CompanyController@index');
    Route::get('/add', 'CompanyController@add');
    Route::get('/edit', 'CompanyController@edit');
});