<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Yajra\Datatables\Datatables;

use Illuminate\Support\Facades\DB;
use App\Aeropuerto;
use App\Sucursal;
use App\Lugar;


class AeropuertoController extends Controller
{
    public function index()
    {
      
      // $aeropuertos= DB::select(DB::raw('
      // select ae.ae_clave, ae.ae_nombre, ae.ae_capacidad as capacidad, ae.ae_cantidad_pistas as pistas, ae.ae_cantidad_terminales as terminales, ae.ae_otro as otros, ae.fk_sucursal as sucursal
      // from aeropuerto ae, sucursal su
      // where ae.fk_sucursal = su.su_clave'));
      // return view('aeropuerto')->with(compact('aeropuertos'));
      
      $sucursales=Sucursal::orderBy('su_nombre')->get();
      return view('aeropuerto',compact('aeropuertos'),compact('sucursales'));
    }
  
    public function getData()
    {
      $aeropuerto = Aeropuerto::select(['ae_clave','ae_nombre','ae_capacidad','ae_cantidad_pistas','ae_cantidad_terminales','ae_otro','fk_sucursal']);
      return Datatables::of(Aeropuerto::query())->addColumn('action', function ($aeropuerto) {
              return '<button class="btn btn-warning btn-detail update" id="'.$aeropuerto->ae_clave.'" value="'.$aeropuerto->ae_clave.'" name="Update">Update</button>
            <button class="btn btn-danger btn-delete delete" id="'.$aeropuerto->ae_clave.'" value="'.$aeropuerto->ae_clave.'" name="delete">Delete</button>'; })->make(true);
    }
  
    public function store(Request $request)
    {
      if ($request->operation == "Edit"){
        $aeropuerto = Aeropuerto::find($request->ae_clave);
        $aeropuerto->fill($request->all());
        $aeropuerto->save();
      } else {
        $aeropuerto = new Aeropuerto();
        $aeropuerto -> ae_nombre = $request->input('ae_nombre');
        $aeropuerto -> ae_capacidad = $request->input('ae_capacidad');
        $aeropuerto -> ae_cantidad_pistas = $request->input('ae_cantidad_pistas');
        $aeropuerto -> ae_cantidad_terminales = $request->input('ae_cantidad_terminales');
        $aeropuerto -> ae_otro = $request->input('ae_otro');
        $aeropuerto -> fk_sucursal = $request->input('fk_sucursal');
        $aeropuerto -> save();
      }
      return ['success' => true, 'message' => 'Saved !!'];
    }
  
    public function getOne(Request $request){
        return $aeropuerto = Aeropuerto::find($request->ae_clave);
    }
  
    public function destroy(Request $request){
      $aeropuerto = Aeropuerto::find($request->ae_clave);
      $aeropuerto->delete();
      return ['success' => true, 'message' => 'Deleted !!'];
    }

}
