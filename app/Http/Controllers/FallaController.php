<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Falla;
use App\Flota;
use App\Taller;
use App\Revision;
use Illuminate\Support\Facades\DB;


class FallaController extends Controller
{
    public function index()
  {
    $revisiones= Revision::orderBy('rev_clave')->get();
    $flotas= Flota::orderby('flo_clave')->get();
    $talleres= Taller::orderby('ta_nombre')->get();
    $fallas = Falla::join('revision','revision.rev_clave','=','falla.fk_revision_1')
    ->join('flota','flota.flo_clave','=','falla.fk_revision_2')
    ->join('taller','taller.ta_clave','=','falla.fk_revision_3')
    ->select(DB::raw('falla.fa_descripcion as falla, taller.ta_nombre as taller, flota.flo_tipo flota ,
    revision.rev_fecha_real_salida - revision.rev_fecha_entrada as duracion'))
    //->where('flo.flo_clave', '=', $id)->orderBy('duracion')
    ->get();
    return view('falla')->with(compact('revisiones'))->with(compact('flotas'))->with(compact('talleres'))->with(compact('fallas'));

    // $fallas= DB::select(DB::raw('
    // select fa.fa_descripcion as falla, ta.ta_nombre as taller, flo.flo_tipo flota ,re.rev_fecha_real_salida - re.rev_fecha_entrada as duracion 
    // from falla fa, revision re, taller ta, flota flo
    // where fa.fk_revision_1 = re.rev_clave and fa.fk_revision_2 = flo.flo_clave and fa.fk_revision_3 = ta.ta_clave'));
    // return view('falla')->with(compact('fallas'));
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
