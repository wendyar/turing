<?php
# @Author: Wendy Guadalupe Magaña Argente <wendylu>
# @Date:   2017-09-03T04:00:16-05:00
# @Email:  wendyargente@nube.unadmexico.mx
# @Project: Turing
# @Filename: Model.php
# @Last modified by:   wendylu
# @Last modified time: 2017-09-05T01:50:38-05:00
# @License: MIT

namespace System\Core;

/**
 * Clase Model
 *
 * Esta clase hereda de la clase Database para
 * poder usar sus métodos y poder realizar las
 * consultas de una manera mucho más fácil.
 */
class Model extends Database
{
    public function __construct()
    {
        // Se crea un atributo para esta instancia
        // el cual se iguala a la instancia global
        // System, de esta manera es posible
        // utilizar una sóla conexión y la misma
        // para las consultas, si no, se crearían
        // varias conexiones sin poder manejar
        // una sola...
        $this->system = $GLOBALS['system'];

        // El objetivo de esta situación es para
        // que las clases que heredan de Model
        // puedan hacer esto:
        //
        //      $this->db->insert();
        //
        $this->db = $this->system->db;
        $this->db->db = $this->db;
    }
}
