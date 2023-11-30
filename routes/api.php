<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

// Criss ----------------------------------------------------------------------------------------

//--------------------- PROVEDORES -----------------------------------------------------

use App\Http\Controllers\CRISS\ProveedorController; //llamamos al controlador

Route::get('/mostrarProveedor', [ProveedorController::class, 'mostrar']); //Asignamos el metodo, la URL y la funcion a ejecutar
Route::get('/mostrarUnProveedor', [ProveedorController::class, 'mostrarUno']);
Route::post('/crearProveedor', [ProveedorController::class, 'crear']);
Route::delete('/eliminarProveedor', [ProveedorController::class, 'eliminar']);
Route::put('/actualizarProveedor', [ProveedorController::class, 'actualizar']);

// ---------------------- INVENTARIOS --------------------------------------------------

use App\Http\Controllers\CRISS\InventarioController; //llamamos al controlador

Route::get('/mostrarInventario', [InventarioController::class, 'mostrar']);
Route::get('/mostrarUnProducto', [InventarioController::class, 'mostrarUno']);
Route::post('/crearInventario', [InventarioController::class, 'crear']);
Route::delete('/eliminarInventario', [InventarioController::class, 'eliminar']);
Route::put('/actualizarProducto', [InventarioController::class, 'actualizar']);

// ---------------------- PRODUCTOS_PROVEEDOR ------------------------------------------

use App\Http\Controllers\CRISS\Producto_PController; //llamamos al controlador

Route::post('/crearProducto_Proveedor', [Producto_PController::class, 'crear']);
Route::post('/añadirProducto_Proveedor', [Producto_PController::class, 'añadir']);
Route::get('/mostrarProducto_Proveedor', [Producto_PController::class, 'mostrar']);
Route::get('/mostrarProveedorProducto_Proveedor', [Producto_PController::class, 'mostrarProveedor']);
Route::get('/mostrarPrecioProducto_Proveedor', [Producto_PController::class, 'mostrarPrecio']);

// --------------------- ORDEN_COMPRA -------------------------------------------------------

use App\Http\Controllers\CRISS\Orden_CController; //llamamos al controlador

Route::post('/crearOrden_Compra', [Orden_CController::class, 'crear']);
Route::get('/mostrarMasRecienteOrden_Compra', [Orden_CController::class, 'mostrarMasReciente']);
Route::put('/actualizarOrden_Compra', [Orden_CController::class, 'actualizar']);

// --------------------- PRODUCTOS PEDIDOS ---------------------------------------------------

use App\Http\Controllers\CRISS\Productos_PedidosController; //llamamos al controlador

Route::post('/crearProductos_Pedidos', [Productos_PedidosController::class, 'crear']);
Route::get('/mostrarUnosProducto', [Productos_PedidosController::class, 'mostrarUnos']);

// --------------------- MOVIMIENTOS ----------------------------------------------------------

use App\Http\Controllers\CRISS\MovimientosController; //llamamos al controlador

Route::get('/mostrarMovimientos', [MovimientosController::class, 'mostrar']);


// --------------------- FIN CRISS ----------------------------------------------------------------


// Steven ----------------------------------------------------------------------------------------
//--------------------- EMPLEADO -----------------------------------------------------
use App\Http\Controllers\Steven\empleadoController; //llamamos al controlador

Route::get('/mostrarEmpleados', [empleadoController::class, 'index']); //Asignamos el metodo, la URL y la funcion a ejecutar
Route::get('/mostrarUnEmpleado', [empleadoController::class, 'mostrarUno']);
Route::post('/crearEmpleado', [empleadoController::class, 'create']);
Route::delete('/eliminarEmpleado', [empleadoController::class, 'destroy']);
Route::put('/actualizarEmpleado', [empleadoController::class, 'actualizar']);



// Jairo -----------------------------------------------------------------------------------------


//Jhon
//----Financiero
use App\Http\Controllers\Jhon\FinancieroController; //llamamos al controlador
Route::get('/mostrarventas', [FinancieroController::class, 'ventas']); //Asignamos el metodo, la URL y la funcion a ejecutar
Route::get('/mostrarproductos', [FinancieroController::class, 'productos']); //Asignamos el metodo, la URL y la funcion a ejecutar
Route::get('/mostrarfactura', [FinancieroController::class, 'factura']); //Asignamos el metodo, la URL y la funcion a ejecutar

//Stripe pago
use App\Http\Controllers\PagoController;
Route::post('/stripe',[PagoController::class,'postPaymentStripe']);