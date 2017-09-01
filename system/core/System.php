<?php
# @Author: Wendy Guadalupe Magaña Argente <wendylu>
# @Date:   2017-08-30T21:36:54-05:00
# @Email:  wendyargente@nube.unadmexico.mx
# @Project: Turing
# @Last modified by:   wendylu
# @Last modified time: 2017-08-31T21:42:48-05:00
# @License: MIT




require_once "Loader.php";

/**
 * Clase sistema
 *
 * En esta clase se establece los pasos de sucesión del progreso
 * de inicio para el correcto sistema para la aplicación, estos
 * pasos se pueden observar dentro del método init()
 *
 */
class System
{
  /**
   * Almacena el "basepath" de la ruta solicitada
   * esta variable es importante para la dirección
   * de los enlaces dentro de la aplicación y un
   * correcto órden.
   *
   * @var string
   */
  protected $basepath;


  /**
   * URI solicitada
   * @var string
   */
  protected $uri;


  /**
   * base_url para poder manejar algunas rutas
   * dentro de la aplicación
   * @var string
   */
  protected $base_url;


  /**
   * Nombre del controlador solicitado
   * @var string
   */
  protected $controller;


  /**
   * Nombre del método solicitado
   * @var string
   */
  protected $method;


  /**
   * Parámetro para el método que ha sido solicitado
   * @var mixed
   */
  protected $param;


  // -----------------------------------------------------------------

  public function __construct()
  {
    $this->load = new Loader();
  }

  // -----------------------------------------------------------------


  /**
   * Realiza una secuencia de carga de clases e instancias
   * necesarias para la aplicación.
   *
   * @return void
   */
  public function init()
  {
    $this->getURI();

    $this->constantes();

    // Realiza una carga de las clases del folder de system/core/
    $this->load->autoload('system/core/');

    // Carga la base de datos
    // ---

    // Carga los modelos
    // ---

    // Carga los hooks
    // ---
    // Carga el controlador solicitado
    $this->load->controller($this->controller, $this->method, $this->param);
  }


  /**
   * Obtiene y resuelve la URI solicitada
   *
   * @return void
   */
  public function getURI()
  {
    $this->basepath = implode('/', array_slice(explode('/', $_SERVER['SCRIPT_NAME']), 0, - 1)).'/';


    $this->uri = substr($_SERVER['REQUEST_URI'], strlen($this->basepath));

    // echo "<pre>";
    // print_r("uri desde la funcion: ".$_SERVER['REQUEST_URI']);
    // echo "</pre>";



    if ( ! isset($this->controller))
    {
      $this->controller = DEFAULT_CONTROLLER;
    }

    //
    // Define las rutas y las guarda en un array
    //
    $this->routes = explode('/', $this->uri);

    if (isset($this->routes[1]))
    {
      $this->controller = $this->routes[1];
    }
    // echo "controllerName: $this->controller<br>";

    //
    // ¿Hay un método solicitado?
    //
    isset($this->routes[2])
    ? $this->method = $this->routes[2]
    : $this->method = "index";
    // echo "methodName: $this->method<br>";

    //
    // ¿Hay un parámetro dado?
    //
    isset($this->routes[3])
    ? $this->param = $this->routes[3]
    : $this->param = "";
    // echo "parametros: $this->param<br>";

  }


  /**
   * Define las constantes para trabajar dentro del
   * proyecto de la aplicación
   *
   * @return void
   */
  public function constantes()
  {
    $request_uri = explode('/', $_SERVER["REQUEST_URI"]);

    //
    // Definición de constantes
    //
    define('SERVER_NAME', $_SERVER['REQUEST_SCHEME'].'://'.$_SERVER['SERVER_NAME']);
    define('BASEPATH', SERVER_NAME.$this->basepath);
    define('BASE_URL', BASEPATH.'index.php');
    define('APPPATH', SERVER_NAME.$this->basepath.'app/');
    define('STATICPATH', APPPATH.'assets/');

    define('VIEWPATH', APPPATH.'views/');
    define('SYSPATH', SERVER_NAME.$this->basepath.'system/');


    // echo "SERVER_NAME: ".SERVER_NAME."<br>";
    // echo "base_url: ".BASE_URL."<br>";
    // echo "basepath: ".BASEPATH."<br>";
    // echo "apppath: ".APPPATH."<br>";
    // echo "viewpath: ".VIEWPATH."<br>";
    // echo "SYSPATH: ".SYSPATH."<br>";
    // echo "STATICPATH: ".STATICPATH."<br>";
  }
}
