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

Auth::routes();

Route::get('/', 'UnitController@index')->name('home');

Route::resource('/user', 'UserController');
Route::resource('/units', 'UnitController');
Route::resource('/cell', 'CellController');
Route::resource('/term', 'TermController');
Route::get('/unit/{unit}/systems', 'RelationController@unitRelation');
Route::get('/department/{department}/blocks', 'RelationController@depRelation');
Route::get('/block/{block}/cells', 'RelationController@blockRelation');
Route::get('/cell/{cell}/steps', 'RelationController@CellRelation');
Route::post('/ajaxblocks', 'RelationController@ajaxblocks');
Route::post('/getDataBySection', 'RelationController@getDataBySection');
Route::post('/ajaxphotobooth', 'RelationController@ajaxphotobooth');




