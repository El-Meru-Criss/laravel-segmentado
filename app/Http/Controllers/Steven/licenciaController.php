<?php

namespace App\Http\Controllers\Steven;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller; // Importar la clase Controller

class licenciaController extends Controller
{
    /**
     * Muestra todos los licencias.
     */
    public function index()
    {
        
         // Realizar la consulta a la base de datos
        //  $licencias = DB::table('licencias')
        // ->join('tipo_licencia ', 'licencias.tipo_licencia_idtipo_licencia', '=', 'tipo_licencia.idtipo_licencia')
        // ->join('empleado', 'licencias.Empleado_idEmpleado', '=', 'empleado.idEmpleado')
        // ->select('licencias.idLicencias','licencias.Descripcion','licencias.fecha_ini', 'licencias.fecha_fin', 'tipo_licencia.nombre', 'empleado.nom_empleado')
        // ->get();
        $licencias = DB::table('licencias')
            ->join('tipo_licencia', 'licencias.tipo_licencia_idtipo_licencia', '=', 'tipo_licencia.idtipo_licencia')
            ->join('empleado', 'licencias.Empleado_idEmpleado', '=', 'empleado.idEmpleado')
            ->select(
                'licencias.idLicencias',
                'licencias.Descripcion',
                'licencias.fecha_ini',
                'licencias.fecha_fin',
                'licencias.tipo_licencia_idtipo_licencia',
                'tipo_licencia.nombre as nombre_tipo_licencia',
                'licencias.Empleado_idEmpleado',
                'empleado.nom_empleado'
            )
            ->get();

         // Convertir los datos a formato JSON
         $json = json_encode($licencias);
 
         // Configurar la respuesta HTTP con el contenido JSON
         return response($json)->header('Content-Type', 'application/json'); 
    }

    /**
     * Muestra todos los tipos de licencia.
     */
    public function index_tipo_licencia()
    {
        
         // Realizar la consulta a la base de datos
         $tipo_licencias = DB::table('tipo_licencia')->get();

         // Convertir los datos a formato JSON
         $json = json_encode($tipo_licencias);
 
         // Configurar la respuesta HTTP con el contenido JSON
         return response($json)->header('Content-Type', 'application/json'); 
    }

    public function mostrarUno(Request $request) // Muestra un licencia -------------------------------------------
    {
        $id = $request->input('id');

        // Realizar la consulta a la base de datos para obtener un solo proveedor por su ID
        $licencia = DB::table('licencias')->where('idLicencias', $id)->first();

        // Convertir los datos a formato JSON y devolver la respuesta HTTP
        return response()->json($licencia);
    }

    /**
     * Crea un licencia.
     */
    public function create(Request $request)
    {
        $Descripcion = $request->input('Descripcion');
        $fecha_ini = $request->input('fecha_ini');
        $fecha_fin = $request->input('fecha_fin');
        $tipo_licencia_idtipo_licencia = $request->input('tipo_licencia_idtipo_licencia');
        $Empleado_idEmpleado = $request->input('Empleado_idEmpleado');

        // Realiza la consulta MySQL
        DB::insert('INSERT INTO licencias(Descripcion, fecha_ini,fecha_fin, tipo_licencia_idtipo_licencia, Empleado_idEmpleado) VALUES (?,?,?,?,?)', [
            $Descripcion,
            $fecha_ini,
            $fecha_fin,
            $tipo_licencia_idtipo_licencia,
            $Empleado_idEmpleado,
        ]);

        return response()->json(['mensaje' => 'licencia creada con éxito']);
    }

    /**
     * Elimina un licencia.
     */
    public function destroy(Request $request)
    {
        // Obtener el ID del proveedor a eliminar desde el cuerpo JSON
        $id = $request->input('id');

        // Realizar la eliminación en la base de datos
        DB::table('licencias')->where('idLicencias', $id)->delete();

        return response()->json(['mensaje' => 'licencia eliminada con éxito']);
    }

    public function actualizar(Request $request)
    {
        $id = $request->input('id');
        $Descripcion = $request->input('Descripcion');
        $fecha_ini = $request->input('fecha_ini');
        $fecha_fin = $request->input('fecha_fin');
        $tipo_licencia_idtipo_licencia = $request->input('tipo_licencia_idtipo_licencia');
        $Empleado_idEmpleado = $request->input('Empleado_idEmpleado');

        // Realiza la consulta MySQL para actualizar los datos del proveedor
        DB::table('licencias')
            ->where('idLicencias', $id)
            ->update([
                'Descripcion' => $Descripcion,
                'fecha_ini' => $fecha_ini,
                'fecha_fin' => $fecha_fin,
                'tipo_licencia_idtipo_licencia' => $tipo_licencia_idtipo_licencia,
                'Empleado_idEmpleado' => $Empleado_idEmpleado,
            ]);

        return response()->json(['mensaje' => 'licencia actualizada con éxito']);
    }
    public function ver_tipo_licencia()
    {
        $tipo_licencias = DB::table('tipo_licencia')
            ->select(
                'tipo_licencia.idtipo_licencia',
                'tipo_licencia.nombre'
            )
            ->get();

         // Convertir los datos a formato JSON
         $json = json_encode($tipo_licencias);
 
         // Configurar la respuesta HTTP con el contenido JSON
         return response($json)->header('Content-Type', 'application/json'); 
    }

public function ver_nombre_empleado()
    {
        $nombre_empleados = DB::table('empleado')
            ->select(
                'empleado.idEmpleado',
                'empleado.nom_empleado'
            )
            ->get();

         // Convertir los datos a formato JSON
         $json = json_encode($nombre_empleados);
 
         // Configurar la respuesta HTTP con el contenido JSON
         return response($json)->header('Content-Type', 'application/json'); 
    }

}
