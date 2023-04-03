<?php

namespace App\Providers;

use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Event;
use JeroenNoten\LaravelAdminLte\Events\BuildingMenu;
use App\Models\Admin\OpcionMenu;
use App\Models\Admin\GrupoMenu;



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
                $opciones = OpcionMenu::select('*')
                ->where('status', '=', 'Y')
                ->where('grupo_menus_id', '=', $grupo->id)
                ->orderBy('orden')
                ->get();

                foreach ($opciones as $opcion) {

                    $event->menu->addIn($grupo->nombre, [
                        'key' => $opcion->nombre,
                        'text' => $opcion->nombre,
                        'url' => 'account/edit/notifications',
                    ]);
                }

            }
        });
    } 
}
