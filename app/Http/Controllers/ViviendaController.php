<?php

namespace App\Http\Controllers;

use App\GeneradorViviendas;
use App\Vivienda;
use Illuminate\Http\Request;

class ViviendaController extends Controller
{
    public function index()
    {
        return response()->json(Vivienda::where('comunidad_id', request('id'))->get());
    }
    public function store()
    {
        new GeneradorViviendas(
            request('tipo'),
            request('planta'),
            request('letra'),
            request('escalera'),
            request('id') );
        return response()->json(Vivienda::where('comunidad_id', request('id'))->get());
    }
}
