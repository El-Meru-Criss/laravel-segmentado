<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class MostrarController extends Controller
{
    public function mostrar()
    {
        // Realizar la consulta a la base de datos
        $datos = DB::table('users')->get();

        // Convertir los datos a formato JSON
        $json = json_encode($datos);

        // Configurar la respuesta HTTP con el contenido JSON
        return response($json)->header('Content-Type', 'application/json');
    }
}
