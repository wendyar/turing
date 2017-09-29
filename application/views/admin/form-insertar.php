<?php
# @Author: Wendy Guadalupe Magaña Argente <wendylu>
# @Date:   2017-09-05T08:10:03-05:00
# @Email:  wendyargente@nube.unadmexico.mx
# @Project: Turing
# @Filename: insertar.php
# @Last modified by:   wendylu
# @License: MIT
?>

<section class="contenido__principal" id="app">

  <article class="">
    <h2>Registrar nuevo libro</h2>

    <form class="form" action=<?php echo base_url().'/admin/insertarLibro' ?> method="post">

      <!-- Registrar autor -->
      <div class="row gutters auto">
        <!-- Nuevo autor -->
        <transition name="fade">
          <div class="col"
               v-if='!autor_existente'>
            <!-- Nombres del autor -->
            <div class="form-item">
              <label for="autor-nombres">Nombre del autor</label>
              <input type="text" name="autor-nombres" id="autor-nombres" value="<?php echo "Esto es una prueba" ?>" placeholder="Escribe los nombres del autor"  v-model='autor_nuevo_nombres'>
            </div>

            <!-- Apellidos del autor -->
            <div class="form-item">
              <label for="autor-apellidos">Apellidos</label>
              <input type="text" name="autor-apellidos" id="autor-apellidos" value="" placeholder="Escribe los apellidos del autor"  v-model='autor_nuevo_apellidos'>
            </div>

            <!-- Nacionalidad del autor -->
            <div class="form-item">
              <label for="pais_id">Nacionalidad</label>
              <select class="pais_id" name="pais_id" id="pais_id" v-model='autor_nuevo_pais' >
                <option value=""> -- </option>
                <?php if (isset($paises)): ?>

                  <?php foreach ($paises->result() as $pais): ?>
                    <!-- Inicio del ciclo for -->
                    <option value="<?php echo $pais->id ?>"><?php echo $pais->nombre ?></option>
                    <!-- Fin del ciclo for -->
                  <?php endforeach; ?>

                <?php endif; ?>
              </select>
            </div>
          </div> <!-- Fin col col-6 -->
        </transition>
        <!--/Nuevo autor -->

        <!-- Autor existente -->
        <transition name="fade">
          <div class="col" v-if='!datos_autor()'>
            <div class="form-item">
              <label for="autor-existente">Elegir un autor existente</label>
              <select class="" name="autor-existente" id="autor-existente" v-model='autor_existente'>
                <option value=""> -- </option>

                <?php if (isset($autores)): ?>

                  <?php foreach ($autores->result() as $autor): ?>
                    <option value="<?php echo $autor->id ?>"><?php echo $autor->nombres ?></option>
                  <?php endforeach; ?>

                <?php endif; ?>


              </select>
            </div>
          </div>
        </transition>

      </div>

      <!-- Categoría del libro -->
      <div class="row gutters auto">
        <!-- Opción para nueva categoría -->
        <transition name="fade">
          <div class="col" v-if='!categoria_existente'>
            <div class="form-item">
              <label for="categoria">Escribe una nueva categoría</label>
              <input type="text" name="categoria" id="categoria" placeholder="Escribe la categoría del libro" value="" v-model='categoria_nueva' >
            </div>
          </div>
        </transition>
        <!--/Opción para nueva categoría -->

        <!-- Opción para la categoría existente -->
        <transition name="fade">
          <div class="col" v-if='!categoria_nueva'>
            <div class="form-item">
              <label for="categoria-existente">Elegir una categoría existente</label>

              <select class="" name="categoria-existente" v-model='categoria_existente' >
                <option value=""> -- </option>

                <?php if (isset($categorias)): ?>
                  <?php foreach ($categorias->result() as $categoria): ?>
                      <option value="<?php echo $categoria->id ?>"><?php echo $categoria->nombre ?></option>
                  <?php endforeach; ?>
                <?php endif; ?>
            </select>

            </div>
          </div>
        </transition>
        <!--/Opción para la categoría existente -->
      </div>

      <!-- Título del título -->
      <div class="form-item">
        <label for="titulo">Título</label>
        <input type="text" name="titulo" id="titulo" value="" placeholder="Escribe el título del libro" >
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
