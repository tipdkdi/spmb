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
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Illuminate\Support\Facades\Validator;

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
        $csvData = [
            // Pertanyaan 1
            ['Apa yang dimaksud dengan moderasi beragama?', 'Sikap mempertahankan kebenaran agama sendiri', 'Sikap mengabaikan agama lain', 'Sikap toleransi dan saling menghormati antaragama', 'Sikap mendorong konflik agama', '3'],
            // Pertanyaan 2
            ['Apa yang menjadi tujuan dari moderasi beragama?', 'Menekankan keunggulan agama tertentu', 'Menghancurkan agama lain', 'Menciptakan harmoni dan toleransi antaragama', 'Memaksa konversi agama', '3'],
            // Pertanyaan 3
            ['Bagaimana moderasi beragama dapat memperkuat kerukunan antarumat beragama?', 'Dengan mengabaikan perbedaan agama', 'Dengan meningkatkan pemahaman antaragama', 'Dengan memperkuat dominasi agama tertentu', 'Dengan mendorong konflik agama', '2'],
            // Pertanyaan 4
            ['Apa yang dapat dilakukan oleh individu dalam mempromosikan moderasi beragama?', 'Mengisolasi diri dari kelompok agama lain', 'Mempertahankan sikap intoleransi terhadap agama lain', 'Menjaga kerukunan dan saling menghormati antaragama', 'Memperkuat perpecahan antaragama', '3'],
            // Pertanyaan 5
            ['Bagaimana moderasi beragama dapat membantu mencegah konflik agama?', 'Dengan memperkuat persepsi negatif terhadap agama lain', 'Dengan menghancurkan bangunan ibadah agama lain', 'Dengan menciptakan dialog dan pemahaman antaragama', 'Dengan memaksa konversi agama', '3'],
            // Pertanyaan 6
            ['Apa yang menjadi hambatan dalam menerapkan moderasi beragama?', 'Ketidakpedulian terhadap keberagaman agama', 'Toleransi dan saling menghormati antaragama', 'Kurangnya pemahaman antaragama', 'Kesediaan untuk bekerja sama dengan agama lain', '1'],
            // Pertanyaan 7
            ['Bagaimana peran pemimpin agama dalam mempromosikan moderasi beragama?', 'Menghasut kebencian terhadap agama lain', 'Menjaga harmoni dan kerukunan antaragama', 'Memperkuat pemisahan antaragama', 'Membatasi kebebasan beragama', '2'],
            // Pertanyaan 8
            ['Apa yang dimaksud dengan sikap inklusif dalam moderasi beragama?', 'Mengutuk agama lain', 'Mengabaikan perbedaan agama', 'Menerima keberagaman agama', 'Mempertahankan sikap intoleransi terhadap agama lain', '3'],
            // Pertanyaan 9
            ['Bagaimana pentingnya memahami agama lain dalam moderasi beragama?', 'Tidak ada hubungan antara moderasi beragama dan pemahaman agama lain', 'Meningkatkan toleransi dan saling menghormati antaragama', 'Mendorong konversi agama', 'Memperkuat perpecahan antaragama', '2'],
            // Pertanyaan 10
            ['Apa yang dapat dilakukan oleh masyarakat dalam menciptakan moderasi beragama?', 'Membatasi kebebasan beragama', 'Menghancurkan tempat ibadah agama lain', 'Menghormati keberagaman agama', 'Menghasut kebencian terhadap agama lain', '3'],
            ['Bagaimana moderasi beragama dapat membantu membangun perdamaian sosial?', 'Dengan memperkuat konflik antaragama', 'Dengan membatasi kebebasan beragama', 'Dengan menciptakan dialog dan kerjasama antaragama', 'Dengan memaksa konversi agama', '3'],
            // Pertanyaan 2
            ['Apa yang dimaksud dengan sikap non-diskriminasi dalam moderasi beragama?', 'Mendiskriminasi agama lain', 'Mengabaikan perbedaan agama', 'Menghargai dan menghormati keberagaman agama', 'Membatasi kebebasan beragama', '3'],
            // Pertanyaan 3
            ['Bagaimana moderasi beragama dapat berkontribusi dalam memerangi intoleransi agama?', 'Dengan memperkuat polarisasi agama', 'Dengan menciptakan dialog dan pemahaman antaragama', 'Dengan membatasi kebebasan beragama', 'Dengan memaksa konversi agama', '2'],
            // Pertanyaan 4
            ['Apa yang menjadi faktor pendukung moderasi beragama?', 'Fanatisme agama', 'Toleransi dan saling menghormati antaragama', 'Ketidakpedulian terhadap agama lain', 'Menghancurkan tempat ibadah agama lain', '2'],
            // Pertanyaan 5
            ['Bagaimana peran pendidikan dalam mempromosikan moderasi beragama?', 'Mengajarkan intoleransi terhadap agama lain', 'Mengabaikan keberagaman agama', 'Mengembangkan pemahaman dan penghargaan terhadap agama lain', 'Menghancurkan tempat ibadah agama lain', '3'],
            // Pertanyaan 6
            ['Apa yang dimaksud dengan konflik agama?', 'Kerjasama dan harmoni antaragama', 'Perbedaan pendapat antaragama', 'Menghormati keberagaman agama', 'Persaingan dan pertentangan antaragama', '4'],
            // Pertanyaan 7
            ['Bagaimana moderasi beragama dapat memperkuat kerukunan sosial?', 'Dengan memisahkan agama-agama', 'Dengan membatasi kebebasan beragama', 'Dengan menciptakan saling pengertian dan toleransi antaragama', 'Dengan memaksa konversi agama', '3'],
            // Pertanyaan 8
            ['Apa yang menjadi hambatan dalam menerapkan moderasi beragama di masyarakat?', 'Toleransi dan saling menghormati antaragama', 'Fanatisme agama', 'Menghormati keberagaman agama', 'Mengabaikan perbedaan agama', '2'],
            // Pertanyaan 9
            ['Bagaimana pentingnya membangun dialog antaragama dalam mewujudkan moderasi beragama?', 'Tidak ada hubungan antara dialog antaragama dan moderasi beragama', 'Mendiskriminasi agama lain', 'Membatasi kebebasan beragama', 'Menghormati keberagaman agama', '4'],
            // Pertanyaan 10
            ['Apa yang dapat dilakukan oleh individu dalam menerapkan moderasi beragama sehari-hari?', 'Menghancurkan tempat ibadah agama lain', 'Mengabaikan keberagaman agama', 'Menghormati dan menghargai agama lain', 'Mengajarkan intoleransi terhadap agama lain', '3'],
        ];

        $csvData2 = [
            ['2 + 2 = ?', '3', '4', '5', '6', '2'],
            ['Siapa presiden Indonesia pertama?', 'Soekarno', 'Soeharto', 'BJ Habibie', 'Megawati Soekarnoputri', '1'],
            ['Apa ibu kota Indonesia?', 'Jakarta', 'Bandung', 'Surabaya', 'Yogyakarta', '1'],
            // Pertanyaan 4
            ['Berapa banyak hari dalam setahun?', '365', '366', '360', '300', '1'],
            // Pertanyaan 5
            ['Berapa jumlah provinsi di Indonesia?', '30', '34', '36', '40', '2'],
            // Pertanyaan 6
            ['Apa kepanjangan dari HTML?', 'Hyper Text Markup Language', 'High Tech Machine Learning', 'Home Tool Management Language', 'Healthcare Technology Management Laboratory', '1'],
            // Pertanyaan 7
            ['Siapa penemu teori relativitas?', 'Isaac Newton', 'Albert Einstein', 'Galileo Galilei', 'Nikola Tesla', '2'],
            // Pertanyaan 8
            ['Apa yang menjadi simbol kimia untuk emas?', 'Au', 'Ag', 'Fe', 'Na', '1'],
            // Pertanyaan 9
            ['Berapa sisi yang dimiliki oleh kubus?', '4', '5', '6', '8', '3'],
            // Pertanyaan 10
            ['Apa yang menjadi simbol kimia untuk air?', 'H2O', 'O2', 'CO2', 'C6H12O6', '1'],
            // Pertanyaan 1
            ['Berapakah hasil dari 6 + 3?', '7', '8', '9', '10', '2'],
            // Pertanyaan 2
            ['Siapa penulis novel "Laskar Pelangi"?', 'Andrea Hirata', 'Tere Liye', 'Dewi Lestari', 'Agnes Jessica', '1'],
            // Pertanyaan 3
            ['Apa bahasa yang paling banyak digunakan di dunia?', 'Bahasa Inggris', 'Bahasa Mandarin', 'Bahasa Spanyol', 'Bahasa Jepang', '2'],
            // Pertanyaan 4
            ['Berapa jumlah planet dalam tata surya kita?', '6', '7', '8', '9', '3'],
            // Pertanyaan 5
            ['Apa yang menjadi simbol kimia untuk besi?', 'Fe', 'Au', 'Ag', 'Cu', '1'],
            // Pertanyaan 6
            ['Siapa pelukis terkenal yang melukis Mona Lisa?', 'Vincent van Gogh', 'Leonardo da Vinci', 'Pablo Picasso', 'Salvador Dali', '2'],
            // Pertanyaan 7
            ['Apa ibu kota Jepang?', 'Tokyo', 'Kyoto', 'Osaka', 'Hiroshima', '1'],
            // Pertanyaan 8
            ['Berapa jumlah mata dadu yang ada?', '4', '6', '8', '10', '2'],
            // Pertanyaan 9
            ['Apa yang menjadi simbol kimia untuk oksigen?', 'O2', 'H2O', 'CO2', 'N2', '1'],
            ['Siapa penulis drama Romeo dan Juliet?', 'William Shakespeare', 'Charles Dickens', 'Jane Austen', 'Mark Twain', '1'],
            ['Apa bilangan berikutnya dalam deret: 2, 4, 6, 8, ... ?', '10', '12', '14', '16', '2'],
            ['Apa pola dalam deret: 1, 4, 9, 16, ... ?', '25', '36', '49', '64', '3'],
            ['Apa bilangan ke-7 dalam deret Fibonacci: 0, 1, 1, 2, 3, 5, ... ?', '8', '10', '12', '13', '4'],
            ['Apa bilangan berikutnya dalam deret: 3, 6, 9, 12, ... ?', '15', '16', '18', '21', '1'],
            ['Jika semua kucing adalah hewan, dan semua hewan adalah mamalia, maka apakah semua kucing mamalia?', 'Ya', 'Tidak', '', '', '1'],
            ['Jika A = 5, B = 10, dan C = 15, maka berapakah A + B + C ?', '20', '25', '30', '35', '3'],
            ['Jika 5 + 3 = 28, 9 + 1 = 810, dan 8 + 6 = 214, maka 7 + 5 = ?', '211', '113', '101', '212', '4'],
            ['Jika semua manusia adalah makhluk hidup, dan semua hewan adalah makhluk hidup, maka apakah semua hewan adalah manusia?', 'Ya', 'Tidak', '-', '-', '2'],
            ['Apa ibu kota Australia?', 'Sydney', 'Melbourne', 'Canberra', 'Brisbane', '3'],
            ['Siapa penemu telepon?', 'Thomas Edison', 'Alexander Graham Bell', 'Nikola Tesla', 'Albert Einstein', '2'],
            ['Berapa banyak benua di dunia?', '4', '5', '6', '7', '4'],
            ['Apa nama ilmuwan terkenal yang menemukan hukum gravitasi?', 'Isaac Newton', 'Galileo Galilei', 'Albert Einstein', 'Stephen Hawking', '1'],
            ['Apa yang menjadi simbol kimia untuk natrium?', 'Na', 'K', 'Ca', 'Mg', '1'],
            ['Apa nama laut terluas di dunia?', 'Laut Pasifik', 'Laut Hindia', 'Laut Atlantik', 'Laut Arktik', '1'],
            ['Siapa penulis novel "Harry Potter"?', 'J.R.R. Tolkien', 'J.K. Rowling', 'George Orwell', 'Ernest Hemingway', '2'],
            ['Berapa banyak huruf dalam alfabet bahasa Inggris?', '24', '25', '26', '27', '3'],
            ['Apa ibu kota Prancis?', 'Paris', 'Roma', 'Berlin', 'London', '1'],
            ['Siapa pelukis terkenal yang melukis "The Starry Night"?', 'Vincent van Gogh', 'Leonardo da Vinci', 'Pablo Picasso', 'Salvador Dali', '1'],
        ];

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

            // return $csvData;
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
            $this->insertSoalTKD(2, $sesiPesertaId, 15, 10);
            $this->insertSoalTKD(3, $sesiPesertaId, 25, 5);
            $this->insertSoalTKD(4, $sesiPesertaId, 30, 15);
            $this->insertSoalTKD(5, $sesiPesertaId, 45, 15);

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
}
