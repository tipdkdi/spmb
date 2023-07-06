<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SoalOpsi extends Model
{
    use HasFactory;

    protected $guarded = ['id'];
    protected $fillable = [
        'soal_id',
        'opsi_text',
        'is_jawaban',
    ];

    public function soal()
    {
        return $this->belongsTo('App\Models\Soal');
    }

    public function pesertaJawaban()
    {
        return $this->hasOne('App\Models\PesertaJawaban');
    }
}
