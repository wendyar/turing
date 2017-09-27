<?php
# @Author: Wendy Guadalupe Magaña Argente <wendylu>
# @Date:   2017-09-08T22:44:19-05:00
# @Email:  wendyargente@nube.unadmexico.mx
# @Project: Turing
# @Filename: categorias.php
# @Last modified by:   wendylu
# @Last modified time: 2017-09-10T21:21:26-05:00
# @License: MIT


?>

<div class="portada">
  <img src=<?php echo STATICPATH."imagenes/libros5.jpeg"; ?> alt="">
</div>

<section class="contenido__principal">
  <article>
    <h2>Categorias</h2>

    <!-- Listado de categorías disponibles -->
    <div class="row">
      <aside class="panel col col-2 contenedor">
        <h4>Categorías disponibles</h4>
        <ul>
          <?php if (isset($this->categorias)): ?>
            <?php while ($categoria = $this->categorias->fetch_object()) {  ?>
              <li <?php if ($categoria->nombre == $this->titulo): ?> class="lista-activo" <?php endif; ?> ><a class="menu__item--lateral" href="<?php echo BASE_URL.'/inicio/categorias/'.$categoria->id ?>" ><?php echo $categoria->nombre ?></a></li>
            <?php } ?>
          <?php endif; ?>
        </ul>
      </aside>

      <!-- Tabla de los títulos disponibles -->
      <div class="col col-9 contenedor categorias__contenido">
        <h3 class="titulo-3"><?php echo $this->titulo ?></h3>

        <?php if (isset($this->libros) && $this->libros->num_rows >= 1): ?>
          <div class="tabla">
            <table class="bordered">
              <thead>
                <tr>
                  <th>Título</th>
                  <th>Descripción</th>
                  <th>Autor</th>
                </tr>
              </thead>


            <?php while ($libro = $this->libros->fetch_object()) { ?>
              <tbody>
              <!-- Inicio del ciclo for -->
              <td><?php echo $libro->titulo ?></td>
              <td><?php echo $libro->descripcion ?></td>
              <?php
                  $this->db->where('id', $libro->autor_id);
                  $autor = $this->db->get('autor', 'object');
              ?>
              <td><?php echo "$autor->nombres $autor->apellidos" ?></td>

              <!-- Fin del ciclo for -->
            </tbody>
            <?php } ?>
            </table>
          </div>
        <?php else: ?>
          <?php if (isset($this->msg)): ?>
              <h4><?php echo $this->msg ?></h4>
            <?php else: ?>
              <h4>¡Aún no hay títulos disponibles!</h4>
          <?php endif; ?>
        <?php endif; ?>



      </div>
    </div>


  </article>
</section>
