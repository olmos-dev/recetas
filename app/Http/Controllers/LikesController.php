<?php

namespace App\Http\Controllers;

use App\{Receta,User};
use Illuminate\Http\Request;

class LikesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $recetas = auth()->user()->meGusta;
        return view('likes.index',compact('recetas'));
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
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\receta  $receta
     * @return \Illuminate\Http\Response
     */
    public function show(receta $receta)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\receta  $receta
     * @return \Illuminate\Http\Response
     */
    public function edit(receta $receta)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\receta  $receta
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Receta $receta)
    {
        //Almacena los likes de un usuario a una receta
        return auth()->user()->meGusta()->toggle($receta);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\receta  $receta
     * @return \Illuminate\Http\Response
     */
    public function destroy(receta $receta)
    {
        //
    }
}
