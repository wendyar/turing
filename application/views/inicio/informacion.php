<?php
# @Author: Wendy Guadalupe Magaña Argente <wendylu>
# @Date:   2017-09-08T22:44:19-05:00
# @Email:  wendyargente@nube.unadmexico.mx
# @Project: Turing
# @Filename: informacion.php
# @Last modified by:   wendylu
# @Last modified time: 2017-09-10T11:58:49-05:00
# @License: MIT
?>


<div class="portada">
  <img src=<?php echo STATICPATH.'imagenes/libros7.jpg' ?> alt="">
</div>

<section class="contenido__principal">
  <article class="">
    <h2><?php echo $titulo ?></h2>
    <p>
      Esta página está dedicada a contener información relevante del sitio, por ejemplo la misión  y visión del sitio web, qué  pueden esperar los usuarios sobre el contenido del sitio, qué ofrece y cuáles son los beneficios de tener una cuenta abierta.
    </p>

    <h3>Preguntas frecuentes</h3>
    <div id="preguntas__contenedor" data-component="collapse">

      <h4><a href="#caja-1" class="collapse-toggle"><span class="caret down"></span>¿Debo iniciar sesión para leer los libros?</a></h4>
      <div class="collapse-box hide" id="caja-1">
        <p>Sí, es necesario iniciar sesión para poder leer un libro ya que al iniciar sesión podrás contar con todos los servicios que te ofrece la biblioteca, además de un espacio personal donde podrás revisar tu historial de libros leídos, y una página de administración.</p>
      </div>

      <h4>
        <a href="#caja-2" class="collapse-toggle">
          <span class="caret down"></span> ¿Cómo se manejan los derechos de autor?
        </a>
      </h4>
      <div class="collapse-box hide" id="caja-2">
        <p>En cada uno de los libros se puede observar el nombre del autor o autores, todo se realizó de manera legal para que ustedes como alumnos puedan hacer uso de sus libros de forma gratuita, las veces que sean necesarias.</p>
      </div>

      <h4><a href="#caja-3" class="collapse-toggle"><span class="caret down"></span>¿Puedo utilizar mas de un solo libro y de diferentes categorías?</a></h4>
      <div class="collapse-box hide" id="caja-3">
        <p>En esta biblioteca virtual claro que puedes utilizar más de un libro, mientras tengas acceso a internet no hay ningún problema</p>
      </div>
      <h4><a href="#caja-4" class="collapse-toggle"><span class="caret down"></span>¿Puedo solicitar libros en específico?</a></h4>
      <div class="collapse-box hide" id="caja-4">
        <p>Cada mes los alumnos pueden hacer sugerencias de libros que necesitan utilizar o que serían indispensables que estuvieran agregados en las categorías, después de que se haga una evaluación de lo solicitado se van a ir agregando más libros, pero tiene un tiempo de espera ya que se tienen que adquirir de manera legal.</p>
      </div>
    </div>
  </article>
