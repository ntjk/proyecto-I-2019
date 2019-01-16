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
        <title>Ruta - LogUCAB</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet" type="text/css">
        <link href="https://fonts.googleapis.com/css?family=Abril+Fatface" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css?family=Lato" rel="stylesheet">
    </head>
    <body>
            <?php echo $__env->make('header', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>
            <div class="container">
            <br/>
            <h1 class="text-center">Rutas</h1>
            <br/>
            <button type="button" data-toggle="modal" data-target="#userModal" class="btn btn-info btn-lg">Add</button>
            <table class="table table-bordered" id="users-table">
                <thead>
                    <tr>
                        <th>Ruta nro</th>
                        <th>Sucursal origen</th>
                        <th>Sucursal destino</th>
                        <th>Sucursales de parada</th>
                        <th>Accion</th>
                    </tr>
                </thead>
                <tbody>
                  <?php $__currentLoopData = $rutas; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $r): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                  <tr>
                    <td><?php echo e($r->flo_ruta); ?></td>
                    <td><?php echo e($r->su_nombre); ?></td>
                    <td><?php echo e($r->sd_nombre); ?></td>
                    <td></td>
                    <td>
                      <button class="btn btn-warning btn-detail update" id="<?php echo e($r->flo_ru_clave); ?>" value="<?php echo e($r->flo_ru_clave); ?>" name="Update">Update</button>
                      <button class="btn btn-danger btn-delete delete" id="<?php echo e($r->flo_ru_clave); ?>" value="<?php echo e($r->flo_ru_clave); ?>" name="delete">Delete</button>
                      <button class="btn btn-primary " id="<?php echo e($r->flo_ru_clave); ?>" data-toggle="modal" data-target="#userModal_2"  value="<?php echo e($r->flo_ru_clave); ?>" name="delete">Agregar nodo</button>
                      <button class="btn btn-primary borrarNodo" id="<?php echo e($r->flo_ru_clave); ?>" data-toggle="modal" data-target="#userModal_2"   value="<?php echo e($r->flo_ru_clave); ?>" name="delete">Borrar nodo</button>
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
     <h4 class="modal-title">Añadir Ruta</h4>
    </div>
    <div class="modal-body">
      <label>Sucursal Origen</label>
      <select class="form-control" name="fk_sucursal_1" id="fk_sucursal_1">
        <?php $__currentLoopData = $sucursales; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $sucursal): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <option value="<?php echo e($sucursal->su_clave); ?>"><?php echo e($sucursal->su_nombre); ?></option>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
      </select>
      <br/>
      <label>Medio de transporte :: origen - destino</label>
      <select class="form-control" name="fk_flota" id="fk_flota">
        <?php $__currentLoopData = $flotas; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $flota): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <option value="<?php echo e($flota->flo_clave); ?>"><?php echo e($flota->flo_clave); ?></option>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
      </select>
      <label>Precio :: origen - destino</label>
      <input type="number" step="0.01" name="flo_ru_precio" id="flo_ru_precio" class="form-control"/>
      <label>Duración en horas :: origen - nodo 1</label>
      <input type="number" step="0.01" name="flo_ru_duracion" id="flo_ru_duracion" class="form-control" />
     <br />
      <label>Sucursal Destino</label>
      <select class="form-control" name="fk_sucursal_2" id="fk_sucursal_2">
         <?php $__currentLoopData = $sucursales; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $sucursal): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
         <option value="<?php echo e($sucursal->su_clave); ?>"><?php echo e($sucursal->su_nombre); ?></option>
         <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
       </select>
      <br />
    </div>
    <div class="modal-footer">
     <input type="hidden" name="ru_clave" id="ru_clave" />
     <input type="hidden" name="operation" id="operation" />
     <input type="submit" name="action" id="action" class="btn btn-success agregarRuta" value="Add" />
     <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
    </div>
   </div>
  </form>
 </div>
</div>


<div id="userModal_2" class="modal fade">
 <div class="modal-dialog">
  <form method="post" id="user_form_2" enctype="multipart/form-data">
   <div class="modal-content">
    <div class="modal-header">
     <button type="button" class="close" data-dismiss="modal">&times;</button>
     <h4 class="modal-title">Añadir Sucursal intermedia</h4>
    </div>
    <div class="modal-body">
      <label>Nodo (Sucursal intermedia)</label>
      <select class="form-control" name="fk_sucursal_2_2" id="fk_sucursal_2_2">
        <?php $__currentLoopData = $sucursales; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $sucursal): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <option value="<?php echo e($sucursal->su_clave); ?>"><?php echo e($sucursal->su_nombre); ?></option>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
      </select>
       <label>Medio de transporte :: desde la sucursal anterior a este nodo</label>
      <select class="form-control" name="fk_flota_2" id="fk_flota_2">
        <?php $__currentLoopData = $flotas; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $flota): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <option value="<?php echo e($flota->flo_clave); ?>"><?php echo e($flota->flo_clave); ?></option>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
      </select>
      <label>Precio :: desde la sucursal anterior a este nodo</label>
      <input type="number" step="0.01" name="flo_ru_precio_2" id="flo_ru_precio_2" class="form-control"/>
      <label>Duración en horas :: origen - nodo 1</label>
      <input type="number" step="0.01" name="flo_ru_duracion_2" id="flo_ru_duracion_2" class="form-control" />
     <br />
    </div>
    <div class="modal-footer">
     <!--<input type="hidden" name="ru_clave" id="ru_clave" />
     <input type="hidden" name="operation" id="operation" />-->
     <input type="submit" name="action_2" id="action_2" class="btn btn-success agregarNodo" value="Add" />
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
            var fk_sucursal_1 = $('#fk_sucursal_1').val();
            var fk_sucursal_2 = $('#fk_sucursal_2').val();
            var fk_flota = $('#fk_flota').val();
            var flo_ru_precio = $('#flo_ru_precio').val();
            var flo_ru_duracion = $('#flo_ru_duracion').val();
            console.log(fk_sucursal_1);
            console.log(fk_sucursal_2);
            console.log(fk_flota);
            console.log(flo_ru_precio);
            console.log(flo_ru_duracion);

            if(fk_sucursal_1 != "" && fk_sucursal_2 != "" && flo_ru_precio != "")
            {
              $.ajax({
                headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                method: 'POST',
                url:"floru/agregarRuta",
                data: {
                  fk_sucursal_1:fk_sucursal_1,
                  fk_sucursal_2:fk_sucursal_2,
                  fk_flota:fk_flota,
                  flo_ru_duracion:flo_ru_duracion,
                  flo_ru_precio:flo_ru_precio
                },
                success:function(data)
                {
                  alert(data.message);
                  $('#user_form')[0].reset();
                  //$('#users-table').dataTable().ajax.reload(null, false);
                }
              });
            }
            else
            {
              alert("Falta campos por llenar");
            }
          });

          $(document).on('click', '.agregarNodo', function(){
            var fk_sucursal_1 = $('#fk_sucursal_1').val();
            var fk_sucursal_2 = $('#fk_sucursal_2').val();
            if(fk_sucursal_1 != fk_sucursal_2)
            {
              $.ajax({
                headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                url:"floru",
                method:'POST',
                data: new FormData(this),
                contentType:false,
                processData:false,
                success:function(data)
                {
                  alert(data.message);
                  $('#user_form_2')[0].reset();
                  $('#users-table').dataTable().ajax.reload(null, false);
                }
              });
            }
            else
            {
              alert("Origen y Destino no pueden ser igual");
            }
          });

          $(document).on('click', '.update', function(){
            var ru_clave = $(this).attr("id");
            $.ajax({
              headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
              url:"ruta/getOne",
              method:"POST",
              data:{ru_clave:ru_clave},
              dataType:"json",
              success:function(data){
                $('#userModal').modal('show');
                $('#fk_sucursal_1').val(data.fk_sucursal_1);
                $('#fk_sucursal_2').val(data.fk_sucursal_2);
                $('.modal-title').text("Edit Ruta");
                $('#ru_clave').val(ru_clave);
                $('#action').val("Edit");
                $('#operation').val("Edit");
              }
            })
          });
          $(document).on('click','.delete',function(){
            var ru_clave = $(this).attr("id");
            if(confirm("¿Estás seguro de que quieres borrar esta información?")){
              $.ajax({
                headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                url:"ruta/"+ru_clave,
                type:"DELETE",
                data:{ru_clave:ru_clave},
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
        });
        </script>
        <?php echo $__env->yieldPushContent('scripts'); ?>
        <?php echo $__env->make('footer', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>
        </div>
      </div>
    </body>
</html>
