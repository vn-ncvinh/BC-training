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

Route::get('/', [App\Http\Controllers\Controller::class, 'index'])->name('index');
Route::post('/', [App\Http\Controllers\TasksController::class, 'add'])->name('addtask');


Route::get('login', [App\Http\Controllers\UsersController::class, 'loginpage'])->name('login');
Route::post('login', [App\Http\Controllers\UsersController::class, 'login']);

Route::get('create', [App\Http\Controllers\UsersController::class, 'createpage'])->name('create');
Route::post('create', [App\Http\Controllers\UsersController::class, 'create']);

