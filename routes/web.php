<?php
use Illuminate\Support\Facades\Route;

Route::match(['get', 'post'], '/login', 'AuthController@login')->name('login');
Route::match(['get', 'post'], '/register', 'AuthController@register')->name('register');
Route::match(['get', 'post'], '/init-password', 'AuthController@initPassword')->name('login');
Route::get('/logout', 'AuthController@logout');
Route::get('/mail/send', 'MailController@send');

Route::middleware('auth')->group(function (){
    Route::get('/', 'HomeController@index');
    Route::post('storage/upload', 'StorageController@upload');
 
    Route::group(['prefix' => 'administrator'], function(){
        Route::get('/', 'administrator\ToursController@index');
        Route::get('/tours', 'administrator\ToursController@index');
        Route::post('/tours/save-create', 'administrator\ToursController@saveCreate');

        Route::group(['prefix' => 'tours'], function(){
            // tour
            Route::get('/{id}', 'administrator\TourController@index');
            Route::get('/{id}/tour', 'administrator\TourController@index');
            Route::get('/{id}/tour/edit', 'administrator\TourController@edit');
            Route::post('/{id}/tour/save-edit', 'administrator\TourController@saveEdit');

            // participants
            Route::get('/{id}/participants', 'administrator\ParticipantsController@index');
            Route::post('/{id}/participants/save-create', 'administrator\ParticipantsController@saveCreate');
            Route::post('/{id}/participants/import-csv', 'administrator\ParticipantsController@importCsv');
            Route::post('/{id}/participants/check-import-csv', 'administrator\ParticipantsController@checkImportCsv');
            Route::post('/{id}/participants/send-emails', 'administrator\ParticipantsController@sendEmails');

            // speakers
            Route::get('/{id}/speakers', 'administrator\SpeakersController@index');
            Route::post('/{id}/speakers/save-create', 'administrator\SpeakersController@saveCreate');
            Route::post('/{id}/speakers/import-csv', 'administrator\SpeakersController@importCsv');
            Route::post('/{id}/speakers/check-import-csv', 'administrator\SpeakersController@checkImportCsv');
            Route::post('/{id}/speakers/send-emails', 'administrator\SpeakersController@sendEmails');

            // zones
            Route::get('/{id}/zones', 'administrator\ZonesController@index');
            Route::get('/{id}/zones/{zoneId}', 'administrator\ZonesController@zone');
            Route::post('/{id}/zones/{zoneId}/save-add-booths', 'administrator\ZonesController@saveAddBooths');
            Route::post('/{id}/zones/save-create', 'administrator\ZonesController@saveCreate');
        
            // booths
            Route::get('/{id}/booths', 'administrator\BoothsController@index');
            Route::post('/{id}/booths/save-create', 'administrator\BoothsController@saveCreate');

            // objects
            Route::get('/{id}/objects', 'administrator\ObjectsController@index');
            Route::get('/{id}/objects/images', 'administrator\ObjectsController@images');
            Route::get('/{id}/objects/videos', 'administrator\ObjectsController@videos');
            Route::get('/{id}/objects/audios', 'administrator\ObjectsController@audios');
            Route::get('/{id}/objects/models', 'administrator\ObjectsController@models');
            Route::post('/{id}/objects/save-create', 'administrator\ObjectsController@saveCreate');

            // event
            Route::get('/{id}/events/webinars', 'administrator\EventsController@webinars');
            Route::get('/{id}/events/webinars/{webinarId}', 'administrator\EventsController@webinar');
            Route::post('/{id}/events/webinars/save-create', 'administrator\EventsController@saveCreate');
        }); 
    });

    Route::group(['prefix' => 'participant'], function(){
        Route::get('/', 'participant\ToursController@index');
        Route::get('/tours', 'participant\ToursController@index');
        Route::get('/tours/{id}', 'participant\TourController@index');
        Route::get('/verification/{id}', 'PartnerController@verification');
        Route::post('/confirmation', 'PartnerController@confirmation');
    });

    Route::group(['prefix' => 'speaker'], function(){
        Route::get('/', 'speaker\ToursController@index');
        Route::get('/tours', 'speaker\ToursController@index');
    });
   
    Route::group(['prefix' => 'profile'], function(){
        Route::get('/', 'ProfileController@index');
    });

});
