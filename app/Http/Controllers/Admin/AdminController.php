<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\UjianSesiRuangan;
use App\Models\User;
use App\Models\userPengawas;
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

    public function cetakPeserta()
    {
        $akun = User::with(['userPeserta.ujianSesiPeserta.dataDiri'])->whereHas('userPeserta')->get();
        $content = "<table border='1' cellpadding='10' cellspacing='0' style='text-align:center; font:arial'>";
        $content .= "<thead>";
        $content .= "<th>NO</th>";
        $content .= "<th>No. Ujian</th>";
        $content .= "<th>Nama Peserta</th>";
        $content .= "<th>Tanggal Lahir</th>";
        $content .= "</thead>";
        $content .= "<tbody>";
        foreach ($akun as $index => $row) {
            $urut = $index + 1;
            $peserta = $row->userPeserta->ujianSesiPeserta->dataDiri->nama_lengkap;
            $noUjian = $row->userPeserta->ujianSesiPeserta->no_test;
            $tanggalLahir = $row->userPeserta->ujianSesiPeserta->dataDiri->lahir_tanggal;
            $content .= "<tr>";
            $content .= "<td>$urut</td>";
            $content .= "<td>$noUjian</td>";
            $content .= "<td style='text-align:left'>$peserta</td>";
            $content .= "<td>$tanggalLahir</td>";
            $content .= "</tr>";
        }
        $content .= "</tbody>";
        $content .= "</table>";
        return $content;
    }

    public function cetakPengawas()
    {
        $akun = User::with('userPengawas.ujianSesiRuangan.ujianSesi')->whereHas('userPengawas')->get();
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
            $sesiRuangan = UjianSesiRuangan::all();
            foreach ($sesiRuangan as $row) {
                $randomText = strtoupper(Str::random(6)); // Membuat password acak dengan 6 karakter
                $user = User::create([
                    "username" => $randomText,
                    "password" => bcrypt($randomText),
                    "user_role_id" => 3,
                ]);
                userPengawas::create([
                    'user_id' => $user->id,
                    'ujian_sesi_ruangan_id' => $row->id,
                ]);
            }
            DB::commit();
            return $sesiRuangan;
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
