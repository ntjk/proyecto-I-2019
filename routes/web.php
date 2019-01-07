<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
/* what the fuck am i doing? */
Route::get('/home', 'HomeController@index')->name('home');
Route::get('welcome', function () {
    return view('welcome');
});

/* oh right console commands lol */
Auth::routes();

/* basic shit */
Route::get('/', function () {
    return view('welcome');
});
Route::get('quienes_somos', function(){
  return view('quienes_somos');
});
Route::get('buscadorChequeo', function(){
  return view('buscadorChequeo');
});

/* REAL HACKER HOURS */
/* sucursal */
Route::resource('sucursal','SucursalController');
Route::post('sucursal/getOne','SucursalController@getOne');
Route::post('sucursal/updateSelect','SucursalController@updateSelect');
Route::get('sucursal', 'SucursalController@index');
Route::get('sucursal-getData','SucursalController@getData')->name('sucursal_getData');
// @eso quiere decir el metodo eso
/* rol */
Route::resource('rol','RolController');
Route::post('rol/getOne','RolController@getOne');
Route::post('rol/updateSelect','RolController@updateSelect');
Route::get('rol','RolController@index');
Route::get('rol-getData','RolController@getData')->name('rol_getData');

/* usuario */
Route::resource('usuario','UsuarioController');
Route::post('usuario/getOne','UsuarioController@getOne');
Route::post('usuario/updateSelect','UsuarioController@updateSelect');
Route::get('usuario','UsuarioController@index');
Route::get('usuario-getData','UsuarioController@getData')->name('usuario_getData');

/* empleado */
Route::resource('empleado','EmpleadoController');
Route::post('empleado/getOne','EmpleadoController@getOne');
Route::post('empleado/updateSelect','EmpleadoController@updateSelect');
Route::post('empleado/updateSelect2','EmpleadoController@updateSelect2');
Route::get('empleado','EmpleadoController@index');
Route::get('empleado-getData','EmpleadoController@getData')->name('empleado_getData');

/* ruta */
Route::resource('ruta','RutaController');
Route::post('ruta/getOne','RutaController@getOne');
Route::post('ruta/updateSelect','RutaController@updateSelect');
Route::get('ruta','RutaController@index');
Route::get('ruta-getData','RutaController@getData')->name('ruta_getData');

/* Flota Terrestre */
Route::resource('transporte','FlotaController');
Route::post('transporte/getOne','FlotaController@getOne');
Route::post('transporte/updateSelect','FlotaController@updateSelect');
Route::get('transporte', 'FlotaController@index');
Route::get('transporteT-getData','FlotaController@getDataT')->name('transporteT_getData');

/* Flota Maritima */
Route::resource('transporteM','FlotaController');
Route::post('transporteM/getOne','FlotaController@getOne');
Route::post('transporteM/updateSelect','FlotaController@updateSelect');
Route::get('transporteM', 'FlotaController@indexM');
Route::get('transporteM-getData','FlotaController@getDataM')->name('transporteM_getData');

/* Flota Aerea */
Route::resource('transporteA','FlotaController');
Route::post('transporteA/getOne','FlotaController@getOne');
Route::post('transporteA/updateSelect','FlotaController@updateSelect');
Route::get('transporteA', 'FlotaController@indexA');
Route::get('transporteA-getData','FlotaController@getDataA')->name('transporteA_getData');

/*Cliente */
Route::resource('cliente','ClienteController');
Route::post('cliente/getOne','ClienteController@getOne');
Route::post('cliente/updateSelect','ClienteController@updateSelect');
Route::post('cliente/updateSelect2','ClienteController@updateSelect2');
Route::get('cliente', 'ClienteController@index');
Route::get('cliente-getData','ClienteController@getData')->name('cliente_getData');

/* Envio */
Route::resource('envio','EnvioController');
Route::post('envio/getOne','EnvioController@getOne');
Route::post('envio/updateSelect','EnvioController@updateSelect');
Route::get('envio', 'EnvioController@index');
Route::get('envio-getData','EnvioController@getData')->name('envio_getData');

/* ruta */
Route::resource('floru','FloruController');
Route::post('floru/getOne','FloruController@getOne');
Route::post('floru/updateSelect','FloruController@updateSelect');
Route::get('floru','FloruController@index');
//Route::get('floru-getData','FloruController@getData')->name('floru_getData');

/*tipo paquete*/
Route::resource('tipo','TipoController');
Route::post('tipo/getOne','TipoController@getOne');
Route::post('tipo/updateSelect','TipoController@updateSelect');
Route::get('tipo','TipoController@index');
Route::get('tipo-getData','TipoController@getData')->name('tipo_getData');

/*chequeo - rastreo*/
Route::resource('chequeo','ChequeoController');
Route::post('chequeo/getOne','ChequeoController@getOne');
Route::post('chequeo/updateSelect','ChequeoController@updateSelect');
Route::get('chequeo-getData','ChequeoController@getData')->name('chequeo_getData');
Route::get('chequeo{id}', 'ChequeoController@show');


Route::get("/aja",function(){
$resul=DB::select("select * from sucursal where su_clave = ?", [12]);
	foreach($resul as $resu){
		return $resu->su_nombre;
	}
});
/*Route::get("/aje",function(){
$resul=DB::select("select en_tipo, en_precio, en_peso, en_descripcion, en_altura, en_anchura, en_profundidad, en_fecha_envio, en_fecha_entrega_estimada, sucursalo.su_nombre, cli_cedula, des_cedula, fk_flota_ruta_1, sucursald.su_nombre 
from sucursal as sucursalo, sucursal as sucursald, envio, cliente, destinatario where 
sucursalo.su_clave=fk_sucursal_origen and sucursald.su_clave=fk_sucursal_destino and cli_clave=fk_cliente and des_clave=fk_destinatario");
	foreach($resul as $resu){
		return $resu->su_nombre, $res;
	}
});

//select devuelve array t recorrer elemento por ele para leerlo