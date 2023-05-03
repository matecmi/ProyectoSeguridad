<?php
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Models\Admin\TicketImagen;
use Illuminate\Support\Facades\Storage;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use DataTables;
class TicketIamgenController extends Controller
{
      
     
    public function ticketImagen(Request $request)
    {

        if($request ->ajax()){

            $ticketId = $request->input("ticketId");

            $ticketImagen = TicketImagen::select('*')
            ->where('ticket_imagens.status', '=', 'Y')
            ->where('ticket_imagens.ticket_id', '=', $ticketId)
            ->get();
            
            return response()->json($ticketImagen);

        }

    }

    public function ticketImagenStore(Request $request)
    {

        if($request->ajax()){
            $request->validate([

                'file'=>'required|image|max:2048'
            ]);
    
           $imagenes= $request->file('file')->store('public/imagenes');
           $url =Storage::url($imagenes);
    
            $ticketImagen = new TicketImagen();
            $ticketImagen->nombre = "imagen";
            $ticketImagen->ticket_id = $request->input('ticketId');
            $ticketImagen->path =  $url;
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
