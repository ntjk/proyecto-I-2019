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
        <title>Marítimo - LogUCAB</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet" type="text/css">
        <link href="https://fonts.googleapis.com/css?family=Abril+Fatface" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css?family=Lato" rel="stylesheet">
    </head>
    <body>
            <?php echo $__env->make('header', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>
            <div class="container">
            <br/>
            <h1 class="text-center">Transportes Maritimos</h1>
            <br/>
            <button type="button" id="add_button" data-toggle="modal" data-target="#userModal" class="btn btn-info btn-lg">Add</button>
            <table class="table table-bordered" id="users-table">
                <thead>
                    <tr>
                        <th>Clave</th>
                        <th>Suptipo</th>
                        <th>Tipo</th>
                        <th>Peso</th>
                        <th>Placa</th>
                        <th>Descripción</th>
                        <th>Combustible por hora</th>
                        <th>Serial de carroceria</th>
                        <th>Capacidad de carga</th>
                        <th>Modelo</th>
                        <th>Sucursal</th>
                        <th>Año</th>
                        <th>Serial Motor</th>
                        <th>Accion</th>
                    </tr>
                </thead>
                <tbody>
                  <?php $__currentLoopData = $flotas; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $floma): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                  <tr>
                    <td><?php echo e($floma->flo_clave); ?></td>
                    <td><?php echo e($floma->flo_subtipo); ?></td>
                    <td><?php echo e($floma->flo_tipo); ?></td>
                    <td><?php echo e($floma->flo_peso); ?></td>
                    <td><?php echo e($floma->flo_placa); ?></td>
                    <td><?php echo e($floma->flo_descripcion); ?></td>
                    <td><?php echo e($floma->flo_combustible_por_hora); ?></td>
                    <td><?php echo e($floma->flo_serial_carroceria); ?></td>
                    <td><?php echo e($floma->flo_capacidad_carga); ?></td>
                    <td><?php echo e($floma->mod_nombre); ?></td>
                    <td><?php echo e($floma->su_nombre); ?></td>
                    <td><?php echo e($floma->flo_año); ?></td>
                    <td><?php echo e($floma->flo_ma_serial_motor); ?></td>
                    <td>
                      <button class="btn btn-warning btn-detail update" id="<?php echo e($floma->flo_clave); ?>" value="<?php echo e($floma->flo_clave); ?>" name="Update">Update</button>
                      <button class="btn btn-danger btn-delete delete" id="<?php echo e($floma->flo_clave); ?>" value="<?php echo e($floma->flo_clave); ?>" name="delete">Delete</button>
                      <button class="btn btn-primary verHistorico" id="<?php echo e($floma->flo_clave); ?>" value="<?php echo e($floma->flo_clave); ?>" name="verHistorico">Histórico</button>
                    </td>
                  </tr>
                  <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </tbody>
            </table>
        </div>
        <div id="userModal" class="modal fade">
 <div class="modal-dialog">
  <form method="post" id="user_form" enctype="multipart/form-data">
   <div class="modal-content">
    <div class="modal-header">
     <button type="button" class="close" data-dismiss="modal">&times;</button>
     <h4 class="modal-title">Añadir Flota Marítima</h4>
    </div>
    <div class="modal-body">
     <label>Subtipo</label>
     <select class="form-control" name="flo_subtipo" id="flo_subtipo">
       <option value="marítima" selected>marítima</option>
     </select>
     <br />
     <label>Tipo</label>
     <input type="text" name="flo_tipo" id="flo_tipo" class="form-control" />
     <br />
     <label>Peso</label>
     <input type="number" step="0.01" name="flo_peso" id="flo_peso" class="form-control" />
     <br />
     <label>Placa</label>
     <input type="text" name="flo_placa" id="flo_placa" class="form-control" />
     <br />
     <label>Descripción</label>
     <input type="text" name="flo_descripcion" id="flo_descripcion" class="form-control" />
     <br />
     <label>Combustible por hora</label>
     <input type="number" step="0.01" name="flo_combustible_por_hora" id="flo_combustible_por_hora" class="form-control" />
     <br />
     <label>Serial de carroceria</label>
     <input type="text" name="flo_serial_carroceria" id="flo_serial_carroceria" class="form-control" />
     <br />
     <label>Capacidad de carga</label>
     <input type="number" step="0.01" name="flo_capacidad_carga" id="flo_capacidad_carga" class="form-control" />
     <br />
     <label>Modelo</label>
     <select class="form-control" name="fk_modelo" id="fk_modelo">
        <?php $__currentLoopData = $modelos; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $modelo): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <option value="<?php echo e($modelo->mod_clave); ?>"><?php echo e($modelo->mod_nombre); ?></option>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
      </select>
     <label>Sucursal Base</label>
     <select class="form-control" name="fk_sucursal" id="fk_sucursal">
        <?php $__currentLoopData = $sucursales; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $sucursal): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <option value="<?php echo e($sucursal->su_clave); ?>"><?php echo e($sucursal->su_nombre); ?></option>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
      </select>
     <br />
     <label>Año</label>
     <input type="text" name="flo_año" id="flo_año" class="form-control" />
     <br />
     <br />
     <label>Serial del Motor</label>
     <input type="text" name="flo_ma_serial_motor" id="flo_ma_serial_motor" class="form-control" />
     <br />
    </div>
    <div class="modal-footer">
     <input type="hidden" name="flo_clave" id="flo_clave" />
     <input type="hidden" name="operation" id="operation" />
     <input type="submit" name="action" id="action" class="btn btn-success" value="Add" />
     <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
    </div>
   </div>
  </form>
 </div>
</div>
        <script src="//code.jquery.com/jquery.js"></script>
        <script src="//cdn.datatables.net/1.10.7/js/jquery.dataTables.min.js"></script>
        <script src="//netdna.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>
        <script>$(function() {
            $('#users-table').DataTable({
            })

            $(document).on('submit', '#user_form', function(event){
            event.preventDefault();
            var flo_subtipo = $('#flo_subtipo').val();
            var flo_tipo = $('#flo_tipo').val();
            var flo_peso = $('#flo_peso').val();
            var flo_placa = $('#flo_placa').val();
            var flo_descripcion = $('#flo_descripcion').val();
            var flo_combustible_por_hora = $('#flo_combustible_por_hora').val();
            var flo_serial_carroceria = $('#flo_serial_carroceria').val();
            var flo_capacidad_carga = $('#flo_capacidad_carga').val();
            var fk_modelo = $('#fk_modelo').val();
            var fk_sucursal = $('#fk_sucursal').val();
            var flo_año = $('#flo_año').val();
            var flo_te_serial_motor = $('#flo_ma_serial_motor').val();
            if(flo_subtipo != '' && flo_tipo != '')
            {
              $.ajax({
                headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                url:"transporteM",
                method:'POST',
                data: new FormData(this),
                contentType:false,
                processData:false,
                success:function(data)
                {
                  alert(data.message);
                  $('#user_form')[0].reset();
                  $('#users-table').dataTable().ajax.reload(null, false);
                }
              });
            }
            else
            {
              alert("Both Fields are Required");
            }
          });

          $(document).on('click', '.update', function(){
            var flo_clave = $(this).attr("id");
            $.ajax({
              headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
              url:"transporteM/getOne",
              method:"POST",
              data:{flo_clave:flo_clave},
              dataType:"json",
              success:function(data){
                $('#userModal').modal('show');
                $('.modal-title').text("Edit Flota");
                $('#flo_clave').val(flo_clave);
                $('#flo_subtipo').val(data.flo_subtipo);
                $('#flo_tipo').val(data.flo_tipo);
                $('#flo_peso').val(data.flo_peso);
                $('#flo_placa').val(data.flo_placa);
                $('#flo_descripcion').val(data.flo_descripcion);
                $('#flo_combustible_por_hora').val(data.flo_combustible_por_hora);
                $('#flo_serial_carroceria').val(data.flo_serial_carroceria);
                $('#flo_capacidad_carga').val(data.flo_capacidad_carga);
                $('#fk_modelo').val(fk_modelo);
                $('#fk_sucursal').val(fk_sucursal);
                $('#flo_año').val(data.flo_año);
                $('#flo_ma_serial_motor').val(data.flo_te_serial_motor);
                $('#action').val("Edit");
                $('#operation').val("Edit");
              }
            })
          });

          $(document).on('click','.delete',function(){
            var flo_clave = $(this).attr("id");
            if(confirm("¿Estás seguro de que quieres borrar esta información?")){
              $.ajax({
                headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                url:"transporteM/"+flo_clave,
                type:"DELETE",
                data:{flo_clave:flo_clave},
                success:function(data){
                  alert(data.message);
                  $('#users-table').dataTable().ajax.reload(null, false);
                }
              })
            }
            else {
              return false;
            }
          });

          $(document).on('click', '.verHistorico', function(){
            var flo_clave = $(this).attr("id");
            var url = "<?php echo e(url('/historicoF')); ?>" + flo_clave;
            window.location.href = url;
          });

        });
        </script>
        <?php echo $__env->yieldPushContent('scripts'); ?>
        <?php echo $__env->make('footer', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>
        </div>
      </div>
    </body>
</html>