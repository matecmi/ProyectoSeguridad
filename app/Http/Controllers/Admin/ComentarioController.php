<?php
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Models\Admin\Ticket;
use App\Models\Admin\Comentario;



use Illuminate\Http\Request;
use Illuminate\Http\Response;
use DataTables;

class ComentarioController extends Controller
{
    public function comentario(Request $request)
    {

        if($request ->ajax()){

            $comentario = Comentario::select('Comentarios.*','tickets.descripcion as ticket_nombre'
            ,'usuarios.nombre as usuario_nombre')
            ->join('usuarios', 'Comentarios.usuario_id', '=', 'usuarios.id')
            ->join('tickets', 'Comentarios.ticket_id', '=', 'tickets.id')
            ->where('Comentarios.status', '=', 'Y')
            ->get();
            return Datatables::of($comentario)
                ->addColumn('action', function($comentario){

                    $acciones ='<button type="button" name="edit"  id="'.$comentario->id.'" class=" btn btn-success btn-sm"> <i class="fa-sharp fa-solid fa-pen-to-square"></i> </button>';
                    $acciones .='&nbsp;&nbsp;<button type="button" name="delete" id="'.$comentario->id.'" class=" btn btn-danger btn-sm"> <i class="fa-solid fa-trash-can"></i> </button>'; 

                    return $acciones;

                })
                ->rawColumns(['action'])
                ->make(true);
        }

        return view('admin.comentario');
    }
   
    public function comentarioStore(Request $request)
    {

        if($request->ajax()){

            $comentario = new Comentario();
            $comentario->descripcion = $request->input('descripcion');
            $comentario->fecha = $request->input('fecha');
            $comentario->ticket_id = $request->input('ticket_id');
            $comentario->usuario_id = $request->input('usuario_id');
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
            $comentario->fecha = $request->input('fecha');
            $comentario->ticket_id = $request->input('ticket_id');
            $comentario->usuario_id = $request->input('usuario_id');
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
