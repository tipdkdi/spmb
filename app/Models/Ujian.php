<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ujian extends Model
{
    use HasFactory;

    protected $guarded = ['id'];
    protected $fillable = [
        'ujian_nama',
        'tempat',
        'waktu_pengerjaan',
        'is_soal_random',
    ];
    public function sesi()
    {
        return $this->hasMany('App\Models\UjianSesi');
    }
    public function pmbUjian()
    {
        return $this->hasMany('App\Models\PmbUjian');
    }
    public function ujianSoalBagian()
    {
        return $this->hasMany('App\Models\UjianSoalBagian');
    }
}
