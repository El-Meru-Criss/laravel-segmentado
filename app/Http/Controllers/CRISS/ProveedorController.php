<?php

namespace App\Http\Controllers\CRISS;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller; // Importar la clase Controller


class ProveedorController extends Controller
{
    public function mostrar() // MOSTRAR -----------------------------------------------------
    {
        // Realizar la consulta a la base de datos
        $datos = DB::table('proveedor')->get();

        // Convertir los datos a formato JSON
        $json = json_encode($datos);

        // Configurar la respuesta HTTP con el contenido JSON
        return response($json)->header('Content-Type', 'application/json');
    }

    public function mostrarUno(Request $request) // MOSTRAR UNO -------------------------------------------
    {
        $id = $request->input('id');

        // Realizar la consulta a la base de datos para obtener un solo proveedor por su ID
        $proveedor = DB::table('proveedor')->where('idproveedor', $id)->first();

        // Convertir los datos a formato JSON y devolver la respuesta HTTP
        return response()->json($proveedor);
    }

    public function crear(Request $request) // CREAR -----------------------------------------
    {
        $Empresa = $request->input('Empresa');
        $Representante = $request->input('Representante');
        $direccion = $request->input('direccion');
        $telefono = $request->input('telefono');
        $correo = $request->input('correo');

        // Realiza la consulta MySQL
        DB::insert('INSERT INTO proveedor(nom_empresa_pro, per_conctacto_pro, direccion_pro, telefono_pro, correo_pro) VALUES (?,?,?,?,?)', [
            $Empresa,
            $Representante,
            $direccion,
            $telefono,
            $correo,
        ]);

        return response()->json(['mensaje' => 'Proveedor creado con éxito']);
    }

    public function eliminar(Request $request)
    {
        // Obtener el ID del proveedor a eliminar desde el cuerpo JSON
        $id = $request->input('id');

        // Realizar la eliminación en la base de datos
        DB::table('proveedor')->where('idproveedor', $id)->delete();

        return response()->json(['mensaje' => 'Proveedor eliminado con éxito']);
    }

        public function actualizar(Request $request)
    {
        $id = $request->input('id');
        $Empresa = $request->input('Empresa');
        $Representante = $request->input('Representante');
        $direccion = $request->input('direccion');
        $telefono = $request->input('telefono');
        $correo = $request->input('correo');

        // Realiza la consulta MySQL para actualizar los datos del proveedor
        DB::table('proveedor')
            ->where('idproveedor', $id)
            ->update([
                'nom_empresa_pro' => $Empresa,
                'per_conctacto_pro' => $Representante,
                'direccion_pro' => $direccion,
                'telefono_pro' => $telefono,
                'correo_pro' => $correo,
            ]);

        return response()->json(['mensaje' => 'Proveedor actualizado con éxito']);
    }


}
