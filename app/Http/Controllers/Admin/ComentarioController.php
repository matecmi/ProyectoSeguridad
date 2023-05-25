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

            $comentario = Comentario::select('comentarios.*','tickets.situacion as ticket_estado'
            ,'usuarios.nombre as usuario_nombre')
            ->join('usuarios', 'comentarios.usuario_id', '=', 'usuarios.id')
            ->join('tickets', 'comentarios.ticket_id', '=', 'tickets.id')
            ->where('comentarios.status', '=', 'Y')
            ->where('comentarios.ticket_id', '=',$ticket)
            ->get();
            return Datatables::of($comentario)
            ->addColumn('action', function($comentario){

                $acciones ='<td id="tdTabla"> <button type="button" name="editComentario"  id="'.$comentario->id.'" class="btn editar btn-sm">Editar <i class="fa-sharp fa-solid fa-pen-to-square ml-1"></i> </button></td>';

                return $acciones;

            })
            ->addColumn('action2', function($comentario){

                $acciones ='<td id="tdTabla"> <button type="button" name="deleteComentario" id="'.$comentario->id.'" class="btn eliminar btn-sm">Eliminar <i class="fa-solid fa-trash-can ml-1"></i> </button></td>';

                return $acciones;

            })
            ->rawColumns(['action', 'action2'])
            ->make(true);

           //return response()->json(['success' => $comentario]);

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
            $comentario->fecha = date('Y-m-d H:i:s', time());
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
