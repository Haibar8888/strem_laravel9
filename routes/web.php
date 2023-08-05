<?php

use Illuminate\Support\Facades\Route;

// controller
use App\Http\Controllers\Admin\MovieController;
use App\Http\Controllers\Admin\TransactionsController;
use App\Http\Controllers\Admin\LoginController;

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

// Route::get('/', function () {
//     return view('');
// });
// Route::group(['prefix' => 'admin'], function () {
//     // dashboard
//     Route::view('/','admin.dashboard');
//     Route::resource('movie',MovieController::class);
// });

// Login
Route::get('admin/login',[LoginController::class,'index'])->name('admin.login');
Route::post('admin/login/action',[LoginController::class,'authenticate'])->name('admin.login.auth');

// admin
Route::prefix('admin')->name('admin.')->group(function () {
    Route::view('/','admin.dashboard');
    // movie controller
    Route::resource('movie',MovieController::class);

    // transaction controller
    Route::resource('transaction',TransactionsController::class);

});

