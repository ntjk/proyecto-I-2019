<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link href="//netdna.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css" rel="stylesheet">
        <link rel="stylesheet" href="//cdn.datatables.net/1.10.7/css/jquery.dataTables.min.css">
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
        <meta name="csrf-token" content="{!! csrf_token() !!}" />
        <title>Cliente - LogUCAB</title>

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
                <a href="welcome"><img src={{ asset('img/logo.png')}} class="logo"></img></a>
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
            <h1 class="text-center">Clientes</h1>
            <br/>
            <button type="button" id="add_button" data-toggle="modal" data-target="#userModal" class="btn btn-info btn-lg">Add</button>
            <table class="table table-bordered" id="users-table">
                <thead>
                    <tr>
                        <th>Clave</th>
                        <th>Cédula</th>
                        <th>Nombre</th>
                        <th>Apellido</th>
                        <th>Estado Civil</th>
                        <th>Empresa de trabajo</th>
                        <th>Fecha de Nacimiento</th>
                        <th>VIP</th>
                        <th>Fk_Lugar</th>
                        <th>Nacionalidad</th>
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
     <h4 class="modal-title">Añadir Cliente</h4>
    </div>
    <div class="modal-body">
     <label>Cédula</label>
     <input type="text" name="cli_cedula" id="cli_cedula" class="form-control" />
     <br />
     <label>Nombre</label>
     <input type="text" name="cli_nombre" id="cli_nombre" class="form-control" />
     <br />
     <label>Apellido</label>
     <input type="text" name="cli_apellido" id="cli_apellido" class="form-control" />
     <br />
     <label>Estado Civil</label>
     <input type="text" name="cli_estado_civil" id="cli_estado_civil" class="form-control" />
     <br />
     <label>Empresa Trabajo</label>
     <input type="text" name="cli_empresa_trabajo" id="cli_empresa_trabajo" class="form-control" />
     <br />
     <label>Fecha de Nacimiento</label>
     <input type="text" name="cli_fecha_nacimiento" id="cli_fecha_nacimiento" class="form-control" />
     <br />
     <label>VIP</label>
     <input type="text" name="cli_vip" id="cli_vip" class="form-control" />
     <br />
     <label>Lugar</label>
     <input type="text" name="fk_lugar" id="fk_lugar" class="form-control" />
     <br />
     <label>Nacionalidad</label>
     <input type="text" name="cli_nacionalidad" id="cli_nacionalidad" class="form-control" />
     <br />
    </div>
    <div class="modal-footer">
     <input type="hidden" name="cli_clave" id="cli_clave" />
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
                ajax: '{!! route('cliente_getData') !!}',
                columns: [
                    { data: 'cli_clave', name: 'cli_clave' },
                    { data: 'cli_cedula', name: 'cli_cedula' },
                    { data: 'cli_nombre', name: 'cli_nombre' },
                    { data: 'cli_apellido', name: 'cli_apellido' },
                    { data: 'cli_estado_civil', name: 'cli_estado_civil' },
                    { data: 'cli_empresa_trabajo', name: 'cli_empresa_trabajo' },
                    { data: 'cli_fecha_nacimiento', name: 'cli_fecha_nacimiento' },
                    { data: 'cli_vip', name: 'cli_vip' },
                    { data: 'fk_lugar', name: 'fk_lugar' },
                    { data: 'cli_nacionalidad', name: 'cli_nacionalidad' },
                    {data: 'action', name: 'action', orderable: false, searchable: false}
                ]
            })

            $(document).on('submit', '#user_form', function(event){
            event.preventDefault();
            var cli_cedula = $('#cli_cedula').val();
            var cli_nombre = $('#cli_nombre').val();
            var cli_apellido = $('#cli_apellido').val();
            var cli_estado_civil = $('#cli_estado_civil').val();
            var cli_empresa_trabajo = $('#cli_empresa_trabajo').val();
            var cli_fecha_nacimiento = $('#cli_fecha_nacimiento').val();
            var cli_vip = $('#cli_vip').val();
            var fk_lugar = $('#fk_lugar').val();
            var cli_nacionalidad = $('#cli_nacionalidad').val();
            if(cli_cedula != '' && cli_nombre != '')
            {
              $.ajax({
                headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                url:"cliente",
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
            var cli_clave = $(this).attr("id");
            $.ajax({
              headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
              url:"cliente/getOne",
              method:"POST",
              data:{cli_clave:cli_clave},
              dataType:"json",
              success:function(data){
                $('#userModal').modal('show');
                $('#cli_cedula').val(data.cli_cedula);
                $('#cli_nombre').val(data.cli_nombre);
                $('#cli_apellido').val(data.cli_apellido);
                $('#cli_estado_civil').val(data.cli_estado_civil);
                $('#cli_empresa_trabajo').val(data.cli_empresa_trabajo);
                $('#cli_fecha_nacimiento').val(data.cli_fecha_nacimiento);
                $('#cli_vip').val(data.cli_vip);
                $('.modal-title').text("Edit cliente");
                $('#cli_clave').val(cli_clave);
                $('#fk_lugar').val(fk_lugar);
                $('#cli_nacionalidad').val(cli_nacionalidad);
                $('#action').val("Edit");
                $('#operation').val("Edit");
              }
            })
          });
          $(document).on('click','.delete',function(){
            var cli_clave = $(this).attr("id");
            if(confirm("¿Estás seguro de que quieres borrar esta información?")){
              $.ajax({
                headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                url:"cliente/"+cli_clave,
                type:"DELETE",
                data:{cli_clave:cli_clave},
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
        @stack('scripts')
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
