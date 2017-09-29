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


    <!-- Carga el contenido principal -->
    <?php $this->load->view($pagina); ?>

    <footer class="footer">
      <div class="footer__content">
        Copyright 2017 - Wendy Argente
      </div>
    </footer>

    <?php $this->load->view('layouts/_includes/js_files'); ?>
  </body>
</html>
