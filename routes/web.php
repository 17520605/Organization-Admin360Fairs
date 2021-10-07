<?php
use Illuminate\Support\Facades\Route;

Route::match(['get', 'post'], '/login', 'AuthController@login')->name('login');
Route::match(['get', 'post'], '/register', 'AuthController@register')->name('register');
Route::get('/logout', 'AuthController@logout');
Route::get('/mail/send', 'MailController@send');

Route::middleware('auth')->group(function (){
    Route::post('storage/upload', 'StorageController@upload');

    Route::get('/', 'ToursController@index')->name('home');
    Route::group(['prefix' => 'tours'], function(){
        Route::get('/', 'ToursController@index');
        Route::post('/save-create', 'ToursController@saveCreate');

        //dashboard

        //tour
        Route::get('/{id}', 'TourController@index');
        Route::get('/{id}/tour', 'TourController@index');
        Route::get('/{id}/tour/edit', 'TourController@edit');
        Route::post('/{id}/tour/save-edit', 'TourController@saveEdit');

        // objects
        Route::get('/{id}/objects', 'ObjectsController@index');
        Route::get('/{id}/objects/images', 'ObjectsController@images');
        Route::get('/{id}/objects/videos', 'ObjectsController@videos');
        Route::get('/{id}/objects/audios', 'ObjectsController@audios');
        Route::get('/{id}/objects/models', 'ObjectsController@models');
        Route::post('/{id}/objects/save-create', 'ObjectsController@saveCreate');


    });

    Route::group(['prefix' => 'profile'], function(){
        Route::get('/', 'ProfileController@index');
    });
});

