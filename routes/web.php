<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\ProjectInvitationsController;
use App\Http\Controllers\ProjectTasksController;
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
    Route::resource('projects', ProjectController::class);
//    Route::get('/projects', [ProjectController::class, 'index']);
//    Route::get('/projects/create', [ProjectController::class, 'create']);
//    Route::get('/projects/{project}', [ProjectController::class, 'show']);
//    Route::get('/projects/{project}/edit', [ProjectController::class, 'edit']);
//    Route::patch('/projects/{project}', [ProjectController::class, 'update']);
//    Route::post('/projects', [ProjectController::class, 'store']);
//    Route::delete('/projects/{project}', [ProjectController::class, 'destroy']);

    Route::post('/projects/{project}/tasks', [ProjectTasksController::class, 'store']);
    Route::patch('/projects/{project}/tasks/{task}', [ProjectTasksController::class, 'update']);

    Route::post('/projects/{project}/invitations', [ProjectInvitationsController::class, 'store']);

    Route::get('/home', [HomeController::class, 'index'])->name('home');
});

Auth::routes();
