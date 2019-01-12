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
    <title>Empleados de una Sucursal - LogUCAB</title>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Abril+Fatface" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Lato" rel="stylesheet">
  </head>
  <body>
    <?php echo $__env->make('header', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>
    <div class="container">
    <h1 class="text-center">Empleados de la sucursal <?php echo e($sucursal->su_nombre); ?></h1>
    <br/>
    <form method="post" id="user_form">
      <label>Fecha</label>
      <input type="date" name="inputid" id="inputid" class="form-control" />
      <br /><br/>
      <a type="reset" onclick="navigate2(this,'<?php echo e($sucursal->su_clave); ?>','inputid')">Crear Nomina</a>
    </form>
      <script>
        function navigate2(link, sucursal, inputid){
          var url = "<?php echo e(url('/sucursal')); ?>" + sucursal +'-'+ document.getElementById(inputid).value;
          window.location.href = url; //navigates to the given url, disabled for demo
          //alert(url);
        }
      </script>
    <table class="table table-bordered" id="users-table">
        <thead>
            <tr>
              <th>Empleado</th>
              <th>Salario Semanal (Incluyendo Inasistencias)</th>
              <th>Accion</th>
            </tr>
        </thead>
        <tbody>
          <?php $__currentLoopData = $empleados; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $em): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
          <tr>
            <td><?php echo e($em->em_nombre); ?></td>
            <td><?php echo e($em->salario); ?></td>
            <td><button class="btn btn-info btn-detail factura" id=".<?php echo e($em->em_clave); ?>." value=".<?php echo e($em->em_clave); ?>." onclick="navigate(this,'<?php echo e($em->em_clave); ?>')" name="factura">Factura</button></td>
          </tr>
          <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </tbody>
    </table>
  </br>
  <h2>Total: <?php echo e($total); ?></h2>
</div>
    <script>
    function navigate(link, inputid){
      //alert(document.getElementById(inputid).value)
      var url = "<?php echo e(url('/empleado')); ?>" + inputid;
      //window.location.href = url; //navigates to the given url, disabled for demo
      alert(url);
    }
    </script>
<script src="//code.jquery.com/jquery.js"></script>
<script src="//cdn.datatables.net/1.10.7/js/jquery.dataTables.min.js"></script>
<script src="//netdna.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>
    <?php echo $__env->yieldPushContent('scripts'); ?>
    <?php echo $__env->make('footer', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>
  </body>
</html>
