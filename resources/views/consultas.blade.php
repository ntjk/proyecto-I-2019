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
    <div class="container">
      <br/>
      <h1 class="text-center">Consultas</h1>
      <br/>
      <a href="consulta1">Mes del año que se realizan más envíos</a>
      <br/>
      <a href="consulta2">Peso promedio de los paquetes que se envían por oficina</a>
      <br/>
      <a href="consulta3">Listado de paquetes por estatus </a>
      <br/>
      <a href="consulta4">¿Qué oficina es la que recibe más paquetes? ¿Qué oficina envía más
paquetes? </a>
      <br/>
      <a href="consulta5">Test5</a>
      <br/>
      <a href="puerto">Listado de puertos.</a>
      <br/>
      <a href="aeropuerto">Listado de aeropuertos.</a>
      <br/>
      <a href="taller">Listado de talleres.</a>
      <br/>
      <a href="servicio_sucursal">Listado de Servicios - Sucursales.</a>
      <br/>
      <a href="falla">Listado de Fallas.</a>
      <br/>
    </div>
    @stack('scripts')
    @include('footer')
  </body>
</html>
