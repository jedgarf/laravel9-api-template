<?php

use Illuminate\Support\Facades\Route;

// Controllers
use App\Http\Controllers\TasksController;

// Middlewares
// use App\Http\Middleware\CheckLoginSession;

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
    return response()->json('Welcome to Simple Task Management API', 200);
});

Route::get('task/filter/{id}', [TasksController::class, 'showOne'])->middleware('token_validation');
Route::post('task/create', [TasksController::class, 'store'])->middleware('token_validation');
Route::get('task/read', [TasksController::class, 'show'])->middleware('token_validation');
Route::post('task/update/{id}', [TasksController::class, 'update'])->middleware('token_validation');
Route::get('task/delete/{id}', [TasksController::class, 'destroy'])->middleware('token_validation');
