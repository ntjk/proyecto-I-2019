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
use App\Flota;
use App\Destinatario;
use App\Telefono;
use App\Tipo;
use App\Modelo;

class ConsultasFlotaController extends Controller
{
    public function flotaPorOfic(){
        $consulta= DB::select(DB::raw('select flo_clave, su_nombre, flo_año, mod_nombre,  flo_subtipo, flo_tipo, flo_placa, flo_serial_carroceria, flo_capacidad_carga from flota, sucursal, modelo where fk_modelo=mod_clave and fk_sucursal=su_clave group by su_nombre, flo_clave, flo_año, mod_nombre, flo_subtipo,  flo_tipo, flo_placa, flo_serial_carroceria, flo_capacidad_carga order by su_nombre'));
    return view('consulta16')->with(compact('consulta'));
    }

    public function flotaPorSubtipo(){
        $consulta= DB::select(DB::raw('select flo_clave, su_nombre, flo_año, mod_nombre,  flo_subtipo, flo_tipo, flo_placa, flo_serial_carroceria, flo_capacidad_carga from flota, sucursal, modelo where fk_modelo=mod_clave and fk_sucursal=su_clave group by flo_subtipo, su_nombre, flo_clave, flo_año, mod_nombre,  flo_tipo, flo_placa, flo_serial_carroceria, flo_capacidad_carga order by su_nombre'));
    return view('consulta17')->with(compact('consulta'));
    }

    public function flotaPorTipo(){
        $consulta= DB::select(DB::raw('select flo_clave, su_nombre, flo_año, mod_nombre,  flo_subtipo, flo_tipo, flo_placa, flo_serial_carroceria, flo_capacidad_carga from flota, sucursal, modelo where fk_modelo=mod_clave and fk_sucursal=su_clave group by flo_subtipo, su_nombre, flo_clave, flo_año, mod_nombre,  flo_tipo, flo_placa, flo_serial_carroceria, flo_capacidad_carga order by su_nombre'));
    return view('consulta18')->with(compact('consulta'));
    }

    public function flotaTerrestre(){
        $terrestre="terrestre";
        $consulta=Flota::join('modelo','fk_modelo','=','mod_clave')->join('sucursal','fk_sucursal','=','su_clave')->select('flo_te_nacional', 'flo_tipo', 'su_nombre', 'flo_año', 'mod_nombre', 'flo_placa', 'flo_te_serial_motor')->groupBy('flo_te_nacional', 'flo_tipo', 'su_nombre', 'flo_año', 'mod_nombre', 'flo_placa', 'flo_te_serial_motor')->where('flo_subtipo','=',$terrestre)->orderBy('flo_te_serial_motor')->get();
    return view('consulta19')->with(compact('consulta'));
        //eturn $consulta;
    }

}
