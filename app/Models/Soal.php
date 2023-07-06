<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Soal extends Model
{
    use HasFactory;

    protected $guarded = ['id'];
    protected $fillable = [
        'soal_kelompok_id',
        'soal',
    ];
    public function soalKelompok()
    {
        return $this->belongsTo('App\Models\SoalKelompok', 'soal_kelompok_id');
    }
    public function opsi()
    {
        return $this->hasMany('App\Models\SoalOpsi');
    }

    public function pesertaSoal()
    {
        return $this->hasOne('App\Models\PesertaSoal');
    }
}
