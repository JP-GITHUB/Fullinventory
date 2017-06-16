<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Main extends CI_Controller {
	function __construct() {
        parent::__construct();

        if (!$this->session->has_userdata('info_usuario')) {
            redirect("login");
        }

        $this->load->model(array('producto_model', 'proveedor_model', 'departamento_model', 'usuario_model'));
    }


	public function index()
	{
        $local = $this->session->info_usuario['local_codigo'];
        $total_productos = $this->producto_model->count_productos($local);
        $total_proveedores = $this->proveedor_model->count_proveedores($local);
        $total_departamento = $this->departamento_model->count_departamentos($local);
        $total_usuarios = $this->usuario_model->count_usuarios($local);
		$this->load->view(
            'main', 
            array(
                'total_productos' => $total_productos->total_productos,
                'total_proveedores' => $total_proveedores->total_proveedores,
                'total_departamento' => $total_departamento->total_departamento,
                'total_usuarios' => $total_usuarios->total_usuarios,
            )
        );
	}
}
