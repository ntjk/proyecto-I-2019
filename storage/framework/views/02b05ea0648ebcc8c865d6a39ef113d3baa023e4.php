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
       <title>Aeropuertos - LogUCAB</title>

       <!-- Fonts -->
       <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet" type="text/css">
       <link href="https://fonts.googleapis.com/css?family=Abril+Fatface" rel="stylesheet">
       <link href="https://fonts.googleapis.com/css?family=Lato" rel="stylesheet">
   </head>
   <body>
           <?php echo $__env->make('header', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>
           <div class="container">
           <br/>
           <h1 class="text-center">Aeropuertos</h1>
           <br/>
           <!--<button type="button" id="add_button" data-toggle="modal" data-target="#userModal" class="btn btn-info btn-lg">Add</button>-->
           <table class="table table-bordered" id="users-table">
               <thead>
                   <tr>
                       <th>Nombre</th>
                       <th>Capacidad</th>
                       <th>Cant. Pistas</th>
                       <th>Cant. Terminales</th>
                       <th>Otros</th>
                       <th>Sucursal</th>
                       <!--<th>Accion</th>-->
                   </tr>
               </thead>
               <tbody>
                  <?php $__currentLoopData = $aeropuertos; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $p): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                  <tr>
                    <td><?php echo e($p->ae_nombre); ?></td>
                    <td><?php echo e($p->capacidad); ?></td>
                    <td><?php echo e($p->pistas); ?></td>
                    <td><?php echo e($p->terminales); ?></td>
                    <td><?php echo e($p->otros); ?></td>
                    <td><?php echo e($p->sucursal); ?></td>
                  </tr>
                  <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </tbody>
           </table>
       <script src="//code.jquery.com/jquery.js"></script>
       <script src="//cdn.datatables.net/1.10.7/js/jquery.dataTables.min.js"></script>
       <script src="//netdna.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>
       <script>$(function() {
           $('#users-table').DataTable({
           })

        //    $(document).on('submit', '#user_form', function(event){
        //    event.preventDefault();
        //    var ae_nombre = $('#ae_nombre').val();
        //    var ae_capacidad = $('#ae_capacidad').val();
        //    var ae_cantidad_pistas = $('#ae_cantidad_pistas').val();
        //    var ae_cantidad_terminales = $('#ae_cantidad_terminales').val();
        //    var ae_otro = $('#ae_otro').val();
        //    var fk_sucursal = $('#fk_sucursal').val();

        //    if(ae_nombre != '' &&
        //    ae_capacidad != '' &&
        //    ae_cantidad_pistas != '' &&
        //    ae_cantidad_terminales != '' &&
        //    ae_otro != '')
        //    {
        //      $.ajax({
        //        headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
        //        url:"aeropuerto",
        //        method:'POST',
        //        data: new FormData(this),
        //        contentType:false,
        //        processData:false,
        //        success:function(data)
        //        {
        //          alert(data.message);
        //          $('#user_form')[0].reset();
        //          $('#users-table').dataTable().ajax.reload(null, false);
        //        }
        //      });
        //    }
        //    else
        //    {
        //      alert("Both Fields are Required");
        //    }
        //  });
        //  $(document).on('click', '.update', function(){
        //    var ae_clave = $(this).attr("id");
        //    $.ajax({
        //      headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
        //      url:"aeropuerto/getOne",
        //      method:"POST",
        //      data:{ae_clave:ae_clave},
        //      dataType:"json",
        //      success:function(data){
        //        $('#userModal').modal('show');
        //        $('#ae_nombre').val(data.ae_nombre);
        //        $('#ae_capacidad').val(data.ae_capacidad);
        //        $('#ae_cantidad_pistas').val(data.ae_cantidad_pistas);
        //        $('#ae_cantidad_terminales').val(data.ae_cantidad_terminales);
        //        $('#ae_otro').val(data.ae_otro);
        //        $('#fk_sucursal').val(data.fk_sucursal);
        //        $('.modal-title').text("Edit aeropuerto");
        //        $('#ae_clave').val(ae_clave);
        //        $('#action').val("Edit");
        //        $('#operation').val("Edit");
        //      }
        //    })
        //  });
        //  $(document).on('click','.delete',function(){
        //    var ae_clave = $(this).attr("id");
        //    if(confirm("¿Estás seguro de que quieres borrar esta información?")){
        //      $.ajax({
        //        headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
        //        url:"aeropuerto/"+ae_clave,
        //        type:"DELETE",
        //        data:{ae_clave:ae_clave},
        //        success:function(data){
        //          alert(data.message);
        //          $('#users-table').dataTable().ajax.reload(null, false);
        //        }
        //      })
        //    }
        //    else {
        //      return false;
        //    }
        //  });
       });
       </script>
       <?php echo $__env->yieldPushContent('scripts'); ?>
       <?php echo $__env->make('footer', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>
       </div>
     </div>
   </body>
</html>