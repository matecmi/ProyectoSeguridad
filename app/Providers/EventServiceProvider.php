<?php

namespace App\Providers;

use App\Models\Admin\RolPersona;
use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Event;
use JeroenNoten\LaravelAdminLte\Events\BuildingMenu;
use App\Models\Admin\OpcionMenu;
use App\Models\Admin\GrupoMenu;
use App\Models\Admin\Persona;
use App\Models\Admin\Usuario;
use App\Models\Admin\Acceso;
use App\Models\Admin\Rol;






class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array<class-string, array<int, class-string>>
     */
    protected $listen = [
        Registered::class => [
            SendEmailVerificationNotification::class,
        ],
    ];


    public function boot()
    {
        
        Event::listen(BuildingMenu::class, function (BuildingMenu $event) {
  
            $key = $this->OpcionesMenu($event);

            $this->PerfilOpcion($key,$event);
            $this->OpcionesPorRol($key,$event);
     
        });
 
 
    } 

    public function AdminOpcion($key,$event){

        $user = auth()->user();
        $email = $user->email;

        if ($email=="kevin2010_12@hotmail.com") {

            $event->menu->addAfter($key, [
                'key'        => 'seguridad',
                'header' => 'SEGURIDAD',
            ]);
            $event->menu->addAfter('seguridad', [
                'key'        => 'grupo',
                'text'       => 'Grupo de menu',
                'icon' => 'fa-solid fa-wrench',
                'route'      => 'admin.grupomenu',
            ]);

            $event->menu->addAfter('grupo', [
                'key'        => 'opcion',
                'text'       => 'Opcion de menu',
                'icon' => 'fa-solid fa-wrench',
                'route'      => 'admin.opcionmenu',
            ]);
            $event->menu->addAfter('opcion', [
                'key'        => 'tipo',
                'text'       => 'Tipo de usuario',
                'icon' => 'fa-solid fa-wrench',
                'route'        => 'admin.tipousuario.index',
            ]);
            $event->menu->addAfter('tipo', [
                'key'        => 'usuario',
                'text'       => 'Usuario',
                'icon' => 'fa-solid fa-wrench',
                'route'        => 'admin.usuario.index',
            ]);
            $event->menu->addAfter('usuario', [
                'key'        => 'rol',
                'text'       => 'Rol',
                'icon' => 'fa-solid fa-wrench',
                'route'        => 'admin.rol.index',
            ]);
            $event->menu->addAfter('rol', [
                'key'        => 'persona',
                'text'       => 'Persona',
                'icon' => 'fa-solid fa-wrench',
                'route'        => 'admin.persona.index',
            ]);
        }else{

        }
    }

    public function PerfilOpcion($key,$event){

            $event->menu->addAfter($key, [
                'key' => 'perfil',
                'text' => 'Perfil',
                'route' => 'admin.profile',
                'icon' => 'fas fa-fw fa-user',
            ]); 
    }


    public function OpcionesMenu($event){
        $user = auth()->user();
        $email = $user->email;


            $grupos = GrupoMenu::select('*')
            ->where('status', '=', 'Y')
            ->orderBy('orden')
            ->get();

            $key ="perfil";
            $persona = Persona::select('*')
            ->where('status', '=', 'Y')
            ->where('email', '=', $email)
            ->first();

            $usuario = Usuario::select('*')
            ->where('status', '=', 'Y')
            ->where('persona_id', '=', $persona->id)
            ->first();

            $accesos = Acceso::select('*')
            ->where('status', '=', 'Y')
            ->where('tipo_usuario_id', '=', $usuario->tipo_usuario_id)
            ->get();

            foreach ($grupos as $grupo) {

                $event->menu->addAfter($key, [
                    'key' => $grupo->nombre,
                    'text' => $grupo->nombre,
                    'icon' => $grupo->icono,
    
                ]);  
                $key =$grupo->nombre;

                foreach ($accesos as $acceso) {
                    $opciones = OpcionMenu::select('*')
                    ->where('status', '=', 'Y')
                    ->where('grupo_menus_id', '=', $grupo->id)
                    ->orderBy('orden')
                    ->get();

                    foreach ($opciones as $opcion) {

                        if ($acceso->opcion_menu_id==$opcion->id) {
                       
                            $event->menu->addIn($grupo->nombre, [
                                'key' => $opcion->nombre,
                                'text' => $opcion->nombre,
                                'icon' => $opcion->icono,
                                'url' => $opcion->ruta,
                            ]);
                        }
                 
                    }

                }
                    
           }
           return $key;
    }

    public function OpcionesPorRol($key,$event){
        $user = auth()->user();
        $email = $user->email;

        $persona = Persona::select('*')
        ->where('status', '=', 'Y')
        ->where('email', '=', $email)
        ->first();

        $rolPersona = RolPersona::select('*')
               ->where('status', '=', 'Y')
               ->where('persona_id', '=', $persona->id)
               ->get();

        $rols = Rol::select('*')
        ->where('status', '=', 'Y')
        ->get();

        if ($email!="kevin2010_12@hotmail.com") {
            foreach ($rolPersona as $rolP) {

                foreach ($rols as $rol) {
    
                    if ($rolP->rol_id ==$rol->id) {
    
                      switch ($rol->nombre) {
                        case 'Usuario': 
                            $event->menu->addAfter($key, [
                                'key'        => 'seguridad',
                                'header' => 'SEGURIDAD',
                            ]);
                            $event->menu->addAfter('seguridad', [
                                'key'        => 'usuario',
                                'text'       => 'Usuario',
                                'icon' => 'fa-solid fa-wrench',
                                'route'        => 'admin.usuario.index',
                            ]);
    
                            break;
                        
                        default:
                            break;
                      }
    
                    }
    
                }
    
            }
            }

       


    }
}
