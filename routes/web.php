<?php


Route::get('/', 'App\Http\Controllers\UploadController@index');
Route::post('/store', 'App\Http\Controllers\UploadController@store');
Route::get('download/{file}','App\Http\Controllers\UploadController@download');
Route::delete('remove/{file}','App\Http\Controllers\UploadController@destroy');
