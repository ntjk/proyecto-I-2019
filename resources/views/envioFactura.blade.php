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
      <h1 class="text-center">Recibo del Envio {{$envio->en_clave}}</h1>
      <br>
      <br>
      <div class="container">
        <div class="fatter full white">
          <b>LogUCAB</b><br>
          Urb. Montalbán, Univesidad Católica Andrés Bello, Edif. De<br>
          Laboratorios, Piso 2, Escuela de Ing. Informática.<br>
          J-3110096725-1<br>
          Tlf. +58-2124076655/6656/6657
        </div>
      </div>
      <div class="half-container">
        <div class="fatter descripcion half">
          Fecha de entrega: {{$envio->en_fecha_envio}}
        </div>
        <div class="fatter descripcion half">
          No. de Guia: {{$envio->en_clave}}
        </div>
      </div>
      <div class="half-container">
        <div class="fatter descripcion half white">
          Quien Envia: {{$cliente->cli_nombre}} {{$cliente->cli_apellido}}
        </div>
        <div class="fatter descripcion half white">
          Destinatario: {{$destinatario->des_nombre}} {{$destinatario->des_apellido}}
        </div>
      </div>
      <div class="half-container">
        <div class="fatter descripcion half">
          Origen: {{$origen->su_nombre}}
        </div>
        <div class="fatter descripcion half">
          Destino: {{$destino->su_nombre}}
        </div>
      </div>
      <div class="half-container">
        <div class="fatter descripcion half white">
          Tipo de Paquete: {{$tipo->ti_nombre}}
        </div>
        <div class="fatter descripcion half white">
          Peso: {{$envio->en_peso}}
        </div>
      </div>
      <div class="container">
        <div class="fatter full">
          Fecha estimada de Entrega: {{$envio->en_fecha_entrega_estimada}}
        </div>
      </div>
      <div class="container">
        <div class="fatter full white">
          Monto: {{$envio->en_precio}}
        </div>
      </div>

      <br>
      <br>
    </div>
    @stack('scripts')
    @include('footer')
  </body>
</html>
