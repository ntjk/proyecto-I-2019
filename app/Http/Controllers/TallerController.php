<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Yajra\Datatables\Datatables;
use App\Taller;
use App\Lugar;


class TallerController extends Controller
{
    public function index()
    {
      $estados= Lugar::where('lu_tipo','estado')->orderBy('lu_nombre')->get();
      return view('taller',compact('estados'));
    }

    public function getData()
    {
      $talleres = Taller::join('lugar','lugar.lu_clave','=','taller.fk_lugar')->select([
        'taller.ta_clave',
        'taller.ta_nombre',
        'taller.ta_email',
        'taller.ta_contacto',
        'taller.ta_pagina_web',
        'lugar.lu_nombre']);
        return Datatables::of($talleres)->addColumn('action', function ($talleres) {
                return '<button class="btn btn-warning btn-detail update" id="'.$talleres->ta_clave.'" value="'.$talleres->ta_clave.'" name="Update">Update</button>
              <button class="btn btn-danger btn-delete delete" id="'.$talleres->ta_clave.'" value="'.$talleres->ta_clave.'" name="delete">Delete</button>'; })->make(true);
    }

    public function store(Request $request){
      if ($request->operation == "Edit"){
        $taller = Taller::find($request->ta_clave);
        $taller->fill($request->all());
        $taller->save();
      } else {
          $taller = new Taller();
          $taller -> ta_nombre = $request->input('ta_nombre');
          $taller -> ta_email = $request->input('ta_email');
          $taller -> ta_contacto = $request->input('ta_contacto');
          $taller -> ta_pagina_web = $request->input('ta_pagina_web');
          $taller -> fk_lugar = $request->input('fk_lugar');
          $taller -> save();
        }
        return ['success' => true, 'message' => 'Saved !!'];
    }

    public function getOne(Request $request){
      return $taller = Taller::find($request->ta_clave);
    }

    public function destroy(Request $request){
      $taller = Taller::find($request->ta_clave);
      $taller->delete();
      return ['success' => true, 'message' => 'Deleted !!'];
    }

    public function updateSelect(Request $request){
      return $lugares= Lugar::where('fk_lugar',$request->estado)->orderBy('lu_nombre')->get();
    }

    // public function updateSelect2(Request $request){
    //   return $parroquias= Lugar::where('fk_lugar',$request->municipio)->orderBy('lu_nombre')->get();
    // }

}
