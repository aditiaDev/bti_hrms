<?php

use App\Http\Controllers\Conf\RoleController;
use App\Http\Controllers\Kepegawaian\KaryawanController;
use App\Http\Controllers\Master\DepartemenController;
use App\Http\Controllers\Master\DivisiController;
use App\Http\Controllers\Master\LiburController;
use App\Http\Controllers\Master\MShiftController;
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
  Route::put('/karyawan/{post}/update', [KaryawanController::class, 'update'])->name('karyawan.update');
  Route::post('/karyawan/getById', [KaryawanController::class, 'getById'])->name('karyawan.getById');
  Route::post('/karyawan/transferEmp', [KaryawanController::class, 'transferEmp'])->name('karyawan.transferEmp');

  Route::post('/master/shift/gethdrall', [MShiftController::class, 'gethdrall'])->name('master.shift.gethdrall');
  Route::post('/master/shift/getdtlbyid', [MShiftController::class, 'getdtlbyid'])->name('master.shift.getdtlbyid');
  Route::post('/master/shift/store', [MShiftController::class, 'store'])->name('master.shift.store');

  Route::post('/master/libur/getByYear', [LiburController::class, 'getByYear'])->name('master.libur.getByYear');
  Route::post('/master/libur/store', [LiburController::class, 'store'])->name('master.libur.store');
  Route::post('/master/libur/update', [LiburController::class, 'update'])->name('master.libur.update');
  Route::post('/master/libur/destroy', [LiburController::class, 'destroy'])->name('master.libur.destroy');
  Route::post('/master/libur/liburAPI', [LiburController::class, 'getLiburAPI'])->name('master.libur.liburAPI');
});
