<?php
# @Author: Wendy Guadalupe Magaña Argente <wendylu>
# @Date:   2017-09-05T09:14:37-05:00
# @Email:  wendyargente@nube.unadmexico.mx
# @Project: Turing
# @Filename: inserta.php
# @Last modified by:   wendylu
# @Last modified time: 2017-09-05T21:38:52-05:00
# @License: MIT

include_once("basedatos.php");
global $db;
$db = $GLOBALS['db'];
$db->connect();



// Array donde se guardan los datos ingresados por el usuario
$data = array();

// Variable para verificar que todos los datos estén completos
$datos_completos = true;

// Es el mensaje que se le mandará al usuario
$mensaje = "";
$tipo_mensaje = "";

function insertarAutor($nombres, $apellidos, $pais_id)
{
  global $db;
  $val = false;

  // Si el autor no existe
  if (! $db->if_exists('autor', array('nombres' => $nombres)))
  {
    $data['nombres'] = $nombres;
    $data['apellidos'] = $apellidos;
    $data['pais_id'] = $pais_id;

    $db->insert('autor', $data);
    $val = true;
  }

  return $val;
}

function insertarCategoria($nombre)
{
  global $db;
  $val = false;

  // Si la categoría no existe
  if (! $db->if_exists('categorias', array('nombre' => $nombre)))
  {
    $data['nombre'] = $nombre;

    $db->insert('categorias', $data);
    $val = true;
  }

  return $val;
}

function insertarLibro($titulo, $descripcion, $data)
{
  global $db;
  $val = false;

  // Si el libro no existe, intenta insertarlo
  if (! $db->if_exists('libro', array('titulo' => $titulo)))
  {
    $data['titulo'] = $titulo;
    $data['descripcion'] = $descripcion;

    $db->insert('libro', $data);
    $val = true;
  }

  return $val;
}

// Secuencia
if ($_POST["autor-nombres"] != "")
{
  $val = insertarAutor($_POST["autor-nombres"], $_POST["autor-apellidos"], $_POST["pais_id"]);

  if (!$val)
  {
    $datos_completos = false;
    $mensaje = "Este autor ya existe";
    $tipo_mensaje = "error";
  }
  else
  {
    $db->where('nombres', $_POST["autor-nombres"]);
    $autor = $db->get('autor', 'object');
    $data['autor_id'] = $autor->id;
  }
}
elseif ($_POST["autor-existente"] != "")
{
  $mensaje = "Se ha seleccionado un autor existente";
  $tipo_mensaje = "warning";
  $data['autor_id'] = $_POST["autor-existente"];
}
else
{
  $datos_completos = false;
}

// Si la categoría es distinto de nada, es porque se intenta
// crear una nueva categoría...
if ($_POST["categoria"] != "")
{
  insertarCategoria($_POST["categoria"]);

  // No importa si la categoría está repetida, de igual manera
  // se obitene su identificador de esta que acaba de ingresar
  $db->where('nombre', $_POST["categoria"]);
  $categoria = $db->get('categorias', 'object');
  $data['categorias_id'] = $categoria->id;
}
elseif ($_POST["categoria-existente"] != "")
{
  // Se ha elegido una categoría ya establecida
  $data['categorias_id'] = $_POST["categoria-existente"];
}
else
{
  $datos_completos = false;
}



if ($_POST["titulo"] == "")
{
  $datos_completos = false;
  $mensaje = "No se han ingresado los datos requeridos.";
  $tipo_mensaje = "error";
}
else
{
  $data['titulo'] = $_POST["titulo"];
  $data['descripcion'] = $_POST["descripcion"];

  if ($datos_completos)
  {
    $val = insertarLibro($_POST["titulo"], $_POST["descripcion"], $data);
    $titulo = $_POST["titulo"];
    $mensaje = "Libro <strong>$titulo</strong> agregado exitosamente.";
    $tipo_mensaje = "success";
  }
  else
  {
    $mensaje = "No se han ingresado los datos requeridos.";
    $tipo_mensaje = "error";
  }
}

$db->close();

?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="utf-8">
  <meta http-equiv="content-language" content="es">

  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>

    <?php echo $mensaje ?>

  </title>


  <link rel="stylesheet" href="assets/css/kube.min.css">
  <!-- Hojas de estilos adicionales, que se recibe como parámetro -->
  <link rel="stylesheet" href="assets/js/vegas/vegas.min.css">
  <link rel="stylesheet" href="assets/css/base.css">

  <style media="screen">
    .datos {
      background-color: whitesmoke;
      padding: 20px;
      border: 1px solid #e2e4e2;
      border-radius: 5px;
    }
  </style>
</head>
<body>
  <div class="contenedor__principal">
    <header class="cabecera__contenedor row">

      <div class="col col-12 inises__contenedor">
        <a href="ingresar.html">Iniciar sesión</a>
        <a href="registrar.html">Registrarse</a>
      </div>

      <div class="col col-12 row auto menu__contenedor">
        <div class="col">
          <h1 class="menu__titulo">Biblioteca Virtual Turing</h1>
        </div>

        <nav class="menu col">
          <a class="menu__item" href="index.html">Inicio</a>
          <a class="menu__item" href="informacion.html">Información</a>
          <a class="menu__item" href="categorias.html">categorías</a>
          <a href="admin.html" class="menu__item "><span class="info-text">Administración</span></a>
        </nav>
      </div>

    </header>

    <section class="contenido__principal">
      <article>
        <div class="mymessage mymessage-<?php echo $tipo_mensaje ?>">
          <p><strong>¡<?php echo ucfirst($tipo_mensaje) ?>!</strong> <?php echo $mensaje ?></p>
        </div>

        <div>
          <h4>Los datos ingresados fueron:</h4>
          <div class="datos">
            <?php foreach ($data as $key => $value): ?>
              <?php echo "$key = $value <br>" ?>
            <?php endforeach; ?>
          </div>
        </div>
      </article>
    </section>

    <footer class="pie-principal">Copyright 2017 - Wendy Argente</footer>
  </div>

  <!-- Default files -->
  <script src="assets/js/jquery.min.js" charset="utf-8"></script>
  <script src="assets/js/kube.min.js" charset="utf-8"></script>


  <!-- Additional script files -->
  <script src="assets/js/vegas/vegas.min.js" charset="utf-8"></script>
  <script src="assets/js/base.js" charset="utf-8"></script>
</body>
</html>
