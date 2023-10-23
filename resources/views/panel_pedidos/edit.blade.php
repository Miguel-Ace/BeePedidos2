@extends('layout.panel')

@section('titulo-crear')
    Crear Pedido
@endsection

@section('formulario')
<form class="form" action="{{url('/panel_pedidos'.'/'.$datos->id.'/'.$idEmpresa)}}" method="post" novalidate>
    @csrf
    {{method_field('PATCH')}}
    <div class="content-campo">
        <div class="campo">
            <label for="num_pedido" class="form-label">Num-Pedido</label>
            <input type="number" class="num_pedido" id="num_pedido" name="num_pedido" value="{{$datos->num_pedido}}">
            @error('num_pedido')
                <p class="text-error">{{$message}}</p>
            @enderror
        </div>

        <div class="campo">
            <label for="fecha_hora" class="form-label">Fecha y Hora</label>
            <input type="datetime" class="fecha_hora" id="fecha_hora" name="fecha_hora" value="{{$datos->fecha_hora}}">
            @error('fecha_hora')
                <p class="text-error">{{$message}}</p>
            @enderror
        </div>

        <div class="select">
            <label for="id_empresa">Empresa</label>
            <select name="id_empresa" id="id_empresa">
                @foreach ($empresas as $empresa)
                    @if ($datos->id_empresa == $empresa->empresa)
                        <option value="{{$empresa->empresa}}" selected>{{$empresa->empresa}}</option>
                    @else
                        <option value="{{$empresa->empresa}}">{{$empresa->empresa}}</option>
                    @endif
                @endforeach
            </select>
            @error('id_empresa')
                <p class="text-error">{{$message}}</p>
            @enderror
        </div>

        <div class="select">
            <label for="id_cliente">Cliente</label>
            <select name="id_cliente" id="id_cliente">
                @foreach ($clientes as $cliente)
                    @if ($datos->id_cliente == $cliente->nombre)
                        <option value="{{$cliente->nombre}}" selected>{{$cliente->nombre}}</option>
                    @else
                        <option value="{{$cliente->nombre}}">{{$cliente->nombre}}</option>
                    @endif
                @endforeach
            </select>
            @error('id_cliente')
                <p class="text-error">{{$message}}</p>
            @enderror
        </div>

        <div class="campo">
            <label for="sub_total" class="form-label">Sub-total</label>
            <input type="number" class="sub_total" id="sub_total" name="sub_total" value="{{$datos->sub_total}}">
            @error('sub_total')
                <p class="text-error">{{$message}}</p>
            @enderror
        </div>

        <div class="campo">
            <label for="descuento" class="form-label">Descuento</label>
            <input type="number" class="descuento" id="descuento" name="descuento" value="{{$datos->descuento}}">
            @error('descuento')
                <p class="text-error">{{$message}}</p>
            @enderror
        </div>

        <div class="campo">
            <label for="iva" class="form-label">IVA</label>
            <input type="number" class="iva" id="iva" name="iva" value="{{$datos->iva}}">
            @error('iva')
                <p class="text-error">{{$message}}</p>
            @enderror
        </div>

        <div class="campo">
            <label for="propina" class="form-label">Propina</label>
            <input type="number" class="propina" id="propina" name="propina" value="{{$datos->propina}}">
            @error('propina')
                <p class="text-error">{{$message}}</p>
            @enderror
        </div>

        <div class="select">
            <label for="id_tipo_pago">Tipo Pago</label>
            <select name="id_tipo_pago" id="id_tipo_pago">
                @foreach ($tipoPagos as $tipoPago)
                    @if ($datos->id_tipo_pago == $tipoPago->tipo_pago)
                        <option value="{{$tipoPago->tipo_pago}}" selected>{{$tipoPago->tipo_pago}}</option>
                    @else
                        <option value="{{$tipoPago->tipo_pago}}">{{$tipoPago->tipo_pago}}</option>
                    @endif
                @endforeach
            </select>
            @error('id_tipo_pago')
                <p class="text-error">{{$message}}</p>
            @enderror
        </div>

        <div class="select">
            <label for="factura_electronica">Factura Electronica</label>
            <select name="factura_electronica" id="factura_electronica">
                <option value="No">No</option>
                <option value="Si">Si</option>
            </select>
            @error('factura_electronica')
                <p class="text-error">{{$message}}</p>
            @enderror
        </div>

        <div class="select">
            <label for="id_tipo_pedido">Tipo Pedido</label>
            <select name="id_tipo_pedido" id="id_tipo_pedido">
                @foreach ($tipoPedidos as $tipoPedido)
                    @if ($datos->id_tipo_pedido == $tipoPedido->tipo_pedido)
                        <option value="{{$tipoPedido->tipo_pedido}}" selected>{{$tipoPedido->tipo_pedido}}</option>
                    @else
                        <option value="{{$tipoPedido->tipo_pedido}}">{{$tipoPedido->tipo_pedido}}</option>
                    @endif
                @endforeach
            </select>
            @error('id_tipo_pedido')
                <p class="text-error">{{$message}}</p>
            @enderror
        </div>

        <div class="select">
            <label for="id_tipo_entrega">Tipo Entrega</label>
            <select name="id_tipo_entrega" id="id_tipo_entrega">
                @foreach ($tipoEntregas as $tipoEntrega)
                    @if ($datos->id_tipo_entrega == $tipoEntrega->tipo_entrega)
                        <option value="{{$tipoEntrega->tipo_entrega}}" selected>{{$tipoEntrega->tipo_entrega}}</option>
                    @else
                        <option value="{{$tipoEntrega->tipo_entrega}}">{{$tipoEntrega->tipo_entrega}}</option>
                    @endif
                @endforeach
            </select>
            @error('id_tipo_entrega')
                <p class="text-error">{{$message}}</p>
            @enderror
        </div>

        <div class="campo">
            <label for="adjuntar_imagen">Adjuntar Imagen</label>
            <input type="file" class="adjuntar_imagen" id="adjuntar_imagen" name="adjuntar_imagen" value="{{$datos->adjuntar_imagen}}">
            @error('adjuntar_imagen')
                <p class="text-error">{{$message}}</p>
            @enderror
        </div>

        <div class="select">
            <label for="id_estado">Estado</label>
            <select name="id_estado" id="id_estado">
                @foreach ($estados as $estado)
                    @if ($datos->id_estado == $estado->estado)
                        <option value="{{$estado->estado}}" selected>{{$estado->estado}}</option>
                    @else
                        <option value="{{$estado->estado}}">{{$estado->estado}}</option>
                    @endif
                @endforeach
            </select>
            @error('id_estado')
                <p class="text-error">{{$message}}</p>
            @enderror
        </div>
    </div>

    <button type="submit" class="btn-enviar">Guardar</button>
</form>
@endsection
