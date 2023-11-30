<?php

namespace App\Http\Controllers\brayan;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller; // Importar la clase Controller

class UsuarioController extends Controller
{
    /**
     * Muestra todos los usuarios.
     */
    public function index()
{
    // Realizar la consulta a la base de datos
    $usuarios = DB::table('usuario')
        ->join('empleado', 'usuario.Empleado_idEmpleado', '=', 'empleado.idEmpleado')
        ->select(
            'usuario.idUsuario',
            'usuario.nom_usuario',
            'usuario.correo',
            'usuario.rol',
            'empleado.nom_empleado'
        )
        ->get();

    // Convertir los datos a formato JSON
    $json = json_encode($usuarios);

    // Configurar la respuesta HTTP con el contenido JSON
    return response($json)->header('Content-Type', 'application/json'); 
}

    public function mostrarUno(Request $request) // Muestra un usuario -------------------------------------------
    {
        $id = $request->input('id');

        // Realizar la consulta a la base de datos para obtener un solo proveedor por su ID
        $usuario = DB::table('usuario')
        ->join('empleado', 'usuario.Empleado_idEmpleado', '=', 'empleado.idEmpleado')
        ->select(
            'usuario.idUsuario',
            'usuario.nom_usuario',
            'usuario.correo',
            'usuario.rol',
            'empleado.nom_empleado'
        )
        ->where('idUsuario', $id)->first();

        // Convertir los datos a formato JSON y devolver la respuesta HTTP
        return response()->json($usuario);
    }

    /**
     * Crea un usuario.
     */
    public function create(Request $request)
    {
        $nom_usuario = $request->input('nom_usuario');
        $correo = $request->input('correo');
        $contrasena = $request->input('contrasena');
        $rol = $request->input('rol');
        $Empleado_idEmpleado = $request->input('Empleado_idEmpleado');

        // Realiza la consulta MySQL
        DB::insert('INSERT INTO usuario(nom_usuario, correo, contrasena, rol, Empleado_idEmpleado) VALUES (?,?,?,?,?)', [
            $nom_usuario,
            $correo,
            $contrasena,
            $rol,
            $Empleado_idEmpleado
        ]);

        return response()->json(['mensaje' => 'usuario creado con éxito']);
    }

    /**
     * Elimina un usuario.
     */
    public function destroy(Request $request)
    {
        // Obtener el ID del proveedor a eliminar desde el cuerpo JSON
        $id = $request->input('id');

        // Realizar la eliminación en la base de datos
        DB::table('usuario')->where('idUsuario', $id)->delete();

        return response()->json(['mensaje' => 'Usuario eliminado con éxito']);
    }

    public function actualizar(Request $request)
    {
        $id = $request->input('id');
        $nom_usuario = $request->input('nom_usuario');
        $correo = $request->input('correo');
        $contrasena = $request->input('contrasena');
        $rol = $request->input('rol');
        $Empleado_idEmpleado = $request->input('Empleado_idEmpleado');

        // Realiza la consulta MySQL para actualizar los datos del proveedor
        DB::table('usuario')
            ->where('idUsuario', $id)
            ->update([
                'nom_usuario' => $nom_usuario,
                'correo' => $correo,
                'contrasena' => $contrasena,
                'rol' => $rol,
                'Empleado_idEmpleado' => $Empleado_idEmpleado,
            ]);

        return response()->json(['mensaje' => 'Usuario actualizado con éxito']);
    }

}
