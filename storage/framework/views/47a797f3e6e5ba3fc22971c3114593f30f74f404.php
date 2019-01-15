<!doctype html>
<html lang="<?php echo e(str_replace('_', '-', app()->getLocale())); ?>">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="//netdna.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="//cdn.datatables.net/1.10.7/css/jquery.dataTables.min.css">
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
    <meta name="csrf-token" content="<?php echo csrf_token(); ?>" />
    <link href="<?php echo e(asset('css/styles.css')); ?>" rel="stylesheet">
    <script type="text/javascript" src="<?php echo e(asset('js/dropdown.js')); ?>"></script>
    <title>Consultas - LogUCAB</title>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Abril+Fatface" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Lato" rel="stylesheet">
  </head>
  <body>
    <?php echo $__env->make('header', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>
    <div class="container labelDestacado" >
      <br/>
      <h1 class="text-center">Consultas</h1>
      <br/>
      <a href="consulta1">Mes del año que se realizan más envíos</a>
      <br/>
      <a href="consulta5">Mes en el que se realizan más envíos</a>
      <br/>
      <a href="consulta2">Peso promedio de los paquetes que se envían por oficina</a>
      <br/>
      <a href="consulta3">Listado de paquetes por estatus </a>
      <br/>
      <a href="consulta4">¿Qué oficina envía más y qué oficina recibe más paquetes?</a>
      <br/>
      <a href="consulta6">Sucursal que tiene más tránsito de paquetes según período</a>
      <br/>
      <a href="consulta7">Promedio de paquetes diarios por oficina</a>
      <br/>
      <a href="consulta8">¿Qué tipo de paquetes combinan más medios de transporte? </a>
      <br/>
      <a href="consulta9">Promedio de estancia de los paquetes por cada zona de las oficinas</a>
      <br/>
      <a href="consulta10">¿Qué usuario registra más paquetes por oficina?</a>
      <br/>
      <a href="consulta11">Clientes frecuentes por oficina ordenado alfabéticamente </a>
      <br/>
      <a href="consulta12">Listado de paquetes por clasificación y por oficina en un periodo de tiempo</a>
      <br/>
      <a href="consulta14">Listado de inasistencia indicando el horario asignado al empleado </a>
      <br/>
      <a href="consulta15">Listado de empleados con las inasistencias</a>
      <br/>
      <a href="consulta14">Listado de vehículos por oficina base </a>
      <br/>
      <a href="consulta15">Listado de medios de transportes, agrupados por tipo</a>
      <br/>
      <a href="puerto">Listado de puertos.</a>
      <br/>
      <a href="aeropuerto">Listado de aeropuertos.</a>
      <br/>
      <a href="consulta41">Sucursales de puertos y aeropuertos.</a>
      <br/>
      <a href="consulta42">Listado de talleres agrupados por zona.</a>
      <br/>
      <a href="servicio_sucursal">Listado de servicios por sucursales.</a>
      <br/>
      <a href="falla">Listado de fallas (todas las flotas).</a>
      <br/>
      <a href="taller">Listado de talleres.</a>
      <br/>
      <a href="consulta43">Listado de flotas con su última fecha de revisión y próxima fecha por oficina.</a>
      <br/>
      <a href="consulta44">Ingresos y egresos por oficina por mes.</a>
      <br/>
      <a href="consulta45">Total de gastos generados por revisión de flotas por mes y por sucursal.</a>
      <br/>
    </div>
    <?php echo $__env->yieldPushContent('scripts'); ?>
    <?php echo $__env->make('footer', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>
  </body>
</html>
