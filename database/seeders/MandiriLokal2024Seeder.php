<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MandiriLokal2024Seeder extends Seeder
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
                    "pmb_nama" => "SMBK 2024",
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
                    "ujian_nama" => "Ujian Seleksi Masuk Berbasis Komputer",
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
                    "ujian_id" => 1,
                    "sesi" => "1",
                    "jam_mulai" => "08:15:00",
                    "jam_selesai" => "09:15:00",
                    "sesi_tanggal" => "2024-08-19",
                ],
                [
                    "ujian_id" => 1,
                    "sesi" => "2",
                    "jam_mulai" => "08:15:00",
                    "jam_selesai" => "09:15:00",
                    "sesi_tanggal" => "2024-08-19",
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
                    "kode_ruangan" => "LAB-01",
                    "ruangan" => "LAB 01",
                ],
            ];

            $array = [];
            for ($i = 1; $i <= 2; $i++) {
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

            DB::table('soal_kelompoks')->insert([
                [
                    "kelompok_soal_nama" => "Penalaran Akademik (PA)", //9
                    "keterangan" => 'mengukur kemampuan potensi calon mahasiswa yang dapat menghantarkan penyelesaian dan keberhasilan studi di jenjang strata satu',
                    "is_aktif" => 1,
                ],
                [
                    "kelompok_soal_nama" => "Penalaran Matematika", //10
                    "keterangan" => 'mengukur kemampuan peserta dalam memahami dan menganalisis isi bacaan sederhana dengan menggunakan penalarannya guna memecahkan permasalahan kehidupan sehari-hari melalui penerapan konsep, prosedur dan fakta dalam matematika',
                    "is_aktif" => 1,
                ],
                [
                    "kelompok_soal_nama" => "Literasi membaca", //11
                    "keterangan" => 'mengukur kemampuan untuk memahami, menggunakan, mengevaluasi, merefleksikan berbagai jenis teks Bahasa Indonesia dan Bahasa Inggris dalam konteks sosio humaniora dan konteks sains serta jenis teks Bahasa Arab untuk menyelesaikan masalah dan mengembangkan kapasitas individu yang moderat dan unggul sebagai warga Indonesia dan warga dunia agar dapat berkontribusi secara produktif dan proporsional',
                    "is_aktif" => 1,
                ],
                [
                    "kelompok_soal_nama" => "Literasi Ajaran Islam", //12
                    "keterangan" => 'mengukur kemampuan memahami, menerapkan dan menganalisis materi ajaran Islam meliputi Al-Quran, Hadis, Fikih dan Sejarah Kebudayaan Islam dalam konteks personal, masyarakat, global dan moderasi untuk mewujudkan masyarakat madani.',
                    "is_aktif" => 1,
                ],
            ]);

            DB::table('ujian_soal_bagians')->insert([
                [
                    "ujian_id" => 1,
                    "soal_kelompok_id" => 1,
                    "bagian_kode" => "A",
                    "bagian_nama" => "Tes Penalaran Akademik (TPA)",
                    "bagian_urutan" => "1",
                    "bagian_keterangan" => "",
                    "jumlah_soal" => "15",
                    "is_pilihan_ganda" => 1,
                    "jumlah_opsi_pilihan_ganda" => "4",
                ],
                [
                    "ujian_id" => 1,
                    "soal_kelompok_id" => 2,
                    "bagian_kode" => "B",
                    "bagian_nama" => "Perhitungan Matematika",
                    "bagian_urutan" => "2",
                    "bagian_keterangan" => "",
                    "jumlah_soal" => "15",
                    "is_pilihan_ganda" => 1,
                    "jumlah_opsi_pilihan_ganda" => "4",
                ],
                [
                    "ujian_id" => 1,
                    "soal_kelompok_id" => 3,
                    "bagian_kode" => "C",
                    "bagian_nama" => "Literasi membaca",
                    "bagian_urutan" => "3",
                    "bagian_keterangan" => "",
                    "jumlah_soal" => "15",
                    "is_pilihan_ganda" => 1,
                    "jumlah_opsi_pilihan_ganda" => "4",
                ],
                [
                    "ujian_id" => 1,
                    "soal_kelompok_id" => 4,
                    "bagian_kode" => "D",
                    "bagian_nama" => "Tes Literasi Ajaran Islam",
                    "bagian_urutan" => "4",
                    "bagian_keterangan" => "",
                    "jumlah_soal" => "15",
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
}
