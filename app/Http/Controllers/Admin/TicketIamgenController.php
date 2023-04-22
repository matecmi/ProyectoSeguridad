<?php
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Models\Admin\Ticket;
use App\Models\Admin\TicketImagen;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use DataTables;
class TicketIamgenController extends Controller
{
      
     
    public function ticketImagen(Request $request)
    {

        if($request ->ajax()){

            $ticketImagen = TicketImagen::select('ticket_imagens.*','tickets.descripcion as ticket_nombre')
            ->join('tickets', 'ticket_imagens.ticket_id', '=', 'tickets.id')
            ->where('ticket_imagens.status', '=', 'Y')
            ->get();
            return Datatables::of($ticketImagen)
                ->addColumn('action', function($ticketImagen){

                    $acciones ='<button type="button" name="edit"  id="'.$ticketImagen->id.'" class=" btn btn-success btn-sm"> <i class="fa-sharp fa-solid fa-pen-to-square"></i> </button>';
                    $acciones .='&nbsp;&nbsp;<button type="button" name="delete" id="'.$ticketImagen->id.'" class=" btn btn-danger btn-sm"> <i class="fa-solid fa-trash-can"></i> </button>'; 

                    return $acciones;

                })
                ->rawColumns(['action'])
                ->make(true);
        }

        return view('admin.ticketImagen');
    }

    public function listTicket()
    {
        $ticket = Ticket::select('*')
        ->where('status', '=', 'Y')
        ->get();
        return response()->json($ticket);
    }

   
    public function ticketImagenStore(Request $request)
    {

        if($request->ajax()){

            $ticketImagen = new TicketImagen();
            $ticketImagen->nombre = $request->input('nombre');
            $ticketImagen->ticket_id = $request->input('ticket_id');
            $ticketImagen->save();
        
            return response()->json(['success' => true]);
        }
   
        return response()->json(['success' => false]);

    }

public function ticketImagenEdit(Request $request)
{
    if($request->ajax()){

        try {
            $ticketImagen = TicketImagen::findOrFail($request->input('id'));
            return response()->json(['success' => $ticketImagen]);
        } catch (\Throwable $th) {
            return response()->json(['error' => 'Registro no encontrado'], 404);
        }
    }
}


    public function ticketImagenUpdate(Request $request)
    {
        if($request->ajax()){

            $id = $request->input('id');
            $ticketImagen = TicketImagen::find($id);
            $ticketImagen->nombre = $request->input('nombre');
            $ticketImagen->ticket_id = $request->input('ticket_id');
            $ticketImagen->save();
        
            return response()->json(['success' => true]);
        }
   
        return response()->json(['success' => false]);
    }


    public function ticketImagenDestroy(Request $request)
    {
        if($request->ajax()){

            $registro = TicketImagen::find($request->input('id'));
            $registro->status = "N";
            $registro->save();
    
            return response()->json(['success' => true]);
            }
            return response()->json(['success' => false]);
    
    }
}
