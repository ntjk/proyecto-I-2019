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
        <title>Puertos - LogUCAB</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet" type="text/css">
        <link href="https://fonts.googleapis.com/css?family=Abril+Fatface" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css?family=Lato" rel="stylesheet">
    </head>
    <body>
            <?php echo $__env->make('header', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>
            <div class="container">
            <br/>
            <h1 class="text-center">Puertos</h1>
            <br/>
            <button type="button" id="add_button" data-toggle="modal" data-target="#userModal" class="btn btn-info btn-lg">Add</button>
            <table class="table table-bordered" id="users-table">
                <thead>
                    <tr>
                        <th>Clave</th>
                        <th>Cant. Puestos</th>
                        <th>Cant. Muelles</th>
                        <th>Longitud</th>
                        <th>Ancho</th>
                        <th>Calado</th>
                        <th>Uso</th>
                        <th>Nombre</th>
                        <th>Flota</th>
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
     <h4 class="modal-title">Añadir Puerto</h4>
    </div>
    <div class="modal-body">
     <label># Puestos</label>
     <input type="number" name="puer_cantidad_puestos" id="puer_cantidad_puestos" class="form-control" />
     <br />
     <label># Muelles</label>
     <input type="number" name="puer_cantidad_muelles" id="puer_cantidad_muelles" class="form-control" />
     <br />
     <label>Longitud</label>
     <input type="number" name="puer_longitud" id="puer_longitud" class="form-control" />
     <br />
     <label>Ancho</label>
     <input type="number" name="puer_ancho" id="puer_ancho" class="form-control" />
     <br />
     <label>Calado</label>
     <input type="number" name="puer_calado" id="puer_calado" class="form-control" />
     <br />
     <label>Uso</label>
     <input type="text" name="puer_uso" id="puer_uso" class="form-control" />
     <br />
     <label>Nombre</label>
     <input type="text" name="puer_nombre" id="puer_nombre" class="form-control" />
     <br />
    <!--FLOTA HERE-->
     <label>Flota</label>
     <input type="number" name="fk_flota" id="fk_flota" class="form-control" />
     <br />
    </div>
    <div class="modal-footer">
     <input type="hidden" name="puer_clave" id="puer_clave" />
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
                ajax: '<?php echo route('puerto_getData'); ?>',
                columns: [
                    { data: 'puer_clave', name: 'puer_clave' },
                    { data: 'puer_cantidad_puestos', name: 'puer_cantidad_puestos' },
                    { data: 'puer_cantidad_muelles', name: 'puer_cantidad_muelles' },
                    { data: 'puer_longitud', name: 'puer_longitud' },
                    { data: 'puer_ancho', name: 'puer_ancho' },
                    { data: 'puer_calado', name: 'puer_calado' },
                    { data: 'puer_uso', name: 'puer_uso' },
                    { data: 'puer_nombre', name: 'puer_nombre' },
                    { data: 'fk_flota', name: 'fk_flota' },
                    {data: 'action', name: 'action', orderable: false, searchable: false}
                ]
            })

            $(document).on('submit', '#user_form', function(event){
            event.preventDefault();
            var puer_cantidad_puestos = $('#puer_cantidad_puestos').val();
            var puer_cantidad_muelles = $('#puer_cantidad_muelles').val();
            var puer_longitud = $('#puer_longitud').val();
            var puer_ancho = $('#puer_ancho').val();
            var puer_calado = $('#puer_calado').val();
            var puer_uso = $('#puer_uso').val();
            var puer_nombre = $('#puer_nombre').val();
            var fk_flota = $('#fk_flota').val();

            if(puer_cantidad_puestos != '' && 
            puer_cantidad_muelles != '' && 
            puer_longitud != '' && 
            puer_ancho != '' && 
            puer_calado != '' && 
            puer_uso != '' && 
            puer_nombre != '' && 
            fk_flota != '')
            {
              $.ajax({
                headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                url:"puerto",
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
            var puer_clave = $(this).attr("id");
            $.ajax({
              headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
              url:"puerto/getOne",
              method:"POST",
              data:{puer_clave:puer_clave},
              dataType:"json",
              success:function(data){
                $('#userModal').modal('show');
                $('#puer_cantidad_puestos').val(data.puer_cantidad_puestos);
                $('#puer_cantidad_muelles').val(data.puer_cantidad_muelles);
                $('#puer_longitud').val(data.puer_longitud);
                $('#puer_ancho').val(data.puer_ancho);
                $('#puer_calado').val(data.puer_calado);
                $('#puer_uso').val(data.puer_uso);
                $('#puer_nombre').val(data.puer_nombre);
                $('#fk_flota').val(data.fk_flota);
                $('.modal-title').text("Edit puerto");
                $('#puer_clave').val(puer_clave);
                $('#action').val("Edit");
                $('#operation').val("Edit");
              }
            })
          });
          $(document).on('click','.delete',function(){
            var puer_clave = $(this).attr("id");
            if(confirm("¿Estás seguro de que quieres borrar esta información?")){
              $.ajax({
                headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                url:"puerto/"+puer_clave,
                type:"DELETE",
                data:{puer_clave:puer_clave},
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