<?php

namespace App\Http\Controllers;

use App\Models\Estado;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class EstadoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index($idEmpresa)
    {
        $datos = Estado::all();

        if (auth()->check()) {
            // La sesión está activa
            return view('panel_estado.index', compact('datos','idEmpresa'));
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
            'estado' => 'required',
        ]);

        $datos = $request->except('_token');
        Estado::insert($datos);
        return redirect('/panel_estado'.'/'.$idEmpresa)->with('success', 'Creado con Exito');
    }

    /**
     * Display the specified resource.
     */
    public function show(Estado $estado)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id, $idEmpresa)
    {
        $datos = Estado::find($id);

        if (auth()->check()) {
            // La sesión está activa
            return view('panel_estado.edit', compact('datos','idEmpresa'));
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
            'estado' => 'required',
        ]);

        $datos = $request->except('_token','_method');
        Estado::where('id','=',$id)->update($datos);
        return redirect('/panel_estado'.'/'.$idEmpresa)->with('success','INFORMACIÓN ACTUALIZADA');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id, $idEmpresa)
    {
        Estado::destroy($id);
        return redirect('/panel_estado'.'/'.$idEmpresa)->with('danger','ELMINADO CON ÉXITO');
    }
}
