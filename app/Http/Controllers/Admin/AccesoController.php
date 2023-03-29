<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Models\Admin\GrupoMenu;
use App\Models\Admin\Acceso;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use DataTables;
class AccesoController extends Controller
{
    
    public function lista(Request $request)
    {
        $listAcceso = Acceso::select('*')
        ->where('status', '=', 'Y')
        ->where('tipo_usuario_id', '=', $request->input('id'))
        ->get();
        return response()->json($listAcceso);
    }

    public function store(Request $request)
    {

        if($request->ajax()){

            $ListaCheck =$request->input('valores');
            $id =$request->input('id');

            $listAcceso = Acceso::select('*')
            ->where('status', '=', 'Y')
            ->where('tipo_usuario_id', '=', $id)
            ->get();

            if (isset($ListaCheck)) {

                foreach ($ListaCheck as $Check) {
                    $condicion=true;
    
                    if(isset($listAcceso)){
                        foreach ($listAcceso as $registroAcceso) {
    
                            if($Check == $registroAcceso->opcion_menu_id){
                                $condicion=false;
                            }
                        }
                    }
    
                    if($condicion){
                        $acceso = new Acceso();
                        $acceso->opcion_menu_id = $Check;
                        $acceso->tipo_usuario_id = $id;
                        $acceso->save();
                    }
                }

            }
 
            if(isset($listAcceso)){
                foreach ($listAcceso as $registroAcceso) {
                    $eliminacion=true;

                    if (isset($ListaCheck)) {
                        foreach ($ListaCheck as $Check) {
    
                            if($registroAcceso->opcion_menu_id ==$Check ){
                                $eliminacion=false;
                            }
                        }

                        if($eliminacion){
                            $registroAcceso->delete();
                        }
                    }else{
                        $registroAcceso->delete();
                    }
                }
            }

            return response()->json(['success' => true]);

        }
   
        return response()->json(['success' => false]);

    }

}
