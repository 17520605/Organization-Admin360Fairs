<?php
use Illuminate\Support\Facades\Route;


Route::match(['get', 'post'], '/login', 'AuthController@login')->name('login');
Route::match(['get', 'post'], '/register', 'AuthController@register')->name('register');

Route::middleware('auth')->group(function (){
    Route::get('/', 'AdminEventController@index')->name('home');

    Route::group(['prefix' => 'tours'], function(){
        //dashboard

        //tour
        Route::get('/{id}', 'TourController@index');
        Route::get('/{id}/tour', 'TourController@edit');
        Route::get('/{id}/tour/edit', 'TourController@edit');
        Route::post('/{id}/tour/save-edit', 'TourController@saveEdit');

        // 
    });
    
    // Route::group(['prefix' => 'company'], function(){
    //     Route::get('/', 'CompanyController@index');
    //     Route::get('/add', 'CompanyController@add');
    //     Route::get('/edit', 'CompanyController@edit');
    // });
});

