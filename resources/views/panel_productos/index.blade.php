@extends('layout.panel')

@section('titulo-crear')
    Crear Producto
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

<form class="form" action="{{url('/panel_productos'.'/'.$idEmpresa)}}" method="post" novalidate>
    @csrf
    <div class="content-campo">
        <div class="campo">
            <label for="producto" class="form-label">Producto</label>
            <input type="text" class="producto" id="producto" name="producto" value="{{old('producto')}}">
            @error('producto')
                <p class="text-error">{{$message}}</p>
            @enderror
        </div>

        <div class="campo">
            <label for="descripcion" class="form-label">Descripción</label>
            <input type="text" class="descripcion" id="descripcion" name="descripcion" value="{{old('descripcion')}}">
            @error('descripcion')
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

        <div class="select">
            <label for="id_categoria">Categoria</label>
            <select name="id_categoria" id="id_categoria">
                <option value="" disabled selected>Seleccione Categoria</option>
                @foreach ($categorias as $categoria)
                    <option {{ old('id_categoria') == $categoria->id ? 'selected' : '' }} value="{{$categoria->id}}">{{$categoria->categoria}}</option>
                @endforeach
            </select>
            @error('id_categoria')
                <p class="text-error">{{$message}}</p>
            @enderror
        </div>

        <div class="campo">
            <label for="url_imagen" class="form-label">Url_Imagen</label>
            <input type="text" class="descuento" id="url_imagen" name="url_imagen" value="{{old('url_imagen')}}">
            @error('url_imagen')
                <p class="text-error">{{$message}}</p>
            @enderror
        </div>
    </div>

    <button type="submit" class="btn-enviar">Guardar</button>
</form>
@endsection

@section('titulo-tabla')
    Lista de Productos
@endsection

@section('tabla')
    <thead>
        <tr>
            {{-- <th>#</th> --}}
            <th>Producto</th>
            <th>Descripción</th>
            <th>Precio</th>
            <th>Descuento</th>
            <th>Empresa</th>
            <th>Categoria</th>
            <th>Url_Imagen</th>
            <th>Acciones</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($datos as $dato)
            <tr>
                {{-- <td>$dato->id</td> --}}
                <td>{{$dato->producto}}</td>
                <td>{{$dato->descripcion}}</td>
                <td>${{$dato->precio}}</td>
                <td>{{$dato->descuento}}%</td>

                @foreach ($empresas as $empresa)
                    @if ($empresa->id == $dato->id_empresa)
                        <td>{{$empresa->empresa}}</td>
                    @endif
                @endforeach

                @foreach ($categorias as $categoria)
                    @if ($categoria->id == $dato->id_categoria)
                        <td>{{$categoria->categoria}}</td>
                    @endif
                @endforeach
                <td><img src="{{$dato->url_imagen}}" width="100" alt=""></td>
                <td class="btn-acciones ajuste-por-imagen">
                    {{-- <a href="{{url('user_cliente?buscar='.$dato->id)}}" class="show"><ion-icon name="add-outline"></ion-icon></a> --}}

                    <a href="{{url('panel_productos/'.$dato->id.'/edit'.'/'.$idEmpresa)}}" class="edit"><ion-icon name="pencil-outline"></ion-icon></a>

                    <form action="{{url('panel_productos/'.$dato->id.'/'.$idEmpresa)}}" method="POST" class="delete">
                        @csrf
                        {{method_field('DELETE')}}
                        <button type="submit"><ion-icon name="beaker-outline"></ion-icon></button>
                    </form>
                </td>
            </tr>
        @endforeach
    </tbody>
@endsection
