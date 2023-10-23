@extends('layout.panel')

@section('titulo-crear')
    Crear Tipo Pedido
@endsection

@section('formulario')
<form class="form" action="{{url('/panel_tipo_pedido'.'/'.$datos->id.'/'.$idEmpresa)}}" method="post" novalidate>
    @csrf
    {{method_field('PATCH')}}
    <div class="content-campo">
        <div class="campo">
            <label for="tipo_pedido" class="form-label">Tipo de Pedido</label>
            <input type="text" class="tipo_pedido" id="tipo_pedido" name="tipo_pedido" value="{{$datos->tipo_pedido}}">
            @error('tipo_pedido')
                <p class="text-error">{{$message}}</p>
            @enderror
        </div>
    </div>

    <button type="submit" class="btn-enviar">Guardar</button>
</form>
@endsection
