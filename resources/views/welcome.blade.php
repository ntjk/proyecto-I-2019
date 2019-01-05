<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link href="{{ asset('css/styles.css') }}" rel="stylesheet">
        <script type="text/javascript" src="{{ asset('js/dropdown.js') }}"></script>

        <title>Inicio</title>

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
                <div class="banner">
                  <div class="third">
                    <img src={{asset('img/main_banner_1.jpg')}} class="mbp">
                  </div>
                  <div class="third blue-block">
                      <div class="motto mbp">
                        ¡Nueva sucursal en Dtto. Capital!
                      </div>
                  </div>
                  <div class="third red-block">
                      <div class="motto mbp a-bit-off">
                        Lo mas importante es brindarte el mejor servicio.
                      </div>
                  </div>
                </div>
              </div>
              @include('footer')
        </div>
    </body>
</html>
