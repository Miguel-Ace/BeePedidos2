@extends('layout.panel')

@section('titulo-crear')
    Crear Tipo Pago
@endsection

@section('formulario')
<form class="form" action="{{url('/panel_tipo_pago'.'/'.$datos->id.'/'.$idEmpresa)}}" method="post" novalidate>
    @csrf
    {{method_field('PATCH')}}
    <div class="content-campo">
        <div class="campo">
            <label for="tipo_pago" class="form-label">Tipo de Pago</label>
            <input type="text" class="tipo_pago" id="tipo_pago" name="tipo_pago" value="{{$datos->tipo_pago}}">
            @error('tipo_pago')
                <p class="text-error">{{$message}}</p>
            @enderror
        </div>
    </div>

    <button type="submit" class="btn-enviar">Guardar</button>
</form>
@endsection
