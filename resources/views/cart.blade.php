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
    @vite(['resources/sass/cart.scss','resources/sass/pantalla_de_carga.scss','resources/js/cart.js'])
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>
<body>

    <span class="user d-none">
        {{$usuarioAuth}}
    </span>
    
    <div class="loanding">
        <div class="bolls">
            <span class="sp1"></span>
            <span class="sp2"></span>
            <span class="sp3"></span>
        </div>
    </div>
    
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
                    {{-- <th>Existencia</th> --}}
                    <th>Modificador</th>
                    <th>Subtotal</th>
                    <th>IVA</th>
                    <th>Total</th>
                    {{-- <th></th> --}}
                </tr>
            </thead>

            {{-- Agregar aquí los productos --}}
            <tbody>
            </tbody>
        </table>

        <div class="finalizar-compra-cart">
            <div class="total"></div>

            <div class="acciones">
                <a href="{{ url('/'.$idEmpresa) }}" class=""><ion-icon name="arrow-back-outline"></ion-icon> Continuar Comprando</a>

                <button type="button" class="procesar" data-toggle="modal" data-target="#exampleModalCenter">
                    <ion-icon name="cash-outline"></ion-icon> Procesar Compra
                </button>
            </div>
        </div>
    </div>


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

                        <div class="content-campo">
                            <div class="info">
                                <div class="content-info cliente">
                                    <p>Cliente: </p>
                                    <p>{{auth()->user()->name}}</p>
                                </div>
                                <div class="content-info sub-total">
                                    <p>Sub_total: </p>
                                    <p></p>
                                </div>
                                <div class="content-info descuento">
                                    <p>Descuento: </p>
                                    <p></p>
                                </div>
                                <div class="content-info iva">
                                    <p>IVA: </p>
                                    <p></p>
                                </div>
                                <div class="content-info total">
                                    <p>Total: </p>
                                    <p></p>
                                </div>
                            </div>

                            <hr>

                            {{-- <label>
                                <input type="checkbox" id="cerrar_pedido" value="1">
                                Cerrar pedido
                            </label> --}}
                            
                            <div class="modal-footer">
                                <button type="button" class="close-btn" data-dismiss="modal"><ion-icon name="close-outline"></ion-icon> Cerrar</button>
                                <button type="submit" class="finalizar-btn" id="enviarBtn"><ion-icon name="checkmark-done-outline"></ion-icon> Finalizar Compra</button>
                                <a href="/9" class="ir"></a>
                                <a href="{{url('/send/email')}}" class="send-factura"></a>
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
    <!-- Fin Modal -->


    <script nomodule src="https://unpkg.com/ioniccart_updateons@7.1.0/dist/ionicons/ionicons.js"></script>
    <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>

</body>
</html>
