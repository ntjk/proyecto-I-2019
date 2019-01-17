<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Yajra\Datatables\Datatables;
use App\Cliente;
use App\Lugar;

class ClienteController extends Controller
{
	/**
     * Displays front end view
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $cliente = Cliente::join('lugar','lugar.lu_clave','=','cliente.fk_lugar')
        ->select(
            'cliente.cli_clave',
            'cliente.cli_cedula',
            'cliente.cli_nombre',
            'cliente.cli_apellido',
            'cliente.cli_estado_civil',
            'cliente.cli_empresa_trabajo',
            'cliente.cli_fecha_nacimiento',
            'cliente.cli_vip',
            'lugar.lu_nombre',
            'cliente.cli_nacionalidad'
        )->get();

        $estados= Lugar::where('lu_tipo','estado')->orderBy('lu_nombre')->get();

        return view('cliente')
        ->with(compact('estados'))
        ->with(compact('cliente'));
    }


    public function store(Request $request){
      if ($request->operation == "Edit"){
        $cliente = Cliente::find($request->cli_clave);
        $cliente->fill($request->all());
        $cliente->save();
      } else {
          $cliente = new Cliente();
          $cliente -> cli_cedula = $request->input('cli_cedula');
          $cliente -> cli_nombre = $request->input('cli_nombre');
          $cliente -> cli_apellido = $request->input('cli_apellido');
          $cliente -> cli_estado_civil = $request->input('cli_estado_civil');
          $cliente -> cli_empresa_trabajo = $request->input('cli_empresa_trabajo');
          $cliente -> cli_fecha_nacimiento = $request->input('cli_fecha_nacimiento');
          $cliente -> cli_vip = $request->input('cli_vip');
          $cliente -> fk_lugar = $request->input('fk_lugar');
          $cliente -> cli_nacionalidad = $request->input('cli_nacionalidad');
          $cliente -> save();
        }
        return ['success' => true, 'message' => 'Saved !!'];
    }

    public function getOne(Request $request){
      return $cliente = Cliente::find($request->cli_clave);
    }

    public function destroy(Request $request){
      $cliente = Cliente::find($request->cli_clave);
      $cliente->delete();
      return ['success' => true, 'message' => 'Deleted !!'];
    }
    public function updateSelect(Request $request){
      return $municipios= Lugar::where('fk_lugar',$request->estado)->orderBy('lu_nombre')->get();
    }
    public function updateSelect2(Request $request){
      return $parroquias= Lugar::where('fk_lugar',$request->municipio)->orderBy('lu_nombre')->get();
    }

    public function showCarnet($id){
      $cliente = Cliente::find($id);
      return view('clienteCarnet')->with(compact('cliente'));
    }

}
