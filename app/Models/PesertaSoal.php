<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PesertaSoal extends Model
{
    use HasFactory;
    protected $guarded = ['id'];
    protected $fillable = [
        'ujian_sesi_peserta_id',
        'soal_id',
        'urutan',
        'is_last_urutan_bagian',
    ];

    public function pesertaSoalOpsi()
    {
        return $this->hasOne('App\Models\PesertaSoalOpsi');
    }
    public function pesertaJawaban()
    {
        return $this->hasOne('App\Models\PesertaJawaban');
    }
    public function soal()
    {
        return $this->belongsTo('App\Models\Soal');
    }
    public function ujianPeserta()
    {
        return $this->belongsTo('App\Models\UjianPeserta');
    }
}
