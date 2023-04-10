<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Models\Admin\Rol;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use DataTables;

class RolController extends Controller
{
   
    public function index(Request $request)
    {

        if($request ->ajax()){

            $rol = Rol::select('*')
            ->where('status', '=', 'Y')
            ->get();
            return Datatables::of($rol)
                ->addColumn('action', function($rol){

                    $acciones ='<button type="button" name="edit"  id="'.$rol->id.'" class=" btn btn-success btn-sm"> <i class="fa-sharp fa-solid fa-pen-to-square"></i> </button>';
                    $acciones .='&nbsp;&nbsp;<button type="button" name="delete" id="'.$rol->id.'" class=" btn btn-danger btn-sm"> <i class="fa-solid fa-trash-can"></i> </button>'; 

                    return $acciones;

                })
                ->rawColumns(['action'])
                ->make(true);
        }

        return view('admin.rol.index');
    }


    public function lista()
    {
        $opcionMenu = Rol::select('*')
        ->where('status', '=', 'Y')
        ->get();
        return response()->json($opcionMenu);
    }

    public function store(Request $request)
    {

        if($request->ajax()){
            $rol = new Rol();
            $rol->nombre = $request->input('nombre');
            $rol->save();
        
            return response()->json(['success' => true]);
        }
   
        return response()->json(['success' => false]);

    }

public function edit($id)
{
    try {
        $rol = Rol::findOrFail($id);
        return response()->json(['success' => $rol]);
    } catch (\Throwable $th) {
        return response()->json(['error' => 'Registro no encontrado'], 404);
    }
}


    public function update(Request $request)
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


    public function destroy( $id)
    {
        
        $registro = Rol::find($id);
        $registro->status = "N";
        $registro->save();

        return response()->json(['mensaje' => 'Registro eliminado']);
    }
}
