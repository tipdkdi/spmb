<?php

namespace App\Http\Controllers\Peserta;

use App\Http\Controllers\Controller;
use App\Models\UjianSesiPeserta;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PesertaController extends Controller
{
    //
    public function index()
    {
        $title = "Dashboard";
        $info = 'Ujian MANDIRI LOKAL Kendari Tahun 2025';
        $data = UjianSesiPeserta::with(['ujianSesiRuangan.ujianSesi.ujian', 'dataDiri'])->where([
            'id' => Auth::user()->userPeserta->ujian_sesi_peserta_id,
        ])
            ->first();
        // return $data;
        return view('peserta.dashboard', compact(['data', 'title', 'info']));
    }

    public function formUjian($ujianId)
    {
        $title = "Ujian MANDIRI LOKAL Kendari Tahun 2025";
        $info = 'Ujian MANDIRI LOKAL Kendari Tahun 2025';
        $sesi = UjianSesiPeserta::with(['dataDiri', 'ujianSesiRuangan' => function ($ujianSesiRuangan) use ($ujianId) {
            // $ujianSesiRuangan->where('ujian_id', $ujianId);
        }])
            ->with(['ujianSesiRuangan.ujianSesi'])
            ->where('id', Auth::user()->userPeserta->ujian_sesi_peserta_id)
            ->get();
        // $pertanyaan = Ujian::with('pertanyaanBagian.pertanyaan') Pertanyaan::with('bagian')->get();
        // return $pertanyaan;
        // return $sesi;
        return view('peserta.soal-form', compact(['sesi', 'info', 'title']));
    }
}
