<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\TransaksiController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\BukuController;


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
    return view('auth.login');
});
Route::get('/login', [LoginController::class, 'login'])->name('login');
    Route::post('/login', [LoginController::class, 'login'])->name('login');
    Route::post('/logout', [LoginController::class, 'logout'])->name('logout');


Route::middleware(['auth.check', 'member'])->group(function () {

    Route::get('bukus', [BukuController::class, 'index'])->name('bukus.index');
    Route::get('transaksi', [TransaksiController::class, 'index'])->name('transaksi.index');
    Route::get('transaksi/home', [TransaksiController::class, 'home'])->name('transaksi.home');
    Route::get('transaksi/create', [TransaksiController::class, 'create'])->name('transaksi.create');
    Route::post('transaksi', [TransaksiController::class, 'store'])->name('transaksi.store');
    Route::get('transaksi/{id}/edit', [TransaksiController::class, 'edit'])->name('transaksi.edit');
    Route::put('transaksi/{id}', [TransaksiController::class, 'update'])->name('transaksi.update');
    Route::patch('/transaksi/update-status/{id}', [TransaksiController::class, 'updateStatus'])->name('transaksi.updateStatus');
    Route::delete('transaksi/{id}', [TransaksiController::class, 'destroy'])->name('transaksi.destroy');
    Route::get('transaksi/{id}', [TransaksiController::class, 'show']);
    Route::get('transaksi/{id}/reviews/{reviewID}', [ProductController::class, 'review']);
});