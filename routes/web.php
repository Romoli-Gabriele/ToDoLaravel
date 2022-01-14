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

Route::get('/', fn () => view('index',['tasks'=> Task::all()]))->name('home');

Route::get('add', fn () => view('add-task'))->middleware('auth');
Route::post('add', [TaskController::class, 'add'])->middleware('auth');

Route::get('done/{task:slug}', [TaskController::class, 'done']);//put update

Route::get('delete', [TaskController::class, 'delete']);//delete destroy

Route::get('login', fn() =>view('login'))->name('login')->middleware('guest');
Route::post('login',[UserController::class,'authenticate'])->middleware('guest');

Route::get('sing-in', [UserController::class, 'create'])->middleware('guest');
Route::post('sing-in',[UserController::class, 'store'])->middleware('guest');

route::get('logout', [UserController::class, 'logout'])->middleware('auth');