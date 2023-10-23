@extends('layout.panel')

@section('titulo-crear')
    Crear Categoria Producto
@endsection

@section('formulario')
<form class="form" action="{{url('/panel_categoria_productos'.'/'.$datos->id.'/'.$idEmpresa)}}" method="post" novalidate>
    @csrf
    {{method_field('PATCH')}}
    <div class="content-campo">
        <div class="select">
            <label for="id_empresa">Empresa</label>
            <select name="id_empresa" id="id_empresa">
                <option value="">Seleccione Empresa</option>
                @foreach ($empresas as $empresa)
                    @if ($datos->id_empresa == $empresa->id)
                        <option value="{{$empresa->id}}" selected>{{$empresa->empresa}}</option>
                    @else
                        <option value="{{$empresa->id}}">{{$empresa->empresa}}</option>
                    @endif
                @endforeach
            </select>
            @error('id_empresa')
                <p class="text-error">{{$message}}</p>
            @enderror
        </div>

        <div class="campo">
            <label for="categoria" class="form-label">Categoria</label>
            <input type="text" class="categoria" id="categoria" name="categoria" value="{{$datos->categoria}}">
            @error('categoria')
                <p class="text-error">{{$message}}</p>
            @enderror
        </div>
    </div>

    <button type="submit" class="btn-enviar">Guardar</button>
</form>
@endsection
