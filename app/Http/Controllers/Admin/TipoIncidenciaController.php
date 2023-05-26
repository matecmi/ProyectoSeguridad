<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Models\Admin\TipoIncidencia;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use DataTables;

class TipoIncidenciaController extends Controller
{
    public function tipoincidencia(Request $request)
    {


        $user = auth()->user();

        if (optional($user)->email !== null) {

            if($request ->ajax()){

                $tipoIncidencia = TipoIncidencia::select('*')
                ->where('status', '=', 'Y')
                ->get();
                return Datatables::of($tipoIncidencia)
                    ->addColumn('action', function($tipoIncidencia){
    
                        $acciones ='<button type="button" name="edit"  id="'.$tipoIncidencia->id.'" class="btn editar btn-sm">Editar<i class="fa-sharp fa-solid fa-pen-to-square ml-1" style="color: white;"></i> </button>';
                        $acciones .='&nbsp;&nbsp;<button type="button" name="delete" id="'.$tipoIncidencia->id.'" class="btn eliminar btn-sm">Eliminar<i class="fa-solid fa-trash-can ml-1" style="color: white;"></i> </button>'; 
                        return $acciones;
    
                    })
                    ->rawColumns(['action'])
                    ->make(true);
            }
    
            return view('admin.tipoincidencia');
    
        }

        return view('auth.login');

   
    }

    public function tIncidenciaStore(Request $request)
    {

        if($request->ajax()){
            $tipoIncidencia = new TipoIncidencia();
            $tipoIncidencia->nombre = $request->input('nombre');
            $tipoIncidencia->save();
        
            return response()->json(['success' => true]);
        }
   
        return response()->json(['success' => false]);

    }


public function tIncidenciaEdit(Request $request)
{

    if($request->ajax()){

    try {
        $tipoIncidencia = TipoIncidencia::findOrFail($request->input('id'));
        return response()->json(['success' => $tipoIncidencia]);
    } catch (\Throwable $th) {
        return response()->json(['error' => 'Registro no encontrado'], 404);
    }
  }
}


    public function tIncidenciaUpdate(Request $request)
    {
        if($request->ajax()){
            $id = $request->input('id');
            $tipoIncidencia = TipoIncidencia::find($id);
            $tipoIncidencia->nombre = $request->input('nombre');
            $tipoIncidencia->save();
        
            return response()->json(['success' => true]);
        }
   
        return response()->json(['success' => false]);
    }


    public function tIncidenciaDestroy(Request $request)
    {

        if($request->ajax()){

        
        $registro = TipoIncidencia::find($request->input('id'));
        $registro->status = "N";
        $registro->save();

        return response()->json(['success' => true]);
    }else {
        return response()->json(['success' => false]);

    }
    }
}
