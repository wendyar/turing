<?php
# @Author: Wendy Guadalupe Magaña Argente <wendylu>
# @Date:   2017-09-03T05:03:17-05:00
# @Email:  wendyargente@nube.unadmexico.mx
# @Project: Turing
# @Filename: Common.php
# @Last modified by:   wendylu
# @Last modified time: 2017-09-04T15:15:31-05:00
# @License: MIT



// -----------------------------------------------------------------

if (! function_exists('loadClasses')) {
    /**
     * Carga las clases de un directorio especificado
     *
     * @param  string $dir directorio de clases a cargar
     * @return void
     */
    function loadClasses($dir)
    {
        //
        // Realiza un autocarga de clases
        //
        $files = scandir($dir);

        $objetos = array();

        foreach ($files as $file) {
            if ($file != "." && $file != "..") {
                $classname = basename($file, '.php');

                spl_autoload_register(function ($classname) use ($dir, $file) {
                    require_once($dir.$file);
                });
                // echo "$file CARGADO...<br>";
            }
        }
    }
}

// -----------------------------------------------------------------

if (! function_exists('print')) {

    /**
     * Añade únicamente un salto de línea
     */
    function printer($val)
    {
        echo "$val";
        echo "<br>";
    }
}

// -----------------------------------------------------------------

if (! function_exists('printCode')) {
    function printCode($string)
    {
        echo "<pre>";
        print_r($string);
        echo "</pre>";
    }
}
