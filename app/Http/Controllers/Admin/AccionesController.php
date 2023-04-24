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

            $accion = Accione::select('acciones.*','tickets.descripcion as ticket_nombre'
            ,'usuarios.nombre as usuario_nombre', 'personas.nombres as persona_nombre')
            ->join('usuarios', 'acciones.usuario_id', '=', 'usuarios.id')
            ->join('tickets', 'acciones.ticket_id', '=', 'tickets.id')
            ->join('personas', 'acciones.personal_id', '=', 'personas.id')
            ->where('acciones.status', '=', 'Y')
            ->where('acciones.ticket_id', '=',$ticket)
            ->get();
            return response()->json(['success' => $accion]);

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

            $accion = new Accione();
            $accion->fecha = $request->input('fecha');
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
            $accion->fecha = $request->input('fecha');
            $accion->descripcion = $request->input('descripcion');
            $accion->modo = $request->input('modo');
            $accion->ticket_id = $request->input('ticket_id');
            $accion->usuario_id = $request->input('usuario_id');
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
