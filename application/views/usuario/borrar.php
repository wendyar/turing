<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<section class="contenido__principal">
  <article>
    <h3>Eliminar cuenta</h3>
    <form class="form" action="<?php echo base_url().'usuario/borrar' ?>" method="post">
      <div class="form_item row gutters">
        <label class="col col-3 small" for="contrasena_eliminar">Contraseña actual</label>
        <input class="col col-9 small" type="password" name="contrasena_eliminar" id="contrasena_eliminar" value="" placeholder="Ingresa tu contraseña">
      </div>
      <?php echo form_error('contrasena_eliminar') ?>

      <br>
      <div class="form_item">
        <button type="submit" name="btn_eliminar_cuenta" class="button btn-error small">Eliminar cuenta</button>
      </div>
    </form>
  </article>
</section>
