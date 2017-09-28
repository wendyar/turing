<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>

<section class="contenido__principal">
  <article>
    <h3>¡Hola <?php echo ucfirst($this->session->userdata('sesion_nombre_usuario')) ?>!</h3>

    <form class="form" action="<?php echo base_url().'usuario/contrasena' ?>" method="post">
      <!-- Contraseña actual -->
      <div class="form_item row gutters">
        <label class="small col col-3" for="usuario_contra_actual"><b>Contraseña actual</b></label>
        <input class="small col col-9" type="password" name="usuario_contra_actual" id="usuario_contra_actual" value="" placeholder="Ingresa tu contraseña actual">
      </div>
      <?php echo form_error('usuario_contra_actual') ?>

      <!-- Nueva contraseña -->
      <div class="form_item row gutters">
        <label class="small col col-3" for="usuario_contra_nueva"><b>Nueva contraseña</b></label>
        <input class="small col col-9" type="password" name="usuario_contra_nueva" id="usuario_contra_nueva" value="<?php echo set_value('usuario_contra_nueva') ?>" placeholder="Ingresa una nueva contraseña">
      </div>
      <?php echo form_error('usuario_contra_nueva') ?>

      <!-- Repetir nueva contraseña -->
      <div class="form_item row gutters">
        <label class="small col col-3" for="usuario_contra_rep"><b>Repite la nueva contraseña</b></label>
        <input class="small col col-9" type="password" name="usuario_contra_rep" id="usuario_contra_rep" value="<?php echo set_value('usuario_contra_rep') ?>" placeholder="Repite la contraseña">
      </div>
      <?php echo form_error('usuario_contra_rep') ?>

      <br>
      <div class="form_item">
        <button class="small" type="submit" name="btn_actualizar-perfil" class="button">Actualizar contraseña</button>
      </div>
    </form>
  </article>
</section>
