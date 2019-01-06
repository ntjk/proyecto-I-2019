<!doctype html>
<html lang="<?php echo e(str_replace('_', '-', app()->getLocale())); ?>">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link href="<?php echo e(asset('css/styles.css')); ?>" rel="stylesheet">
        <link href="<?php echo e(asset('css/styles_qs.css')); ?>" rel="stylesheet">
        <script type="text/javascript" src="<?php echo e(asset('js/dropdown.js')); ?>"></script>

        <title>¿Quiénes Somos? - LogUCAB</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet" type="text/css">
        <link href="https://fonts.googleapis.com/css?family=Abril+Fatface" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css?family=Lato" rel="stylesheet">
    </head>
    <body>
      <!--  <div class="flex-center position-ref full-height">
            <?php if(Route::has('login')): ?>
                <div class="top-right links">
                    <?php if(auth()->guard()->check()): ?>
                        <a href="<?php echo e(url('/home')); ?>">Home</a>
                    <?php else: ?>
                        <a href="<?php echo e(route('login')); ?>">Login</a>

                        <?php if(Route::has('register')): ?>
                            <a href="<?php echo e(route('register')); ?>">Register</a>
                        <?php endif; ?>
                    <?php endif; ?>
                </div>
            <?php endif; ?> -->

            <?php echo $__env->make('header', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>
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
                <?php echo $__env->make('footer', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>
        </div>
    </body>
</html>
