<?php

use Illuminate\Support\Facades\Route;
use App\Models\Task;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\UserController;
use App\Models\User;
use GuzzleHttp\Psr7\Request;
use Illuminate\Support\Facades\Auth;

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

Route::get('/', [TaskController::class, 'index'])->middleware('auth')->name('home');

Route::get('add', [TaskController::class, 'create'])->middleware('auth');
Route::post('add', [TaskController::class, 'store'])->middleware('auth');

Route::get('edit/{task:slug}', [TaskController::class, 'edit'])->middleware('auth');
Route::post('update/{task:slug}', [TaskController::class, 'update'])->middleware('auth');

Route::get('delete', [TaskController::class, 'delete'])->middleware('auth');
Route::delete('tasks/{task:slug}',  [TaskController::class, 'destroy'])->middleware('auth');

Route::get('login', fn() =>view('auth.login'))->name('login')->middleware('guest');
Route::post('login',[UserController::class,'authenticate'])->middleware('guest');

Route::get('sing-in', [UserController::class, 'create'])->middleware('guest');
Route::post('sing-in',[UserController::class, 'store'])->middleware('guest');

route::get('logout', [UserController::class, 'logout'])->middleware('auth');