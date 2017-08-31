<?php
# @Author: Wendy Guadalupe Magaña Argente <wendylu>
# @Date:   2017-08-30T21:37:29-05:00
# @Email:  wendyargente@nube.unadmexico.mx
# @Project: Turing
# @Last modified by:   wendylu
# @Last modified time: 2017-08-31T01:06:37-05:00
# @License: MIT




/**
 *
 */
class Loader
{

  // -----------------------------------------------------------------

  function __construct()
  {
  }

  // -----------------------------------------------------------------


  /**
   * Carga un controlador específico, esta función es necesaria para
   * la automatización de crear instancias de una clase dada, además
   * de la interación de otros controladores con sus métodos.
   *
   * @param  string $controllerName Nombre del controlador a cargar
   * @param  string $methodName     Nombre del método a llamar del controlador
   * @param  string $param          Parámetro dado para el método
   * @return void
   */
  public function controller($controllerName, $methodName = "", $param = "")
  {
    // Nueva instancia de view para llamar a las páginas de error
    $view = new view();

    if ( ! isset($controllerName) || $controllerName == "")
    {
      $controllerName = DEFAULT_CONTROLLER;
    }

    //
    // Comprueba que exista el controlador solicitado
    //
    if (file_exists('app/controllers/'.ucfirst($controllerName).'.php'))
    {
      // echo "El archivo existe<br>";
      // Establece el nombre de la clase del controlador, agrega _Controller
      $classname = ucfirst($controllerName).'_Controller';

      //
      // Autocarga el controlador o su clase correspondiente
      //
      spl_autoload_register(function($classname) use ($controllerName) {
        $filename = "app/controllers/".ucfirst($controllerName).".php";
        require($filename);
      });

      //
      // Crea una instancia de la clase solicitada
      //
      $obj = new $classname();

      //
      // Trata de llamar a los métodos solicitados
      // si es que los hay...
      //
      if (isset($methodName) && $methodName != "")
      {
        if (method_exists($obj, $methodName))
        {
          call_user_func(array($obj, $methodName), $param);
        }
        else
        {
          $view->obj = $view;
          $view->titulo = "Página no encontrada :(";
          $view->pagina = "errors/404";
          $view->mensaje = "El método '$methodName' que estás intentando llamar no existe, comprueba tu dirección URL";
          $view->render('base');
          exit(1);
        }
      }
      else
      {
        //
        // Si no hay método establecido llama al método principal index
        //
        call_user_func(array($obj, "index"), $param);
      }
    }
    else
    {
      $view->obj = $view;
      $view->titulo = "Página no encontrada :( ";
      $view->pagina = "errors/404";
      $view->mensaje = "Error 404, el controllador ".$controllerName." no se puede localizar";
      $view->render("base");
    }
  }


  /**
   * Realiza la autocarga de un lote de clases dadas dentro de un directorio
   *
   * @param  string $dir directorio de clases a cargar
   * @return void
   */
  public function autoload($dir)
  {
    //
    // Realiza un autocarga de clases
    //
    $files = scandir($dir);

    $objetos = array();

    foreach($files as $file)
    {
      if ($file != "." && $file != "..")
      {
        $classname = basename($file, '.php');

        // Closure para usar $dir y $file
        spl_autoload_register(function($classname) use ($dir, $file) {
          require_once($dir.$file);
        });
      }
    }
  }
}
