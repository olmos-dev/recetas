<?php

use App\User;
use App\Receta;
use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class LikesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //es una un seeder para los likes de las recetas

        for ($i=1; $i<=1000 ; $i++) { 
            
            $usuario = User::all()->random()->id;
            $receta = Receta::all()->random()->id;
            $fecha = Carbon::now();

            DB::insert('insert into likes_receta (user_id,receta_id,created_at,updated_at) values (?,?,?,?)', [
                $usuario,
                $receta,
                $fecha,
                $fecha
            ]);
        }
    }
}
