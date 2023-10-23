@extends('layout.panel')

@section('titulo-crear')
    Crear Tipo Entrega
@endsection

@section('formulario')
    <form class="form" action="{{url('/panel_tipo_entrega'.'/'.$datos->id.'/'.$idEmpresa)}}" method="post" novalidate>
        @csrf
        {{method_field('PATCH')}}
        <div class="content-campo">
            <div class="campo">
                <label for="tipo_entrega" class="form-label">Tipo de Entrega</label>
                <input type="text" class="tipo_entrega" id="tipo_entrega" name="tipo_entrega" value="{{$datos->tipo_entrega}}">
                @error('tipo_entrega')
                    <p class="text-error">{{$message}}</p>
                @enderror
            </div>
        </div>

        <button type="submit" class="btn-enviar">Guardar</button>
    </form>
@endsection
