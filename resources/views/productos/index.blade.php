@extends('layout.app')
@vite(['resources/js/products.js'])

{{-- <pre>
    {{$ultimoValue}}
</pre> --}}

@section('list-categoria')
    @if (session('success'))
        <script>
            swal({
                title: "¡Éxito!",
                text: "{{ session('success') }}",
                icon: "success",
                button: "Aceptar",
            });
        </script>
    @endif

    @if (session('message'))
        <script>
            swal({
                title: "¡Éxito!",
                text: "{{ session('message') }}",
                icon: "success",
                button: "Aceptar",
            });
        </script>
    @endif

    {{-- Modal Pedidos User --}}
    @if (auth()->check())
    <div class="modal fade" id="exampleModalCenter3" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modificar-modal modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h3 class="modal-title" id="exampleModalLongTitle">Regístro de Pedidos</h3>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <div class="modal-body cuerpo-modal">
                    <div class="table-responsive">
                        <table id="tabla-pedidos" class="tabla-resumen-pedidos">
                            <thead>
                                <tr>
                                    {{-- <th>#</th> --}}
                                    <th>Num-Pedido</th>
                                    <th>Fecha y Hora <input type="date" id="fecha-filtro"></th>
                                    {{-- <th>Empresa</th> --}}
                                    <th>Cliente</th>
                                    <th>Descuento</th>
                                    <th>IVA</th>
                                    <th>Sub-total</th>
                                    <th>Propina</th>
                                    <th>Tipo Pago</th>
                                    <th>Factura Electronica</th>
                                    <th>Tipo Pedido</th>
                                    <th>Tipo Entrega</th>
                                    <th>Imagen</th>
                                    <th>Estado</th>
                                </tr>
                            </thead>
                            <tbody id="listaParticipante">
                                @foreach ($pedidos as $pedido)
                                    <tr>
                                        {{-- <td>$dato->id</td> --}}
                                        <td>{{$pedido->num_pedido}}</td>
                                        <td>{{$pedido->fecha_hora}}</td>
                                        {{-- <td>{{$pedido->id_empresa}}</td> --}}
                                        <td>{{$pedido->cliente->name}}</td>
                                        <td>{{$pedido->descuento}}</td>
                                        <td>{{$pedido->iva}}</td>
                                        <td>{{$pedido->sub_total}}</td>
                                        <td>{{$pedido->propina}}</td>
                                        <td>{{$pedido->tipoPago->tipo_pago}}</td>
                                        <td>{{$pedido->factura_electronica}}</td>
                                        <td>
                                            @if (isset($pedido->tipoPedido->tipo_pedido))
                                                {{$pedido->tipoPedido->tipo_pedido}}
                                            @endif
                                        </td>
                                        <td>
                                            @if (isset($pedido->tipoEntrega->tipo_entrega))
                                                {{$pedido->tipoEntrega->tipo_entrega}}
                                            @endif
                                        </td>
                                        <td>{{$pedido->adjuntar_imagen}}</td>
                                        <td>{{$pedido->estado->estado}}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endif
    {{-- Modal Pedidos User --}}

    {{-- Modal editar User --}}
    @if (auth()->check())
    <div class="modal fade caja-modal" id="exampleModalCenter2" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h3 class="modal-title" id="exampleModalLongTitle">Verifique su informacion</h3>
                    <button type="button" class="close btnclose" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <div class="modal-body cuerpo-modal">
                    <div class="table-responsive">
                        <form class="form edit-user" action="{{url('/panel_clientes'.'/'.auth()->user()->id.'/'.$idEmpresa)}}" method="post" novalidate>
                            @csrf
                            {{method_field('PATCH')}}
                            <div class="content-campo">
                                <div class="campo">
                                    <label for="name" class="form-label">Nombre</label>
                                    <input type="text" class="name" id="name" name="name" value="{{auth()->user()->name}}">
                                    @error('name')
                                        <p class="text-error">{{$message}}</p>
                                    @enderror
                                </div>
                        
                                <div class="campo">
                                    <label for="email" class="form-label">Email</label>
                                    <input type="email" class="email" id="email" name="email" value="{{auth()->user()->email}}">
                                    @error('email')
                                        <p class="text-error">{{$message}}</p>
                                    @enderror
                                </div>
                        
                                <div class="campo">
                                    <label for="telefono" class="form-label">Telefono</label>
                                    <input type="number" class="telefono" id="telefono" name="telefono" value="{{auth()->user()->telefono}}">
                                    @error('telefono')
                                        <p class="text-error">{{$message}}</p>
                                    @enderror
                                </div>
                        
                                <div class="campo">
                                    <label for="cedula" class="form-label">Cédula</label>
                                    <input type="text" class="cedula" id="cedula" name="cedula" value="{{auth()->user()->cedula}}">
                                    @error('cedula')
                                        <p class="text-error">{{$message}}</p>
                                    @enderror
                                </div>
                        
                                <div class="campo">
                                    <label for="tipo_cedula" class="form-label">Tipo Cédula</label>
                                    <select name="tipo_cedula" id="tipo_cedula">
                                        @if (auth()->user()->tipo_cedula == 01)
                                            <option value="01" selected>Cédula Física</option>
                                            <option value="02">Cédula Jurídica</option>
                                            <option value="03">DIMEX</option>
                                            <option value="04">NITE</option>
                                        @elseif (auth()->user()->tipo_cedula == 02)
                                            <option value="01">Cédula Física</option>
                                            <option value="02" selected>Cédula Jurídica</option>
                                            <option value="03">DIMEX</option>
                                            <option value="04">NITE</option>
                                        @elseif (auth()->user()->tipo_cedula == 03)
                                            <option value="01">Cédula Física</option>
                                            <option value="02">Cédula Jurídica</option>
                                            <option value="03" selected>DIMEX</option>
                                            <option value="04">NITE</option>
                                        @else
                                            <option value="01">Cédula Física</option>
                                            <option value="02">Cédula Jurídica</option>
                                            <option value="03">DIMEX</option>
                                            <option value="04" selected>NITE</option>
                                        @endif
                                    </select>
                                    {{-- <input type="text" class="tipo_cedula" id="tipo_cedula" name="tipo_cedula" value="{{auth()->user()->tipo_cedula}}"> --}}
                                    @error('tipo_cedula')
                                        <p class="text-error">{{$message}}</p>
                                    @enderror
                                </div>
            
                                <div class="campo">
                                    <label for="direccion1" class="form-label">Primera Dirección</label>
                                    {{-- <input type="text" class="direccion1" id="direccion1" name="direccion1" value="{{auth()->user()->direccion1}}"> --}}
                                    <textarea name="direccion1" id="direccion1" rows="3">{{auth()->user()->direccion1}}</textarea>
                                    @error('direccion1')
                                        <p class="text-error">{{$message}}</p>
                                    @enderror
                                </div>
            
                                <div class="campo">
                                    <label for="direccion2" class="form-label">Segunda Dirección</label>
                                    {{-- <input type="text" class="direccion2" id="direccion2" name="direccion2" value="{{auth()->user()->direccion2}}"> --}}
                                    <textarea name="direccion2" id="direccion2" rows="3">{{auth()->user()->direccion2}}</textarea>
                                    @error('direccion2')
                                        <p class="text-error">{{$message}}</p>
                                    @enderror
                                </div>
            
                                <div class="campo">
                                    <label for="direccion3" class="form-label">Tercera Dirección</label>
                                    {{-- <input type="text" class="direccion3" id="direccion3" name="direccion3" value="{{auth()->user()->direccion3}}"> --}}
                                    <textarea name="direccion3" id="direccion3" rows="3">{{auth()->user()->direccion3}}</textarea>
                                    @error('direccion3')
                                        <p class="text-error">{{$message}}</p>
                                    @enderror
                                </div>

                                {{-- <div class="campo">
                                    <label for="password" class="form-label">Password</label>
                                    <input type="password" class="password" id="password" name="password">
                                    @error('password')
                                        <p class="text-error">{{$message}}</p>
                                    @enderror
                                </div> --}}
                            </div>
                        
                            <button type="submit" class="btn-enviar">Guardar</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endif
    {{-- Modal fin editar User --}}

    <!-- Modal Roles-->
    <div class="modal fade" id="exampleModalCenter1" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h3 class="modal-title" id="exampleModalLongTitle">Asignar Roles</h3>
                    <button type="button" class="close btnclose" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <div class="modal-body cuerpo-modal">
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>Usuario</th>
                                    <th>Rol</th>
                                    <th>Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($users as $user)
                                    <tr>
                                        <td>{{ $user->name }}</td>
                                        <td>{{ implode(', ', $user->roles()->get()->pluck('name')->toArray()) }}</td>
                                        <td class="accion-rol">
                                            <form action="{{ url('/assign'.'/'.$user->id.'/'.$idEmpresa) }}" method="post">
                                                @csrf
                                                @method('PUT')
                                                <select name="role" id="role" class="form-control">
                                                    @foreach ($roles as $role)
                                                        <option value="{{ $role->name }}" {{ $user->hasRole($role) ? 'selected' : '' }}>{{ $role->name }}</option>
                                                    @endforeach
                                                </select>
                                                <button type="submit" class="actualizar">Asignar</button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Fin Modal Roles-->

    <!-- Modal Registro de Pedidos-->
    <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modificar-modal modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h3 class="modal-title" id="exampleModalLongTitle">Regístro de Pedidos</h3>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <div class="modal-body cuerpo-modal">
                    <div class="table-responsive">
                        <table id="tabla-pedidos" class="tabla-resumen-pedidos">
                            <thead>
                                <tr>
                                    {{-- <th>#</th> --}}
                                    <th>Num-Pedido</th>
                                    <th>Fecha y Hora <input type="date" id="fecha-filtro"></th>
                                    {{-- <th>Empresa</th> --}}
                                    <th>Cliente</th>
                                    <th>Descuento</th>
                                    <th>IVA</th>
                                    <th>Sub-total</th>
                                    <th>Propina</th>
                                    <th>Tipo Pago</th>
                                    <th>Factura Electronica</th>
                                    <th>Tipo Pedido</th>
                                    <th>Tipo Entrega</th>
                                    <th>Imagen</th>
                                    <th>Estado</th>
                                </tr>
                            </thead>
                            <tbody id="listaParticipante">
                                @foreach ($pedidos as $pedido)
                                    @if ($pedido->id_cliente == $usuarioAuth)
                                        <tr>
                                            {{-- <td>$dato->id</td> --}}
                                            <td>{{$pedido->num_pedido}}</td>
                                            <td>{{$pedido->fecha_hora}}</td>
                                            {{-- <td>{{$pedido->id_empresa}}</td> --}}
                                            <td>{{$pedido->cliente->name}}</td>
                                            <td>{{$pedido->descuento}}</td>
                                            <td>{{$pedido->iva}}</td>
                                            <td>{{$pedido->sub_total}}</td>
                                            <td>{{$pedido->propina}}</td>
                                            <td>{{$pedido->tipoPago->tipo_pago}}</td>
                                            <td>{{$pedido->factura_electronica}}</td>
                                            <td>
                                                @if (isset($pedido->tipoPedido->tipo_pedido))
                                                    {{$pedido->tipoPedido->tipo_pedido}}
                                                @endif
                                            </td>
                                            <td>
                                                @if (isset($pedido->tipoEntrega->tipo_entrega))
                                                    {{$pedido->tipoEntrega->tipo_entrega}}
                                                @endif
                                            </td>
                                            <td>{{$pedido->adjuntar_imagen}}</td>
                                            <td>{{$pedido->estado->estado}}</td>
                                        </tr>
                                    @endif
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Fin Modal Registro de Pedidos-->

    <div class="list">
        <div class="contenedor-categoria">
            <ion-icon class="cerrar-categorias" name="close-circle-outline"></ion-icon>
            @foreach ($categorias as $categoria)
                <button class="categorias" value="{{ $categoria->id }}">{{ $categoria->categoria }}</button>
            @endforeach
        </div>
    </div>

@endsection

@section('carrusel')
    <div class="carousel-inner">
        @foreach ($empresas as $empresa)
            @if (($empresa->id == $idEmpresa && $empresa->baner1 != null) && ($empresa->baner2 != null && $empresa->baner3 != null))
                <div class="carousel-item active">
                    <img src="{{$empresa->baner1}}"  class="d-block w-100" alt="Imagen 1">
                </div>
                <div class="carousel-item">
                    <img src="{{$empresa->baner2}}"  class="d-block w-100" alt="Imagen 2">
                </div>
                <div class="carousel-item">
                    <img src="{{$empresa->baner3}}"  class="d-block w-100" alt="Imagen 3">
                </div>
            @endif    
        @endforeach
    </div>
@endsection

@section('list-productos')

    @if (session('success_message'))
        <script>
            sessionStorage.removeItem('sumatoria');
            swal({
                title: "¡Éxito!",
                text: "{{ session('success_message') }}",
                icon: "success",
                button: "Aceptar",
            });
        </script>
    @endif


    <h1 class="titulo-categoria"></h1>
    <div class="desc-categoria">
        {{-- <p id="pais"></p> --}}
        <p>Elige y personaliza tu pedido a continuación</p>
        <div>
            <input type="text" class="buscador-categoria" placeholder="">
            <ion-icon name="search-outline"></ion-icon>
        </div>
    </div>

    @foreach ($productos as $producto)
        @if ($producto->descuento != NULL)
            @if ($producto->activo == true)
                <div class="productos">
                    <div class="content-img">
                        <img src="{{$producto->url_imagen}}" alt="">
                    </div>
                    <div class="descuento"><span>Hasta un -{{$producto->descuento}}%</span> <p>{{$producto->producto}}</p></div>
                    {{-- Sacando el descuento --}}

                    {{-- <span class="ecuacion-descuento">{{$descuento = $producto->precio * $producto->descuento / 100}}</span> --}}

                    <div class="descripcion">{{$producto->descripcion}}</div>
                    
                    <div class="precio">{{$moneda}}<span>{{number_format($producto->precio - ($producto->precio * $producto->descuento / 100), 2)}}</span> <sub>{{$moneda}}{{number_format($producto->precio, 2)}}</sub></div>
                    
                    <div class="existencia">Exist: <span>{{$producto->existencia}}</span></div>

                    <div class="categoria d-none">{{$producto->id_categoria}}</div>
                    <div class="cadProductoBeesy d-none">{{$producto->cod_producto_beesy}}</div>
                    {{-- <div class="descripcion">{{$producto->descripcion}}</div> --}}

                    <form action="{{ route('add_to_cart', $producto->id) }}" method="get">
                        @csrf
                        <div>
                            @php
                                $id_producto1 = 0;
                                $id_producto2 = 0;
                                $id_producto3 = 0;

                                foreach ($modificadores as $modificador) {
                                    if ($modificador->id_producto == $producto->id && ($modificador->tipo_modificador == 1 || $modificador->tipo_modificador == 123)) {
                                        $id_producto1 += $modificador->id_producto;
                                    }
                                }
                                foreach ($modificadores as $modificador) {
                                    if ($modificador->id_producto == $producto->id && ($modificador->tipo_modificador == 2 || $modificador->tipo_modificador == 123)) {
                                        $id_producto2 += $modificador->id_producto;
                                    }
                                }
                                foreach ($modificadores as $modificador) {
                                    if ($modificador->id_producto == $producto->id && ($modificador->tipo_modificador == 3 || $modificador->tipo_modificador == 123)) {
                                        $id_producto3 += $modificador->id_producto;
                                    }
                                }
                            @endphp

                            @if ($id_producto1 == $producto->id)
                                <select name="id_modificador1" id="id_modificador1">
                                    @foreach ($empresas as $empresa)
                                        @if (($empresa->id == $idEmpresa) && ($empresa->tipo_licencia == "pos"))
                                            <option value="" selected disabled>Talla</option>
                                        @else
                                            <option value="" selected disabled>Complemento</option>
                                        @endif
                                    @endforeach

                                    @foreach ($modificadores as $modificador)
                                        @if ($modificador->id_producto == $producto->id && ($modificador->tipo_modificador == 1 || $modificador->tipo_modificador == 123))
                                            <option value="{{$modificador->id}}">{{$modificador->modificador}}</option>
                                        @endif
                                    @endforeach
                                </select>
                            @endif

                            @if ($id_producto2 == $producto->id)
                                <select name="id_modificador2" id="id_modificador2">
                                    @foreach ($empresas as $empresa)
                                        @if (($empresa->id == $idEmpresa) && ($empresa->tipo_licencia == "pos"))
                                            <option value="" selected disabled>Color</option>
                                        @else
                                            <option value="" selected disabled>Preferencia</option>
                                        @endif
                                    @endforeach

                                    @foreach ($modificadores as $modificador)
                                        @if ($modificador->id_producto == $producto->id && ($modificador->tipo_modificador == 2 || $modificador->tipo_modificador == 123))
                                            <option value="{{$modificador->id}}">{{$modificador->modificador}}</option>
                                        @endif
                                    @endforeach
                                </select>
                            @endif

                            @if ($id_producto3 == $producto->id)
                                <select name="id_modificador3" id="id_modificador3">
                                            <option value="" selected disabled>Opción 3</option>
                                    @foreach ($modificadores as $modificador)
                                        @if ($modificador->id_producto == $producto->id && ($modificador->tipo_modificador == 3 || $modificador->tipo_modificador == 123))
                                            <option value="{{$modificador->id}}">{{$modificador->modificador}}</option>
                                        @endif
                                    @endforeach
                                </select>
                            @endif
                        </div>

                        <input class="button" type="submit" value="Agregar">
                    </form>
                    {{-- <a href="{{ route('add_to_cart', $producto->id) }}" class="" role="button">Agregar</a> --}}
                </div>
            @endif
        @else
            @if ($producto->activo == true)
                <div class="productos">
                    <div class="content-img">
                        <img src="{{$producto->url_imagen}}" alt="">
                    </div>
                    <div class="descuento sin-descuento"><p>{{$producto->producto}}</p></div>
                    {{-- Sacando el descuento --}}

                    {{-- <span class="ecuacion-descuento">{{$descuento = $producto->precio * $producto->descuento / 100}}</span> --}}

                    <div class="descripcion">{{$producto->descripcion}}</div>

                    <div class="precio">{{$moneda}}<span>{{number_format($producto->precio, 2)}}</span></div>

                    <div class="existencia">Exist: <span>{{$producto->existencia}}</span></div>

                    <div class="categoria d-none">{{$producto->id_categoria}}</div>
                    <div class="cadProductoBeesy d-none">{{$producto->cod_producto_beesy}}</div>
                    {{-- <div class="descripcion">{{$producto->descripcion}}</div> --}}

                    <form action="{{ route('add_to_cart', $producto->id) }}" method="get">
                        @csrf
                        <div>
                            @php
                                $id_producto1 = 0;
                                $id_producto2 = 0;
                                $id_producto3 = 0;

                                foreach ($modificadores as $modificador) {
                                    if ($modificador->id_producto == $producto->id && ($modificador->tipo_modificador == 1 || $modificador->tipo_modificador == 123)) {
                                        $id_producto1 += $modificador->id_producto;
                                    }
                                }
                                foreach ($modificadores as $modificador) {
                                    if ($modificador->id_producto == $producto->id && ($modificador->tipo_modificador == 2 || $modificador->tipo_modificador == 123)) {
                                        $id_producto2 += $modificador->id_producto;
                                    }
                                }
                                foreach ($modificadores as $modificador) {
                                    if ($modificador->id_producto == $producto->id && ($modificador->tipo_modificador == 3 || $modificador->tipo_modificador == 123)) {
                                        $id_producto3 += $modificador->id_producto;
                                    }
                                }
                            @endphp

                            @if ($id_producto1 == $producto->id)
                                <select name="id_modificador1" id="id_modificador1">
                                    @foreach ($empresas as $empresa)
                                        @if (($empresa->id == $idEmpresa) && ($empresa->tipo_licencia == "pos"))
                                            <option value="" selected disabled>Talla</option>
                                        @else
                                            <option value="" selected disabled>Complemento</option>
                                        @endif
                                    @endforeach

                                    @foreach ($modificadores as $modificador)
                                        @if ($modificador->id_producto == $producto->id && ($modificador->tipo_modificador == 1 || $modificador->tipo_modificador == 123))
                                            <option value="{{$modificador->id}}">{{$modificador->modificador}}</option>
                                        @endif
                                    @endforeach
                                </select>
                            @endif

                            @if ($id_producto2 == $producto->id)
                                <select name="id_modificador2" id="id_modificador2">
                                    @foreach ($empresas as $empresa)
                                        @if (($empresa->id == $idEmpresa) && ($empresa->tipo_licencia == "pos"))
                                            <option value="" selected disabled>Color</option>
                                        @else
                                            <option value="" selected disabled>Preferencia</option>
                                        @endif
                                    @endforeach

                                    @foreach ($modificadores as $modificador)
                                        @if ($modificador->id_producto == $producto->id && ($modificador->tipo_modificador == 2 || $modificador->tipo_modificador == 123))
                                            <option value="{{$modificador->id}}">{{$modificador->modificador}}</option>
                                        @endif
                                    @endforeach
                                </select>
                            @endif

                            @if ($id_producto3 == $producto->id)
                                <select name="id_modificador3" id="id_modificador3">
                                            <option value="" selected disabled>Opción 3</option>
                                    @foreach ($modificadores as $modificador)
                                        @if ($modificador->id_producto == $producto->id && ($modificador->tipo_modificador == 3 || $modificador->tipo_modificador == 123))
                                            <option value="{{$modificador->id}}">{{$modificador->modificador}}</option>
                                        @endif
                                    @endforeach
                                </select>
                            @endif
                        </div>

                        <input class="button" type="submit" value="Agregar">
                    </form>
                    {{-- <a href="{{ route('add_to_cart', $producto->id) }}" class="" role="button">Agregar</a> --}}
                </div>
            @endif
        @endif
    @endforeach

    <script>       
        // Verificar si el navegador soporta geolocalización
        if ("geolocation" in navigator) {
        // Obtener la posición actual del usuario
            navigator.geolocation.getCurrentPosition(successCallback, errorCallback);
        } else {
            // El navegador no soporta geolocalización
            document.getElementById("pais").innerText = "Geolocalización no disponible en este navegador.";
        }

        // Función de éxito para obtener la posición
        function successCallback(position) {
            const latitude = position.coords.latitude;
            const longitude = position.coords.longitude;

            // Hacer una solicitud a un servicio de geolocalización para obtener la información del país
            const url = `https://api.bigdatacloud.net/data/reverse-geocode-client?latitude=${latitude}&longitude=${longitude}&localityLanguage=es`;
            fetch(url)
                .then(response => response.json())
                .then(data => {
                    const country = data.countryName;
                    document.getElementById("pais").innerText = country;
                })
                .catch(error => {
                    console.error("Error al obtener información del país:", error);
                    document.getElementById("pais").innerText = "No se pudo obtener el país.";
                });
        }

        // Función de error si falla la obtención de la posición
        function errorCallback(error) {
            console.error("Error al obtener la posición:", error);
            document.getElementById("pais").innerText = "No se pudo obtener la posición.";
        }
    </script>

    <script>
        //Darle color a la categoria seleccionada
        const contenedorCategoria = document.querySelectorAll('.contenedor-categoria button')
        const tituloCategoria = document.querySelector('.titulo-categoria')
        const productos = document.querySelectorAll('.productos')
    
        let categorias = JSON.parse('{!! json_encode($categorias) !!}');

        contenedorCategoria.forEach(item => {
            item.addEventListener('click', () => {
                contenedorCategoria.forEach(item => {
                    item.classList.remove('active')
                });
                item.classList.toggle('active')
                const valor = parseInt(item.value)
                idValor(valor)
                sessionStorage.setItem('idCategoria', JSON.stringify(valor))
            })
        });


        if (JSON.parse(sessionStorage.getItem('idCategoria')) != null) {
            idValor(JSON.parse(sessionStorage.getItem('idCategoria')))
        }

        function idValor(id) {
            categorias.forEach(categoria => {
                if (categoria.id == id) {
                    tituloCategoria.textContent = categoria.categoria
                    // console.log(categoria.id)
                }
            });

            productos.forEach(product => {
                const idCategoriaProducto = product.querySelector('.categoria').textContent
                if (idCategoriaProducto == id) {
                    product.style.display = ''
                    // product.style.height = '40rem'
                }else{
                    product.style.display = 'none'
                }
            });    
        }
    </script>

    <script>
        const btnCategorias = document.querySelector('.btn-categorias')
        const btnPedidos = document.querySelector('.btn-pedidos')
        const btnCerrarCategorias = document.querySelector('.cerrar-categorias')
        const listCategoria = document.querySelector('.list')

        btnCategorias.onclick = () => {
            listCategoria.style = "display: flex;"
        }
        
        btnCerrarCategorias.onclick = () => {
            listCategoria.style = "display: none;"
        }
    </script>

    <script>
        // sessionStorage.removeItem('sumatoria');
        const empresas = JSON.parse('{!! json_encode($empresas) !!}')
        const idEmpresa = JSON.parse('{!! $idEmpresa !!}')
        const btnAgregar = document.querySelectorAll('.button')
        let sumatoria = JSON.parse(sessionStorage.getItem('sumatoria')) || 0
        // console.log(empresas[idEmpresa - 1].cantidad_pedidos);

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
    
            // console.log(diferenciaEnDias);

            if (diferenciaEnDias > 30 && empresas[idEmpresa - 1].cantidad_pedidos != 0) {
                empresas.forEach(item => {
                    if (item.id == idEmpresa) {
                        // console.log(item.cantidad_pedidos)
                        cantidadPedidos(item.cantidad_pedidos)
                    }
                });
    
                function cantidadPedidos(cantidad) {
                    btnAgregar.forEach(item => {
                        item.addEventListener('click', () => {
                            sumatoria++
                            sessionStorage.setItem('sumatoria',sumatoria)
                            // console.log('click');
                        })
                    });
                }
                // console.log(sumatoria);
                console.log("llevar minimo de productos");
            } else {
                console.log("no hay minimo");
            }
        }else{

            if (empresas[idEmpresa - 1].cantidad_pedidos != 0) {
                empresas.forEach(item => {
                    if (item.id == idEmpresa) {
                        // console.log(item.cantidad_pedidos)
                        cantidadPedidos(item.cantidad_pedidos)
                    }
                });
    
                function cantidadPedidos(cantidad) {
                    btnAgregar.forEach(item => {
                        item.addEventListener('click', () => {
                            sumatoria++
                            sessionStorage.setItem('sumatoria',sumatoria)
                            // console.log('click');
                        })
                    });
                }
                // console.log(sumatoria);
                // console.log("llevar minimo de productos");
            } else {
                // console.log("no hay minimo");
            }
        }
    </script>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js"></script>

    <script>
        $(document).ready(function() {
            $('.carousel').carousel({
                interval: 4000 // Cambio automático cada 5 segundos (5000 ms)
            });
        });
    </script>
@endsection

@section('list-productos-cart')
    <div class="carrito">
        <p class="tittle-cart">Mi Pedido</p>
        <p class="desc-cart">Aqui podras ver el resumen <br> y totales de tu pedido</p>
        {{-- @if (session('cart'))
            <ion-icon name="cart-outline" class="con-producto"></ion-icon> <span class="contidad badge-pill badge-danger">{{ count((array) session('cart')) }}</span>
        @else
            <ion-icon name="cart-outline"></ion-icon> <span class="contidad badge-pill badge-danger">{{ count((array) session('cart')) }}</span>
        @endif --}}
        <div class="dropdown-carrito">
            @if(session('cart'))
                @foreach(session('cart') as $id => $details)
                        @if ($details['descuento'] != NULL)
                            <div class="detalle-carrito">
                                <div class="detalle-img">
                                    <img src="{{ $details['url_imagen'] }}" width="100">
                                </div>
                                <div class="detalle-producto">
                                    <p>{{ $details['producto'] }}</p>
                                    <span class="price text-info">{{$moneda}}{{ number_format(($details['precio'] - ($details['precio'] * $details['descuento'] / 100)) * $details['quantity'] , 2) }}</span> Cantidad: <span class="count">{{ $details['quantity'] }}</span>
                                </div>
                            </div>
                        @else
                            <div class="detalle-carrito">
                                <div class="detalle-img">
                                    <img src="{{ $details['url_imagen'] }}" width="100">
                                </div>
                                <div class="detalle-producto">
                                    <p>{{ $details['producto'] }}</p>
                                    <span class="price text-info"> ${{ number_format($details['precio'] * $details['quantity'] , 2) }}</span> Cantidad: <span class="count">{{ $details['quantity'] }}</span>
                                </div>
                            </div>
                        @endif
                @endforeach
            @else
                <p class="desc-sin-producto">No hay elementos en <br> tu pedido aún</p>
            @endif

            {{-- <div class="productos-agregados">
            </div> --}}

            <div class="total-carrito">
                @php $total = 0 @endphp
                @foreach((array) session('cart') as $id => $details)

                    @if ($details['descuento'] != NULL)
                        {{-- Sacando el descuento --}}
                        <span class="esconder">{{$descuento = $details['precio'] * $details['descuento'] / 100}}</span>
                        @php $total += ($details['precio'] - $descuento) * $details['quantity'] @endphp
                    @else
                        @php $total += $details['precio'] * $details['quantity'] @endphp
                    @endif

                @endforeach
                <p>Total: <span class="text-info">{{$moneda}}{{ number_format($total , 2) }}</span></p>
                {{-- <div class="salir-modal-carrito">X</div> --}}
            </div>

            <div class="ver-carrito">
                {{-- <a href="{{ route('cart') }}" class="">Ver Todo</a> --}}
                @if (session('cart'))
                    <a href="{{ url('/cart'.'/'.$idEmpresa) }}" class="confirmar">CONFIRMAR PEDIDO</a>
                @else
                    <a class="confirmar deshabilitado">CONFIRMAR PEDIDO</a>
                @endif
            </div>
        </div>
    </div>
@endsection