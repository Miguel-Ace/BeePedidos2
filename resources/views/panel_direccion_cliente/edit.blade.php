@extends('layout.panel')

@section('titulo-crear')
    Crear Dirección Cliente
@endsection

@section('formulario')
<form class="form" action="{{url('/panel_direccion_cliente'.'/'.$datos->id.'/'.$idEmpresa)}}" method="post" novalidate>
    @csrf
    <div class="content-campo">
        <div class="select">
            <label for="id_cliente">Cliente</label>
            <select name="id_cliente" id="id_cliente">
                @foreach ($clientes as $cliente)
                    @if ($datos->id_cliente == $cliente->id)
                        <option value="{{$cliente->id}}" selected>{{$cliente->name}}</option>
                    @else
                        <option value="{{$cliente->id}}">{{$cliente->name}}</option>
                    @endif
                @endforeach
            </select>
            @error('id_cliente')
                <p class="text-error">{{$message}}</p>
            @enderror
        </div>

        <div class="campo">
            <label for="direccion" class="form-label">Dirección</label>
            <input type="text" class="producto" id="direccion" name="direccion" value="{{$datos->direccion}}">
            @error('direccion')
                <p class="text-error">{{$message}}</p>
            @enderror
        </div>

        <div class="campo">
            <label for="coordenadas" class="form-label">Coordenadas</label>
            <input type="text" class="coordenadas" id="coordenadas" name="coordenadas" value="{{$datos->coordenadas}}">
            @error('coordenadas')
                <p class="text-error">{{$message}}</p>
            @enderror
        </div>

        <div class="campo">
            <label for="favorita" class="form-label">Favorita</label>
            <input type="text" class="favorita" id="favorita" name="favorita" value="{{$datos->favorita}}">
            @error('favorita')
                <p class="text-error">{{$message}}</p>
            @enderror
        </div>
    </div>

    <button type="submit" class="btn-enviar">Guardar</button>
</form>
@endsection
