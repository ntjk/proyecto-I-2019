<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Yajra\Datatables\Datatables;
use Illuminate\Support\Facades\DB;
use App\Envio;
use App\Cliente;
use App\Sucursal;
use App\Floru;
use App\Ruta;
use App\Destinatario;
use App\Telefono;
use App\Tipo;
use App\Chequeo;
use App\Permiso;
use App\Rolper;
use App\Usuario;
use App\Falla;
use App\Flota;
use App\Taller;
use App\Revision;
use App\Servicio;
use App\Servicio_Sucursal;

class ConsultasEnvioController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function pesoPromedioPorOficina(){
        $pesoPromedioEnvio = DB::select(DB::raw('select round(avg(en_peso),2) as peso, su_nombre as so from sucursal, envio where su_clave=fk_sucursal_origen group by su_nombre'));
        return view('consulta2')->with(compact('pesoPromedioEnvio'));
    /*select round(avg(en_peso),2) as peso, su_nombre as so from sucursal, envio where su_clave=fk_sucursal_origen group by su_nombre*/
    }

    public function calcularMesConMasEnvios(){
        $mesMasEnvios=DB::select(DB::raw('select max(cantidad) as max, mes, yy from (select count(*) as cantidad, extract(month from en_fecha_envio) as mes, extract(year from en_fecha_envio) as yy from envio group by yy, mes) as enviosPorMesYy group by yy, mes'));
        return view('consulta1')->with(compact('mesMasEnvios'));
    }

    public function calcularMesConMasEnvios2(){ //lo mismo pero sin agrupar por year
        $mesMasEnvios=Envio::select(DB::raw('count(*) as cantidad, extract(month from en_fecha_envio) as mes'))->groupBy('mes')->orderBy('cantidad','desc')->first();
        return view('consulta5')->with(compact('mesMasEnvios'));
    /*select count(*) as cantidad, extract(month from en_fecha_envio) as mes from envio group by mes order by cantidad desc limit 1*/
    }

    public function origenDestinoMaxPaquetes(){
        /*select mo, su_nombre as so from (select su_nombre, count(e.*) as mo from sucursal , envio e where fk_sucursal_origen =su_clave group by su_nombre) as t1 where mo = (select max(mo) from (select su_nombre, count(e.*) as mo from sucursal , envio e where fk_sucursal_origen =su_clave group by su_nombre) as t1)*/
        $origenMaxPaquetes=Envio::join('sucursal','sucursal.su_clave','=','envio.fk_sucursal_origen')->select(DB::raw('count(*) as mo, su_nombre as so'))->groupBy('so')->orderBy('mo','desc')->first();
        $destinoMaxPaquetes=Envio::join('sucursal','sucursal.su_clave','=','envio.fk_sucursal_destino')->select(DB::raw('count(*) as md, su_nombre as sd'))->groupBy('sd')->orderBy('md','desc')->first();
       return view('consulta4')->with(compact('origenMaxPaquetes'))->with(compact('destinoMaxPaquetes'));
       /*select count(*) as mo, su_nombre as so from sucursal, envio where fk_sucursal_origen=su_clave group by so order by mo desc limit 1 select count(*) as mo, su_nombre as so from sucursal, envio where fk_sucursal_destino=su_clave group by so order by mo desc limit 1 */
    }


    public function promedioPaquetesDiarios(){
        $consulta= DB::select(DB::raw('select round(avg(mo),2), so from (select count(*) as mo, su_nombre as so, en_fecha_envio from sucursal, envio where fk_sucursal_origen=su_clave
    group by en_fecha_envio, so order by so) as hola group by so'));
    return view('consulta7')->with(compact('consulta'));
    }

    public function clasificacionPaquetesPorOficina($rango){
        $rangoi = substr($rango, 0, 10);
        $rangof = substr($rango, 10);
        $sql = "select ti_nombre, so.su_nombre as so, cli_nacionalidad, en_clave, en_precio, en_peso, en_altura, en_anchura, en_profundidad, en_fecha_envio, cli_cedula, sd.su_nombre as sd from envio, cliente, tipo, sucursal as so, sucursal as sd where ti_clave=fk_tipo and cli_clave=fk_cliente and fk_sucursal_destino = sd.su_clave and fk_sucursal_origen = so.su_clave and en_fecha_envio between ? and ? order by ti_nombre, so";
        $consulta = DB::select(DB::raw($sql), [$rangoi, $rangof]);
        return view('consulta13')->with(compact('consulta'))->with(compact('rangoi'))->with(compact('rangof'));
    }

    public function enviosPorEstatus(){
        $consulta= DB::select(DB::raw('select che_estatus, che_clave, cli_nacionalidad, ti_nombre, en_clave, en_precio, en_peso, en_descripcion, en_altura, en_anchura, en_profundidad, en_fecha_envio, en_fecha_entrega_estimada, fk_flota_ruta_1, des_cedula, cli_cedula, so.su_nombre as so, sd.su_nombre as sd from envio, tipo, cliente, chequeo, destinatario, sucursal as so, sucursal as sd where ti_clave=fk_tipo and fk_destinatario = des_clave and cli_clave=fk_cliente and fk_sucursal_destino = sd.su_clave and fk_sucursal_origen = so.su_clave and che_clave =(select che_clave from chequeo where fk_envio=en_clave order by che_clave desc limit 1)  order by che_estatus'));
        return view('consulta3')->with(compact('consulta'));
    }

    public function consulta6($fecha)
    {
           $consulta = Envio::join('sucursal','sucursal.su_clave','=','envio.fk_sucursal_origen')->select(DB::raw('count(*) as mo, su_nombre as so, en_fecha_envio as fecha'))->groupBy('so','fecha')->where('en_fecha_envio', $fecha)->orderBy('mo','desc')->first();
            return view('consulta6')->with(compact('consulta'));
    }

    public function consulta6_2($rango)
    {
        $rangoi = substr($rango, 0, 10);
        $rangof = substr($rango, 10);
        $consulta = Envio::join('sucursal','sucursal.su_clave','=','envio.fk_sucursal_origen')->select(DB::raw('count(*) as mo, su_nombre as so'))->groupBy('so')->whereBetween('en_fecha_envio', [$rangoi, $rangof])->orderBy('mo','desc')->first();
        return view('consulta6_2')->with(compact('consulta'))->with(compact('rangoi'))->with(compact('rangof'));
        /*select count(*) as mo, su_nombre as so from envio, sucursal where fk_sucursal_origen=su_clave and en_fecha_envio between '01-01-2019' and '14-01-2019' group by so order by mo desc limit 1*/
    }

    public function promedioEstanciaZonas(){

        //Para los que no tienen che_fecha_salida todavia es que la estancia no ha terminado, por lo tanto, como es algo logico lo dejare en null, tampoco lo comparo con la fecha actual porque esa no sera su verdadera estancia, si nos pide cambio durante la consulta... Simplemente, sin comentar algo mas, descomentar todo lo de esta funcion

        /*$consultaPrimitiva = Chequeo::join('sucursal','sucursal.su_clave','=','chequeo.fk_sucursal')->join('zona','zona.zo_clave','=','chequeo.fk_zona')->select('che_clave','che_fecha_salida')->whereRaw('chequeo.fk_zona is not null and che_fecha_salida is null')->distinct()->get();

        $i=0;
        foreach($consultaPrimitiva as $cpr){
            $c=Chequeo::find($cpr->che_clave);
            $c->che_fecha_salida=date("Y-m-d h:i:sa");
            $c->save();
            $i++;
        }*/
        /*select avg(c.che_fecha_salida - c.che_fecha_entrada) as dias, z.zo_nombre, s.su_nombre
        from chequeo c, zona z, sucursal s
        where z.zo_clave=c.fk_zona and s.su_clave=c.fk_sucursal and c.fk_zona is not null
        group by z.zo_nombre, s.su_nombre*/

        // que no muestre los que son null cambia whereRaw por whereRaw('chequeo.fk_zona is not null and che_fecha_salida is not null')

        $consulta = Chequeo::join('sucursal','sucursal.su_clave','=','chequeo.fk_sucursal')->join('zona','zona.zo_clave','=','chequeo.fk_zona')->select(DB::raw('avg(che_fecha_salida - che_fecha_entrada) as dias, su_nombre as so, zo_nombre as zo'))->whereRaw('chequeo.fk_zona is not null')->where('chequeo.che_estatus', '!=', 'entregado')->groupBy('so', 'zo')->get();

        return view('consulta9')->with(compact('consulta'));

    }

    public function clasificacionPaquetesPorOficinaCantidad($rango){
        $rangoi = substr($rango, 0, 10);
        $rangof = substr($rango, 10);
        $consulta = Envio::join('sucursal','sucursal.su_clave','=','envio.fk_sucursal_origen')->join('tipo', 'tipo.ti_clave', '=', 'fk_tipo')->select(DB::raw('count(*) as mo, su_nombre as so, tipo.ti_nombre as tipo'))->groupBy('tipo','so')->whereBetween('en_fecha_envio', [$rangoi, $rangof])->get();
        return view('consulta12')->with(compact('consulta'))->with(compact('rangoi'))->with(compact('rangof'));
        /*select count(*) as mo, su_nombre as so, ti_nombre as tipo from sucursal, tipo, envio where fk_sucursal_origen=su_clave and fk_tipo = ti_clave and en_fecha_envio between '01-11-2018' and '01-01-2019' group by tipo, so */
    }

    public function rutaMasUsada(){
        $consulta= DB::select(DB::raw('select count(*) as cant, so.su_nombre as so, sd.su_nombre as sd, flo.flo_subtipo, e.fk_flota_ruta_1, f.flo_ruta, f.flo_ru_costo,  f.flo_ru_duracion_hrs from flota_ruta as f, flota as flo, sucursal as so, sucursal as sd, envio as e where sd.su_clave=f.fk_ruta_3 and so.su_clave=f.fk_ruta_2 and flo.flo_clave=f.fk_flota and e.fk_flota_ruta_1=f.flo_ru_clave group by e.fk_flota_ruta_1, so.su_nombre, sd.su_nombre, flo.flo_subtipo, f.flo_ruta, f.flo_ru_costo, f.flo_ru_duracion_hrs having count(*) = (select max(cou) from (select distinct count(*) as cou from envio group by fk_flota_ruta_1) as t1)'));
        return view('consulta30')->with(compact('consulta'));
        /*select count(*) as cant, so.su_nombre, sd.su_nombre, flo.flo_subtipo, e.fk_flota_ruta_1, f.flo_ruta, f.flo_ru_costo, f.flo_ru_duracion_hrs, f.fk_flota, f.fk_ruta_1, f.fk_ruta_2, f.fk_ruta_3 from flota_ruta as f, flota as flo, sucursal as so, sucursal as sd, envio as e where sd.su_clave=f.fk_ruta_3 and so.su_clave=f.fk_ruta_2 and flo.flo_clave=f.fk_flota and e.fk_flota_ruta_1=f.flo_ru_clave group by e.fk_flota_ruta_1, so.su_nombre, sd.su_nombre, flo.flo_subtipo, f.flo_ruta, f.flo_ru_costo, f.flo_ru_duracion_hrs, f.fk_flota, f.fk_ruta_1, f.fk_ruta_2, f.fk_ruta_3 having count(*) >all (select count(*) from flota_ruta where flo_ru_clave=e.fk_flota_ruta_1 group by flo_ruta)*/
    }

    public function medioMasUsado(){
        $consulta= DB::select(DB::raw('select count(*) as cant, flo.flo_tipo, flo.flo_subtipo, flo.flo_año, md.mod_nombre, e.fk_flota_ruta_1, f.flo_ruta, f.fk_flota from modelo as md, flota_ruta as f, flota as flo, envio as e where md.mod_clave=flo.fk_modelo and flo.flo_clave=f.fk_flota and e.fk_flota_ruta_1=f.flo_ru_clave group by e.fk_flota_ruta_1, flo.flo_subtipo, flo.flo_tipo, f.flo_ruta, f.fk_flota,flo.flo_año, md.mod_nombre  having count(*) = (select distinct max(cou) from (select count(*) as cou from envio group by fk_flota_ruta_1) as t1)'));
        return view('consulta31')->with(compact('consulta'));
    }

    public function alerta242(){
        if(isset($_COOKIE['usuario']) && isset($_COOKIE['password']))
        {
            $nombreUsuario=$_COOKIE['usuario'];
            $supervisor=Usuario::where('u_nombre','=',$nombreUsuario)->where('fk_rol','=',1)->exists();
            $ahora=date("Y-m-d h:i:sa");
            if($supervisor){
                $chequeosEnOrigen="select che_estatus, che_clave, en_clave, en_fecha_envio +? as dife, en_fecha_entrega_estimada from envio, chequeo where che_clave =(select che_clave from chequeo where fk_envio=en_clave order by che_clave desc limit 1) and che_estatus=?";
                $consulta = DB::select(DB::raw($chequeosEnOrigen), ['24 hours',"en oficina origen"]);
                $cantidad=count($consulta);
                if($consulta[0]->dife<=$ahora)
                    return 1;
                else
                    return 0;
            }
            else
                return 0;
        }
        else
            return 0;
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
        if($descripcionPermisos->contains($permisoConsulta))
            return "ajaaaa". $descripcionPermisos. " si tiene ".$permisoConsulta;
        return $descripcionPermisos;
    }


   public    function validarUsuario2(){
      /*  if(isset($_COOKIE['usuario']) && isset($_COOKIE['password']))
        {
            $nombreUsuario=$_COOKIE['usuario'];
            $contra=$_COOKIE['password'];
            $password=Usuario::where('u_nombre','=',$nombreUsuario)->pluck('u_contraseña')[0];
            if($password==$contra)
                 $r=1;
            else
            $r=0;
            // ."contra es ".$password." y pasaste ". $contra. "usu es ". $nombreUsuario;
            return $r;
        }*/
    }

    public function index() {  }

    /////////////////////////// AQUI ///////////////////////////////
    public function sucursalesPuertosAeropuertos(){

        $consultas=DB::select(DB::raw('
        select \'Aeropuerto\' as tipo, ae_nombre as nombre, su_nombre as sucu
        from aeropuerto, sucursal
        where fk_sucursal = su_clave
        union
        select \'Puerto\' as tipo, puer_nombre as nombre, su_nombre as sucu
        from puerto, sucursal
        where fk_sucursal = su_clave
        order by sucu
        '));
        return view('consulta41')->with(compact('consultas'));
    }

    public function historicoFalla($id){

        // $historicos=DB::select(DB::raw('
        //     select fa.fa_descripcion as falla, ta.ta_nombre as taller, flo.flo_tipo flota ,re.rev_fecha_real_salida - re.rev_fecha_entrada as duracion
        //     from falla fa, revision re, taller ta, flota flo
        //     where fa.fk_revision_1 = re.rev_clave and fa.fk_revision_2 = flo.flo_clave and fa.fk_revision_3 = ta.ta_clave
        // '));
        // return view('historico')->with(compact('historicos'));

        $revisiones= Revision::orderBy('rev_clave')->get();
        $flotas= Flota::orderby('flo_clave')->get();
        $talleres= Taller::orderby('ta_nombre')->get();
        $fallas = Falla::join('revision','revision.rev_clave','=','falla.fk_revision_1')
        ->join('flota','flota.flo_clave','=','falla.fk_revision_2')
        ->join('taller','taller.ta_clave','=','falla.fk_revision_3')
        ->select(DB::raw('falla.fa_descripcion as falla, taller.ta_nombre as taller, flota.flo_tipo flota ,
        revision.rev_fecha_real_salida - revision.rev_fecha_entrada as duracion'))
        ->where('flota.flo_clave', '=', $id)
        //->orderBy('duracion')
        ->get();
        return view('historico')->with(compact('id'))->with(compact('revisiones'))->with(compact('flotas'))->with(compact('talleres'))->with(compact('fallas'));
    }

    public function consulta42(){
        $talleres= DB::select(DB::raw('
        select lu.lu_nombre as zona, ta.ta_nombre as nombre
        from taller ta, lugar lu
        where ta.fk_lugar = lu.lu_clave
        group by lu.lu_nombre, ta.ta_nombre'));
        return view('consulta42')->with(compact('talleres'));
    }

    public function consulta43(){
        $consultas= DB::select(DB::raw('
            select su.su_nombre as nombre, flo.flo_tipo as flo, rev.rev_fecha_real_salida as revf, rev.rev_fecha_proxima_revision as revp
            from revision rev, flota flo, sucursal su, (select fk_flota, max(rev_fecha_real_salida) from revision group by fk_flota) as tabla
            where rev.fk_flota = flo.flo_clave and flo.fk_sucursal = su.su_clave
            and rev.rev_fecha_real_salida = tabla.max
            and flo.flo_clave = tabla.fk_flota
        '));
        return view('consulta43')->with(compact('consultas'));
    }

    public function consulta44(){
        $consultas= DB::select(DB::raw('
            select \'Envío\' as tipo, null as egreso, en.en_precio as ingreso, su_nombre as sucu, en.en_fecha_envio::date as fecha
            from envio en, sucursal su
            where en.fk_sucursal_origen = su.su_clave
            union
            select \'Revisión\' as tipo, rev.rev_monto_pagar as egreso, null as ingreso, su.su_nombre as sucu, rev.rev_fecha_real_salida::date as fecha
            from revision rev, flota flo, sucursal su
            where rev.fk_flota = flo.flo_clave
            and flo.fk_sucursal = su.su_clave
            union
            select \'Salario\' as tipo, em.em_salario_base as egreso,null as ingreso, su_nombre as sucu, null as fecha
            from empleado em, zona zo, zona_empleado ze, sucursal su
            where em.em_clave = ze.fk_empleado
            and ze.fk_zona_2 = zo.fk_sucursal
            and zo.fk_sucursal = su.su_clave
            order by tipo desc, sucu, fecha
        '));
        return view('consulta44')->with(compact('consultas'));
    }


    public function consulta45(){
        // $consultas45 = Revision::join('flota','flota.flo_clave','=','revision.fk_flota')
        // ->join('sucursal', 'sucursal.su_clave', '=', 'flota.fk_sucursal')
        // ->select(DB::raw('sucursal.su_nombre as nombre, extract(month from revision.rev_fecha_real_salida) as mes, sum(revision.rev_monto_pagar) as total'))
        // ->groupBy('mes','nombre')->get();

        $cons45= DB::select(DB::raw('
            select su.su_nombre as nombre, extract(month from rev.rev_fecha_real_salida) as mes, sum(rev.rev_monto_pagar) as total
            from revision rev, flota flo, sucursal su
            where rev.fk_flota = flo.flo_clave and flo.fk_sucursal = su.su_clave
            group by extract(month from rev.rev_fecha_real_salida),su.su_nombre
            order by nombre, mes
        '));
        return view('consulta45')->with(compact('cons45'));
    }


    public function index() {  }

    public function create() { }

    public function store(Request $request) { }

    public function show($id) { }

}
