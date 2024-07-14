<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SoalKelompok extends Model
{
    use HasFactory;

    protected $fillable = [
        'kelompok_soal_nama',
        'keterangan',
        'is_aktif'
    ];

    public function soal()
    {
        return $this->hasMany('App\Models\Soal');
    }

    public function ujianSoalBagian()
    {
        return $this->hasMany('App\Models\UjianSoalBagian');
    }
}
