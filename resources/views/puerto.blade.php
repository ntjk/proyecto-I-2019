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
        <title>Puertos - LogUCAB</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet" type="text/css">
        <link href="https://fonts.googleapis.com/css?family=Abril+Fatface" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css?family=Lato" rel="stylesheet">
    </head>
    <body>
            @include('header')
            <div class="container">
            <br/>
            <h1 class="text-center">Puertos</h1>
            <br/>
            <!--<button type="button" id="add_button" data-toggle="modal" data-target="#userModal" class="btn btn-info btn-lg">Add</button>-->
            <table class="table table-bordered" id="users-table">
                <thead>
                    <tr>
                        <th>Nombre</th>
                        <th>Cant. Puestos</th>
                        <th>Cant. Muelles</th>
                        <th>Longitud</th>
                        <th>Ancho</th>
                        <th>Calado</th>
                        <th>Uso</th>
                        <th>Tipo Flota</th>
                        <th>Sucursal</th>
                        <!--<th>Accion</th>-->
                    </tr>
                </thead>
                <tbody>
                  @foreach ($puertos as $p)
                  <tr>
                    <td>{{$p->nombre}}</td>
                    <td>{{$p->cp}}</td>
                    <td>{{$p->cm}}</td>
                    <td>{{$p->long}}</td>
                    <td>{{$p->ancho}}</td>
                    <td>{{$p->calado}}</td>
                    <td>{{$p->uso}}</td>
                    <td>{{$p->flota}}</td>
                    <td>{{$p->sucursal}}</td>
                  </tr>
                  @endforeach
                </tbody>
            </table>
        <script src="//code.jquery.com/jquery.js"></script>
        <script src="//cdn.datatables.net/1.10.7/js/jquery.dataTables.min.js"></script>
        <script src="//netdna.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>
        <script>$(function() {
            $('#users-table').DataTable({
            })
        });
        </script>
        @stack('scripts')
        @include('footer')
    </body>
</html>