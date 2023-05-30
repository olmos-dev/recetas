<?php

use Illuminate\Database\Seeder;
use App\User;
use Illuminate\Support\Facades\Hash;

class UsuarioSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(User::class, 100)->create();

        /**Usuario 1 */
        $user1 = User::create([
            'name' => 'Alberto',
            'email' => 'alberto@mail.com',
            'password' => Hash::make('123'),
            'url' => 'http://misitioalberto.com'
        ]);

        /**Usuario 2 */
        $user2 = User::create([
            'name' => 'Carlos',
            'email' => 'carlos@mail.com',
            'password' => Hash::make('123'),
            'url' => 'http://misitiocarlos.com'
        ]);

        
    }
}
