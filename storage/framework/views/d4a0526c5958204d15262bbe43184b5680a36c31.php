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
        <title>Envio - LogUCAB</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet" type="text/css">
        <link href="https://fonts.googleapis.com/css?family=Abril+Fatface" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css?family=Lato" rel="stylesheet">

        <!-- Styles -->
        <style>
            html, body {
                background-color: #fff;
                color: #636b6f;
                font-family: 'Lato', sans-serif;
                font-weight: 200;
                margin: 0;
            }

            .full-height {
                height: 100vh;
            }

            .flex-center {
                align-items: center;
                display: flex;
                justify-content: center;
            }

            .position-ref {
                position: relative;
            }

            .top-right {
                position: absolute;
                right: 10px;
                top: 18px;
            }

            .content {
                width: 100vw;
                background-color: #ffc002;
                text-align: center;
                height:200px;
            }

            .title {
                font-size: 46px;
                text-decoration: underline;
            }

            .links > a {
                width:100vw;
                color: #ffffff;
                padding: 0 10px;
                font-size: 13px;
                font-weight: 600;
                letter-spacing: .1rem;
                text-decoration: none;
                text-transform: uppercase;
                float:none;
            }

            .m-b-md {
              margin-top: 20px;
                text-align: center;
                margin-left: 30px;
            }
            .logo-container{
              display: inline;
              float: left;
              width: 30vw;
            }
            .logo{
                height:200px;
            }

            .motto-container{
              width:70vw;
              float:right;
            }

            .motto{
              color:#ffffff;
              font-family: 'Abril Fatface', cursive;
                  padding-top: 45px;
                  font-size: 52px;
                  text-decoration: bold;
                  text-align: center;
            }

            .nav{
              text-align: center;
              width:100vw;
              height: 30px;
              background-color: #000000;
            }
            .main{
              padding-top: 50px;
            }
          .banner{
            height:350px;
          }
          .third{
            float:left;
            height:inherit;
            width:32vw;
          }
          .mbp{
            display: block;
            max-width:33vw;
            max-height: 300px;
            width: auto;
            height: auto;
            margin: 20px;
          }
          .blue-block{
            background-color: #1480d1;
            margin-top: 20px;
            max-height: 300px;
          }
          .red-block{
            background-color: #FF4136;
            margin-top: 20px;
            margin-left: 20px;
            max-height: 300px;
          }
          .a-bit-off{
            margin-top:-2px;
            font-size: 46px;
          }
          .line{
            background-color: #000000;
            height: 3px;
            margin-left: 2vw;
            width: 95vw;
          }
          .footer{
            text-align: center;
            margin-top: 50px;
          }
        </style>
    </head>
    <body>
            <div class="content">
              <div class="logo-container">
              <div class="logo">
                <a href="welcome"><img src=<?php echo e(asset('img/logo.png')); ?> class="logo"></img></a>
              </div>
            </div>
            <div class="motto-container">
              <div class="motto">
                  Mayor empresa de envios en venezuela.
              </div>
            </div>
            </div>
              <div class="nav">
                <div class="links">
                    <a href="quienes_somos">¿Quienes Somos?</a>
                    <a href="usuario">Usuarios</a>
                    <a href="rol">Roles</a>
                    <a href="sucursal">Sucursales</a>
                    <a href="transporte">Transportes T</a>
                    <a href="transporteM">Transportes M</a>
                    <a href="transporteA">Transportes A</a>
                    <a href="cliente">Clientes</a>
                    <a href="empleado">Empleados</a>
                    <a href="ruta">Rutas</a>
                    <a href="envio">Envios</a>
                </div>
              </div>
            <div class="container">
            <br/>
            <h1 class="text-center">Envios</h1>
            <br/>
            <button type="button" id="add_button" data-toggle="modal" data-target="#userModal" class="btn btn-info btn-lg">Add</button>
            <table class="table table-bordered" id="users-table">
                <thead>
                    <tr>
                        <th>Clave</th>
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
                        <th>Accion</th>
                    </tr>
                </thead>
                <tbody>
                  <?php $__currentLoopData = $envios; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $envio): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                  <tr>
                    <td><?php echo e($envio->en_clave); ?></td>
                    <td><?php echo e($envio->en_tipo); ?></td>
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
                    <td><?php echo e($envio->sd_nombre); ?></td>
                    <td>
                      <button class="btn btn-warning btn-detail update" id="<?php echo e($envio->en_clave); ?>" value="<?php echo e($envio->en_clave); ?>" name="Update">Update</button>
                      <button class="btn btn-danger btn-delete delete" id="<?php echo e($envio->en_clave); ?>" value="<?php echo e($envio->en_clave); ?>" name="delete">Delete</button>
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
     <h4 class="modal-title">Añadir envio</h4>
    </div>
  <div class="modal-body">
     <label>Tipo</label>
     <input type="text" name="en_tipo" id="en_tipo" class="form-control" />
     <br />
     <label>Precio</label>
     <input type="number" step="0.01" name="en_precio" id="en_precio" class="form-control"/>
     <br />
     <label>Peso</label>
     <input type="number" step="0.01" name="en_peso" id="en_peso" class="form-control" />
     <br />
     <label>Descripción</label>
     <input type="text" name="en_descripcion" id="en_descripcion" class="form-control" />
     <br />
     <label>Altura</label>
     <input type="number" step="0.01" name="en_altura" id="en_altura" class="form-control" />
     <br />
     <label>Anchura</label>
     <input type="number" step="0.01" name="en_anchura" id="en_anchura" class="form-control" />
     <br />
     <label>Profundidad</label>
     <input type="number" step="0.01" name="en_profundidad" id="en_profundidad" class="form-control" />
     <br />
     <label>Fecha de envío</label>
     <input type="date" name="en_fecha_envio" id="en_fecha_envio" class="form-control" />
     <br />
     <label>Fecha de entrega estimada</label>
     <input type="date" name="en_fecha_entrega_estimada" id="en_fecha_entrega_estimada" class="form-control" />
     <br />
     <label>Sucursal origen</label>
     <select name="fk_sucursal_origen" id="fk_sucursal_origen" class="form-control">
        <?php $__currentLoopData = $sucursales; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $sucursal): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <option value="<?php echo e($sucursal->su_clave); ?>"><?php echo e($sucursal->su_nombre); ?></option>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
      </select>
      <br />
     <label>Sucursal destino</label>
     <select name="fk_sucursal_destino" id="fk_sucursal_destino" class="form-control">
        <?php $__currentLoopData = $sucursales; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $sucursal): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <option value="<?php echo e($sucursal->su_clave); ?>"><?php echo e($sucursal->su_nombre); ?></option>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
      </select>
     <br />
     <label>Cliente emisor</label>
     <select name="fk_cliente" id="fk_cliente" class="form-control">
        <?php $__currentLoopData = $clientes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $cliente): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <option value="<?php echo e($cliente->cli_clave); ?>"><?php echo e($cliente->cli_nacionalidad); ?> <?php echo e($cliente->cli_cedula); ?></option>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
      </select>
     <br />
     
    <label>Ruta (flota-ruta)</label>
         

        <input type="number" name="fk_flota_ruta_1" id="fk_flota_ruta_1" class="form-control"/>
      <br />
    <label>Nombre del destinatario</label>
    <input type="text" name="des_nombre" id="des_nombre" class="form-control" />
    <label>Apellido del destinatario</label>
    <input type="text" name="des_apellido" id="des_apellido" class="form-control" />
    <label>Cedula del destinatario</label>
    <input type="text" name="des_cedula" id="des_cedula" class="form-control" />
    <label>Telefono del destinatario</label>
    <input type="text" name="tel_numero" id="tel_numero" class="form-control" />
    <br />  
    
     
    </div> -->
    <div class="modal-footer">
     <input type="hidden" name="en_clave" id="en_clave" />
      <input type="hidden" name="fk_sucursal_cliente_1" id="fk_sucursal_cliente_1" />
       <input type="hidden" name="fk_flota_ruta_3" id="fk_flota_ruta_3" />
        <input type="hidden" name="fk_flota_ruta_4" id="fk_flota_ruta_4" />
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
      /*          processing: true,
                serverSide: true,
                ajax: '<?php echo route('envio_getData'); ?>',
                columns: [
                    { data: 'en_clave', name: 'envio.en_clave' },
                    { data: 'en_tipo', name: 'envio.en_tipo' },
                    { data: 'en_precio', name: 'envio.en_precio' },
                    { data: 'en_peso', name: 'envio.en_peso' },
                    { data: 'en_descripcion', name: 'envio.en_descripcion' },
                    { data: 'en_altura', name: 'envio.en_altura' },
                    { data: 'en_anchura', name: 'envio.en_anchura' },
                    { data: 'en_profundidad', name: 'envio.en_profundidad' },
                    { data: 'en_fecha_envio', name: 'envio.en_fecha_envio' },
                    { data: 'en_fecha_entrega_estimada', name: 'envio.en_fecha_entrega_estimada' },
                    { data: 'cli_cedula', name: 'cliente.cli_cedula' },
                    { data: 'des_cedula', name: 'destinatario.des_cedula' },
                    { data: 'fk_flota_ruta_1', name: 'envio.fk_flota_ruta_1' },
                    { data: 'su_nombre', name: 'sucursal.su_nombre' },
                    { data: 'fk_sucursal_destino', name: 'envio.fk_sucursal_destino' },
                    {data: 'action', name: 'action', orderable: false, searchable: false}
                ]*/
            })

         
            $(document).on('submit', '#user_form', function(event){
            event.preventDefault();
            var en_tipo = $('#en_tipo').val();
            var en_precio = $('#en_precio').val();
            var en_peso = $('#en_peso').val();
            var en_descripcion = $('#en_descripcion').val();
            var en_altura = $('#en_altura').val();
            var en_anchura = $('#en_anchura').val();
            var en_profundidad = $('#en_profundidad').val();
            var en_fecha_envio = $('#en_fecha_envio').val();
            var en_fecha_entrega_estimada = $('#en_fecha_entrega_estimada').val();
            var fk_sucursal_origen = $('#fk_sucursal_origen').val();
            var fk_sucursal_destino = $('#fk_sucursal_destino').val();
            var fk_cliente = $('#fk_cliente').val();
            var fk_flota_ruta_1 = $('#fk_flota_ruta_1').val();
            var des_nombre = $('#des_nombre').val();
            var des_apellido = $('#des_apellido').val();
            var des_cedula = $('#des_cedula').val();
            var tel_numero =$('#tel_numero').val();

            if(en_tipo != '' && en_precio!= '' && en_peso!= ''&& en_descripcion!= ''&& en_altura!= ''&& en_anchura!= ''&& en_profundidad!= ''
            && en_fecha_envio != ''&& en_fecha_entrega_estimada != '')
            {
              $.ajax({
                headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                url:"envio",
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
              alert("All Fields are Required");
            }
          });
          $(document).on('click', '.update', function(){
            var en_clave = $(this).attr("id");
            console.log(en_clave);
            $.ajax({
              headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
              url:"envio/getOne",
              method:"POST",
              data:{en_clave:en_clave}
              ,
              dataType:"json",
              success:function(data){
                $('#userModal').modal('show');
                $('#en_tipo').val(data.en_tipo);
                $('#en_precio').val(data.en_precio);
                $('#en_peso').val(data.en_peso);
                $('#en_descripcion').val(data.en_descripcion);
                $('#en_altura').val(data.en_altura);
                $('#en_anchura').val(data.en_anchura);
                $('#en_profundidad').val(data.en_profundidad);
                $('#en_fecha_envio').val(data.en_fecha_envio);
                $('#en_fecha_entrega_estimada').val(en_fecha_entrega_estimada);
                $('.modal-title').text("Edit envio");
                $('#en_clave').val(en_clave);
                $('#fk_sucursal_origen').val(data.fk_sucursal_origen); 
                $('#fk_cliente').val(data.fk_cliente);
                $('#fk_destinatario').val(data.fk_destinatario);
                $('#fk_flota_ruta_1').val(data.fk_flota_ruta_1);
                $('#fk_sucursal_destino').val(data.fk_sucursal_destino);
                $('#action').val("Edit");
                $('#operation').val("Edit");
              }
            })
          });
          $(document).on('click','.delete',function(){
            var en_clave = $(this).attr("id");
            
            if(confirm("¿Estás seguro de que quieres borrar esta información?")){
              $.ajax({
                headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                url:"envio/"+en_clave,
                type:"DELETE",
                data:{
                  en_clave:en_clave,
                },
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
              <div class="line-container">
                <div class="line">
                </div>
              </div>
              <div class="footer">
                Envíos UCAB, Rif: J-00274758-7, LogUCAB Venezuela todos los derechos reservados<br>
Diseñado y desarrollado por SSR Lerana C.A.

              </div>
        </div>
      </div>
    </body>
</html>
