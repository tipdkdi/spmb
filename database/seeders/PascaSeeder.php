<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PascaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::beginTransaction();

        try {
            //code...
            DB::table('user_roles')->insert([
                ['nama_role' => 'admin'],
                ['nama_role' => 'dosen'],
                ['nama_role' => 'pengawas'],
                ['nama_role' => 'peserta']
            ]);

            DB::table('pmbs')->insert([
                [
                    "pmb_nama" => "Penerimaan Pascasarjana",
                    "tahun_akademik" => "2024/Ganjil",
                    "biaya_pendaftaran" => 250000,
                    "daftar_mulai" => "2024-01-01",
                    "daftar_selesai" => "2024-01-01",
                    "jenis_ujian" => "offline",
                    "ruang_per_sesi" => 3,
                    "peserta_per_ruang" => 20,
                    "is_publish" => 1,
                ]
            ]);
            DB::table('ujians')->insert([
                [
                    "ujian_nama" => "Ujian Penerimaan Pascasarjana",
                    "tempat" => "IAIN Kendari",
                    "waktu_pengerjaan" => "01:00:00",
                    "is_soal_random" => 1
                ]
            ]);
            DB::table('pmb_ujians')->insert([
                [
                    "pmb_id" => 1,
                    "ujian_id" => 1,
                ]
            ]);

            DB::table('ujian_sesis')->insert([
                [
                    "ujian_id" => 1,  ///ini diganti2 sesuai ujian id yang ingin dilaksanakan
                    "sesi" => "1",
                    "jam_mulai" => "08:15:00",
                    "jam_selesai" => "09:15:00",
                    "sesi_tanggal" => "2024-08-24",
                ],
                [
                    "ujian_id" => 1,
                    "sesi" => "2",
                    "jam_mulai" => "09:30:00",
                    "jam_selesai" => "10:30:00",
                    "sesi_tanggal" => "2024-08-24",
                ],
                [
                    "ujian_id" => 1,
                    "sesi" => "3",
                    "jam_mulai" => "09:30:00",
                    "jam_selesai" => "10:30:00",
                    "sesi_tanggal" => "2024-08-24",
                ]

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
                [
                    "gedung" => "LAB TIPD",
                    "kode_ruangan" => "LAB-03",
                    "ruangan" => "Lab Bahasa",
                ],
            ];

            $array = [];
            $sesi = 0;

            for ($i = 1; $i <= 3; $i++) { //ini id sesi, jadi contoh ujian id 1 sampai 10 sesi, jadi skrg di sini jadi dari 11 -15 karena sampe 5 sesu
                $sesi = 1;

                foreach ($info as $index => $value) {
                    $array[] = [
                        "ujian_sesi_id" => $i,
                        "gedung" => $value['gedung'],
                        "kode_ruangan" => $value['kode_ruangan'],
                        "ruangan" => $value['ruangan'],
                        "nama_pengawas" => "Pengawas " . $value['ruangan'] . " Sesi " . $sesi,
                    ];
                }
                $sesi++;
            }

            DB::table('ujian_sesi_ruangans')->insert($array);
            DB::table('soal_kelompoks')->insert([
                [
                    "kelompok_soal_nama" => "Tes Potensi Akademik (TPA)", //9
                    "keterangan" => 'mengukur kemampuan potensi calon mahasiswa yang dapat menghantarkan penyelesaian dan keberhasilan studi di jenjang strata satu',
                    "is_aktif" => 1,
                ],
                [
                    "kelompok_soal_nama" => "Bahasa Inggris", //10
                    "keterangan" => 'mengukur kemampuan peserta dalam memahami dan menganalisis isi bacaan sederhana dengan menggunakan penalarannya guna memecahkan permasalahan kehidupan sehari-hari melalui penerapan konsep, prosedur dan fakta dalam matematika',
                    "is_aktif" => 1,
                ],
                [
                    "kelompok_soal_nama" => "Bahasa Arab", //11
                    "keterangan" => 'mengukur kemampuan untuk memahami, menggunakan, mengevaluasi, merefleksikan berbagai jenis teks Bahasa Indonesia dan Bahasa Inggris dalam konteks sosio humaniora dan konteks sains serta jenis teks Bahasa Arab untuk menyelesaikan masalah dan mengembangkan kapasitas individu yang moderat dan unggul sebagai warga Indonesia dan warga dunia agar dapat berkontribusi secara produktif dan proporsional',
                    "is_aktif" => 1,
                ],
            ]);
            DB::table('ujian_soal_bagians')->insert([
                [
                    "ujian_id" => 1,
                    "soal_kelompok_id" => 1,
                    "bagian_kode" => "A",
                    "bagian_nama" => "Tes Potensi Akademik (TPA)",
                    "bagian_urutan" => "1",
                    "bagian_keterangan" => "",
                    "jumlah_soal" => "50",
                    "is_pilihan_ganda" => 1,
                    "jumlah_opsi_pilihan_ganda" => "4",
                ],
                [
                    "ujian_id" => 1,
                    "soal_kelompok_id" => 2,
                    "bagian_kode" => "B",
                    "bagian_nama" => "Bahasa Inggris",
                    "bagian_urutan" => "2",
                    "bagian_keterangan" => "",
                    "jumlah_soal" => "25",
                    "is_pilihan_ganda" => 1,
                    "jumlah_opsi_pilihan_ganda" => "4",
                ],
                [
                    "ujian_id" => 1,
                    "soal_kelompok_id" => 3,
                    "bagian_kode" => "C",
                    "bagian_nama" => "Bahasa Arab",
                    "bagian_urutan" => "3",
                    "bagian_keterangan" => "",
                    "jumlah_soal" => "25",
                    "is_pilihan_ganda" => 1,
                    "jumlah_opsi_pilihan_ganda" => "4",
                ],
            ]);
            DB::commit();
        } catch (\Throwable $th) {
            DB::rollback();
            throw $th;
        }
    }
}
