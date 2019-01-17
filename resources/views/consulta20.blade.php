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
    <title>Promedio de envios {{$mensaje}} de la Sucursal {{$sucursal}} - LogUCAB</title>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Abril+Fatface" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Lato" rel="stylesheet">
  </head>
  <body>
    @include('header')
    <div class="container">
    <br/>
    <h1 class="text-center">Promedio de envios {{$mensaje}} de la Sucursal {{$sucursal}}</h1>
    <br/>
    <form method="post" id="user_form">
      <label class="labelDestacado">Seleccione la Sucursal</label>
      <select name="fk_sucursal_origen" id="inputid1" class="form-control">
        @foreach($sucursales as $s)
        <option value="{{$s->su_clave}}">{{$s->su_nombre}}</option>
        @endforeach
      </select>
      <br /><br/>
      <label class="labelDestacado">Seleccione el Periodo</label>
      <select name="tiempo" id="inputid2" class="form-control">
          <option value="30">Mensual</option>
          <option value="60">Bimestral</option>
          <option value="90">Trimestral</option>
          <option value="180">Semestral</option>
      </select>
      <br /><br/>
      <a type="reset" onclick="navigate(this,'inputid1','inputid2')">Edit</a>
      <script>
        function navigate(link, inputid1, inputid2){
          var url = "{{url('/consulta20-')}}" + document.getElementById(inputid1).value +"-"+document.getElementById(inputid2).value;
          window.location.href = url; //navigates to the given url, disabled for demo
          //alert(url);
        }
      </script>
    </form>
    <table class="table table-bordered" id="users-table">
        <thead>
            <tr>
              <th>Sucursal</th>
              <th>Promedio</th>
              <th>Año</th>
            </tr>
        </thead>
        <tbody>
          @foreach ($avgES as $aes)
          <tr>
            <td>{{$aes->so}}</td>
            <td>{{$aes->promedio}}</td>
            <td>{{$aes->yy}}</td>
          </tr>
          @endforeach
        </tbody>
    </table>
</div>
<script src="//code.jquery.com/jquery.js"></script>
<script src="//cdn.datatables.net/1.10.7/js/jquery.dataTables.min.js"></script>
<script src="//netdna.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>
    @stack('scripts')
    @include('footer')
  </body>
</html>
