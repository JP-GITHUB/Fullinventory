<?php

class Producto_model extends CI_Model {

    public function __construct()
    {
        parent::__construct();
        // Your own constructor code
    }

    public function get_lista(){
        $this->db->select('*');
        $this->db->from('producto');
        return $this->db->get()->result_array();
    }
    
    public function get_productos($codigo = null){
        $this->db->select('codigo, departamento_codigo, proveedor_codigo, estado_id');
        $this->db->from('producto');
        $this->db->where('codigo', $codigo);
        return $this->db->get()->row_array();
    }

    public function save($data){
        $this->db->insert('producto', $data);
    }
}