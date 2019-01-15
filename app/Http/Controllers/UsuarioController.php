<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Yajra\Datatables\Datatables;

use App\Usuario;
use App\Rol;
use App\Empleado;

class UsuarioController extends Controller
{
  public function index()
  {
    $roles= Rol::orderBy('rol_nombre')->get();
    $empleados= Empleado::orderby('em_nombre')->get();
    $usuarios = Usuario::join('rol','rol.rol_clave','=','usuario.fk_rol')->join('empleado','empleado.em_clave','=','usuario.fk_empleado')
    ->select(['usuario.u_id','usuario.u_nombre','usuario.u_contraseña','rol.rol_nombre','empleado.em_nombre', 'em_cedula', 'em_nacionalidad'])->get();
    return view('usuario')->with(compact('roles'))->with(compact('empleados'))->with(compact('usuarios'));
    /*Copiar de getData al index y agregarle get()
    agregar la var de retorno
    borrar get data pero antes pasar esos botones a la vista
    En la vista agrgar tbody y sus celdas con foreach
    borrar de la vista el cotenido de datatables
    */
  }
  public function store(Request $request){
    if ($request->operation == "Edit"){
      $usuario = Usuario::find($request->u_id);
      $usuario->fill($request->all());
      $usuario->save();
    } else {
        $usuario = new Usuario();
        $usuario -> u_nombre = $request->input('u_nombre');
        $usuario -> u_contraseña = $request->input('u_contraseña');
        $usuario -> fk_rol = $request->input('fk_rol');
        $usuario -> fk_empleado = $request->input('fk_empleado');
        $usuario -> save();
      }
      return ['success' => true, 'message' => 'Saved !!'];
  }
  public function getOne(Request $request){
        return $usuario = Usuario::find($request->u_id);
    }
      public function destroy(Request $request){
        $usuario = Usuario::find($request->u_id);
        $usuario->delete();
        return ['success' => true, 'message' => 'Deleted !!'];
      }
}