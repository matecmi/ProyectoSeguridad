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
            $accion_id = $request->input("accion_id");

            $ticketImagen = TicketImagen::select('*')
            ->where('ticket_imagens.status', '=', 'Y')
            ->where('ticket_imagens.ticket_id', '=', $ticketId)
            ->when($accion_id != 'NoFiltrar' , function ($query) use ($accion_id) {
                return $query->where('ticket_imagens.accion_id', $accion_id);
            })
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


            return response()->json(['success' => $ticketImagen->id]);

        }
        return response()->json(['success' => false]);

   
    }

    public function ticketImagenAccion(Request $request){
        if($request->ajax()){

            $id = $request->input('id');
            $imagen = TicketImagen::find($id);
            $imagen->accion_id = $request->input('accion_id');
            $imagen->save();
            return response()->json(['success' => true]);
        }
   
        return response()->json(['success' => false]);
    }

    public function ticketImagenDestroy(Request $request)
    {
        if($request->ajax()){
            $registro = TicketImagen::find($request->input('id'));


          if(file_exists(substr($registro->path, 1))) {
          unlink(substr($registro->path, 1));
          }

            $registro = TicketImagen::find($request->input('id'));
            $registro->status = "N";
            $registro->save();
    
            return response()->json(['success' => true]);
            }
            return response()->json(['success' => false]);
    
    }
}
