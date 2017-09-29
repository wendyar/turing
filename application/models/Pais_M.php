<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pais_M extends MY_Model{

  public function __construct()
  {
    parent::__construct();

    $this->tabla = "pais";
  }

}
