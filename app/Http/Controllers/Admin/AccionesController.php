<?php
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Models\Admin\Accione;
use App\Models\Admin\Persona;
use App\Models\Admin\Usuario;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use DataTables;

class AccionesController extends Controller
{
    public function acciones(Request $request)
    {

        if($request ->ajax()){

            $ticket = $request->input('idTicket');

            $accion = Accione::select('acciones.*','tickets.situacion as ticket_estado'
            ,'usuarios.nombre as usuario_nombre', 'personas.nombres as persona_nombre')
            ->join('usuarios', 'acciones.usuario_id', '=', 'usuarios.id')
            ->join('tickets', 'acciones.ticket_id', '=', 'tickets.id')
            ->join('personas', 'acciones.personal_id', '=', 'personas.id')
            ->where('acciones.status', '=', 'Y')
            ->where('acciones.ticket_id', '=',$ticket)
            ->get();
            return Datatables::of($accion)
            ->addColumn('action1', function($accion){

                $acciones ='<td id="tdTabla"> <button type="button" name="editAccion"  id="'.$accion->id.'" class="btn editar btn-sm">Editar <i class="fa-sharp fa-solid fa-pen-to-square"></i> </button></td>';
                return $acciones;

            })
            ->addColumn('action2', function($accion){

                $acciones ='<td id="tdTabla"> <button type="button" name="deleteAccion" id="'.$accion->id.'" class="btn eliminar btn-sm">Eliminar <i class="fa-solid fa-trash-can"></i> </button></td>';

                return $acciones;

            })
            ->addColumn('action3', function($accion){

                $acciones ='<td id="tdTabla"><button style="font-size: 20px;" id="'.$accion->id.'" name="imagen" type="button" class="btn imagen btn-sm" ><i class="fa-regular fa-images" style="color: white;"></i></button></td>';

                return $acciones;

            })
            ->addColumn('action4', function($accion){

                $acciones ='<td id="tdTabla"><button style="font-size: 20px;"  name="archivo" id="'.$accion->id.'" type="button" class="btn archivo btn-sm"><i class="fa-solid fa-folder-open" style="color: white;"></i></button></td>';

                return $acciones;

            })
            ->rawColumns(['action1', 'action2','action3','action4'])
            ->make(true);

        }

    }
   
    public function accionesStore(Request $request)
    {

        $user = auth()->user();
        $email = $user->email;

            $key ="perfil";
            $persona = Persona::select('*')
            ->where('status', '=', 'Y')
            ->where('email', '=', $email)
            ->first();

            $usuario = Usuario::select('*')
            ->where('status', '=', 'Y')
            ->where('persona_id', '=', $persona->id)
            ->first();


        if($request->ajax()){
            date_default_timezone_set('America/Lima');

            $accion = new Accione();
            $accion->fecha = date('Y-m-d H:i:s', time());
            $accion->descripcion = $request->input('descripcion');
            $accion->modo = $request->input('modo');
            $accion->ticket_id = $request->input('idTicket');
            $accion->usuario_id = $usuario->id;
            $accion->personal_id = $request->input('personal_id');
            $accion->save();
        
            return response()->json(['success' => true]);
        }
   
        return response()->json(['success' => false]);

    }

public function accionesEdit(Request $request)
{
    if($request->ajax()){

        try {
            $accion = Accione::findOrFail($request->input('id'));
            return response()->json(['success' => $accion]);
        } catch (\Throwable $th) {
            return response()->json(['error' => 'Registro no encontrado'], 404);
        }
    }
}


    public function accionesUpdate(Request $request)
    {
        if($request->ajax()){

            $id = $request->input('id');
            $accion = Accione::find($id);
            $accion->descripcion = $request->input('descripcion');
            $accion->modo = $request->input('modo');
            $accion->personal_id = $request->input('personal_id');
            $accion->save();
        
            return response()->json(['success' => true]);
        }
   
        return response()->json(['success' => false]);
    }


    public function accionesDestroy(Request $request)
    {
        if($request->ajax()){

            $registro = Accione::find($request->input('id'));
            $registro->status = "N";
            $registro->save();
    
            return response()->json(['success' => true]);
            }
            return response()->json(['success' => false]);
    
    }
}
