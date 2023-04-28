<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Models\Admin\MedioReporte;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use DataTables;

class MedioReporteController extends Controller
{
    public function medioReporte(Request $request)
    {

        if($request ->ajax()){

            $medio = MedioReporte::select('*')
            ->where('status', '=', 'Y')
            ->get();
            return Datatables::of($medio)
                ->addColumn('action', function($medio){

                    $acciones ='<button type="button" name="edit"  id="'.$medio->id.'" class=" btn btn-success btn-sm"> <i class="fa-sharp fa-solid fa-pen-to-square"></i> </button>';
                    $acciones .='&nbsp;&nbsp;<button type="button" name="delete" id="'.$medio->id.'" class=" btn btn-danger btn-sm"> <i class="fa-solid fa-trash-can"></i> </button>'; 

                    return $acciones;

                })
                ->rawColumns(['action'])
                ->make(true);
        }

        return view('admin.medioReporte');
    }

    public function medioReporteStore(Request $request)
    {

        if($request->ajax()){
            $medio = new MedioReporte();
            $medio->nombre = $request->input('nombre');
            $medio->save();
        
            return response()->json(['success' => true]);
        }
   
        return response()->json(['success' => false]);

    }


public function medioReporteEdit(Request $request)
{

    if($request->ajax()){

    try {
        $medio = MedioReporte::findOrFail($request->input('id'));
        return response()->json(['success' => $medio]);
    } catch (\Throwable $th) {
        return response()->json(['error' => 'Registro no encontrado'], 404);
    }
  }
}


    public function medioReporteUpdate(Request $request)
    {
        if($request->ajax()){
            $id = $request->input('id');
            $medio = MedioReporte::find($id);
            $medio->nombre = $request->input('nombre');
            $medio->save();
        
            return response()->json(['success' => true]);
        }
   
        return response()->json(['success' => false]);
    }


    public function medioReporteDestroy(Request $request)
    {
    if($request->ajax()){

        
        $registro = MedioReporte::find($request->input('id'));
        $registro->status = "N";
        $registro->save();

        return response()->json(['success' => true]);
    }else {
        return response()->json(['success' => false]);

    }
    }
}
