<?php

use App\Http\Controllers\Admin\AdminController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Peserta\PesertaController;
use App\Http\Controllers\Peserta\PertanyaanController;
use App\Http\Controllers\Pengawas\PengawasController;
use App\Http\Controllers\API\ApiController;
use App\Http\Controllers\LoginController;

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

Route::get('/password/{pass}', [AdminController::class, 'password']);
Route::get('/admin', [AdminController::class, 'index'])->name('admin.index');
Route::get('/admin/cetak-pengawas', [AdminController::class, 'cetakPengawas'])->name('cetak.pengawas');
Route::get('/admin/cetak-peserta', [AdminController::class, 'cetakPeserta'])->name('cetak.peserta');
Route::get('/admin/create-akun-pengawas', [AdminController::class, 'createAkunPengawas'])->name('admin.create.akun.pengawas');
Route::get('/admin/import-soal', [ApiController::class, 'importSoal'])->name('admin.import.soal');

Route::get('/', [LoginController::class, 'index'])->name('login.index');
Route::post('/authenticate', [LoginController::class, 'authenticate'])->name('login');
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');


Route::group(['middleware' => 'auth'], function () {
    Route::get('/peserta/dashboard', [PesertaController::class, 'index'])->name('peserta.dashboard');
    Route::get('ujian/{id}/peserta/form-ujian', [PesertaController::class, 'formUjian'])->name('peserta.form.ujian');
    Route::post('/peserta/create-list-pertanyaan', [PertanyaanController::class, 'createListPertanyaanPeserta'])->name('create.list.pertanyaan.peserta');


    //PENGAWAS
    Route::get('/pengawas/dashboard', [PengawasController::class, 'index'])->name('pengawas.dashboard');
});
