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
        <title>Permisos - LogUCAB</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet" type="text/css">
        <link href="https://fonts.googleapis.com/css?family=Abril+Fatface" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css?family=Lato" rel="stylesheet">
    </head>
    <body>
            @include('header')
           <div class="container contLogin" align="center" style="background-color:#404040;">
          <h3 style="color:#fff;"><b>Inicio de sesión</b><br/>Solo para empleados</h3>
            <br/>
          <form class="form-inline">
            <div class="input-group">
              <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
              <input id="uss" type="text" class="form-control inputLogin" name="uss" placeholder="Usuario">
            </div>
            <br/>
            <br/>
            <div class="input-group">
              <span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>
              <input id="password" type="password" class="form-control inputLogin" name="password" placeholder="Contraseña">
            </div>
            <br/><br/><br/>
            <div >
             <a type="reset" class="btn btn-info btn-lg entra" >Entrar</a>

            </div>
            <br/><br/><br/>
          </form>
        </div>
        <script src="//code.jquery.com/jquery.js"></script>
        <script src="//cdn.datatables.net/1.10.7/js/jquery.dataTables.min.js"></script>
        <script src="//netdna.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>
        <script>$(function() {

          $('#users-table').DataTable({
          })

          $(document).on('click','.entra',function(){

            var usuario = $('#uss').val();
            var password = $('#password').val();
            console.log(usuario);
            console.log(password);
            if(usuario != "" && password != ""){
              document.cookie = "usuario=; expires=Thu, 01 Jan 1970 00:00:00 UTC;";
              document.cookie = "password=; expires=Thu, 01 Jan 1970 00:00:00 UTC;";
              document.cookie = "usuario=" + usuario;
              document.cookie = "password=" + password;
              console.log("los que valida "+document.cookie);
              var url = "{{url('/welcome')}}";
              window.location = url;
            }
          });
        });
        </script>
        @stack('scripts')
        @include('footer')
        </div>
      </div>
    </body>
</html>
