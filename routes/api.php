<?php

use Illuminate\Http\Request;
use App\Models\VideoRecords;
use App\Models\VideoRecordImages;
use App\Models\VideoRecordsCategory;


/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

/*
|------------------------------------------
| PUBLIC API
|------------------------------------------
*/
Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
Route::group(['namespace' => 'Api'], function () { // 'middleware' => ['auth:api'],
    // notifications
    Route::group(['prefix' => 'notifications',], function () {
        Route::post('/{user}', 'NotificationsController@index');
        Route::post('/{user}/unread', 'NotificationsController@unread');
        Route::post('/{user}/read/{notification}', 'NotificationsController@read');

        Route::post('/actions/latest', 'NotificationsController@getLatestActions');
    });

    Route::group(['prefix' => 'stats'], function () {
      Route::post('/get_stats_bars', 'Ip2locationController@returnedRowedIpToLocations');
    });

    // analytics
    Route::group(['prefix' => 'analytics'], function () {
        Route::post('/keywords', 'AnalyticsController@getKeywords');
        Route::post('/visitors', 'AnalyticsController@getVisitors');
        Route::post('/browsers', 'AnalyticsController@getBrowsers');
        Route::post('/referrers', 'AnalyticsController@getReferrers');
        Route::post('/page-load', 'AnalyticsController@getAvgPageLoad');
        Route::post('/bounce-rate', 'AnalyticsController@getBounceRate');
        Route::post('/visited-pages', 'AnalyticsController@getVisitedPages');
        Route::post('/active-visitors', 'AnalyticsController@getActiveVisitors');
        Route::post('/unique-visitors', 'AnalyticsController@getUniqueVisitors');
        Route::post('/visitors-views', 'AnalyticsController@getVisitorsAndPageViews');
        Route::post('/visitors/locations', 'AnalyticsController@getVisitorsLocations');

        Route::post('/age', 'AnalyticsController@getUsersAge');
        Route::post('/devices', 'AnalyticsController@getDevices');
        Route::post('/gender', 'AnalyticsController@getUsersGender');
        Route::post('/device-category', 'AnalyticsController@getDeviceCategory');

        Route::post('/interests-other', 'AnalyticsController@getInterestsOther');
        Route::post('/interests-market', 'AnalyticsController@getInterestsMarket');
        Route::post('/interests-affinity', 'AnalyticsController@getInterestsAffinity');
    });

    Route::post('/newsletter/subscribe', 'NewsletterController@subscribe');
    Route::group(['prefix' => 'videos'], function(){
      Route::post('/action', 'VideoRecordsController@index')->middleware('apiKey');
      Route::get('/action/{page}/{limit}/{category}', 'VideoRecordsController@listing');
    });

    // stats
    Route::group(['prefix' => 'stats'], function () {
        Route::get('/', 'Ip2locationController@index');
        Route::post('/insert', 'Ip2locationController@insertEntry');
    });
});

Route::group(['prefix'=>'v1','middleware' => 'auth:api'], function() {
	Route::put('/user', 'LoggedUserController@update');
});
