<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PmbKuota extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function pmb()
    {
        return $this->belongsTo('App\Models\Pmb');
    }
}
