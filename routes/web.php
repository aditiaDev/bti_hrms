<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Conf\RoleController;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;

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



// Auth::routes();

Route::get('/', [LoginController::class, 'login'])->name('login');
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::post('/authenticate', [LoginController::class, 'authenticate'])->name('auth.authenticate');


Route::group(['middleware' => ['auth']], function () {
  Route::post('/logout', [LoginController::class, 'logout'])->name('auth.logout');
  Route::get('/role', [RoleController::class, 'index'])->name('role');

  Route::get('/home', [HomeController::class, 'index'])->name('home');
});
