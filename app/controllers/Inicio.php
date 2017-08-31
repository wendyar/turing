<?php
# @Author: Wendy Guadalupe Magaña Argente <wendylu>
# @Date:   2017-08-30T21:55:31-05:00
# @Email:  wendyargente@nube.unadmexico.mx
# @Project: Turing
# @Last modified by:   wendylu
# @Last modified time: 2017-08-31T01:11:43-05:00
# @License: MIT


/**
 * Controllador de Inicio
 *
 * Este controlador es básicamente el encargado de administrar
 * en parte las sesiones y las páginas que se despachan a través
 * de este controlador.
 * 
 */
class Inicio_Controller extends Controller {

  public function __construct()
  {
    parent::__construct();
    $this->view->obj = $this->view;
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

  public function categorias()
  {
    $this->view->titulo = "Categorías";
    $this->view->pagina = "categorias";
    $this->view->render("base");
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
