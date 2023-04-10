<?php


namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Models\Admin\Faq;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use DataTables;

class FaqController extends Controller
{

    public function index(Request $request)
    {

        if($request ->ajax()){

            $faq = Faq::select('*')
            ->where('status', '=', 'Y')
            ->get();
            return Datatables::of($faq)
                ->addColumn('action', function($faq){

                    $acciones ='<button type="button" name="edit"  id="'.$faq->id.'" class=" btn btn-info btn-sm"> Editar </button>';
                    $acciones .='&nbsp;&nbsp;<button type="button" name="delete" id="'.$faq->id.'" class=" btn btn-danger btn-sm"> Eliminar </button>'; 

                    return $acciones;

                })
                ->rawColumns(['action'])
                ->make(true);
        }

        return view('admin.faq.index');
    }

    public function store(Request $request)
    {

        if($request->ajax()){
            $faq = new Faq();
            $faq->titulo = $request->input('titulo');
            $faq->respuesta = $request->input('respuesta');

            $faq->save();
        
            return response()->json(['success' => true]);
        }
   
        return response()->json(['success' => false]);

    }


public function edit($id)
{
    try {
        $faq = Faq::findOrFail($id);
        return response()->json(['success' => $faq]);
    } catch (\Throwable $th) {
        return response()->json(['error' => 'Registro no encontrado'], 404);
    }
}


    public function update(Request $request)
    {
        if($request->ajax()){
            $id = $request->input('id');
            $faq = Faq::find($id);
            $faq->titulo = $request->input('titulo');
            $faq->respuesta = $request->input('respuesta');            
            $faq->save();
        
            return response()->json(['success' => true]);
        }
   
        return response()->json(['success' => false]);
    }


    public function destroy( $id)
    {
        
        $registro = Faq::find($id);
        $registro->status = "N";
        $registro->save();

        return response()->json(['mensaje' => 'Registro eliminado']);
    }
}
