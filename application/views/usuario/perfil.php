<?php
defined('BASEPATH') OR exit('No direct script access allowed');

$nom_val      = isset($u_nom) ? $u_nom : set_value('nombre_usuario');
$nom_real_val = isset($u_nom_real) ? $u_nom_real : set_value('nombre_real');
$correo       = isset($u_correo) ? $u_correo : set_value('usuario_mail');
$date         = date_create($this->session->userdata('sesion_registro_usuario'));
?>
<section class="contenido__principal">

  <article>

    <h3>¡Hola <?php echo ucfirst($this->session->userdata('sesion_nombre_usuario')) ?>!</h3>
    <div class="form__cuenta">

      <form class="form" action="<?php echo base_url().'usuario/perfil' ?>" method="post">

        <!-- Fecha de registro -->
        <div class="form_item row gutters">
          <label class="small col col-3" for="fecha_registro"><b>Fecha de registro</b></label>
          <label class="small col col-9" for=""><?php echo date_format($date, 'g:i a \o\n l jS F Y'); ?></label>
        </div>

        <!-- Nombre de la persona -->
        <div class="form_item row gutters">
          <label class="small col col-3" for="nombre_real "><b>Nombre completo</b></label>
          <input class="small col col-9" type="text" name="nombre_real" id="nombre_real" value="<?php echo $nom_real_val ?>" placeholder="Nombre real">
        </div>
        <?php echo form_error('nombre_real') ?>

        <!-- Nombre de usuario -->
        <div class="form_item row gutters">
          <label class="small col col-3" for="nombre_usuario"><b>Nombre de usuario</b></label>
          <input class="small col col-9" type="text" name="nombre_usuario" id="nombre_usuario" value="<?php echo $nom_val ?>" placeholder="Nombre de usuario">
        </div>
        <?php if ($this->session->has_userdata('sesion_error_nombre')): ?>
          <div class="form_item row gutters">
            <div class="col col-3 hide-sm"> </div>
            <div class="desc error-text col col-9">
              <?php echo $this->session->userdata('sesion_error_nombre'); ?>
            </div>
          </div>
        <?php endif; ?>
        <?php echo form_error('nombre_usuario') ?>



        <!-- Correo personal -->
        <div class="form_item row gutters">
          <label class="small col col-3" for="usuario_mail"><b>Correo electrónico</b></label>
          <input class="small col col-9" type="mail" name="usuario_mail" id="usuario_mail" value="<?php echo $correo ?>" placeholder="Correo-e">
        </div>
        <?php if ($this->session->has_userdata('sesion_error_correo')): ?>
          <div class="form_item row gutters">
            <div class="col col-3 hide-sm"> </div>
            <div class="desc error-text col col-9">
              <?php echo $this->session->userdata('sesion_error_correo'); ?>
            </div>
          </div>
        <?php endif; ?>
        <?php echo form_error('usuario_mail') ?>



        <br>
        <div class="form_item">
          <button class="small" type="submit" name="btn_actualizar-perfil" class="button">Actualizar perfil</button>
        </div>
      </form>
    </div>

  </article>
</section>
