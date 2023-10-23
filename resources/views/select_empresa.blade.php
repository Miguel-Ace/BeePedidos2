<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Pedidos</title>
    @vite(['resources/css/app.css','resources/sass/select_empresa.scss','resources/js/app.js'])
</head>
<body>
    <div class="header">
        <a href="https://beesys.net/" target="_blank">
            <img src="{{asset('img/logo.png')}}" alt="" class="logo">
        </a>
        <div class="descripcion">
            <p class="titulo">Store de pedidos</p>
            <p class="breve-descrip">Pedí comida a través de nuestra plataforma. De tu restaurante favorito a la puerta de tu casa.</p>
            <a href="#contenedor" class="btn-select-empresa">Empieza Ya!</a>
        </div>
    </div>

    <div class="contenedor" id="contenedor">
        @foreach ($empresas as $empresa)
        <div class="card">
            <div class="card-empresa">
                <a href="{{ url('/'.$empresa->id)}}">
                    <img src="{{$empresa->url_imagen}}" alt="">
                </a>
            </div>
            <div class="part-inferior">
                @if ($empresa->empresa)
                <p class="titulo-empresa">{{$empresa->empresa}}</p>
                @endif
                @if ($empresa->descripcion)
                <p class="descripcion-empresa">{{$empresa->descripcion}}</p>
                @endif
                @if ($empresa->direccion)
                <p class="direccion-empresa"><span>Dirección: </span>{{$empresa->direccion}}</p>
                @endif
                @if ($empresa->telefono)
                <p class="telefono-empresa"><span>Teléfono: </span>{{$empresa->telefono}}</p>
                @endif
                @if ($empresa->celular)
                <p class="celular-empresa"><span>Celular: </span>{{$empresa->celular}}</p>
                @endif
                @if ($empresa->email)
                <p class="email-empresa"><span>Correo: </span>{{$empresa->email}}</p>
                @endif

                <a href="{{ url('/'.$empresa->id)}}">Ir</a>
            </div>
        </div>
        @endforeach
    </div>

    {{$empresas->links()}}

    <footer>
    </footer>

    <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>

    <script>
        sessionStorage.removeItem('sumatoria');
        sessionStorage.removeItem('idCategoria')
    </script>
</body>
</html>
