<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Models\Admin\GrupoMenu;
use App\Models\Admin\OpcionMenu;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use DataTables;

class OpcionMenuController extends Controller
{
 
    public function opcionmenu(Request $request)
    {

        if($request ->ajax()){

            $opcionmenu = OpcionMenu::select('opcion_menus.*','grupo_menus.nombre as nombre_grupo')
            ->join('grupo_menus', 'opcion_menus.grupo_menus_id', '=', 'grupo_menus.id')
            ->where('opcion_menus.status', '=', 'Y')
            ->get();
            return Datatables::of($opcionmenu)
                ->addColumn('action', function($opcionmenu){

                    $acciones ='<button type="button" name="edit"  id="'.$opcionmenu->id.'" class=" btn btn-success btn-sm"> <i class="fa-sharp fa-solid fa-pen-to-square"></i> </button>';
                    $acciones .='&nbsp;&nbsp;<button type="button" name="delete" id="'.$opcionmenu->id.'" class=" btn btn-danger btn-sm"> <i class="fa-solid fa-trash-can"></i> </button>'; 

                    return $acciones;

                })
                ->rawColumns(['action'])
                ->make(true);
        }

        return view('admin.opcionmenu');
    }

    public function grupo()
    {
        $grupos = GrupoMenu::select('*')
        ->where('status', '=', 'Y')
        ->get();
        return response()->json($grupos);
    }


    public function listaOpcion()
    {


        $grupos = GrupoMenu::select('*')
        ->where('status', '=', 'Y')
        ->get();

        $opcionMenu = OpcionMenu::select('*')
        ->where('status', '=', 'Y')
        ->get();

        $lista= array(
            $grupos,
            $opcionMenu
        );
        return response()->json($lista);
    }

    public function opcionStore(Request $request)
    {

        if($request->ajax()){
            $opcionmenu = new OpcionMenu();
            $opcionmenu->nombre = $request->input('nombre');
            $opcionmenu->ruta = $request->input('ruta');
            $opcionmenu->orden = $request->input('orden');
            $opcionmenu->icono = $request->input('icono');
            $opcionmenu->grupo_menus_id = $request->input('grupo');
            $opcionmenu->save();
        
            return response()->json(['success' => true]);
        }
   
        return response()->json(['success' => false]);

    }

public function opcionEdit($id)
{
    try {
        $opcionmenu = OpcionMenu::findOrFail($id);
        return response()->json(['success' => $opcionmenu]);
    } catch (\Throwable $th) {
        return response()->json(['error' => 'Registro no encontrado'], 404);
    }
}


    public function opcionUpdate(Request $request)
    {
        if($request->ajax()){
            $id = $request->input('id');
            $opcionmenu = OpcionMenu::find($id);
            $opcionmenu->nombre = $request->input('nombre');
            $opcionmenu->icono = $request->input('icono');
            $opcionmenu->orden = $request->input('orden');
            $opcionmenu->ruta = $request->input('ruta');
            $opcionmenu->grupo_menus_id = $request->input('grupo');

            $opcionmenu->save();
        
            return response()->json(['success' => true]);
        }
   
        return response()->json(['success' => false]);
    }


    public function opcionDestroy( $id)
    {
        
        $registro = OpcionMenu::find($id);
        $registro->status = "N";
        $registro->save();

        return response()->json(['mensaje' => 'Registro eliminado']);
    }
}
