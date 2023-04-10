<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Models\Admin\TipoUsuario;
use App\Models\Admin\Persona;
use App\Models\Admin\Usuario;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use DataTables;
use App\Models\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class UsuarioController extends Controller
{
    
    public function index(Request $request)
    {

        if($request ->ajax()){

            $usuario = Usuario::select('usuarios.*','tipo_usuarios.nombre as nombre_tipo',
            'personas.nombres as nombre_persona')
            ->join('tipo_usuarios', 'usuarios.tipo_usuario_id', '=', 'tipo_usuarios.id')
            ->join('personas', 'usuarios.persona_id', '=', 'personas.id')
            ->where('usuarios.status', '=', 'Y')
            ->get();
            return Datatables::of($usuario)
                ->addColumn('action', function($usuario){

                    $acciones ='<button type="button" name="edit"  id="'.$usuario->id.'" class=" btn btn-success btn-sm"> <i class="fa-sharp fa-solid fa-pen-to-square"></i> </button>';
                    $acciones .='&nbsp;&nbsp;<button type="button" name="delete" id="'.$usuario->id.'" class=" btn btn-danger btn-sm"> <i class="fa-solid fa-trash-can"></i> </button>'; 

                    return $acciones;

                })
                ->rawColumns(['action'])
                ->make(true);
        }

        return view('admin.usuario.index');
    }

    public function tipousuario()
    {
        $tipoUsuarios = TipoUsuario::select('*')
        ->where('status', '=', 'Y')
        ->get();
        return response()->json($tipoUsuarios);
    }

    public function persona()
    {
        $personas = Persona::select('*')
        ->where('status', '=', 'Y')
        ->get();
        return response()->json($personas);
    }

    public function store(Request $request)
    {

        if($request->ajax()){

            $persona = Persona::select('*')
            ->where('status', '=', 'Y')
            ->where('id', '=', $request->input('persona'))
            ->first();

             User::create([
                'name' => $persona->nombres,
                'email' => $persona->email,
                'password' => Hash::make($request->input('password')),
            ]);


            $usuario = new Usuario();
            $usuario->nombre = $request->input('nombre');
            $usuario->password = $request->input('password');
            $usuario->tipo_usuario_id = $request->input('tipo');
            $usuario->persona_id = $request->input('persona');
            $usuario->save();
        
            return response()->json(['success' => true]);
        }
   
        return response()->json(['success' => false]);

    }

public function edit($id)
{
    try {
        $usuario = Usuario::findOrFail($id);
        return response()->json(['success' => $usuario]);
    } catch (\Throwable $th) {
        return response()->json(['error' => 'Registro no encontrado'], 404);
    }
}


    public function update(Request $request)
    {
        if($request->ajax()){

            $persona = Persona::select('*')
            ->where('status', '=', 'Y')
            ->where('id', '=', $request->input('persona'))
            ->first();

            $user = User::select('*')
            ->where('email', '=', $persona->email)
            ->first();
             User::destroy($user->id);

             User::create([
                'name' => $persona->nombres,
                'email' => $persona->email,
                'password' => Hash::make($request->input('password')),
            ]);

            $id = $request->input('id');
            $usuario = Usuario::find($id);
            $usuario->nombre = $request->input('nombre');
            $usuario->password = $request->input('password');
            $usuario->tipo_usuario_id = $request->input('tipo');
            $usuario->persona_id = $request->input('persona');

            $usuario->save();
        
            return response()->json(['success' => true]);
        }
   
        return response()->json(['success' => false]);
    }


    public function destroy( $id)
    {
        
        $registro = Usuario::find($id);
        $registro->status = "N";
        $registro->save();

        return response()->json(['mensaje' => 'Registro eliminado']);
    }
}
