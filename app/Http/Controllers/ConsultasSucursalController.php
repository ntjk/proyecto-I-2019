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

      $

      return view('consulta70')
      ->with(compact('costo'))
      ->with(compact('sucursales'));
    }
}
