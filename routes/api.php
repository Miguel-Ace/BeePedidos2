<?php

use App\Http\Controllers\ApiController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('/register',[ApiController::class, 'register']);
Route::post('/login',[ApiController::class, 'login']);
Route::post('/userinfo',[ApiController::class, 'infouser'])->middleware('auth:sanctum');

// ================ Usuarios =====================
Route::get('/user', [ApiController::class, 'getUser'])->middleware('auth:sanctum');
Route::get('/user/{id}', [ApiController::class, 'getUserid'])->middleware('auth:sanctum');
Route::post('/user/insert', [ApiController::class, 'insertUser'])->middleware('auth:sanctum');
Route::put('/user/update/{id}', [ApiController::class, 'updateUser'])->middleware('auth:sanctum');
Route::delete('/user/delete/{id}', [ApiController::class, 'deleteUser'])->middleware('auth:sanctum');

// ================ Categoria Productos =====================
Route::get('/categoria_producto/{categoria}/{id_empresa}', [ApiController::class, 'getCategoriaProductoPorCategoriaCedula'])->middleware('auth:sanctum');
Route::get('/categoria_producto_x_empresa/{id_empresa}', [ApiController::class, 'getCategoriaProductoPorEmpresa'])->middleware('auth:sanctum');

Route::get('/categoria_producto', [ApiController::class, 'getCategoriaProducto'])->middleware('auth:sanctum');
Route::get('/categoria_producto/{id}', [ApiController::class, 'getCategoriaProductoid'])->middleware('auth:sanctum');
Route::post('/categoria_producto/insert', [ApiController::class, 'insertCategoriaProducto'])->middleware('auth:sanctum');
Route::put('/categoria_producto/update/{id}', [ApiController::class, 'updateCategoriaProducto'])->middleware('auth:sanctum');
Route::put('/categoria_producto/update', [ApiController::class, 'updateCategoria'])->middleware('auth:sanctum');
Route::delete('/categoria_producto/delete/{id}', [ApiController::class, 'deleteCategoriaProducto'])->middleware('auth:sanctum');

// ================ Detalle Pedido =====================
Route::get('/detalle_pedido', [ApiController::class, 'getDetallePedido'])->middleware('auth:sanctum');
Route::get('/detalle_pedido/{id}', [ApiController::class, 'getDetallePedidoid'])->middleware('auth:sanctum');
Route::post('/detalle_pedido/insert', [ApiController::class, 'insertDetallePedidoo'])->middleware('auth:sanctum');
Route::put('/detalle_pedido/update/{id}', [ApiController::class, 'updateDetallePedido'])->middleware('auth:sanctum');
Route::delete('/detalle_pedido/delete', [ApiController::class, 'deleteDetallePedido'])->middleware('auth:sanctum');

// ================ Dirección Cliente =====================
Route::get('/direccion_cliente', [ApiController::class, 'getDireccionesCliente'])->middleware('auth:sanctum');
Route::get('/direccion_cliente/{id}', [ApiController::class, 'getDireccionesClienteid'])->middleware('auth:sanctum');
Route::post('/direccion_cliente/insert', [ApiController::class, 'insertDireccionesCliente'])->middleware('auth:sanctum');
Route::put('/direccion_cliente/update/{id}', [ApiController::class, 'updateDireccionesCliente'])->middleware('auth:sanctum');
Route::delete('/direccion_cliente/delete/{id}', [ApiController::class, 'deleteDireccionesCliente'])->middleware('auth:sanctum');

// ================ Empresa =====================
Route::get('/empresa/{cedula}/{pais}', [ApiController::class, 'getEmpresaPorCedulaPais'])->middleware('auth:sanctum');

Route::get('/empresa', [ApiController::class, 'getEmpresa'])->middleware('auth:sanctum');
Route::get('/empresa/{id}', [ApiController::class, 'getEmpresaid'])->middleware('auth:sanctum');
Route::post('/empresa/insert', [ApiController::class, 'insertEmpresa'])->middleware('auth:sanctum');
Route::put('/empresa/update/{id}', [ApiController::class, 'updatetEmpresa'])->middleware('auth:sanctum');
Route::delete('/empresa/delete/{id}', [ApiController::class, 'deleteEmpresa'])->middleware('auth:sanctum');

// ================ Estado =====================
Route::get('/estado', [ApiController::class, 'getEstado'])->middleware('auth:sanctum');
Route::get('/estado/{id}', [ApiController::class, 'getEstadoid'])->middleware('auth:sanctum');
Route::post('/estado/insert', [ApiController::class, 'insertEstado'])->middleware('auth:sanctum');
Route::put('/estado/update/{id}', [ApiController::class, 'updateEstado'])->middleware('auth:sanctum');
Route::delete('/estado/delete/{id}', [ApiController::class, 'deleteEstado'])->middleware('auth:sanctum');

// ================ Modificadores Producto =====================
Route::get('/modificador_producto/{modificador}/{empresa}', [ApiController::class, 'getModificadorEmpresa'])->middleware('auth:sanctum');
Route::get('/modificador_producto_x_empresa/{empresa}', [ApiController::class, 'getModificadorPorEmpresa'])->middleware('auth:sanctum');

Route::get('/modificador_producto', [ApiController::class, 'getModificadoresProducto'])->middleware('auth:sanctum');
Route::get('/modificador_producto/{id}', [ApiController::class, 'getModificadoresProductoid'])->middleware('auth:sanctum');
Route::post('/modificador_producto/insert', [ApiController::class, 'insertModificadoresProducto'])->middleware('auth:sanctum');
Route::put('/modificador_producto/update/{id}', [ApiController::class, 'updateModificadoresProducto'])->middleware('auth:sanctum');
Route::put('/modificador_producto/update', [ApiController::class, 'updateModificadores'])->middleware('auth:sanctum');
Route::delete('/modificador_producto/delete/{id}', [ApiController::class, 'deleteModificadoresProducto'])->middleware('auth:sanctum');

// ================ Pedido =====================
Route::get('/pedido_x_empresa/{empresa}', [ApiController::class, 'getPedidoPorEmpresa'])->middleware('auth:sanctum');

Route::get('/pedido', [ApiController::class, 'getPedido'])->middleware('auth:sanctum');
Route::get('/pedido/{id}', [ApiController::class, 'getPedidoid'])->middleware('auth:sanctum');
Route::post('/pedido/insert', [ApiController::class, 'insertPedido']);
Route::put('/pedido/update/{id}', [ApiController::class, 'updatePedido'])->middleware('auth:sanctum');
Route::put('/pedido/update', [ApiController::class, 'updatePedidos'])->middleware('auth:sanctum');
Route::delete('/pedido/delete/{id}', [ApiController::class, 'deletePedido'])->middleware('auth:sanctum');

// ================ Producto =====================
Route::get('/producto/{product}/{empresa}', [ApiController::class, 'getProductoEmpresa'])->middleware('auth:sanctum');
Route::get('/producto_x_empresa/{empresa}', [ApiController::class, 'getProducto_id_empresa'])->middleware('auth:sanctum');

Route::get('/producto', [ApiController::class, 'getProducto'])->middleware('auth:sanctum');
Route::get('/producto/{id}', [ApiController::class, 'getProductoid'])->middleware('auth:sanctum');
Route::post('/producto/insert', [ApiController::class, 'insertProductos'])->middleware('auth:sanctum');
Route::put('/producto/update/{id}', [ApiController::class, 'updateProducto'])->middleware('auth:sanctum');
Route::put('/producto/update', [ApiController::class, 'updateProductos'])->middleware('auth:sanctum');
Route::delete('/producto/delete/{id}', [ApiController::class, 'deleteProducto'])->middleware('auth:sanctum');

// ================ Tipo Entrega =====================
Route::get('/tipo_entrega', [ApiController::class, 'getTipoEntrega'])->middleware('auth:sanctum');
Route::get('/tipo_entrega/{id}', [ApiController::class, 'getTipoEntregaid'])->middleware('auth:sanctum');
Route::post('/tipo_entrega/insert', [ApiController::class, 'insertTipoEntrega'])->middleware('auth:sanctum');
Route::put('/tipo_entrega/update/{id}', [ApiController::class, 'updateTipoEntrega'])->middleware('auth:sanctum');
Route::delete('/tipo_entrega/delete/{id}', [ApiController::class, 'deleteTipoEntrega'])->middleware('auth:sanctum');

// ================ Tipo Pago =====================
Route::get('/tipo_pago', [ApiController::class, 'getTipoPago'])->middleware('auth:sanctum');
Route::get('/tipo_pago/{id}', [ApiController::class, 'getTipoPagoid'])->middleware('auth:sanctum');
Route::post('/tipo_pago/insert', [ApiController::class, 'insertTipoPago'])->middleware('auth:sanctum');
Route::put('/tipo_pago/update/{id}', [ApiController::class, 'updateTipoPago'])->middleware('auth:sanctum');
Route::delete('/tipo_pago/delete/{id}', [ApiController::class, 'deleteTipoPago'])->middleware('auth:sanctum');

// ================ Tipo Pedido =====================
Route::get('/tipo_pedido', [ApiController::class, 'getTipoPedido'])->middleware('auth:sanctum');
Route::get('/tipo_pedido/{id}', [ApiController::class, 'getTipoPedidoid'])->middleware('auth:sanctum');
Route::post('/tipo_pedido/insert', [ApiController::class, 'insertTipoPedido'])->middleware('auth:sanctum');
Route::put('/tipo_pedido/update/{id}', [ApiController::class, 'updateTipoPedido'])->middleware('auth:sanctum');
Route::delete('/tipo_pedido/delete/{id}', [ApiController::class, 'deleteTipoPedido'])->middleware('auth:sanctum');
