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
        <title>Taller - LogUCAB</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet" type="text/css">
        <link href="https://fonts.googleapis.com/css?family=Abril+Fatface" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css?family=Lato" rel="stylesheet">
    </head>
    <body>
            @include('header')
            <div class="container">
            <br/>
            <h1 class="text-center">Talleres</h1>
            <br/>
            <button type="button" id="add_button" data-toggle="modal" data-target="#userModal" class="btn btn-info btn-lg">Add</button>
            <div class="table-container">
            <table class="table table-bordered special-table" id="users-table">
                <thead>
                    <tr>
                        <th>Clave</th>
                        <th>Nombre</th>
                        <th>Email</th>
                        <th>Contacto</th>
                        <th>Página Web</th>
                        <th>Lugar</th>
                        <th>Accion</th>
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
     <h4 class="modal-title">Añadir Taller</h4>
    </div>
    <div class="modal-body">
     <label>Nombre</label>
     <input type="text" name="ta_nombre" id="ta_nombre" class="form-control" />
     <br />
     <label>Email</label>
     <input type="text" name="ta_email" id="ta_email" class="form-control" />
     <br />
     <label>Contacto</label>
     <input type="text" name="ta_contacto" id="ta_contacto" class="form-control" />
     <br />
     <label>Página web</label>
     <input type="text" name="ta_pagina_web" id="ta_pagina_web" class="form-control" />
     <br />
     <label>Estado</label>
     <select class="form-control" name="estado" id="estado">
        @foreach($estados as $estado)
        <option value="{{$estado->lu_clave}}">{{$estado->lu_nombre}}</option>
        @endforeach
     </select>
     <br />
     <label>Municipio</label>
     <select class="form-control" name="fk_lugar" id="fk_lugar">
     </select>
    </div>
    <div class="modal-footer">
     <input type="hidden" name="ta_clave" id="ta_clave" />
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
                ajax: '{!! route('taller_getData') !!}',
                columns: [
                    { data: 'ta_clave', name: 'taller.ta_clave' },
                    { data: 'ta_nombre', name: 'taller.ta_nombre' },
                    { data: 'ta_email', name: 'taller.ta_email' },
                    { data: 'ta_contacto', name: 'taller.ta_contacto' },
                    { data: 'ta_pagina_web', name: 'taller.ta_pagina_web' },
                    { data: 'lu_nombre', name: 'lugar.lu_nombre' },
                    {data: 'action', name: 'action', orderable: false, searchable: false}
                ]
            })
            $(document).on('change','#estado',function(){
              var estado = $(this).val();
              $.ajax({
                headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                type: "POST",
                url: "taller/updateSelect",
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
            var ta_clave = $('#ta_clave').val();
            var ta_nombre = $('#ta_nombre').val();
            var ta_email = $('#ta_email').val();
            var ta_contacto = $('#ta_contacto').val();
            var ta_pagina_web = $('#ta_pagina_web').val();
            var fk_lugar = $('#fk_lugar').val();
            if(ta_nombre != '' 
            && ta_email != '' 
            && ta_contacto != '' 
            && ta_pagina_web != '')
            {
              $.ajax({
                headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                url:"taller",
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
              alert("Required Fields are not Filled.");
            }
          });
          $(document).on('click', '.update', function(){
            var ta_clave = $(this).attr("id");
            $.ajax({
              headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
              url:"taller/getOne",
              method:"POST",
              data:{ta_clave:ta_clave},
              dataType:"json",
              success:function(data){
                $('#userModal').modal('show');
                $('.modal-title').text("Edit taller");
                $('#ta_nombre').val(data.ta_nombre);
                $('#ta_email').val(data.ta_email);
                $('#ta_contacto').val(data.ta_contacto);
                $('#ta_clave').val(ta_clave);
                $('#ta_pagina_web').val(data.ta_pagina_web);
                $('#fk_lugar').val(data.fk_lugar);
                $('#action').val("Edit");
                $('#operation').val("Edit");
              }
            })
          });
          $(document).on('click','.delete',function(){
            var ta_clave = $(this).attr("id");
            if(confirm("¿Estás seguro de que quieres borrar esta información?")){
              $.ajax({
                headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                url:"taller/"+ta_clave,
                type:"DELETE",
                data:{ta_clave:ta_clave},
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
