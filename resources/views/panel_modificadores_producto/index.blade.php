@extends('layout.panel')

@section('titulo-crear')
    Crear Modificador Producto
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

<form class="form" action="{{url('/panel_modificadores_producto'.'/'.$idEmpresa)}}" method="post" novalidate>
    @csrf
    <div class="content-campo">
        <div class="select">
            <label for="id_producto">Producto</label>
            <select name="id_producto" id="id_producto">
                <option value="" disabled selected>Seleccione Producto</option>
                @foreach ($productos as $producto)
                    <option {{ old('id_producto') == $producto->id ? 'selected' : '' }} value="{{$producto->id}}">{{$producto->producto}}</option>
                @endforeach
            </select>
            @error('id_producto')
                <p class="text-error">{{$message}}</p>
            @enderror
        </div>

        <div class="campo">
            <label for="modificador" class="form-label">Modificador</label>
            <input type="text" class="modificador" id="modificador" name="modificador" value="{{old('modificador')}}">
            @error('modificador')
                <p class="text-error">{{$message}}</p>
            @enderror
        </div>

        {{-- <div class="campo">
            <label for="modificador2" class="form-label">Modificador3</label>
            <input type="text" class="modificador2" id="modificador2" name="modificador2" value="{{old('modificador2')}}">
            @error('modificador2')
                <p class="text-error">{{$message}}</p>
            @enderror
        </div>

        <div class="campo">
            <label for="modificador3" class="form-label">Modificador3</label>
            <input type="text" class="modificador3" id="modificador3" name="modificador3" value="{{old('modificador3')}}">
            @error('modificador3')
                <p class="text-error">{{$message}}</p>
            @enderror
        </div> --}}
    </div>
    <button type="submit" class="btn-enviar">Guardar</button>
</form>
@endsection

@section('titulo-tabla')
    Lista Modificador Producto
@endsection

@section('tabla')
    <thead>
        <tr>
            {{-- <th>#</th> --}}
            <th>Producto</th>
            <th>Modificador</th>
            <th>Acciones</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($datos as $dato)
            <tr>
                {{-- <td>$dato->id</td> --}}
                @foreach ($productos as $producto)
                    @if ($producto->id == $dato->id_producto)
                    <td>{{$producto->producto}}</td>
                    @endif
                @endforeach
                <td>{{$dato->modificador}}</td>
                <td class="btn-acciones">
                    {{-- <a href="{{url('user_cliente?buscar='.$dato->id)}}" class="show"><ion-icon name="add-outline"></ion-icon></a> --}}

                    <a href="{{url('panel_modificadores_producto/'.$dato->id.'/edit'.'/'.$idEmpresa)}}" class="edit"><ion-icon name="pencil-outline"></ion-icon></a>

                    <form action="{{url('panel_modificadores_producto/'.$dato->id.'/'.$idEmpresa)}}" method="POST" class="delete">
                        @csrf
                        {{method_field('DELETE')}}
                        <button type="submit"><ion-icon name="beaker-outline"></ion-icon></button>
                    </form>
                </td>
            </tr>
        @endforeach
    </tbody>
@endsection
