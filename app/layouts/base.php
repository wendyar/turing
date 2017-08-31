<?php
# @Author: Wendy Guadalupe Magaña Argente <wendylu>
# @Date:   2017-08-30T21:44:40-05:00
# @Email:  wendyargente@nube.unadmexico.mx
# @Project: Turing
# @Last modified by:   wendylu
# @Last modified time: 2017-08-31T01:09:07-05:00
# @License: MIT
?>
<!DOCTYPE html>
<html lang="es">
  <head>
    <?php $this->obj->include('head') ?>
  </head>
  <body>
    <div class="contenedor__principal">
      <?php $this->obj->include('header') ?>

      <?php $this->obj->include($this->pagina, 'views/') ?>

      <footer class="pie-principal">Copyright 2017 - Wendy Argente</footer>
    </div>

    <?php $this->obj->include('js_files') ?>
  </body>
</html>
