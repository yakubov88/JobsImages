<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of the routes that are handled
| by your application. Just tell Laravel the URIs it should respond
| to using a Closure or controller method. Build something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('upload', 'UploadsController@index');
Route::post('upload/uploadFiles', 'UploadsController@multiple_upload');
Route::get('getjobs', 'UploadsController@getJobs');