<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Yajra\Datatables\Datatables;
use Carbon\Carbon;


use App\Empleado;
use App\Lugar;
use App\Asistencia;
use App\Zoemho;
use App\Zona;
use App\Sucursal;
use App\Horario;

class EmpleadoController extends Controller
{

 public function index()
 {
   $estados= Lugar::where('lu_tipo','estado')->orderBy('lu_nombre')->get();
   return view('empleado',compact('estados'));
 }

 public function getData()
 {
   $empleados = Empleado::join('lugar','lugar.lu_clave','=','empleado.fk_lugar')->select(['empleado.em_clave','empleado.em_cedula', 'empleado.em_nombre', 'empleado.em_apellido', 'empleado.em_profesion', 'empleado.em_estado_civil', 'empleado.em_salario_base', 'empleado.em_email_empresa', 'empleado.em_email_personal', 'empleado.em_nivel_academico', 'empleado.em_cantidad_hijos', 'empleado.em_descripcion_trabajo', 'empleado.em_fecha_egreso', 'empleado.em_fecha_ingreso', 'empleado.em_fecha_nacimiento', 'lugar.lu_nombre', 'empleado.em_nacionalidad']);
     return Datatables::of($empleados)->addColumn('action', function ($empleados) {
             return '<button class="btn btn-warning btn-detail update" id="'.$empleados->em_clave.'" value="'.$empleados->em_clave.'" name="Update">Update</button>
           <button class="btn btn-danger btn-delete delete" id="'.$empleados->em_clave.'" value="'.$empleados->em_clave.'" name="delete">Delete</button>'; })->make(true);
 }

 public function store(Request $request){
   $validatedData = $request->validate([
       'em_cedula' => 'required|numeric',
       //'em_nombre' => 'required',
       //'em_apellido' => 'required',
       //'em_profesion' => 'required',
       //'em_estado_civil' => 'required',
       //'em_salario_base' => 'nullable',
       //'em_email_empresa' => 'required',
       //'em_email_personal' => 'required',
       //'em_nivel_academico' => 'required',
       //'em_cantidad_hijos' => 'required',
       //'em_descripcion_trabajo' => 'nullable',
       //'em_fecha_ingreso' => 'date',
       //'em_fecha_nacimiento' => 'date',
      // 'em_nacionalidad' => 'required',
   ]);

   if ($request->operation == "Edit"){
     $empleado = Empleado::find($request->em_clave);
     $empleado -> em_fecha_egreso = $request->input('em_fecha_ingreso');
     $fecha_ingreso = $empleado -> em_fecha_ingreso;
     $fecha_nac = $empleado -> em_fecha_nacimiento;
     $empleado->fill($request->all());
     $empleado -> em_fecha_ingreso = $fecha_ingreso;
     $empleado -> em_fecha_nacimiento = $fecha_nac;     
     $empleado->save();
   } else {
       $empleado = new Empleado();
       $empleado -> em_cedula = $request->input('em_cedula');
       $empleado -> em_nombre = $request->input('em_nombre');
       $empleado -> em_apellido = $request->input('em_apellido');
       $empleado -> em_profesion = $request->input('em_profesion');
       $empleado -> em_estado_civil = $request->input('em_estado_civil');
       $empleado -> em_salario_base = $request->input('em_salario_base');
       $empleado -> em_email_empresa = $request->input('em_email_empresa');
       $empleado -> em_email_personal = $request->input('em_email_personal');
       $empleado -> em_nivel_academico = $request->input('em_nivel_academico');
       $empleado -> em_cantidad_hijos = $request->input('em_cantidad_hijos');
       $empleado -> em_descripcion_trabajo = $request->input('em_descripcion_trabajo');
       $empleado -> em_fecha_ingreso = $request->input('em_fecha_ingreso');
       $empleado -> em_fecha_nacimiento = $request->input('em_fecha_nacimiento');
       $empleado -> fk_lugar = $request->input('fk_lugar');
       $empleado -> em_nacionalidad = $request->input('em_nacionalidad');
       $empleado -> save();
     }
     return ['success' => true, 'message' => 'Saved !!'];
 }

 public function getOne(Request $request){
   return $empleado = Empleado::find($request->em_clave);
 }

 public function destroy(Request $request){
   $empleado = Empleado::find($request->em_clave);
   $empleado->delete();
   return ['success' => true, 'message' => 'Deleted !!'];
 }
 public function updateSelect(Request $request){
   return $municipios= Lugar::where('fk_lugar',$request->estado)->orderBy('lu_nombre')->get();
 }
 public function updateSelect2(Request $request){
   return $parroquias= Lugar::where('fk_lugar',$request->municipio)->orderBy('lu_nombre')->get();
 }

 public function showFactura($id,$year,$month,$day,$su_id){
   $empleado=Empleado::find($id);
   $sucursal=Sucursal::find($su_id);

   $start=Carbon::parse('first day of January 1900');
   $end=Carbon::create($year,$month,$day)->endOfWeek();

   $acumulado=Empleado::join('asistencia','asistencia.fk_zo_em_ho_3','=','em_clave')
   ->where('em_clave','=',$id)->where('a_check','!=',null)
   ->whereBetween('a_fecha',array($start, $end))
   ->sum('em_salario_base');

   $start=Carbon::create($year,$month,$day);

   $factura=Empleado::join('asistencia','asistencia.fk_zo_em_ho_3','=','em_clave')
   ->join('zona_empleado_horario','fk_zona_empleado_3','=','em_clave')
   ->join('horario','ho_clave','=','fk_horario')
   ->select('em_salario_base','ho_dia','a_fecha')
   ->where('em_clave','=',$id)->where('a_check','!=',null)
   ->whereBetween('a_fecha',array($start, $end))
   ->orderBy('a_fecha')
   ->get();

   $total=0;

   foreach ($factura as $f) {
     $total+=$f->em_salario_base;
   }

   return view('empleadoRecibo')
   ->with(compact('empleado'))
   ->with(compact('sucursal'))
   ->with(compact('acumulado'))
   ->with(compact('end'))
   ->with(compact('factura'))
   ->with(compact('total'));

 }
}
