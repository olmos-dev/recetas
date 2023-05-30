<?php

use App\Perfil;
use Faker\Factory;
use Illuminate\Database\Seeder;

class PerfilSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Factory::create();
        $numero = rand(1,29);

        for ($i=1; $i <=100; $i++) { 
            Perfil::create([
                'user_id' => $i,
                'biografia' => $faker->text(1000),
                'foto' => 'perfiles/pic'.$numero.'.jpg'
            ]);
        }
    }
}
