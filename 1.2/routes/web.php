<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Storage;

Route::get('/', [App\Http\Controllers\Controller::class, 'index'])->name('index');


Route::get('login', [App\Http\Controllers\UsersController::class, 'loginpage'])->name('login');
Route::post('login', [App\Http\Controllers\UsersController::class, 'login']);

Route::get('logout', [App\Http\Controllers\UsersController::class, 'logout'])->name('logout');

Route::get('user/create', [App\Http\Controllers\UsersController::class, 'createpage'])->name('create');
Route::post('user/create', [App\Http\Controllers\UsersController::class, 'create']);

Route::get('user/update/{username}', [App\Http\Controllers\UsersController::class, 'updatepage'])->name('update');
Route::post('user/update/{username}', [App\Http\Controllers\UsersController::class, 'update']);

Route::get('user/delete/{username}', [App\Http\Controllers\UsersController::class, 'delete'])->name('delete');



Route::get('user/detail/{username}', [App\Http\Controllers\MessagesController::class, 'detail'])->name('detail');
Route::post('user/detail/{username}', [App\Http\Controllers\MessagesController::class, 'sendmessage']);
Route::get('messages', [App\Http\Controllers\MessagesController::class, 'view']);



Route::get('assignments', [App\Http\Controllers\AssignmentsController::class, 'index'])->name('assignments');

Route::get('assignments/create', [App\Http\Controllers\AssignmentsController::class, 'createpage']);
Route::post('assignments/create', [App\Http\Controllers\AssignmentsController::class, 'create']);
Route::get('assignments/delete/{id}', [App\Http\Controllers\AssignmentsController::class, 'delete']);
Route::get('assignments/images/{filename}', [App\Http\Controllers\AssignmentsController::class, 'downloadfile']);