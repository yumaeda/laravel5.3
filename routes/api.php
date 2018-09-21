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

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:api');


/* GET */
Route::get('/v1/importers', 'Wines@importer');
Route::get('/v1/wine-sets/{id?}', 'WineSets@find');
Route::get('/v1/set-wines/{id}', 'SetWines@find');
Route::get('/v1/preorder-wines/{type?}', 'PreorderWines@find');
Route::get('/v1/preorder-wines/creation/date', 'PreorderWines@creationDate');
Route::get('/v1/new-wines', 'NewWines@index');
Route::get('/v1/ranking-wines', 'RankingWines@index');
Route::get('/v1/producers/{region}', 'ProducerDetails@region');
Route::get('/v1/producer-details/{name?}', 'ProducerDetails@find');
Route::get('/v1/region-details/{region}', 'RegionDetails@find');
Route::get('/v1/wines/{id?}', 'Wines@find');
Route::get('/v1/wine-details/{producer}', 'Wines@detail');
Route::get('/v1/countries/{type?}', 'Wines@getCounties');
Route::get('/v1/villages/{region}/{type?}', 'Wines@getVillages');
Route::get('/v1/regions/{country?}/{type?}', 'Wines@getRegions');
Route::get('/v1/districts/{region?}/{type?}', 'Wines@getDistricts');
Route::get('/v1/delivered-wines', 'GoodsIssues@index');

/* POST */
Route::post('/v1/delivered-wines', 'GoodsIssues@store');

/* DELETE */
Route::delete('/v1/producer-details/{name}', 'ProducerDetails@delete');
Route::delete('/v1/delivered-wines/{id?}', 'GoodsIssues@delete');
