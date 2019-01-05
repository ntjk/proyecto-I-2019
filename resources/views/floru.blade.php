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
            <h1 class="text-center">Rutas</h1>
            <br/>
            <button type="button" id="add_button" data-toggle="modal" data-target="#userModal" class="btn btn-info btn-lg">Add</button>
            <table class="table table-bordered" id="users-table">
                <thead>
                    <tr>
                        <th>Clave</th>
                        <th>Sucursal origen</th>
                        <th>Sucursal destino</th>
                        <th>Sucursales de parada</th>
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
        @foreach($sucursales as $sucursal)
        <option value="{{$sucursal->su_clave}}">{{$sucursal->su_nombre}}</option>
        @endforeach
      </select>
     <br /> 
      <label>Nodo 1 (Sucursal intermedia)</label>
      <select class="form-control" name="fk_sucursal_1" id="fk_sucursal_1">
        @foreach($sucursales as $sucursal)
        <option value="{{$sucursal->su_clave}}">{{$sucursal->su_nombre}}</option>
        @endforeach
      </select>
      <label>Medio de transporte :: origen - nodo 1</label>
      <select class="form-control" name="fk_sucursal_1" id="fk_sucursal_1">
        <option value="1">Marítimo</option>
        <option value="2">Aéreo</option>
        <option value="7">Terrestre</option>
      </select> 
      <label>Precio :: origen - nodo 1</label>
      <input type="number" step="0.01" name="flo_ru_precio" id="en_precio" class="form-control"/>
      <label>Duración en horas :: origen - nodo 1</label>
      <input type="number" step="0.01" name="en_peso" id="en_peso" class="form-control" />
     <br />
      <label>Nodo 2 (Sucursal intermedia)</label>
      <select class="form-control" name="fk_sucursal_1" id="fk_sucursal_1">
        @foreach($sucursales as $sucursal)
        <option value="{{$sucursal->su_clave}}">{{$sucursal->su_nombre}}</option>
        @endforeach
      </select>
      <label>Medio de transporte: nodo1 - nodo 2</label>
      <select class="form-control" name="fk_sucursal_1" id="fk_sucursal_1">
        <option value="1">Marítimo</option>
        <option value="2">Aéreo</option>
        <option value="7">Terrestre</option>
      </select>
     <br />
      <label>Sucursal Destino</label>
      <select class="form-control" name="fk_sucursal_2" id="fk_sucursal_2">
         @foreach($sucursales as $sucursal)
         <option value="{{$sucursal->su_clave}}">{{$sucursal->su_nombre}}</option>
         @endforeach
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
                ajax: '{!! route('ruta_getData') !!}',
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
