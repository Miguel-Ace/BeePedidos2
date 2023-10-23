@extends('layout.panel')

@section('titulo-crear')
    Editar Estado
@endsection

@section('formulario')
<form class="form" action="{{url('/panel_estado'.'/'.$datos->id.'/'.$idEmpresa)}}" method="post" novalidate>
    @csrf
    {{method_field('PATCH')}}
    <div class="content-campo">
        <div class="campo">
            <label for="estado" class="form-label">Estado</label>
            <input type="text" class="estado" id="estado" name="estado" value="{{$datos->estado}}">
            @error('estado')
                <p class="text-error">{{$message}}</p>
            @enderror
        </div>
    </div>

    <button type="submit" class="btn-enviar">Guardar</button>
</form>
@endsection
