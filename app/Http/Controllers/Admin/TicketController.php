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
use App\Models\Admin\MedioReporte;
use App\Models\Admin\Accione;
use App\Models\Admin\TicketImagen;
use App\Models\Admin\TicketDocumento;
use Illuminate\Support\Facades\Storage;




use Illuminate\Http\Request;
use Illuminate\Http\Response;
use DataTables;

class TicketController extends Controller
{

    public function ticketList(Request $request){

        if($request ->ajax()){
        
            
            $filtroIncidencia = $request->input('filtroIncidencia');
            $filtroEstado = $request->input('filtroEstado');
            $filtroEmpresa = $request->input('filtroEmpresa');
            $filtroDescripcion = $request->input('filtroDescripcion');
            $filtroPersonal = $request->input('filtroPersonal');
            $filtroDesde = $request->input('filtroDesde');
            $filtroHasta = $request->input('filtroHasta');

            $fechaDesde =date('Y-m-d H:i:s', strtotime($filtroDesde . ' 00:00:00'));
            $fechasHasta= date('Y-m-d H:i:s', strtotime($filtroHasta . ' 23:59:59'));

            $ticket = Ticket::select('tickets.*','usuarios.nombre as usuario_nombre',
            'tipo_incidencias.nombre as tipo_incidencia_nombre',
            'slas.nombre as sla_nombre',
            'slas.nomenclatura as sla_nomenclatura',  
            'medio_reportes.nombre as medio_reporte_nombre',
            'persona1.nombres as personal_nombre',
            'persona2.nombres as empresa_nombre', 
            'persona3.nombres as supervisor_nombre','usuario_reportes.nombre as nombre')
            ->join('usuarios', 'tickets.usuario_id', '=', 'usuarios.id')
            ->join('medio_reportes', 'tickets.medio_reporte_id', '=', 'medio_reportes.id')
            ->join('tipo_incidencias', 'tickets.tipoincidencia_id', '=', 'tipo_incidencias.id')
            ->join('slas', 'tickets.sla_id', '=', 'slas.id')
            ->join('personas as persona1', 'tickets.personal_id', '=', 'persona1.id')
            ->join('personas as persona2', 'tickets.empresa_id', '=', 'persona2.id')
            ->join('personas as persona3', 'tickets.supervisor_id', '=', 'persona3.id')
            ->join('usuario_reportes', 'tickets.usuario_reporte_id', '=', 'usuario_reportes.id')
            ->where('tickets.status', '=', 'Y')
            ->when($filtroEstado != 'Todos' && $filtroEstado != null , function ($query) use ($filtroEstado) {
                return $query->where('tickets.situacion', $filtroEstado);
            })
            ->when($filtroIncidencia != 'Todos' && $filtroIncidencia != null , function ($query) use ($filtroIncidencia) {
                return $query->where('tickets.tipoincidencia_id', $filtroIncidencia);
            })
            ->when($filtroEmpresa != 'Todos' && $filtroEmpresa != null , function ($query) use ($filtroEmpresa) {
                return $query->where('tickets.empresa_id', $filtroEmpresa);
            })
            ->when($filtroPersonal != 'Todos' && $filtroPersonal != null , function ($query) use ($filtroPersonal) {
                return $query->where('tickets.personal_id', $filtroPersonal);
            })
            ->when($filtroDescripcion != '' && $filtroDescripcion != null , function ($query) use ($filtroDescripcion) {
                return $query->where('tickets.descripcion', 'LIKE', '%' . $filtroDescripcion . '%');
            })
            ->when($filtroDesde && $filtroHasta, function ($query) use ($fechaDesde, $fechasHasta) {
                return $query->whereBetween('tickets.fecha_registro', [$fechaDesde, $fechasHasta]);
            })
            ->when($filtroDesde && !$filtroHasta, function ($query) use ($fechaDesde) {
                return $query->where('tickets.fecha_registro', '>=', $fechaDesde);
            })
            ->when(!$filtroDesde && $filtroHasta, function ($query) use ($fechasHasta) {
                return $query->where('tickets.fecha_registro', '<=', $fechasHasta);
            })
            ->get();


            return response()->json(['success' => $ticket]);


        }
    }
     
    public function ticket(Request $request)
    {

        if($request ->ajax()){

            $acciones =Accione::select('*')
            ->where('status', '=', 'Y')
            ->get();

        
            date_default_timezone_set('America/Lima');

            $tickets = Ticket::select('tickets.*','usuarios.nombre as usuario_nombre',
            'slas.nombre as sla_nombre',
            'slas.nomenclatura as sla_nomenclatura')
            ->join('usuarios', 'tickets.usuario_id', '=', 'usuarios.id')
            ->join('slas', 'tickets.sla_id', '=', 'slas.id')
            ->where('tickets.status', '=', 'Y')
            ->where('tickets.situacion', '=', "En Proceso")
            ->where('tickets.fecha_primera_respuesta', '<', date('Y-m-d H:i:s', time()))
            ->get();

            $ticketVencido = array(); 
            $validar =true;
            foreach ($tickets as $ticket) {

                foreach ($acciones as $accion) {

                    if ($accion->ticket_id == $ticket->id) {
                        $validar =false;

                    }
                }

                if ($validar) {
                    array_push($ticketVencido, $ticket);

                }
                $validar =true;

            }


            return response()->json($ticketVencido);
        }
        
        return view('admin.ticket');

    }

    public function ticketUsuarioReporte(Request $request){
        if($request ->ajax()){
            $id = $request->input('id');

            $tickets = Ticket::select('tickets.*','usuario_reportes.nombre as nombre',
            'usuario_reportes.email as email',
            'usuario_reportes.telefono as telefono','usuarios.nombre as usuario_nombre',
            'tipo_incidencias.nombre as tipo_incidencia_nombre',
            'slas.nombre as sla_nombre',
            'slas.nomenclatura as sla_nomenclatura',  
            'medio_reportes.nombre as medio_reporte_nombre',
            'persona1.nombres as personal_nombre',
            'persona2.nombres as empresa_nombre', 
            'persona3.nombres as supervisor_nombre')
            ->join('usuarios', 'tickets.usuario_id', '=', 'usuarios.id')
            ->join('medio_reportes', 'tickets.medio_reporte_id', '=', 'medio_reportes.id')
            ->join('tipo_incidencias', 'tickets.tipoincidencia_id', '=', 'tipo_incidencias.id')
            ->join('slas', 'tickets.sla_id', '=', 'slas.id')
            ->join('personas as persona1', 'tickets.personal_id', '=', 'persona1.id')
            ->join('personas as persona2', 'tickets.empresa_id', '=', 'persona2.id')
            ->join('personas as persona3', 'tickets.supervisor_id', '=', 'persona3.id')
            ->join('usuario_reportes', 'tickets.usuario_reporte_id', '=', 'usuario_reportes.id')
            ->where('tickets.status', '=', 'Y')
            ->where('tickets.id', '=',$id)
            ->first();

            return response()->json($tickets);

        }
    }

    public function listUsuario()
    {
        $usuario = Usuario::select('*')
        ->where('status', '=', 'Y')
        ->get();
        return response()->json($usuario);
    }
    
    public function listMedioReporte()
    {
        $medio = MedioReporte::select('*')
        ->where('status', '=', 'Y')
        ->get();
        return response()->json($medio);
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

            
            $sla = Sla::select('*')
            ->where('status', '=', 'Y')
            ->where('id', '=', $request->input('sla_id'))
            ->first();

            date_default_timezone_set('America/Lima');

            $ticked = new Ticket();
            $ticked->fecha_registro = $request->input('fecha');
            $ticked->fecha_fin_estimado = $this->sumarHoras($request->input('fecha'),$sla->horas);
            $ticked->fecha_primera_respuesta = $this->sumarHoras($request->input('fecha'),$sla->tiempo_primera_respuesta);
            $ticked->descripcion = $request->input('descripcion');
            $ticked->situacion = "En Proceso";
            $ticked->usuario_id = $usuario->id;
            $ticked->tipoincidencia_id = $request->input('tipoincidencia_id');
            $ticked->sla_id = $request->input('sla_id');
            $ticked->personal_id = $request->input('personal_id');
            $ticked->supervisor_id = $request->input('supervisor_id');
            $ticked->empresa_id = $request->input('empresa_id');
            $ticked->medio_reporte_id = $request->input('medio_reporte_id');
            $ticked->usuario_reporte_id  = $request->input('usuario_reporte_id');


            $ticked->save();

            if ( $request->hasFile('fileTicket')) {
                $request->validate([

                    'fileTicket'=>'required|image|max:2048'
                ]);
    
               $imagenes= $request->file('fileTicket')->store('public/imagenes');
               $urlImagen =Storage::url($imagenes);
        
                $ticketImagen = new TicketImagen();
                $ticketImagen->nombre = "imagen";
                $ticketImagen->ticket_id = $ticked->id;
                $ticketImagen->path =  $urlImagen;
                
                $ticketImagen->save();           
             }

             if ($request->hasFile('fileDocumentoTicket')) {
                $request->validate([
                    'fileDocumentoTicket' => 'required|mimetypes:application/pdf,application/vnd.ms-excel,application/vnd.openxmlformats-officedocument.spreadsheetml.sheet,application/msword,application/vnd.openxmlformats-officedocument.wordprocessingml.document,application/vnd.ms-powerpoint|max:10240',
                ]);
                
        
               $documento= $request->file('fileDocumentoTicket')->store('public/documentos');
               $urlDocumento =Storage::url($documento);
               date_default_timezone_set('America/Lima');
    
                $ticketDocumento = new TicketDocumento();
                $ticketDocumento->ticket_id = $ticked->id;
                $ticketDocumento->nombre = "Documento Ticket";
                $ticketDocumento->fecha = date('Y-m-d H:i:s', time());
                $ticketDocumento->path =  $urlDocumento;
                $ticketDocumento->save();             
            }
        
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

            $sla = Sla::select('*')
            ->where('status', '=', 'Y')
            ->where('id', '=', $request->input('sla_id'))
            ->first();

            $id = $request->input('id');
            $ticked = Ticket::find($id);
            $ticked->fecha_registro = $request->input('fecha');
            $ticked->fecha_fin_estimado = $this->sumarHoras($request->input('fecha'),$sla->horas);
            $ticked->fecha_primera_respuesta = $this->sumarHoras($request->input('fecha'),$sla->tiempo_primera_respuesta);
            $ticked->descripcion = $request->input('descripcion');

            $ticked->tipoincidencia_id = $request->input('tipoincidencia_id');
            $ticked->sla_id = $request->input('sla_id');
            $ticked->personal_id = $request->input('personal_id');
            $ticked->supervisor_id = $request->input('supervisor_id');
            $ticked->empresa_id = $request->input('empresa_id');
            $ticked->usuario_reporte_id  = $request->input('usuario_reporte_id');
            $ticked->medio_reporte_id = $request->input('medio_reporte_id');

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



    public function ticketUpdateEstado(Request $request)
    {
        if($request->ajax()){

            date_default_timezone_set('America/Lima');

            $estado =$request->input('estado');
            $id = $request->input('id');
            $ticked = Ticket::find($id);

            if ($estado=="Finalizado") {
                $ticked->fecha_fin =date('Y-m-d H:i:s', time());
            }else{
                $ticked->fecha_fin =null;

            }

            $ticked->situacion = $request->input('estado');

            if ($estado=="Finalizado") {
                $acciones =Accione::select('*')
                ->where('status', '=', 'Y')
                ->where('ticket_id', '=', $id)
                ->get();

                if ($acciones->isEmpty()) {
                    return response()->json(['success' => false]);

                } else {
                    $ticked->save();
                }

            }else{
                $ticked->save();

            }
        
            return response()->json(['success' => true]);
        }
   
        return response()->json(['success' => false]);
    }

    function sumarHoras($fecha, $horas) {
        // Crea un objeto DateTime a partir de la fecha y hora dadas
        $fechaObj = new \DateTime($fecha);
        
        // Suma las horas a la fecha y hora
        $fechaObj->add(new \DateInterval("PT{$horas}H"));
        
        // Devuelve la nueva fecha y hora en formato ISO 8601
        return $fechaObj->format('Y-m-d H:i:s');
      }
}
