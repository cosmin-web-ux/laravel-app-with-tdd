<?php

use Illuminate\Support\Facades\Route;

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
    return view('layouts.app');
});

Route::group(['middleware' => 'auth'], function () {
    //Route::get('/projects', 'App\Http\Controllers\ProjectController@index');
    Route::get('/projects', [\App\Http\Controllers\ProjectController::class, 'index']);
    Route::get('/projects/create', [\App\Http\Controllers\ProjectController::class, 'create']);
    Route::get('/projects/{project}', [\App\Http\Controllers\ProjectController::class, 'show']);
    Route::post('/projects', [\App\Http\Controllers\ProjectController::class, 'store']);

    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
});

Auth::routes();
