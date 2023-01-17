<?php

use App\Http\Controllers\QRCodeController;
use Illuminate\Support\Facades\Route;

Route::get('/', [QRCodeController::class, 'index'])->name('index');
Route::get('/enterQRCode', [QRCodeController::class, 'enterQRCode'])->name('enterQRCode');
Route::get('/renderQRCode', [QRCodeController::class, 'renderQRCode'])->name('renderQRCode');
Route::get('/downloadQRCode', [QRCodeController::class, 'downloadQRCode'])->name('downloadQRCode');
Route::get('/readQRCode', [QRCodeController::class, 'readQRCode'])->name('readQRCode');
