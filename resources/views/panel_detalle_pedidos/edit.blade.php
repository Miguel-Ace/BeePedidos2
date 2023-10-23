@extends('layout.panel')

@section('titulo-crear')
    Crear Detalle Pedido
@endsection

@section('formulario')
<form class="form" action="{{url('/panel_detalle_pedidos'.'/'.$datos->id.'/'.$idEmpresa)}}" method="post" novalidate>
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

        <div class="select">
            <label for="id_producto">Producto</label>
            <select name="id_producto" id="id_producto">
                <option value="">Seleccione Producto</option>
                @foreach ($productos as $producto)
                    @if ($datos->id_producto == $producto->producto)
                        <option value="{{$producto->producto}}">{{$producto->producto}}</option>
                    @else
                        <option value="{{$producto->producto}}">{{$producto->producto}}</option>
                    @endif
                @endforeach
            </select>
            @error('id_producto')
                <p class="text-error">{{$message}}</p>
            @enderror
        </div>

        <div class="campo">
            <label for="cantidad" class="form-label">Cantidad</label>
            <input type="number" class="cantidad" id="cantidad" name="cantidad" value="{{$datos->cantidad}}">
            @error('cantidad')
                <p class="text-error">{{$message}}</p>
            @enderror
        </div>

        <div class="campo">
            <label for="precio" class="form-label">Precio</label>
            <input type="number" class="precio" id="precio" name="precio" value="{{$datos->precio}}">
            @error('precio')
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

        <div class="select">
            <label for="enviada_beesy">Enviada-beesy</label>
            <select name="enviada_beesy" id="enviada_beesy">
                @if ($datos->enviada_beesy == 'No')
                    <option value="No" selected>No</option>
                    <option value="Si">Si</option>
                @else
                    <option value="No">No</option>
                    <option value="Si" selected>Si</option>
                @endif
            </select>
            @error('enviada_beesy')
                <p class="text-error">{{$message}}</p>
            @enderror
        </div>

        <div class="select">
            <label for="id_modificador1">Modificador1</label>
            <select name="id_modificador1" id="id_modificador1">
                <option value="">Seleccione Categoria</option>
                @foreach ($modificadoresproductos as $modificadoresproducto)
                    @if ($datos->id_modificador1 == $modificadoresproducto->modificador)
                        <option value="{{$modificadoresproducto->modificador}}" selected>{{$modificadoresproducto->modificador}}</option>
                    @else
                        <option value="{{$modificadoresproducto->modificador}}">{{$modificadoresproducto->modificador}}</option>
                    @endif
                @endforeach
            </select>
            @error('id_modificador1')
                <p class="text-error">{{$message}}</p>
            @enderror
        </div>

        <div class="select">
            <label for="id_modificador2">Modificador2</label>
            <select name="id_modificador2" id="id_modificador2">
                <option value="">Seleccione Categoria</option>
                @foreach ($modificadoresproductos as $modificadoresproducto)
                    @if ($datos->id_modificador2 == $modificadoresproducto->modificador)
                        <option value="{{$modificadoresproducto->modificador}}" selected>{{$modificadoresproducto->modificador}}</option>
                    @else
                        <option value="{{$modificadoresproducto->modificador}}">{{$modificadoresproducto->modificador}}</option>
                    @endif
                @endforeach
            </select>
            @error('id_modificador2')
                <p class="text-error">{{$message}}</p>
            @enderror
        </div>

        <div class="select">
            <label for="id_modificador3">Modificador3</label>
            <select name="id_modificador3" id="id_modificador3">
                <option value="">Seleccione Categoria</option>
                @foreach ($modificadoresproductos as $modificadoresproducto)
                    @if ($datos->id_modificador3 == $modificadoresproducto->modificador)
                        <option value="{{$modificadoresproducto->modificador}}" selected>{{$modificadoresproducto->modificador}}</option>
                    @else
                        <option value="{{$modificadoresproducto->modificador}}">{{$modificadoresproducto->modificador}}</option>
                    @endif
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
