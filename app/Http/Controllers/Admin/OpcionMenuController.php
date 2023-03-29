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
 
    public function index(Request $request)
    {

        if($request ->ajax()){

            $opcionmenu = OpcionMenu::select('*')
            ->where('status', '=', 'Y')
            ->get();
            return Datatables::of($opcionmenu)
                ->addColumn('action', function($opcionmenu){

                    $acciones ='<button type="button" name="edit"  id="'.$opcionmenu->id.'" class=" btn btn-info btn-sm"> Editar </button>';
                    $acciones .='&nbsp;&nbsp;<button type="button" name="delete" id="'.$opcionmenu->id.'" class=" btn btn-danger btn-sm"> Eliminar </button>'; 

                    return $acciones;

                })
                ->rawColumns(['action'])
                ->make(true);
        }

        return view('admin.opcionmenu.index');
    }

    public function grupo()
    {
        $grupos = GrupoMenu::select('*')
        ->where('status', '=', 'Y')
        ->get();
        return response()->json($grupos);
    }


    public function lista()
    {
        $opcionMenu = OpcionMenu::select('*')
        ->where('status', '=', 'Y')
        ->get();
        return response()->json($opcionMenu);
    }

    public function store(Request $request)
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

public function edit($id)
{
    try {
        $opcionmenu = OpcionMenu::findOrFail($id);
        return response()->json(['success' => $opcionmenu]);
    } catch (\Throwable $th) {
        return response()->json(['error' => 'Registro no encontrado'], 404);
    }
}


    public function update(Request $request)
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


    public function destroy( $id)
    {
        
        $registro = OpcionMenu::find($id);
        $registro->status = "N";
        $registro->save();

        return response()->json(['mensaje' => 'Registro eliminado']);
    }
}
