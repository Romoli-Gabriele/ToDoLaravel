<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\TeamController;
use App\Models\User;

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
Route::middleware('guest')->group(function () {
    Route::get('/', fn () => view('auth.login'))->name('login');
    Route::get('/register', [UserController::class, 'create'])->name('register');
    
    Route::post('login', [UserController::class, 'authenticate']);
    Route::post('/register', [UserController::class, 'store']);
});
Route::middleware('auth')->group(function () {
    Route::resource('/tasks', TaskController::class);
    Route::resource('/profile', ProfileController::class);
    Route::get('logout', [UserController::class, 'logout']);
});
Route::middleware('role:teamleader')->group(function () {
    Route::get('team/{team:id}/users', [UserController::class, 'indexTeam']);//aggiungere id del team e request se fa parte di quel team
    Route::get('/delete', [TaskController::class, 'delete']);
});
Route::middleware('role:admin')->group(function(){
    Route::get('/admin', [UserController::class, 'index']);
    Route::get('/admin/roles/{user:id}', [UserController::class, 'editRoles']);
    Route::put('/admin/roles/{user:id}', [UserController::class, 'updateRoles']);
    Route::resource('/admin/teams', TeamController::class);
    Route::get('/admin/delete', [TaskController::class, 'delete']);
});
