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
    <script src="https://kit.fontawesome.com/cd197f289d.js" crossorigin="anonymous"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    @vite(['resources/css/app.css','resources/sass/cart.scss','resources/js/app.js','resources/js/app2.js','resources/js/cart.js','resources/js/enviar_formulario.js','resources/js/botones_cart.js'])
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>
<body>
    @if (session('remover'))
        <script>
            swal({
                title: "¡Eliminado!",
                text: "{{ session('remover') }}",
                icon: "error",
                button: "Aceptar",
            });
        </script>
    @endif

    @if (session('actualizado'))
        <script>
            swal({
                title: "¡Éxito!",
                text: "{{ session('actualizado') }}",
                icon: "info",
                button: "Aceptar",
            });
        </script>
    @endif

    {{-- @if(session('apiResponse'))
        <pre>
            @if (!empty(session('apiResponse')['DATA']['checkout']))
                <a href="https://{{session('apiResponse')['DATA']['checkout']}}" id="miEnlace">Ir a pagar</a>
            @else
                sin checkout
                {{session('apiResponse')['DESC']}}
            @endif
        </pre>

        <script>
            // Obtén una referencia al elemento de enlace por su ID
            var enlace = document.getElementById("miEnlace");

            // Define una función para hacer clic en el enlace
            function hacerClicEnEnlace() {
            enlace.click();
            }

            // Llama a la función para hacer clic en el enlace
            hacerClicEnEnlace();
        </script>
    @endif --}}

    <div class="content-table-cart">
        <h1 class="su-orden">Su Pedido</h1>
        <p class="pruebaTexto"></p>
        <div class="imagenes-complemento">
            <img class="img1" src="{{asset('img/undraw_In_love_q0bn.png')}}" alt="">
        </div>

        <table id="cart" class="table-cart">
            <thead>
                <tr>
                    <th></th>
                    <th>Producto</th>
                    <th>Precio</th>
                    <th>Descuento</th>
                    <th>Cantidad</th>
                    <th>Existencia</th>
                    <th>Modificador</th>
                    <th>Subtotal</th>
                    <th>IVA</th>
                    <th>Total</th>
                    <th></th>
                </tr>
            </thead>

            <tbody>
            </tbody>
        </table>

        <div class="finalizar-compra-cart">
            <div class="total"></div>

            <div class="acciones">
                <a href="{{ url('/'.$idEmpresa) }}" class=""><ion-icon name="arrow-back-outline"></ion-icon> Continuar Comprando</a>

                <button type="button" class="" data-toggle="modal" data-target="#exampleModalCenter">
                    <ion-icon name="cash-outline"></ion-icon> Procesar Compra
                </button>
                
                {{-- <a href="{{url('/login-user'.'/'.$idEmpresa)}}" class="inicia-session">
                    <ion-icon name="cash-outline"></ion-icon>
                    Procesar Compra
                </a> --}}
            </div>
        </div>
    </div>

    {{-- <div class="cart-vacio">
        <img src="{{asset('img/undraw_Slider_re_ch7w.png')}}" alt="">
        <div class="info-sigue-comprando">
            <p class="comentario-sigue-comprando">Tu cesta está vacía. ¡Selecciona un producto del inventario!</p>
            <a href="{{ url('/'.$idEmpresa) }}" class="btn-sigue-comprando">Continuar Comprando</a>
        </div>
    </div> --}}




    <!-- Modal -->
    <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h3 class="modal-title" id="exampleModalLongTitle">Resumen</h3>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <div class="modal-body cuerpo-modal">
                    @if (auth()->check())
                    {{-- <form class="form-factura" method="POST" action="{{url('/checkout'.'/'.$idEmpresa)}}" enctype="multipart/form-data"> --}}
                    <form class="form-factura" enctype="multipart/form-data">
                        <div class="content-campo">
                            {{-- @csrf --}}
                            <div class="info">
                                <div class="content-info">
                                    <p>Cliente: </p>
                                    <p>{{auth()->user()->name}}</p>
                                </div>
                                <div class="content-info">
                                    <p>Sub_total: </p>
                                    <p></p>
                                </div>
                                <div class="content-info">
                                    <p>Descuento: </p>
                                    <p style="color:red"></p>
                                </div>
                                <div class="content-info">
                                    <p>IVA: </p>
                                    <p></p>
                                </div>
                                <div class="content-info" id="sin-propina-info">
                                    <p>Total: </p>
                                    <p></p>
                                </div>
                            </div>

                            <hr>

                            <div class="campo esconder d-none">
                                <label for="num_pedido" class="form-label">num_pedido</label>
                                <input type="number" class="num_pedido" id="num_pedido" value="{{$cantidad_pedidos + 1}}">
                                @error('num_pedido')
                                    <p class="text-error">{{$message}}</p>
                                @enderror
                            </div>

                            <div class="campo esconder d-none">
                                <label for="fecha_hora" class="form-label">Fecha y Hora</label>
                                <input type="datetime-local" class="fecha_hora" id="fecha_hora" value="{{$fechaHoraActual}}">
                                @error('fecha_hora')
                                    <p class="text-error">{{$message}}</p>
                                @enderror
                            </div>

                            <div class="campo d-none">
                                <label for="id_cliente" class="form-label">Cliente</label>
                                <input type="text" class="id_cliente" id="id_cliente" value="{{auth()->user()->id}}">
                                @error('id_cliente')
                                    <p class="text-error">{{$message}}</p>
                                @enderror
                            </div>

                            <div class="campo d-none">
                                <label for="sub_total" class="form-label">Sub_total</label>
                                <input type="text" class="sub_total" id="sub_total" value="">
                                @error('sub_total')
                                    <p class="text-error">{{$message}}</p>
                                @enderror
                            </div>

                            <div class="campo d-none">
                                <label for="descuento" class="form-label">Descuento</label>
                                <input type="text" class="descuento" id="descuento" value="">
                                @error('descuento')
                                    <p class="text-error">{{$message}}</p>
                                @enderror
                            </div>

                            <div class="campo d-none">
                                <label for="iva" class="form-label">IVA</label>
                                <input type="text" class="iva" id="iva"  value="">
                                @error('iva')
                                    <p class="text-error">{{$message}}</p>
                                @enderror
                            </div>

                            {{-- <div class="campo">
                                <label for="propina" class="form-label">Propina</label>
                                <input type="number" class="propina" id="propina" name="propina" value="">
                                @error('propina')
                                    <p class="text-error">{{$message}}</p>
                                @enderror
                            </div> --}}


                            <div class="select">
                                <label for="id_tipo_pago">Tipo de Pago</label>
                                <select id="id_tipo_pago">
                                    {{-- <option value="" disabled selected>Seleccione Pago</option> --}}
                                    @foreach ($tipo_pagos as $tipo_pago)
                                        <option {{ old('id_tipo_pago') == $tipo_pago->id ? 'selected' : '' }} value="{{$tipo_pago->id}}">{{$tipo_pago->tipo_pago}}</option>
                                    @endforeach
                                </select>
                                @error('id_tipo_pago')
                                    <p class="text-error">{{$message}}</p>
                                @enderror
                            </div>

                            @foreach ($empresas as $empresa)
                                @if (($empresa->id == $idEmpresa) && ($empresa->tipo_licencia == 'coffee'))
                                    <div class="select">
                                        <label for="id_tipo_pedido">Tipo de Pedido</label>
                                        <select id="id_tipo_pedido">
                                            {{-- <option value="" disabled selected>Seleccione Pedido</option> --}}
                                            @foreach ($tipo_pedidos as $tipo_pedido)
                                                <option {{ old('id_tipo_pedido') == $tipo_pedido->id ? 'selected' : '' }} value="{{$tipo_pedido->id}}">{{$tipo_pedido->tipo_pedido}}</option>
                                            @endforeach
                                        </select>
                                        @error('id_tipo_pedido')
                                            <p class="text-error">{{$message}}</p>
                                        @enderror
                                    </div>
                                @endif
                            @endforeach

                            @foreach ($empresas as $empresa)
                                @if (($empresa->id == $idEmpresa) && ($empresa->tipo_licencia == 'coffee'))
                                    <div class="select">
                                        <label for="id_tipo_entrega">Tipo de Entrega</label>
                                        <select id="id_tipo_entrega">
                                            @foreach ($tipo_entregas as $tipo_entrega)
                                                <option {{ old('id_tipo_entrega') == $tipo_entrega->id ? 'selected' : '' }} value="{{$tipo_entrega->id}}">{{$tipo_entrega->tipo_entrega}}</option>
                                            @endforeach
                                        </select>
                                        @error('id_tipo_entrega')
                                            <p class="text-error">{{$message}}</p>
                                        @enderror
                                    </div>
                                @endif
                            @endforeach

                            @foreach ($empresas as $empresa)
                                @if (($empresa->id == $idEmpresa) && ($empresa->tipo_licencia === 'pos'))
                                    <div class="select">
                                        <label for="tipo_documento">Tipo de Factura</label>
                                        <select id="tipo_documento">
                                            <option value="contado">Contado</option>
                                            <option value="credito">Crédito</option>
                                        </select>
                                        @error('tipo_documento')
                                            <p class="text-error">{{$message}}</p>
                                        @enderror
                                    </div>
                                    @break
                                @elseif (($empresa->id == $idEmpresa) && ($empresa->tipo_licencia === 'coffee'))
                                    <div class="select d-none">
                                        <label for="tipo_documento">Tipo de Factura</label>
                                        <select id="tipo_documento">
                                            <option value="contado" selected>Contado</option>
                                        </select>
                                        @error('tipo_documento')
                                            <p class="text-error">{{$message}}</p>
                                        @enderror
                                    </div>
                                    @break
                                @endif
                            @endforeach

                            @foreach ($empresas as $empresa)
                                @if (($empresa->id == $idEmpresa) && ($empresa->tipo_licencia == 'coffee'))
                                    <div class="select">
                                        <label for="">Tiempo de Preparación</label>
                                        @foreach ($empresas as $empresa)
                                            @if ($empresa->id == $idEmpresa)
                                                <p>{{$empresa->tiempo_preparacion}}</p>
                                            @endif
                                        @endforeach
                                    </div>
                                @endif
                            @endforeach

                            <div class="campo">
                                <label for="adjuntar_imagen" class="form-label">Adjuntar Comprobante</label>
                                <input type="file" class="adjuntar_imagen" id="adjuntar_imagen" value="">
                                @error('adjuntar_imagen')
                                    <p class="text-error">{{$message}}</p>
                                @enderror
                            </div>

                            {{-- <div class="" id="direcciones" style="display: none;">
                                @if (auth()->check())
                                <label for="option1">
                                    <input type="radio" id="option1" name="direccion" value="{{auth()->user()->direccion1}}">
                                    {{auth()->user()->direccion1}}
                                </label>
                                <br>
                                <label for="option2">
                                  <input type="radio" id="option2" name="direccion" value="{{auth()->user()->direccion2}}">
                                  {{auth()->user()->direccion2}}
                                </label>
                                <br>
                                <label for="option3">
                                    <input type="radio" id="option3" name="direccion" value="{{auth()->user()->direccion3}}">
                                    {{auth()->user()->direccion3}}
                                </label>
                                @endif
                            </div> --}}

                            <div class="campo d-none">
                                <label for="latitud" class="form-label">latitud</label>
                                <input type="text" class="latitud" id="latitud" value="">
                            </div>

                            <div class="campo d-none">
                                <label for="longitud" class="form-label">longitud</label>
                                <input type="text" class="longitud" id="longitud" value="">
                            </div>
                            <hr>

                            <div class="contenedor-cantidad-articulos">
                                {{--  --}}
                                {{--  --}}
                            </div>

                            {{-- @foreach ($empresas as $empresa)
                                @if (($empresa->id == $idEmpresa) && ($empresa->tipo_licencia == 'coffee'))
                                    <label>
                                        <input type="checkbox" name="propina" id="propina-checkbox" value="Si">
                                        ¿Desea dar propina?
                                    </label>
                                @endif
                            @endforeach --}}

                            <label>
                                <input type="checkbox" id="factura_electronica" value="Si">
                                ¿Desea factura electrónica?
                            </label>

                            <label>
                                <input type="checkbox" id="cerrar_pedido" value="1">
                                Cerrar pedido
                            </label>

                            <div class="campo esconder d-none">
                                <label for="id_estado" class="form-label">Estado</label>
                                <input type="text" class="id_estado" id="id_estado" value="1">
                                @error('id_estado')
                                    <p class="text-error">{{$message}}</p>
                                @enderror
                            </div>
                        </div>

                        <div class="modal-footer">
                            <button type="button" class="close-btn" data-dismiss="modal"><ion-icon name="close-outline"></ion-icon> Cerrar</button>
                            <button type="submit" class="finalizar-btn" id="enviarBtn"><ion-icon name="checkmark-done-outline"></ion-icon> Finalizar Compra</button>
                            <a href="/9" class="ir"></a>
                            {{-- <button type="submit" class="finalizar-btn" onclick="enviarFormulario()" id="enviarBtn"><ion-icon name="checkmark-done-outline"></ion-icon> Finalizar Compra</button> --}}
                        </div>
                    </form>
                    @endif
                </div>
            </div>
        </div>
    </div>
    <!-- Fin Modal -->


    <script nomodule src="https://unpkg.com/ioniccart_updateons@7.1.0/dist/ionicons/ionicons.js"></script>
    <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>

    <script>
        const usuario = '{!! json_encode($usuarioAuth) !!}'
        const pedidos = JSON.parse('{!! json_encode($pedidos) !!}')
        const detallePedidos = JSON.parse('{!! json_encode($detalle_pedidos) !!}')
        let idProducts = []

        pedidos.forEach(item => {
            if (item.id_cliente == parseInt(usuario) && item.cerrar_pedido == 0) {
                mandarPedido(item.num_pedido)
            }
        });

        function mandarPedido(numPedido) {
            detallePedidos.forEach(item => {
                if (item.num_pedido == numPedido) {
                    // console.log(item.id_producto)
                    idProducts.push({id:item.id})
                }
            })
        }

        sessionStorage.setItem('idProducts', JSON.stringify(idProducts))
    </script>
</body>
</html>
