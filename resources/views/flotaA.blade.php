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
        <title>Transporte - LogUCAB</title>

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
            <h1 class="text-center">Transportes Aereos</h1>
            <br/>
            <button type="button" id="add_button" data-toggle="modal" data-target="#userModal" class="btn btn-info btn-lg">Add</button>
            <table class="table table-bordered" id="users-table">
                <thead>
                    <tr>
                        <th>Clave</th>
                        <th>Suptipo</th>
                        <th>Tipo</th>
                        <th>Peso</th>
                        <th>Placa</th>
                        <th>Descripción</th>
                        <th>Combustible por hora</th>
                        <th>Serial de carroceria</th>
                        <th>Capacidad de carga</th>
                        <th>Modelo</th>
                        <th>Sucursal</th>
                        <th>Año</th>
                        <th>Longitud</th>
                        <th>Envergadura</th>
                        <th>Área</th>
                        <th>Altura</th>
                        <th>Ancho de cabina interna</th>
                        <th>Diámetro de fusilaje</th>
                        <th>Peso vacío</th>
                        <th>Peso máximo de despegue</th>
                        <th>Carrera de despegue</th>
                        <th>Velocidad máxima</th>
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
     <h4 class="modal-title">Añadir Flota</h4>
    </div>
    <div class="modal-body">
     <label>Subtipo</label>
     <select class="form-control" name="flo_subtipo" id="flo_subtipo">
       <option value="aerea" selected>aerea</option>
    <!--  <option value="marítima">marítima</option>
       <option value="terrestre">terrestre</option>-->
     </select>
     <br />
     <label>Tipo</label>
     <input type="text" name="flo_tipo" id="flo_tipo" class="form-control" />
     <br />
     <label>Peso</label>
     <input type="number" step="0.01" name="flo_peso" id="flo_peso" class="form-control" />
     <br />
     <label>Placa</label>
     <input type="text" name="flo_placa" id="flo_placa" class="form-control" />
     <br />
     <label>Descripción</label>
     <input type="text" name="flo_descripcion" id="flo_descripcion" class="form-control" />
     <br />
     <label>Combustible por hora</label>
     <input type="number" step="0.01" name="flo_combustible_por_hora" id="flo_combustible_por_hora" class="form-control" />
     <br />
     <label>Serial de carroceria</label>
     <input type="text" name="flo_serial_carroceria" id="flo_serial_carroceria" class="form-control" />
     <br />
     <label>Capacidad de carga</label>
     <input type="number" step="0.01" name="flo_capacidad_carga" id="flo_capacidad_carga" class="form-control" />
     <br />
     <label>Modelo</label>
     <select class="form-control" name="fk_modelo" id="fk_modelo">
        @foreach($modelos as $modelo)
        <option value="{{$modelo->mod_clave}}">{{$modelo->mod_nombre}}</option>
        @endforeach
      </select>
     <label>Sucursal Base</label>
     <select class="form-control" name="fk_sucursal" id="fk_sucursal">
        @foreach($sucursales as $sucursal)
        <option value="{{$sucursal->su_clave}}">{{$sucursal->su_nombre}}</option>
        @endforeach
      </select>
     <br />
     <label>Año</label>
     <input type="text" name="flo_año" id="flo_año" class="form-control" />
     <br />
     <label>Longitud</label>
     <input type="number" step="0.01" name="flo_a_longitud" id="flo_a_longitud" class="form-control" />
     <br />
     <label>Envergadura</label>
     <input type="number" step="0.01" name="flo_a_envergadura" id="flo_a_envergadura" class="form-control" />
     <br />
     <label>Area</label>
     <input type="number" step="0.01" name="flo_a_area" id="flo_a_area" class="form-control" />
     <br />
     <label>Altura</label>
     <input type="number" step="0.01" name="flo_a_altura" id="flo_a_altura" class="form-control" />
     <br />
     <label>Ancho Cabina Interna</label>
     <input type="number" step="0.01" name="flo_a_ancho_cabina_interna" id="flo_a_ancho_cabina_interna" class="form-control" />
     <br />
     <label>Diametro de Fuselaje</label>
     <input type="number" step="0.01" name="flo_a_diametro_fuselaje" id="flo_a_diametro_fuselaje" class="form-control" />
     <br />
     <label>Peso Vacio</label>
     <input type="number" step="0.01" name="flo_a_peso_vacio" id="flo_a_peso_vacio" class="form-control" />
     <br />
     <label>Peso Maximo Despegue</label>
     <input type="number" step="0.01" name="flo_a_peso_maximo_despegue" id="flo_a_peso_maximo_despegue" class="form-control" />
     <br />
     <label>Carrera de Despegue</label>
     <input type="number" step="0.01" name="flo_a_carrera_de_despegue" id="flo_a_carrera_de_despegue" class="form-control" />
     <br />
     <label>Velocidad de Despegue</label>
     <input type="number" step="0.01" name="flo_a_velocidad_maxima" id="flo_a_velocidad_maxima" class="form-control" />
     <br />

    </div>
    <div class="modal-footer">
     <input type="hidden" name="flo_clave" id="flo_clave" />
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
                ajax: '{!! route('transporteA_getData') !!}',
                columns: [
                    { data: 'flo_clave', name: 'flota.flo_clave' },
                    { data: 'flo_subtipo', name: 'flota.flo_subtipo' },
                    { data: 'flo_tipo', name: 'flota.flo_tipo' },
                    { data: 'flo_peso', name: 'flota.flo_peso' },
                    { data: 'flo_placa', name: 'flota.flo_placa' },
                    { data: 'flo_descripcion', name: 'flota.flo_descripcion' },
                    { data: 'flo_combustible_por_hora', name: 'flota.flo_combustible_por_hora' },
                    { data: 'flo_serial_carroceria', name: 'flota.flo_serial_carroceria' },
                    { data: 'flo_capacidad_carga', name: 'flota.flo_capacidad_carga' },
                    { data: 'mod_nombre', name: 'modelo.mod_nombre' },
                    { data: 'su_nombre', name: 'sucursal.su_nombre' },
                    { data: 'flo_año', name: 'flota.flo_año' },
                    { data: 'flo_a_longitud', name: 'flota.flo_a_longitud' },
                    { data: 'flo_a_envergadura', name: 'flota.flo_a_envergadura' },
                    { data: 'flo_a_area', name: 'flota.flo_a_area' },
                    { data: 'flo_a_altura', name: 'flota.flo_a_altura' },
                    { data: 'flo_a_ancho_cabina_interna', name: 'flota.flo_a_ancho_cabina_interna' },
                    { data: 'flo_a_diametro_fuselaje', name: 'flota.flo_a_diametro_fuselaje' },
                    { data: 'flo_a_peso_vacio', name: 'flota.flo_a_peso_vacio' },
                    { data: 'flo_a_peso_maximo_despegue', name: 'flota.flo_a_peso_maximo_despegue' },
                    { data: 'flo_a_carrera_de_despegue', name: 'flota.flo_a_carrera_de_despegue' },
                    { data: 'flo_a_velocidad_maxima', name: 'flota.flo_a_velocidad_maxima' },
                    {data: 'action', name: 'action', orderable: false, searchable: false}
                ]
            })

            $(document).on('submit', '#user_form', function(event){
            event.preventDefault();
            var flo_subtipo = $('#flo_subtipo').val();
            var flo_tipo = $('#flo_tipo').val();
            var flo_peso = $('#flo_peso').val();
            var flo_placa = $('#flo_placa').val();
            var flo_descripcion = $('#flo_descripcion').val();
            var flo_combustible_por_hora = $('#flo_combustible_por_hora').val();
            var flo_serial_carroceria = $('#flo_serial_carroceria').val();
            var flo_capacidad_carga = $('#flo_capacidad_carga').val();
            var fk_modelo = $('#fk_modelo').val();
            var fk_sucursal = $('#fk_sucursal').val();
            var flo_año = $('#flo_año').val();
            var flo_a_longitud = $('#flo_a_longitud').val();
            var flo_a_envergadura = $('#flo_a_envergadura').val();
            var flo_a_area = $('#flo_a_area').val();
            var flo_a_altura = $('#flo_a_altura').val();
            var flo_a_ancho_cabina_interna = $('#flo_a_ancho_cabina_interna').val();
            var flo_a_diametro_fuselaje = $('#flo_a_diametro_fuselaje').val();
            var flo_a_peso_vacio = $('#flo_a_peso_vacio').val();
            var flo_a_peso_maximo_despegue = $('#flo_a_peso_maximo_despegue').val();
            var flo_a_carrera_de_despegue = $('#flo_a_carrera_de_despegue').val();
            var flo_a_velocidad_maxima = $('#flo_a_velocidad_maxima').val();
            if(flo_subtipo != '' && flo_tipo != '')
            {
              $.ajax({
                headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                url:"transporteA",
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
            var flo_clave = $(this).attr("id");
            $.ajax({
              headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
              url:"transporteA/getOne",
              method:"POST",
              data:{flo_clave:flo_clave},
              dataType:"json",
              success:function(data){
                $('#userModal').modal('show');
                $('#flo_subtipo').val(data.flo_subtipo);
                $('#flo_tipo').val(data.flo_tipo);
                $('#flo_peso').val(data.flo_peso);
                $('#flo_placa').val(data.flo_placa);
                $('#flo_descripcion').val(data.flo_descripcion);
                $('#flo_combustible_por_hora').val(data.flo_combustible_por_hora);
                $('#flo_serial_carroceria').val(data.flo_serial_carroceria);
                $('#flo_capacidad_carga').val(data.flo_capacidad_carga);
                $('#flo_año').val(data.flo_año);
                $('#flo_a_longitud').val(data.flo_a_longitud);
                $('#flo_a_envergadura').val(data.flo_a_envergadura);
                $('#flo_a_area').val(data.flo_a_area);
                $('#flo_a_altura').val(data.flo_a_altura);
                $('#flo_a_ancho_cabina_interna').val(data.flo_a_ancho_cabina_interna);
                $('#flo_a_diametro_fuselaje').val(data.flo_a_diametro_fuselaje);
                $('#flo_a_peso_vacio').val(data.flo_a_peso_vacio);
                $('#flo_a_peso_maximo_despegue').val(data.flo_a_peso_maximo_despegue);
                $('#flo_a_carrera_de_despegue').val(data.flo_a_carrera_de_despegue);
                $('#flo_a_velocidad_maxima').val(data.flo_a_velocidad_maxima);
                $('.modal-title').text("Edit Flota");
                $('#flo_clave').val(flo_clave);
                $('#fk_modelo').val(fk_modelo);
                $('#fk_sucursal').val(fk_sucursal);
                $('#action').val("Edit");
                $('#operation').val("Edit");
              }
            })
          });
          $(document).on('click','.delete',function(){
            var flo_clave = $(this).attr("id");
            if(confirm("¿Estás seguro de que quieres borrar esta información?")){
              $.ajax({
                headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                url:"transporteA/"+flo_clave,
                type:"DELETE",
                data:{flo_clave:flo_clave},
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
