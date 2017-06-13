<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Producto extends CI_Controller {
	function __construct() 
    {
        parent::__construct();

        if (!$this->session->has_userdata('email')) {
            redirect("login");
        }

        $this->load->model('producto_model');
    }

    ##Despliega vista listar
	public function listar()
	{
        $productos = $this->producto_model->get_lista();
		$this->load->view('producto/listar', array('Productos' => $productos));
	}

    ##Despliega vista agregar
	public function agregar()
	{
		$this->load->view('producto/agregar');
	}

    public function agregar_producto(){
        $datos = $this->input->post();
        $codigo = $datos['codigo'];

        $producto_db = $this->producto_model->get_productos($codigo);
        if(!$producto_db){
            $this->output->set_content_type('application/json')
            ->set_output(json_encode(array('estado' => true, 'mensaje' => 'Call save model')));
        }else{
            $this->output->set_content_type('application/json')
            ->set_output(json_encode(array('estado' => false, 'mensaje' => 'El Producto ya existe.')));
        }
    }
}
