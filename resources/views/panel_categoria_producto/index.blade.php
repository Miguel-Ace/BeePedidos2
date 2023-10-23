@extends('layout.panel')

@section('titulo-crear')
    Crear Categoria Producto
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

<form class="form" action="{{url('/panel_categoria_productos'.'/'.$idEmpresa)}}" method="post" novalidate>
    @csrf
    <div class="content-campo">
        <div class="select">
            <label for="id_empresa">Empresa</label>
            <select name="id_empresa" id="id_empresa">
                <option value="" disabled selected>Seleccione Empresa</option>
                @foreach ($empresas as $empresa)
                    <option {{ old('id_empresa') == $empresa->id ? 'selected' : '' }} value="{{$empresa->id}}">{{$empresa->empresa}}</option>
                @endforeach
            </select>
            @error('id_empresa')
                <p class="text-error">{{$message}}</p>
            @enderror
        </div>

        <div class="campo">
            <label for="categoria" class="form-label">Categoria</label>
            <input type="text" class="categoria" id="categoria" name="categoria" value="{{old('categoria')}}">
            @error('categoria')
                <p class="text-error">{{$message}}</p>
            @enderror
        </div>
    </div>

    <button type="submit" class="btn-enviar">Guardar</button>
</form>
@endsection

@section('titulo-tabla')
    Lista Categoria Producto
@endsection

@section('tabla')
    <thead>
        <tr>
            {{-- <th>#</th> --}}
            <th>Empresa</th>
            <th>Categoria</th>
            <th>Acciones</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($datos as $dato)
            <tr>
                {{-- <td>$dato->id</td> --}}
                @foreach ($empresas as $empresa)
                    @if ($empresa->id == $dato->id_empresa)
                        <td>{{$empresa->empresa}}</td>
                    @endif
                @endforeach
                <td>{{$dato->categoria}}</td>
                <td class="btn-acciones">
                    {{-- <a href="{{url('user_cliente?buscar='.$dato->id)}}" class="show"><ion-icon name="add-outline"></ion-icon></a> --}}

                    <a href="{{url('panel_categoria_productos/'.$dato->id.'/edit'.'/'.$idEmpresa)}}" class="edit"><ion-icon name="pencil-outline"></ion-icon></a>

                    <form action="{{url('panel_categoria_productos/'.$dato->id.'/'.$idEmpresa)}}" method="POST" class="delete">
                        @csrf
                        {{method_field('DELETE')}}
                        <button type="submit"><ion-icon name="beaker-outline"></ion-icon></button>
                    </form>
                </td>
            </tr>
        @endforeach
    </tbody>
@endsection
