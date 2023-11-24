<?php

namespace App\Http\Controllers\Steven;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller; // Importar la clase Controller

class empleadoController extends Controller
{
    /**
     * Muestra todos los empleados.
     */
    public function index()
    {
        
         // Realizar la consulta a la base de datos
         $empleados = DB::table('empleado')->get();

         // Convertir los datos a formato JSON
         $json = json_encode($empleados);
 
         // Configurar la respuesta HTTP con el contenido JSON
         return response($json)->header('Content-Type', 'application/json'); 
    }

    public function mostrarUno(Request $request) // Muestra un empleado -------------------------------------------
    {
        $id = $request->input('id');

        // Realizar la consulta a la base de datos para obtener un solo proveedor por su ID
        $empleado = DB::table('empleado')->where('idEmpleado', $id)->first();

        // Convertir los datos a formato JSON y devolver la respuesta HTTP
        return response()->json($empleado);
    }

    /**
     * Crea un empleado.
     */
    public function create(Request $request)
    {
        $nom_empleado = $request->input('nom_empleado');
        $ape_empleado = $request->input('ape_empleado');
        $cargo = $request->input('cargo');
        $departamento = $request->input('departamento');

        // Realiza la consulta MySQL
        DB::insert('INSERT INTO empleado(nom_empleado, ape_empleado, cargo, departamento) VALUES (?,?,?,?)', [
            $nom_empleado,
            $ape_empleado,
            $cargo,
            $departamento,
        ]);

        return response()->json(['mensaje' => 'Empleado creado con éxito']);
    }

    /**
     * Elimina un empleado.
     */
    public function destroy(Request $request)
    {
        // Obtener el ID del proveedor a eliminar desde el cuerpo JSON
        $id = $request->input('id');

        // Realizar la eliminación en la base de datos
        DB::table('empleado')->where('idEmpleado', $id)->delete();

        return response()->json(['mensaje' => 'Empleado eliminado con éxito']);
    }

    public function actualizar(Request $request)
    {
        $id = $request->input('id');
        $nom_empleado = $request->input('nom_empleado');
        $ape_empleado = $request->input('ape_empleado');
        $cargo = $request->input('cargo');
        $departamento = $request->input('departamento');

        // Realiza la consulta MySQL para actualizar los datos del proveedor
        DB::table('empleado')
            ->where('idEmpleado', $id)
            ->update([
                'nom_empleado' => $nom_empleado,
                'ape_empleado' => $ape_empleado,
                'cargo' => $cargo,
                'departamento' => $departamento,
            ]);

        return response()->json(['mensaje' => 'Empleado actualizado con éxito']);
    }

}
