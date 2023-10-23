<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Cliente;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;

class ClienteController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index($idEmpresa)
    {
        $datos = User::all();

        if (auth()->check()) {
            // La sesión está activa
            return view('panel_clientes.index', compact('datos','idEmpresa'));
        } else {
            // La sesión no está activa
            return redirect('/login'.'/'.$idEmpresa);
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, $idEmpresa)
    {
        request()->validate([
            'name' => 'required|min:3',
            'email' => 'required|email|unique:users',
            'telefono' => 'required',
            'cedula' => 'required|unique:users',
            'tipo_cedula' => 'required',
            'password' => 'required|min:8',
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'telefono' => $request->telefono,
            'cedula' => $request->cedula,
            'tipo_cedula' => $request->tipo_cedula,
            'password' => Hash::make($request->password),
        ]);

        // $datos = $request->except('_token');
        // User::insert($datos);
        return redirect('/panel_clientes'.'/'.$idEmpresa)->with('success', 'Creado con Exito');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id, $idEmpresa)
    {
        $datos = User::find($id);

        if (auth()->check()) {
            // La sesión está activa
            return view('panel_clientes.edit', compact('datos','idEmpresa'));
        } else {
            // La sesión no está activa
            return redirect('/login'.'/'.$idEmpresa);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id, $idEmpresa)
    {
        request()->validate([
            'name' => 'required|min:3',
            'email' => 'required|email',
            'telefono' => 'required',
            'cedula' => 'required',
            'tipo_cedula' => 'required',
            'direccion1' => 'required',
            'direccion2' => 'required',
            'direccion3' => 'required',
            // 'password' => 'nullable|min:8',
        ]);

        $datos = $request->except('_token','_method');
        User::where('id','=',$id)->update($datos);
        // return redirect('/panel_clientes'.'/'.$idEmpresa)->with('success','INFORMACIÓN ACTUALIZADA');
        return redirect()->back()->with('success','INFORMACIÓN ACTUALIZADA');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id, $idEmpresa)
    {
        User::destroy($id);
        return redirect('/panel_clientes'.'/'.$idEmpresa)->with('danger','ELMINADO CON ÉXITO');
    }
}
