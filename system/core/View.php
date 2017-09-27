<?php
# @Author: Wendy Guadalupe Magaña Argente <wendylu>
# @Date:   2017-08-31T01:12:14-05:00
# @Email:  wendyargente@nube.unadmexico.mx
# @Project: Turing
# @Last modified by:   wendylu
# @Last modified time: 2017-09-10T08:53:10-05:00
# @License: MIT

namespace System\Core;

/**
 * Clase vista
 *
 * Esta clase realiza el trabajo de "renderizar" de alguna manera
 * la plantilla o layout con que se está trabajando, el objetivo
 * de esta plantilla es que se comporte lo más parecido a un motor
 * de plantillas lo más sencillo posible pero de una manera óptima.
 */
class View
{
    /**
     * Almacena el nombre de la plantilla a llamar
     * @var string
     */
    public $plantilla;


    /**
     * Guarda el nombre del archivo a cargar
     * @var string
     */
    public $archivo;


    // -----------------------------------------------------------------

    public function __construct()
    {
    }

    // -----------------------------------------------------------------


    /**
     * Función que carga el archivo que se está manejando como plantilla
     *
     * @param  string $plantilla layout
     * @return void
     */
    public function render($plantilla)
    {
        $plantilla_path = 'public/app/layouts/'.$plantilla.'.php';

        if (file_exists($plantilla_path)) {
            ob_start();

            require($plantilla_path);

            $output = ob_get_contents();
        }
    }


    /**
     * Función include, trata de incluir una porción de código
     * para insertarlo una plantilla o layout.
     *
     * @param  string $file   Nombre del archivo a cargar
     * @param  string $folder Ruta del archivo a cargar
     * @return void
     */
    public function include($file, $folder = "layouts/_includes/")
    {
        $file_path = 'public/app/'.$folder.$file.'.php';

        ob_start();

        require($file_path);

        $output = ob_get_contents();
    }
}
