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

use App\Http\Controllers\MostrarController; //con esto llamamos al controlador que creamos

Route::get('/mostrar', [MostrarController::class, 'mostrar']);  //Aqui especificamos el metodo, creamos una clase y llamamos la funcion deseada

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


// --------------------- FIN CRISS ----------------------------------------------------------------