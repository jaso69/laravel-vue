<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Agenda extends Model
{
    protected $fillable = [
        'user_id', 'name', 'details', 'start', 'end', 'color',
    ];

    
}
