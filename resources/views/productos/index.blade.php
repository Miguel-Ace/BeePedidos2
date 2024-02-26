@extends('layout.app')
@vite(['resources/js/products.js','resources/sass/pantalla_de_carga.scss'])

<span class="user" style="display: none">
    {{$usuarioAuth}}
</span>

<div class="loanding">
    <div class="bolls">
        <span class="sp1"></span>
        <span class="sp2"></span>
        <span class="sp3"></span>
    </div>
</div>

@section('list-categoria')

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

                                <div class="campo">
                                    <label for="password" class="form-label">Password</label>
                                    <input type="password" class="password" id="password" name="password">
                                    @error('password')
                                        <p class="text-error">{{$message}}</p>
                                    @enderror
                                </div>
                            </div>

                            <button type="submit" class="btn-enviar">Guardar</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endif
    {{-- Fin Modal fin editar User --}}

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
                                    <th>Cliente</th>
                                    <th>Descuento</th>
                                    <th>IVA</th>
                                    <th>Sub-total</th>
                                    <th>Estado</th>
                                    <th>-</th>
                                </tr>
                            </thead>
                            @role('usuario')
                            <tbody id="listaParticipante" class="registro_pedidos">
                            </tbody>
                            @endrole

                            @role('Vendedor')
                            <tbody class="registro_pedidos_admin">
                            </tbody>
                            @endrole
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
            {{-- @foreach ($categorias as $categoria)
                <button class="categorias" value="{{ $categoria->id }}">{{ $categoria->categoria }}</button>
            @endforeach --}}
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

    <h1 class="titulo-categoria"></h1>
    <div class="desc-categoria">
        {{-- <p id="pais"></p> --}}
        <p>Elige y personaliza tu pedido a continuación</p>
        <div>
            <input type="text" class="buscador-categoria" placeholder="">
            <ion-icon name="search-outline"></ion-icon>
        </div>
    </div>


    <div class="content-all-products"></div>

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

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
@endsection

@section('list-productos-cart')
    <div class="carrito">
        <p class="tittle-cart">Mi Pedido</p>
        <p class="desc-cart">Aqui podras ver el resumen <br> y totales de tu pedido. <br> Agregados: <span class="totalProductosAgregados"></span></p>

        <div class="dropdown-carrito">
            <div class="productos-agregados"></div>

            <div class="total-carrito">
                <p>Total: <span class="text-precio">0</span></p>
            </div>

            <div class="ver-carrito">
                <a href="{{ url('/cart'.'/'.$idEmpresa) }}" class="confirmar">CONFIRMAR PEDIDO</a>
            </div>
        </div>
    </div>
@endsection
