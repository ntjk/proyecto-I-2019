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
    <title>Empleados de una Sucursal - LogUCAB</title>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Abril+Fatface" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Lato" rel="stylesheet">
  </head>
  <body>
    @include('header')
    <div class="container">
    <h1 class="text-center">Empleados de la sucursal {{$sucursal->su_nombre}}</h1>
    <br/>
    <form method="post" id="user_form">
      <label>Fecha</label>
      <input type="date" name="inputid" id="inputid" class="form-control" />
      <br /><br/>
      <a type="reset" onclick="navigate2(this,'{{$sucursal->su_clave}}','inputid')">Crear Nomina</a>
    </form>
      <script>
        function navigate2(link, sucursal, inputid){
          var url = "{{url('/sucursal')}}" + sucursal +'-'+ document.getElementById(inputid).value;
          window.location.href = url; //navigates to the given url, disabled for demo
          //alert(url);
        }
      </script>
    <table class="table table-bordered" id="users-table">
        <thead>
            <tr>
              <th>Empleado</th>
              <th>Salario Semanal (Incluyendo Inasistencias)</th>
              <th>Accion</th>
            </tr>
        </thead>
        <tbody>
          @foreach ($empleados as $em)
          <tr>
            <td>{{$em->em_nombre}}</td>
            <td>{{$em->salario}}</td>
            <td><button class="btn btn-info btn-detail factura" id=".{{$em->em_clave}}." value=".{{$em->em_clave}}." onclick="navigate(this,'{{$em->em_clave}}','{{$monday}}','{{$sucursal->su_clave}}')" name="recibo">Recibo</button></td>
          </tr>
          @endforeach
        </tbody>
    </table>
  </br>
  <h2>Total: {{$total}}</h2>
</div>
    <script>
    function navigate(link, inputid, time, sucursal){
      //alert(document.getElementById(inputid).value)
      var date = time.split(' ')[0];
      var url = "{{url('/empleado')}}" + inputid + "-" + date + "-" + sucursal;
      window.location.href = url; //navigates to the given url, disabled for demo
      //alert(url);
    }
    </script>
<script src="//code.jquery.com/jquery.js"></script>
<script src="//cdn.datatables.net/1.10.7/js/jquery.dataTables.min.js"></script>
<script src="//netdna.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>
    @stack('scripts')
    @include('footer')
  </body>
</html>
