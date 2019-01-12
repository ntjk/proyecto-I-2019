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
		$consulta= DB::select(DB::raw('select count(*) as cant, su_nombre so , fk_cliente, c.cli_cedula, c.cli_nombre, c.cli_nacionalidad from envio, sucursal, cliente as c where cli_clave=fk_cliente and su_clave=fk_sucursal_origen group by su_nombre, c.cli_cedula, c.cli_nombre, c.cli_nacionalidad, fk_cliente having count(*) >all (select count(*) from cliente where fk_cliente=cli_clave group by fk_cliente)'));
		return view('consulta10')->with(compact('consulta'));
    }

    public function vipPorOfic(){
    	$consulta = Cliente::join('sucursal', 'su_clave', 'cliente.fk_sucursal')->where('cli_vip','=', true)->groupBy('su_nombre', 'cli_nacionalidad', 'cli_cedula', 'cli_nombre', 'cli_apellido')->select('su_nombre', 'cli_nacionalidad', 'cli_cedula', 'cli_nombre', 'cli_apellido')->orderBy('cli_nombre')->get();
    	return view('consulta11')->with(compact('consulta'));
    }// NOTA: seria fino agregarle que tambien se vea su cantidad de envios pero nah
}
