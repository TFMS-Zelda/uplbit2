<?php

use Illuminate\Http\Request;

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

Route::get('/getAllArticlesByIdProvider/{id}', 'Api\ArticleController@getAllArticlesByIdProvider');

// assigns computer vue.js
Route::get('/assignments/computers', 'Api\RelationshipConfigurationController@getComputers');
Route::get('computers', 'Api\RelationshipConfigurationController@allComputersByAssign');

// assigns tablets vue.js
Route::get('/assignments/tablets', 'Api\RelationshipConfigurationController@getTablets');
Route::get('tablets', 'Api\RelationshipConfigurationController@allTabletsByAssign');

// assigns monitors vue.js
Route::get('/assignments/monitors', 'Api\RelationshipConfigurationController@getMonitors');
Route::get('monitors', 'Api\RelationshipConfigurationController@allMonitorsByAssign');

// assigns perisfericos vue.js
Route::get('/assignments/other-peripherals', 'Api\RelationshipConfigurationController@getOtherPeripherals');
Route::get('other-peripherals', 'Api\RelationshipConfigurationController@allOtherPeripheralsByAssign');