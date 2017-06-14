<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Proveedor extends CI_Controller {
	function __construct() {
        parent::__construct();

        if (!$this->session->has_userdata('info_usuario')) {
            redirect("login");
        }

        $this->load->model('Proveedor_model');
        $this->load->model('Comuna_model');
    }

	public function index()
	{	

	}

    ##Despliega vista listar
	public function listar()
	{
        $proveedores = $this->Proveedor_model->get_lista();
		$this->load->view('proveedor/listar', array('proveedores' => $proveedores));
	}

      ##Despliega vista agregar
	public function agregar()
	{
        $comunas = $this->Comuna_model->get_lista();

		$this->load->view('proveedor/agregar', array('comunas' => $comunas));
	}

    public function modificar_producto(){

        $codigo = $this->input->post('codigo');

        $comunas = $this->Comuna_model->get_lista();
         
        $proveedores = $this->Proveedor_model->get_proveedor($codigo);

		$this->load->view('proveedor/modificar', array('comunas' => $comunas, 'proveedor' => $proveedores[0]));
    }


    public function existe_proveedor()
    {
        $codigo = $this->input->post('codigo');

        $respuesta = $this->Proveedor_model->existe_proveedor($codigo);

        if($respuesta){
            $this->output->set_content_type('application/json')
            ->set_output(json_encode(array('existe' => true)));
        }else{
            $this->output->set_content_type('application/json')
            ->set_output(json_encode(array('existe' => false)));
        }
    }


    public function agregar_proveedor()
    {
        $codigo = $this->input->post('codigo');
        $nombre = $this->input->post('nombre');
        $telefono = $this->input->post('telefono');
        $direccion = $this->input->post('direccion');
        $comuna = $this->input->post('comuna');

        $respuesta = $this->Proveedor_model->save_proveedor($codigo, $nombre, $telefono, $direccion, $comuna);

        if($respuesta){
            $this->output->set_content_type('application/json')
            ->set_output(json_encode(array('estado' => true, 'mensaje' => 'Proveedor guardado exitosamente!')));
        }else{
            $this->output->set_content_type('application/json')
            ->set_output(json_encode(array('estado' => false, 'mensaje' => 'Error al guardar Proveedor')));
        }
    }

     public function guardar_cambios_proveedor()
    {
        $codigo = $this->input->post('codigo');
        $nombre = $this->input->post('nombre');
        $telefono = $this->input->post('telefono');
        $direccion = $this->input->post('direccion');
        $comuna = $this->input->post('comuna');

        $respuesta = $this->Proveedor_model->save_change_proveedor($codigo, $nombre, $telefono, $direccion, $comuna);

        if($respuesta){
            $this->output->set_content_type('application/json')
            ->set_output(json_encode(array('estado' => true, 'mensaje' => 'Proveedor guardado exitosamente!')));
        }else{
            $this->output->set_content_type('application/json')
            ->set_output(json_encode(array('estado' => false, 'mensaje' => 'No se han guardado cambios en el Proveedor')));
        }
    }

     public function cambiar_estado_proveedor()
    {
        $codigo = $this->input->post('codigo');
        $id_estado = $this->input->post('id_estado');
        
        $respuesta = $this->Proveedor_model->change_state($codigo, $id_estado);

        if($respuesta){
            $this->output->set_content_type('application/json')
            ->set_output(json_encode(array('estado' => true, 'mensaje' => 'Cambio realizado exitosamente!')));
        }else{
            $this->output->set_content_type('application/json')
            ->set_output(json_encode(array('estado' => false, 'mensaje' => 'No se han guardado cambios en el Proveedor')));
        }
    }

    public function buscar_proveedor(){

        $filtro = $this->input->post('filtro');
        
        $proveedores = $this->Proveedor_model->get_proveedor($filtro);

		$this->load->view('proveedor/listar', array('proveedores' => $proveedores));
        
    }
}
