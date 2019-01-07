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

class ConsultasEnvioController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function calcularMesConMasEnvios(){
        $mayor=0;
        for ($i = 1; $i <= 12; $i++){
            $num=Envio::whereMonth('en_fecha_envio', $i)->count();
            if($num>$mayor)
                $mayor=$i;
        }
        $mesMasEnvios=Envio::select(DB::raw('count(*) as cantidad, extract(month from en_fecha_envio) as mes, extract(year from en_fecha_envio) as yy'))->groupBy('yy', 'mes')->get();
        return view('consulta1')->with(compact('mesMasEnvios'));
    }

    public function pesoPromedioPorOficina(){
        $pesoPromedioEnvio=Envio::join('sucursal','sucursal.su_clave','=','envio.fk_sucursal_origen')->select(DB::raw('round(avg(en_peso),2) as peso, su_nombre as so'))
        ->groupBy('su_nombre')->get();
        return view('consulta2')->with(compact('pesoPromedioEnvio'));
    }

    public function enviosPorEstatus(){
      $clientes=Cliente::orderBy('cli_cedula')->get();
      $rutas=Ruta::orderBy('ru_clave')->get();
      $sucursales=Sucursal::orderBy('su_nombre')->get();
      $florus=Floru::orderBy('flo_ru_clave')->get();
      $tipos=Tipo::orderBy('ti_clave')->get();

        $envio1 = Envio::orderBy('en_clave')->join('sucursal','sucursal.su_clave','=','envio.fk_sucursal_origen')
        ->select(['sucursal.su_nombre'])->get();
        

        $envio2 = Envio::orderBy('en_clave')->join('tipo','ti_clave','=','envio.fk_tipo')->join('destinatario','des_clave','=','envio.fk_destinatario')->join('cliente','cli_clave','=','envio.fk_cliente')->join('sucursal','sucursal.su_clave','=','envio.fk_sucursal_destino')->join('chequeo','chequeo.fk_envio','=','en_clave')->select(
            'chequeo.che_estatus',
            'tipo.ti_nombre',
            'envio.en_precio',
            'envio.en_peso',
            'envio.en_descripcion',
            'envio.en_altura',
            'envio.en_anchura',
            'envio.en_profundidad',
            'envio.en_fecha_envio',
            'envio.en_fecha_entrega_estimada',
            'envio.fk_flota_ruta_1',
            'destinatario.des_cedula',
            'cliente.cli_cedula',
            'sucursal.su_nombre')
        ->get();


         $i=0;
        foreach($envio2 as $envi){
          $envi->setAttribute("so_nombre",$envio1[$i]->su_nombre);
          $i++;
        }

        $envio3=$envio2->where('che_estatus','=','entregado');
        $envio4=$envio2->where('che_estatus','=','en oficina destino');
        $envio5=$envio2->where('che_estatus','=','en oficina intermedia');
        $envio6=$envio2->where('che_estatus','=','en aduana');
        $envio7=$envio2->where('che_estatus','=','en oficina origen');

        $envio8 = $envio3->union($envio4);
        $envio9 = $envio8->union($envio5);
        $envio10 = $envio9->union($envio6);

        $envios = $envio10->union($envio7);

      return view('consulta3')->with(compact('envios'));
     
    }

    public function origenMaxPaquetes(){
        $origenMaxPaquetes=Envio::join('sucursal','sucursal.su_clave','=','envio.fk_sucursal_origen')->select(DB::raw('count(*) as mo, su_nombre as so'))->groupBy('so')->get();
        return view('consulta4')->with(compact('origenMaxPaquetes'));
    }

    public function destinoMaxPaquetes(){
        $destinoMaxPaquetes=Envio::join('sucursal','sucursal.su_clave','=','envio.fk_sucursal_destino')->select(DB::raw('count(*) as md, su_nombre as sd'))->groupBy('sd')->get();
        return view('consulta5')->with(compact('destinoMaxPaquetes'));
    }



    public function index()
    {
        
    }


    public function create()
    {
        //
    }


    public function store(Request $request)
    {
        //
    }

    public function show($id)
    {
        //
    }


}
