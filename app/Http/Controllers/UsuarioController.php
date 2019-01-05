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
    return view('usuario',compact('roles'),compact('empleados'));
  }
  public function getData()
  {
    $usuarios = Usuario::join('rol','rol.rol_clave','=','usuario.fk_rol')->join('empleado','empleado.em_clave','=','usuario.fk_empleado')->select(['usuario.u_id','usuario.u_nombre','usuario.u_contraseña','rol.rol_nombre','empleado.em_nombre']);
      return Datatables::of($usuarios)->addColumn('action', function ($usuarios) {
              return '<button class="btn btn-warning btn-detail update" id="'.$usuarios->u_id.'" value="'.$usuarios->u_id.'" name="Update">Update</button>
            <button class="btn btn-danger btn-delete delete" id="'.$usuarios->u_id.'" value="'.$usuarios->u_id.'" name="delete">Delete</button>'; })->make(true);
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
