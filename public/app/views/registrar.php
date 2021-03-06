<div class="contenedor">
  <h1 class="titulo">Registro</h1>
  <form class="form-inicio" action="" method="post" class="form">

    <div class="form-item">
      <label for="correo-e">Correo electrónico <span class="req">*</span></label>
      <input type="email" name="correo-e" id="correo-e" value="" required>
    </div>

    <div class="form-item">
      <label for="contrasena">Crea una nueva contraseña <span class="req">*</span></label>
      <input type="password" name="contrasena" id="contrasena" value="" required>
    </div>

    <div class="form-item">
      <label for="rep-contrasena">Repite la contraseña <span class="req">*</span></label>
      <input type="password" name="rep-contrasena" id="rep-contrasena" value="" required>
      <span class="desc">Escribe la contraseña que acabas de crear</span>
    </div>

    <div class="form-item">
      <button type="submit" name="btn-enviar" id="btn-enviar" class="button w100 btn-success">Registrar</button>
    </div>


  </form>
</div>
