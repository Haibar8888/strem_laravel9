<?php

use Illuminate\Support\Facades\Route;

// controller
use App\Http\Controllers\Admin\MovieController;
use App\Http\Controllers\Admin\TransactionsController;
use App\Http\Controllers\Admin\LoginController;
use App\Http\Controllers\Member\RegisterController;
use App\Http\Controllers\Member\LoginController AS MemberController;
use App\Http\Controllers\Member\DashboardController;
use App\Http\Controllers\Member\MovieController as MoviesController;
use App\Http\Controllers\Member\PricingController;

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

    // admin logout
    Route::get('/logout',[LoginController::class,'logout'])->name('admin.logout');
});

Route::view('/','index');

// login
Route::get('/login',[MemberController::class,'index'])->name('member.login');
Route::post('/login',[MemberController::class,'auth'])->name('member.login.auth');

// register
Route::get('/register',[RegisterController::class,'index'])->name('member.register');
Route::post('/register',[RegisterController::class,'store'])->name('member.register.store');

// pricing
Route::get('/pricing',[PricingController::class,'index'])->name('member.pricing');
// member 
Route::group(['prefix' => 'member','middleware' => ['auth']], function(){

    // member dashboard
    Route::get('/',[DashboardController::class,'index'])->name('member.dashboard');

    // member logout
    Route::get('/logout',[MemberController::class,'logout'])->name('member.logout');

    // member detail movie
    Route::get('movie/{id}',[MoviesController::class,'show'])->name('member.movie.detail');
});

