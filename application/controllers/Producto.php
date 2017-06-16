<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Producto extends CI_Controller {
	function __construct() 
    {
        parent::__construct();

        if (!$this->session->has_userdata('info_usuario')) {
            redirect("login");
        }

        $this->load->model('Producto_model');
        $this->load->model('Proveedor_model');
        $this->load->model('Departamento_model');        
    }

    ##Despliega vista listar
	public function inicio()
	{        
        $this->load->view('producto/inicio');
	}

    public function listar()
	{
        $local = $this->session->info_usuario['local_codigo'];
        
        $productos = $this->Producto_model->get_productos($local);
		
        $this->load->view('producto/listar', array('productos' => $productos));
	}

    ##Despliega vista agregar
	public function agregar()
	{
        $local = $this->session->info_usuario['local_codigo'];

        $proveedores = $this->Proveedor_model->get_lista();
        $departamentos = $this->Departamento_model->get_departamentos_by_local($local);

		$this->load->view('producto/agregar', array('proveedores' => $proveedores, 'departamentos' => $departamentos));
	}

    ##Despliega vista agregar
	public function modificar()
	{
		$this->load->view('producto/modificar');
	}

    public function buscar_productos()
    {
        $local = $this->session->info_usuario['local_codigo'];
        $filtro = $this->input->post('filtro');
        $productos = $this->Producto_model->get_productos($local, $filtro);
        $this->load->view('producto/listar', array('Productos' => $productos));
    }

    public function agregar_producto()
    {
        $codigo = $this->input->post('codigo');
        $nombre = $this->input->post('nombre');
        $descripcion = $this->input->post('descripcion');
        $cantidad = $this->input->post('cantidad');
        $codproveedor = $this->input->post('codproveedor');
        $departamento = $this->input->post('departamento');
        $imagen = $this->input->post('imagen');


        $respuesta = $this->Producto_model->save_producto($codigo, $nombre, $descripcion, $cantidad, $codproveedor, $departamento, $imagen);

        if($respuesta){
            $this->output->set_content_type('application/json')
            ->set_output(json_encode(array('estado' => true, 'mensaje' => 'Producto guardado exitosamente!')));
        }else{
            $this->output->set_content_type('application/json')
            ->set_output(json_encode(array('estado' => false, 'mensaje' => 'Error al guardar Producto')));
        }
    }

     function save_archivo() {

        $ruta = "assets/images/";

        $config['upload_path'] = $ruta;
        $config['allowed_types'] = '*';
        
        $config['max_filename'] = '25500000';

        if (isset($_FILES['file']['name'])) {
            $full_path = $ruta . DIRECTORY_SEPARATOR . $_FILES['file']['name'];

            if (file_exists($full_path)) {
                unlink($full_path);
            }


            if (0 < $_FILES['file']['error']) {
                $arr_data = array('success' => false, 'error' => $this->upload->display_errors());
            } else {
                $this->load->library('upload', $config);
                if (!$this->upload->do_upload('file')) {

                    $arr_data = array('success' => false, 'error' => $this->upload->display_errors());
                } else {
                    $arr_data = array('success' => true);
                }
            }
        }

        $this->outputJSON(json_encode($arr_data));
    }

}
