<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Yajra\Datatables\Datatables;
use Illuminate\Support\Facades\DB;
use App\Envio;
use App\Cliente;
use App\Sucursal;
use App\Flota;
use App\Destinatario;
use App\Telefono;
use App\Tipo;

class ConsultasClienteController extends Controller
{
    public function masEnviosPorOfic(){
		$consulta = Envio::join('cliente','cli_clave','=','envio.fk_cliente')->join('sucursal','su_clave','=','envio.fk_sucursal_origen')->select(DB::raw('count(en_clave) as cant, su_nombre, cli_cedula, cli_nacionalidad'))
        ->groupBy('su_nombre', 'cli_nacionalidad', 'cli_cedula')->get();
        return view('consulta10')->with(compact('consulta'));
    }

    public function vipPorOfic(){
    	$consulta = Cliente::join('sucursal', 'su_clave', 'cliente.fk_sucursal')->where('cli_vip','=', true)->groupBy('su_nombre', 'cli_nacionalidad', 'cli_cedula', 'cli_nombre', 'cli_apellido')->select('su_nombre', 'cli_nacionalidad', 'cli_cedula', 'cli_nombre', 'cli_apellido')->orderBy('cli_nombre')->get();
    	return view('consulta11')->with(compact('consulta'));
    }// NOTA: seria fino agregarle que tambien se vea su cantidad de envios pero nah
}
