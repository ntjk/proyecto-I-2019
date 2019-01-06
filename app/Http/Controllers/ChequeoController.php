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

class ChequeoController extends Controller
{

	public function show($id)
    {
    	$sucursales=Sucursal::orderBy('su_nombre')->get();
    	$chequeosFk=Chequeo::where('fk_envio', '=', $id)->get(); //linea con la que se obtienen los chequeos de ESE envio
    	$chequeos=Chequeo::all();
        return view('chequeo')->with(compact('sucursales'))->with(compact('chequeos'))->with(compact('chequeosFk'));
    }

    public function prueba(Request $request){
      	$sucursales=Sucursal::orderBy('su_nombre')->get();
    	//$chequeosFk=Chequeo::where('fk_envio', '=', $request->input('fk_envio'))->get(); //linea con la que se obtienen los chequeos de ESE envio
    	//$chequeos=Chequeo::all();
//return Envio::findOrFail($id);
    	//echo $chequeosFk;
        return view('sucursal')->with(compact('sucursales'));

    }


	

 }
    
