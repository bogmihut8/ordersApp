<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', 'ClientController@index');

Route::auth();

Route::get('register', 'HomeController@abort');

Route::get('/facturi', 'HomeController@index');

Route::resource('user','UserController');

Route::resource('client','ClientController');

Route::resource('order','OrderController');

Route::resource('subcontractor', 'SubcontractorController');

Route::get('/downloadPDF/{id}','OrderController@downloadPDF');
Route::post('/downloadPartialPDF/{id}','OrderController@downloadPartialPDF');

Route::post('/updateState/{id}/{newState}','OrderController@updateState');
Route::get('/updateState/{id}/{newState}','OrderController@updateState');

Route::post('/update/{id}','OrderController@update');


Route::get('/deleteOrder/{id}','OrderController@destroy');
Route::post('/facturi', 'OrderController@search');

Route::post('/client/{id}/orders', 'OrderController@searchPerClient');

Route::post('/updateState/{id}','OrderController@updateOrderData');

Route::get('/client/{id}/orders','OrderController@clientOrders');

Route::get('/duplicate/{id}','OrderController@duplicate');

Route::post('/storeAfterDuplicate','OrderController@storeAfterDuplicate');