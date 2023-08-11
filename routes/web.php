<?php

use Illuminate\Support\Facades\Route;

// controller
use App\Http\Controllers\Admin\MovieController;
use App\Http\Controllers\Admin\TransactionsController;
use App\Http\Controllers\Admin\LoginController;
use App\Http\Controllers\Member\RegisterController;
use App\Http\Controllers\Member\LoginController AS MemberController;
use App\Http\Controllers\Member\DashboardController;

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
Route::post('admin/login',[LoginController::class,'auth'])->name('admin.login.auth');

// admin
Route::prefix('admin')->name('admin.')->group(function () {
    Route::view('/','admin.dashboard');
    // movie controller
    Route::resource('movie',MovieController::class);

    // transaction controller
    Route::resource('transaction',TransactionsController::class);
});

Route::view('/','index');

// login
Route::get('/login',[MemberController::class,'index'])->name('member.login');
Route::post('/login',[MemberController::class,'auth'])->name('member.login.auth');

// register
Route::get('/register',[RegisterController::class,'index'])->name('member.register');
Route::post('/register',[RegisterController::class,'store'])->name('member.register.store');

// member 
Route::group(['prefix' => 'member'], function(){
    Route::get('/',[DashboardController::class,'index'])->name('member.dashboard');
});

