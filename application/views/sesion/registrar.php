<div class="contenedor">
  <h1 class="titulo">Registro</h1>
  <form class="form-inicio" action="<?php echo base_url().'index.php/inicio/registrar' ?>" method="post" class="form">

    <!-- Nombre de usuario -->
    <div class="form-item">
      <label class="small" for="nombre-usuario">Nombre de usuario <span class="req">*</span></label>
      <input class="small" type="text" name="nombre-usuario" id="nombre-usuario" value="<?php echo set_value('nombre-usuario') ?>" placeholder="Ingresa un nuevo nombre de usuario">
      <?php echo form_error('nombre-usuario') ?>
    </div>

    <!-- Nombre real -->
    <div class="form-item">
      <label class="small" for="nombre-real">Nombre real <span class="req">*</span></label>
      <input class="small" type="text" name="nombre-real" value="<?php echo set_value('nombre-real') ?>" placeholder="Ingresa tu nombre real">
      <?php echo form_error('nombre-real') ?>
    </div>

    <!-- Correo electrónico -->
    <div class="form-item">
      <label class="small" for="correo-e">Correo electrónico <span class="req">*</span></label>
      <input class="small" type="email" name="correo-e" id="correo-e" value="<?php echo set_value('correo-e') ?>" placeholder="Ingresa tu correo electrónico actual">
      <?php echo form_error('correo-e') ?>
    </div>

    <!-- Contraseña -->
    <div class="form-item">
      <label class="small" for="contrasena">Crea una nueva contraseña <span class="req">*</span></label>
      <input class="small" type="password" name="contrasena" id="contrasena" value="<?php echo set_value('contrasena') ?>">
      <?php echo form_error('contrasena') ?>
    </div>

    <!-- Repetir contraseña -->
    <div class="form-item">
      <label class="small" for="rep-contrasena">Repite la contraseña <span class="req">*</span></label>
      <input class="small" type="password" name="rep-contrasena" id="rep-contrasena" value="<?php echo set_value('rep-contrasena') ?>">
      <?php echo form_error('rep-contrasena') ?>
    </div>

    <div class="form-item">
      <button type="submit" name="btn-enviar" id="btn-enviar" class="button w100 btn-success">Registrar</button>
    </div>


  </form>
</div>
