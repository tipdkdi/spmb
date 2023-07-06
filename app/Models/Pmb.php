<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pmb extends Model
{
    use HasFactory;

    protected $guarded = ['id'];
    protected $fillable = [
        'pmb_nama',
        'tahun_akademik',
        'biaya_pendaftaran',
        'daftar_mulai',
        'daftar_selesai',
        'jenis_ujian',
        'ruang_per_sesi',
        'peserta_per_ruang',
        'is_publish',
    ];
    public function ujian()
    {
        return $this->hasOne('App\Models\Ujian');
    }
    public function pendaftar()
    {
        return $this->hasMany('App\Models\PmbPendaftar');
    }
    public function kuota()
    {
        return $this->hasMany('App\Models\PmbKuota');
    }
}
