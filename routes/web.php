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


// regist of cash
Route::get('/cash/index', 'cashController@indexAction');
// regist execute
Route::get('/cash/indexexecute', 'cashController@indexexecute');
Route::post('/cash/indexexecute', 'cashController@indexexecute');
// cash list
Route::get('/cash/list', 'cashController@listAction');
// delete of cash list
Route::get('/cash/deleteexecute', 'cashController@deleteexecute');
// fetch detail by id
Route::get('/cash/fetch/detail', 'cashController@fetch_detail_by_id');
// constant regist cash of list
Route::get('/cash/constant/list', 'cashController@constantListAction');
// delete of constant cash data
Route::get('/cash/constant/deleteexecute', 'cashController@constantDeleteexecute');
