<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {

	function __construct() {
        parent::__construct();

        $this->load->model('usuario_model');
    }


	public function index()
	{        
		$this->load->view('login/index');
	}

    function validar_usuario(){
        $email = $this->input->post('email');
        $clave = $this->input->post('clave');

        if ($email == "" || $clave == ""){
            $this->output->set_content_type('application/json')->set_output(json_encode(array('estado' => false, 'mensaje' => 'Ambos campos son requeridos.')));
        }

        $existencia = $this->usuario_model->verificar_existencia($email);
        if($existencia){
            if($existencia['clave'] == $clave){
                $this->session->set_userdata('info_usuario', array(
                    'nombre' => $existencia['nombre'],
                    'apellido' => $existencia['apellido_paterno'],
                    'estado' => $existencia['estado_id'],
                    'local_codigo' => $existencia['local_codigo'],
                    'email' => $existencia['email'],
                    'rol_id' => $existencia['rol_id'],
                ));

                $this->output->set_content_type('application/json')->set_output(json_encode(array('estado' => true)));
            }else{
                $this->output->set_content_type('application/json')->set_output(json_encode(array('estado' => false, 'mensaje' => 'El usuario no es valido.')));
            }
        }else{
            $this->output->set_content_type('application/json')->set_output(json_encode(array('estado' => false, 'mensaje' => 'El usuario no es valido.')));
        }

    }

    public function logout() {
        $this->session->unset_userdata('info_usuario');
        $this->removeCache();
        redirect("login");
    }

    public function removeCache() {
        $this->output->set_header('Last-Modified:' . gmdate('D, d M Y H:i:s') . 'GMT');
        $this->output->set_header('Cache-Control: no-store, no-cache, must-revalidate');
        $this->output->set_header('Cache-Control: post-check=0, pre-check=0', false);
        $this->output->set_header('Pragma: no-cache');
    }
}
