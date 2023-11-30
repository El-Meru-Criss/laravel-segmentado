<?php

namespace App\Http\Controllers\brayan;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller; // Importar la clase Controller

class usuario_has_permisoController extends Controller
{
    /**
     * Muestra todos los usuario_has_permiso.
     */
    public function index()
    {
        
         // Realizar la consulta a la base de datos
         $usuario_has_permiso = DB::table('usuario_has_permiso')->get();
         $usuario_has_permiso = DB::table('usuario_has_permiso')
            ->join('usuario', 'usuario.idUsuario', '=', 'usuario_has_permiso.Usuario_idUsuario')
            ->join('permiso', 'permiso.idpermiso', '=', 'usuario_has_permiso.permiso_idpermiso')
            ->select(
                'usuario_has_permiso.Usuario_idUsuario',
                'usuario.nom_usuario',
                'permiso.nom_permiso',
            )
            ->get();

         // Convertir los datos a formato JSON
         $json = json_encode($usuario_has_permiso);
 
         // Configurar la respuesta HTTP con el contenido JSON
         return response($json)->header('Content-Type', 'application/json'); 
    }

    /**
     * monstrar uno usuario_has_permiso.
     */
    public function mostrarUnos(Request $request)
    {
        $id = $request->input('id');

        $productos = DB::table('usuario_has_permiso')
            ->join('usuario', 'usuario.idUsuario', '=', 'usuario_has_permiso.Usuario_idUsuario')
            ->join('permiso', 'permiso.idpermiso', '=', 'usuario_has_permiso.permiso_idpermiso')
            ->select(
                'usuario_has_permiso.Usuario_idUsuario',
                'usuario.nom_usuario',
                'usuario.ape_empleado',
                'usuario.cargo',
                'usuario.departamento',
                'usuario_has_permiso.permiso_idpermiso',
                'permiso.nom_permiso',
                'usuario_has_permiso.estado_usuario'
            )
            ->where('usuario_has_permiso.Usuario_idUsuario', $id)
            ->get();

        return response()->json($productos);
    }

    /**
     * actuliza usuario_has_permiso.
     */

    public function actualizar(Request $request)
    {
        $Usuario_idUsuario = $request->input('Usuario_idUsuario');
        $permiso_idpermiso = $request->input('permiso_idpermiso');
        $estado_usuario = $request->input('estado_usuario');

        // Realiza la consulta MySQL para actualizar los datos del proveedor
        DB::table('usuario_has_permiso')
            ->where('Usuario_idUsuario', $Usuario_idUsuario)
            ->where('permiso_idpermiso', $permiso_idpermiso)
            ->update([
                'estado_usuario' => $estado_usuario,
            ]);

        return response()->json(['mensaje' => 'los permisos del Empleado se actualizaron con éxito']);
    }
    /**
     * asigna
     *  usuario_has_permiso.
     */

    public function create(Request $request)
{
 
    $usuario = $request->input('usuario');
    $permiso = $request->input('Permisos');
    $estado_empleado = $request->input('estado_usuario');

    // Realiza la consulta MySQL
    DB::insert('INSERT INTO usuario_has_permiso(Usuario_idUsuario, permiso_idpermiso, estado_usuario) VALUES (?,?,?)', [
        $usuario,
        $permiso,
        $estado_empleado
    ]);

    return response()->json(['mensaje' => 'permiso asignado con éxito']);

}
}