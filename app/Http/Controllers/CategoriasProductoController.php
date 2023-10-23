<?php

namespace App\Http\Controllers;

use App\Models\Empresa;
use Illuminate\Http\Request;
use App\Models\CategoriasProducto;
use App\Http\Controllers\Controller;

class CategoriasProductoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index($idEmpresa)
    {
        $datos = CategoriasProducto::all();
        $empresas = Empresa::all();

        if (auth()->check()) {
            // La sesión está activa
            return view('panel_categoria_producto.index', compact('datos','empresas','idEmpresa'));
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
            'id_empresa' => 'required',
            'categoria' => 'required',
        ]);

        $datos = $request->except('_token');
        CategoriasProducto::insert($datos);
        return redirect('/panel_categoria_productos'.'/'.$idEmpresa)->with('success', 'Creado con Exito');
    }

    /**
     * Display the specified resource.
     */
    public function show(CategoriasProducto $categoriasProducto)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id, $idEmpresa)
    {
        $datos = CategoriasProducto::find($id);
        $empresas = Empresa::all();

        if (auth()->check()) {
            // La sesión está activa
            return view('panel_categoria_producto.edit', compact('datos','empresas','idEmpresa'));
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
            'id_empresa' => 'required',
            'categoria' => 'required',
        ]);

        $datos = $request->except('_token','_method');
        CategoriasProducto::where('id','=',$id)->update($datos);
        return redirect('/panel_categoria_productos'.'/'.$idEmpresa)->with('success','INFORMACIÓN ACTUALIZADA');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id, $idEmpresa)
    {
        CategoriasProducto::destroy($id);
        return redirect('/panel_categoria_productos'.'/'.$idEmpresa)->with('danger','ELMINADO CON ÉXITO');
    }
}
