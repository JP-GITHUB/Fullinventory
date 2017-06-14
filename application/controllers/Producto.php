<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Producto extends CI_Controller {
	function __construct() 
    {
        parent::__construct();

        if (!$this->session->has_userdata('info_usuario')) {
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

    ##Despliega vista agregar
	public function modificar()
	{
		$this->load->view('producto/modificar');
	}

    public function buscar_productos()
    {
        $filtro = $this->input->post('filtro');
        $productos = $this->producto_model->get_productos($filtro);
        $this->load->view('producto/listar', array('Productos' => $productos));
    }

    public function agregar_producto()
    {
        $codigo = $this->input->post('codigo');

        $producto_db = $this->producto_model->get_producto($codigo);
        if(!$producto_db){
            $this->output->set_content_type('application/json')
            ->set_output(json_encode(array('estado' => true, 'mensaje' => 'Call save model')));
        }else{
            $this->output->set_content_type('application/json')
            ->set_output(json_encode(array('estado' => false, 'mensaje' => 'El Producto ya existe.')));
        }
    }
}
