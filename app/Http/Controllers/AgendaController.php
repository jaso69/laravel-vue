<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Agenda;
use Illuminate\Support\Facades;
use App\User;

class AgendaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return response()->json(Agenda::where('user_id', auth()->user()->id)->get());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store()
    {
       
        Agenda::create([
            'user_id' => request('user_id'),
            'name' => request('name'),
            'details' => request('details'),
            'start' => request('start'),
            'end' => request('end'),
            'color' => request('color'),
        ]);

        return response()->json(Agenda::where('user_id', request('user_id'))->get());

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update()
    {
        $nota = Agenda::where('id', request('id'))->first();
        $nota->name = request('name');
        $nota->details = request('details');
        $nota->start = request('start');
        $nota->end = request('end');
        $nota->color = request('color');
        $nota->update();
        return response()->json(Agenda::where('user_id', request('user_id'))->get());
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy()
    {
        $nota = Agenda::where('id', request('id'))->first();
        $nota->delete();
        return response()->json(Agenda::where('user_id', request('user_id'))->get());
    }
}
