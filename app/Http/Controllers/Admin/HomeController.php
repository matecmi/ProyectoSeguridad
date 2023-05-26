<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class HomeController extends Controller
{

    
    public function index(){

        $user = auth()->user();

        if (optional($user)->email !== null) {
            return view('admin.index');

        }

        return view('auth.login');
    }

}


