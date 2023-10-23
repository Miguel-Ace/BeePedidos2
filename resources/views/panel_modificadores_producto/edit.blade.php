@extends('layout.panel')

@section('titulo-crear')
    Crear Modificador Producto
@endsection

@section('formulario')
<form class="form" action="{{url('/panel_modificadores_producto'.'/'.$datos->id.'/'.$idEmpresa)}}" method="post" novalidate>
    @csrf
    {{method_field('PATCH')}}
    <div class="content-campo">
        <div class="select">
            <label for="id_producto">Producto</label>
            <select name="id_producto" id="id_producto">
                @foreach ($productos as $producto)
                    @if ($datos->id_producto == $producto->id)
                        <option value="{{$producto->id}}" selected>{{$producto->producto}}</option>
                    @else
                        <option value="{{$producto->id}}">{{$producto->producto}}</option>
                    @endif
                @endforeach
            </select>
            @error('id_producto')
                <p class="text-error">{{$message}}</p>
            @enderror
        </div>

        <div class="campo">
            <label for="modificador" class="form-label">Modificador</label>
            <input type="text" class="modificador" id="modificador" name="modificador" value="{{$datos->modificador}}">
            @error('modificador')
                <p class="text-error">{{$message}}</p>
            @enderror
        </div>

        {{-- <div class="campo">
            <label for="modificador2" class="form-label">Modificador3</label>
            <input type="text" class="modificador2" id="modificador2" name="modificador2" value="{{$datos->modificador2}}">
            @error('modificador2')
                <p class="text-error">{{$message}}</p>
            @enderror
        </div>

        <div class="campo">
            <label for="modificador3" class="form-label">Modificador3</label>
            <input type="text" class="modificador3" id="modificador3" name="modificador3" value="{{$datos->modificador3}}">
            @error('modificador3')
                <p class="text-error">{{$message}}</p>
            @enderror
        </div> --}}
    </div>
    <button type="submit" class="btn-enviar">Guardar</button>
</form>
@endsection
