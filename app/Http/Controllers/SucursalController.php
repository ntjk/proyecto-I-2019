<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Yajra\Datatables\Datatables;

use App\Sucursal;
use App\Lugar;

class SucursalController extends Controller
{

	/**
     * Displays front end view
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
      $estados= Lugar::where('lu_tipo','estado')->orderBy('lu_nombre')->get();
    	return view("sucursal",compact('estados'));
    }
    /**
     * Process ajax request.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function getData()
    {
      $sucursales = Sucursal::join('lugar','lugar.lu_clave','=','sucursal.fk_lugar')->select(['sucursal.su_nombre','sucursal.su_clave','sucursal.su_email','sucursal.su_capacidad','lugar.lu_nombre']);
        return Datatables::of($sucursales)->addColumn('action', function ($sucursales) {
                return '<button class="btn btn-warning btn-detail update" id="'.$sucursales->su_clave.'" value="'.$sucursales->su_clave.'" name="Update">Update</button>
              <button class="btn btn-danger btn-delete delete" id="'.$sucursales->su_clave.'" value="'.$sucursales->su_clave.'" name="delete">Delete</button>
              <button class="btn btn-info btn-detail nomina" id="'.$sucursales->su_clave.'" value="'.$sucursales->su_clave.'" onclick="navigate(this,'.$sucursales->su_clave.')" name="Nomina">Nomina</button>'; })->make(true);
    }

    public function store(Request $request){
      if ($request->operation == "Edit"){
        $sucursal = Sucursal::find($request->su_clave);
        $sucursal->fill($request->all());
        $sucursal->save();
      } else {
          $sucursal = new Sucursal();
          $sucursal -> su_nombre = $request->input('su_nombre');
          $sucursal -> su_email = $request->input('su_email');
          $sucursal -> su_capacidad = $request->input('su_capacidad');
          $sucursal -> fk_lugar = $request->input('fk_lugar');
          $sucursal -> save();
        }
        return ['success' => true, 'message' => 'Saved !!'];
    }

    public function getOne(Request $request){
      return $sucursal = Sucursal::find($request->su_clave);
    }

    public function destroy(Request $request){
      $sucursal = Sucursal::find($request->su_clave);
      $sucursal->delete();
      return ['success' => true, 'message' => 'Deleted !!'];
    }

    public function updateSelect(Request $request){
      return $lugares= Lugar::where('fk_lugar',$request->estado)->orderBy('lu_nombre')->get();
    }

    public function showNomina($id){
      $sucursal = Sucursal::find($id);
      return view('sucursalNomina')->with(compact('sucursal'));
    }
}
