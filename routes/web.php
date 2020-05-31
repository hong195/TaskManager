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

Auth::routes(
    [
        'register' => false, 'reset' => false
    ]
);

Route::get('/', 'UnitController@index')->name('home');
Route::get('/test', 'RelationController@test')->name('test');

Route::get('/change-password', 'UserController@changePassword')->name('change-password');
Route::resource('user', 'UserController');
Route::resource('file', 'FileController');
Route::resource('units', 'UnitController');
Route::resource('cell', 'CellController');
Route::resource('term', 'TermController');
Route::resource('step', 'StepController');
Route::get('/unit/{unit}/departments', 'RelationController@unitRelation')->name('departments');
Route::get('/block/{block}/cells', 'RelationController@blockRelation')->name('blocks');
Route::get('/cell/{cell}/steps', 'RelationController@CellRelation')->name('cells');
Route::post('/ajaxblocks', 'RelationController@ajaxblocks');
Route::post('/getDataBySection', 'RelationController@getDataBySection');
Route::post('/ajaxphotobooth', 'RelationController@ajaxphotobooth');
Route::get('/getCellsBySystemGC', 'RelationController@getCellsBySystemGC');
Route::get('/analytics/{unit}', 'RelationController@statistics')->name('statistics');
Route::get('/gantt/{unit}/{department?}', 'CellGanttController@ganttView')->name('gantt');
Route::post('/gantt', 'CellGanttController@getGanttAnalitic');




