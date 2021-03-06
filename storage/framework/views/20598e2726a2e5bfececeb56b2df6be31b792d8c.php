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
        <title>Consulta 13</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet" type="text/css">
        <link href="https://fonts.googleapis.com/css?family=Abril+Fatface" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css?family=Lato" rel="stylesheet">
    </head>
    <body>
            <?php echo $__env->make('header', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>
            <h1 class="text-center">Listado de paquetes por clasificación y por oficina <br/>entre <?php echo e($rangoi); ?> y <?php echo e($rangof); ?></h1>
            <br/>
            <table class="table table-bordered" width="80%" id="users-table">
                <thead>
                    <tr>
                        <th>Tipo</th>
                        <th>Sucursal origen</th>
                        <th>Nro de guia</th>
                        <th>Precio</th>
                        <th>Peso</th>
                        <th>Fecha de envío</th>
                        <th>Cliente emisor</th>
                        <th>Sucursal destino</th>
                    </tr>
                </thead>
                <tbody>
                  <?php $__currentLoopData = $consulta; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $envio): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                  <tr>
                    <td><?php echo e($envio->ti_nombre); ?></td>
                    <td><?php echo e($envio->so); ?></td>
                    <td><?php echo e($envio->en_clave); ?></td>
                    <td><?php echo e($envio->en_precio); ?></td>
                    <td><?php echo e($envio->en_peso); ?></td>
                    <td><?php echo e($envio->en_fecha_envio); ?></td>
                    <td><?php echo e($envio->cli_nacionalidad); ?> <?php echo e($envio->cli_cedula); ?></td>
                    <td><?php echo e($envio->sd); ?></td>            
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