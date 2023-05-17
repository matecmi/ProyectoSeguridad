<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{

    public function run()
    {

        $this->call(GrupoMenuSeeder::class);
        $this->call(OpcionMenuSeeder::class);
        $this->call(TipoUsuarioSeeder::class);
        $this->call(AccesoSeeder::class);
        $this->call(PersonaSeeder::class);
        $this->call(RolSeeder::class);
        $this->call(UsuarioSeeder::class);
        $this->call(UserSeeder::class);


    }
}
