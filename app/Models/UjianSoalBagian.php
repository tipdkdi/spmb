<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UjianSoalBagian extends Model
{
    use HasFactory;

    protected $guarded = ['id'];
    protected $fillable = [
        'ujian_id',
        'soal_kelompok_id',
        'bagian_kode',
        'bagian_nama',
        'bagian_urutan',
        'bagian_keterangan',
        'jumlah_soal',
        'is_pilihan_ganda',
        'jumlah_opsi_pilihan_ganda',
    ];

    public function ujian()
    {
        return $this->belongsTo('App\Models\Ujian');
    }
    public function soalKelompok()
    {
        return $this->belongsTo('App\Models\SoalKelompok');
    }
    // public function soal()
    // {
    //     return $this->hasMany('App\Models\Soal');
    // }
}
