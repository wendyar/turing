<?php
# @Author: Wendy Guadalupe Magaña Argente <wendylu>
# @Date:   2017-09-05T21:45:57-05:00
# @Email:  wendyargente@nube.unadmexico.mx
# @Project: Turing
# @Filename: borrado.php
# @Last modified by:   wendylu
# @Last modified time: 2017-09-05T22:26:24-05:00
# @License: MIT

include_once('basedatos.php');

$db->connect();


if ($_POST["titulo_id"] != "")
{
  $val = $db->delete('libro',array('id' => $_POST["titulo_id"]));
  if ($val)
  {
    $mensaje = "Elemento eliminado correctamente.";
    $tipo_mensaje = "success";
  }
  else
  {
    $mensaje = "No se ha podido eliminar el elemento.";
    $tipo_mensaje = "error";
  }
}
else
{
  $mensaje = "No se ha elegido una opción";
  $tipo_mensaje = "error";
}



$db->close();
?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="utf-8">
  <meta http-equiv="content-language" content="es">

  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>

    <?php echo $mensaje ?>

  </title>


  <link rel="stylesheet" href="assets/css/kube.min.css">
  <!-- Hojas de estilos adicionales, que se recibe como parámetro -->
  <link rel="stylesheet" href="assets/js/vegas/vegas.min.css">
  <link rel="stylesheet" href="assets/css/base.css">

  <style media="screen">
    .datos {
      background-color: whitesmoke;
      padding: 20px;
      border: 1px solid #e2e4e2;
      border-radius: 5px;
    }
  </style>
</head>
<body>
  <div class="contenedor__principal">
    <header class="cabecera__contenedor row">

      <div class="col col-12 inises__contenedor">
        <a href="ingresar.html">Iniciar sesión</a>
        <a href="registrar.html">Registrarse</a>
      </div>

      <div class="col col-12 row auto menu__contenedor">
        <div class="col">
          <h1 class="menu__titulo">Biblioteca Virtual Turing</h1>
        </div>

        <nav class="menu col">
          <a class="menu__item" href="index.html">Inicio</a>
          <a class="menu__item" href="informacion.html">Información</a>
          <a class="menu__item" href="categorias.html">categorías</a>
          <a href="admin.html" class="menu__item "><span class="info-text">Administración</span></a>
        </nav>
      </div>

    </header>

    <section class="contenido__principal">
      <article>
        <div class="mymessage mymessage-<?php echo $tipo_mensaje ?>">
          <p><strong>¡<?php echo ucfirst($tipo_mensaje) ?>!</strong> <?php echo $mensaje ?></p>
        </div>
      </article>
    </section>

    <footer class="pie-principal">Copyright 2017 - Wendy Argente</footer>
  </div>

  <!-- Default files -->
  <script src="assets/js/jquery.min.js" charset="utf-8"></script>
  <script src="assets/js/kube.min.js" charset="utf-8"></script>


  <!-- Additional script files -->
  <script src="assets/js/vegas/vegas.min.js" charset="utf-8"></script>
  <script src="assets/js/base.js" charset="utf-8"></script>
</body>
</html>
