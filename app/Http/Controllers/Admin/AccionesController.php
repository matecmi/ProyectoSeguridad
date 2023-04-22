<?php
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Models\Admin\Accione;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use DataTables;

class AccionesController extends Controller
{
    public function acciones(Request $request)
    {

        if($request ->ajax()){

            $accion = Accione::select('acciones.*','tickets.descripcion as ticket_nombre'
            ,'usuarios.nombre as usuario_nombre', 'personas.nombres as persona_nombre')
            ->join('usuarios', 'acciones.usuario_id', '=', 'usuarios.id')
            ->join('tickets', 'acciones.ticket_id', '=', 'tickets.id')
            ->join('personas', 'acciones.personal_id', '=', 'personas.id')
            ->where('acciones.status', '=', 'Y')
            ->get();
            return Datatables::of($accion)
                ->addColumn('action', function($accion){

                    $acciones ='<button type="button" name="edit"  id="'.$accion->id.'" class=" btn btn-success btn-sm"> <i class="fa-sharp fa-solid fa-pen-to-square"></i> </button>';
                    $acciones .='&nbsp;&nbsp;<button type="button" name="delete" id="'.$accion->id.'" class=" btn btn-danger btn-sm"> <i class="fa-solid fa-trash-can"></i> </button>'; 

                    return $acciones; 

                })
                ->rawColumns(['action'])
                ->make(true);
        }

        return view('admin.acciones');
    }
   
    public function accionesStore(Request $request)
    {

        if($request->ajax()){

            $accion = new Accione();
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
