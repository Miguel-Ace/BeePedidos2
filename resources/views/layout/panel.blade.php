<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Panel Administrativo</title>
    @vite(['resources/css/app.css','resources/sass/panel.scss','resources/js/app.js'])
    <script src="https://kit.fontawesome.com/cd197f289d.js" crossorigin="anonymous"></script>
</head>
<body>
    <div class="cabecera">
        <div class="logo">
            Pedidos
        </div>

        <div class="configuracion">
            <div class="info-user">
                <p><ion-icon name="caret-down-outline"></ion-icon> {{auth()->user()->name}}</p>
                <div class="settins">
                    <a href="{{url('/'.$idEmpresa)}}">Page Pricipal</a>
                    <a href="{{url('/logout'.'/'.$idEmpresa)}}">Cerrar Sesión</a>
                </div>
            </div>
        </div>
    </div>

    <main>
        <div class="lateral">
            <p>Panel Admin</p>
            <hr>
            <div class="catalogos">
                <a href="{{url('/panel_productos'.'/'.$idEmpresa)}}"><i class="fas fa-cart-arrow-down"></i>  <span>Productos</span></a>
                <a href="{{url('/panel_categoria_productos'.'/'.$idEmpresa)}}"><i class="fas fa-folder"></i> <span>Categoria Producto</span></a>
                <a href="{{url('/panel_clientes'.'/'.$idEmpresa)}}"><i class="fas fa-users"></i> <span>Clientes</span></a>
                <a href="{{url('/panel_direccion_cliente'.'/'.$idEmpresa)}}"><i class="fas fa-house-user"></i> <span>Dirección Cliente</span></a>
                <a href="{{url('/panel_empresas'.'/'.$idEmpresa)}}"><i class="fas fa-building"></i> <span>Empresa</span></a>
                <a href="{{url('/panel_pedidos'.'/'.$idEmpresa)}}"><i class="fas fa-list-check"></i> <span>Pedidos</span></a>
                <a href="{{url('/panel_detalle_pedidos'.'/'.$idEmpresa)}}"><i class="fas fa-clock-rotate-left"></i> <span>Detalle Pedidos</span></a>
                <a href="{{url('/panel_modificadores_producto'.'/'.$idEmpresa)}}"><i class="fas fa-hand-pointer"></i> <span>Modificadores Producto</span></a>
                <a href="{{url('/panel_estado'.'/'.$idEmpresa)}}"><i class="fas fa-clock-rotate-left"></i>  <span>Estado</span></a>
                <a href="{{url('/panel_tipo_entrega'.'/'.$idEmpresa)}}"><i class="fas fa-truck-ramp-box"></i> <span>Tipo Entrega</span></a>
                <a href="{{url('/panel_tipo_pago'.'/'.$idEmpresa)}}"><i class="fas fa-credit-card"></i> <span>Tipo Pago</span></a>
                <a href="{{url('/panel_tipo_pedido'.'/'.$idEmpresa)}}"><i class="fas fa-truck-ramp-box"></i> <span>Tipo Pedido</span></a>
            </div>
        </div>
        <div class="principal">
            <div class="create-tablas">
                <div class="titulo-crear">
                    <p>@yield('titulo-crear')</p>
                </div>
                    @yield('formulario')
            </div>

            <div class="tablas">
                <div class="titulo-tabla">
                    <p>@yield('titulo-tabla')</p>
                </div>
                <table class="table">
                    @yield('tabla')
                </table>
            </div>
        </div>
    </main>

    <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
</body>
</html>
