<?php
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Models\Admin\Ticket;
use App\Models\Admin\Comentario;
use App\Models\Admin\Usuario;
use App\Models\Admin\Persona;



use Illuminate\Http\Request;
use Illuminate\Http\Response;
use DataTables;

class ComentarioController extends Controller
{
    public function comentario(Request $request)
    {

        if($request ->ajax()){

            $ticket = $request->input('idTicket');

            $comentario = Comentario::select('Comentarios.*','tickets.situacion as ticket_estado'
            ,'usuarios.nombre as usuario_nombre')
            ->join('usuarios', 'Comentarios.usuario_id', '=', 'usuarios.id')
            ->join('tickets', 'Comentarios.ticket_id', '=', 'tickets.id')
            ->where('Comentarios.status', '=', 'Y')
            ->where('Comentarios.ticket_id', '=',$ticket)
            ->get();

            return response()->json(['success' => $comentario]);

        }

    }
   
    public function comentarioStore(Request $request)
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

            $comentario = new Comentario();
            $comentario->descripcion = $request->input('descripcion');
            $comentario->fecha = date('d/m/Y H:i:s', time());
            $comentario->ticket_id = $request->input('idTicket');
            $comentario->usuario_id = $usuario->id;
            $comentario->save();
        
            return response()->json(['success' => true]);
        }
   
        return response()->json(['success' => false]);

    }

public function comentarioEdit(Request $request)
{
    if($request->ajax()){

        try {
            $comentario = Comentario::findOrFail($request->input('id'));
            return response()->json(['success' => $comentario]);
        } catch (\Throwable $th) {
            return response()->json(['error' => 'Registro no encontrado'], 404);
        }
    }
}


    public function comentarioUpdate(Request $request)
    {
        if($request->ajax()){

            $id = $request->input('id');
            $comentario = Comentario::find($id);
            $comentario->descripcion = $request->input('descripcion');
            $comentario->save();
        
            return response()->json(['success' => true]);
        }
   
        return response()->json(['success' => false]);
    }


    public function comentarioDestroy(Request $request)
    {
        if($request->ajax()){

            $registro = Comentario::find($request->input('id'));
            $registro->status = "N";
            $registro->save();
    
            return response()->json(['success' => true]);
            }
            return response()->json(['success' => false]);
    
    }
}
