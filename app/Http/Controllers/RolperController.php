<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Yajra\Datatables\Datatables;
use Illuminate\Support\Facades\DB;
use App\Sucursal;
use App\Destinatario;
use App\Permiso;
use App\Tipo;
use App\Chequeo;
use App\Rol;
use App\Rolper;

class RolperController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function index(){   }

    public function show($id)
    {
        $permisosFk=Rolper::join('permiso','per_clave','=','rol_permiso.fk_permiso')->select(
         'per_clave', 'per_nombre', 'per_descripcion', 'per_tipo')->orderBy('per_tipo')->distinct()->where('fk_rol', '=', $id)->get();
        $rol=Rol::find($id);
        $permisos=Permiso::select(
         'per_clave', 'per_nombre', 'per_descripcion')->get();//$permisosNoFk=Permiso::doesntHave('rolpers')->get();
        $permisosNoFk=Permiso::whereDoesntHave('rolpers', function ($query) use ($id) {
        $query->where('fk_rol', '=', $id);})->get();

        return view('rolper')->with(compact('permisosFk'))->with(compact('rol'))->with(compact('permisosNoFk'));
    }

    public function store(Request $request)
    {
       /* if ($request->operation == "Edit"){
        $rolper = Rolper::where('fk_rol','=',$request->fk_rol)->where('fk_permiso','=',$request->fk_permiso);
        $rolper->fk_permiso=$request->fk_permiso;
        $rolper->save();
        } else {*/
          $rolper = new Rolper();
          $rolper -> fk_permiso = $request->input('fk_permiso');
          $rolper -> fk_rol = $request->fk_rol;
          $rolper -> save();
       // }
        return ['success' => true, 'message' => 'Saved !!'];
    }

    public function destroy(Request $request)
    {
        $rolper = Rolper::where('fk_rol','=',$request->fk_rol)->where('fk_permiso','=',$request->fk_permiso);
        $rolper->delete();
        return ['success' => true, 'message' => 'Deleted !!'];
    }
}
