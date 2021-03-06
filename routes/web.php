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

Route::get('/', function () {
    return view('welcome');
});

// regist of api
Route::get('/regist/index', 'apiController@indexAction');
// registration process of api
Route::get('/regist/indexexecute', 'apiController@indexexecute');
Route::post('/regist/indexexecute', 'apiController@indexexecute');
// API description 
Route::get('/doc', 'apiController@docAction');

// basic API URL
Route::get('/api', 'apiController@apiAction');


