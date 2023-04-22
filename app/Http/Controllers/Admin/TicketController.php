<?php
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Models\Admin\Ticket;
use App\Models\Admin\Usuario;
use App\Models\Admin\TipoIncidencia;
use App\Models\Admin\Sla;
use App\Models\Admin\Persona;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use DataTables;

class TicketController extends Controller
{
     
    public function ticket(Request $request)
    {

        if($request ->ajax()){

            $ticket = Ticket::select('tickets.*','usuarios.nombre as usuario_nombre',
            'tipo_incidencias.nombre as tipo_incidencia_nombre','slas.nombre as sla_nombre', 'personas.nombres as persona_nombre')
            ->join('usuarios', 'tickets.usuario_id', '=', 'usuarios.id')
            ->join('tipo_incidencias', 'tickets.tipoincidencia_id', '=', 'tipo_incidencias.id')
            ->join('slas', 'tickets.sla_id', '=', 'slas.id')
            ->join('personas', 'tickets.personal_id', '=', 'personas.id')
            ->where('tickets.status', '=', 'Y')
            ->get();
            return Datatables::of($ticket)
                ->addColumn('action', function($ticket){

                    $acciones ='<button type="button" name="edit"  id="'.$ticket->id.'" class=" btn btn-success btn-sm"> <i class="fa-sharp fa-solid fa-pen-to-square"></i> </button>';
                    $acciones .='&nbsp;&nbsp;<button type="button" name="delete" id="'.$ticket->id.'" class=" btn btn-danger btn-sm"> <i class="fa-solid fa-trash-can"></i> </button>'; 

                    return $acciones;

                })
                ->rawColumns(['action'])
                ->make(true);
        }

        return view('admin.ticket');
    }

    public function listUsuario()
    {
        $usuario = Usuario::select('*')
        ->where('status', '=', 'Y')
        ->get();
        return response()->json($usuario);
    }

    public function ListTipoIncidencia()
    {
        $tIncidencia = TipoIncidencia::select('*')
        ->where('status', '=', 'Y')
        ->get();
        return response()->json($tIncidencia);
    }

    public function ListSla()
    {
        $sla = Sla::select('*')
        ->where('status', '=', 'Y')
        ->get();
        return response()->json($sla);
    }
    public function ListPersona()
    {
        $persona = Persona::select('*')
        ->where('status', '=', 'Y')
        ->get();
        return response()->json($persona);
    }


    
    public function ticketStore(Request $request)
    {

        if($request->ajax()){

            $ticked = new Ticket();
            $ticked->fecha_registro = $request->input('fecha_registro');
            $ticked->fecha_inicio = $request->input('fecha_inicio');
            $ticked->fecha_fin_estimado = $request->input('fecha_fin_estimado');
            $ticked->fecha_fin = $request->input('fecha_fin');
            $ticked->descripcion = $request->input('descripcion');
            $ticked->situacion = $request->input('situacion');
            $ticked->usuario_id = $request->input('usuario_id');
            $ticked->tipoincidencia_id = $request->input('tipoincidencia_id');
            $ticked->sla_id = $request->input('sla_id');
            $ticked->personal_id = $request->input('personal_id');
            $ticked->save();
        
            return response()->json(['success' => true]);
        }
   
        return response()->json(['success' => false]);

    }

public function ticketEdit(Request $request)
{
    if($request->ajax()){

        try {
            $ticket = Ticket::findOrFail($request->input('id'));
            return response()->json(['success' => $ticket]);
        } catch (\Throwable $th) {
            return response()->json(['error' => 'Registro no encontrado'], 404);
        }
    }
}


    public function ticketUpdate(Request $request)
    {
        if($request->ajax()){

            $id = $request->input('id');
            $ticked = Ticket::find($id);
            $ticked->fecha_registro = $request->input('fecha_registro');
            $ticked->fecha_inicio = $request->input('fecha_inicio');
            $ticked->fecha_fin_estimado = $request->input('fecha_fin_estimado');
            $ticked->fecha_fin = $request->input('fecha_fin');
            $ticked->descripcion = $request->input('descripcion');
            $ticked->situacion = $request->input('situacion');
            $ticked->usuario_id = $request->input('usuario_id');
            $ticked->tipoincidencia_id = $request->input('tipoincidencia_id');
            $ticked->sla_id = $request->input('sla_id');
            $ticked->personal_id = $request->input('personal_id');

            $ticked->save();
        
            return response()->json(['success' => true]);
        }
   
        return response()->json(['success' => false]);
    }


    public function ticketDestroy(Request $request)
    {
        if($request->ajax()){

            $registro = Ticket::find($request->input('id'));
            $registro->status = "N";
            $registro->save();
    
            return response()->json(['success' => true]);
            }
            return response()->json(['success' => false]);
    
    }
}
