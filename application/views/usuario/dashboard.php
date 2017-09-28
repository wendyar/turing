<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>

<section class="contenido__principal">

  <!-- Administración de entradas del blog -->
  <article class="container__grid">
    <header>
      <h3>¡Hola <?php echo ucfirst($this->session->userdata('sesion_nombre_usuario')); ?>!</h3>
    </header>

    <h4>Administración del blog</h4>
    <div class="tasks row auto">
      <a href="#">
        <section class="col square">
          <i class="fa fa-plus fa-2x"></i>
          <p>Nueva entrada</p>
        </section>
      </a>

      <a href="#">
        <section class="col square">
          <i class="fa fa-eye fa-2x"></i>
          <p>Ver entradas</p>
        </section>
      </a>

      <a href="#">
        <section class="col square">
          <i class="fa fa-minus fa-2x"></i>
          <p>Borrar entrada</p>
        </section>
      </a>
    </div>
  </article>

  <!-- Administración de libros -->
  <article class="container__grid">
    <header>
      <h4>Administración de libros</h4>
    </header>

    <div class="tasks row auto">
      <!-- Agregar libro -->
      <a href="<?php echo base_url().'admin/formNuevoLibro' ?>">
        <section class="col square">
          <i class="fa fa-book fa-2x"></i>
          <p>Agregar libro</p>
        </section>
      </a>

      <!-- Modificar libro -->
      <a href="#">
        <section class="col square">
          <i class="fa fa-pencil fa-2x"></i>
          <p>Modificar libro</p>
        </section>
      </a>

      <!-- Eliminar libro -->
      <a href="<?php echo base_url().'admin/formBorrarLibro' ?>">
        <section class="col square">
          <i class="fa fa-minus fa-2x"></i>
          <p>Eliminar libro</p>
        </section>
      </a>
    </div>
  </article>
</section>
