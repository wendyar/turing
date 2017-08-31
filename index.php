<?php

include 'system/core/System.php';

//
// Nombra al controlador principal que maneja las peticiones
//
define('DEFAULT_CONTROLLER', 'index');


//
// Crea una instancia de la clase sistema,
// y llama al método init()
//
$system = new System();
$system->init();
