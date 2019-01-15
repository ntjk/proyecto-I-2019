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
        <title>Aéreo - LogUCAB</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet" type="text/css">
        <link href="https://fonts.googleapis.com/css?family=Abril+Fatface" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css?family=Lato" rel="stylesheet">
    </head>
    <body>
            @include('header')
            <div class="container">
            <br/>
            <h1 class="text-center">Transportes Aéreos</h1>
            <br/>
            <button type="button" id="add_button" data-toggle="modal" data-target="#userModal" class="btn btn-info btn-lg">Add</button>
            <table class="table table-bordered" id="users-table">
                <thead>
                    <tr>
                        <th>Clave</th>
                        <th>Suptipo</th>
                        <th>Tipo</th>
                        <th>Peso</th>
                        <th>Placa</th>
                        <th>Descripción</th>
                        <th>Combustible por hora</th>
                        <th>Serial de carroceria</th>
                        <th>Capacidad de carga</th>
                        <th>Modelo</th>
                        <th>Sucursal</th>
                        <th>Año</th>
                        <th>Longitud</th>
                        <th>Envergadura</th>
                        <th>Área</th>
                        <th>Altura</th>
                        <th>Ancho de cabina interna</th>
                        <th>Diámetro de fusilaje</th>
                        <th>Peso vacío</th>
                        <th>Peso máximo de despegue</th>
                        <th>Carrera de despegue</th>
                        <th>Velocidad máxima</th>
                        <th>Accion</th>
                    </tr>
                </thead>
                <tbody>
                  @foreach ($flotas as $floa)
                  <tr>
                    <td>{{$floa->flo_clave}}</td>
                    <td>{{$floa->flo_subtipo}}</td>
                    <td>{{$floa->flo_tipo}}</td>
                    <td>{{$floa->flo_peso}}</td>
                    <td>{{$floa->flo_placa}}</td>
                    <td>{{$floa->flo_descripcion}}</td>
                    <td>{{$floa->flo_combustible_por_hora}}</td>
                    <td>{{$floa->flo_serial_carroceria}}</td>
                    <td>{{$floa->flo_capacidad_carga}}</td>
                    <td>{{$floa->mod_nombre}}</td>
                    <td>{{$floa->su_nombre}}</td>
                    <td>{{$floa->flo_año}}</td>
                    <td>{{$floa->flo_a_longitud}}</td>
                    <td>{{$floa->flo_a_envergadura}}</td>
                    <td>{{$floa->flo_a_area}}</td>
                    <td>{{$floa->flo_a_altura}}</td>
                    <td>{{$floa->flo_a_ancho_cabina_interna}}</td>
                    <td>{{$floa->flo_a_diametro_fuselaje}}</td>
                    <td>{{$floa->flo_a_peso_vacio}}</td>
                    <td>{{$floa->flo_a_peso_maximo_despegue}}</td>
                    <td>{{$floa->flo_a_carrera_de_despegue}}</td>
                    <td>{{$floa->flo_a_velocidad_maxima}}</td>
                    <td>
                      <button class="btn btn-warning btn-detail update" id="{{$floa->flo_clave}}" value="{{$floa->flo_clave}}" name="Update">Update</button>
                      <button class="btn btn-danger btn-delete delete" id="{{$floa->flo_clave}}" value="{{$floa->flo_clave}}" name="delete">Delete</button>
                      <button class="btn btn-primary verHistorico" id="{{$floa->flo_clave}}" value="{{$floa->flo_clave}}" name="verHistorico">Histórico</button>
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
     <h4 class="modal-title">Añadir Flota Aérea</h4>
    </div>
    <div class="modal-body">
     <label>Subtipo</label>
     <select class="form-control" name="flo_subtipo" id="flo_subtipo">
       <option value="aerea" selected>aerea</option>
     </select>
     <br />
     <label>Tipo</label>
     <input type="text" name="flo_tipo" id="flo_tipo" class="form-control" />
     <br />
     <label>Peso</label>
     <input type="number" step="0.01" name="flo_peso" id="flo_peso" class="form-control" />
     <br />
     <label>Placa</label>
     <input type="text" name="flo_placa" id="flo_placa" class="form-control" />
     <br />
     <label>Descripción</label>
     <input type="text" name="flo_descripcion" id="flo_descripcion" class="form-control" />
     <br />
     <label>Combustible por hora</label>
     <input type="number" step="0.01" name="flo_combustible_por_hora" id="flo_combustible_por_hora" class="form-control" />
     <br />
     <label>Serial de carroceria</label>
     <input type="text" name="flo_serial_carroceria" id="flo_serial_carroceria" class="form-control" />
     <br />
     <label>Capacidad de carga</label>
     <input type="number" step="0.01" name="flo_capacidad_carga" id="flo_capacidad_carga" class="form-control" />
     <br />
     <label>Modelo</label>
     <select class="form-control" name="fk_modelo" id="fk_modelo">
        @foreach($modelos as $modelo)
        <option value="{{$modelo->mod_clave}}">{{$modelo->mod_nombre}}</option>
        @endforeach
      </select>
     <label>Sucursal Base</label>
     <select class="form-control" name="fk_sucursal" id="fk_sucursal">
        @foreach($sucursales as $sucursal)
        <option value="{{$sucursal->su_clave}}">{{$sucursal->su_nombre}}</option>
        @endforeach
      </select>
     <br />
     <label>Año</label>
     <input type="text" name="flo_año" id="flo_año" class="form-control" />
     <br />
     <label>Longitud</label>
     <input type="number" step="0.01" name="flo_a_longitud" id="flo_a_longitud" class="form-control" />
     <br />
     <label>Envergadura</label>
     <input type="number" step="0.01" name="flo_a_envergadura" id="flo_a_envergadura" class="form-control" />
     <br />
     <label>Area</label>
     <input type="number" step="0.01" name="flo_a_area" id="flo_a_area" class="form-control" />
     <br />
     <label>Altura</label>
     <input type="number" step="0.01" name="flo_a_altura" id="flo_a_altura" class="form-control" />
     <br />
     <label>Ancho Cabina Interna</label>
     <input type="number" step="0.01" name="flo_a_ancho_cabina_interna" id="flo_a_ancho_cabina_interna" class="form-control" />
     <br />
     <label>Diametro de Fuselaje</label>
     <input type="number" step="0.01" name="flo_a_diametro_fuselaje" id="flo_a_diametro_fuselaje" class="form-control" />
     <br />
     <label>Peso Vacio</label>
     <input type="number" step="0.01" name="flo_a_peso_vacio" id="flo_a_peso_vacio" class="form-control" />
     <br />
     <label>Peso Maximo Despegue</label>
     <input type="number" step="0.01" name="flo_a_peso_maximo_despegue" id="flo_a_peso_maximo_despegue" class="form-control" />
     <br />
     <label>Carrera de Despegue</label>
     <input type="number" step="0.01" name="flo_a_carrera_de_despegue" id="flo_a_carrera_de_despegue" class="form-control" />
     <br />
     <label>Velocidad de Despegue</label>
     <input type="number" step="0.01" name="flo_a_velocidad_maxima" id="flo_a_velocidad_maxima" class="form-control" />
     <br />
    </div>
    <div class="modal-footer">
     <input type="hidden" name="flo_clave" id="flo_clave" />
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
            var flo_subtipo = $('#flo_subtipo').val();
            var flo_tipo = $('#flo_tipo').val();
            var flo_peso = $('#flo_peso').val();
            var flo_placa = $('#flo_placa').val();
            var flo_descripcion = $('#flo_descripcion').val();
            var flo_combustible_por_hora = $('#flo_combustible_por_hora').val();
            var flo_serial_carroceria = $('#flo_serial_carroceria').val();
            var flo_capacidad_carga = $('#flo_capacidad_carga').val();
            var fk_modelo = $('#fk_modelo').val();
            var fk_sucursal = $('#fk_sucursal').val();
            var flo_año = $('#flo_año').val();
            var flo_a_longitud = $('#flo_a_longitud').val();
            var flo_a_envergadura = $('#flo_a_envergadura').val();
            var flo_a_area = $('#flo_a_area').val();
            var flo_a_altura = $('#flo_a_altura').val();
            var flo_a_ancho_cabina_interna = $('#flo_a_ancho_cabina_interna').val();
            var flo_a_diametro_fuselaje = $('#flo_a_diametro_fuselaje').val();
            var flo_a_peso_vacio = $('#flo_a_peso_vacio').val();
            var flo_a_peso_maximo_despegue = $('#flo_a_peso_maximo_despegue').val();
            var flo_a_carrera_de_despegue = $('#flo_a_carrera_de_despegue').val();
            var flo_a_velocidad_maxima = $('#flo_a_velocidad_maxima').val();
            if(flo_subtipo != '' && flo_tipo != '')
            {
              $.ajax({
                headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                url:"transporteA",
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
            var flo_clave = $(this).attr("id");
            $.ajax({
              headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
              url:"transporteA/getOne",
              method:"POST",
              data:{flo_clave:flo_clave},
              dataType:"json",
              success:function(data){
                $('#userModal').modal('show');
                $('#flo_subtipo').val(data.flo_subtipo);
                $('#flo_tipo').val(data.flo_tipo);
                $('#flo_peso').val(data.flo_peso);
                $('#flo_placa').val(data.flo_placa);
                $('#flo_descripcion').val(data.flo_descripcion);
                $('#flo_combustible_por_hora').val(data.flo_combustible_por_hora);
                $('#flo_serial_carroceria').val(data.flo_serial_carroceria);
                $('#flo_capacidad_carga').val(data.flo_capacidad_carga);
                $('#flo_año').val(data.flo_año);
                $('#flo_a_longitud').val(data.flo_a_longitud);
                $('#flo_a_envergadura').val(data.flo_a_envergadura);
                $('#flo_a_area').val(data.flo_a_area);
                $('#flo_a_altura').val(data.flo_a_altura);
                $('#flo_a_ancho_cabina_interna').val(data.flo_a_ancho_cabina_interna);
                $('#flo_a_diametro_fuselaje').val(data.flo_a_diametro_fuselaje);
                $('#flo_a_peso_vacio').val(data.flo_a_peso_vacio);
                $('#flo_a_peso_maximo_despegue').val(data.flo_a_peso_maximo_despegue);
                $('#flo_a_carrera_de_despegue').val(data.flo_a_carrera_de_despegue);
                $('#flo_a_velocidad_maxima').val(data.flo_a_velocidad_maxima);
                $('.modal-title').text("Edit Flota");
                $('#flo_clave').val(flo_clave);
                $('#fk_modelo').val(fk_modelo);
                $('#fk_sucursal').val(fk_sucursal);
                $('#action').val("Edit");
                $('#operation').val("Edit");
              }
            })
          });
          $(document).on('click','.delete',function(){
            var flo_clave = $(this).attr("id");
            if(confirm("¿Estás seguro de que quieres borrar esta información?")){
              $.ajax({
                headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                url:"transporteA/"+flo_clave,
                type:"DELETE",
                data:{flo_clave:flo_clave},
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

          $(document).on('click', '.verHistorico', function(){
            var flo_clave = $(this).attr("id");
            var url = "{{url('/historicoF')}}" + flo_clave;
            window.location.href = url;
          });


        });
        </script>
        @stack('scripts')
        @include('footer')
        </div>
      </div>
    </body>
</html>