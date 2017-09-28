<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class MY_Model extends CI_Model {

  public $tabla;

  public function __construct()
  {
    parent::__construct();
  }

  public function insertar($data = array())
  {
    $this->db->insert($this->tabla, $data);
  }

  public function obtenerDatos()
  {
    $consulta = $this->db->get($this->tabla, 500);
    return $consulta;
  }

  public function actualizar($id, $data = array())
  {
    $val = false;

    $this->db->where('id', $id);
    if ($this->db->update($this->tabla, $data))
    {
      $val = TRUE;
    }

    return $val;
  }

  public function obtenerPorId($id)
  {
    $this->db->where('id', $id);
    $consulta = $this->db->get($this->tabla);
    return $consulta;
  }

  public function obtenerPorNombre($Nombre)
  {
    $consulta = $this->db->get_where($this->tabla, array("Nombre" => $Nombre), 1);
    return $consulta;
  }

  public function obtenerPorCampo($columna, $valor)
  {
    $this->db->where($columna, $valor);
    $this->db->from($this->tabla);
    $consulta = $this->db->get();

    return $consulta;
  }


  /**
 * Elimina un registro de la tabla
 *
 * Elimina un registro de la tabla buscando su $id
 *
 * @param int $id identificador
 * @return void
 */
  public function eliminar($id)
  {
    $this->db->where('id', $id);
    $this->db->delete($this->tabla);
  }

  /**
   * Busca y verifica si un dato en una tabla existe
   * @param  string $columna Nombre de la columna
   * @param  mixto $dato     Dato a buscar
   * @return int             Devuelve 0 si no encuentra el dato, de lo contrario devuelve 1
   */
  public function siExiste($columna, $dato)
  {
    $consulta = $this->obtenerPorCampo($columna, $dato);

    if ($consulta->num_rows() < 1)
    {
      return 0;
    }
    else
    {
      return 1;
    }
  }

}
