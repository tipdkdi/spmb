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
    public function seeder()
    {
        DB::beginTransaction();

        try {
            //code...

            DB::table('pmbs')->insert([
                [
                    "pmb_nama" => "PMB Jalur Mandiri Tahap 2",
                    "tahun_akademik" => "2023/Ganjil",
                    "biaya_pendaftaran" => 250000,
                    "daftar_mulai" => "2023-01-01",
                    "daftar_selesai" => "2023-01-01",
                    "jenis_ujian" => "offline",
                    "ruang_per_sesi" => 3,
                    "peserta_per_ruang" => 20,
                    "is_publish" => 1,
                ]
            ]);
            DB::table('ujians')->insert([
                [
                    "ujian_nama" => "Ujian Penerimaan Mahasiswa Baru Jalur Mandiri 2023 Tahap 2",
                    "tempat" => "IAIN Kendari",
                    "waktu_pengerjaan" => "01:00:00",
                    "is_soal_random" => 1
                ]
            ]);
            DB::table('pmb_ujians')->insert([
                [
                    "pmb_id" => 2,
                    "ujian_id" => 2,
                ]
            ]);

            DB::table('ujian_sesis')->insert([
                [
                    "ujian_id" => 2,  ///ini diganti2 sesuai ujian id yang ingin dilaksanakan
                    "sesi" => "1",
                    "jam_mulai" => "08:15:00",
                    "jam_selesai" => "09:15:00",
                    "sesi_tanggal" => "2023-07-31",
                ],
                [
                    "ujian_id" => 2,
                    "sesi" => "2",
                    "jam_mulai" => "09:30:00",
                    "jam_selesai" => "10:30:00",
                    "sesi_tanggal" => "2023-07-31",
                ],
                [
                    "ujian_id" => 2,
                    "sesi" => "3",
                    "jam_mulai" => "10:45:00",
                    "jam_selesai" => "11:45:00",
                    "sesi_tanggal" => "2023-07-31",
                ],
                [
                    "ujian_id" => 2,
                    "sesi" => "4",
                    "jam_mulai" => "13:00:00",
                    "jam_selesai" => "14:00:00",
                    "sesi_tanggal" => "2023-07-31",
                ],
                [
                    "ujian_id" => 2,
                    "sesi" => "5",
                    "jam_mulai" => "14:15:00",
                    "jam_selesai" => "15:15:00",
                    "sesi_tanggal" => "2023-07-31",
                ],

            ]);

            $info = [
                [
                    "gedung" => "LAB TIPD",
                    "kode_ruangan" => "LAB-01",
                    "ruangan" => "LAB 01",
                ],
                [
                    "gedung" => "LAB TIPD",
                    "kode_ruangan" => "LAB-02",
                    "ruangan" => "LAB 02",
                ],
                // [
                //     "gedung" => "LAB TIPD",
                //     "kode_ruangan" => "LAB-03",
                //     "ruangan" => "Lab Bahasa",
                // ],
            ];

            $array = [];
            for ($i = 11; $i <= 15; $i++) { //ini id sesi, jadi contoh ujian id 1 sampai 10 sesi, jadi skrg di sini jadi dari 11 -15 karena sampe 5 sesu
                foreach ($info as $index => $value) {
                    $array[] = [
                        "ujian_sesi_id" => $i,
                        "gedung" => $value['gedung'],
                        "kode_ruangan" => $value['kode_ruangan'],
                        "ruangan" => $value['ruangan'],
                        "nama_pengawas" => "Pengawas " . $value['ruangan'] . " Sesi " . $i,
                    ];
                }
            }

            DB::table('ujian_sesi_ruangans')->insert($array);

            DB::table('ujian_soal_bagians')->insert([
                [
                    "ujian_id" => 2,
                    "soal_kelompok_id" => 1,
                    "bagian_kode" => "A",
                    "bagian_nama" => "Tes Kemampuan Dasar (TKD) 1",
                    "bagian_urutan" => "1",
                    "bagian_keterangan" => "",
                    "jumlah_soal" => "5",
                    "is_pilihan_ganda" => 1,
                    "jumlah_opsi_pilihan_ganda" => "4",
                ],
                [
                    "ujian_id" => 2,
                    "soal_kelompok_id" => 2,
                    "bagian_kode" => "A",
                    "bagian_nama" => "Tes Kemampuan Dasar (TKD) 2",
                    "bagian_urutan" => "2",
                    "bagian_keterangan" => "",
                    "jumlah_soal" => "5",
                    "is_pilihan_ganda" => 1,
                    "jumlah_opsi_pilihan_ganda" => "4",
                ],
                [
                    "ujian_id" => 2,
                    "soal_kelompok_id" => 3,
                    "bagian_kode" => "A",
                    "bagian_nama" => "Tes Kemampuan Dasar (TKD) 3",
                    "bagian_urutan" => "3",
                    "bagian_keterangan" => "",
                    "jumlah_soal" => "5",
                    "is_pilihan_ganda" => 1,
                    "jumlah_opsi_pilihan_ganda" => "4",
                ],
                [
                    "ujian_id" => 2,
                    "soal_kelompok_id" => 4,
                    "bagian_kode" => "A",
                    "bagian_nama" => "Tes Kemampuan Dasar (TKD) 4",
                    "bagian_urutan" => "4",
                    "bagian_keterangan" => "",
                    "jumlah_soal" => "5",
                    "is_pilihan_ganda" => 1,
                    "jumlah_opsi_pilihan_ganda" => "4",
                ],
                [
                    "ujian_id" => 2,
                    "soal_kelompok_id" => 5,
                    "bagian_kode" => "A",
                    "bagian_nama" => "Tes Kemampuan Dasar (TKD) 5",
                    "bagian_urutan" => "5",
                    "bagian_keterangan" => "",
                    "jumlah_soal" => "5",
                    "is_pilihan_ganda" => 1,
                    "jumlah_opsi_pilihan_ganda" => "4",
                ],
                [
                    "ujian_id" => 2,
                    "soal_kelompok_id" => 6,
                    "bagian_kode" => "A",
                    "bagian_nama" => "Tes Kemampuan Dasar (TKD) 6",
                    "bagian_urutan" => "6",
                    "bagian_keterangan" => "",
                    "jumlah_soal" => "5",
                    "is_pilihan_ganda" => 1,
                    "jumlah_opsi_pilihan_ganda" => "4",
                ],
                [
                    "ujian_id" => 2,
                    "soal_kelompok_id" => 7,
                    "bagian_kode" => "A",
                    "bagian_nama" => "Tes Kemampuan Dasar (TKD) 7",
                    "bagian_urutan" => "7",
                    "bagian_keterangan" => "",
                    "jumlah_soal" => "5",
                    "is_pilihan_ganda" => 1,
                    "jumlah_opsi_pilihan_ganda" => "4",
                ],
                [
                    "ujian_id" => 2,
                    "soal_kelompok_id" => 8,
                    "bagian_kode" => "B",
                    "bagian_nama" => "Tes Moderasi Beragama",
                    "bagian_urutan" => "8",
                    "bagian_keterangan" => "Tes moderasi beragama",
                    "jumlah_soal" => "10",
                    "is_pilihan_ganda" => 1,
                    "jumlah_opsi_pilihan_ganda" => "4",
                ]
            ]);
            DB::commit();
        } catch (\Throwable $th) {
            DB::rollback();
            throw $th;
        }
    }
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
        $sesiPeserta = UjianSesiPeserta::with([
            'dataDiri',
            'ujianSesiRuangan' => function ($ujianSesiRuangan) {
                $ujianSesiRuangan->with('ujianSesi')->orderBy('ruangan', 'asc');
            },
            'pesertaSoal'  => function ($ujianSesiPeserta) {
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
            ->whereHas('ujianSesiRuangan.ujianSesi.ujian', function ($ujian) {
                $ujian->where('id', 3);
            })
            ->whereHas('ujianSesiRuangan', function ($ujianSesiRuangan) {
                $ujianSesiRuangan->orderBy('ujian_sesi_id', 'asc');
            })
            // ->orderBy('no_test', 'ASC')
            // ->orderBy(UjianSesiRuangan::select('ujian_sesi_id')->whereColumn('ujian_sesi_ruangans.id', 'ujian_sesi_pesertas.ujian_sesi_ruangan_id'))
            // ->orderBy(UjianSesiRuangan::select('ujian_sesi_id')->where('ujian_sesi_peserta_id', $ujianSesiPesertaId)->whereColumn('soals.id', 'peserta_soals.soal_id'))
            ->get();

        // return $akun;
        $content = "<table border='1' cellpadding='10' cellspacing='0' style='text-align:center; font:arial'>";
        $content .= "<thead>";
        $content .= "<th>NO</th>";
        $content .= "<th>No. Ujian</th>";
        $content .= "<th>Sesi</th>";
        $content .= "<th>Ruang</th>";
        $content .= "<th>Nama Peserta</th>";
        $content .= "<th>Tanggal Lahir</th>";
        $content .= "<th>Nilai</th>";
        $content .= "</thead>";
        $content .= "<tbody>";
        foreach ($sesiPeserta as $index => $row) {
            $jumlahBenar = count($row->pesertaSoal);
            $totalNilai = number_format(($jumlahBenar / 45) * 100, 1);
            $urut = $index + 1;
            $peserta = $row->dataDiri->nama_lengkap;
            $noUjian = $row->no_test;
            $tanggalLahir = $row->dataDiri->lahir_tanggal;
            $content .= "<tr>";
            $content .= "<td>$urut</td>";
            $content .= "<td>$noUjian</td>";
            $content .= "<td>" . $row->ujianSesiRuangan->ujianSesi->sesi . "</td>";
            $content .= "<td>" . $row->ujianSesiRuangan->ruangan . "</td>";
            $content .= "<td style='text-align:left'>$peserta</td>";
            $content .= "<td>$tanggalLahir</td>";
            $content .= "<td><a href='" . route('hasil.ujian.detail', $row->id) . "'>$totalNilai</a></td>";
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
            $ujian->where('id', 3);
        }])
            ->whereHas('userPengawas')
            ->whereHas('userPengawas.ujianSesiRuangan.ujianSesi.ujian', function ($ujian) {
                $ujian->where('id', 3);
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
                $ujian->where('id', 3);
            }])
                ->whereHas('ujianSesi.ujian', function ($ujian) {
                    $ujian->where('id', 3);
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
