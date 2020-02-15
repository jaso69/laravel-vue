<?php

namespace App\Http\Controllers;

use App\Propietario;
use Illuminate\Http\Request;

class PropietarioController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api');
    }

    public function index(){
        $propietario = Propietario::with('vivienda')->where('vivienda_id', request('vivienda_id'))->get();
        return response()->json($propietario);
    }

    public function store()
    {
        Propietario::create([
            'vivienda_id' => request('vivienda_id'),
            'nombre' => request('nombre'),
            'apellido1' => request('apellido1'),
            'apellido2' => request('apellido2'),
            'dni' => request('dni'),
            'telefono' => request('telefono'),
            'movil' => request('movil'),
            'email' => request('email'),
            'cargo' => request('cargo'),
            'titulo' => request('titulo'),
            'cc' => request('cc'),
            'pago' => request('pago'),
            'notas' => request('notas'),
        ]);
        return response()->json(Propietario::where('vivienda_id', request('vivienda_id'))->get());
    }

    public function update()
    {
        $propietario = Propietario::where('id', request('id'))->first();
        $propietario->vivienda_id = request('vivienda_id');
        $propietario->nombre = request('nombre');
        $propietario->apellido1 = request('apellido1');
        $propietario->apellido2 = request('apellido2');
        $propietario->dni = request('dni');
        $propietario->telefono = request('telefono');
        $propietario->movil = request('movil');
        $propietario->email = request('email');
        $propietario->cargo = request('cargo');
        $propietario->titulo = request('titulo');
        $propietario->cc = request('cc');
        $propietario->pago = request('pago');
        $propietario->notas = request('notas');
        $propietario->update();
        return response()->json(Propietario::where('vivienda_id', request('vivienda_id'))->get());
    }

    public function destroy(){
        $propietario = Propietario::where('id', request('id'))->first();
        $propietario->delete();
        return response()->json(Propietario::where('vivienda_id', request('vivienda_id'))->get());
    }

}
