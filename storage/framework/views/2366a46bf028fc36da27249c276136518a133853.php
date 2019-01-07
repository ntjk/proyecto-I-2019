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
    <title>template - LogUCAB</title>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Abril+Fatface" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Lato" rel="stylesheet">
  </head>
  <body>
    <?php echo $__env->make('header', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>
    <div class="container">
    <br/>
    <h1 class="text-center">Promedio de envios <?php echo e($mensaje); ?> de la Sucursal <?php echo e($sucursal); ?></h1>
    <br/>
    <form method="post" id="user_form">
      <label class="labelDestacado">Seleccione la Sucursal</label>
      <select name="fk_sucursal_origen" id="inputid1" class="form-control">
        <?php $__currentLoopData = $sucursales; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $s): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <option value="<?php echo e($s->su_clave); ?>"><?php echo e($s->su_nombre); ?></option>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
      </select>
      <br /><br/>
      <label class="labelDestacado">Seleccione el Periodo</label>
      <select name="tiempo" id="inputid2" class="form-control">
          <option value="30">Mensual</option>
          <option value="60">Bimestral</option>
          <option value="90">Trimestral</option>
          <option value="180">Semestral</option>
      </select>
      <br /><br/>
      <a type="reset" onclick="navigate(this,'inputid1','inputid2')">Edit</a>
      <script>
        function navigate(link, inputid1, inputid2){
          var url = "<?php echo e(url('/consulta20-')); ?>" + document.getElementById(inputid1).value +"-"+document.getElementById(inputid2).value;
          window.location.href = url; //navigates to the given url, disabled for demo
          //alert(url);
        }
      </script>
    </form>
    <table class="table table-bordered" id="users-table">
        <thead>
            <tr>
              <th>Sucursal</th>
              <th>Promedio</th>
              <th>Año</th>
            </tr>
        </thead>
        <tbody>
          <?php $__currentLoopData = $avgES; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $aes): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
          <tr>
            <td><?php echo e($aes->so); ?></td>
            <td><?php echo e($aes->promedio); ?></td>
            <td><?php echo e($aes->yy); ?></td>
          </tr>
          <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </tbody>
    </table>
</div>
<script src="//code.jquery.com/jquery.js"></script>
<script src="//cdn.datatables.net/1.10.7/js/jquery.dataTables.min.js"></script>
<script src="//netdna.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>
    <?php echo $__env->yieldPushContent('scripts'); ?>
    <?php echo $__env->make('footer', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>
  </body>
</html>
