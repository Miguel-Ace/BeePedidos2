@extends('layout.panel')

@section('titulo-crear')
    Crear Producto
@endsection

@section('formulario')
<form class="form" action="{{url('/panel_productos'.'/'.$datos->id.'/'.$idEmpresa)}}" method="post" novalidate>
    @csrf
    {{method_field('PATCH')}}
    <div class="content-campo">
        <div class="campo">
            <label for="producto" class="form-label">Producto</label>
            <input type="text" class="producto" id="producto" name="producto" value="{{$datos->producto}}">
            @error('producto')
                <p class="text-error">{{$message}}</p>
            @enderror
        </div>

        <div class="campo">
            <label for="descripcion" class="form-label">Descripción</label>
            <input type="text" class="descripcion" id="descripcion" name="descripcion" value="{{$datos->descripcion}}">
            @error('descripcion')
                <p class="text-error">{{$message}}</p>
            @enderror
        </div>

        <div class="campo">
            <label for="precio" class="form-label">Precio</label>
            <input type="number" class="precio" id="precio" name="precio" value="{{$datos->precio}}">
            @error('precio')
                <p class="text-error">{{$message}}</p>
            @enderror
        </div>

        <div class="campo">
            <label for="descuento" class="form-label">Descuento</label>
            <input type="number" class="descuento" id="descuento" name="descuento" value="{{$datos->descuento}}">
            @error('descuento')
                <p class="text-error">{{$message}}</p>
            @enderror
        </div>

        <div class="select">
            <label for="id_empresa">Empresa</label>
            <select name="id_empresa" id="id_empresa">
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

        <div class="select">
            <label for="id_categoria">Categoria</label>
            <select name="id_categoria" id="id_categoria">
                @foreach ($categorias as $categoria)
                    @if ($datos->id_categoria == $categoria->id)
                        <option value="{{$categoria->id}}" selected>{{$categoria->categoria}}</option>
                    @else
                        <option value="{{$categoria->id}}">{{$categoria->categoria}}</option>
                    @endif
                @endforeach
            </select>
            @error('id_categoria')
                <p class="text-error">{{$message}}</p>
            @enderror
        </div>

        <div class="campo">
            <label for="url_imagen" class="form-label">Url_Imagen</label>
            <input type="text" class="descuento" id="url_imagen" name="url_imagen" value="{{$datos->url_imagen}}">
            @error('url_imagen')
                <p class="text-error">{{$message}}</p>
            @enderror
        </div>
    </div>

    <button type="submit" class="btn-enviar">Guardar</button>
</form>
@endsection
