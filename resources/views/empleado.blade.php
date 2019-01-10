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
        <title>Empleado - LogUCAB</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet" type="text/css">
        <link href="https://fonts.googleapis.com/css?family=Abril+Fatface" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css?family=Lato" rel="stylesheet">
    </head>
    <body>
            @include('header')
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
                        <th id="hd1">Accion</th>
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

             //$('#hd1').hide();
            $('#users-table').DataTable({
                processing: true,
                serverSide: true,
                ajax: '{!! route('empleado_getData') !!}',
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
                    { data: 'em_nacionalidad', name: 'em_nacionalidad' }
                    ,
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
            if(em_nombre != '')
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
              alert("Falta campos por llenar");
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
          /*$(document).on('click', '.registro', function(){
            var em_clave = $(this).attr("id");
            var url = "{{url('/registro')}}" + em_clave;
            window.location.href = url;
            //alert(url);
          });*/

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
        @stack('scripts')
        @include('footer')
        </div>
      </div>
    </body>
</html>
