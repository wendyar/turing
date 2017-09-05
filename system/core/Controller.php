<?php
# @Author: Wendy Guadalupe Magaña Argente <wendylu>
# @Date:   2017-08-30T21:15:48-05:00
# @Email:  wendyargente@nube.unadmexico.mx
# @Project: Turing
# @Last modified by:   wendylu
# @Last modified time: 2017-09-05T01:16:31-05:00
# @License: MIT

namespace System\Core;

/**
 * Clase controlador
 *
 */
class Controller
{
    public function __construct()
    {
        /*
         * ------------------------------------------------------
         * Esto se va a descontrolar...
         * ------------------------------------------------------
         */

        // Asigna a la propiedad load, la instancia de System.
        $this->load = $GLOBALS['system'];

        //
        // Crea una nueva propiedad $this->view, a la cual
        // se le asigna la instancia de la clase View(),
        // por medio de la llamada a la función view()
        // de la clase system.
        //
        $this->view = $this->load->view();

        //
        // Sinceramente, no sé bien lo que hace, pero ¡FUNCIONA!
        // En el controlador se puede utilizar:
        //
        //      $this->view->render()
        //
        $this->view->view = $this->view;
    }
}
