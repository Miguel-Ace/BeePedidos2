@extends('layout.panel')

@section('titulo-crear')
    Crear Empresa
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

<form class="form" action="{{url('/panel_empresas'.'/'.$idEmpresa)}}" method="post" novalidate>
    @csrf
    <div class="content-campo">
        <div class="campo">
            <label for="cedula" class="form-label">Cédula</label>
            <input type="text" class="cedula" id="cedula" name="cedula" value="{{old('cedula')}}">
            @error('cedula')
                <p class="text-error">{{$message}}</p>
            @enderror
        </div>

        <div class="campo">
            <label for="pais" class="form-label">País</label>
            <input type="text" class="pais" id="pais" name="pais" value="{{old('pais')}}">
            @error('pais')
                <p class="text-error">{{$message}}</p>
            @enderror
        </div>

        <div class="campo">
            <label for="empresa" class="form-label">Empresa</label>
            <input type="text" class="empresa" id="precio" name="empresa" value="{{old('empresa')}}">
            @error('empresa')
                <p class="text-error">{{$message}}</p>
            @enderror
        </div>

        <div class="campo">
            <label for="direccion" class="form-label">Direccion</label>
            <input type="text" class="direccion" id="direccion" name="direccion" value="{{old('direccion')}}">
            @error('direccion')
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
            <label for="telefono" class="form-label">Teléfono</label>
            <input type="text" class="telefono" id="telefono" name="telefono" value="{{old('telefono')}}">
            @error('telefono')
                <p class="text-error">{{$message}}</p>
            @enderror
        </div>

        <div class="campo">
            <label for="email" class="form-label">Email</label>
            <input type="email" class="email" id="email" name="email" value="{{old('email')}}">
            @error('email')
                <p class="text-error">{{$message}}</p>
            @enderror
        </div>

        <div class="campo">
            <label for="celular" class="form-label">Celular</label>
            <input type="number" class="celular" id="celular" name="celular" value="{{old('celular')}}">
            @error('celular')
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
            <label for="url_imagen" class="form-label">Logo</label>
            <input type="text" class="url_imagen" id="url_imagen" name="url_imagen" value="{{old('url_imagen')}}">
            @error('url_imagen')
                <p class="text-error">{{$message}}</p>
            @enderror
        </div>
    </div>

    <button type="submit" class="btn-enviar">Guardar</button>
</form>
@endsection

@section('titulo-tabla')
    Lista de Empresa
@endsection

@section('tabla')
    <thead>
        <tr>
            {{-- <th>#</th> --}}
            <th>Cédula</th>
            <th>País</th>
            <th>Empresa</th>
            <th>Dirreción</th>
            <th>Descripción</th>
            <th>Teléfono</th>
            <th>Email</th>
            <th>Celular</th>
            <th>Coordenadas</th>
            <th>Logo</th>
            <th>Acciones</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($datos as $dato)
            <tr>
                {{-- <td>$dato->id</td> --}}
                <td>{{$dato->cedula}}</td>
                <td>{{$dato->pais}}</td>
                <td>{{$dato->empresa}}</td>
                <td>{{$dato->direccion}}</td>
                <td>{{$dato->descripcion}}</td>
                <td>{{$dato->telefono}}</td>
                <td>{{$dato->email}}</td>
                <td>{{$dato->celular}}</td>
                <td>{{$dato->coordenadas}}</td>
                <td><img src="{{$dato->url_imagen}}" alt="" width="100"></td>
                <td class="btn-acciones">
                    {{-- <a href="{{url('user_cliente?buscar='.$dato->id)}}" class="show"><ion-icon name="add-outline"></ion-icon></a> --}}

                    <a href="{{url('panel_empresas/'.$dato->id.'/edit'.'/'.$idEmpresa)}}" class="edit"><ion-icon name="pencil-outline"></ion-icon></a>

                    <form action="{{url('panel_empresas/'.$dato->id.'/'.$idEmpresa)}}" method="POST" class="delete">
                        @csrf
                        {{method_field('DELETE')}}
                        <button type="submit"><ion-icon name="beaker-outline"></ion-icon></button>
                    </form>
                </td>
            </tr>
        @endforeach
    </tbody>
@endsection
