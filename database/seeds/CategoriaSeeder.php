<?php

use Illuminate\Database\Seeder;
use App\Categoria;

class CategoriaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Categoria::create([
            'nombre' => 'Comida Mexicana'

        ]);

        Categoria::create([
            'nombre' => 'Comida Italiana'
        ]);

        Categoria::create([
            'nombre' => 'Comida Argentina'

        ]);

        Categoria::create([
            'nombre' => 'Postres'

        ]);

        Categoria::create([
            'nombre' => 'Cortes'

        ]);

        Categoria::create([
            'nombre' => 'Ensaladas'

        ]);

        Categoria::create([
            'nombre' => 'Desayunos'

        ]);
    }
}
