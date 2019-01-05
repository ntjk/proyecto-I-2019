<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Yajra\Datatables\Datatables;

use App\Ruta;
use App\Sucursal;

class RutaController extends Controller
{
  public function index()
  {
    $sucursales= Sucursal::orderBy('su_nombre')->get();
    //$origenn = Ruta::find(1)->origen()->get();
    return view('ruta')->with(compact('sucursales'));
  }
  public function getData()
  {
    ;
    $rutas = Ruta::join('sucursal','sucursal.su_clave','=','ruta.fk_sucursal_1')
    ->select(['ruta.ru_clave','sucursal.su_nombre','fk_sucursal_2']);


      return Datatables::of($rutas)->addColumn('action', function ($rutas) {
              return '<button class="btn btn-warning btn-detail update" id="'.$rutas->ru_clave.'" value="'.$rutas->ru_clave.'" name="Update">Update</button>
            <button class="btn btn-danger btn-delete delete" id="'.$rutas->ru_clave.'" value="'.$rutas->ru_clave.'" name="delete">Delete</button>'; })->make(true);
  }
  public function store(Request $request){
    if ($request->operation == "Edit"){
      $ruta = Ruta::find($request->ru_clave);
      $ruta->fill($request->all());
      $ruta->save();
    } else {
        $ruta = new Ruta();
        $ruta -> fk_sucursal_1 = $request->input('fk_sucursal_1');
        $ruta -> fk_sucursal_2 = $request->input('fk_sucursal_2');
        $ruta -> save();
      }
      return ['success' => true, 'message' => 'Saved !!'];
  }

  public function getOne(Request $request){
    return $ruta = Ruta::find($request->ru_clave);
  }

  public function destroy(Request $request){
    $ruta = Ruta::find($request->ru_clave);
    $ruta->delete();
    return ['success' => true, 'message' => 'Deleted !!'];
  }
}
