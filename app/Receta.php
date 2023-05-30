<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Receta extends Model
{
    protected $table = 'receta';
    protected $fillable = ['user_id','categoria_id','titulo','ingredientes','preparacion','imagen'];

    /**Relacion 1:1 obtiene la categoria desde FK categoria_id de la receta*/
    public function categoria(){
        return $this->belongsTo(Categoria::class);
    }

    /**Relacion 1:1 es la relacion de Receta con User - una receta es de un solo usuario  */
    public function user(){
        return $this->belongsTo(User::class);
    }

     /**Relacion muchos a muchos quien le dio le gusta a la receta de los usuarios*/
     public function likes(){
        return $this->belongsToMany(User::class,'likes_receta');
    }
}
