<?php

namespace App\Http\Controllers;

use App\Gasto;
use Illuminate\Http\Request;

class GastoController extends Controller
{

    public function index()
    {
        return response()->json(Gasto::where('user_id', auth('api')->user()->id)->get());
    }

    public function store()
    {
        Gasto::create([
            'user_id' => request('user_id'),
            'tipo_gasto' => request('tipo_gasto'),
            'descripcion' => request('descripcion'),
            'importe' => request('importe'),
            'fecha' => request('fecha'),
        ]);

        return response()->json(Gasto::where('user_id', request('user_id'))->get());

    }
}
