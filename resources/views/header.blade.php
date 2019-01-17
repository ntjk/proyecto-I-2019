<div class="content">
  <div class="logo-container">
  <div class="logo">
    <a href="welcome"><img src={{ asset('img/logo.png')}} class="logo"></img></a>
  </div>
</div>
<div class="motto-container">
  <div class="motto">
      Mayor empresa de envíos en Venezuela.
  </div>
</div>
</div>
  <div class="nav">
    <div class="links">
        <a href="quienes_somos">¿Quienes Somos?</a>
        <a id="consultas" href="consultas">Consultas</a>
        <a href="buscadorChequeo">Rastreo de envíos</a>
        <a href="inicioSesion">Empleados</a>
        <div class="dropdown">
          <a onclick="myFunction()" class="dropbtn">Tablas</a>
          <div id="myDropdown" class="dropdown-content">
            <a id="usuario" href="usuario">Usuarios</a>
            <a id="rol" href="rol">Roles</a>
            <a id="sucursal" href="sucursal">Sucursales</a>
            <a id="transporte" href="transporte">Transportes T</a>
            <a id="transporteM" href="transporteM">Transportes M</a>
            <a id="transporteA" href="transporteA">Transportes A</a>
            <a id="cliente" href="cliente">Clientes</a>
            <a id="empleado" href="empleado">Empleados</a>
            <a id="ruta" href="floru">Rutas</a>
            <a id="envio" href="envio">Envios</a>
            <a id="asistencia" href="asistencia">Asistencias</a>
          </div>
        <a id="alerta" href="#" class="notification">
          <span>Alertas</span>
          <span class="badge" id="badge">1</span>
        </a>
        <a id="cerrarSesion" class="sale">Cerrar sesión</a>
        </div>
      </div>
    </div>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
    <script>
      $(document).ready(function () {

        $('#envio').hide();
        $('#usuario').hide();
        $('#rol').hide();
        $('#sucursal').hide();
        $('#transporte').hide();
        $('#transporteM').hide();
        $('#transporteA').hide();
        $('#cliente').hide();
        $('#empleado').hide();
        $('#ruta').hide();
        $('#asistencia').hide();
        $('#consultas').hide();
        $('#alerta').hide();
        $('#badge').hide();
        var envios = '{!! verificarPermisosHelper("ver envios"); !!}';
        var usuario = '{!! verificarPermisosHelper("ver usuarios"); !!}';
        var rol = '{!! verificarPermisosHelper("ver roles"); !!}';
        var sucursal = '{!! verificarPermisosHelper("ver sucursales"); !!}';
        var flota = '{!! verificarPermisosHelper("ver flotas"); !!}';
        var cliente = '{!! verificarPermisosHelper("ver clientes"); !!}';
        var empleado = '{!! verificarPermisosHelper("ver empleados"); !!}';
        var ruta = '{!! verificarPermisosHelper("ver rutas"); !!}';
        var asistencia = '{!! verificarPermisosHelper("ver asistencias"); !!}';
        var consultas = '{!! verificarPermisosHelper("ver reportes"); !!}';
        var alertas = '{!! verificarPermisosHelper("ver alertas"); !!}';
        var alerta = '{!! alerta24(); !!}';
        console.log(alerta);
        if(alertas){
          $('#alerta').show();
        }
        if(alerta==1 && alertas==1){
          $('#badge').show();
        }
        if(envios)
          $('#envio').show();
        if(envios)
          $('#envio').show();
        if(usuario)
          $('#usuario').show();
        if(rol)
          $('#rol').show();
        if(sucursal)
          $('#sucursal').show();
        if(flota){
          $('#transporte').show();
          $('#transporteM').show();
          $('#transporteA').show();
        }
        if(cliente)
          $('#cliente').show();
        if(empleado)
          $('#empleado').show();
        if(ruta)
          $('#ruta').show();
        if(asistencia)
          $('#asistencia').show();
        if(consultas)
          $('#consultas').show();


         $(document).on('click','.sale',function(){
            document.cookie = "usuario=; expires=Thu, 01 Jan 1970 00:00:00 UTC;";
            document.cookie = "password=; expires=Thu, 01 Jan 1970 00:00:00 UTC;";
            document.cookie = "usuario=" + " ";
            var url = "{{url('/inicioSesion')}}";
            window.location = url;
         });

         $(document).on('click','.notification',function(){
            alert("Hay paquetes en la oficina origen con más de 24 horas");
         });

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
