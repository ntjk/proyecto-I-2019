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
    <link href="{{ asset('css/styles_factura.css') }}" rel="stylesheet">
    <script type="text/javascript" src="{{ asset('js/dropdown.js') }}"></script>
    <title>Factura - LogUCAB</title>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Abril+Fatface" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Lato" rel="stylesheet">
  </head>
  <body>
    @include('header')
    <div class="container">
      <h1 class="text-center">Factura del Empleado {{$empleado->em_nombre}} {{$empleado->em_apellido}}</h1>
      <br>
      <br>
      <div class="half-container">
        <div class="descripcion half">
          ACUMULADO <br> {{$acumulado}} BS.
        </div>
        <div class="descripcion half">
          CARGO <br> {{$empleado->em_profesion}}
        </div>
      </div>
      <div class="half-container">
        <div class="descripcion half">
          SUCURSAL <br> {{$sucursal->su_nombre}}
        </div>
        <div class="descripcion half">
          PERIODO QUE TERMINA <br> {{$end}}
        </div>
      </div>
      <div class="half-container">
        <div class="descripcion half eighty">
          CONCEPTO
        </div>
        <div class="descripcion half twenty">
          ASIGNACIONES
        </div>
      </div>
      <div class="half-container">
        <div class="descripcion half eighty white">
            <?php foreach ($factura as $f): ?>
              PAGO DEL DIA {{$f->a_fecha}}<br>
            <?php endforeach; ?>
        </div>
        <div class="descripcion half twenty white">
            <?php foreach ($factura as $f): ?>
              {{$f->em_salario_base}} BS.<br>
            <?php endforeach; ?>
        </div>
      </div>
      <div class="half-container">
        <div class="descripcion half eighty">
          TOTAL
        </div>
        <div class="descripcion half twenty">
          {{$total}} BS.
        </div>
      </div>
      <br>
      <br>
    </div>
    @stack('scripts')
    @include('footer')
  </body>
</html>
