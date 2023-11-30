<?php

namespace App\Http\Controllers\brayan;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller; // Importar la clase Controller

class PermisosController extends Controller
{
    /**
     * Muestra todos los permisos.
     */
    public function index()
    {
        
         // Realizar la consulta a la base de datos
         $permiso = DB::table('permiso')->get();

         // Convertir los datos a formato JSON
         $json = json_encode($permiso);
 
         // Configurar la respuesta HTTP con el contenido JSON
         return response($json)->header('Content-Type', 'application/json'); 
    }

}
