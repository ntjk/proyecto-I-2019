<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Permiso;
use App\Rolper;
use App\Usuario;

class InicioSesionController extends Controller
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

    public function verificarPermisos(){
        //se halla el rol del usuario
        //$rolFk=Usuario::where('u_nombre','=',$nombre)->first();
        $permisoConsulta="ver envios"; //va a revisar si en los permisos tiene este string
        $nombreUsuario=$_COOKIE['usuario'];
         $usuario=Usuario::where('u_nombre','=',$nombreUsuario)->first();
        //y con el rol se ven los permisos
        $permisosFk=Rolper::join('permiso','per_clave','=','rol_permiso.fk_permiso')->select(
         'per_clave', 'per_nombre', 'per_descripcion', 'per_tipo')->orderBy('per_tipo')->distinct()->where('fk_rol', '=', $usuario->fk_rol)->get();
        $descripcionPermisos=Rolper::join('permiso','per_clave','=','rol_permiso.fk_permiso')->select(
         'per_clave', 'per_nombre', 'per_descripcion', 'per_tipo')->orderBy('per_tipo')->distinct()->where('fk_rol', '=', $usuario->fk_rol)->pluck('per_descripcion');
        /*var lasCookies = document.cookie;
        cookieArray = lasCookies.split(';');
        var usu = cookieArray[0].split('=')[1];,'per_nombre'
                  var contra = cookieArray[1].split('=')[1];*/
        if($descripcionPermisos->contains($permisoConsulta))
            return "ajaaa";
                  return $permisosFk;

    }
    /*
    Si contiene la palabra ver.. 4 vriables 
    Ver oculta el dropdown o botones como el de Permisos
    Eliminar oculta el btn eleminar, asi es actualizar tambien y agregar respectivamente.
    Ya tenemos la funcion que nos da los permissos de un usuario... En el btn colocar la cond
    if 

    */

    public function validarUsuario(Request $request){
        $usuario="";
    }

    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
  
    public function update(Request $request, $id)
    {
        //
    }


}
