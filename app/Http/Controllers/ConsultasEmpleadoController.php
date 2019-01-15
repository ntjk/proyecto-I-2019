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
use App\Zoemho;
use App\Asistencia;
use App\Tipo;
use App\Chequeo;

class ConsultasEmpleadoController extends Controller
{
    
    public function inasistenciasEmpleadosSinHorario(){
        $consulta = Asistencia::join('zona_empleado_horario','zo_em_ho_clave','=','asistencia.fk_zo_em_ho_5')->join('empleado','empleado.em_clave','=','zona_empleado_horario.fk_zona_empleado_3')->select('empleado.em_nombre', 'empleado.em_cedula', 'empleado.em_nacionalidad', 'empleado.em_apellido', 'asistencia.a_clave', 'asistencia.a_fecha', 'asistencia.a_check', 'asistencia.fk_zo_em_ho_5')->where('a_check', '=', null)->get();
        return view('consulta15')->with(compact('consulta'));
    } 

    public function empleadosFechaIngreso(){
        $consulta=DB::select(DB::raw('select em_clave, em_nacionalidad, em_cedula, em_nombre, em_apellido, em_estado_civil, em_fecha_nacimiento, em_salario_base, em_email_empresa, em_email_personal , em_profesion, em_fecha_ingreso from empleado where em_fecha_egreso is null'));
        return view('consulta24')->with(compact('consulta'));
    }

    public function empleadosFechaEgreso(){
        $consulta=DB::select(DB::raw('select em_clave, em_nacionalidad, em_cedula, em_nombre, em_apellido, em_estado_civil, em_fecha_nacimiento, em_salario_base, em_email_empresa, em_email_personal , em_profesion, em_fecha_ingreso, em_fecha_egreso from empleado'));
        $activos = DB::select(DB::raw('select count(*) as cant from empleado where em_fecha_egreso is null'));
        $inactivos = DB::select(DB::raw('select count(*) as cant from empleado where em_fecha_egreso is not null'));
        return view('consulta25')->with(compact('consulta'))->with(compact('activos'))->with(compact('inactivos'));
    }

   public function horarioEmpleados(){
        /*select em_clave, em_nacionalidad, em_cedula, em_nombre, em_apellido, su_nombre, ho_hora_entrada, ho_hora_salida, ho_dia, fk_zona_empleado_2, case when fk_zona_empleado_2=1 then 'deposito a' when fk_zona_empleado_2=2 then 'deposito B' when fk_zona_empleado_2=3 then 'deposito C' when fk_zona_empleado_2=4 then 'zona de carga C1' when fk_zona_empleado_2=5 then 'zona de carga C2' when fk_zona_empleado_2=6 then 'zona administrativa' when fk_zona_empleado_2=7 then 'zona para clientes' end from empleado, sucursal, horario, zona_empleado_horario where su_clave=fk_zona_empleado_1 and em_clave=fk_zona_empleado_3 and ho_clave=fk_horario and em_fecha_egreso is null order by su_nombre, em_nombre*/

        $consulta = Zoemho::join('sucursal','sucursal.su_clave','=','zona_empleado_horario.fk_zona_empleado_1')->join('empleado','empleado.em_clave','=','zona_empleado_horario.fk_zona_empleado_3')->join('horario','horario.ho_clave','=','zona_empleado_horario.fk_horario')->select('em_nacionalidad', 'em_cedula', 'em_nombre', 'em_apellido', 'su_nombre', 'ho_hora_entrada', 'ho_hora_salida', 'ho_dia', 'fk_zona_empleado_2')->where('em_fecha_egreso','=',null)->get();

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
        return view('consulta26')->with(compact('consulta'));
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
