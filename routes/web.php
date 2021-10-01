<?php
use Illuminate\Support\Facades\Route;


Route::match(['get', 'post'], '/login', 'AuthController@login')->name('login');
Route::match(['get', 'post'], '/register', 'AuthController@register')->name('register');

Route::middleware('auth')->group(function (){
    Route::get('/', 'AdminEventController@index')->name('home');

    // ROUTER TOUR
    Route::group(['prefix' => 'tour'], function(){
        Route::get('/{id}', 'TourController@index');
    });
    
    // Route::group(['prefix' => 'company'], function(){
    //     Route::get('/', 'CompanyController@index');
    //     Route::get('/add', 'CompanyController@add');
    //     Route::get('/edit', 'CompanyController@edit');
    // });
});

