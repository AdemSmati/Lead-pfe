<?php

use Illuminate\Support\Facades\Route;
use App\Http\Middleware\isAdmin;


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
    return view('welcome');
});

Auth::routes();

Route::get('auth/home', [\App\Http\Controllers\Auth\HomeController::class, 'index'])->name('auth.home')->middleware('isAdmin');
Route::get('user/home', [\App\Http\Controllers\User\HomeController::class, 'index'])->name('user.home');

Route::get('/leads', function () {
    return view('leads');
})->name('leads');
Route::get('/dasboard', function () {
    return view('dashboardTest');
});
