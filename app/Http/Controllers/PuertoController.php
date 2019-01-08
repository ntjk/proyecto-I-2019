<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Yajra\Datatables\Datatables;
use App\Puerto;
//use App\Flota;

class PuertoController extends Controller
{
    public function index()
    {
        //$flotas= Flota::orderBy('flo_placa')->get();
        //return view('puerto',compact('flotas'));
        return view('puerto');
    }
  
    public function getData()
    {
      $puerto = Puerto::select(['puer_clave','puer_cantidad_puestos','puer_cantidad_muelles','puer_longitud','puer_ancho','puer_calado','puer_uso','puer_nombre','fk_flota']);
      return Datatables::of(Puerto::query())->addColumn('action', function ($puerto) {
              return '<button class="btn btn-warning btn-detail update" id="'.$puerto->puer_clave.'" value="'.$puerto->puer_clave.'" name="Update">Update</button>
            <button class="btn btn-danger btn-delete delete" id="'.$puerto->puer_clave.'" value="'.$puerto->puer_clave.'" name="delete">Delete</button>'; })->make(true);
    }
  
    public function store(Request $request)
    {
      if ($request->operation == "Edit"){
        $puerto = Puerto::find($request->puer_clave);
        $puerto->fill($request->all());
        $puerto->save();
      } else {
        $puerto = new Puerto();
        $puerto -> puer_cantidad_puestos = $request->input('puer_cantidad_puestos');
        $puerto -> puer_cantidad_muelles = $request->input('puer_cantidad_muelles');
        $puerto -> puer_longitud = $request->input('puer_longitud');
        $puerto -> puer_ancho = $request->input('puer_ancho');
        $puerto -> puer_calado = $request->input('puer_calado');
        $puerto -> puer_uso = $request->input('puer_uso');
        $puerto -> puer_nombre = $request->input('puer_nombre');
        $puerto -> fk_flota = $request->input('fk_flota');
        $puerto -> save();
      }
      return ['success' => true, 'message' => 'Saved !!'];
    }
  
  
    public function getOne(Request $request){
        return $puerto = Puerto::find($request->puer_clave);
    }
  
    public function destroy(Request $request){
      $puerto = Puerto::find($request->puer_clave);
      $puerto->delete();
      return ['success' => true, 'message' => 'Deleted !!'];
    }

}
