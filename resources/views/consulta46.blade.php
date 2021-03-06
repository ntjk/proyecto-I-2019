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
        <title>Consulta 46</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet" type="text/css">
        <link href="https://fonts.googleapis.com/css?family=Abril+Fatface" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css?family=Lato" rel="stylesheet">
    </head>
    <body>
            @include('header')
            <h1 class="text-center">Ingresos y egresos por oficina entre {{$rangoi}} y {{$rangof}}.</h1>
            <br/>
            <table class="table table-bordered" width="80%" id="users-table">
                <thead>
                    <tr>
                       <th>Tipo</th>
                       <th>Sucursal</th>
                       <th>Egreso</th>
                       <th>Ingreso</th>
                       <th>Fecha</th>
                    </tr>
                </thead>
                <tbody>
                  @foreach ($unionfinal as $unionF)
                  <tr>
                  <td>{{$unionF->tipo}}</td>
                   <td>{{$unionF->sucu}}</td>
                   <td>{{$unionF->egreso}}</td>
                   <td>{{$unionF->ingreso}}</td>
                   <td>{{$unionF->fecha}}</td>
                  </tr>
                  @endforeach
                </tbody>
            </table>
            <br/>
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
