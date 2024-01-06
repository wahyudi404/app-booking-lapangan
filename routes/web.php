<?php

use App\Http\Controllers\BookingController;
use Illuminate\Support\Facades\Auth;
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

Route::get('/', function () {
    return view('welcome');
});


Route::prefix('booking-lapangan')->group(function () {
    Route::get('', [App\Http\Controllers\BookingLapanganController::class, 'index'])->name('booking-lapangan');
    Route::post('', [App\Http\Controllers\BookingLapanganController::class, 'store']);
});

Route::get('/cek-jadwal', [App\Http\Controllers\JadwalController::class, 'index'])->name('cek-jadwal');


Route::prefix('pembayaran')->group(function () {
    Route::get('', [App\Http\Controllers\PembayaranController::class, 'index'])->name('cek-pembayaran');
    Route::post('', [App\Http\Controllers\PembayaranController::class, 'showPembayaran']);
    Route::get('/cek-pembayaran-detail/{kode}', [App\Http\Controllers\PembayaranController::class, 'cekPembayaran'])->name('cek-pembayaran-detail');
    Route::get('/hasil-pembayaran/{kode}', [App\Http\Controllers\PembayaranController::class, 'hasilPembayaran'])->name('hasil-pembayaran');
    Route::post('/upload-bukti', [App\Http\Controllers\PembayaranController::class, 'uploadBukti'])->name('upload-bukti');
});


Auth::routes([
    'register' => false,
    'reset' => false,
    'verify' => false
]);

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::prefix('booking')->group(function () {
    Route::get('', [BookingController::class, 'index'])->name('booking');
    Route::post('/update-status', [BookingController::class, 'updateStatus'])->name('update-status');
});