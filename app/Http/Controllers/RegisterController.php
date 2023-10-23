<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Cliente;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use App\Mail\agregarUsuario;
use Illuminate\Support\Facades\Mail;


class RegisterController extends Controller
{
    // ============= vista registro con id de la empresa ===============
    public function index($idEmpresa){
        return view('auth.register', compact('idEmpresa'));
    }

    // ============= guardar registro login con id de la empresa ===============
    public function store(Request $request, $idEmpresa){

        $message = request()->validate([
            'name' => 'required|min:3',
            'email' => 'required|email|unique:users',
            'telefono' => 'required',
            'cedula' => 'required|unique:users',
            'tipo_cedula' => 'required',
            'password' => 'required|min:8|confirmed',
            'direccion1' => 'required|min:10',
            'direccion2' => 'nullable|min:10',
            'direccion3' => 'nullable|min:10',
        ],
        [
            'name.required' => 'El nombre es requerido.',
            'name.min' => 'El nombre debe llevar más de 3 carácteres.',
            'email.required' => 'El correo es requerido.',
            'email.email' => 'El correo no es valido.',
            'email.unique' => 'El correo fue tomado',
            'cedula.required' => 'La cédula es requerido.',
            'tipo_cedula.required' => 'El tipo de cédula es requerido.',
            'telefono.required' => 'El teléfono es requerido.',
            'direccion1.required' => 'Escribe la primer dirección',
            'direccion1.min' => 'La dirección debe tener al menos 10 carácteres',
            // 'direccion2.required' => 'Escribe la segunda dirección',
            // 'direccion2.min' => 'La dirección debe tener al menos 10 carácteres',
            // 'direccion3.required' => 'Escribe la tercer dirección',
            // 'direccion3.min' => 'La dirección debe tener al menos 10 carácteres',
            'password.confirmed' => 'Password no coincide'
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'telefono' => $request->telefono,
            'cedula' => $request->cedula,
            'tipo_cedula' => $request->tipo_cedula,
            'password' => Hash::make($request->password),
            'direccion1' => $request->direccion1,
            'direccion2' => $request->direccion2,
            'direccion3' => $request->direccion3,
        ]);

        // auth()->attempt($request->only('email','password'));

        $correo = new agregarUsuario($message);
        $correoUser = $request->email;
        Mail::to($correoUser)->queue($correo);

        return redirect()->back();
        
        // if (session('cart')) {
        //     return redirect('cart/'.$idEmpresa);
        // }else{
        //     return redirect('/'.$idEmpresa);
        // }
    }


    // ============= vista registro sin id de la empresa ===============
    public function vista(){
        return view('auth.sin_idempresa.register');
    }

    // ============= guardar registro login sin id de la empresa ===============
    public function guardar(Request $request){

        $message = request()->validate([
            'name' => 'required|min:3',
            'email' => 'required|email|unique:users',
            'telefono' => 'required',
            'cedula' => 'required|unique:users',
            'tipo_cedula' => 'required',
            'password' => 'required|min:8|confirmed',
            'direccion1' => 'required|min:10',
            'direccion2' => 'nullable|min:10',
            'direccion3' => 'nullable|min:10',
        ],
        [
            'name.required' => 'El nombre es requerido.',
            'name.min' => 'El nombre debe llevar más de 3 carácteres.',
            'email.required' => 'El correo es requerido.',
            'email.email' => 'El correo no es valido.',
            'email.unique' => 'El correo fue tomado',
            'cedula.required' => 'La cédula es requerido.',
            'tipo_cedula.required' => 'El tipo de cédula es requerido.',
            'telefono.required' => 'El teléfono es requerido.',
            'direccion1.required' => 'Escribe la primer dirección',
            'direccion1.min' => 'La dirección debe tener al menos 10 carácteres',
            // 'direccion2.required' => 'Escribe la segunda dirección',
            // 'direccion2.min' => 'La dirección debe tener al menos 10 carácteres',
            // 'direccion3.required' => 'Escribe la tercer dirección',
            // 'direccion3.min' => 'La dirección debe tener al menos 10 carácteres',
            'password.confirmed' => 'Password no coincide'
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'telefono' => $request->telefono,
            'cedula' => $request->cedula,
            'tipo_cedula' => $request->tipo_cedula,
            'password' => Hash::make($request->password),
            'direccion1' => $request->direccion1,
            'direccion2' => $request->direccion2,
            'direccion3' => $request->direccion3,
        ]);

        // auth()->attempt($request->only('email','password'));

        $correo = new agregarUsuario($message);
        $correoUser = $request->email;
        Mail::to($correoUser)->queue($correo);

        return redirect()->back();
        
        // return redirect('/');
    }

    // ============= vista register con id empresa 2 ===============
    public function vista_register_precio2($idEmpresa){
        return view('auth.login_precio2.register', compact('idEmpresa'));
    }
    
    // ============= registrarse register con id empresa 2 ===============
    public function guardar_register_precio2(Request $request, $idEmpresa){

        $message = request()->validate([
            'name' => 'required|min:3',
            'email' => 'required|email|unique:users',
            'telefono' => 'required',
            'cedula' => 'required|unique:users',
            'tipo_cedula' => 'required',
            'password' => 'required|min:8|confirmed',
            'direccion1' => 'required|min:10',
            'direccion2' => 'nullable|min:10',
            'direccion3' => 'nullable|min:10',
        ],
        [
            'name.required' => 'El nombre es requerido.',
            'name.min' => 'El nombre debe llevar más de 3 carácteres.',
            'email.required' => 'El correo es requerido.',
            'email.email' => 'El correo no es valido.',
            'email.unique' => 'El correo fue tomado',
            'cedula.required' => 'La cédula es requerido.',
            'tipo_cedula.required' => 'El tipo de cédula es requerido.',
            'telefono.required' => 'El teléfono es requerido.',
            'direccion1.required' => 'Escribe la primer dirección',
            'direccion1.min' => 'La dirección debe tener al menos 10 carácteres',
            // 'direccion2.required' => 'Escribe la segunda dirección',
            // 'direccion2.min' => 'La dirección debe tener al menos 10 carácteres',
            // 'direccion3.required' => 'Escribe la tercer dirección',
            // 'direccion3.min' => 'La dirección debe tener al menos 10 carácteres',
            'password.confirmed' => 'Password no coincide'
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'telefono' => $request->telefono,
            'cedula' => $request->cedula,
            'tipo_cedula' => $request->tipo_cedula,
            'password' => Hash::make($request->password),
            'direccion1' => $request->direccion1,
            'direccion2' => $request->direccion2,
            'direccion3' => $request->direccion3,
        ]);

        // auth()->attempt($request->only('email','password'));

        $correo = new agregarUsuario($message);
        $correoUser = $request->email;
        Mail::to($correoUser)->queue($correo);

        return redirect()->back();
    }
}