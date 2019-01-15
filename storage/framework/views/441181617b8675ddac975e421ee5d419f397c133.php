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
      <h1 class="text-center">Factura del Empleado <?php echo e($empleado->em_nombre); ?> <?php echo e($empleado->em_apellido); ?></h1>
      <br>
      <br>
      <div class="half-container">
        <div class="descripcion half">
          ACUMULADO <br> <?php echo e($acumulado); ?> BS.
        </div>
        <div class="descripcion half">
          CARGO <br> <?php echo e($empleado->em_profesion); ?>

        </div>
      </div>
      <div class="half-container">
        <div class="descripcion half">
          SUCURSAL <br> <?php echo e($sucursal->su_nombre); ?>

        </div>
        <div class="descripcion half">
          PERIODO QUE TERMINA <br> <?php echo e($end); ?>

        </div>
      </div>
      <div class="half-container">
        <div class="descripcion half eighty">
          CONCEPTO
        </div>
        <div class="descripcion half twenty">
          ASIGNACIONES
        </div>
      </div>
      <div class="half-container">
        <div class="descripcion half eighty white">
            <?php foreach ($factura as $f): ?>
              PAGO DEL DIA <?php echo e($f->a_fecha); ?><br>
            <?php endforeach; ?>
        </div>
        <div class="descripcion half twenty white">
            <?php foreach ($factura as $f): ?>
              <?php echo e($f->em_salario_base); ?> BS.<br>
            <?php endforeach; ?>
        </div>
      </div>
      <div class="half-container">
        <div class="descripcion half eighty">
          TOTAL
        </div>
        <div class="descripcion half twenty">
          <?php echo e($total); ?> BS.
        </div>
      </div>
      <br>
      <br>
    </div>
    <?php echo $__env->yieldPushContent('scripts'); ?>
    <?php echo $__env->make('footer', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>
  </body>
</html>
