@extends('layout.panel')

@section('titulo-crear')
    Crear Cliente
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

<form class="form" action="{{url('/panel_clientes'.'/'.$idEmpresa)}}" method="post" novalidate>
    @csrf
    <div class="content-campo">
        <div class="campo">
            <label for="name" class="form-label">Nombre</label>
            <input type="text" class="name" id="name" name="name" value="{{old('name')}}">
            @error('name')
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
            <label for="telefono" class="form-label">Telefono</label>
            <input type="number" class="telefono" id="telefono" name="telefono" value="{{old('telefono')}}">
            @error('telefono')
                <p class="text-error">{{$message}}</p>
            @enderror
        </div>

        <div class="campo">
            <label for="cedula" class="form-label">Cédula</label>
            <input type="text" class="cedula" id="cedula" name="cedula" value="{{old('cedula')}}">
            @error('cedula')
                <p class="text-error">{{$message}}</p>
            @enderror
        </div>

        <div class="campo">
            <label for="tipo_cedula" class="form-label">Tipo Cédula</label>
            <input type="text" class="tipo_cedula" id="tipo_cedula" name="tipo_cedula" value="{{old('tipo_cedula')}}">
            @error('tipo_cedula')
                <p class="text-error">{{$message}}</p>
            @enderror
        </div>

        <div class="campo">
            <label for="password" class="form-label">Password</label>
            <input type="password" class="password" id="password" name="password" value="{{old('password')}}">
            @error('password')
                <p class="text-error">{{$message}}</p>
            @enderror
        </div>
    </div>

    <button type="submit" class="btn-enviar">Guardar</button>
</form>
@endsection

@section('titulo-tabla')
    Lista de Cliente
@endsection

@section('tabla')
    <thead>
        <tr>
            {{-- <th>#</th> --}}
            <th>Nombre</th>
            <th>Email</th>
            <th>Teléfono</th>
            <th>Cédula</th>
            <th>Tipo Cédula</th>
            <th>Acciones</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($datos as $dato)
            <tr>
                {{-- <td>$dato->id</td> --}}
                <td>{{$dato->name}}</td>
                <td>{{$dato->email}}</td>
                <td>{{$dato->telefono}}</td>
                <td>{{$dato->cedula}}</td>
                <td>{{$dato->tipo_cedula}}</td>
                <td class="btn-acciones">
                    {{-- <a href="{{url('user_cliente?buscar='.$dato->id)}}" class="show"><ion-icon name="add-outline"></ion-icon></a> --}}

                    <a href="{{url('panel_clientes/'.$dato->id.'/edit'.'/'.$idEmpresa)}}" class="edit"><ion-icon name="pencil-outline"></ion-icon></a>

                    <form action="{{url('panel_clientes/'.$dato->id.'/'.$idEmpresa)}}" method="POST" class="delete">
                        @csrf
                        {{method_field('DELETE')}}
                        <button type="submit"><ion-icon name="beaker-outline"></ion-icon></button>
                    </form>
                </td>
            </tr>
        @endforeach
    </tbody>
@endsection
