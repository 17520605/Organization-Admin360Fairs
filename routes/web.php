<?php
use Illuminate\Support\Facades\Route;

Route::match(['get', 'post'], '/login', 'AuthController@login')->name('login');
Route::match(['get', 'post'], '/register', 'AuthController@register')->name('register');
Route::match(['get', 'post'], '/init-password', 'AuthController@initPassword')->name('login');
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

        // participants
        Route::get('/{id}/participants', 'ParticipantsController@index');
        Route::post('/{id}/participants/save-create', 'ParticipantsController@saveCreate');
        Route::post('/{id}/participants/import-csv', 'ParticipantsController@importCsv');
        Route::post('/{id}/participants/check-import-csv', 'ParticipantsController@checkImportCsv');
        Route::post('/{id}/participants/send-emails', 'ParticipantsController@sendEmails');

        // speakers
        Route::get('/{id}/speakers', 'SpeakersController@index');
        Route::post('/{id}/speakers/save-create', 'SpeakersController@saveCreate');
        Route::post('/{id}/speakers/import-csv', 'SpeakersController@importCsv');
        Route::post('/{id}/speakers/check-import-csv', 'SpeakersController@checkImportCsv');
        Route::post('/{id}/speakers/send-emails', 'SpeakersController@sendEmails');

        // zones
        Route::get('/{id}/zones', 'ZonesController@index');
        Route::get('/{id}/zones/{zoneId}', 'ZonesController@zone');
        Route::post('/{id}/zones/{zoneId}/save-add-booths', 'ZonesController@saveAddBooths');
        Route::post('/{id}/zones/save-create', 'ZonesController@saveCreate');
       

        // booths
        Route::get('/{id}/booths', 'BoothsController@index');
        Route::post('/{id}/booths/save-create', 'BoothsController@saveCreate');

        // objects
        Route::get('/{id}/objects', 'ObjectsController@index');
        Route::get('/{id}/objects/images', 'ObjectsController@images');
        Route::get('/{id}/objects/videos', 'ObjectsController@videos');
        Route::get('/{id}/objects/audios', 'ObjectsController@audios');
        Route::get('/{id}/objects/models', 'ObjectsController@models');
        Route::post('/{id}/objects/save-create', 'ObjectsController@saveCreate');

        // event
        Route::get('/{id}/events/webinars', 'EventsController@webinars');
        Route::get('/{id}/events/webinars/{webinarId}', 'EventsController@webinar');
        Route::post('/{id}/events/webinars/save-create', 'EventsController@saveCreate');

    });

    Route::group(['prefix' => 'profile'], function(){
        Route::get('/', 'ProfileController@index');
    });

    Route::group(['prefix' => 'partner'], function(){
        Route::get('/verification/{id}', 'PartnerController@verification');
        Route::post('/confirmation', 'PartnerController@confirmation');
    });
});

