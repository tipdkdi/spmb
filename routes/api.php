<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\ApiController;
use App\Http\Controllers\Admin\AdminController;

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
Route::post('/reset-login', [ApiController::class, 'resetLogin'])->name('reset.login');
Route::post('/import-soal', [ApiController::class, 'importSoal'])->name('import.soal');
Route::get('/ujian/{id}/create-akun-pengawas', [AdminController::class, 'createAkunPengawas'])->name('create.akun.pengawas');
Route::middleware('throttle:10000,60')->group(function () {
    // Route::get('/api/example', 'ExampleController@index');
    Route::post('/sinkron', [ApiController::class, 'sinkron'])->name('sinkron');
});
Route::post('/update-selesai', [ApiController::class, 'updateSelesai'])->name('update.selesai');
Route::post('/update-aktif', [ApiController::class, 'updateAktif'])->name('update.aktif');

Route::post('/create-soal-peserta', [ApiController::class, 'createSoalPeserta'])->name('create.soal.peserta');

Route::get('/navigasi/{sesiId}', [ApiController::class, 'navigasi'])->name('navigasi');

Route::post('/soal', [ApiController::class, 'soal'])->name('soal.get');
Route::post('/jawanan/simpan', [ApiController::class, 'jawabanStore'])->name('jawaban.store');
Route::get('/bagian/{bagianId}/pertanyaan/terjawab', [ApiController::class, 'pertanyaanTerjawab'])->name('pertanyaan.terjawab');

Route::get('/soal/{id}', [ApiController::class, 'selectSoal'])->name('select.soal');
Route::get('/soal/{id}/update', [ApiController::class, 'updateSoal'])->name('update.soal');

Route::get('/kelompok-soal', [ApiController::class, 'kelompokSoal'])->name('kelompok.soal');
Route::get('/kelompok-soal/{id}/get-soal', [ApiController::class, 'getSoal'])->name('get.soal');

Route::post('/upload-image', [ApiController::class, 'uploadKontenEditor'])->name('get.soal');
// Route::get('/peserta/dashboard', [ApiController::class, 'pertanyaanSave'])->name('pertanyaan.save');
