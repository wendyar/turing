<?php
# @Author: Wendy Guadalupe Magaña Argente <wendylu>
# @Date:   2017-09-05T08:10:03-05:00
# @Email:  wendyargente@nube.unadmexico.mx
# @Project: Turing
# @Filename: insertar.php
# @Last modified by:   wendylu
# @Last modified time: 2017-09-06T05:38:45-05:00
# @License: MIT




include_once('basedatos.php');

$db->connect();

// Obtiene todos los registros de la tabla autores
$autores = $db->get('autor');

// Obtiene todos los registros de la tabla de categoria
$categorias = $db->get('categorias');

// Obtiene la lista de los países existentes
$paises = $db->get('pais');

?>
  <!DOCTYPE html>
  <html lang="es">

  <head>
    <meta charset="utf-8">
    <meta http-equiv="content-language" content="es">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> Registrar nuevo libro </title>

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

        <div class="col col-12 row menu__contenedor">
          <div class="col col-6">
            <h1 class="menu__titulo">Biblioteca Virtual Turing</h1>
          </div>

          <nav class="menu col col-6">
            <a class="menu__item" href="index.html">Inicio</a>
            <a class="menu__item" href="informacion.html">Información</a>
            <a class="menu__item" href="categorias.html">categorías</a>
            <a href="admin.html" class="menu__item "><span class="info-text">Administración</span></a>
          </nav>
        </div>

      </header>


      <section class="contenido__principal" id="app">
        <pre>
          {{ $data }}
        </pre>

        <article class="">
          <h2>Registrar nuevo libro</h2>

          <form class="form" action="insertar.php" method="post">

            <!-- Registrar autor -->
            <div class="row gutters auto">
              <div class="col">
                <!-- Nombres del autor -->
                <div class="form-item">
                  <label for="autor-nombres">Nombre del autor</label>
                  <input type="text" name="autor-nombres" id="autor-nombres" value="" placeholder="Escribe los nombres del autor" required v-model='autor_nuevo_nombres'>
                </div>

                <!-- Apellidos del autor -->
                <div class="form-item">
                  <label for="autor-apellidos">Apellidos</label>
                  <input type="text" name="autor-apellidos" id="autor-apellidos" value="" placeholder="Escribe los apellidos del autor" required v-model='autor_nuevo_apellidos'>
                </div>

                <!-- Nacionalidad del autor -->
                <div class="form-item">
                  <label for="pais_id">Nacionalidad</label>
                  <select class="pais_id" name="pais_id" id="pais_id" v-model='autor_nuevo_pais' required>
                    <option value=""> -- </option>
                    <?php if (isset($paises)): ?>
                      <?php while ($pais = $paises->fetch_object()) { ?>

                        <!-- Inicio del ciclo for -->
                        <option value="<?php echo $pais->id ?>"><?php echo $pais->nombre ?></option>
                        <!-- Fin del ciclo for -->

                      <?php } ?>
                    <?php endif; ?>
                  </select>
                </div>
              </div> <!-- Fin col col-6 -->

              <!-- Autor existente -->
              <div class="col" v-if='!datos_autor()'>
                <div class="form-item">
                  <label for="autor-existente">Elegir un autor existente</label>
                  <select class="" name="autor-existente" id="autor-existente" v-model='autor_existente'>
                    <option value=""> -- </option>
                    <option value="1"> Este autor </option>

                    <?php if (isset($autores)): ?>
                      <?php while ($autor = $autores->fetch_object()) { ?>

                        <!-- Inicio del ciclo for -->
                        <option value="<?php echo $autor->id ?>"><?php echo $autor->nombres ?></option>
                        <!-- Fin del ciclo for -->

                      <?php } ?>
                    <?php endif; ?>


                  </select>
                </div>
              </div>
            </div>

            <!-- Categoría del libro -->
            <div class="row gutters auto">
              <div class="col" v-if='!categoria_existente'>
                <div class="form-item">
                  <label for="categoria">Escribe una nueva categoría</label>
                  <input type="text" name="categoria" id="categoria" placeholder="Escribe la categoría del libro" value="" v-model='categoria_nueva' required>
                </div>
              </div>
              <div class="col" v-if='!categoria_nueva'>
                <div class="form-item">
                  <label for="categoria-existente">Elegir una categoría existente</label>

                  <select class="" name="categoria-existente" v-model='categoria_existente' required>
                    <option value=""> -- </option>

                    <?php if (isset($categorias)): ?>
                      <?php while ($categoria = $categorias->fetch_object()) { ?>

                        <!-- Inicio del ciclo for -->
                        <option value="<?php echo $categoria->id ?>"><?php echo $categoria->nombre ?></option>
                        <!-- Fin del ciclo for -->

                      <?php } ?>
                    <?php endif; ?>

                </select>

                </div>
              </div>
            </div>

            <!-- Título del título -->
            <div class="form-item">
              <label for="titulo">Título</label>
              <input type="text" name="titulo" id="titulo" value="" placeholder="Escribe el título del libro" required>
            </div>

            <!-- Descripción del libro -->
            <div class="form-item">
              <label for="descripcion">Descripción del libro</label>
              <input type="text" name="descripcion" id="descripcion" value="" placeholder="Escribe una descripción para el libro">
            </div>



            <!-- Botón para enviar -->
            <div class="group">
              <button type="submit" name="btn-enviar" id="btn-enviar" class="button float-right">Registrar</button>
            </div>
          </form>
        </article>
      </section>


      <footer class="pie-principal">Copyright 2017 - Wendy Argente</footer>
    </div>

    <!-- Default files -->
    <script src="assets/js/jquery.min.js" charset="utf-8"></script>
    <script src="assets/js/kube.min.js" charset="utf-8"></script>
    <script src="assets/js/vue.min.js" charset="utf-8"></script>
    <script src="assets/js/master.js" charset="utf-8"></script>

    <!-- Additional script files -->
    <script src="assets/js/vegas/vegas.min.js" charset="utf-8"></script>
    <script src="assets/js/base.js" charset="utf-8"></script>
  </body>

  </html>
