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
        $local = $this->session->info_usuario['local_codigo'];
        $inventarios = $this->inventario_model->listar_inventario($local);
		$this->load->view('inventario/listar', array('Registros' => $inventarios));
	}

    public function historial(){
        $departamento = $this->input->post('departamento');
        $producto = $this->input->post('producto');
        $local = $this->session->info_usuario['local_codigo'];

        $historial = $this->inventario_model->historial_producto($producto, $departamento, $local);

        $this->load->view('inventario/historial', array('Historial' => $historial));
    }

    public function obtener_movimientos(){
        $departamento = $this->input->post('departamento');
        $producto = $this->input->post('producto');
        $local = $this->session->info_usuario['local_codigo'];

        $ventas = $this->inventario_model->obtener_movimientos($producto, $departamento, $venta = 2, $local);
        $mermas = $this->inventario_model->obtener_movimientos($producto, $departamento, $merma = 3, $local);

        $aMatrizVenta = array('1'=>0, '2'=>0 ,'3'=>0 ,'4'=>0 ,'5'=>0 ,'6'=>0 ,'7'=>0 ,'8'=>0 ,'9'=>0 ,'10'=>0 ,'11'=>0 ,'12'=>0);
        $aReturn = array();
        foreach ($ventas as $key => $value) {
            $aMatrizVenta[$value['mes']] = (int) $value['total'];
        }

        $aMatrizMerma = array('1'=>0, '2'=>0 ,'3'=>0 ,'4'=>0 ,'5'=>0 ,'6'=>0 ,'7'=>0 ,'8'=>0 ,'9'=>0 ,'10'=>0 ,'11'=>0 ,'12'=>0);
        foreach ($mermas as $key => $value) {
            $aMatrizMerma[$value['mes']] = (int) $value['total'];
        }

        for ($i=1; $i <= 12; $i++) { 
            $aReturn['ventas'][] = $aMatrizVenta[$i];
            $aReturn['mermas'][] = $aMatrizMerma[$i];
            $aReturn['total'][] = $aMatrizVenta[$i] + $aMatrizMerma[$i];
        }

        $this->output->set_content_type('application/json')
        ->set_output(json_encode(array('estado' => true, 'datos' => $aReturn)));
    }
}
