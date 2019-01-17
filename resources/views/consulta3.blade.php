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
        <link href="{{ asset('css/unselectable.css') }}" rel="stylesheet">
        <script type="text/javascript" src="{{ asset('js/dropdown.js') }}"></script>
        <title>Consulta 3</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet" type="text/css">
        <link href="https://fonts.googleapis.com/css?family=Abril+Fatface" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css?family=Lato" rel="stylesheet">
    </head>
    <body>
            @include('header')
            <h1 class="text-center">Envios por estatus</h1>
            <br/>
            <table class="table table-bordered" width="80%" id="users-table">
                <thead>
                    <tr>
                        <th>Estatus</th>
                        <th>Nro de guia</th>
                        <th>Tipo</th>
                        <th>Precio</th>
                        <th>Peso</th>
                        <th>Altura</th>
                        <th>Anchura</th>
                        <th>Profundidad</th>
                        <th>Fecha de envío</th>
                        <th>Cliente emisor</th>
                        <th>Destinatario</th>
                        <th>Sucursal origen</th>
                        <th>Sucursal destino</th>
                    </tr>
                </thead>
                <tbody>
                  @foreach ($consulta as $envio)
                  <tr>
                    <td>{{$envio->che_estatus}}</td>
                    <td>{{$envio->en_clave}}</td>
                    <td>{{$envio->ti_nombre}}</td>
                    <td>{{$envio->en_precio}}</td>
                    <td>{{$envio->en_peso}}</td>
                    <td>{{$envio->en_altura}}</td>
                    <td>{{$envio->en_anchura}}</td>
                    <td>{{$envio->en_profundidad}}</td>
                    <td>{{$envio->en_fecha_envio}}</td>
                    <td>{{$envio->cli_nacionalidad}} {{$envio->cli_cedula}}</td>
                    <td>{{$envio->des_cedula}}</td>
                    <td>{{$envio->so}}</td>
                    <td>{{$envio->sd}}</td>            
                  </tr>
                  @endforeach
                </tbody>
            </table>
        </div>
        <div id="userModal" class="modal fade">
        <script src="//code.jquery.com/jquery.js"></script>
        <script src="//cdn.datatables.net/1.10.7/js/jquery.dataTables.min.js"></script>
        <script src="//netdna.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>

        <script>$(function() {
            $('#users-table').DataTable({
            })
          	$(document).on('click', '.update', function(){
            	var en_clave = $(this).attr("id");
          	});
        });
        </script>
        @stack('scripts')
        @include('footer')
              </div>
        </div>
      </div>
    </body>
</html>