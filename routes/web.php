<?php
Auth::routes();
Route::get('/', 'HomeController@index');
Route::get('/home', 'HomeController@index')->name('home');
// Auth::routes(['register' => false]);
Route::post('userlogin','Auth\\LoginController@authenticate')->name('userlogin');
// Route::get('/hashunhashed','UserController@hashunhashed');
Route::group( ['prefix' => 'admin','middleware' => 'auth' ], function()
{
    Route::get('/', 'Admin\DashboardController@highlight');
    Route::get('/highlight', 'Admin\DashboardController@highlight');
    Route::get('/dashboard', 'Admin\DashboardController@dashboard');
    Route::get('/adsperformance', 'Admin\CommercialController@index');
    Route::post('/adsperformance/indexjson', 'Admin\CommercialController@indexjson');
    Route::get('/tvads', 'Admin\VideoController@tvads');
    Route::get('/tvprogramme', 'Admin\VideoController@tvprogramme');
    Route::get('/mktsummary', 'Admin\MarketingController@mktsummary');
    Route::get('/adexnett', 'Admin\MarketingController@adexnett');
    Route::get('/spotmatching', 'Admin\MarketingController@spotmatching');
    /**/
    Route::get('/uploaddata/commercial', 'Admin\Uploaddata\CommercialController@index');
    Route::post('/uploaddata/commercial/upload', 'Admin\Uploaddata\CommercialController@upload');
    Route::post('/uploaddata/commercial/indexjson', 'Admin\Uploaddata\CommercialController@indexjson');
    Route::get('/uploaddata/commercialgrouped', 'Admin\Uploaddata\CommercialgroupedController@index');
    Route::post('/uploaddata/commercialgrouped/upload', 'Admin\Uploaddata\CommercialgroupedController@upload');
    Route::post('/uploaddata/commercialgrouped/indexjson', 'Admin\Uploaddata\CommercialgroupedController@indexjson');
    Route::get('/uploaddata/tvprogramme', 'Admin\Uploaddata\TvprogrammeController@index');
    Route::post('/uploaddata/tvprogramme/upload', 'Admin\Uploaddata\TvprogrammeController@upload');
    Route::post('/uploaddata/tvprogramme/indexjson', 'Admin\Uploaddata\TvprogrammeController@indexjson');
    Route::get('/uploaddata/adexnett', 'Admin\Uploaddata\AdexnettController@index');
    Route::post('/uploaddata/adexnett/upload', 'Admin\Uploaddata\AdexnettController@upload');
    Route::post('/uploaddata/adexnett/indexjson', 'Admin\Uploaddata\AdexnettController@indexjson');
    Route::get('/uploaddata/spotmatching', 'Admin\Uploaddata\SpotmatchingController@index');
    Route::post('/uploaddata/spotmatching/upload', 'Admin\Uploaddata\SpotmatchingController@upload');
    Route::post('/uploaddata/spotmatching/indexjson', 'Admin\Uploaddata\SpotmatchingController@indexjson');
    Route::get('/uploaddata/spotunpaired', 'Admin\Uploaddata\SpotunpairedController@index');
    Route::post('/uploaddata/spotunpaired/upload', 'Admin\Uploaddata\SpotunpairedController@upload');
    Route::post('/uploaddata/spotunpaired/indexjson', 'Admin\Uploaddata\SpotunpairedController@indexjson');
    /**/
    Route::get('/uploadsearch/commercial', 'Admin\Uploadsearch\CommercialController@index');
    Route::post('/uploadsearch/commercial/upload', 'Admin\Uploadsearch\CommercialController@upload');
    Route::post('/uploadsearch/commercial/indexjson', 'Admin\Uploadsearch\CommercialController@indexjson');
    Route::get('/uploadsearch/tvprogramme', 'Admin\Uploadsearch\TvprogrammeController@index');
    Route::post('/uploadsearch/tvprogramme/upload', 'Admin\Uploadsearch\TvprogrammeController@upload');
    Route::post('/uploadsearch/tvprogramme/indexjson', 'Admin\Uploadsearch\TvprogrammeController@indexjson');
    Route::get('/uploadsearch/adstype', 'Admin\Uploadsearch\AdstypeController@index');
    Route::post('/uploadsearch/adstype/upload', 'Admin\Uploadsearch\AdstypeController@upload');
    Route::post('/uploadsearch/adstype/indexjson', 'Admin\Uploadsearch\AdstypeController@indexjson');
    /**/
    Route::get('/spotpairing', 'Admin\DashboardController@spotpairing');
    Route::get('/videodata', 'Admin\DashboardController@videodata');
    Route::get('/targetaudience', 'Admin\DashboardController@targetaudience');
    Route::get('/user/indexjson','Admin\UserController@indexjson');
    Route::get('/user/csvall','Admin\UserController@csvall');
    Route::get('/user/destroymulti','Admin\UserController@destroymulti');
    Route::resource('/user', 'Admin\UserController');
    Route::get('/role/indexjson','Admin\RoleController@indexjson');
    Route::get('/role/csvall','Admin\RoleController@csvall');
    Route::get('/role/destroymulti','Admin\RoleController@destroymulti');
    Route::resource('/role', 'Admin\RoleController');
    
});