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

use Illuminate\Support\Facades\DB;

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

Route::post('/ajaxblocks', 'UnitRelationController@ajaxblocks');
Route::post('/getDataBySection', 'UnitRelationController@getDataBySection');
Route::post('/ajaxphotobooth', 'UnitRelationController@ajaxphotobooth');
Route::post('/gantt', 'CellGanttController@getGanttAnalytic');

Route::get('/getCellsBySystemGC', 'RelationController@getCellsBySystemGC');
Route::get('/unit/{unit}/departments', 'UnitRelationController@departments')->name('departments');
Route::get('/block/{block}/cells', 'BlockRelationController@cells')->name('blocks');
Route::get('/cell/{cell}/steps', 'CellRelationController@steps')->name('cells');
Route::get('/analytics/{unit}', 'AnalyticController@index')->name('statistics');
Route::get('/gantt/{unit}/{department?}', 'CellGanttController@ganttView')->name('gantt');

Route::get('/duplicates', function () {
    $unit = \App\Unit::where('id', 1)->first();

    $analytic = new \App\Http\Controllers\UnitTotalAnalyticController($unit);
    $analytic2 = new \App\Http\Controllers\PrimaryUnitAnalyticController($unit);

    $tt = $analytic2->getAllData();
    $tt = $analytic2->getCompletedTasks();
    dump($tt);


});
