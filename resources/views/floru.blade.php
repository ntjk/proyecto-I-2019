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
        <title>Ruta - LogUCAB</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet" type="text/css">
        <link href="https://fonts.googleapis.com/css?family=Abril+Fatface" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css?family=Lato" rel="stylesheet">
    </head>
    <body>
            @include('header')
            <div class="container">
            <br/>
            <h1 class="text-center">Rutas</h1>
            <br/>
            <button type="button" data-toggle="modal" data-target="#userModal" class="btn btn-info btn-lg">Add</button>
            <table class="table table-bordered" id="users-table">
                <thead>
                    <tr>
                        <th>Ruta nro</th>
                        <th>Sucursal origen</th>
                        <th>Sucursal destino</th>
                        <th>Flota</th>
                        <th>Costo</th>
                        <th>Duracion</th>
                        <th>Accion</th>
                    </tr>
                </thead>
                <tbody>
                  @foreach($rutas as $r)
                  <tr>
                    <td>{{$r->flo_ruta}}</td>
                    <td>{{$r->su_nombre}}</td>
                    <td>{{$r->sd_nombre}}</td>
                    <td>{{$r->mod_nombre}} {{$r->flo_año}}, {{$r->flo_subtipo}}</td>
                    <td>{{$r->flo_ru_costo}}</td>
                    <td>{{$r->flo_ru_duracion_hrs}}</td>
                    <td>                      
                      <button class="btn btn-warning btn-detail update" id="{{$r->flo_ru_clave}}" value="{{$r->flo_ru_clave}}" name="Update">Update</button>
                      <button class="btn btn-danger btn-delete delete" id="{{$r->flo_ru_clave}}" value="{{$r->flo_ru_clave}}" name="delete">Delete</button>
                      <button class="btn btn-primary agregarNodoBtn" id="{{$r->flo_ru_clave}}" data-toggle="modal" data-target="#userModal_2" value="{{$r->flo_ru_clave}}" name="delete">Agregar nodo</button>
                      <!--<button class="btn btn-primary borrarNodo" id="{{$r->flo_ru_clave}}" data-toggle="modal" data-target="#userModal_2" value="{{$r->flo_ru_clave}}" name="delete">Borrar nodo</button>-->
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
     <h4 class="modal-title">Añadir Ruta</h4>
    </div>
    <div class="modal-body">
      <label>Sucursal Origen</label>
      <select class="form-control" name="fk_sucursal_1" id="fk_sucursal_1">
        @foreach($sucursales as $sucursal)
        <option value="{{$sucursal->su_clave}}">{{$sucursal->su_nombre}}</option>
        @endforeach
      </select>
      <br/>
      <label>Medio de transporte :: origen - destino</label>
      <select class="form-control" name="fk_flota" id="fk_flota">
        @foreach($flotas as $flota)
        <option value="{{$flota->flo_clave}}">{{$flota->mod_nombre}} {{$flota->flo_año}}, {{$flota->flo_subtipo}}</option>
        @endforeach        
      </select>
      <label>Precio :: origen - destino</label>
      <input type="number" step="0.01" name="flo_ru_precio" id="flo_ru_precio" class="form-control"/>
      <label>Duración en horas :: origen - nodo 1</label>
      <input type="number" step="0.01" name="flo_ru_duracion" id="flo_ru_duracion" class="form-control" />
     <br />
      <label>Sucursal Destino</label>
      <select class="form-control" name="fk_sucursal_2" id="fk_sucursal_2">
         @foreach($sucursales as $sucursal)
         <option value="{{$sucursal->su_clave}}">{{$sucursal->su_nombre}}</option>
         @endforeach
       </select>
      <br />
    </div>
    <div class="modal-footer">
     <input type="hidden" name="flo_ru_clave" id="flo_ru_clave" />
     <input type="hidden" name="operation" id="operation" />
     <input type="submit" name="action" id="action" class="btn btn-success agregarRuta" value="Add" />
     <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
    </div>
   </div>
  </form>
 </div>
</div>


<div id="userModal_2" class="modal fade">
 <div class="modal-dialog">
  <form method="post" id="user_form_2" enctype="multipart/form-data">
   <div class="modal-content">
    <div class="modal-header">
     <button type="button" class="close" data-dismiss="modal">&times;</button>
     <h4 class="modal-title">Añadir Sucursal intermedia</h4>
    </div>
    <div class="modal-body">
      <label>Nodo (Sucursal intermedia)</label>
      <select class="form-control" name="fk_sucursal_2_2" id="fk_sucursal_2_2">
        @foreach($sucursales as $sucursal)
        <option value="{{$sucursal->su_clave}}">{{$sucursal->su_nombre}}</option>
        @endforeach
      </select>
       <label>Medio de transporte :: desde la sucursal anterior a este nodo</label>
      <select class="form-control" name="fk_flota_2" id="fk_flota_2">
        @foreach($flotas as $flota)
        <option value="{{$flota->flo_clave}}">{{$flota->mod_nombre}} {{$flota->flo_año}}, {{$flota->flo_subtipo}}</option>
        @endforeach        
      </select>
      <label>Precio :: desde la sucursal anterior a este nodo</label>
      <input type="number" step="0.01" name="flo_ru_precio_2" id="flo_ru_precio_2" class="form-control"/>
      <label>Duración en horas :: origen - nodo 1</label>
      <input type="number" step="0.01" name="flo_ru_duracion_2" id="flo_ru_duracion_2" class="form-control" />
     <br />
    </div>
    <div class="modal-footer">
     <input type="hidden" name="flo_ru_clave_nodo" id="flo_ru_clave_nodo" />
     <input type="submit" name="action_2" id="action_2" class="btn btn-success agregarNodo" value="Add" />
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

            $(document).on('click', '.agregarRuta', function(event){
            event.preventDefault();
            var fk_sucursal_1 = $('#fk_sucursal_1').val();
            var fk_sucursal_2 = $('#fk_sucursal_2').val();
            var fk_flota = $('#fk_flota').val();
            var flo_ru_precio = $('#flo_ru_precio').val();
            var flo_ru_duracion = $('#flo_ru_duracion').val();
            console.log(fk_sucursal_1);
            console.log(fk_sucursal_2);
            console.log(fk_flota);
            console.log(flo_ru_precio);
            console.log(flo_ru_duracion);

            if(fk_sucursal_1 != "" && fk_sucursal_2 != "" && flo_ru_precio != "")
            {
              $.ajax({
                headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                type: "POST",
                url:"floru/agregarRuta",
                data: { 
                  fk_sucursal_1:fk_sucursal_1,
                  fk_sucursal_2:fk_sucursal_2,
                  fk_flota:fk_flota,
                  flo_ru_duracion:flo_ru_duracion,
                  flo_ru_precio:flo_ru_precio
                },
                success:function(data)
                {
                  alert(data.message);
                  $('#user_form')[0].reset();
                  //$('#users-table').dataTable().ajax.reload(null, false);
                }
              });
            }
            else
            {
              alert("Falta campos por llenar");
            }
          });

          $(document).on('click', '.agregarNodoBtn', function(){
            var flo_ru_clave = $(this).attr("id");
            $('#flo_ru_clave_nodo').val(flo_ru_clave);
          });

          $(document).on('click', '.agregarNodo', function(){
            event.preventDefault();
            var flo_ru_clave = $('#flo_ru_clave_nodo').val();
            var fk_sucursal_2 = $('#fk_sucursal_2_2').val();
            var fk_flota = $('#fk_flota_2').val();
            var flo_ru_precio = $('#flo_ru_precio_2').val();
            var flo_ru_duracion = $('#flo_ru_duracion_2').val();
            console.log(flo_ru_clave);

            if(fk_sucursal_2 != "" && flo_ru_precio != "")
            {
              $.ajax({
                headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                type: "POST",
                url:"floru/agregarNodo",
                data: {
                  flo_ru_clave:flo_ru_clave,
                  fk_sucursal_2:fk_sucursal_2,
                  fk_flota:fk_flota,
                  flo_ru_duracion:flo_ru_duracion,
                  flo_ru_precio:flo_ru_precio
                },
                success:function(data)
                {
                  alert(data.message);
                  //$('#user_form')[0].reset();
                  //$('#users-table').dataTable().ajax.reload(null, false);
                }
              });
            }
            else
            {
              alert("Falta campos por llenar");
            }
          });

          $(document).on('click', '.update', function(){
            var flo_ru_clave = $(this).attr("id");
            var operation="Edit";
            $.ajax({
              headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
              url:"floru/getOne",
              method:"POST",
              data:{flo_ru_clave:flo_ru_clave,
                operation:operation},
              dataType:"json",
              success:function(data){
                $('#userModal').modal('show');
                $('#fk_sucursal_1').val(data.fk_ruta_2);
                $('#fk_sucursal_2').val(data.fk_ruta_3);
                $('#fk_flota').val(data.fk_flota);
                $('#flo_ru_precio').val(data.flo_ru_costo);
                $('#flo_ru_duracion').val(data.flo_ru_duracion_hrs);
                $('.modal-title').text("Edit Ruta");
                $('#flo_ru_clave').val(flo_ru_clave);
                $('#action').val("Edit");
                $('#operation').val("Edit");
              }
            })
          });
          $(document).on('click','.delete',function(){
            var flo_ru_clave = $(this).attr("id");
            if(confirm("ALERTA: borraría TODA la ruta de la cual forma parte este nodo, desea continuar?")){
              $.ajax({
                headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                url:"floru/"+flo_ru_clave,
                type:"DELETE",
                data:{flo_ru_clave:flo_ru_clave},
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
