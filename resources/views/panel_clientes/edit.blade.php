@extends('layout.panel')

@section('titulo-crear')
    Crear Cliente
@endsection

@section('formulario')
<form class="form" action="{{url('/panel_clientes'.'/'.$datos->id.'/'.$idEmpresa)}}" method="post" novalidate>
    @csrf
    {{method_field('PATCH')}}
    <div class="content-campo">
        <div class="campo">
            <label for="name" class="form-label">Nombre</label>
            <input type="text" class="name" id="name" name="name" value="{{$datos->name}}">
            @error('name')
                <p class="text-error">{{$message}}</p>
            @enderror
        </div>

        <div class="campo">
            <label for="email" class="form-label">Email</label>
            <input type="email" class="email" id="email" name="email" value="{{$datos->email}}">
            @error('email')
                <p class="text-error">{{$message}}</p>
            @enderror
        </div>

        <div class="campo">
            <label for="telefono" class="form-label">Telefono</label>
            <input type="number" class="telefono" id="telefono" name="telefono" value="{{$datos->telefono}}">
            @error('telefono')
                <p class="text-error">{{$message}}</p>
            @enderror
        </div>

        <div class="campo">
            <label for="cedula" class="form-label">Cédula</label>
            <input type="text" class="cedula" id="cedula" name="cedula" value="{{$datos->cedula}}">
            @error('cedula')
                <p class="text-error">{{$message}}</p>
            @enderror
        </div>

        <div class="campo">
            <label for="tipo_cedula" class="form-label">Tipo Cédula</label>
            <input type="text" class="tipo_cedula" id="tipo_cedula" name="tipo_cedula" value="{{$datos->tipo_cedula}}">
            @error('tipo_cedula')
                <p class="text-error">{{$message}}</p>
            @enderror
        </div>
    </div>

    <button type="submit" class="btn-enviar">Guardar</button>
</form>
@endsection
