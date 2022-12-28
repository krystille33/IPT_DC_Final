<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\OrdersController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\IndexController;

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
    return view('auth.login');
});

Auth::routes(['verify' => true]);

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home')->middleware('verified');

Route::middleware(['auth', 'role:admin'])->name('admin.')->prefix('admin')->group(function(){
    Route::get('/', [IndexController::class, 'index'])->name('index');
    Route::get('/user-view', [UserController::class, 'index']);
});

Route::middleware(['auth', 'role:user|admin'])->name('admin.')->prefix('admin')->group(function(){
    Route::get('/', [IndexController::class, 'index'])->name('index');
    Route::get('/orders', [OrdersController::class, 'userOnly']);
    Route::get('/orders/{id}', [OrdersController::class, 'showOrder']);
});
