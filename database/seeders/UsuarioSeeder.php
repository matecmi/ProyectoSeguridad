<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UsuarioSeeder extends Seeder
{

    public function run()
    {
        DB::table('tipo_usuarios')->insert([
            'id' => null,
            'nombre' => 'administrador',
            'tipo_usuario_id' => 1,
            'persona_id' => 1,
            'created_at' => '2023-05-16 23:50:40',
            'updated_at' => '2023-05-16 23:50:40',
        ]);
    }
}
