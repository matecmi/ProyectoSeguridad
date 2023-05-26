<?php
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Models\Admin\GrupoMenu;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use DataTables;

class GrupoMenuController extends Controller
{
 
    public function grupomenu(Request $request)
    {

        $user = auth()->user();

        if (optional($user)->email !== null) {


        if($request ->ajax()){

            $grupomenu = GrupoMenu::select('*')
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

        return view('admin.grupomenu');
    }
    return view('auth.login');

    }

    public function grupoCreate(Request $request)
    {

        if($request->ajax()) {
            $grupoMenu = new GrupoMenu();
            $grupoMenu->nombre = $request->input('nombre');
            $grupoMenu->icono = $request->input('icono');
            $grupoMenu->orden = $request->input('orden');
            $grupoMenu->save();
        
            return response()->json(['success' => true]);
        }


    }

    public function grupoStore(Request $request)
    {

        if($request->ajax()){
            $grupoMenu = new GrupoMenu();
            $grupoMenu->nombre = $request->input('nombre');
            $grupoMenu->icono = $request->input('icono');
            $grupoMenu->orden = $request->input('orden');
            $grupoMenu->save();
        
            return response()->json(['success' => true]);
        }
   
        return response()->json(['success' => false]);

    }

public function grupoEdit(Request $request)
{
    if($request->ajax()){

    try {
        $grupoMenu = GrupoMenu::findOrFail($request->input('id'));
        return response()->json(['success' => $grupoMenu]);
    } catch (\Throwable $th) {
        return response()->json(['error' => 'Registro no encontrado'], 404);
    }
}
}


    public function grupoUpdate(Request $request)
    {
        if($request->ajax()){
            $id = $request->input('id');
            $grupoMenu = GrupoMenu::find($id);
            $grupoMenu->nombre = $request->input('nombre');
            $grupoMenu->icono = $request->input('icono');
            $grupoMenu->orden = $request->input('orden');
            $grupoMenu->save();
        
            return response()->json(['success' => true]);
        }
   
        return response()->json(['success' => false]);
    }


    public function grupoDestroy(Request $request)
    {

        
        if($request->ajax()){

        $registro = GrupoMenu::find($request->input('id'));
        $registro->status = "N";
        $registro->save();

        return response()->json(['success' => true]);
        }
        return response()->json(['success' => false]);

    }
}
