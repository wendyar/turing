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
    <?php $this->view->include('head') ?>
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
      <?php $this->view->include('header') ?>

      <?php $this->view->include($this->pagina, "views/") ?>

      <footer class="pie-principal">Copyright 2017 - Wendy Argente</footer>
    </div>

    <?php $this->view->include('js_files') ?>
  </body>
</html>
