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
        <title>Aeropuerto - LogUCAB</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet" type="text/css">
        <link href="https://fonts.googleapis.com/css?family=Abril+Fatface" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css?family=Lato" rel="stylesheet">
    </head>
    <body>
            @include('header')
            <div class="container">
            <br/>
            <h1 class="text-center">Aeropuertos</h1>
            <br/>
            <button type="button" id="add_button" data-toggle="modal" data-target="#userModal" class="btn btn-info btn-lg">Add</button>
            <table class="table table-bordered" id="users-table">
                <thead>
                    <tr>
                        <th>Clave</th>
                        <th>Nombre</th>
                        <th>Capacidad</th>
                        <th>Cant. Pistas</th>
                        <th>Cant. Terminales</th>
                        <th>Otros</th>
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
     <h4 class="modal-title">Añadir Aeropuerto</h4>
    </div>
    <div class="modal-body">
     <label>Nombre</label>
     <input type="text" name="ae_nombre" id="ae_nombre" class="form-control" />
     <br />
     <label>Capacidad</label>
     <input type="number" name="ae_capacidad" id="ae_capacidad" class="form-control" />
     <br />
     <label>Cantidad de pistas</label>
     <input type="number" name="ae_cantidad_pistas" id="ae_cantidad_pistas" class="form-control" />
     <br />
     <label>Cantida de terminales</label>
     <input type="number" name="ae_cantidad_terminales" id="ae_cantidad_terminales" class="form-control" />
     <br />
     <label>Otros</label>
     <input type="text" name="ae_otro" id="ae_otro" class="form-control" />
     <br />
    </div>
    <div class="modal-footer">
     <input type="hidden" name="ae_clave" id="ae_clave" />
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
                ajax: '{!! route('aeropuerto_getData') !!}',
                columns: [
                    { data: 'ae_clave', name: 'ae_clave' },
                    { data: 'ae_nombre', name: 'ae_nombre' },
                    { data: 'ae_capacidad', name: 'ae_capacidad' },
                    { data: 'ae_cantidad_pistas', name: 'ae_cantidad_pistas' },
                    { data: 'ae_cantidad_terminales', name: 'ae_cantidad_terminales' },
                    { data: 'ae_otro', name: 'ae_otro' },
                    {data: 'action', name: 'action', orderable: false, searchable: false}
                ]
            })

            $(document).on('submit', '#user_form', function(event){
            event.preventDefault();
            var ae_nombre = $('#ae_nombre').val();
            var ae_capacidad = $('#ae_capacidad').val();
            var ae_cantidad_pistas = $('#ae_cantidad_pistas').val();
            var ae_cantidad_terminales = $('#ae_cantidad_terminales').val();
            var ae_otro = $('#ae_otro').val();

            if(ae_nombre != '' && 
            ae_capacidad != '' && 
            ae_cantidad_pistas != '' && 
            ae_cantidad_terminales != '' && 
            ae_otro != '')
            {
              $.ajax({
                headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                url:"aeropuerto",
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
            var ae_clave = $(this).attr("id");
            $.ajax({
              headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
              url:"aeropuerto/getOne",
              method:"POST",
              data:{ae_clave:ae_clave},
              dataType:"json",
              success:function(data){
                $('#userModal').modal('show');
                $('#ae_nombre').val(data.ae_nombre);
                $('#ae_capacidad').val(data.ae_capacidad);
                $('#ae_cantidad_pistas').val(data.ae_cantidad_pistas);
                $('#ae_cantidad_terminales').val(data.ae_cantidad_terminales);
                $('#ae_otro').val(data.ae_otro);
                $('.modal-title').text("Edit aeropuerto");
                $('#ae_clave').val(ae_clave);
                $('#action').val("Edit");
                $('#operation').val("Edit");
              }
            })
          });
          $(document).on('click','.delete',function(){
            var ae_clave = $(this).attr("id");
            if(confirm("¿Estás seguro de que quieres borrar esta información?")){
              $.ajax({
                headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                url:"aeropuerto/"+ae_clave,
                type:"DELETE",
                data:{ae_clave:ae_clave},
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