<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AccesoSeeder extends Seeder
{
    public function run()
    {
        DB::table('accesos')->insert([
            'id' => null,
            'opcion_menu_id' => 1,
            'tipo_usuario_id' => 1,
            'created_at' => '2023-05-16 23:50:40',
            'updated_at' => '2023-05-16 23:50:40',
        ]);   
    
    }
}
