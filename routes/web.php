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

Route::middleware('auth')->group(function () {
    Route::resource('/tasks', TaskController::class, ['except' => ['show']]);
    Route::get('/delete', [TaskController::class, 'delete']);
    Route::get('logout', [UserController::class, 'logout']);
});
Route::middleware('guest')->group(function () {
    Route::get('/', fn () => view('auth.login'))->name('login');
    Route::post('login', [UserController::class, 'authenticate']);

    Route::get('sing-in', [UserController::class, 'create']);
    Route::post('sing-in', [UserController::class, 'store']);
});
