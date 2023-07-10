<?php

namespace App\Http\Controllers\Pengawas;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\UjianSesiRuangan;
use Illuminate\Support\Facades\Auth;

class PengawasController extends Controller
{
    //
    public function index()
    {
        $title = 'Pengawas Ruang';
        $data = UjianSesiRuangan::with(['ujianSesi', 'peserta' => function ($peserta) {
            $peserta->with(['dataDiri', 'userPeserta.user'])->orderBy('no_urut', 'ASC');
        }])->find(Auth::user()->userPengawas->ujianSesiRuangan->id);
        // return $data;
        return view('pengawas.dashboard', compact(['data', 'title']));
    }
}
