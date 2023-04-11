<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Models\Admin\Sla;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use DataTables;

class SlaController extends Controller
{
    public function sla(Request $request)
    {

        if($request ->ajax()){

            $sla = Sla::select('*')
            ->where('status', '=', 'Y')
            ->get();
            return Datatables::of($sla)
                ->addColumn('action', function($sla){

                    $acciones ='<button type="button" name="edit"  id="'.$sla->id.'" class=" btn btn-success btn-sm"> <i class="fa-sharp fa-solid fa-pen-to-square"></i> </button>';
                    $acciones .='&nbsp;&nbsp;<button type="button" name="delete" id="'.$sla->id.'" class=" btn btn-danger btn-sm"> <i class="fa-solid fa-trash-can"></i> </button>'; 

                    return $acciones;

                })
                ->rawColumns(['action'])
                ->make(true);
        }

        return view('admin.sla');
    }

    public function slaStore(Request $request)
    {

        if($request->ajax()){
            $sla = new Sla();
            $sla->nombre = $request->input('nombre');
            $sla->horas = $request->input('hora');
            $sla->tiempo_primera_respuesta = $request->input('tpRespuesta');
            $sla->save();
        
            return response()->json(['success' => true]);
        }
   
        return response()->json(['success' => false]);

    }


public function slaEdit(Request $request)
{

    if($request->ajax()){

    try {
        $sla = Sla::findOrFail($request->input('id'));
        return response()->json(['success' => $sla]);
    } catch (\Throwable $th) {
        return response()->json(['error' => 'Registro no encontrado'], 404);
    }
  }
}


    public function slaUpdate(Request $request)
    {
        if($request->ajax()){
            $id = $request->input('id');
            $sla = Sla::find($id);
            $sla->nombre = $request->input('nombre');
            $sla->horas = $request->input('hora');
            $sla->tiempo_primera_respuesta = $request->input('tpRespuesta');
            $sla->save();
        
            return response()->json(['success' => true]);
        }
   
        return response()->json(['success' => false]);
    }


    public function slaDestroy(Request $request)
    {
    if($request->ajax()){

        
        $registro = Sla::find($request->input('id'));
        $registro->status = "N";
        $registro->save();

        return response()->json(['success' => true]);
    }else {
        return response()->json(['success' => false]);

    }
    }
}
