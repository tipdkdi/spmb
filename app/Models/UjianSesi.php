<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UjianSesi extends Model
{
    use HasFactory;

    protected $guarded = ['id'];
    protected $fillable = [
        'ujian_id',
        'sesi',
        'jam_mulai',
        'jam_selesai',
        'sesi_tanggal',
    ];

    public function ujian()
    {
        return $this->belongsTo('App\Models\Ujian');
    }
    public function ujianSesiRuangan()
    {
        return $this->hasMany('App\Models\UjianSesiRuangan');
    }
}
