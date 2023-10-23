<?php

namespace App\Http\Controllers;

use App\Models\TipoPedido;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class TipoPedidoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index($idEmpresa)
    {
        $datos = TipoPedido::all();

        if (auth()->check()) {
            // La sesión está activa
            return view('panel_tipo_pedido.index', compact('datos','idEmpresa'));
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
            'tipo_pedido' => 'required',
        ]);

        $datos = $request->except('_token');
        TipoPedido::insert($datos);
        return redirect('/panel_tipo_pedido'.'/'.$idEmpresa)->with('success', 'Creado con Exito');
    }

    /**
     * Display the specified resource.
     */
    public function show(TipoPedido $tipoPedido)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id, $idEmpresa)
    {
        $datos = TipoPedido::find($id);

        if (auth()->check()) {
            // La sesión está activa
            return view('panel_tipo_pedido.edit', compact('datos','idEmpresa'));
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
            'tipo_pedido' => 'required',
        ]);

        $datos = $request->except('_token','_method');
        TipoPedido::where('id','=',$id)->update($datos);
        return redirect('/panel_tipo_pedido'.'/'.$idEmpresa)->with('success','INFORMACIÓN ACTUALIZADA');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id, $idEmpresa)
    {
        TipoPedido::destroy($id);
        return redirect('/panel_tipo_pedido'.'/'.$idEmpresa)->with('danger','ELMINADO CON ÉXITO');
    }
}
