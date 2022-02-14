<?php

use Illuminate\Contracts\Session\Session;
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
Route::post('add', [App\Http\Controllers\TasksController::class, 'add'])->name('addtask');


Route::get('login', [App\Http\Controllers\UsersController::class, 'loginpage'])->name('login');
Route::post('login', [App\Http\Controllers\UsersController::class, 'login']);

Route::get('logout', [App\Http\Controllers\UsersController::class, 'logout'])->name('logout');

Route::get('create', [App\Http\Controllers\UsersController::class, 'createpage'])->name('create');
Route::post('create', [App\Http\Controllers\UsersController::class, 'create']);

Route::get('update/{id}', [App\Http\Controllers\UsersController::class, 'updatepage'])->name('update');
Route::post('update/{id}', [App\Http\Controllers\UsersController::class, 'update']);

Route::get('delete/{id}', [App\Http\Controllers\UsersController::class, 'delete'])->name('delete');

Route::get('detail/{username}', [App\Http\Controllers\UsersController::class, 'detail'])->name('detail');
Route::post('detail/{username}', [App\Http\Controllers\UsersController::class, 'sendmessage']);

Route::get('messages', [App\Http\Controllers\UsersController::class, 'view']);