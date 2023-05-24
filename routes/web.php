<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\DetailController;
use App\Http\Controllers\auth\LoginController;
use App\Http\Controllers\PendaftaranController;
use App\Http\Controllers\admin\DashboardController;
use App\Http\Controllers\admin\EventController;
use App\Http\Controllers\admin\KeuntunganController;
use App\Http\Controllers\admin\PemateriController;
use App\Http\Controllers\admin\PenggunaController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::group(['middleware' => ['guest'], 'prefix' => '/administrator/event/'], function() {
    Route::get('', [LoginController::class, 'index'])->name('login'); 
    Route::post('', [LoginController::class, 'postLogin']); 
});

Route::group(['middleware' => ['auth', 'isAdmin'], 'prefix' => '/administrator/event/'], function() {
    Route::post('logout', [LoginController::class, 'logout'])->name('logout'); 
    Route::get('dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::resource('pemateri', PemateriController::class);
    Route::resource('keuntungan', KeuntunganController::class);
    Route::resource('data-event', EventController::class);
    Route::put('data-event/update-status/{id}', [EventController::class, 'updateStatus'])->name('updateStatus');
    Route::resource('pengguna', PenggunaController::class);
});

Route::get('/', [HomeController::class, 'index'])->name('home');

Route::post('/daftar', [PendaftaranController::class, 'daftar'])->name('daftar');
Route::post('/daftar-hadir', [PendaftaranController::class, 'daftarHadir'])->name('daftarHadir');
Route::get('/detail', [DetailController::class, 'index']);