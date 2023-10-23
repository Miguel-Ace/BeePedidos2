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
    @vite(['resources/css/app.css','resources/sass/cart.scss','resources/js/app.js','resources/js/app2.js','resources/js/cart.js'])
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

    @if(session('cart'))
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
                @php $ivaTotal = 0 @endphp
                @php $total = 0 @endphp
                @php $total_sin_descuento = 0 @endphp
                @php $descuento_total = 0 @endphp
                {{-- @if(session('cart')) --}}
                    @foreach(session('cart') as $id => $details)
                    {{-- {{$details['id_empresa']}} --}}
                        @if ($details['descuento'] != NULL)

                            {{-- Sacando el descuento para saber cuanto ahorra en dinero el cliente --}}
                            <span class="esconder">{{$descuento_total += ($details['precio'] * $details['descuento'] / 100) * $details['quantity']}}</span>
                            {{-- Sacando el descuento --}}
                            <span class="esconder">{{$descuento = $details['precio'] * $details['descuento'] / 100}}</span>
                            {{-- El total ya con el descuento x producto --}}
                            @php $total += ($details['precio'] - $descuento) * $details['quantity'] @endphp
                            {{-- El total sin el descuento x producto--}}
                            @php $total_sin_descuento += $details['precio'] * $details['quantity'] @endphp

                            <tr data-id="{{ $id }}" class="allTr">
                                <td class="imagen">
                                    <div class=""><img src="{{ $details['url_imagen'] }}" width="100" height="100" class="img-responsive"/></div>
                                </td>

                                <td data-th="producto" class="producto">
                                    <div class="">
                                        <h4 class="nomargin">{{ $details['producto'] }}</h4>
                                    </div>
                                </td>

                                <td data-th="precio" class="precio">{{$moneda}}{{ number_format($details['precio'] , 2)}}</td>

                                <td class="descuento">{{ $details['descuento'] }}%</td>

                                {{-- <td data-th="cantidad" class="cantidad">
                                    <input type="number" value="{{ $details['quantity'] }}" class="form-control quantity cart_update" min="1" />
                                </td> --}}

                                <td data-th="cantidad" class="cantidad">
                                    <div class="input-group">
                                        <button type="button" class="btn btn-outline-secondary quantity-minus">-</button>
                                        <input type="text" disabled style="text-align: center" value="{{ $details['quantity'] }}" class="form-control quantity cart_update" min="1" />
                                        <button type="button" class="btn btn-outline-secondary quantity-plus">+</button>
                                    </div>
                                </td>

                                <td data-th="existencia" class="existencia">
                                    @foreach ($productos as $producto)
                                        @if ($producto->producto == $details['producto'])
                                            <p>{{$producto->existencia}}</p>
                                        @endif
                                    @endforeach
                                </td>

                                <td>
                                    @if (empty($details['idModificador1']) && empty($details['idModificador2']) && empty($details['idModificador3']))
                                        <p>{{$details['descripcion']}}</p>
                                    @else
                                        @foreach ($modificadores as $modificador)
                                            @if ($modificador->id == $details['idModificador1'])
                                                {{$modificador->modificador}}
                                            @endif
                                        @endforeach
                                        @foreach ($modificadores as $modificador)
                                            @if ($modificador->id == $details['idModificador2'])
                                                {{$modificador->modificador}}
                                            @endif
                                        @endforeach
                                        @foreach ($modificadores as $modificador)
                                            @if ($modificador->id == $details['idModificador3'])
                                                {{$modificador->modificador}}
                                            @endif
                                        @endforeach
                                    @endif
                                </td>


                                <td data-th="subtotal" class="subtotal">{{$moneda}}{{number_format(($details['precio'] - $descuento) * $details['quantity'] , 2) }}</td>

                                <td class="iva">{{ number_format($iva = $descuento* $details['quantity'] * 0.10, 2)}}</td>
                                <span class="esconder">{{$ivaTotal += $iva}}</span>

                                <td class="total">{{number_format(($details['precio'] - $descuento) * $details['quantity'] + $iva , 2) }}</td>

                                <td class="delete-product" data-th="">
                                    <button class="cart_remove"><i class="fa-solid fa-trash"></i></button>
                                </td>
                            </tr>
                        @else
                            {{-- <span class="esconder">{{$descuento_total += $details['precio'] * $details['descuento'] / 100}}</span> --}}
                            {{-- Sacando el descuento --}}
                            {{-- <span class="esconder">{{$descuento = $details['precio'] * $details['descuento'] / 100}}</span> --}}
                            @php $total += $details['precio'] * $details['quantity'] @endphp
                            {{-- El total sin el descuento x producto--}}
                            @php $total_sin_descuento += $details['precio'] * $details['quantity'] @endphp
                            <tr data-id="{{ $id }}" class="allTr">
                                <td class="imagen">
                                    <div class=""><img src="{{ $details['url_imagen'] }}" width="100" height="100" class="img-responsive"/></div>
                                </td>

                                <td data-th="producto" class="producto">
                                    <div class="">
                                        <h4 class="nomargin">{{ $details['producto'] }}</h4>
                                    </div>
                                </td>

                                <td data-th="precio" class="precio">{{$moneda}}{{ number_format($details['precio'] , 2)}}</td>

                                <td class="descuento">{{ $details['descuento'] }}-</td>

                                {{-- <td data-th="cantidad" class="cantidad">
                                    <input type="number" value="{{ $details['quantity'] }}" class="form-control quantity cart_update" min="1" />
                                </td> --}}

                                <td data-th="cantidad" class="cantidad">
                                    <div class="input-group">
                                        <button type="button" class="btn btn-outline-secondary quantity-minus">-</button>
                                        <input type="text" disabled style="text-align: center" value="{{ $details['quantity'] }}" class="form-control quantity cart_update" min="1" />
                                        <button type="button" class="btn btn-outline-secondary quantity-plus">+</button>
                                    </div>
                                </td>

                                <td data-th="existencia" class="existencia">
                                    @foreach ($productos as $producto)
                                        @if ($producto->producto == $details['producto'])
                                            <p>{{$producto->existencia}}</p>
                                        @endif
                                    @endforeach
                                </td>

                                <td>
                                    @if (empty($details['idModificador1']) && empty($details['idModificador2']) && empty($details['idModificador3']))
                                        <p>{{$details['descripcion']}}</p>
                                    @else
                                        @foreach ($modificadores as $modificador)
                                            @if ($modificador->id == $details['idModificador1'])
                                                {{$modificador->modificador}}
                                            @endif
                                        @endforeach
                                        @foreach ($modificadores as $modificador)
                                            @if ($modificador->id == $details['idModificador2'])
                                                {{$modificador->modificador}}
                                            @endif
                                        @endforeach
                                        @foreach ($modificadores as $modificador)
                                            @if ($modificador->id == $details['idModificador3'])
                                                {{$modificador->modificador}}
                                            @endif
                                        @endforeach
                                    @endif
                                </td>

                                <td data-th="subtotal" class="subtotal">{{$moneda}}{{ number_format($details['precio'] * $details['quantity'] , 2) }}</td>

                                <td class="iva">{{ number_format($iva = $details['precio'] * $details['quantity'] * 0.10 , 2)}}</td>
                                <span class="esconder">{{$ivaTotal += $iva}}</span>

                                <td class="total">{{ number_format($details['precio'] * $details['quantity'] + $iva , 2)}}</td>

                                <td class="delete-product" data-th="">
                                    <button class="cart_remove"><i class="fa-solid fa-trash"></i></button>
                                </td>
                            </tr>
                        @endif
                    {{-- {{session()->forget('cart');}} --}}

                    @endforeach
                {{-- @endif --}}
            </tbody>
        </table>

        <div class="finalizar-compra-cart">
            <div class="total">Total: {{$moneda}}{{ number_format($total + $ivaTotal , 2)}}</div>

            <div class="acciones">
                <a href="{{ url('/'.$idEmpresa) }}" class=""><ion-icon name="arrow-back-outline"></ion-icon> Continuar Comprando</a>

                {{-- <button class=""><ion-icon name="cash-outline"></ion-icon> Finalizar Compra</button> --}}

                    <!-- Button trigger modal -->

                    @if (auth()->check())
                        <button type="button" class="" data-toggle="modal" data-target="#exampleModalCenter">
                            <ion-icon name="cash-outline"></ion-icon> Procesar Compra
                        </button>
                    @else
                        <a href="{{url('/login-user'.'/'.$idEmpresa)}}" class="inicia-session">
                            <ion-icon name="cash-outline"></ion-icon>
                            Procesar Compra
                        </a>
                    @endif
            </div>
        </div>
    </div>
    @else
        <div class="cart-vacio">
            <img src="{{asset('img/undraw_Slider_re_ch7w.png')}}" alt="">
            <div class="info-sigue-comprando">
                <p class="comentario-sigue-comprando">Tu cesta está vacía. ¡Selecciona un producto del inventario!</p>
                <a href="{{ url('/'.$idEmpresa) }}" class="btn-sigue-comprando">Continuar Comprando</a>
            </div>
        </div>
    @endif




    <!-- Modal -->
    @if(session('cart'))
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
                        <form class="form-factura" method="POST" action="{{ url('/checkout'.'/'.$idEmpresa) }}" enctype="multipart/form-data">
                            @csrf
                            <div class="content-campo">

                                <div class="info">
                                    <div class="content-info">
                                        <p>Cliente: </p>
                                        <p>{{auth()->user()->name}}</p>
                                    </div>
                                    <div class="content-info">
                                        <p>Sub_total: </p>
                                        <p>{{number_format($total_sin_descuento, 2)}}</p>
                                    </div>
                                    <div class="content-info">
                                        <p>Descuento: </p>
                                        <p style="color:red">{{number_format($descuento_total, 2)}}</p>
                                    </div>
                                    <div class="content-info">
                                        <p>IVA: </p>
                                        <p>{{number_format($totalConIva = $total * 0.10, 2)}}</p>
                                    </div>
                                    {{-- Con propina --}}
                                    <div class="content-info" id="propina-info" style="display:none;">
                                        <p>Total: </p>
                                        <p>(10%) {{number_format((($total + $totalConIva) * 0.10) + $total + $totalConIva, 2)}}</p>
                                    </div>
                                    {{-- Sin propina --}}
                                    <div class="content-info" id="sin-propina-info">
                                        <p>Total: </p>
                                        <p>{{number_format($total + $ivaTotal, 2)}}</p>
                                    </div>
                                </div>

                                <hr>

                                <div class="campo esconder d-none">
                                    <label for="num_pedido" class="form-label">num_pedido</label>
                                    <input type="number" class="num_pedido" id="num_pedido" name="num_pedido" value="{{$cantidad_pedidos + 1}}">
                                    @error('num_pedido')
                                        <p class="text-error">{{$message}}</p>
                                    @enderror
                                </div>

                                <div class="campo esconder d-none">
                                    <label for="fecha_hora" class="form-label">Fecha y Hora</label>
                                    <input type="datetime-local" class="fecha_hora" id="fecha_hora" name="fecha_hora" value="{{$fechaHoraActual}}">
                                    @error('fecha_hora')
                                        <p class="text-error">{{$message}}</p>
                                    @enderror
                                </div>

                                <div class="campo d-none">
                                    <label for="id_cliente" class="form-label">Cliente</label>
                                    <input type="text" class="id_cliente" id="id_cliente" name="id_cliente" value="{{auth()->user()->id}}">
                                    @error('id_cliente')
                                        <p class="text-error">{{$message}}</p>
                                    @enderror
                                </div>

                                <div class="campo d-none">
                                    <label for="sub_total" class="form-label">Sub_total</label>
                                    <input type="text" class="sub_total" id="sub_total" name="sub_total" value="{{$total_sin_descuento}}">
                                    @error('sub_total')
                                        <p class="text-error">{{$message}}</p>
                                    @enderror
                                </div>

                                <div class="campo d-none">
                                    <label for="descuento" class="form-label">Descuento</label>
                                    <input type="text" class="descuento" id="descuento" name="descuento" value="{{$descuento_total}}">
                                    @error('descuento')
                                        <p class="text-error">{{$message}}</p>
                                    @enderror
                                </div>

                                <div class="campo d-none">
                                    <label for="iva" class="form-label">IVA</label>
                                    <input type="text" class="iva" id="iva" name="iva" value="{{$total * 0.10}}">
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
                                    <select name="id_tipo_pago" id="id_tipo_pago">
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
                                            <select name="id_tipo_pedido" id="id_tipo_pedido">
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
                                            <select name="id_tipo_entrega" id="id_tipo_entrega">
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
                                            <select name="tipo_documento" id="tipo_documento">
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
                                            <select name="tipo_documento" id="tipo_documento">
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
                                    <input type="file" class="adjuntar_imagen" id="adjuntar_imagen" name="adjuntar_imagen" value="">
                                    @error('adjuntar_imagen')
                                        <p class="text-error">{{$message}}</p>
                                    @enderror
                                </div>

                                <div class="" id="direcciones" style="display: none;">
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
                                </div>

                                <div class="campo d-none">
                                    <label for="latitud" class="form-label">latitud</label>
                                    <input type="text" class="latitud" id="latitud" name="latitud" value="">
                                </div>

                                <div class="campo d-none">
                                    <label for="longitud" class="form-label">longitud</label>
                                    <input type="text" class="longitud" id="longitud" name="longitud" value="">
                                </div>
                                <hr>

                                <div class="contenedor-cantidad-articulos">
                                    {{--  --}}
                                    {{--  --}}
                                </div>

                                @foreach ($empresas as $empresa)
                                    @if (($empresa->id == $idEmpresa) && ($empresa->tipo_licencia == 'coffee'))
                                        <label>
                                            <input type="checkbox" name="propina" id="propina-checkbox" value="Si">
                                            ¿Desea dar propina?
                                        </label>
                                    @endif
                                @endforeach

                                <label>
                                    <input type="checkbox" name="factura_electronica" value="Si">
                                    ¿Desea factura electrónica?
                                </label>

                                <label>
                                    <input type="checkbox" name="cerrar_pedido" value="1">
                                    Cerrar pedido
                                </label>

                                <div class="campo esconder d-none">
                                    <label for="id_estado" class="form-label">Estado</label>
                                    <input type="text" class="id_estado" id="id_estado" name="id_estado" value="1">
                                    @error('id_estado')
                                        <p class="text-error">{{$message}}</p>
                                    @enderror
                                </div>
                            </div>

                            <div class="modal-footer">
                                <button type="button" class="close-btn" data-dismiss="modal"><ion-icon name="close-outline"></ion-icon> Cerrar</button>
                                <button type="submit" class="finalizar-btn" id="enviarBtn"><ion-icon name="checkmark-done-outline"></ion-icon> Finalizar Compra</button>
                            </div>
                        </form>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    @endif
    <!-- Fin Modal -->


    <script nomodule src="https://unpkg.com/ioniccart_updateons@7.1.0/dist/ionicons/ionicons.js"></script>
    <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>

    <script type="text/javascript">
    console.log(JSON.parse(sessionStorage.getItem('sumatoria')));
    const allTrs = document.querySelectorAll('.allTr')

    if (allTrs[0]) {
        allTrs.forEach(e => {
            const cantidadProductosInput = e.querySelector('tr .cantidad .cart_update').value
            const btnElminar = e.querySelector('tr .delete-product button')
            // console.log(btnElminar)
            
            btnElminar.addEventListener('click', () => {
                const restarInput = JSON.parse(sessionStorage.getItem('sumatoria')) - cantidadProductosInput
                sessionStorage.setItem('sumatoria',restarInput)
                console.log(restarInput)
            })
        })
        // console.log('si hay');
    }else{
        sessionStorage.removeItem('sumatoria');
        // console.log('no hay');
    }

    $(".cart_update").change(function (e) {
            e.preventDefault();

            var ele = $(this);

            $.ajax({
                url: '{{ route('update_cart') }}',
                method: "patch",
                data: {
                    _token: '{{ csrf_token() }}',
                    id: ele.parents("tr").attr("data-id"),
                    quantity: ele.parents("tr").find(".quantity").val()
                },
                success: function (response) {
                   window.location.reload();
                }
            });
        });

        $(".cart_remove").click(function (e) {
            e.preventDefault();

            var ele = $(this);

            $.ajax({
                url: '{{ route('remove_from_cart') }}',
                method: "DELETE",
                data: {
                    _token: '{{ csrf_token() }}',
                    id: ele.parents("tr").attr("data-id")
                },
                success: function (response) {
                    window.location.reload();
                }
            });
        });

    </script>

    <script>
        document.querySelectorAll('.quantity-plus').forEach(function(button) {
        button.addEventListener('click', function() {
            var inputField = this.parentElement.querySelector('.quantity');
            var currentVal = parseInt(inputField.value);
            if (!isNaN(currentVal)) {
            inputField.value = currentVal + 1;
            inputField.dispatchEvent(new Event('change')); // dispara el evento de cambio
            const sumar = JSON.parse(sessionStorage.getItem('sumatoria')) + 1
            sessionStorage.setItem('sumatoria',sumar)
            } else {
            inputField.value = 1;
            inputField.dispatchEvent(new Event('change')); // dispara el evento de cambio
            }
        });
        });

        document.querySelectorAll('.quantity-minus').forEach(function(button) {
        button.addEventListener('click', function() {
            var inputField = this.parentElement.querySelector('.quantity');
            var currentVal = parseInt(inputField.value);
            if (!isNaN(currentVal) && currentVal > 1) {
            inputField.value = currentVal - 1;
            inputField.dispatchEvent(new Event('change')); // dispara el evento de cambio
            const restar = JSON.parse(sessionStorage.getItem('sumatoria')) - 1
            sessionStorage.setItem('sumatoria',restar)
            } else {
            inputField.value = 1;
            inputField.dispatchEvent(new Event('change')); // dispara el evento de cambio
            }
        });
        });
    </script>

    <script>
            const propinaCheckbox = document.getElementById("propina-checkbox");
            const propinaInfo = document.getElementById("propina-info");
            const sinPropinaInfo = document.getElementById("sin-propina-info");

            if (propinaCheckbox) {
                propinaCheckbox.addEventListener("change", () => {
                    if (this.checked) {
                        // Si el checkbox está marcado, mostrar el div con propina e ocultar el div sin propina
                        propinaInfo.style.display = "flex";
                        sinPropinaInfo.style.display = "none";
                    } else {
                        // Si el checkbox no está marcado, mostrar el div sin propina e ocultar el div con propina
                        propinaInfo.style.display = "none";
                        sinPropinaInfo.style.display = "flex";
                    }
                });
            }
    </script>

    <script>
            const empresas = JSON.parse('{!! json_encode($empresas) !!}')
            const idEmpresa = JSON.parse('{!! $idEmpresa !!}')
            const finalizarBtn = document.querySelector('.finalizar-btn')
            const contenedorCantidadArticulos = document.querySelector('.contenedor-cantidad-articulos')

            // if (empresas) {
            //     empresas.forEach(item => {
            //         if (item.id == idEmpresa) {
            //             // console.log(item.cantidad_pedidos);
            //             if (finalizarBtn) {
            //                 bloquearBtnEnviar(item.cantidad_pedidos)
            //             }
            //         }
            //     })
            // }

            // ===============================================================
            let nuevoArregloPedidos = []
            const pedidos = JSON.parse('{!! json_encode($pedidos) !!}');
            
            if ('{!! $usuarioAuth !!}' != 0) {
                pedidos.forEach(item => {
                    if (item.id_empresa == '{!! $idEmpresa !!}' && item.id_cliente == '{!! $usuarioAuth !!}') {
                        // console.log(item);
                        nuevoArregloPedidos.push(item)
                    }
                })

                const fechaPedido = nuevoArregloPedidos[nuevoArregloPedidos.length - 1].fecha_hora 
    
                const fecha1 = new Date(fechaPedido).getTime();
                const fecha2 = new Date().getTime();
    
                const diferenciaEnMilisegundos = fecha2 - fecha1;
                const diferenciaEnDias = Math.floor(diferenciaEnMilisegundos / (1000 * 60 * 60 * 24));
    
                console.log(diferenciaEnDias);

                if (diferenciaEnDias > 30 && empresas[idEmpresa - 1].cantidad_pedidos != 0) {
                    if (empresas) {
                        empresas.forEach(item => {
                            if (item.id == idEmpresa) {
                                // console.log(item.cantidad_pedidos);
                                if (finalizarBtn) {
                                    bloquearBtnEnviar(item.cantidad_pedidos)
                                }
                            }
                        })
                    }
                    console.log("llevar minimo de productos");
                } else {
                    console.log("no hay minimo");
                }
            }else{
                if (empresas[idEmpresa - 1].cantidad_pedidos != 0) {
                    if (empresas) {
                        empresas.forEach(item => {
                            if (item.id == idEmpresa) {
                                // console.log(item.cantidad_pedidos);
                                if (finalizarBtn) {
                                    bloquearBtnEnviar(item.cantidad_pedidos)
                                }
                            }
                        })
                    }
                    console.log("llevar minimo de productos");
                } else {
                    console.log("no hay minimo");
                }
            }


            function bloquearBtnEnviar(cantidadPedido) {
                if (JSON.parse(sessionStorage.getItem('sumatoria')) >= parseInt(cantidadPedido)) {
                    finalizarBtn.classList.remove('ocultar')
                }else{
                    finalizarBtn.classList.add('ocultar')
                    finalizarBtn.disabled = true
                    contenedorCantidadArticulos.innerHTML = `
                    <p style="text-align: center;color:red;font-weight:bold">Compra mínima de ${cantidadPedido} articulos</p>
                    `
                }
            }
    </script>
</body>
</html>
