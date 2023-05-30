<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Perfil extends Model
{
    protected $table = 'perfil';
    protected $fillable = ['user_id','biografia','foto'];

    /**Relacion 1:1 Perfil - User */
    public function user(){
        return $this->belongsTo(User::class);
    }
    
}
