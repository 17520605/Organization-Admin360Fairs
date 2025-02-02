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
            Route::post('/{id}/tour/publictour', 'administrator\TourController@publicTour');
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
            Route::get('/{id}/booths/requests', 'administrator\BoothsController@request');
            Route::get('/{id}/booths/booth', 'administrator\BoothsController@booth');
            Route::post('/{id}/booths/save-create', 'administrator\BoothsController@saveCreate');
            Route::post('/{id}/booths/save-edit', 'administrator\BoothsController@saveEdit');
            Route::post('/{id}/booths/save-approve', 'administrator\BoothsController@saveApprove');
            Route::post('/{id}/booths/save-reject', 'administrator\BoothsController@saveReject');
            Route::post('/{id}/booths/save-reedit', 'administrator\BoothsController@saveReedit');
            Route::post('/{id}/booths/grant-owner', 'administrator\BoothsController@grantOwner');
            Route::get('/{id}/booths/{boothId}', 'administrator\BoothsController@booth');
            Route::post('/{id}/booths/{boothId}/change-logo', 'administrator\BoothsController@changeLogo');
            Route::delete('/{id}/booths/{boothId}', 'administrator\BoothsController@saveDelete');

            // assets
            Route::get('/{id}/assets', 'administrator\AssetsController@index');
            Route::get('/{id}/assets/{assetId}', 'administrator\AssetsController@object');
            Route::get('/{id}/assets/{assetId}/get-infor', 'administrator\AssetsController@getInfor');
            Route::post('/{id}/assets/save-create', 'administrator\AssetsController@saveCreate');
            Route::post('/{id}/assets/save-edit-name', 'administrator\AssetsController@saveEditName');
            Route::delete('/{id}/assets/{assetId}/save-delete', 'administrator\AssetsController@saveDelete');

            // event
            Route::get('/{id}/events/webinars', 'administrator\EventsController@webinars');
            Route::get('/{id}/events/webinars/schedule', 'administrator\EventsController@schedule');
            Route::get('/{id}/events/webinars/requests', 'administrator\EventsController@requests');
            Route::get('/{id}/events/webinars/create', 'administrator\EventsController@create');
            Route::get('/{id}/events/webinars/{webinarId}', 'administrator\EventsController@webinar');
            Route::get('/{id}/events/webinars/{webinarId}/edit', 'administrator\EventsController@edit');
            Route::post('/{id}/events/webinars/save-create', 'administrator\EventsController@saveCreate');
            Route::post('/{id}/events/webinars/save-edit', 'administrator\EventsController@saveEdit');
            Route::post('/{id}/events/webinars/save-approve', 'administrator\EventsController@saveApprove');
            Route::post('/{id}/events/webinars/save-reject', 'administrator\EventsController@saveReject');
            Route::post('/{id}/events/webinars/save-reedit', 'administrator\EventsController@saveReedit');
            Route::delete('/{id}/events/webinars/{webinarId}', 'administrator\EventsController@saveDelete');

            Route::get('/{id}/articles/', 'administrator\ArticlesController@index');
            Route::get('/{id}/articles/create', 'administrator\ArticlesController@create');
            Route::post('/{id}/articles/save-create', 'administrator\ArticlesController@saveCreate');
            Route::get('/{id}/articles/{articleId}/edit/', 'administrator\ArticlesController@edit');
            Route::post('/{id}/articles/{articleId}/save-edit/', 'administrator\ArticlesController@saveEdit');
            Route::post('/{id}/articles/{articleId}/toggle-visiable', 'administrator\ArticlesController@toggleVisiable');
            Route::delete('/{id}/articles/{articleId}', 'administrator\ArticlesController@delete');

            // views
            Route::get('/{id}/viewer', 'administrator\ViewerController@index');

            // comments
            Route::post('/{id}/comments/show-comment', 'administrator\CommentController@showComment');
            Route::post('/{id}/comments/hide-comment', 'administrator\CommentController@hideComment');

            // interest
            Route::get('/{id}/interest', 'administrator\InterestController@index');

            // request
            Route::get('/{id}/requests', 'administrator\RequestsController@index');
            Route::get('/{id}/requests/get-request-count', 'administrator\RequestsController@getRequestCount');

            // notifications
            Route::get('/{id}/notifications', 'administrator\NotificationsController@index');
            Route::get('/{id}/notifications/get-unseen', 'administrator\NotificationsController@getUnseen');
            Route::get('/{id}/notifications/get-all', 'administrator\NotificationsController@getAll');
            Route::post('/{id}/notifications/{notificationId}/set-seen', 'administrator\NotificationsController@setSeen');

            // settings
            Route::get('/{id}/settings', 'administrator\SettingsController@index');
            Route::post('/{id}/settings/save-configs-color', 'administrator\SettingsController@saveConfigsColor');
        }); 
    });

    Route::group(['prefix' => 'partner'], function(){
        Route::get('/', 'partner\ToursController@index');
        Route::get('/tours', 'partner\ToursController@index');

        Route::group(['prefix' => 'booths'], function(){
            // // speakers
            // Route::get('/{id}/speakers', 'partner\SpeakersController@index');
            // Route::get('/{id}/speakers/{speakerId}/calendar', 'partner\SpeakersController@calendar');
            // Route::post('/{id}/speakers/save-create', 'partner\SpeakersController@saveCreate');
            // Route::post('/{id}/speakers/save-edit', 'partner\SpeakersController@saveEdit');
            // Route::post('/{id}/speakers/import-csv', 'partner\SpeakersController@importCsv');
            // Route::post('/{id}/speakers/check-import-csv', 'partner\SpeakersController@checkImportCsv');
            // Route::post('/{id}/speakers/send-emails', 'partner\SpeakersController@sendEmails');
            // Route::delete('/{id}/speakers/{speakerId}', 'partner\SpeakersController@saveDelete');
            
            // booth
            Route::get('/{id}', 'partner\BoothController@index');
            Route::post('/{id}/save-edit', 'partner\BoothController@saveEdit');
            Route::post('/{id}/save-request', 'partner\BoothController@saveRequest');
            Route::post('/{id}/save-cancel', 'partner\BoothController@saveCancel');
            Route::post('/{id}/save-add-objects', 'partner\BoothController@saveAddObjects');
            
            // objects
            // Route::get('/{id}/objects', 'partner\ObjectsController@index');
            // Route::get('/{id}/objects/dashboard', 'partner\ObjectsController@dashboard');
            // Route::post('/{id}/objects/save-create', 'partner\ObjectsController@saveCreate');
            // Route::get('/{id}/objects/{objectId}', 'partner\ObjectsController@object');

            // assets
            Route::get('/{id}/assets', 'partner\AssetsController@index');
            Route::get('/{id}/assets/{assetId}', 'partner\AssetsController@object');
            Route::get('/{id}/assets/{assetId}/get-infor', 'partner\AssetsController@getInfor');
            Route::post('/{id}/assets/save-create', 'partner\AssetsController@saveCreate');
            Route::post('/{id}/assets/save-edit-name', 'partner\AssetsController@saveEditName');
            Route::delete('/{id}/assets/{assetId}/save-delete', 'partner\AssetsController@saveDelete');

            // event
            Route::get('/{id}/events/webinars', 'partner\EventsController@webinars');
            Route::get('/{id}/events/webinars/schedule', 'partner\EventsController@schedule');
            Route::get('/{id}/events/webinars/create', 'partner\EventsController@create');
            Route::get('/{id}/events/webinars/{webinarId}', 'partner\EventsController@webinar');
            Route::get('/{id}/events/webinars/{webinarId}/edit', 'partner\EventsController@edit');
            Route::post('/{id}/events/webinars/save-create', 'partner\EventsController@saveCreate');
            Route::post('/{id}/events/webinars/save-edit', 'partner\EventsController@saveEdit');
            Route::post('/{id}/events/webinars/save-register', 'partner\EventsController@saveRegister');
            Route::post('/{id}/events/webinars/save-cancel', 'partner\EventsController@saveCancel');
            Route::delete('/{id}/events/webinars/{webinarId}', 'partner\EventsController@saveDelete');

            // notifications
            Route::get('/{id}/notifications', 'partner\NotificationsController@index');
            Route::get('/{id}/notifications/get-unseen', 'partner\NotificationsController@getUnseen');
            Route::get('/{id}/notifications/get-all', 'partner\NotificationsController@getAll');
            Route::post('/{id}/notifications/{notificationId}/set-seen', 'administrator\NotificationsController@setSeen');
            
        }); 

    });

    Route::group(['prefix' => 'speaker'], function(){
        Route::get('/', 'speaker\ToursController@index'); 
        Route::get('/tours', 'speaker\ToursController@index');  
        
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
            Route::get('/{id}/events/webinars/schedule', 'speaker\EventsController@schedule');
            Route::get('/{id}/events/webinars/create', 'speaker\EventsController@create');
            Route::get('/{id}/events/webinars/{webinarId}', 'speaker\EventsController@webinar');
            Route::get('/{id}/events/webinars/{webinarId}/edit', 'speaker\EventsController@edit');
            Route::post('/{id}/events/webinars/save-create', 'speaker\EventsController@saveCreate');
            Route::post('/{id}/events/webinars/save-edit', 'speaker\EventsController@saveEdit');
            Route::post('/{id}/events/webinars/save-register', 'speaker\EventsController@saveRegister');
            Route::post('/{id}/events/webinars/save-cancel', 'speaker\EventsController@saveCancel');
            Route::delete('/{id}/events/webinars/{webinarId}', 'speaker\EventsController@saveDelete');

            // event
            Route::get('/{id}/events/webinars', 'speaker\EventsController@webinars');
            Route::get('/{id}/events/webinars/{webinarId}', 'speaker\EventsController@webinar');
            Route::post('/{id}/events/webinars/{webinarId}/upload-documents', 'speaker\EventsController@uploadDocuments');
            Route::post('/{id}/events/webinars/{webinarId}/choose-documents', 'speaker\EventsController@chooseDocuments');
            Route::post('/{id}/events/webinars/{webinarId}/delete-document', 'speaker\EventsController@deleteDocument');
            Route::post('/{id}/events/webinars/{webinarId}/save-edit-webinar-detail', 'speaker\EventsController@saveEditWebinarDetail');
            Route::post('/{id}/events/webinars/save-edit', 'speaker\EventsController@saveEdit');

            // documents
            Route::get('/{id}/documents', 'speaker\DocumentsController@index');
            Route::post('/{id}/documents/save-create', 'speaker\DocumentsController@saveCreate');
            Route::post('/{id}/documents/save-delete', 'speaker\DocumentsController@saveDelete');
        });

        
    });
   
    Route::group(['prefix' => 'profile'], function(){
        Route::get('/', 'ProfileController@index');
        Route::post('/save-edit', 'ProfileController@saveEdit');
        Route::post('/save-configs-color', 'ProfileController@saveConfigsColor');
        Route::post('/save-edit-image-popular', 'ProfileController@saveEditPopularImages');
        Route::post('/save-avatar', 'ProfileController@saveAvatar');
        Route::post('/save-logo', 'ProfileController@saveLogo');
        Route::post('/save-cv', 'ProfileController@saveCv');
        Route::post('/delete-cv', 'ProfileController@deleteCv');
        Route::post('/save-background', 'ProfileController@saveBackground');
        Route::post('/delete-background', 'ProfileController@deleteBackground');
        Route::post('/save-vd', 'ProfileController@saveVd');
        Route::post('/delete-vd', 'ProfileController@deleteVd');
    });

});
