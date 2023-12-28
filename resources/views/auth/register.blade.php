@extends('layout.identificacion')

{{-- modal errores --}}
@if ($errors->any())
    <div class="caja-modal">
        <div class="contenido-caja-modal">
            <button class="btn-cerrar-modal">X</button>

            @error('name')
            <p class="error">{{$message}}</p>
            @enderror
            @error('email')
            <p class="error">{{$message}}</p>
            @enderror
            @error('telefono')
            <p class="error">{{$message}}</p>
            @enderror
            @error('cedula')
            <p class="error">{{$message}}</p>
            @enderror
            @error('direccion1')
            <p class="error">{{$message}}</p>
            @enderror
            @error('direccion2')
            <p class="error">{{$message}}</p>
            @enderror
            @error('direccion3')
            <p class="error">{{$message}}</p>
            @enderror
            @error('password')
            <p class="error">{{$message}}</p>
            @enderror
        </div>
    </div>
@endif

@section('contenido-identificacion')
<div class="imagen"></div>
<div class="form-register">
    <div class="titulo">
        <h1>BeêCommerce</h1>
    </div>

    <div class="logo">
        <img src="{{asset('img/logo.png')}}" alt="">
    </div>

    <div class="bienvenida">
        <p>Bienvenido a Pedidos</p>
    </div>

    <form action="{{url('/register'.'/'.$idEmpresa)}}" method="post" class="form-identificate" novalidate>
        @csrf
        <div class="input name">
            <input type="text" name="name" id="name" value="{{old('name')}}">
            <label for="name" id="label">Nombre</label>
            @error('name')
            <p class="error">{{$message}}</p>
            @enderror
        </div>

        <div class="input email">
            <input type="email" name="email" id="email" value="{{old('email')}}">
            <label for="email">Correo</label>
            @error('email')
            <p class="error">{{$message}}</p>
            @enderror
        </div>

        <div class="input telefono">
            <input type="number" name="telefono" id="telefono" value="{{old('telefono')}}">
            <label for="telefono">Teléfono</label>
            @error('telefono')
            <p class="error">{{$message}}</p>
            @enderror
        </div>

        <div class="input cedula">
            <input type="number" name="cedula" id="cedula" value="">
            <label for="cedula">Cédula</label>
            @error('cedula')
            <p class="error">{{$message}}</p>
            @enderror
        </div>

        <div class="input tipo_cedula">
            <label for="tipo_cedula">Tipo de Cédula</label>
            <select name="tipo_cedula" id="tipo_cedula">
                <option value="01">Cédula Física</option>
                <option value="02">Cédula Jurídica</option>
                <option value="03">DIMEX</option>
                <option value="04">NITE</option>
            </select>

            @error('tipo_cedula')
            <p class="error">{{$message}}</p>
            @enderror
        </div>
        
        <div class="input direccion1">
            <input type="text" name="direccion1" id="direccion1" value="">
            <label for="direccion1">Primera Direccion</label>
            @error('direccion1')
            <p class="error">{{$message}}</p>
            @enderror
        </div>

        <div class="input direccion2">
            <input type="text" name="direccion2" id="direccion2" value="">
            <label for="direccion2">Segunda Direccion</label>
            @error('direccion2')
            <p class="error">{{$message}}</p>
            @enderror
        </div>

        <div class="input direccion3">
            <input type="text" name="direccion3" id="direccion3" value="">
            <label for="direccion3">Tercer Direccion</label>
            @error('direccion3')
            <p class="error">{{$message}}</p>
            @enderror
        </div>

        <div class="input password">
            <input type="password" name="password" id="password" value="{{old('password')}}">
            <label for="password">password</label>
            @error('password')
            <p class="error">{{$message}}</p>
            @enderror
        </div>

        <div class="input repetir-password">
            <input type="password" name="password_confirmation" id="password_confirmation">
            <label for="password_confirmation">Repetir Password</label>
        </div>

        <input type="submit" value="Crear Cuenta" class="btn-crear">
        <a href="{{url('/login')}}">Inicia Sesión</a>
        <a href="{{url('/9')}}">Tienda</a>
    </form>
</div>

<script>
    var btnCerrarModal = document.querySelector(".btn-cerrar-modal");
    var cajaModal = document.querySelector(".caja-modal");

    btnCerrarModal.addEventListener("click", function() {
    cajaModal.style.display = "none";
    });
</script>

@endsection
