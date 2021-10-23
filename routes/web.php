<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

/*
|------------------------------------------
| Localization
|------------------------------------------
*/
Route::get('locale', function () {
    return \App::getLocale();
});

Route::get('locale/{locale}', function ($locale) {
    \Session::put('locale', $locale);
    return redirect()->back();
});



//Route::post('/language-chooser', 'LanguageController@changeLanguage');
Route::post('/language/', array('before' => 'csrf', 'as' => 'language-chooser', 'uses' => 'LanguageController@changeLanguage' ));

/*
|------------------------------------------
| Website
|------------------------------------------
*/

Route::redirect('/', '/admin');

##Route::redirect('/home', '/');



/*
|------------------------------------------
| Frontend
|------------------------------------------
*/


// Route::group( ['middleware' =>\App\Http\Middleware\Localization::class, 'namespace' => 'Website' ],function(){
//   Route::get('/', 'HomeController@index')->name('home');
//   Route::get('/contact-us', 'ContactUsController@index')->name('contactus');
//   Route::post('/contact-us/submit', 'ContactUsController@feedback')->name('feedback');

//   // gallery
//   Route::get('/gallery', 'GalleryController@index')->name('imagegallery');
//   Route::get('/gallery/{albumSlug}', 'GalleryController@showAlbum')->name('imagealbum');

//   // videos
//   //Route::group(['prefix' => 'videos'], function(){
//     Route::get('/videos', 'VideoController@index')->name('vid');
//     Route::get('/videos/category_id/{category_id}', 'VideoController@index')->name('by_video_categories');
//   //});
//   #Route::get('/videos/getdata', 'VideoController@getVideos')->name('getVideos');
//   Route::get('/videos/video_entry/{id}', 'VideoController@showAlbum')->name('showvideo');

//   // blog / articles
//   Route::get('/blog', 'BlogController@index')->name('blog');
//   Route::get('/blog/{articleSlug}', 'BlogController@show')->name('blogshow');

//   // news and events
//   Route::get('/news-and-events', 'NewsEventController@index')->name('news');
//   Route::get('/news-and-events/{newsSlug}', 'NewsEventController@show')->name('newsshow');
// });


/*
|------------------------------------------
| Frontend
|------------------------------------------
*/

// Route::group([ 'namespace' => 'Website'], function () {
//     Route::get('/', 'HomeController@index');
//     Route::get('/contact-us', 'ContactUsController@index');
//     Route::post('/contact-us/submit', 'ContactUsController@feedback');
//
//     // gallery
//     Route::get('/gallery', 'GalleryController@index');
//     Route::get('/gallery/{albumSlug}', 'GalleryController@showAlbum');
//
//     // videos
//     Route::get('/videos', 'VideoController@index')->name('vid');
//     Route::get('/videos/getdata', 'VideoController@getVideos')->name('getVideos');
//     Route::get('/videos/{id}', 'VideoController@showAlbum');
//
//     // blog / articles
//     Route::get('/blog', 'BlogController@index');
//     Route::get('/blog/{articleSlug}', 'BlogController@show');
//
//     // news and events
//     Route::get('/news-and-events', 'NewsEventController@index');
//     Route::get('/news-and-events/{newsSlug}', 'NewsEventController@show');
// });

/*
|------------------------------------------
| Website Account
|------------------------------------------
*/
Route::group(['middleware' => ['auth'], 'prefix' => 'account', 'namespace' => 'Website\Account'],
    function () {
        Route::get('/', 'AccountController@index')->name('account');
        Route::get('/profile', 'ProfileController@index')->name('profile');
        Route::post('/profile', 'ProfileController@update');
    });

/*
|------------------------------------------
| Authenticate User
|------------------------------------------
*/
Route::group(['prefix' => 'auth', 'namespace' => 'Auth'], function () {
    // logout (get or post)
    Route::any('logout', 'LoginController@logout')->name('logout');

    Route::group(['middleware' => 'guest'], function () {
        // login
        Route::get('login', 'LoginController@showLoginForm')->name('login');
        Route::post('login', 'LoginController@login');

        // // registration
        // Route::get('register/{token?}', 'RegisterController@showRegistrationForm')
        //      ->name('register');
        // Route::post('register', 'RegisterController@register');
        // Route::get('register/confirm/{token}', 'RegisterController@confirmAccount');

        // password reset
        Route::get('password/forgot', 'ForgotPasswordController@showLinkRequestForm')
            ->name('forgot-password');
        Route::post('password/email', 'ForgotPasswordController@sendResetLinkEmail');
        Route::get('password/reset/{token}', 'ResetPasswordController@showResetForm')
            ->name('password.reset');
        Route::post('password/reset', 'ResetPasswordController@reset');
    });
});


/*
|------------------------------------------
| RTMP
|------------------------------------------
*/
Auth::routes();
// function isUserAgent($type) {
//         return stripos($_SERVER['HTTP_USER_AGENT'],$type);
// }

Route::pattern('streamName', '[a-zA-Z0-9\-]+');
Route::pattern('playbackToken', '[a-zA-Z0-9\-]+');
Route::pattern('playbackTime', '[0-9]+');
Route::pattern('id', '[0-9]+');

#Route::get('/player/{streamName}', 'PlayerController@player');
Route::get('/auth', 'StreamController@auth');

/*
|------------------------------------------
| RTMP
|------------------------------------------
*/



/*
|------------------------------------------
| Admin (when authorized and admin)
|------------------------------------------
*/
Route::group(['middleware' => ['auth', 'auth.admin'], 'prefix' => 'admin', 'namespace' => 'Admin'],
    function () {
        Route::get('/', 'DashboardController@index')->name('admin');

        // profile
        Route::get('/profile', 'ProfileController@index');
        Route::put('/profile/{user}', 'ProfileController@update');

        // analytics
        Route::group(['prefix' => 'analytics'], function () {
            Route::get('/summary', 'AnalyticsController@summary');
            Route::get('/devices', 'AnalyticsController@devices');
            Route::get('/visits-and-referrals', 'AnalyticsController@visitsReferrals');
            Route::get('/interests', 'AnalyticsController@interests');
            Route::get('/demographics', 'AnalyticsController@demographics');
        });



        // stats
        Route::group(['prefix' => 'stats',  'namespace' => 'Stats'], function () {
            Route::get('/ip2location', 'Ip2locationController@index');
            Route::get('/ip2location/getStats', 'Ip2locationController@returnedRowedIpToLocations')->name('stats_datatable');
            Route::get('/ip2location/getRinvex', 'Ip2locationController@rinvexIncludeStats')->name('stats_rinvex');
        });

        // history
        Route::group(['prefix' => 'latest-activity', 'namespace' => 'History'], function () {
            Route::get('/', 'HistoryController@website');
            Route::get('/admin', 'HistoryController@admin');
            Route::get('/website', 'HistoryController@website');
        });

        Route::group(['prefix' => 'settings'], function () {
            Route::resource('tags', 'TagsController');

            Route::get('/banners/order', 'BannersOrderController@index');
            Route::post('/banners/order', 'BannersOrderController@update');
            Route::resource('banners', 'BannersController');

            Route::resource('clients', 'ClientsController');
            Route::post('clients/password/email', 'ClientsController@sendResetLinkEmail');
            Route::post('clients/resend/{id}','ClientsController@reSendActivationEmail');
        });

        // Sidebars
        Route::group(['prefix' => 'sidebars', 'namespace' => 'Sidebars'], function(){
            Route::resource('/list', 'SidebarController');
            Route::post('/list/{id}/edit/order', 'SidebarController@updateOrder');
            Route::resource('/list/{sidebar_id}/moduls', 'ModulsToSidebarsController');
            Route::resource('/weather', 'WeatherController');

            // Route::get('/', 'SidebarController@index');
            // Route::get('/create', 'SidebarController@create');
            // Route::get('/{id}', 'SidebarController@show');
            // Route::get('/{id}/edit', 'SidebarController@edit');
            // Route::delete('/{id}/edit', 'SidebarController@destroy');
            // Route::put('/{id}', 'SidebarController@update');
        });


        // pages order
        Route::group(['prefix' => 'pages', 'namespace' => 'Pages'], function () {
            Route::get('/order/{type?}', 'OrderController@index');
            Route::post('/order/{type?}', 'OrderController@updateOrder');

            // manage page sections list order
            Route::get('/{page}/sections', 'PageContentController@index');
            Route::post('/{page}/sections/order', 'PageContentController@updateOrder');
            Route::delete('/{page}/sections/{section}', 'PageContentController@destroy');

            // page components
            Route::resource('/{page}/sections/content', 'PageContentController');
        });
        Route::resource('pages', 'Pages\PagesController');

        // blog
        Route::group(['prefix' => 'blog', 'namespace' => 'Blog'], function () {
            Route::get('/', function () {
                return redirect('/admin/blog/articles');
            });
            Route::resource('categories', 'CategoriesController');
            Route::resource('articles', 'ArticlesController');
        });

        // news and events
        Route::group(['prefix' => 'news-and-events', 'namespace' => 'NewsEvents'], function () {
            Route::resource('news', 'NewsController');
            Route::resource('categories', 'CategoriesController');
        });

        // video_records
        Route::group(['prefix' => 'video-records', 'namespace' => 'VideoRecords'], function () {

            Route::resource('player-settings', 'PlayerSettingsController', ['except' => 'show']);
            Route::get('show_modal/{id}', 'PlayerSettingsController@show')->name('datatable/showPlayerSettings');


            Route::resource('videos', 'VideoRecordsController', ['except' => 'show']);
            Route::get('datatable/getdata', 'VideoRecordsController@getVideos')->name('datatable/getVideos');
            Route::get('datatable/getVideoDetailes/{id}', 'VideoRecordsController@getVideoDetailes')->name('datatable/getVideoDetailes');
            Route::get('datatable/getvideo/{id}', 'VideoRecordsController@getVideoByid')->name('datatable/getVideoByid');

            Route::get('datatable/massDelete', 'VideoRecordsController@massDelete')->name('datatable.massDelete');

            Route::get('datatable/massAddToPlaylist', 'VideoRecordsController@massAddToPlaylist')->name('datatable.massAddToPlaylist');
            Route::get('datatable/updateThmbnailWithCover', 'VideoRecordsController@updateThmbnailWithCover')->name('datatable/updateThmbnailWithCover');
            Route::resource('video-record-categories', 'VideoRecordsCategoriesController');
            Route::resource('video-record-images', 'VideoRecordImagesController', ['except' => 'show']);
            Route::get('video-record-images/datatable/getdata', 'VideoRecordImagesController@getVideoImages')->name('datatable/getVideoImages');

            Route::group(['prefix' => 'video-record-playlists'], function () {
                Route::resource('/', 'VideoRecordPlaylists');
                Route::get('show_modal/{id}', 'VideoRecordPlaylists@show')->name('datatable/showPlaylist');
                Route::get('mass_delete', 'VideoRecordPlaylists@massRemoveFromPlaylist')->name('video-record-playlists.massRemoveFromPlaylist');
            });



              //Route::get('/{id}', 'PlayerSettingsController@show');
              //  Route::get('/{id}/edit', 'PlayerSettingsController@edit');
               //resource($name, $controller, array $options = [])





            Route::get('/video-record-images/{videoRecord}', 'VideoRecordImagesController@showNewsPhotos');
            Route::post('/video-record-images/upload', 'VideoRecordImagesController@uploadPhotos');
            Route::delete('/{id}', 'PhotosController@destroy');
            Route::post('/video-record-images/{videoRecord}/cover', 'VideoRecordImagesController@updatePhotoCover');

            Route::resource('/live-stream', 'LiveController', ['except' => ['show','update']]);





            Route::get('/live-stream/getipstats', 'LiveController@getipstats');
            Route::get('/live-stream/player/{id}/saveAsTxt/{slug}/key/{key}', 'LiveController@saveAsTxt');
            Route::post('/archive/{id}/time/{time}', 'VideoRecordsController@archive');

        });


      // gallery / photos
      Route::group(['prefix' => 'images', 'namespace' => 'Images'], function () {
        Route::get('/category', 'ImageCategoryController@index');
        Route::get('/category/{id}/edit', 'ImageCategoryController@edit')->name('editImageCategory');

        Route::get('/photos', 'ImageController@index');
        Route::get('/images/getImages', 'ImageController@returnedRowedImages')->name('archive_images');
        Route::get('/images/getCategories', 'ImageCategoryController@returnedTree')->name('returnedTree');
      });



        // gallery / photos
        Route::group(['prefix' => 'photos', 'namespace' => 'Photos'], function () {
            Route::get('/', 'PhotosController@index');
            Route::delete('/{photo}', 'PhotosController@destroy');
            Route::post('/upload', 'PhotosController@uploadPhotos');
            Route::post('/{photo}/edit/name', 'PhotosController@updatePhotoName');
            Route::post('/{photo}/cover', 'PhotosController@updatePhotoCover');

            // photoables
            Route::get('/news/{news}', 'PhotosController@showNewsPhotos');
            Route::get('/articles/{article}', 'PhotosController@showArticlePhotos');

            Route::resource('/albums', 'AlbumsController', ['except' => 'show']);
            Route::get('/albums/{album}', 'PhotosController@showAlbumPhotos');

            // croppers
            Route::post('/crop/{photo}', 'CropperController@cropPhoto');
            Route::get('/news/{news}/crop/{photo}', 'CropperController@showNewsPhoto');
            Route::get('/albums/{album}/crop/{photo}', 'CropperController@showAlbumsPhoto');
            Route::get('/articles/{article}/crop/{photo}', 'CropperController@showArticlesPhoto');

            // resource image crop
            Route::post('/crop-resource', 'CropResourceController@cropPhoto');
            Route::get('/banners/{banner}/crop-resource/', 'CropResourceController@showBanner');
        });

        // corporate
        Route::group(['prefix' => 'newsletter', 'namespace' => 'Newsletter'], function () {
            Route::resource('subscribers', 'SubscribersController');
        });

        // documents
        Route::group(['prefix' => 'documents', 'namespace' => 'Documents'], function () {
            // documents
            Route::get('/', 'DocumentsController@index');
            Route::delete('/{document}', 'DocumentsController@destroy');
            Route::post('/upload', 'DocumentsController@upload');
            Route::post('/{document}/edit/name', 'DocumentsController@updateName');

            // documentable
            Route::get('/category/{category}', 'DocumentsController@showCategory');

            // categories
            Route::resource('/categories', 'CategoriesController');
        });

        // reports
        Route::group(['prefix' => 'reports', 'namespace' => 'Reports'], function () {
            Route::get('summary', 'SummaryController@index');

            // feedback contact us
            Route::get('contact-us', 'ContactUsController@index');
            Route::post('contact-us/chart', 'ContactUsController@getChartData');
            Route::get('contact-us/datatable', 'ContactUsController@getTableData');
        });

        Route::group(['prefix' => 'settings', 'namespace' => 'Settings'], function () {
            Route::resource('roles', 'RolesController');

            // settings
            Route::resource('settings', 'SettingsController');

            // users
            Route::get('administrators/invites', 'AdministratorsController@showInvites');
            Route::post('administrators/invites', 'AdministratorsController@postInvite');
            Route::resource('administrators', 'AdministratorsController');

            // navigation
            Route::get('navigation/order', 'NavigationOrderController@index');
            Route::post('navigation/order', 'NavigationOrderController@updateOrder');
            Route::get('navigation/datatable', 'NavigationController@getTableData');
            Route::resource('navigation', 'NavigationController');
        });
    });

/*
|--------------------------------------------------------------------------
| AJAX ROUTES
|--------------------------------------------------------------------------
*/
Route::group(['prefix' => 'ajax', 'namespace' => 'Ajax', 'middleware' => 'web'], function () {
    // logs
    Route::group(['prefix' => 'log'], function () {
        Route::post('social-media', 'LogsController@socialMedia');
    });
});

/*
|--------------------------------------------------------------------------
| Website Dynamic Pages
|--------------------------------------------------------------------------
*/
Route::group(['namespace' => 'Website'], function () {
    Route::get('{slug1}/{slug2?}/{slug3?}', 'PagesController@index');
});
Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
