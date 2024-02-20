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
use Illuminate\Support\Facades\DB;
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
        $empresas = Setup::paginate(8);
        return view('select_empresa', compact('empresas'));
    }

    public function index(Request $request, $idEmpresa)
    {
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

        return view('productos.index', compact('moneda','usuarioAuth','empresas','productos','categorias','idEmpresa','pedidos','users','roles','modificadores','detalle_pedidos'));
        // return view('productos.index', compact('ultimoValue','moneda','usuarioAuth','empresas','productos','categorias','idEmpresa','pedidos','users','roles','modificadores'));
    }

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

        $detalle_pedidos = Detail::all();

        return view('cart', compact('productos','moneda','usuarioAuth','pedidos','empresas','modificadores','tipo_pagos','tipo_pedidos','tipo_entregas','cantidad_pedidos','fechaHoraActual','idEmpresa','detalle_pedidos'));
    }

    // Enviando el email cuando el user cierra pedido
    public function send_mail_cart() {

        $pedido = Order::where('id_cliente', auth()->user()->id)
                        ->where('cerrar_pedido', 0)
                        ->get();


        // $id_pedido = $pedido->id;
        // $detalle_pedidos = Detail::where('num_pedido', $id_pedido);

        $correo = new notificacionesFactura('');
        $email = auth()->user()->email;
        Mail::to($email)->send($correo);

        return redirect('/9');
    }
}
