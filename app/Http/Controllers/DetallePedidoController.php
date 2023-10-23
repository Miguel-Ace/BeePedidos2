<?php

namespace App\Http\Controllers;

use App\Models\DetallePedido;
use App\Http\Controllers\Controller;
use App\Models\ModificadoresProducto;
use App\Models\Producto;
use Illuminate\Http\Request;

class DetallePedidoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index($idEmpresa)
    {
        $datos = DetallePedido::all();
        $productos = Producto::all();
        $modificadoresproductos = ModificadoresProducto::all();

        if (auth()->check()) {
            // La sesión está activa
            return view('panel_detalle_pedidos.index', compact('datos','productos','modificadoresproductos','idEmpresa'));
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
            'num_pedido' => 'required',
            'id_producto' => 'required',
            'cantidad' => 'required',
            'precio' => 'required',
            // 'descuento' => 'required',
            'iva' => 'required',
            'enviada_beesy' => 'required',
            // 'id_modificador1' => 'required',
            // 'id_modificador2' => 'required',
            // 'id_modificador3' => 'required',
        ]);

        $datos = $request->except('_token');
        DetallePedido::insert($datos);
        return redirect('/panel_detalle_pedidos'.'/'.$idEmpresa)->with('success', 'Creado con Exito');
    }

    /**
     * Display the specified resource.
     */
    public function show(DetallePedido $detallePedido)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id, $idEmpresa)
    {
        $datos = DetallePedido::find($id);
        $productos = Producto::all();
        $modificadoresproductos = ModificadoresProducto::all();

        if (auth()->check()) {
            // La sesión está activa
            return view('panel_detalle_pedidos.edit', compact('datos','productos','modificadoresproductos','idEmpresa'));
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
            'num_pedido' => 'required',
            'id_producto' => 'required',
            'cantidad' => 'required',
            'precio' => 'required',
            // 'descuento' => 'required',
            'iva' => 'required',
            'enviada_beesy' => 'required',
            // 'id_modificador1' => 'required',
            // 'id_modificador2' => 'required',
            // 'id_modificador3' => 'required',
        ]);

        $datos = $request->except('_token','_method');
        DetallePedido::where('id','=',$id)->update($datos);
        return redirect('/panel_detalle_pedidos'.'/'.$idEmpresa)->with('success','INFORMACIÓN ACTUALIZADA');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id, $idEmpresa)
    {
        DetallePedido::destroy($id);
        return redirect('/panel_detalle_pedidos'.'/'.$idEmpresa)->with('danger','ELMINADO CON ÉXITO');
    }
}
