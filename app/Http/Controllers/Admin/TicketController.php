<?php
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Models\Admin\Ticket;
use App\Models\Admin\Usuario;
use App\Models\Admin\TipoIncidencia;
use App\Models\Admin\Sla;
use App\Models\Admin\Persona;
use App\Models\Admin\Rol;
use App\Models\Admin\RolPersona;



use Illuminate\Http\Request;
use Illuminate\Http\Response;
use DataTables;

class TicketController extends Controller
{
     
    public function ticket(Request $request)
    {

        if($request ->ajax()){

            $ticket = Ticket::select('tickets.*','usuarios.nombre as usuario_nombre',
            'tipo_incidencias.nombre as tipo_incidencia_nombre','slas.nombre as sla_nombre', 
            'persona1.nombres as personal_nombre',
            'persona2.nombres as empresa_nombre', 
            'persona3.nombres as supervisor_nombre')
            ->join('usuarios', 'tickets.usuario_id', '=', 'usuarios.id')
            ->join('tipo_incidencias', 'tickets.tipoincidencia_id', '=', 'tipo_incidencias.id')
            ->join('slas', 'tickets.sla_id', '=', 'slas.id')
            ->join('personas as persona1', 'tickets.personal_id', '=', 'persona1.id')
            ->join('personas as persona2', 'tickets.empresa_id', '=', 'persona2.id')
            ->join('personas as persona3', 'tickets.supervisor_id', '=', 'persona3.id')
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
        $Personal = array(); 

        $rol = Rol::select('*')
        ->where('status', '=', 'Y')
        ->where('nombre', '=', 'Personal')
        ->first();


        $rolPersona = RolPersona::select('*')
        ->where('status', '=', 'Y')
        ->where('rol_id', '=', $rol->id)
        ->get();

        $personas = Persona::select('*')
        ->where('status', '=', 'Y')
        ->get();

        $contador = 0;

        foreach ($rolPersona as $rolP) {

            foreach ($personas as $persona) {

                if ($rolP->persona_id ==$persona->id) {

                    $Personal[$contador] = $persona;
                    $contador++;
                }


            }
        }


        return response()->json($Personal);
    }

    public function listEmpresa()
    {
        $Empresa = array(); 

        $rol = Rol::select('*')
        ->where('status', '=', 'Y')
        ->where('nombre', '=', 'Empresa')
        ->first();


        $rolPersona = RolPersona::select('*')
        ->where('status', '=', 'Y')
        ->where('rol_id', '=', $rol->id)
        ->get();

        $personas = Persona::select('*')
        ->where('status', '=', 'Y')
        ->get();

        $contador = 0;

        foreach ($rolPersona as $rolP) {

            foreach ($personas as $persona) {

                if ($rolP->persona_id ==$persona->id) {

                    $Empresa[$contador] = $persona;
                    $contador++;
                }


            }
        }


        return response()->json($Empresa);
    }
    public function listSupervisor()
    {
        $Supervisor = array(); 

        $rol = Rol::select('*')
        ->where('status', '=', 'Y')
        ->where('nombre', '=', 'Supervisor')
        ->first();


        $rolPersona = RolPersona::select('*')
        ->where('status', '=', 'Y')
        ->where('rol_id', '=', $rol->id)
        ->get();

        $personas = Persona::select('*')
        ->where('status', '=', 'Y')
        ->get();

        $contador = 0;

        foreach ($rolPersona as $rolP) {

            foreach ($personas as $persona) {

                if ($rolP->persona_id ==$persona->id) {

                    $Supervisor[$contador] = $persona;
                    $contador++;
                }


            }
        }


        return response()->json($Supervisor);
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
            $ticked->supervisor_id = $request->input('supervisor_id');
            $ticked->empresa_id = $request->input('empresa_id');

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
            $ticked->supervisor_id = $request->input('supervisor_id');
            $ticked->empresa_id = $request->input('empresa_id');

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
