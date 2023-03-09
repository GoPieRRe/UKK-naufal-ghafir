<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\{
    HomeController,
    KelasController,
    SiswaController,
    SppController,
    PetugasController,
    PembayaranController
};

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

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::middleware(['auth'])->group(function () {
    Route::middleware(['admin'])->group(function () {
        Route::get('admin/dashboard', [HomeController::class, 'adminHome'])->name('admin.dashboard');
        Route::resource('Kelas', KelasController::class);
        Route::resource('Siswa', SiswaController::class);
        Route::resource('Petugas', PetugasController::class);
        Route::resource('Spp', SppController::class);
        Route::get('Pembayaran/getData/{nisn}/{berapa}', [PembayaranController::class, 'getData'])->name('Pembayaran.getData');
        Route::get('Pembayaran/sturk', [PembayaranController::class, 'struk'])->name('Pembayaran.struk');
    });

    Route::middleware(['petugas'])->group(function () {
        Route::resource('Pembayaran', PembayaranController::class);
    });

    Route::get('/riwayat', [PembayaranController::class, 'riwayat'])->name('Pembayaran.riwayat');
    Route::get('/export_excel', [PembayaranController::class, 'export_excel']);
});
