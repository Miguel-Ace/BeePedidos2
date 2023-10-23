@extends('layout.panel')

@section('titulo-crear')
    Crear Pedido
@endsection

@section('formulario')

@if (session('success'))
    <div>
        <p style="background: rgb(64, 129, 64); color: white;text-align: center">{{session('success')}}</p>
    </div>
@endif

@if (session('danger'))
    <div>
        <p style="background: rgb(243, 61, 37); color: white;text-align: center">{{session('danger')}}</p>
    </div>
@endif

<form class="form" action="{{url('/panel_pedidos'.'/'.$idEmpresa)}}" method="post" novalidate>
    @csrf
    <div class="content-campo">
        <div class="campo">
            <label for="num_pedido" class="form-label">Num-Pedido</label>
            <input type="number" class="num_pedido" id="num_pedido" name="num_pedido" value="{{old('num_pedido')}}">
            @error('num_pedido')
                <p class="text-error">{{$message}}</p>
            @enderror
        </div>

        <div class="campo">
            <label for="fecha_hora" class="form-label">Fecha y Hora</label>
            <input type="datetime" class="fecha_hora" id="fecha_hora" name="fecha_hora" value="{{old('fecha_hora')}}">
            @error('fecha_hora')
                <p class="text-error">{{$message}}</p>
            @enderror
        </div>

        <div class="select">
            <label for="id_empresa">Empresa</label>
            <select name="id_empresa" id="id_empresa">
                <option value="" disabled selected>Seleccione Empresa</option>
                @foreach ($empresas as $empresa)
                    <option value="{{$empresa->empresa}}">{{$empresa->empresa}}</option>
                @endforeach
            </select>
            @error('id_empresa')
                <p class="text-error">{{$message}}</p>
            @enderror
        </div>

        <div class="select">
            <label for="id_cliente">Cliente</label>
            <select name="id_cliente" id="id_cliente">
                <option value="" disabled selected>Seleccione Cliente</option>
                @foreach ($clientes as $cliente)
                    <option value="{{$cliente->nombre}}">{{$cliente->nombre}}</option>
                @endforeach
            </select>
            @error('id_cliente')
                <p class="text-error">{{$message}}</p>
            @enderror
        </div>

        <div class="campo">
            <label for="sub_total" class="form-label">Sub-total</label>
            <input type="number" class="sub_total" id="sub_total" name="sub_total" value="{{old('sub_total')}}">
            @error('sub_total')
                <p class="text-error">{{$message}}</p>
            @enderror
        </div>

        <div class="campo">
            <label for="descuento" class="form-label">Descuento</label>
            <input type="number" class="descuento" id="descuento" name="descuento" value="{{old('descuento')}}">
            @error('descuento')
                <p class="text-error">{{$message}}</p>
            @enderror
        </div>

        <div class="campo">
            <label for="iva" class="form-label">IVA</label>
            <input type="number" class="iva" id="iva" name="iva" value="{{old('iva')}}">
            @error('iva')
                <p class="text-error">{{$message}}</p>
            @enderror
        </div>

        <div class="campo">
            <label for="propina" class="form-label">Propina</label>
            <input type="number" class="propina" id="propina" name="propina" value="{{old('propina')}}">
            @error('propina')
                <p class="text-error">{{$message}}</p>
            @enderror
        </div>

        <div class="select">
            <label for="id_tipo_pago">Tipo Pago</label>
            <select name="id_tipo_pago" id="id_tipo_pago">
                <option value="" disabled selected>Seleccione Pago</option>
                @foreach ($tipoPagos as $tipoPago)
                    <option value="{{$tipoPago->tipo_pago}}">{{$tipoPago->tipo_pago}}</option>
                @endforeach
            </select>
            @error('id_tipo_pago')
                <p class="text-error">{{$message}}</p>
            @enderror
        </div>

        <div class="select">
            <label for="factura_electronica">Factura Electronica</label>
            <select name="factura_electronica" id="factura_electronica">
                <option {{ old('factura_electronica') == 'No' ? 'selected' : '' }} value="No">No</option>
                <option {{ old('factura_electronica') == 'Si' ? 'selected' : '' }} value="Si">Si</option>
            </select>
            @error('factura_electronica')
                <p class="text-error">{{$message}}</p>
            @enderror
        </div>

        <div class="select">
            <label for="id_tipo_pedido">Tipo Pedido</label>
            <select name="id_tipo_pedido" id="id_tipo_pedido">
                <option value="" disabled selected>Seleccione Pedido</option>
                @foreach ($tipoPedidos as $tipoPedido)
                    <option value="{{$tipoPedido->tipo_pedido}}">{{$tipoPedido->tipo_pedido}}</option>
                @endforeach
            </select>
            @error('id_tipo_pedido')
                <p class="text-error">{{$message}}</p>
            @enderror
        </div>

        <div class="select">
            <label for="id_tipo_entrega">Tipo Entrega</label>
            <select name="id_tipo_entrega" id="id_tipo_entrega">
                <option value="" disabled selected>Seleccione Entrega</option>
                @foreach ($tipoEntregas as $tipoEntrega)
                    <option value="{{$tipoEntrega->tipo_entrega}}">{{$tipoEntrega->tipo_entrega}}</option>
                @endforeach
            </select>
            @error('id_tipo_entrega')
                <p class="text-error">{{$message}}</p>
            @enderror
        </div>

        <div class="campo">
            <label for="adjuntar_imagen">Adjuntar Imagen</label>
            <input type="file" class="adjuntar_imagen" id="adjuntar_imagen" name="adjuntar_imagen" value="{{old('adjuntar_imagen')}}">
            @error('adjuntar_imagen')
                <p class="text-error">{{$message}}</p>
            @enderror
        </div>

        <div class="select">
            <label for="id_estado">Estado</label>
            <select name="id_estado" id="id_estado">
                <option value="" disabled selected>Seleccione Entrega</option>
                @foreach ($estados as $estado)
                    <option value="{{$estado->estado}}">{{$estado->estado}}</option>
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

@section('titulo-tabla')
    Lista de Pedidos
@endsection

@section('tabla')
    <thead>
        <tr>
            {{-- <th>#</th> --}}
            <th>Num-Pedido</th>
            <th>Fecha y Hora</th>
            <th>Empresa</th>
            <th>Cliente</th>
            <th>Sub-total</th>
            <th>Descuento</th>
            <th>IVA</th>
            <th>Propina</th>
            <th>Tipo Pago</th>
            <th>Factura Electronica</th>
            <th>Tipo Pedido</th>
            <th>Tipo Entrega</th>
            <th>Imagen</th>
            <th>Estado</th>
            <th>Acciones</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($datos as $dato)
            <tr>
                {{-- <td>$dato->id</td> --}}
                <td>{{$dato->num_pedido}}</td>
                <td>{{$dato->fecha_hora}}</td>
                <td>{{$dato->id_empresa}}</td>
                <td>{{$dato->id_cliente}}</td>
                <td>{{$dato->sub_total}}</td>
                <td>{{$dato->descuento}}</td>
                <td>{{$dato->iva}}</td>
                <td>{{$dato->propina}}</td>
                <td>{{$dato->id_tipo_pago}}</td>
                <td>{{$dato->factura_electronica}}</td>
                <td>{{$dato->id_tipo_pedido}}</td>
                <td>{{$dato->id_tipo_entrega}}</td>
                <td>{{$dato->adjuntar_imagen}}</td>
                <td>{{$dato->id_estado}}</td>
                <td class="btn-acciones">
                    {{-- <a href="{{url('user_cliente?buscar='.$dato->id)}}" class="show"><ion-icon name="add-outline"></ion-icon></a> --}}

                    <a href="{{url('panel_pedidos/'.$dato->id.'/edit'.'/'.$idEmpresa)}}" class="edit"><ion-icon name="pencil-outline"></ion-icon></a>

                    <form action="{{url('panel_pedidos/'.$dato->id.'/'.$idEmpresa)}}" method="POST" class="delete">
                        @csrf
                        {{method_field('DELETE')}}
                        <button type="submit"><ion-icon name="beaker-outline"></ion-icon></button>
                    </form>
                </td>
            </tr>
        @endforeach
    </tbody>
@endsection
