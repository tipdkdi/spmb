<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PesertaJawaban extends Model
{
    use HasFactory;

    protected $guarded = ['id'];
    protected $fillable = [
        'peserta_soal_id',
        'soal_opsi_id',
    ];

    public function pesertaSoal()
    {
        return $this->belongsTo('App\Models\PesertaSoal');
    }
    public function soalOpsi()
    {
        return $this->belongsTo('App\Models\SoalOpsi');
    }
}
