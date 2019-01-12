<div class="content">
  <div class="logo-container">
  <div class="logo">
    <a href="welcome"><img src=<?php echo e(asset('img/logo.png')); ?> class="logo"></img></a>
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
        <a href="consultas">Consultas</a>
        <a href="buscadorChequeo">Rastreo de envíos</a>
        <a href="inicioSesion">Empleados</a>
        <div class="dropdown">
          <a onclick="myFunction()" class="dropbtn">Tablas</a>
          <div id="myDropdown" class="dropdown-content">
            <a id="usuario" href="usuario">Usuarios</a>
            <a href="rol">Roles</a>
            <a href="sucursal">Sucursales</a>
            <a href="transporte">Transportes T</a>
            <a href="transporteM">Transportes M</a>
            <a href="transporteA">Transportes A</a>
            <a href="cliente">Clientes</a>
            <a href="empleado">Empleados</a>
            <a href="ruta">Rutas</a>
            <a id="envio" href="envio">Envios</a>
            <a href="tipo">Tipos de Paquete</a>
            <a href="asistencia">Asistencias</a>
          </div>
        </div>
      </div>
    </div>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
    <script>  
      $(document).ready(function () {
      //function leerUsuario() {
        $('#envio').hide();
        $('#usuario').hide(); 
        var ver = '<?php echo verificarPermisosHelper("ver envios");; ?>';
        if(ver)
          $('#envio').show();
      });
    </script>


  <!--<a href="usuario">Usuarios</a>
  <a href="rol">Roles</a>
  <a href="sucursal">Sucursales</a>
  <a href="transporte">Transportes T</a>
  <a href="transporteM">Transportes M</a>
  <a href="transporteA">Transportes A</a>
  <a href="cliente">Clientes</a>
  <a href="empleado">Empleados</a>
  <a href="ruta">Rutas</a>
  <a href="envio">Envios</a>-->
