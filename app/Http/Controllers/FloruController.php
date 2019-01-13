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
        ->select(['sucursal.su_clave', 'sucursal.su_nombre'])->get();
        $rutas = Floru::join('sucursal','sucursal.su_clave','=','fk_ruta_2')
        ->select(['flo_ru_clave','flo_ruta','flo_ru_costo','flo_ru_duracion_hrs','sucursal.su_nombre','fk_flota','fk_ruta_1','fk_ruta_2','fk_ruta_3'])->get();
        $flotas = Flota::get();

    $i=0;
      foreach($rutas as $ruta){
        $ruta->setAttribute("sd_nombre",$sucursales[$i]->su_nombre);
        $i++;
      }

      return view('floru')->with(compact('rutas'))->with(compact('sucursales'))->with(compact('flotas'));

    }

    public function guardarRuta(Request $request){
        if ($request->operation == "Edit"){
          $ruta = Ruta::find($request->ru_clave);
          $ruta->fill($request->all());
          $ruta->save();
        } else {
            $rut = Ruta::where('fk_sucursal_1','=', $request->input('fk_sucursal_1'))->where('fk_sucursal_2','=', $request->input('fk_sucursal_2'))->exists();

            if($rut==false){
                $ruta = new Ruta();
                $ruta -> fk_sucursal_1 = $request->fk_sucursal_1;
                $ruta -> fk_sucursal_2 = $request->fk_sucursal_2;
                $ruta -> save();
//este no incluye el nro de ruta, solo tiene las punto a punto.
            }//else{
            $rutClave = Ruta::where('fk_sucursal_1','=', $request->input('fk_sucursal_1'))->where('fk_sucursal_2','=', $request->input('fk_sucursal_2'))->first()->ru_clave;
            $UltimoFloru= Floru::max('flo_ruta')->first()->flo_ruta;//aseguras que la ruta sea la proxima
    
            $floru = new Floru();
            $floru -> fk_ruta_1 = $rutClave;  
            $floru -> fk_ruta_2 = $request->input('fk_sucursal_1');                
            $floru -> fk_ruta_3 = $request->input('fk_sucursal_2');
            $floru -> fk_flota = $request->input('fk_flota');
            $floru -> flo_ru_costo = $request->input('flo_ru_costo');
            $floru -> flo_ru_duracion_hrs = $request->input('flo_ru_duracion_hrs');
            $floru -> flo_ruta = $UltimoFloru + 1;
          //  }
          }
          return ['success' => true, 'message' => 'Saved !!'];
    }


   /* public function getData()
    {
      $florus = Floru::select(['sucursal.su_nombre','sucursal.su_clave','sucursal.su_email','sucursal.su_capacidad','lugar.lu_nombre']);
    }*/

}
