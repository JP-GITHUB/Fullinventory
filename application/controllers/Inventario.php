<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Inventario extends CI_Controller {
	function __construct() 
    {
        parent::__construct();

        if (!$this->session->has_userdata('info_usuario')) {
            redirect("login");
        }

        $this->load->model('inventario_model');
    }

    ##Despliega vista listar
	public function listar()
	{
        $inventarios = $this->inventario_model->listar_inventario();
		$this->load->view('inventario/listar', array('Registros' => $inventarios));
	}

    public function historial(){
        $departamento = $this->input->post('departamento');
        $producto = $this->input->post('producto');
        $historial = $this->inventario_model->historial_producto($producto, $departamento);

        $this->load->view('inventario/historial', array('Historial' => $historial));
    }
}
