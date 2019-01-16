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

class ConsultasEnvioController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
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

   public function validarUsuario2(){
        if(isset($_COOKIE['usuario']) && isset($_COOKIE['password']))
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
        }
    }

    public function calcularMesConMasEnvios(){
        $mesMasEnvios=DB::select(DB::raw('select max(cantidad) as max, mes, yy from (select count(*) as cantidad, extract(month from en_fecha_envio) as mes, extract(year from en_fecha_envio) as yy from envio group by yy, mes) as enviosPorMesYy group by yy, mes'));
        return view('consulta1')->with(compact('mesMasEnvios'));
    }

    public function calcularMesConMasEnvios2(){ //lo mismo pero sin agrupar por year
        $mesMasEnvios=Envio::select(DB::raw('count(*) as cantidad, extract(month from en_fecha_envio) as mes'))->groupBy('mes')->orderBy('cantidad','desc')->first();
        return view('consulta5')->with(compact('mesMasEnvios'));
    }
    /*select count(*) as cantidad, extract(month from en_fecha_envio) as mes from envio group by mes order by cantidad desc limit 1*/

    public function promedioPaquetesDiarios(){
        $consulta= DB::select(DB::raw('select round(avg(mo),2), so from (select count(*) as mo, su_nombre as so, en_fecha_envio from sucursal, envio where fk_sucursal_origen=su_clave 
    group by en_fecha_envio, so order by so) as hola group by so'));
    /*select round(avg(en_peso),2) as peso, su_nombre as so from sucursal, envio where su_clave=fk_sucursal_origen group by su_nombre*/
    return view('consulta7')->with(compact('consulta'));
    }

    public function pesoPromedioPorOficina(){
        $pesoPromedioEnvio=Envio::join('sucursal','sucursal.su_clave','=','envio.fk_sucursal_origen')->select(DB::raw('count(*) as mo, su_nombre as so, en_fecha_envio as fecha'))->groupBy('so','fecha')->get();
        return view('consulta2')->with(compact('pesoPromedioEnvio'));
    /*select round(avg(en_peso),2) as peso, su_nombre as so from sucursal, envio where su_clave=fk_sucursal_origen group by su_nombre*/
    }

    public function enviosPorEstatus(){
      $clientes=Cliente::orderBy('cli_cedula')->get();
      $rutas=Ruta::orderBy('ru_clave')->get();
      $sucursales=Sucursal::orderBy('su_nombre')->get();
      $florus=Floru::orderBy('flo_ru_clave')->get();
      $tipos=Tipo::orderBy('ti_clave')->get();

        $envio1 = Envio::orderBy('en_clave')->join('sucursal','sucursal.su_clave','=','envio.fk_sucursal_origen')
        ->select(['sucursal.su_nombre'])->get();
        

        $envio2 = Envio::orderBy('en_clave')->join('tipo','ti_clave','=','envio.fk_tipo')->join('destinatario','des_clave','=','envio.fk_destinatario')->join('cliente','cli_clave','=','envio.fk_cliente')->join('sucursal','sucursal.su_clave','=','envio.fk_sucursal_destino')->join('chequeo','chequeo.fk_envio','=','en_clave')->select(
            'chequeo.che_estatus',
            'tipo.ti_nombre',
            'envio.en_precio',
            'envio.en_peso',
            'envio.en_descripcion',
            'envio.en_altura',
            'envio.en_anchura',
            'envio.en_profundidad',
            'envio.en_fecha_envio',
            'envio.en_fecha_entrega_estimada',
            'envio.fk_flota_ruta_1',
            'destinatario.des_cedula',
            'cliente.cli_cedula',
            'sucursal.su_nombre')
        ->get();


         $i=0;
        foreach($envio2 as $envi){
          $envi->setAttribute("so_nombre",$envio1[$i]->su_nombre);
          $i++;
        }

        $envio3=$envio2->where('che_estatus','=','entregado');
        $envio4=$envio2->where('che_estatus','=','en oficina destino');
        $envio5=$envio2->where('che_estatus','=','en oficina intermedia');
        $envio6=$envio2->where('che_estatus','=','en aduana');
        $envio7=$envio2->where('che_estatus','=','en oficina origen');

        $envio8 = $envio3->union($envio4);
        $envio9 = $envio8->union($envio5);
        $envio10 = $envio9->union($envio6);

        $envios = $envio10->union($envio7);

      return view('consulta3')->with(compact('envios'));
     
    }

    public function origenDestinoMaxPaquetes(){
       $origenMaxPaquetes=Envio::join('sucursal','sucursal.su_clave','=','envio.fk_sucursal_origen')->select(DB::raw('count(*) as mo, su_nombre as so'))->groupBy('so')->orderBy('mo','desc')->first();
       $destinoMaxPaquetes=Envio::join('sucursal','sucursal.su_clave','=','envio.fk_sucursal_destino')->select(DB::raw('count(*) as md, su_nombre as sd'))->groupBy('sd')->orderBy('md','desc')->first();
       return view('consulta4')->with(compact('origenMaxPaquetes'))->with(compact('destinoMaxPaquetes'));
       /*select count(*) as mo, su_nombre as so from sucursal, envio where fk_sucursal_origen=su_clave group by so order by mo desc limit 1 select count(*) as mo, su_nombre as so from sucursal, envio where fk_sucursal_destino=su_clave group by so order by mo desc limit 1 */
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

        $consulta = Chequeo::join('sucursal','sucursal.su_clave','=','chequeo.fk_sucursal')->join('zona','zona.zo_clave','=','chequeo.fk_zona')->select(DB::raw('avg(che_fecha_salida - che_fecha_entrada) as dias, su_nombre as so, zo_nombre as zo'))->whereRaw('chequeo.fk_zona is not null')->where('chequeo.che_estatus', '!=', 'entregado')->groupBy('so', 'zo')->get();
        
        return view('consulta9')->with(compact('consulta'));

    }

    public function clasificacionPaquetesPorOficina($rango){
        $rangoi = substr($rango, 0, 10);
        $rangof = substr($rango, 10); 
        //Listado de paquetes por clasificación y por oficina en un periodo de tiempo. 
        $consulta = Envio::join('sucursal','sucursal.su_clave','=','envio.fk_sucursal_origen')->join('tipo', 'tipo.ti_clave', '=', 'fk_tipo')->select(DB::raw('count(*) as mo, su_nombre as so, tipo.ti_nombre as tipo'))->groupBy('tipo','so')->whereBetween('en_fecha_envio', [$rangoi, $rangof])->get();
        return view('consulta12')->with(compact('consulta'))->with(compact('rangoi'))->with(compact('rangof')); 
        //preg a Leopoldo como supo que al usar with compact era sin el signo $         
        //return $consulta->count();
    }


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
            select su.su_nombre as sucu, flo.flo_tipo as flota, rev.rev_fecha_real_salida::date as revf, rev.rev_fecha_proxima_revision::date as revp
            from revision rev, sucursal su, flota flo, (select fk_flota, max(rev_fecha_real_salida)::date as ultima_revision from revision group by fk_flota) as aux
            where rev.fk_flota = aux.fk_flota and rev_fecha_real_salida= aux.ultima_revision
            and rev.fk_flota = flo.flo_clave and flo.fk_sucursal = su.su_clave
            order by su.su_nombre
        '));
        return view('consulta43')->with(compact('consultas'));
    }

    public function consulta44(){
        $consultas= DB::select(DB::raw('
        select su.su_nombre as nombre, extract(month from rc.re_fecha) as mes ,rc.re_egreso as egreso, rc.re_ingreso as ingreso
        from registro_contable rc, sucursal su
        where rc.fk_servicio_sucursal_1 = su.su_clave
        order by su.su_nombre,  rc.re_fecha
        '));
        return view('consulta44')->with(compact('consultas'));
    }

    // public function consulta44(){
    //     $consultas= DB::select(DB::raw('
    //     select su.su_nombre as nombre, extract(month from rc.re_fecha) as mes ,rc.re_egreso as egreso, rc.re_ingreso as ingreso
    //     from registro_contable rc, sucursal su
    //     where rc.fk_servicio_sucursal_1 = su.su_clave
    //     order by su.su_nombre,  rc.re_fecha
    //     '));
    //     return view('consulta44')->with(compact('consultas'));
    // }

    
    public function index() {  }

    public function create() { }

    public function store(Request $request) { }

    public function show($id) { }


}
