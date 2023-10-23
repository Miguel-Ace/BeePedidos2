<?php

namespace App\Http\Controllers;

use App\Models\Empresa;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class EmpresaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index($idEmpresa)
    {
        $datos = Empresa::all();

        if (auth()->check()) {
            // La sesión está activa
            return view('panel_empresas.index', compact('datos','idEmpresa'));
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
            'url_imagen' => 'required',
            'descripcion' => 'required',
            'cedula' => 'required',
            'pais' => 'required',
            'empresa' => 'required',
            'direccion' => 'required',
            'telefono' => 'required',
            'email' => 'required',
            'celular' => 'required',
            'coordenadas' => 'required',
        ]);

        $datos = $request->except('_token');
        Empresa::insert($datos);
        return redirect('/panel_empresas'.'/'.$idEmpresa)->with('success', 'Creado con Exito');
    }

    /**
     * Display the specified resource.
     */
    public function show(Empresa $empresa)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id, $idEmpresa)
    {
        $datos = Empresa::find($id);

        if (auth()->check()) {
            // La sesión está activa
            return view('panel_empresas.edit', compact('datos','idEmpresa'));
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
            'cedula' => 'required',
            'pais' => 'required',
            'empresa' => 'required',
            'direccion' => 'required',
            'telefono' => 'required',
            'email' => 'required',
            'celular' => 'required',
            'coordenadas' => 'required',
        ]);

        $datos = $request->except('_token','_method');
        Empresa::where('id','=',$id)->update($datos);
        return redirect('/panel_empresas'.'/'.$idEmpresa)->with('success','INFORMACIÓN ACTUALIZADA');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id, $idEmpresa)
    {
        Empresa::destroy($id);
        return redirect('/panel_empresas'.'/'.$idEmpresa)->with('danger','ELMINADO CON ÉXITO');
    }
}
