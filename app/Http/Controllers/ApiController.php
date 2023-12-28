<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Category;
use App\Models\Address;
use App\Models\Detail;
use App\Models\Order;
use App\Models\Product;
use App\Models\ProductModifier;
use App\Models\Setup;
use App\Models\State;
use App\Models\TypeDelivery;
use App\Models\TypeOrder;
use App\Models\TypePay;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class ApiController extends Controller
{
        //Registro
        public function register(Request $request){
            $validateData = $request->validate([
                'name' => 'required|string|max:255',
                'email' => 'required|string|email|max:255|unique:users',
                'password' => 'required|string|min:8',
            ]);

            $user = User::create([
                'name' => $validateData['name'],
                'email' => $validateData['email'],
                'password' =>  Hash::make($validateData['password']),
            ]);

            $token = $user->createToken('auth_token')->plainTextToken;

            return response()->json([
                'access_token' => $token,
                'token_type' => 'Bearer',
            ], 200);
        }

        // Login
        public function login(Request $request){
            if (!Auth::attempt($request->only('email','password'))) {
                return response()->json(['Mensaje' => 'Inicio Invalido'],404);
            }

            $user = User::where('email', $request['email'])->firstOrFail();

            $token = $user->createToken('auth_token')->plainTextToken;

            return response()->json([
                'access_token' => $token,
                'token_type' => 'Bearer',
            ], 200);
        }

        // Ver informacion por token
        public function infouser(Request $request){
            return $request->user();
        }

    // ================ Usuarios =====================
    public function getUser(){
        return response()->json(User::all(),200);
    }

    public function getUserid($id){
        $usuario = User::find($id);
        if (is_null($usuario)) {
            return response()->json(["message"=>"Registro no encontrado"],404);
        }
        return response()->json($usuario,200);
    }

    public function insertUser(Request $request){
        $usuario = User::create($request->all());
        if (is_null($usuario)) {
            return response()->json(["message"=>"No se pudo insertar"],404);
        }
        return response()->json($usuario,200);
    }

    public function updateUser(Request $request, $id){
        $usuario = User::find($id);
        if (is_null($usuario)) {
            return response()->json(["message"=>"Registro no encontrado"],404);
        }
        $usuario->update($request->all());
        return response()->json($usuario,200);
    }

    public function deleteUser($id){
        $usuario = User::find($id);
        if (is_null($usuario)) {
            return response()->json(["message"=>"No se pudo eliminar"],404);
        }
        $usuario->delete();
        return response()->json(["message"=>"Registro eliminado"],200);
    }

    // ============= Categoria Productos ==============
    public function getCategoriaProductoPorCategoriaCedula($categoria, $empresa) {
        $categoria_producto = Category::where('categoria', $categoria)
            ->where('id_empresa', $empresa)
            ->get();

        return response()->json($categoria_producto, 200);
    }

    public function getCategoriaProductoPorEmpresa($empresa) {
        $categoria_producto = Category::where('id_empresa', $empresa)->get();

        return response()->json($categoria_producto, 200);
    }

    public function getCategoriaProducto(){
        return response()->json(Category::all(),200);
    }

    public function getCategoriaProductoid($id){
        $categoria_producto = Category::find($id);
        if (is_null($categoria_producto)) {
            return response()->json(["message"=>"Registro no encontrado"],404);
        }
        return response()->json($categoria_producto,200);
    }

    // public function insertCategoriaProducto(Request $request){
    //     $categoria_producto = CategoriasProducto::create($request->all());
    //     if (is_null($categoria_producto)) {
    //         return response()->json(["message"=>"No se pudo insertar"],404);
    //     }
    //     return response()->json($categoria_producto,200);
    // }
    public function insertCategoriaProducto(Request $request){
        $productos = $request->all();
        // $arreglo = [];
        foreach($productos as $producto){
            $productos = Category::create($producto);
            // $arreglo[] = $productos;
        }
        // return response()->json($arreglo,200);
        return response()->json([
            "message" => "Registro insertado con éxito.",
            "status" => "OK"
        ], 200);
    }

    public function updateCategoriaProducto(Request $request, $id){
        $categoria_producto = Category::find($id);
        if (is_null($categoria_producto)) {
            return response()->json(["message"=>"Registro no encontrado"],404);
        }
        $categoria_producto->update($request->all());
        return response()->json($categoria_producto,200);
    }

    public function updateCategoria(Request $request)
    {
        $productos = $request->all();
        // $productosActualizados = [];

        foreach ($productos as $productoData) {
            $id = $productoData['id'];
            $producto = Category::find($id);

            if (!is_null($producto)) {
                $producto->update($productoData);
                // $productosActualizados[] = $producto;
            }else{
                Category::create($productoData);
            }
        }

        // return response()->json($productosActualizados, 200);
        return response()->json([
            "message" => "Registro actualizado con éxito.",
            "status" => "OK"
        ], 200);
    }

    public function deleteCategoriaProducto($id){
        $categoria_producto = Category::find($id);
        if (is_null($categoria_producto)) {
            return response()->json(["message"=>"No se pudo eliminar"],404);
        }
        $categoria_producto->delete();
        return response()->json(["message"=>"Registro eliminado"],200);
    }

    // ============= Clientes ==============
    // public function getCliente(){
    //     return response()->json(User::all(),200);
    // }

     // ============= Detalle Pedido ==============
    public function getDetallePedido(){
        return response()->json(Detail::all()->load('producto','modificadorProducto1','modificadorProducto2','modificadorProducto3'),200);
    }

        public function getDetallePedidoid($id){
        $detalle_pedido = Detail::find($id);
        if (is_null($detalle_pedido)) {
            return response()->json(["message"=>"Registro no encontrado"],404);
        }
        return response()->json($detalle_pedido->load('producto','modificadorProducto1','modificadorProducto2','modificadorProducto3'),200);
    }

    public function insertDetallePedidoo(Request $request){
        $detalle_pedido = $request->all();

        foreach ($detalle_pedido as $detalleData) {
            Detail::create($detalleData);
        }

        return response()->json([
            "message" => "Registro insertados con éxito.",
            "status" => "OK"
        ], 200);
        
        // $detalle_pedido = Detail::create($request->all());
        // if (is_null($detalle_pedido)) {
        //     return response()->json(["message"=>"No se pudo insertar"],404);
        // }
        // return response()->json($detalle_pedido,200);
    }

    public function updateDetallePedido(Request $request, $id){
        $detalle_pedido = Detail::find($id);
        if (is_null($detalle_pedido)) {
            return response()->json(["message"=>"Registro no encontrado"],404);
        }
        $detalle_pedido->update($request->all());
        return response()->json($detalle_pedido,200);
    }

    public function deleteDetallePedido(Request $request){
        $ids = $request->all();

        foreach ($ids as $id) {
            $detalle_pedido = Detail::find($id);
            
            $detalle_pedido->delete();
            // if (!is_null($detalle_pedido)) {
            // }
        }
    
        return response()->json(["message" => "Registros eliminados"], 200);

        // $detalle_pedido = Detail::find($id);
        // if (is_null($detalle_pedido)) {
        //     return response()->json(["message"=>"No se pudo eliminar"],404);
        // }
        // $detalle_pedido->delete();
        // return response()->json(["message"=>"Registro eliminado"],200);
    }

     // =========== Direcciones Cliente ===========
    public function getDireccionesCliente(){
        return response()->json(Address::all(),200);
    }

        public function getDireccionesClienteid($id){
        $direccion_cliente = Address::find($id);
        if (is_null($direccion_cliente)) {
            return response()->json(["message"=>"Registro no encontrado"],404);
        }
        return response()->json($direccion_cliente,200);
    }

    public function insertDireccionesCliente(Request $request){
        $direccion_cliente = Address::create($request->all());
        if (is_null($direccion_cliente)) {
            return response()->json(["message"=>"No se pudo insertar"],404);
        }
        return response()->json($direccion_cliente,200);
    }

    public function updateDireccionesCliente(Request $request, $id){
        $direccion_cliente = Address::find($id);
        if (is_null($direccion_cliente)) {
            return response()->json(["message"=>"Registro no encontrado"],404);
        }
        $direccion_cliente->update($request->all());
        return response()->json($direccion_cliente,200);
    }

    public function deleteDireccionesCliente($id){
        $direccion_cliente = Address::find($id);
        if (is_null($direccion_cliente)) {
            return response()->json(["message"=>"No se pudo eliminar"],404);
        }
        $direccion_cliente->delete();
        return response()->json(["message"=>"Registro eliminado"],200);
    }

     // ============= Empresa ==============
     public function getEmpresaPorCedulaPais($cedula, $pais) {
        $empresas = Setup::where('cedula', $cedula)
            ->where('pais', $pais)
            ->get();

        return response()->json($empresas, 200);
    }

    public function getEmpresa(){
        return response()->json(Setup::all(),200);
    }

    public function getEmpresaid($id){
        $empresa = Setup::find($id);
        if (is_null($empresa)) {
            return response()->json(["message"=>"Registro no encontrado"],404);
        }
        return response()->json($empresa,200);
    }

    public function insertEmpresa(Request $request){
        $empresa = Setup::create($request->all());
        if (is_null($empresa)) {
            return response()->json(["message"=>"No se pudo insertar"],404);
        }
        return response()->json($empresa,200);
    }

    public function updatetEmpresa(Request $request, $id){
        $empresa = Setup::find($id);
        if (is_null($empresa)) {
            return response()->json(["message"=>"Registro no encontrado"],404);
        }
        $empresa->update($request->all());
        return response()->json($empresa,200);
    }

    public function deleteEmpresa($id){
        $empresa = Setup::find($id);
        if (is_null($empresa)) {
            return response()->json(["message"=>"No se pudo eliminar"],404);
        }
        $empresa->delete();
        return response()->json(["message"=>"Registro eliminado"],200);
    }

     // ============= Estado ==============
    public function getEstado(){
        return response()->json(State::all(),200);
    }

        public function getEstadoid($id){
        $estado = State::find($id);
        if (is_null($estado)) {
            return response()->json(["message"=>"Registro no encontrado"],404);
        }
        return response()->json($estado,200);
    }

    public function insertEstado(Request $request){
        $estado = State::create($request->all());
        if (is_null($estado)) {
            return response()->json(["message"=>"No se pudo insertar"],404);
        }
        return response()->json($estado,200);
    }

    public function updateEstado(Request $request, $id){
        $estado = State::find($id);
        if (is_null($estado)) {
            return response()->json(["message"=>"Registro no encontrado"],404);
        }
        $estado->update($request->all());
        return response()->json($estado,200);
    }

    public function deleteEstado($id){
        $estado = State::find($id);
        if (is_null($estado)) {
            return response()->json(["message"=>"No se pudo eliminar"],404);
        }
        $estado->delete();
        return response()->json(["message"=>"Registro eliminado"],200);
    }

     // ========== Modificadores Producto =========
     public function getModificadorEmpresa($modificador, $empresa) {
        $modificador_producto = ProductModifier::where('modificador', $modificador)
            ->where('id_empresa', $empresa)
            ->get();

        return response()->json($modificador_producto, 200);
    }

     public function getModificadorPorEmpresa($empresa) {
        $modificador_producto = ProductModifier::where('id_empresa', $empresa)->get();

        return response()->json($modificador_producto, 200);
    }

    public function getModificadoresProducto(){
        return response()->json(ProductModifier::all(),200);
    }

        public function getModificadoresProductoid($id){
        $modificador_producto = ProductModifier::find($id);
        if (is_null($modificador_producto)) {
            return response()->json(["message"=>"Registro no encontrado"],404);
        }
        return response()->json($modificador_producto,200);
    }

    // public function insertModificadoresProducto(Request $request){
    //     $modificador_producto = ModificadoresProducto::create($request->all());
    //     if (is_null($modificador_producto)) {
    //         return response()->json(["message"=>"No se pudo insertar"],404);
    //     }
    //     return response()->json($modificador_producto,200);
    // }
    public function insertModificadoresProducto(Request $request){

        $modificador_productos = $request->all();
        $arreglo = [];

        foreach ($modificador_productos as $modificador_producto) {
            $modificadores = ProductModifier::create($modificador_producto);
            $arreglo[] = $modificadores;
        }

        // return response()->json($arreglo,200);

        return response()->json([
            "Message"=>"Modificadores Insertados",
            "Status"=>"OK",
        ],200);

    }

    public function updateModificadoresProducto(Request $request, $id){
        $modificador_producto = ProductModifier::find($id);
        if (is_null($modificador_producto)) {
            return response()->json(["message"=>"Registro no encontrado"],404);
        }
        $modificador_producto->update($request->all());
        return response()->json($modificador_producto,200);
    }

    public function updateModificadores(Request $request)
    {
        $datos = $request->all();
        $productosActualizados = [];

        foreach ($datos as $dato) {
            $id = $dato['id'];
            $modificador = ProductModifier::find($id);

            if (!is_null($modificador)) {
                $modificador->update($dato);
                $productosActualizados[] = $modificador;
            }else{
                ProductModifier::create($modificador);
            }
        }

        // return response()->json($productosActualizados, 200);

        return response()->json([
            "message" => "Registro actualizado con éxito.",
            "status" => "OK"
        ], 200);
    }

    public function deleteModificadoresProducto($id){
        $modificador_producto = ProductModifier::find($id);
        if (is_null($modificador_producto)) {
            return response()->json(["message"=>"No se pudo eliminar"],404);
        }
        $modificador_producto->delete();
        return response()->json(["message"=>"Registro eliminado"],200);
    }

     // ============= Pedido ==============
    public function getPedidoPorEmpresa($empresa) {
        $pedidos = Order::where('id_empresa', $empresa)
        ->where('id_estado',1)->get();

        // return response()->json($pedidos, 200);
        return response()->json($pedidos->load('empresa','cliente','estado','tipoPago','tipoPedido','tipoEntrega'), 200);
    }


    public function getPedido(){

        $pedidos = Order::where('id_estado', '!=' , 2)->get();
        // return response()->json(Order::all(),200);
        
        return response()->json($pedidos->load('cliente','estado','tipoPago','tipoPedido','tipoEntrega'), 200);

        // return response()->json(Order::all()->load('cliente','estado','tipoPago','tipoPedido','tipoEntrega'),200);
    }

    public function getPedidoid($id){
        $pedido = Order::find($id);
        if (is_null($pedido)) {
            return response()->json(["message"=>"Registro no encontrado"],404);
        }
        // return response()->json($pedido->load('empresa','cliente','estado','tipoPago','tipoPedido','tipoEntrega'),200);
        return response()->json($pedido,200);
    }

    public function insertPedido(Request $request){
        $pedido = Order::create($request->all());
        if (is_null($pedido)) {
            return response()->json(["message"=>"No se pudo insertar"],404);
        }
        return response()->json($pedido,200);
    }

    public function updatePedido(Request $request, $id){
        $pedido = Order::find($id);
        if (is_null($pedido)) {
            return response()->json(["message"=>"Registro no encontrado"],404);
        }
        $pedido->update($request->all());
        return response()->json($pedido,200);
    }

    public function updatePedidos(Request $request)
    {
        $datos = $request->all();
        // $productosActualizados = [];

        foreach ($datos as $dato) {
            $id = $dato['id'];
            $pedido = Order::find($id);

            if (!is_null($pedido)) {
                $pedido->update($dato);
                // $productosActualizados[] = $modificador;
            }else{
                Order::create($pedido);
            }
        }

        // return response()->json($productosActualizados, 200);

        return response()->json([
            "message" => "Registro actualizado con éxito.",
            "status" => "OK"
        ], 200);
    }

    public function deletePedido($id){
        $pedido = Order::find($id);
        if (is_null($pedido)) {
            return response()->json(["message"=>"No se pudo eliminar"],404);
        }
        $pedido->delete();
        return response()->json(["message"=>"Registro eliminado"],200);
    }

    public function deletePedido_x_num_pedido($id){
        $pedido = Order::where('num_pedido', $id);
        $pedido->delete();
        return response()->json(["message"=>"Registro eliminado"],200);
    }

     // ============= Producto ==============
    //  Filtrar X producto X cedula de empresa
     public function getProductoEmpresa($product, $empresa) {
        $producto = Product::where('producto', $product)
            ->where('id_empresa', $empresa)
            ->get();

        return response()->json($producto, 200);
    }

    //  Filtrar X id de empresa
     public function getProducto_id_empresa($empresa) {
        $producto = Product::where('id_empresa', $empresa)->get();

        return response()->json($producto, 200);
    }

    // Todos los productos
    public function getProducto(){
        return response()->json(Product::all(),200);
    }

    // Filtrar X id de producto
    public function getProductoid($id){
        $producto = Product::find($id);
        if (is_null($producto)) {
            return response()->json(["message"=>"Registro no encontrado"],404);
        }
        return response()->json($producto,200);
    }

    // Insertar producto
    // public function insertProducto(Request $request){
    //     $producto = Producto::create($request->all());
    //     if (is_null($producto)) {
    //         return response()->json(["message"=>"No se pudo insertar"],404);
    //     }
    //     return response()->json($producto,200);
    // }

    // Insertar producto como un arreglo
    public function insertProductos(Request $request)
    {
        $productos = $request->all();
        // $productosGuardados = [];

        foreach ($productos as $productoData) {
            Product::create($productoData);
            // $productosGuardados[] = $producto;
        }

        // return response()->json($productosGuardados, 200);
        return response()->json([
            "message" => "Registro insertados con éxito.",
            "status" => "OK"
        ], 200);
    }

    // Actualizar producto X id
    public function updateProducto(Request $request, $id){
        $producto = Product::find($id);
        if (is_null($producto)) {
            return response()->json(["message"=>"Registro no encontrado"],404);
        }
        $producto->update($request->all());
        return response()->json($producto,200);
    }

    // Actualizar productos como arreglo, sino crea el dato
    public function updateProductos(Request $request)
    {
        $productos = $request->all();
        // $productosActualizados = [];

        foreach ($productos as $productoData) {
            $id = $productoData['id'];
            $producto = Product::find($id);

            if (!is_null($producto)) {
                $producto->update($productoData);
                // $productosActualizados[] = $producto;
            }else{
                Product::create($productoData);
            }
        }

        // return response()->json($productosActualizados, 200);
        return response()->json([
            "message" => "Registro actualizado con éxito.",
            "status" => "OK"
        ], 200);
    }

    // Borrar producto
    public function deleteProducto($id){
        $producto = Product::find($id);
        if (is_null($producto)) {
            return response()->json(["message"=>"No se pudo eliminar"],404);
        }
        $producto->delete();
        return response()->json(["message"=>"Registro eliminado"],200);
    }

     // ============= Tipo Entrega ==============
    public function getTipoEntrega(){
        return response()->json(TypeDelivery::all(),200);
    }

        public function getTipoEntregaid($id){
        $tipo_entrega = TypeDelivery::find($id);
        if (is_null($tipo_entrega)) {
            return response()->json(["message"=>"Registro no encontrado"],404);
        }
        return response()->json($tipo_entrega,200);
    }

    public function insertTipoEntrega(Request $request){
        $tipo_entrega = TypeDelivery::create($request->all());
        if (is_null($tipo_entrega)) {
            return response()->json(["message"=>"No se pudo insertar"],404);
        }
        return response()->json($tipo_entrega,200);
    }

    public function updateTipoEntrega(Request $request, $id){
        $tipo_entrega = TypeDelivery::find($id);
        if (is_null($tipo_entrega)) {
            return response()->json(["message"=>"Registro no encontrado"],404);
        }
        $tipo_entrega->update($request->all());
        return response()->json($tipo_entrega,200);
    }

    public function deleteTipoEntrega($id){
        $tipo_entrega = TypeDelivery::find($id);
        if (is_null($tipo_entrega)) {
            return response()->json(["message"=>"No se pudo eliminar"],404);
        }
        $tipo_entrega->delete();
        return response()->json(["message"=>"Registro eliminado"],200);
    }

     // ============= Tipo Pago ==============
    public function getTipoPago(){
        return response()->json(TypePay::all(),200);
    }

        public function getTipoPagoid($id){
        $tipo_pago = TypePay::find($id);
        if (is_null($tipo_pago)) {
            return response()->json(["message"=>"Registro no encontrado"],404);
        }
        return response()->json($tipo_pago,200);
    }

    public function insertTipoPago(Request $request){
        $tipo_pago = TypePay::create($request->all());
        if (is_null($tipo_pago)) {
            return response()->json(["message"=>"No se pudo insertar"],404);
        }
        return response()->json($tipo_pago,200);
    }

    public function updateTipoPago(Request $request, $id){
        $tipo_pago = TypePay::find($id);
        if (is_null($tipo_pago)) {
            return response()->json(["message"=>"Registro no encontrado"],404);
        }
        $tipo_pago->update($request->all());
        return response()->json($tipo_pago,200);
    }

    public function deleteTipoPago($id){
        $tipo_pago = TypePay::find($id);
        if (is_null($tipo_pago)) {
            return response()->json(["message"=>"No se pudo eliminar"],404);
        }
        $tipo_pago->delete();
        return response()->json(["message"=>"Registro eliminado"],200);
    }

     // ============= Tipo Pedido ==============
    public function getTipoPedido(){
        return response()->json(TypeOrder::all(),200);
    }

        public function getTipoPedidoid($id){
        $tipo_pedido = TypeOrder::find($id);
        if (is_null($tipo_pedido)) {
            return response()->json(["message"=>"Registro no encontrado"],404);
        }
        return response()->json($tipo_pedido,200);
    }

    public function insertTipoPedido(Request $request){
        $tipo_pedido = TypeOrder::create($request->all());
        if (is_null($tipo_pedido)) {
            return response()->json(["message"=>"No se pudo insertar"],404);
        }
        return response()->json($tipo_pedido,200);
    }

    public function updateTipoPedido(Request $request, $id){
        $tipo_pedido = TypeOrder::find($id);
        if (is_null($tipo_pedido)) {
            return response()->json(["message"=>"Registro no encontrado"],404);
        }
        $tipo_pedido->update($request->all());
        return response()->json($tipo_pedido,200);
    }

    public function deleteTipoPedido($id){
        $tipo_pedido = TypeOrder::find($id);
        if (is_null($tipo_pedido)) {
            return response()->json(["message"=>"No se pudo eliminar"],404);
        }
        $tipo_pedido->delete();
        return response()->json(["message"=>"Registro eliminado"],200);
    }

}
