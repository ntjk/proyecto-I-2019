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
        <title>Laravel</title>

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
          .table-contaier{
            width:300px;
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
            <h1 class="text-center">Empleados</h1>
            <br/>
            <button type="button" id="add_button" data-toggle="modal" data-target="#userModal" class="btn btn-info btn-lg">Add</button>
            <div class="table-container">
            <table class="table table-bordered special-table" id="users-table">
                <thead>
                    <tr>
                        <th>Clave</th>
                        <th>Cedula</th>
                        <th>Nombre</th>
                        <th>Apellido</th>
                        <th>Profesion</th>
                        <th>Estado Civil</th>
                        <th>Salario Base</th>
                        <th>Email (Empresa)</th>
                        <th>Email (Personal)</th>
                        <th>Nivel Academico</th>
                        <th>Cant. Hijos</th>
                        <th>Descripcion</th>
                        <th>Fecha (Egreso)</th>
                        <th>Fecha (Ingreso)</th>
                        <th>Fecha (Nacimiento)</th>
                        <th>Parroquia</th>
                        <th>Nacionalidad</th>
                        <th>Accion</th>
                    </tr>
                </thead>
            </table>
          </div>
        </div>
        <div id="userModal" class="modal fade">
 <div class="modal-dialog">
  <form method="post" id="user_form" enctype="multipart/form-data">
   <div class="modal-content">
    <div class="modal-header">
     <button type="button" class="close" data-dismiss="modal">&times;</button>
     <h4 class="modal-title">Añadir Empleado</h4>
    </div>
    <div class="modal-body">
     <label>CI</label>
     <input type="text" name="em_cedula" id="em_cedula" class="form-control" />
     <br />
     <label>Nacionalidad</label>
     <select class="form-control" name="em_nacionalidad" id="em_nacionalidad">
       <option value="E">E</option>
       <option value="V">V</option>
     </select>
     <br />
     <label>Nombre</label>
     <input type="text" name="em_nombre" id="em_nombre" class="form-control" />
     <br />
     <label>Apellido</label>
     <input type="text" name="em_apellido" id="em_apellido" class="form-control" />
     <br />
     <label>Profesion</label>
     <input type="text" name="em_profesion" id="em_profesion" class="form-control" />
     <br />
     <label>Estado Civil</label>
     <select class="form-control" name="em_estado_civil" id="em_estado_civil">
       <option value="casado/a">casado/a</option>
       <option value="divorciado/a">divorciado/a</option>
       <option value="soltero/a">soltero/a</option>
       <option value="viudo/a">viudo/a</option>
       <option value="concubino/a">concubino/a</option>
     </select>
     <br />
     <label>Salario Base</label>
     <input type="number" step="0.01" name="em_salario_base" id="em_salario_base" class="form-control" />
     <br />
     <label>Email (Empresa)</label>
     <input type="text" name="em_email_empresa" id="em_email_empresa" class="form-control" />
     <br />
     <label>Email (Personal)</label>
     <input type="text" name="em_email_personal" id="em_email_personal" class="form-control" />
     <br />
     <label>Nivel Academico</label>
     <select class="form-control" name="em_nivel_academico" id="em_nivel_academico">
       <option value="primaria">primaria</option>
       <option value="bachillerato">bachillerato</option>
       <option value="técnico medio">técnico medio</option>
       <option value="técnico superior">técnico superior</option>
       <option value="universitario">universitario</option>
       <option value="postgrado">postgrado</option>
     </select>
     <br />
     <label>Cant. Hijos</label>
     <input type="number" name="em_cantidad_hijos" id="em_cantidad_hijos" class="form-control" />
     <br />
     <label>Descripcion</label>
     <input type="text" name="em_descripcion_trabajo" id="em_descripcion_trabajo" class="form-control" />
     <br />
     <label>Fecha (Ingreso)</label>
     <input type="date" name="em_fecha_ingreso" id="em_fecha_ingreso" class="form-control" />
     <br />
     <label>Fecha (Nacimiento)</label>
     <input type="date" name="em_fecha_nacimiento" id="em_fecha_nacimiento" class="form-control" />
     <br />
     <label>Estado</label>
     <select class="form-control" name="estado" id="estado">
        <?php $__currentLoopData = $estados; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $estado): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <option value="<?php echo e($estado->lu_clave); ?>"><?php echo e($estado->lu_nombre); ?></option>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
      </select>
      <br />
      <label>Municipio</label>
      <select class="form-control" name="municipio" id="municipio">
      </select>
      <br />
      <label>Parroquia</label>
      <select class="form-control" name="fk_lugar" id="fk_lugar">
      </select>
    </div>
    <div class="modal-footer">
     <input type="hidden" name="em_clave" id="em_clave" />
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
                ajax: '<?php echo route('empleado_getData'); ?>',
                columns: [
                    { data: 'em_clave', name: 'empleado.em_clave' },
                    { data: 'em_cedula', name: 'empleado.em_cedula' },
                    { data: 'em_nombre', name: 'empleado.em_nombre' },
                    { data: 'em_apellido', name: 'empleado.em_apellido' },
                    { data: 'em_profesion', name: 'empleado.em_profesion' },
                    { data: 'em_estado_civil', name: 'empleado.em_estado_civil' },
                    { data: 'em_salario_base', name: 'empleado.em_salario_base' },
                    { data: 'em_email_empresa', name: 'empleado.em_email_empresa' },
                    { data: 'em_email_personal', name: 'empleado.em_email_personal' },
                    { data: 'em_nivel_academico', name: 'empleado.em_nivel_academico' },
                    { data: 'em_cantidad_hijos', name: 'empleado.em_cantidad_hijos' },
                    { data: 'em_descripcion_trabajo', name: 'empleado.em_descripcion_trabajo' },
                    { data: 'em_fecha_egreso', name: 'empleado.em_fecha_egreso' },
                    { data: 'em_fecha_ingreso', name: 'empleado.em_fecha_ingreso' },
                    { data: 'em_fecha_nacimiento', name: 'empleado.em_fecha_nacimiento' },
                    { data: 'lu_nombre', name: 'lugar.lu_nombre' },
                    { data: 'em_nacionalidad', name: 'em_nacionalidad' },
                    {data: 'action', name: 'action', orderable: false, searchable: false}
                ]
            })
            $(document).on('change','#estado',function(){
              var estado = $(this).val();
              $.ajax({
                headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                type: "POST",
                url: "empleado/updateSelect",
                data:{ estado: estado},
                success: function(data){
                    var options = '';
                    $.each(data, function(i, item) {
                      options += '<option value="' + item.lu_clave + '">' + item.lu_nombre + '</option>';
                    });
                    $('#municipio').empty().html(options);
                }
              });
            });
            $(document).on('change','#municipio',function(){
              var municipio = $(this).val();
              $.ajax({
                headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                type: "POST",
                url: "empleado/updateSelect2",
                data:{ municipio: municipio},
                success: function(data){
                    var options = '';
                    $.each(data, function(i, item) {
                      options += '<option value="' + item.lu_clave + '">' + item.lu_nombre + '</option>';
                    });
                    $('#fk_lugar').empty().html(options);
                }
              });
            });

            $(document).on('submit', '#user_form', function(event){
            event.preventDefault();
            var em_cedula = $('#em_cedula').val();
            var em_nacionalidad = $('#em_nacionalidad').val();
            var em_nombre = $('#em_nombre').val();
            var em_apellido = $('#em_apellido').val();
            var em_profesion = $('#em_profesion').val();
            var em_estado_civil = $('#em_estado_civil').val();
            var em_salario_base = $('#em_salario_base').val();
            var em_email_empresa = $('#em_email_empresa').val();
            var em_email_personal = $('#em_email_personal').val();
            var em_nivel_academico = $('#em_nivel_academico').val();
            var em_cantidad_hijos = $('#em_cantidad_hijos').val();
            var em_descripcion_trabajo = $('#em_descripcion_trabajo').val();
            var em_fecha_ingreso = $('#em_fecha_ingreso').val();
            var em_fecha_nacimiento = $('#em_fecha_nacimiento').val();
            var em_clave = $('#em_clave').val();
            var fk_lugar = $('#fk_lugar').val();
            if(em_nombre != '' && em_email_empresa != '' && em_cedula != '' && em_nacionalidad != '' && em_apellido != '' && em_profesion != '' && em_estado_civil != '' && em_salario_base != '' && em_email_personal != '' && em_nivel_academico != '' && em_cantidad_hijos != '' && em_fecha_ingreso != '' && em_fecha_nacimiento)
            {
              $.ajax({
                headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                url:"empleado",
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
              alert("Required Fields are not Filled.");
            }
          });
          $(document).on('click', '.update', function(){
            var em_clave = $(this).attr("id");
            $.ajax({
              headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
              url:"empleado/getOne",
              method:"POST",
              data:{em_clave:em_clave},
              dataType:"json",
              success:function(data){
                $('#userModal').modal('show');
                $('#em_cedula').val(data.em_cedula);
                $('#em_nacionalidad').val(data.em_nacionalidad);
                $('#em_nombre').val(data.em_nombre);
                $('.modal-title').text("Edit Empleado");
                $('#em_apellido').val(data.em_apellido);
                $('#em_profesion').val(data.em_profesion);
                $('#em_estado_civil').val(data.em_estado_civil);
                $('#em_salario_base').val(data.em_salario_base);
                $('#em_email_empresa').val(data.em_email_empresa);
                $('#em_email_personal').val(data.em_email_personal);
                $('#em_nivel_academico').val(data.em_nivel_academico);
                $('#em_cantidad_hijos').val(data.em_cantidad_hijos);
                $('#em_descripcion_trabajo').val(data.em_descripcion_trabajo);
                $('#em_fecha_ingreso').val(data.em_fecha_ingreso);
                $('#em_fecha_nacimiento').val(data.em_fecha_nacimiento);
                $('#em_clave').val(em_clave);
                $('#fk_lugar').val(data.fk_lugar);
                $('#action').val("Edit");
                $('#operation').val("Edit");
              }
            })
          });
          $(document).on('click','.delete',function(){
            var em_clave = $(this).attr("id");
            if(confirm("¿Estás seguro de que quieres borrar esta información?")){
              $.ajax({
                headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                url:"empleado/"+em_clave,
                type:"DELETE",
                data:{em_clave:em_clave},
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
