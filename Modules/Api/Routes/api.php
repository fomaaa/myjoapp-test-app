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

Route::group(['middleware' => 'api'], function () {
    //Get Entities list routes
    Route::get('user', 'UserController@index');
    Route::get('vehicle', 'VehicleController@index');

    //Driving Routes
    Route::get('drive-list', 'DrivingController@list');
    Route::post('drive', 'DrivingController@drive');
    Route::post('stop', 'DrivingController@stop');
    Route::post('stop/user/{id}', 'DrivingController@stopByUser');
    Route::post('stop/vehicle/{id}', 'DrivingController@stopByVehicle');
});

