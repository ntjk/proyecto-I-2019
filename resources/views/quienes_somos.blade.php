<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link href="{{ asset('css/styles.css') }}" rel="stylesheet">
        <link href="{{ asset('css/styles_qs.css') }}" rel="stylesheet">
        <script type="text/javascript" src="{{ asset('js/dropdown.js') }}"></script>

        <title>¿Quiénes Somos? - LogUCAB</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet" type="text/css">
        <link href="https://fonts.googleapis.com/css?family=Abril+Fatface" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css?family=Lato" rel="stylesheet">
    </head>
    <body>
      <!--  <div class="flex-center position-ref full-height">
            @if (Route::has('login'))
                <div class="top-right links">
                    @auth
                        <a href="{{ url('/home') }}">Home</a>
                    @else
                        <a href="{{ route('login') }}">Login</a>

                        @if (Route::has('register'))
                            <a href="{{ route('register') }}">Register</a>
                        @endif
                    @endauth
                </div>
            @endif -->

            @include('header')
              <div class="main">
                <div class="description">
                  En 1986 la UCAB extiende sus negocios con la apertura de la primera compañía de entregas dentro de Venezuela LogUCAB. Hoy en día hacemos traslados de paquetes a toda América Latina y Europa (España, Portugal y Francia en miras de seguir expandiendo). Estamos comprometidos con la sostenibilidad, la satisfacción del cliente, la protección del medio ambiente, la seguridad de las personas y de la información
                </div>
                <div class="half-container">
                  <div class="description half">
                  <h1>Misión</h1> <br> Aportar soluciones para hacer ganar tiempo uniendo personas y distancias, comprometidos con un mundo más  sostenible.
                </div>
                    <div class="description half">
                      <h1>Visión</h1> <br> Ser percibida como la marca líder preferida por ofrecer las soluciones más innovadoras y de valor añadido en el transporte y la logística.
                    </div>
                  </div>

                </div>
                @include('footer')
        </div>
    </body>
</html>
