<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Yajra\Datatables\Datatables;
use App\Flota;
use App\Sucursal;
use App\Modelo;

class FlotaController extends Controller
{
	/**
     * Displays front end view
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $sucursales= Sucursal::orderBy('su_nombre')->get();
        $modelos= Modelo::orderBy('mod_nombre')->get();
        $flotas = Flota::join('sucursal','sucursal.su_clave','=','flota.fk_sucursal')
        ->join('modelo','modelo.mod_clave','=','flota.fk_modelo')
        ->select([
            'flota.flo_clave',
            'flota.flo_subtipo',
            'flota.flo_tipo',
            'flota.flo_peso',
            'flota.flo_placa',
            'flota.flo_descripcion',
            'flota.flo_combustible_por_hora',
            'flota.flo_serial_carroceria',
            'flota.flo_capacidad_carga',
            'flota.flo_te_nacional',
            'flota.flo_te_serial_motor',
            'flota.flo_ma_serial_motor',
            'flota.flo_a_longitud',
            'flota.flo_a_envergadura',
            'flota.flo_a_area',
            'flota.flo_a_altura',
            'flota.flo_a_ancho_cabina_interna',
            'flota.flo_a_diametro_fuselaje',
            'flota.flo_a_peso_vacio',
            'flota.flo_a_peso_maximo_despegue',
            'flota.flo_a_carrera_de_despegue',
            'flota.flo_a_velocidad_maxima',
            'sucursal.su_nombre',
            'modelo.mod_nombre',
            'flota.flo_año'
        ])->where('flota.flo_subtipo','terrestre')->orderBy('flo_clave')->get();
        return view('flota')->with(compact('sucursales'))->with(compact('modelos'))->with(compact('flotas'));
    }
   
    public function indexM()
    {
        $sucursales= Sucursal::orderBy('su_nombre')->get();
        $modelos= Modelo::orderBy('mod_nombre')->get();
        $flotas = Flota::join('sucursal','sucursal.su_clave','=','flota.fk_sucursal')
        ->join('modelo','modelo.mod_clave','=','flota.fk_modelo')
        ->select([
            'flota.flo_clave',
            'flota.flo_subtipo',
            'flota.flo_tipo',
            'flota.flo_peso',
            'flota.flo_placa',
            'flota.flo_descripcion',
            'flota.flo_combustible_por_hora',
            'flota.flo_serial_carroceria',
            'flota.flo_capacidad_carga',
            'flota.flo_te_nacional',
            'flota.flo_te_serial_motor',
            'flota.flo_ma_serial_motor',
            'flota.flo_a_longitud',
            'flota.flo_a_envergadura',
            'flota.flo_a_area',
            'flota.flo_a_altura',
            'flota.flo_a_ancho_cabina_interna',
            'flota.flo_a_diametro_fuselaje',
            'flota.flo_a_peso_vacio',
            'flota.flo_a_peso_maximo_despegue',
            'flota.flo_a_carrera_de_despegue',
            'flota.flo_a_velocidad_maxima',
            'sucursal.su_nombre',
            'modelo.mod_nombre',
            'flota.flo_año'
        ])->where('flota.flo_subtipo','marítima')->orderBy('flo_clave')->get();
        return view('flotaM')->with(compact('sucursales'))->with(compact('modelos'))->with(compact('flotas'));
    }
    
    public function indexA()
    {
        $sucursales= Sucursal::orderBy('su_nombre')->get();
        $modelos= Modelo::orderBy('mod_nombre')->get();
        $flotas = Flota::join('sucursal','sucursal.su_clave','=','flota.fk_sucursal')
        ->join('modelo','modelo.mod_clave','=','flota.fk_modelo')
        ->select([
            'flota.flo_clave',
            'flota.flo_subtipo',
            'flota.flo_tipo',
            'flota.flo_peso',
            'flota.flo_placa',
            'flota.flo_descripcion',
            'flota.flo_combustible_por_hora',
            'flota.flo_serial_carroceria',
            'flota.flo_capacidad_carga',
            'flota.flo_te_nacional',
            'flota.flo_te_serial_motor',
            'flota.flo_ma_serial_motor',
            'flota.flo_a_longitud',
            'flota.flo_a_envergadura',
            'flota.flo_a_area',
            'flota.flo_a_altura',
            'flota.flo_a_ancho_cabina_interna',
            'flota.flo_a_diametro_fuselaje',
            'flota.flo_a_peso_vacio',
            'flota.flo_a_peso_maximo_despegue',
            'flota.flo_a_carrera_de_despegue',
            'flota.flo_a_velocidad_maxima',
            'sucursal.su_nombre',
            'modelo.mod_nombre',
            'flota.flo_año'
        ])->where('flota.flo_subtipo','aerea')->orderBy('flo_clave')->get();
        return view('flotaA')->with(compact('sucursales'))->with(compact('modelos'))->with(compact('flotas'));
    }
   

    public function store(Request $request){
      if ($request->operation == "Edit"){
        $flota = Flota::find($request->flo_clave);
        $flota->fill($request->all());
        $flota->save();
      } else {
          $flota = new Flota();
          $flota -> flo_subtipo = $request->input('flo_subtipo');
          $flota -> flo_tipo = $request->input('flo_tipo');
          $flota -> flo_peso = $request->input('flo_peso');
          $flota -> flo_placa = $request->input('flo_placa');
          $flota -> flo_descripcion = $request->input('flo_descripcion');
          $flota -> flo_combustible_por_hora = $request->input('flo_combustible_por_hora');
          $flota -> flo_serial_carroceria = $request->input('flo_serial_carroceria');
          $flota -> flo_capacidad_carga = $request->input('flo_capacidad_carga');
          $flota -> flo_te_nacional = $request->input('flo_te_nacional');
          $flota -> flo_te_serial_motor = $request->input('flo_te_serial_motor');
          $flota -> flo_ma_serial_motor = $request->input('flo_ma_serial_motor');
          $flota -> flo_a_longitud = $request->input('flo_a_longitud');
          $flota -> flo_a_envergadura = $request->input('flo_a_envergadura');
          $flota -> flo_a_area = $request->input('flo_a_area');
          $flota -> flo_a_altura = $request->input('flo_a_altura');
          $flota -> flo_a_ancho_cabina_interna = $request->input('flo_a_ancho_cabina_interna');
          $flota -> flo_a_diametro_fuselaje = $request->input('flo_a_diametro_fuselaje');
          $flota -> flo_a_peso_vacio = $request->input('flo_a_peso_vacio');
          $flota -> flo_a_peso_maximo_despegue = $request->input('flo_a_peso_maximo_despegue');
          $flota -> flo_a_carrera_de_despegue = $request->input('flo_a_carrera_de_despegue');
          $flota -> flo_a_velocidad_maxima = $request->input('flo_a_velocidad_maxima');
          $flota -> fk_sucursal = $request->input('fk_sucursal');
          $flota -> fk_modelo = $request->input('fk_modelo');
          $flota -> flo_año = $request->input('flo_año');
          $flota -> save();
        }
        return ['success' => true, 'message' => 'Saved !!'];
    }

    public function getOne(Request $request){
      return $flota = Flota::find($request->flo_clave);
    }

    public function destroy(Request $request){
      $flota = Flota::find($request->flo_clave);
      $flota->delete();
      return ['success' => true, 'message' => 'Deleted !!'];
    }
}
