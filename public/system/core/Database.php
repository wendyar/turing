<?php
# @Author: Wendy Guadalupe Magaña Argente <wendylu>
# @Date:   2017-09-02T21:49:19-05:00
# @Email:  wendyargente@nube.unadmexico.mx
# @Project: Turing
# @Filename: Database.php
# @Last modified by:   wendylu
# @Last modified time: 2017-09-10T18:40:53-05:00
# @License: MIT

namespace System\Core;

global $config;

$config = include(dirname(__FILE__).'/../config/Database.php');


/**
 *
 */
class Database
{
    /**
     * Guarda una instancia de mysqli
     * @var object
     */
    private $mysqli;

    /**
     * Guarda las columnas de la selección de la tabla
     * @var string
     */
    private $select;

    /**
     * Almacena la consulta para la base de datos
     * @var string
     */
    private $query;

    /**
     * Almacena las condicionales que se harán a la
     * consulta
     * @var string
     */
    private $condition;

    // -----------------------------------------------------------------

    public function __construct()
    {
    }

    // -----------------------------------------------------------------

    /**
     * Función para conectar con la base de datos
     *
     * Devuelve true si la conexión se ha establecido,
     * y false si ha fallado.
     *
     * @return boolean
     */
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

            if ($this->mysqli->connect_error)
            {
              print_r("No se ha posido establecer la conexión a la base de datos");
            }
            else
            {
              // print_r("Conexión establecida con la base de datos");
              $val = true;
              return $this->mysqli;
            }

        } catch (Exception $e) {

            die("<br>Error en la conexión de base de datos: " . $e->getMessage()."<br>");

        }

        return $val;
    }


    /**
     * Función para cerrar la conexión a la base de datos
     *
     * Devuelve true si se ha podido cerrar la conexión,
     * y false si ha fallado.
     *
     * @return boolean
     */
    public function close()
    {
      $val = false;

      if (isset($this->mysqli))
      {
        $this->mysqli->close();
        $val = true;
        // print_r("Conexión cerrada.");
      }

      return $val;
    }


    /**
     * Función para insertar un nuevo registro
     * en una tabla dada.
     *
     * @param  string $table  Nombre de la tabla donde se hará el registro.
     * @param  array $data    Valores que serán agregados al registro.
     * @return boolean        Retorna true si el registro fue añadido.
     */
    public function insert($table, $data)
    {
        $this->mysqli->query("SET character_set_results = 'utf8', character_set_client = 'utf8', character_set_connection = 'utf8', character_set_database = 'utf8', character_set_server = 'utf8'");

        $this->query = "INSERT INTO " . $table;

        // Si el parámetro es un array...
        if (is_array($data))
        {
            // print_r("es un array");
            $this->query = $this->query . $this->buildQuery($data, 'key') . ' VALUES';
            $this->query = $this->query . $this->buildQuery($data, 'val') . ';';
        }
        elseif (is_object($data))
        {
          // Si el parámetro es un objeto
          // Obtiene los atributos de la clase
          $vars = get_class_vars(get_class($data));

          $keys = array();
          $values = array();

          foreach ($vars as $key => $val)
          {
            array_push($keys, $key);
            array_push($values, $val);
          }

          $this->query = $this->query . $this->buildQuery($keys, 'val') . 'VALUES';
          $this->query = $this->query . $this->buildQuery($values, 'val') . ';';
        }
        else
        {
          // printCode("No es ninguno de los dos");
        }

        // print_r($this->query);

        if ($stmt = $this->mysqli->prepare($this->query)) {
            $this->condition = "";
            $this->query = "";
            $stmt->execute();
            $stmt->close();
            // echo "<br>";
            // print_r("Registro agregado.");
            // echo "<br>";
        } else {
            // echo "<br>";
            // print_r("La preparación ha fallado.");
            // echo "<br>";
        }
    }


    /**
     * Función para eliminar un registro
     * de una tabla dada.
     *
     * @param  string $table Nombre de la tabla donde se eliminará el registro
     * @param  array  $data  Datos con los que se hará una comparación para
     *                       eliminar un dato en el registro.
     * @return boolean       Devuelve true si el registro ha sido eliminado
     */
    public function delete($table, $data = array())
    {
      $val = false;

        $this->query = "DELETE FROM ".$table." ";
        if (isset($data)) {
            foreach ($data as $key => $val) {
                $this->where($key, $val);
            }
        }

        // Cierra únicamente la sentencia con punto y coma;
        $this->query = $this->query . $this->condition . ';';

        // print_r($this->query);


        if ($stmt = $this->mysqli->prepare($this->query)) {
            // Resetea la condición para que no se acumule en el string
            $this->condition = "";
            $this->query = "";
            $stmt->execute();
            $stmt->close();
            $val = true;
            // print_r("Registro eliminado.");
        }

        return $val;
    }


    /**
     * Elimina todos los datos de una tabla dada
     *
     * @param  string $table Nombre de la tabla donde se borrarán sus registros.
     * @return boolean       Devuelve true, si la operación ha sido exitosa.
     */
    public function deleteAllFrom($table)
    {
        $this->query = "";

        $data = $this->get($table);

        if (isset($data)) {
            while ($d = $data->fetch_object()) {
                $this->where('id', $d->id);
                $this->delete($table);
            }
            // print_r("Registros de tabla: '$table' eliminados.");
        }
    }

    /**
     * Función para estructurar una consulta
     *
     * @param  array  $data Datos a estructurar
     * @return string       Typo de estructura, es decir, si el tipo
     *                      de estructura es para estructurar las
     *                      columnas o los valores a ingresar.
     */
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


    /**
     * Función para establecer las columnas que serán
     * seleccionados dentro de una consulta para
     * la base de datos.
     *
     * @param  string $select Columnas a elegir dentro de una consulta
     * @return boolean        Devuelve true si se ha podido establecer
*                             las columnas.
     */
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

        // print_r($this->query);
        // print_r($this->condition);
    }

    public function get($table, $type = "")
    {
        $this->mysqli->query("SET character_set_results = 'utf8', character_set_client = 'utf8', character_set_connection = 'utf8', character_set_database = 'utf8', character_set_server = 'utf8'");

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

        // print_r("La consulta fue: ");
        // print_r($this->query);
        // echo "<br>";

        // Devuelve si hay registros...
        if ($r = $this->mysqli->query($this->query)) {
            switch ($type) {
                case 'object':
                        $result = $r->fetch_object();
                    break;
                default:
                        $result = $r;
                    break;
            }
        } else {
            $result = false;
        }

        $this->query = "";
        $this->condition = "";
        return $result;
    }


    /**
     * Función que verifica si existe un registro en la base de datos
     * de acuerdo a los parámetros ingresados, es decir, ya sea el
     * título, o el nombre de un autor.
     *
     * @param  string $table Nombre de la tabla a buscar el registro
     * @param  array  $data  Datos con los cuales hará la comparación
     * @return boolean       Retorna verdadero si encuentra el registro buscado
     */
    public function if_exists($table, $data = array())
    {
      $val_return = false;

      // Si el parámetro es un array...
      if (is_array($data))
      {
        // printCode("Es un array");

        foreach ($data as $key => $val)
        {
          // print_r("key: $key, val: $val");
          $this->where($key, $val);
        }

        $result = $this->get($table);

        if ($result->num_rows >= 1)
        {
          return $val_return = true;
        }
      }
      elseif (is_object($data)) // Si el parámetro es un objeto
      {
        // NOTE: Recordar escribir este bloque...
      }

      // printCode("Valor de retorno es: $val_return");
      return $val_return;
    }

    /**
     * Función para establecer la propiedad query
     *
     * @param  string $query Es la consulta que se lanzará
     * @return void        
     */
    public function query($query)
    {
        $this->query = $query;
    }
}
