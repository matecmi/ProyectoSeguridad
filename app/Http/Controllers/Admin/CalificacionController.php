<?php
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Models\Admin\Ticket;
use App\Models\Admin\Calificacion;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use DataTables;
class CalificacionController extends Controller
{
       
    public function calificacion(Request $request)
    {

        if($request ->ajax()){

            $calificacion = Calificacion::select('calificacions.*','tickets.descripcion as ticket_nombre')
            ->join('tickets', 'calificacions.ticket_id', '=', 'tickets.id')
            ->where('tickets.status', '=', 'Y')
            ->get();
            return Datatables::of($calificacion)
                ->addColumn('action', function($calificacion){

                    $acciones ='<button type="button" name="edit"  id="'.$calificacion->id.'" class=" btn btn-success btn-sm"> <i class="fa-sharp fa-solid fa-pen-to-square"></i> </button>';
                    $acciones .='&nbsp;&nbsp;<button type="button" name="delete" id="'.$calificacion->id.'" class=" btn btn-danger btn-sm"> <i class="fa-solid fa-trash-can"></i> </button>'; 

                    return $acciones;

                })
                ->rawColumns(['action'])
                ->make(true);
        }

        return view('admin.calificacion');
    }

    public function listTicket()
    {
        $ticket = Ticket::select('*')
        ->where('status', '=', 'Y')
        ->get();
        return response()->json($ticket);
    }

   
    public function calificacionStore(Request $request)
    {

        if($request->ajax()){

            $calificacion = new Calificacion();
            $calificacion->fecha = $request->input('fecha');
            $calificacion->descripcion = $request->input('descripcion');
            $calificacion->puntaje = $request->input('puntaje');
            $calificacion->ticket_id = $request->input('ticket_id');
            $calificacion->save();
        
            return response()->json(['success' => true]);
        }
   
        return response()->json(['success' => false]);

    }

public function calificacionEdit(Request $request)
{
    if($request->ajax()){

        try {
            $calificacion = Calificacion::findOrFail($request->input('id'));
            return response()->json(['success' => $calificacion]);
        } catch (\Throwable $th) {
            return response()->json(['error' => 'Registro no encontrado'], 404);
        }
    }
}


    public function calificacionUpdate(Request $request)
    {
        if($request->ajax()){

            $id = $request->input('id');
            $calificacion = Calificacion::find($id);
            $calificacion->fecha = $request->input('fecha');
            $calificacion->descripcion = $request->input('descripcion');
            $calificacion->puntaje = $request->input('puntaje');
            $calificacion->ticket_id = $request->input('ticket_id');

            $calificacion->save();
        
            return response()->json(['success' => true]);
        }
   
        return response()->json(['success' => false]);
    }


    public function calificacionDestroy(Request $request)
    {
        if($request->ajax()){

            $registro = Calificacion::find($request->input('id'));
            $registro->status = "N";
            $registro->save();
    
            return response()->json(['success' => true]);
            }
            return response()->json(['success' => false]);
    
    }
}
