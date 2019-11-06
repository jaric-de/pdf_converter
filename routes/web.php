<?php

declare(strict_types = 1);

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
Route::get('files', 'FileController@index')->name('uploaded.files');
Route::get('files/create', 'FileController@create')->name('upload.page');
Route::post('files/store', 'FileController@store')->name('upload.file');
Route::get('files/{file}/{extension}/download', 'FileController@download')->name('download.file');
Route::post('files/{file}/convert', 'FileController@convert')->name('convert.file');
