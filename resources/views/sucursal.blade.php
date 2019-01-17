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
        <title>Sucursal - LogUCAB</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet" type="text/css">
        <link href="https://fonts.googleapis.com/css?family=Abril+Fatface" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css?family=Lato" rel="stylesheet">
    </head>
    <body>
            @include('header')
            <div class="container">
            <br/>
            <h1 class="text-center">Sucursales</h1>
            <br/>
            <button type="button" id="add_button" data-toggle="modal" data-target="#userModal" class="btn btn-info btn-lg">Add</button>
            <table class="table table-bordered" id="users-table">
                <thead>
                    <tr>
                        <th>Clave</th>
                        <th>Nombre</th>
                        <th>Email</th>
                        <th>Capacidad</th>>
                        <th>Lugar</th>
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
     <h4 class="modal-title">Añadir Sucursal</h4>
    </div>
    <div class="modal-body">
     <label>Nombre</label>
     <input type="text" name="su_nombre" id="su_nombre" class="form-control"/>
     <br />
     <label>Email</label>
     <input type="text" name="su_email" id="su_email" class="form-control" />
     <br />
     <label>Capacidad</label>
     <input type="number" step="0.01" name="su_capacidad" id="su_capacidad" class="form-control" />
     <br />
     <label>Estado</label>
     <select class="form-control" name="estado" id="estado">
        @foreach($estados as $estado)<!-- Busca de cada estado, el nombre, busca de cada
        Para usar variables del controlador usar llave para que lo lea, value es como un id-->
        <option value="{{$estado->lu_clave}}">{{$estado->lu_nombre}}</option>
        @endforeach
      </select>
      <br />
      <label>Municipio</label>
      <select class="form-control" name="fk_lugar" id="fk_lugar">
      </select>
    </div>
    <div class="modal-footer">
     <input type="hidden" name="su_clave" id="su_clave" />
     <input type="hidden" name="operation" id="operation" />
     <input type="submit" name="action" id="action" class="btn btn-success" value="Add"/>
     <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
    </div>
   </div>
  </form>
 </div>
</div>
<script>

function navigate(link, inputid){
  //alert(document.getElementById(inputid).value)
  var url = "{{url('/sucursal')}}" + document.getElementById(inputid).value + '-0-0-0';
  window.location.href = url; //navigates to the given url, disabled for demo
  //alert(url);
}
</script>
        <script src="//code.jquery.com/jquery.js"></script>
        <script src="//cdn.datatables.net/1.10.7/js/jquery.dataTables.min.js"></script>
        <script src="//netdna.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>
        <script>$(function() {
            $('#users-table').DataTable({
                processing: true,
                serverSide: true,
                ajax: '{!! route('sucursal_getData') !!}',
                columns: [
                    { data: 'su_clave', name: 'sucursal.su_clave' },
                    { data: 'su_nombre', name: 'sucursal.su_nombre' },
                    { data: 'su_email', name: 'sucursal.su_email' },
                    { data: 'su_capacidad', name: 'sucursal.su_capacidad' },
                    { data: 'lu_nombre', name: 'lugar.lu_nombre' },
                    {data: 'action', name: 'action', orderable: false, searchable: false}
                ]
            })
            $(document).on('change','#estado',function(){
              var estado = $(this).val();
              $.ajax({
                headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                type: "POST",
                url: "sucursal/updateSelect",
                data:{ estado: estado},
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
            var su_nombre = $('#su_nombre').val();
            var su_email = $('#su_email').val();
            var su_capacidad = $('#su_capacidad').val();
            var fk_lugar = $('#fk_lugar').val();
            if(su_nombre != '' && su_email != '')
            {
              $.ajax({
                headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                url:"sucursal",
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
            var su_clave = $(this).attr("id");
            $.ajax({
              headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
              url:"sucursal/getOne",
              method:"POST",
              data:{su_clave:su_clave},
              dataType:"json",
              success:function(data){
                $('#userModal').modal('show');
                $('#su_nombre').val(data.su_nombre);
                $('#su_email').val(data.su_email);
                $('#su_capacidad').val(data.su_capacidad);
                $('.modal-title').text("Edit Sucursal");
                $('#su_clave').val(su_clave);
                $('#fk_lugar').val(data.fk_lugar);
                $('#action').val("Edit");
                $('#operation').val("Edit");
              }
            })
          });
          $(document).on('click','.delete',function(){
            var su_clave = $(this).attr("id");
            console.log(su_clave);
            if(confirm("¿Estás seguro de que quieres borrar esta información?")){
              $.ajax({
                headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                url:"sucursal/"+su_clave,
                type:"DELETE",
                data:{su_clave:su_clave},
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
