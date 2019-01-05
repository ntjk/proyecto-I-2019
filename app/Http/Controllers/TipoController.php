<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Yajra\Datatables\Datatables;

use App\Tipo;

class TipoController extends Controller
{
  public function index()
  {
    return view('tipo');
  }

  public function getData()
  {
    $tipos = Tipo::select(['ti_clave','ti_nombre','ti_precio_kg']);
    return Datatables::of(Tipo::query())->addColumn('action', function ($tipos) {
            return '<button class="btn btn-warning btn-detail update" id="'.$tipos->ti_clave.'" value="'.$tipos->ti_clave.'" name="Update">Update</button>
          <button class="btn btn-danger btn-delete delete" id="'.$tipos->ti_clave.'" value="'.$tipos->ti_clave.'" name="delete">Delete</button>'; })->make(true);
  }

  public function store(Request $request)
  {
    if ($request->operation == "Edit"){
      $tipo = Tipo::find($request->ti_clave);
      $tipo->fill($request->all());
      $tipo->save();
    } else {
      $tipo = new Tipo();
      $tipo -> ti_nombre = $request->input('ti_nombre');
      $tipo -> ti_precio_kg = $request->input('ti_precio_kg');
      $tipo -> save();
    }
    return ['success' => true, 'message' => 'Saved !!'];
  }


  public function getOne(Request $request){
      return $tipo = Tipo::find($request->ti_clave);
  }

  public function destroy(Request $request){
    $tipo = Tipo::find($request->ti_clave);
    $tipo->delete();
    return ['success' => true, 'message' => 'Deleted !!'];
  }
}
