<?php
# @Author: Wendy Guadalupe Magaña Argente <wendylu>
# @Date:   2017-09-05T07:51:13-05:00
# @Email:  wendyargente@nube.unadmexico.mx
# @Project: Turing
# @Filename: consulta.php
# @Last modified by:   wendylu
# @Last modified time: 2017-09-06T06:54:51-05:00
# @License: MIT



include_once('basedatos.php');

$db->connect();

$libros = $db->get('libro');

?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="utf-8">
  <meta http-equiv="content-language" content="es">

  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title> Lista de libros registrados </title>

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
        <h2>Lista de libros registrados</h2>

        <table class="bordered">
          <thead>
            <th>Id</th>
            <th>Título</th>
            <th>Descripción</th>
            <th>Autor</th>
            <th>Categoría</th>
          </thead>

            <?php if (isset($libros)): ?>
              <?php while ($libro = $libros->fetch_object()) { ?>
                <tbody>
                <!-- Inicio del ciclo for -->
                <td><?php echo $libro->id ?></td>
                <td><?php echo $libro->titulo ?></td>
                <td><?php echo $libro->descripcion ?></td>

                <?php
                    $db->where('id', $libro->autor_id);
                    $autor = $db->get('autor', 'object');
                ?>
                <td><?php echo "$autor->nombres $autor->apellidos" ?></td>

                <?php
                  $db->where('id', $libro->categorias_id);
                  $categoria = $db->get('categorias', 'object');
                ?>
                <td><?php echo $categoria->nombre ?></td>
                <!-- Fin del ciclo for -->
              </tbody>
              <?php } ?>
            <?php endif; ?>

        </table>
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
<?php

$db->close();
?>
