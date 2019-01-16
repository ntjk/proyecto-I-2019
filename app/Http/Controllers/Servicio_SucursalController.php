<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Yajra\Datatables\Datatables;
use App\Servicio_Sucursal;
use App\Servicio;
use App\Sucursal;

class Servicio_SucursalController extends Controller
{

  public function index()
    {
        // $sucursales= Sucursal::orderBy('su_nombre')->get();
        // $servicios= Servicio::orderBy('ser_tipo')->get();
        return view("servicio_sucursal");
    }

    public function getData()
    {
        $servicio_sucursal = Servicio_Sucursal::join('sucursal','sucursal.su_clave','=','servicio_sucursal.fk_sucursal')
        ->join('servicio','servicio.ser_clave','=','servicio_sucursal.fk_servicio')
        ->select([
            'sucursal.su_nombre',
            'servicio.ser_tipo',
            'servicio.ser_descripcion',
        ]);
        return Datatables::of($servicio_sucursal)->addColumn('action', function ($servicio_sucursal) {
            return '<button class="btn btn-warning btn-detail update" id="'.$servicio_sucursal->fk_servicio.'" value="'.$servicio_sucursal->fk_servicio.'" name="Update">Update</button>
            <button class="btn btn-danger btn-delete delete" id="'.$servicio_sucursal->fk_servicio.'" value="'.$servicio_sucursal->fk_servicio.'" name="delete">Delete</button>'; })->make(true);

    }

    public function store(Request $request){
      if ($request->operation == "Edit"){
        $servicio_sucursal = Servicio_Sucursal::find($request->fk_servicio);
        $servicio_sucursal->fill($request->all());
        $servicio_sucursal->save();
      } else {
          $servicio_sucursal = new Servicio_Sucursal();
          $servicio_sucursal -> fk_sucursal = $request->input('fk_sucursal');
          $servicio_sucursal -> fk_servicio = $request->input('fk_servicio');
          $servicio_sucursal -> save();
        }
        return ['success' => true, 'message' => 'Saved !!'];
    }

    public function getOne(Request $request){
      return $servicio_sucursal = Servicio_Sucursal::find($request->fk_servicio);
    }

    // $ss= DB::select(DB::raw('
    // select su.su_nombre, ser.ser_tipo
    // from sucursal su, servicio ser, servicio_sucursal ss
    // where ss.fk_sucursal=su.su_clave and ss.fk_servicio=ser.ser_clave
    // group by su.su_nombre, ser.ser_tipo
    // '));
    // return view('')->with(compact('ss'));

}
