<?php
# @Author: Wendy Guadalupe Magaña Argente <wendylu>
# @Date:   2017-08-30T21:44:40-05:00
# @Email:  wendyargente@nube.unadmexico.mx
# @Project: Turing
# @Last modified by:   wendylu
# @Last modified time: 2017-08-31T03:05:09-05:00
# @License: MIT
?>
<!DOCTYPE html>
<html lang="es">
  <head>
    <?php $this->view->include('head') ?>
  </head>
  <body>
    <div class="contenedor__principal">
      <?php $this->view->include('header') ?>

      <?php $this->view->include($this->pagina, "views/") ?>

      <footer class="pie-principal">Copyright 2017 - Wendy Argente</footer>
    </div>

    <?php $this->view->include('js_files') ?>
  </body>
</html>
