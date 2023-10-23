@extends('layout.panel')

@section('titulo-crear')
    Crear Detalle Pedido
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

<form class="form" action="{{url('/panel_detalle_pedidos'.'/'.$idEmpresa)}}" method="post" novalidate>
    @csrf
    <div class="content-campo">
        <div class="campo">
            <label for="num_pedido" class="form-label">Num-Pedido</label>
            <input type="number" class="num_pedido" id="num_pedido" name="num_pedido" value="{{old('num_pedido')}}">
            @error('num_pedido')
                <p class="text-error">{{$message}}</p>
            @enderror
        </div>

        <div class="select">
            <label for="id_producto">Producto</label>
            <select name="id_producto" id="id_producto">
                <option value="" disabled selected>Seleccione Producto</option>
                @foreach ($productos as $producto)
                    <option {{ old('id_producto') == $producto->producto ? 'selected' : '' }} value="{{$producto->producto}}">{{$producto->producto}}</option>
                @endforeach
            </select>
            @error('id_producto')
                <p class="text-error">{{$message}}</p>
            @enderror
        </div>

        <div class="campo">
            <label for="cantidad" class="form-label">Cantidad</label>
            <input type="number" class="cantidad" id="cantidad" name="cantidad" value="{{old('cantidad')}}">
            @error('cantidad')
                <p class="text-error">{{$message}}</p>
            @enderror
        </div>

        <div class="campo">
            <label for="precio" class="form-label">Precio</label>
            <input type="number" class="precio" id="precio" name="precio" value="{{old('precio')}}">
            @error('precio')
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

        <div class="select">
            <label for="enviada_beesy">Enviada-beesy</label>
            <select name="enviada_beesy" id="enviada_beesy">
                <option value="No">No</option>
                <option value="Si">Si</option>
            </select>
            @error('enviada_beesy')
                <p class="text-error">{{$message}}</p>
            @enderror
        </div>

        <div class="select">
            <label for="id_modificador1">Modificador1</label>
            <select name="id_modificador1" id="id_modificador1">
                <option value="" disabled selected>Seleccione Categoria</option>
                @foreach ($modificadoresproductos as $modificadoresproducto)
                    <option {{ old('id_modificador1') == $modificadoresproducto->modificador ? 'selected' : '' }} value="{{$modificadoresproducto->modificador}}">{{$modificadoresproducto->modificador}}</option>
                @endforeach
            </select>
            @error('id_modificador1')
                <p class="text-error">{{$message}}</p>
            @enderror
        </div>

        <div class="select">
            <label for="id_modificador2">Modificador2</label>
            <select name="id_modificador2" id="id_modificador2">
                <option value="" disabled selected>Seleccione Categoria</option>
                @foreach ($modificadoresproductos as $modificadoresproducto)
                    <option {{ old('id_modificador2') == $modificadoresproducto->modificador ? 'selected' : '' }} value="{{$modificadoresproducto->modificador}}">{{$modificadoresproducto->modificador}}</option>
                @endforeach
            </select>
            @error('id_modificador2')
                <p class="text-error">{{$message}}</p>
            @enderror
        </div>

        <div class="select">
            <label for="id_modificador3">Modificador3</label>
            <select name="id_modificador3" id="id_modificador3">
                <option value="" disabled selected>Seleccione Categoria</option>
                @foreach ($modificadoresproductos as $modificadoresproducto)
                    <option {{ old('id_modificador3') == $modificadoresproducto->modificador ? 'selected' : '' }} value="{{$modificadoresproducto->modificador}}">{{$modificadoresproducto->modificador}}</option>
                @endforeach
            </select>
            @error('id_modificador3')
                <p class="text-error">{{$message}}</p>
            @enderror
        </div>
    </div>

    <button type="submit" class="btn-enviar">Guardar</button>
</form>
@endsection

@section('titulo-tabla')
    Lista Detalle Pedido
@endsection

@section('tabla')
    <thead>
        <tr>
            {{-- <th>#</th> --}}
            <th>Num-Pedido</th>
            <th>Producto</th>
            <th>Cantidad</th>
            <th>Precio</th>
            <th>Descuento</th>
            <th>IVA</th>
            <th>Enviada-beesy</th>
            <th>Modificador1</th>
            <th>Modificador2</th>
            <th>Modificador3</th>
            <th>Acciones</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($datos as $dato)
            <tr>
                {{-- <td>$dato->id</td> --}}
                <td>{{$dato->num_pedido}}</td>
                <td>{{$dato->id_producto}}</td>
                <td>{{$dato->cantidad}}</td>
                <td>{{$dato->precio}}</td>
                <td>{{$dato->descuento}}</td>
                <td>{{$dato->iva}}</td>
                <td>{{$dato->enviada_beesy}}</td>
                <td>{{$dato->id_modificador1}}</td>
                <td>{{$dato->id_modificador2}}</td>
                <td>{{$dato->id_modificador3}}</td>
                <td class="btn-acciones">
                    {{-- <a href="{{url('user_cliente?buscar='.$dato->id)}}" class="show"><ion-icon name="add-outline"></ion-icon></a> --}}

                    <a href="{{url('panel_detalle_pedidos/'.$dato->id.'/edit'.'/'.$idEmpresa)}}" class="edit"><ion-icon name="pencil-outline"></ion-icon></a>

                    <form action="{{url('panel_detalle_pedidos/'.$dato->id.'/'.$idEmpresa)}}" method="POST" class="delete">
                        @csrf
                        {{method_field('DELETE')}}
                        <button type="submit"><ion-icon name="beaker-outline"></ion-icon></button>
                    </form>
                </td>
            </tr>
        @endforeach
    </tbody>
@endsection
