<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Usuario extends MY_Controller {

  public $plantilla;

  public function __construct()
  {
    parent::__construct();

    $this->plantilla = "layouts/dashboard";
    $this->load->model('Usuario_M', 'usuario_m');
  }

  function index()
  {
    $this->dashboard();
  }

  public function dashboard()
  {
    $data['titulo'] = "Dashboard";
    $data['pagina'] = "usuario/dashboard";
    $this->load->view($this->plantilla, $data);
  }

  public function perfil()
  {
    // Obtiene los datos del usuario actual
    $us_cons = $this->usuario_m->obtenerPorId($this->session->userdata('sesion_id_usuario'))->row();

    /*
     * ------------------------------------------------------
     * Validación de los datos del formulario
     * ------------------------------------------------------
     */
    // Nombre del usuario
    $this->form_validation->set_rules('nombre_usuario', 'Nombre de usuario', 'trim|required|min_length[5]|max_length[12]');

    // Nombre real
    $this->form_validation->set_rules('nombre_real', 'Nombre real', 'trim|required|min_length[5]|max_length[40]');

    // Correo electrónico
    $this->form_validation->set_rules('usuario_mail', 'Correo electrónico', 'trim|required|min_length[5]|max_length[80]|valid_email');

    // Establece los delimitadores para los mensajes de error
    $this->form_validation->set_error_delimiters('
    <div class="row gutters">
    <div class="col col-3 hide-sm"></div>
    <div class="desc error-text col col-9">', '</div></div>');

    if ($this->form_validation->run() == FALSE)
    {
      $data['u_nom']      = $us_cons->nombreUsuario;
      $data['u_nom_real'] = $us_cons->nombreReal;
      $data['u_correo']   = $us_cons->correo;

      $data['titulo'] = "Perfil";
      $data['pagina'] = "usuario/perfil";

      $this->load->view($this->plantilla, $data);
    }
    else
    {
      // Obtiene los datos del formulario
      $nombre      = $usuarioData['nombreUsuario'] = $this->security->xss_clean(strip_tags($this->input->post('nombre_usuario')));
      $nombre_real = $usuarioData['nombreReal']              = $this->security->xss_clean(strip_tags($this->input->post('nombre_real')));
      $correo      = $usuarioData['correo']        = $this->security->xss_clean(strip_tags($this->input->post('usuario_mail')));

      //
      // Realiza una busqueda de usuario para
      // verificar que el nombre y correo no
      // se encuentren repetidos.
      //
      if ($us_cons->nombreUsuario != $nombre)
      {
        $busqueda_nombre = $this->usuario_m->obtenerPorCampo("nombreUsuario", $usuarioData['nombreUsuario']);

        // Si la búsqueda arroja un resultado por lo menos,
        // significa que el nombre de usuario ya está ocupado
        if ($busqueda_nombre->num_rows() >= 1)
        {
          $_SESSION['sesion_error_nombre'] = "Este nombre de usuario '$nombre' ya está registrado.";
          $this->session->mark_as_temp('sesion_error_nombre', 1);
          redirect(base_url().'usuario/perfil');
          return;
        }
      }

      if ($us_cons->correo != $correo)
      {
        $busqueda_correo = $this->usuario_m->obtenerPorCampo("correo", $usuarioData['correo']);

        if ($busqueda_correo->num_rows() >= 1)
        {
          $_SESSION['sesion_error_correo'] = "Este correo electrónico '$correo' ya está registrado.";
          $this->session->mark_as_temp('sesion_error_correo', 1);
          redirect(base_url().'usuario/perfil');
          return;
        }
      }

      // Realiza la actualización de los datos
      if ($this->usuario_m->actualizar($us_cons->id, $usuarioData))
      {
        $dataUsuario = array(
          'sesion_nombre_usuario' => $nombre,
          'sesion_nombre_real' => $nombre_real,
          'sesion_correo_usuario' => $correo
        );
        $this->session->set_userdata($dataUsuario);

        $mensaje['mensaje'] = "¡Datos actualizados!";
        $mensaje['mensaje_tipo'] = "success";
      }
      else
      {
        $mensaje['mensaje'] = "¡No se ha podido actualizar los datos!";
        $mensaje['mensaje_tipo'] = "error";
      }

      $this->session->set_userdata($mensaje);
      $this->session->mark_as_temp("mensaje", 1);

      redirect(base_url().'usuario/perfil');
    }
  }

  public function contrasena()
  {
    // Obtiene los datos del usuario actual
    $usuario = $this->usuario_m->obtenerPorId($this->session->userdata('sesion_id_usuario'))->row();

    /*
     * ------------------------------------------------------
     * Validación de formulario
     * ------------------------------------------------------
     */
    $this->form_validation->set_rules('usuario_contra_actual', 'Contraseña actual', 'trim|required|min_length[5]|max_length[12]');
    $this->form_validation->set_rules('usuario_contra_nueva', 'Nueva contraseña', 'trim|required|min_length[5]|max_length[12]');
    $this->form_validation->set_rules('usuario_contra_rep', 'Repetir contraseña', 'trim|required|min_length[5]|max_length[12]|matches[usuario_contra_nueva]');

    $this->form_validation->set_error_delimiters("<div class='desc error-text col offset-3'>", "</div>");

    if ($this->form_validation->run() == FALSE)
    {
      $data['titulo'] = "Editar contraseña";
      $data['pagina'] = "usuario/contrasena";
      $this->load->view($this->plantilla, $data);
    }
    else
    {
      $pass = FALSE;

      /*
       * ------------------------------------------------------
       * Obtencion de datos
       * ------------------------------------------------------
       */
      $contra_actual  = $this->security->xss_clean(strip_tags($this->input->post('usuario_contra_actual')));
      $contra_nueva   = $this->security->xss_clean(strip_tags($this->input->post('usuario_contra_nueva')));

      $usuario = $this->usuario_m->obtenerPorId($this->session->userdata('sesion_id_usuario'))->row();

      if ((strcmp($contra_actual, $usuario->contrasena) !== 0))
      {
        $mensaje['mensaje'] = "¡Tu contraseña actual es incorrecta!";
        $mensaje['mensaje_tipo'] = "error";
      }
      else
      {
        $pass = TRUE;
      }

      if ($pass)
      {
        $dataUsuario = array(
          'contrasena' => $contra_nueva
        );
        $this->usuario_m->actualizar($this->session->userdata('sesion_id_usuario'), $dataUsuario);

        $mensaje['mensaje'] = "¡Contraseña actualizada correctamente!";
        $mensaje['mensaje_tipo'] = "success";
      }

      $this->session->set_userdata($mensaje);
      $this->session->mark_as_temp("mensaje", 1);
      redirect(base_url().'usuario/contrasena');
      return 0;

    }
  }

  public function borrar()
  {
    // Obtiene los datos del usuario actual
    $id = $this->session->userdata('sesion_id_usuario');

    $usuario = $this->usuario_m->obtenerPorId($id)->row();

    $this->form_validation->set_rules('contrasena_eliminar', 'Contraseña', 'trim|required|min_length[5]|max_length[12]');
    $this->form_validation->set_error_delimiters("<div class='desc error-text offset-3'>", "</div>");

    if ($this->form_validation->run() == FALSE)
    {
      $data['titulo'] = "Eliminar cuenta";
      $data['pagina'] = "usuario/borrar";
      $this->load->view($this->plantilla, $data);
    }
    else
    {
      $pass = FALSE;

      $contra = $this->security->xss_clean(strip_tags($this->input->post('contrasena_eliminar')));

      if (strcmp($contra, $usuario->contrasena) !== 0)
      {
        $mensaje['mensaje'] = "¡La contraseña es incorrecta!";
        $mensaje['mensaje_tipo'] = "error";
      }
      else
      {
        $pass = TRUE;
      }

      if ($pass)
      {
        $this->usuario_m->eliminar($id);
        $data['titulo'] = "Eliminando cuenta";
        $data['mensaje'] = "¡Cuenta eliminada!";
        $this->session->sess_destroy();

        $this->load->view('layouts/message', $data);
        return 0;
      }

      $this->session->set_userdata($mensaje);
      $this->session->mark_as_temp("mensaje", 1);
      redirect(base_url().'usuario/borrar');
      return 0;

    }
  }

}
