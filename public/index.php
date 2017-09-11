<?php
# @Author: Wendy Guadalupe Magaña Argente <wendylu>
# @Date:   2017-08-30T21:19:21-05:00
# @Email:  wendyargente@nube.unadmexico.mx
# @Project: Turing
# @Last modified by:   wendylu
# @Last modified time: 2017-09-10T19:11:07-05:00
# @License: MIT
/*

 * ------------------------------------------------------
 * CONTROLADOR PRINCIPAL
 * ------------------------------------------------------
 *
 * Se nombra al controlador por defecto, es decir, este
 * será el controlador que será llamado cuando no se
 * haya realizado la petición de ningun controlador,
 * cuando la URL se encuentre vacía.
 * ------------------------------------------------------
 */
define('DEFAULT_CONTROLLER', 'inicio');


/*
 * ------------------------------------------------------
 * RESOLUCIÓN DE PETICIONES
 * ------------------------------------------------------
 *
 * Comienza la resolución del URI, toma el recurso y lo
 * dividen en varias partes hasta poder definir cada una
 * de ellas.
 */
$basepath = implode('/', array_slice(explode('/', $_SERVER['SCRIPT_NAME']), 0, - 1)).'/';
$uri = substr($_SERVER['REQUEST_URI'], strlen($basepath));
$routes = explode('/', $uri);


/*
 * ------------------------------------------------------
 * DEFINE LAS PETICIONES
 * ------------------------------------------------------
 *
 * Si el primer índice está definido, se definirá como
 * el controlador al que se está llamando, si no, entonces
 * se llamará al controlador que se a definido por defecto
 * para recibir las peticiones.
 */
isset($routes[1])
? $controller = $routes[1]
: $controller = DEFAULT_CONTROLLER;


/*
 * ------------------------------------------------------
 * ¿Hay un método solicitado?
 * ------------------------------------------------------
 */
isset($routes[2])
? $method = $routes[2]
: $method = "index";

/*
 * ------------------------------------------------------
 * ¿Se recibe un parámetro?
 * ------------------------------------------------------
 */
isset($routes[3])
? $param = $routes[3]
: $param = "";


/*
 * ------------------------------------------------------
 * DEFINICIÓN DE RUTAS CONSTANTES
 * ------------------------------------------------------
 *
 * Ya que se tienen las variables claves, se pueden definir
 * las constantes que son usadas durante todo el programa.
 */
// URI
define('URI', $uri);

// Nombre del servidor
define('SERVER_NAME', $_SERVER['REQUEST_SCHEME'].'://'.$_SERVER['SERVER_NAME']);

// Ruta base del proyecto
define('BASEPATH', SERVER_NAME.$basepath);

// Ruta base del proyecto, frente del index.php/
define('BASE_URL', BASEPATH.'index.php');

// Frente del directorio de la aplicación
define('APPPATH', SERVER_NAME.$basepath.'public/app/');

// Frente de los archivos estáticos
define('STATICPATH', APPPATH.'assets/');

// Frente del directorio de las vistas
define('VIEWPATH', APPPATH.'views/');

// Frente del directorio del sistema
define('SYSPATH', SERVER_NAME.$basepath.'system/');


// echo "SERVER_NAME: ".SERVER_NAME."<br>";
// echo "base_url: ".BASE_URL."<br>";
// echo "basepath: ".BASEPATH."<br>";
// echo "apppath: ".APPPATH."<br>";
// echo "viewpath: ".VIEWPATH."<br>";
// echo "SYSPATH: ".SYSPATH."<br>";
// echo "STATICPATH: ".STATICPATH."<br>";


/*
 * ------------------------------------------------------
 * AMBIENTE DE CONFIGURACIÓN
 * ------------------------------------------------------
 * Aquí se define el tipo de ambiente con el que se está
 * trabajando, si el tipo de ambiente es 'development'
 * entonces se estará trabajando con una configuración
 * para el servidor y la base de datos local, si la
 * configuración está en 'production', se trabajará con
 * la configuración establecida para el servidor remoto

 *    -- Ver la configuración de base de datos
 */
if (SERVER_NAME == "http://localhost")
{
  define('ENVIRONMENT', 'development');
}
else
{
  define('ENVIRONMENT', 'production');
}


/*
 * ------------------------------------------------------
 * Carga las funciones comúnes
 * ------------------------------------------------------
 */
require_once 'system/core/Common.php';


/*
 * ------------------------------------------------------
 * Carga las clases principales
 * ------------------------------------------------------
 */
loadClasses('system/core/');

/*
 * ------------------------------------------------------
 * CARGA EL SISTEMA
 * ------------------------------------------------------
 *
 * Una vez que está todo listo...
 *
 * Aquí vamos... :)
 */
require_once 'system/core/System.php';

$GLOBALS['system'] = new System\Core\System();

$system->controller($controller, $method, $param);
