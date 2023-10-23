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

    <form action="{{ route('password.update') }}" method="POST" class="form-identificate" novalidate>
        @csrf

        <input type="hidden" name="token" value="{{ $token }}">

        <div class="input email">
            <label for="email" class="">Correo electrónico</label>
            <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ $email ?? old('email') }}" required autocomplete="email" autofocus>

            @error('email')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>

        <div class="input email">
            <label for="password" class="">Password</label>
            <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

            @error('password')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>

        <div class="input email">
            <label for="password-confirm" class="col-md-4 col-form-label text-md-right">Confirmar Password</label>
            <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
        </div>

        <input type="submit" value="Actualizar la contraseña" class="btn-crear">
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
