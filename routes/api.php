<?php

use App\Http\Controllers\Conf\RoleController;
use App\Http\Controllers\Kepegawaian\KaryawanController;
use App\Http\Controllers\Master\DepartemenController;
use App\Http\Controllers\Master\DivisiController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::group(['middleware' => ['auth']], function () {
  Route::post('/role/getall', [RoleController::class, 'getall'])->name('role.getall');
  Route::post('/role/store', [RoleController::class, 'store'])->name('role.store');
  Route::post('/role/update', [RoleController::class, 'update'])->name('role.update');
  Route::post('/role/changeStatus', [RoleController::class, 'changeStatus'])->name('role.changeStatus');

  Route::post('/master/getDivisiByDept', [DivisiController::class, 'getDivisiByDept'])->name('master.getDivisiByDept');

  Route::post('/karyawan/getall', [KaryawanController::class, 'getall'])->name('karyawan.getall');
  Route::post('/karyawan/changeStatus', [KaryawanController::class, 'changeStatus'])->name('karyawan.changeStatus');
  Route::post('/karyawan/generateNIK', [KaryawanController::class, 'generateNIK'])->name('karyawan.generateNIK');
  Route::post('/karyawan/store', [KaryawanController::class, 'store'])->name('karyawan.store');
});
