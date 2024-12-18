<?php


Route::get('/', 'App\Http\Controllers\UploadController@index');
Route::post('/upload/store', 'App\Http\Controllers\ReportController@store');
Route::get('download/{file}','App\Http\Controllers\UploadController@download');
Route::delete('remove/{file}','App\Http\Controllers\UploadController@destroy');
Route::get('/report/download','App\Http\Controllers\ReportController@downloadReport');
