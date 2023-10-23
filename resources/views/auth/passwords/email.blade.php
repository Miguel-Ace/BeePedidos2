@extends('layout.identificacion')

@section('contenido-identificacion')
<div class="imagen"></div>
<div>
    <div class="titulo">
        <h1>BeêCommerce</h1>
    </div>

    <div class="logo">
        <img src="{{asset('img/logo.png')}}" alt="">
    </div>

    <div class="bienvenida">
        <p>Recupera tu Cuenta</p>
    </div>

    @if (session('mensaje'))
        <p class="error">{{session('mensaje')}}</p>
    @endif

    <form action="{{ route('password.email') }}" method="post" class="form-identificate" novalidate>
        @csrf

        <div class="input email">
            <label for="email">Correo electrónico</label>
            <input id="email" type="email" name="email" value="{{ old('email') }}" required autofocus>
            @error('email')
                <span role="alert">{{ $message }}</span>
            @enderror
        </div>

        <input type="submit" value="Enviar enlace de restablecimiento de contraseña" class="btn-crear">
    </form>
</div>

{{-- <script>
    const label = document.getElementById('label');
    const inputname = document.getElementById('name');

    inputname.addEventListener('click', function() {
        label.classList.toggle('subir-label');
    });
</script> --}}

@endsection
