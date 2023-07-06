<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class userPeserta extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'ujian_sesi_peserta_id',
    ];

    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }
    public function ujianSesiPeserta()
    {
        return $this->belongsTo('App\Models\UjianSesiPeserta');
    }
}
