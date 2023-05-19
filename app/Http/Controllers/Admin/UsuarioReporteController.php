<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Models\Admin\UsuarioReporte;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use DataTables;

class UsuarioReporteController extends Controller
{
    public function usuarioreporte(Request $request)
    {

        if($request ->ajax()){

            $usuarioReporte = UsuarioReporte::select('*')
            ->where('status', '=', 'Y')
            ->get();
            return Datatables::of($usuarioReporte)
            ->addColumn('action', function($usuarioReporte){
                $acciones ='<button type="button" name="edit"  id="'.$usuarioReporte->id.'" class="btn editar btn-sm">Editar<i class="fa-sharp fa-solid fa-pen-to-square ml-1" style="color: white;"></i> </button>';
                $acciones .='&nbsp;&nbsp;<button type="button" name="delete" id="'.$usuarioReporte->id.'" class="btn eliminar btn-sm">Eliminar<i class="fa-solid fa-trash-can ml-1" style="color: white;"></i> </button>'; 
                return $acciones;

            })
                ->rawColumns(['action'])
                ->make(true);
        }

        return view('admin.usuarioreporte');
    }

    public function usuarioReporteList(){

        $usuarioReporte = UsuarioReporte::select('*')
        ->where('status', '=', 'Y')
        ->get();
        return response()->json($usuarioReporte);
    }

    public function usuarioReporteStore(Request $request)
    {

        if($request->ajax()){
            $usuarioReporte = new UsuarioReporte();
            $usuarioReporte->nombre = $request->input('nombre');
            $usuarioReporte->telefono = $request->input('telefono');
            $usuarioReporte->email = $request->input('email');
            $usuarioReporte->save();
        
            return response()->json(['success' => true]);
        }
   
        return response()->json(['success' => false]);

    }


public function usuarioReporteEdit(Request $request)
{

    if($request->ajax()){

    try {
        $usuarioReporte = UsuarioReporte::findOrFail($request->input('id'));
        return response()->json(['success' => $usuarioReporte]);
    } catch (\Throwable $th) {
        return response()->json(['error' => 'Registro no encontrado'], 404);
    }
  }
}


    public function usuarioReporteUpdate(Request $request)
    {
        if($request->ajax()){
            $id = $request->input('id');
            $usuarioReporte = UsuarioReporte::find($id);
            $usuarioReporte->nombre = $request->input('nombre');
            $usuarioReporte->telefono = $request->input('telefono');
            $usuarioReporte->email = $request->input('email');
            $usuarioReporte->save();
        
            return response()->json(['success' => true]);
        }
   
        return response()->json(['success' => false]);
    }


    public function usuarioReporteDestroy(Request $request)
    {
    if($request->ajax()){

        
        $registro = UsuarioReporte::find($request->input('id'));
        $registro->status = "N";
        $registro->save();

        return response()->json(['success' => true]);
    }else {
        return response()->json(['success' => false]);

    }
    }
}
