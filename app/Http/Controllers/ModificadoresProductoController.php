<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Producto;
use App\Http\Controllers\Controller;
use App\Models\ModificadoresProducto;

class ModificadoresProductoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index($idEmpresa)
    {
        $datos = ModificadoresProducto::all();
        $productos = Producto::all();

        if (auth()->check()) {
            // La sesión está activa
            return view('panel_modificadores_producto.index', compact('datos','productos','idEmpresa'));
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
            'id_producto' => 'required',
            'modificador' => 'required',
        ]);

        $datos = $request->except('_token');
        ModificadoresProducto::insert($datos);
        return redirect('/panel_modificadores_producto'.'/'.$idEmpresa)->with('success', 'Creado con Exito');
    }

    /**
     * Display the specified resource.
     */
    public function show(ModificadoresProducto $modificadoresProducto)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id, $idEmpresa)
    {
        $datos = ModificadoresProducto::find($id);
        $productos = Producto::all();

        if (auth()->check()) {
            // La sesión está activa
            return view('panel_modificadores_producto.edit', compact('datos','productos','idEmpresa'));
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
            'id_producto' => 'required',
            'modificador' => 'required',
        ]);

        $datos = $request->except('_token','_method');
        ModificadoresProducto::where('id','=',$id)->update($datos);
        return redirect('/panel_modificadores_producto'.'/'.$idEmpresa)->with('success','INFORMACIÓN ACTUALIZADA');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id, $idEmpresa)
    {
        ModificadoresProducto::destroy($id);
        return redirect('/panel_modificadores_producto'.'/'.$idEmpresa)->with('danger','ELMINADO CON ÉXITO');
    }
}
