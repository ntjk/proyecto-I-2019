<?php

use Illuminate\Http\Request;
use App\Permiso;
use App\Rolper;
use App\Usuario;

    function verificarPermisosHelper($p){
        //se halla el rol del usuario
        //$rolFk=Usuario::where('u_nombre','=',$nombre)->first();
        $permisoConsulta=$p; //va a revisar si en los permisos tiene este string
        if(isset($_COOKIE['usuario'])){
            $nombreUsuario=$_COOKIE['usuario'];
             $usuario=Usuario::where('u_nombre','=',$nombreUsuario)->pluck('fk_rol')->first();
            //y con el rol se ven los permisos
            $permisosFk=Rolper::join('permiso','per_clave','=','rol_permiso.fk_permiso')->select(
             'per_clave', 'per_nombre', 'per_descripcion', 'per_tipo')->orderBy('per_tipo')->distinct()->where('fk_rol', '=', $usuario)->get();
            $descripcionPermisos=Rolper::join('permiso','per_clave','=','rol_permiso.fk_permiso')->select(
             'per_clave', 'per_nombre', 'per_descripcion', 'per_tipo')->orderBy('per_tipo')->distinct()->where('fk_rol', '=', $usuario)->pluck('per_descripcion');
            if($descripcionPermisos->contains($permisoConsulta))
                return true;
            return false;
        }else{
            return false;
        }
    }

  /*  function validarUsuario(){
        if(isset($_COOKIE['usuario']) && isset($_COOKIE['password']))
        {
            $nombreUsuario=$_COOKIE['usuario'];
            $contra=$_COOKIE['password'];
            $password=Usuario::where('u_nombre','=',$nombreUsuario)->pluck('u_contraseña')[0];
            if($password==$contra)
                return 1;
            else
                return 0;
        }
    }*/
