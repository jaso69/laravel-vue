<?php

namespace App\Http\Controllers;

use App\Comunidad;
use Illuminate\Http\Request;

class ComunidadController extends Controller
{
    public function index()
    {
        return response()->json(Comunidad::all());
    }

    public function store()
    {
        Comunidad::create([
            'calle' => request('calle'),
            'numero' => request('numero'),
            'municipio' => request('municipio'),
            'provincia' => request('provincia'),
            'codigo_postal' => request('codigo_postal'),
        ]);
        return response()->json(Comunidad::all());
    }

    public function update()
    {
        $comunidad = Comunidad::where('id', request('id'))->first();
        $comunidad->calle = request('calle');
        $comunidad->numero = request('numero');
        $comunidad->municipio = request('municipio');
        $comunidad->provincia = request('provincia');
        $comunidad->codigo_postal = request('codigo_postal');
        $comunidad->update();
        return response()->json(Comunidad::all());
    }

    public function destroy()
    {
        $comunidad = Comunidad::where('id', request('id'))->first();
        $comunidad->delete();
        return response()->json(Comunidad::all());
    }

    protected function comunidadJson(){
        return response()->json(Comunidad::all());
    }
}

