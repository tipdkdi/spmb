<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserPengawas extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'ujian_sesi_ruangan_id',
    ];

    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }
    public function ujianSesiRuangan()
    {
        return $this->belongsTo('App\Models\UjianSesiRuangan');
    }
}
