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
        <p>Bienvenido a Pedidos</p>
    </div>

    @if (session('mensaje'))
        <p class="error">{{session('mensaje')}}</p>
    @endif

    <form action="{{url('/login')}}" method="post" class="form-identificate" novalidate>
        @csrf
        <div class="input email">
            <input type="email" name="email" id="email" value="{{old('email')}}">
            <label for="email">Correo</label>
            @error('email')
            <p class="error">{{$message}}</p>
            @enderror
        </div>

        <div class="input password">
            <input type="password" name="password" id="password" value="">
            <label for="password">Password</label>
            @error('password')
            <p class="error">{{$message}}</p>
            @enderror
        </div>

        <input type="submit" value="Iniciar Sesión" class="btn-crear">
        @role('Vendedor')
        <a href="{{url('/register')}}">Regístrate</a>
        @endrole
        <a href="{{url('/password/reset')}}">Olvidastes la contraseña?</a>
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
