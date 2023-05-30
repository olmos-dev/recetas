<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // $this->call(UsersTableSeeder::class);
        $this->call(CategoriaSeeder::class);
        $this->call(UsuarioSeeder::class);
        $this->call(PerfilSeeder::class);
        $this->call(RecetaSeeder::class);
        $this->call(LikesSeeder::class);
    }
}
