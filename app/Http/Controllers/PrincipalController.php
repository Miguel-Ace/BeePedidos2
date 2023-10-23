<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Order;
use App\Models\Setup;
use App\Models\Detail;
use App\Models\Product;
use App\Models\TypePay;
use App\Models\Category;
use App\Models\TypeOrder;
use App\Models\TypeDelivery;
use Illuminate\Http\Request;
use App\Models\ProductModifier;
use Spatie\Permission\Models\Role;
use App\Mail\notificacionesFactura;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Mail;

class PrincipalController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function selectEmpresa(){
        session()->forget('cart');
        session()->forget('cart_modificador');
        $empresas = Setup::paginate(8);
        return view('select_empresa', compact('empresas'));
    }

    public function index(Request $request, $idEmpresa){
        // if (empty($_GET['categoria'])) {
        //     $valorcategoria = 0;
        //     $productos = Producto::where('id_empresa', $idEmpresa)->paginate(9);
        // }else{
        //     $valorcategoria = $_GET['categoria'];
        //     $productos = Producto::all();
        // }
        $productos = Product::all();

        if ($request->has('categoria')) {
          $categoria = $request->categoria;
          $productos = $productos->where('id_categoria', $categoria);
        }

        if (auth()->user()) {
            $usuarioAuth = auth()->user()->id;
        }else{
            $usuarioAuth = 0;
        }
        $empresas = Setup::all();

        foreach ($empresas as $empresa) {
            if ($empresa->id == $idEmpresa) {
                $moneda = $empresa->moneda;
            }    
        }

        $categorias = Category::all();
        $pedidos = Order::all();
        $users = User::all();
        $roles = Role::all();
        $modificadores = ProductModifier::all();
        $detalle_pedidos = Detail::all();

        $id_productos = [];

        function comprobar($detalle_pedidos,$id,&$id_productos) {
            foreach ($detalle_pedidos as $key => $detalle) {
                if ($detalle->num_pedido == $id) {
                    $id_productos[] = [
                        'id' => $detalle->id_producto,
                        'cantidad' => $detalle->cantidad,
                        'id_modificador1' => $detalle->id_modificador1,
                        'id_modificador3' => $detalle->id_modificador2,
                        'id_modificador2' => $detalle->id_modificador3,
                    ];
                }
            }
        }

        foreach ($pedidos as $key => $pedido) {
            if ($pedido->id_cliente == auth()->user()->id) {
                if ($pedido->cerrar_pedido == false) {
                    comprobar($detalle_pedidos,$pedido->num_pedido,$id_productos);
                }
            }
        }

        if (!session()->has('cart')) {
            $cart = session()->get('cart', []);
    
            foreach ($id_productos as $idproducto) {
                $product = Product::findOrFail($idproducto['id']);
    
                $cart = session()->get('cart', []);
    
                $cart[$idproducto['id']] = [
                    "id_producto" => $product->id,
                    "producto" => $product->producto,
                    "url_imagen" => $product->url_imagen,
                    "precio" => $product->precio,
                    "descuento" => $product->descuento,
                    "id_categoria" => $product->id_categoria,
                    "quantity" => $idproducto['cantidad'],
                    "descripcion" => $product->descripcion,
                    "idModificador1" => $idproducto['id_modificador1'],
                    "idModificador2" => $idproducto['id_modificador2'],
                    "idModificador3" => $idproducto['id_modificador3'],
                ];
                session()->put('cart', $cart);
            }
        }

        $orders = Order::all();
        $meterPedidosXId = [];
        foreach ($orders as $orden) {
            if ($orden->id_cliente == auth()->user()->id && $orden->cerrar_pedido == null) {
                array_push($meterPedidosXId, $orden);
            }
        }
        
        $ultimoValue = end($meterPedidosXId);

        return view('productos.index', compact('ultimoValue','id_productos','moneda','usuarioAuth','empresas','productos','categorias','idEmpresa','pedidos','users','roles','modificadores'));
        // return view('productos.index', compact('ultimoValue','moneda','usuarioAuth','empresas','productos','categorias','idEmpresa','pedidos','users','roles','modificadores'));
    }

    // Vista del carrito
    public function cart($idEmpresa)
    {
        $empresas = Setup::all();
        foreach ($empresas as $empresa) {
            if ($empresa->id == $idEmpresa) {
                $moneda = $empresa->moneda;
            }    
        }
        $cantidad_pedidos = Order::count();
        $fechaHoraActual = now()->format('Y-m-d H:i:s');
        $modificadores = ProductModifier::all();
        $tipo_pagos = TypePay::all();
        $tipo_pedidos = TypeOrder::all();
        $tipo_entregas = TypeDelivery::all();
        $pedidos = Order::all();
        $productos = Product::all();
        if (auth()->user()) {
            $usuarioAuth = auth()->user()->id;
        }else{
            $usuarioAuth = 0;
        }

        // if (auth()->check()) {
        //     // La sesión está activa
        //     return view('cart', compact('modificadores','tipo_pagos','tipo_pedidos','tipo_entregas','cantidad_pedidos','fechaHoraActual','idEmpresa'));
        // } else {
        //     // La sesión no está activa
        //     return redirect('/login'.'/'.$idEmpresa);
        // }

        return view('cart', compact('productos','moneda','usuarioAuth','pedidos','empresas','modificadores','tipo_pagos','tipo_pedidos','tipo_entregas','cantidad_pedidos','fechaHoraActual','idEmpresa'));
    }

    // Creando la sessión y Añadir Producto al carrito
    public function addToCart($id, Request $request)
    {
        $product = Product::findOrFail($id);

        $cart = session()->get('cart', []);

        if(isset($cart[$id])) {
            $cart[$id]['quantity']++;
        }  else {
            $cart[$id] = [
                "id_producto" => $product->id,
                "producto" => $product->producto,
                "url_imagen" => $product->url_imagen,
                "precio" => $product->precio,
                "descuento" => $product->descuento,
                "id_categoria" => $product->id_categoria,
                "quantity" => 1,
                "descripcion" => $product->descripcion,
                "idModificador1" => $request->input('id_modificador1'),
                "idModificador2" => $request->input('id_modificador2'),
                "idModificador3" => $request->input('id_modificador3'),
            ];
        }
        session()->put('cart', $cart);

        return redirect()->back()->with('agregado', 'Producto agregado al carrito!');
    }

    // Actualizar cantidad producto
    public function update(Request $request)
    {
        if($request->id && $request->quantity){
            $cart = session()->get('cart');
            $cart[$request->id]["quantity"] = $request->quantity;
            session()->put('cart', $cart);
            session()->flash('actualizado', 'Carrito Actualizado Correctamente!');
        }
    }

    // Eliminar Producto
    public function remove(Request $request)
    {
        $cart = session()->get('cart');
        if(isset($cart[$request->id])) {
            unset($cart[$request->id]);
            session()->put('cart', $cart);
        }
        session()->flash('remover', 'Producto Removido Con Éxito!');
        // if($request->id) {
        // }

        $orders = Order::all();
        $detalles = Detail::all();

        $meterPedidosXId = [];
        foreach ($orders as $orden) {
            if ($orden->id_cliente === auth()->user()->id && ($orden->cerrar_pedido == null || $orden->cerrar_pedido == "0")) {
                array_push($meterPedidosXId, $orden);
            }
        }
        $ultimoValue = end($meterPedidosXId);

        foreach ($detalles as $value) {
            if ($ultimoValue->num_pedido == $value->num_pedido) {
                if ($value->id_producto == $request->id) {
                    Detail::destroy($value->id);
                }
            }
        }
    }

    // Guardar detalle de compra
    public function checkout(Request $request, $idEmpresa)
    {

        $message = request()->validate([
            'num_pedido' => 'required',
            'fecha_hora' => 'required',
            'id_cliente' => 'required',
            'sub_total' => 'required',
            'descuento' => 'required',
            'iva' => 'required',
            'propina' => 'nullable',
            'id_tipo_pago' => 'nullable',
            'factura_electronica' => 'nullable',
            'id_tipo_pedido' => 'nullable',
            'id_tipo_entrega' => 'nullable',
            'adjuntar_imagen' => 'nullable',
            'id_estado' => 'nullable',
            // 'direccion' => 'required',
        ]);

        $productos = Product::all();
        $datos = $request->except('_token');

        $orders = Order::all();
        $detalles = Detail::all();

        $meterPedidosXId = [];
        foreach ($orders as $orden) {
            if ($orden->id_cliente == auth()->user()->id) {
                array_push($meterPedidosXId, $orden);
            }
        }
        
        $ultimoValue = end($meterPedidosXId);
        
        if (empty($ultimoValue) || $ultimoValue->cerrar_pedido == "1") {
            
            $cartItems = session('cart');
    
            foreach ($cartItems as $id => $details) {
    
                foreach ($productos as $producto){
                    if ($producto->producto == $details['producto']) {
                        if ($details['quantity'] <= $producto->existencia) {
                            if ($details['descuento'] != NULL) {
                                $descuento = $details['precio'] * $details['descuento'] / 100;
                
                                $cartItem = new Detail();
                                $cartItem->num_pedido = $request->input('num_pedido');
                                $cartItem->iva = $request->input('iva');
                                $cartItem->enviada_beesy = 'Si';
                
                                $cartItem->id_modificador1 = $details['idModificador1'];
                                $cartItem->id_modificador2 = $details['idModificador2'];
                                $cartItem->id_modificador3 = $details['idModificador3'];
                
                                $cartItem->id_producto = $id;
                                $cartItem->precio = $details['precio'];
                                $cartItem->cantidad = $details['quantity'];
                                $cartItem->descuento = $request->input('descuento');
                                $cartItem->save();
                            }
                            else{
                                $cartItem = new Detail();
                                $cartItem->num_pedido = $request->input('num_pedido');
                                $cartItem->iva = $request->input('iva');
                                $cartItem->enviada_beesy = 'Si';
                
                                $cartItem->id_modificador1 = $details['idModificador1'];
                                $cartItem->id_modificador2 = $details['idModificador2'];
                                $cartItem->id_modificador3 = $details['idModificador3'];
                
                                $cartItem->id_producto = $id;
                                $cartItem->precio = $details['precio'];
                                $cartItem->cantidad = $details['quantity'];
                                // $cartItem->descuento = $details['descuento'];
                                $cartItem->descuento = $request->input('descuento');
                                $cartItem->save();
                            }
                        }else{
                            return redirect()->back();
                        }
                    }
                }
            }

            if ($request->file('adjuntar_imagen')) {
                $datos['adjuntar_imagen'] = $request->file('adjuntar_imagen')->storeAs('archivos', $request->file('adjuntar_imagen')->getClientOriginalName(), 'public');
            }
    
            Order::insert($datos);
            
        }
        elseif(($ultimoValue->cerrar_pedido == null || $ultimoValue->cerrar_pedido == "0") && session()->has('cart')){

            if ($request->file('adjuntar_imagen')) {
                $datos['adjuntar_imagen'] = $request->file('adjuntar_imagen')->storeAs('archivos', $request->file('adjuntar_imagen')->getClientOriginalName(), 'public');
            }

            $pedidoActual = Order::find($ultimoValue->id);
            $datos['num_pedido'] = $pedidoActual->num_pedido;
            Order::where('id','=',$ultimoValue->id)->update($datos);
    
            foreach ($detalles as $value) {
                if ($ultimoValue->num_pedido == $value->num_pedido) {
                    Detail::destroy($value->id);
                }
            }

            function funActualizarDetail($numPedido,$request) {
                $cartItems = session('cart');

                foreach ($cartItems as $id => $details) {
    
                    if ($details['descuento'] != NULL) {
                        $descuento = $details['precio'] * $details['descuento'] / 100;
        
                        $cartItem = new Detail();
                        $cartItem->num_pedido = $numPedido;
                        $cartItem->iva = $request->input('iva');
                        $cartItem->enviada_beesy = 'Si';
        
                        $cartItem->id_modificador1 = $details['idModificador1'];
                        $cartItem->id_modificador2 = $details['idModificador2'];
                        $cartItem->id_modificador3 = $details['idModificador3'];
        
                        $cartItem->id_producto = $id;
                        $cartItem->precio = $details['precio'];
                        $cartItem->cantidad = $details['quantity'];
                        $cartItem->descuento = $request->input('descuento');
                        $cartItem->save();
                    }
                    else{
                        $cartItem = new Detail();
                        $cartItem->num_pedido = $numPedido;
                        $cartItem->iva = $request->input('iva');
                        $cartItem->enviada_beesy = 'Si';
        
                        $cartItem->id_modificador1 = $details['idModificador1'];
                        $cartItem->id_modificador2 = $details['idModificador2'];
                        $cartItem->id_modificador3 = $details['idModificador3'];
        
                        $cartItem->id_producto = $id;
                        $cartItem->precio = $details['precio'];
                        $cartItem->cantidad = $details['quantity'];
                        // $cartItem->descuento = $details['descuento'];
                        $cartItem->descuento = $request->input('descuento');
                        $cartItem->save();
                    }
        
                }
                session()->forget('cart');
            }

            funActualizarDetail($ultimoValue->num_pedido,$request);
        }

        //=============================================================================== 
        // $numSumar = 11;
        // // Funciòn para sacar el checksum sha512
        // // Datos
        // $email = auth()->user()->email;
        // $country = 314;
        // $order = "$numSumar";
        // $money = "CRC";
        // $amount = 10500;
        // $FIXED_HASH = "a8c2f8b6b75649a871939fb751fb442246463012995610903c1bf0182f3641baa9b18ed7a19013850dbc08aea9e5af5e0c8174a26e0ac140e76b1efba7c40f7c";

        // // Concatenar los datos en una cadena
        // $data_string = $email . $country . $order . $money . $amount . $FIXED_HASH;

        // // Calcular el hash SHA-512
        // $hash_result = hash('sha512', $data_string);

        // // Credenciales
        // $merchant = 'comercioncp4';

        // $response = Http::post('https://api-test.payvalida.com/api/v3/porders', [
        //     'merchant' => $merchant,
        //     'email' => $email,
        //     'country' => 314,
        //     'order' => $order,
        //     'money' => 'CRC',
        //     'amount' => '10500',
        //     'description' => 'Orden de prueba',
        //     'method' => '',
        //     'language' => 'es',
        //     'recurrent' => false,
        //     'expiration' => '30/09/2023',
        //     'iva' => '0',
        //     'checksum' => $hash_result,
        //     'user_di' => '94320444',
        //     'user_type_di' => 'CC',
        //     'user_name' => 'Miguel',
        //     'redirect_timeout' => '300000'
        // ]);

        // if ($response->successful()) {
        //     $data = $response->json();
        //     return redirect()->back()->with('apiResponse', $data);
        // } else {
        //     return redirect()->back()->with('mensaje', 'No funcionó');
        // }

        // $correo = new notificacionesFactura($message);
        // $correoUser = auth()->user()->email;
        // Mail::to($correoUser)->queue($correo);
        
        // Limpiar la sesión del carrito después de guardar los detalles en la base de datos.
        $request->session()->forget('cart');
        // Redirigir a una página de confirmación o a la página principal.
        return redirect('/'.$idEmpresa)->with('success_message', 'Compra realizada con éxito.');
    }
}
