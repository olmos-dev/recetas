<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\{Perfil,User,Receta};
use App\Http\Requests\{EditPerfilRequest};
use Illuminate\Support\Facades\Storage;

class PerfilController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Perfil $perfil)
    {
        Perfil::findOrFail($perfil->id);
        $recetas = Receta::where('user_id',$perfil->id)->paginate(9);
        //return $recetas;
        return view('perfiles.show',compact('perfil','recetas'));

        /*
        User::findOrFail($perfil->id);
        $perfil = User::with('perfil','recetas')->where('id',$perfil->id)->get();
        return view('perfiles.show',compact('perfil'));
        */
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Perfil $perfil)
    {
        /**Ejecutar Policy*/
        $this->authorize('view',$perfil);

        Perfil::findOrFail($perfil->id);
        return view('perfiles.edit',compact('perfil'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(EditPerfilRequest $request, Perfil $perfil)
    {
        /**Ejecutar Policy*/
        $this->authorize('update',$perfil);
        
        /**Validacion*/
        $data = $request->validated();

        /**Actualizar el Usuario*/
        $user = User::find($perfil->id);
        $user->update([
            'name' => $data['nombre'],
            'url' => $data['web']
        ]);

        /**Actualizar el perfil*/
        $perfil = Perfil::findOrfail($perfil->id);
        $perfil->update([
            'biografia' => $data['biografia'] 
        ]);

        /**Verifica si el usuario sube una foto*/
        if(!empty($data['foto'])){
              /**Verifica si existe una foto registrada en la bd*/
              if(!empty($perfil->foto)){
                /**Eliminar la imagen actual para ser remplazada*/
                Storage::disk('public')->delete($perfil->foto);
              }
              /**Almacenar la imagen en la ruta espeficada*/
              $url = $data['foto']->store('perfiles','public');
              $perfil->update([
                  'foto' => $url
              ]);
        }

        return redirect()->route('perfil.update',['perfil' => $perfil->id])->with('sistema','Receta actualizada correctamente');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
