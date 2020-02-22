<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comunidad extends Model
{
    protected $guarded = [];

    public function viviendas(){
        return $this->belongsToMany(Vivienda::class);
    }
}
