<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();

        DB::table('user_roles')->insert([
            ['nama_role' => 'admin'],
            ['nama_role' => 'dosen'],
            ['nama_role' => 'pengawas'],
            ['nama_role' => 'peserta']
        ]);


        DB::table('pmbs')->insert([
            [
                "pmb_nama" => "PMB Jalur Mandiri",
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
                "ujian_nama" => "Ujian Penerimaan Mahasiswa Baru Jalur Mandiri 2023",
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
        // DB::table('pmb_pendaftars')->insert([
        //     [
        //         "pmb_id" => 1,
        //         "data_diri_id" => 200,
        //         "nisn" => "nisin123323",
        //     ]
        // ]);

        DB::table('ujian_sesis')->insert([
            [
                "ujian_id" => 1,
                "sesi" => "1",
                "jam_mulai" => "08:15:00",
                "jam_selesai" => "09:15:00",
                "sesi_tanggal" => "2023-07-10",
            ],
            [
                "ujian_id" => 1,
                "sesi" => "2",
                "jam_mulai" => "09:30:00",
                "jam_selesai" => "10:30:00",
                "sesi_tanggal" => "2023-07-10",
            ],
            [
                "ujian_id" => 1,
                "sesi" => "3",
                "jam_mulai" => "10:45:00",
                "jam_selesai" => "11:45:00",
                "sesi_tanggal" => "2023-07-10",
            ],
            [
                "ujian_id" => 1,
                "sesi" => "4",
                "jam_mulai" => "13:00:00",
                "jam_selesai" => "14:00:00",
                "sesi_tanggal" => "2023-07-10",
            ],
            [
                "ujian_id" => 1,
                "sesi" => "5",
                "jam_mulai" => "14:15:00",
                "jam_selesai" => "15:15:00",
                "sesi_tanggal" => "2023-07-10",
            ],

            [
                "ujian_id" => 1,
                "sesi" => "6",
                "jam_mulai" => "08:15:00",
                "jam_selesai" => "09:15:00",
                "sesi_tanggal" => "2023-07-11",
            ],
            [
                "ujian_id" => 1,
                "sesi" => "7",
                "jam_mulai" => "09:30:00",
                "jam_selesai" => "10:30:00",
                "sesi_tanggal" => "2023-07-11",
            ],
            [
                "ujian_id" => 1,
                "sesi" => "8",
                "jam_mulai" => "10:45:00",
                "jam_selesai" => "11:45:00",
                "sesi_tanggal" => "2023-07-11",
            ],
            [
                "ujian_id" => 1,
                "sesi" => "9",
                "jam_mulai" => "13:00:00",
                "jam_selesai" => "14:00:00",
                "sesi_tanggal" => "2023-07-11",
            ],
            [
                "ujian_id" => 1,
                "sesi" => "10",
                "jam_mulai" => "14:15:00",
                "jam_selesai" => "15:15:00",
                "sesi_tanggal" => "2023-07-11",
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
            [
                "gedung" => "LAB TIPD",
                "kode_ruangan" => "LAB-03",
                "ruangan" => "Lab Bahasa",
            ],
        ];

        $array = [];
        for ($i = 1; $i <= 10; $i++) {
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

        // DB::table('ujian_sesi_ruangans')->insert([
        //     [
        //         "ujian_sesi_id" => 1, //sesi 1 ruang 1
        //         "gedung" => "LAB TIPD",
        //         "kode_ruangan" => "LAB-01",
        //         "ruangan" => "LAB 01",
        //         "nama_pengawas" => "Pengawas Ruang 1 Sesi 1",
        //     ],
        //     [
        //         "ujian_sesi_id" => 1, //sesi 1 ruang 2
        //         "gedung" => "LAB TIPD",
        //         "kode_ruangan" => "LAB-02",
        //         "ruangan" => "LAB 02",
        //         "nama_pengawas" => "Pengawas Ruang 2 Sesi 1",
        //     ],
        //     [
        //         "ujian_sesi_id" => 1, //sesi 1 ruang 3
        //         "gedung" => "LAB TIPD",
        //         "kode_ruangan" => "LAB-03",
        //         "ruangan" => "Lab Bahasa",
        //         "nama_pengawas" => "Pengawas Ruang 3 Sesi 1",
        //     ],

        //     [
        //         "ujian_sesi_id" => 2, //sesi 1 ruang 1
        //         "gedung" => "LAB TIPD",
        //         "kode_ruangan" => "LAB-01",
        //         "ruangan" => "LAB 01",
        //         "nama_pengawas" => "Pengawas Ruang 1 Sesi 2",
        //     ],
        //     [
        //         "ujian_sesi_id" => 2, //sesi 1 ruang 2
        //         "gedung" => "LAB TIPD",
        //         "kode_ruangan" => "LAB-02",
        //         "ruangan" => "LAB 02",
        //         "nama_pengawas" => "Pengawas Ruang 3 Sesi 2",
        //     ],
        //     [
        //         "ujian_sesi_id" => 2, //sesi 1 ruang 3
        //         "gedung" => "LAB TIPD",
        //         "kode_ruangan" => "LAB-03",
        //         "ruangan" => "Lab Bahasa",
        //         "nama_pengawas" => "Pengawas Ruang 3 Sesi 2",
        //     ],

        //     [
        //         "ujian_sesi_id" => 3, //sesi 1 ruang 1
        //         "gedung" => "LAB TIPD",
        //         "kode_ruangan" => "LAB-01",
        //         "ruangan" => "LAB 01",
        //         "nama_pengawas" => "Pengawas Ruang 1 Sesi 3",
        //     ],
        //     [
        //         "ujian_sesi_id" => 3, //sesi 1 ruang 2
        //         "gedung" => "LAB TIPD",
        //         "kode_ruangan" => "LAB-02",
        //         "ruangan" => "LAB 02",
        //         "nama_pengawas" => "Pengawas Ruang 2 Sesi 3",
        //     ],
        //     [
        //         "ujian_sesi_id" => 3, //sesi 1 ruang 3
        //         "gedung" => "LAB TIPD",
        //         "kode_ruangan" => "LAB-03",
        //         "ruangan" => "Lab Bahasa",
        //         "nama_pengawas" => "Pengawas Ruang 3 Sesi 3",
        //     ],

        //     [
        //         "ujian_sesi_id" => 4, //sesi 1 ruang 1
        //         "gedung" => "LAB TIPD",
        //         "kode_ruangan" => "LAB-01",
        //         "ruangan" => "LAB 01",
        //         "nama_pengawas" => "Pengawas Ruang 1 Sesi 4",
        //     ],
        //     [
        //         "ujian_sesi_id" => 4, //sesi 1 ruang 2
        //         "gedung" => "LAB TIPD",
        //         "kode_ruangan" => "LAB-02",
        //         "ruangan" => "LAB 02",
        //         "nama_pengawas" => "Pengawas Ruang 2 Sesi 4",
        //     ],
        //     [
        //         "ujian_sesi_id" => 4, //sesi 1 ruang 3
        //         "gedung" => "LAB TIPD",
        //         "kode_ruangan" => "LAB-03",
        //         "ruangan" => "Lab Bahasa",
        //         "nama_pengawas" => "Pengawas Ruang 3 Sesi 4",
        //     ],

        //     [
        //         "ujian_sesi_id" => 5, //sesi 1 ruang 1
        //         "gedung" => "LAB TIPD",
        //         "kode_ruangan" => "LAB-01",
        //         "ruangan" => "LAB 01",
        //         "nama_pengawas" => "Pengawas Ruang 1 Sesi 5",
        //     ],
        //     [
        //         "ujian_sesi_id" => 5, //sesi 1 ruang 2
        //         "gedung" => "LAB TIPD",
        //         "kode_ruangan" => "LAB-02",
        //         "ruangan" => "LAB 02",
        //         "nama_pengawas" => "Pengawas Ruang 2 Sesi 5",
        //     ],
        //     [
        //         "ujian_sesi_id" => 5, //sesi 1 ruang 3
        //         "gedung" => "LAB TIPD",
        //         "kode_ruangan" => "LAB-03",
        //         "ruangan" => "Lab Bahasa",
        //         "nama_pengawas" => "Pengawas Ruang 3 Sesi 5",
        //     ],

        //     [
        //         "ujian_sesi_id" => 6, //sesi 1 ruang 1
        //         "gedung" => "LAB TIPD",
        //         "kode_ruangan" => "LAB-01",
        //         "ruangan" => "LAB 01",
        //         "nama_pengawas" => "Pengawas Ruang 1 Sesi 6",
        //     ],
        //     [
        //         "ujian_sesi_id" => 6, //sesi 1 ruang 2
        //         "gedung" => "LAB TIPD",
        //         "kode_ruangan" => "LAB-02",
        //         "ruangan" => "LAB 02",
        //         "nama_pengawas" => "Pengawas Ruang 2 Sesi 6",
        //     ],
        //     [
        //         "ujian_sesi_id" => 6, //sesi 1 ruang 3
        //         "gedung" => "LAB TIPD",
        //         "kode_ruangan" => "LAB-03",
        //         "ruangan" => "Lab Bahasa",
        //         "nama_pengawas" => "Pengawas Ruang 2 Sesi 6",
        //     ],

        //     [
        //         "ujian_sesi_id" => 7, //sesi 1 ruang 1
        //         "gedung" => "LAB TIPD",
        //         "kode_ruangan" => "LAB-01",
        //         "ruangan" => "LAB 01",
        //         "nama_pengawas" => "Pengawas Ruang 1 Sesi 7",
        //     ],
        //     [
        //         "ujian_sesi_id" => 7, //sesi 1 ruang 2
        //         "gedung" => "LAB TIPD",
        //         "kode_ruangan" => "LAB-02",
        //         "ruangan" => "LAB 02",
        //         "nama_pengawas" => "Pengawas Ruang 2 Sesi 7",
        //     ],
        //     [
        //         "ujian_sesi_id" => 7, //sesi 1 ruang 3
        //         "gedung" => "LAB TIPD",
        //         "kode_ruangan" => "LAB-03",
        //         "ruangan" => "Lab Bahasa",
        //         "nama_pengawas" => "Pengawas Ruang 3 Sesi 7",
        //     ],

        //     [
        //         "ujian_sesi_id" => 8, //sesi 1 ruang 1
        //         "gedung" => "LAB TIPD",
        //         "kode_ruangan" => "LAB-01",
        //         "ruangan" => "LAB 01",
        //         "nama_pengawas" => "Pengawas Ruang 1 Sesi 8",
        //     ],
        //     [
        //         "ujian_sesi_id" => 8, //sesi 1 ruang 2
        //         "gedung" => "LAB TIPD",
        //         "kode_ruangan" => "LAB-02",
        //         "ruangan" => "LAB 02",
        //         "nama_pengawas" => "Pengawas Ruang 2 Sesi 8",
        //     ],
        //     [
        //         "ujian_sesi_id" => 8, //sesi 1 ruang 3
        //         "gedung" => "LAB TIPD",
        //         "kode_ruangan" => "LAB-03",
        //         "ruangan" => "Lab Bahasa",
        //         "nama_pengawas" => "Pengawas Ruang 3 Sesi 8",
        //     ],

        //     [
        //         "ujian_sesi_id" => 9, //sesi 1 ruang 1
        //         "gedung" => "LAB TIPD",
        //         "kode_ruangan" => "LAB-01",
        //         "ruangan" => "LAB 01",
        //         "nama_pengawas" => "Pengawas Ruang 1 Sesi 9",
        //     ],
        //     [
        //         "ujian_sesi_id" => 9, //sesi 1 ruang 2
        //         "gedung" => "LAB TIPD",
        //         "kode_ruangan" => "LAB-02",
        //         "ruangan" => "LAB 02",
        //         "nama_pengawas" => "Pengawas Ruang 2 Sesi 9",
        //     ],
        //     [
        //         "ujian_sesi_id" => 9, //sesi 1 ruang 3
        //         "gedung" => "LAB TIPD",
        //         "kode_ruangan" => "LAB-03",
        //         "ruangan" => "Lab Bahasa",
        //         "nama_pengawas" => "Pengawas Ruang 3 Sesi 9",
        //     ],
        //     [
        //         "ujian_sesi_id" => 10, //sesi 1 ruang 1
        //         "gedung" => "LAB TIPD",
        //         "kode_ruangan" => "LAB-01",
        //         "ruangan" => "LAB 01",
        //         "nama_pengawas" => "Pengawas Ruang 1 Sesi 10",
        //     ],
        //     [
        //         "ujian_sesi_id" => 10, //sesi 1 ruang 2
        //         "gedung" => "LAB TIPD",
        //         "kode_ruangan" => "LAB-02",
        //         "ruangan" => "LAB 02",
        //         "nama_pengawas" => "Pengawas Ruang 2 Sesi 10",
        //     ],
        //     [
        //         "ujian_sesi_id" => 10, //sesi 1 ruang 3
        //         "gedung" => "LAB TIPD",
        //         "kode_ruangan" => "LAB-03",
        //         "ruangan" => "Lab Bahasa",
        //         "nama_pengawas" => "Pengawas Ruang 3 Sesi 10",
        //     ],

        // ]);

        DB::table('soal_kelompoks')->insert([
            [
                "kelompok_soal_nama" => "Soal Tes Kemampuan Dasar (TKD)",
                "keterangan" => "Soal kemampuan dasar",
                "is_aktif" => 1,
            ],
            [
                "kelompok_soal_nama" => "Soal Tes Moderasi Beragama",
                "keterangan" => "Soal moderasi beragama",
                "is_aktif" => 1,
            ]
        ]);
        DB::table('ujian_soal_bagians')->insert([
            [
                "ujian_id" => 1,
                "soal_kelompok_id" => 1,
                "bagian_kode" => "A",
                "bagian_nama" => "Tes Kemampuan Dasar (TKD)",
                "bagian_urutan" => "1",
                "bagian_keterangan" => "",
                "jumlah_soal" => "35",
                "is_pilihan_ganda" => 1,
                "jumlah_opsi_pilihan_ganda" => "4",
            ],
            [
                "ujian_id" => 1,
                "soal_kelompok_id" => 2,
                "bagian_kode" => "B",
                "bagian_nama" => "Tes Moderasi Beragama",
                "bagian_urutan" => "2",
                "bagian_keterangan" => "Tes moderasi beragama",
                "jumlah_soal" => "10",
                "is_pilihan_ganda" => 1,
                "jumlah_opsi_pilihan_ganda" => "4",
            ]
        ]);
        // DB::table('soals')->insert([
        //     [
        //         "soal_kelompok_id" => 1,
        //         "soal" => "3,4,5, ...",
        //     ],
        //     [
        //         "soal_kelompok_id" => 1,
        //         "soal" => "Siapa Presiden Indonesia",
        //     ],
        //     [
        //         "soal_kelompok_id" => 1,
        //         "soal" => "3(3+7) = ...",
        //     ],
        //     [
        //         "soal_kelompok_id" => 2,
        //         "soal" => "ini soal moderasi beragama 1",
        //     ],
        //     [
        //         "soal_kelompok_id" => 2,
        //         "soal" => "ini soal moderasi beragama 2",
        //     ],
        // ]);

        // DB::table('soal_opsis')->insert([
        //     [
        //         "soal_id" => 1,
        //         "opsi_text" => "6",
        //         "is_jawaban" => 1,
        //     ],
        //     [
        //         "soal_id" => 1,
        //         "opsi_text" => "7",
        //         "is_jawaban" => 0,
        //     ],
        //     [
        //         "soal_id" => 1,
        //         "opsi_text" => "9",
        //         "is_jawaban" => 0,
        //     ],
        //     [
        //         "soal_id" => 1,
        //         "opsi_text" => "4",
        //         "is_jawaban" => 0,
        //     ],


        //     [
        //         "soal_id" => 2,
        //         "opsi_text" => "Jokowi",
        //         "is_jawaban" => 1,
        //     ],
        //     [
        //         "soal_id" => 2,
        //         "opsi_text" => "Prabowo",
        //         "is_jawaban" => 0,
        //     ],
        //     [
        //         "soal_id" => 2,
        //         "opsi_text" => "Megawati",
        //         "is_jawaban" => 0,
        //     ],
        //     [
        //         "soal_id" => 2,
        //         "opsi_text" => "Anis",
        //         "is_jawaban" => 0,
        //     ],

        //     [
        //         "soal_id" => 3,
        //         "opsi_text" => "30",
        //         "is_jawaban" => 1,
        //     ],
        //     [
        //         "soal_id" => 3,
        //         "opsi_text" => "100",
        //         "is_jawaban" => 0,
        //     ],
        //     [
        //         "soal_id" => 3,
        //         "opsi_text" => "77",
        //         "is_jawaban" => 0,
        //     ],
        //     [
        //         "soal_id" => 3,
        //         "opsi_text" => "33",
        //         "is_jawaban" => 0,
        //     ],

        //     [
        //         "soal_id" => 4,
        //         "opsi_text" => "iya betulnya ini",
        //         "is_jawaban" => 1,
        //     ],
        //     [
        //         "soal_id" => 4,
        //         "opsi_text" => "ini salah ya",
        //         "is_jawaban" => 0,
        //     ],
        //     [
        //         "soal_id" => 4,
        //         "opsi_text" => "ini salah jg",
        //         "is_jawaban" => 0,
        //     ],
        //     [
        //         "soal_id" => 4,
        //         "opsi_text" => "sama kok salah jg",
        //         "is_jawaban" => 0,
        //     ],
        //     [
        //         "soal_id" => 5,
        //         "opsi_text" => "iya betulnya ini 5",
        //         "is_jawaban" => 1,
        //     ],
        //     [
        //         "soal_id" => 5,
        //         "opsi_text" => "ini salah ya 5",
        //         "is_jawaban" => 0,
        //     ],
        //     [
        //         "soal_id" => 5,
        //         "opsi_text" => "ini salah jg 5",
        //         "is_jawaban" => 0,
        //     ],
        //     [
        //         "soal_id" => 5,
        //         "opsi_text" => "sama kok salah jg 5",
        //         "is_jawaban" => 0,
        //     ],

        // ]);

        // DB::table('peserta_soals')->insert([
        //     [
        //         "ujian_sesi_peserta_id" => 1,
        //         "soal_id" => 2,
        //         "urutan" => "1",
        //         "is_last_urutan_bagian" => 0,
        //     ],
        //     [
        //         "ujian_sesi_peserta_id" => 1,
        //         "soal_id" => 1,
        //         "urutan" => "2",
        //         "is_last_urutan_bagian" => 0,
        //     ],
        //     [
        //         "ujian_sesi_peserta_id" => 1,
        //         "soal_id" => 3,
        //         "urutan" => "3",
        //         "is_last_urutan_bagian" => 1,
        //     ],
        //     [
        //         "ujian_sesi_peserta_id" => 1,
        //         "soal_id" => 5,
        //         "urutan" => "4",
        //         "is_last_urutan_bagian" => 0,
        //     ],
        //     [
        //         "ujian_sesi_peserta_id" => 1,
        //         "soal_id" => 4,
        //         "urutan" => "5",
        //         "is_last_urutan_bagian" => 1,
        //     ],

        //     [
        //         "ujian_sesi_peserta_id" => 2,
        //         "soal_id" => 2,
        //         "urutan" => "2",
        //         "is_last_urutan_bagian" => 0,
        //     ],
        //     [
        //         "ujian_sesi_peserta_id" => 2,
        //         "soal_id" => 1,
        //         "urutan" => "1",
        //         "is_last_urutan_bagian" => 0,
        //     ],
        //     [
        //         "ujian_sesi_peserta_id" => 2,
        //         "soal_id" => 3,
        //         "urutan" => "3",
        //         "is_last_urutan_bagian" => 1,
        //     ],
        //     [
        //         "ujian_sesi_peserta_id" => 2,
        //         "soal_id" => 5,
        //         "urutan" => "5",
        //         "is_last_urutan_bagian" => 1,
        //     ],
        //     [
        //         "ujian_sesi_peserta_id" => 2,
        //         "soal_id" => 4,
        //         "urutan" => "4",
        //         "is_last_urutan_bagian" => 0,
        //     ],

        // ]);

        // DB::table('peserta_soal_opsis')->insert([
        //     [
        //         "peserta_soal_id" => 1,
        //         "opsis_id" => "[5, 7, 8, 6]",
        //     ],
        //     [
        //         "peserta_soal_id" => 2,
        //         "opsis_id" => "[2, 1, 3, 4]",
        //     ],
        //     [
        //         "peserta_soal_id" => 3,
        //         "opsis_id" => "[10, 12, 11, 9]",
        //     ],
        //     [
        //         "peserta_soal_id" => 4,
        //         "opsis_id" => "[20, 17, 18, 19]",
        //     ],
        //     [
        //         "peserta_soal_id" => 5,
        //         "opsis_id" => "[13, 16, 14, 15]",
        //     ],

        //     [
        //         "peserta_soal_id" => 6,
        //         "opsis_id" => "[5, 7, 8, 6]",
        //     ],
        //     [
        //         "peserta_soal_id" => 7,
        //         "opsis_id" => "[1, 2, 3, 4]",
        //     ],
        //     [
        //         "peserta_soal_id" => 8,
        //         "opsis_id" => "[11, 12, 10, 9]",
        //     ],
        //     [
        //         "peserta_soal_id" => 9,
        //         "opsis_id" => "[17, 20, 18, 19]",
        //     ],
        //     [
        //         "peserta_soal_id" => 10,
        //         "opsis_id" => "[14, 16, 13, 15]",
        //     ],


        // ]);

        // DB::table('users')->insert([
        //     [
        //         "username" => "test_user1",
        //         "password" => bcrypt('1234qwer'),
        //         "user_role_id" => 4,
        //     ],
        //     [
        //         "username" => "test_user2",
        //         "password" => bcrypt('1234qwer'),
        //         "user_role_id" => 4,
        //     ],
        //     [
        //         "username" => "test_user3",
        //         "password" => bcrypt('1234qwer'),
        //         "user_role_id" => 4,
        //     ],
        //     [
        //         "username" => "test_user4",
        //         "password" => bcrypt('1234qwer'),
        //         "user_role_id" => 4,
        //     ],
        //     [
        //         "username" => "test_pengawas1",
        //         "password" => bcrypt('1234qwer'),
        //         "user_role_id" => 3,
        //     ],
        //     [
        //         "username" => "test_pengawas2",
        //         "password" => bcrypt('1234qwer'),
        //         "user_role_id" => 3,
        //     ],
        //     [
        //         "username" => "test_pengawas3",
        //         "password" => bcrypt('1234qwer'),
        //         "user_role_id" => 3,
        //     ],
        //     [
        //         "username" => "test_pengawas4",
        //         "password" => bcrypt('1234qwer'),
        //         "user_role_id" => 3,
        //     ],
        // ]);

        // DB::table('user_pesertas')->insert([
        //     [
        //         "user_id" => "1",
        //         "ujian_sesi_peserta_id" => 1,
        //     ],
        //     [
        //         "user_id" => "2",
        //         "ujian_sesi_peserta_id" => 2,
        //     ],
        //     [
        //         "user_id" => "3",
        //         "ujian_sesi_peserta_id" => 3,
        //     ],
        //     [
        //         "user_id" => "4",
        //         "ujian_sesi_peserta_id" => 4,
        //     ],
        // ]);
        // DB::table('user_pengawas')->insert([
        //     [
        //         "user_id" => "5",
        //         "ujian_sesi_ruangan_id" => 1,
        //     ],
        //     [
        //         "user_id" => "6",
        //         "ujian_sesi_ruangan_id" => 2,
        //     ],
        //     [
        //         "user_id" => "7",
        //         "ujian_sesi_ruangan_id" => 3,
        //     ],
        //     [
        //         "user_id" => "8",
        //         "ujian_sesi_ruangan_id" => 4,
        //     ],
        // ]);
    }
}
