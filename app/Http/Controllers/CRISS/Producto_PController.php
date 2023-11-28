<?php

namespace App\Http\Controllers\CRISS;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller; // Importar la clase Controller


class Producto_PController extends Controller //Este controlador contendra todo el CRUD de la tabla proveedor
{
    public function mostrar() // MOSTRAR -----------------------------------------------------
    {
        $productosProveedores = DB::table('producto_provedoor')
        ->join('producto_servicio', 'producto_servicio.idProducto_servicio', '=', 'producto_provedoor.Producto_servicio_idProducto_servicio')
        ->select('producto_servicio.idProducto_servicio', 'producto_servicio.nom_producto_servicio')
        ->groupBy('producto_servicio.idProducto_servicio', 'producto_servicio.nom_producto_servicio')
        ->get();

        return response()->json($productosProveedores);
    }

    public function mostrarProveedor(Request $request) // MOSTRAR -----------------------------------------------------
    {
        $id = $request->input('id');

        $productosProveedores = DB::table('producto_provedoor')
        ->join('proveedor', 'proveedor.idproveedor', '=', 'producto_provedoor.proveedor_idproveedor')
        ->join('producto_servicio', 'producto_servicio.idProducto_servicio', '=', 'producto_provedoor.Producto_servicio_idProducto_servicio')
        ->select('proveedor.idproveedor','proveedor.nom_empresa_pro','producto_servicio.idProducto_servicio', 'producto_servicio.nom_producto_servicio', 'producto_provedoor.precio_compra')
        ->where('producto_servicio.idProducto_servicio', $id)
        ->get();

        return response()->json($productosProveedores);
    }

    public function mostrarPrecio(Request $request) // MOSTRAR -----------------------------------------------------
    {
        $id = $request->input('id');
        $id2 = $request->input('id2');

        $productosProveedores = DB::table('producto_provedoor')
        ->join('proveedor', 'proveedor.idproveedor', '=', 'producto_provedoor.proveedor_idproveedor')
        ->join('producto_servicio', 'producto_servicio.idProducto_servicio', '=', 'producto_provedoor.Producto_servicio_idProducto_servicio')
        ->select('proveedor.idproveedor','proveedor.nom_empresa_pro','producto_servicio.idProducto_servicio', 'producto_servicio.nom_producto_servicio', 'producto_provedoor.precio_compra')
        ->where('producto_servicio.idProducto_servicio', $id)
        ->where('proveedor.idproveedor', $id2)
        ->first();

        return response()->json($productosProveedores);
    }

    public function mostrarUno(Request $request) // MOSTRAR UNO -------------------------------------------
    {
        $id = $request->input('id');

        // Realizar la consulta a la base de datos para obtener un solo proveedor por su ID
        $proveedor = DB::table('producto_servicio')->where('idProducto_servicio', $id)->first();

        // Convertir los datos a formato JSON y devolver la respuesta HTTP
        return response()->json($proveedor);
    }

    public function crear(Request $request) // CREAR -----------------------------------------
    {
        
        // Consulta para obtener el último producto creado
        $ultimoProducto = DB::table('producto_servicio')
        ->select('idProducto_servicio')
        ->orderBy('idProducto_servicio', 'desc')
        ->first();
        $proveedor_idproveedor = $request->input('proveedor_idproveedor');
        $precio_compra = $request->input('precio_compra');

        // Realiza la consulta MySQL
        DB::insert('INSERT INTO producto_provedoor(Producto_servicio_idProducto_servicio, proveedor_idproveedor, precio_compra) VALUES (?,?,?)', [
            $ultimoProducto->idProducto_servicio,
            $proveedor_idproveedor,
            $precio_compra,
        ]);

        return response()->json(['mensaje' => 'Producto_proveedor creado con éxito']);
    }

    public function añadir(Request $request) // CREAR -----------------------------------------
    {
        
        // Consulta para obtener el último producto creado
        $producto = $request->input('producto');
        $proveedor_idproveedor = $request->input('proveedor_idproveedor');
        $precio_compra = $request->input('precio_compra');

        // Realiza la consulta MySQL
        DB::insert('INSERT INTO producto_provedoor(Producto_servicio_idProducto_servicio, proveedor_idproveedor, precio_compra) VALUES (?,?,?)', [
            $producto,
            $proveedor_idproveedor,
            $precio_compra,
        ]);

        return response()->json(['mensaje' => 'Producto_proveedor añadido con éxito']);
    }

    public function eliminar(Request $request)
    {
        // Obtener el ID del proveedor a eliminar desde el cuerpo JSON
        $id = $request->input('id');

        // Realizar la eliminación en la base de datos
        DB::table('producto_servicio')->where('idProducto_servicio', $id)->delete();

        return response()->json(['mensaje' => 'Producto eliminado con éxito']);
    }

        public function actualizar(Request $request)
    {
        $id = $request->input('id');
        $nom_producto_servicio = $request->input('nom_producto_servicio');
        $descripcion = $request->input('descripcion');
        $precio = $request->input('precio');
        $cantidad_stock = $request->input('cantidad_stock');

        // Realiza la consulta MySQL para actualizar los datos del proveedor
        DB::table('producto_servicio')
            ->where('idProducto_servicio', $id)
            ->update([
                'nom_producto_servicio' => $nom_producto_servicio,
                'descripcion' => $descripcion,
                'precio' => $precio,
                'cantidad_stock' => $cantidad_stock,
            ]);

        return response()->json(['mensaje' => 'Producto actualizado con éxito']);
    }


}
