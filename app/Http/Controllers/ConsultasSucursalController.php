<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

use App\Envio;
use App\Sucursal;
use App\Asistencia;
use App\Zoemho;
use App\Empleado;

class ConsultasSucursalController extends Controller
{
    public function avgEnviosSucursales($id,$tiempo){
      if ($tiempo==30){
        $mensaje='Mensual';
        $avgES=Envio::join('sucursal','sucursal.su_clave','=','envio.fk_sucursal_origen')->select(DB::raw('round(count(*)/12.00,2) as promedio, su_nombre as so, extract(year from en_fecha_envio) as yy'))
        ->where('fk_sucursal_origen','=',$id)->groupBy('yy','su_nombre')->get();
        $sucursal=Sucursal::find($id)->su_nombre;
        $sucursales=Sucursal::orderBy('su_nombre')->get();
      } else if($tiempo==60) {
        $mensaje='Bimestral';
        $avgES=Envio::join('sucursal','sucursal.su_clave','=','envio.fk_sucursal_origen')->select(DB::raw('round(count(*)/6.00,2) as promedio, su_nombre as so, extract(year from en_fecha_envio) as yy'))
        ->where('fk_sucursal_origen','=',$id)->groupBy('yy','su_nombre')->get();
        $sucursal=Sucursal::find($id)->su_nombre;
        $sucursales=Sucursal::orderBy('su_nombre')->get();
      } else if($tiempo==90) {
        $mensaje='Trimestral';
        $avgES=Envio::join('sucursal','sucursal.su_clave','=','envio.fk_sucursal_origen')->select(DB::raw('round(count(*)/4.00,2) as promedio, su_nombre as so, extract(year from en_fecha_envio) as yy'))
        ->where('fk_sucursal_origen','=',$id)->groupBy('yy','su_nombre')->get();
        $sucursal=Sucursal::find($id)->su_nombre;
        $sucursales=Sucursal::orderBy('su_nombre')->get();
      } else if($tiempo==180) {
        $mensaje='Semestral';
        $avgES=Envio::join('sucursal','sucursal.su_clave','=','envio.fk_sucursal_origen')->select(DB::raw('round(count(*)/2.00,2) as promedio, su_nombre as so, extract(year from en_fecha_envio) as yy'))
        ->where('fk_sucursal_origen','=',$id)->groupBy('yy','su_nombre')->get();
        $sucursal=Sucursal::find($id)->su_nombre;
        $sucursales=Sucursal::orderBy('su_nombre')->get();
      } else {
        $mensaje='Mensual';
        $avgES=Envio::join('sucursal','sucursal.su_clave','=','envio.fk_sucursal_origen')->select(DB::raw('round(count(*)/12.00,2) as promedio, su_nombre as so, extract(year from en_fecha_envio) as yy'))
        ->where('fk_sucursal_origen','=',$id)->groupBy('yy','su_nombre')->get();
        $sucursal=Sucursal::find($id)->su_nombre;
        $sucursales=Sucursal::orderBy('su_nombre')->get();
      }
      return view('consulta20')->with(compact('avgES'))->with(compact('sucursal'))->with(compact('sucursales'))->with(compact('mensaje'));
    }

    public function showNominas($id){
      $sucursales=Sucursal::orderBy('su_nombre')->get();

      $start=Carbon::parse('first day of January 2018')->startOfWeek();
      $end=Carbon::parse('first day of January 2018')->endOfWeek();

      return view('consulta70')
      ->with(compact('costo'))
      ->with(compact('sucursales'));
    }


    public function oficPorEstado(){
        $consulta=DB::select(DB::raw('select s.su_nombre, (select lu_nombre from lugar where lu_clave=(select fk_lugar from lugar where lu_clave = (select l.fk_lugar from lugar l, sucursal su where l.lu_clave = su.fk_lugar and su.su_clave=s.su_clave))) from sucursal s order by lu_nombre'));
        return view('consulta21')->with(compact('consulta'));
    }

    public function oficConUbicacion(){
        $consulta=DB::select(DB::raw('select s.su_nombre, (select lu_nombre from lugar where lu_clave=(select fk_lugar from lugar where lu_clave = (select l.fk_lugar from lugar l, sucursal su where l.lu_clave = su.fk_lugar and su.su_clave=s.su_clave))) as estado, (select lu_nombre from lugar where lu_clave= (select l.fk_lugar from lugar l, sucursal su where l.lu_clave = su.fk_lugar and su.su_clave=s.su_clave)) as municipio, (select lu_nombre from lugar where lu_clave=s.fk_lugar) as parroquia from sucursal s order by estado, municipio, parroquia'));
        return view('consulta28')->with(compact('consulta'));
    }

    public function oficYZonaPorEstado(){
        $consulta=DB::select(DB::raw('select s.su_nombre, zo_nombre, (select lu_nombre from lugar where lu_clave=(select fk_lugar from lugar where lu_clave = (select l.fk_lugar from lugar l, sucursal su where l.lu_clave = su.fk_lugar and su.su_clave=s.su_clave))) from sucursal s, zona where fk_sucursal=s.su_clave group by lu_nombre, s.su_nombre, zo_nombre'));
        return view('consulta22')->with(compact('consulta'));
    }

    public function oficInternacionales(){
        $pais='venezuela';
        $tipo="pais";
        $sql="select su_nombre from sucursal where fk_lugar in (select lu_clave from lugar where fk_lugar in (select lu_clave from lugar where fk_lugar in (select lu_clave from lugar where fk_lugar in ( select lu_clave from lugar where lu_nombre!= ? and lu_tipo= ? ))))";
        $consulta = DB::select(DB::raw($sql), [$pais, $tipo]);
        return view('consulta23')->with(compact('consulta'));
    }

        public function masAmplia(){
        $consulta = DB::select(DB::raw('select s.su_nombre, max(s.su_capacidad) as capac, (select lu_nombre from lugar where lu_clave=(select fk_lugar from lugar where lu_clave = (select l.fk_lugar from lugar l, sucursal su where l.lu_clave = su.fk_lugar and su.su_clave=s.su_clave))) as estado, (select lu_nombre from lugar where lu_clave= (select l.fk_lugar from lugar l, sucursal su where l.lu_clave = su.fk_lugar and su.su_clave=s.su_clave)) as municipio, (select lu_nombre from lugar where lu_clave=s.fk_lugar) as parroquia from sucursal s group by estado, municipio, parroquia, s.fk_lugar, s.su_nombre having max(s.su_capacidad) >=all (select max(su_capacidad) from lugar where lu_clave=s.fk_lugar group by s.fk_lugar)'));
        return view('consulta29')->with(compact('consulta'));
    }

}
