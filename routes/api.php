<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::prefix('auth')->middleware('api')->group(function () {
    Route::post('login', 'AuthController@login');
    Route::post('logout', 'AuthController@logout');
    Route::post('refresh', 'AuthController@refresh');
    Route::post('me', 'AuthController@me');
});

//here can split to api versions
Route::prefix('v1')->namespace('Api\v1')->middleware('auth:api')->group(function () {
    Route::prefix('toDo')->group(function () {
        Route::middleware('admin')->get('/', 'ToDoController@index')->name('toDo.index');
        Route::get('/me', 'ToDoController@me')->name('toDo.me');
        Route::post('/', 'ToDoController@store')->name('toDo.store');
        Route::patch('/{toDo}', 'ToDoController@update')->name('toDo.update');
        Route::delete('/{toDo}', 'ToDoController@destroy')->name('toDo.store');
    });

    Route::prefix('logs')->middleware(['auth:api', 'admin'])->group(function () {
        Route::get('/', 'LogController@index')->name('logs.index');
    });
});