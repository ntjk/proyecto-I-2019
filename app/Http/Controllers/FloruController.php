<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Yajra\Datatables\Datatables;

use App\Ruta;
use App\Sucursal;
use App\Envio;
use App\Floru;
use App\Flota;

class FloruController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $sucursales = Floru::join('sucursal','sucursal.su_clave','=','fk_ruta_3')
        ->select(['sucursal.su_nombre'])->get();
        $rutas = Floru::join('sucursal','sucursal.su_clave','=','fk_ruta_2')
        ->select(['fk_ruta_1','sucursal.su_nombre'])->get();

    $i=0;
      foreach($rutas as $ruta){
        $ruta->setAttribute("sd_nombre",$sucursales[$i]->su_nombre);
        $i++;
      }

      return view('floru')->with(compact('rutas'))->with(compact('sucursales'));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }


    /**
     * Process ajax request.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function getData()
    {
      $florus = Floru::select(['sucursal.su_nombre','sucursal.su_clave','sucursal.su_email','sucursal.su_capacidad','lugar.lu_nombre']);
    }

}
