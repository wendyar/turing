<?php
# @Author: Wendy Guadalupe Magaña Argente <wendylu>
# @Date:   2017-08-30T21:15:48-05:00
# @Email:  wendyargente@nube.unadmexico.mx
# @Project: Turing
# @Last modified by:   wendylu
# @Last modified time: 2017-08-31T01:23:00-05:00
# @License: MIT



/**
 * Clase controlador
 *
 * Realiza algunas instancias por su cuenta
 * para que el usuario las pueda utilizar
 * sin preocupaciones.
 *
 */
class Controller
{
  protected $view;

  function __construct()
  {
    $this->view = new View();

    $this->load = new Loader();
  }

}
