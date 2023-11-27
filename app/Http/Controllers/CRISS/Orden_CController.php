<?php

namespace App\Http\Controllers\CRISS;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller; // Importar la clase Controller


class Orden_CController extends Controller //Este controlador contendra todo el CRUD de la tabla proveedor
{
    public function mostrar() // MOSTRAR -----------------------------------------------------
    {
        // Realizar la consulta a la base de datos
        $datos = DB::table('producto_provedoor')->get();

        // Convertir los datos a formato JSON
        $json = json_encode($datos);

        // Configurar la respuesta HTTP con el contenido JSON
        return response($json)->header('Content-Type', 'application/json');
    }

    public function mostrarMasReciente() // MOSTRAR MAS RECIENTE ----------------------------------
    {
        // Realizar la consulta a la base de datos
        $datos = DB::table('orden_compra')
        ->select('idorden_compra')
        ->orderBy('idorden_compra', 'desc')
        ->first();

        // Convertir los datos a formato JSON
        $json = json_encode($datos);

        // Configurar la respuesta HTTP con el contenido JSON
        return response($json)->header('Content-Type', 'application/json');
    }

    public function crear(Request $request) // CREAR -----------------------------------------
    {

        // Obtener la fecha actual
        $fecha_creacion = now();

        // Valor inicial para total_compra (puede ser ajustado según tus necesidades)
        $total_compra = 0;

        // Realizar la consulta MySQL para insertar la orden de compra
        DB::table('orden_compra')->insert([
            'fecha_creacion' => $fecha_creacion,
            'total_compra' => $total_compra,
        ]);

        return response()->json(['mensaje' => 'Orden_Compra creado con éxito']);
    }

    public function actualizar(Request $request)
    {
        $id = $request->input('id');
        $total_compra = $request->input('total_compra');

        // Realiza la consulta MySQL para actualizar los datos del proveedor
        DB::table('orden_compra')
            ->where('idorden_compra', $id)
            ->update([
                'total_compra' => $total_compra,
            ]);

        return response()->json(['mensaje' => 'Orden actualizada con éxito']);
    }


}
