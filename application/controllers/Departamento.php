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

        $this->load->model(array('Departamento_model'));
    }

    ##Despliega vista listar
	public function listar()
	{
        $local = $this->input->post("local");
        $departamentos = $this->Departamento_model->get_departamentos_by_local($local);
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

    public function cambiar_estado_departamento(){
        
        $codigo = $this->input->post('codigo');
        $id_estado = $this->input->post('id_estado');
        
        $respuesta = $this->Departamento_model->change_state($codigo, $id_estado);

        if($respuesta){
            $this->output->set_content_type('application/json')
            ->set_output(json_encode(array('estado' => true, 'mensaje' => 'Cambio realizado exitosamente!')));
        }else{
            $this->output->set_content_type('application/json')
            ->set_output(json_encode(array('estado' => false, 'mensaje' => 'No se han guardado cambios en el Departamento')));
        }

    }
   

    ##Despliega vista modificar
	public function modificar()
	{
        $codigo = $this->input->post('codigo_departamento');

        $departamentos = $this->Departamento_model->get_departamento($codigo);

		$this->load->view('departamento/modificar', array('departamento' => $departamentos));
	}

    public function agregar_departamento()
    {
        $local = $this->input->post('local');
        $codigo = $this->input->post('codigo');
        $nombre = $this->input->post('nombre');        
        
        $respuesta = $this->Departamento_model->save_departamento($local,$codigo, $nombre);

        if($respuesta){
            $this->output->set_content_type('application/json')
            ->set_output(json_encode(array('estado' => true, 'mensaje' => 'Departamento guardado exitosamente!')));
        }else{
            $this->output->set_content_type('application/json')
            ->set_output(json_encode(array('estado' => false, 'mensaje' => 'Error al guardar Proveedor')));
        }
    }

    public function guardar_cambios_departamento(){

        $codigo = $this->input->post('codigo');
        $nombre = $this->input->post('nombre');
        
        $respuesta = $this->Departamento_model->save_change_departamento($codigo, $nombre);

        if($respuesta){
            $this->output->set_content_type('application/json')
            ->set_output(json_encode(array('estado' => true, 'mensaje' => 'Departamento guardado exitosamente!')));
        }else{
            $this->output->set_content_type('application/json')
            ->set_output(json_encode(array('estado' => false, 'mensaje' => 'No se han guardado cambios en el Departamento')));
        }
    }
}
