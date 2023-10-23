<?php

namespace App\Http\Controllers;

use App\Models\TipoPago;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class TipoPagoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index($idEmpresa)
    {
        $datos = TipoPago::all();

        if (auth()->check()) {
            // La sesión está activa
            return view('panel_tipo_pago.index', compact('datos','idEmpresa'));
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
            'tipo_pago' => 'required',
        ]);

        $datos = $request->except('_token');
        TipoPago::insert($datos);
        return redirect('/panel_tipo_pago'.'/'.$idEmpresa)->with('success', 'Creado con Exito');
    }

    /**
     * Display the specified resource.
     */
    public function show(TipoPago $tipoPago)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id, $idEmpresa)
    {
        $datos = TipoPago::find($id);

        if (auth()->check()) {
            // La sesión está activa
            return view('panel_tipo_pago.edit', compact('datos','idEmpresa'));
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
            'tipo_pago' => 'required',
        ]);

        $datos = $request->except('_token','_method');
        TipoPago::where('id','=',$id)->update($datos);
        return redirect('/panel_tipo_pago'.'/'.$idEmpresa)->with('success','INFORMACIÓN ACTUALIZADA');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id, $idEmpresa)
    {
        TipoPago::destroy($id);
        return redirect('/panel_tipo_pago'.'/'.$idEmpresa)->with('danger','ELMINADO CON ÉXITO');
    }
}
