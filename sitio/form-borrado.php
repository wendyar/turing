<?php
# @Author: Wendy Guadalupe Magaña Argente <wendylu>
# @Date:   2017-09-05T21:40:54-05:00
# @Email:  wendyargente@nube.unadmexico.mx
# @Project: Turing
# @Filename: form-borrado.php
# @Last modified by:   wendylu
# @Last modified time: 2017-09-06T00:09:46-05:00
# @License: MIT

include_once('basedatos.php');

$db->connect();

$libros = $db->get('libro');

$db->close();
?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="utf-8">
  <meta http-equiv="content-language" content="es">

  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>

  </title>

  <link rel="stylesheet" href="assets/css/kube.min.css">
  <!-- Hojas de estilos adicionales, que se recibe como parámetro -->
  <link rel="stylesheet" href="assets/js/vegas/vegas.min.css">
  <link rel="stylesheet" href="assets/css/base.css">
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
        <h2>Borrar libro</h2>

        <form class="form" action="borrado.php" method="post">
          <fieldset>
            <legend><span class="error">Eliminar un título</span></legend>

            <!-- Selección de título -->
            <div class="form-item">
              <label for="titulo_id">Título del libro</label>
              <select class="" name="titulo_id" id="titulo_id" required>
            <option value=""> -- </option>

            <?php
              while ($libro = $libros->fetch_object()) {
                echo "<option value='$libro->id'>$libro->titulo</option>";
              }
            ?>

          </select>
            </div>

            <!-- Botón de enviar -->
            <div class="form-item">
              <button type="submit" name="enviar" class="btn btn-error">Eliminar</button>
            </div>

          </fieldset>
        </form>
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
