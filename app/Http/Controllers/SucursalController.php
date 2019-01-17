<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;

use Yajra\Datatables\Datatables;
use Illuminate\Support\Facades\DB;

use App\Sucursal;
use App\Lugar;
use App\Zona;
use App\Zoemho;
use App\Empleado;
use App\Asistencia;

class SucursalController extends Controller
{

	/**
     * Displays front end view
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
      $estados= Lugar::where('lu_tipo','estado')->orderBy('lu_nombre')->get();
      $sucursales = Sucursal::join('lugar','lugar.lu_clave','=','sucursal.fk_lugar')->select(['sucursal.su_nombre','sucursal.su_clave','sucursal.su_email','sucursal.su_capacidad','lugar.lu_nombre'])->get();
    	return view("sucursal")->with(compact('estados'))->with(compact('sucursales'));
    }


    public function store(Request $request){
      if ($request->operation == "Edit"){
        $sucursal = Sucursal::find($request->su_clave);
        $sucursal->fill($request->all());
        $sucursal->save();
      } else {
          $sucursal = new Sucursal();
          $sucursal -> su_nombre = $request->input('su_nombre');
          $sucursal -> su_email = $request->input('su_email');
          $sucursal -> su_capacidad = $request->input('su_capacidad');
          $sucursal -> fk_lugar = $request->input('fk_lugar');
          $sucursal -> save();
        }
        return ['success' => true, 'message' => 'Saved !!'];
    }

    public function getOne(Request $request){
      return $sucursal = Sucursal::find($request->su_clave);
    }

    public function destroy(Request $request){
      $sucursal = Sucursal::find($request->su_clave);
      $sucursal->delete();
      return ['success' => true, 'message' => 'Deleted !!'];
    }

    public function updateSelect(Request $request){
      return $lugares= Lugar::where('fk_lugar',$request->estado)->orderBy('lu_nombre')->get();
    }

    public function showNomina($id,$year,$month,$day){
      $empleados = Sucursal::join('zona_empleado_horario','fk_zona_empleado_1','=','sucursal.su_clave')->join('empleado','empleado.em_clave','=','fk_zona_empleado_3')
      ->select('em_clave','em_nombre','em_salario_base')->where('su_clave','=',$id)->get();


      if ($year==0 || $month==0 || $day==0){
        $monday = Carbon::now()->startOfWeek();
        $sunday = Carbon::now()->endOfWeek();
      } else {
        $monday = Carbon::create($year,$month,$day)->startOfWeek();
        $sunday = Carbon::create($year,$month,$day)->endOfWeek();
      }
      
      $total=0;

      foreach ($empleados as $em) {
        $em->salario = Sucursal::join('zona_empleado_horario','fk_zona_empleado_1','=','sucursal.su_clave')->join('empleado','empleado.em_clave','=','fk_zona_empleado_3')
        ->join('asistencia','asistencia.fk_zo_em_ho_5','=','zo_em_ho_clave')
        ->where('su_clave','=',$id)->where('a_check','!=',null)->where('em_clave','=',$em->em_clave)->whereBetween('a_fecha',array($monday, $sunday))->sum('em_salario_base');
        /*$em->salario = Sucursal::join('zona_empleado_horario','fk_zona_empleado_1','=','sucursal.su_clave')->join('empleado','empleado.em_clave','=','fk_zona_empleado_3')
        ->join('asistencia','asistencia.fk_zo_em_ho_3','=','em_clave')
        ->where('su_clave','=',$id)->where('a_check','!=',null)->where('em_clave','=',$em->em_clave)->whereBetween('a_fecha',array($monday, $sunday))->sum('em_salario_base');*/

        $total+=$em->salario;
      }

      $sucursal = Sucursal::find($id);
      return view('sucursalNomina')->with(compact('empleados'))->with(compact('sucursal'))->with(compact('total'));
    }
}
