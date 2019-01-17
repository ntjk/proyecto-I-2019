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

    public function showNominas($id){
      $sucursales=Sucursal::orderBy('su_nombre')->get();

      $costo=Zoemho::join('sucursal','su_clave','=','fk_zona_empleado_1')
      ->join('empleado','em_clave','=','fk_zona_empleado_3')
      ->join('asistencia','fk_zo_em_ho_5','=','zo_em_ho_clave')
      ->select(DB::raw("date_trunc('week',a_fecha) as semana, sum(em_salario_base) as salario"))
      ->where('su_clave','=',$id)
      ->groupBy("semana")
      ->havingRaw("sum(em_salario_base)>0")
      ->get();

      $sucursal=Sucursal::find($id);

      /*select date_trunc('week',a_fecha), sum(em_salario_base)
        from asistencia, empleado, sucursal, zona_empleado_horario
        where fk_zo_em_ho_5=zo_em_ho_clave
        and fk_zona_empleado_3=em_clave
        and fk_zona_empleado_1=su_clave
        and su_clave=1
        group by date_trunc('week',a_fecha)
        having sum(em_salario_base)>0
        */

        $total=0;
        foreach ($costo as $c) {
          $total+=$c->salario;
        }

        return view('consulta70')
        ->with(compact('sucursales'))
        ->with(compact('sucursal'))
        ->with(compact('total'))
        ->with(compact('costo'));
    }



    public function showNominaPeriodo($id,$yi,$mi,$di,$yf,$mf,$df){
      if ($yi==0 && $mi==0 && $di==0)
      {
        $inicio = Carbon::now()->startOfWeek();
      } else {
        $inicio = Carbon::create($yi,$mi,$di);
      }
      if ($yf==0 && $mf==0 && $df==0)
      {
        $fin = Carbon::now()->endOfWeek();
      } else {
        $fin = Carbon::create($yf,$mf,$df);
      }

      $sucursales=Sucursal::orderby('su_clave')->get();

      $sucursal=Sucursal::find($id);

      $nomina=Zoemho::join('sucursal','su_clave','=','fk_zona_empleado_1')
      ->join('empleado','em_clave','=','fk_zona_empleado_3')
      ->join('asistencia','fk_zo_em_ho_5','=','zo_em_ho_clave')
      ->select(DB::raw('em_nombre, em_apellido, em_clave, sum(em_salario_base) as salario'))
      ->whereBetween('a_fecha',array($inicio, $fin))
      ->where('su_clave','=',$id)
      ->where('a_check','!=',null)
      ->groupBy('em_clave','em_apellido','em_nombre')
      ->get();

      /*
      select em_nombre, em_apellido, em_clave, sum(em_salario_base)
      from zona_empleado_horario
      inner join sucursal on su_clave=fk_zona_empleado_1
      inner join empleado on em_clave=fk_zona_empleado_3
      inner join asistencia on fk_zo_em_ho_5=zo_em_ho_clave
      where a_fecha between **FECHA INICIO and FECHA FINAL** '2018-11-1' and '2018-11-23'
      and su_clave=**CLAVE** 20
      and a_check is not null
      group by em_clave, em_apellido, em_nombre
      */


      $total=0;
      foreach ($nomina as $n) {
        $total+=$n->salario;
      }

      return view('consulta71')
      ->with(compact('sucursales'))
      ->with(compact('sucursal'))
      ->with(compact('nomina'))
      ->with(compact('total'));
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
