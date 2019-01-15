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
        <title>Rastreo - LogUCAB</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet" type="text/css">
        <link href="https://fonts.googleapis.com/css?family=Abril+Fatface" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css?family=Lato" rel="stylesheet">
    </head>
    <body>
        @include('header')
        <div class="container">
        <br/>
        <h1 class="text-center">Rastreo del envío</h1>
        <br/>
			<form method="post" id="user_form">
					<label class="labelDestacado">Ingrese el nro. de guía</label>
					<input name="fk_envio"  id="fk_envio" class="buscador">
				<br/><br/>
				<!-- <button href="" type="reset" name="action" onclick="navigate(this,'fk_envio')" id="action" class="btn btn-info btn-lg buscar" value="Buscar"> -->
        <a type="reset" class="btn btn-info btn-lg" onclick="navigate(this,'fk_envio')">Buscar</a>
        <script>
        function navigate(link, inputid){
          var url = "{{url('/chequeo')}}" + document.getElementById(inputid).value;
          window.location.href = url; //navigates to the given url, disabled for demo
          //alert(url);
        }
        </script>
			</form>
        </div>
		<br/><br/>

		<script src="//code.jquery.com/jquery.js"></script>
        <script src="//cdn.datatables.net/1.10.7/js/jquery.dataTables.min.js"></script>
        <script src="//netdna.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>
        @stack('scripts')
        @include('footer')
        </div>
      </div>
    </body>
</html>
