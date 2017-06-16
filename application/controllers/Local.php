<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Local extends CI_Controller {
	function __construct() 
    {
        parent::__construct();
        if (!$this->session->has_userdata('info_usuario')) {
            redirect("login");
        }else{
            if($this->session->info_usuario['rol_id'] != 1){
                redirect("login");
            }
        }

        $this->load->model(array('local_model', 'comuna_model'));
    }

    ##Despliega vista listar
	public function listar()
	{
        $local = $this->session->info_usuario['local_codigo'];
        $locales = $this->local_model->get_otros_locales($local);
		$this->load->view('local/listar', array('Locales' => $locales));
	}

    ##Despliega vista agregar
	public function agregar()
	{   
        $comunas = $this->comuna_model->get_lista();
		$this->load->view('local/agregar', array('Comunas' => $comunas));
	}

    ##Despliega vista modificar
	public function modificar()
	{
        $codigo = $this->input->post('codigo_local');

        $local = $this->local_model->get_local($codigo);
        
        $comunas = $this->comuna_model->get_lista();

		$this->load->view('local/modificar', array('Comunas' => $comunas, 'local' => $local));
	}

    public function buscar_locales()
    {
        $filtro = $this->input->post('filtro');
        $locales = $this->local->get_locales($filtro);
        $this->load->view('local/listar', array('locales' => $locales));
    }

    public function agregar_local()
    {
        $codigo = $this->input->post('codigo');
        $nombre = $this->input->post('nombre');
        $direccion = $this->input->post('direccion');
        $comuna = $this->input->post('comuna');

        $local_db = $this->local_model->get_local($codigo);
        if(!$local_db){

            $local = $this->session->info_usuario['local_codigo'];

            $empresa = $this->local_model->get_empresa_del_local($local);
            
            $respuesta = $this->local_model->save($codigo, $nombre, $direccion, $comuna, $empresa->empresa_id);

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

     public function buscar_local(){

        $filtro = $this->input->post('filtro');
        
        $locales = $this->local_model->get_local_filter($filtro);

		$this->load->view('local/listar', array('Locales' => $locales));      
        
    }

    public function guardar_cambios_local(){

        $codigo = $this->input->post('codigo');
        $nombre = $this->input->post('nombre');
        $direccion = $this->input->post('direccion');
        $comuna = $this->input->post('comuna');

        $respuesta = $this->local_model->save_change_local($codigo, $nombre, $direccion, $comuna);

        if($respuesta){
            $this->output->set_content_type('application/json')
            ->set_output(json_encode(array('estado' => true, 'mensaje' => 'Local guardado exitosamente!')));
        }else{
            $this->output->set_content_type('application/json')
            ->set_output(json_encode(array('estado' => false, 'mensaje' => 'No se han guardado cambios en el Local')));
        }
    }

    public function cambiar_estado_local()
    {
        $codigo = $this->input->post('codigo');
        $id_estado = $this->input->post('id_estado');

        $respuesta = $this->local_model->change_state($codigo, $id_estado);

        if($respuesta){
            $this->output->set_content_type('application/json')
            ->set_output(json_encode(array('estado' => true, 'mensaje' => 'Cambio realizado exitosamente!')));
        }else{
            $this->output->set_content_type('application/json')
            ->set_output(json_encode(array('estado' => false, 'mensaje' => 'No se han guardado cambios en el Proveedor')));
        }
    }
}
