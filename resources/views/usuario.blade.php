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
        <title>Usuarios - LogUCAB</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet" type="text/css">
        <link href="https://fonts.googleapis.com/css?family=Abril+Fatface" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css?family=Lato" rel="stylesheet">
    </head>
    <body>
            @include('header')
            <div class="container">
            <br/>
            <h1 class="text-center">Usuarios</h1>
            <br/>
            <button type="button" id="add_button" data-toggle="modal" data-target="#userModal" class="btn btn-info btn-lg">Add</button>
            <table class="table table-bordered" id="users-table">
                <thead>
                    <tr>
                        <th>Nombre</th>
                        <th>Contraseña</th>
                        <th>Rol</th>>
                        <th>Nombre del Empleado</th>
                        <th id="hidden2">Accion</th>
                    </tr>
                </thead>
                <<tbody>
                  @foreach ($usuarios as $u)
                  <tr>
                    <td>{{$u->u_nombre}}</td>
                    <td>{{$u->u_contraseña}}</td>
                    <td>{{$u->rol_nombre}}</td>
                    <td>{{$u->em_nombre}} {{$u->em_nacionalidad}} {{$u->em_cedula}}</td>
                    <td id="hidden3"><button class="btn btn-warning btn-detail update" id="'.$usuarios->u_id.'" value="'.$usuarios->u_id.'" name="Update">Update</button>
                      <button class="btn btn-danger btn-delete delete" id="'.$usuarios->u_id.'" value="'.$usuarios->u_id.'" name="delete">Delete</button>
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
     <h4 class="modal-title">Añadir Empleado</h4>
    </div>
    <div class="modal-body">
     <label>Nombre</label>
     <input type="text" name="u_nombre" id="u_nombre" class="form-control" />
     <br />
     <label>Contraseña</label>
     <input type="text" name="u_contraseña" id="u_contraseña" class="form-control" />
     <br />
     <label>Roles</label>
     <select class="form-control" name="fk_rol" id="fk_rol">
      @foreach($roles as $rol)
      <option value="{{$rol->rol_clave}}">{{$rol->rol_nombre}}</option>
      @endforeach
      </select>
     <br />
     <label>Empleado</label>
     <select class="form-control" name="fk_empleado" id="fk_empleado">
        @foreach($empleados as $empleado)
        <option value="{{$empleado->em_clave}}">{{$empleado->em_nombre}} {{$empleado->em_apellido}}</option>
        @endforeach
      </select>
      <br />
    </div>
    <div class="modal-footer">
     <input type="hidden" name="u_id" id="u_id" />
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

            $(".delete").hide();
            $(".update").hide();
            $('#add_button').hide();
            $('#hidden2').hide();    
            $('#hidden3').hide();    

            var eliminar = '{!! verificarPermisosHelper("eliminar usuarios"); !!}';
            var modificar = '{!! verificarPermisosHelper("modificar usuarios"); !!}';
            var insertar = '{!! verificarPermisosHelper("insertar usuarios"); !!}';

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

            $(document).on('submit', '#user_form', function(event){
            event.preventDefault();
            var u_nombre = $('#u_nombre').val();
            var u_contraseña = $('#u_contraseña').val();
            var fk_rol = $('#fk_rol').val();
            var fk_empleado = $('#fk_empleado').val();
            if(u_nombre != '' && u_contraseña != '')
            {
              $.ajax({
                headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                url:"usuario",
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
              alert("Llene los campos requeridos.");
            }
          });
          $(document).on('click', '.update', function(){
            var u_id = $(this).attr("id");
            $.ajax({
              headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
              url:"usuario/getOne",
              method:"POST",
              data:{u_id:u_id},
              dataType:"json",
              success:function(data){
                $('#userModal').modal('show');
                $('#u_nombre').val(data.u_nombre);
                $('#u_contraseña').val(data.u_contraseña);
                $('.modal-title').text("Edit Usuario");
                $('#u_id').val(u_id);
                $('#fk_rol').val(data.fk_rol);
                $('#fk_empleado').val(data.fk_empleado);
                $('#action').val("Edit");
                $('#operation').val("Edit");
              }
            })
          });
          $(document).on('click','.delete',function(){
            var u_id = $(this).attr("id");
            if(confirm("¿Estás seguro de que quieres borrar esta información?")){
              $.ajax({
                headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                url:"usuario/"+u_id,
                type:"DELETE",
                data:{u_id:u_id},
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
