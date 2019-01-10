<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Yajra\Datatables\Datatables;
use Illuminate\Support\Facades\DB;
use App\Envio;
use App\Cliente;
use App\Sucursal;
use App\Floru;
use App\Ruta;
use App\Flota;
use App\Destinatario;
use App\Telefono;
use App\Tipo;
use App\Chequeo;
use App\Zona;

class ChequeoController extends Controller
{

	public function index()
    {
    }

	public function show($id)
    {
    	$sucursales=Sucursal::orderBy('su_nombre')->get();
    	//$chequeosFk=Chequeo::where('fk_envio', '=', $id)->get(); //linea con la que se obtienen los chequeos de ESE envio
    	$envio=$id;    
      $chequeosSinZona=Chequeo::select('che_clave', 'che_estatus', 'che_descripcion', 'che_fecha_entrada', 'che_fecha_salida', 'fk_zona', 'chequeo.fk_sucursal','fk_envio')->distinct()->where('fk_envio', '=', $id)->get();
      $i=0;
        foreach($chequeosSinZona as $csz){
          $csz->setAttribute("zo_nombre",null);
          $csz->setAttribute("su_nombre",null);
          $i++;
        }
      $chequeosConZona=Chequeo::join('sucursal','sucursal.su_clave','=','chequeo.fk_sucursal')->join('zona','zona.zo_clave', '=', 'chequeo.fk_sucursal')->select(
         'che_clave', 'che_estatus', 'che_descripcion', 'che_fecha_entrada', 'che_fecha_salida', 'fk_zona', 'chequeo.fk_sucursal','fk_envio','su_nombre','zo_nombre')->distinct()->where('fk_envio', '=', $id)->orderBy('che_clave')->get();
      $chequeosFk = $chequeosConZona->union($chequeosSinZona);
      //return $chequeosFk;
      return view('chequeo')->with(compact('sucursales'))->with(compact('chequeosFk'))->with(compact('envio'));
    }

    public function store(Request $request){
      if ($request->operation == "Edit"){
        $chequeo = Chequeo::find($request->che_clave);
        $chequeo->fill($request->all());
      	$chequeo -> fk_envio = $request->fk_envio;
        $chequeo->save();
      } else {
          $chequeo = new Chequeo();
          $chequeo -> che_fecha_entrada = date("Y-m-d h:i:sa");
          $chequeo -> che_descripcion = $request->input('che_descripcion');
          $chequeo -> che_estatus = $request->input('che_estatus');
          $chequeo -> fk_zona = $request->input('fk_zona');
          $chequeo -> fk_envio = $request->fk_envio;
          $chequeoAnterior = Chequeo::where('fk_envio','=',$request->fk_envio)->orderBy('che_clave','desc')->first();
          if ($chequeoAnterior != null){
            $chequeoAnterior -> che_fecha_salida = $chequeo -> che_fecha_entrada;
            $chequeoAnterior -> save();
          }
          $chequeo -> save();
        }
        return ['success' => true, 'message' => 'Saved !!'];
    }

    public function getOne(Request $request){
      $chequeo = Chequeo::find($request->che_clave)->get();
      $zona = Zona::find($chequeo[0]->fk_zona)->distinct()->get();
      $sucursal = Sucursal::find($chequeo[0]->fk_sucursal)->get();
      $chequeo[0]->setAttribute("zo_nombre",$zona[0]->zo_nombre);
      $chequeo[0]->setAttribute("su_nombre",$sucursal[0]->su_nombre);
      return $chequeo[0];
    }

    public function destroy(Request $request){
      $chequeo = Chequeo::find($request->che_clave);
      $chequeo->delete();
      return ['success' => true, 'message' => 'Deleted !!'];
    }

    public function updateSelect(Request $request){
     return $zonas= Zona::where('zona.fk_sucursal', $request->sucursal)->orderBy('zo_nombre')->distinct()->get();

    }


	

 }
    
