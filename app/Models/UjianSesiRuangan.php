<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UjianSesiRuangan extends Model
{
    use HasFactory;
    protected $fillable = [
        'ujian_sesi_id',
        'gedung',
        'kode_ruangan',
        'ruangan',
        'nama_pengawas'
    ];
    public function ujianSesi()
    {
        return $this->belongsTo('App\Models\UjianSesi');
    }

    public function peserta()
    {
        return $this->hasMany('App\Models\UjianSesiPeserta');
    }
}
