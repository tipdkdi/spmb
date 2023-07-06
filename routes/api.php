<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\ApiController;

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
Route::middleware('throttle:1000,60')->group(function () {
    // Route::get('/api/example', 'ExampleController@index');
    Route::post('/sinkron', [ApiController::class, 'sinkron'])->name('sinkron');
});
Route::post('/update-aktif', [ApiController::class, 'updateAktif'])->name('update.aktif');

Route::post('/create-soal-peserta', [ApiController::class, 'createSoalPeserta'])->name('create.soal.peserta');

Route::get('/navigasi/{sesiId}', [ApiController::class, 'navigasi'])->name('navigasi');

Route::post('/soal', [ApiController::class, 'soal'])->name('soal.get');
Route::post('/jawanan/simpan', [ApiController::class, 'jawabanStore'])->name('jawaban.store');
Route::get('/bagian/{bagianId}/pertanyaan/terjawab', [ApiController::class, 'pertanyaanTerjawab'])->name('pertanyaan.terjawab');
// Route::get('/peserta/dashboard', [ApiController::class, 'pertanyaanSave'])->name('pertanyaan.save');
