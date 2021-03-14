<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Usuario;

class UsuarioTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Usuario::create([
            'nome' => 'Admin',
            'email' => 'admin@gmail.com',
            'password' => bcrypt('123456'),
            'permissao' => 1,
          ]);
    }
}
