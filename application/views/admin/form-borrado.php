<?php
# @Author: Wendy Guadalupe Magaña Argente <wendylu>
# @Date:   2017-09-08T23:54:04-05:00
# @Email:  wendyargente@nube.unadmexico.mx
# @Project: Turing
# @Filename: form-borrado.php
# @Last modified by:   wendylu
# @Last modified time: 2017-09-09T04:06:07-05:00
# @License: MIT



?>
<section class="contenido__principal">
  <article>
    <h2>Borrar libro</h2>

    <form class="form" action=<?php echo base_url()."/admin/borrarLibro" ?> method="post">
      <fieldset>
        <legend><span class="error">Eliminar un título</span></legend>

        <!-- Selección de título -->
        <div class="form-item">
          <label for="titulo_id">Título del libro</label>
          <select class="" name="titulo_id" id="titulo_id" >
        <option value=""> -- </option>

        <?php
          foreach ($libros->result() as $libro)
          {
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
