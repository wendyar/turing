<?php
# @Author: Wendy Guadalupe Magaña Argente <wendylu>
# @Date:   2017-09-08T23:08:15-05:00
# @Email:  wendyargente@nube.unadmexico.mx
# @Project: Turing
# @Filename: admin.php
# @Last modified by:   wendylu
# @Last modified time: 2017-09-10T07:27:34-05:00
# @License: MIT
?>

<section class="contenido__principal">
  <article>
    <h2>Administración</h2>

    <fieldset>
      <legend><span class="success">Agregar nuevo libro</span></legend>
      <a href=<?php echo BASE_URL."/admin/formNuevoLibro" ?> class="button btn-success">Agregar nuevo libro</a>
    </fieldset>

    <fieldset>
      <legend><span class="error">Eliminar un libro</span></legend>
      <a href=<?php echo BASE_URL."/admin/formBorrarLibro" ?> class="button btn-error">Borrar un libro</a>
    </fieldset>
  </article>
</section>
