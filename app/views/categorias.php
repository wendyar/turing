<div class="portada">
  <img src=<?php echo STATICPATH."imagenes/libros5.jpeg"; ?> alt="">
</div>

<section class="contenido__principal">
  <article class="row">
    <h2 class="col-12">Categorias</h2>

    <div class="col-12">
      <div class="message focus" data-component="message">
        <span class="close small"></span>
        <h5 style="color: #fff">Mensaje!</h5>
        En la tabla se muestran algunos botones de forma desabilitada, esto es porque se pretenede que sólo estén activos durante el inicio de sesión para poder leer los títulos disponibles.
      </div>

    </div>

    <aside class="panel col col-3 contenedor">
      <h4>Categorías disponibles</h4>
      <ul>
        <li class="lista-activo">
          <a class="menu__item" href="#">
            Redes
          </a>
        </li>
        <li><a class="menu__item" href="#">Física</a></li>
        <li><a class="menu__item" href="#">Química</a></li>
        <li><a class="menu__item" href="#">Electrónica</a></li>
        <li><a class="menu__item" href="#">Electricidad</a></li>
        <li><a class="menu__item" href="#">Telemática</a></li>
        <li><a class="menu__item" href="#">Programación</a></li>
      </ul>
    </aside>

    <div class="col col-9 contenedor categorias__contenido">
      <h3>Títulos disponibles</h3>
      <div class="tabla">
        <div class="tabla">
          <table class="bordered">
            <tr>
              <th>Ejemplar ID</th>
              <th>Título</th>
              <th>Autor</th>
              <th>Enlace</th>
            </tr>
            <tr>
              <td>#460</td>
              <td>Balún Canán</td>
              <td>Rosario Castellanos</td>
              <td><a href="#" class="button small btn-disabled">Leer</a></td>
            </tr>
            <tr>
              <td>#1645</td>
              <td>El laberinto de la soledad</td>
              <td>Octavio Paz</td>
              <td><a href="#" class="button small btn-success">Leer</a></td>
            </tr>
            <tr>
              <td>#467</td>
              <td>Fuerte es el silencio</td>
              <td>Elena Poniatowska</td>
              <td><a href="#" class="button small btn-success">Leer</a></td>
            </tr>
            <tr>
              <td>#174</td>
              <td>Mujer que sabe latín...</td>
              <td>Rosario Castellanos</td>
              <td><a href="#" class="button small btn-disabled">Leer</a></td>
            </tr>
          </table>
        </div>
      </div>
    </div>
  </article>
</section>