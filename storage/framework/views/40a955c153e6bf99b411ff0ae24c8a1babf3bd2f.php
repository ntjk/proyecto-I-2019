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
            <button type="button" id="add_button" data-toggle="modal" data-target="#userModal" class="btn btn-info btn-lg">Add</button>
            <table class="table table-bordered" id="users-table">
                <thead>
                    <tr>
                        <th>Clave</th>
                        <th>Sucursal Origen</th>
                        <th>Sucursal Destino</th>
                        <th>Accion</th>
                    </tr>
                </thead>
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
                processing: true,
                serverSide: true,
                ajax: '<?php echo route('ruta_getData'); ?>',
                columns: [
                    { data: 'ru_clave', name: 'ruta.ru_clave' },
                    { data: 'su_nombre', name: 'sucursal.su_nombre' },
                    { data: 'fk_sucursal_2', name: 'ruta.fk_sucursal_2' },
                    {data: 'action', name: 'action', orderable: false, searchable: false}
                ]
            })

            $(document).on('submit', '#user_form', function(event){
            event.preventDefault();
            var fk_sucursal_1 = $('#fk_sucursal_1').val();
            var fk_sucursal_2 = $('#fk_sucursal_2').val();
            if(fk_sucursal_1 != fk_sucursal_2)
            {
              $.ajax({
                headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                url:"ruta",
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
