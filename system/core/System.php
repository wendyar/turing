<?php
# @Author: Wendy Guadalupe Magaña Argente <wendylu>
# @Date:   2017-08-30T21:36:54-05:00
# @Email:  wendyargente@nube.unadmexico.mx
# @Project: Turing
# @Last modified by:   wendylu
# @Last modified time: 2017-09-05T01:42:13-05:00
# @License: MIT

namespace System\Core;

global $controller;
global $method;
global $param;

/*
 * ------------------------------------------------------
 * Clase sistema
 * ------------------------------------------------------
 *
 * Esta clase es la que maneja los métodos con los que se
 * comportará la aplicación, esta clase se instanciará
 * para estar como una variable global y que esté en
 * comunicación con todas las clases.
 *
 */
class System
{
    /**
     * Guarda la conexión de la base de datos,
     * una instancia de Mysqli.
     *
     * @var object
     */
    public $connection;

    /**
     * Esta variable se utilizará para poder acceder
     * a los métodos de la clase System.
     *
     * @var mixed
     */
    public $load;


    /**
     * Recibe una instancia de la clase de Base de datos,
     * así se podrán utilizar los métodos de connect (para
     * establecer conexión) y close (para cerrar la conexión).
     *
     * @var object
     */
    public $db;


    // -----------------------------------------------------------------

    public function __construct()
    {
        $this->init();
    }

    // -----------------------------------------------------------------

    private function init()
    {
        $this->view = new View();
        $this->view->view = $this->view;

        new Bootstrap();
    }

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

        //
        // Comprueba que exista el controlador solicitado
        //
        if (file_exists('app/controllers/'.ucfirst($controllerName).'.php')) {

            // Establece el nombre de la clase del controlador, agrega _Controller
            $classname = ucfirst($controllerName);

            //
            // Autocarga el controlador o su clase correspondiente.
            //
            spl_autoload_register(function ($classname) use ($controllerName) {
                $filename = "app/controllers/".ucfirst($controllerName).".php";
                require_once($filename);
            });

            //
            // Crea una instancia de la clase solicitada llamando a su
            // respectivo espacio de nombres.
            //
            $namespace = 'System\\App\\'.$classname;
            $obj = new $namespace();

            //
            // Trata de llamar a los métodos solicitados
            // si es que los hay...
            //
            if (isset($methodName) && $methodName != "") {
                if (method_exists($obj, $methodName)) {
                    call_user_func(array($obj, $methodName), $param);
                } else {
                    $this->view->titulo = "Página no encontrada :(";
                    $this->view->pagina = "errors/404";
                    $this->view->mensaje = "El método '$methodName' no existe, comprueba tu dirección URL";
                    $this->view->render('base');
                    exit(1);
                }
            } else {
                //
                // Si no hay método establecido llama al método principal index
                //
                call_user_func(array($obj, "index"), $param);
            }
        } else {
            $this->view->titulo = "Página no encontrada :( ";
            $this->view->pagina = "errors/404";
            $this->view->mensaje = "Error 404, el controllador ".$controllerName." no se puede localizar";
            $this->view->render("base");
        }
    }

    /**
     * Realiza la conexión a la base de datos
     *
     * Esta función inicia una nueva instancia de la clase Database
     * la hice porque quizás en algunas partes del sitio web no sea
     * necesario realizar una conexión a la base de datos todo el
     * tiempo, sólo en las páginas que es necesario establecer la
     * conexión.
     *
     * @return void
     */
    public function database()
    {
        $this->db = new Database();
        $this->connection = $this->db->connect();
    }


    /**
     * Carga un modelo especificado
     *
     * Esta función carga un modelo para realizar las consultas
     * para la base de datos.
     *
     * @return void
     */
    public function model($classname, $alias = "")
    {
        $pathFile = 'app/models/'.$classname.'.php';

        /*
         * ------------------------------------------------------
         * Si el archivo no existe, no hay nada qué hacer... :(
         * ------------------------------------------------------
         */
        if (! file_exists($pathFile)) {
            echo "El archivo $classname.php modelo no existe";
            exit(1);
        }

        require(dirname(__FILE__).'../../../app/models/'.$classname.'.php');

        if (isset($alias) || $alias != "") {
            $alias = $classname;
        }

        $this->$alias = new $classname();
    }


    /**
     * Función view.
     * @return object Retorna simplemente una instancia de clase View.
     */
    public function view()
    {
        return new View();
    }
}
