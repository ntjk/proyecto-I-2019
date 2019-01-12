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
        <title>Fallas - LogUCAB</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet" type="text/css">
        <link href="https://fonts.googleapis.com/css?family=Abril+Fatface" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css?family=Lato" rel="stylesheet">
    </head>
    <body>
            @include('header')
            <div class="container">
            <br/>
            <h1 class="text-center">Fallas</h1>
            <br/>
            <button type="button" id="add_button" data-toggle="modal" data-target="#userModal" class="btn btn-info btn-lg">Add</button>
            <table class="table table-bordered" id="users-table">
                <thead>
                    <tr>
                        <th>Descripción</th>
                        <th>Taller</th>
                        <th>Flota</th>>
                        <th>Revisión</th>
                        <th>Accion</th>
                    </tr>
                </thead>
                <<tbody>
                  @foreach ($fallas as $falla)
                  <tr>
                    <td>{{$falla->fa_descripcion}}</td>
                    <td>{{$falla->ta_nombre}}</td>
                    <td>{{$falla->flo_tipo}}</td>
                    <td>{{$falla->rev_fecha_entrada}} - {{$falla->rev_fecha_real_salida}}</td>
                    <td><button class="btn btn-warning btn-detail update" id="'.$fallas->fa_clave.'" value="'.$fallas->fa_clave.'" name="Update">Update</button>
                      <button class="btn btn-danger btn-delete delete" id="'.$fallas->fa_clave.'" value="'.$fallas->fa_clave.'" name="delete">Delete</button>
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
     <h4 class="modal-title">Añadir Falla</h4>
    </div>
    <div class="modal-body">
     <label>Descripción</label>
     <input type="text" name="fa_descripcion" id="fa_descripcion" class="form-control" />
     <br />
     <label>Taller</label>
     <select class="form-control" name="fk_revision_1" id="fk_revision_1">
        @foreach($talleres as $taller)
        <option value="{{$taller->ta_nombre}}">{{$taller->ta_nombre}}</option>
        @endforeach
     </select>
     <br />
     <label>Flota</label>
     <select class="form-control" name="fk_revision_2" id="fk_revision_2">
        @foreach($flotas as $flota)
        <option value="{{$flota->flo_clave}}">{{$flota->flo_tipo}}</option>
        @endforeach
     </select>
     <br />
     <label>Duración</label>
     <select class="form-control" name="fk_revision_3" id="fk_revision_3">
        @foreach($revisiones as $revision)
        <option value="{{$revision->rev_clave}}">{{$revision->rev_fecha_entrada}} {{$revision->rev_fecha_real_salida}}</option>
        @endforeach
      </select>
      <br />
    </div>
    <div class="modal-footer">
     <input type="hidden" name="fa_clave" id="fa_clave" />
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
            var fa_descripcion = $('#fa_descripcion').val();
            var fk_revision_1 = $('#fk_revision_1').val();
            var fk_revision_2 = $('#fk_revision_2').val();
            var fk_revision_3 = $('#fk_revision_3').val();
            if(fa_descripcion != '')
            {
              $.ajax({
                headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                url:"falla",
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
            var fa_clave = $(this).attr("id");
            $.ajax({
              headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
              url:"falla/getOne",
              method:"POST",
              data:{fa_clave:fa_clave},
              dataType:"json",
              success:function(data){
                $('#userModal').modal('show');
                $('#fa_clave').val(fa_clave);
                $('#fa_descripcion').val(data.fa_descripcion);
                $('#fk_revision_1').val(data.fk_revision_1);
                $('#fk_revision_2').val(data.fk_revision_2);
                $('#fk_revision_3').val(data.fk_revision_3);
                $('.modal-title').text("Edit falla");
                $('#action').val("Edit");
                $('#operation').val("Edit");
              }
            })
          });
          $(document).on('click','.delete',function(){
            var fa_clave = $(this).attr("clave");
            if(confirm("¿Estás seguro de que quieres borrar esta información?")){
              $.ajax({
                headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                url:"falla/"+fa_clave,
                type:"DELETE",
                data:{fa_clave:fa_clave},
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