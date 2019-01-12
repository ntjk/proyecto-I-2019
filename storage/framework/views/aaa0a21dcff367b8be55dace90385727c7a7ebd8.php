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
        <link href="<?php echo e(asset('css/unselectable.css')); ?>" rel="stylesheet">
        <script type="text/javascript" src="<?php echo e(asset('js/dropdown.js')); ?>"></script>
        <title>Consulta 2</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet" type="text/css">
        <link href="https://fonts.googleapis.com/css?family=Abril+Fatface" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css?family=Lato" rel="stylesheet">
    </head>
    <body>
            <?php echo $__env->make('header', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>
            <h1 class="text-center">Envios por estatus</h1>
            <br/>
            <table class="table table-bordered" width="80%" id="users-table">
                <thead>
                    <tr>
                        <th>Estatus</th>
                        <th>Tipo</th>
                        <th>Precio</th>
                        <th>Peso</th>
                        <th>Descripción</th>
                        <th>Altura</th>
                        <th>Anchura</th>
                        <th>Profundidad</th>
                        <th>Fecha de envío</th>
                        <th>Fecha de entrega estimada</th>
                        <th>Cliente emisor</th>
                        <th>Destinatario</th>
                        <th>FKFR1</th>
                        <th>Sucursal origen</th>
                        <th>Sucursal destino</th>
                    </tr>
                </thead>
                <tbody>
                  <?php $__currentLoopData = $envios; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $envio): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                  <tr>
                    <td><?php echo e($envio->che_estatus); ?></td>
                    <td><?php echo e($envio->ti_nombre); ?></td>
                    <td><?php echo e($envio->en_precio); ?></td>
                    <td><?php echo e($envio->en_peso); ?></td>
                    <td><?php echo e($envio->en_descripcion); ?></td>
                    <td><?php echo e($envio->en_altura); ?></td>
                    <td><?php echo e($envio->en_anchura); ?></td>
                    <td><?php echo e($envio->en_profundidad); ?></td>
                    <td><?php echo e($envio->en_fecha_envio); ?></td>
                    <td><?php echo e($envio->en_fecha_entrega_estimada); ?></td>
                    <td><?php echo e($envio->cli_cedula); ?></td>
                    <td><?php echo e($envio->des_cedula); ?></td>
                    <td><?php echo e($envio->fk_flota_ruta_1); ?></td>
                    <td><?php echo e($envio->so_nombre); ?></td>
                    <td><?php echo e($envio->su_nombre); ?></td>            
                  </tr>
                  <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
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
        <?php echo $__env->yieldPushContent('scripts'); ?>
        <?php echo $__env->make('footer', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>
              </div>
        </div>
      </div>
    </body>
</html>