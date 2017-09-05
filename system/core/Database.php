<?php
# @Author: Wendy Guadalupe Magaña Argente <wendylu>
# @Date:   2017-09-02T21:49:19-05:00
# @Email:  wendyargente@nube.unadmexico.mx
# @Project: Turing
# @Filename: Database.php
# @Last modified by:   wendylu
# @Last modified time: 2017-09-05T01:31:32-05:00
# @License: MIT

namespace System\Core;

global $config;

$config = include(dirname(__FILE__).'/../config/Database.php');


/**
 *
 */
class Database
{
    private $mysqli;

    private $table;

    private $select;

    private $query;

    private $condition;

    public function __construct()
    {
    }


    public function connect()
    {
        $val = false;

        global $config;

        try {
            $this->mysqli = new \mysqli(
                $config['hostname'],
                $config['username'],
                $config['password'],
                $config['database']
            );

            if ($this->mysqli->connect_error) {
                printer("No se ha posido establecer la conexión a la base de datos");
            } else {
                printer("Conexión establecida con la base de datos");
                $val = true;
                return $this->mysqli;
            }
        } catch (Exception $e) {
            die("<br>Error en la conexión de base de datos: " . $e->getMessage()."<br>");
        }

        return $val;
    }

    public function close()
    {
        $val = false;

        if (isset($this->mysqli)) {
            $this->mysqli->close();
            $val = true;
        }

        return $val;
    }

    public function insert($table, $data)
    {
        $this->mysqli->query("SET character_set_results = 'utf8', character_set_client = 'utf8', character_set_connection = 'utf8', character_set_database = 'utf8', character_set_server = 'utf8'");

        $this->query = "INSERT INTO " . $table;

        // Si el parámetro es un array...
        if (is_array($data)) {
            printer("es un array");
            $this->query = $this->query . $this->buildQuery($data, 'key') . ' VALUES';
            $this->query = $this->query . $this->buildQuery($data, 'val') . ';';
        } elseif (is_object($data)) {
            // Obtiene los atributos de la clase
            $vars = get_class_vars(get_class($data));

            $keys = array();
            $values = array();

            foreach ($vars as $key => $val) {
                array_push($keys, $key);
                array_push($values, $val);
            }

            $this->query = $this->query . $this->buildQuery($keys, 'val') . 'VALUES';
            $this->query = $this->query . $this->buildQuery($values, 'val') . ';';
        }

        printCode($this->query);

        if ($stmt = $this->mysqli->prepare($this->query)) {
            $stmt->execute();
            $stmt->close();
            printer("Registro agregado.");
        } else {
            printer("La preparación ha fallado.");
        }
    }

    public function delete($table, $data = array())
    {
        $this->query = "DELETE FROM ".$table." ";
        if (isset($data)) {
            foreach ($data as $key => $val) {
                $this->where($key, $val);
            }
        }

        // Cierra únicamente la sentencia con punto y coma;
        $this->query = $this->query . $this->condition . ';';


        if ($stmt = $this->mysqli->prepare($this->query)) {
            // Resetea la condición para que no se acumule en el string
            $this->condition = "";
            $this->query = "";
            $stmt->execute();
            $stmt->close();
            printer("Registro eliminado.");
        }
    }

    public function deleteAllFrom($table)
    {
        $this->query = "";

        $data = $this->get($table);

        if (isset($data)) {
            while ($d = $data->fetch_object()) {
                $this->where('id', $d->id);
                $this->delete($table);
            }
            printCode("Registros de tabla: '$table' eliminados.");
        }
    }

    private function buildQuery($data = array(), $val = "")
    {
        $str = " ( ";
        $i = 1;
        switch ($val) {
            case 'key':
                while ($value = current($data)) {
                    $str = $str . key($data);

                    if ($i < count($data)) {
                        $str = $str . ', ';
                    }

                    $i++;
                    next($data);
                }
                $str = $str . ') ';
                break;

            case 'val':
                foreach ($data as $d) {
                    $str = $str . '"'.$d;

                    if ($i < count($data)) {
                        $str = $str . '", ';
                    }

                    $i++;
                }
                $str = $str . '") ';
                break;
        }

        return $str;
    }

    public function select($select)
    {
        $val = false;

        if (isset($select)) {
            $this->select = $select;
            $val = true;
        }

        return $val;
    }

    public function where($column, $val, $operator = "")
    {

        // Si hay una condición previa establecida
        if ($this->condition == "") {
            $this->condition = $this->condition . 'WHERE ';
        } else {
            $this->condition = $this->condition . ' AND ';
        }

        if ($operator != "") {
            $this->condition = $this->condition . $column.' '.$operator.' "'.$val.'"';
        } else {
            $this->condition = $this->condition . $column . ' = "' . $val . '"';
        }
    }

    public function get($table)
    {
        $result;

        // Si se ha establecido una selección de columnas
        if (isset($this->select)) {
            $this->query = "SELECT ".$this->select.' FROM '.$table;
        }

        // Si no se ha establecido una consulta personalizada
        if ($this->query == "") {
            $this->query = "SELECT * FROM ".$table;
        }

        // Si se ha establecido una condición a la consulta
        if (isset($this->condition)) {
            $this->query = $this->query . ' ' . $this->condition;
        }

        $this->query = $this->query . ';';

        // Devuelve si hay registros...
        if ($r = $this->mysqli->query($this->query)) {
            $result = $r;
        } else {
            $result = false;
        }

        $this->query = "";
        $this->condition = "";
        return $result;
    }

    public function query($query)
    {
        $this->query = $query;
    }
}
