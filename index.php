<?php
# @Author: Wendy Guadalupe Magaña Argente <wendylu>
# @Date:   2017-08-30T21:19:21-05:00
# @Email:  wendyargente@nube.unadmexico.mx
# @Project: Turing
# @Last modified by:   wendylu
# @Last modified time: 2017-08-31T20:07:21-05:00
# @License: MIT




include 'system/core/System.php';

//
// Nombra al controlador principal que maneja las peticiones
//
define('DEFAULT_CONTROLLER', 'inicio');


//
// Crea una instancia de la clase sistema,
// y llama al método init()
//
$system = new System();
$system->init();
