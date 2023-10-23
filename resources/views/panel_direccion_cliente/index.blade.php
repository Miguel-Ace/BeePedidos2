@extends('layout.panel')

@section('titulo-crear')
    Crear Dirección Cliente
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

<form class="form" action="{{url('/panel_direccion_cliente'.'/'.$idEmpresa)}}" method="post" novalidate>
    @csrf
    <div class="content-campo">
        <div class="select">
            <label for="id_cliente">Cliente</label>
            <select name="id_cliente" id="id_cliente">
                <option value="" selected disabled>Seleccione Cliente</option>
                @foreach ($clientes as $cliente)
                    <option {{ old('id_cliente') == $cliente->id ? 'selected' : '' }} value="{{$cliente->id}}">{{$cliente->name}}</option>
                @endforeach
            </select>
            @error('id_cliente')
                <p class="text-error">{{$message}}</p>
            @enderror
        </div>

        <div class="campo">
            <label for="direccion" class="form-label">Dirección</label>
            <input type="text" class="producto" id="direccion" name="direccion" value="{{old('direccion')}}">
            @error('direccion')
                <p class="text-error">{{$message}}</p>
            @enderror
        </div>

        <div class="campo">
            <label for="coordenadas" class="form-label">Coordenadas</label>
            <input type="text" class="coordenadas" id="coordenadas" name="coordenadas" value="{{old('coordenadas')}}">
            @error('coordenadas')
                <p class="text-error">{{$message}}</p>
            @enderror
        </div>

        <div class="campo">
            <label for="favorita" class="form-label">Favorita</label>
            <input type="text" class="favorita" id="favorita" name="v" value="{{old('favorita')}}">
            @error('favorita')
                <p class="text-error">{{$message}}</p>
            @enderror
        </div>
    </div>

    <button type="submit" class="btn-enviar">Guardar</button>
</form>
@endsection

@section('titulo-tabla')
    Lista Dirección Clientes
@endsection

@section('tabla')
    <thead>
        <tr>
            {{-- <th>#</th> --}}
            <th>Cliente</th>
            <th>Dirección</th>
            <th>Coordenadas</th>
            <th>Favorita</th>
            <th>Acciones</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($datos as $dato)
            <tr>
                {{-- <td>$dato->id</td> --}}
                @foreach ($clientes as $cliente)
                    @if ($cliente->id == $dato->id_client)
                        <td>{{$cliente->name}}</td>
                    @endif
                @endforeach
                <td>{{$dato->direccion}}</td>
                <td>{{$dato->coordenadas}}</td>
                <td>{{$dato->favorita}}</td>
                <td class="btn-acciones">
                    {{-- <a href="{{url('user_cliente?buscar='.$dato->id)}}" class="show"><ion-icon name="add-outline"></ion-icon></a> --}}

                    <a href="{{url('panel_direccion_cliente/'.$dato->id.'/edit'.'/'.$idEmpresa)}}" class="edit"><ion-icon name="pencil-outline"></ion-icon></a>

                    <form action="{{url('panel_direccion_cliente/'.$dato->id.'/'.$idEmpresa)}}" method="POST" class="delete">
                        @csrf
                        {{method_field('DELETE')}}
                        <button type="submit"><ion-icon name="beaker-outline"></ion-icon></button>
                    </form>
                </td>
            </tr>
        @endforeach
    </tbody>
@endsection
