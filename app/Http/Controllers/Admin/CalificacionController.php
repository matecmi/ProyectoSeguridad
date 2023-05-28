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

        $user = auth()->user();

        if (optional($user)->email !== null) {

        if($request ->ajax()){

            $calificacion = Calificacion::select('calificacions.*','tickets.descripcion as ticket_nombre')
            ->join('tickets', 'calificacions.ticket_id', '=', 'tickets.id')
            ->where('calificacions.status', '=', 'Y')
            ->get();
            return Datatables::of($calificacion)
                ->addColumn('action', function($calificacion){

                    $acciones ='<button type="button" name="edit"  id="'.$calificacion->id.'" class="btn editar btn-sm">Editar<i class="fa-sharp fa-solid fa-pen-to-square ml-1" style="color: white;"></i> </button>';
                    $acciones .='&nbsp;&nbsp;<button type="button" name="delete" id="'.$calificacion->id.'" class="btn eliminar btn-sm">Eliminar<i class="fa-solid fa-trash-can ml-1" style="color: white;"></i> </button>'; 
                    return $acciones;

                })
                ->addColumn('estrella', function($calificacion){
                    $estrellas = $calificacion->puntaje;

                    $acciones ='<div class="starEstrella" >';

                    if ($estrellas==0) {

                        $acciones  .='<i class="fa-solid fa-star activo"></i>';
                        $acciones  .='<i class="fa-solid fa-star inactivo"></i>';
                        $acciones  .='<i class="fa-solid fa-star inactivo"></i>';
                        $acciones  .='<i class="fa-solid fa-star inactivo"></i>';
                        $acciones  .='<i class="fa-solid fa-star inactivo"></i>';

                    }

                    if ($estrellas==1) {

                        $acciones  .='<i class="fa-solid fa-star activo"></i>';
                        $acciones  .='<i class="fa-solid fa-star activo"></i>';
                        $acciones  .='<i class="fa-solid fa-star inactivo"></i>';
                        $acciones  .='<i class="fa-solid fa-star inactivo"></i>';
                        $acciones  .='<i class="fa-solid fa-star inactivo"></i>';

                        
                    }

                    if ($estrellas==2) {
                        $acciones  .='<i class="fa-solid fa-star activo"></i>';
                        $acciones  .='<i class="fa-solid fa-star activo"></i>';
                        $acciones  .='<i class="fa-solid fa-star activo"></i>';
                        $acciones  .='<i class="fa-solid fa-star inactivo"></i>';
                        $acciones  .='<i class="fa-solid fa-star inactivo"></i>';

                        
                    }

                    if ($estrellas==3) {
                        $acciones  .='<i class="fa-solid fa-star activo"></i>';
                        $acciones  .='<i class="fa-solid fa-star activo"></i>';
                        $acciones  .='<i class="fa-solid fa-star activo"></i>';
                        $acciones  .='<i class="fa-solid fa-star activo"></i>';
                        $acciones  .='<i class="fa-solid fa-star inactivo"></i>';

                        
                    }

                    if ($estrellas==4) {
                        $acciones  .='<i class="fa-solid fa-star activo"></i>';
                        $acciones  .='<i class="fa-solid fa-star activo"></i>';
                        $acciones  .='<i class="fa-solid fa-star activo"></i>';
                        $acciones  .='<i class="fa-solid fa-star activo"></i>';
                        $acciones  .='<i class="fa-solid fa-star activo"></i>';

                    }
                    $acciones .='</div>';

                    
                    return  $acciones;
    
                })
                ->rawColumns(['action', 'estrella'])
                ->make(true);
        }

        return view('admin.calificacion');

    }
    return view('auth.login');

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

            date_default_timezone_set('America/Lima');


            $calificacion = new Calificacion();
            $calificacion->fecha = date('Y-m-d H:i:s', time());
            $calificacion->descripcion = $request->input('descripcion');
            $calificacion->puntaje = $request->input('puntaje');
            $calificacion->ticket_id = $request->input('ticket_id');
            $calificacion->ticketCodigo=$request->input('ticketNombre');
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

public function calificacionObjeto (Request $request){
    if($request->ajax()){

    $calificacion = Calificacion::select('*')
    ->where('status', '=', 'Y')
    ->where('ticket_id', '=', $request->input('id'))
    ->first();
    return response()->json(['success' => $calificacion]);

}

}




    public function calificacionUpdate(Request $request)
    {
        if($request->ajax()){

            $id = $request->input('id');
            $calificacion = Calificacion::find($id);
            $calificacion->descripcion = $request->input('descripcion');
            $calificacion->puntaje = $request->input('puntaje');

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
