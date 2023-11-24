<?php

namespace App\Http\Controllers\CRISS;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller; // Importar la clase Controller


class InventarioController extends Controller //Este controlador contendra todo el CRUD de la tabla proveedor
{
    public function mostrar() // MOSTRAR -----------------------------------------------------
    {
        // Realizar la consulta a la base de datos
        $datos = DB::table('producto_servicio')->get();

        // Convertir los datos a formato JSON
        $json = json_encode($datos);

        // Configurar la respuesta HTTP con el contenido JSON
        return response($json)->header('Content-Type', 'application/json');
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
        
        $nom_producto_servicio = $request->input('nom_producto_servicio');
        $descripcion = $request->input('descripcion');
        $precio = $request->input('precio');
        $cantidad_stock = $request->input('cantidad_stock');

        // Realiza la consulta MySQL
        DB::insert('INSERT INTO producto_servicio(nom_producto_servicio, descripcion, precio, cantidad_stock) VALUES (?,?,?,?)', [
            $nom_producto_servicio,
            $descripcion,
            $precio,
            $cantidad_stock,
        ]);

        return response()->json(['mensaje' => 'Producto/servicio creado con éxito']);
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
