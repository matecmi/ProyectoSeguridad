<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PersonaSeeder extends Seeder
{
    public function run()
    {
        DB::table('personas')->insert([
            'id' => null,
            'nombres' => 'Administrador',
            'apellidopaterno' => '----',
            'apellidomaterno' => '----',
            'dni' => '----',
            'ruc' => '----',
            'telefno' => '---',
            'email' => 'admin@gmail.com',
            'created_at' => '2023-05-16 23:50:40',
            'updated_at' => '2023-05-16 23:50:40',
        ]);

    }
}
