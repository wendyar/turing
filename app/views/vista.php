<?php


//Define autoloader
function __autoload($className)
{
  $path = $_SERVER["DOCUMENT_ROOT"]."/public_html/turing/sitio/";
  echo $path.$className.'.php', "<br>";

  if (file_exists($path.$className.'.php'))
  {
    echo "El archivo existe <br>";
    require_once($path.$className.'.php');
  }
  else
  {
    echo "No existe <br>";
  }
}


// echo __FILE__,"<br>";
echo __autoload("Sesion");

$clase = new Sesion();
echo "Esta es la vista <BR>";
