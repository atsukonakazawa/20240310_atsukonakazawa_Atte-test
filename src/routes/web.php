<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AttendanceController;


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

Route::middleware('auth')->group(function () {
    Route::get('/', [AuthController::class, 'index']);
    Route::get('/attendance', [AuthController::class, 'index']);
});

Route::post('/start',[AttendanceController::class,'start'])->name("form.start");
Route::post('/finish',[AttendanceController::class,'finish'])->name("form.finish");
Route::post('/break',[AttendanceController::class,'break'])->name("form.break");
Route::post('/back',[AttendanceController::class,'back'])->name("form.back");
Route::get('/attendance',[AttendanceController::class,'list']);
Route::post('/attendance',[AttendanceController::class,'list']);


