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
        <title>Consulta 24</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet" type="text/css">
        <link href="https://fonts.googleapis.com/css?family=Abril+Fatface" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css?family=Lato" rel="stylesheet">
    </head>
    <body>
            @include('header')
            <h1 class="text-center">Lista de empleados activos, indicando su información básica, cargo que ocupa y fecha de ingreso a la compañía</h1>
            <br/>
            <table class="table table-bordered" width="80%" id="users-table">
                <thead>
                    <tr>
                      <th>Datos basicos del empleado</th>
                      <th>Estado civil</th>  
                      <th>Fecha de nacimiento</th>
                      <th>Salario base</th>
                      <th>Correo laboral</th>
                      <th>Fecha de ingreso</th>
                      <th>Cargo que ocupa</th>
                    </tr>
                </thead>
                <tbody>
                  @foreach ($consulta as $b)
                  <tr>
                    <td>{{$b->em_nombre}} {{$b->em_apellido}}, {{$b->em_nacionalidad}} {{$b->em_cedula}}</td>
                    <td>{{$b->em_estado_civil}}</td>
                    <td>{{$b->em_fecha_nacimiento}}</td>
                    <td>{{$b->em_salario_base}}</td>
                    <td>{{$b->em_email_empresa}}</td>
                    <td>{{$b->em_fecha_ingreso}}</td>
                    <td>{{$b->em_profesion}}</td>
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