<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\{Receta,Categoria};
use Str;

class InicioController extends Controller
{
    public function index()
    {
        /**Ultimas 10 recetas */
        $nuevas = Receta::latest()->take(10)->get();
        //$recetas = Receta::orderBy('created_at','desc')->take(10)->get();

        /**Obtener todas las categorías*/
        $categorias = Categoria::all(['id','nombre']);

        /**Agrupar las recetas por categorias*/
        foreach($categorias as $categoria){
            $recetas[Str::slug($categoria->nombre)][] = Receta::where('categoria_id',$categoria->id)->take(3)->get();
            //$recetas[$categoria->id][] = Receta::where('categoria_id',$categoria->id)->get();
        }
        //return $recetas;

        return view('inicio.index',compact('nuevas','recetas'));
    }
}
