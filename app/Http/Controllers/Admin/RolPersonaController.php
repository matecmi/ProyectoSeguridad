<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Models\Admin\RolPersona;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use DataTables;

class RolPersonaController extends Controller
{
    public function lista(Request $request)
    {
        $listRolPersona = RolPersona::select('*')
        ->where('status', '=', 'Y')
        ->where('persona_id', '=', $request->input('id'))
        ->get();
        return response()->json($listRolPersona);
    }

    public function store(Request $request)
    {

        if($request->ajax()){

            $ListaCheck =$request->input('valores');
            $id =$request->input('id');

            $listRolPersona = RolPersona::select('*')
            ->where('status', '=', 'Y')
            ->where('persona_id', '=', $id)
            ->get();

            if (isset($ListaCheck)) {

                foreach ($ListaCheck as $Check) {
                    $condicion=true;
    
                    if(isset($listRolPersona)){
                        foreach ($listRolPersona as $registroRolPersona) {
    
                            if($Check == $registroRolPersona->rol_id){
                                $condicion=false;
                            }
                        }
                    }
    
                    if($condicion){
                        $rolPersona = new RolPersona();
                        $rolPersona->rol_id = $Check;
                        $rolPersona->persona_id = $id;
                        $rolPersona->save();
                    }
                }

            }
 
            if(isset($listRolPersona)){
                foreach ($listRolPersona as $registroRolPersona) {
                    $eliminacion=true;

                    if (isset($ListaCheck)) {
                        foreach ($ListaCheck as $Check) {
    
                            if($registroRolPersona->rol_id ==$Check ){
                                $eliminacion=false;
                            }
                        }

                        if($eliminacion){
                            $registroRolPersona->delete();
                        }
                    }else{
                        $registroRolPersona->delete();
                    }
                }
            }

            return response()->json(['success' => true]);

        }
   
        return response()->json(['success' => false]);

    }

}
