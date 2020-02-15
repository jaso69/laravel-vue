<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Vivienda;

class Propietario extends Model
{
    protected $guarded = [];

    public function vivienda(){
        return $this->belongsTo(Vivienda::class);
    }
}
