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
    <link href="<?php echo e(asset('css/styles_factura.css')); ?>" rel="stylesheet">
    <script type="text/javascript" src="<?php echo e(asset('js/dropdown.js')); ?>"></script>
    <title>Factura - LogUCAB</title>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Abril+Fatface" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Lato" rel="stylesheet">
  </head>
  <body>
    <?php echo $__env->make('header', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>
    <div class="container">
      <h1 class="text-center">Recibo del Envio <?php echo e($envio->en_clave); ?></h1>
      <br>
      <br>
      <div class="container">
        <div class="fatter full white">
          <b>LogUCAB</b><br>
          Urb. Montalbán, Univesidad Católica Andrés Bello, Edif. De<br>
          Laboratorios, Piso 2, Escuela de Ing. Informática.<br>
          J-3110096725-1<br>
          Tlf. +58-2124076655/6656/6657
        </div>
      </div>
      <div class="half-container">
        <div class="fatter descripcion half">
          Fecha de entrega: <?php echo e($envio->en_fecha_envio); ?>

        </div>
        <div class="fatter descripcion half">
          No. de Guia: <?php echo e($envio->en_clave); ?>

        </div>
      </div>
      <div class="half-container">
        <div class="fatter descripcion half white">
          Quien Envia: <?php echo e($cliente->cli_nombre); ?> <?php echo e($cliente->cli_apellido); ?>

        </div>
        <div class="fatter descripcion half white">
          Destinatario: <?php echo e($destinatario->des_nombre); ?> <?php echo e($destinatario->des_apellido); ?>

        </div>
      </div>
      <div class="half-container">
        <div class="fatter descripcion half">
          Origen: <?php echo e($origen->su_nombre); ?>

        </div>
        <div class="fatter descripcion half">
          Destino: <?php echo e($destino->su_nombre); ?>

        </div>
      </div>
      <div class="half-container">
        <div class="fatter descripcion half white">
          Tipo de Paquete: <?php echo e($tipo->ti_nombre); ?>

        </div>
        <div class="fatter descripcion half white">
          Peso: <?php echo e($envio->en_peso); ?> Kg.
        </div>
      </div>
      <div class="container">
        <div class="fatter full">
          Fecha estimada de Entrega: <?php echo e($envio->en_fecha_entrega_estimada); ?>

        </div>
      </div>
      <div class="container">
        <div class="fatter full white">
          Monto: <?php echo e($envio->en_precio); ?> Bs.
        </div>
      </div>

      <br>
      <br>
    </div>
    <?php echo $__env->yieldPushContent('scripts'); ?>
    <?php echo $__env->make('footer', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>
  </body>
</html>