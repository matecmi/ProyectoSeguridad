<?php
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Models\Admin\TicketDocumento;
use Illuminate\Support\Facades\Storage;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use DataTables;

class TicketDocumentoController extends Controller
{
      
    public function ticketDocumento(Request $request)
    {

        if($request ->ajax()){

            $ticketId = $request->input("ticketId");

            $ticketDocumento = TicketDocumento::select('*')
            ->where('ticket_documentos.status', '=', 'Y')
            ->where('ticket_documentos.ticket_id', '=', $ticketId)
            ->get();
            
            return response()->json($ticketDocumento);

        }

    }

    public function ticketDocumentoStore(Request $request)
    {

        if($request->ajax()){
            $request->validate([
                'file' => 'required|mimetypes:application/pdf,application/vnd.ms-excel,application/vnd.openxmlformats-officedocument.spreadsheetml.sheet,application/msword,application/vnd.openxmlformats-officedocument.wordprocessingml.document,application/vnd.ms-powerpoint|max:10240',
            ]);
            
    
           $documento= $request->file('file')->store('public/documentos');
           $url =Storage::url($documento);
           date_default_timezone_set('America/Lima');

            $ticketDocumento = new TicketDocumento();
            $ticketDocumento->ticket_id = $request->input('ticketIdDocumento');
            $ticketDocumento->nombre = $request->input('nombreDocumento');
            $ticketDocumento->fecha = date('Y-m-d H:i:s', time());
            $ticketDocumento->path =  $url;
            $ticketDocumento->save();
 

            return response()->json(['success' => true]);

        }
        return response()->json(['success' => false]);

   
    }

    public function ticketDocumentoDestroy(Request $request)
    {
        if($request->ajax()){
            $registro = TicketDocumento::find($request->input('id'));


          if(file_exists(substr($registro->path, 1))) {
          unlink(substr($registro->path, 1));
          }

            $registro->status = "N";
            $registro->save();
    
            return response()->json(['success' => true]);
            }
            return response()->json(['success' => false]);
    
    }
}
