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
        <link href="{{ asset('css/styles.css') }}" rel="stylesheet">
        <script type="text/javascript" src="{{ asset('js/dropdown.js') }}"></script>
        <title>Cliente - LogUCAB</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet" type="text/css">
        <link href="https://fonts.googleapis.com/css?family=Abril+Fatface" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css?family=Lato" rel="stylesheet">
    </head>
    <body>
            @include('header')
            <div class="container">
            <br/>
            <h1 class="text-center">Clientes</h1>
            <br/>
            <button type="button" id="add_button" data-toggle="modal" data-target="#userModal" class="btn btn-info btn-lg">Add</button>
            <table class="table table-bordered" id="users-table">
                <thead>
                    <tr>
                        <th>Nacionalidad</th>
                        <th>Cédula</th>
                        <th>Nombre</th>
                        <th>Apellido</th>
                        <th>Estado Civil</th>
                        <th>Empresa de trabajo</th>
                        <th>Fecha de Nacimiento</th>
                        <th>VIP</th>
                        <th>Fk_Lugar</th>
                        <th id="hidden2" name="hd1">Accion</th>
                    </tr>
                </thead>
                <tbody>
                  @foreach ($cliente as $c)
                  <tr>
                    <td>{{$c->cli_nacionalidad}}</td>
                    <td>{{$c->cli_cedula}}</td>
                    <td>{{$c->cli_nombre}}</td>
                    <td>{{$c->cli_apellido}}</td>
                    <td>{{$c->cli_estado_civil}}</td>
                    <td>{{$c->cli_empresa_trabajo}}</td>
                    <td>{{$c->cli_fecha_nacimiento}}</td>
                    <td>{{$c->cli_vip}}</td>
                    <td>{{$c->lu_nombre}}</td>
                    <td name="hidden3">
                    <button class="btn btn-warning btn-detail update" id="{{$c->cli_clave}}" value="{{$c->cli_clave}}" name="Update">Update</button>
                    <button class="btn btn-danger btn-delete delete" id="{{$c->cli_clave}}" value="{{$c->cli_clave}}" name="delete">Delete</button>
                    <button class="btn btn-info btn-detail carnet" id="{{$c->cli_clave}}" value="{{$c->cli_clave}}" onclick="navigate(this,'{{$c->cli_clave}}')" name="Carnet">Carnet</button>
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
     <select class="form-control" name="cli_estado_civil" id="cli_estado_civil">
       <option value="casado/a">casado/a</option>
       <option value="divorciado/a">divorciado/a</option>
       <option value="soltero/a">soltero/a</option>
       <option value="viudo/a">viudo/a</option>
       <option value="concubino/a">concubino/a</option>
     </select>
     <br />
     <label>Empresa Trabajo</label>
     <input type="text" name="cli_empresa_trabajo" id="cli_empresa_trabajo" class="form-control" />
     <br />
     <label>Fecha de Nacimiento</label>
     <input type="date" name="cli_fecha_nacimiento" id="cli_fecha_nacimiento" class="form-control" />
     <br />
     <label>VIP</label>
     <select class="form-control" name="cli_vip" id="cli_vip">
     <option value="true">Sí</option>
     <option value="false">No</option>
     </select>
     <br />
     <label>Estado</label>
     <select class="form-control" name="estado" id="estado">
        @foreach($estados as $estado)
        <option value="{{$estado->lu_clave}}">{{$estado->lu_nombre}}</option>
        @endforeach
      </select>
      <br />
      <label>Municipio</label>
      <select class="form-control" name="municipio" id="municipio">
      </select>
      <br />
      <label>Parroquia</label>
      <select class="form-control" name="fk_lugar" id="fk_lugar">
      </select>
     <br />
     <label>Nacionalidad</label>
     <select class="form-control" name="cli_nacionalidad" id="cli_nacionalidad">
     <option value="E">E</option>
     <option value="V">V</option>
     </select>
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
<script>

function navigate(link, inputid){
  //alert(document.getElementById(inputid).value)
  var url = "{{url('/cliente')}}" + document.getElementById(inputid).value;
  window.location.href = url; //navigates to the given url, disabled for demo
  //alert(url);
}
</script>
        <script src="//code.jquery.com/jquery.js"></script>
        <script src="//cdn.datatables.net/1.10.7/js/jquery.dataTables.min.js"></script>
        <script src="//netdna.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>
        <script>$(function() {
         // input[name=parametro] El if iria aca y ni modo, repetir la funcion gigante esta que llama las columnas, una sin el boton y otra con.
           /* $('[name="hd1"]').hide();
            $('[name="delete"]').hide();
            $('[name="Update"]').hide();*/
           // $(".delete").hide();

            $('#users-table').DataTable({
            })

            $(".delete").hide();
            $(".update").hide();
            $('#add_button').hide();
            $('#hidden2').hide();
            $('#hidden3').hide();

            var eliminar = '{!! verificarPermisosHelper("eliminar clientes"); !!}';
            var modificar = '{!! verificarPermisosHelper("modificar clientes"); !!}';
            var insertar = '{!! verificarPermisosHelper("insertar clientes"); !!}';

            if(eliminar || modificar){
              $('#hidden2').show();
              $('#hidden3').show();
            }
            if(eliminar)
              $(".delete").show();
            if(modificar)
              $(".update").show();
            if(insertar)
              $('#add_button').show();


            $(document).on('change','#estado',function(){
              var estado = $(this).val();
              $.ajax({
                headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                type: "POST",
                url: "cliente/updateSelect",
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
                url: "cliente/updateSelect2",
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
            var cli_cedula = $('#cli_cedula').val();
            var cli_nombre = $('#cli_nombre').val();
            var cli_apellido = $('#cli_apellido').val();
            var cli_estado_civil = $('#cli_estado_civil').val();
            var cli_empresa_trabajo = $('#cli_empresa_trabajo').val();
            var cli_fecha_nacimiento = $('#cli_fecha_nacimiento').val();
            var cli_vip = $('#cli_vip').val();
            var fk_lugar = $('#fk_lugar').val();
            var cli_nacionalidad = $('#cli_nacionalidad').val();
            if(cli_cedula != '' && cli_nombre != '' && cli_apellido != '' && cli_estado_civil != '' && cli_empresa_trabajo != '' && cli_fecha_nacimiento != '' && cli_vip != '' && fk_lugar != '' && cli_nacionalidad != '' )
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
        @include('footer')
        </div>
      </div>
    </body>
</html>
