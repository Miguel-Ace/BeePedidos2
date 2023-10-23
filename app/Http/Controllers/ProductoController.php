<?php

namespace App\Http\Controllers;

use App\Models\Producto;
use App\Http\Controllers\Controller;
use App\Models\CategoriasProducto;
use App\Models\Empresa;
use Illuminate\Http\Request;

class ProductoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index($idEmpresa)
    {
        $datos = Producto::all();
        $empresas = Empresa::all();
        $categorias = CategoriasProducto::all();

        if (auth()->check()) {
            // La sesión está activa
            return view('panel_productos.index', compact('datos','empresas','categorias','idEmpresa'));
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
            'producto' => 'required',
            'descripcion' => 'required',
            'precio' => 'required',
            // 'descuento' => 'required',
            'id_empresa' => 'required',
            'id_categoria' => 'required',
            'url_imagen' => 'required',
        ]);

        $datos = $request->except('_token');
        Producto::insert($datos);
        return redirect('/panel_productos'.'/'.$idEmpresa)->with('success', 'Creado con Exito');
    }

    /**
     * Display the specified resource.
     */
    public function show(Producto $producto)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id, $idEmpresa)
    {
        $datos = Producto::find($id);
        $empresas = Empresa::all();
        $categorias = CategoriasProducto::all();

        if (auth()->check()) {
            // La sesión está activa
            return view('panel_productos.edit', compact('datos','empresas','categorias','idEmpresa'));
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
            'producto' => 'required',
            'descripcion' => 'required',
            'precio' => 'required',
            // 'descuento' => 'required',
            'id_empresa' => 'required',
            'id_categoria' => 'required',
            'url_imagen' => 'required',
        ]);

        $datos = $request->except('_token','_method');
        Producto::where('id','=',$id)->update($datos);
        return redirect('/panel_productos'.'/'.$idEmpresa)->with('success','INFORMACIÓN ACTUALIZADA');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id, $idEmpresa)
    {
        Producto::destroy($id);
        return redirect('/panel_productos'.'/'.$idEmpresa)->with('danger','ELMINADO CON ÉXITO');
    }
}
