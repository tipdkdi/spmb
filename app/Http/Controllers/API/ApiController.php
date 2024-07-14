<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\UjianSoalBagian;
use App\Models\DataDiri;
use App\Models\PesertaJawaban;
use App\Models\PesertaSoal;
use App\Models\PesertaSoalOpsi;
use App\Models\SoalOpsi;
use App\Models\UjianSesiPeserta;
use App\Models\User;
use App\Models\UserPeserta;
use App\Models\Soal;
use App\Models\SoalKelompok;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\File;

class ApiController extends Controller
{
    //

    public function resetLogin(Request $request)
    {
        try {
            //code...
            $user = User::find($request->id);
            $user->is_login = 0;
            $user->save();
            return response()->json([
                'status' => true,
                'message' => 'sukses',
                'data' => [],
            ], 200);
        } catch (\Throwable $th) {
            throw $th;
        }
    }
    public function updateAktif(Request $request)
    {
        try {
            //code...
            $peserta = UjianSesiPeserta::find($request->id);
            $peserta->is_aktif = $request->is_aktif;
            $peserta->save();
            return response()->json([
                'status' => true,
                'message' => 'sukses',
                'data' => $peserta,
            ], 200);
        } catch (\Throwable $th) {
            return response()->json([
                'status' => false,
                'message' => 'gagal',
                'data' => $th,
            ], 500);
            //throw $th;
        }
    }

    public function updateSelesai(Request $request)
    {
        try {
            //code...
            $peserta = UjianSesiPeserta::find($request->id);
            $peserta->status = "2";
            $peserta->save();
            return response()->json([
                'status' => true,
                'message' => 'sukses',
                'data' => $peserta,
            ], 200);
        } catch (\Throwable $th) {
            return response()->json([
                'status' => false,
                'message' => 'gagal',
                'data' => $th,
            ], 500);
            //throw $th;
        }
        return $peserta;
        return "ggwp";
    }


    function getUrut($nourut)
    {
        $tmp = explode(".", trim($nourut));
        $ret = isset($tmp[1]) ? ceil($tmp[1] % 20) : 0;
        if ($ret == 0)
            $ret = 20;
        if ($ret > 0 && $ret < 10)
            $ret = '0' . $ret;
        return $ret;
    }

    public function importSoal(Request $request)
    {


        try {
            $validator = Validator::make($request->all(), [
                'kelompok_soal_id' => 'required',
                'urut' => 'required',
                'csv_file' => 'required|mimes:csv,txt'
            ]);
            $kelompokSoalId = $request->kelompok_soal_id;

            if ($validator->fails()) {
                return response()->json(['error' => $validator->errors()], 400);
            }

            // Mengambil file CSV dari request
            $file = $request->file('csv_file');

            // Mendapatkan path file sementara
            $filePath = $file->getRealPath();

            // Membaca isi file CSV
            $csvData = array_map('str_getcsv', file($filePath));

            // Menghapus header file CSV (jika ada)
            unset($csvData[0]);

            // return $csvData[1];
            $ur = $request->urut;
            foreach ($csvData as $index => $data) {
                // Buat model Soal
                // fputcsv($file, $data, ';');


                // $soal = Soal::with('opsi')->find($ur);
                // foreach ($soal->opsi as $urut => $item) {
                //     if ($urut == $data[5]) {
                //         $opsi = SoalOpsi::find($item->id);
                //         $opsi->is_jawaban = true;
                //         $opsi->save();
                //     }
                // }
                // $ur = $ur + 1;
                // Loop untuk membuat SoalOpsi
                // for ($i = 1; $i <= 4; $i++) {
                //     $soalOpsi = new SoalOpsi();
                //     $soalOpsi->soal_id = $soal->id;
                //     $soalOpsi->opsi_text = $data[$i];
                //     $soalOpsi->is_jawaban = ($i == ($data[5]));
                //     $soalOpsi->save();
                // }
                $soal = new Soal();
                $soal->soal_kelompok_id = $kelompokSoalId;
                $soal->soal = $data[0];
                $soal->save();

                // Loop untuk membuat SoalOpsi
                for ($i = 1; $i <= 4; $i++) {
                    $soalOpsi = new SoalOpsi();
                    $soalOpsi->soal_id = $soal->id;
                    $soalOpsi->opsi_text = $data[$i];
                    $soalOpsi->is_jawaban = ($i == ($data[5]));
                    $soalOpsi->save();
                }
            }
            return response()->json([
                'status' => true,
                'message' => 'sukses import',
                'data' => $csvData,
            ], 200);
        } catch (\Throwable $th) {
            throw $th;
        }
        // Validasi request


        // foreach ($csvData as $data) {
        //     // Buat model Soal
        //     $soal = new Soal();
        //     $soal->soal_kelompok_id = 2;
        //     $soal->soal = $data[0];
        //     $soal->save();

        //     // Loop untuk membuat SoalOpsi
        //     for ($i = 1; $i <= 4; $i++) {
        //         $soalOpsi = new SoalOpsi();
        //         $soalOpsi->soal_id = $soal->id;
        //         $soalOpsi->opsi_text = $data[$i];
        //         $soalOpsi->is_jawaban = ($i == ($data[5]));
        //         $soalOpsi->save();
        //     }
        // }

        return;
    }

    public function sinkron(Request $request)
    {
        DB::beginTransaction();

        try {

            $data = json_decode($request->data);
            $foto = json_decode($data->foto);

            $defaultFoto = 'https://sia.iainkendari.ac.id/assets/template/admincore/assets/images/user_bg.png';
            // return $foto->path;
            $check = UjianSesiPeserta::where('iddata', $data->iddata);
            if ($check->count() > 0)
                return response()->json([
                    'status' => true,
                    'message' => 'Data sudah ada',
                    'data' => $check->get(),
                ], 200);
            // return $data;
            $dataDiri = DataDiri::create([
                'nama_lengkap' => $data->nama,
                'jenis_kelamin' => $data->kelamin,
                'lahir_tempat' => $data->tmplahir,
                'lahir_tanggal' => $data->tgllahir,
                'no_hp' => $data->hp,
                'alamat_ktp' => $data->alamat,
                'alamat_domisili' => $data->alamat,
                'foto' => ($foto == null) ? $defaultFoto : 'https://sia.iainkendari.ac.id/' . $foto->path,
            ]);


            $ruang = $data->ruang; // ini 40 dari id terakhir ujian mandiri tahap 1, jadi tahap 2 mulai dari id 40 karena manual wkwkk
            $sesi = UjianSesiPeserta::create([
                'ujian_sesi_ruangan_id' => $ruang,
                'iddata' => $data->iddata,
                'data_diri_id' => $dataDiri->id,
                'no_test' => $data->nopendaftaran,
                'no_urut' => $this->getUrut($data->nopendaftaran),
                'is_aktif' => 0,
                'status' => "0",
            ]);
            $tanggal = Carbon::parse($data->tgllahir);
            $tahun = $tanggal->format('Y');
            $user = User::create([
                "username" => $data->nopendaftaran,
                "password" => bcrypt($tahun),
                "user_role_id" => 4,
            ]);
            UserPeserta::create([
                "user_id" => $user->id,
                "ujian_sesi_peserta_id" => $sesi->id,
            ]);
            DB::commit();

            return response()->json([
                'status' => true,
                'message' => 'sukses import',
                'data' => $dataDiri,
            ], 200);
        } catch (\Throwable $th) {
            DB::rollback();
            throw $th;
        }
    }


    public function navigasi($ujianSesiPesertaId)
    {
        $data = UjianSoalBagian::with(['soalKelompok.soal' => function ($soal) use ($ujianSesiPesertaId) {
            $soal->whereHas('pesertaSoal', function ($pesertaSoal) use ($ujianSesiPesertaId) {
                $pesertaSoal
                    ->where('ujian_sesi_peserta_id', $ujianSesiPesertaId)
                    ->orderBy('urutan', 'ASC');
            })
                ->with(['pesertaSoal' => function ($pesertaSoal) use ($ujianSesiPesertaId) {
                    $pesertaSoal->with('pesertaJawaban')
                        ->where('ujian_sesi_peserta_id', $ujianSesiPesertaId);
                }])
                ->orderBy(PesertaSoal::select('urutan')->where('ujian_sesi_peserta_id', $ujianSesiPesertaId)->whereColumn('soals.id', 'peserta_soals.soal_id')->limit(1));
        }, 'ujian'])
            ->whereHas('ujian', function ($ujian) {
                $ujian->where('id', 1);
            })
            ->get();
        // return PesertaSoal::where('ujian_sesi_peserta_id', $ujianSesiPesertaId)->get();
        return $data;
    }

    public function insertSoalTKD($id, $sesiPesertaId, $mulaiUrut, $jumlahSoal)
    {
        $soalBagian = UjianSoalBagian::with(['soalKelompok.soal' => function ($soal) use ($jumlahSoal) {
            $soal->with(['opsi' => function ($opsi) {
                $opsi->inRandomOrder();
            }])->take($jumlahSoal)->inRandomOrder()->get();
        }])->where([
            // 'ujian_id' => $ujianId
            'id' => $id
        ])->get();
        $opsi = [];
        $lastIndex = count($soalBagian[0]->soalKelompok->soal) - 1;
        foreach ($soalBagian[0]->soalKelompok->soal as $index => $item) {
            $urut = $mulaiUrut + $index + 1;
            $pesertaSoal = PesertaSoal::create([
                'ujian_sesi_peserta_id' => $sesiPesertaId,
                'soal_id' => $item->id,
                'urutan' => $urut,
                'is_last_urutan_bagian' => ($lastIndex == $index) ? 1 : 0,
            ]);
            foreach ($item->opsi as $index2 => $row) {
                $opsi[$index2] = $row->id;
            };
            PesertaSoalOpsi::create([
                'peserta_soal_id' => $pesertaSoal->id,
                'opsis_id' => json_encode($opsi),
            ]);
        };
    }


    public function createSoalPeserta(Request $request)
    {

        try {
            //code...
            $sesiPesertaId = $request->ujian_sesi_peserta_id;
            $check = PesertaSoal::where('ujian_sesi_peserta_id', $sesiPesertaId)->count();
            if ($check > 0)
                return response()->json([
                    'status' => true,
                    'message' => 'Sukses',
                    'data' => [],
                ], 200);
            // return $sesiPesertaId;
            $ujianId = $request->ujian_id;
            // $ujianId = 1;

            // [1, 2, 3, 4, 5, 6, 7]
            $this->insertSoalTKD(1, $sesiPesertaId, 0, 15);
            $this->insertSoalTKD(2, $sesiPesertaId, 15, 15);
            $this->insertSoalTKD(3, $sesiPesertaId, 30, 15);
            $this->insertSoalTKD(4, $sesiPesertaId, 45, 15);

            // return $opsi;
            //ini untuk soal moderasi ID 2
            // $soalBagian = UjianSoalBagian::with(['soalKelompok.soal' => function ($soal) {
            //     $soal->with(['opsi' => function ($opsi) {
            //         $opsi->inRandomOrder();
            //     }])->inRandomOrder()->take(10)->get();
            // }])->where([
            //     // 'ujian_id' => $ujianId
            //     'id' => 16
            // ])->get();
            // $opsi = [];
            // $lastIndex = count($soalBagian[0]->soalKelompok->soal) - 1;
            // foreach ($soalBagian[0]->soalKelompok->soal as $index => $item) {
            //     $pesertaSoal = PesertaSoal::create([
            //         'ujian_sesi_peserta_id' => $sesiPesertaId,
            //         'soal_id' => $item->id,
            //         'urutan' => 35 + $index + 1,
            //         'is_last_urutan_bagian' => ($lastIndex == $index) ? 1 : 0,
            //     ]);
            //     foreach ($item->opsi as $index2 => $row) {
            //         $opsi[$index2] = $row->id;
            //     };
            //     PesertaSoalOpsi::create([
            //         'peserta_soal_id' => $pesertaSoal->id,
            //         'opsis_id' => json_encode($opsi),
            //     ]);
            // };

            $sesiPeserta = UjianSesiPeserta::find($sesiPesertaId);
            $sesiPeserta->status = "1";
            $sesiPeserta->save();

            return response()->json([
                'status' => true,
                'message' => 'Sukses',
                'data' => $sesiPeserta,
            ], 200);
        } catch (\Throwable $th) {
            // return response()->json([
            //     'status' => true,
            //     'message' => 'ada masalah',
            //     'data' => $th,
            // ], 500);
            throw $th;
        }

        // return $soalBagian;
        // $sesi = UjianSesiPeserta::create([
        //     "ujian_sesi_peserta_id" => $sesiPesertaId,
        //     "soal_id" => 2,
        //     "urutan" => "1",
        //     "is_last_urutan_bagian" => 0,
        // ]);

        // PesertaSoalOpsi::create([
        //     "peserta_soal_id" => $sesi,
        //     "opsis_id" => "[5, 7, 8, 6]",
        // ]);
    }
    public function soal(Request $request)
    {
        // return $request->all();
        $ujianId = $request->ujian_id;
        $ujianSesiPesertaId = $request->ujian_peserta_id;
        $bagianUrutan = $request->bagian_urutan;
        $soalUrutan = $request->pertanyaan_urutan;

        $data = UjianSoalBagian::with(['soalKelompok.soal' => function ($soal) use ($soalUrutan, $ujianSesiPesertaId) {
            $soal->with(['pesertaSoal' => function ($pesertaSoal) use ($soalUrutan, $ujianSesiPesertaId) {
                $pesertaSoal->with(['pesertaSoalOpsi', 'pesertaJawaban'])
                    ->where(['ujian_sesi_peserta_id' => $ujianSesiPesertaId, 'urutan' => $soalUrutan]);
            }, 'soalKelompok'])
                ->whereHas('pesertaSoal', function ($pesertaSoal) use ($soalUrutan, $ujianSesiPesertaId) {
                    $pesertaSoal->where(['ujian_sesi_peserta_id' => $ujianSesiPesertaId, 'urutan' => $soalUrutan]);
                });
        }])->where([
            'ujian_id' => $ujianId,
            'bagian_urutan' => $bagianUrutan,
        ])->get();
        // return json_decode($data->pertanyaan[0]->pesertaPertanyaan->pesertaPertanyaanOpsi[0]->opsis_id);
        // return $data[0]->soalKelompok->soal[0]->pesertaSoal->pesertaSoalOpsi->opsis_id;
        // return $data[0];
        $opsiIds = json_decode($data[0]->soalKelompok->soal[0]->pesertaSoal->pesertaSoalOpsi->opsis_id);
        $data[0]->soalKelompok->soal[0]->pesertaSoal->pesertaSoalOpsi->opsis = SoalOpsi::whereIn('id', $opsiIds)->orderByRaw("FIELD(id, " . implode(',', $opsiIds) . ")")
            ->get();
        return $data[0];
    }

    public function pertanyaanTerjawab($bagianId)
    {
    }

    public function jawabanStore(Request $request)
    {
        try {
            $request->validate([
                'peserta_soal_id' => 'required|integer',
                'soal_opsi_id' => 'required|integer',
            ]);
            // $data = PesertaJawaban::create($validated);
            $data = PesertaJawaban::updateOrCreate(
                ['peserta_soal_id' => $request->peserta_soal_id],
                ['soal_opsi_id' => $request->soal_opsi_id]
            );
            return response()->json([
                'status' => true,
                'message' => 'Jawaban disimpan',
                'data' => $data,
            ], 200);
        } catch (\Throwable $th) {
            throw $th;
            // return response()->json([
            //     'status' => false,
            //     'message' => 'ada kesalahan sistem, mohon coba lagi',
            //     'data' => $th,
            // ], 500);
        }
    }

    public function kelompokSoal(Request $request)
    {
        $dataQuery = Soal::with([
            'opsi', 'soalKelompok',
        ])
            ->orderBy('soal_kelompok_id', 'ASC')
            ->orderBy('id', 'DESC');

        if ($request->filled('id')) {
            $id = $request->input('id');
            $dataQuery->where('id', $id);
        } else {
            if ($request->filled('search')) {
                $search = $request->input('search');
                $dataQuery->where('soal', 'LIKE', '%' . $search . '%');
            }

            if ($request->filled('soal_kelompok_id')) {
                $soal_kelompok_id = $request->input('soal_kelompok_id');
                $dataQuery->whereHas('soalKelompok', function ($query) use ($soal_kelompok_id) {
                    $query->where('id', $soal_kelompok_id);
                });
            }
        }

        $data = $dataQuery->paginate(30);
        // return response()->json($data);
        return response()->json([
            'status' => true,
            'message' => 'Jawaban disimpan',
            'data' => $data,
        ], 200);
    }

    // public function kelompokSoal()
    // {
    //     try {
    //         // $query = SoalKelompok::query();

    //         // if ($request->has('soal_kelompok_id')) {
    //         //     $query->with('soal')->find($request->soal_kelompok_id);
    //         //     return response()->json([
    //         //         'status' => true,
    //         //         'message' => 'Data usulan ditemukan',
    //         //         'data' => $query->get()
    //         //     ], 200);
    //         // }
    //         // return response()->json([
    //         //     'status' => true,
    //         //     'message' => 'Data usulan ditemukan',
    //         //     'data' => $query->paginate(50)
    //         // ], 200);



    //         // return response()->json([
    //         //     'status' => false,
    //         //     'message' => 'Data usulan tidak ditemukan',
    //         //     'data' => $query,
    //         // ], 404);
    //         $soal = SoalKelompok::with('soal')->get();
    //         return response()->json([
    //             'status' => true,
    //             'message' => 'data ditemukan',
    //             'data' => $soal,
    //         ], 200);
    //     } catch (\Throwable $th) {
    //         //throw $th;
    //         return response()->json([
    //             'status' => false,
    //             'message' => 'gagal',
    //             'data' => [],
    //         ], 201);
    //     }
    // }
    public function getSoal($kelompokSoalId)
    {

        try {
            $soal = Soal::with('opsi')->where('soal_kelompok_id', $kelompokSoalId)->paginate(20);
            return response()->json([
                'status' => true,
                'message' => 'data ditemukan',
                'data' => $soal,
            ], 200);
        } catch (\Throwable $th) {
            //throw $th;
            return response()->json([
                'status' => false,
                'message' => 'gagal',
                'data' => [],
            ], 201);
        }
    }
    public function storeSoal(Request $request)
    {
        // return $request->opsi;
        DB::beginTransaction();

        try {
            $soal = Soal::updateOrCreate([
                'id' => $request->soal_id,
            ], [
                'soal_kelompok_id' => $request->soal_kelompok_id,
                'soal' => $request->soal,
            ]);
            if ($request->soal_id == null) {
                // for ($i = 0; $i <= 3; $i++) {
                //     SoalOpsi::create([
                //         'soal_id' => $request->opsi[$i]['soal_opsi_id'],
                //         'opsi_text' => $request->opsi[$i]['opsi_text'],
                //         'is_jawaban' => $request->opsi[$i]['is_jawaban'],
                //     ]);
                // }
                foreach ($request->opsi as $item) {
                    SoalOpsi::create([
                        'soal_id' => $soal->id,
                        'opsi_text' => $item['opsi_text'],
                        'is_jawaban' => $item['is_jawaban'],
                    ]);
                }
            } else {
                foreach ($request->opsi as $item) {
                    SoalOpsi::create([
                        'soal_id' => $item->soal_opsi_id,
                        'opsi_text' => $item['opsi_text'],
                        'is_jawaban' => $item['is_jawaban'],
                    ]);
                }
            }
            DB::commit();

            return response()->json([
                'status' => true,
                'message' => 'data ditemukan',
                'data' => $soal,
            ], 200);
        } catch (\Throwable $th) {
            DB::rollback();
            throw $th;
            return;
            return response()->json([
                'status' => false,
                'message' => 'gagal',
                'data' => [],
            ], 201);
        }
    }

    public function deleteSoal($id)
    {
        try {
            $data = Soal::find($id);
            $data->delete();
            return response()->json([
                'status' => true,
                'message' => 'data dihapus',
                'data' => $data,
            ], 200);
        } catch (\Throwable $th) {
            //throw $th;
            return response()->json([
                'status' => false,
                'message' => 'gagal',
                'data' => [],
            ], 201);
        }
    }
    public function selectSoal($soalId)
    {
        try {
            $soal = Soal::with('opsi')->find($soalId);
            return response()->json([
                'status' => true,
                'message' => 'Soal ditemukan',
                'data' => $soal,
            ], 200);
        } catch (\Throwable $th) {
            //throw $th;
            return response()->json([
                'status' => false,
                'message' => 'gagal',
                'data' => [],
            ], 201);
        }
    }
    public function updateSoal(Request $request, $soalId)
    {
        try {
            $soal = Soal::find($soalId);
            $soal->soal = $request->soal;
            $soal->save();
            return response()->json([
                'status' => true,
                'message' => 'Soal diupdate disimpan',
                'data' => $soal,
            ], 200);
        } catch (\Throwable $th) {
            //throw $th;
            return response()->json([
                'status' => false,
                'message' => 'gagal',
                'data' => [],
            ], 201);
        }
    }

    public function uploadKontenEditor(Request $request)
    {
        $request->validate([
            'file' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $storagePath = 'editor/images/' . date('Y') . '/' . date('m');
        $path = $this->uploadFile($request, 'file', $storagePath);
        $path = url('/' . $path);
        return response()->json(['success' => 'Image uploaded successfully.', 'image' => $path]);
    }


    function uploadFile($request, $reqFileName = 'file', $storagePath = null, $fileName = null)
    {
        $uploadedFile = $request->file($reqFileName);
        $originalFileName = $uploadedFile->getClientOriginalName();
        $ukuranFile = $uploadedFile->getSize();
        $tipeFile = $uploadedFile->getMimeType();
        $ext = $uploadedFile->getClientOriginalExtension();

        if (!$storagePath)
            $storagePath = 'uploads/' . date('Y') . '/' . date('m');

        if (!File::isDirectory(public_path($storagePath))) {
            File::makeDirectory(public_path($storagePath), 0755, true);
        }

        if (!$fileName)
            $fileName = $this->generateUniqueFileName();
        else
            $fileName = $fileName . "." . $uploadedFile->getClientOriginalExtension();

        $fileName .= '.' . $ext;

        $uploadedFile->move(public_path($storagePath), $fileName);
        $fileFullPath = public_path($storagePath . '/' . $fileName);
        chmod($fileFullPath, 0755);
        $path = $storagePath . '/' . $fileName;
        return $path;
    }


    function generateUniqueFileName()
    {
        return $randomString = time() . Str::random(22);
    }
}
