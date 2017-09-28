<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Usuario_M extends MY_Model{

  public function __construct()
  {
    parent::__construct();

    $this->tabla = "usuario";
  }

}
