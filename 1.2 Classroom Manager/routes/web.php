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



Route::get('assignments', [App\Http\Controllers\AssignmentsController::class, 'indexpage'])->name('assignments');

Route::get('assignments/create', [App\Http\Controllers\AssignmentsController::class, 'createpage']);
Route::post('assignments/create', [App\Http\Controllers\AssignmentsController::class, 'create']);
Route::get('assignments/delete/{id}', [App\Http\Controllers\AssignmentsController::class, 'delete']);
Route::get('/assignments/{id}/file/', [App\Http\Controllers\AssignmentsController::class, 'downloadfile']);
Route::post('assignments/detail/{id}', [App\Http\Controllers\AssignmentsController::class, 'updateFile']);


Route::get('assignments/{id}', [App\Http\Controllers\ReturnAssignmentsController::class, 'route'])->name('turninpage');
Route::post('assignments/{id}/turnin', [App\Http\Controllers\ReturnAssignmentsController::class, 'turnin']);
Route::get('assignments/{id}/download/{username}', [App\Http\Controllers\ReturnAssignmentsController::class, 'downloadfile']);
Route::get('assignments/{id}/undo', [App\Http\Controllers\ReturnAssignmentsController::class, 'undoturnin']);


Route::get('challenges', [App\Http\Controllers\ChallengesController::class, 'indexpage'])->name('challenges');
Route::get('challenges/create', [App\Http\Controllers\ChallengesController::class, 'createpage']);
Route::post('challenges/create', [App\Http\Controllers\ChallengesController::class, 'create']);
Route::get('challenges/detail/{id}', [App\Http\Controllers\ChallengesController::class, 'detail']);
Route::get('challenges/delete/{id}', [App\Http\Controllers\ChallengesController::class, 'delete']);
Route::post('challenges/detail/{id}', [App\Http\Controllers\ChallengesController::class, 'answer']);


