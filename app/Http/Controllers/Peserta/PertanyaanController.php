<?php

namespace App\Http\Controllers\Peserta;

use App\Http\Controllers\Controller;
use App\Models\Pertanyaan;
use App\Models\PertanyaanBagian;
use App\Models\Ujian;
use Illuminate\Http\Request;

class PertanyaanController extends Controller
{
    //
    public function index()
    {
        $title = "Soal Ujian";
        $data['info'] = 'Ujian MANDIRI LOKAL IAIN Kendari Tahun 2025';
        // $pertanyaan = Ujian::with('pertanyaanBagian.pertanyaan') Pertanyaan::with('bagian')->get();
        // return $pertanyaan;
        // return view('peserta.soal-form', compact(['data', 'title']));
    }

    public function createListPertanyaanPeserta() {}

    public function showPertanyaan($pertanyaanId) {}
}
