<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Blog extends MY_Controller{

  public function __construct()
  {
    parent::__construct();

  }

  function index()
  {
    // Si el usuario no es administrador
    if ($this->session->userdata('sesion_permisos_usuario') != 1)
    {
      $data['titulo'] = "¡Acceso restringido!";
      $data['mensaje'] = "No tienes acceso a esta funcionalidad.";
      $this->load->view('layouts/message', $data);
      return;
    }

    echo "Bienvenido";
  }

}
