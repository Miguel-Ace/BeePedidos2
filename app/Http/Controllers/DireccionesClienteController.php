<?php

namespace App\Http\Controllers;

use App\Models\DireccionesCliente;
use App\Http\Controllers\Controller;
use App\Models\Cliente;
use App\Models\User;
use Illuminate\Http\Request;

class DireccionesClienteController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index($idEmpresa)
    {
        $datos = DireccionesCliente::all();
        $clientes = User::all();

        if (auth()->check()) {
            // La sesión está activa
            return view('panel_direccion_cliente.index', compact('datos','clientes','idEmpresa'));
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
            'id_cliente' => 'required',
            'direccion' => 'required',
            'coordenadas' => 'required',
            'favorita' => 'required',
        ]);

        $datos = $request->except('_token');
        DireccionesCliente::insert($datos);
        return redirect('/panel_direccion_cliente'.'/'.$idEmpresa)->with('success', 'Creado con Exito');
    }

    /**
     * Display the specified resource.
     */
    public function show(DireccionesCliente $direccionesCliente)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id, $idEmpresa)
    {
        $datos = DireccionesCliente::find($id);
        $clientes = User::all();

        if (auth()->check()) {
            // La sesión está activa
            return view('panel_direccion_cliente.edit', compact('datos','clientes','idEmpresa'));
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
            'id_cliente' => 'required',
            'direccion' => 'required',
            'coordenadas' => 'required',
            'favorita' => 'required',
        ]);

        $datos = $request->except('_token','_method');
        DireccionesCliente::where('id','=',$id)->update($datos);
        return redirect('/panel_direccion_cliente'.'/'.$idEmpresa)->with('success','INFORMACIÓN ACTUALIZADA');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id, $idEmpresa)
    {
        DireccionesCliente::destroy($id);
        return redirect('/panel_direccion_cliente'.'/'.$idEmpresa)->with('danger','ELMINADO CON ÉXITO');
    }
}
