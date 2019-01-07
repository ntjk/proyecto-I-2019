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
    	$chequeosFk=Chequeo::where('fk_envio', '=', $id)->get(); //linea con la que se obtienen los chequeos de ESE envio
    	$chequeos=Chequeo::all();
    	$envio=$id;
        return view('chequeo')->with(compact('sucursales'))->with(compact('chequeos'))->with(compact('chequeosFk'))->with(compact('envio'));
    }

    public function store(Request $request){
      if ($request->operation == "Edit"){
        $chequeo = Chequeo::find($request->che_clave);
        $chequeo->fill($request->all());
      	$chequeo -> fk_envio = $request->fk_envio;
        $chequeo->save();
      } else {
          $chequeo = new Chequeo();
          $chequeo -> che_fecha = date("Y-m-d h:i:sa");
          $chequeo -> che_descripcion = $request->input('che_descripcion');
          $chequeo -> che_estatus = $request->input('che_estatus');
          $chequeo -> fk_zona = $request->input('fk_zona');
          $chequeo -> fk_envio = $request->fk_envio;
          $chequeo -> save();
        }
        return ['success' => true, 'message' => 'Saved !!'];
    }

    public function getOne(Request $request){
      return $chequeo = Chequeo::find($request->che_clave);
    }

    public function destroy(Request $request){
      $chequeo = Chequeo::find($request->che_clave);
      $chequeo->delete();
      return ['success' => true, 'message' => 'Deleted !!'];
    }

    public function updateSelect(Request $request){
     return $zonas= Zona::where('fk_sucursal', $request->sucursal)->orderBy('zo_nombre')->get();
    	//return $zonas= Sucursal::orderBy('su_nombre')->get();
    }


	

 }
    
