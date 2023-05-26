<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Models\Admin\Rol;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use DataTables;

class RolController extends Controller
{
   
    public function rol(Request $request)
    {


        $user = auth()->user();

        if (optional($user)->email !== null) {

            if($request ->ajax()){

                $rol = Rol::select('*')
                ->where('status', '=', 'Y')
                ->get();
                return Datatables::of($rol)
                    ->addColumn('action', function($rol){
    
                        $acciones ='<button type="button" name="edit"  id="'.$rol->id.'" class="btn editar btn-sm">Editar<i class="fa-sharp fa-solid fa-pen-to-square ml-1" style="color: white;"></i> </button>';
                        $acciones .='&nbsp;&nbsp;<button type="button" name="delete" id="'.$rol->id.'" class="btn eliminar btn-sm">Eliminar<i class="fa-solid fa-trash-can ml-1" style="color: white;"></i> </button>'; 
                        return $acciones;
    
                    })
                    ->rawColumns(['action'])
                    ->make(true);
            }
    
            return view('admin.rol');
    
        }

        return view('auth.login');

        
    }


    public function rolLista()
    {
        $opcionMenu = Rol::select('*')
        ->where('status', '=', 'Y')
        ->get();
        return response()->json($opcionMenu);
    }

    public function rolStore(Request $request)
    {

        if($request->ajax()){
            $rol = new Rol();
            $rol->nombre = $request->input('nombre');
            $rol->save();
        
            return response()->json(['success' => true]);
        }
   
        return response()->json(['success' => false]);

    }

public function rolEdit(Request $request)
{
    if($request->ajax()){

    try {
        $rol = Rol::findOrFail($request->input('id'));
        return response()->json(['success' => $rol]);
    } catch (\Throwable $th) {
        return response()->json(['error' => 'Registro no encontrado'], 404);
    }
}
}


    public function rolUpdate(Request $request)
    {
        if($request->ajax()){
            $id = $request->input('id');
            $rol = Rol::find($id);
            $rol->nombre = $request->input('nombre');
            $rol->save();
        
            return response()->json(['success' => true]);
        }
   
        return response()->json(['success' => false]);
    }


    public function rolDestroy( Request $request)
    {
        if($request->ajax()){

        $registro = Rol::find($request->input('id'));
        $registro->status = "N";
        $registro->save();

        return response()->json(['mensaje' => 'Registro eliminado']);
    }
}
}
