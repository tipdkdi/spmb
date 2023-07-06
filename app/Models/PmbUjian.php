<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PmbUjian extends Model
{
    use HasFactory;

    protected $guarded = ['id'];
    protected $fillable = [
        'pmb_id',
        'ujian_id',
    ];
    public function ujian()
    {
        return $this->belongsTo('App\Models\Ujian');
    }
    public function pmb()
    {
        return $this->belongsTo('App\Models\Pmb');
    }
}
