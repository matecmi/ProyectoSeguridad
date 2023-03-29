<?php
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Models\Admin\GrupoMenu;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use DataTables;

class GrupoMenuController extends Controller
{
 
    public function index(Request $request)
    {

        if($request ->ajax()){

            $grupomenu = GrupoMenu::select('*')
            ->where('status', '=', 'Y')
            ->get();
            return Datatables::of($grupomenu)
                ->addColumn('action', function($grupomenu){

                    $acciones ='<button type="button" name="edit"  id="'.$grupomenu->id.'" class=" btn btn-info btn-sm"> Editar </button>';
                    $acciones .='&nbsp;&nbsp;<button type="button" name="delete" id="'.$grupomenu->id.'" class=" btn btn-danger btn-sm"> Eliminar </button>'; 

                    return $acciones;

                })
                ->rawColumns(['action'])
                ->make(true);
        }

        return view('admin.grupomenu.index');
    }

    public function create(Request $request)
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

    public function store(Request $request)
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


    public function show(GrupoMenu $grupomenu)
    {

        $grupoMenus = GrupoMenu::all();
        return view('admin.grupomenu.show',compact('grupoMenus'));
    }


public function edit($id)
{
    try {
        $grupoMenu = GrupoMenu::findOrFail($id);
        return response()->json(['success' => $grupoMenu]);
    } catch (\Throwable $th) {
        return response()->json(['error' => 'Registro no encontrado'], 404);
    }
}


    public function update(Request $request)
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


    public function destroy( $id)
    {
        
        $registro = GrupoMenu::find($id);
        $registro->status = "N";
        $registro->save();

        return response()->json(['mensaje' => 'Registro eliminado']);
    }
}
