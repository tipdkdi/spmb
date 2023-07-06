<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PesertaSoalOpsi extends Model
{
    use HasFactory;
    protected $guarded = ['id'];
    protected $fillable = [
        'peserta_soal_id',
        'opsis_id',
    ];
    public function pesertaSoal()
    {
        return $this->belongsTo('App\Models\PesertaSoal');
    }
}
