<?php
# @Author: Wendy Guadalupe Magaña Argente <wendylu>
# @Date:   2017-08-30T21:55:31-05:00
# @Email:  wendyargente@nube.unadmexico.mx
# @Project: Turing
# @Last modified by:   wendylu
# @Last modified time: 2017-09-10T12:19:01-05:00
# @License: MIT

namespace System\App;

use System\Core\Controller as Controller;

/**
 * Controllador de Inicio
 *
 * Este controlador es básicamente el encargado de administrar
 * en parte las sesiones y las páginas que se despachan a través
 * de este controlador.
 *
 */
class Inicio extends Controller
{
    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        $this->view->titulo = "Inicio";
        $this->view->pagina = "index";
        $this->view->render('base');
    }

    public function informacion()
    {
        $this->view->titulo = "Información del sitio";
        $this->view->pagina = "informacion";
        $this->view->render("base");
    }

    public function categorias($categoriaSolicitada = "")
    {
      $val = false;

      // Inicia la conexión con la base de datos...
      $this->load->database();

      // Establece las variables para la página y la carga
      $this->view->titulo = "Consulta de datos";
      $this->view->pagina = "categorias";

      // Obtiene las categorías disponibles
      $this->view->categorias = $this->load->db->get('categorias');

      // Si no se ha pasado un nombre de alguna categoría
      // simplemente muestra la página sin datos.
      if ($categoriaSolicitada == "")
      {
        $this->view->titulo = "Elige una categoría.";
        $this->view->msg = "En esta sección se listan los títulos que podrás encontrar en nuestro sitio web, te recordamos que debes registrarte e iniciar sesión para poder tener acceso a cualquier libro a continuación presentado.";
        $this->view->render('base');
        return $val;
      }


      // Obtiene el nombre de la categoria
      $this->load->db->where('id', $categoriaSolicitada);
      $this->view->titulo = $this->load->db->get('categorias', 'object')->nombre;

      // Obtiene los libros de la base de datos
      $this->load->db->where('categorias_id', $categoriaSolicitada);
      $this->view->libros = $this->load->db->get('libro');

      // Se pasa la instancia de la base datos para que pueda hacer
      // consultas dentro de la página
      $this->view->db = $this->load->db;

      // Renderiza la página solicitada
      $this->view->render('base');

      // Se para una instancia de la base de datos
      // para que se puedan realizar consultas desde
      // la vista, se puede utilizar perfectamente
      // las funciones de la base de datos.
      $this->view->db = $this->load->db;

      // Cierra la conexión con la base de datos
      $this->load->db->close();
    }

    public function ingresar()
    {
        $this->view->titulo = "Ingresar";
        $this->view->pagina = "ingresar";
        $this->view->render("form-inicio");
    }

    public function registrar()
    {
        $this->view->titulo = "Nuevo registro";
        $this->view->pagina = "registrar";
        $this->view->render("form-inicio");
    }
}
