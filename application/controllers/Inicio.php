<?php
# @Author: Wendy Guadalupe Magaña Argente <wendylu>
# @Date:   2017-08-30T21:55:31-05:00
# @Email:  wendyargente@nube.unadmexico.mx
# @Project: Turing
# @Last modified by:   wendylu
# @Last modified time: 2017-09-10T12:19:01-05:00
# @License: MIT
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Controllador de Inicio
 *
 * Este controlador es básicamente el encargado de administrar
 * en parte las sesiones y las páginas que se despachan a través
 * de este controlador.
 *
 */
class Inicio extends CI_Controller
{
  public $plantilla;

  public function __construct()
  {
    parent::__construct();

    $this->plantilla = "layouts/base";
    $this->output->enable_profiler(TRUE);
  }

  public function index()
  {
    $data['titulo'] = "Inicio";
    $data['pagina'] = "index";
    $this->load->view($this->plantilla, $data);
  }

  public function informacion()
  {
    $data['titulo'] = "Información del sitio";
    $data['pagina'] = "inicio/informacion";
    $this->load->view($this->plantilla, $data);
  }

  public function categorias($categoriaSolicitada = "")
  {
    $val = false;

    $this->load->model('Categorias_M', 'categorias');
    $this->load->model('Libros_M', 'libros');
    $this->load->model('Autor_M', 'autores');


    // Establece las variables para la página y la carga
    $data['categorias'] = $this->categorias->obtenerDatos();
    $data['titulo'] = "Consulta de datos";
    $data['pagina'] = "inicio/categorias";

    // Si no se ha pasado un nombre de alguna categoría
    // simplemente muestra la página sin datos.
    if ($categoriaSolicitada == "")
    {
      $data['titulo'] = "Elige una categoría.";
      $data['msg'] = "En esta sección se listan los títulos que podrás encontrar en nuestro sitio web, te recordamos que debes registrarte e iniciar sesión para poder tener acceso a cualquier libro a continuación presentado.";
      $this->load->view($this->plantilla, $data);

      return $val;
    }

    // Obtiene el nombre de la categoria
    $categoria = $this->categorias->obtenerPorId($categoriaSolicitada)->row();
    $data['titulo'] = $categoria->nombre;

    // Obtiene los libros de la base de datos
    $data['libros'] = $this->libros->obtenerPorCampo('categorias_id', $categoriaSolicitada);

    // Renderiza la página solicitada
    $this->load->view($this->plantilla, $data);
  }

  public function ingresar()
  {
    // Si ha existe una sesión, simplemente regresa al inicio
    if ($this->session->has_userdata('sesion_id_usuario'))
    {
      redirect(base_url());
      return 0;
    }

    /*
    * ------------------------------------------------------
    * Validación de los datos del formulario
    * ------------------------------------------------------
    */
    $this->form_validation->set_rules('usuario', 'Nombre de usuario', 'trim|required|min_length[5]|max_length[12]');
    $this->form_validation->set_rules('contrasena', 'Contraseña', 'trim|required|min_length[5]|max_length[12]');

    $this->form_validation->set_error_delimiters("<div class='desc error-text'>", "</div>");

    $this->security->xss_clean(strip_tags($this->input->post('contrasena')));

    if ($this->form_validation->run() == FALSE)
    {
      $data['titulo'] = "Ingresar";
      $data['pagina'] = "sesion/ingresar";
      $this->load->view("layouts/form-inicio", $data);
    }
    else
    {
      // Obtiene los datos del formulario
      $this->load->model('Usuario_M', 'usuario_m');

      $input_usuario = $this->security->xss_clean(strip_tags($this->input->post('usuario')));
      $input_contra  = $this->security->xss_clean(strip_tags($this->input->post('contrasena')));

      // Variable para conceder acceso al inicio de sesión
      $acceso = FALSE;

      // Busca el registro del nombre de usuario solicitado
      $usuario = $this->usuario_m->obtenerPorCampo('nombreUsuario', $input_usuario);

      // Si la búsqueda del usuario no arroja
      // regultados, manda mensaje de error
      if ($usuario->num_rows() <= 0)
      {
        $_SESSION['mensaje'] = "¡Este usuario no existe!";
        $this->session->mark_as_temp('mensaje', 1);
        redirect(base_url().'inicio/ingresar');
        return 0;
      }
      else
      {
        // Si está en este punto, significa que
        // el usuario sí existe

        $u = $usuario->row();

        (strcmp($input_contra, $u->contrasena) == 0 )
        ? $acceso = TRUE
        : $_SESSION['mensaje'] = "El nombre de usuario o contraseña es incorrecto.";

        if ($acceso)
        {
          $sesionUsuario = array(
          'sesion_id_usuario'       => $u->id,
          'sesion_nombre_usuario'   => $u->nombreUsuario,
          'sesion_registro_usuario' => $u->fechaRegistro,
          'sesion_nombre_real'      => $u->nombreReal,
          'sesion_permisos_usuario' => $u->permisos_id
          );

          $this->session->set_userdata($sesionUsuario);
          redirect(base_url().'usuario');
          return 0;
        }
        else
        {
          $this->session->mark_as_temp('mensaje', 1);
          redirect(base_url().'inicio/ingresar');
          return 0;
        }
      }
    }
  }

  public function registrar()
  {
    /*
     * ------------------------------------------------------
     * Validación de los datos del formulario
     * ------------------------------------------------------
     */
    // Nombre del usuario
    $this->form_validation->set_rules('nombre-usuario', 'Nombre de usuario', 'trim|required|min_length[5]|max_length[12]|is_unique[usuario.nombreUsuario]');

    // Nombre real
    $this->form_validation->set_rules('nombre-real', 'Nombre real', 'trim|required|min_length[5]|max_length[40]');

    // Correo electrónico
    $this->form_validation->set_rules('correo-e', 'Correo electrónico', 'trim|required|min_length[5]|max_length[30]|valid_email');

    // Contraseña
    $this->form_validation->set_rules('contrasena', 'Contraseña', 'trim|required|min_length[5]|max_length[12]');

    // Repetir contraseña
    $this->form_validation->set_rules('rep-contrasena', 'Repetir contraseña', 'trim|required|matches[contrasena]');

    // Establece los delimitadores para los mensajes de error
    $this->form_validation->set_error_delimiters('<div class="desc error-text">', '</div>');


    if ($this->form_validation->run() == FALSE)
    {
      $data['titulo'] = "Nuevo registro";
      $data['pagina'] = "sesion/registrar";
      $this->load->view("layouts/form-inicio", $data);
    }
    else
    {
      $this->load->model('Usuario_M', 'usuario_m');
      /*
       * ------------------------------------------------------
       * Obtención de datos
       * ------------------------------------------------------
       */
      $usuario['nombreUsuario'] = $this->security->xss_clean(strip_tags($this->input->post('nombre-usuario')));
      $usuario['nombreReal']    = $this->security->xss_clean(strip_tags($this->input->post('nombre-real')));
      $usuario['contrasena']    = $this->security->xss_clean(strip_tags($this->input->post('contrasena')));
      $usuario['correo']        = $this->security->xss_clean(strip_tags($this->input->post('correo-e')));
      $usuario['fechaRegistro'] = date("Y-m-d h:i:s");
      $usuario['permisos_id']   = 2; // Se registra como usuario regular por defecto

      // Registra los datos en la base de datos
      $this->usuario_m->insertar($usuario);

      /*
       * ------------------------------------------------------
       * Registra los datos de sesión
       * ------------------------------------------------------
       */
      $u = $this->usuario_m->obtenerPorCampo('nombreUsuario', $usuario['nombreUsuario'])->row();

      $sesion = array(
        'sesion_id_usuario' =>  $u->id,
        'sesion_nombre_usuario' => $u->nombreUsuario,
        'sesion_nombre_real' => $usuario['nombreReal'],
        'sesion_correo_usuario' => $u->correo,
        'sesion_registro_usuario' => $u->fechaRegistro,
        'sesion_permisos_usuario' => $u->permisos_id
      );
      $this->session->set_userdata($sesion);

      redirect(base_url().'usuario/perfil');

      return;
    }
  }

  public function salir()
  {
    $this->session->sess_destroy();
    redirect(base_url());
  }
}
