<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Abril+Fatface" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css?family=Lato" rel="stylesheet">

        <!-- Styles -->
        <style>
            html, body {
                background-color: #fff;
                color: #636b6f;
                font-family: 'Lato', sans-serif;
                font-weight: 200;
                margin: 0;
            }

            .full-height {
                height: 100vh;
            }

            .flex-center {
                align-items: center;
                display: flex;
                justify-content: center;
            }

            .position-ref {
                position: relative;
            }

            .top-right {
                position: absolute;
                right: 10px;
                top: 18px;
            }

            .content {
                width: 100vw;
                background-color: #ffc002;
                text-align: center;
                height:200px;
            }

            .title {
                font-size: 46px;
                text-decoration: underline;
            }

            .links > a {
                width:100vw;
                color: #ffffff;
                padding: 0 10px;
                font-size: 13px;
                font-weight: 600;
                letter-spacing: .1rem;
                text-decoration: none;
                text-transform: uppercase;
                float:none;
            }

            .m-b-md {
              margin-top: 20px;
                text-align: center;
                margin-left: 30px;
            }
            .logo-container{
              display: inline;
              float: left;
              width: 30vw;
            }
            .logo{
                height:200px;
            }

            .motto-container{
              width:70vw;
              float:right;
            }

            .motto{
              color:#ffffff;
              font-family: 'Abril Fatface', cursive;
                  padding-top: 45px;
                  font-size: 52px;
                  text-decoration: bold;
                  text-align: center;
            }

            .nav{
              text-align: center;
              width:100vw;
              height: 30px;
              background-color: #000000;
            }
            .main{
              padding-top: 50px;
              background-color: #404040;
              height: auto;
            }
            .description{
              display: block;
              padding-bottom: 1px;
              margin-top:20px;
              margin-bottom:50px;
              margin-left: 20vw;
              margin-right: 20vw;
              color: #ffffff;
              text-align: center;
            }
          .banner{
            height:350px;
          }
          .line{
            background-color: #000000;
            height: 3px;
            margin-left: 2vw;
            width: 95vw;
          }
          .footer{
            text-align: center;
            margin-top: 50px;
          }
          .half-container{
            margin: 0px;
            width:80vw;
            padding-left: 10vw;
            padding-right: 10vw;
            overflow: hidden;
          }
          .half{
            margin-left: 0;
            margin-right: 0;
            border: 20vw;
            float:left;
            max-width: 40vw;
            width: auto;
          }
          .half h1{
            color: #45a5ed;
          }
        </style>
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

            <div class="content">
              <div class="logo-container">
              <div class="logo">
                <a href="welcome"><img src={{ asset('img/logo.png')}} class="logo"></img></a>
              </div>
            </div>
            <div class="motto-container">
              <div class="motto">
                  Mayor empresa de envios en venezuela.
              </div>
            </div>
            </div>
              <div class="nav">
                <div class="links">
                    <a href="quienes_somos">¿Quienes Somos?</a>
                    <a href="usuario">Usuarios</a>
                    <a href="rol">Roles</a>
                    <a href="sucursal">Sucursales</a>
                    <a href="transporte">Transportes T</a>
                    <a href="transporteM">Transportes M</a>
                    <a href="transporteA">Transportes A</a>
                    <a href="cliente">Clientes</a>
                    <a href="empleado">Empleados</a>
                    <a href="ruta">Rutas</a>
                    <a href="envio">Envios</a>
                </div>
              </div>
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
              <div class="line-container">
                <div class="line">
                </div>
              </div>
              <div class="footer">
                Envíos UCAB, Rif: J-00274758-7, LogUCAB Venezuela todos los derechos reservados<br>
Diseñado y desarrollado por SSR Lerana C.A.

              </div>
        </div>
    </body>
</html>
