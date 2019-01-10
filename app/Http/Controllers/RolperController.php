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

    public function index()
    {
        //
    }

    public function show($id)
    {
        $permisosFk=Rolper::join('permiso','per_clave','=','rol_permiso.fk_permiso')->select(
         'per_clave', 'per_nombre', 'per_descripcion', 'per_tipo')->orderBy('per_tipo')->distinct()->where('fk_rol', '=', $id)->get();
        $rol=Rol::find($id);
        /*$clavePermisos=Permiso::select('per_clave')->orderBy('per_clave')->distinct()->get();
        $permisos=Permiso::get();
        $i=0;
        $j=0;
        foreach($permisosFk as $p){
          if($clavePermisos->contains($p->per_clave)){
                $j+=1;
            } 
          $i++;

        }
        //return $j  . "   ".$clavePermisos;*/
        $permisos=Permiso::select(
         'per_clave', 'per_nombre', 'per_descripcion')->get();
        $permisosNoFk=Permiso::doesntHave('rolpers')->get();

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

    public function update(Request $request, $id)
    {
        //
    }

    public function destroy(Request $request)
    {
        $rolper = Rolper::where('fk_rol','=',$request->fk_rol)->where('fk_permiso','=',$request->fk_permiso);
        $rolper->delete();
        return ['success' => true, 'message' => 'Deleted !!'];
    }
}
