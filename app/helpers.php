<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Permiso;
use App\Rolper;
use App\Usuario;
use App\Accion;

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

    function alerta24(){
        if(isset($_COOKIE['usuario']) && isset($_COOKIE['password']))
        {
            $nombreUsuario=$_COOKIE['usuario'];
            $supervisor=Usuario::where('u_nombre','=',$nombreUsuario)->where('fk_rol','=',1)->exists();
            $ahora=date("Y-m-d h:i:sa");
            $d=mktime(24, 00, 00);
            $24Horas=date("h:i:sa", $d);
            if($supervisor){
                $chequeosEnOrigen="select che_estatus, che_clave, en_clave, en_fecha_envio, en_fecha_entrega_estimada from envio, chequeo where che_clave =(select che_clave from chequeo where fk_envio=en_clave order by che_clave desc limit 1) and che_estatus=?";
                $consulta = DB::select(DB::raw($chequeosEnOrigen), ["en oficina origen"]);
                if($ahora-$consulta->en_fecha_envio >= $24Horas)
                    return 1;
                else
                    return 0;
            }
        }
    }

  /*  function auditoria($ac_descrip){
            $nombreUsuario=$_COOKIE['usuario'];
            $accion = new Accion();
            $accion -> ac_descripcion = $ac_descrip;
            $accion -> ac_fecha = date("Y-m-d h:i:sa");
            $idUsuario=Usuario::where('u_nombre','=',$nombreUsuario)->value('u_id');
            $accion -> fk_usuario = $idUsuario;
            $accion -> save();
    }*/

    function validarUsuario(){
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
    }
