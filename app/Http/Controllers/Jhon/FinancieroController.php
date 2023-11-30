<?php

namespace App\Http\Controllers\Jhon;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller; // Importar la clase Controller

class FinancieroController extends Controller
{
    /**
     * Muestra todos los empleados.
     */
    public function ventas()
    {
        // Realizar la consulta a la base de datos
        $ventas = DB::table('detalle_venta')
            ->select(
                'detalle_venta.precio_unidad',
                'producto_servicio.precio as precio_servicio',
                'venta.fecha',
                'producto_servicio.cantidad_stock',
                'producto_provedoor.precio_compra',
                'productos_pedidos.cantidad',
                'orden_compra.total_compra',
                'venta.total_venta'
            )
            ->join('venta', 'detalle_venta.venta_idventa', '=', 'venta.idventa')
            ->crossJoin('producto_servicio')
            ->crossJoin('producto_provedoor')
            ->crossJoin('productos_pedidos')
            ->crossJoin('orden_compra')
            ->orderBy('venta.fecha')
            ->distinct()
            ->get();

        // Convertir los datos a formato JSON
        $json = json_encode($ventas);

        // Configurar la respuesta HTTP con el contenido JSON
        return response($json)->header('Content-Type', 'application/json');
    }

    public function productos()
{
    // Realizar la consulta a la base de datos
    $productos = DB::table('producto_servicio')
        ->select(
            'producto_servicio.nom_producto_servicio',
            'producto_servicio.precio',
            'producto_servicio.cantidad_stock',
            'producto_provedoor.proveedor_idproveedor',
            'producto_provedoor.precio_compra',
            'orden_compra.fecha_creacion',
            'orden_compra.total_compra',
            'productos_pedidos.cantidad',
            DB::raw('producto_provedoor.precio_compra * productos_pedidos.cantidad AS venta')
        )
        ->crossJoin('producto_provedoor')
        ->crossJoin('productos_pedidos')
        ->crossJoin('orden_compra')
        ->orderBy('orden_compra.fecha_creacion')
        ->get();

    // Convertir los datos a formato JSON
    $json = json_encode($productos);

    // Configurar la respuesta HTTP con el contenido JSON
    return response($json)->header('Content-Type', 'application/json');
}

public function factura()
{
    // Realizar la consulta a la base de datos
    $factura = DB::table('detalle_venta')
        ->select(
            'cliente.nom_empresa',
            'venta.fecha',
            DB::raw('CAST(venta.total_venta / detalle_venta.precio_unidad AS INT) as total'),
            'producto_servicio.nom_producto_servicio'
        )
        ->crossJoin('cliente')
        ->crossJoin('venta')
        ->crossJoin('producto_servicio')
        ->where('cliente.idCliente', 1)
        ->orderBy('venta.fecha')
        ->get();

    // Convertir los datos a formato JSON
    $json = json_encode($factura);

    // Configurar la respuesta HTTP con el contenido JSON
    return response($json)->header('Content-Type', 'application/json');
}


}