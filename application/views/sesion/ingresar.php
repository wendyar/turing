<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>

<div class="contenedor">
  <?php if (isset($_SESSION['mensaje'])): ?>
    <?php echo $_SESSION['mensaje'] ?>
  <?php endif; ?>
  <h1 class="titulo">Iniciar sesión</h1>
  <form class="form-inicio" action="<?php echo base_url().'inicio/ingresar' ?>" method="post" class="form">

    <div class="form-item">
      <label for="usuario">Nombre de usuario <span class="req">*</span></label>
      <input type="text" name="usuario" id="usuario" value="" placeholder="Ingresa tu nombre de usuario" required >
      <?php echo form_error('usuario') ?>
    </div>

    <div class="form-item">
      <label for="contrasena">Contraseña <span class="req">*</span></label>
      <input type="password" name="contrasena" id="contrasena" value="" placeholder="Ingresa tu contraseña" required>
      <?php echo form_error('contrasena') ?>
    </div>

    <div class="form-item">
      <button type="submit" name="btn-enviar" class="button w100 btn-success">Enviar</button>
    </div>
  </form>
</div>
