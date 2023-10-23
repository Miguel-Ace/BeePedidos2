@extends('layout.panel')

@section('titulo-crear')
    Crear Empresa
@endsection

@section('formulario')
<form class="form" action="{{url('/panel_empresas'.'/'.$datos->id.'/'.$idEmpresa)}}" method="post" novalidate>
    @csrf
    {{method_field('PATCH')}}
    <div class="content-campo">
        <div class="campo">
            <label for="cedula" class="form-label">Cédula</label>
            <input type="text" class="cedula" id="cedula" name="cedula" value="{{$datos->cedula}}">
            @error('cedula')
                <p class="text-error">{{$message}}</p>
            @enderror
        </div>

        <div class="campo">
            <label for="pais" class="form-label">País</label>
            <input type="text" class="pais" id="pais" name="pais" value="{{$datos->pais}}">
            @error('pais')
                <p class="text-error">{{$message}}</p>
            @enderror
        </div>

        <div class="campo">
            <label for="empresa" class="form-label">Empresa</label>
            <input type="text" class="empresa" id="precio" name="empresa" value="{{$datos->empresa}}">
            @error('empresa')
                <p class="text-error">{{$message}}</p>
            @enderror
        </div>

        <div class="campo">
            <label for="direccion" class="form-label">Direccion</label>
            <input type="text" class="direccion" id="direccion" name="direccion" value="{{$datos->direccion}}">
            @error('direccion')
                <p class="text-error">{{$message}}</p>
            @enderror
        </div>

        <div class="campo">
            <label for="telefono" class="form-label">Teléfono</label>
            <input type="text" class="telefono" id="telefono" name="telefono" value="{{$datos->telefono}}">
            @error('telefono')
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
            <label for="celular" class="form-label">Celular</label>
            <input type="number" class="celular" id="celular" name="celular" value="{{$datos->celular}}">
            @error('celular')
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
    </div>

    <button type="submit" class="btn-enviar">Guardar</button>
</form>
@endsection
