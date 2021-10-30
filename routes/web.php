<?php
use Illuminate\Support\Facades\Route;

Route::match(['get', 'post'], '/login', 'AuthController@login')->name('login');
Route::match(['get', 'post'], '/register', 'AuthController@register')->name('register');
Route::match(['get', 'post'], '/init-password', 'AuthController@initPassword');
Route::match(['get', 'post'], '/verification/{id}', 'AuthController@verification');
Route::match(['get', 'post'], '/confirmation', 'AuthController@confirmation');
Route::get('/logout', 'AuthController@logout');

Route::get('/resume/{id}', 'ResumeController@index');

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

            // partners
            Route::get('/{id}/partners', 'administrator\PartnersController@index');
            Route::post('/{id}/partners/save-create', 'administrator\PartnersController@saveCreate');
            Route::post('/{id}/partners/save-edit', 'administrator\PartnersController@saveEdit');
            Route::post('/{id}/partners/import-csv', 'administrator\PartnersController@importCsv');
            Route::post('/{id}/partners/check-import-csv', 'administrator\PartnersController@checkImportCsv');
            Route::post('/{id}/partners/send-emails', 'administrator\PartnersController@sendEmails');
            Route::delete('/{id}/partners/{partnerId}', 'administrator\PartnersController@saveDelete');
            
            // speakers
            Route::get('/{id}/speakers', 'administrator\SpeakersController@index');
            Route::get('/{id}/speakers/{speakerId}/calendar', 'administrator\SpeakersController@calendar');
            Route::post('/{id}/speakers/save-create', 'administrator\SpeakersController@saveCreate');
            Route::post('/{id}/speakers/save-edit', 'administrator\SpeakersController@saveEdit');
            Route::post('/{id}/speakers/import-csv', 'administrator\SpeakersController@importCsv');
            Route::post('/{id}/speakers/check-import-csv', 'administrator\SpeakersController@checkImportCsv');
            Route::post('/{id}/speakers/send-emails', 'administrator\SpeakersController@sendEmails');
            Route::delete('/{id}/speakers/{speakerId}', 'administrator\SpeakersController@saveDelete');

            // zones
            Route::get('/{id}/zones', 'administrator\ZonesController@index');
            Route::get('/{id}/zones/{zoneId}', 'administrator\ZonesController@zone');
            Route::post('/{id}/zones/{zoneId}/save-add-booths', 'administrator\ZonesController@saveAddBooths');
            Route::post('/{id}/zones/save-create', 'administrator\ZonesController@saveCreate');
            Route::post('/{id}/zones/save-edit', 'administrator\ZonesController@saveEdit');
            Route::delete('/{id}/zones/{zoneId}', 'administrator\ZonesController@saveDelete');
        
            // booths
            Route::get('/{id}/booths', 'administrator\BoothsController@index');
            Route::get('/{id}/booths/booth', 'administrator\BoothsController@booth');
            Route::post('/{id}/booths/save-create', 'administrator\BoothsController@saveCreate');
            Route::post('/{id}/booths/save-edit', 'administrator\BoothsController@saveEdit');
            Route::post('/{id}/booths/grant-owner', 'administrator\BoothsController@grantOwner');
            Route::get('/{id}/booths/{boothId}', 'administrator\BoothsController@booth');
            Route::post('/{id}/booths/{boothId}/change-logo', 'administrator\BoothsController@changeLogo');
            Route::delete('/{id}/booths/{boothId}', 'administrator\BoothsController@saveDelete');

            // objects
            Route::get('/{id}/objects', 'administrator\ObjectsController@index');
            Route::get('/{id}/objects/dashboard', 'administrator\ObjectsController@dashboard');
            Route::get('/{id}/objects/images', 'administrator\ObjectsController@images');
            Route::get('/{id}/objects/videos', 'administrator\ObjectsController@videos');
            Route::get('/{id}/objects/audios', 'administrator\ObjectsController@audios');
            Route::get('/{id}/objects/models', 'administrator\ObjectsController@models');
            Route::get('/{id}/objects/documents', 'administrator\ObjectsController@documents');
            Route::post('/{id}/objects/save-create', 'administrator\ObjectsController@saveCreate');
            Route::get('/{id}/objects/{objectId}', 'administrator\ObjectsController@object');

            // event
            Route::get('/{id}/events/webinars', 'administrator\EventsController@webinars');
            Route::get('/{id}/events/webinars/{webinarId}', 'administrator\EventsController@webinar');
            Route::post('/{id}/events/webinars/save-create', 'administrator\EventsController@saveCreate');
            Route::post('/{id}/events/webinars/save-edit', 'administrator\EventsController@saveEdit');
            Route::post('/{id}/events/webinars/save-approve', 'administrator\EventsController@saveApprove');
            Route::post('/{id}/events/webinars/save-reject', 'administrator\EventsController@saveReject');
            Route::delete('/{id}/events/webinars/{webinarId}', 'administrator\EventsController@saveDelete');

            // views
            Route::get('/{id}/viewer', 'administrator\ViewerController@index');

            // interest
            Route::get('/{id}/interest', 'administrator\InterestController@index');

            // request
            Route::get('/{id}/interest', 'administrator\RequestController@index');

            // notification
            Route::get('/{id}/notifications', 'administrator\NotificationController@index');
            Route::post('/{id}/notifications/save-create', 'administrator\NotificationController@saveCreate');

        }); 
    });

    Route::group(['prefix' => 'partner'], function(){
        Route::get('/', 'partner\ToursController@index');
        Route::get('/tours', 'partner\ToursController@index');
        Route::get('/tour/{id}', 'partner\TourController@index');

        Route::group(['prefix' => 'tours'], function(){
            // tour
            Route::get('/{id}', 'partner\TourController@index');
            Route::get('/{id}/tour', 'partner\TourController@index');
            Route::get('/{id}/tour/edit', 'partner\TourController@edit');
            Route::post('/{id}/tour/save-edit', 'partner\TourController@saveEdit');
            
            // speakers
            Route::get('/{id}/speakers', 'partner\SpeakersController@index');
            Route::get('/{id}/speakers/{speakerId}/calendar', 'partner\SpeakersController@calendar');
            Route::post('/{id}/speakers/save-create', 'partner\SpeakersController@saveCreate');
            Route::post('/{id}/speakers/save-edit', 'partner\SpeakersController@saveEdit');
            Route::post('/{id}/speakers/import-csv', 'partner\SpeakersController@importCsv');
            Route::post('/{id}/speakers/check-import-csv', 'partner\SpeakersController@checkImportCsv');
            Route::post('/{id}/speakers/send-emails', 'partner\SpeakersController@sendEmails');
            Route::delete('/{id}/speakers/{speakerId}', 'partner\SpeakersController@saveDelete');
            
            // booths
            Route::get('/{id}/booths', 'partner\BoothsController@index');
            Route::post('/{id}/booths/save-edit', 'partner\BoothsController@saveEdit');
            Route::post('/{id}/booths/save-add-objects', 'partner\BoothsController@saveAddObjects');
            Route::get('/{id}/booths/{boothId}', 'partner\BoothsController@booth');
            
            // objects
            Route::get('/{id}/objects', 'partner\ObjectsController@index');
            Route::get('/{id}/objects/dashboard', 'partner\ObjectsController@dashboard');
            Route::post('/{id}/objects/save-create', 'partner\ObjectsController@saveCreate');
            Route::get('/{id}/objects/{objectId}', 'partner\ObjectsController@object');

            // event
            Route::get('/{id}/events/webinars', 'partner\EventsController@webinars');
            Route::get('/{id}/events/webinars/{webinarId}', 'partner\EventsController@webinar');
            Route::post('/{id}/events/webinars/save-create', 'partner\EventsController@saveCreate');
            Route::post('/{id}/events/webinars/save-edit', 'partner\EventsController@saveEdit');
            Route::delete('/{id}/events/webinars/{webinarId}', 'partner\EventsController@saveDelete');

        }); 

    });

    Route::group(['prefix' => 'speaker'], function(){
        Route::get('/', 'speaker\ToursController@index');   
        
        Route::group(['prefix' => 'tours'], function(){
            Route::get('/{id}', 'speaker\CalendarController@index');
            Route::get('/{id}/calendar', 'speaker\CalendarController@index');

            // speakers
            Route::get('/{id}/speakers', 'speaker\SpeakersController@index');
            Route::get('/{id}/speakers/{speakerId}/calendar', 'speaker\SpeakersController@calendar');
            Route::post('/{id}/speakers/save-create', 'speaker\SpeakersController@saveCreate');
            Route::post('/{id}/speakers/save-edit', 'speaker\SpeakersController@saveEdit');
            Route::post('/{id}/speakers/import-csv', 'speaker\SpeakersController@importCsv');
            Route::post('/{id}/speakers/check-import-csv', 'speaker\SpeakersController@checkImportCsv');
            Route::post('/{id}/speakers/send-emails', 'speaker\SpeakersController@sendEmails');
            Route::delete('/{id}/speakers/{speakerId}', 'speaker\SpeakersController@saveDelete');

            // event
            Route::get('/{id}/events/webinars', 'speaker\EventsController@webinars');
            Route::get('/{id}/events/webinars/{webinarId}', 'speaker\EventsController@webinar');
            Route::post('/{id}/events/webinars/{webinarId}/upload-documents', 'speaker\EventsController@uploadDocuments');
            Route::post('/{id}/events/webinars/{webinarId}/choose-documents', 'speaker\EventsController@chooseDocuments');
            Route::post('/{id}/events/webinars/{webinarId}/delete-document', 'speaker\EventsController@deleteDocument');
            Route::post('/{id}/events/webinars/{webinarId}/save-edit-webinar-detail', 'speaker\EventsController@saveEditWebinarDetail');
            // Route::post('/{id}/events/webinars/save-edit', 'speaker\EventsController@saveEdit');

            // documents
            Route::get('/{id}/documents', 'speaker\DocumentsController@index');
            Route::post('/{id}/documents/save-create', 'speaker\DocumentsController@saveCreate');
            Route::post('/{id}/documents/save-delete', 'speaker\DocumentsController@saveDelete');
        });

        
    });
   
    Route::group(['prefix' => 'profile'], function(){
        Route::get('/', 'ProfileController@index');
        Route::post('/save-edit', 'ProfileController@saveEdit');
        Route::post('/save-avatar', 'ProfileController@saveAvatar');
        Route::post('/save-cv', 'ProfileController@saveCv');
        Route::post('/delete-cv', 'ProfileController@deleteCv');
    });

});
