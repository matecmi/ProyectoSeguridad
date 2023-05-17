<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RolSeeder extends Seeder
{
    public function run()
    {

        DB::table('rols')->insert([
            'id' => null,
            'nombre' => 'Personal',
            'created_at' => '2023-05-16 23:50:40',
            'updated_at' => '2023-05-16 23:50:40',
        ]);   
        DB::table('rols')->insert([
            'id' => null,
            'nombre' => 'Usuario',
            'created_at' => '2023-05-16 23:50:40',
            'updated_at' => '2023-05-16 23:50:40',
        ]);   
        DB::table('rols')->insert([
            'id' => null,
            'nombre' => 'Supervisor',
            'created_at' => '2023-05-16 23:50:40',
            'updated_at' => '2023-05-16 23:50:40',
        ]);   
        DB::table('rols')->insert([
            'id' => null,
            'nombre' => 'Tecnico',
            'created_at' => '2023-05-16 23:50:40',
            'updated_at' => '2023-05-16 23:50:40',
        ]);   
        DB::table('rols')->insert([
            'id' => null,
            'nombre' => 'Empresa',
            'created_at' => '2023-05-16 23:50:40',
            'updated_at' => '2023-05-16 23:50:40',
        ]);   


    }
}
