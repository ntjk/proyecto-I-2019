<!doctype html>
<html lang="<?php echo e(str_replace('_', '-', app()->getLocale())); ?>">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link href="<?php echo e(asset('css/styles.css')); ?>" rel="stylesheet">
        <script type="text/javascript" src="<?php echo e(asset('js/dropdown.js')); ?>"></script>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>

        <title>Inicio</title>

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
                <div class="banner">
                  <div class="third">
                    <img src=<?php echo e(asset('img/main_banner_1.jpg')); ?> class="mbp">
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
              <script src="//code.jquery.com/jquery.js"></script>
              <script src="//cdn.datatables.net/1.10.7/js/jquery.dataTables.min.js"></script>
              <script src="//netdna.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>
              <script>
              $(document).ready(function () {
                //function leerUsuario() {
                  var lasCookies = document.cookie;
                  //document.write ("All Cookies : " + lasCookies );
                  
                  // Get all the cookies pairs in an array
                  cookieArray = lasCookies.split(';');
                  //varriable = cookieArray[i].split('=')[0];
                  var usu = cookieArray[0].split('=')[1];
                  var contra = cookieArray[1].split('=')[1];
                  console.log("Usu "+usu);
                  console.log("Contra "+contra);
                //}
              });
              </script>

              <?php echo $__env->make('footer', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>
        </div>
    </body>
</html>
