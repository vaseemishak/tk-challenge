<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::group(["middleware" => ["api"], "namespace" => 'Api', "as" => 'api.'], function (){

    /**
     * Device Routes
     */
    Route::post('/device', 'DeviceController@store')->name('device.store');
    Route::post('/device/get-access-token', 'DeviceController@getDeviceAccessToken')->name('device.get-access-token');
    Route::get('/device', 'DeviceController@show')->name('device.show');
    Route::patch('/device', 'DeviceController@update')->name('device.update');


    /**
     * Song Routes
     */
    Route::get('/song/categories', 'SongController@categories')->name('song.categories');
    Route::get('/song/category/{category_id}', 'SongController@listWithCategory')->name('song.list.category');
    Route::get('/song/{song_id}/favorite', 'SongController@favorite')->name('song.favorite');
    Route::get('/song/{song_id}/unfavorite', 'SongController@unfavorite')->name('song.unfavorite');
});