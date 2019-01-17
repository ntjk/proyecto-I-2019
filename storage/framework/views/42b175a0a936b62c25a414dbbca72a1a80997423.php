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
        <title>Chequeos - LogUCAB</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet" type="text/css">
        <link href="https://fonts.googleapis.com/css?family=Abril+Fatface" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css?family=Lato" rel="stylesheet">
    </head>
    <body>
            <?php echo $__env->make('header', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>
            <div class="container">
            <br/>
            <h1 class="text-center">Rastreo del envío <?php echo e($envio); ?></h1>
            <br/>
            <button type="button" id="add_button" data-toggle="modal" data-target="#userModal" class="btn btn-info btn-lg">Add</button>
            <table class="table table-bordered" id="users-table">
                <thead>
                    <tr>
                      <th>Fecha</th>
                      <th>Fecha de registro</th>
                      <th>Descripcion</th>
                      <th>Sucursal</th>
                      <th>Zona de la sucursal</th>
                      <th>Estatus</th>
		                  <th>Acción</th>
                    </tr>
                </thead>
                <tbody>
                  <?php $__currentLoopData = $chequeosFk; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $c): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                  <tr>
                    <td><?php echo e($c->che_fecha_entrada); ?></td>
                    <td><?php echo e($c->che_fecha_registro); ?></td>
                    <td><?php echo e($c->che_descripcion); ?></td>
                    <td><?php echo e($c->su_nombre); ?></td>
                    <td><?php echo e($c->case); ?></td>
                    <td><?php echo e($c->che_estatus); ?></td>
                    <td>
                      <button class="btn btn-warning btn-detail update" id="<?php echo e($c->che_clave); ?>" value="<?php echo e($c->che_clave); ?>" name="Update">Update</button>
                      <button class="btn btn-danger btn-delete delete" id="<?php echo e($c->che_clave); ?>" value="<?php echo e($c->che_clave); ?>" name="delete">Delete</button>
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
     <h4 class="modal-title">Añadir Chequeo</h4>
    </div>
    <div class="modal-body">
     <br />
     <label>Fecha</label>
     <input name="che_fecha_entrada" type="date" id="che_fecha_entrada" class="form-control"/>
     <br />
       <script>
        var f = new Date();
       // document.getElementById("che_fecha_entrada").value = f;
       </script>
     <label>Descripcion</label>
     <input type="text" name="che_descripcion" id="che_descripcion" class="form-control" />
     <br />
     <label>Sucursal</label>
     <select name="fk_sucursal" id="fk_sucursal" class="form-control">
        <option value="<?php echo e(null); ?>" selected disabled hidden>Si está en una sucursal, indique cuál</option>
        <?php $__currentLoopData = $sucursales; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $sucursal): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
          <option value="<?php echo e($sucursal->su_clave); ?>"><?php echo e($sucursal->su_nombre); ?></option>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
     </select>
     <br />
     <label>Zona</label>
     <select class="form-control" name="fk_zona" id="fk_zona">
    </select>
     <br />
     <label>Estatus</label>
     <select name="che_estatus" id="che_estatus" class="form-control">
        <option value="entregado">Entregado</option>
        <option value="en aduana">En aduana</option>
        <option value="en oficina origen">En oficina origen</option>        
        <option value="en oficina destino">En oficina destino</option>
        <option value="por entregar">Por entregar</option>
     </select>
     <br />
    </div>
    <div class="modal-footer">
     <input type="hidden" name="fk_envio" id="fk_envio" value=<?php echo e($envio); ?>> 
     <input type="hidden" name="che_clave" id="che_clave" />
     <input type="hidden" name="operation" id="operation" />
     <input type="submit" name="action" id="action" class="btn btn-success" value="Add"/>
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
            var che_fecha_entrada = $('#che_fecha_entrada').val();
            var che_descripcion = $('#che_descripcion').val();
            var che_estatus = $('#che_estatus').val();
            var fk_sucursal = $('#fk_sucursal').val();
            var fk_zona = $('#fk_zona').val();
            var fk_envio = $('#fk_envio').val();
            if(che_estatus != '' && che_descripcion != '')
            {
              $.ajax({
                headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                url:"chequeo",
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
              alert("Debe seleccionar un estatus y colocar una descripcion");
            }
          });

          $(document).on('change','#fk_sucursal',function(){
              var sucursal = $(this).val();
              $.ajax({
                headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                type: "POST",
                url: "chequeo/updateSelect",
                data:{sucursal:sucursal},
                success: function(data){
                    var options = '';
                    $.each(data, function(i, item) {
                      options += '<option value="' + item.zo_clave + '">' + item.zo_nombre + '</option>';
                    });
                    $('#fk_zona').empty().html(options);
                }
              });
            });
              
          $(document).on('click', '.update', function(){
            var che_clave = $(this).attr("id");
            $.ajax({
              headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
              url:"chequeo/getOne",
              method:"POST",
              data:{che_clave:che_clave},
              dataType:"json",
              success:function(data){
                $('#userModal').modal('show');
                $('#che_estatus').val(data.che_estatus);
                $('#che_descripcion').val(data.che_descripcion);
                $('#che_fecha_entrada').val(data.che_fecha_entrada);
                $('#che_clave').val(che_clave);
                $('.modal-title').text("Edit Chequeo");
                $('#fk_zona').val(data.zo_nombre);
                $('#fk_sucursal').val(data.su_nombre);
                $('#action').val("Edit");
                $('#operation').val("Edit");
              }
            })
          });
          $(document).on('click','.delete',function(){
            var che_clave = $(this).attr("id");
            if(confirm("¿Estás seguro de que quieres borrar esta información?")){
              $.ajax({
                headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                url:"chequeo/"+che_clave,
                type:"DELETE",
                data:{che_clave:che_clave},
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