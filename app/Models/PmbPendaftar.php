<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PmbPendaftar extends Model
{
    use HasFactory;

    protected $guarded = ['id'];
    protected $fillable = [
        'pmb_id',
        'data_diri_id',
        'iddata',
        'nisn',
    ];
    public function pmb()
    {
        return $this->belongsTo('App\Models\Pmb');
    }
    public function dataDiri()
    {
        return $this->belongsTo('App\Models\DataDiri');
    }
}
