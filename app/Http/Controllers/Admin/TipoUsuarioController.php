<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Models\Admin\GrupoMenu;
use App\Models\Admin\TipoUsuario;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use DataTables;

class TipoUsuarioController extends Controller
{
  
    public function index(Request $request)
    {

        if($request ->ajax()){

            $grupomenu = TipoUsuario::select('*')
            ->where('status', '=', 'Y')
            ->get();
            return Datatables::of($grupomenu)
                ->addColumn('action', function($grupomenu){

                    $acciones ='<button type="button" name="edit"  id="'.$grupomenu->id.'" class="btn editar btn-sm">Editar<i class="fa-sharp fa-solid fa-pen-to-square ml-1" style="color: white;"></i> </button>';
                    $acciones .='&nbsp;&nbsp;<button type="button" name="delete" id="'.$grupomenu->id.'" class="btn eliminar btn-sm">Eliminar<i class="fa-solid fa-trash-can ml-1" style="color: white;"></i> </button>'; 
                    return $acciones;

                })
                ->rawColumns(['action'])
                ->make(true);
        }

        return view('admin.tipousuario.index');
    }

    public function store(Request $request)
    {

        if($request->ajax()){
            $tipousuario = new TipoUsuario();
            $tipousuario->nombre = $request->input('nombre');
            $tipousuario->save();
        
            return response()->json(['success' => true]);
        }
   
        return response()->json(['success' => false]);

    }


public function edit($id)
{
    try {
        $tipousuario = TipoUsuario::findOrFail($id);
        return response()->json(['success' => $tipousuario]);
    } catch (\Throwable $th) {
        return response()->json(['error' => 'Registro no encontrado'], 404);
    }
}


    public function update(Request $request)
    {
        if($request->ajax()){
            $id = $request->input('id');
            $tipousuario = TipoUsuario::find($id);
            $tipousuario->nombre = $request->input('nombre');
            $tipousuario->save();
        
            return response()->json(['success' => true]);
        }
   
        return response()->json(['success' => false]);
    }


    public function destroy( $id)
    {
        
        $registro = TipoUsuario::find($id);
        $registro->status = "N";
        $registro->save();

        return response()->json(['mensaje' => 'Registro eliminado']);
    }
}
