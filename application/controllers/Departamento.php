<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Departamento extends CI_Controller {
	function __construct() 
    {
        parent::__construct();
        #Validar si es admin
        if (!$this->session->has_userdata('info_usuario')) {
            redirect("login");
        }

        $this->load->model(array('departamento_model'));
    }

    ##Despliega vista listar
	public function listar()
	{
        $local = $this->input->post("local");
        $departamentos = $this->departamento_model->get_departamentos_by_local($local);
		$this->load->view('departamento/listar', array(
            'local' =>  $local,
            'Departamentos' => ($departamentos) ? $departamentos : [])
        );
	}

    ##Despliega vista agregar
	public function agregar()
	{   
		$this->load->view('departamento/agregar');
	}

    ##Despliega vista modificar
	public function modificar()
	{
		$this->load->view('departamento/modificar');
	}

    public function agregar_local()
    {
        $codigo = $this->input->post('codigo');
        $nombre = $this->input->post('nombre');
        $direccion = $this->input->post('direccion');
        $comuna = $this->input->post('comuna');

        $local_db = $this->local_model->get_local($codigo);
        if(!$local_db){
            $empresa = $this->local_model->get_empresa_del_local($codigo);
            
            $respuesta = $this->local_model->save($codigo, $nombre, $direccion, $comuna, $empresa);
            if($respuesta){
                $this->output->set_content_type('application/json')
                ->set_output(json_encode(array('estado' => true, 'mensaje' => 'Local guardado exitosamente')));
            }else{
                $this->output->set_content_type('application/json')
                ->set_output(json_encode(array('estado' => false, 'mensaje' => 'Error al guardar Local')));
            }
        }else{
            $this->output->set_content_type('application/json')
            ->set_output(json_encode(array('estado' => false, 'mensaje' => 'El local ya existe.')));
        }
    }
}
