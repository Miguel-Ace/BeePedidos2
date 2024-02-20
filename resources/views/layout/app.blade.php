<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Pedidos</title>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.0/dist/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/animejs/2.0.2/anime.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
    @vite(['resources/css/app.css','resources/sass/estilos.scss'])
</head>
<body>
    <main>
        <p class="btn-categorias"><ion-icon name="apps-outline"></ion-icon></p>
        <a href="{{ url('/cart'.'/'.$idEmpresa) }}" class="btn-pedidos"><ion-icon name="cart-outline"></ion-icon></a>
        <div class="cabecera">
            <div class="logo">
                Beê<span class="ml3">Commerce</span>
            </div>

            <div class="configuracion">
                <div class="logo-empresa">
                    @foreach ($empresas as $empresa)
                        @if ($empresa->id == $idEmpresa)
                            <img src="{{$empresa->url_imagen}}" alt="">
                        @endif
                    @endforeach
                </div>

                @php
                    function obtenerIniciales($nombreCompleto) {
                        $nombres = explode(' ', $nombreCompleto);
                        $iniciales = '';

                        foreach ($nombres as $nombre) {
                            $iniciales .= strtoupper(substr($nombre, 0, 1));
                        }

                        return $iniciales;
                    }
                @endphp
                @if (auth()->check())
                    <p class="nombre-completo"><ion-icon name="caret-forward-outline" class=""></ion-icon>Hola: {{auth()->user()->name}}</p>
                    {{-- <p class="nombre-iniciales"><ion-icon name="caret-forward-outline" class=""></ion-icon> {{obtenerIniciales(auth()->user()->name)}}</p> --}}
                @else
                    <p class="nombre-completo"><ion-icon name="caret-forward-outline" class=""></ion-icon>Usuario</p>
                @endif

                <div class="settins">
                    {{-- @role('Administrador')
                    <a href="{{url('/panel_productos'.'/'.$idEmpresa)}}">Panel Admin</a>
                    @endrole --}}
                    @if (auth()->check())
                        {{-- <a href="">Editar</a> --}}
                        {{-- <button class="btn-editar-user">Editar Perfil</button> --}}
                        
                        {{-- @role('Empresario')
                        <button type="button" class="btn-editar-user" data-toggle="modal" data-target="#exampleModalCenter">
                            Pedidos2
                        </button>
                        @endrole
                        
                        @role('Administrador')
                        <button type="button" class="btn-editar-user" data-toggle="modal" data-target="#exampleModalCenter">
                            Pedidos
                        </button>
                        @endrole --}}

                        <button type="button" class="btn-editar-user" data-toggle="modal" data-target="#exampleModalCenter">
                            Pedidos
                        </button>

                        {{-- <button type="button" class="btn-editar-user" data-toggle="modal" data-target="#exampleModalCenter3">
                            Pedidos3
                        </button> --}}

                        @role('Vendedor')
                        <button type="button" class="btn-editar-user" data-toggle="modal" data-target="#exampleModalCenter1">
                            Editar Roles
                        </button>
                        @endrole

                        <button type="button" class="btn-editar-user" data-toggle="modal" data-target="#exampleModalCenter2">
                            Editar Perfil
                        </button>

                        @role('Vendedor')
                        <a href="{{url('/register'.'/'.$idEmpresa)}}">Agregar Usuario</a>
                        @endrole

                        <a href="{{url('/logout'.'/'.$idEmpresa)}}">Cerrar Sesión</a>
                    @else
                        <a href="{{url('/login'.'/'.$idEmpresa)}}">Iniciar Sesión</a>
                    @endif
                </div>
            </div>

            <div class="list-categoria">
                @yield('list-categoria')
            </div>
        </div>
        
        <div class="contenedor-producto">
            <div id="carouselExample" class="carousel slide" data-bs-ride="carousel">
                @yield('carrusel')
            </div>
            <div class="contenedor-cards">
                @yield('list-productos')
            </div>
        </div>

        <div class="mostrar-pedido">
            @if (session('agregado'))
            {{-- <script>
                swal({
                    title: "¡Éxito!",
                    text: "{{ session('agregado') }}",
                    icon: "success",
                    button: "Aceptar",
                });
            </script> --}}
            <div class="alerta-agregado">
                <ion-icon name="checkmark-outline"></ion-icon>
                <p>
                    Pedido realizado correctamente,<br>
                    estará listo en unos minutos.
                </p>
            </div>
            <script>
                const alertaAgregado = document.querySelector('.alerta-agregado')
                setTimeout(() => {
                    alertaAgregado.style = 'transform: translateX(0%)'
                    setTimeout(() => {
                        alertaAgregado.style = 'transform: translateX(100%)'
                            setTimeout(() => {
                                alertaAgregado.style = 'display:none'
                            }, 800)
                    }, 1500);
                }, 600);
            </script>
            @endif

            @yield('list-productos-cart')
        </div>
    </main>

    <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
    <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>

    <script>
        var textWrapper = document.querySelector('.ml3');
        textWrapper.innerHTML = textWrapper.textContent.replace(/\S/g, "<span class='letter'>$&</span>");

        anime.timeline({loop: true})
        .add({
            targets: '.ml3 .letter',
            opacity: [0,1],
            easing: "easeInOutQuad",
            duration: 2250,
            delay: (el, i) => 150 * (i+1)
        }).add({
            targets: '.ml3',
            opacity: 0,
            duration: 1000,
            easing: "easeOutExpo",
            delay: 4000
        });
    </script>
</body>
</html>
