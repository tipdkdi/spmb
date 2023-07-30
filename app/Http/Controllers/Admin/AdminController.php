<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\UjianSesiPeserta;
use App\Models\UjianSesiRuangan;
use App\Models\User;
use App\Models\UserPengawas;
use App\Models\SoalOpsi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class AdminController extends Controller
{
    //
    public function password($password)
    {
        return bcrypt($password);
        // return view('admin.dashboard');
    }

    public function hasilUjian($ujianSesiPesertaId)
    {
        $title = "Detail Jawaban";
        $data = UjianSesiPeserta::with([
            'pesertaSoal.pesertaJawaban',
            'pesertaSoal.pesertaSoalOpsi',
            'pesertaSoal.soal'
        ])
            ->find($ujianSesiPesertaId);
        foreach ($data->pesertaSoal as $item) {
            $opsiIds = json_decode($item->pesertaSoalOpsi->opsis_id);
            $item->pesertaSoalOpsi->opsis = SoalOpsi::whereIn('id', $opsiIds)->orderByRaw("FIELD(id, " . implode(',', $opsiIds) . ")")
                ->get();
            foreach ($item->pesertaSoalOpsi->opsis as $opsi) {
                if ($item->pesertaJawaban != null) {

                    if ($opsi->id == $item->pesertaJawaban->soal_opsi_id) {
                        $opsi->jawabannyaPeserta = true;
                    }
                }
            }
        }

        // return $data;
        return view('admin.hasil-detail', compact(['data', 'title']));

        // return $sesiPeserta;
    }
    public function cetakPeserta()
    {
        $akun = User::with([
            'userPeserta.ujianSesiPeserta.dataDiri',
            'userPeserta.ujianSesiPeserta.pesertaSoal'  => function ($ujianSesiPeserta) {
                $ujianSesiPeserta->with(['pesertaJawaban.soalOpsi' => function ($soalOpsi) {
                    // $pesertaJawaban->withCount(['' => function ($soalOpsi) {
                    $soalOpsi->where('is_jawaban', true);
                    // }]);
                }])
                    ->whereHas('pesertaJawaban.soalOpsi', function ($soalOpsi) {
                        $soalOpsi->where('is_jawaban', true);
                    });;
            }
        ])
            ->whereHas('userPeserta')->get();

        // return $akun;
        $content = "<table border='1' cellpadding='10' cellspacing='0' style='text-align:center; font:arial'>";
        $content .= "<thead>";
        $content .= "<th>NO</th>";
        $content .= "<th>No. Ujian</th>";
        $content .= "<th>Nama Peserta</th>";
        $content .= "<th>Tanggal Lahir</th>";
        $content .= "<th>Nilai</th>";
        $content .= "</thead>";
        $content .= "<tbody>";
        foreach ($akun as $index => $row) {
            $jumlahBenar = count($row->userPeserta->ujianSesiPeserta->pesertaSoal);
            $totalNilai = number_format(($jumlahBenar / 45) * 100, 1);
            $urut = $index + 1;
            $peserta = $row->userPeserta->ujianSesiPeserta->dataDiri->nama_lengkap;
            $noUjian = $row->userPeserta->ujianSesiPeserta->no_test;
            $tanggalLahir = $row->userPeserta->ujianSesiPeserta->dataDiri->lahir_tanggal;
            $content .= "<tr>";
            $content .= "<td>$urut</td>";
            $content .= "<td>$noUjian</td>";
            $content .= "<td style='text-align:left'>$peserta</td>";
            $content .= "<td>$tanggalLahir</td>";
            $content .= "<td><a href='" . route('hasil.ujian.detail', $row->userPeserta->ujianSesiPeserta->id) . "'>$totalNilai</a></td>";
            $content .= "</tr>";
        }
        $content .= "</tbody>";
        $content .= "</table>";
        return $content;
    }

    public function cetakPengawas()
    {
        // $akun = User::with('userPengawas.ujianSesiRuangan.ujianSesi.ujian')->whereHas('userPengawas')->get();
        $akun = User::with(['userPengawas.ujianSesiRuangan.ujianSesi.ujian' => function ($ujian) {
            $ujian->where('id', 2);
        }])
            ->whereHas('userPengawas')
            ->whereHas('userPengawas.ujianSesiRuangan.ujianSesi.ujian', function ($ujian) {
                $ujian->where('id', 2);
            })
            ->get();

        $content = "<table border='1' cellpadding='10' cellspacing='0' style='text-align:center; font:arial'>";
        $content .= "<thead>";
        $content .= "<th>NO</th>";
        $content .= "<th>Pengawas</th>";
        $content .= "<th>Username</th>";
        $content .= "<th>Password</th>";
        $content .= "<th>Tanggal</th>";
        $content .= "<th>Jam</th>";
        $content .= "</thead>";
        $content .= "<tbody>";
        foreach ($akun as $index => $row) {
            $urut = $index + 1;
            $pengawas = $row->userPengawas->ujianSesiRuangan->nama_pengawas;
            $tanggal = $row->userPengawas->ujianSesiRuangan->ujianSesi->sesi_tanggal;
            $waktu = $row->userPengawas->ujianSesiRuangan->ujianSesi->jam_mulai . " - " . $row->userPengawas->ujianSesiRuangan->ujianSesi->jam_selesai;
            $content .= "<tr>";
            $content .= "<td>$urut</td>";
            $content .= "<td style='text-align:left'>$pengawas</td>";
            $content .= "<td>$row->username</td>";
            $content .= "<td>$row->username</td>";
            $content .= "<td>$tanggal</td>";
            $content .= "<td>$waktu</td>";
            $content .= "</tr>";
        }
        $content .= "</tbody>";
        $content .= "</table>";
        // return $akun;
        return $content;
    }
    public function createAkunPengawas()
    {
        DB::beginTransaction();

        try {
            //code...
            // $sesiRuangan = UjianSesiRuangan::all(); //ini ubah dulu kasih parameter ujian yang mana
            $sesiRuangan = UjianSesiRuangan::with(['ujianSesi.ujian' => function ($ujian) {
                $ujian->where('id', 2);
            }])
                ->whereHas('ujianSesi.ujian', function ($ujian) {
                    $ujian->where('id', 2);
                })
                ->get(); //ini ubah dulu kasih parameter ujian yang mana
            // return $sesiRuangan;
            foreach ($sesiRuangan as $row) {
                $randomText = strtoupper(Str::random(6)); // Membuat password acak dengan 6 karakter
                $user = User::create([
                    "username" => $randomText,
                    "password" => bcrypt($randomText),
                    "user_role_id" => 3,
                ]);
                UserPengawas::create([
                    'user_id' => $user->id,
                    'ujian_sesi_ruangan_id' => $row->id,
                ]);
            }
            DB::commit();
            return response()->json([
                'status' => true,
                'message' => 'Sudah create',
                'data' => $sesiRuangan,
            ], 200);
            // return $;
        } catch (\Throwable $th) {
            DB::rollback();

            throw $th;
        }
    }

    public function index()
    {

        return view('admin.dashboard');
    }
}
