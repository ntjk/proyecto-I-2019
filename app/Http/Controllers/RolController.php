<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Yajra\Datatables\Datatables;

use App\Rol;

class RolController extends Controller
{
  public function index()
  {
    $roles = Rol::select(['rol_clave','rol_nombre','rol_descripcion'])
    ->orderBy('rol_clave')->get();
    return view('rol')->with(compact('roles'));
  }

  public function store(Request $request)
  {
    if ($request->operation == "Edit"){
      $rol = Rol::find($request->rol_clave);
      $rol->fill($request->all());
      $rol->save();
    } else {
      $rol = new Rol();
      $rol -> rol_nombre = $request->input('rol_nombre');
      $rol -> rol_descripcion = $request->input('rol_descripcion');
      $rol -> save();
    }
    return ['success' => true, 'message' => 'Saved !!'];
  }

  public function getOne(Request $request){
      return $rol = Rol::find($request->rol_clave);
  }

  public function destroy(Request $request){
    $rol = Rol::find($request->rol_clave);
    $rol->delete();
    return ['success' => true, 'message' => 'Deleted !!'];
  }
}
