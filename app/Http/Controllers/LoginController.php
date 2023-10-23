<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

class LoginController extends Controller
{
    // ============= vista login con id de la empresa ===============
    public function index($idEmpresa){
        return view('auth.login', compact('idEmpresa'));
    }

    // ============= iniciar session login con id de la empresa ===============
    public function store(Request $request, $idEmpresa){
        
        session()->forget('precio2');
        
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|',
        ]);

        if (!auth()->attempt($request->only('email','password'))) {
            return back()->with('mensaje','Credenciales Incorrectas');
        }

        if (session('cart')) {
            return redirect('cart/'.$idEmpresa);
        }else{
            return redirect('/'.$idEmpresa);
        }
    }


    // ============= vista login sin id de la empresa ===============
    public function vista(){
        return view('auth.sin_idempresa.login');
    }

    // ============= iniciar session login sin id de la empresa ===============
    public function guardar(Request $request){

        $request->validate([
            'email' => 'required|email',
            'password' => 'required|',
        ]);

        if (!auth()->attempt($request->only('email','password'))) {
            return back()->with('mensaje','Credenciales Incorrectas');
        }

        return redirect('/');
    }


    // ============= vista login con id empresa 2 ===============
    public function vista_login_precio2($idEmpresa){
        return view('auth.login_precio2.login', compact('idEmpresa'));
    }
    
    // ============= iniciar session login con id empresa 2 ===============
    public function guardar_login_precio2(Request $request, $idEmpresa){

        $request->validate([
            'email' => 'required|email',
            'password' => 'required|',
        ]);
    
        if (!auth()->attempt($request->only('email','password'))) {
            return back()->with('mensaje','Credenciales Incorrectas');
        }

        if (session('cart')) {
            return redirect('cart/'.$idEmpresa);
        }else{
            return redirect('/'.$idEmpresa);
        }
    }
}



