<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Vivienda extends Model
{
    protected $guarded = [];

    public function comunidad(){
        return $this->belongsTo(Comunidad::class);
    }
}
