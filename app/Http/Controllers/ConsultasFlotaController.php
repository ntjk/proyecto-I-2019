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

class ConsultasFlotaController extends Controller
{
    public function flotaPorOfic(){
        $consulta= DB::select(DB::raw('select round(avg(mo),2), so from (select count(*) as mo, su_nombre as so, en_fecha_envio from sucursal, envio where fk_sucursal_origen=su_clave 
    group by en_fecha_envio, so order by so) as hola group by so'));
    /*select round(avg(en_peso),2) as peso, su_nombre as so from sucursal, envio where su_clave=fk_sucursal_origen group by su_nombre*/
    return view('consulta7')->with(compact('consulta'));
    }

    public function flotaPorTipo(){
        $consulta= DB::select(DB::raw('select round(avg(mo),2), so from (select count(*) as mo, su_nombre as so, en_fecha_envio from sucursal, envio where fk_sucursal_origen=su_clave 
    group by en_fecha_envio, so order by so) as hola group by so'));
    /*select round(avg(en_peso),2) as peso, su_nombre as so from sucursal, envio where su_clave=fk_sucursal_origen group by su_nombre*/
    return view('consulta7')->with(compact('consulta'));
    }
}
