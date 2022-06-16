<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\MasterController;
use App\Http\Controllers\TransaksiController;
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
    return redirect('/home');
});
Route::get('/home', [DashboardController::class, 'index']);

Route::get('/mbrg', [MasterController::class, 'barangIndex']);
Route::post('/mbrg/ibrg', [MasterController::class, 'barangInput']);
Route::put('/mbrg/ubrg/{id}', [MasterController::class, 'barangUpdate']);
Route::get('/mbrg/dbrg/{id}', [MasterController::class, 'barangDelete']);
Route::get('/mcst', [MasterController::class, 'customerIndex']);
Route::post('/mcst/icst', [MasterController::class, 'customerInput']);
Route::put('/mcst/ucst/{id}', [MasterController::class, 'customerUpdate']);
Route::get('/mcst/dcst/{id}', [MasterController::class, 'customerDelete']);

Route::get('/tpnj', [TransaksiController::class, 'penjualanIndex']);
Route::get('/tpnj/lcst', [TransaksiController::class, 'customerLoad']);
Route::get('/tpnj/idcst/{id}', [TransaksiController::class, 'customerId']);
Route::get('/tpnj/lbrg', [TransaksiController::class, 'barangLoad']);
Route::get('/tpnj/ibrg/{id}', [TransaksiController::class, 'barangInput']);
Route::get('/tpnj/dtpnj', [TransaksiController::class, 'detailpenjualanIndex']);
Route::post('/tpnj/qtypnj', [TransaksiController::class, 'qtypenjualanInput']);
Route::post('/tpnj/dispnj', [TransaksiController::class, 'dispenjualanInput']);
Route::get('/tpnj/dpnj/{id}', [TransaksiController::class, 'detpenjualanDelete']);
Route::post('/tpnj/ipnj', [TransaksiController::class, 'penjualanInput']);
Route::get('/dpnj', [TransaksiController::class, 'penjualanList']);