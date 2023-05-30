<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\{UpdateRecetaRequest,StoreRecetaRequest};
use App\{Categoria,Receta};
use Illuminate\Database\QueryException;
use Auth;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Storage;

class RecetaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        /**muestra unicamente las recetas que ha creado ese usuaio autenticado*/
        $recetas = Receta::with('categoria:id,nombre')->where('user_id',auth()->user()->id)->paginate(10);
        //$recetas = auth()->user()->recetas;
        return view('recetas.index',compact('recetas'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categorias = Categoria::select('id','nombre')->orderBy('nombre','asc')->get();  
        return view('recetas.create',compact('categorias'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreRecetaRequest $request)
    {
        try {
            /**Validacion de los request*/
            $data = $request->validated();
            /**Almacenar la imagen en la ruta espeficada*/
            $url = $data['imagen']->store('recetas','public');
            /**Intervention tratamiento de la imagen */
            //$img = Image::make(public_path("storage/{$url}"))->fit(480,320);
            //$img->save();
            /**Almacenar los datos validados en la BD */
            Receta::create([
                'user_id' => Auth::user()->id,
                'categoria_id' => $data['categoria'],
                'titulo' => $data['titulo'],
                'ingredientes' => $data['ingredientes'],
                'preparacion' => $data['preparacion'],
                'imagen' => $url
            ]);
            return redirect()->route('receta.index')->with('sistema','Receta creada correctamente');

        } catch (QueryException $e) {
            //return $e->getMessage();
            abort(404);
        }
        
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Receta $receta)
    {
        /**Obtiene si el usuario authenticado le gusta la receta y esta autenticado*/
        $like = (auth()->user()) ? auth()->user()->meGusta->contains($receta->id) : false;

        /**Pasa la cantidad de likes a la vista */
        $contarLikes = $receta->likes->count();
        
        return view('recetas.show',compact('receta','like','contarLikes'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Receta $receta)
    {
        /**Revisar el RecetaPolicy*/
        $this->authorize('update',$receta);
        $categorias = Categoria::select('id','nombre')->orderBy('nombre','asc')->get();  
        return view('recetas.edit',compact('categorias','receta'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateRecetaRequest $request, Receta $receta)
    {
        try {
            /**Revisar el RecetaPolicy*/
            $this->authorize('update',$receta);

            /**Verificar si existe esta receta en la BD */
            $find = Receta::findOrFail($receta->id);
           //ddd($find);

            /**Validacion de los request*/
            $data = $request->validated();

            /**Verificar si existe una imagen*/
            if($request->imagen){
                /**Eliminar la imagen actual para ser remplazada*/
                Storage::disk('public')->delete($find->imagen);
                /**Almacenar la imagen en la ruta espeficada*/
                $url = $data['imagen']->store('recetas','public');
                /**Actualiza la información de la receta sin imagen*/
                $find->update([
                    'user_id' => Auth::user()->id,
                    'categoria_id' => $data['categoria'],
                    'titulo' => $data['titulo'],
                    'ingredientes' => $data['ingredientes'],
                    'preparacion' => $data['preparacion'],
                    'imagen' => $url
                ]);
            }else{
                /**Actualiza la información de la receta sin imagen*/
                $find->update([
                    'user_id' => Auth::user()->id,
                    'categoria_id' => $data['categoria'],
                    'titulo' => $data['titulo'],
                    'ingredientes' => $data['ingredientes'],
                    'preparacion' => $data['preparacion'],
                ]);
            }

            return redirect()->route('receta.index')->with('sistema','Receta actualizada correctamente');

        } catch (QueryException $e) {
            //return $e->getMessage();
           abort(404);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Receta $receta)
    {
        /**Revisa el receta policy */
        $this->authorize('delete',$receta);
        /**Verifica la receta si existe */
        $data = Receta::findOrFail($receta->id);
        /**accion para eliminar la receta */
        Receta::destroy($receta->id);
        /**Eliminar la imagen actual para ser remplazada*/
        Storage::disk('public')->delete($data->imagen);
    }

    public function search(Request $request){
        $buscar = $request->buscar;
        $recetas = Receta::where('titulo','like',"%$buscar%")->paginate(1);
        $recetas->appends(['buscar' => $buscar]);
        return view('buscar.index',compact('recetas','buscar'));
    }
}
