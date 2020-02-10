<?php

namespace App\Http\Controllers;

use App\GeneradorViviendas;
use App\Vivienda;
use Illuminate\Http\Request;

class ViviendaController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api');
    }

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

    public function update()
    {
        $vivienda = Vivienda::where('id', request('id'))->first();
        $vivienda->tipo = request('tipo');
        $vivienda->planta = request('planta');
        $vivienda->letra = request('letra');
        $vivienda->escalera = request('escalera');
        $vivienda->update();
        return response()->json(Vivienda::where('comunidad_id', request('comunidad_id'))->get());
    }

    public function destroy()
    {
        $vivienda = Vivienda::where('id', request('id'))->first();
        $vivienda->delete();
        return response()->json(Vivienda::where('comunidad_id', request('comunidad_id'))->get());
    }
}
