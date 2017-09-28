<?php
# @Author: Wendy Guadalupe Magaña Argente <wendylu>
# @Date:   2017-09-08T22:51:20-05:00
# @Email:  wendyargente@nube.unadmexico.mx
# @Project: Turing
# @Filename: header.php
# @Last modified by:   wendylu
# @Last modified time: 2017-09-10T21:57:49-05:00
# @License: MIT
?>

<header class="cabecera__contenedor row">
  <?php if ($this->session->has_userdata('sesion_id_usuario')): ?>
  <nav class="menu__usuario col-12 row">
    <a href="#" data-component="dropdown" data-target="#submenu" class="push-right" id="userMenu">
      <b> <?php echo ucfirst($this->session->userdata('sesion_nombre_usuario')); ?> </b><span class="caret down"></span>
    </a>

    <!-- Dropdown -->
    <div class="dropdown hide" id="submenu">
      <ul>
        <li><a href="<?php echo base_url().'usuario/perfil' ?>">Perfil</a></li>
        <li><a href="perfil.html#configuracion">Configuración</a></li>
        <li><a href="perfil.html#historial">Historial</a></li>
        <br>
        <li><a href="<?php echo base_url().'inicio/salir' ?>"><b>Cerrar sesión</b></a></li>
      </ul>
    </div>
  </nav>
<?php else: ?>
  <div class="col col-12 inises__contenedor">
    <a href=<?php echo base_url()."inicio/ingresar" ?> >Iniciar sesión</a>
    <a href=<?php echo base_url()."inicio/registrar" ?> >Registrarse</a>
  </div>
<?php endif; ?>


  <div class="col col-12 row auto menu__contenedor">
    <div class="col">
      <h1 class="menu__titulo">Biblioteca Virtual Turing</h1>
    </div>

    <nav class="menu col row" >
      <a class="menu__item col" href=<?php echo base_url()."inicio" ?> >Inicio</a>
      <a class="menu__item col" href=<?php echo base_url()."inicio/informacion" ?> >Información</a>
      <a class="menu__item col" href=<?php echo base_url()."inicio/categorias" ?> >categorías</a>
    </nav>
  </div>

</header>
<div class="linea-nav"> </div>
