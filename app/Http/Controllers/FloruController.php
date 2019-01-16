<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Yajra\Datatables\Datatables;

use App\Ruta;
use App\Sucursal;
use App\Envio;
use App\Floru;
use App\Flota;
use App\Modelo;

class FloruController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $sucursales = Floru::join('sucursal','sucursal.su_clave','=','fk_ruta_3')->orderBy('flo_ru_clave')
        ->select(['sucursal.su_clave', 'sucursal.su_nombre'])->get();
        $rutas = Floru::join('sucursal','sucursal.su_clave','=','fk_ruta_2')->join('flota','flo_clave','=','flota_ruta.fk_flota')->join('modelo','mod_clave', '=', 'flota.fk_modelo')
        ->select(['mod_nombre','flo_ru_clave','flo_año','flo_ruta','flo_ru_costo','flo_subtipo','flo_ru_duracion_hrs','sucursal.su_nombre','fk_flota','fk_ruta_1','fk_ruta_2','fk_ruta_3'])->orderBy('flo_ru_clave')->get();
        $flotas = Flota::join('modelo','mod_clave', '=', 'flota.fk_modelo')->select('mod_nombre','flo_clave','flo_subtipo', 'flo_año')->get();
        /*select mod_nombre, flo_ru_clave, flo_ruta, flo_ru_costo, flo_año, flo_subtipo, flo_ru_duracion_hrs, so.su_nombre as so, sd.su_nombre as sd, fk_flota, fk_ruta_1, fk_ruta_2, fk_ruta_3 from flota, sucursal as so, sucursal as sd, modelo, flota_ruta where fk_modelo = mod_clave and fk_flota=flo_clave and fk_ruta_2=so.su_clave and fk_ruta_3=sd.su_clave order by flo_ruta*/

    $i=0;
      foreach($rutas as $ruta){
        $ruta->setAttribute("sd_nombre",$sucursales[$i]->su_nombre);
        $i++;
      }

      return view('floru')->with(compact('rutas'))->with(compact('sucursales'))->with(compact('flotas'));

    }

    public function guardarRuta(Request $request){
        if ($request->operation == "Edit"){
          $floru = Floru::find($request->flo_ru_clave);
          $floru->fill($request->all());
          $floru->save();
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
            $UltimoFloru= Floru::max('flo_ruta');//aseguras que la ruta sea la proxima
    
            $floru = new Floru();
            $floru -> fk_ruta_1 = $rutClave;  
            $floru -> fk_ruta_2 = $request->input('fk_sucursal_1');                
            $floru -> fk_ruta_3 = $request->input('fk_sucursal_2');
            $floru -> fk_flota = $request->input('fk_flota');
            $floru -> flo_ru_costo = $request->input('flo_ru_precio');
            $floru -> flo_ru_duracion_hrs = $request->input('flo_ru_duracion');
            $floru -> flo_ruta = $UltimoFloru + 1;
            $floru -> save();
          //  }
          }
          return ['success' => true, 'message' => 'Saved !!'];
    }

    public function getOne(Request $request){
      return $floru = Floru::find($request->flo_ru_clave);
    }

    public function guardarNodo(Request $request){

      $floru = Floru::find($request->flo_ru_clave);
      /*tienes que hallar el origen de esa ruta para poder agregarle un nodo e identificar cual ruta es
      con la primera cond estamos haciendo que el destino de floru sea el ppio de esta nueva ruta*/

      //con esa se busca a cual ruta pertenece y se halla el ultimo nodo de esa ruta
      $UltimoFloru=Floru::where('flo_ruta', '=', $floru->flo_ruta)->orderBy('flo_ru_clave', 'desc')->first();
      $rut = Ruta::where('fk_sucursal_1','=', $UltimoFloru->fk_ruta_3)->where('fk_sucursal_2','=', $request->fk_sucursal_2)->exists();

      if($rut==false){
        $ruta = new Ruta();
        $ruta -> fk_sucursal_1 = $UltimoFloru->fk_ruta_3;
        $ruta -> fk_sucursal_2 = $request->fk_sucursal_2;
        $ruta -> save();
    //este no incluye el nro de ruta, solo tiene las punto a punto.
      }//else{
      $rutClave = Ruta::where('fk_sucursal_1','=', $UltimoFloru->fk_ruta_3)->where('fk_sucursal_2','=', $request->fk_sucursal_2)->first()->ru_clave;
    
            $floruNodo = new Floru();
            $floruNodo -> flo_ruta = $UltimoFloru->flo_ruta;
            $floruNodo -> fk_ruta_1 = $rutClave;  
            $floruNodo -> fk_ruta_2 = $UltimoFloru->fk_ruta_3;              
            $floruNodo -> fk_ruta_3 = $request->fk_sucursal_2;
            $floruNodo -> fk_flota = $request->fk_flota;
            $floruNodo -> flo_ru_costo = $request->flo_ru_precio;
            $floruNodo -> flo_ru_duracion_hrs = $request->flo_ru_duracion;
            //Esencia de la logica: porque es el nodo de ESA ruta*/
            $floruNodo -> save();
          //  }
          return ['success' => true, 'message' => 'Saved !!'];
    }

    public function destroy(Request $request){
      $floru = Floru::find($request->flo_ru_clave);
      $ruta = Floru::where('flo_ruta','=',$floru->flo_ruta);
      $ruta->delete();
      return ['success' => true, 'message' => 'Deleted !!'];
    }
   /* public function getData()
    {
      $florus = Floru::select(['sucursal.su_nombre','sucursal.su_clave','sucursal.su_email','sucursal.su_capacidad','lugar.lu_nombre']);
    }*/

}
