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
use App\Asistencia;
use App\Tipo;
use App\Chequeo;

class ConsultasEmpleadoController extends Controller
{
    
    public function inasistenciasEmpleadosSinHorario(){

        $consulta = Asistencia::join('zona_empleado_horario','zo_em_ho_clave','=','asistencia.fk_zo_em_ho_5')->join('empleado','empleado.em_clave','=','zona_empleado_horario.fk_zona_empleado_3')->select('empleado.em_nombre', 'empleado.em_cedula', 'empleado.em_nacionalidad', 'empleado.em_apellido', 'asistencia.a_clave', 'asistencia.a_fecha', 'asistencia.a_check', 'asistencia.fk_zo_em_ho_5')->where('a_check', '=', null)->get();
        return view('consulta15')->with(compact('consulta'));
    } 



    public function inasistenciasEmpleados(){

        $consulta = Asistencia::join('zona_empleado_horario','zo_em_ho_clave','=','asistencia.fk_zo_em_ho_5')->join('sucursal','sucursal.su_clave','=','zona_empleado_horario.fk_zona_empleado_1')->join('empleado','empleado.em_clave','=','zona_empleado_horario.fk_zona_empleado_3')->join('horario','horario.ho_clave','=','zona_empleado_horario.fk_horario')->select('sucursal.su_nombre', 'empleado.em_nombre', 'empleado.em_cedula', 'empleado.em_nacionalidad', 'fk_zona_empleado_2', 'empleado.em_apellido', 'horario.ho_hora_entrada', 'horario.ho_hora_salida', 'horario.ho_dia', 'asistencia.a_clave', 'asistencia.a_fecha', 'asistencia.a_check', 'asistencia.fk_zo_em_ho_5')->where('a_check', '=', null)->get();

        $i=0;
        foreach($consulta as $c){
        	switch ($c->fk_zona_empleado_2) {
        		case 1: $c->setAttribute("zo_nombre","deposito A"); break;
        		case 2: $c->setAttribute("zo_nombre","deposito B"); break;
        		case 3: $c->setAttribute("zo_nombre","deposito C"); break;
        		case 4: $c->setAttribute("zo_nombre","zona de carga C1"); break;
        		case 5: $c->setAttribute("zo_nombre","zona de carga C2"); break;
        		case 6: $c->setAttribute("zo_nombre","zona administrativa"); break;
        		case 7: $c->setAttribute("zo_nombre","zona para clientes"); break;
        	}
        	$i++;
        }

        return view('consulta14')->with(compact('consulta'));
    }

}
