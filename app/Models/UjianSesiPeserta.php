<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UjianSesiPeserta extends Model
{
    use HasFactory;

    protected $guarded = ['id'];
    protected $fillable = [
        'ujian_sesi_ruangan_id',
        'iddata',
        'data_diri_id',
        'no_test',
        'no_urut',
        'is_aktif',
        'status',
    ];
    public function ujianSesiRuangan()
    {
        return $this->belongsTo('App\Models\UjianSesiRuangan');
    }
    public function pesertaSoal()
    {
        return $this->hasMany('App\Models\PesertaSoal');
    }
    public function dataDiri()
    {
        return $this->belongsTo('App\Models\DataDiri');
    }
}
