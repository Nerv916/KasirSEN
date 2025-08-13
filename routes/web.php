<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LaporanController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\AlfamartTrxController;
use App\Http\Controllers\ControllerPertaminaTrx;
use App\Http\Controllers\ControllerTrxIndomaret;

Route::get('/', function () {
    return view('auth.login');
});


Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::get('/indomaret', [ControllerTrxIndomaret::class, 'index'])->name('indomaret.index');
    Route::post('/transaksi/simpan', [ControllerTrxIndomaret::class, 'simpan']);
    Route::get('/transaksi/struk/{id}', [ControllerTrxIndomaret::class, 'printStruk']);

    Route::get('/pertamina', [ControllerPertaminaTrx::class, 'index'])->name('pertamina.index');
    Route::post('/pertamina/simpan', [ControllerPertaminaTrx::class, 'simpan']);

    Route::get('/alfamart', [AlfamartTrxController::class, 'index'])->name('alfamart.index');
    Route::post('/alfamart/simpan', [AlfamartTrxController::class, 'simpan'])->name('alfamart.simpan');

    Route::get('/laporan', [LaporanController::class, 'index'])->name('laporan.index');
});

require __DIR__ . '/auth.php';
