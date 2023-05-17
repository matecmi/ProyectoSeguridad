<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class OpcionMenuSeeder extends Seeder
{

    public function run()
    {
        DB::table('opcion_menus')->insert([
            'id' => null,
            'nombre' => 'Tipo Usuario',
            'ruta' => 'admin/tipousuario',
            'orden' => '6',
            'icono' => 'fa-solid fa-location-arrow',
            'grupo_menus_id' => 1,
            'created_at' => '2023-05-16 23:50:40',
            'updated_at' => '2023-05-16 23:50:40',
        ]);
        DB::table('opcion_menus')->insert([
            'id' => null,
            'nombre' => 'Faq',
            'ruta' => 'admin/faq',
            'orden' => '6',
            'icono' => 'fa-solid fa-location-arrow',
            'grupo_menus_id' => 2,
            'created_at' => '2023-05-16 23:50:40',
            'updated_at' => '2023-05-16 23:50:40',
        ]);

        DB::table('opcion_menus')->insert([
            'id' => null,
            'nombre' => 'Grupo de Menu',
            'ruta' => 'admin/grupomenu',
            'orden' => '1',
            'icono' => 'fa-solid fa-wrench',
            'grupo_menus_id' => 1,
            'created_at' => '2023-05-16 23:50:40',
            'updated_at' => '2023-05-16 23:50:40',
        ]);
        DB::table('opcion_menus')->insert([
            'id' => null,
            'nombre' => 'Opcion de menu',
            'ruta' => 'admin/opcionmenu',
            'orden' => '2',
            'icono' => 'fa-solid fa-wrench',
            'grupo_menus_id' => 1,
            'created_at' => '2023-05-16 23:50:40',
            'updated_at' => '2023-05-16 23:50:40',
        ]);
        DB::table('opcion_menus')->insert([
            'id' => null,
            'nombre' => 'Sla',
            'ruta' => 'admin/sla',
            'orden' => '2',
            'icono' => 'fa-solid fa-location-arrow',
            'grupo_menus_id' => 3,
            'created_at' => '2023-05-16 23:50:40',
            'updated_at' => '2023-05-16 23:50:40',
        ]);
        DB::table('opcion_menus')->insert([
            'id' => null,
            'nombre' => 'Tipo Incidencia',
            'ruta' => 'admin/tipoincidencia',
            'orden' => '3',
            'icono' => 'fa-solid fa-location-arrow',
            'grupo_menus_id' => 3,
            'created_at' => '2023-05-16 23:50:40',
            'updated_at' => '2023-05-16 23:50:40',
        ]);
        DB::table('opcion_menus')->insert([
            'id' => null,
            'nombre' => 'Usuario',
            'ruta' => 'admin/usuario',
            'orden' => '4',
            'icono' => 'fa-solid fa-wrench',
            'grupo_menus_id' => 1,
            'created_at' => '2023-05-16 23:50:40',
            'updated_at' => '2023-05-16 23:50:40',
        ]);
        DB::table('opcion_menus')->insert([
            'id' => null,
            'nombre' => 'Rol',
            'ruta' => 'admin/rol',
            'orden' => '4',
            'icono' => 'fa-solid fa-wrench',
            'grupo_menus_id' => 1,
            'created_at' => '2023-05-16 23:50:40',
            'updated_at' => '2023-05-16 23:50:40',
        ]);
        DB::table('opcion_menus')->insert([
            'id' => null,
            'nombre' => 'Persona',
            'ruta' => 'admin/persona',
            'orden' => '5',
            'icono' => 'fa-solid fa-wrench',
            'grupo_menus_id' => 1,
            'created_at' => '2023-05-16 23:50:40',
            'updated_at' => '2023-05-16 23:50:40',
        ]);
        DB::table('opcion_menus')->insert([
            'id' => null,
            'nombre' => 'Ticket',
            'ruta' => 'admin/ticket',
            'orden' => '1',
            'icono' => 'fa-solid fa-location-arrow',
            'grupo_menus_id' => 2,
            'created_at' => '2023-05-16 23:50:40',
            'updated_at' => '2023-05-16 23:50:40',
        ]);
        DB::table('opcion_menus')->insert([
            'id' => null,
            'nombre' => 'Calificación',
            'ruta' => 'admin/calificacion',
            'orden' => '4',
            'icono' => 'fa-solid fa-location-arrow',
            'grupo_menus_id' => 2,
            'created_at' => '2023-05-16 23:50:40',
            'updated_at' => '2023-05-16 23:50:40',
        ]);

        DB::table('opcion_menus')->insert([
            'id' => null,
            'nombre' => 'Medio de reporte',
            'ruta' => 'admin/medioreporte',
            'orden' => '4',
            'icono' => 'fa-solid fa-location-arrow',
            'grupo_menus_id' => 3,
            'created_at' => '2023-05-16 23:50:40',
            'updated_at' => '2023-05-16 23:50:40',
        ]);
        DB::table('opcion_menus')->insert([
            'id' => null,
            'nombre' => 'Usuario Reporte',
            'ruta' => 'admin/usuarioreporte',
            'orden' => '4',
            'icono' => 'fa-solid fa-wrench',
            'grupo_menus_id' => 3,
            'created_at' => '2023-05-16 23:50:40',
            'updated_at' => '2023-05-16 23:50:40',
        ]);
    }


}
