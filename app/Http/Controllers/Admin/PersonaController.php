<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Models\Admin\Persona;
use App\Models\Admin\RolPersona;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use DataTables;

class PersonaController extends Controller
{
    
    public function index(Request $request)
    {

        if($request ->ajax()){

            $persona = Persona::select('*')
            ->where('status', '=', 'Y')
            ->get();
            return Datatables::of($persona)
                ->addColumn('action', function($persona){

                    $acciones ='<button type="button" name="edit"  id="'.$persona->id.'" class=" btn btn-success btn-sm"> <i class="fa-sharp fa-solid fa-pen-to-square"></i> </button>';
                    $acciones .='&nbsp;&nbsp;<button type="button" name="delete" id="'.$persona->id.'" class=" btn btn-danger btn-sm"> <i class="fa-solid fa-trash-can"></i> </button>'; 

                    return $acciones;

                })
                ->rawColumns(['action'])
                ->make(true);
        }

        return view('admin.persona.index');
    }

    public function store(Request $request)
    {

        if($request->ajax()){

            $ListaCheck =$request->input('valores');
            $persona = new Persona();
            
            $persona->nombres = $request->input('nombres');
            $persona->apellidopaterno = $request->input('paterno');
            $persona->apellidomaterno = $request->input('materno');
            $persona->dni = $request->input('dni');
            $persona->ruc = $request->input('ruc');
            $persona->telefno = $request->input('telefono');
            $persona->email = $request->input('email');
            $persona->save();

            $per = Persona::select('*')
            ->where('status', '=', 'Y')
            ->where('email', '=', $request->input('email'))
            ->first();

            $this->storeRolPersona($ListaCheck, $per->id);
        
            return response()->json(['success' =>true]);
        }
   
        return response()->json(['success' => false]);

    }


public function edit($id)
{
    try {


        $listRolPersona = RolPersona::select('*')
        ->where('status', '=', 'Y')
        ->where('persona_id', '=', $id)
        ->get();

        $persona = Persona::findOrFail($id);

        $lista= array(
            $persona,
            $listRolPersona

        );
        return response()->json(['success' => $lista]);
    } catch (\Throwable $th) {
        return response()->json(['error' => 'Registro no encontrado'], 404);
    }
}


    public function update(Request $request)
    {
        if($request->ajax()){
            $ListaCheck =$request->input('valores');

            $id = $request->input('id');
            $persona = Persona::find($id);
            $persona->nombres = $request->input('nombres');
            $persona->apellidopaterno = $request->input('paterno');
            $persona->apellidomaterno = $request->input('materno');
            $persona->dni = $request->input('dni');
            $persona->ruc = $request->input('ruc');
            $persona->telefno = $request->input('telefono');
            $persona->email = $request->input('email');
            $persona->save();

            $this->storeRolPersona($ListaCheck, $id);

        
            return response()->json(['success' => true]);
        }
   
        return response()->json(['success' => false]);
    }


    public function destroy( $id)
    {
        
        $registro = Persona::find($id);
        $registro->status = "N";
        $registro->save();

        return response()->json(['mensaje' => 'Registro eliminado']);
    }

    public function storeRolPersona($ListaCheck,$id)
    {

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
    }
}
