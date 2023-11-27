<?php

namespace App\Http\Controllers\CRISS;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller; // Importar la clase Controller


class Productos_PedidosController extends Controller //Este controlador contendra todo el CRUD de la tabla proveedor
{
    public function mostrar() // MOSTRAR -----------------------------------------------------
    {
        // Realizar la consulta a la base de datos
        $datos = DB::table('productos_pedidos')->get();

        // Convertir los datos a formato JSON
        $json = json_encode($datos);

        // Configurar la respuesta HTTP con el contenido JSON
        return response($json)->header('Content-Type', 'application/json');
    }

    public function mostrarUnos(Request $request) // MOSTRAR UNO -------------------------------------------
    {
        $id = $request->input('id');

        $productos = DB::table('productos_pedidos')
            ->join('producto_provedoor', function ($join) {
                $join->on('producto_provedoor.Producto_servicio_idProducto_servicio', '=', 'productos_pedidos.idProducto')
                    ->on('producto_provedoor.proveedor_idproveedor', '=', 'productos_pedidos.idproveedor');
            })
            ->join('proveedor', 'proveedor.idproveedor', '=', 'producto_provedoor.proveedor_idproveedor')
            ->join('producto_servicio', 'producto_servicio.idProducto_servicio', '=', 'producto_provedoor.Producto_servicio_idProducto_servicio')
            ->select(
                'productos_pedidos.idorden_compra',
                'proveedor.nom_empresa_pro',
                'producto_servicio.nom_producto_servicio',
                'productos_pedidos.cantidad'
            )
            ->where('productos_pedidos.idorden_compra', $id)
            ->get();

        return response()->json($productos);
    }

    public function crear(Request $request) // CREAR -----------------------------------------
    {
        $idPedido = $request->input('idPedido');
        $idProducto = $request->input('idProducto');
        $idProveedor = $request->input('idProveedor');
        $cantidad = $request->input('cantidad');

        // Realizar la consulta MySQL para insertar la orden de compra
        DB::table('productos_pedidos')->insert([
            'idProducto' => $idProducto,
            'idproveedor' => $idProveedor,
            'idorden_compra' => $idPedido,
            'cantidad' => $cantidad,
        ]);

        return response()->json(['mensaje' => 'Producto añadido con éxito']);
    }


}
