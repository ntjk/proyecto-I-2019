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
        <title>Asistencias - LogUCAB</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet" type="text/css">
        <link href="https://fonts.googleapis.com/css?family=Abril+Fatface" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css?family=Lato" rel="stylesheet">
    </head>
    <body>
            @include('header')
            <div class="container">
            <br/>
            <h1 class="text-center">Registro de asistencia</h1>
            <br/>
            <button type="button" id="add_button" data-toggle="modal" data-target="#userModal" class="btn btn-info btn-lg">Add</button>
            <table class="table table-bordered" id="users-table">
                <thead>
                    <tr>
                      <th>Fecha</th>
                      <th>Sucursal</th>
                      <th>Zona</th>
                      <th>Empleado</th>
                      <th>Cedula</th>
                      <th>Dia</th>
                      <th>Hora de entrada</th>
                      <th>Hora de salida</th>
                      <th>Check</th>
		                  <th>Acción</th>
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
    <h4 class="modal-title">Añadir asistencia</h4>
    </div>
    <div class="modal-body">
     <br />
     <label>Fecha</label>
     <input type="date" name="a_fecha" id="a_fecha" class="form-control"/>
     <br />
     <label>Empleado</label>
     <select class="form-control" name="empleado" id="empleado">
      @foreach($empleados as $empleado)
        <option value="{{$empleado->em_clave}}">{{$empleado->em_nombre}} {{$empleado->em_nacionalidad}} {{$empleado->em_cedula}}</option>
      @endforeach
     </select>
     <br />
     <label>Puesto de trabajo y horario</label>
     <select class="form-control" name="fk_zo_em_ho_5" id="fk_zo_em_ho_5">
     </select>
     <br/>
     <label>Asistió</label>
     <br />
        <input type="radio" name="a_check" id="a_check" class="param"> Sí
     <br />
    </div>
    <div class="modal-footer">
     <input type="hidden" name="a_clave" id="a_clave" />
     <input type="hidden" name="operation" id="operation" />
     <input type="submit" name="action" id="action" class="btn btn-success" value="Add"/>
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
                ajax: '{!! route('asistencia_getData') !!}',
                columns: [
                    { data: 'a_fecha', name: 'asistencia.a_fecha' },
                    { data: 'su_nombre', name: 'sucursal.su_nombre' },
                    { data: 'fk_zona_empleado_2', name: 'zona_empleado_horario.fk_zona_empleado_2' },
                    { data: 'em_nombre', name: 'empleado.em_nombre' },
                    { data: 'em_cedula', name: 'empleado.em_cedula' },
                    { data: 'ho_dia' , name: 'horario.ho_dia' },
                    { data: 'ho_hora_entrada' , name: 'horario.ho_hora_entrada' },
                    { data: 'ho_hora_salida' , name: 'horario.ho_hora_salida' },
                    { data: 'a_check', name: 'asistencia.a_check' },
                    { data: 'action', name: 'action', orderable: false, searchable: false}
                ]
            })

            $(document).on('submit', '#user_form', function(event){
            event.preventDefault();
            var a_fecha = $('#a_fecha').val();
            var fk_zo_em_ho_5 = $('#fk_zo_em_ho_5').val();
            if ($("input[name=a_check]:checked"))
              $('#a_check').val("x");
            else
              $('#a_check').val(null);
            console.log(a_fecha);
            console.log(fk_zo_em_ho_5);
            console.log(a_check);
            if(a_fecha != '' && fk_zo_em_ho_5 != '')
            {
              $.ajax({
                headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                url:"asistencia",
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


          $(document).on('change','#empleado',function(){
              var empleado = $(this).val();
              $.ajax({
                headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                type: "POST",
                url: "asistencia/updateSelect",
                data:{empleado:empleado},
                success: function(data){
                    var options = '';
                    $.each(data, function(i, item) {
                      options += '<option value="' + item.zo_em_ho_clave + '">' + "Zona " + item.fk_zona_empleado_2 + " de la sucursal " + item.su_nombre + " los " + item.ho_dia + " de " + item.ho_hora_entrada + " a " + item.ho_hora_salida + '</option>';
                    });
                    $('#fk_zo_em_ho_5').empty().html(options);
                }
              });
            });
  
          $(document).on('click', '.update', function(){
            var a_clave = $(this).attr("id");
            if ($("input[name=a_check]:checked"))
              var a_check = "x";
            else
              var a_check = null;
            $.ajax({
              headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
              url:"asistencia/getOne",
              method:"POST",
              data:{a_clave:a_clave,
                  a_check:a_check},
              dataType:"json",
              success:function(data){
                $('#userModal').modal('show');
                $('#a_fecha').val(data.a_fecha);
                $('#fk_zo_em_ho_5').val(data.fk_zo_em_ho_5);
                $('#a_check').val(a_check);
                $('#a_clave').val(a_clave);
                $('.modal-title').text("Edit Asistencia");
                $('#action').val("Edit");
                $('#operation').val("Edit");
              }
            })
          });
          $(document).on('click','.delete',function(){
            var a_clave = $(this).attr("id");
            if(confirm("¿Estás seguro de que quieres borrar esta información?")){
              $.ajax({
                headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                url:"asistencia/"+a_clave,
                type:"DELETE",
                data:{a_clave:a_clave},
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