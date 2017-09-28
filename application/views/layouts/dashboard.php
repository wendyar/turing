<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<!DOCTYPE html>
<html>
  <head>
    <!-- Font awesome -->
    <link rel="stylesheet" href="<?php echo STATICPATH.'css/font-awesome.min.css' ?>">
    <?php $this->load->view('layouts/_includes/head'); ?>
    <!-- Custom style for this template -->
    <link rel="stylesheet" href="<?php echo STATICPATH.'css/admin.min.css' ?>">
  </head>
  <body>

    <!-- Top nav -->
    <nav class="top-nav">
      <div class="container row">
        <!-- logo -->
        <div class="container_logo col-6 hide-sm"><h1><a href="<?php echo base_url() ?>">Biblioteca Virtual Turing</a></h1></div>

        <!-- Iconos -->
        <div class="container_icons col-6">
          <a href="<?php echo base_url().'blog/' ?>"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a>
          <a href="<?php echo base_url().'usuario/perfil' ?>"><i class="fa fa-user-o" aria-hidden="true"></i></a>
        </div>
      </div>
    </nav>
    <!--/Top nav -->

    <!-- Main content -->
    <div class="btn-aside show-sm">
      <button class="button w100" type="button" name="showAside" data-component="toggleme" data-target="#togglebox-sidebarmenu" data-text="Ocultar menu"><i class="fa fa-bars"></i> Mostrar menú</button>
    </div>

    <div class="container main_content row" id="dashboardContainer">
      <!-- Sidebar menu -->
      <aside class="account__aside col-3 hide-sm" id="togglebox-sidebarmenu">
        <a href="<?php echo base_url().'usuario/' ?>">Dashboard</a>
        <a href="<?php echo base_url().'usuario/perfil' ?>">Editar perfil</a>
        <a href="<?php echo base_url().'usuario/contrasena' ?>">Cambiar contraseña</a>
        <a href="<?php echo base_url().'usuario/borrar' ?>">Eliminar cuenta</a>
        <hr>
        <a href="<?php echo base_url().'inicio/salir' ?>">Cerrar sesión</a>
      </aside>
      <!--/Sidebar menu -->

      <!-- content -->
      <section class="content col-9">
        <?php $this->load->view($pagina); ?>
        <div class="mensaje">
          <span class="<?php echo $this->session->userdata('mensaje_tipo') ?>-text"><b><?php echo $this->session->userdata('mensaje'); ?></b></span>
        </div>
      </section>
      <!--/content -->
    </div>

    <footer class="footer">
      <div class="footer__content">
        Copyright 2017 - Wendy Argente
      </div>
    </footer>

    <?php $this->load->view('layouts/_includes/js_files'); ?>
  </body>
</html>
