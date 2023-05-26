<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Admin\Usuario;
use App\Models\Admin\Persona;
use App\Models\User;
use Illuminate\Support\Facades\Hash;




class ProfileController extends Controller
{

    public function profile()
    {
        return view('admin.profile');
    }

    public function validar(Request $request){


        $user = auth()->user();

        if (optional($user)->email !== null) {

            if($request->ajax()){

                $user = auth()->user();
                $email = $user->email;
    
    
                $persona = Persona::select('*')
                ->where('status', '=', 'Y')
                ->where('email', '=', $email)
                ->first();
    
                $usuario = Usuario::select('*')
                ->where('status', '=', 'Y')
                ->where('persona_id', '=', $persona->id)
                ->first();
    
                if($usuario->password == $request->input('password')){
                    return response()->json(['success' => true]);
    
                }else{
                    
                  return response()->json(['success' => false]);
    
                }
    
            }
    
        }

        return view('auth.login');

      
    }

    public function update(Request $request){

        if($request->ajax()){

            $user = auth()->user();

            if (optional($user)->email !== null) {
    
                $logeado = auth()->user();
                $email = $logeado->email;
    
                $persona = Persona::select('*')
                ->where('status', '=', 'Y')
                ->where('email', '=', $email)
                ->first();
    
                $usuario = Usuario::select('*')
                ->where('status', '=', 'Y')
                ->where('persona_id', '=', $persona->id)
                ->first();
    
                $user = User::select('*')
                ->where('email', '=', $email)
                ->first();
                 User::destroy($user->id);
        
                 User::create([
                    'name' => $persona->nombres,
                    'email' => $persona->email,
                    'password' => Hash::make($request->input('password')),
                ]);
    
                $usuario->password = $request->input('password');
                $usuario->save();
            
                return response()->json(['success' => true]);
            }
            return response()->json(['success' => false]);
    
        
            }
    
            return view('auth.login');
    
    
    
            
           
    }



}
