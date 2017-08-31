<?php
# @Author: Wendy Guadalupe Magaña Argente <wendylu>
# @Date:   2017-08-31T00:28:21-05:00
# @Email:  wendyargente@nube.unadmexico.mx
# @Project: Turing
# @Last modified by:   wendylu
# @Last modified time: 2017-08-31T00:48:26-05:00
# @License: MIT
?>


<!DOCTYPE html>
<html lang="es">
<head>

  <?php $this->obj->include('head'); ?>

  <link rel="stylesheet" href="<?php echo STATICPATH.'css/form-inicio.css' ?>" >
</head>
  <body>
    <?php $this->obj->include($this->pagina, 'views/') ?>

    <?php $this->obj->include('js_files') ?>
  </body>

</html>
