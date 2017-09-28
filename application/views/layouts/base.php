<?php
# @Author: Wendy Guadalupe Magaña Argente <wendylu>
# @Date:   2017-08-30T21:44:40-05:00
# @Email:  wendyargente@nube.unadmexico.mx
# @Project: Turing
# @Last modified by:   wendylu
# @Last modified time: 2017-09-10T11:19:35-05:00
# @License: MIT
?>
<!DOCTYPE html>
<html lang="es">
  <head>
    <?php $this->load->view('layouts/_includes/head') ?>

    <link rel="stylesheet" href="<?php echo STATICPATH.'js/vegas/vegas.min.css'; ?>" >
    <link rel="stylesheet" href="<?php echo STATICPATH.'css/base.min.css' ?>" >
  </head>
  <body>

    <?php // Mensaje de notificación si es que lo hay ?>
    <?php if (isset($GLOBALS['message'])): ?>
      <div class="mymessage type-<?php echo $GLOBALS['type_message'] ?>" id="toggle-message"  >
        <div class="container">
          <?php echo $GLOBALS['message'] ?>
          <span class="close" data-target="#toggle-message"></span>
        </div>
      </div>
    <?php endif; ?>

    <div class="contenedor__principal" id="app">
      <?php $this->load->view('layouts/_includes/header') ?>

      <?php $this->load->view($pagina) ?>

      <footer class="pie-principal">Copyright 2017 - Wendy Argente</footer>
    </div>

    <?php $this->load->view('layouts/_includes/js_files') ?>
  </body>
</html>
