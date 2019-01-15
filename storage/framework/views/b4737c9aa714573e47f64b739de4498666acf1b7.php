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
        <title>Permisos - LogUCAB</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet" type="text/css">
        <link href="https://fonts.googleapis.com/css?family=Abril+Fatface" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css?family=Lato" rel="stylesheet">
    </head>
    <body>
            <?php echo $__env->make('header', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>
            <div class="container">
            <br/>
            <h1 class="text-center">Permisos del rol <?php echo e($rol->rol_nombre); ?></h1>
            <br/>
            <button type="button" id="add_button" data-toggle="modal" data-target="#userModal" class="btn btn-info btn-lg">Agregar </button>
            <br/>
            <table class="table table-bordered" id="users-table" width="70%">
                <thead>
                    <tr>
                      <th>Permisos del rol <?php echo e($rol->rol_nombre); ?></th>
                      <th>Accion</th>
                    </tr>
                </thead>
                <tbody>
                  <?php $__currentLoopData = $permisosFk; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $c): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                  <tr>
                    <td><?php echo e($c->per_descripcion); ?></td>
                    <td>
                      <button class="btn btn-danger btn-delete delete" id="<?php echo e($c->per_clave); ?>" value="<?php echo e($c->per_clave); ?>" name="delete">Quitar permiso</button>
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
     <h4 class="modal-title">Añadir Permiso a este rol</h4>
    </div>
    <div class="modal-body">
     <br />
     <label>Permisos</label>
      <select class="form-control" name="fk_permiso" id="fk_permiso">
       <?php $__currentLoopData = $permisosNoFk; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $pnfk): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <option value="<?php echo e($pnfk->per_clave); ?>"><?php echo e($pnfk->per_tipo); ?> <?php echo e($pnfk->per_nombre); ?></option>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
      </select>
     <br />   
    </div>
    <div class="modal-footer">
     <input type="hidden" name="fk_rol" id="fk_rol" value="<?php echo e($rol->rol_clave); ?>"> 
     <input type="hidden" name="per_clave" id="per_clave" />
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
            var fk_permiso= $('#fk_permiso').val();
            var fk_rol = $('#fk_rol').val();
            if(fk_permiso != '')
            {
              $.ajax({
                headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                url:"rolper",
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
              alert("Debe seleccionar un permiso");
            }
          });


          $(document).on('click','.delete',function(){
            
            var fk_rol = $('#fk_rol').val();
             console.log(fk_rol);
            var fk_permiso = $(this).attr("id");
            console.log(fk_permiso);
           
            if(confirm("¿Está seguro de quitarle el permiso a este rol?")){
              $.ajax({
                headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                url:"rolper/"+fk_permiso,
                type:"DELETE",
                data:{fk_permiso:fk_permiso,
                  fk_rol:fk_rol},
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