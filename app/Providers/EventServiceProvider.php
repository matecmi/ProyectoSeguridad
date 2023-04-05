<?php

namespace App\Providers;

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
  

            $user = auth()->user();
            $email = $user->email;


                $grupos = GrupoMenu::select('*')
                ->where('status', '=', 'Y')
                ->orderBy('orden')
                ->get();
    
                $key ="perfil";

    
                foreach ($grupos as $grupo) {
    
                    $event->menu->addAfter($key, [
                        'key' => $grupo->nombre,
                        'text' => $grupo->nombre,
                        'icon' => $grupo->icono,
        
                    ]);  
                    $key =$grupo->nombre;

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
                                    'url' => 'account/edit/notifications',
                                ]);
                            }
                     
                        }

                    }
                        
               }

               if ($email=="kevin2010_12@hotmail.com") {


                $event->menu->addAfter('seguridad', [
                    'key'        => 'grupo',
                    'text'       => 'Grupo de menu',
                    'icon_color' => 'red',
                    'route'      => 'admin.grupomenu.index',
                ]);

                $event->menu->addAfter('grupo', [
                    'key'        => 'opcion',
                    'text'       => 'Opcion de menu',
                    'icon_color' => 'yellow',
                    'route'      => 'admin.opcionmenu.index',
                ]);
                $event->menu->addAfter('opcion', [
                    'key'        => 'tipo',
                    'text'       => 'Tipo de usuario',
                    'icon_color' => 'cyan',
                    'route'        => 'admin.tipousuario.index',
                ]);
                $event->menu->addAfter('tipo', [
                    'key'        => 'usuario',
                    'text'       => 'Usuario',
                    'icon_color' => 'black',
                    'route'        => 'admin.usuario.index',
                ]);
                $event->menu->addAfter('usuario', [
                    'key'        => 'rol',
                    'text'       => 'Rol',
                    'icon_color' => 'blue',
                    'route'        => 'admin.rol.index',
                ]);
                $event->menu->addAfter('rol', [
                    'key'        => 'persona',
                    'text'       => 'Persona',
                    'icon_color' => 'green',
                    'route'        => 'admin.persona.index',
                ]);
            }

           
        });
 
 
    } 
}
