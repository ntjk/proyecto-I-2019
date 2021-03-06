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

class EnvioController extends Controller
{
    /**
     * Displays front end view
     *
     * @return \Illuminate\View\View
     */

    public function index()
    {
      $clientes=Cliente::orderBy('cli_cedula')->get();
      $rutas=Ruta::orderBy('ru_clave')->get();
      $sucursales=Sucursal::orderBy('su_nombre')->get();
      $florus=Floru::orderBy('flo_ru_clave')->get();
      $tipos=Tipo::orderBy('ti_clave')->get();


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
        $envio5 = Envio::join('tipo','ti_clave','=','envio.fk_tipo')->select(['tipo.ti_nombre'])
        //->whereBetween('tipo.ti_clave', [1, 10])
        ->get();
//este poco de envios es por los atributos que necesitamos que salgan en la tabla pero no pertenecen a la tabla envio

        $envios = Envio::select(
            'envio.en_clave',
            'envio.fk_tipo',
            'envio.en_precio',
            'envio.en_peso',
            'envio.en_descripcion',
            'envio.en_altura',
            'envio.en_anchura',
            'envio.en_profundidad',
            'envio.en_fecha_envio',
            'envio.en_fecha_entrega_estimada',
            'envio.fk_flota_ruta_1')
        ->whereBetween('envio.en_clave', [1, 10])
        ->get();


         $i=0;
        foreach($envios as $envi){
          $envi->setAttribute("so_nombre",$envio1[$i]->su_nombre);
          $envi->setAttribute("sd_nombre",$envio2[$i]->su_nombre);
          $envi->setAttribute("cli_cedula",$envio3[$i]->cli_cedula);
          $envi->setAttribute("des_cedula",$envio4[$i]->des_cedula);
          $envi->setAttribute("ti_nombre",$envio5[$i]->ti_nombre);
          $i++;
        }

      return view('envio')->with(compact('sucursales'))->with(compact('clientes'))->with(compact('tipos'))->with(compact('florus'))->with(compact('rutas'))->with(compact('envios'));

    }

    /**
     * Process ajax request.
     *
     * @return \Illuminate\Http\JsonResponse
     */

    public function store(Request $request){
      if ($request->operation == "Edit"){
        $cliente = Cliente::find($request->fk_cliente);
        $cliente->cli_cedula = $request->input('fk_cliente');
        $cliente->save();
        $destinatario = Destinatario::find($request->fk_destinatario);
        $destinatario = $request->input('fk_destinatario');
        $destinatario->save();
        $envio = Envio::find($request->en_clave);
        $envio->fill($request->all());
        $envio->save();
      } else {
          $destin = Destinatario::where('destinatario.des_cedula','=', $request->input('des_cedula'))->where('destinatario.des_nombre','=', $request->input('des_nombre'))->where('destinatario.des_apellido','=', $request->input('des_apellido'))->exists();

          $envio = new Envio();
          $envio -> fk_tipo = $request->input('fk_tipo');
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

          $cliente = Cliente::find($request->input('fk_cliente'));
          if (Envio::join('cliente','cli_clave','=','fk_cliente')
          ->select(DB::raw("date_trunc('month',en_fecha_envio) as mes, cli_clave"))
          ->where('cli_clave','=',$cliente->cli_clave)
          ->groupBy('mes','cli_clave')
          ->having('count(*)','>=','5')
          ->exists()) {
            $cliente->cli_vip = 1;
          } else {
            $cliente->cli_vip = 0;
          }
          $cliente->save();

          /*select date_trunc('month',en_fecha_envio) as mes, cli_nombre
            from envio, cliente
            where fk_cliente=cli_clave
            group by mes, cli_nombre
            having count(*)>5*/

          $ruta3 = Floru::where('flo_ru_clave','=', $request->input('fk_flota_ruta_1'))->first();
          $envio -> fk_flota_ruta_1 = $ruta3->flo_ru_clave;
          $envio -> fk_flota_ruta_2 = $ruta3->fk_flota;
          $envio -> fk_flota_ruta_3 = $ruta3->fk_ruta_1;
          $envio -> fk_flota_ruta_4 = $ruta3->fk_ruta_2;
          $envio -> fk_flota_ruta_5 = $ruta3->fk_ruta_3;

          $telefono = new Telefono();
          $telefono -> tel_numero = $request->input('tel_numero');

          if($destin==false){
            $destinatario = new Destinatario();
            $destinatario -> des_nombre = $request->input('des_nombre');
            $destinatario -> des_apellido = $request->input('des_apellido');
            $destinatario -> des_cedula = $request->input('des_cedula');
            $destinatario -> save();
          }

          $destinatarioClave = Destinatario::where('destinatario.des_cedula','=', $request->input('des_cedula'))->where('destinatario.des_nombre','=', $request->input('des_nombre'))->where('destinatario.des_apellido','=', $request->input('des_apellido'))->first()->des_clave;
          $envio-> fk_destinatario = $destinatarioClave;
          $telefono -> fk_destinatario = $destinatarioClave;
          $telefono -> save();

          $envio -> save();
        }
        return ['success' => true, 'message' => 'Saved !!', 'value' => Envio::where('fk_cliente',$request->input('fk_cliente'))->count()];
    }

    public function updateRuta(Request $request){
      //cuantas florus tienen esa fk como destino
      /*$destino=$request->sd;
      $sql=DB::select(DB::raw('select count (*) from (select * from flota_ruta where fk_ruta_3= ?) as t1'));
      $cantidadRutas = DB::select(DB::raw($sql), [$destino]);

      $sql2=DB::select(DB::raw('select distinct flo_ruta from flota_ruta where flo_ruta in (select flo_ruta from flota_ruta where fk_ruta_3= ?)'));
      $cadaRuta=DB::select(DB::raw($sql2), [$destino]);
      //por cada floru, recorrer todos los registros de esa ruta Nro. tal
      for ($i=0; $i < $cantidadRutas; $i++) {
        $param3 = $cadaRuta[$i];
        $sql3=DB::select(DB::raw('select so.su_nombre as so, flo_ru_clave from flota_ruta, sucursal as so where fk_ruta_2=so.su_clave and flo_ruta = ?'));;
        $sucursalesDeEsaRuta=DB::select(DB::raw($sql3), [$param3]);

      }*/
      $destino=$request->sd;
      $origen=$request->so;
      //$sql="select so.su_nombre as so, sd.su_nombre as sd, flo_ruta, flo_ru_clave from flota_ruta, sucursal as so, sucursal as sd where fk_ruta_2=so.su_clave and fk_ruta_3=sd.su_clave and flo_ruta in (select flo_ruta from flota_ruta where fk_ruta_3= ? ) order by flo_ru_clave";
      $sql="select so.su_nombre as so, flo_subtipo, sd.su_nombre as sd, flo_ruta, flo_ru_clave from flota_ruta, sucursal as so, sucursal as sd, flota where fk_flota=flo_clave and fk_ruta_2=so.su_clave and fk_ruta_3=sd.su_clave and flo_ruta in (select flo_ruta from flota_ruta where fk_ruta_3= ? ) and flo_ruta in (select flo_ruta from flota_ruta where fk_ruta_2= ? ) order by flo_ru_clave";
      $rutas= DB::select(DB::raw($sql), [$destino, $origen]);
      //bien pero ahora falta asegurar que el origen sea el primer registro de la flota_ruta, ajuro usar for
      //porque no sabes cuantos registros debas devolver...
      return $rutas;
    }

    public function destroy($id){
      $envio = Envio::find($id);
      $envio->delete();
      return ['success' => true, 'message' => 'Deleted !!', ];
    }

    public function updatePrecio(Request $request){
      $tipoF = Tipo::find($request->tipo);
      //$tipoValor = $tipoF->ti_precio;
      $floruF = Floru::find($request->floru);
      //$floruValor = $floruF->flo_ru_costo;
      $cliente=Cliente::find($request->cliente);

      if ($request->peso>=10){
        $precio=($tipoF->ti_precio_kg + $floruF->flo_ru_costo) * $request->altura * $request->anchura * $request->profundidad;
      }else{
        $precio=($tipoF->ti_precio_kg + $floruF->flo_ru_costo) * $request->peso;
      }

      if ($cliente->cli_vip==true || $cliente->cli_vip==1){
        $precio*=.90;
      }

      return $precio;
    }

    public function showFactura($id){
      $envio=Envio::find($id);

      $cliente=Cliente::find($envio->fk_cliente);
      $destinatario=Destinatario::find($envio->fk_destinatario);
      $origen=Sucursal::find($envio->fk_sucursal_origen);
      $destino=Sucursal::find($envio->fk_sucursal_destino);
      $tipo=Tipo::find($envio->fk_tipo);

      return view('envioFactura')
      ->with(compact('envio'))
      ->with(compact('cliente'))
      ->with(compact('destinatario'))
      ->with(compact('origen'))
      ->with(compact('destino'))
      ->with(compact('tipo'));
    }
}
