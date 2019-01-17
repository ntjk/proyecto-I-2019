 <!doctype html>
<html lang="<?php echo e(str_replace('_', '-', app()->getLocale())); ?>">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link href="//netdna.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css" rel="stylesheet">
        <link rel="stylesheet" href="//cdn.datatables.net/1.10.7/css/jquery.dataTables.min.css">
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
        <meta name="csrf-token" content="<?php echo csrf_token(); ?>" />
        <link href="<?php echo e(asset('css/styles.css')); ?>" rel="stylesheet">
        <script type="text/javascript" src="<?php echo e(asset('js/dropdown.js')); ?>"></script>
        <title>Rastreo - LogUCAB</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet" type="text/css">
        <link href="https://fonts.googleapis.com/css?family=Abril+Fatface" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css?family=Lato" rel="stylesheet">
    </head>
    <body>
        <?php echo $__env->make('header', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>
        <div class="container">
        <br/>
        <h1 class="text-center">Filtro de fechas</h1>
        <br/>
			<form method="post" id="user_form">
				<label class="labelDestacado">Seleccione por qué parámetro quiere filtrar</label>
                    <div>
                        <input id="radioFecha" type="radio" name="parametro" class="param" value="fecha"> fecha<br>
                        <input type="radio" name="parametro" class="param" value="rango"> rango
                    </div>
				<br/><br/>
                <input value="<?php echo e($paraDiferenciar); ?>" type="hidden" name="paraDiferenciar" id="paraDiferenciar" />
                <label class="labelDestacado" id="labelFecha">Seleccione la fecha</label>
                <input type="date" name="fecha" id="fecha" class="form-control" />
                <br/>
                <label class="labelDestacado">Seleccione principio del rango</label>
                <input type="date" name="rangoi" id="rangoi" class="form-control" />
                <label class="labelDestacado">Seleccione final del rango</label>
                <input type="date" name="rangof" id="rangof" class="form-control" />
                <br/>
                <a type="reset" class="btn btn-info btn-lg" onclick="navigate(this,'fecha','rangoi','rangof')">Filtrar link</a>
                <script>
                /*$(document).ready(function(){
                    if($('#paraDiferenciar').val() == 12){
                        $('#labelFecha').hide();
                        $('#fecha').hide();
                        $('#radioFecha').hide();
                    }
                });*/

                function navigate(link, fecha, rangoi, rangof){
                    
                    //Para la consulta 6
                    if($('#paraDiferenciar').val() == 6){
                        if ($("input[name=parametro]:checked").val() == "fecha") {
                            var url = "<?php echo e(url('/filtrarFecha_1')); ?>" + document.getElementById(fecha).value;
                            window.location.href = url;
                        }
                    }
                   // Para la consulta 6_2
                    if($('#paraDiferenciar').val() == 6){
                        if ($("input[name=parametro]:checked").val() == "rango") {
                            var url = "<?php echo e(url('/filtrarFecha_2')); ?>" + document.getElementById(rangoi).value + document.getElementById(rangof).value;
                            window.location.href = url; 
                        }
                    }
                    // Para la consulta 12
                    if($('#paraDiferenciar').val() == 12){
                        if ($("input[name=parametro]:checked").val() == "rango") {
                            var url = "<?php echo e(url('/filtrarFecha_3')); ?>" + document.getElementById(rangoi).value + document.getElementById(rangof).value;
                            window.location.href = url; 
                        }
                    }
                    // Para la consulta 46
                    if($('#paraDiferenciar').val() == 46){
                        if ($("input[name=parametro]:checked").val() == "rango") {
                            var url = "<?php echo e(url('/filtrarFecha_46')); ?>" + document.getElementById(rangoi).value + document.getElementById(rangof).value;
                            window.location.href = url; 
                        }
                    }
                }
                </script>

			</form>
        </div>
		<br/><br/>

        <script>$(function() {
            $(".param").click(function() {
                $("#fecha").attr("disabled", true);
                $("#rangoi").attr("disabled", true);
                $("#rangof").attr("disabled", true);
                if ($("input[name=parametro]:checked").val() == "fecha") {
                    var parametro = "fecha";
                    $("#fecha").attr("disabled", false);
                }
                if ($("input[name=parametro]:checked").val() == "rango") {
                    var parametro = "rango";
                    $("#rangoi").attr("disabled", false);
                    $("#rangof").attr("disabled", false);
                }
            });
/*
            $(document).on('submit', '#user_form', function(event){
                event.preventDefault();
                if ($("input[name=parametro]:checked").val() == "rango") {
                    var rangoi = $('#rangoi').val();
                    var rangof = $('#rangof').val();
                    if (rangoi != '' && rangof != ''){
                        $.ajax({
                           headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                          type: "POST",
                          url: "filtrarFecha",
                          data: {
                            rangoi: rangoi,
                            rangof: rangof
                          }
                        });
                    }
                }

            else
              alert("Rellene los campos solicitados");
            });*/

        });
        </script>
		<script src="//code.jquery.com/jquery.js"></script>
        <script src="//cdn.datatables.net/1.10.7/js/jquery.dataTables.min.js"></script>
        <script src="//netdna.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>
        <?php echo $__env->yieldPushContent('scripts'); ?>
        <?php echo $__env->make('footer', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>
        </div>
      </div>
    </body>
</html>