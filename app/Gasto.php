<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Gasto extends Model
{
    protected $fillable = [
        'user_id', 'tipo_gasto', 'descripcion', 'importe', 'fecha',
    ];
}
