<?php

namespace App\Http\Controllers\CRISS;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller; // Importar la clase Controller


class MovimientosController extends Controller //Este controlador contendra todo el CRUD de la tabla proveedor
{
    public function mostrar() // MOSTRAR -----------------------------------------------------
    {
        $movimientos = DB::table('movimientos')
        ->join('producto_servicio', 'producto_servicio.idProducto_servicio', '=', 'movimientos.Producto_servicio_idProducto_servicio')
        ->select('movimientos.idMovimientos', 'producto_servicio.nom_producto_servicio', 'movimientos.cantidad', 'movimientos.tipo')
        ->get();

        return response()->json($movimientos);
    }
}
