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
            @include('header')
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
                  @foreach ($envios as $envio)
                  <tr>
                    <td>{{$envio->en_clave}}</td>
                    <td>{{$envio->ti_nombre}}</td>
                    <td>{{$envio->en_precio}}</td>
                    <td>{{$envio->en_peso}}</td>
                    <td>{{$envio->en_descripcion}}</td>
                    <td>{{$envio->en_altura}}</td>
                    <td>{{$envio->en_anchura}}</td>
                    <td>{{$envio->en_profundidad}}</td>
                    <td>{{$envio->en_fecha_envio}}</td>
                    <td>{{$envio->en_fecha_entrega_estimada}}</td>
                    <td>{{$envio->cli_cedula}}</td>
                    <td>{{$envio->des_cedula}}</td>
                    <td>{{$envio->fk_flota_ruta_1}}</td>
                    <td>{{$envio->so_nombre}}</td>
                    <td>{{$envio->sd_nombre}}</td>
                    <td>
                      <button class="btn btn-warning btn-detail update" id="{{$envio->en_clave}}" value="{{$envio->en_clave}}" name="Update">Update</button>
                      <button class="btn btn-danger btn-delete delete" id="{{$envio->en_clave}}" value="{{$envio->en_clave}}" name="delete">Delete</button>
                    </td>
                  </tr>
                  @endforeach
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
     <input value={{$mesConMasEnvios}}> </input>
     <label>Tipo</label>
      <select name="fk_tipo" id="fk_tipo" class="form-control">
        @foreach($tipos as $tipo)
        <option value="{{$tipo->ti_clave}}" oninput="calcularPrecio()">{{$tipo->ti_nombre}}</option>
        @endforeach
      </select>
     <br />
     <label>Descripción</label>
     <input type="text" name="en_descripcion" id="en_descripcion" class="form-control" />
     <br />
     <label>Peso</label>
     <input type="number" step="0.01" name="en_peso" id="en_peso" class="form-control" oninput="calcularPrecio()"/>
     <br />
     <label>Altura</label>
     <input type="number" step="0.01" name="en_altura" id="en_altura" class="form-control" oninput="calcularPrecio()"/>
     <br />
     <label>Anchura</label>
     <input type="number" step="0.01" name="en_anchura" id="en_anchura" class="form-control" oninput="calcularPrecio()"/>
     <br />
     <label>Profundidad</label>
     <input type="number" step="0.01" name="en_profundidad" id="en_profundidad" class="form-control" oninput="calcularPrecio()"/>
     <br />
     <label>Precio</label>
     <input name="en_precio" id="en_precio" class="form-control"/>
        <script>
        function calcularPrecio() {
          var peso = document.getElementById("en_peso").value;
          if (peso >= 10){
            var alto = document.getElementById("en_altura").value;
            var ancho = document.getElementById("en_anchura").value;
            var profundo = document.getElementById("en_profundidad").value;
            var tipo = document.getElementById("fk_tipo").value;
            var precioTipo = Tipo::find(tipo);
            document.getElementById("en_precio").value = tipo+" "precioTipo+" "alto*ancho*profundo;
          }
          else{
            document.getElementById("en_precio").value = peso;
          }
          
        }
        </script>
     </br>
     <label>Fecha de envío</label>
     <input type="date" name="en_fecha_envio" id="en_fecha_envio" class="form-control" />
     <br />
     <label>Fecha de entrega estimada</label>
     <input type="date" name="en_fecha_entrega_estimada" id="en_fecha_entrega_estimada" class="form-control" />
     <br />
     <label>Sucursal origen</label>
     <select name="fk_sucursal_origen" id="fk_sucursal_origen" class="form-control">
        @foreach($sucursales as $sucursal)
        <option value="{{$sucursal->su_clave}}">{{$sucursal->su_nombre}}</option>
        @endforeach
      </select>
      <br />
     <label>Sucursal destino</label>
     <select name="fk_sucursal_destino" id="fk_sucursal_destino" class="form-control">
        @foreach($sucursales as $sucursal)
        <option value="{{$sucursal->su_clave}}">{{$sucursal->su_nombre}}</option>
        @endforeach
      </select>
     <br />
     <label>Cliente emisor</label>
     <select name="fk_cliente" id="fk_cliente" class="form-control">
        @foreach($clientes as $cliente)
        <option value="{{$cliente->cli_clave}}">{{$cliente->cli_nacionalidad}} {{$cliente->cli_cedula}}</option>
        @endforeach
      </select>
     <br />
     <label>Ruta (flota-ruta) </label>
      <select name="fk_flota_ruta_1" id="fk_flota_ruta_1" class="form-control">
        @foreach($florus as $flor)
        <option value="{{$flor->flo_ru_clave}}">{{$flor->flo_ru_clave}}</option>
        @endforeach
      </select>
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
    
     
    </div>
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
            })

         
            $(document).on('submit', '#user_form', function(event){
            event.preventDefault();
            var fk_tipo = $('#fk_tipo').val();
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

            if(fk_tipo != '' && en_precio!= '' && en_peso!= ''&& en_descripcion!= ''&& en_altura!= ''&& en_anchura!= ''&& en_profundidad!= ''
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
            $.ajax({
              headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
              url:"envio/getOne",
              method:"POST",
              data:{en_clave:en_clave}
              ,
              dataType:"json",
              success:function(data){
                $('#userModal').modal('show');
                $('#fk_tipo').val(data.fk_tipo);
                $('#en_precio').val(data.en_precio);
                $('#en_peso').val(data.en_peso);
                $('#en_descripcion').val(data.en_descripcion);
                $('#en_altura').val(data.en_altura);
                $('#en_anchura').val(data.en_anchura);
                $('#en_profundidad').val(data.en_profundidad);
                $('#en_fecha_envio').val(data.en_fecha_envio);
                $('#en_fecha_entrega_estimada').val(data.en_fecha_entrega_estimada);
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
        @stack('scripts')
        @include('footer')
              </div>
        </div>
      </div>
    </body>
</html>
