<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Yajra\Datatables\Datatables;
use App\Envio;
use App\Cliente;
use App\Sucursal;
use App\Floru;
use App\Ruta;
use App\Flota;
use App\Destinatario;
use App\Telefono;

class EnvioController extends Controller
{
    /**
     * Displays front end view
     *
     * @return \Illuminate\View\View
     */


    public function index()
    {
      $clientes=Cliente::orderBy('cli_nombre')->get();
      $rutas=Ruta::orderBy('ru_clave')->get();
      $sucursales=Sucursal::orderBy('su_nombre')->get();
      $florus=Floru::orderBy('flo_ru_clave')->get();

     /* Con esto seleccionas un nodo y está bien. Hacer que esto salga en una filita o varias filitas
select su_nombre, ru_clave from ruta, sucursal where fk_sucursal_1=su_clave and fk_sucursal_2=335 and fk_ruta in (select ru_clave from ruta where fk_sucursal_1 = 1 and fk_ruta is null)

Habria que hacer esto para obtener el nombre del nodo 2
select su_nombre, ru_clave from ruta, sucursal where fk_sucursal_1=su_clave and fk_sucursal_2=335 and fk_ruta in (select ru_clave from ruta where fk_ruta in (select ru_clave from ruta where fk_sucursal_1 = 1 and fk_ruta is null))
Habria que hacer esto para obtener el nombre del nodo 1
select su_nombre, ru_clave from ruta, sucursal where fk_sucursal_1=su_clave and fk_sucursal_2!=335 and fk_ruta in (select ru_clave from ruta where fk_sucursal_1 = 1 and fk_ruta is null) */

      $envio1 = Envio::join('sucursal','sucursal.su_clave','=','envio.fk_sucursal_origen')
        ->select(['sucursal.su_nombre'])
        //->whereBetween('sucursal.su_clave', [1, 10])
        ->get();
        $envio2 = Envio::join('sucursal','sucursal.su_clave','=','envio.fk_sucursal_destino')
        ->select(['sucursal.su_nombre'])
        //->whereBetween('sucursal.su_clave', [1, 10])
        ->get();
        $envio3 = Envio::join('cliente','cli_clave','=','envio.fk_cliente')->select(['cliente.cli_cedula'])
        //->whereBetween('cliente.cli_clave', [1, 10])
        ->get();
        $envio4 = Envio::join('destinatario','des_clave','=','envio.fk_destinatario')->select(['destinatario.des_cedula'])
        //->whereBetween('destinatario.des_clave', [1, 10])
        ->get();


        $envios = Envio::select(
            'envio.en_clave',
            'envio.en_tipo',
            'envio.en_precio',
            'envio.en_peso',
            'envio.en_descripcion',
            'envio.en_altura',
            'envio.en_anchura',
            'envio.en_profundidad',
            'envio.en_fecha_envio',
            'envio.en_fecha_entrega_estimada',
            'envio.fk_flota_ruta_1')
        //->whereBetween('envio.en_clave', [1, 10])
        ->get();


        $i=0;
        foreach($envios as $envi){
          $envi->setAttribute("so_nombre",$envio1[$i]->su_nombre);
          $envi->setAttribute("sd_nombre",$envio2[$i]->su_nombre);
          $envi->setAttribute("cli_cedula",$envio3[$i]->cli_cedula);
          $envi->setAttribute("des_cedula",$envio4[$i]->des_cedula);
          $i++;
        }

      return view('envio')->with(compact('sucursales'))->with(compact('clientes'))->with(compact('florus'))->with(compact('rutas'))->with(compact('envios'));
     // return view('envio')->with(compact('sucursales'))->with(compact('clientes'))->with(compact('florus'))->with(compact('rutas'));
    }

    /**
     * Process ajax request.
     *
     * @return \Illuminate\Http\JsonResponse
     */

    public function getData()
    {

        $envio = Envio::join('sucursal','sucursal.su_clave','=','envio.fk_sucursal_origen')
        ->join('cliente','cliente.cli_clave','=','envio.fk_cliente')
        ->join('destinatario','destinatario.des_clave','=','envio.fk_destinatario')
        ->select([
            'envio.en_clave',
            'envio.en_tipo',
            'envio.en_precio',
            'envio.en_peso',
            'envio.en_descripcion',
            'envio.en_altura',
            'envio.en_anchura',
            'envio.en_profundidad',
            'envio.en_fecha_envio',
            'envio.en_fecha_entrega_estimada',
            'envio.fk_flota_ruta_1',
            'envio.fk_sucursal_destino',
            'sucursal.su_nombre',
            'cliente.cli_cedula',
            'destinatario.des_cedula'
        ]);

        return Datatables::of($envio)->addColumn('action', function ($envio) {
            return '<button class="btn btn-warning btn-detail update" id="'.$envio->en_clave.'" value="'.$envio->en_clave.'" name="Update">Update</button>
            <button class="btn btn-danger btn-delete delete" id="'.$envio->en_clave.'" value="'.$envio->en_clave.'" name="delete">Delete</button>'; })->make(true);
    }

    public function store(Request $request){
      if ($request->operation == "Edit"){
        $cliente = Cliente::find($request->fk_cliente);
        $cliente->cli_cedula = $request->input('fk_cliente');
        $cliente->save();
        $envio = Envio::find($request->en_clave);
        $envio->fill($request->all());
        $envio->save();
      } else {
          $envio = new Envio();
          $envio -> en_tipo = $request->input('en_tipo');
          $envio -> en_precio = $request->input('en_precio');
          $envio -> en_peso = $request->input('en_peso');
          $envio -> en_descripcion = $request->input('en_descripcion');
          $envio -> en_altura = $request->input('en_altura');
          $envio -> en_anchura = $request->input('en_anchura');
          $envio -> en_profundidad = $request->input('en_profundidad');
          $envio -> en_fecha_envio = $request->input('en_fecha_envio');
          $envio -> en_fecha_entrega_estimada = $request->input('en_fecha_entrega_estimada');
          $envio -> fk_cliente = $request->input('fk_cliente');
          $envio -> fk_sucursal_origen = $request->input('fk_sucursal_origen');
          $envio -> fk_sucursal_destino = $request->input('fk_sucursal_destino');

          $ruta3 = Floru::where('flo_ru_clave','=', $request->input('fk_flota_ruta_1'))->first();
          $envio -> fk_flota_ruta_1 = $ruta3->flo_ru_clave;
          $envio -> fk_flota_ruta_2 = $ruta3->fk_flota;
          $envio -> fk_flota_ruta_3 = $ruta3->fk_ruta_1;
          $envio -> fk_flota_ruta_4 = $ruta3->fk_ruta_2;
          $envio -> fk_flota_ruta_5 = $ruta3->fk_ruta_3;

          $destinatario = new Destinatario();
          $destinatario -> des_nombre = $request->input('des_nombre');
          $destinatario -> des_apellido = $request->input('des_apellido');
          $destinatario -> des_cedula = $request->input('des_cedula');
          $destinatario -> save();

          $telefono = new Telefono();
          $telefono -> tel_numero = $request->input('tel_numero');
          $destinatarioClave = Destinatario::where('destinatario.des_cedula','=', $request->input('des_cedula'))->where('destinatario.des_nombre','=', $request->input('des_nombre'))->where('destinatario.des_apellido','=', $request->input('des_apellido'))->first()->des_clave;
          $telefono -> fk_destinatario = $destinatarioClave;
          $telefono -> save();

          $envio-> fk_destinatario = $destinatarioClave;

          $envio -> save();
        }
        return ['success' => true, 'message' => 'Saved !!'];
    }

    public function getOne(Request $request){
      return $envio = Envio::find($request->en_clave);
    }

   /* public function destroy(Request $request){
      $envio = Envio::find($request->en_clave);
      $envio->delete();
      return ['success' => true, 'message' => 'Deleted !!'];
    }*/

    public function destroy($id){
      $envio = Envio::find($id);
      $envio->delete();
      return ['success' => true, 'message' => 'Deleted !!'];
    }
}
