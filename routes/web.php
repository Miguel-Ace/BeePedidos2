<?php

use App\Models\Producto;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\EstadoController;
use App\Http\Controllers\LogoutController;
use App\Http\Controllers\PedidoController;
use App\Http\Controllers\ClienteController;
use App\Http\Controllers\EmpresaController;
use App\Http\Controllers\ProductoController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\TipoPagoController;
use App\Http\Controllers\PrincipalController;
use App\Http\Controllers\TipoPedidoController;
use App\Http\Controllers\TipoEntregaController;
use App\Http\Controllers\DetallePedidoController;
use App\Http\Controllers\CategoriasProductoController;
use App\Http\Controllers\DireccionesClienteController;
use App\Http\Controllers\ModificadoresProductoController;
use App\Http\Controllers\PasswordController;
use App\Http\Controllers\RoleController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Route::get('/', function () {
//     return view('principal');
// });

// Muestra el formulario de recuperación de contraseña
Route::get('password/reset', [PasswordController::class, 'showLinkRequestForm'])->name('password.request');
// Envía el correo electrónico con el enlace de restablecimiento de contraseña
Route::post('password/email', [PasswordController::class, 'sendResetLinkEmail'])->name('password.email');
// Muestra el formulario para restablecer la contraseña
Route::get('password/reset/{token}', [PasswordController::class, 'showResetForm'])->name('password.reset');
// Restablece la contraseña
Route::post('password/reset', [PasswordController::class, 'reset'])->name('password.update');


Route::get('/register/{idEmpresa}', [RegisterController::class, 'index']);
Route::post('/register/{idEmpresa}', [RegisterController::class, 'store']);

Route::get('/login/{idEmpresa}', [LoginController::class, 'index']);
Route::post('/login/{idEmpresa}', [LoginController::class, 'store']);
Route::get('/logout/{idEmpresa}', [LogoutController::class, 'store']);

Route::get('/register', [RegisterController::class, 'vista']);
Route::post('/register', [RegisterController::class, 'guardar']);

Route::get('/login', [LoginController::class, 'vista'])->name('login');
Route::post('/login', [LoginController::class, 'guardar']);
// Route::get('/logout', [LogoutController::class, 'guardar'])->name('logout');

Route::get('/register-user/{idEmpresa}', [RegisterController::class, 'vista_register_precio2']);
Route::post('/register-user/{idEmpresa}', [RegisterController::class, 'guardar_register_precio2']);

Route::get('/login-user/{idEmpresa}', [LoginController::class, 'vista_login_precio2']);
Route::post('/login-user/{idEmpresa}', [LoginController::class, 'guardar_login_precio2']);

// Inventario Panel
// Route::resource('/panel_productos/{idEmpresa}', ProductoController::class);
Route::get('panel_productos/{idEmpresa}', [ProductoController::class, 'index']);
Route::post('panel_productos/{idEmpresa}', [ProductoController::class, 'store']);
Route::get('panel_productos/{id}/edit/{idEmpresa}', [ProductoController::class, 'edit']);
Route::patch('panel_productos/{id}/{idEmpresa}', [ProductoController::class, 'update']);
Route::delete('panel_productos/{id}/{idEmpresa}', [ProductoController::class, 'destroy']);

// Route::resource('/panel_categoria_productos', CategoriasProductoController::class);
Route::get('panel_categoria_productos/{idEmpresa}', [CategoriasProductoController::class, 'index']);
Route::post('panel_categoria_productos/{idEmpresa}', [CategoriasProductoController::class, 'store']);
Route::get('panel_categoria_productos/{id}/edit/{idEmpresa}', [CategoriasProductoController::class, 'edit']);
Route::patch('panel_categoria_productos/{id}/{idEmpresa}', [CategoriasProductoController::class, 'update']);
Route::delete('panel_categoria_productos/{id}/{idEmpresa}', [CategoriasProductoController::class, 'destroy']);

// Route::resource('/panel_clientes', ClienteController::class);
Route::get('panel_clientes/{idEmpresa}', [ClienteController::class, 'index']);
Route::post('panel_clientes/{idEmpresa}', [ClienteController::class, 'store']);
Route::get('panel_clientes/{id}/edit/{idEmpresa}', [ClienteController::class, 'edit']);
Route::patch('panel_clientes/{id}/{idEmpresa}', [ClienteController::class, 'update']);
Route::delete('panel_clientes/{id}/{idEmpresa}', [ClienteController::class, 'destroy']);

// Route::resource('/panel_direccion_cliente', DireccionesClienteController::class);
Route::get('panel_direccion_cliente/{idEmpresa}', [DireccionesClienteController::class, 'index']);
Route::post('panel_direccion_cliente/{idEmpresa}', [DireccionesClienteController::class, 'store']);
Route::get('panel_direccion_cliente/{id}/edit/{idEmpresa}', [DireccionesClienteController::class, 'edit']);
Route::patch('panel_direccion_cliente/{id}/{idEmpresa}', [DireccionesClienteController::class, 'update']);
Route::delete('panel_direccion_cliente/{id}/{idEmpresa}', [DireccionesClienteController::class, 'destroy']);

// Route::resource('/panel_empresas', EmpresaController::class);
Route::get('panel_empresas/{idEmpresa}', [EmpresaController::class, 'index']);
Route::post('panel_empresas/{idEmpresa}', [EmpresaController::class, 'store']);
Route::get('panel_empresas/{id}/edit/{idEmpresa}', [EmpresaController::class, 'edit']);
Route::patch('panel_empresas/{id}/{idEmpresa}', [EmpresaController::class, 'update']);
Route::delete('panel_empresas/{id}/{idEmpresa}', [EmpresaController::class, 'destroy']);

// Route::resource('/panel_pedidos', PedidoController::class);
Route::get('panel_pedidos/{idEmpresa}', [PedidoController::class, 'index']);
Route::post('panel_pedidos/{idEmpresa}', [PedidoController::class, 'store']);
Route::get('panel_pedidos/{id}/edit/{idEmpresa}', [PedidoController::class, 'edit']);
Route::patch('panel_pedidos/{id}/{idEmpresa}', [PedidoController::class, 'update']);
Route::delete('panel_pedidos/{id}/{idEmpresa}', [PedidoController::class, 'destroy']);

// Route::resource('/panel_detalle_pedidos', DetallePedidoController::class);
Route::get('panel_detalle_pedidos/{idEmpresa}', [DetallePedidoController::class, 'index']);
Route::post('panel_detalle_pedidos/{idEmpresa}', [DetallePedidoController::class, 'store']);
Route::get('panel_detalle_pedidos/{id}/edit/{idEmpresa}', [DetallePedidoController::class, 'edit']);
Route::patch('panel_detalle_pedidos/{id}/{idEmpresa}', [DetallePedidoController::class, 'update']);
Route::delete('panel_detalle_pedidos/{id}/{idEmpresa}', [DetallePedidoController::class, 'destroy']);

// Route::resource('/panel_modificadores_producto', ModificadoresProductoController::class);
Route::get('panel_modificadores_producto/{idEmpresa}', [ModificadoresProductoController::class, 'index']);
Route::post('panel_modificadores_producto/{idEmpresa}', [ModificadoresProductoController::class, 'store']);
Route::get('panel_modificadores_producto/{id}/edit/{idEmpresa}', [ModificadoresProductoController::class, 'edit']);
Route::patch('panel_modificadores_producto/{id}/{idEmpresa}', [ModificadoresProductoController::class, 'update']);
Route::delete('panel_modificadores_producto/{id}/{idEmpresa}', [ModificadoresProductoController::class, 'destroy']);

// Route::resource('/panel_tipo_entrega', TipoEntregaController::class);
Route::get('panel_tipo_entrega/{idEmpresa}', [TipoEntregaController::class, 'index']);
Route::post('panel_tipo_entrega/{idEmpresa}', [TipoEntregaController::class, 'store']);
Route::get('panel_tipo_entrega/{id}/edit/{idEmpresa}', [TipoEntregaController::class, 'edit']);
Route::patch('panel_tipo_entrega/{id}/{idEmpresa}', [TipoEntregaController::class, 'update']);
Route::delete('panel_tipo_entrega/{id}/{idEmpresa}', [TipoEntregaController::class, 'destroy']);

// Route::resource('/panel_tipo_pago', TipoPagoController::class);
Route::get('panel_tipo_pago/{idEmpresa}', [TipoPagoController::class, 'index']);
Route::post('panel_tipo_pago/{idEmpresa}', [TipoPagoController::class, 'store']);
Route::get('panel_tipo_pago/{id}/edit/{idEmpresa}', [TipoPagoController::class, 'edit']);
Route::patch('panel_tipo_pago/{id}/{idEmpresa}', [TipoPagoController::class, 'update']);
Route::delete('panel_tipo_pago/{id}/{idEmpresa}', [TipoPagoController::class, 'destroy']);

// Route::resource('/panel_tipo_pedido', TipoPedidoController::class);
Route::get('panel_tipo_pedido/{idEmpresa}', [TipoPedidoController::class, 'index']);
Route::post('panel_tipo_pedido/{idEmpresa}', [TipoPedidoController::class, 'store']);
Route::get('panel_tipo_pedido/{id}/edit/{idEmpresa}', [TipoPedidoController::class, 'edit']);
Route::patch('panel_tipo_pedido/{id}/{idEmpresa}', [TipoPedidoController::class, 'update']);
Route::delete('panel_tipo_pedido/{id}/{idEmpresa}', [TipoPedidoController::class, 'destroy']);

// Route::resource('/panel_estado', EstadoController::class);
Route::get('panel_estado/{idEmpresa}', [EstadoController::class, 'index']);
Route::post('panel_estado/{idEmpresa}', [EstadoController::class, 'store']);
Route::get('panel_estado/{id}/edit/{idEmpresa}', [EstadoController::class, 'edit']);
Route::patch('panel_estado/{id}/{idEmpresa}', [EstadoController::class, 'update']);
Route::delete('panel_estado/{id}/{idEmpresa}', [EstadoController::class, 'destroy']);


// Vista de Empresas
Route::get('/', [PrincipalController::class, 'selectEmpresa']);

// Vista de Productos
Route::get('/{idEmpresa}', [PrincipalController::class, 'index']);


Route::get('/cart/{idEmpresa}', [PrincipalController::class, 'cart'])->name('cart');
Route::post('/checkout/{idEmpresa}', [PrincipalController::class, 'checkout']);


// ========= Roles ==========
// Route::get('/assign/{idEmpresa}', [RoleController::class, 'index']);
Route::post('/assign/{idEmpresa}', [RoleController::class, 'store']);
Route::put('/assign/{id}/{idEmpresa}', [RoleController::class, 'update'])->name('role.update');
// Route::delete('/assign/{id}/{idEmpresa}', [RoleController::class, 'destroy'])->name('role.destroy');


Route::get('/send/email', [PrincipalController::class, 'send_mail_cart']);