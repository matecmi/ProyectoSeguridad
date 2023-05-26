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

    public function persona(Request $request)
    {


        $user = auth()->user();

        if (optional($user)->email !== null) {
            if ($request->ajax()) {

                $persona = Persona::select('*')
                    ->where('status', '=', 'Y')
                    ->get();
                return Datatables::of($persona)
                    ->addColumn('action', function ($persona) {
    
                        $acciones ='<button type="button" name="edit"  id="'.$persona->id.'" class="btn editar btn-sm">Editar<i class="fa-sharp fa-solid fa-pen-to-square ml-1" style="color: white;"></i> </button>';
                        $acciones .='&nbsp;&nbsp;<button type="button" name="delete" id="'.$persona->id.'" class="btn eliminar btn-sm">Eliminar<i class="fa-solid fa-trash-can ml-1" style="color: white;"></i> </button>'; 
                        return $acciones;
    
                    })
                    ->rawColumns(['action'])
                    ->make(true);
            }
    
            return view('admin.persona');

    
        }

        return view('auth.login');

       
    }

    public function personaStore(Request $request)
    {

        if ($request->ajax()) {

            $validar = Persona::select('*')
                ->where('status', '=', 'Y')
                ->where('email', '=', $request->input('email'))
                ->first();

            if (!isset($validar)) {
                $ListaCheck = $request->input('valores');
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

                return response()->json(['success' => true]);
            } else {

                return response()->json(['success' => false]);

            }


        } else {
            return response()->json(['success' => false]);

        }


    }


    public function personaEdit(Request $request)
    {

        if($request->ajax()){

        try {

            $id = $request->input('id');


            $listRolPersona = RolPersona::select('*')
                ->where('status', '=', 'Y')
                ->where('persona_id', '=', $id)
                ->get();

            $persona = Persona::findOrFail($id);

            $lista = array(
                $persona,
                $listRolPersona

            );
            return response()->json(['success' => $lista]);
        } catch (\Throwable $th) {
            return response()->json(['error' => 'Registro no encontrado'], 404);
        }

        }
    }


    public function personaUpdate(Request $request)
    {
        if ($request->ajax()) {
            $ListaCheck = $request->input('valores');

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


    public function personaDestroy(Request $request)
    {

        if($request->ajax()){

        
            $registro = Persona::find($request->input('id'));
            $registro->status = "N";
            $registro->save();
    
            return response()->json(['success' => true]);
        }else {
            return response()->json(['success' => false]);
    
        }
    }

    public function storeRolPersona($ListaCheck, $id)
    {

        $listRolPersona = RolPersona::select('*')
            ->where('status', '=', 'Y')
            ->where('persona_id', '=', $id)
            ->get();

        if (isset($ListaCheck)) {

            foreach ($ListaCheck as $Check) {
                $condicion = true;

                if (isset($listRolPersona)) {
                    foreach ($listRolPersona as $registroRolPersona) {

                        if ($Check == $registroRolPersona->rol_id) {
                            $condicion = false;
                        }
                    }
                }

                if ($condicion) {
                    $rolPersona = new RolPersona();
                    $rolPersona->rol_id = $Check;
                    $rolPersona->persona_id = $id;
                    $rolPersona->save();
                }
            }

        }

        if (isset($listRolPersona)) {
            foreach ($listRolPersona as $registroRolPersona) {
                $eliminacion = true;

                if (isset($ListaCheck)) {
                    foreach ($ListaCheck as $Check) {

                        if ($registroRolPersona->rol_id == $Check) {
                            $eliminacion = false;
                        }
                    }

                    if ($eliminacion) {
                        $registroRolPersona->delete();
                    }
                } else {
                    $registroRolPersona->delete();
                }
            }
        }
    }
}