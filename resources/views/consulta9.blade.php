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
        <title>Consulta 9</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet" type="text/css">
        <link href="https://fonts.googleapis.com/css?family=Abril+Fatface" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css?family=Lato" rel="stylesheet">
    </head>
    <body>
            @include('header')
            <h1 class="text-center">Promedio de estancia de los paquetes por cada zona de las sucursales</h1>
            <br/>
            <table class="table table-bordered" width="80%" id="users-table">
                <thead>
                    <tr>
                        <th>Sucursal</th>
                        <th>Zona</th>
                        <th>Tiempo promedio de estancia</th>
                    </tr>
                </thead>
                <tbody>
                  @foreach ($consulta as $b)
                  <tr>
                    <td>{{$b->so}}</td>
                    <td>{{$b->zo}}</td>
                    <td>{{$b->dias}}</td>
                  </tr>
                  @endforeach
                </tbody>
            </table>
            <label><b>Nota</b>: Tiempo promedio de estancia sin algún valor quiere decir que todos los respectivos paquetes siguen allí y no han sido entregados.
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