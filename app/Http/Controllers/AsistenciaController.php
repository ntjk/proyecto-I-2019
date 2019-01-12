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
use App\Empleado;
use App\Telefono;
use App\Tipo;
use App\Chequeo;
use App\Zona;
use App\Asistencia;
use App\Zoemho;
use App\Horario;

class AsistenciaController extends Controller
{

	public function index() {
		$empleados = Empleado::orderBy('em_nombre')->get();
		return view('asistencia')->with(compact('empleados'));
	}
    
    public function getData()
    {
   		
        $consulta = Asistencia::join('zona_empleado_horario','zo_em_ho_clave','=','asistencia.fk_zo_em_ho_5')->join('sucursal','sucursal.su_clave','=','zona_empleado_horario.fk_zona_empleado_1')->join('empleado','empleado.em_clave','=','zona_empleado_horario.fk_zona_empleado_3')->join('horario','horario.ho_clave','=','zona_empleado_horario.fk_horario')->select('sucursal.su_nombre', 'empleado.em_nombre', 'empleado.em_cedula', 'empleado.em_nacionalidad', 'fk_zona_empleado_2', 'empleado.em_apellido', 'horario.ho_hora_entrada', 'horario.ho_hora_salida', 'horario.ho_dia', 'asistencia.a_clave', 'asistencia.a_fecha', 'asistencia.a_check', 'asistencia.fk_zo_em_ho_5');

        /*$consulta = Asistencia::join('zona_empleado_horario','zo_em_ho_clave','=','asistencia.fk_zo_em_ho_5')->join('sucursal','sucursal.su_clave','=','fk_zona_empleado_1')->join('empleado','empleado.em_clave','=','asistencia.fk_zona_empleado_3')->join('horario','horario.ho_clave','=','asistencia.fk_horario')->select('sucursal.su_nombre', 'empleado.em_nombre', 'empleado.em_cedula', 'empleado.em_nacionalidad', 'empleado.em_apellido', 'horario.ho_hora_entrada', 'horario.ho_hora_salida', 'horario.ho_dia', 'asistencia.a_clave', 'asistencia.a_fecha', 'asistencia.a_check', 'asistencia.fk_zo_em_ho_1', 'asistencia.fk_zo_em_ho_2', 'asistencia.fk_zo_em_ho_3', 'asistencia.fk_zo_em_ho_4', 'asistencia.fk_zo_em_ho_5');*/

        return Datatables::of($consulta)->addColumn('action', function ($consulta) {
                return '<button class="btn btn-warning btn-detail update" id="'.$consulta->a_clave.'" value="'.$consulta->a_clave.'" name="Update">Update</button>
              <button class="btn btn-danger btn-delete delete" id="'.$consulta->a_clave.'" value="'.$consulta->a_clave.'" name="delete">Delete</button>'; })->make(true);
	}

    public function store(Request $request){
      if ($request->operation == "Edit"){
        $asistencia = Asistencia::find($request->a_clave);
        $asistencia -> a_check = $request->a_check;
        $asistencia->save();
      } else {
          $asistencia = new Asistencia();
          $asistencia -> a_fecha = $request->input('a_fecha');
          $asistencia -> fk_zo_em_ho_5 = $request->input('fk_zo_em_ho_5');
          $asistencia -> a_check = $request->input('a_check');
          $asistencia -> save();
        }
        return ['success' => true, 'message' => 'Saved !!'];
    }

    public function getOne(Request $request){
      $asistencia = Asistencia::find($request->a_clave);
      return $asistencia;
    }

    public function destroy(Request $request){
      $asistencia = Asistencia::find($request->a_clave);
      $asistencia->delete();
      return ['success' => true, 'message' => 'Deleted !!'];
    }

    public function updateSelect(Request $request){
     return $puestos= Zoemho::join('sucursal','sucursal.su_clave','=','zona_empleado_horario.fk_zona_empleado_1')->join('horario','horario.ho_clave','=','zona_empleado_horario.fk_horario')->where('fk_zona_empleado_3', $request->empleado)->orderBy('su_nombre')->select('sucursal.su_nombre', 'fk_zona_empleado_2','zo_em_ho_clave','horario.ho_hora_entrada', 'horario.ho_hora_salida', 'horario.ho_dia')->distinct()->get();
    }


 }
    
