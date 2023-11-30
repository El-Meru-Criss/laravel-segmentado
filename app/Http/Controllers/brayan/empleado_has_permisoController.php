<?php

namespace App\Http\Controllers\brayan;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller; // Importar la clase Controller

class empleado_has_permisoController extends Controller
{
    /**
     * Muestra todos los empleado_has_permiso.
     */
    public function index()
    {
        
         // Realizar la consulta a la base de datos
         $empleado_has_permiso = DB::table('empleado_has_permiso')
         ->join('empleado', 'empleado_has_permiso.Empleado_idEmpleado', '=', 'empleado.idEmpleado')
         ->join('permiso', 'empleado_has_permiso.permiso_idpermiso', '=', 'permiso.idpermiso')
         ->select(
            'empleado.idEmpleado',
            'empleado.nom_empleado',
            'permiso.idpermiso',
            'permiso.nom_permiso',
        )
         ->get();

         // Convertir los datos a formato JSON
         $json = json_encode($empleado_has_permiso);
 
         // Configurar la respuesta HTTP con el contenido JSON
         return response($json)->header('Content-Type', 'application/json'); 
    }
    public function create(Request $request)
    {
        $permiso = $request->input('empleado');
        $empleado = $request->input('Permisos');
        $estado_empleado = $request->input('estado_empleado');

        // Realiza la consulta MySQL
        DB::insert('INSERT INTO empleado_has_permiso(Empleado_idEmpleado, permiso_idpermiso, estado_empleado) VALUES (?,?,?)', [
            $permiso,
            $empleado,
            $estado_empleado
        ]);

        return response()->json(['mensaje' => 'permiso asignado con éxito']);
    }

    public function permisosEmpleado(Request $request)
    {
        
        $id = $request->input('id');

        // Realizar la consulta a la base de datos para obtener un solo proveedor por su ID
        $empleado_has_permiso = DB::table('empleado_has_permiso')
        ->select(
            'empleado_has_permiso.permiso_idpermiso'
        )
        ->where('Empleado_idEmpleado', $id)
        ->get();

        // Convertir los datos a formato JSON y devolver la respuesta HTTP
        return response()->json($empleado_has_permiso);
    }
}
