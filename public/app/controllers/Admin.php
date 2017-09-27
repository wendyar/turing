<?php
# @Author: Wendy Guadalupe Magaña Argente <wendylu>
# @Date:   2017-09-08T23:00:34-05:00
# @Email:  wendyargente@nube.unadmexico.mx
# @Project: Turing
# @Filename: Admin.php
# @Last modified by:   wendylu
# @Last modified time: 2017-09-10T21:35:04-05:00
# @License: MIT



namespace System\App;

use System\Core\Controller as Controller;

/**
 *
 */
class Admin extends Controller
{
  /**
   * Array que almacena los datos que serán insertados
   * en las tablas.
   * @var array
   */
  private $data = array();

  // -----------------------------------------------------------------

  function __construct()
  {
    parent::__construct();
  }

  // -----------------------------------------------------------------

  /**
   * Función por defecto a la que entra cuando no se llama
   * a una en específico.
   *
   * @return void
   */
  public function index()
  {
    $this->view->titulo = "Panel de administración";
    $this->view->pagina = "admin";
    $this->view->render('base');
  }

  /**
   * Función para consultar los libros de la base de datos.
   *
   * @return void
   */
  public function consultarLibro()
  {
    // Inicia la conexión con la base de datos...
    $this->load->database();

    // Obtiene los libros de la base de datos
    $this->view->libros = $this->load->db->get('libro');

    // Se para una instancia de la base de datos
    // para que se puedan realizar consultas desde
    // la vista, se puede utilizar perfectamente
    // las funciones de la base de datos.
    $this->view->db = $this->load->db;

    // Establece las variables para la página y la carga
    $this->view->titulo = "Consulta de datos";
    $this->view->pagina = "consulta";
    $this->view->render('base');

    // Cierra la conexión con la base de datos
    $this->load->db->close();
  }


  /**
   * Función para la inserción de un nuevo autor
   *
   * @param  string nombres    Nombres del autor del libro
   * @param  string $apellidos Apellidos del autor del libro
   * @param  string $pais_id   Nacionalidad del autor del libro
   * @return val               boolean
   */
  public function insertarAutor($nombres = "", $apellidos = "", $pais_id = "")
  {
    $val = false;

    // Configura los nombes si es que no se están pasando
    // como parámetros, ya que esta función puede ser
    // reutilizada por otras internamente.
    if ($nombres == "" && $apellidos == "" && $pais_id == "")
    {
      $nombres = $_POST["nombres"];
      $apellidos = $_POST["apellidos"];
      $pais_id = $_POST["pais_id"];
    }

    // Verifica que el autor no exista
    if ( ! $this->load->db->if_exists('autor', array('nombres' => $nombres)))
    {
      $data['nombres'] = $nombres;
      $data['apellidos'] = $apellidos;
      $data['pais_id'] = $pais_id;

      $this->load->db->insert('autor', $data);
      $val = true;
    }

    return $val;
  }

  public function insertarCategoria($nombre)
  {
    $val = false;

    // Verifica si la categoría no existe
    if (! $this->load->db->if_exists('categorias', array('nombre' => $nombre)))
    {
      $data['nombre'] = $nombre;
      printCode($data);

      $this->load->db->insert('categorias', $data);
      $val = true;
    }

    return $val;
  }

  public function insertarLibro()
  {
    $val = false;

    // Variable para verificar que todos los datos necesarios
    // para insertar un nuevo título estén completos
    $datosCompletos = false;

    // Datos locales para registrar el nuevo libro
    $data = array();

    // Inicia la conexión con la base de datos
    $this->load->database();

    $titulo = $_POST["titulo"];
    $descripcion = $_POST["descripcion"];

    // Verifica primero si el título que se intenta agregar
    // no esté duplicado en la base de datos
    if ($this->load->db->if_exists('libro', array('titulo' => $titulo)))
    {
      $GLOBALS['message'] = "Este título: '$titulo' ya está registrado.";
      $GLOBALS['type_message'] = "error";
      $this->formNuevoLibro();
      return $val;
    }
    else
    {
      /*
       * ------------------------------------------------------
       * Registro de nuevo autor
       * ------------------------------------------------------
       * Si se intenta registrar un nuevo autor, verifica también
       * que este no esté duplicado.
       */
       if ((isset($_POST["autor-nombres"]) && $_POST["autor-nombres"]    != "") &&
           (isset($_POST["autor-apellidos"]) && $_POST["autor-apellidos"]  != "") &&
           (isset($_POST["pais_id"]) && $_POST["pais_id"] != ""))
       {
         // Si el autor ya se encuentra registrado, manda un mensaje y detiene la función
         if ($this->load->db->if_exists('autor', array('nombres' => $_POST["autor-nombres"])))
         {
           $GLOBALS['message'] = "Este autor ya se encuentra registrado.";
           $GLOBALS['type_message'] = "error";
           $this->formNuevoLibro();
           return $val;
         }
         else
         {
          //  Registra al autor y prepara los datos para registrar el libro
          $autor['nombres'] = $_POST["autor-nombres"];
          $autor['apellidos'] = $_POST["autor-apellidos"];
          $autor['pais_id'] = $_POST["pais_id"];

          $this->load->db->insert('autor', $autor);

          // Obtiene los datos del nuevo registro del autor
          $this->load->db->where('nombres', $_POST["autor-nombres"]);
          $a = $this->load->db->get('autor', 'object');
          $data['autor_id'] = $a->id;
         }
       }
       else
       {
         // Si el programa está aquí, es porque se ha ingresado un autor existente
         if (isset($_POST["autor-existente"]) && $_POST["autor-existente"] != "")
         {
           $data['autor_id'] = $_POST["autor-existente"];
         }
         else
         {
           $GLOBALS['message'] = "No se ha establecido un autor.";
           $GLOBALS['type_message'] = "error";
           $this->formNuevoLibro();
           return $val;
         }
       } // Fin de las condicionales para regisrar un nuevo autor

       /*
        * ------------------------------------------------------
        * Registro de la categoría
        * ------------------------------------------------------
        * Igualmente verifica si la categoría ingresada no esté
        * repetida, pero si lo está, no importa, igualmente se
        * obtiene su identificador.
        */
        if (isset($_POST["categoria"]) && $_POST["categoria"] != "")
        {
          // Si la categoría no existe, la registra
          if ( ! $this->load->db->if_exists('categorias', array('nombre' => $_POST["categoria"])))
          {
            $cat['nombre'] = $_POST["categoria"];

            if (! $this->load->db->insert('categorias', $cat))
            {
              echo "No se ha podido registrar la categoría";
            }
          }

          // Obtiene el identificador de la nueva categoría registrada
          $this->load->db->where('nombre', $_POST["categoria"]);
          $c = $this->load->db->get('categorias', 'object');

          // Variable para la inserción de datos del nuevo libro
          $data['categorias_id'] = $c->id;

          printer("Valor de la categoría");
          printCode($c->id);

        }
        elseif (isset($_POST["categoria-existente"]) && $_POST["categoria-existente"] != "")
        {
          // Si se ha ingresado una categoría existente
          // simplemente se obtiene su identificador
          $data['categorias_id'] = $_POST["categoria-existente"];
        }
        else // Si está aquí es porque no se ha ingresado ningún valor para la categoría
        {
          $GLOBALS['message'] = "No se ha ingresado una categoría.";
          $GLOBALS['type_message'] = "error";
          $this->formNuevoLibro();
          return $val;
        }


        /*
         * ------------------------------------------------------
         * Registro del libro
         * ------------------------------------------------------
         * Para el registro del libro, si se ha llegado hasta
         * este punto, es porque los datos para el registro
         * del libro han sido exitosos.
         */
        if (! (isset($_POST["titulo"]) && $_POST["titulo"] != ""))
        {
          $GLOBALS['message'] = "No se ha establecido un título para el libro.";
          $GLOBALS['type_message'] = "error";
          $this->formNuevoLibro();
          return $val;
        }

        $titulo = $data['titulo'] = $_POST["titulo"];
        $data['descripcion'] = $_POST["descripcion"];

        $this->load->db->insert('libro', $data);

        $GLOBALS['message'] = "Título '$titulo' registrado exitosamente.";
        $GLOBALS['type_message'] = "error";
        $val = true;

        $this->formNuevoLibro();

    }
    // printCode($data);

    $this->load->db->close();

    return $val;
  }

  public function borrarLibro($titulo_id = "")
  {
    // Inicia conexión con la base de datos.
    $this->load->database();

    $return_val = false;

    if ($titulo_id == "")
    {
      $titulo_id = $_POST["titulo_id"];
    }

    if ($titulo_id != "")
    {
      // Obtiene el nombre del título para poder mostrarlo al usuario
      $this->load->db->where('id', $titulo_id);
      $libro = $this->load->db->get('libro', 'object');

      $registro = $this->load->db->delete('libro', array('id' => $titulo_id));

      if ($registro)
      {
        if (isset($libro->titulo))
        {
          $GLOBALS['message'] = "Elemento: '$libro->titulo' eliminado correctamente.";
          $GLOBALS['type_message'] = "success";

          $return_val = true;
        }
      }
      else
      {
        $GLOBALS['message'] = "No se ha podido eliminar el elemento.";
        $GLOBALS['type_message'] = "error";
        return $return_val;
      }
      $registro = false;
    }

    $this->load->db->close();

    $this->formBorrarLibro();

    return $return_val;
  }

  public function formNuevoLibro()
  {
    // Inicia la conexión con la base de datos
    $this->load->database();

    // Instancia para poder comunicar con la base de datos
    $this->view->db = $this->load->db;

    // Lo siguiente aún se podría mejorar...
    $this->view->paises     = $this->load->db->get('pais');
    $this->view->autores    = $this->load->db->get('autor');
    $this->view->categorias = $this->load->db->get('categorias');

    // Establece las variables para la página y la carga
    $this->view->titulo = "Nuevo registro de libro";
    $this->view->pagina = "form-insertar";
    $this->view->render("base");

    // Cierra la conexión con la base de datos
    $this->load->db->close();
  }


  public function formBorrarLibro()
  {
    // Inicia la conexión con la base de datos
    $this->load->database();

    // Instancia para poder coumicar con la base de datos
    $this->view->libros = $this->load->db->get('libro');

    // Establece las variables para la página y la carga...
    $this->view->titulo = "Eliminar un título";
    $this->view->pagina = "form-borrado";
    $this->view->render('base');

    // Cierra la conexión con la base de datos
    $this->load->db->close();
  }



}
