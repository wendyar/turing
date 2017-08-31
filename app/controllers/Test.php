<?php
class Test_Controller{

  public function __construct()
  {
    echo "Este es un mensaje desde el constructor de la clase test";
  }

  public function miprueba()
  {
    echo "Esto es una prueba más desde el controlador Test...";
  }

  public function mipruebaparam($param)
  {
    echo "<br>El parámetro dado es: $param <br>";
    echo dirname(__FILE__);
  }

  public function index($param)
  {
    echo "<br>Este es el índex solamente y el parámetro es: $param <br>";
  }

}
