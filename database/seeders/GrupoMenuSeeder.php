<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
class GrupoMenuSeeder extends Seeder
{

    public function run()
    {
        DB::table('grupo_menus')->insert([
            'id' => null,
            'nombre' => 'Seguridad',
            'icono' => 'fa-solid fa-shield-halved',
            'orden' => '9',
            'created_at' => '2023-05-16 23:50:40',
            'updated_at' => '2023-05-16 23:50:40',
        ]);

        DB::table('grupo_menus')->insert([
            'id' => null,
            'nombre' => 'Movimientos',
            'icono' => 'fa-solid fa-person-running',
            'orden' => '1',
            'created_at' => '2023-05-16 23:50:40',
            'updated_at' => '2023-05-16 23:50:40',
        ]);

        DB::table('grupo_menus')->insert([
            'id' => null,
            'nombre' => 'Mantenimeinto',
            'icono' => 'fa-solid fa-hammer',
            'orden' => '2',
            'created_at' => '2023-05-16 23:50:40',
            'updated_at' => '2023-05-16 23:50:40',
        ]);


        // \App\Models\User::factory(10)->create();
    }
}