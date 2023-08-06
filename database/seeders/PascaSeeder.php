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

            DB::table('pmbs')->insert([
                [
                    "pmb_nama" => "Penerimaan Pascasarjana",
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
                    "ujian_nama" => "Ujian Penerimaan Pascasarjana",
                    "tempat" => "IAIN Kendari",
                    "waktu_pengerjaan" => "01:00:00",
                    "is_soal_random" => 1
                ]
            ]);
            DB::table('pmb_ujians')->insert([
                [
                    "pmb_id" => 3,
                    "ujian_id" => 3,
                ]
            ]);

            DB::table('ujian_sesis')->insert([
                [
                    "ujian_id" => 3,  ///ini diganti2 sesuai ujian id yang ingin dilaksanakan
                    "sesi" => "1",
                    "jam_mulai" => "08:15:00",
                    "jam_selesai" => "09:15:00",
                    "sesi_tanggal" => "2023-07-31",
                ],
                [
                    "ujian_id" => 3,
                    "sesi" => "2",
                    "jam_mulai" => "09:30:00",
                    "jam_selesai" => "10:30:00",
                    "sesi_tanggal" => "2023-07-31",
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
                // [
                //     "gedung" => "LAB TIPD",
                //     "kode_ruangan" => "LAB-03",
                //     "ruangan" => "Lab Bahasa",
                // ],
            ];

            $array = [];
            $sesi = 0;

            for ($i = 16; $i <= 17; $i++) { //ini id sesi, jadi contoh ujian id 1 sampai 10 sesi, jadi skrg di sini jadi dari 11 -15 karena sampe 5 sesu
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

            DB::table('ujian_soal_bagians')->insert([
                [
                    "ujian_id" => 3,
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
                    "ujian_id" => 3,
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
                    "ujian_id" => 3,
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
                    "ujian_id" => 3,
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
                    "ujian_id" => 3,
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
                    "ujian_id" => 3,
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
                    "ujian_id" => 3,
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
                    "ujian_id" => 3,
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
}
