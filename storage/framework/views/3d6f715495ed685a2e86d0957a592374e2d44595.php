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
    <title>Costo por empleados de la sucursal <?php echo e($sucursal->su_nombre); ?> - LogUCAB</title>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Abril+Fatface" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Lato" rel="stylesheet">
  </head>
  <body>
    <?php echo $__env->make('header', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>
    <div class="container">
    <h1 class="text-center">Costo por empleados de la sucursal <?php echo e($sucursal->su_nombre); ?></h1>
    <br/>
    <form method="post" id="user_form">
      <label>Fecha de Inicio</label>
      <input type="date" name="inputid1" id="inputid1" class="form-control" />
      <br /><br/>
      <label>Fecha Fin</label>
      <input type="date" name="inputid2" id="inputid2" class="form-control" />
      <br /><br/>
      <label>Sucursal</label>
      <select name="inputid3" id="inputid3" class="form-control">
        <?php $__currentLoopData = $sucursales; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $s): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <option value="<?php echo e($s->su_clave); ?>"><?php echo e($s->su_nombre); ?></option>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
      </select>
      <br /><br/>
      <a type="reset" onclick="navigate2(this,'inputid1','inputid2','inputid3')">Crear Reporte</a>
    </form>
      <script>
        function navigate2(link, fechainicio, fechafin, sucursal){
          var url = "<?php echo e(url('/consulta71-')); ?>" + document.getElementById(sucursal).value +'-'+ document.getElementById(fechainicio).value+'-'+ document.getElementById(fechafin).value;
          window.location.href = url; //navigates to the given url, disabled for demo
          //alert(url);
        }
      </script>
    <table class="table table-bordered" id="users-table">
        <thead>
            <tr>
              <th>Empleado</th>
              <th>Salario Total Del Periodo</th>
            </tr>
        </thead>
        <tbody>
          <?php $__currentLoopData = $nomina; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $no): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
          <tr>
            <td><?php echo e($no->em_nombre); ?> <?php echo e($no->em_apellido); ?></td>
            <td><?php echo e($no->salario); ?></td>
          </tr>
          <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </tbody>
    </table>
  </br>
  <h2>Total: <?php echo e($total); ?></h2>
</div>
<script src="//code.jquery.com/jquery.js"></script>
<script src="//cdn.datatables.net/1.10.7/js/jquery.dataTables.min.js"></script>
<script src="//netdna.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>

    </div>
    <?php echo $__env->yieldPushContent('scripts'); ?>
    <?php echo $__env->make('footer', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>
  </body>
</html>
