<div class="container main_content row" id="dashboardContainer">
  <div class="btn-aside show-sm">
    <button class="button w100" type="button" name="showAside" data-component="toggleme" data-target="#togglebox-sidebarmenu" data-text="Ocultar menu"><i class="fa fa-bars"></i> Mostrar menú</button>
  </div>
  <!-- Sidebar menu -->
  <aside class="account__aside col-3 hide-sm" id="togglebox-sidebarmenu">
    <?php if ($this->session->userdata('sesion_permisos_usuario') == 1): ?>
      <a href="<?php echo base_url().'admin/formNuevoLibro' ?>"> Agregar libro</a>
      <a href="<?php echo base_url().'admin/formEditarLibro' ?>"> Editar libro</a>
      <a href="<?php echo base_url().'admin/formBorrarLibro' ?>"> Borrar libro</a>
      <hr>
    <?php endif; ?>
    <a href="<?php echo base_url().'usuario/' ?>">Dashboard</a>
    <a href="<?php echo base_url().'usuario/perfil' ?>">Editar perfil</a>
    <a href="<?php echo base_url().'usuario/contrasena' ?>">Cambiar contraseña</a>
    <a href="<?php echo base_url().'usuario/borrar' ?>">Eliminar cuenta</a>
    <hr>
    <a href="<?php echo base_url().'inicio/salir' ?>">Cerrar sesión</a>
  </aside>
  <!--/Sidebar menu -->

  <!-- content -->
  <section class="content col-9">
    <?php $this->load->view($sub_pagina); ?>
    <div class="mensaje">
      <span class="<?php echo $this->session->userdata('mensaje_tipo') ?>-text"><b><?php echo $this->session->userdata('mensaje'); ?></b></span>
    </div>
  </section>
  <!--/content -->
</div>
