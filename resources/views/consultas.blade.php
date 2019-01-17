<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="//netdna.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="//cdn.datatables.net/1.10.7/css/jquery.dataTables.min.css">
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
    <meta name="csrf-token" content="{!! csrf_token() !!}" />
    <link href="{{ asset('css/styles.css') }}" rel="stylesheet">
    <script type="text/javascript" src="{{ asset('js/dropdown.js') }}"></script>
    <title>Consultas - LogUCAB</title>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Abril+Fatface" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Lato" rel="stylesheet">
  </head>
  <body>
    @include('header')
 <!--   <div class="container labelDestacado" -->

    <h1 class="text-center">Listados y reportes</h1>
            <br/>
            <table class="table table-bordered" width="60%" id="users-table">
                <thead>
                    <tr>
                      <th>Listados</th>
                    </tr>
                </thead>
                <tbody>
                  <tr>
                    <td><a href="consulta1">Mes del año que se realizan más envíos</a></td>
                  </tr>
                  <tr>
                    <td><a href="consulta5">Mes en el que se realizan más envíos</a></td>
                  </tr>
                  <tr>
                    <td><a href="consulta2">Peso promedio de los paquetes que se envían por oficina</a></td>
                  </tr>
                  <tr>
                    <td><a href="consulta3">Listado de paquetes por estatus </a></td>
                  </tr>
                  <tr>
                    <td><a href="consulta4">¿Qué oficina envía más y qué oficina recibe más paquetes?</a></td>
                  </tr>
                  <tr>
                    <td><a href="consulta6">Sucursal que tiene más tránsito de paquetes según período</a></td>
                  </tr>
                  <tr>
                    <td><a href="consulta7">Promedio de paquetes diarios por oficina</a></td>
                  </tr>
                  <tr>
                    <td><a href="consulta8">¿Qué tipo de paquetes combinan más medios de transporte? </a></td>
                  </tr>
                  <tr>
                    <td><a href="consulta9">Promedio de estancia de los paquetes por cada zona de las oficinas</a></td>
                  </tr>
                  <tr>
                    <td><a href="consulta10">¿Qué usuario registra más paquetes por oficina?</a></td>
                  </tr>
                  <tr>
                    <td><a href="consulta11">Clientes frecuentes por oficina ordenado alfabéticamente </a></td>
                  </tr>
                  <tr>
                    <td><a href="consulta12">Cantidad de paquetes por clasificación y por oficina en un periodo de tiempo</a></td>
                  </tr>
                  <tr>
                    <td><a href="consulta13">Paquetes por clasificación y por oficina en un periodo de tiempo</a></td>
                  </tr>
                  <tr>
                    <td><a href="consulta14">Listado de inasistencia indicando el horario asignado al empleado </a></td>
                  </tr>
                  <tr>
                    <td><a href="consulta15">Listado de empleados con las inasistencias</a></td>
                  </tr>
                  <tr>
                    <td><a href="consulta16">Listado de vehículos por oficina base </a></td>
                  </tr>
                  <tr>
                    <td><a href="consulta17">Listado de medios de transportes, agrupados por subtipo</a></td>
                  </tr>
                  <tr>
                    <td><a href="consulta18">Listado de medios de transportes, agrupados por tipo</a></td>
                  </tr>
                  <tr>
                    <td><a href="consulta19">Flota terrestre nacional e internacional ordenado por serial de motor</a></td>
                  </tr>
                  <tr>
                    <td><a href="consulta20-1-60">Promedio de paquetes de una oficina en un periodo de tiempo</a></td>
                  </tr>
                  <tr>
                    <td><a href="consulta21">Listado de Oficinas por Estado ordenadas alfabéticamente</a></td>
                  </tr>
                  <tr>
                    <td><a href="consulta22">Oficinas y sus zonas por estado</a></td>
                  </tr>
                   <tr>
                    <td><a href="consulta23">Oficinas internacionales</a></td>
                  </tr>
                  <tr>
                    <td><a href="consulta24">Empleados activos, indicando su información básica, cargo que ocupa y fecha de ingreso a la compañía</a></td>
                  </tr>
                  <tr>
                    <td><a href="consulta25">Empleados y total de empleados activos y total de empleados desincorporados</a></td>
                  </tr>
                  <tr>
                    <td><a href="consulta26">Empleados con su horario y ubicación dentro de cada oficina</a></td>
                  </tr>
                  <tr>
                    <td><a href="consulta70-1">Listado de Nominas Semanales por Sucursal</a></td>
                  </tr>
                  <tr>
                    <td><a href="falla">Listado de fallas (todas las flotas).</a></td>
                  </tr>
                  <tr>
                    <td><a href="puerto">Listado de puertos.</a></td>
                  </tr>
                  <tr>
                    <td><a href="aeropuerto">Listado de aeropuertos.</a></td>
                  </tr>
                  <tr>
                    <td><a href="consulta41">Sucursales de puertos y aeropuertos.</a></td>
                  </tr>
                  <tr>
                    <td><a href="taller">Listado de talleres.</a></td>
                  </tr>
                  <tr>
                    <td><a href="consulta42">Listado de talleres agrupados por zona.</a></td>
                  </tr>
                  <tr>
                    <td><a href="servicio_sucursal">Listado de Servicios por sucursales.</a></td>
                  </tr>
                  <tr>
                    <td><a href="consulta43">Listado de flotas con su última fecha de revisión y próxima fecha por oficina.</a></td>
                  </tr>
                  <tr>
                    <td><a href="consulta44">Ingresos y egresos por oficina por mes.</a></td>
                  </tr>
                  <tr>
                    <td><a href="consulta45">Total de gastos generados por revisión de flotas por mes y por sucursal.</a></td>
                  </tr>
                  <tr>
                    <td><a href="consulta27">Cantidad de flota terrestre nacional e internacional, agrupado por tipo de ubicación tipo de vehículo</a></td>
                  </tr>
                  <tr>
                    <td><a href="consulta28">Sucursales indicando estado, municipio y parroquia</a></td>
                  </tr>
                  <tr>
                    <td><a href="consulta29">Oficina es la más amplia por estado, municipio y parroquia</a></td>
                  </tr>
                  <tr>
                    <td><a href="consulta71-1-0-0-0-0-0-0">Costo de cada empleado por oficina en un periodo de tiempo</a></td>
                  </tr>
                </tbody>
            </table>
        </div>
        <div id="userModal" class="modal fade">
        <script src="//code.jquery.com/jquery.js"></script>
        <script src="//cdn.datatables.net/1.10.7/js/jquery.dataTables.min.js"></script>
        <script src="//netdna.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>
        <script>$(function() {
            $('#users-table').DataTable({
            })
            $(document).on('click', '.update', function(){
              var en_clave = $(this).attr("id");
            });
        });
        </script>
    @stack('scripts')
    @include('footer')
  </body>
</html>
