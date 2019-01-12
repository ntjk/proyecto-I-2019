<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Falla;
use App\Flota;
use App\Taller;
use App\Revision;

class FallaController extends Controller
{
    public function index()
  {
    $revisiones= Revision::orderBy('rev_clave')->get();
    $flotas= Flota::orderby('flo_clave')->get();
    $talleres= Taller::orderby('ta_nombre')->get();
    $fallas = Falla::join('revision','revision.rev_clave','=','falla.fk_revision_1')
    ->join('flota','flota.flo_clave','=','revision.fk_flota')
    ->join('taller','taller.ta_clave','=','revision.fk_taller')
    ->select(['falla.fa_clave','falla.fa_descripcion','taller.ta_nombre',
    'flota.flo_tipo','revision.rev_fecha_entrada','revision.rev_fecha_real_salida'])->get();
    return view('falla')->with(compact('revisiones'))->with(compact('flotas'))->with(compact('talleres'))->with(compact('fallas'));
  }

  public function store(Request $request){
    if ($request->operation == "Edit"){
      $falla = Falla::find($request->fa_clave);
      $falla->fill($request->all());
      $falla->save();
    } else {
        $falla = new Falla();
        $falla -> fa_descripcion = $request->input('fa_descripcion');
        $falla -> fk_revision_1 = $request->input('fk_revision_1');
        $falla -> fk_revision_2 = $request->input('fk_revision_2');
        $falla -> fk_revision_3 = $request->input('fk_revision_3');
        $falla -> save();
      }
      return ['success' => true, 'message' => 'Saved !!'];
  }

  public function getOne(Request $request){
        return $falla = Falla::find($request->fa_clave);
    }
      public function destroy(Request $request){
        $falla = Falla::find($request->fa_clave);
        $falla->delete();
        return ['success' => true, 'message' => 'Deleted !!'];
      }
}
