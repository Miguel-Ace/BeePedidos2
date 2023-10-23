<?php

namespace App\Http\Controllers;

use App\Models\Pedido;
use App\Http\Controllers\Controller;
use App\Models\Cliente;
use App\Models\Empresa;
use App\Models\Estado;
use App\Models\TipoEntrega;
use App\Models\TipoPago;
use App\Models\TipoPedido;
use Illuminate\Http\Request;

class PedidoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index($idEmpresa)
    {
        $datos = Pedido::all();
        $empresas = Empresa::all();
        $clientes = Cliente::all();
        $tipoPagos = TipoPago::all();
        $tipoPedidos = TipoPedido::all();
        $tipoEntregas = TipoEntrega::all();
        $estados = Estado::all();

        if (auth()->check()) {
            // La sesión está activa
            return view('panel_pedidos.index', compact('datos','empresas','clientes','tipoPagos','tipoPedidos','tipoEntregas','estados','idEmpresa'));
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
            'fecha_hora' => 'required',
            'id_empresa' => 'required',
            'id_cliente' => 'required',
            'sub_total' => 'required',
            'descuento' => 'required',
            'iva' => 'required',
            'propina' => 'required',
            'id_tipo_pago' => 'required',
            'factura_electronica' => 'required',
            'id_tipo_pedido' => 'required',
            'id_tipo_entrega' => 'required',
            'adjuntar_imagen' => 'required',
            'id_estado' => 'required',
            'direccion' => 'required',
        ]);

        $datos = $request->except('_token');
        Pedido::insert($datos);
        return redirect('/panel_pedidos'.'/'.$idEmpresa)->with('success', 'Creado con Exito');
    }

    /**
     * Display the specified resource.
     */
    public function show(Pedido $pedido)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id, $idEmpresa)
    {
        $datos = Pedido::find($id);
        $empresas = Empresa::all();
        $clientes = Cliente::all();
        $tipoPagos = TipoPago::all();
        $tipoPedidos = TipoPedido::all();
        $tipoEntregas = TipoEntrega::all();
        $estados = Estado::all();

        if (auth()->check()) {
            // La sesión está activa
            return view('panel_pedidos.edit', compact('datos','empresas','clientes','tipoPagos','tipoPedidos','tipoEntregas','estados','idEmpresa'));
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
            'fecha_hora' => 'required',
            'id_empresa' => 'required',
            'id_cliente' => 'required',
            'sub_total' => 'required',
            'descuento' => 'required',
            'iva' => 'required',
            'propina' => 'required',
            'id_tipo_pago' => 'required',
            'factura_electronica' => 'required',
            'id_tipo_pedido' => 'required',
            'id_tipo_entrega' => 'required',
            'adjuntar_imagen' => 'required',
            'id_estado' => 'required',
        ]);

        $datos = $request->except('_token','_method');
        Pedido::where('id','=',$id)->update($datos);
        return redirect('/panel_pedidos'.'/'.$idEmpresa)->with('success','INFORMACIÓN ACTUALIZADA');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id, $idEmpresa)
    {
        Pedido::destroy($id);
        return redirect('/panel_pedidos'.'/'.$idEmpresa)->with('danger','ELMINADO CON ÉXITO');
    }
}
