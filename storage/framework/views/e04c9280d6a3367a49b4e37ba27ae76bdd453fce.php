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
        <title>Roles - LogUCAB</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet" type="text/css">
        <link href="https://fonts.googleapis.com/css?family=Abril+Fatface" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css?family=Lato" rel="stylesheet">
    </head>
    <body>
            <?php echo $__env->make('header', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>
            <div class="container">
            <br/>
            <h1 class="text-center">Roles</h1>
            <br/>
            <button type="button" id="add_button" data-toggle="modal" data-target="#userModal" class="btn btn-info btn-lg">Add</button>
            <table class="table table-bordered" id="users-table">
                <thead>
                    <tr>
                        <th>Nombre</th>
                        <th>Descripcion</th>
                        <th id="hidden2">Accion</th> 
                    </tr>
                </thead>
                <tbody>
                  <?php $__currentLoopData = $roles; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $rol): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                  <tr>
                    <td><?php echo e($rol->rol_nombre); ?></td>
                    <td><?php echo e($rol->rol_descripcion); ?></td>
                    <td id="hidden3">
                      <button class="btn btn-warning btn-detail update" id="<?php echo e($rol->rol_clave); ?>" value="<?php echo e($rol->rol_clave); ?>" name="Update">Update</button>
                      <button class="btn btn-danger btn-delete delete" id="<?php echo e($rol->rol_clave); ?>" value="<?php echo e($rol->rol_clave); ?>" name="delete">Delete</button>
                      <button class="btn btn-primary verPermisos" id="<?php echo e($rol->rol_clave); ?>" value="<?php echo e($rol->rol_clave); ?>" name="verPermisos">Permisos</button>
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
     <h4 class="modal-title">Añadir Rol</h4>
    </div>
    <div class="modal-body">
     <label>Nombre</label>
     <input type="text" name="rol_nombre" id="rol_nombre" class="form-control" />
     <br />
     <label>Descripcion</label>
     <input type="text" name="rol_descripcion" id="rol_descripcion" class="form-control" />
     <br />
    </div>
    <div class="modal-footer">
     <input type="hidden" name="rol_clave" id="rol_clave" />
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

            $(".delete").hide();
            $(".update").hide();
            $('#add_button').hide();
            $('#hidden2').hide();    
            $('#hidden3').hide();    

            var eliminar = '<?php echo verificarPermisosHelper("eliminar roles");; ?>';
            var modificar = '<?php echo verificarPermisosHelper("modificar roles");; ?>';
            var insertar = '<?php echo verificarPermisosHelper("insertar roles");; ?>';

            if(eliminar || modificar){
              $('#hidden2').show();    
              $('#hidden3').show();
            }
            if(eliminar)
              $(".delete").show();
            if(modificar)
              $(".update").show();              
            if(insertar)
              $('#add_button').show();

            $(document).on('submit', '#user_form', function(event){
            event.preventDefault();
            var rol_nombre = $('#rol_nombre').val();
            var rol_descripcion = $('#rol_descripcion').val();
            if(rol_nombre != '' && rol_descripcion != '')
            {
              $.ajax({
                headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                url:"rol",
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
            var rol_clave = $(this).attr("id");
            $.ajax({
              headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
              url:"rol/getOne",
              method:"POST",
              data:{rol_clave:rol_clave},
              dataType:"json",
              success:function(data){
                $('#userModal').modal('show');
                $('#rol_nombre').val(data.rol_nombre);
                $('#rol_descripcion').val(data.rol_descripcion);
                $('.modal-title').text("Edit Rol");
                $('#rol_clave').val(rol_clave);
                $('#action').val("Edit");
                $('#operation').val("Edit");
              }
            })
          });
          $(document).on('click', '.verPermisos', function(){
            var rol_clave = $(this).attr("id");
            var url = "<?php echo e(url('/rolper')); ?>" + rol_clave;
            window.location.href = url;
          });
          $(document).on('click','.delete',function(){
            var rol_clave = $(this).attr("id");
            if(confirm("¿Estás seguro de que quieres borrar esta información?")){
              $.ajax({
                headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                url:"rol/"+rol_clave,
                type:"DELETE",
                data:{rol_clave:rol_clave},
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
