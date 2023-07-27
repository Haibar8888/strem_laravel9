<?php

use Illuminate\Support\Facades\Route;

// controller
use App\Http\Controllers\Admin\MovieController;

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

Route::prefix('admin')->name('admin.')->group(function () {
    Route::view('/','admin.dashboard');
    Route::resource('movie',MovieController::class);

});

